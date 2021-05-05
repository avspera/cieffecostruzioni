<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Tagliando */

$this->title = "Tagliando del: ".$model->formatDate($model->created);
$this->params['breadcrumbs'][] = ['label' => 'Tagliandi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="tagliando-view">

    <div class="panel panel-default">

        <div class="panel-heading">
            <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Sei sicuro di voler cancellare quesot elemento?',
                    'method' => 'post',
                ],
            ]) ?>
            <?= Html::a('Vedi tutti', ['index'], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Aggiungi nuovo', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    [
                        'attribute' => 'id_automezzo',
                        'value' => function($model){
                            $url = Html::a($model->automezzo->modello." - ".$model->automezzo->targa, Url::to(["automezzo/view", "id" => $model->automezzo->id]));
                            return $url;
                        },
                        'format' => "raw"
                    ],
                    [
                        'attribute' => 'created',
                        'value' => function($model){
                            return $model->formatDate($model->created);
                        } 
                    ],
                    [
                        'attribute' => 'costo',
                        'value' => function($model){
                            return $model->formatValue($model->costo);
                        } 
                    ],
                    [
                        'attribute' => 'costo_con_iva',
                        'value' => function($model){
                            return $model->formatValue($model->costo_con_iva);
                        } 
                    ],
                    'note:ntext',
                    [
                        'attribute' => 'allegati',
                        'value' => function($model){
                            $files = $model->getAttachmentUrl('allegati', true);
                            $html = "";
                            foreach($files as $key => $value){
                                if(strpos($value, ".pdf")){
                                    $html .= Html::a(Html::img("@web/images/pdf_icon.png"), $value, ['target' => '_blank']);
                                }
                                else{
                                    $html .= "<a href='{$value}' target='_blank'>".Html::img($value, ['width' => '100px'])."</a>";
                                }
                            }
                            return $html;
                        },
                        'format' => "raw"
                    ],
                    [
                        'attribute' => "updated",
                        'value' => function($model){
                            return !empty($model->updated) ? "<span style='color:red'>".$model->formatDate($model->updated)."</span>" : "-";
                        },
                        'format' => "raw"  
                    ]
                ],
            ]) ?>
        </div>
        
    </div>
    
</div>
