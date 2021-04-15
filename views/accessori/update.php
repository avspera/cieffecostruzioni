<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Accessori */

$this->title = 'Aggiorna Accessori: ' . $model->getCategoriaAccessori();
$this->params['breadcrumbs'][] = ['label' => 'Accessori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->getCategoriaAccessori(), 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>
<div class="accessori-update">

    <div class="panel panel-success">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
                'update' => true
            ]) ?>
        </div>
    </div>

</div>
