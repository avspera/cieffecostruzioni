<?php
use yii\helpers\Html;
use yii\helpers\Url;
use app\models\Automezzo;


    $today      = date("Y-m-d H:i:s");
    $maxRange   = date('Y-m-d H:i:s', strtotime($today . ' +10 day'));
    
    $scadenzaAss = Automezzo::find()
                    ->select(["id", "marca", "modello", "targa", "data_scadenza_assicurazione"])
                    ->where([">", "data_scadenza_assicurazione", $today])
                    ->andWhere(["<=", "data_scadenza_assicurazione", $maxRange])
                    ->all();
    
    $scadenzaRevisione = Automezzo::find()
                        ->select(["id", "marca", "modello", "targa", "data_prossima_revisione"])
                        ->where([">", "data_prossima_revisione", $today])
                        ->andWhere(["<=", "data_prossima_revisione", $maxRange])
                        ->all();

    $count  = count($scadenzaAss)+count($scadenzaRevisione);

/* @var $this \yii\web\View */
/* @var $content string */
?>

<header class="main-header">

    <?= Html::a('<span class="logo-mini">APP</span><span class="logo-lg">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'logo']) ?>

    <nav class="navbar navbar-static-top" role="navigation">

        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">

            <ul class="nav navbar-nav">

                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown notifications-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <i class="fa fa-bell-o"></i>
                        <span class="label label-warning"><?= $count ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li class="header">Ci sono <?= $count ?> notifiche</li>
                        <li>
                            <!-- inner menu: contains the actual data -->
                            <ul class="menu">

                                <?php 
                                    if(!empty($scadenzaAss)){
                                        foreach($scadenzaAss as $automezzo){ ?>
                                    <li>
                                        <a href="<?= Url::to(["automezzo/view", "id" => $automezzo->id]) ?>">
                                            <i class="fa fa-warning text-yellow"></i> <?= $automezzo->marca." ".$automezzo->modello ?> 
                                            <strong><?= $automezzo->targa ?></strong> <br>
                                            <small>Assicurazione in scadenza</small>
                                            <small style="float:right;" class="bg-yellow"><?= $automezzo->formatDate($automezzo->data_scadenza_assicurazione) ?></small>
                                        </a> 
                                    </li>
                                        <?php } ?>
                                <?php } ?>

                                <?php 
                                    if(!empty($scadenzaRevisione)){
                                        foreach($scadenzaRevisione as $automezzo){ ?>
                                    <li>
                                        <a href="<?= Url::to(["automezzo/view", "id" => $automezzo->id]) ?>">
                                            <i class="fa fa-warning text-yellow"></i> <?= $automezzo->marca." ".$automezzo->modello ?> 
                                            <strong><?= $automezzo->targa ?></strong>
                                            <small>Revisione in scadenza</small>
                                            <small style="float:right;" class="bg-yellow"><?= $automezzo->formatDate($automezzo->data_prossima_revisione) ?></small>
                                        </a>
                                    </li>
                                        <?php } ?>
                                <?php } ?>
                            </ul>
                        </li>
                        <li class="footer"><a href="<?= Url::to(["automezzi/index"]) ?>">Vedi tutti</a></li>
                    </ul>
                </li>
              
                <!-- User Account: style can be found in dropdown.less -->

                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="user-image" alt="cieffecostruzioni"/> -->
                        <img src='<?= Yii::getAlias("@web")."/images/logo.jpeg"?> 'class="user-image" alt="cieffecostruzioni"/>
                        <span class="hidden-xs"><?= Yii::$app->user->identity->username ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- cieffecostruzioni -->
                        <li class="user-header">
                            <!-- <img src="<?= $directoryAsset ?>/img/user2-160x160.jpg" class="img-circle" alt="cieffecostruzioni"/> -->
                            <img src='<?= Yii::getAlias("@web")."/images/logo.jpeg"?> 'class="img-circle" alt="cieffecostruzioni"/>

                            <p>
                                <?= Yii::$app->user->identity->username ?>
                            </p>
                            <small style="color:white !important;">cieffecostruzioni gestione automezzi</small>
                        </li>
                        <!-- Menu Body -->
                        <!-- <li class="user-body">
                            <div class="col-xs-4 text-center">
                                <a href="#">Followers</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Sales</a>
                            </div>
                            <div class="col-xs-4 text-center">
                                <a href="#">Friends</a>
                            </div>
                        </li> -->
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <!-- <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div> -->
                            <div class="pull-right">
                                <?= Html::a(
                                    'Esci',
                                    ['/site/logout'],
                                    ['data-method' => 'post', 'class' => 'btn btn-default btn-flat']
                                ) ?>
                            </div>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </nav>
</header>
