<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model app\models\Tagliando */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tagliando-form">

    <div class="container">
        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
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
        </div>
        
        <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

        <?php 
            echo '<label class="control-label">Aggiungi allegati</label>';
            echo FileInput::widget([
                'model' => $model,
                'attribute' => 'allegati[]',
                'options' => ['multiple' => true]
            ]);
        ?>
        <div class="form-group">
            <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    

</div>
