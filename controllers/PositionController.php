<?php

namespace app\controllers;

use app\models\Position;
use app\models\PositionSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PositionController implements the CRUD actions for Position model.
 */
class PositionController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
{
    return array_merge(
        parent::behaviors(),
        [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // Allow only logged-in users
                    ],
                ],
                'denyCallback' => function($rule, $action) {
                    Yii::$app->session->setFlash('error', 'Please login to access this page.'); // Set flash message
                    return $this->redirect(['site/login']); // Redirect to login page
                },
            ],
        ]
    );
}


    /**
     * Lists all Position models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = '/dashb.php';

        $searchModel = new PositionSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Position model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        $this->layout = '/dashb.php';
        
        $model = Position::findOne(['slug' => $slug]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Position model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $this->layout = '/dashb.php';

        $model = new Position();        

        if ($this->request->isPost) {
            if ($model->load($this->request->post())) {                

                if ($model->save()) {
                    Yii::$app->getSession()->setFlash('success', 'Position added successfully.');
                    return $this->redirect('index');
                } else {
                    Yii::$app->getSession()->setFlash('error', 'Adding Failed.');
                }
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Position model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {        
        $this->layout = '/dashb.php';

        $model = Position::findOne(['slug' => $slug]);

        if ($this->request->isPost){
            if($model->load($this->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Candidate profile updated successfully.');
                return $this->redirect(['view', 'slug' => $model->slug]);
            }else{
                Yii::$app->getSession()->setFlash('error', 'Update Failed.');            
            }
        }else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Position model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($slug)
    {
        $model = Position::findOne(['slug' => $slug]);
        $model->delete();
        Yii::$app->getSession()->setFlash('success', 'Position deleted successfully.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Position model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Position the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Position::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
