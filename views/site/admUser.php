<?php
use yii\helpers\Html;
use kartik\widgets\Growl;
use yii\grid\GridView;

/* @var $this yii\web\View */
$this->title = 'Panel de control de usuario';
$this->params['breadcrumbs'][] = $this->title;

// http://demos.krajee.com/widget-details/growl

if (!$hasProfile) {
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


}
?>
<div class="site-about">
    <h3><?= Html::encode($this->title) ?></h3>



    <?= Html::a('Actualizar datos de Perfil', ['/profile/createown'], ['class' => 'btn btn-success']) ?>
    <?= Html::a('Inscripción', ['/inscription/createown'], ['class' => 'btn btn-success']) ?>
    <div class="row">

        <div class="col-lg-4">
            <nav>
                <ul class="pager">
                    <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Anterior</a></li>
                    <li class="next"><a href="#">Siguiente <span aria-hidden="true">&rarr;</span></a></li>
                </ul>
            </nav>
            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">


                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                fugiat nulla pariatur.</p>
                        <address>
                            <strong>Twitter, Inc.</strong><br>
                            795 Folsom Ave, Suite 600<br>
                            San Francisco, CA 94107<br>
                            <abbr title="Phone">P:</abbr> (123) 456-7890
                        </address>

                    </div>
                    <div class="item">

                        <div class="carousel-caption">
                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                                fugiat nulla pariatur.</p>
                        </div>
                    </div>
                   CONTROLES
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
            <h2>Gestión De proyectos </h2>




            <address>
                <strong>Twitter, Inc.</strong><br>
                795 Folsom Ave, Suite 600<br>
                San Francisco, CA 94107<br>
                <abbr title="Phone">P:</abbr> (123) 456-7890
            </address>
            <p><a class="btn btn-default" href="Evento">Inscribirme</a></p>
        </div>
        <div class="col-lg-8">
            <h2>Mis inscripciones</h2>

            <p>componente</p>
            <?= GridView::widget([
                'dataProvider' => $dataInscription,
                'filterModel' => $searchInscription,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'event_id',
                        'value' => function ($data) {
                            return $data->event->name;
                        }
                    ],
//            'id',
                    //'exposition',
                    //  'service_terms',
                    'complete',
                    'status',
                    // 'created_at',
                    // 'updated_at',
                    // 'complete_logistic',
                    // 'complete_eventquiz',
                    // 'complete_quiz',
                    // 'event_id',
                    // 'user_id',

                    // 'registertype_type',
                    // 'registertype_assigment',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        </div>
        <!--        <div class="col-lg-4">
                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2>Heading</h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                fugiat nulla pariatur.</p>

            <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
        </div>-->
    </div>


    <p>
        This is the About page. You may modify the following file to customize its content:
    </p>

    <code><?= __FILE__ ?></code>
</div>


