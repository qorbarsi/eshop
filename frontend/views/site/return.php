<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Prekių grąžinimas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>
    <p>Jūs turite teisę grąžinti užsakytas prekes per 14 dienų.</p>
    <p>Prekes galėsite pakeisti į bet kurį kitą arba atgauti sumokėtus pinigus. Jeigu keičiama prekė yra pigesnė, jums reikės sumokėti skirtumą, jei brangesnė - tada mes grąžinsime jums skirtumą.</p>
    <p>Jeigu norite grąžinti tiesiog parašykite mums el. paštu <a href="mailto:<?= Yii::$app->params['infoEmail'] ?>"><?= Yii::$app->params['infoEmail'] ?></a>, bei nurodykite užsakymo numerį ir prekės kodą, kurią norite grąžinti arba pakeisti.</p>
</div>
