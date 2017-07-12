<aside class="main-sidebar">

    <section class="sidebar">

        <?= dmstr\widgets\Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu'],
                'encodeLabels' => false,
                'items' => [
                    [
                        'label' => Yii::t('backend','Заказы ') . \dvizh\order\widgets\CountByStatusInformer::widget([
                                'renderEmpty' => true,
                                'iTagCssClass' => '',
                                'aTag' => false
                            ]) ,
                        //'icon' => 'fa fa-suitcase',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'url' => ['/order/order/index']
                    ],
                    ['label' => Yii::t('backend','Магазин'), 'options' => ['class' => 'header']],
                    [
                        'label' => Yii::t('backend','Магазин'),
                        'icon' => 'shopping-bag',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('backend','Товары'), 'url' => ['/shop/product']],
                            ['label' => Yii::t('backend','Категории'), 'url' => ['/shop/category']],
                            ['label' => Yii::t('backend','Производители'), 'url' => ['/shop/producer']],
                            ['label' => Yii::t('backend','Фильтры'), 'url' => ['/filter/filter']],
                        ],
                    ],
                    [
                        'label' => Yii::t('backend','Маркетинг'),
                        'icon' => 'area-chart',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('backend','Промокоды'), 'url' => ['/promocode/promo-code/index']],
                            ['label' => Yii::t('backend','Сертификаты'), 'url' => ['/certificate/certificate/index']],
                        ],
                    ],
                    [
                        'label' => Yii::t('backend','Сайт'),
                        'icon' => 'sitemap',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('backend','Пользователи'), 'url' => ['/user/admin/index']],
                            ['label' => Yii::t('backend','Слайдер'), 'url' => ['/slider/index']],
                            ['label' => Yii::t('backend','Новости'), 'url' => ['/news/index']],
                            ['label' => Yii::t('backend','Страницы'), 'url' => ['/page/index']],
                        ],
                    ],
                    [
                        'label' => Yii::t('backend','Настройки'),
                        'icon' => 'cogs',
                        'url' => '#',
                        'visible' => Yii::$app->user->can('superadmin'),
                        'items' => [
                            ['label' => Yii::t('backend','Поля контента'), 'url' => ['/field/field/index']],
                            ['label' => Yii::t('backend','Поля заказа'), 'url' => ['/order/field/index']],
                            ['label' => Yii::t('backend','Типы цен'), 'url' => ['/shop/price-type']],
                            ['label' => Yii::t('backend','Типы доставки'), 'url' => ['/order/shipping-type/index']],
                            ['label' => Yii::t('backend','Типы оплаты'), 'url' => ['/order/payment-type/index']],
                            ['label' => Yii::t('backend','Настройки сайта'), 'url' => ['/settings/default/index']],
                        ]
                    ],

                ],
            ]
        ) ?>

    </section>

</aside>
