<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app/frontend','Pristatymas ir apmokėjimas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-delivery">
    <h1>Pristatomos būdai</h1>
    <ol>
        <li>Pristatymas kurjeriu - kaina 3.30 Eur.<br/>
            Skubus pristatymas visoje Lietuvoje kitą darbo dieną.</li>
        <li>Pristatymas registruotu paštu - kaina 2 Eur.<br/>
            Prekės pristatomos per 2-3 darbo dienas.</li>
        <li>Pristatymas į LP EXPRESS terminalus - kaina 2 Eur.<br/>
            Prekės pristatomos per 1-2 darbo dienas.</li>
    </ol>

    <h1>Apmokejimo būdai</h1>
    <ol>
        <li>Atsiskaitymas per el. bankininkystę (PaySera).</li>
        <li>Atsiskaitymas grynais pinigais.</li>
        <li>Atsiskaitymas kortele prie LP EXPRESS terminalo.</li>
    </ol>
</div>
