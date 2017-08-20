<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<div class="ssc_discount_block <?= $cssClass ?>">
    <?php $form = ActiveForm::begin([
        'action' => ['/promocode/promo-code-use/enter'],
        'options' => [
            'data-role' => 'promocode-enter-form',
            'class' => $cssClass,
        ]
    ]); ?>
        <?php if(yii::$app->promocode->has()) { ?>
            <p class="promo-code-discount">
                <?= Yii::t('promocode', 'Ваша скидка: '); ?>
                <?php
                    if (yii::$app->promocode->get()->promocode->type === 'cumulative' && empty(yii::$app->promocode->get()->promocode->getTransactions()->all())) {
                        echo '0%';
                    } else {
                        if (yii::$app->promocode->get()->promocode->type != 'quantum') {
                            echo yii::$app->promocode->get()->promocode->discount . '%';
                        } else {
                            echo yii::$app->cart->getFormatted(yii::$app->promocode->get()->promocode->discount);
                        }
                    }
                ?>
            </p>
        <?php } else { ?>
            <p class="promo-code-discount" style="display: none;"></p>
        <?php } ?>
        <div class="input-group">
            <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
            <?=Html::input('text', 'promocode', yii::$app->promocode->getCode(), ['class' => 'form-control', 'placeholder' => Yii::t('promocode','Введите промокод')]) ?>
            <span class="input-group-btn">
                <?= Html::submitButton($ok, ['class' => 'btn btn-success promo-code-enter-btn']) ?>
                <?= Html::submitButton($del, ['class' => 'btn btn-danger promo-code-clear-btn']) ?>
            </span>
        </div>
    <?php ActiveForm::end(); ?>
</div>
