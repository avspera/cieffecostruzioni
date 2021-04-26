<?php

use yii\helpers\Html;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AutomezzoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Automezzi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="automezzo-index">

    <?php 
        $gridColumns = [
            ['class' => 'yii\grid\ActionColumn'],
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
                        'model' => $searchModel,
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
                        'model' => $searchModel,
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
                    $data =  $model->formatDate($model->data_scadenza_assicurazione);
                    $isExpiring = $model->isExpiring("data_scadenza_assicurazione");
                    $color = $isExpiring ? "red" : "black";
                    return "<span style='color:{$color}'>{$data}</span>";
                },
                'format' => "raw",
                'filterType' => GridView::FILTER_DATE,
                    'filterWidgetOptions' =>([
                        'language'=> "it",
                        'size' => "sm",
                        'layout' => '{picker}{input}{remove}',
                        'model' => $searchModel,
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
                        'model' => $searchModel,
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
                    $data =  $model->formatDate($model->data_prossima_revisione);
                    $isExpiring = $model->isExpiring("data_prossima_revisione");
                    $color = $isExpiring ? "red" : "black";
                    return "<span style='color:{$color}'>{$data}</span>";
                },
                'format' => "raw",
                'filterType' => GridView::FILTER_DATE,
                    'filterWidgetOptions' =>([
                        'language'=> "it",
                        'size' => "sm",
                        'layout' => '{picker}{input}{remove}',
                        'model' => $searchModel,
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
        ];
    
    ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row">
        <div class="col-md-12">
            <?= Html::a('Nuovo Automezzo', ['create'], ['class' => 'btn btn-success']) ?>
                <?= ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'filename' => 'lista_automezzi_'.date('d-m-Y')
                ]); ?>
        </div>
    </div>
    

    <div class="panel panel-default" style="margin-top:10px">
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
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
