<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriaAccessori */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Categorie Accessori', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="categoria-accessori-view">

    <p>
        <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
        <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Vedi tutti', ['index'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Aggiungi nuovo', ['create'], ['class' => 'btn btn-success']) ?>

    </p>

    <div class="panel panel-default">
        <div class="panel-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'nome',
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
                ],
            ]) ?>
        </div>
    </div>

</div>
