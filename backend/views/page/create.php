<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Page */

$this->title = Yii::t('app/backend','Создать страницу');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/backend','Страницы'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
