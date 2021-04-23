<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\OperaioSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Dipendenti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operaio-index">

    <p>
        <?= Html::a('Aggiungi Dipendente', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-default" style="margin-top:10px">
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\SerialColumn'],
                    'nome',
                    'cognome',
                    [
                        'attribute' => 'codice_fiscale',
                        'value' => function($model){
                            $value  = json_decode($model->codice_fiscale);
                            $icon   = !empty($value) ? "<i class='fa fa-2x fa-check'></i>" : "<i class='fa fa-2x fa-times'></i>";
                            $color  = !empty($value) ? "green" : "red";
                            return "<span style='color:{$color}'>{$icon}</span>";
                        },
                        'format' => "raw"
                    ],
                    [
                        'attribute' => 'documento_identita',
                        'value' => function($model){
                            $value  = json_decode($model->documento_identita);
                            $icon   = !empty($value) ? "<i class = 'fa fa-2x fa-check'></i>" : "<i class='fa fa-2x fa-times'></i>";
                            $color  = !empty($value) ? "green" : "red";
                            return "<span style='color:{$color}'>{$icon}</span>";
                        },
                        'format' => "raw"
                    ],
                    [
                        'attribute' => 'ruolo',
                        'value' => function($model){
                            return $model->getRole();
                        },
                        'filter' => $searchModel->roles
                    ]
                ],
                'emptyText' => "Nessun risultato trovato"
            ]); ?>
        </div>
    </div>

</div>
