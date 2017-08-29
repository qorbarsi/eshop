<?php
use yii\helpers\Url;
use yii\helpers\Html;
?>

<form action="<?= $url ?>" method="POST" id="payment_paysera_form">
    <input type="hidden" name="<?= Yii::$app->request->csrfParam; ?>" value="<?= Yii::$app->request->csrfToken; ?>" />
    <?php if(!$autoSend) { ?>
        <input type="submit" value="<?=Yii::t('paysera','Оплатить');?>  <?= $txt_amount ?> " />
    <?php } ?>
</form>

<?php if($autoSend) { ?><script>document.getElementById('payment_paysera_form').submit();</script><?php } ?>
