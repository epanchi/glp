<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\Inscription */

$this->title = $model->id;
/*$this->params['breadcrumbs'][] = ['label' => 'Inscripciones', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;*/
?>

<div class="breadcrumb">
    <?= Html::a(\Yii::$app->params['btnCancel'], ['/site/index'], ['class' => 'btn btn-danger']) ?>

    <?= Html::a(\Yii::$app->params['btnInscriptionS1'], ['updateown', 'id' => $model->id], ['class' => 'btn btn btn-primary']) ?>
    <?= Html::a(\Yii::$app->params['btnInscriptionS2'], ['eventanswer', 'id' => $model->id], ['class' => 'btn btn btn-success']) ?>
    <?= Html::a(\Yii::$app->params['btnInscriptionS3'], ['answer', 'id' => $model->id], ['class' => 'btn btn btn-success']) ?>
    <?= Html::a(\Yii::$app->params['btnNuevaInquietud'], ['request/createown', 'inscription_id' => $model->id], ['class' => 'btn btn-info']) ?>
    <!-- AYUDA-->


<!--    --><?php
//    Modal::begin([
//        'header' => '<h4>Inscripción</h3>',
//        'toggleButton' => ['label' => \Yii::$app->params['btnHelp'],'class'=>'btn btn-default pull-right'],
//    ]);
//
//    echo $this->render('/help/inscription-index');
//    Modal::end();
//    ?>


</div>

<?php
foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
    //echo '<div class="alert alert-' . $key . '">' . $message . '</div>';
    echo '<div class="alert alert-' . $key . '" role="alert">
                  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                  ' . $message . '
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
             </div>';
}
?>

<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
    <!--Visualización información del evento-->

    <div class="panel panel-primary">
        <?= $this->render('/event/_detailinfo', ['model' => $model->event]) ?>
        <div class="panel-footer">

            <!--  <?= Html::a(\Yii::$app->params['btnRegresar'], ['/site/index'], ['class' => 'btn btn-default']) ?> -->
                <span class="pull-right">

               

                </span>
        </div>
    </div>

    <!--END Visualización evento-->

</div>


<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">


    <div class="panel-group" id="accordion" role="tablist">

        <div class="panel panel-primary">
            <div class="panel-heading" role="tab" id="headingOne">
                <h5 class="panel-title">

                    <span class="glyphicon glyphicon-file" aria-hidden="true"></span>
                    <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne" aria-expanded="true"
                       aria-controls="collapseOne">
                        Información de Inscripción <span class="pull-right"><?= $model->complete; ?>%</span>
                    </a>
                </h5>
            </div>
            <div id="collapseOne" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne">
                <div class="panel-body">
                    <?= $this->render('_partialInscription', ['model' => $model, 'modelProfile' => $modelProfile]) ?>
                </div>

            </div>
        </div>

        <div class="panel panel-primary">
            <div class="panel-heading" role="tab" id="headingTwo" aria-multiselectable="true">
                <h4 class="panel-title">
                    <span class="glyphicon glyphicon-plane" aria-hidden="true"></span>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"
                       aria-expanded="true" aria-controls="collapseTwo">
                        Información logística
                    </a>
                </h4>
            </div>
            <div id="collapseTwo" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingTwo">
                <div class="panel-body">
                    <?= $this->render('_partialLogistic', ['model' => $modelLogistic]) ?>

                </div>

            </div>
        </div>


        <!--        <div class="panel panel-primary">
            <div class="panel-heading" role="tab" id="headingThree">
                <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseThree"
                       aria-expanded="false" aria-controls="collapseThree">
                        Respuestas por evento
                    </a>
                </h4>
            </div>
            <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
                <div class="panel-body">
                    <? /*= $this->render('_partialEventanswerown', ['searchModel' => $searchModelEventanswer, 'dataProvider' => $dataProviderEventanswer]); */ ?>
                </div>
            </div>
        </div>-->


        <!--        <div class="panel panel-primary">
            <div class="panel-heading" role="tab" id="heading4">
                <h4 class="panel-title">
                    <span class="glyphicon glyphicon-list" aria-hidden="true"></span>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse4"
                       aria-expanded="false" aria-controls="collapse4">
                        Respuestas a preguntas generales
                    </a>
                </h4>
            </div>
            <div id="collapse4" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading4">
                <div class="panel-body">
                    <? /*= $this->render('_partialAnswerown', ['searchModel' => $searchModelAnswer, 'dataProvider' => $dataProviderAnswer]); */ ?>
                </div>
            </div>
        </div>-->


        <div class="panel panel-success">
            <div class="panel-heading" role="tab" id="heading5">
                <h4 class="panel-title">
                    <span class="glyphicon glyphicon-comment" aria-hidden="true"></span>
                    <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse5"
                       aria-expanded="false" aria-controls="collapse5">
                        Notificaciones / Solicitudes
                    </a>
                </h4>
            </div>
            <div id="collapse5" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading5">
                <div class="panel-body">
                    <?= $this->render('_partialRequest', ['searchModel' => $searchModelRequest, 'dataProvider' => $dataProviderRequest]); ?>
                    <?= Html::a(\Yii::$app->params['btnEnviar'], ['request/createown', 'inscription_id' => $model->id], ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>


    </div>
</div>

<!--ENDRegistro-->
