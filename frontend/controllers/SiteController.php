<?php
namespace frontend\controllers;

use Yii;
use yii\web\Controller;
use dvizh\shop\models\Category;
use dvizh\shop\models\Product;
use frontend\models\ContactForm;
use yii\web\NotFoundHttpException;

use yii\filters\VerbFilter;
use yii\validators\EmailValidator;

use MailerLiteApi\MailerLite;
/**
 * Site controller
 */
class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'subscribe' => ['POST',],
                ],
            ],

        ];
    }

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

        return $this->render('index', [
            'queryForFilter' => $queryForFilter,
            'categories' => $categories,
            'products' => $products,
            'category' => $category,
        ]);
    }

    public function actionSubscribe() {
        if ( $email = yii::$app->request->post('email')) {
            $validator = new EmailValidator();

            if ( !$validator->validate($email, $error) ) {
                die(json_encode(['result' => 'fail', 'error' => $error]));
            }

            if (
                isset(yii::$app->params['ML_API_KEY']) &&
                ($key = yii::$app->params['ML_API_KEY']) &&
                isset(yii::$app->params['ML_GROUP_ID']) &&
                ($gid = yii::$app->params['ML_GROUP_ID'])
            ) {

                $groupsApi = (new MailerLite($key))->groups();
        		$subscribersApi = (new MailerLite($key))->subscribers();
        		$subscriber = $subscribersApi->find($email);
        		$array = json_decode(json_encode($subscriber),true);

        		if ( isset($array['error']['code']) && ( $array['error']['code'] == 123 ) ) {
        			$subscriber = [ 'email' => $email,];
        			$addedSubscriber = $groupsApi->addSubscriber(5546820, $subscriber);
                }
                die(json_encode(['result' => 'success']));
            } else {
                die(json_encode(['result' => 'fail', 'error' => Yii::t('app/frontend','Subsribing failed')]));
            }
        } else {
            die(json_encode(['result' => 'fail', 'error' => Yii::t('app/frontend','Invalid email specified')]));
        }
    }

    public function actionThanks()
    {
        return $this->render('thanks');
    }


    public function actionReview()
    {
        return $this->render('review');
    }

    public function actionArticle()
    {
        return $this->render('article');
    }

    public function actionDelivery()
    {
        return $this->render('delivery');
    }

    public function actionWarranty()
    {
        return $this->render('warranty');
    }

    public function actionReturn()
    {
        return $this->render('return');
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
