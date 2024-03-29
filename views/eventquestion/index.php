<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Event;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel app\controllers\EventquestionSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Preguntas por Evento';
?>
<div class="regresar">
<?= Html::a(\Yii::$app->params['btnRegresar'],['/site/index'], ['class' => 'btn btn-default'])?>
</div>


<div class="panel panel-green">
  <div class="panel-heading"><?= Html::encode($this->title) ?></div>
  <div class="panel-body">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',


//            'created_at',
//            'updated_at',
//            'event_id',
            [
                'attribute' => 'event_id',
                'value' => function ($data) {
                        return $data->event->name;
                    }
            ],
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

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['eventquestion/view', 'id' => $key]);
                        },
                    'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['eventquestion/update', 'id' => $key]);
                        },

                ]
            ],
        ],
    ]); ?>
  </div>
</div>

<div class="eventquestion-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <!--<p>
        <?/*= Html::a('Crear Pregunta por Evento', ['create'], ['class' => 'btn btn-success', ]) */?>
    </p>-->

    

</div>
