<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class CartAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
    ];
    public $js = [
        '/js/simpleCart.min.js',
        '/js/cart.js',
    ];
    public $depends = [
        'frontend\assets\AppAsset',
    ];

    /*
    'yii\web\YiiAsset',
    'yii\bootstrap\BootstrapAsset',
    */

}
