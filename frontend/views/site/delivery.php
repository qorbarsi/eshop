<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app/frontend','Pristatymas ir apmokėjimas');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-delivery">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol>
        <li><b>Pristatymas kurjeriu iki Jūsų namų (arba darbo) durų</b>
            <ul>
                <li>Skubus pristatymas visoje Lietuvoje per 1-2 darbo dienas į bet kurį miestą (miestelį, kaimą)</li>
                <li>Pristatymo kaina – 3.00€</li>
                <li>Galimi atsiskaitymo būdai:
                    <ul>
                        <li>Mokėjimo kortele kurjeriui pristatymo metu</li>
                        <li>Grynais pinigais kurjeriui pristatymo metu (taikomas papildomas mokestis +1.00€)</li>
                        <li>Internetu prisijungiant prie internetinės bankininkystės</li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><b>Pristatymas registruotu paštu</b>
            <ul>
                <li>Prekės pristatomos per 2-3 darbo dienas užsakymo metu nurodytu adresu</li>
                <li>Pristatymo kaina – 3.50€</li>
                <li>Galimi atsiskaitymo būdai:
                    <ul>
                        <li>Internetu prisijungiant prie internetinės bankininkystės</li>
                    </ul>
                </li>
            </ul>
        </li>
        <li><b>Nemokamas pristatymas į LP EXPRESS terminalus visoje Lietuvoje</b>
            <ul>
                <li>Prekės pristatomos per 1-2 darbo dienas į pasirinktą LP EXPRESS terminalą</li>
                <li>Pristatymo kaina – 0.00€ (nemokamai)</li>
                <li>Galimi atsiskaitymo būdai:
                    <ul>
                        <li>Mokėjimas kortele atsiiminant prekes LP EXPRESS terminale</li>
                        <li>Internetu prisijungiant prie internetinės bankininkystės</li>
                    </ul>
                </li>
            </ul>
        </li>
    </ol>
    <?= $this->render('../layouts/edvinas') ?>
</div>
