<?php
use yii\helpers\Url;
?>
<div class="dvizh-change-count" id="dvizh-change-count">
    <a href="#" class="dvizh-arr dvizh-downArr">&nbsp;</a>
    <input type="hidden" value="<?= $model->count ?>" id="cartelement-count"  name='CartElement[count]' class='dvizh-cart-element-count item-quantity' data-role="cart-element-count" data-id="<?= $model->getId()?>" data-href="/cart/element/update" data-line-selector="li">
        <?= $model->count ?>
    </input>
    <a href="#" class='dvizh-arr dvizh-upArr'>&nbsp;</a>
</div>
