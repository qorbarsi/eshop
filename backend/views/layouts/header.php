<?php
use yii\helpers\Url;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"><?= Yii::t('app/backend','Toggle navigation') ?></span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">
                <li>
                    <a href="/" class="dropdown-toggle">
                        <?= Yii::t('app/backend','На главную сайта') ?>
                    </a>
                </li>
                <?php if (Yii::$app->user->can('superadmin'))  {?>
                    <li>
                        <?= \dvizh\order\widgets\CountByStatusInformer::widget([
                            'url' => ['/order/order/index'],
                            'renderEmpty' => true,
                            ]) ?>
                    </li>
                <?php } ?>

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="glyphicon glyphicon-user"></i>
                        <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu" style="width: auto;">
                    <?php if (Yii::$app->user->can('userAdmin'))  {?>
                        <li class="user-footer">
                            <?= Html::a(Yii::t('app/backend','Профиль'),
                            ['/user/admin/update', 'id'=>Yii::$app->user->id]
                            ) ?>
                        </li>
                    <?php } else {?>
                        <li class="user-footer">
                            <?= Html::a(Yii::t('app/backend','Профиль'),'/user/settings') ?>
                        </li>
                    <?php } ?>
                        <li class="user-footer">
                            <?= Html::a(Yii::t('app/backend','Выйти'),
                            ['/user/security/logout'],
                            ['data-method' => 'post', 'class' => '']
                            ) ?>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
