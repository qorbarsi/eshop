<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app/frontend','Apie mus');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>
    <p><b>„Tomeda.lt“</b></p>
    <p>Internetinė elektronikos prekių parduotuvė.</p>
    <p><b>Kaip mes dirbame?</b></p>
    <ul>
        <li>Priimame užsakymus mūsų internetinėje parduotuvėje bei tel. <?= Yii::$app->params['infoPhone'] ?>.</li>
        <li>Pristatatome prekes visoje Lietuvoje į bet kurį miestą (miestelį, kaimą).</li>
    </ul>
    <b>Prekių kategorijos mūsų parduotuvėje:</b>
    <ul>
        <li>Garso kolonėlės</li>
        <li>Garso sistemos</li>
        <li>Nešiojamos kolonėlės</li>
        <li>Laisvų rankų įranga</li>
        <li>Vaizdo registratoriai</li>
        <li>Išorinės baterijos (Power Banks)</li>
        <li>Telefonų laikikliai</li>
        <li>Planšečių laikikliai</li>
        <li>Atmintukai (USB raktai)</li>
        <li>Atminties kortelės</li>
    </ul>
    <p><b>Prekių gamintojai:</b></p>
    <ul>
        <li>Blow</li>
        <li>Jabra</li>
        <li>Forever</li>
        <li>Platronics</li>
        <li>JBL</li>
        <li>Phillips</li>
    </ul>
    <?= $this->render('../layouts/edvinas') ?>
</div>
