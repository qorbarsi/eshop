<?php
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

#use dvizh\shop\models\Category;
#use dvizh\shop\widgets\ShowPrice;
#use dvizh\filter\widgets\FilterPanel;
#use dvizh\field\widgets\Show;
use dvizh\cart\widgets\ElementsList;
#use dvizh\cart\widgets\CartInformer;
#use dvizh\cart\widgets\ChangeOptions;
#use dvizh\cart\widgets\ChangeCount;
#use dvizh\cart\widgets\TruncateButton;
#use dvizh\cart\widgets\BuyButton;
#use dvizh\order\widgets\OrderForm;
use dvizh\promocode\widgets\Enter;
#use dvizh\certificate\widgets\CertificateWidget;
#<=CertificateWidget::widget();>

/* @var $this yii\web\View */
$this->title = Yii::t('app/frontend','Krepšelis');

$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'url' => '',
];

$this->params['withSignup']   = 0;
$this->params['withBenefits'] = 0;

?>
        <div class="breadcrumbs">
            <?= Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'],
                'itemTemplate' => "<li>{link}</li>\n",
                'activeItemTemplate' => "{link}\n",
                'tag' => 'div',
                'options' => [
                    'class' => 'breadcrumbs'
                ]
            ]) ?>
        </div>
        <h1>Krepšelis</h1>
        <div class="ss_cart">
            <div class="shopping_cart_steps" id="step0">
                <?= ElementsList::widget(['type' => ElementsList::TYPE_FULL, 'elementView' => '//widgets/tomedaCardListView', 'showTotal' => true]); ?>
                <?= Enter::widget(['view'=>'//widgets/tomedaPromocodeWidget', 'ok_button' => 'Pritaikyti', 'del_button' => 'Panaikinti']); ?>
            </div>
        </div>
