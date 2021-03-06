<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "team".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $img
 * @property string|null $field
 * @property string|null $twitter
 * @property string|null $telegram
 * @property string|null $ok
 * @property string|null $linkedin
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'team';
    }

   public function behaviors()
   {
       return [
            TimestampBehavior::class,
       ];
   }
   const CREATE = 'create';
   const UPDATE = 'update';

    
    public function rules()
    {
        return [
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'img', 'field', 'twitter', 'telegram', 'ok', 'linkedin'], 'string', 'max' => 255],
            [['name', 'img', 'field'], 'required','on'=>self::CREATE],
            [['name', 'field'], 'required','on'=>self::UPDATE],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'img' => Yii::t('app', 'Img'),
            'field' => Yii::t('app', 'Field'),
            'twitter' => Yii::t('app', 'Twitter'),
            'telegram' => Yii::t('app', 'Instagram'),
            'ok' => Yii::t('app', 'Facebook'),
            'linkedin' => Yii::t('app', 'Linkedin'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
