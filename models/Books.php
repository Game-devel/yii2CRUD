<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "books".
 *
 * @property int $id
 * @property string $name
 * @property int $author_id
 * 
 * @property Authors $author
 * 
 */
class Books extends \yii\db\ActiveRecord
{
  /**
   * {@inheritdoc}
   */
  public static function tableName()
  {
      return 'books';
  }

  /**
   * {@inheritdoc}
   */
  public function rules()
  {
      return [
          [['name', 'author_id'], 'required'],
          ['name', 'string'],
          [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => Authors::className(), 'targetAttribute' => ['author_id' => 'id']],
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
          'author_id' => 'Author',          
      ];
  }

  /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Authors::className(), ['id' => 'author_id']);
    }
}
