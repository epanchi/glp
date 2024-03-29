<?php

namespace app\controllers;

use app\models\PhforumDocument;
use app\models\TopicDocument;
use Yii;
use app\models\Phforum;
use app\models\User;
use app\models\Topic;
use app\models\PhforumSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Post;
use app\models\Document;
use app\models\PostDocument;
use yii\helpers\Url;
use yii\web\UploadedFile;


/**
 * PhforumController implements the CRUD actions for Phforum model.
 */
class ForoController extends Controller
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Phforum models.
     * @return mixed
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'model' => Phforum::find()->where(['status' => self::STATUS_ACTIVE])->all(),
        ]);
    }

    public function actionTopic($id)
    {

        $modelPost = new Post();
        $modelPost->topic_id = $id;
        $modelPost->user_id = Yii::$app->user->id;

        $modelDocument = new Document;

        /*       // Verificación de parametros de envio
               $request = $_REQUEST;
               if (isset($_POST['file']))
                   $modelDocument->scenario('file');*/
        /*   if ($request->get('file') && $request->get('name') )
               $modelDocument->scenario('file');*/

        if ($modelPost->load(Yii::$app->request->post()) && $modelPost->validate() && $modelDocument->load(Yii::$app->request->post()) && $modelDocument->validate()) {

            // Post Alamacenado

            /* if (isset($_POST['file'])) {*/
            //Almacena archivos solo si se envian parametros
            $doc = UploadedFile::getInstance($modelDocument, 'file');

            $modelPost->save();
            if ($doc) {
                $docName = Yii::$app->security->generateRandomString() . time() . '.' . $doc->extension;
                $doc->saveAs(\Yii::$app->params['foroDocs'] . $docName);
                $modelDocument->file = $docName;
                $modelDocument->save();

                //Guarda relación de documentos
                $modelPostDocument = new PostDocument;
                $modelPostDocument->post_id = $modelPost->id;
                $modelPostDocument->document_id = $modelDocument->id;
                $modelPostDocument->save();
            }

            /*  }*/


            // > Envio de correo electrónico
            $html = '<h4>Contenido </h4>';
            $html .= '<blockquote>' . $modelPost->content . '</blockquote>';
            $html .= '<kbd>' . $modelPost->user->username . '</kbd>';
            $html .= '<b>' .htmlspecialchars_decode(substr( $modelPost->topic->content,0,200)).'...</b>';
            $url = \Yii::$app->params['webRoot'] . Url::to(['foro/topic', 'id' => $id]);

            $this->sendMail($id, $html, $url);
            //> Fin Correo
            \Yii::$app->getSession()
                ->setFlash('success',
                    'Su aporte ha sido publicado éxitosamente');


            // Encerar modelo
            return $this->redirect(['topic', 'id' => $id]);
            /*   $modelPost = new Post();
               $modelPost->content=NULL;*/
        }

        return $this->render('topic', [
            'model' => Topic::find()->where(['id' => $id])->one(),
            'modellatest' => Post::find()->where(['status' => self::STATUS_ACTIVE])->orderBy('created_at desc')->limit(5)->all(),
            'modelPostList' => Post::find()->where(['topic_id' => $id, 'status'=>self::STATUS_ACTIVE])->all(),
            'modelPost' => $modelPost,
            'modelDocument' => $modelDocument,
            'modelUser' => User::find()->where(['id' => Yii::$app->user->id])->one(),
        ]);
    }

    /**
     * Displays a single Phforum model.
     * @param integer $id
     * @return mixed
     */
    public
    function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
            'modelPostList' => Post::find()->where(['topic_id' => $id])->all(),
        ]);
    }

    /**
     * Creates a new Phforum model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public
    function actionCreate()
    {
        $model = new Phforum();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Phforum model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public
    function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Phforum model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public
    function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Phforum model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Phforum the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = Phforum::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public
    function actionList()
    {
        return $this->render('list');
    }

    public
    function actionMultimedia()
    {
        return $this->render('multimedia');
    }

    public
    function actionMensajes()
    {
        return $this->render('mensajes');
    }

    public
    function actionTopicfinal()
    {
        return $this->render('topicFinal');
    }

    /*
    * Función para envio de correos electrónicos a todos los participantes que están participando en el tópico
    */
    protected function sendMail($topic_id, $message, $url)
    {
        $modelTopic = Topic::find()->where(['id'=>$topic_id])->one();


        $title = "Nuevo mensaje";
        $content = $message;


        $modelPost = User::find()->where(['status'=>User::STATUS_ACTIVE])->all();
        foreach ($modelPost as $user) {
            // Contenido, tipo  1=Notificacion URL
            if ($user->notification == User::EMAIL_DAILY)
                $user->sendEmail($content, $url, $title);
        }
        //$modelPost = Post::find()->where(['topic_id' => $topic_id])->addGroupBy(['user_id'])->all();
        /*        foreach ($modelPost as $user) {
            // Contenido, tipo  1=Notificacion URL
            if ($user->user->notification == User::EMAIL_DAILY)
                $user->user->sendEmail($content, $url, $title);
        }*/
    }

    public function actionResumen()
    {
        $title = 'Resumen de Diario de Aportes Foro electrónico';
        $content = 'Resumen foro';

        //Armado de contenidos
        $modelForo = Phforum::find()->where(['status' => Phforum::STATUS_ACTIVE])->all();
        /*
                $curr_date = date('Y-m-d H:m:s');
                echo( $curr_date);

                $modelPost=Post::find()->where(['date("Y-m-d H:m:s")< created_at'])->all();
                print_r($modelPost);*/


        $url = \Yii::$app->params['webRoot'] . Url::to(['foro/']);

        $enviarMail = true;
        foreach ($modelForo as $foro) {
            $arr = array();
            $mensaje = '';
            $mensaje .= '<h1>FORO:' . $foro->name . '</h1>';

            $counTopic = 1;
            $modelTopic = Topic::find()->where(['status' => Topic::STATUS_ACTIVE])->all();
            foreach ($modelTopic as $topic) {

                //Arreglo de busqueda para unificar usuarios por foro
                array_push($arr, $topic->id);

                $mensaje .= '<h3>TEMA :' . $counTopic++ . '</h3>';
                $mensaje .= '<p>' . $topic->content . '</p>';
                $mensaje .= '<h5> Aportes del día :</h5>';
                $numPost = 1;

                $modelPost = Post::find()->where(['topic_id' => $topic->id])->all();
                if (!$modelPost)
                    $mensaje .= '<p>No existen post</p>';

                foreach ($modelPost as $post) {

                    if (($post->status == Post::STATUS_ACTIVE) && (     date('Y-m-d', strtotime($post->created_at)) == date("Y-m-d"))) {
                        $mensaje .= '<p style="padding-left: 10px;"><b>' . $numPost++ . ': </b>' . $post->content . '</p>';
                        // Condición única para el envio de información del mensaje
                        $enviarMail = true;
                    }

                }

            }
            $mensaje .= '<hr>';
            echo $mensaje;
            if ($enviarMail) {

                foreach (\app\models\Post::find()->where(['topic_id' => $arr])->addGroupBy(['user_id'])->all() as $post):
                    if ($post->user->notification == User::EMAIL_RESUME)
                        $post->user->sendEmail($mensaje, $url, $title);

                endforeach;
            }
        }
        unset($arr);


    }
    /*
     * Martes 9 de Junio
     * Función para despliegue de documentos relacionados
     */
    public function actionDocuments($id){
        // Carga de foro enviado

        if (($model = Phforum::findOne($id)) !== null) {
            // Listado de todos los documentos del foro
            $modelForoDocs=PhforumDocument::find()->where(['phforum_id'=>$id])->all();

            // Listado de todos los Topicos
            $modelTopic=Topic::find()->where(['phforum_id'=>$id])->all();

            // Barrido de todos los ID's del modelo
            $arr = array();
            foreach ($modelTopic as $topic){
                array_push($arr, $topic->id);
            }
            $modelTopicDocs=TopicDocument::find()->where(['topic_id'=>$arr])->all();


            $modelPost=Post::find()->where(['topic_id'=>$arr])->all();
            $arrPost = array();
            foreach ($modelPost as $post){
                array_push($arrPost, $post->id);
            }
            $modelPostDocs=PostDocument::find()->where(['post_id'=>$arrPost])->all();

            unset($arr);
            unset($arrPost);
            return $this->render('documents',
                [
                    'modelForoDocs'=>$modelForoDocs,
                    'modelTopicDocs'=>$modelTopicDocs,
                    'modelPostDocs'=>$modelPostDocs
                ]
            );

        } else {
            throw new NotFoundHttpException('La página solicitada no éxiste');
        }


    }




}
