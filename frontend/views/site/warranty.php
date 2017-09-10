<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = Yii::t('app/frontend','Garantijos');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-warranty">
    <h1><?= Html::encode($this->title) ?></h1>
    <ol>
        <li><b>Prekių grąžinimo garantija</b>
            <p>Jūs turite teisę grąžinti užsakytas prekes per 30 dienų.</p>
            <p>Grąžinamą prekę galėsite pakeisti į bet kurią kitą arba atgauti sumokėtus pinigus:
                <ul>
                    <li>Jeigu keičiama prekė yra pigesnė, Jums reikės sumokėti skirtumą.</li>
                    <li>Jeigu keičiama prekė yra brangesnė, mes grąžinsime Jums skirtumą.</li>
                </ul>
            </p>
            <p>Svarbu:
                <ul>
                    <li>Pagrindinė grąžinimo sąlyga – elektronikos prekė neturi būti panaudota bei prarasti prekinės išvaizdos.</li>
                    <li>Draugai, prekių keitimas ir grąžinimas vyksta be jokių ilgų procedūrų.</li>
                    <li>Nesugadintas ir nenaudotas prekes (originalioje nesugadintoje pakuotėje) priimsime atgal arba pakeisime į kitas prekes pateikus užsakymą patvirtinančią informaciją.</li>
                </ul>
            </p>
        </p>Jeigu norite grąžinti prekę, tiesiog parašykite mums el. paštu <a href="mailto:<?= Yii::$app->params['infoEmail'] ?>"><?= Yii::$app->params['infoEmail'] ?></a> arba skambinkite mūsų vadybininkui tel. <?= Yii::$app->params['infoPhone'] ?>.</p>
        </li>
        <li><b>Visoms prekėms suteikiame net iki 3 metų garantiją</b>
            <p>Visoms elektronikos prekėms, kuriomis prekiaujama e-parduotuvėje tomeda.lt, suteikiama jų gamintojo garantija. Garantinis laikotarpis yra nustatytas gamintojo ir priklauso nuo elektronikos prekės tipo (~ nuo 1 iki 3 metų).</p>
            <p>Jeigu turėsite kokių nors problemų dėl mūsų e-parduotuvėje įsigytos elektronikos prekės kokybės, galite drąsiai kreiptis tiesiogiai į mus. Mes būtinai padėsime Jums išspręsti visus klausimus, susijusius su garantiniu aptarnavimu.</p>
        </li>
    </ol>
    <?= $this->render('../layouts/edvinas') ?>
</div>
