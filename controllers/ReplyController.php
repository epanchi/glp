<?php

namespace app\controllers;

use Yii;
use app\models\Reply;
use app\models\ReplySearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ReplyController implements the CRUD actions for Reply model.
 */
class ReplyController extends Controller
{
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
     * Lists all Reply models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReplySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Reply model.
     * @param integer $user_id
     * @param integer $request_id
     * @return mixed
     */
    public function actionView($user_id, $request_id)
    {
        return $this->render('view', [
            'model' => $this->findModel($user_id, $request_id),
        ]);
    }

    /**
     * Creates a new Reply model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Reply();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'request_id' => $model->request_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Reply model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $user_id
     * @param integer $request_id
     * @return mixed
     */
    public function actionUpdate($user_id, $request_id)
    {
        $model = $this->findModel($user_id, $request_id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'user_id' => $model->user_id, 'request_id' => $model->request_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Reply model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $user_id
     * @param integer $request_id
     * @return mixed
     */
    public function actionDelete($user_id, $request_id)
    {
        $this->findModel($user_id, $request_id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Reply model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $user_id
     * @param integer $request_id
     * @return Reply the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($user_id, $request_id)
    {
        if (($model = Reply::findOne(['user_id' => $user_id, 'request_id' => $request_id])) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}