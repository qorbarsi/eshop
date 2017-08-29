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
                '/'          => $params['eshopPrefix'].'/index',
                'index'      => $params['eshopPrefix'].'/index',
                'site/index' => $params['eshopPrefix'].'/index',

                $params['eshopPrefix']          => $params['eshopPrefix'].'/index',
                $params['eshopPrefix'].'/index' => $params['eshopPrefix'].'/index',

                'cart'                         => $params['eshopPrefix'].'/cart',
                $params['eshopPrefix'].'/cart' => $params['eshopPrefix'].'/cart',

                $params['eshopPrefix'].'/search' => $params['eshopPrefix'].'/search',

                [
                    'pattern'  => $params['eshopPrefix'].'/<category:[\w\-]+>/<id:\d*>',
                    'route'    => $params['eshopPrefix'].'/product',
                ],
                [
                    'pattern'  => $params['eshopPrefix'].'/<category:[\w\-]+>/<slug:[0-9a-zA-Z\-]+>',
                    'route'    => $params['eshopPrefix'].'/products',
                ],
                [
                    'pattern'  => $params['eshopPrefix'].'/<id:\d*>',
                    'route'    => $params['eshopPrefix'].'/category',
                    'defaults' => ['id' => null],
                ],
                [
                    'pattern'  => $params['eshopPrefix'].'/<slug:[0-9a-zA-Z\-]+>',
                    'route'    => $params['eshopPrefix'].'/categories',
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
            'class'   => 'yii\web\DbSession',
            /*'name' => 'FRONTENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/',
            ],*/
            'timeout' => 60*60*24*14,
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
