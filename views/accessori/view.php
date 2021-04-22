<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Accessori */

$this->title = $model->getCategoriaAccessori();
$this->params['breadcrumbs'][] = ['label' => 'Accessori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="accessori-view">

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="panel panel-default">
        <div class="panel-body">
          
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'id_operaio',
                        'value' => function($model){
                            $url = Html::a($model->getOperaio(), Url::to(["operaio/view", "id" => $model->id_operaio]));
                            return $model->getOperaio();
                        },
                        'format' => "raw"
                    ],
                    [
                        'attribute' => 'oggetto',
                        'value' => function($model){
                            return $model->getCategoriaAccessori();
                        }
                    ],
                    'quantita',
                    'taglia',
                    [
                        'attribute' => "created",
                        'value' =>  function($model){
                            return $model->formatDate($model->created);
                        }
                    ]
                ],
            ]) ?>
        </div>
    </div>

</div>
