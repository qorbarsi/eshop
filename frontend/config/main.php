<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'lt',
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'user' => [
            'as frontend' => 'dektrium\user\filters\FrontendFilter',
        ],
    ],
    'homeUrl' => '/',
    'components' => [
        'assetManager' => [
            'bundles' => [
                'yii\bootstrap\BootstrapAsset' => [
                    'css' => [],
                ],
            ],
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                $params['eshopPrefix'] => 'site/index',
                $params['eshopPrefix'].'/cart' => 'site/cart',
                'cart' => 'site/cart',
                [
                    'pattern'  => $params['eshopPrefix'].'/<category:[\w\-]+>/<id:\d*>',
                    'route'    => 'site/product',
                ],
                [
                    'pattern'  => $params['eshopPrefix'].'/<category:[\w\-]+>/<slug:[0-9a-zA-Z\-]+>',
                    'route'    => 'site/products',
                ],
                [
                    'pattern'  => $params['eshopPrefix'].'/<id:\d*>',
                    'route'    => 'site/category',
                    'defaults' => ['id' => null],
                ],
                [
                    'pattern'  => $params['eshopPrefix'].'/<slug:[0-9a-zA-Z\-]+>',
                    'route'    => 'site/categories',
                    'defaults' => ['slug' => null],
                ],
            ],
        ],
        'request' => [
            'baseUrl' => '',
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'identityCookie' => [
                'name'     => '_frontendIdentity',
                'path'     => '/',
                'httpOnly' => true,
            ],
        ],
        'session' => [
            'name' => 'frontend-sess',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
    ],
    'params' => $params,
];
