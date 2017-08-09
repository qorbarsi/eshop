<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Slider */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/backend','Слайдеры'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="col-md-6">
        <?= Html::a(Yii::t('app/backend','Обновить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/backend','Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app/backend','Вы уверены, что хотите удалить этот элемент?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <div class="col-md-6">
    <?php
    $Gallery = \common\models\Slider::findOne($model->id);
    echo "<img src='".$Gallery -> getImage()->getURL("500x")."'/>";
    ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'url:url',
            'short_test',
            'sort',
        ],
    ]) ?>

</div>
