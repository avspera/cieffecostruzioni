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
        <div class="col-md-4"><?= $form->field($model, 'targa')->textInput(['maxlength' => true, 'onblur' => "javascritp:checkTarga()"]) ?></div>
    </div>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'data_immatricolazione')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'it',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => [
                    'class' => 'form-control',
                    "autocomplete" => "off",
                    'placehoder' => "Es. 10-02-2020"
                ],
        ]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'data_ultimo_rinnovo_assicurazione')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'it',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => [
                    'class' => 'form-control',
                    "autocomplete" => "off",
                    'placehoder' => "Es. 10-02-2020"
                ],
        ]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'data_scadenza_assicurazione')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'it',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => [
                    'class' => 'form-control',
                    "autocomplete" => "off",
                    'placehoder' => "Es. 10-02-2020"
                ],
        ]) ?></div>
        
    </div>
    
    <div class="row">
    <div class="col-md-6"><?= $form->field($model, 'data_ultima_revisione')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'it',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => [
                    'class' => 'form-control',
                    "autocomplete" => "off"
                ]
        ]) ?></div>
        <div class="col-md-6"><?= $form->field($model, 'data_prossima_revisione')->widget(\yii\jui\DatePicker::classname(), [
                'language' => 'it',
                'dateFormat' => 'dd-MM-yyyy',
                'options' => [
                    'class' => 'form-control',
                    "autocomplete" => "off"
                ]
        ]) ?></div>

    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>

<script>
    function checkTarga(){
        let targa = $("#automezzo-targa").val();
        let targaContainer = $(".field-automezzo-targa");
        if(targa.length > 3){
            $.ajax({
                dataType: 'json',
                url: "check-targa",
                method: 'post',
                data: {
                    targa: targa
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.log(errorThrown);
                },
                success: function (data) {
                    if(data.status == "200"){
                        targaContainer.removeClass("has-success");
                        targaContainer.addClass("has-error");
                        targaContainer.find("div.help-block").append("Questa targa è già presente nel sistema");
                        $("button[type=submit]").prop("disabled",true);
                    }else{
                        targaContainer.removeClass("has-error");
                        targaContainer.addClass("has-success");
                        targaContainer.find("div.help-block").html("");
                        $("button[type=submit]").prop("disabled",false);
                    }
                }
            });
        }
    }
</script>