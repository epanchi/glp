<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Eventanswer */

/*$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Respuestas por Evento', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>
<div class="eventanswer-view">

    <!--<h1><?/*= Html::encode($this->title) */?></h1>

    <p>
        <?/*= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */?>
        <?/*= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>-->

    <?/*= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'reply:ntext',
            'inscription_id',
            'eventquestion_id',
            'created_at',
            'updated_at',
            'status',
        ],
    ]) */?>

</div>
