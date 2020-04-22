<?php

namespace backend\controllers;

use Yii;
use common\models\Question;
use common\models\Options;
use common\models\QuestionSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * QuestionController implements the CRUD actions for Question model.
 */
class QuestionController extends Controller
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
     * Lists all Question models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new QuestionSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Question model.
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
     * Creates a new Question model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Question();

        if ($model->load(Yii::$app->request->post())) {
            // echo "<pre>"; print_r(Yii::$app->request->post()); exit;
            $mypost = Yii::$app->request->post();
            $opts = $mypost['Option'];
            // echo "<pre>"; print_r($opts[1]); exit;
            if($model->save()){
                foreach($opts as $k => $opt){
                    $option = new Options();
                    $option->name = strval($opt);
                    $option->question_id = $model->id;
                    if($k == $mypost['select']){
                        $option->is_correct = 1;
                    }else{
                        $option->is_correct = 0;
                    }
                    $option->save();
                    // print_r($opt->getErrors()); exit;
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Question model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $optso = Options::find()->where(['question_id'=>$id])->all();
        $oarr = [];
        $cnt = 1;
        foreach($optso as $opto){
            $oarr[$cnt]['name'] = $opto->name;
            $oarr[$cnt]['is_correct'] = $opto->is_correct;
            $cnt++;
        }
        if(count($oarr)==0){
            for($i=1;$i<=4;$i++){
                $oarr[$i]['name'] = '';
                $oarr[$i]['is_correct'] = '';
            }
        }
        // echo "<pre>"; print_r($oarr); exit;
        if ($model->load(Yii::$app->request->post())) {
            $mypost = Yii::$app->request->post();
            $opts = $mypost['Option'];
            // echo "<pre>"; print_r($opts[1]); exit;
            if($model->save()){
                foreach($opts as $k => $opt){
                    $option = new Options();
                    $option->name = strval($opt);
                    if($k == $mypost['select']){
                        $option->is_correct = 1;
                    }else{
                        $option->is_correct = 0;
                    }
                    $option->save();
                    // print_r($opt->getErrors()); exit;
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'oarr' => $oarr,
        ]);
    }

    /**
     * Deletes an existing Question model.
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
     * Finds the Question model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Question the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Question::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
