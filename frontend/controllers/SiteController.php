<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use dvizh\shop\models\Category;
use dvizh\shop\models\Product;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

/**
 * Site controller
 */
class SiteController extends Controller
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
        $products   = Product::find()->orderBy('id DESC')->all();

        return $this->render('index', [
            'categories' => $categories,
            'products'   => $products
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
            return $this->redirect(['site/index',]);
        }

        $category = $this->findCategory($id);

        $query = Product::find()->category($category->id)->orderBy('id DESC');
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
            return $this->redirect(['site/index',]);
        }

        $category = $this->findCategoryBySlug($slug);

        $query = Product::find()->category($category->id)->orderBy('id DESC');
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

    protected function findCategory($id)
    {
        $model = new Category;

        if (($model = $model::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('frontend','The requested category does not exist.'));
        }
    }

    protected function findCategoryBySlug($slug)
    {
        $model = new Category;

        if (($model = $model::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('frontend','The requested category does not exist.'));
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
            return $this->redirect(['site/index',]);
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
            throw new NotFoundHttpException(Yii::t('frontend','The requested product does not exist.'));
        }
    }

    protected function findProductBySlug($slug)
    {
        $model = new Product;

        if (($model = $model::findOne(['slug' => $slug])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('frontend','The requested product does not exist.'));
        }
    }

    public function actionProducts($slug=null, $category=null)
    {
        if (empty($category)) {
            return $this->redirect(['site/index',]);
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


    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionDemoIndex()
    {
        $categories = Category::find()->all();

        if($catId = yii::$app->request->get('categoryId')) {
            $category = Category::findOne($catId);
        } elseif($categories) {
            $category = current($categories);
        } else {
            $category = null;
        }

        if($category) {
            $query = Product::find()->category($category->id)->orderBy('id DESC');
        } else {
            $query = Product::find()->orderBy('id DESC');
        }

        $queryForFilter = clone $query;

        if($filter = yii::$app->request->get('filter')) {
            $query->filtered($filter);
        }

        $products = $query->all();

        return $this->render('demoindex', [
            'queryForFilter' => $queryForFilter,
            'categories' => $categories,
            'products' => $products,
            'category' => $category,
        ]);
    }

    public function actionThanks()
    {
        return $this->render('thanks');
    }

    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending email.');
            }

            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
