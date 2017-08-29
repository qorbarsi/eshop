<?php

namespace qorbarsi\paysera\widgets;

use yii;
use yii\helpers\Url;

require_once(dirname(__DIR__).'/libwebtopay/WebToPay.php');

class PayseraForm extends \yii\base\Widget
{
    public $description = '';
    public $orderModel;
    public $autoSend = false;
    public $view = 'form';
    public $txtAmountTemplate = '{amount} {currency}';
    public $currency;
    public $payment;

    protected $module;

    public function init()
    {
        $this->module =yii::$app->getModule('paysera');
        $this->currency = empty($this->currency) ? $this->module->currency : $this->currency;

        return parent::init();
    }

    public function run()
    {
        if(empty($this->orderModel)) {
            return false;
        }

        $acceptUrl = empty($this->module->acceptUrl) ? Url::to(['paysera/accept'],true) : $this->module->acceptUrl;
        $cancelUrl = empty($this->module->cancelUrl) ? Url::to(['paysera/cancel'],true) : $this->module->cancelUrl;
        $callbackUrl = empty($this->module->callbackUrl) ? Url::to(['paysera/callback'],true) : $this->module->callbackUrl;

        $oid = $this->orderModel->getId();
        $amount = $this->orderModel->getCost();

        if ( isset($orderModel->getCostFormatted) && is_callable($orderModel->getCostFormatted) ) {
            $txt_amount = $orderModel->getCostFormatted();
        } else {
            $txt_amount = str_replace(['{amount}', '{currency}'],
                [$amount, $this->currency],
                $this->txtAmountTemplate
            );
        }

        $data = [
            'projectid'     => $this->module->projectId,
            'sign_password' => $this->module->signPassword,
            'orderid'       => $oid,
            'amount'        => $amount*100,
            'currency'      => $this->currency,
            'country'       => $this->module->country,
            'accepturl'     => $acceptUrl,
            'cancelurl'     => $cancelUrl,
            'callbackurl'   => $callbackUrl,
            'test'          => $this->module->test,
            'payment'       => $this->payment,
        ];

        //$request = \WebToPay::redirectToPayment($data);
        $factory = new \WebToPay_Factory([
            'projectId' => $this->module->projectId,
            'password'  => $this->module->signPassword
        ]);

        $url = $factory->getRequestBuilder()->buildRequestUrlFromData($data);

        return $this->render($this->view, [
            'orderModel' => $this->orderModel,
            'description' => $this->description,
            'autoSend' => $this->autoSend,
            'url' => $url,
            'txt_amount' => $txt_amount,
        ]);
    }
}
