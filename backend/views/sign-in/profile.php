<?php

use common\models\user\UserProfile;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\UserProfile */
/* @var $form yii\bootstrap\ActiveForm */

$this->title = Yii::t('backend','Редактирование профиля');
?>

<div class="user-profile-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'firstname')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'middlename')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'lastname')->textInput(['maxlength' => 255]) ?>

    <?php echo $form->field($model, 'gender')->dropDownlist([
        UserProfile::GENDER_FEMALE => Yii::t('backend','Женщина'),
        UserProfile::GENDER_MALE => Yii::t('backend','Мужчина'),
    ]) ?>

    <div class="form-group">
        <?php echo Html::submitButton(Yii::t('backend','Редактировать'), ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
