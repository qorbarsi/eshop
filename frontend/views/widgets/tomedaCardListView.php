<?php
use yii\helpers\Html;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\DeleteButton;
use dvizh\cart\widgets\ElementPrice;
use dvizh\cart\widgets\ElementCost;
?>

<li class="dvizh-cart-row ">
<div class="row itemRow row-0 odd" id="cartItem_SCI-1">
    <div class="item-thumb">
        <img src="<?=$model->getModel()->getImage()->getUrl('88x88');?>" alt="<?= $model->name?>">
    </div>
    <div class="item-name">
        <?= $name ?>
    </div>
    <div class="item-price"><?= ElementPrice::widget(['model' => $model]); ?></div>
    <?= ChangeCount::widget([
        'model' => $model,
        'showArrows' => $showCountArrows,
        'actionUpdateUrl' => $controllerActions['update'],
        'customView' => '//widgets/tomedaChangeCount',
    ]); ?>
    <div class="item-total"><?= ElementCost::widget(['model' => $model]); ?></div>
    <div class="item-remove">
        <?= DeleteButton::widget([
            'model' => $model,
            'deleteElementUrl' => $controllerActions['delete'],
            'text' => 'Pašalinti',
            'cssClass' => 'simpleCart_remove']);
        ?>
    </div>
    <div class="item-productshopid"></div>
    <div class="item-productimg"></div>
    <div class="item-category"></div>
</div>
</li>
