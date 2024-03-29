<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => 100,'readonly'=>'readonly']) ?>

<!--    --><?//= $form->field($model, 'auth_key')->textInput(['maxlength' => 32]) ?>

    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => 250]) ?>


<!--    --><?//= $form->field($model, 'password_reset_token')->textInput(['maxlength' => 250]) ?>

<!--    --><?//= $form->field($model, 'email')->textInput(['maxlength' => 45]) ?>

<!--    --><?//= $form->field($model, 'status')->textInput() ?>
<!--    --><?//= $form->field($model, 'status')->dropDownList(['10' => 'Activo', '0' => 'Inactivo'], ['prompt' => 'Seleccionar']) ?>
<!--    --><?//= $form->field($model, 'status')->dropDownList($model->getStatusList()) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? \Yii::$app->params['btnCrear'] : \Yii::$app->params['btnActualizar'], ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
