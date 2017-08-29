<?php
namespace qorbarsi\paysera;

use yii;

class Module extends \yii\base\Module
{
    public $signPassword = '';
    public $projectId = '';
    public $acceptUrl = '';
    public $cancelUrl = '';
    public $callbackUrl = '';
    public $test = 0;
    public $currency = 'EUR';
    public $country = 'LT';

    public $orderModelClass = 'dvizh\order\models\Order';

    public function init()
    {
        $this->test = ( !empty($this->test) && ( $this->test > 0 ) ) ? 1 : 0;
        parent::init();
    }
}
