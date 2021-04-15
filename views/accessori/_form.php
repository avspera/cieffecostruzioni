<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;

/* @var $this yii\web\View */
/* @var $model app\models\Accessori */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="accessori-form">

        <?php $form = ActiveForm::begin(); ?>
        
        <div class="row">
            <?php 
                if(!isset($update) && !$update){
            ?>
                <div class="col-md-6">
                    <?= $form->field($model, 'id_operaio')->widget(Select2::classname(), [
                            'options' => ['multiple'=>false, 'placeholder' => 'Cerca per cognome...'],
                            'pluginOptions' => [
                                'value' => "",
                                'allowClear' => true,
                                'minimumInputLength' => 3,
                                'language' => [
                                    'errorLoading' => new JsExpression("function () { return 'Sto cercando...'; }"),
                                ],
                                'ajax' => [
                                    'url' => Url::to(["operaio/search"]),
                                    'dataType' => 'json',
                                    'data' => new JsExpression('function(params) { return {q:params.term}; }')
                                ],
                                'escapeMarkup' => new JsExpression('function (markup) { return markup; }'),
                                'templateResult' => new JsExpression('function(operaio) { return operaio.text; }'),
                                'templateSelection' => new JsExpression('function (operaio) { return operaio.text; }'),
                            ],
                        ]);
                    ?>
                </div>
            <?php } else { ?>
                <div class="col-md-6">
                    <label>Operaio</label>
                    <input readonly type="text" class="form-control" value="<?= $model->getOperaio() ?>">
                </div>
                
            <?php } ?>
            <div class="col-md-6">
                <?= $form->field($model, 'oggetto')->dropDownList(\yii\helpers\ArrayHelper::map(\app\models\CategoriaAccessori::find()->orderBy('nome')->all(), 'id', 'nome'), ['maxlength' => true, 'prompt' => 'Scegli']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4"><?= $form->field($model, 'quantita')->textInput(['maxlength' => true, 'type' => "number"]) ?></div>
            <div class="col-md-4"><?= $form->field($model, 'taglia')->textInput(['maxlength' => true]) ?></div>
            <div class="col-md-4">
                <?= $form->field($model, 'created')->widget(\yii\jui\DatePicker::classname(), [
                    'language' => 'it',
                    'dateFormat' => 'dd-MM-yyyy',
                    'options' => [
                        'class' => 'form-control',
                        "autocomplete" => "off"
                    ]
                ])->label("Data di consegna") ?>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12"><?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>    </div>
        </div>

        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>

</div>