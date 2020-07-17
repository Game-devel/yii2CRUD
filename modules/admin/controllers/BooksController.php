<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\filters\VerbFilter;
use app\modules\UserInfo;

use app\models\Books;
use app\models\Authors;
use app\models\BooksSearch;
use \yii\web\Response;

class BooksController extends \yii\web\Controller
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
        $model = Books::findOne($id);
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

        $searchModel = new BooksSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);        
        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }    

    public function actionCreate()
    {
        $model = new Books();
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());                                                           
            if ($model->save()) {
                Yii::$app->session->setFlash('success','Книга '.$model->name.' успешно добавлен');
                return $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('error','Ошибка при добавлении книги');
            }        
        }            
        $authors = Authors::find()->all();
        return $this->render('create',[
            'model' => $model,
            'authors' => $authors
        ]);
    }

    public function actionUpdate($id)
    {                
        $model = Books::findOne($id);        
        if (Yii::$app->request->isPost) {
            $model->load(Yii::$app->request->post());
            if ($model->save()) {
                Yii::$app->session->setFlash('success','Книга '.$model->name.'  успешно обновлен');
                return $this->redirect('index');
            } else {
                Yii::$app->session->setFlash('error','Ошибка при обновлении книги');
            }
        }
        $authors = Authors::find()->all();                                        
        return $this->render('update',[
            'model' => $model,
            'authors' => $authors
        ]);
    }
    
    
    public function actionDelete($id)
    {
        $model = Books::findOne($id);
        $name = $model->name;        
        $model->delete();
        Yii::$app->session->setFlash('success','Книга '.$name.' был удален');
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
