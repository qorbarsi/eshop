<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Kontaktinė informacija';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="point">
        <h1>Kontaktinė informacija</h1>
        <p>Skambinkite: +370 6094 1008</p>
        <p>Rašykite: <a href="mailto:<?= Yii::$app->params['infoEmail'] ?>"><?= Yii::$app->params['infoEmail'] ?></a></p>
        <p>Adresas: Panevėžio 15-29, Klaipėda</p>
        <p>Edvinas Artimovičius</p>
        <p>Individualios veiklos Nr: 708092</p>
    </div>
</div>
