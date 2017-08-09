<?php

namespace common\models;

use Yii;

class News extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'slug' => [
                'class' => 'Zelenin\yii\behaviors\Slug',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'anons', 'text'], 'required'],
            [['text', 'status'], 'string'],
            [['date'], 'safe'],
            [['name', 'slug'], 'string', 'max' => 55],
            [['anons'], 'string', 'max' => 300],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'     => Yii::t('app/backend','ID'),
            'name'   => Yii::t('app/backend','Заголовок'),
            'anons'  => Yii::t('app/backend','Анонс'),
            'text'   => Yii::t('app/backend','Текст'),
            'slug'   => Yii::t('app/backend','Seo-заголовок'),
            'date'   => Yii::t('app/backend','Дата'),
            'status' => Yii::t('app/backend','Статус'),
        ];
    }
}
