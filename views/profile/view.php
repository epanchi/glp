<?php

use yii\helpers\Html;
use yii\widgets\DetailView;


/* @var $this yii\web\View */
/* @var $model app\models\Profile */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Perfiles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="profile-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->id], [
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
//            'id',
            'name',
            'lastname',
            'institution_name',
            'responsability_name',
            'gender',
            'phone_number',
            'mobile_number',
//            'complete',
            'status',
//            'created_at',
//            'updated_at',
            'photo',
//            'user_id',
            [                    // the owner name of the model
                'label' => 'Usuario',
                'value' => $model->user->username,
            ],
//            'institutiontype_id',
            [                    // the owner name of the model
                'label' => 'Tipo de Instituto',
                'value' => $model->institutiontype->name,
            ],
//            'responsibilitytype_id',
            [                    // the owner name of the model
                'label' => 'Tipo de Responsabilidad',
                'value' => $model->responsibilitytype->name,
            ],
//            'country_id',
//            'country_id:html',  // description attribute in HTML
            [                    // the owner name of the model
                'label' => 'Pais',
                'value' => $model->country->name,
            ],
    ]]) ?>

</div>
