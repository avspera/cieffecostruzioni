<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dipendente */

$this->title = 'Modifica Dipendente: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Dipendenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modifica';
?>
<div class="Dipendente-update">

    <div class="panel panel-success">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>


</div>
