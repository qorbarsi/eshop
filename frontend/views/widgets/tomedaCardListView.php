<?php
use yii\helpers\Html;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\DeleteButton;
use dvizh\cart\widgets\ElementPrice;
use dvizh\cart\widgets\ElementCost;

use common\widgets\Alert;
?>

<?php if ($model->count > 0) { ?>

<li class="dvizh-cart-row">
    <?= Alert::widget([
        'alertTypes' => [
            'checkAmountError' => 'alert-danger',
        ],
    ]) ?>
<div class="row itemRow " id="cartItem_<?= $model->id ?>" data-id="<?= $model->id ?>">
    <div class="item-thumb" id="item-productimg">
        <img src="<?=$model->getModel()->getImage()->getUrl('88x88');?>" alt="<?= $model->name?>">
    </div>
    <div class="item-name">
        <?= Html::encode($name) ?>
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
    <div class="item-productimg"><?=$model->getModel()->getImage()->getUrl('88x88');?></div>
    <div class="item-category"></div>
</div>
</li>
<?php } ?>
