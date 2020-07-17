<?php

namespace app\modules\admin\controllers;

use Yii;
use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use app\modules\UserInfo;


use yii\data\Pagination;

class PanelController extends \yii\web\Controller
{
    public function actionIndex()
    {        
        return $this->render('index');
    }
    
     /*Страницы и действия блока Документы*/
    
    public function actionDocuments()
    {
        return $this->render('documents');
    }
    
    
     /*Страницы и действия блока Фотогаллерея*/
    
    public function actionPhotogallery()
    {
        return $this->render('photogallery');
    }
    
    
     /*Страницы и действия блока События и семинары*/
    
    public function actionEvents()
    {
        return $this->render('events');
    }
     
    
    /*Страницы и действия блока Отзывы*/
    
    
    public function actionReviews()
    {
        return $this->render('reviews');
    }
    
    
     /*Страницы и действия блока Ответы специалистов*/
    
    public function actionAnswers()
    {
        return $this->render('answers');
    }
    
    /*Страницы и действия блока Пользователи*/
    
     public function actionUsers()
    {
        return $this->render('users');
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
