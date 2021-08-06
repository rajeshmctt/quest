<?php

namespace backend\controllers;

use Yii;
use common\models\user;
use common\models\Answers;
use common\models\UserSearch;
use common\models\AnswersSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\models\enums\ICFTypes;
use backend\models\enums\UserTypes;
use yii\filters\AccessControl;
use common\components\BaseController;

/**
 * UserController implements the CRUD actions for user model.
 */
class UserController extends Controller
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
                            'test','index','create-participant','update','delete','view','all','part-report','part-report1'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['login', 'error', 'forgot-password', 'reset-password', 'captcha', 'change-password','test-notify','contact'],
                        'allow' => true,

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
	
	
	public function actionPartReport1()
    {
        $org_id ='';
        $str_date ='';
        $end_date = '';
        $export = Yii::$app->request->get('export');
        $search = Yii::$app->request->get('search');
        $batch_id = Yii::$app->request->get('batch');
		// echo "<pre>"; print_r($batch_id); exit;
        if (Yii::$app->request->get('start_date') != '') {

            $str_date = strtotime(Yii::$app->request->get('start_date'));
			//echo "test<pre>"; print_r($str_date); exit;
        }	
        if (Yii::$app->request->get('end_date') != '') {
            $end_date = strtotime(Yii::$app->request->get('end_date'));
        }
		
        if(isset($export) && !isset($search))
        {
            $this->pr_export($batch_id,$str_date,$end_date);
        }
		else {
			//echo "test<pre>"; print_r($search); exit;
            // $searchModel = new AnswersSearch();
            $searchModel = new UserSearch();
			// $searchModel->status = Asi2::STATUS_DELETED;
            if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN) {
                // $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //, 
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams,5); //, UserTypes::SUPER_ADMIN,'', $str_date, $end_date
                
                // ANSWER logic  
                /*$answers = $dataProvider->getModels();
                $oth = [];
                $asr_ids = [];
                foreach($answers as $ans){
                    $oth[$ans->user_id]['Name'] = $ans->user->first_name;
                    $oth[$ans->user_id][$ans->question->name]=$ans->option_id;
                }*/

                // $asr_ids = array_unique($asr_ids);
                // echo "<pre>"; print_r($oth); exit;           /// main work 
                // $user_id = Yii::$app->user->identity->id ;
        
                // $count = count($dataProvider);
                        


            } else {
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //, UserTypes::ORGANIZATION,'', $str_date, $end_date
            }
			//echo "test<pre>"; print_r($search); exit;
            return $this->render('part_report', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
				'search' => $search,	//13-2
            ]);
        }
    }
	
	
	public function actionPartReport()
    {
        $org_id ='';
        $str_date ='';
        $end_date = '';
        $export = Yii::$app->request->get('export');
        $search = Yii::$app->request->get('search');
        $batch_id = Yii::$app->request->get('batch');
		// echo "<pre>"; print_r($batch_id); exit;
        if (Yii::$app->request->get('start_date') != '') {

            $str_date = strtotime(Yii::$app->request->get('start_date'));
			//echo "test<pre>"; print_r($str_date); exit;
        }	
        if (Yii::$app->request->get('end_date') != '') {
            $end_date = strtotime(Yii::$app->request->get('end_date'));
        }
		
        if(isset($export) && !isset($search))
        {
            $this->pr_export($batch_id,$str_date,$end_date);
        }
		else {
			//echo "test<pre>"; print_r($search); exit;
            $searchModel = new AnswersSearch();
			// $searchModel->status = Asi2::STATUS_DELETED;
            if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN) {
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //, UserTypes::SUPER_ADMIN,'', $str_date, $end_date
                $answers = $dataProvider->getModels();
                $oth = [];
                $asr_ids = [];
                foreach($answers as $ans){
                    $oth[$ans->user_id]['Name'] = $ans->user->first_name;
                    $oth[$ans->user_id][$ans->question->name]=$ans->option_id;
                }
                // $asr_ids = array_unique($asr_ids);
                echo "<pre>"; print_r($oth); exit;           /// main work 
                // $user_id = Yii::$app->user->identity->id ;
        
                // $count = count($dataProvider);
                $assmt = Assessment::findOne($asm_id); 
                // $count = count($assmt->assessmentAnswers);
                $spreadsheet = new Spreadsheet();	
                $sheet = $spreadsheet->getActiveSheet();
                $ans = $dataProvider->getModels(); 
                
                // unwanted code 
                /*$array = [];
                $c = 3;
                foreach($ans as $an){
                    $array[$an->aq->question->question] = $an->answer;
                }
                
                // echo "<pre>"; print_r($array); exit;
                $count = count($array);   */
                        
                $spreadsheet->setActiveSheetIndex(0);
                $activeSheet = $spreadsheet->getActiveSheet();
                
                $x = 2;	
                // $sheet->setCellValueByColumnAndRow(1,1, 'Question');
                // $sheet->setCellValueByColumnAndRow(2,1, 'Answer');
                // foreach($array as $k=>$v){
                
                    // testing new code 
                $x = 2;  // Column
                foreach($oth as $k=>$v){
                    $alph = 1; //$y = 
                    //$sheet->setCellValueByColumnAndRow($column, 1, $question->label);
                    // $sheet->setCellValueByColumnAndRow($x,1, 'test');
                    foreach($v as $k1=>$v1){
                        $sheet->setCellValueByColumnAndRow(1,$alph, $k1);
                        $sheet->setCellValueByColumnAndRow($x,$alph, $v1);
                        $alph++;
                    }
                    // $sheet->setCellValueByColumnAndRow(++$y,$x, $v);
                    // $sheet->setCellValueByColumnAndRow(2,1, 'Participant id');
                    // $alph = '2'; 
                    $x++;
                }
                /*foreach($array as $k=>$v){
                    //$sheet->setCellValueByColumnAndRow($column, 1, $question->label);
                    $sheet->setCellValueByColumnAndRow(1,$x, $k);
                    $sheet->setCellValueByColumnAndRow(2,$x, $v);
                    // $sheet->setCellValueByColumnAndRow(2,1, 'Participant id');
                    $alph = '2'; 
                    $x++;
                }*/
                
                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment;filename="' . preg_replace( '/[^a-zA-Z0-9_ ]+/i', '-', 'test' ) . '_' . date('dmY_His', time()) . '.xls"');
                /*header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment;filename="' . preg_replace( '/[^a-zA-Z0-9_ ]+/i', '-', 'test' ) . '_' . date('dmY_His', time()) . '.xlsx"');*/
                header('Cache-Control: max-age=0');
        
                $writer = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($spreadsheet, 'Xls');
                $writer->save('php://output');



            } else {
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams); //, UserTypes::ORGANIZATION,'', $str_date, $end_date
            }
			//echo "test<pre>"; print_r($search); exit;
            return $this->render('part_report', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
				'search' => $search,	//13-2
            ]);
        }
    }

    /**
     * Lists all user models.
     * @return mixed
     */
    public function actionIndex($type)
    {
        if (Yii::$app->user->identity->role != UserTypes::SUPER_ADMIN) {
			return $this->redirect(["site/index"]);
		}
		$searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams, $type);
        $location_array=[];
        $model = new User();
        $model->role = $type;
          $location_array=[];
        $coaching_med = '';
        $level = [];
        $agreement = '';
        $agreement_temp = [];

        $status = ['10' => 'Active', '0' => 'Inactive'];
		//echo "<pre>"; print_r($status); exit;
        $icf = [ICFTypes::ICF_ACC => 'ICF ACC', ICFTypes::ICF_PCC => 'ICF PCC', ICFTypes::ICF_MCC => 'ICF MCC', ICFTypes::NONE_FROM_ICF => 'None From ICF'];


        if ($model->load(Yii::$app->request->post())) {
			
            $location_array=$model->location_id;
            //echo "<pre>"; print_r($location_array); //print_r($locationname); 
			//exit; 
			if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN && $model->role == UserTypes::CLIENT) {
                if ($model->organization_id == '') {
                    $model->addError('organization_id', 'Organization can not be blank');

                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'type' => $type,
                        'status' => $status,
                        'model' => $model,
                        'location' => $location,
                        'locationname' => $locationname,
                        'country' => $country,
                        'countryname' => $countryname,
                    ]);
                }
            }

            if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN) {
                if (Yii::$app->request->post('agreement') == '') {
                    $model->addError('agreement_content', 'Agreement can not be blank');

                    return $this->render('index', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                        'type' => $type,
                        'status' => $status,
                        'model' => $model,
                        'location' => $location,
                        'locationname' => $locationname,
                        'country' => $country,
                        'countryname' => $countryname,
                    ]);
                }
            }
            if ($model->role == UserTypes::COACH) {
                $model->email = Yii::$app->request->post('email');
                if ($model->coaching_medium != null) {
                    $result = array_filter($model->coaching_medium,
                        function ($arrayEntry) {
                            return !is_numeric($arrayEntry);
                        }
                    );
                    if (in_array("Other", $result)) {
                        $result[] = Yii::$app->request->post('other_medium');
                    }
                    $coaching_med = implode(",", $result);
                    $model->coaching_medium = $coaching_med;
                }
            }
            if (!in_array($model->country_id, $countryname, true)) {
                $country_model = new Country();
                $country_model->name = $model->country_id;
                if ($country_model->save()) {
                    $model->country_id = $country_model->id;
                }
            } else {
                $country_id = Country::find()->where(['name' => $model->country_id])->one();
                $model->country_id = $country_id->id;
            }
           /* if (!in_array($model->location_id, $locationname, true)) {
                $location_model = new Location();
                $location_model->name = $model->location_id;
                if ($location_model->save()) {
                    $model->location_id = $location_model->id;
                }
            } else {
                $location_id = Location::find()->where(['name' => $model->location_id])->one();
                $model->location_id = $location_id->id;
            }*/
            $password = $model->password_hash;
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
            $media = UploadedFile::getInstance($model, 'media_id');
            if ($media != null && !$media->getHasError()) {
                $media_id = LogoUploader::LogoUpload($media, 'media_id', $type);
            }
            if (isset($media_id)) {
                $model->media_id = $media_id;
            }
            $model->contact_no = preg_replace('/(\D+)/', '', $model->contact_no);
            $model->location_id ='';
            if ($model->save()) {
                /***userlocation***/
                if($location_array && count($location_array)>0) {
                    $location_count = count($location_array);
					//echo "<pre>"; print_r($location_array); print_r($locationname); exit; 
                    try{
						$location_diff = array_diff($location_array, $locationname);
					}
					catch(Exception $e){
						echo 'Message: ' .$e->getMessage();
					}
                    $location_same = array_intersect($location_array, $locationname);
                    if (count($location_diff) > 0) {
                        foreach ($location_diff as $loc) {
                            $location_model = new Location();
                            $location_model->name = $loc;
                            $location_model->country_id = $model->country_id;
                            if ($location_model->save()) {
                                $user_location_model = new UserLocation();
                                $user_location_model->user_id = $model->id;
                                $user_location_model->location_id = $location_model->id;
                                $user_location_model->country_id = $model->country_id;
                                $user_location_model->save();
                            }
                        }
                    } else {
                        $location_id = Location::find()->where(['IN', 'name', $location_same])->all();

                        foreach ($location_id as $val) {
                            $user_location_model = new UserLocation();
                            $user_location_model->user_id = $model->id;
                            $user_location_model->location_id = $val->id;
                            $user_location_model->country_id = $model->country_id;
                            $user_location_model->save();
                        }
                    }
                }

                /******/

                if ($model->role == USERTYPES::CLIENT) {
                    $this->sendEmail($model, "user_add", $password);
                    Yii::$app->getSession()->setFlash('success', 'Client is added successfully');
                } else {
                    $this->sendEmail($model, "user_add", $password);
                    Yii::$app->getSession()->setFlash('success', 'Coach is added successfully');
                }
                return $this->redirect(['index', 'type' => $type]);
            } else {
                $errors = $model->getErrors();
                return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
                    'type' => $type,
                    'status' => $status,
                    'model' => $model,
                ]);
            }
        } else {
            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
                'type' => $type,
                'status' => $status,
                'model' => $model,
            ]);
        }
    }
	
	

    /**
     * Displays a single user model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new user model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new user();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
	
	public function actionCreateParticipant()
    {
		if (Yii::$app->user->identity->role != UserTypes::SUPER_ADMIN) {
			return $this->redirect(["site/index"]);
        }
        $model = new User();
        $model->role = UserTypes::PARTICIPANT;
        
        if ($model->load(Yii::$app->request->post())) {			
            $password = $model->password_hash;
            $model->setPassword($model->password_hash);
            $model->generateAuthKey();
			if($model->save()){
				// echo "yes"; exit;
			}else{
				// echo "<pre>"; print_r($model->getErrors()); exit;
			}
            // return $this->redirect(['view', 'id' => $model->id]);
            return $this->redirect(['index', 'type' => 5]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing user model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		$answers = Answers::find()->where(['status'=>10,'user_id'=>$id])->all();
		// echo "<pre>"; print_r(count($answers)); exit;
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['index','type'=>5]); //, 'id' => $model->id
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing user model.
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
     * Finds the user model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return user the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = user::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
