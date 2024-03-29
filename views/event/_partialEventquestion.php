<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\controllers\EventquestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preguntas por Evento';

?>
<div class="eventquestion-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,

//        'filterModel' => false,

        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'text',
//            'status',
            [
                'attribute' => 'status',
                /* 'value'=> function ($data){ return $data->question->text;}*/
                'filter' => [1 => 'ACTIVO', 2 => 'INACTIVO', 0 => 'ELIMINADO'],
                'value' => function ($model) {
                        if ($rel = $model->getStatus($model->status)) {
                            return $rel;
                        }
                    },

            ],
//            'created_at',
//            'updated_at',
//            'eventtype_id',
            /*            [
                            'attribute' => 'eventtype_id',
                            'value'=> function ($data){ return $data->eventtype->name;}
                        ],*/
            /*//            'question_id',
                        [
                            'attribute' => 'question_id',
                            'value'=> function ($data){ return $data->text;}
                        ],*/

            ['class' => 'yii\grid\ActionColumn',
                'template' => ' {update}',
                'buttons' => [
                    'update' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['eventquestion/update', 'id' => $key]);
                    },


                ]
            ],

        ],
    ]); ?>
    <div class="panel-body">


    </div>






</div>
