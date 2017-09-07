<?php
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; <?= Yii::$app->charset ?>" />
		<!--[if !mso]><!-->
		<meta http-equiv="X-UA-Compatible" content="IE=edge" />
		<!--<![endif]-->
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?= Html::encode($this->title) ?></title>
        <?php $this->head() ?>
	</head>
	<body>
		<div style="max-width: 580px;">
            <?php $this->beginBody() ?>
            <?= $content ?>
            <?php $this->endBody() ?>
		</div>
	</body>
</html>
<?php $this->endPage() ?>
