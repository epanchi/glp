<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Video */

$this->title = 'Crear Video';
$this->params['breadcrumbs'][] = ['label' => 'Videos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="video-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('/video/_form', [
        'model' => $model,
    ]) ?>

</div>
