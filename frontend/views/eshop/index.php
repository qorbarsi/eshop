<?php
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use yii\widgets\Menu;

use dvizh\shop\models\Category;
use dvizh\shop\widgets\ShowPrice;

#use dvizh\filter\widgets\FilterPanel;
#use dvizh\field\widgets\Show;
#use dvizh\cart\widgets\ElementsList;
#use dvizh\cart\widgets\CartInformer;
#use dvizh\cart\widgets\ChangeOptions;
#use dvizh\cart\widgets\ChangeCount;
#use dvizh\cart\widgets\TruncateButton;
#use dvizh\cart\widgets\BuyButton;
#use dvizh\order\widgets\OrderForm;
#use dvizh\promocode\widgets\Enter;
#use dvizh\certificate\widgets\CertificateWidget;


/* @var $this yii\web\View */
$this->title = !empty($this->title) ? $this->title : Yii::t('app/frontend','Recommended products');
$this->params['breadcrumbs']  = isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [];
$this->params['withSignup']   = isset($this->params['withSignup']) ? $this->params['withSignup'] : 1;
$this->params['withBenefits'] = isset($this->params['withBenefits']) ? $this->params['withBenefits'] : 1;

$this->params['sfilter'] = isset($filter) ? $filter : '';
?>
    <div id="category">
        <div class="fl-le category-menu">
            <div class="left-categories">
                <p class="h3"><?= Yii::t('app/frontend','Kategorijos') ?></p>
                <?php

                function processRecordIndex($arr,$index=1) {
                    $return = [];
                    $ind = $index+1;
                    foreach($arr as $level1) {
                        $return[] = [
                            'label' => $level1['name'],
                            'url'   => ['/'.\Yii::$app->params['eshopPrefix'].'/'.(empty($level1['slug']) ? $level1['id'] : $level1['slug'])],
                            'items' => ( isset($level1['childs']) && !empty($level1['childs'])) ? processRecordIndex($level1['childs'],$ind) : [],
                        ];
                    }
                    return $return;
                }

                $catalog = processRecordIndex(Category::buildTree());

                echo Menu::widget([
                    'items' => $catalog,
                    'labelTemplate' =>'{label} Label',
                    'linkTemplate' => '<a href="{url}"><span>{label}</span></a>',
                    'activeCssClass' => 'activeclass',
                    'options' => [
                        'class' => 'mar0 pad0',
                    ],
                    'submenuTemplate' => "\n<ul class='mar0 pad0'>\n{items}\n</ul>\n",
                ]);
                ?>
            </div>
        </div>
        <div class="fl-le category-products">
            <div class="category-body">
                <div class="category-header">
                    <?= Breadcrumbs::widget([
                        'links' => $this->params['breadcrumbs'],
                        'itemTemplate' => "<li>{link}</li>\n",
                        'activeItemTemplate' => "{link}\n",
                        'tag' => 'div',
                        'options' => [
                            'class' => 'breadcrumbs'
                        ]
                    ]) ?>
                    <h1><?= $this->title ?></h1>
                </div>
                <div class="category-product-list">
                    <?php foreach($products as $product) { ?>
                        <a href="<?= Url::toRoute(['/'.\Yii::$app->params['eshopPrefix'].'/'.
                                        (empty($product->category->slug) ? $product->category->id : $product->category->slug) ]).'/'.
                                        (empty($product->slug) ? $product->id : $product->slug )?> ">
                            <div class="cat-pr">
                                <div class="cat-pr-img">
                                    <img src="<?=$product->getImage()->getUrl('200x200');?>" alt="<?=$product->name;?>">
                                </div>
                                <div class="cat-pr-title"><?=$product->name;?></div>
                                <?= ShowPrice::widget([
                                    'model'    => $product,
                                    'htmlTag'  => 'div',
                                    'cssClass' => 'cat-pr-price',
                                    'cssClassOldNew' => 'discount',
                                    'templateOldNew' => '{price} <span>{oldPrice}</span>',
                                    'currency' => '&euro;',
                                ]);?>
                                <div class="cat-pr-cta"><?= Yii::t('app/frontend','Plačiau') ?> &raquo;</div>
                                <!-- Show::widget(['model' => $product]);>
                                <ChangeOptions::widget(['model' => $product]);>
                                <ChangeCount::widget(['model' => $product]);>
                                <BuyButton::widget(['model' => $product]);-->
                            </div>
                        </a>
                    <?php } ?>

                    <div class="clear"></div>
                </div>
            </div>
        </div>

        <div class="clear"></div>
    </div>
