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
        <!-- /.col -->
      </div>

        <div class="row">
            <div class="col-md-6">
                <div class="box box-default">
                    <div class="box-header with-border">
                    <h3 class="box-title">Accessori consegnati</h3>

                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                        </button>
                        <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                    <div class="row">
                        <div class="col-md-8">
                        <div class="chart-responsive">
                            <canvas id="pieChart" height="160" width="224" style="width: 224px; height: 160px;"></canvas>
                        </div>
                        <!-- ./chart-responsive -->
                        </div>
                        <!-- /.col -->
                        <div class="col-md-4">
                        <ul class="chart-legend clearfix">
                            <li><i class="fa fa-circle-o text-red"></i> Chrome</li>
                            <li><i class="fa fa-circle-o text-green"></i> IE</li>
                            <li><i class="fa fa-circle-o text-yellow"></i> FireFox</li>
                            <li><i class="fa fa-circle-o text-aqua"></i> Safari</li>
                            <li><i class="fa fa-circle-o text-light-blue"></i> Opera</li>
                            <li><i class="fa fa-circle-o text-gray"></i> Navigator</li>
                        </ul>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer no-padding">
                    <ul class="nav nav-pills nav-stacked">
                        <li><a href="#">United States of America
                        <span class="pull-right text-red"><i class="fa fa-angle-down"></i> 12%</span></a></li>
                        <li><a href="#">India <span class="pull-right text-green"><i class="fa fa-angle-up"></i> 4%</span></a>
                        </li>
                        <li><a href="#">China
                        <span class="pull-right text-yellow"><i class="fa fa-angle-left"></i> 0%</span></a></li>
                    </ul>
                    </div>
                    <!-- /.footer -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="box box-primary">
                <div class="box-header with-border">
                <h3 class="box-title">Ultimi automezzi aggiunti</h3>

                <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                <ul class="products-list product-list-in-box">
                    <?php 
                        foreach($automezzi->getModels() as $automezzo){
                    ?>
                    <li class="item">
                        <div class="product-img">
                            <i class="fa fa-truck"></i>
                        </div>
                        <div class="product-info">
                            <?= Html::a($automezzo->marca." ".$automezzo->modello, Url::to(["automezzo/view", "id" => $automezzo->id]), ["class" => "product-title"]) ?>
                            <span class="label label-warning pull-right"><?= $automezzo->formatDate($automezzo->created)?></span></a>
                            <span class="product-description"><?= $automezzo->targa ?></span>
                        </div>
                    </li>
                    <?php } ?>
                    <!-- /.item -->
                </ul>
                </div>
                <!-- /.box-body -->
                <div class="box-footer text-center">
                    <?= Html::a("Vedi tutti", Url::to(["automezzo/index"]), ["class" => "uppercase"]) ?>
                </div>
                <!-- /.box-footer -->
            </div>
            </div>
        </div>
    

        <div class="panel panel-default" style="margin-top:10px">
            <div class="panel-heading"><h3>Automezzi</h3></div>
            <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $automezzi,
                    'filterModel' => $automezzoSearch,
                    'responsive'=>true,
                    'hover'=>true,
                    'toolbar'=>[
                        '{export}',
                    ],
                    'exportContainer' => ['class' => 'btn-group-sm'],
                    'columns' => $gridColumns,
                    'emptyText' => "Nessun risultato trovato"
                ]); ?>
            </div>
        </div>    
    
    </div>
</div>