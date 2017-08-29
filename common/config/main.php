<?php

return [
    'name' => Yii::t('app/common','Tomeda'),
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'lt',
    'bootstrap' => [
        'dektrium\user\Bootstrap',
        'dektrium\rbac\Bootstrap',
        'qorbarsi\paysera\Bootstrap',
    ],

    'extensions' => yii\helpers\ArrayHelper::merge(
        require( dirname(dirname(__DIR__)) . '/vendor/yiisoft/extensions.php'),
        [
            'dektrium/yii2-rbac' => [
              'name' => 'dektrium/yii2-rbac',
              'version' => '1.0.0.0-alpha',
              'alias' => [
                '@dektrium/rbac' => '@dektrium/rbac',
              ],
            ],
        ]
    ),
    'components' => [
        'view' => [
            'theme' => [
                'pathMap' => [
                    '@dektrium/user/views' => '@backend/views/user'
                ],
            ],
        ],
        'assetManager' => [
            'forceCopy' => false,
        ],
        'i18n' => [
            'translations' => [
                'app*' => [
                    'class' => 'yii\i18n\PhpMessageSource',
                    'basePath' => '@common/messages', //
                    'forceTranslation' => true,
                    'sourceLanguage' => 'ru',
                    'fileMap' => [
                        'app/frontend' => 'app/frontend.php',
                        'app/backend'  => 'app/backend.php',
                        'app/common'  => 'app/common.php',
                    ],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'dektrium\rbac\components\DbManager',
            'itemTable' => '{{%rbac_auth_item}}',
            'itemChildTable' => '{{%rbac_auth_item_child}}',
            'assignmentTable' => '{{%rbac_auth_assignment}}',
            'ruleTable' => '{{%rbac_auth_rule}}'
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            // 'clients' => [
            //     'google' => [
            //         'class' => 'yii\authclient\clients\Google',
            //         'clientId' => 'google_client_id',
            //         'clientSecret' => 'google_client_secret',
            //     ],
            //     'facebook' => [
            //         'class' => 'yii\authclient\clients\Facebook',
            //         'clientId' => 'facebook_client_id',
            //         'clientSecret' => 'facebook_client_secret',
            //     ],
            // ],
        ],
        'cart' => [
            'class' => 'dvizh\cart\Cart',
            'currency' => '€', //Валюта
            'currencyPosition' => 'after', //after или before (позиция значка валюты относительно цены)
            'priceFormat' => [2,'.', ''], //Форма цены
            'as set_discount' => ['class' => '\common\aspects\SetDiscount'],
            //'as set_element_discount' => ['class' => 'dvizh\promocode\behaviors\DiscountToElement'],
            //'as set_certificate_discount' => '\common\aspects\SetCertificateDiscount'
        ],
        'client' => [
            'class' => 'dvizh\client\Client',
        ],
    ],
    'modules' => [
        'user' => [
            'class' => 'dektrium\user\Module',
            //'admins' => ['ilja'],
            'adminPermission' => 'userAdmin',
            'mailer' => [
                'viewPath' => '@common/mail'
            ],
        ],
        'gallery' => [
            'class' => 'dvizh\gallery\Module',
            'imagesStorePath' => dirname(dirname(__DIR__)).'/frontend/web/images/store', //path to origin images
            'imagesCachePath' => dirname(dirname(__DIR__)).'/frontend/web/images/cache', //path to resized copies
            'graphicsLibrary' => 'GD',
            'placeHolderPath' => '@webroot/images/placeHolder.png',
        ],
        'order' => [
            'class' => 'dvizh\order\Module',
            'successUrl' => '/site/thanks', //Страница, куда попадает пользователь после успешного заказа
            //'as use_certificate' => '\common\aspects\UseCertificate',
            'as do_discount' => '\common\aspects\SetDiscount',
            'as order_filling' => '\common\aspects\OrderFilling',
            'as promocode_use' => '\dvizh\promocode\behaviors\PromoCodeUse',
            'countryCode' => 'LT',
            'currency' => '€',
            //
            'createOrderUrl' => true,
            //'adminNotificationEmail' => 'info@tomeda.lt', //Мыло для отправки заказов
            'adminNotificationEmail' => 'qorbarsi@gmail.com', //Мыло для отправки заказов
            'robotEmail' => 'info@tomeda.lt',
            'robotName' => 'Tomeda',
            //'adminNotificationEmail' => false,
            'clientEmailNotification' => false,
            'elementToOrderUrl' => false,
            'showPaymentColumn' => true,
            'showCountColumn' => true,
            'mailViewPath' => '@common/mail',
            //
            'orderStatuses' => [
                'new' => 'Naujas',
                'approve' => 'Patvirtintas',
                'cancel' => 'Atšauktas',
                'process' => 'Apdorojimas',
                'done' => 'Užbaigtas'
            ],
        ],
        'cart' => [
            'class' => 'dvizh\cart\Module',
        ],
        'promocode' => [
            'class' => 'dvizh\promocode\Module',
            'informer' => 'dvizh\cart\widgets\CartInformer', // namespace to custom cartInformer widget
            'informerSettings' => ['text' => '{c}'], //settings for custom cartInformer widget
            'currency' => '€', //Валюта
            //'clientsModel' => 'dvizh\client\Client',
            //'clientsModel' => 'dvizh\yii2-clients\models\Client',
            //Указываем модели, к которым будем привязывать промокод
            /*
            'targetModelList' => [
                'Категории' => [
                    'model' => 'dvizh\shop\models\Category',
                    'searchModel' => 'dvizh\shop\models\category\CategorySearch'
                ],
                'Продукты' => [
                    'model' => 'dvizh\shop\models\Product',
                    'searchModel' => 'dvizh\shop\models\product\ProductSearch'
                ],
            ],
            */
        ],
        /*
        'certificate' => [
            'class' => '\dvizh\certificate\Module',
            'targetModelList' => [
                'Категории' => [
                    'model' => 'dvizh\shop\models\Category',
                    'searchModel' => 'dvizh\shop\models\category\CategorySearch'
                ],
                'Продукты' => [
                    'model' => 'dvizh\shop\models\Product',
                    'searchModel' => 'dvizh\shop\models\product\ProductSearch'
                ],
            ]
        ],
        */
        'shop' => [
            'class' => 'dvizh\shop\Module',
            'adminRoles' => ['superadmin'],
        ],
        'filter' => [
            'class' => 'dvizh\filter\Module',
            'adminRoles' => ['superadmin'],
            'relationFieldName' => 'category_id',
            'relationFieldValues' =>
                function() {
                    return \dvizh\shop\models\Category::buildTextTree();
                },
        ],
        'field' => [
            'class' => 'dvizh\field\Module',
            'relationModels' => [
                'dvizh\shop\models\Product' => Yii::t('app/common','Продукты'),
                'dvizh\shop\models\Category' => Yii::t('app/common','Категории'),
                'dvizh\shop\models\Producer' => Yii::t('app/common','Производители'),
            ],
            'adminRoles' => ['superadmin'],
        ],
        'relations' => [
            'class' => 'dvizh\relations\Module',
            'fields' => ['code'],
        ],
        'client' => [
            'class' => 'dvizh\client\Module',
            'adminRoles' => ['superadmin'],
        ],
        'review' => [
            'class' => 'dvizh\review\Module',
        ],
        'settings' => [
            'class' => 'pheme\settings\Module',
            'sourceLanguage' => 'lt'
        ],
        'paysera' => [
            'class'     => 'qorbarsi\paysera\Module',
            'projectId' => '103677',
            'signPassword' => '3966033980c35a002bf1b8f79baeb7a8',
            'test' => 1,
        ]
    ],
];
