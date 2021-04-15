<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tagliando */

$this->title = 'Aggiorna Tagliando: ' . $model->automezzo->marca." ".$model->automezzo->modello." - ".$model->automezzo->targa;
$this->params['breadcrumbs'][] = ['label' => 'Tagliandi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->automezzo->marca." ".$model->automezzo->modello." - ".$model->automezzo->targa, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>
<div class="tagliando-update">

    <div class="panel panel-success">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
                'update' => true
            ]) ?>
        </div>
    </div>

</div>
