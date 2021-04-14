<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Operaio */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="operaio-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'cognome')->textInput(['maxlength' => true]) ?></div>
    </div>
    
    <div class="row">
        <div class="col-md-6"><?= $form->field($model, 'codice_fiscale')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'ruolo')->dropdownlist($model->roles, ["prompt" => "Scegli"]) ?></div>
    </div>
    
    

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
