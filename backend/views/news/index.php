<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/backend','Новости');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app/backend','Добавить новость'), ['create'], ['class' => 'btn btn-success']) ?>
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
                    ['draft' => Yii::t('app/backend','Черновик'),'published' => Yii::t('app/backend','Опубликовано'), 'deleted' => Yii::t('app/backend','Удалено')],
                    ['class' => 'form-control', 'prompt' => Yii::t('app/backend','Статус')]
                ),
                'format' => 'raw',
                'value' => function($model){
                    $translate = ['draft' => Yii::t('app/backend','Черновик'),'published' => Yii::t('app/backend','Опубликовано'), 'deleted' => Yii::t('app/backend','Удалено')];
                    return $translate[$model->status];
                }
            ],

             //'status',

            //['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
