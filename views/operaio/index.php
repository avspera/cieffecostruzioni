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
                    ['class' => 'yii\grid\SerialColumn'],
                    'nome',
                    'cognome',
                    'codice_fiscale',
                    [
                        'attribute' => 'ruolo',
                        'value' => function($model){
                            return $model->getRole();
                        },
                        'filter' => $searchModel->roles
                    ],
                    ['class' => 'yii\grid\ActionColumn'],
                ],
                'emptyText' => "Nessun risultato trovato"
            ]); ?>
        </div>
    </div>

</div>
