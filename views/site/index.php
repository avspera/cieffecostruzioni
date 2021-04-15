<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Gestione cieffecostruzioni';
\yii\web\YiiAsset::register($this);

$this->registerJsFile(Yii::getAlias("@web").'/js/pieChart.js' );
?>
<div class="site-index">

<?php 
        $gridColumns = [
            [
                'class' => 'yii\grid\SerialColumn',
            ],
            [
                'attribute' => 'marca',
                'hAlign' => 'center', 
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'modello',
                'hAlign' => 'center', 
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'targa',
                'hAlign' => 'center', 
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'data_immatricolazione',
                'value' => function($model){
                    return $model->formatDate($model->data_immatricolazione);
                },
                'hAlign' => 'center', 
                'vAlign' => 'middle',
                'filterType' => GridView::FILTER_DATE,
                    'filterWidgetOptions' =>([
                        'language'=> "it",
                        'size' => "sm",
                        'layout' => '{picker}{input}{remove}',
                        'model' => $automezzoSearch,
                        'attribute' => 'data_immatricolazione',
                        'options' => ['placeholder' => 'Scegli'],
                        'pickerButton' => ['icon' => 'time'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ]
                    ]
                ),
            ],
            [
                'attribute' => 'data_ultimo_rinnovo_assicurazione',
                'value' => function($model){
                    return $model->formatDate($model->data_ultimo_rinnovo_assicurazione);
                },
                'filterType' => GridView::FILTER_DATE,
                    'filterWidgetOptions' =>([
                        'language'=> "it",
                        'size' => "sm",
                        'layout' => '{picker}{input}{remove}',
                        'model' => $automezzoSearch,
                        'attribute' => 'data_ultimo_rinnovo_assicurazione',
                        'options' => ['placeholder' => 'Scegli'],
                        'pickerButton' => ['icon' => 'time'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ]
                    ]
                ),
                'hAlign' => 'center', 
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'data_scadenza_assicurazione',
                'value' => function($model){
                    return $model->formatDate($model->data_scadenza_assicurazione);
                },
                'filterType' => GridView::FILTER_DATE,
                    'filterWidgetOptions' =>([
                        'language'=> "it",
                        'size' => "sm",
                        'layout' => '{picker}{input}{remove}',
                        'model' => $automezzoSearch,
                        'attribute' => 'data_scadenza_assicurazione',
                        'options' => ['placeholder' => 'Scegli'],
                        'pickerButton' => ['icon' => 'time'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ]
                    ]
                ),
                'hAlign' => 'center', 
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'data_ultima_revisione',
                'value' => function($model){
                    return $model->formatDate($model->data_ultima_revisione);
                },
                'filterType' => GridView::FILTER_DATE,
                    'filterWidgetOptions' =>([
                        'language'=> "it",
                        'size' => "sm",
                        'layout' => '{picker}{input}{remove}',
                        'model' => $automezzoSearch,
                        'attribute' => 'data_ultima_revisione',
                        'options' => ['placeholder' => 'Scegli'],
                        'pickerButton' => ['icon' => 'time'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ]
                    ]
                ),
                'hAlign' => 'center', 
                'vAlign' => 'middle',
            ],
            [
                'attribute' => 'data_prossima_revisione',
                'value' => function($model){
                    return $model->formatDate($model->data_prossima_revisione);
                },
                'filterType' => GridView::FILTER_DATE,
                    'filterWidgetOptions' =>([
                        'language'=> "it",
                        'size' => "sm",
                        'layout' => '{picker}{input}{remove}',
                        'model' => $automezzoSearch,
                        'attribute' => 'data_prossima_revisione',
                        'options' => ['placeholder' => 'Scegli'],
                        'pickerButton' => ['icon' => 'time'],
                        'pluginOptions' => [
                            'autoclose' => true,
                            'format' => 'yyyy-mm-dd',
                        ]
                    ]
                ),
                'hAlign' => 'center', 
                'vAlign' => 'middle',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ];
    
    ?>
    <?php // echo $this->render('_search', ['model' => $automezzoSearch]); ?>

    <!-- <div class="jumbotron">
        
    </div> -->
    
    <div class="body-content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-aqua"><i class="fa fa-truck"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Automezzi</span>
                        <span class="info-box-number"><?= $automezzi->count ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-green"><i class="fa fa-cogs"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text">Tagliandi</span>
                        <span class="info-box-number"><?= $tagliandiCount ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-yellow"><i class="fa fa-users"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Operai</span>
                        <span class="info-box-number"><?= $operaiCount ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>

            <div class="col-md-3 col-sm-6 col-xs-12">
                <div class="info-box">
                    <span class="info-box-icon bg-primary"><i class="fa fa-paperclip"></i></span>
                    <div class="info-box-content">
                        <span class="info-box-text">Accessori</span>
                        <span class="info-box-number"><?= $accessori ?></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
            <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>

            <div class="row">
                <div class="col-md-6"><?= $this->render("snippets/_automezzi", ["automezzi" => $scadenzaAss, "title" => "Assicurazione in scadenza", "date" => "data_scadenza_assicurazione"]) ?></div>
                <div class="col-md-6"><?= $this->render("snippets/_automezzi", ["automezzi" => $scadenzaRevisione, "title" => "Revisione in scadenza", "date" => "data_prossima_revisione"]) ?></div>
            </div>
            
            <div class="row">
                <div class="col-md-6"><?= $this->render("snippets/_operai", ["operai" => $operai, "title" => "Operai"]) ?></div>
                <div class="col-md-6"><?= $this->render("snippets/_accessori", ["title" => "Accessori consegnati"]) ?></div>
            </div>
        

            <div class="panel panel-default" style="margin-top:10px">
                <div class="panel-heading"><h3>Automezzi</h3></div>
                <div class="panel-body">
                    <?= GridView::widget([
                        'dataProvider' => $automezzi,
                        'responsive'=>true,
                        'hover'=>true,
                        'exportContainer' => ['class' => 'btn-group-sm'],
                        'columns' => $gridColumns,
                        'emptyText' => "Nessun risultato trovato"
                    ]); ?>
                </div>
            </div>    
        
        </div>
    </div>
</div>