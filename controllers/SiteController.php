<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Position;
use app\models\User;
use app\models\Voter;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(["/dashboard"]);
        }

        $request = Yii::$app->request->post();
        $user = new User();
        if ($request) {
            if ($user->load($request) && $user->login()) {
                return $this->redirect(["/dashboard"]);
            }

            $session = Yii::$app->session;
            $session->setFlash('errorMessages', $user->getErrors());
        }


        $user->password = '';
        return $this->render('index', [
            'user' => $user,
        ]);
    }

    // Registter
    public function actionRegister()
    {
        return $this->render('register');
    }

    public function actionSignUp()
    {
        $request = Yii::$app->request->post();

        $user = new User();
        $user->attributes = $request;
        $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password); //Hash password before storing to DB
        $user->auth_key = Yii::$app->security->generateRandomString(); //Generate auth key
        $user->otp = Yii::$app->security->generateRandomString(6, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789'); // add this line to generate a random six-digit token
        $session = Yii::$app->session;

        if ($user->validate() && $user->save()) {
            $session->setFlash('successMessage', 'Registration successful');
            return $this->redirect(['/login']);
        }

        $session->setFlash('errorMessages', $user->getErrors());
        return $this->redirect(['/register']);
    }


    // Login
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(["/dashboard"]);
        }

        $request = Yii::$app->request->post();
        $user = new User();
        if ($request) {
            if ($user->load($request) && $user->login()) {
                return $this->redirect(["/dashboard"]);
            }

            $session = Yii::$app->session;
            $session->setFlash('errorMessages', $user->getErrors());
        }


        $user->password = '';
        return $this->render('login', [
            'user' => $user,
        ]);
    }

    // Dashboard
    public function actionDashboard()
    {
        $this->layout = '/dashb.php';

        $totalPositions = Position::find()->count();
        $totalVoters = Voter::find()->where(['user_type' => 'voter'])->count();

        if (Yii::$app->user->isGuest) {
            // User is not logged in, redirect to login page
            return $this->redirect(['index']);
        } else {
            // User is logged in, show content
            return $this->render('dashboard', [
                'totalPositions' => $totalPositions,
                'totalVoters' => $totalVoters,
            ]);
        }
    }



    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}
