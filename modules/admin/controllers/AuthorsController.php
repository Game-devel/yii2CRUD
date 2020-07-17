<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\modules\UserInfo;
use app\models\Authors;
use app\models\AuthorsSearch;
use \yii\web\Response;

class AuthorsController extends \yii\web\Controller
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

    public function actionView($id)
    {
        $model = Authors::findOne($id);
        if ($model) {
            return $this->render('view', [
                'model' => $model,
            ]);
        }
        Yii::$app->session->setFlash('error', 'Ошибка пользователь не найден');
        return $this->redirect(['index']);
    }

    public function actionIndex()
    {

        $searchModel = new AuthorsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    public function actionCreate()
    {
        $model = new Authors();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());                                                          
            if ($model->save()) {
                Yii::$app->session->setFlash('success','Автор '.$model->name.' успешно добавлен');
                return $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('error','Ошибка при добавлении автора');
            }            
        }            
        return $this->render('create',[
            'model' => $model,
        ]);
    }

    public function actionUpdate($id)
    {                
        $model = Authors::findOne($id);        
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->save()) {
                Yii::$app->session->setFlash('success','Автор '.$model->name.'  успешно обновлен');
                return $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('error','Ошибка при обновлении автора');
            }
        }                                        
        return $this->render('update',[
            'model' => $model,
        ]);
    }
    
    
    public function actionDelete($id)
    {
        $model = Authors::findOne($id);
        $name = $model->name;        
        $model->delete();
        Yii::$app->session->setFlash('success','Автор '.$name.' был удален');
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
