<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\search\PageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/backend','Страницы');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-index">

    <p>
        <?= Html::a(Yii::t('app/backend','Создать страницу'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'name',
            //'slug',
            [
                'attribute' => 'show',
                'format' => 'raw',
                'value' => function($model){
                    $translate =['1' =>  Yii::t('app/backend','Да'),'0' =>  Yii::t('app/backend','Нет')];
                    return $translate[$model ->top_menu];
                }
            ],
            'sort',
            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]); ?>
</div>
