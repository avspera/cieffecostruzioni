<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\CategoriaAccessori */

$this->title = 'Modifica Categoria Accessori: ' . $model->nome;
$this->params['breadcrumbs'][] = ['label' => 'Categorie Accessori', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->nome, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Modifica';
?>
<div class="categoria-accessori-update">

    <div class="panel panel-success">
        <div class="panel-body">
            <div class="alert alert-warning">Modificando il prezzo, si aggiorneranno in automatico tutti i prezzi degli accessori già consegnati</div>
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
