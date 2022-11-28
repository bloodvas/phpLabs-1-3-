<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\RegisterForm;
use app\models\User;
use app\models\ContactForm;
use app\models\EntryForm;

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
                'only' => ['logout', 'lab1'],
                'rules' => [
                    [
                        // 'actions' => ['logout', 'lab1'],
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionRegister()
    {

        $model = new RegisterForm();
        if ($model->load(Yii::$app->request->post())) {
            $data = $_POST['RegisterForm'];
            if (isset($data) != null) {
                $user = new User();
                $user->username = $data['username'];
                $user->password = $data['password'];
                $user->save();
            }
        }
        return $this->render('register', [
            'model' => $model,
        ]);
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

    //Displays say page
    public function actionSay($message = 'Привет')
    {
        return $this->render('say', ['message' => $message]);
    }


    //Displays entry page
    public function actionLab1()
    {
        $model = new EntryForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            // данные в $model удачно проверены
            // делаем что-то полезное с $model ...
            Yii::$app->session->setFlash('success','Лабораторная работа 1');
             return $this->render('entry', ['model' => $model]);
        } else {
            // либо страница отображается первый раз, либо есть ошибка в данных
            Yii::$app->session->setFlash('warning','Лабораторная работа 1');
        }
        return $this->render('entry', ['model' => $model]);
    }

    //Displays info page 
    
    public function actionInfo()
    {
        return $this->render('info');
    }
    
    //Displays lab2 page 
    public function actionLab2()
    {
        Yii::$app->session->setFlash('success','Лабораторная работа 2');
        return $this->render('lab2');
    }
    
    //Displays lab3 page 

    public function actionLab3()
    {
        Yii::$app->session->setFlash('success','Лабораторная работа 3');
        return $this->render('lab3');
    }
}
