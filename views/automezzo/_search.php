<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AutomezzoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="automezzo-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'marca') ?>

    <?= $form->field($model, 'modello') ?>

    <?= $form->field($model, 'targa') ?>

    <?= $form->field($model, 'created') ?>

    <?php // echo $form->field($model, 'data_immatricolazione') ?>

    <?php // echo $form->field($model, 'data_ultimo_rinnovo_assicurazione') ?>

    <?php // echo $form->field($model, 'data_scadenza_assicurazione') ?>

    <?php // echo $form->field($model, 'data_ultima_revisione') ?>

    <?php // echo $form->field($model, 'data_prossima_revisione') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
