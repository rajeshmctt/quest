<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;

use Yii;

/**
 * This is the model class for table "answers".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $question_id
* @property int|null $option_id 
 * @property int|null $user_id
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
* @property Options $option 
 * @property Question $question
 * @property User $user
 */
class Answers extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'answers';
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
            [['question_id', 'option_id', 'user_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['option_id'], 'exist', 'skipOnError' => true, 'targetClass' => Options::className(), 'targetAttribute' => ['option_id' => 'id']], 
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
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
            'question_id' => 'Question ID',
            'option_id' => 'Option ID', 
            'user_id' => 'User ID',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * Gets query for [[Question]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getQuestion()
    {
        return $this->hasOne(Question::className(), ['id' => 'question_id']);
    }
 
    /** 
     * Gets query for [[Option]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getOption() 
    { 
        return $this->hasOne(Options::className(), ['id' => 'option_id']); 
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
