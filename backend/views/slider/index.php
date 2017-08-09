<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel common\models\search\SliderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app/backend','Слайдер');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="slider-index">

    <p>
        <?= Html::a(Yii::t('app/backend','Добавить слайдер'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'name',

            ['label' => Yii::t('app/backend','Изображение'), 'content' => function($model){
                return "<img src='".$model -> getImage()->getURL("100x")."'/>";
            } ],

            'url:url',
            'short_text',
            'sort',

            ['class' => 'yii\grid\ActionColumn', 'template' => '{update} {delete}'],
        ],
    ]);
    ?>
</div>
