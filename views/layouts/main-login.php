<?php
use backend\assets\AppAsset;
use yii\helpers\Html;

/* @var $this \yii\web\View */
/* @var $content string */

dmstr\web\AdminLteAsset::register($this);
$imgUrl = Yii::getAlias("@web")."/images/cf-costruzioni-0004.jpg";
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= $this->registerLinkTag(['rel' => 'icon', 'type' => 'image/png', 'href' => Yii::getAlias("@web").'/favicon.png']) ?>
    <?= Html::csrfMetaTags() ?>
    <style>
        body {
            height: 100%;
            background-image: url("<?= $imgUrl ?>");
            height: 100%;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
        }
    </style>

    <title><?= Html::encode($this->title) ?></title>
    
    <?php $this->head() ?>
</head>
<body class="">

<?php $this->beginBody() ?>
    
    <?= $content ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
