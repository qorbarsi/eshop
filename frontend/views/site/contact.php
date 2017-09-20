<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;

$this->title = 'Kontaktinė informacija';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <div class="point">
        <h1><?= Html::encode($this->title) ?></h1>
        <?= $this->render('../layouts/edvinas') ?>

        <p><b>Kita informacija:</b></p>
        <p>Individualios veiklos Nr: 708092<br/>Edvinas Artimovičius<br/>Adresas: Panevėžio 15-29, Klaipėda</p>
    </div>
</div>
