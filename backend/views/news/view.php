<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app/backend','Новости'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app/backend','Обновить'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('app/backend','Удалить'), ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('app/backend','Вы уверены, что хотите удалить этот элемент?'),
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'anons',
            'text:ntext',
            'slug',
            'date',
            [
                'attribute' =>'status',
                'format' => 'raw',
                'value' => function($model){
                    $translate =['draft' => Yii::t('app/backend','Черновик'),'published' => Yii::t('app/backend','Опубликовано'), 'deleted' => Yii::t('app/backend','Удалено')];
                    return $translate[$model ->status];
                }
            ],
        ],
    ]) ?>

</div>
