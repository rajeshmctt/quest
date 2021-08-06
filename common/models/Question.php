<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "question".
 *
 * @property int $id
 * @property string|null $name
* @property string|null $section 
 * @property int|null $questionnaire_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
* @property Answers[] $answers 
 * @property Options[] $options
 * @property Questionnaire $questionnaire
 */
class Question extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'question';
    }

	public function behaviors()
    {
        return [
            TimestampBehavior::className(),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
			['status', 'default', 'value' => self::STATUS_ACTIVE],
			[['name', 'section'], 'string'],
            [['questionnaire_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string'],
            [['questionnaire_id'], 'exist', 'skipOnError' => true, 'targetClass' => Questionnaire::className(), 'targetAttribute' => ['questionnaire_id' => 'id']],
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
           'section' => 'Section', 
            'questionnaire_id' => 'Questionnaire ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Options]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOptions()
    {
        return $this->hasMany(Options::className(), ['question_id' => 'id']);
    }

    /**
     * Gets query for [[Questionnaire]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestionnaire()
    {
        return $this->hasOne(Questionnaire::className(), ['id' => 'questionnaire_id']);
    }
 
   /** 
    * Gets query for [[Answers]]. 
    * 
    * @return \yii\db\ActiveQuery 
    */ 
   public function getAnswers() 
   { 
       return $this->hasMany(Answers::className(), ['question_id' => 'id']); 
   }
}
