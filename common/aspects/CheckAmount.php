<?php
namespace common\aspects;

use Yii;

use dvizh\cart\Cart;

use yii\web\NotFoundHttpException;

class CheckAmount extends \yii\base\Behavior
{
    public $eventName = 'cart_update';

    public function events()
    {
        $eventName = $this->eventName;

        return [
            Cart::EVENT_CART_UPDATE => 'checkAvailable'
        ];
    }

    public function checkAvailable($event)
    {

        if (!empty($event->cart)) {
            foreach ($event->cart as $cartElement) {
                $product = $cartElement->getModel();
                $amountMax = ( $product->amount ) > 0 ? $product->amount : 0;
                if ( $cartElement->count > $amountMax )  {
                    $cartElement->setCount($amountMax, true);
                    yii::$app->session->setFlash('checkAmountError', Yii::t('app/common', 'Atsiprašome, šiuo metu sandėlyje tokio prekės kiekio neturime'));
                }
            }
        }
    }

}
