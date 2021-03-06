<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'lt',
    'controllerNamespace' => 'backend\controllers',
    'modules' => [
        'user' => [
            'as backend' => 'dektrium\user\filters\BackendFilter',
            //'admins' => ['ilja'],
            'adminPermission' => 'userAdmin',
            'enableUnconfirmedLogin' => false,
        ],
        'rbac' => 'dektrium\rbac\RbacWebModule',
    ],
    'homeUrl' => '/backend/web',
    'components' => [
        'fileStorage' => [
            'class' => '\trntv\filekit\Storage',
            'baseUrl' => '/frontend/web/images/source',
            'filesystem'=> function() {
                $adapter = new \League\Flysystem\Adapter\Local(dirname(dirname(__DIR__)).'/frontend/web/images/source');
                return new League\Flysystem\Filesystem($adapter);
            },
        ],
        'urlManager' => [
           'enablePrettyUrl' => true,
           'showScriptName' => false,
        ],
        'request' => [
            'baseUrl' => '/backend/web',
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'identityClass' => 'dektrium\user\models\User',
            'identityCookie' => [
                'name'     => '_backendIdentity',
                'path'     => '/backend/web',
                'httpOnly' => true,
            ],
            'loginUrl' => ['/user/security/login'],
        ],
        'session' => [
            'class'   => 'yii\web\DbSession',
            /*'name' => 'BACKENDSESSID',
            'cookieParams' => [
                'httpOnly' => true,
                'path'     => '/backend/web',
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
