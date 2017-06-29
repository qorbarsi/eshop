<?php
use yii\helpers\Url;
use dvizh\shop\models\Category;
use dvizh\shop\widgets\ShowPrice;
use dvizh\filter\widgets\FilterPanel;
use dvizh\field\widgets\Show;
use dvizh\cart\widgets\ElementsList;
use dvizh\cart\widgets\CartInformer;
use dvizh\cart\widgets\ChangeOptions;
use dvizh\cart\widgets\ChangeCount;
use dvizh\cart\widgets\TruncateButton;
use dvizh\cart\widgets\BuyButton;
use dvizh\order\widgets\OrderForm;
use dvizh\promocode\widgets\Enter;
use dvizh\certificate\widgets\CertificateWidget;

/* @var $this yii\web\View */

$this->title = $category->name;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= $category->name ?></h1>
        <h3><a href="<?=Url::toRoute(['/site/index']);?>"><?= Yii::t('eshop','All categories') ?></a></h3>
    </div>

    <div class="body-content">
        <div class="row">
            <div class="col-md-12">
                <fieldset>
                    <legend><?= Yii::t('eshop','Filters') ?></legend>
                    <div>
                        <?=FilterPanel::widget(['itemId' => isset($category->id) ? $category->id : null, 'findModel' => $queryForFilter, 'ajaxLoad' => true, 'resultHtmlSelector' => '#productsList']); ?>
                    </div>
                </fieldset>
            </div>
        </div>

        <h2>3. Положите в корзину товар</h2>
        <div class="row" id="productsList">
            <?php foreach($products as $product) { ?>
                <div class="col-md-6 product-block">
                    <figure>
                        <img src="<?=$product->getImage()->getUrl('200x200');?>" alt="<?=$product->name;?>" />
                    </figure>
                    <h3><?=$product->name;?></h3>

                    <fieldset>
                        <legend><?= Yii::t('eshop','Show') ?></legend>
                        <div>
                            <?=Show::widget(['model' => $product]);?>
                            <h3>
                                <a href="
                                <?=
                                Url::toRoute([\Yii::$app->params['eshopPrefix'].'/'.
                                (empty($product->category->slug) ? $product->category->id : $product->category->slug) ]).'/'.
                                (empty($product->slug) ? $product->id : $product->slug )
                                ?>
                            "><?= Yii::t('eshop','Product details') ?></a></h3>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><?= Yii::t('eshop','Price') ?></legend>
                        <div>
                            <?=ShowPrice::widget(['model' => $product]);?> р.
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><?= Yii::t('eshop','Options') ?></legend>
                        <div>
                            <?=ChangeOptions::widget(['model' => $product]);?>
                        </div>
                    </fieldset>

                    <fieldset>
                        <legend><?= Yii::t('eshop','Count') ?></legend>
                        <div>
                            <?=ChangeCount::widget(['model' => $product]);?> <?=BuyButton::widget(['model' => $product]);?>
                        </div>
                    </fieldset>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
