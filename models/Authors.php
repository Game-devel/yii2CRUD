<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors".
 *
 * @property int $id
 * @property string $name
 * @property string $contact
 * @property string $address
 * 
 * @property Books $books
 */
class Authors extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
      return 'authors';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
      return [
          [['name'], 'required'],
          [['name', 'contact', 'address'], 'string'],          
      ];
  }

  /**
   * {@inheritdoc}
   */
  public function attributeLabels()
  {
      return [
          'id' => 'ID',
          'name' => 'Name',
          'contact' => 'Contact',
          'address' => 'Address',
      ];
  }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Books::className(), ['author_id' => 'id'])->count();
    }
}
