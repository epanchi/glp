<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Inscription;
use app\models\Question;

/* @var $this yii\web\View */
/* @var $model app\models\Answer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="answer-form">

    <?php $form = ActiveForm::begin(); ?>

<!--    --><?//= $form->field($model, 'inscription_id')->textInput() ?>
    <?=
    $form->field($model, 'inscription_id')->dropDownList(
        ArrayHelper::map(Inscription::find()->all(), 'id', 'id'),
        ['' => '']
    ) ?>

<!--    --><?//= $form->field($model, 'question_id')->textInput() ?>

    <?= $form->field($model, 'reply')->textarea(['rows' => 6]) ?>

<!--    --><?//= $form->field($model, 'created_at')->textInput() ?>
<!---->
<!--    --><?//= $form->field($model, 'updated_at')->textInput() ?>

    <? /*= $form->field($model, 'status')->textInput() */ ?>
    <?= $form->field($model, 'status')->dropDownList($model->getStatusList()) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? \Yii::$app->params['btnCrear'] : \Yii::$app->params['btnActualizar'], ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
