<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "slider".
 *
 * @property int $id
 * @property string $url
 * @property string $short_test
 * @property int $sort
 */
class Slider extends \yii\db\ActiveRecord
{
    function behaviors()
    {
        return [
            'images' => [
                'class' => 'dvizh\gallery\behaviors\AttachImages',
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'slider';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sort'], 'integer'],
            [['url', 'short_text', 'name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id'         => Yii::t('app/backend','ID'),
            'name'       => Yii::t('app/backend','Название'),
            'url'        => Yii::t('app/backend','Ссылка'),
            'short_text' => Yii::t('app/backend','Краткое описание'),
            'sort'       => Yii::t('app/backend','Порядок'),
        ];
    }
}
