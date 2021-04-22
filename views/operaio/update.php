<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Dipendente */

$this->title = 'Aggiorna Dipendente: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Dipendenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="Dipendente-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
