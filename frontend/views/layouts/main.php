<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Menu;

use dvizh\shop\models\Category;
use dvizh\cart\widgets\ElementsList;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
    <div id="fb-root"></div>
    <script>
        (function(d, s, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s); js.id = id;
            js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.10&appId=764901620321616";
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="over-header">
        <div id="header">
            <div class="content">
                <div class="fl-le">
                    <div class="logo-container">
                        <img src="/css/img/tomeda-logo-black.png" alt="Tomeda logo">
                    </div>
                    <p class="descript">Elektronikos prekės</p>
                </div>
                <div class="fl-ri">
                    <div class="phone"><div><span class="tbg"></span></div>8 6333 8702</div>
                    <div class="search-box">
                        <input type="text" placeholder="Paieška" />
                        <a href="javascript:;"><span class="tbg"></span></a>
                    </div>
                </div>
                <div id="shopping-cart">
                    <div class="cart-icon fl-le">
                        <div class="tbg"></div>
                        <span class="empty">0</span>
                    </div>
                    <div class="cart-text fl-le">
                        <div class="cart-header">Prekių krepšelis</div>
                        <div class="cart-links"><a href="javascript:;">Peržiūreti</a> – <a href="javascript:;">Užsakyti</a></div>
                        <?=ElementsList::widget(['type' => ElementsList::TYPE_DROPDOWN]);?>
                    </div>
                </div>
                <div class="clear"></div>
            </div>
        </div>
        <div id="menu">
            <div class="content">
                <?php
                function processRecord($arr,$index=1) {
                    $return = [];
                    $ind = $index+1;
                    foreach($arr as $level1) {
                        $return[] = [
                            'label' => $level1['name'],
                            'url'   => [\Yii::$app->params['eshopPrefix'].'/'.(empty($level1['slug']) ? $level1['id'] : $level1['slug'])],
                            'items' => ( isset($level1['childs']) && !empty($level1['childs'])) ? processRecord($level1['childs'],$ind) : [],
                            'submenuTemplate' => "\n<ul class='catalog-level".($ind > 2 ? 2 : $ind )."' role='menu'>\n{items}\n</ul>\n",
                            'options' => [
                                'class' => ( isset($level1['childs']) && !empty($level1['childs'])) ? 'has-children' : ''
                            ],
                        ];
                    }
                    return $return;
                }

                $catalog = processRecord(Category::buildTree());

                echo Menu::widget([
                    'items' => [
                        [
                            'label' => Yii::t('app/frontend','Katalogas'),
                            'url' => ['site/index'],
                            'options' => ['class'=>'catalog'],
                            'items' => $catalog
                        ],

                        ['label' => Yii::t('app/frontend','Pristatymas ir apmokėjimas'), 'url' => 'javascript:;'],
                        ['label' => Yii::t('app/frontend','Garantijos'), 'url' => 'javascript:;'],
                        ['label' => Yii::t('app/frontend','Atsiliepimai'), 'url' => 'javascript:;'],
                        ['label' => Yii::t('app/frontend','Straipsniai'), 'url' => 'javascript:;'],

                        ['label' => Yii::t('app/frontend','Apie mus'), 'url' => ['site/about']],
                        ['label' => Yii::t('app/frontend','Kontaktai'), 'url' => ['site/contact']],
                    ],
                    'labelTemplate' =>'{label} Label',
                    'linkTemplate' => '<a href="{url}"><span>{label}</span></a>',
                    'activeCssClass' => 'activeclass',
                    'options' => [
                        'class' => 'mar0 pad0',
                    ],
                    'submenuTemplate' => "\n<ul class='catalog-level1' role='menu'>\n{items}\n</ul>\n",
                ]);
                ?>

            </div>
        </div>
    </div>

    <div class="content">
        <div id="main-content" class="pad-top pad-bot">
            <?php
                // echo Breadcrumbs::widget(['links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [], ]) ;
            ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>

    <?php
        if (!empty($this->params['withBenefits'])) {
            echo $this->render('benefits');
        }
        if (!empty($this->params['withSignup'])) {
            echo $this->render('signup');
        }
    ?>

    <div id="footer" class="pad-top pad-bot">
        <div class="content">
            <div class="points">
                <div class="point">
                    <p class="point-head">Kontaktinė informacija</p>
                    <p>Skambinkite: +370 6333 8702</p>
                    <p>Rašykite: <a href="mailto:info@tomeda.lt">info@tomeda.lt</a></p>
                    <p>Adresas: Gedimino pr. 33, Vilnius</p>
                    <br>
                    <p>UAB "Tomeda"</p>
                    <p>Įmonės kodas: 303123987</p>
                </div>
                <div class="point">
                    <p class="point-head">Informacija</p>
                    <p><a href="javascript:;">Pristatymas ir apmokėjimas</a></p>
                    <p><a href="javascript:;">Garantijos</a></p>
                    <p><a href="javascript:;">Atsiliepimai</a></p>
                    <p><a href="javascript:;">Straipsniai</a></p>
                    <p><?=Html::a(Yii::t('app/frontend','Apie mus'), ['site/about']);?></p>
                    <p><?=Html::a(Yii::t('app/frontend','Kontaktai'), ['site/contact']);?></p>
                </div>
                <div class="point">
                    <p class="point-head">Prisijunkite prie mūsų</p>
                    <div class="social-icon facebook"><span class="tbg"></span></div>
                    <div class="social-icon email"><span class="tbg"></span></div>
                </div>
                <div class="clear"></div>
            </div>
            <div class="footer-logo">
                <img src="/css/img/tomeda-logo-black.png" alt="Tomeda">
            </div>
        </div>
    </div>

<?php $this->endBody() ?>
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;subset=latin-ext" rel="stylesheet">
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript">
			$('.tabs ul li a').click(function () {
				var tab_name = $(this).attr('id');
				var tab = $(this).add('.'+tab_name);
				$('.tabs a, .tab-selected').removeClass('selected');
				tab.addClass('selected');
			});
            $('.additional-images a').click(function () {
                var src = $(this).children("img:first").attr('src');
                $('.main-image img').attr('src', src);
            });
		</script>
    </body>
</html>
<?php $this->endPage() ?>
