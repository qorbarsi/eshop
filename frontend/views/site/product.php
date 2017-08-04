<?php
use yii\widgets\Breadcrumbs;
use yii\helpers\Url;

#use dvizh\shop\models\Category;
use dvizh\shop\widgets\ShowPrice;
#use dvizh\filter\widgets\FilterPanel;
#use dvizh\field\widgets\Show;
#use dvizh\cart\widgets\ElementsList;
#use dvizh\cart\widgets\CartInformer;
#use dvizh\cart\widgets\ChangeOptions;
#use dvizh\cart\widgets\ChangeCount;
#use dvizh\cart\widgets\TruncateButton;
use dvizh\cart\widgets\BuyButton;
use dvizh\order\widgets\OrderForm;
#use dvizh\promocode\widgets\Enter;
#use dvizh\certificate\widgets\CertificateWidget;

/* @var $this yii\web\View */

function getBreadcrumbs ($cat) {
    $return = [];
    if ( isset($cat->parent) && !empty($cat->parent) ) {
        $return = getBreadcrumbs($cat->parent);
    }
    if ( isset($cat) && !empty($cat) ) {
        $return[] = [
            'label' => $cat->name,
            'url'   => [ \Yii::$app->params['eshopPrefix'].'/'.( empty($cat->slug) ? $cat->id : $cat->slug )]
        ];
    }
    return $return;
}

