<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Utenti';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-index">

    <div class="panel panel-default">

        <div class="panel-body">
            <p><?= Html::a('<i class="fa fa-plus"></i> Aggiungi utente', ['create'], ['class' => 'btn btn-success']) ?></p>

            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\ActionColumn'],
                    ['class' => 'yii\grid\SerialColumn'],
                    'nome',
                    'username',
                    [
                        'attribute' => "role_id",
                        'value' => function($model){
                            return $model->getRole();
                        },
                        'filter' => $searchModel->roles
                    ],
                    [
                        'attribute' => "created",
                        'value' => function($model){
                            return $model->formatDate($model->created);
                        },
                        'filterType' => GridView::FILTER_DATE,
                        'filterWidgetOptions' =>([
                            'language'=> "it",
                            'size' => "sm",
                            'layout' => '{picker}{input}{remove}',
                            'model' => $searchModel,
                            'attribute' => 'created',
                            'options' => ['placeholder' => 'Scegli'],
                            'pickerButton' => ['icon' => 'time'],
                            'pluginOptions' => [
                                'autoclose' => true,
                                'format' => 'yyyy-mm-dd',
                            ]
                        ]),
                    ],
                ],
            ]); ?>
        </div>
    </div>
</div>
