<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend','Новости');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('backend','Добавить новость'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'name',
            'anons',
           // 'text:ntext',
          //  'slug',
             'date',
            [
                'attribute' =>'status',
                'filter' => Html::activeDropDownList(
                    $searchModel,
                    'status',
                    ['draft' => Yii::t('backend','Черновик'),'published' => Yii::t('backend','Опубликовано'), 'deleted' => Yii::t('backend','Удалено')],
                    ['class' => 'form-control', 'prompt' => Yii::t('backend','Статус')]
                ),
                'format' => 'raw',
                'value' => function($model){
                    $translate = ['draft' => Yii::t('backend','Черновик'),'published' => Yii::t('backend','Опубликовано'), 'deleted' => Yii::t('backend','Удалено')];
                    return $translate[$model->status];
                }
            ],

             //'status',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