$this->title = $product->name;
$breadcrumbs = getBreadcrumbs($product->category);
$this->params['breadcrumbs'] = $breadcrumbs;
$this->params['breadcrumbs'][] = [
    'label' => $this->title,
    'url' =>
    [   \Yii::$app->params['eshopPrefix'].'/'.
        (empty($product->category->slug) ? $product->category->id : $product->category->slug) .'/'.
        ( empty($product->slug) ? $product->id : $product->slug )
    ]
];
$this->params['withSignup'] = 1;
$this->params['withBenefits'] = 0;
?>
<div id="product-page">
    <?= Breadcrumbs::widget([
        'links' => $this->params['breadcrumbs'],
        'itemTemplate' => "<li>{link}</li>\n",
        'activeItemTemplate' => "{link}\n",
        'tag' => 'div',
        'options' => [
            'class' => 'breadcrumbs'
        ]
    ]) ?>
    <div class="product-container simpleCart_shelfItem">
        <div class="product-title">
            <h1 class="item_name"><?= $this->title?></h1>
        </div>
        <div class="product-images">
            <div class="main-image">
                <img src="<?=$product->getImage()->getUrl('500x500');?>" alt="<?= $this->title?>">
            </div>
            <div class="additional-images">
            <?php
                $images = $product->getImages();
                $i = 0;
                $len = count($images);
                foreach ($images as $img) {
                    $class = (($i%5) == 4) ? 'last' : '';
                    $url = $img->getUrl('88x88');
                    $alt = $img->alt;
                    $alt = (empty($alt)) ? $this->title : $alt;
                    echo "<a href='javascript:;' class='".$class."'><img src='".$url."' alt='".$alt."'></a>";
                    $i++;
                }
            ?>
            </div>
        </div>
        <div class="short-info">
            <div class="product-details">
                <p class="product-code">Prekės kodas: <?= $product->code ?></p>
                <?= ShowPrice::widget([
                    'model'    => $product,
                    'htmlTag'  => 'p',
                    'cssClass' => 'product-price',
                    'cssClassOldNew' => '',
                    'templateOldNew' => '{price} <span>{oldPrice}</span>',
                    'currency' => '&euro;',
                ]);?>
                <div class="add-block">
                    <?= BuyButton::widget(['model' => $product, 'cssClass' => 'button to-cart', 'htmlTag' => 'a', 'text' => '<span></span>Pirkti']); ?>
                    <!-- Show::widget(['model' => $product]);>
                    <ChangeOptions::widget(['model' => $product]);>
                    <ChangeCount::widget(['model' => $product]);>
                    -->
                </div>
            </div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <div class="long-description">
            <div class="tab-container">
                <div class="tabs">
                    <ul>
                        <li><a href="javascript:;" id="point-description" class="selected">Aprašymas</a></li>
                        <li><a href="javascript:;" id="point-payment-delivery">Pristatymas ir apmokėjimas</a></li>
                        <li><a href="javascript:;" id="point-warranty">Garantijos</a></li>
                        <li><a href="javascript:;" id="point-return">Prekių grąžinimas</a></li>
                        <div class="clear"></div>
                    </ul>
                    <div class="clear"></div>
                </div>
                <div class="tab-info">
                    <div class="tab-content">
                        <div class="tab-selected point-description selected">
                            <p class="tab-header">Aprašymas</p>
                            <?= $product->text ?>
                            <br>
                            <p class="tab-header">Kodėl verta rinktis e-parduotuvę „Tomeda.lt“?</p>
                            <div class="short-benefits">
                                <div class="point ic1">
                                    <div class="icon"><div class="tbg"></div></div>
                                    <div class="text">Visoms prekėms suteikiame net iki 3 metų garantiją</div>
                                </div>
                                <div class="point ic2">
                                    <div class="icon"><div class="tbg"></div></div>
                                    <div class="text">Nemokamas pristatymas visoje Lietuvoje</div>
                                </div>
                                <div class="point ic3">
                                    <div class="icon"><div class="tbg"></div></div>
                                    <div class="text">Konsultantų praktiški patarimai ir rekomendacijos</div>
                                </div>
                                <div class="point ic4">
                                    <div class="icon"><div class="tbg"></div></div>
                                    <div class="text">Greitas pristatymas per 1-2 darbo dienas</div>
                                </div>
                                <div class="point ic5">
                                    <div class="icon"><div class="tbg"></div></div>
                                    <div class="text">Atsiskaitymas grynaisiais arba internetu</div>
                                </div>
                                <!-- <div class="point ic6">
                                    <div class="icon"><div class="tbg"></div></div>
                                    <div class="text">Konkurencingos kainos ir specialūs pasiūlymai</div>
                                </div>
                                <div class="point ic7">
                                    <div class="icon"><div class="tbg"></div></div>
                                    <div class="text">Išsamūs prekių aprašymai, vaizdo apžvalgos</div>
                                </div> -->
                                <div class="point ic8">
                                    <div class="icon"><div class="tbg"></div></div>
                                    <div class="text">Paprasta prekių grąžinimo/keitimo procedūra</div>
                                </div>
                                <!-- <div class="point ic9">
                                    <div class="icon"><div class="tbg"></div></div>
                                    <div class="text">Padengiame grąžinimo siuntimo išlaidas</div>
                                </div> -->
                                <div class="clear"></div>
                            </div>
                        </div>

                        <div class="tab-selected point-payment-delivery">
                            <p class="tab-header">Pristatymas ir apmokėjimas</p>
                        </div>

                        <div class="tab-selected point-warranty">
                            <p class="tab-header">Garantijos</p>
                        </div>

                        <div class="tab-selected point-return">
                            <p class="tab-header">Prekių grąžinimas</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="related-products">
                <p class="rel-header">Rekomenduojami produktai</p>
                <ul>
                    <?php
                        //echo print_r($product->relations,true);
                        $related = $product->getRelations();
                        if (isset($related) && !empty($related)) {
                            foreach ($related->all() as $rel) {
                                echo '<li>';
                                echo '<a href="'.Url::toRoute(
                                    [
                                        \Yii::$app->params['eshopPrefix'].'/'.
                                        (empty($rel->category->slug) ? $rel->category->id : $rel->category->slug) .'/'.
                                        ( empty($rel->slug) ? $rel->id : $rel->slug )
                                    ]
                                ).'">';
                                echo '<div class="related-img">';
                                echo '<img src="'.$rel->getImage()->getUrl('200x200').'" alt="'.$rel->name.'">';
                                echo '</div>';
                                echo ShowPrice::widget([
                                    'model'    => $rel,
                                    'htmlTag'  => 'p',
                                    'cssClass' => 'related-price',
                                    'cssClassOldNew' => '',
                                    'templateOldNew' => '{price} <span>{oldPrice}</span>',
                                    'currency' => '&euro;',
                                ]);
                                echo '<p class="related-name">'.$rel->name.'</p>';
                                echo '</a></li>';
                            }
                        }
                    ?>
                </ul>
            </div>
            <div class="clear"></div>
        </div>
    </div>
</div>
