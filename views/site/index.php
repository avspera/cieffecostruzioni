<?php
use kartik\grid\GridView;
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'Gestione cieffecostruzioni';
\yii\web\YiiAsset::register($this);
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
            <a style="color:black;" href="<?= Url::to(["automezzo/index"]) ?>">
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
            </a>
            <!-- /.col -->
            
            <!-- fix for small devices only -->
            <div class="clearfix visible-sm-block"></div>

            <a style="color:black;" href="<?= Url::to(["tagliando/index"]) ?>">
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
            </a>

            <a style="color:black;" href="<?= Url::to(["operaio/index"]) ?>">
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
            </a>

            <a style="color:black;" href="<?= Url::to(["accessori/index"]) ?>">
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
            </a>
            <!-- /.col -->
        </div>
            
            <div class="row">
                <div class="col-md-6"><?= $this->render("snippets/_automezzi", ["automezzi" => $automezzi->getModels(), "title" => "Automezzi", "date" => "data_scadenza_assicurazione"]) ?></div>
                <div class="col-md-6"><?= $this->render("snippets/_operai", ["operai" => $operai, "title" => "Operai"]) ?></div>
            </div>
            
            <div class="row">
                <div class="col-md-12"><?= $this->render("snippets/_accessori", ["title" => "Accessori consegnati", "categorieAccessori" => $categorieAccessori, 'accessori' => $accessori]) ?></div>
            </div>

            <div class="row">
                <div class="col-md-6"><?= $this->render("snippets/_automezzi", ["automezzi" => $scadenzaAss, "title" => "Assicurazione in scadenza", "date" => "data_scadenza_assicurazione"]) ?></div>
                <div class="col-md-6"><?= $this->render("snippets/_automezzi", ["automezzi" => $scadenzaRevisione, "title" => "Revisione in scadenza", "date" => "data_prossima_revisione"]) ?></div>
            </div>
        </div>
    </div>
</div>

<script src="<?= Yii::getAlias("@web") ?>/js/Chart.js"></script>

<script>
    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas  = $('#pieChart').get(0).getContext('2d')
    var pieChart        = new Chart(pieChartCanvas);
    var incomingPieData = <?= json_encode($accessori) ?>;
    var PieData         = [];

    $.each(incomingPieData, function(key, element){
        var obj = {
            value: element.quantita,
            label: element.oggetto,
            color    : '#f56954',
            highlight: '#f56954',
        }
        PieData.push(obj);
    });
    
    var pieOptions     = {
      //Boolean - Whether we should show a stroke on each segment
      segmentShowStroke    : true,
      //String - The colour of each segment stroke
      segmentStrokeColor   : '#fff',
      //Number - The width of each segment stroke
      segmentStrokeWidth   : 2,
      //Number - The percentage of the chart that we cut out of the middle
      percentageInnerCutout: 50, // This is 0 for Pie charts
      //Number - Amount of animation steps
      animationSteps       : 100,
      //String - Animation easing effect
      animationEasing      : 'easeOutBounce',
      //Boolean - Whether we animate the rotation of the Doughnut
      animateRotate        : true,
      //Boolean - Whether we animate scaling the Doughnut from the centre
      animateScale         : false,
      //Boolean - whether to make the chart responsive to window resizing
      responsive           : true,
      // Boolean - whether to maintain the starting aspect ratio or not when responsive, if set to false, will take up entire container
      maintainAspectRatio  : true,
      //String - A legend template
      legendTemplate       : '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    pieChart.Doughnut(PieData, pieOptions)
</script>