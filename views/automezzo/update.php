<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Automezzo */

$this->title = 'Aggiorna Automezzo: ' . $model->marca." ".$model->modello." - ".$model->targa;
$this->params['breadcrumbs'][] = ['label' => 'Automezzi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $this->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>
<div class="automezzo-update">

    <div class="panel panel-success">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
