<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
//use yii\bootstrap\Nav;
//use yii\bootstrap\NavBar;
//use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use common\widgets\Alert;
use yii\widgets\Menu;

use dvizh\shop\models\Category;
use dvizh\cart\widgets\ElementsList;
use dvizh\cart\widgets\CartInformer;

AppAsset::register($this);

$this->params['sfilter'] = isset($this->params['sfilter']) ? $this->params['sfilter'] : '';
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
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-76419403-14', 'auto');
        ga('send', 'pageview');
    </script>
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
                        <a href='/'>
                            <img src="/css/img/tomeda-logo-black.png" alt="<?= Yii::$app->params['storeName'] ?> logo">
                        </a>
                    </div>
                    <p class="descript">Elektronikos prekės</p>
                </div>
                <div class="fl-ri">
                    <div class="phone"><div><span class="tbg"></span></div>8 6333 8702</div>
                    <div class="search-box">
                        <form id="cartsearchbox" method="get" action="<?= Url::toRoute(['/'.\Yii::$app->params['eshopPrefix'].'/search']); ?>">
                            <input type="text" name="sfilter" placeholder="Paieška" value="<?= $this->params['sfilter'] ?>"/>
                            <a id="cartsearchboxsubmit" href="javascript:;"><span class="tbg"></span></a>
                        </form>
                        <script>
                            var form = document.getElementById("cartsearchbox");
                            document.getElementById("cartsearchboxsubmit").addEventListener("click", function () {
                                form.submit();
                            });
                        </script>
                    </div>
                </div>
                <div id="shopping-cart" class="<?= ( yii::$app->cart->getCount() > 0 ) ? 'incart' : '' ?>">
                    <div class="cart-icon fl-le">
                        <div class="tbg"></div>
                        <?php
                            $class = ( yii::$app->cart->getCount() > 0 ) ? '' : 'empty';
                            echo CartInformer::widget(['htmlTag' => 'span', 'cssClass'=> $class, 'text' => '{c}']);
                        ?>
                    </div>
                    <div class="cart-text fl-le">
                        <div class="cart-header">Prekių krepšelis</div>
                        <div class="cart-links"><a href="<?= Url::toRoute(['/'.\Yii::$app->params['eshopPrefix'].'/cart']); ?>" class="">Peržiūreti</a> – <a href="<?= Url::toRoute(['/'.\Yii::$app->params['eshopPrefix'].'/cart']); ?>" class="">Užsakyti</a></div>
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
                            'url' => ['/site/index'],
                            'options' => ['class'=>'catalog'],
                            'items' => $catalog
                        ],

                        ['label' => Yii::t('app/frontend','Pristatymas ir apmokėjimas'), 'url' => ['/site/delivery']],
                        ['label' => Yii::t('app/frontend','Grąžinimas'), 'url' => ['/site/return']],
                        //['label' => Yii::t('app/frontend','Garantijos'), 'url' => ['/site/warranty']],
                        //['label' => Yii::t('app/frontend','Atsiliepimai'), 'url' => ['/site/review']],
                        //['label' => Yii::t('app/frontend','Straipsniai'), 'url' => ['/site/article']],

                        //['label' => Yii::t('app/frontend','Apie mus'), 'url' => ['/site/about']],
                        ['label' => Yii::t('app/frontend','Kontaktai'), 'url' => ['/site/contact']],
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
        <div id="mobile-menu">
            <div class="content">
                <?php
                $catalog = processRecord(Category::buildTree());

                echo Menu::widget([
                    'items' => [
                        [
                            'label' => Yii::t('app/frontend','Katalogas'),
                            'url' => 'javascript:;',
                            'options' => ['class'=>'catalog'],
                            'items' => $catalog
                        ],
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
            <?php if(Yii::$app->session->hasFlash('orderError')) { ?>
                <?php
                $errors = unserialize(Yii::$app->session->getFlash('orderError'));
                foreach ($errors as $err){
                    Yii::$app->session->setFlash('error', $err[0]);
                }
                ?>
            <?php } ?>
            <?= Alert::widget([
                'alertTypes' => [
                    'error'   => 'alert-danger',
                    'danger'  => 'alert-danger',
                    'success' => 'alert-success',
                    'info'    => 'alert-info',
                    'warning' => 'alert-warning',
                    //'orderError' => 'alert-danger',
                ],
            ]) ?>
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
                    <p>Skambinkite: <?= Yii::$app->params['infoPhone'] ?></p>
                    <p>Rašykite: <a href="mailto:<?= Yii::$app->params['infoEmail'] ?>"><?= Yii::$app->params['infoEmail'] ?></a></p>
                    <p>Adresas: Panevėžio 15-29, Klaipėda</p>
                    <br>
                    <p>Edvinas Artimovičius</p>
                    <p>Individualios veiklos Nr: 708092</p>
                </div>
                <div class="point">
                    <p class="point-head">Informacija</p>
                    <p><?=Html::a(Yii::t('app/frontend','Pristatymas ir apmokėjimas'), ['site/delivery']);?></p>
                    <p><?=Html::a(Yii::t('app/frontend','Garantijos'), ['site/warranty']);?></p>
                    <p><?=Html::a(Yii::t('app/frontend','Atsiliepimai'), ['site/review']);?></p>
                    <p><?=Html::a(Yii::t('app/frontend','Straipsniai'), ['site/article']);?></p>
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
                <img src="/css/img/tomeda-logo-black.png" alt="<?= Yii::$app->params['storeName'] ?>">
            </div>
            <a class="mobile-fixed-cart <?= ( yii::$app->cart->getCount() > 0 ) ? 'incart' : '' ?>" href="<?= Url::toRoute(['/'.\Yii::$app->params['eshopPrefix'].'/cart']); ?>">
               <span class="tbg"></span>
               <?php
                   $class = ( yii::$app->cart->getCount() > 0 ) ? '' : 'empty';
                   echo CartInformer::widget(['htmlTag' => 'span', 'cssClass'=> $class, 'text' => '{c}']);
               ?>
           </a>
        </div>
    </div>

<?php $this->endBody() ?>
        <link href="https://fonts.googleapis.com/css?family=Cairo:400,600,700&amp;subset=latin-ext" rel="stylesheet">
        <script type="text/javascript">
            function isNumeric(n) { return !isNaN(parseFloat(n)) && isFinite(n); }
			$('.tabs ul li a').click(function () {
				var tab_name = $(this).attr('id');
				var tab = $(this).add('.'+tab_name);
				$('.tabs a, .tab-selected').removeClass('selected');
				tab.addClass('selected');
			});
            $('.additional-images a').click(function () {
                var src = $(this).children("img:first").attr('src');
                $('.main-image img').attr('src', src.replace('88x88','500x500'));
            });
            $('#mobile-menu li.catalog > a').click(function () {
            	$('#mobile-menu .catalog-level1').toggle();
            });
            $(document).on('renderCart', function (event, json) {
                if (json.count > 0) {
                    $('.dvizh-cart-informer').removeClass('empty');
                    $('#shopping-cart').addClass('incart');
                    $('.mobile-fixed-cart').addClass('incart');
                } else {
                    $('.dvizh-cart-informer').addClass('empty');
                    $('#shopping-cart').removeClass('incart');
                    $('.mobile-fixed-cart').removeClass('incart');
                }
            });
            $(document).on('promocodeClear', function (event, json) {
                discount = 0;
                discount_type = 0;
                promocode = null;
                simpleCart.update();
            });
            $(document).on('promocodeEnter', function (event, json) {
                //console.log(json);
                promocode = json.code;
                if (json.type == 'quantum') {
                    discount_type = 2;
                } else {
                    discount_type = 1;
                }
                if (isNumeric(json.discount)) {
                    discount = json.discount;
                    simpleCart.update();
                }
            });
            $(document).ready(function () {
            	if (parseInt($('.dvizh-cart-count').text()) > 0) {
            		$('#shopping-cart').addClass('incart');
                    $('.mobile-fixed-cart').addClass('incart');
            	}
            	$('.button.to-cart').click(function () {
					addedProduct();
                });
            });
            function addedProduct() {
                $('#product-page .added_message').css('display','block');
                $('#product-page .added_content').slideToggle(300);
                $('.added_close, .added_continue').click(function () {
                    $('#product-page .added_message, #product-page .added_content').css('display','none');
                });
            }
		</script>
    </body>
</html>
<?php $this->endPage() ?>
