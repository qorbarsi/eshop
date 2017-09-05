<?php
namespace qorbarsi\paysera\controllers;

use yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\helpers\Url;
use yii\filters\VerbFilter;

use qorbarsi\paysera\widgets\PayseraForm;

require_once(dirname(__DIR__).'/libwebtopay/WebToPay.php');

class PayseraController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'redirect' => ['POST',],
                    'callback' => ['POST','GET'],
                    'accept' => ['GET','POST'],
                    'cancel' => ['GET','POST'],
                ],
            ],

        ];
    }

    public function beforeAction($action)
    {
        if ($action->id == 'callback') {
            $this->enableCsrfValidation = false;
        }
        return parent::beforeAction($action);
    }

    function actionRedirect()
    {
        $module = yii::$app->getModule('paysera');

        $orderId = yii::$app->request->post('order_id');
        $payment = yii::$app->request->post('payment_bank');

        $orderModel = $this->findOrderModel($module->orderModelClass,$orderId);

        return PayseraForm::widget([
            'autoSend'    => true,
            'orderModel'  => $orderModel,
            'description' => Yii::t('paysera', 'Order #{number}', ['number' => $orderModel->id]),
            'payment'     => $payment,
        ]);
    }

    function actionAccept()
    {
        return $this->render('accept', [
        ]);
    }

    function actionCancel()
    {
        return $this->render('cancel', [
        ]);
    }

    function actionCallback()
    {
        $module = yii::$app->getModule('paysera');

        if ( isset($_GET['data']) && isset($_GET['ss1']) ) {
            $req = $_GET;
        } else {
            $req = $_POST;
        }

        try {
            $response = \WebToPay::checkResponse($req , [
                'projectid'     => $module->projectId,
                'sign_password' => $module->signPassword,
            ]);

            if ($response['test'] !== '0') {
                throw new Exception('Testing, real payment was not made');
            }

            if ($response['type'] !== 'macro') {
                throw new Exception('Only macro payment callbacks are accepted');
            }

            $orderId = $response['orderid'];
            $amount = $response['amount'];
            $currency = $response['currency'];

            $orderModel = $this->findOrderModel($module->orderModelClass,$orderId);

            //@todo: patikrinti, ar užsakymas su $orderId dar nepatvirtintas (callback gali būti pakartotas kelis kartus)
            //@todo: patikrinti, ar užsakymo suma ir valiuta atitinka $amount ir $currency
            //@todo: patvirtinti užsakymą

            $order_total = number_format($orderModel->getCost(), 2, '.', '');
            if( $amount < $order_total) {
                return 'INCORRECT AMOUNT';
            } else {
                $orderModel->setPaymentStatus('yes');
                $orderModel->save(false);

                return 'OK';
            }

        } catch (Exception $e) {
            return get_class($e) . ': ' . $e->getMessage();
        }
    }

    protected function findOrderModel($modelClass, $id)
    {
        $orderModel = new $modelClass;

        if (($model = $orderModel::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException(Yii::t('paysera', 'The requested order does not exist.'));
        }
    }


}
