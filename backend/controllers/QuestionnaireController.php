<?php

namespace backend\controllers;

use Yii;
use common\models\Questionnaire;
use common\models\Answers;
use common\models\Options;
use common\models\Assessment;
use common\models\User;
use common\models\QuestionnaireSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\QuestionSearch;
use yii\filters\AccessControl;

/**
 * QuestionnaireController implements the CRUD actions for Questionnaire model.
 */
class QuestionnaireController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => [
                            'test','index','view','update','delete','create','all'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login','result', 'my-test', 'my-login', 'error', 'forgot-password', 'reset-password', 'captcha', 'change-password','test-notify','contact'],
                        'allow' => true,
                        // 'roles' => ['?'],
                    ],

                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Questionnaire models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionnaireSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Questionnaire model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);

        return $this->render('view', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Lists all AssessmentQuestionsAsm models.
     * @return mixed
     */
    public function actionTest($id='')
    {
        // echo $id; exit;
        $model = $this->findModel($id);
		$aid = isset($asm->id)?$asm->id:0;
		// $asm->name = "test";
		// $asm = Assessment::find()->where(['id'=>$aid])->one();
		// echo "asasasasas ".$aid; exit;
        /*$str = "test@test.com";
        $enc = base64_encode($str); 
        $dec = base64_decode(urldecode($enc));
        echo $enc." ".$dec; exit;*/
        
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
		$qkey =[];
		foreach($dataProvider->getModels() as $dp){
			$qkey[] = $dp->id;
		}
				
        // if ($model->load(Yii::$app->request->post())) {
        if (Yii::$app->request->post()) {
			$array = Yii::$app->request->post();
            // $answers = $array['Answers'];
            foreach ($array as $key => $value) {
                if (!is_int($key)) {
                    unset($array[$key]);
                }
            }
			// echo "<pre>"; print_r($array); exit;
			foreach($array as $key=>$val){
				// echo $key.'  ';
                // $model = $this->findModel($key);
                $aa_old = Answers::find()->where(['question_id'=>$key,'user_id'=>Yii::$app->user->identity->id,'status'=>10])->one();
                if($aa_old!=''){
                    $aa_old->status = 0;
                    $aa_old->save();
                }
				$aa_model = new Answers();
				$aa_model->question_id = $key;
				$aa_model->option_id = $val;
				$aa_model->user_id = Yii::$app->user->identity->id;
				// echo "<pre>"; print_r($aa_model); exit;
                $aa_model->save();
			}
			// exit;
			
			// if($model->save()){
				return $this->redirect(['result','id'=>$id]);
			// }
        }
		
        return $this->render('test', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            // 'asm' => isset($asm->name)?$asm->name:'',
            // 'aid' => $aid,
            'qkey' => $qkey,
        ]);
    }

    /**
     * Lists all AssessmentQuestionsAsm models.
     * @return mixed
     */
    public function actionMyLogin($id='')
    {
        $dec = base64_decode(urldecode($id));
        // echo $id; exit;
        $model = $this->findModel($dec);
		$user = new User();
        $this->layout = "open";
        $nouser = 0; 

        if ($user->load(Yii::$app->request->post())) {
            $umodel = User::find()->where(['email'=>$user->email, 'status'=>User::STATUS_ACTIVE])->one();
            // echo "<pre>"; print_r($umodel); exit;
            if(count((array)$umodel)!=0){
                $par = base64_encode($umodel->id); 
				return $this->redirect(['my-test','id'=>$id,'par'=>$par]);
            }else{
                // $nouser = 1;	
				$user->username = $user->username.rand(1,1000);	
				// $model->email = $user->email;			
				// $password = $model->password_hash;
				$user->setPassword(12345);//$model->password_hash
				$user->generateAuthKey();
				if($user->save()){
                    
                }else{
                    echo "<pre>"; print_r($user->getErrors());exit;
                }
                $par = base64_encode(isset($umodel->id)?$umodel->id:$user->id); 
				return $this->redirect(['my-test','id'=>$id,'par'=>$par]);
            }
        }
        return $this->render('mylogin', [
            'model' => $model,
            'user' => $user,
            'nouser' => $nouser,
        ]);

    }

    /**
     * Lists all AssessmentQuestionsAsm models.
     * @return mixed
     */
    public function actionMyTest($id='',$par)
    {
        // echo $aid; exit;
        $qid = $id;
        $id = base64_decode(urldecode($id));
        $pid = base64_decode(urldecode($par));
        // echo $pid; exit;
        $model = $this->findModel($id);
		$aid = isset($asm->id)?$asm->id:0;
		// $asm->name = "test";
		// $asm = Assessment::find()->where(['id'=>$aid])->one();
		// echo "asasasasas ".$aid; exit;
        /*$str = "test@test.com";
        $enc = base64_encode($str); 
        $dec = base64_decode(urldecode($enc));
        echo $enc." ".$dec; exit;*/
        $this->layout = "open";

        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id,1); //Random 20 = true
		$qkey =[];
		foreach($dataProvider->getModels() as $dp){
			$qkey[] = $dp->id;
		}
		
		
		// $keys = http_build_query($qkey);
		
		// echo "<pre>"; print_r($qkey); print_r($nn); exit;
        // if ($model->load(Yii::$app->request->post())) {
        if (Yii::$app->request->post()) {
			$array = Yii::$app->request->post();
            // $answers = $array['Answers'];
            foreach ($array as $key => $value) {
                if (!is_int($key)) {
                    unset($array[$key]);
                }
            }
            // echo "<pre>"; print_r($array); exit;
            $score = 0;
			foreach($array as $key=>$val){
				// echo $key.'  ';
                // $model = $this->findModel($key);
                $aa_old = Answers::find()->where(['question_id'=>$key,'user_id'=>$pid,'status'=>10])->one();
                // echo "$key $pid <pre>"; print_r($aa_old); exit;
                if(count((array)$aa_old)!=0){
                    $aa_old->status = 0;
                    $aa_old->save();
                    // echo "<pre>"; print_r($aa_old->getErrors()); exit;
                }
				$aa_model = new Answers();
				$aa_model->question_id = $key;
				$aa_model->option_id = $val;
				$aa_model->user_id = $pid;
				// echo "<pre>"; print_r($aa_model); exit;
                $aa_model->save();
                $optm = Options::find()->where(['id'=>$aa_model->option_id])->one();
                if($optm->is_correct==1){
                    $score++;
                }
            }
            /* 21jan21
			// To save to LMS db-> assessment table
			$asm_model = new Assessment();
            $asm_model->name = $model->name;
            $asm_model->asm_id = $model->id;
            $asm_model->score = $score;
            $asm_model->out_of = count((array)$array);
            if($score/count((array)$array)>0.7){
                $asm_model->result = "pass";
            }else{
                $asm_model->result = "fail";
            }
            $asm_model->save();
			// exit;
			*/
			
			// $keys = http_build_query($qkey);
			// if($model->save()){
				// return $this->redirect(['result','id'=>$qid,'par'=>$par]);
				return $this->redirect(['result','id'=>$qid,'par'=>$par]); //13may rdm ,'keys'=>$keys
			// }
        }
		
        return $this->render('test2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            // 'asm' => isset($asm->name)?$asm->name:'',
            // 'aid' => $aid,
            'qkey' => $qkey,
        ]);
    }

    /**
     * Lists all AssessmentQuestionsAsm models.
     * @return mixed
     */
    public function actionResult($id='',$par)//,$keys
    {
        // echo $aid; exit;
        $id = base64_decode(urldecode($id));
        $pid = base64_decode(urldecode($par));
        $model = $this->findModel($id);
		$aid = isset($asm->id)?$asm->id:0;
		$this->layout = "open";
		// $asm->name = "test";
		// $asm = Assessment::find()->where(['id'=>$aid])->one();
		
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
		// 13may rdm comment $qkey = []
		$qkey =[];
		foreach($dataProvider->getModels() as $dp){
			$qkey[] = $dp->id;
		}
		
		// $qkey = [];
		// parse_str($keys,$qkey);
		
        $akey = [];
        $acorr = 0;
        foreach($qkey as $val){
            $aa_o = Answers::find()->where(['question_id'=>$val,'user_id'=>$pid,'status'=>10])->one();
            $akey[$val] = $aa_o->option_id;
            if($aa_o->option->is_correct){
                $acorr++;
            }
        }
        // echo "<pre>"; print_r($acorr); print_r($akey); exit;
                
        return $this->render('result2', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'model' => $model,
            // 'asm' => isset($asm->name)?$asm->name:'',
            'acorr' => $acorr,
            'qkey' => $qkey,
            'akey' => $akey,
        ]);
    }

    /**
     * Creates a new Questionnaire model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Questionnaire();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Questionnaire model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Questionnaire model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Questionnaire model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Questionnaire the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Questionnaire::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
