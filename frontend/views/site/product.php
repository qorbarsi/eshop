<?php
use yii\helpers\Url;
use dvizh\shop\models\Category;
use dvizh\shop\widgets\ShowPrice;
use dvizh\filter\widgets\FilterPanel;
use dvizh\field\widgets\Show;
use dvizh\cart\widgets\ElementsList;
use dvizh\cart\widgets\CartInformer;
use dvizh\cart\widgets\ChangeOptions;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\TruncateButton;
use dvizh\cart\widgets\BuyButton;
use dvizh\order\widgets\OrderForm;
use dvizh\promocode\widgets\Enter;
use dvizh\certificate\widgets\CertificateWidget;
use yii\widgets\DetailView;

/* @var $this yii\web\View */

$this->title = $product->name;
$this->params['breadcrumbs'][] = ['label' => $product->category->name, 'url' => [ \Yii::$app->params['eshopPrefix'].'/'.( empty($product->category->slug) ? $product->category->id : $product->category->slug )]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="body-content">
        <h2><?= $product->name ?></h2>
        <h2><a href="<?=Yii::$app->request->referrer ?>"><?= Yii::t('frontend','Back') ?></a></h2>
        <?= DetailView::widget([ 'model' => $product]) ?>
    </div>
</div>
