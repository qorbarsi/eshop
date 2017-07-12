<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */
$this->title = Yii::t('backend','Аккаунт');
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // echo $form->field($model, 'username') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php echo $form->field($model, 'password')->passwordInput()->label(Yii::t('backend', 'Новый пароль')) ?>

    <?php echo $form->field($model, 'password_confirm')->passwordInput()->label(Yii::t('backend','Новый пароль еще раз')) ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend','Редактировать'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
