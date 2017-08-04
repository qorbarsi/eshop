<?php
use yii\helpers\Url;
?>
<div class="dvizh-change-count">
    <a href="#" class="dvizh-arr dvizh-downArr simpleCart_decrement item-decrement">&nbsp;</a>
    <input type="number" value="<?= $model->count ?>" id="cartelement-count"  name='CartElement[count]' class='dvizh-cart-element-count item-quantity' data-role="cart-element-count" data-id="<?= $model->getId()?>" data-href="/cart/element/update" data-line-selector="li">
    <a href="#" class='dvizh-arr dvizh-upArr simpleCart_increment item-increment'>&nbsp;</a>
</div>
