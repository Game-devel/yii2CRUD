<?php

namespace app\modules;

use Yii;

class UserInfo 
{
 
    public static function getRole(){
        if (!Yii::$app->user->isGuest) {
            $role = Yii::$app->user->identity->role;
        } else {
            $role = -1;
        }
        return $role;
    }
    
    public static function getId(){
        if (!Yii::$app->user->isGuest) {
            $id = Yii::$app->user->identity->id;
        } else {
            $id = -1;
        }
        return $id;
    }
    
}