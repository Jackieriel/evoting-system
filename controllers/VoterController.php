<?php

namespace app\controllers;

use app\models\User;
use app\models\Voter;
use app\models\VoterSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VoterController implements the CRUD actions for Voter model.
 */
class VoterController extends Controller
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
     * Lists all Voter models.
     *
     * @return string
     */

    public function actionIndex()
    {
        $this->layout = '/dashb.php';

        $searchModel = new VoterSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        // Filter the data provider to only show voters
        $dataProvider->query->andWhere(['user_type' => 'voter']);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Voter model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($username)
    {
        $this->layout = '/dashb.php';

        $model = Voter::findOne(['username' => $username]);

        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Voter model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $this->layout = '/dashb.php';

        $request = Yii::$app->request->post();

        $model = new User();
        $model->attributes = $request;
        $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password); //Hash password before storing to DB
        $model->auth_key = Yii::$app->security->generateRandomString(); //Generate auth key
        $model->otp = Yii::$app->security->generateRandomString(6, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'); // add this line to generate a random six-digit token
        $session = Yii::$app->session;

        if ($model->validate() && $model->save()) {
            $session->setFlash('successMessage', 'Voter added successful');
            return $this->redirect('index');
        } else {
            $session->setFlash('errorMessages', $model->getErrors());
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Voter model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($username)
    {
        $this->layout = '/dashb.php';

        $model = Voter::findOne(['username' => $username]);

        // if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
        //     return $this->redirect(['view', 'username' => $model->username]);
        // }
        // var_dump($model);
        // return $this->render('update', [
        //     'model' => $model,
        // ]);

        // from her

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->getSession()->setFlash('success', 'Voter profile updated successfully.');
                // return $this->redirect(['view', 'slug' => $model->slug]);
                return $this->redirect(['view', 'username' => $model->username]);
            } else {
                Yii::$app->getSession()->setFlash('error', 'Update Failed.');
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Voter model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */

    public function actionDelete($username)
    {
        $this->layout = '/dashb.php';

        $model = Voter::findOne(['username' => $username]);

        if ($model !== null) {
            $model->delete();
            Yii::$app->session->setFlash('success', 'The voter has been successfully removed.');
        } else {
            Yii::$app->session->setFlash('error', 'The voter could not be found.');
        }

        return $this->redirect(['index']);
    }


    /**
     * Finds the Voter model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Voter the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($username)
    {
        $this->layout = '/dashb.php';

        if (($model = Voter::findOne(['username' => $username])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
