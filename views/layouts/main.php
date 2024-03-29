<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;


/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
// Botón HOME todos tiene el botón


// Botones solo para usuarios que no están logeados todavia

if (Yii::$app->user->isGuest) {
    /*$items[] = ['label' => '<span class="glyphicon glyphicon-user"></span> Registro', 'url' => ['/site/signup'], 'visible' => [Yii::$app->user->isGuest], 'class' => 'btn btn-success btn-md'];*/
    $items[] = ['label' => 'Ingresar', 'url' => ['/site/login'], 'visible' => [Yii::$app->user->isGuest], 'class' => 'btn'];
} else {
    $items[] = ['label' => 'Eventos', 'url' => ['/site/index'], 'class' => 'btn btn-xs'];
}
$items[] = ['label' => ' Foro', 'url' => ['/foro']];
// Botones para usuario ASOCAM
if (Yii::$app->user->can('permission_admin')) {
    $items[] = ['label' => '<span class="glyphicon glyphicon-cog"></span>Foro', 'items' => [
        ['label' => 'Foros', 'url' => ['/phforum']],
        ['label' => 'Documentos', 'url' => ['/phforum-document']],
        ['label' => 'Videos', 'url' => ['/phforum-video']],
        ['label' => 'Imagen', 'url' => ['/phforum-imagen']],
        '<li class="divider"></li>',
        ['label' => 'Temas', 'url' => ['/topic']],
        ['label' => 'Documentos', 'url' => ['/topic-document']],
        ['label' => 'Videos', 'url' => ['/topic-video']],
        ['label' => 'Imagen', 'url' => ['/topic-imagen']],

        '<li class="divider"></li>',
        ['label' => 'Aportes', 'url' => ['/post']],
        ['label' => 'Documentos', 'url' => ['/post-document']],
        ['label' => 'Videos', 'url' => ['/post-video']],
        ['label' => 'Imagen', 'url' => ['/post-imagen']],

        '<li class="divider"></li>',
        ['label' => 'Comentarios', 'url' => ['/comment']],
        '<li class="divider"></li>',
        ['label' => 'Documentos', 'url' => ['/document']],
        ['label' => 'Video', 'url' => ['/video']],
        ['label' => 'Imagen', 'url' => ['/imagen']],
    ]
    ];
    $items[] = ['label' => '<span class="glyphicon glyphicon-cog"></span>Evento', 'items' => [
        ['label' => 'Eventos', 'url' => ['/event']],
        ['label' => 'Respuesta', 'url' => ['/answer']],
        ['label' => 'Respuesta por evento', 'url' => ['/eventanswer']],
        ['label' => 'Pregunta por evento', 'url' => ['/eventquestion']],
        ['label' => 'Pregunta General', 'url' => ['/generalquestion']],
    ]];

    $items[] =

        ['label' => 'Notificaciones', 'items' => [
            ['label' => 'Solicitudes', 'url' => ['/request']],
            ['label' => 'Respuestas', 'url' => ['/reply']],
            ['label' => 'Notificaciones', 'url' => ['/notification']],

        ]
        ];
    $items[] = ['label' => 'Inscripción', 'url' => ['/inscription']];

    $items[] = ['label' => 'Catálogos', 'items' => [
        ['label' => 'Responsabilidad', 'url' => ['/responsibilitytype']],
        ['label' => 'Institución', 'url' => ['/institutiontype']],
        '<li class="divider"></li>',
        ['label' => 'Pais', 'url' => ['/country']],
        ['label' => 'Tipos Eventos', 'url' => ['/eventtype']],
        ['label' => 'Tipo de Registro', 'url' => ['/registertype']],
        '<li class="divider"></li>',
//            ['label' => 'Preguntas', 'url' => ['/question']],
        ['label' => 'Pregunta General', 'url' => ['/generalquestion']],
    ]
    ];

    if (Yii::$app->user->can('permission_admin'))
        $items[] = ['label' => 'Roles', 'items' => [
            ['label' => 'Asignaciones', 'url' => ['/admin']],
            ['label' => 'Roles', 'url' => ['/admin/role']],
            ['label' => 'Permisos', 'url' => ['/admin/permission']],

        ]
        ];

}
// Botones Foro
if (Yii::$app->user->can('asocam')) {
/*
    $items[] = ['label' => '<span class="glyphicon glyphicon-cog"></span>Foro', 'items' => [
        ['label' => 'Foros', 'url' => ['/phforum']],
        ['label' => 'Documentos', 'url' => ['/phforum-document']],
        ['label' => 'Videos', 'url' => ['/phforum-video']],
        ['label' => 'Imagen', 'url' => ['/phforum-imagen']],
        '<li class="divider"></li>',
        ['label' => 'Temas', 'url' => ['/topic']],
        ['label' => 'Documentos', 'url' => ['/topic-document']],
        ['label' => 'Videos', 'url' => ['/topic-video']],
        ['label' => 'Imagen', 'url' => ['/topic-imagen']],

        '<li class="divider"></li>',
        ['label' => 'Aportes', 'url' => ['/post']],
        ['label' => 'Documentos', 'url' => ['/post-document']],
        ['label' => 'Videos', 'url' => ['/post-video']],
        ['label' => 'Imagen', 'url' => ['/post-imagen']],

        '<li class="divider"></li>',
        ['label' => 'Comentarios', 'url' => ['/comment']],
        '<li class="divider"></li>',
        ['label' => 'Documentos', 'url' => ['/document']],
        ['label' => 'Video', 'url' => ['/video']],
        ['label' => 'Imagen', 'url' => ['/imagen']],
    ]
    ];*/

}

