<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use common\models\Category;
use common\models\Options;
use backend\models\enums\DirectoryTypes;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Program */

$this->title = 'View Questionnaire: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Questionnaire', 'url' => ['questionnaire/index']];
//$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="page">

	<?php if(!Yii::$app->request->isAjax){?>
		<div class="page-header">
			<h1 class="page-title"><?= Html::encode($this->title) ?></h1>
			<ol class="breadcrumb">
				<li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index");?>" data-link-to='site'>Home</a></li>
				<?php foreach($this->params['breadcrumbs'] as $k=>$v){
					if(isset($v['label'])){
						echo "<li><a href=".Yii::$app->urlManager->createAbsoluteUrl($v['url'][0])." data-link-to='questionnaire-index'>".$v['label']."</a></li>";
					}else{
						echo "<li class='active'>$v</li>";
					}
				}?>
			</ol>
		</div>
	<?php }?>
    
    
<div class="page-content container-fluid">
        <div class="panel">
            <div class="panel-body">
                <div class="row row-lg">
                    <div class="col-sm-10 col-md-offset-1">
                        <!-- Example Basic Form -->

                        <div class="example-wrap">
                            <div class="example">
                                <!--<h3 class="example-theme">
                                    Add Category
                                </h3>-->
                                <?php $form = ActiveForm::begin(['options' => ['data-link-to' => 'questionnaire-create']]); ?>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label">Questionnaire Name</label>
                                        <?= $form->field($model, 'name')->textInput(['readonly'=>true])->label(false) ?>										
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="control-label">Category</label>
                                        <?= $form->field($model, 'category_id')->label(false)->widget(Select2::classname(), [
											//'name' => 'User[location_id]',
											//'id' => 'location', // location 6-4-18
											//'value' => $location_name, // initial value
											'data' => Category::getCategories(),
											'options' => ['placeholder' => 'Select Category', 'id' => 'cate','disabled'=>true],
											'pluginOptions' => [
												'tags' => true,
												'tokenSeparators' => [',', ' '],
												// 'multiple'=>true, ,'multiple'=>true
												'maximumInputLength' => 10
											],
										]);?>
                                    </div>
                                </div>                                
                                <div class=" form-group row"><!-- form-material-->
                                    <div class="col-sm-6">
                                        <label class="control-label">Description</label>
                                        <?= $form->field($model, 'description')->textArea(['readonly'=>true])->label(false) ?>
                                    </div>
                                    <div class="col-sm-6">
                                        <!--<?//= Html::submitButton($model->isNewRecord?'Add':'Update', ['class' => 'btn btn-success pull-right btn_prog']) ?>-->
                                        <br><br><?= Html::a('Update', ['questionnaire/update','id'=>$model->id], ['class' => 'btn btn-success pull-right']) ?>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12">
                                <!--<?//= Html::a('Update', ['questionnaire/update','id'=>$model->id], ['class' => 'btn btn-success']) ?>-->
                                    
                                        <label class="control-label">Test Link</label>
                                        <div class="form-group field-questionnaire-name has-success">
                                            <input type="text" id="myInput" class="form-control" name="Questionnaire[link]" value="<?= Yii::$app->urlManager->createAbsoluteUrl(["questionnaire/my-login","id"=>base64_encode($model->id)]);?>" readonly="" aria-invalid="false">
                                            <div class="help-block"></div>
                                        </div>	
                                    </div>

                                </div>
                                <!--<?//php ActiveForm::end(); ?>-->
                            </div>
                        </div>
                        <!-- End Example Basic Form -->
                <?php ActiveForm::end(); ?>

                                                    
                    </div>

                    
                </div>
            </div>
            
<!--start 123-->
<div class="panel-body">
<?php
                        $array = [
                            ['id' => 10, 'name' => 'Active'],
                            ['id' => 0, 'name' => 'Inactive'],
                        ];
                        ?>
						<div class="table-responsive">
						<?= GridView::widget([
							'dataProvider' => $dataProvider,
							// 'filterModel' => $searchModel,
							'columns' => [
								['class' => 'yii\grid\SerialColumn'],

								//'id',
								// 'name',
								[
									'attribute' => 'name',
									// 'value' => 'description',
									'contentOptions' => ['style' => 'width:35%; white-space: normal;'],
								],
								//'description:ntext',
                                [
                                    'format'=>'raw',
                                    'label'=>'Options',
                                    'value'=>function($data){
                                        $opts = Options::find()->where(['question_id'=>$data->id])->all();
                                        $ostr = '';
                                        foreach($opts as $opt){
                                            $chk = 0;
                                            if($opt->is_correct == 1){
                                                $chk = 'checked';
                                            }
                                            if($ostr == ''){
                                                $ostr = "<input type='radio' disabled='disabled' $chk/>".$opt->name;
                                            }else{
                                                $ostr = $ostr."<br><input type='radio' disabled='disabled' $chk/>".$opt->name;
                                            }
                                        }
                                        return $ostr;
                                    },
									'contentOptions' => ['style' => 'width:35%; white-space: normal;'],
                                ],
								[
									'attribute' => 'section',
									// 'value' => 'description',
									'contentOptions' => ['style' => 'width:15%; white-space: normal;'],
								],
								//['class' => 'yii\grid\ActionColumn'],
								[
									'class' => 'yii\grid\ActionColumn',
									'template' => '{update}&nbsp;{delete}',

									'buttons' => [
										'update' => function ($url, $model) {
											return Html::a('<span class="icon md-edit"></span>', Yii::$app->getUrlManager()->createUrl(['/question/update', 'id' => $model->id]), [
												'title' => Yii::t('yii', 'View'),
												'data' => [
													'link-to' => 'user-view',
													// 'url' => Yii::$app->getUrlManager()->createUrl(['/user-assignment/index-for-assn', 'assn' => $model->id]),
													// 'no-link' => "true",
												],
											]);
										},
									],
								],
							],
						]); ?>
                        </div>
                    </div>
<!--end 123-->
        </div>
    </div>

</div>