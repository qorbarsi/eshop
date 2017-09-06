<?php
namespace common\aspects;

use Yii;
use Exception;
use MailerLiteApi\MailerLite;

class OrderSubscribe extends \yii\base\Behavior
{
    public function events()
    {
        return [
            'create' => 'subscribeClient'
        ];
    }

    public function subscribeClient($event)
    {
        $order = $event->model;

        if ( !empty($order->email ) ) {
            if (
                isset(yii::$app->params['ML_API_KEY']) &&
                ($key = yii::$app->params['ML_API_KEY']) &&
                isset(yii::$app->params['ML_GROUP_ID']) &&
                ($gid = yii::$app->params['ML_GROUP_ID'])
            ) {
                try {
                    $groupsApi = (new MailerLite($key))->groups();
                    $subscribersApi = (new MailerLite($key))->subscribers();
                    $subscriber = $subscribersApi->find($order->email);
                    $array = json_decode(json_encode($subscriber),true);

                    if ( isset($array['error']['code']) && ( $array['error']['code'] == 123 ) ) {
                        $subscriber = [ 'email' => $order->email,];
                        $addedSubscriber = $groupsApi->addSubscriber($gid, $subscriber);
                    }
                } catch (Exception $e) {
                    yii::error(print_r($e,true));
                }

            }
        }
    }
}
