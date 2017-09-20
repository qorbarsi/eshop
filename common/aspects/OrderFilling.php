<?php
namespace common\aspects;

use Yii;

use dvizh\order\models\Element;
use dvizh\order\models\ShippingType;
use yii\base\Exception;

class OrderFilling extends \yii\base\Behavior
{
    public function events()
    {
        return [
            'create' => 'putElements'
        ];
    }

    public function checkAmounts () {
        $cnt = 0;
        foreach(yii::$app->cart->elements as $element) {
            $elementCount = $element->getCount();

            if ($elementCount > 0) {
                try {
                    $product = $element->getModel();
                } catch (Exception $e) {
                    return false;
                }
                $amount = ( isset($product->amount) && ( $product->amount > 0 ) ) ? $product->amount : 0;
                if ($elementCount > $amount ) {
                    return false;
                }
                $cnt += 1;
            }
        }

        return ( $cnt > 0 );
    }

    public function putElements($event)
    {
        $order = $event->model;

        if (!$this->checkAmounts()) {
            $order->delete();
            //yii::$app->session->setFlash('checkAmountError', Yii::t('app/common', 'Atsiprašome, šiuo metu sandėlyje tokio prekės kiekio neturime'));
            throw new Exception(Yii::t('app/common','Atsiprašome, šiuo metu sandėlyje tokio prekės kiekio neturime'));
        }

        foreach(yii::$app->cart->elements as $element) {

            if (!empty($element->getCount())) {

                $elementModel = new Element;

                $elementModel->setOrderId($order->id);
                $elementModel->setAssigment($order->is_assigment);
                $elementModel->setModelName($element->getModelName());
                $elementModel->setName($element->getName());
                $elementModel->setItemId($element->getItemId());
                $elementModel->setCount($element->getCount());
                $elementModel->setBasePrice($element->getPrice(false));
                $elementModel->setPrice($element->getPrice());
                $elementModel->setOptions(json_encode($element->getOptions()));
                $elementModel->setDescription('');
                $elementModel->saveData();

                $product = $element->getModel();
                $product->minusAmount($element->getCount());
            }
        }

        if (yii::$app->cart) {
            $order->base_cost = yii::$app->cart->getCost(false);
            $order->cost      = yii::$app->cart->getCost(true);
        } else {

            $order->base_cost = 0;
            $order->cost = 0;

            foreach($order->elements as $element) {
                $order->base_cost += ($element->base_price*$element->count);
                $order->cost += ($element->price*$element->count);
            }
        }

        $shippingCost = 0;

        if ( $orderShippingType = $order->shipping_type_id ) {
            if($orderShippingType > 0) {
                $shippingType = ShippingType::findOne($orderShippingType);

                if(($shippingType && $shippingType->cost > 0) && ((int)$shippingType->free_cost_from <= 0 | $shippingType->free_cost_from > $order->cost)) {
                    $shippingCost = $shippingType->cost;
                }
            }
        }

        $order->base_cost += $shippingCost;
        $order->cost += $shippingCost;


        $order->save();

        yii::$app->cart->truncate();
        if ( isset(yii::$app->promocode) ) {
            yii::$app->promocode->clear();
        }
    }
}
