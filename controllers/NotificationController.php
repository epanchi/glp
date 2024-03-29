<?php

namespace app\controllers;

use app\models\Phforum;
use Yii;
use app\models\Notification;
use app\models\NotificationSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\helpers\Url;
use app\models\User;

/**
 * NotificationController implements the CRUD actions for Notification model.
 */
class NotificationController extends Controller
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create', 'send','foro'],
                //'only' => ['index', 'view', 'create','update','delete'],
                // 'only' => ['login', 'logout', 'signup','event','admuser'],
                'rules' => [
                    [
                        'actions' => ['create','send','foro'],
                        'allow' => true,
                        'roles' => ['asocam','sysadmin'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * Lists all Notification models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new NotificationSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Notification model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Notification model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Notification();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /*
     * Notificaciones para Foro
     */
    public function actionForo($id)
    {
        $model = new Notification();
        $modelForo = Phforum::find()->where(['id'=>$id])->one();
        $model->user_id= Yii::$app->user->identity->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            \Yii::$app->getSession()->setFlash('success', 'La notificación ha sido enviada con éxito');
            // Envio de notificación electrónica
            //$url = \Yii::$app->params['webRoot'] . Url::to(['foro/'])."/".$id;
            $url = \Yii::$app->params['webRoot'] . Url::to(['foro/']);
            $title = 'Notificación electrónica';
            $html = $model->text;
            $html .=" <hr>";

            $html .="<a href=". $url. "> ".$modelForo->name."</a> <br/>";
            $html .="<b>".Yii::$app->user->identity->username."</b>";


            $this->sendMail($id, $html, $url, $title);

            return $this->redirect(['/phforum/view', 'id' => $id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'id'=>$id
            ]);
        }
    }

    /**
     * Updates an existing Notification model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
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
     * Deletes an existing Notification model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Notification model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Notification the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Notification::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    /*
     * Función para notificación electrónica desde el foro
     */
    protected function sendMail($id, $message, $url, $title)
    {
        $content = $message;
        foreach (\app\models\User::find()->where(['status'=>User::STATUS_ACTIVE])->all() as $post):
            if ($post->notification == User::EMAIL_DAILY)
                $post->sendEmail($content, $url, $title);

        endforeach;
    }
}
