<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tagliando */

$this->title = 'Aggiorna Tagliando: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tagliandi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Aggiorna';
?>
<div class="tagliando-update">

    <div class="panel panel-success">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
