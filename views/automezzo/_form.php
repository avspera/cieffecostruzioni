<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\jui\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\Automezzo */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="automezzo-form">
    
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'marca')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'modello')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'targa')->textInput(['maxlength' => true]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'data_immatricolazione')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'it',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => [
                    'class' => 'form-control'
                ]
        ]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'data_ultimo_rinnovo_assicurazione')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'it',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => [
                    'class' => 'form-control'
                ]
        ]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'data_scadenza_assicurazione')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'it',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => [
                    'class' => 'form-control'
                ]
        ]) ?></div>
        
    </div>
    
    <div class="row">
    <div class="col-md-6"><?= $form->field($model, 'data_ultima_revisione')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'it',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => [
                    'class' => 'form-control'
                ]
        ]) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'data_prossima_revisione')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'it',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => [
                    'class' => 'form-control'
                ]
        ]) ?></div>

    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
