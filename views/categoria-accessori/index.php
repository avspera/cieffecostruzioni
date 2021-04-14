<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategoriaAccessoriSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Categorie Accessori';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="categoria-accessori-index">

    <p>
        <?= Html::a('Aggiungi Accessorio', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="panel panel-default">
        <div class="panel-body">
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'nome',
                    ['class' => 'yii\grid\ActionColumn'],
                ],
                'emptyText' => "Nessun risultato trovato"
            ]); ?>
        </div>
        
    </div>
    

</div>
