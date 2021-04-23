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
        echo $form->field($model, 'codice_fiscale[]')->widget(
            FileInput::classname(), [
                'options' => [
                    'multiple' => true, 
                    'accept' => 'image/*'
                ]
            ]
        );
    ?>

    <br>
    <?php 
        echo $form->field($model, 'documento_identita[]')->widget(
            FileInput::classname(), [
                'options' => [
                    'multiple' => true, 
                    'accept' => 'image/*'
                ]
            ]
        );
    ?>
    

    <div class="form-group" style="margin-top:20px;">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
