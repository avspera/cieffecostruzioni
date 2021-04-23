<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use kartik\grid\GridView;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $model app\models\Automezzo */

$this->title = $model->modello." - ".$model->targa;
$this->params['breadcrumbs'][] = ['label' => 'Automezzi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="automezzo-view">

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Elimina', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Torna indietro', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Aggiungi nuovo', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'marca',
            'modello',
            'targa',
            [
                'attribute' => 'created',
                'value' => function($model){
                    return $model->formatDate($model->created, true);
                }
            ],
            [
                'attribute' => 'data_immatricolazione',
                'value' => function($model){
                    return $model->formatDate($model->data_immatricolazione);
                }
            ],
            [
                'attribute' => 'data_ultimo_rinnovo_assicurazione',
                'value' => function($model){
                    return $model->formatDate($model->data_ultimo_rinnovo_assicurazione);
                }
            ],
            [
                'attribute' => 'data_scadenza_assicurazione',
                'value' => function($model){
                    $data =  $model->formatDate($model->data_scadenza_assicurazione);
                    $isExpiring = $model->isExpiring("data_scadenza_assicurazione");
                    $color = $isExpiring ? "red" : "black";
                    return "<span style='color:{$color}'>{$data}</span>";
                },
                'format' => "raw"
            ],
            [
                'attribute' => 'data_ultima_revisione',
                'value' => function($model){
                    return $model->formatDate($model->data_ultima_revisione);
                }
            ],
            [
                'attribute' => 'data_prossima_revisione',
                'value' => function($model){
                    $data =  $model->formatDate($model->data_prossima_revisione);
                    $isExpiring = $model->isExpiring("data_prossima_revisione");
                    $color = $isExpiring ? "red" : "black";
                    return "<span style='color:{$color}'>{$data}</span>";
                },
                'format' => "raw"
            ]
        ],
    ]) ?>

</div>


<div class="tagliando-index">
<?php 
        // $gridColumns = [
        //     ['class' => 'yii\grid\SerialColumn'],
        //     [
        //         'attribute' => 'created',
        //         'value' => function($model){
        //             return $model->formatDate($model->created);
        //         },
        //         'hAlign' => 'center', 
        //         'vAlign' => 'middle',
        //         'filterType' => GridView::FILTER_DATE,
        //             'filterWidgetOptions' =>([
        //                 'language'=> "it",
        //                 'size' => "sm",
        //                 'layout' => '{picker}{input}{remove}',
        //                 'model' => $tagliandoSearch,
        //                 'attribute' => 'data_immatricolazione',
        //                 'options' => ['placeholder' => 'Scegli'],
        //                 'pickerButton' => ['icon' => 'time'],
        //                 'pluginOptions' => [
        //                     'autoclose' => true,
        //                     'format' => 'yyyy-mm-dd',
        //                 ]
        //             ]
        //         ),
        //     ],
        //     'note:ntext',
        //     'allegati:ntext',
        //     ['class' => 'yii\grid\ActionColumn'],
        // ];
    ?>

    <div class="panel panel-default" style="margin-top:10px">
        <div class="panel-heading"><h3>Tagliandi</h3></div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-12">
                    <!-- The time line -->
                    <ul class="timeline">
                        <!-- timeline time label -->
                        <?php 
                            foreach($tagliandi->getModels() as $tagliando){
                        ?>
                            <li class="time-label">
                                <span class="bg-red"><?= $tagliando->formatDate($tagliando->created) ?></span>
                            </li>
                        
                            <li>
                                <i class="fa fa-user bg-aqua"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> <?= $tagliando->getDateHour($tagliando->created) ?></span>
                                    
                                    <h3 class="timeline-header no-border"><a href="#"><?= Yii::$app->user->identity->username ?></a> ha inserito il tagliando nel sistema</h3>
                                </div>
                            </li>

                            <li>
                                <i class="fa fa-comments bg-yellow"></i>

                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> <?= $tagliando->getDateHour($tagliando->created) ?></span>

                                    <h3 class="timeline-header"><a href="#">Note</a></h3>

                                    <div class="timeline-body"><?= $tagliando->note ?></div>
                                    <div class="timeline-footer">
                                        <?= Html::a("Vedi i dettagli", Url::to(["tagliando/view", "id" => $tagliando->id]), ['class' => "btn btn-primary btn-xs"]) ?>
                                    </div>
                                </div>
                            </li>
                            
                            <?php if(!empty($tagliando->allegati)){ ?>
                            <li>
                                <i class="fa fa-camera bg-purple"></i>
                                <div class="timeline-item">
                                    <span class="time"><i class="fa fa-clock-o"></i> <?= $tagliando->getDateHour($tagliando->created) ?></span>

                                    <h3 class="timeline-header"><a href="#">File allegati</h3>
                                    <div class="timeline-body">
                                    <?php
                                        $files = $tagliando->getAttachmentUrl('allegati', true);
                                        $html = "";
                                        foreach($files as $key => $value){
                                            if(strpos($value, ".pdf")){
                                                $html .= Html::a("<i class='fa fa-2x fa-file-pdf'></i> ", $value, ['target' => '_blank']);
                                            }
                                            else{
                                                $html .= "<a href='{$value}' target='_blank'>".Html::img($value, ['width' => '100px', 'class' => "margin"])."</a>";
                                            }
                                        }
                                        echo $html;
                                    ?>
                                        <!-- <img src="http://placehold.it/150x100" alt="..." class="margin"> -->
                                    </div>
                                </div>
                            </li>
                            <?php } ?>

                        <?php } ?>
                        <!-- END of foreach -->
                        <li>
                        <i class="fa fa-clock-o bg-gray"></i>
                        </li>
                    </ul>
                </div>
            <!-- /.col -->
        </div>

            <?php 
                // GridView::widget([
                //     'dataProvider' => $tagliandi,
                //     'filterModel' => $tagliandoSearch,
                //     'responsive'=>true,
                //     'hover'=>true,
                //     'toolbar'=>[
                //         '{export}',
                //     ],
                //     'exportContainer' => ['class' => 'btn-group-sm'],
                //     'columns' => $gridColumns,
                //     'emptyText' => "Nessun risultato trovato"
                // ]); 
            ?>
        </div>
    </div>
</div>
