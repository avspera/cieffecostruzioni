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

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
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
            'quantita',
            'taglia',
            [
                'attribute' => 'created',
                'value' => function($model){
                    return $model->formatDate($model->created);
                },
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'emptyText' => "Nessun risultato trovato",
    ]); ?>


</div>
