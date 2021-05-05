<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->nome;
$this->params['breadcrumbs'][] = Yii::$app->user->identity->username=="mago" ? ['label' => 'Utenti', 'url' => ['index']] : "";
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <div class="panel panel-default">
        <div class="panel-body">
        <p>
            <?= Html::a('Modifica', ['update', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
            <?php if(Yii::$app->user->identity->role_id==0){ ?>
                <?= Html::a('Cancella', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Sei sicuro di voler cancellare questo elemento?',
                        'method' => 'post',
                    ],
                ]) ?>
                <?= Html::a('Aggiungi nuovo', ['create'], ['class' => 'btn btn-success']) ?>
            <?php } ?>
            <?= Html::a('Vedi tutti', ['index'], ['class' => 'btn btn-primary']) ?>
            
        </p>

        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'nome',
                'username',
                [
                    'attribute' => "role_id",
                    'value' => function($model){
                        return $model->getRole();
                    }
                ],
                [
                    'attribute' => "created",
                    'value'=> function($model){
                        return $model->formatDate($model->created);
                    }
                ]
            ],
        ]) ?>
        </div>
    </div>
</div>
