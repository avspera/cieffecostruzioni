<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\file\FileInput;
/* @var $this yii\web\View */
/* @var $model app\models\Operaio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operaio-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'ruolo')->dropdownlist($model->roles, ["prompt" => "Scegli"]) ?></div>

    </div>
    
    <?php 
        echo '<label class="control-label">Aggiungi codice fiscale o tessera sanitaria</label>';
        echo FileInput::widget([
            'model' => $model,
            'attribute' => 'codice_fiscale[]',
            'options' => ['multiple' => true]
        ]);
    ?>

<br>
    <?php 
        echo '<label class="control-label">Aggiungi carta di identità o patente di guida</label>';
        echo FileInput::widget([
            'model' => $model,
            'attribute' => 'documento_identita[]',
            'options' => ['multiple' => true]
        ]);
    ?>
    

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
