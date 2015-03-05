<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Event */

$this->title = $modelEvent->name;
$this->params['breadcrumbs'][] = ['label' => 'Eventos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="event-view">

    <h1><?= Html::encode($this->title) ?></h1>
    <p><?= Html::encode($modelEvent->short_description) ?></p>
    <p><?= Html::encode($modelEvent->general_content) ?></p>
    <p><?= Html::encode($modelEvent->methodology) ?></p>
    <p><?= Html::encode($modelEvent->addressed_to) ?></p>
    <p><?= Html::encode($modelEvent->included) ?></p>
    <p><?= Html::encode($modelEvent->requirements) ?></p>
    <p><?= Html::encode($modelEvent->file) ?></p>
    <p><?= Html::encode($modelEvent->photo) ?></p>
    <p><?= Html::encode($modelEvent->url) ?></p>
    <strong>Inicia: </strong><?= Yii::$app->formatter->asDate($modelEvent->begin_at, 'long'); ?><br>
    <strong>Finaliza: </strong><?= Yii::$app->formatter->asDate($modelEvent->end_at, 'long'); ?><br>
    <p><?= Html::encode($modelEvent->city) ?></p>
    <p><?= Html::encode($modelEvent->cost) ?></p>
    <p><?= Html::encode($modelEvent->discount) ?></p>
    <p><?= Html::encode($modelEvent->discount_end_at) ?></p>
    <p><?= Html::encode($modelEvent->discount_description) ?></p>
    <p><?= Html::encode($modelEvent->year) ?></p>
    <p><?= Html::encode($modelEvent->status) ?></p>
    <p><?= Html::encode($modelEvent->created_at) ?></p>
    <p><?= Html::encode($modelEvent->updated_at) ?></p>
    <p><?= Html::encode($modelEvent->country->name) ?></p>

    <!-- botón-->
    <?= Html::a('Regresar', ['/site/admuser'], ['class' => 'btn btn-success']) ?>

<!--
    <p>
        <?/*= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) */?>
        <?/*= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */?>
    </p>

    --><?/*= DetailView::widget([
        'model' => $model,
        'attributes' => [
//            'id',
            'name',
            'short_description:ntext',
            'general_content:ntext',
            'methodology:ntext',
            'addressed_to:ntext',
            'included:ntext',
            'requirements:ntext',
            'file:ntext',
            'photo:ntext',
            'url:ntext',
            'begin_at',
            'end_at',
            'city',
            'cost',
            'discount',
            'discount_end_at',
            'discount_description',
            'year',
            'status',
            'created_at',
            'updated_at',
//            'country_id',
            [                    // the owner name of the model
                'label' => 'Pais',
                'value' => $model->country->name,
            ],
//            'eventtype_id',
            [                    // the owner name of the model
                'label' => 'Tipo de Evento',
                'value' => $model->eventtype->name,
            ],
        ],
    ]) */?>

</div>
