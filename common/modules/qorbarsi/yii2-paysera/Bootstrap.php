<?php
namespace qorbarsi\paysera;

use yii\base\BootstrapInterface;
use yii;

class Bootstrap implements BootstrapInterface
{
    public function bootstrap($app)
    {
        if ($app->hasModule('paysera') && ($module = $app->getModule('paysera')) instanceof Module) {
            //$module->test = $this->ensureCorrectDebugSetting();
            if (!isset($app->i18n->translations['paysera']) && !isset($app->i18n->translations['paysera*'])) {
                $app->i18n->translations['paysera'] = [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => __DIR__.'/messages',
                    'forceTranslation' => true
                ];
            }
        }
    }

    /** Ensure the module is not in DEBUG mode on production environments */
    public function ensureCorrectDebugSetting()
    {
        if (!defined('YII_DEBUG')) {
            return 0;
        }
        if (!defined('YII_ENV')) {
            return 0;
        }
        if (defined('YII_ENV') && YII_ENV !== 'dev') {
            return 0;
        }
        if (defined('YII_DEBUG') && YII_DEBUG !== true) {
            return 0;
        }

        return Yii::$app->getModule('paysera')->debug;
    }
}
