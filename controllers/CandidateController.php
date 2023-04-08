<?php

namespace app\controllers;

use app\models\Candidate;
use app\models\CandidateSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CandidateController implements the CRUD actions for Candidate model.
 */
class CandidateController extends Controller
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
                    'denyCallback' => function ($rule, $action) {
                        Yii::$app->session->setFlash('error', 'Please login to access this page.'); // Set flash message
                        return $this->redirect(['site/login']); // Redirect to login page
                    },
                ],
            ]
        );
    }

    /**
     * Lists all Candidate models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = '/dashb.php';

        $searchModel = new CandidateSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Candidate model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($slug)
    {
        $this->layout = '/dashb.php';
        
        $model = Candidate::findOne(['slug' => $slug]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Candidate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $this->layout = '/dashb.php';

        $model = new Candidate();

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->upload() && $model->save(false)) {
                Yii::$app->getSession()->setFlash('success', 'Candidate registered successfully.');
                return $this->redirect('index');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Adding Failed.');
            }
        } else {
            $model->loadDefaultValues();
        }


        return $this->render('create', [
            'model' => $model,
        ]);
    }


    /**
     * Updates an existing Candidate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($slug)
    {
        $this->layout = '/dashb.php';

        $model = Candidate::findOne(['slug' => $slug]);

        if ($model->load(Yii::$app->request->post())) {
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
            if ($model->imageFile !== null) {
                if ($model->upload()) {
                    // image uploaded successfully, update model's image attribute
                    $model->save(false);
                } else {
                    // error uploading image
                    Yii::$app->getSession()->setFlash('error', 'Failed to upload image.');
                    return $this->refresh();
                }
            } else {
                // no image uploaded, save model without updating image attribute
                $model->save(false);
            }
            Yii::$app->getSession()->setFlash('success', 'Candidate updated successfully.');
            return $this->redirect(['view', 'slug' => $model->slug]);
        }
        

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Candidate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($slug)
    {
        $model = Candidate::findOne(['slug' => $slug]);
        $model->delete();
        Yii::$app->getSession()->setFlash('success', 'Candidate removed successfully.');

        return $this->redirect(['index']);
    }

    /**
     * Finds the Candidate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Candidate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Candidate::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
