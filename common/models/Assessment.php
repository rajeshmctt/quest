<?php

namespace common\models;
use yii\behaviors\TimestampBehavior;
use yii\web\IdentityInterface;
use common\components\DB2ActiveRecord;

use Yii;

/**
 * This is the model class for table "assessment".
 *
 * @property int $id
 * @property string $name
 * @property int $asm_id
 * @property int $score
 * @property int $out_of
 * @property string $result
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 */
class Assessment extends \yii\db\ActiveRecord
{
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
	
	public static function getDb() {
		return Yii::$app->get('db2');
	}
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        // return 'assessment';
		return '{{%lms.assessment}}';  // confirm the other database name 
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
            [['asm_id', 'score', 'out_of', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name', 'result'], 'string', 'max' => 255],
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
            'asm_id' => 'Asm ID',
            'score' => 'Score',
            'out_of' => 'Out Of',
            'result' => 'Result',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
	
	/*public function afterSave($insert, $changedAttributes)		// 14-6-18 rajesh
	{
		$model2 = User2::find()->where(['email'=>$this->email])->one();
		// $role = $model2->role;
		// $country_id = $model2->country_id;
		// $password_hash = $model2->password_hash;
		if(count($model2)==0){
			$model2 = new User2();
			$model2->role = $this->role;
			// $model2->role = UserTypes::PARTICIPANT;
			$model2->email = $this->email;
			$model2->contact_no = $this->contact_no;  	//
			$model2->first_name = $this->first_name;	//
			$model2->last_name = $this->last_name;		//		
			$model2->auth_key = $this->auth_key;

		}
		//$data = $this->attributes;
		//echo "<pre>"; print_r(UserTypes::PARTICIPANT); exit;
		//$model2->setAttributes($data);
		
		$model2->password_hash = $this->password_hash;
		$model2->flag =1;
		// $model2->country_id = $this->country_id;
		$model2->location =1;
		//$model2->status = User::STATUS_ACTIVE;
		$model2->save();
		
		$model3 = User3::find()->where(['email'=>$this->email])->one();
		if(count($model3)==0){
			$model3 = new User3();
			$model3->role = $this->role;
			$model3->email = $this->email;
			$model3->contact_no = $this->contact_no;  	//
			$model3->first_name = $this->first_name;	//
			$model3->last_name = $this->last_name;		//
			$model3->auth_key = $this->auth_key;   //
		}
		$model3->password_hash = $this->password_hash;
		$model3->flag =1;
		// $model3->country_id = $this->country_id;
		$model3->location =1;
		$model3->save();
	}*/
}
