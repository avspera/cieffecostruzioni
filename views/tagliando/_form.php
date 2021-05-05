<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use kartik\file\FileInput;
use yii\jui\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Tagliando */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tagliando-form">

    <div class="container-fluid">
        <?php $form = ActiveForm::begin(); ?>

        <?php if(isset($update)): ?>
            <div class="alert alert-info">Ultima modifica effettuata: <?= $model->formatDate($model->updated) ?></div>
        <?php endif; ?>
        <div class="row">
            <?php 
                if(!isset($update) && !$update){
            ?>
                <div class="col-md-4">
                    <?= $form->field($model, 'id_automezzo')->widget(Select2::classname(), [
                            'options' => ['multiple'=>false, 'placeholder' => 'Cerca per targa...'],
                            'pluginOptions' => [
                                'value' => $model->id_automezzo,
                                'allowClear' => true,
                                'minimumInputLength' => 3,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Sto cercando...'; }"),
                                ],
                                'ajax' => [
                                    'url' => Url::to(["automezzo/search"]),
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(city) { return city.text; }'),
                                'templateSelection' => new JsExpression('function (city) { return city.text; }'),
                            ],
                        ]);
                    ?>
                </div>
            <?php } else { ?>
                <div class="col-md-4">
                    <label>Automezzo</label>
                    <input readonly type="text" class="form-control" value="<?= $model->automezzo->marca." ".$model->automezzo->modello." - ".$model->automezzo->targa ?>">
                </div>
                <div class="col-md-4">
                    <label>Inserito</label>
                    <input readonly type="text" class="form-control" value="<?= $model->formatDate($model->created) ?>">
                </div>
            <?php } ?>
        </div>
        

        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'created')->widget(\yii\jui\DatePicker::classname(), [
                    'language' => 'it',
                    'dateFormat' => 'dd-MM-yyyy',
                    'options' => [
                        'class' => 'form-control',
                        "autocomplete" => "off",
                        'placehoder' => "Es. 10-02-2020"
                    ],
                ]) ?>
            </div>
            <div class="col-md-4"><?= $form->field($model, 'costo')->textInput(['placeholder' => '0.00']) ?></div>
            <div class="col-md-4"><?= $form->field($model, 'costo_con_iva')->textInput(['placeholder' => '0.00']) ?></div>
        </div>

        <div class="row">
            <div class="col-md-12"><?= $form->field($model, 'note')->textarea(['rows' => 6]) ?></div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <?= $form->field($model, 'allegati[]')->widget(
                        FileInput::classname(), [
                            'options' => [
                                'multiple' => true, 
                                'accept' => 'image/*'
                            ]
                        ]
                    );
                ?>
            </div>
        </div>
        
        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    

</div>
