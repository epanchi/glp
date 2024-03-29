<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reply */

$this->title = $model->user_id;
$this->params['breadcrumbs'][] = ['label' => 'Respuestas', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reply-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'user_id' => $model->user_id, 'request_id' => $model->request_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'user_id' => $model->user_id, 'request_id' => $model->request_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'user_id',
            'request_id',
            'text:ntext',
            'created_at',
            'updated_at',
            [
                'label' => 'Estado',
                'value'=>$model->getStatus ($model->status),

            ],         ],
    ]) ?>

</div>
