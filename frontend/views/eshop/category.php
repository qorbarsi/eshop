<?php

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
$this->params['withSignup'] = 0;
$this->params['withBenefits'] = 0;
?>

<?php $this->beginContent('@frontend/views/eshop/index.php' , ['products' => $products]) ?>


<?php $this->endContent() ?>
