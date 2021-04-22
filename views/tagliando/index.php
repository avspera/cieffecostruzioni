<?php

use yii\helpers\Html;
use yii\helpers\Url;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TagliandoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tagliandi';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tagliando-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <?php 
        $gridColumns = [
            ['class' => 'yii\grid\ActionColumn'],
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'id_automezzo',
                'value' => function($model){
                    return !empty($model->automezzo) ? Html::a($model->automezzo->modello." - ".$model->automezzo->targa, Url::to(["automezzo/view", "id" => $model->automezzo->id])) : "<p style='color=red'>Mezzo non trovato</p>";
                },
                'format' => "raw"
            ],
            [
                'attribute' => 'created',
                'value' => function($model){
                    return $model->formatDate($model->created);
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
            'note:ntext',
            'allegati:ntext'
        ];
    ?>
    <div class="row">
        <div class="col-md-12">
            <?= Html::a('Aggiungi Tagliando', ['create'], ['class' => 'btn btn-success']) ?>
                <?= ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
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
