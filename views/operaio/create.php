<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Operaio */

$this->title = 'Aggiungi Dipendente';
$this->params['breadcrumbs'][] = ['label' => 'Dipendenti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="operaio-create">

    <div class="panel panel-success">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
