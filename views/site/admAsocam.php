<?php
use yii\helpers\Html;
use kartik\widgets\Growl;

use yii\grid\GridView;
use miloschuman\highcharts\Highmaps;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/*$this->title = 'Bienvenido ASOCAM';
$this->params['breadcrumbs'][] = $this->title;*/

// http://demos.krajee.com/widget-details/growl

/*if (!$hasProfile) {
    echo Growl::widget([
        'type' => Growl::TYPE_WARNING,
        'title' => 'Perfil de usario incompleto',
        'icon' => 'glyphicon glyphicon-exclamation-sign',
        'body' => 'Actualicelo inmediatamente',
        'showSeparator' => true,
        'delay' => 0,
        'pluginOptions' => [
            'placement' => [
                'from' => 'top',
                'align' => 'right',
            ]
        ]
    ]);


}*/
?>
<div >
<!--<div class="hidden-xs">-->
    <!--<h3><? /*= Html::encode($this->title) */ ?></h3>-->
    <div class="btn-group btn-group-justified" role="group" aria-label="...">
        <!--Panel-->
        <div class="col-xs-6 col-lg-3 col-md-3">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i style="font-size:3em;" class="glyphicon glyphicon-user"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $activeUsers; ?></div>
                            <div>Usuarios</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"><?= Html::a('Ver más..', ['user/index']) ?></span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!--END Panel-->
        <!--Panel-->
        <div class="col-xs-6 col-lg-3 col-md-3">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i style="font-size:3em;" class="glyphicon glyphicon-tasks"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $activeEvents; ?></div>
                            <div>Eventos</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"><?= Html::a('Ver más..', ['event/index']) ?></span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!--END Panel-->
        <!--Panel-->
        <div class="col-xs-6 col-lg-3 col-md-3">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i style="font-size:3em;" class="glyphicon glyphicon-pencil"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $activeInscriptions; ?></div>
                            <div>Inscripciones</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"><?= Html::a('Ver todas..', ['inscription/index']) ?></span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!--END Panel-->
        <!--Panel-->
        <div class=" col-xs-6 col-lg-3 col-md-3">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i style="font-size:3em;" class="glyphicon glyphicon-eye-open"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge"><?= $ownInscriptions; ?></div>
                            <div>Mis Inscripciones</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"><?= Html::a('Ver todas..', ['site/admuser']) ?></span>
                        <span class="pull-right"><i class="glyphicon glyphicon-circle-arrow-right"></i></span>

                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <!--END Panel-->
    </div>
</div>

<!--<div class="col-xs-12 col-lg-8 col-md-8 col-md-8">
    <div class="panel panel-green">
      <div class="panel-heading">Inscripciones activas</div>
      <br>
  <div class="panel-body">
        <div class="inscription-index">

    
    <?/*= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

//            'id',
            'exposition',
           // 'service_terms',
            'complete',
            'status',
            // 'created_at',
            // 'updated_at',
            // 'complete_logistic',
            // 'complete_eventquiz',
            // 'complete_quiz',
             'event_id',
            // 'user_id',
            // 'registertype_type',
            // 'registertype_assigment',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); */
?>
    </div>
    </div>

</div>
</div>-->

<div class="col-xs-12 col-lg-4 col-md-4 col-lg-4">

    <!-- /.panel -->
    <div class="chat-panel panel panel-green">
        <div class="panel-heading">
            <i class="fa fa-comments fa-fw"></i>
            Solicitudes por atender
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <ul class="chat">
                <?php foreach ($modelRequest as $request) { ?>
                    <li class="left clearfix">
                                    <span class="chat-img pull-left">
                                      <?= Html::img(\Yii::$app->params['webRoot'].'/'.$request->inscription->user->getImageUrl(), ['class' => 'img-circle', 'style' => 'height:50px;']); ?>
                                    </span>

                        <div class="chat-body clearfix">
                            <div class="header">
                                <strong class="green-font"><?= $request->inscription->user->username ?></strong>
                                <small class="pull-right text-muted">
                                    <i class="fa fa-clock-o fa-fw"></i> <?= Yii::$app->formatter->asDate($request->created_at, 'long'); ?>
                                </small>
                            </div>
                            <p><?= $request->question; ?></p>
                            <span class="pull-right">&nbsp;<?= Html::a('Responder', ['reply/create', 'id' => $request->id], ['class' => 'btn btn-default btn-xs']) ?></span>
                            <span class="pull-right"><?= Html::a('Cerrar', ['request/update', 'id' => $request->id], ['class' => 'btn btn-default btn-xs']) ?></span>
                        </div>
                    </li>


                   <?php
                }
                ?>


            </ul>
        </div>
        <!-- /.panel-body -->
        <div class="panel-footer">
            <div class="input-group">
 Listado de inquitudes de los participantes



            </div>
        </div>
        <!-- /.panel-footer -->
    </div>
    <!-- /.panel .chat-panel -->

