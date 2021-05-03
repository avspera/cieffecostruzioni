<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AccessoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Accessori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="accessori-index">

    <p>
        <?= Html::a('Aggiungi Accessorio', ['create'], ['class' => 'btn btn-success']) ?>
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
                    [
                    'attribute' => 'id_operaio',
                    'value' => function($model){
                        return $model->getOperaio();
                    }
                    ],
                    [
                        'attribute' => 'oggetto',
                        'value' => function($model){
                            return $model->getCategoriaAccessori();
                        },
                        'filter' => $searchModel->getCategorieAccessori()
                    ],
                    'taglia',
                    'quantita',
                    [
                        'attribute' => 'costo_totale',
                        'value' => function($model){
                            return $model->formatValue($model->costo_totale);
                        }
                    ],
                    [
                        'attribute' => 'created',
                        'value' => function($model){
                            return $model->formatDate($model->created);
                        },
                    ]
                ],
                'emptyText' => "Nessun risultato trovato",
            ]); ?>
        </div>
    </div>


</div>
