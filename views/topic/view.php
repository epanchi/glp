<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\models\Topic */

$this->title = 'Actualización Topico';
//$this->params['breadcrumbs'][] = ['label' => 'Topics', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;

?>
<div class="breadcrumb">

    <?= Html::a(\Yii::$app->params['btnRegresar'] . ' al Foro', ['/phforum/view', 'id' => $model->phforum_id], ['class' => 'btn btn-default']) ?>
    <?= Html::a(\Yii::$app->params['btnActualizar'], ['update', 'id' => $model->id], ['class' => 'btn btn-success']) ?>
    <?= Html::a('<span class="glyphicon glyphicon-upload"></span>Subir Documento', ['topic/createdoc', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('<span class="glyphicon glyphicon-upload"></span>Subir Imagen', ['topic/createimg', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
<!--    --><?//= Html::a('<span class="glyphicon glyphicon-upload"></span>Subir Video', ['topic/createvideo', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>

    <?= Html::a(\Yii::$app->params['btnRegresarTopic'], ['/foro/topic', 'id' => $model->id], ['class' => 'btn btn-default pull-right']) ?>

    <!--        --><?/*= Html::a('Eliminar', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) */
    ?>

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

<div class="tabs-x align-center tabs-above tab-bordered">
    <ul class="nav nav-tabs">
        <li class="active"><a href="#one2" data-toggle="tab">Información del Tema</a></li>
        <li><a href="#two2" data-toggle="tab">Aportes</a></li>
        <li><a href="#three2" data-toggle="tab">Documento</a></li>
        <li><a href="#four2" data-toggle="tab">Imagen</a></li>
<!--        <li><a href="#five2" data-toggle="tab">Video</a></li>-->
    </ul>
    <div class="tab-content">
        <div class="tab-pane active" id="one2">
            <br/>

            <div class="panel panel-green">
                <div class="panel-heading">Tema:</div>
                <div class="panel-body">
                    <div class="topic-view">

                        <!--                    <h1>--><? //= Html::encode($this->title) ?><!--</h1>-->
                        <br/>

                        <p>


                        </p>

                        <?= DetailView::widget([
                            'model' => $model,
                            'attributes' => [
//            'id',
                                //            'phforum_id',
                                [                    // the owner name of the model
                                    'label' => 'Foro',
                                    'value' => $model->phforum->name,
                                ],
                                'content:html',


                                //            'user_id',
                                [                    // the owner name of the model
                                    'label' => 'Usuario',
                                    'value' => $model->user->username,
                                ],

                                'created_at',
//            'status',
//            'updated_at',

                            ],
                        ]) ?>

                    </div>


                    <!--        --><? //= Html::a('Crear Aporte', ['post/create', 'id' => $model->id ], ['class' => 'btn btn-primary']) ?>
                </div>
            </div>
        </div>
        <div class="tab-pane" id="two2">
            <div class="post-index">
                <br/>
                <div class="panel panel-green">
                    <div class="panel-heading">Aportes:</div>
                    <div class="panel-body">

                <?= GridView::widget([
                    'dataProvider' => $dataProviderPost,
//                        'filterModel' => $searchPost,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],
//            'id',
                        'content:ntext',
//            'created_at',
//            'updated_at',
//                            'status',
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
                        // 'topic_id',
                        // 'user_id',

//                            ['class' => 'yii\grid\ActionColumn'],
                        ['class' => 'yii\grid\ActionColumn',
                            'template' => ' {update}',
                            'buttons' => [
//                                'view' => function ($url, $model, $key) {
//                                    return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['post/view', 'id' => $key]);
//                                },
                                'update' => function ($url, $model, $key) {
                                    return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['post/update', 'id' => $key]);
                                },
                            ]
                        ],
                    ],
                ]); ?>

            </div>
        </div>
        </div>
        </div>
        <div class="tab-pane" id="three2">

            <br/>
            <div class="panel panel-green">
                <div class="panel-heading">Documentos:</div>
                <div class="panel-body">
            <div class="topic-document-index">


                <?= GridView::widget([
                    'dataProvider' => $dataProviderPostDocument,
//                        'filterModel' => $searchTopicDocument,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//                        'topic_id',
//                        [
//                            'attribute' => 'topic_id',
//                            'value' => function ($data) {
//                                    return $data->topic->content;
//                                }
//                        ],
//                        'document_id',
                        [
                            'attribute' => 'document_id',
                            'value' => function ($data) {
                                    return $data->document->name;
                                }
                        ],
                        'created_at',
                        'updated_at',

//                        ['class' => 'yii\grid\ActionColumn'],
                        ['class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'buttons' => [
//                            'view' => function ($url, $model) {
//                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['phforum-imagen/view', 'phforum_id' => $model->phforum_id, 'imagen_id' => $model->imagen_id]);
//                            },
//                                   'update' => function ($url, $model) {
//                                           return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['phforum-document/update', 'phforum_id' => $model->phforum_id, 'document_id' => $model->document_id]);
//                                        },

                                'delete' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['topic-document/delete' ,'topic_id' => $model->topic_id, 'document_id' => $model->document_id]);
                                    },

                            ]
                        ],
                    ],
                ]); ?>

            </div>
            </div>
            </div>


        </div>
        <div class="tab-pane" id="four2">
            <br/>
            <div class="topic-imagen-index">

                <div class="panel panel-green">
                    <div class="panel-heading">Imagenes:</div>
                    <div class="panel-body">
                <?= GridView::widget([
                    'dataProvider' => $dataProviderTopicImagen,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

//                        'topic_id',
//                        'imagen_id',
                        [
                            'label' => 'Imagenes',
                            'format' => 'raw',

                            'value' => function ($data) {
                                    $url = \Yii::$app->params['foroImgs'] . $data->imagen->file;
                                    return Html::img($url, ['class' => 'thumbnail', 'style' => 'height:100px;']);
                                }
                        ],
                        'created_at',
                        'updated_at',

//                        ['class' => 'yii\grid\ActionColumn'],
                        ['class' => 'yii\grid\ActionColumn',
                            'template' => '{delete}',
                            'buttons' => [
//                            'view' => function ($url, $model) {
//                                return Html::a('<span class="glyphicon glyphicon-eye-open"></span>', ['phforum-imagen/view', 'phforum_id' => $model->phforum_id, 'imagen_id' => $model->imagen_id]);
//                            },
//                                   'update' => function ($url, $model) {
//                                           return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['phforum-document/update', 'phforum_id' => $model->phforum_id, 'document_id' => $model->document_id]);
//                                        },

                                'delete' => function ($url, $model) {
                                        return Html::a('<span class="glyphicon glyphicon-trash"></span>', ['topic-imagen/delete' ,'topic_id' => $model->topic_id, 'imagen_id' => $model->imagen_id]);
                                    },

                            ]
                        ],
                    ],
                ]); ?>

            </div>
            </div>
            </div>
        </div>

        <div class="tab-pane" id="five2">
            <br/>
            <div class="topic-video-index">
                <div class="panel panel-green">
                    <div class="panel-heading">Videos:</div>
                    <div class="panel-body">

                <?= GridView::widget([
                    'dataProvider' => $dataProviderTopicVideo,
//                        'filterModel' => $searchTopicVideo,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'topic_id',
                        'video_id',
                        'created_at',
                        'updated_at',

//                        ['class' => 'yii\grid\ActionColumn'],
                    ],
                ]); ?>

            </div>
            </div>
            </div>


        </div>

    </div>
</div>

