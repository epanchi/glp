<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\editable\Editable;
use yii\bootstrap\Modal;

use yii\widgets\Pjax;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel app\models\InstitutiontypeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tipos de Institución';
?>

<!--<div class="regresar">
<?/*= Html::a(\Yii::$app->params['btnRegresar'],['/site/index'], ['class' => 'btn btn-default'])*/?>
</div>
-->
<div class="breadcrumb">
    <?= Html::a(\Yii::$app->params['btnRegresar'], ['/site/index'], ['class' => 'btn btn-default']) ?>
    <?= Html::a(\Yii::$app->params['btnInstitucion'], ['create'], ['class' => 'btn btn-success']) ?>
</div>
<div class="panel panel-green">
  <div class="panel-heading"><?= Html::encode($this->title) ?></div>
  <div class="panel-body">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function ($model) {
            if ($model->status == 1) {
                return ['class' => 'success'];
            } elseif ($model->status == 0) {
                return ['class' => 'danger'];
            } else
                return ['class' => 'warning'];

        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
//            'id',
            'name',
            'description:ntext',
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
//            'created_at',
            // 'updated_at',

//            ['class' => 'yii\grid\ActionColumn',
                /*'template' => '{view} {delete}',
                'headerOptions' => ['width' => '20%', 'class' => 'activity-view-link',],
                'contentOptions' => ['class' => 'padding-left-5px'],

                'buttons' => [
                    'view' => function ($url, $model, $key) {
                        return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', '#', [
                            'id' => 'activity-view-link',
                            'title' => Yii::t('yii', 'View'),
                            'data-toggle' => 'modal',
                            'data-target' => '#activity-modal',
                            'data-id' => $key,
                            'data-pjax' => '0',

                        ]);
                    },
                ],*/


//            ],

            ['class' => 'yii\grid\ActionColumn',
                'template' => '{view} {update}',
                'buttons' => [
                    'view' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['institutiontype/view', 'id' => $key]);
                        },
                    'update' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['institutiontype/update', 'id' => $key]);
                        },

                ]
            ],
        ],

    ]);


    ?>

  </div>
</div>
<!--<p>
        <?/*= Html::a(\Yii::$app->params['btnInstitucion'], ['create'], ['class' => 'btn btn-success']) */?>
    </p>-->