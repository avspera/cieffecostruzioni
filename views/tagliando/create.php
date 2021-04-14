<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tagliando */

$this->title = 'Nuovo Tagliando';
$this->params['breadcrumbs'][] = ['label' => 'Tagliandi', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tagliando-create">

    <div class="panel panel-success">
        <div class="panel-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>
