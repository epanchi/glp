<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PhforumImagen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="phforum-imagen-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'phforum_id')->textInput() ?>

    <?= $form->field($model, 'imagen_id')->textInput() ?>


    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? \Yii::$app->params['btnCrear'] : \Yii::$app->params['btnGuardar'], ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
