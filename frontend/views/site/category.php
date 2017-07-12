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

$breadcrumbs = getBreadcrumbs($category);
$this->params['breadcrumbs'] = $breadcrumbs;
$this->title = $category->name;
?>

<?php $this->beginContent('@frontend/views/site/index.php' , ['products' => $products]) ?>


<?php $this->endContent() ?>
