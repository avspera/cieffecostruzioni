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
                <?= Html::a('Aggiorna', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Sei sicuro di voler cancellare quesot elemento?',
                        'method' => 'post',
                    ],
                ]) ?>
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
                    'note:ntext',
                    'allegati:ntext',
                ],
            ]) ?>
        </div>
        
    </div>
    
</div>
