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

/* @var $this yii\web\View */

$this->title = Yii::t('eshop','Main page title');
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= Yii::t('eshop','Title') ?></h1>
        <p class="lead"><?= Yii::t('eshop','Какой-то текст') ?></p>
    </div>

    <div class="body-content">
        <h2><?= Yii::t('eshop','Category list') ?></h2>
        <ul class="nav nav-pills">
            <?php foreach($categories as $cat) { ?>
                <li <?php if (isset($category->id) && ($cat->id == $category->id)) echo 'class="active"';?>>
                    <a href="<?=Url::toRoute([\Yii::$app->params['eshopPrefix'].'/'.(empty($cat->slug) ? $cat->id : $cat->slug) ]) ?>"><?=$cat->name?></a>
                </li>
            <?php } ?>
        </ul>

    </div>
</div>
