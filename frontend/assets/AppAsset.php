<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/tomeda.css',
        'css/tomeda.add.css',
    ];
    public $js = [
    ];
    public $depends = [
    ];

    /*
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset',
    */

}
