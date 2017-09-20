<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;
use yii\widgets\DetailView;

use dvizh\order\models\ShippingType;

$this->title = 'Tomeda užsakymas';

$shippingCost = 0;

if ( $orderShippingType = $model->shipping_type_id ) {
    if($orderShippingType > 0) {
        $shippingType = ShippingType::findOne($orderShippingType);

        if(($shippingType && $shippingType->cost > 0) && ((int)$shippingType->free_cost_from <= 0 | $shippingType->free_cost_from > $model->cost)) {
            $shippingCost = $shippingType->cost;
        }
    }
}

?>
    <img src="http://tomeda.lt/css/img/email_logo.png" border="0" width="131" height="30">
    <h3 style="background-color: #eeeeee; color: #000; padding: 10px; text-transform:uppercase;">Užsakymas #<?=$model->id;?></h3>
	<div style="line-height: 1.5;">
        <p>
            Mielas kliente,<br />
            Mes gavome Jūsų užsakymą ir netrukus pradėsime jį ruošti.<br />
            Žemiau pateikiame Jūsų užsakymo informaciją:
        </p>
    </div>
    <?php if($model->elements) { ?>
        <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #aaa; border-left: 1px solid #aaa;">
            <tr>
                <td style="padding: 10px; border-right: 1px solid #aaa; border-bottom: 1px solid #aaa;"><b>Pavadinimas</b></td>
                <td style="padding: 10px; width: 60px; text-align: center; border-right: 1px solid #aaa; border-bottom: 1px solid #aaa;"><b>Kaina</b></td>
                <td style="padding: 10px; width: 40px; text-align: center; border-right: 1px solid #aaa; border-bottom: 1px solid #aaa;"><b>Kiekis</b></td>
                <td style="padding: 10px; width: 60px; text-align: center; border-right: 1px solid #aaa; border-bottom: 1px solid #aaa;"><b>Suma</b></td>
            </tr>
            <?php foreach($model->elements as $element) { ?>
                <tr>
                    <td style="padding: 10px; border-right: 1px solid #aaa; border-bottom: 1px solid #aaa;" valign="middle">
                        <?=$element->product->getCartName(); ?>
                        <?php if($element->description) { echo "({$element->description})"; } ?>
                        <?php
                        if($options = json_decode($element->options)) {
                            foreach($options as $name => $value) {
                                $return .= Html::tag('p', Html::encode($name).': '.Html::encode($value));
                            }
                        }
                        ?>
                        <?=' ['.$element->product->code.']' ?>
                    </td>
                    <td style="padding: 10px; border-right: 1px solid #aaa; border-bottom: 1px solid #aaa;" align="right" valign="middle">
                        <?=$model->getFormatted($element->price);?>
                    </td>
                    <td style="padding: 10px; border-right: 1px solid #aaa; border-bottom: 1px solid #aaa;" align="center" valign="middle">
                        <?=$element->count;?>
                    </td>
                    <td style="padding: 10px; border-right: 1px solid #aaa; border-bottom: 1px solid #aaa;" align="right" valign="middle">
                        <?=$model->getFormatted($element->price*$element->count);?>
                    </td>
                </tr>
            <?php } ?>
		    <tr>
                <td style="padding: 10px; border-bottom: 1px solid #aaa;" rowspan=3></td>
			    <td style="border: 0; padding: 10px 10px 0 10px;" colspan="2" align="right"><b>Pristatymas:</b></td>
                <td style="padding: 5px 10px 0 10px;border-right: 1px solid #aaa;" colspan="2" align="right"><?= $model->getFormatted($shippingCost); ?></td>
		    </tr>
            <tr>
                <td style="border: 0; padding: 5px 10px 0 10px;" colspan="2" align="right"><b>Produktai:</b></td>
                <td style="padding: 5px 10px 0 10px; border-right: 1px solid #aaa;" colspan="2" align="right"><?= $model->getTotalFormatted() ?></td>
		    </tr>
            <tr>
                <td style="padding: 5px 10px 0 10px; border-bottom: 1px solid #aaa;" colspan="2" align="right" valign="top"><b>Viso:</b></td>
                <td style="padding: 5px 10px 0 10px; border-right: 1px solid #aaa; border-bottom: 1px solid #aaa; height: 22px;" colspan="2" align="right" valign="top"><b><?= $model->getCostFormatted() ?></b></td>
            </tr>
        </table>
    <?php } ?>
    <br />
    <p style="line-height: 1.5;">
      <b>Užsakovo informacija:</b><br />
		Vardas:&nbsp;<b><?=$model->client_name;?></b><br />
		El. paštas:&nbsp;<b><?=Html::a($model->email, 'mailto:'.$model->email);?></b><br />
		Telefonas:&nbsp;<b><?=$model->phone;?></b><br /><br />
		<b>Pristatymo būdas:</b><br />
		<?= $model->address; ?><br /><br />
		<b>Mokėjimo būdas:</b><br />
		<?=$model->paymentType->name;?>
    </p>
    <br />
    <i><?=$model->comment;?></i>
    <br />
    <br />
    <div style="line-height: 1.5;">
        <p>Jeigu turėsite kokių nors klausimų, drąsiai mums skambinkite arba rašykite.</p>
        <p>
            Pagarbiai<br />
            Tomeda kolektyvas<br />
            <a href="mailto:<?= Yii::$app->params['infoEmail'] ?>"><?= Yii::$app->params['infoEmail'] ?></a><br />
            <a href="http://www.tomeda.lt/?utm_source=email&amp;utm_medium=transactional&amp;utm_campaign=order" target="_blank">www.tomeda.lt</a><br />
            <?= Yii::$app->params['infoPhone'] ?>
        </p>
	</div>