</div>
<div class="col-xs-12 col-lg-8 col-md-8 col-lg-8">

    <!-- /.panel  CENTRAL-->
    <div class="chat-panel panel panel-green">
        <div class="panel-heading">
            <i class="fa fa-comments fa-fw"></i>
            Inscripciones Recientes
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                    <tr>

                        <th>#</th>
                        <th>Evento</th>
                        <th>Usuario</th>

                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    $contador = 1;
                    foreach ($modelRecentInscription as $recent) {
                        ?>
                        <tr>
                            <td><?= $contador++; ?></td>
                            <td><?= substr($recent->event->name, 0, 30) . '...'; ?></td>

                            <td><?= $recent->user->username; ?></td>
                            <!--<td> <? /*= Yii::$app->formatter->asDate($recent->created_at, 'short'); */ ?></td>-->
                            <td>

                                    <?= Html::a(' Ver', ['inscription/view','id'=>$recent->id], ['class' => 'glyphicon glyphicon-eye-open btn btn-default  btn-xs']) ?>


                            </td>
                        </tr>
                    <?php
                    }
                    ?>

                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.panel-body -->
        <div class="panel-footer">
          <?= Html::a(\Yii::$app->params['btnVisualizar'], ['inscription/index'], ['class' => 'btn btn-default btn-block btn-xs']) ?>


            <!--<a href="#" class="btn btn-default btn-block">View All Alerts</a>-->
        </div>
        <!-- /.panel-footer -->
    </div>
    <!-- /.panel .chat-panel -->

</div>


<div class="col-xs-12 col-lg-4 col-md-4 col-lg-4">

    <!-- /.panel -->
    <div class="chat-panel panel panel-green">
        <div class="panel-heading">
            <i class="fa fa-comments fa-fw"></i>
            Accesos Rápidos
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body">
            <div class="list-group">
                <?= Html::a('<i class="glyphicon glyphicon-bullhorn"></i> Foros electrónicos <i class="glyphicon glyphicon-circle-arrow-left pull-right"></i> ', ['/phforum/index'],['class'=>'list-group-item']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-user"></i> Usuarios', ['/user'],['class'=>'list-group-item']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-question-sign"></i> Preguntas Generales', ['/generalquestion'],['class'=>'list-group-item']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-star"></i> Asignaciones', ['/admin'],['class'=>'list-group-item']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Catálogo de tipos responsabilidad', ['/responsibilitytype'],['class'=>'list-group-item']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Catálogos de tipos de Institución', ['/institutiontype'],['class'=>'list-group-item']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Catálogos de tipos de Evento', ['/eventtype'],['class'=>'list-group-item']) ?>
                <?= Html::a('<i class="glyphicon glyphicon-list-alt"></i> Catálogo de tipos de registro', ['/registertype'],['class'=>'list-group-item']) ?>

            </div>
        </div>
        <!-- /.panel-body -->
        <div class="panel-footer">
            <br>
<!--                <a href="#" class="btn btn-default btn-block"></a>-->
        </div>
        <!-- /.panel-footer -->
    </div>
    <!-- /.panel .chat-panel -->

</div>
<div class="col-xs-12 col-lg-8 col-md-8 col-lg-8">

    <!-- /.panel -->
    <div class="chat-panel panel panel-green">
    <div class="panel-heading">
            <i class="fa fa-comments fa-fw"></i>
           Mapa
        </div>
        <!-- /.panel-heading -->
        <div class="panel-body" style="widht: 80%;">
            <?php

            $sql="SELECT  LOWER(c.iso) as 'hc-key', count(i.id)as 'value'
FROM inscription as i, user as u, profile as p, country as c
where i.status=1 and u.id=i.user_id and p.user_id=u.id and p.country_id=c.id
group by u.id";


            $this->registerJsFile('http://code.highcharts.com/mapdata/custom/world.js', [
                'depends' => 'miloschuman\highcharts\HighchartsAsset'
            ]);
            $db = Yii::$app->db;
            $dbdata= $db->createCommand($sql)->queryAll();

            echo Highmaps::widget([
                'options' => [
                    'title' => [
                        'text' => 'Inscripciones Generales por Pais',
                        'enabled' => false,
                    ],
                    'mapNavigation' => [
                        'enabled' => true,
                        'buttonOptions' => [
                            'verticalAlign' => 'left',
                        ]
                    ],
                    'colorAxis' => [
                        'min' => 0,
                    ],

                    'series' => [
                        [    'enabled' => true,
                            'data' => $dbdata,
                            'mapData' => new JsExpression('Highcharts.maps["custom/world"]'),
                            'joinBy' => 'hc-key',
                            'name' => '',
                            'states' => [
                                'hover' => [
                                    'color' => '#BADA55',
                                ]
                            ],
                            'dataLabels' => [
                                'enabled' => false,
                                'format' => '{point.name}',
                                'joinBy'=> ['iso-a2', 'code'],
                            ]
                        ]
                    ]
                ]
            ]);
?>
        </div>
        <!-- /.panel-body -->
        <div class="panel-footer">
            Aplica a los registros de usuario que han completado la información de perfil
        </div>
        <!-- /.panel-footer -->
    </div>
    <!-- /.panel .chat-panel -->

</div>