//Menu de Usuario
if (!Yii::$app->user->isGuest) {
    $items[] = ['label' => '<span class="glyphicon glyphicon-user"></span> ' . Yii::$app->user->identity->username, 'items' => [
        ['label' => ' Actualizar Perfil', 'url' => ['/profile/createown']],
        ['label' => 'Actualización de Contraseña', 'url' => ['/user/password']],
        ['label' => 'Actualización de Correo', 'url' => ['/user/email']],
        '<li class="divider"></li>',
        ['label' => 'Salir', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
    ]];
}
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <link href='http://fonts.googleapis.com/css?family=Lato&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
</head>
<body>
<script>
    window.fbAsyncInit = function() {
        FB.init({
            appId      : '1043186472377916',
            xfbml      : true,
            version    : 'v2.3'
        });
    };

    (function(d, s, id){
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {return;}
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>


<?php $this->beginBody() ?>



<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => '<span class="glyphicon glyphicon-globe" aria-hidden="true"></span> ASOCAM: Plataforma Tecnológica',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top nav-pills',
        ],
    ]);
    ?>

    <?php
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'encodeLabels' => false,
        'items' => $items,
    ]);
    ?>

    <?php NavBar::end(); ?>
    <div class="container">
        <?=
        Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>

    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="col-xs-2 col-sm-2 col-md-2 col-lg-1">
            <a href="http://www.asocam.org"
               target="_blank"> <?= Html::img(Yii::$app->urlManager->baseUrl.'/'.'imgs/logos/asocam.png', ['class' => 'img_footer']); ?></a>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10 col-lg-11">
            <p style="text-align:justify">ASOCAM es el Servicio de Gestión del Conocimiento para América Latina que
                apoya procesos de construcción colectiva de conocimientos, que permite compartir y avanzar en temas
                específicos, generando productos de alta calidad y utilidad para los actores de desarrollo.</p>

            <p>Desarrollado por <a href="http://www.cladian.com" target="_blank">Cladian Digital</a> &
                ASOCAM <?php echo date("Y"); ?>  </p>

        </div>
    </div>
</footer>

<?php $this->endBody() ?>
<!-- Seguimiento Analitics-->
<script>
    (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
    })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

    ga('create', 'UA-49948483-16', 'auto');
    ga('send', 'pageview');

</script>
</body>
</html>
<?php $this->endPage() ?>
