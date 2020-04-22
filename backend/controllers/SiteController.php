<?php
namespace backend\controllers;

use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
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
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }
	
    public function actionLogin()
    {
        //echo "<pre>"; print_r(Yii::$app->request->get("ajax")); exit;
		// echo "<pre>"; print_r(Yii::$app->request->get("choose")); exit;
		$choose = Yii::$app->request->get("choose");
		// echo "<pre>"; print_r($choose); exit;
		if (!\Yii::$app->user->isGuest) {
			if(Yii::$app->request->get("ajax")){
				return $this->redirect(["site/index"]);
				// return $this->redirect(["site/choose"]);
			}else{
				// return $this->goBack();
				return $this->goHome();
			}
        }
        $model = new LoginForm();

        /* $validationResult = $this->ajaxValidation($model);
        if($validationResult){
            return $validationResult;
        } */

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
			// echo "<pre>"; print_r(Yii::$app->request->get("choose")); exit;
			Yii::$app->session->set('email',Yii::$app->user->identity->email);   // save email in session
			// echo "<pre>test 23"; print_r(Yii::$app->user->identity->email); exit;
			if(Yii::$app->request->get("ajax")){
				
				return "logged in";
			}else{
				// echo "<pre>test 23"; print_r($choose); exit;
				if($choose!=1){
					return $this->redirect(Yii::$app->request->referrer);  // 4-9-18 rajesh
				}
				else{
					// return $this->redirect(["site/choose"]);
					$session = Yii::$app->session;
					$session->set('choose', '1');
					return $this->redirect(['site/index', 'choose' => $choose]);
				}
				// return $this->goBack();
				// return $this->redirect(["site/index"]);
			}
        } else {//echo "<pre>";print_r($model->getErrors());exit;
			//if(!Yii::$app->request->get("from_app")){
				if(!Yii::$app->request->get("ajax")){
					$this->layout = "login";
				}
				return $this->render('login', [
					'model' => $model,
					'choose' => $choose,
				]);
			/* }else{
				return $this->renderPartial('login', [
					'model' => $model,
				]);
			} */
        }
    }


    /**
     * Login action.
     *
     * @return string
     */
    public function actionLoginO()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
		$this->layout = "login";
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
