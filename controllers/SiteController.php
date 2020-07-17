<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\RegistrationForm;
use app\models\Books;
use yii\web\UploadedFile;



class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
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
                'class' => VerbFilter::className(),
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
        $books = Books::find()->with('author')->orderBy(['author_id' => SORT_DESC])->all();
        return $this->render('index',[
            'books' => $books
        ]);
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

    public function actionRegistration()
    {
        if (Yii::$app->user->isGuest) {
            $model = new RegistrationForm();

            if (Yii::$app->request->isPost) {
                $model->load(Yii::$app->request->post());
                $model->idCard = UploadedFile::getInstance($model, 'idCard');                
                if ($model->validate()){                    
                    $user = new User();
                    $user->name = $model->name;
                    $user->surname = $model->surname;
                    $user->patronymic = $model->patronymic;
                    $user->organization = $model->organization;
                    $user->email = $model->email;
                    $user->phone = $model->phone;
                    $email = explode('@', $model->email);
                    $user->username = $email[0];
                    $imgUrl = $model->uploadCard();
                    $user->idCard = $imgUrl;
                    $user->password = Yii::$app->security->generatePasswordHash($model->password);
                    $user->role = 3; 
                    if($user->validate()&&$user->save()){
                        return $this->goHome();
                    }
                }
            }

            return $this->render('registration', [
                'model' => $model,
            ]);
        }
        
        return $this->goHome();
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
