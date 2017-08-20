<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => Yii::t('app/backend','Заказы ') . \dvizh\order\widgets\CountByStatusInformer::widget([
                                'renderEmpty' => true,
                                'iTagCssClass' => '',
                                'aTag' => false
                            ]) ,
                        //'icon' => 'fa fa-suitcase',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'url' => ['/order/order/index']
                    ],
                    [
                        'label' => Yii::t('app/backend','Operator workplace'),
                        //'icon' => 'fa fa-suitcase',
                        //'visible' => Yii::$app->user->can('superadmin'),
                        'url' => ['/order/operator/index']
                    ],
                    ['label' => Yii::t('app/backend','Магазин'), 'options' => ['class' => 'header']],
                    [
                        'label' => Yii::t('app/backend','Магазин'),
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('app/backend','Товары'), 'url' => ['/shop/product']],
                            ['label' => Yii::t('app/backend','Категории'), 'url' => ['/shop/category']],
                            ['label' => Yii::t('app/backend','Производители'), 'url' => ['/shop/producer']],
                            ['label' => Yii::t('app/backend','Фильтры'), 'url' => ['/filter/filter']],
                        ],
                    ],
                    [
                        'label' => Yii::t('app/backend','Маркетинг'),
                        'icon' => 'area-chart',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('app/backend','Промокоды'), 'url' => ['/promocode/promo-code/index']],
                            //['label' => Yii::t('app/backend','Сертификаты'), 'url' => ['/certificate/certificate/index']],
                        ],
                    ],
                    [
                        'label' => Yii::t('app/backend','Сайт'),
                        'icon' => 'sitemap',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('app/backend','Пользователи'), 'url' => ['/user/admin/index']],
                            ['label' => Yii::t('app/backend','Слайдер'), 'url' => ['/slider/index']],
                            ['label' => Yii::t('app/backend','Новости'), 'url' => ['/news/index']],
                            ['label' => Yii::t('app/backend','Страницы'), 'url' => ['/page/index']],
                        ],
                    ],
                    [
                        'label' => Yii::t('app/backend','Настройки'),
                        'icon' => 'cogs',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('app/backend','Поля контента'), 'url' => ['/field/field/index']],
                            ['label' => Yii::t('app/backend','Поля заказа'), 'url' => ['/order/field/index']],
                            ['label' => Yii::t('app/backend','Типы цен'), 'url' => ['/shop/price-type']],
                            ['label' => Yii::t('app/backend','Типы доставки'), 'url' => ['/order/shipping-type/index']],
                            ['label' => Yii::t('app/backend','Типы оплаты'), 'url' => ['/order/payment-type/index']],
                            ['label' => Yii::t('app/backend','Настройки сайта'), 'url' => ['/settings/default/index']],
                        ]
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
