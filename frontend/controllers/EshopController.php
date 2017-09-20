<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

use dvizh\shop\models\Category;
use dvizh\shop\models\Product;

use dvizh\order\models\PaymentType;
use dvizh\order\models\ShippingType;

use frontend\models\ContactForm;

use dvizh\cart\events\Cart as CartEvent;

/**
 * Eshop controller
 */
class EshopController extends Controller
{

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
    * Displays homepage.
    *
    * @return mixed
    */
    public function actionIndex()
    {
        $categories = Category::find()->all();
        $products   = Product::find()->andWhere(['is_popular' => 'yes', 'available' => 'yes'] )->orderBy('is_popular ASC, id DESC')->all();
        return $this->render('index', [
            'categories' => $categories,
            'products'   => $products
        ]);
    }

    public function actionSearch()
    {
        $categories = Category::find()->all();
        $query = Product::find()->andWhere(['available' => 'yes'] )->orderBy('is_popular ASC, id DESC');


        if($filter = yii::$app->request->get('sfilter')) {
            //$query->filtered($filter);
            $query = $query->andFilterWhere([
                'or',
                ['like', 'code', $filter],
                ['like', 'sku', $filter],
                ['like', 'name', $filter],
                ['like', 'text', $filter],
                ['like', 'short_text', $filter],
                ['like', 'slug', $filter],
            ]);
        } else {
            $query = $query->andFilterWhere(['is_popular' => 'yes']);
        }

        $products = $query->all();

        return $this->render('index', [
            'categories' => $categories,
            'products'   => $products,
            'filter'     => $filter,
        ]);
    }

    /**
     * Displays cart.
     *
     * @return mixed
     */
    public function actionCart()
    {
        $shippingTypesList = ShippingType::find()->orderBy('order DESC')->all();
        $paymentTypesList = PaymentType::find()->orderBy('order DESC')->all();

        $elementEvent = new CartEvent([
            'cart' => yii::$app->cart->getElements(),
            'cost' => yii::$app->cart->getCost(),
            'count' => yii::$app->cart->getCount(),
        ]);
        $cartComponent = yii::$app->cart;
        $cartComponent->trigger($cartComponent::EVENT_CART_UPDATE, $elementEvent);

        return $this->render('cart', [
            'shippingTypesList' => $shippingTypesList,
            'paymentTypesList'  => $paymentTypesList
        ]);
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionCategory($id=null)
    {
        if (empty($id)) {
            return $this->redirect([\Yii::$app->params['eshopPrefix'].'/index',]);
        }

        $category = $this->findCategory($id);

        $query = Product::find()->andWhere(['available' => 'yes'] )->category($category->id)->orderBy('is_popular ASC, id DESC');
        $queryForFilter = clone $query;
        if($filter = yii::$app->request->get('filter')) {
            $query->filtered($filter);
        }
        $products = $query->all();
        return $this->render('category', [
            'queryForFilter' => $queryForFilter,
            'products' => $products,
            'category' => $category,
        ]);
    }
    public function actionCategories($slug=null)
    {
        if (empty($slug)) {
            return $this->redirect([\Yii::$app->params['eshopPrefix'].'/index',]);
        }

        $category = $this->findCategoryBySlug($slug);

        #$query = Product::find()->andWhere(['available' => 'yes'] )->category($category->id)->orderBy('is_popular ASC, id DESC');
        $query = $category->getProducts()->available()->orderBy('is_popular ASC, id DESC');
        $queryForFilter = clone $query;
        if($filter = yii::$app->request->get('filter')) {
            $query->filtered($filter);
        }
        $products = $query->all();
        return $this->render('category', [
            'queryForFilter' => $queryForFilter,
            'products' => $products,
            //'products' => $category->getProducts()->all(),
            'category' => $category,
        ]);
    }

    protected function findCategory($id)
    {
        $model = new Category;

        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app/frontend','The requested category does not exist.'));
        }
    }

    protected function findCategoryBySlug($slug)
    {
        $model = new Category;

        if (($model = $model::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app/frontend','The requested category does not exist.'));
        }
    }

    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionProduct($id=null, $category=null)
    {
        if (empty($category)) {
            return $this->redirect([\Yii::$app->params['eshopPrefix'].'/index',]);
        }

        if (empty($id)) {
            return $this->redirect([\Yii::$app->params['eshopPrefix'].'/'.$category,]);
        }

        $product = $this->findProduct($id);

        if ( ( $product->category->id != $category ) && ( $product->category->slug != $category ) ) {
            return $this->redirect([\Yii::$app->params['eshopPrefix'].'/'.$category,]);
        }

        return $this->render('product', [
            'product' => $product,
        ]);
    }

    protected function findProduct($id)
    {
        $model = new Product;

        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app/frontend','The requested product does not exist.'));
        }
    }

    protected function findProductBySlug($slug)
    {
        $model = new Product;

        if (($model = $model::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('app/frontend','The requested product does not exist.'));
        }
    }

    public function actionProducts($slug=null, $category=null)
    {
        if (empty($category)) {
            return $this->redirect([\Yii::$app->params['eshopPrefix'].'/index',]);
        }

        if (empty($slug)) {
            return $this->redirect([\Yii::$app->params['eshopPrefix'].'/'.$category,]);
        }

        $product = $this->findProductBySlug($slug);

        if ( ( $product->category->id != $category ) && ( $product->category->slug != $category ) ) {
            return $this->redirect([\Yii::$app->params['eshopPrefix'].'/'.$category,]);
        }

        return $this->render('product', [
            'product' => $product,
        ]);
    }
}
