<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\EventanswerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Respuestas por Evento';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="eventanswer-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>



    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',

//            'inscription_id',
//            'eventquestion_id',
            [
                'attribute' => 'eventquestion_id',
                'value'=> function ($data){ return $data->eventquestion->question->text;}
            ],
            'reply:ntext',
//            'created_at',
            // 'updated_at',
            // 'status',

//            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
