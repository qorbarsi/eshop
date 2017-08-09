<?php

namespace common\models;

use Yii;

class Page extends \yii\db\ActiveRecord
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
        return 'page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'name', 'text'], 'required'],
            [['text','show_page', 'template'], 'string'],
            [['slug', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'        => Yii::t('app/backend','ID'),
            'show_page' => Yii::t('app/backend','Показывать в главном меню'),
            'slug'      => Yii::t('app/backend','SEO-заголовок'),
            'name'      => Yii::t('app/backend','Заголовок'),
            'text'      => Yii::t('app/backend','Текст'),
        ];
    }
}
