<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\User;
use yii\web\UploadedFile;
 
class RegistrationForm extends Model{
    
    public $name;
    public $surname;
    public $patronymic;
    public $email;
    public $phone;
    public $organization;
    public $password;
    public $idCard;
    
    public function rules() {
        return [
            [['email', 'phone', 'name', 'surname', 'patronymic', 'organization', 'password', 'idCard'], 'required', 'message' => 'Заполните поле'],
            [['idCard'], 'required', 'message' => 'Выберите файл'],
            [['idCard'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, pdf'],
            ['email', 'unique', 'targetClass' => '\app\models\User',  'message' => 'Эта почта уже используется'],
            ['email','email','message' => 'Укажите вашу почту'],
            ['phone', 'unique', 'targetClass' => '\app\models\User',  'message' => 'Этот номер телефона уже используется'],
        ];
    }
    
    public function attributeLabels() {
        return [
            'email' => 'Email',
            'phone' => 'Phone',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'organization' => 'Organization',
            'password' => 'Password',
            'idCard' => 'ID Card',
        ];
    }
    
    public function uploadCard()
    {
        if ($this->validate()) {
            $saveDir = Yii::getAlias('@app/web/uploads/idcards/');
            if(!file_exists($saveDir)){
                mkdir($saveDir, 0775, true);
            }
            $time = strtotime(date('Y-m-d H:i:s'));
            $url = 'uploads/idcards/' . $time . '.' . $this->idCard->extension;
            $this->idCard->saveAs($url);
            return $url;
        } else {
            return false;
        }
    }
}
    
