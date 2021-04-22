<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;
use yii\grid\GridView;
/* @var $this yii\web\View */
/* @var $model app\models\Operaio */

$this->title = $model->nome." ".$model->cognome;
$this->params['breadcrumbs'][] = ['label' => 'Operai', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

?>
<div class="operaio-view">

        <p>
            <?= Html::a('Aggiorna', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
                    'method' => 'post',
                ],
            ]) ?>
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'nome',
                'cognome',
                'codice_fiscale',
                [
                    'attribute' => 'ruolo',
                    'value' => function($model){
                        return $model->getRole();
                    }
                ]
            ],
        ]) ?>

        <div class="panel panel-default">
            <div class="panel-heading"><h3>Accessori consegnati</h3></div>
            <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $accessori,
                'filterModel' => $accessoriModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                       'attribute' => 'oggetto',
                       'value' => function($model){
                           return $model->getCategoriaAccessori();
                       }
                    ],
                    'quantita',
                    'taglia',
                    [
                        'class' => 'yii\grid\ActionColumn', 'template' => '{view} {update} {delete}',
                        'buttons' => [
                            'view' => function($url, $model, $key) {
                                $url = Url::to(["accessori/view", 'id' => $model->id]);
                                $btn = Html::a("<i class='fa fa-eye'></i>", $url);
                                return $btn;
                            },
                            'update' => function($url, $model, $key) {
                                $url = Url::to(["accessori/update", 'id' => $model->id]);
                                $btn = Html::a("<i class='fa fa-pencil'></i>", $url);
                                return $btn;
                            },
                            'delete' => function($url, $model) {
                                return Html::a('<i class="fa fa-trash"></i>', ['accessori/delete', 'id' => $model->id], [
                                    'class' => '',
                                    'data' => [
                                        'confirm' => 'Sei sicuro di voler eliminare questo catalogo? Verranno cancellati anche i prodotti',
                                        'method' => 'post',
                                    ],
                                ]);
                            }
                        ],
                    ], 
                ],
                'emptyText' => "Nessun risultato trovato"
            ]); ?>
            </div>
        </div>

</div>
