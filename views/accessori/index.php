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
            'id',
            'id_operaio',
            'oggetto',
            'quantita',
            'taglia',
            ['class' => 'yii\grid\ActionColumn'],
        ],
        'emptyText' => "Nessun risultato trovato",
    ]); ?>


</div>
