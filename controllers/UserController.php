<?php

namespace app\controllers;

use Yii;
use app\models\User;
use app\models\Profile;
use app\modelsUserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * UserController implements the CRUD actions for User model.
 */

class UserController extends Controller
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 2;

    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index', 'view', 'create','update','delete','sendmail','email','password'],
                // 'only' => ['login', 'logout', 'signup','event','admuser'],
                'rules' => [
                    [
                        'actions' => ['index','view','create','update','delete','email','password'],
                        'allow' => true,
                        'roles' => ['asocam','sysadmin'],
                    ],
                    [
                        'actions' => ['sendmail','email','password'],
                        'allow' => true,
                        'roles' => ['user','asocam'],
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new modelsUserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    // Retorno de info para Grid Administrador
    public function actionProfile()
    {
        if (isset($_POST['expandRowKey'])) {

            $userId = Yii::$app->request->post('expandRowKey');
            $modelProfile = \app\models\Profile::find()
                ->where(['user_id' => $userId])
                ->one();
            if ($modelProfile){
                return $this->renderPartial('_profile', [

                    'modelProfile' => $modelProfile
                ]);
            }
            else
            {
                return '<div class="alert alert-danger">No tiene perfil</div>';
            }


      /*      $modelLogistic = Logistic::find()
                ->where(['inscription_id' => $inscriptionId])
                ->one();

            $modelProfile = Profile::find()
                ->where(['user_id' => $modelLogistic->inscription->user_id])
                ->one();

            return $this->renderPartial('_detail', [
                'modelLogistic' => $modelLogistic,
                'modelProfile' => $modelProfile
            ]);*/
        } else {
            return '<div class="alert alert-danger">No data found</div>';
        }
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    public function actionEmail()
    {   $id=Yii::$app->user->identity->id;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
           // return $this->redirect(['site/index']);
            return $this->redirect(['/foro']);
            //return $this->redirect(Yii::$app->request->referrer);
           // return $this->goBack();

        } else {
            return $this->render('email', [
                'model' => $model,
            ]);
        }
    }

    public function actionPassword()
    {   $id=Yii::$app->user->identity->id;
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) ) {

            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            $model->save();
            return $this->redirect(['site/index', 'id' => $model->id]);
        } else {
            return $this->render('password', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }


}
