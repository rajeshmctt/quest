<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "options".
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $question_id
* @property int|null $is_correct 
 * @property int|null $status
 * @property int|null $created_at
 * @property int|null $updated_at
 *
* @property Answers[] $answers 
 * @property Question $question
 */
class Options extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'options';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['question_id', 'is_correct','status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['question_id'], 'exist', 'skipOnError' => true, 'targetClass' => Question::className(), 'targetAttribute' => ['question_id' => 'id']],
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
            'is_correct' => 'Is Correct', 
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
 
    /** 
     * Gets query for [[Answers]]. 
     * 
     * @return \yii\db\ActiveQuery 
     */ 
    public function getAnswers() 
    { 
        return $this->hasMany(Answers::className(), ['option_id' => 'id']); 
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
}
