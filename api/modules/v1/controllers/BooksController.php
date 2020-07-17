<?php
namespace app\api\modules\v1\controllers;

use Yii;
use yii\rest\ActiveController;
use app\models\Books;

class BooksController extends ActiveController
{
    // We are using the regular web app modules:
    public $modelClass = 'app\models\Books';

    public function actions()
    {
      $actions = parent::actions();
      unset($actions['index']);
      unset($actions['view']);
      unset($actions['update']);
      unset($actions['create']);
      unset($actions['delete']);           
      return $actions;
    }

    protected function verbs()
    {
      return [        
        'update' => ['POST'],
        'delete' => ['DELETE'],
        'view' => ['GET', 'HEAD'],
        'index' => ['GET', 'HEAD'],        
      ];
    }    

    public function actionIndex()
    {            
      $books = Books::find()->with('author')->orderBy(['author_id' => SORT_DESC])->asArray()->all();
      return $books;
    }

    public function actionView($id)
    {      
      $books = Books::findOne($id);
      if ($books) {
        return $books;
      }      
      else {          
        Yii::$app->response->statusCode = 422;
        return [
            "data" => [
                'errors' => 'Not found'
            ],
        ];
      }
    }

    public function actionUpdate($id) {      
      $book = Books::findOne($id);
      if ($book == null) {
        Yii::$app->response->statusCode = 422;
        return [
            "data" => [
                'errors' => 'Not found'
            ],
        ];
      }
      if (Yii::$app->request->isPost) {
        $data = json_decode(Yii::$app->request->getRawBody(), true);
        $book->attributes = $data;
        if ($book->save()) {              
          return $book;
        } else {        
          Yii::$app->response->statusCode = 422;
          return [
            "data" => [
              'errors' => $book->getErrors()
            ]
          ];       
        }
      }
      Yii::$app->response->statusCode = 405;
      return [
        "data" => [
            'errors' => 'method not allowed'
        ],
      ];
    }

    public function actionDelete($id) {
      $book = Books::findOne($id);
      if ($book == null) {
        Yii::$app->response->statusCode = 422;
        return [
            "data" => [
                'errors' => 'Not found'
            ],
        ];
      }
      $book->delete();
      Yii::$app->response->statusCode = 204;      
    }
}
