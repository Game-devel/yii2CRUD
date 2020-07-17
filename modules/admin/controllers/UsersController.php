<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\modules\UserInfo;

use app\models\User;
use app\models\UserPermit;
use app\models\UserTests;
use app\models\Test;
use app\models\TestQuestion;
use app\models\TestAnswer;
use app\models\UserSearch;
use \yii\web\Response;
use \yii\data\ActiveDataProvider;

class UsersController extends \yii\web\Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    
                ],
            ],
        ];
    }

    public function actionIndex()
    {

        $searchModel = new UserSearch();
        // $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->where(['<>','role',3]),            
            'sort' => ['defaultOrder' => ['created_at' => SORT_DESC]]
        ]);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }


    public function actionView($id)
    {
        $model = User::findOne($id);
        if ($model) {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
        Yii::$app->session->setFlash('error', 'Ошибка пользователь не найден');
        return $this->redirect(['index']);
    }
   
    /*Проверка роли*/
    public function beforeAction($action)
    {
        $userRole = UserInfo::getRole();
        if ($userRole == 3) {
            return parent::beforeAction($action);
        } else {
            return $this->goHome();
        }
    }
}
