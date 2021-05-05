<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?></div>
        <div class="col-md-4"><?= $form->field($model, 'email')->textInput(['type' => 'email']) ?></div>
    </div>
    
    <div class="row">
        <div class="col-md-4"><?= $form->field($model, 'role_id')->dropdownlist($model->roles, ["prompt" => "Scegli"]) ?></div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <h4><i class="icon_lock"></i> Modifica Password</h4>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Nuova password</label>
                <input class="form-control" name="User[new_password]" type="password">
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Conferma nuova password</label>
                <input class="form-control" name="User[new_password_confirm]" type="password">
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Salva', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
