<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Automezzo */

$this->title = 'Aggiungi Automezzo';
$this->params['breadcrumbs'][] = ['label' => 'Automezzi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="automezzo-create">

    <div class="panel panel-success">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>
