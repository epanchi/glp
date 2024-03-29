<?php
use kartik\mpdf\Pdf;
$params = require(__DIR__ . '/params.php');

$config = [
    'id' => 'basic',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log'],
    'language' => 'es',
    'sourceLanguage' => 'es',
    'components' => [
        'request' => [
            'baseUrl' => $baseUrl,
        ],

        'pdf' => [
            'class' => Pdf::classname(),
            'format' => Pdf::FORMAT_A4,
            'orientation' => Pdf::ORIENT_PORTRAIT,
            'destination' => Pdf::DEST_BROWSER,
            // refer settings section for all configuration options
        ],
/*        'excel'=>[
            'class'=>'yii\phpoffice\PHPExcel',
        ],*/
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => 'MmLEHt6GjDarlWZqosTfd6qQsFwkKFqu',
        ],
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'user' => [
            'identityClass' => 'app\models\User',
            'enableAutoLogin' => true,
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            // send all mails to a file by default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => false,
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'db' => require(__DIR__ . '/db.php'),
       'urlManager'=>[

           'enablePrettyUrl' => true,
           'showScriptName' => false,
           'rules'=>[
               '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                                               '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                   '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',

],


        ],
        'authManager'=>[
            'class'=>'yii\rbac\DbManager',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'useFileTransport'=>false,
            'viewPath' => '@app/mail',


        ],
    ],
    #Acceso url para los modulos de roles y perfiles configurados
    'modules'=>[
        'admin'=>[
            'class'=>'mdm\admin\Module',
        ],
        'gridview' =>  [
            'class' => '\kartik\grid\Module'
        ]
    ],
    #Acceso publico sin control de login desde la aplicación, en este ejemplo site es de acceso publico permitido

   /* 'as access'=>[
        'class'=>'mdm\admin\components\AccessControl',
        'allowActions'=>[
            'site/*',
        ]
    ],*/
    'params' => $params,
];

if (YII_ENV_DEV) {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = 'yii\debug\Module';

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = 'yii\gii\Module';
}

return $config;
