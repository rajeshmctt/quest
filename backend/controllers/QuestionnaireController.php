<?php

namespace backend\controllers;

use Yii;
use common\models\Questionnaire;
use common\models\QuestionnaireSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use common\models\QuestionSearch;

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
        // echo $aid; exit;
        $model = $this->findModel($id);
		$aid = isset($asm->id)?$asm->id:0;
		// $asm->name = "test";
		// $asm = Assessment::find()->where(['id'=>$aid])->one();
		// echo "asasasasas ".$aid; exit;
		
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,$id);
		$qkey =[];
		foreach($dataProvider->getModels() as $dp){
			$qkey[] = $dp->id;
		}
				
        // if ($model->load(Yii::$app->request->post())) {
        if (Yii::$app->request->post()) {
			$array = Yii::$app->request->post();
			// $answers = $array['AssessmentAnswers'];
			echo "<pre>"; print_r($array); exit;
			foreach($answers as $key=>$val){
				// echo $key.'  ';
				$model = $this->findModel($key);
				$aa_model = new AssessmentAnswers();
				$aa_model->aq_id = $key;
				$aa_model->answer = $val;
				$aa_model->user_id = Yii::$app->user->identity->id;
				$aa_model->assessment_id = $aid;
				// $aa_model->assessor_id = Yii::$app->user->identity->id;
				// echo "<pre>"; print_r($aa_model); exit;
				$aa_model->save();
				// echo "<pre>"; print_r($aa_model->getErrors()); exit;
			}
			
			// echo "<pre>"; print_r($answers); exit;
			$asm->fill_self = 1; 
			$asm->save();
			
			if($model->save()){
				return $this->redirect(['view-asm', 'aid' => $aid]);
			}
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
