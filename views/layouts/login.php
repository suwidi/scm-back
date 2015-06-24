<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */
AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.css" rel="stylesheet">
    <!-- Custom Style -->
    <link href="css/stylelogin.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="fonts/css/font-awesome.min.css" rel="stylesheet">
    <?= Html::csrfMetaTags() ?>
    <?= Html::csrfMetaTags() ?>
<title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="navbar-fixed-top company-head">
                <div class="col-xs-4 col-xs-offset-4">
                <img src="img/company-head.png" alt="">
                </div>
            </div>
        </div>
    </div>    
    <?php $this->beginBody() ?>
<div class="container">
        <?= $content ?>
        </div>

<div class="container">
        <div class="row">
            <div class="company-foot navbar-fixed-bottom">
                <p class="text-center">&copy; <?= date('Y') ?> Cubiconia | e:info@cubiconia.com | ph.0811 611 5500</p>
            </div>
        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
