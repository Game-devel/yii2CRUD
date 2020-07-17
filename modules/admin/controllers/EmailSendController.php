<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\filters\VerbFilter;
use app\modules\UserInfo;

use app\models\SendMailForm;
use app\models\User;

use yii\web\UploadedFile;

use yii\data\Pagination;

class EmailSendController extends \yii\web\Controller
{
    
  public function behaviors()
  {
    return [
        'verbs' => [
            'class' => VerbFilter::className(),
            'actions' => [
                'delete' => ['POST'],
                'download' => ['POST'],
            ],
        ],
    ];
  }
    
  public function actionSend()
  {
    $model = new SendMailForm();
    
    if (Yii::$app->request->isPost) {
      $model->load(Yii::$app->request->post());
      if ($model->validate()){        
        foreach ($model->users as $user) {
              Yii::$app->mailer->compose()
                ->setTo($user)
                ->setFrom('mail@osvald.kz')
                ->setSubject($model->subject)
                ->setHtmlBody($model->text)
                ->send();
        }        
        Yii::$app->session->setFlash('success','Рассылка успешно отправлена');
        return $this->redirect('/admin');        
      }
    }

    $users=User::find()->all();
    $listUsers=ArrayHelper::map($users,'email','fio');    
    return $this->render('create',[
        'model' => $model,
        'listUsers' => $listUsers
    ]);
  }
    
    /*Проверка роли*/
    
    public function beforeAction($action)
    {
        $userRole = UserInfo::getRole();
        if ($userRole == 4) {
            return parent::beforeAction($action);
        } else {
            return $this->goHome();
        }
    }
    
   

}
