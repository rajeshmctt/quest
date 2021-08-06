<?php

use yii\helpers\Html;
use yii\grid\GridView;
use backend\models\enums\UserTypes;
use common\models\AssessmentQuestions;
use yii\widgets\ActiveForm;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\AssessmentQuestionsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = isset($model)?$model->name:'No active Assessment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page assessment-index"><!-- program-index -->
		<div class="page-header">
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <!--<ol class="breadcrumb">
                <li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index"); ?>"
                       data-link-to="site">Home</a></li>
                <?php foreach ($this->params['breadcrumbs'] as $k => $v) {
                    if (isset($v['label'])) {
                        echo "<li><a href=" . Yii::$app->urlManager->createAbsoluteUrl($v['url'][0]) . ">" . $v['label'] . "</a></li>";
                    } else {
                        echo "<li class='active'>$v</li>";
                    }
                }?>
            </ol>-->
        </div>
		<div class="page-content">
            <div class="row row-lg mgcut">
                <div class="col-lg-12">
                    <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
					<?php if($model!=''){?>
					<div class="panel" style="<?= ($model=='')?'display:none':'' ?>">
                        <div class="panel-heading" id="exampleHeadingDefaultLevel" role="tab">
                         <a class="panel-title collapsed" id="panel-theme" data-toggle="collapse" href="#exampleCollapseDefaultLevel"
                                  data-parent="#exampleAccordionDefault" aria-expanded="true"
                                  aria-controls="exampleCollapseDefaultLevel" style="text-align:center">
                             Result 
                                </a>
                        </div>
						<div class="panel-collapse collapse in" id="exampleCollapseDefaultLevel" aria-labelledby="exampleHeadingDefaultLevel"
                    role="tabpanel">
							<div class="panel-body">
								<div class="form-inline padding-bottom-15">
									<!--<div class="row">
										<div class="col-sm-4">
											<p><b>Assessment: </b><?=$model->name?></p>
										</div>
										<div class="col-sm-4">
											<p><b>Category: </b><?=$model->category->name?></p>
										</div>
									</div>-->
									<div class="row">
										<div class="col-sm-12" style="text-align:center">
											<h4>You scored <?= $acorr."/".count($qkey) ?> in your assessment.</h4>
										</div>
									</div>
									<div class="row row-lg">
										<div class="col-sm-10 col-md-offset-1">
											
										</div>
									</div>
								</div>
					
					
					<?php $form = ActiveForm::begin(['options' => ['data-link-to' => 'assessment-answers-create']]); ?>
					<?= ListView::widget([
								'options' => [
									'tag' => 'div',
								],
								'dataProvider' => $dataProvider,
								'itemView' => function ($model, $key, $index, $widget) use($qkey,$akey) {   
									$itemContent = $this->render('_list_res_item',['model' => $model,'key'=>$key,'qkey'=>$qkey,'akey'=>$akey]); //

									/* Display an Advertisement after the first list item */
									
									// echo "<pre>"; print_r($itemContent); exit;
									return $itemContent;
								},
								'itemOptions' => [
									'tag' => false,
								],
								'summary' => '',
								
								/* do not display {summary} */
								'layout' => '{items}{pager}',

								'pager' => [
									'firstPageLabel' => 'First',
									'lastPageLabel' => 'Last',
									'maxButtonCount' => 4,
									'options' => [
										'class' => 'pagination col-xs-12'
									]
								],

							]);
							?>
						<div class="form-group form-material">
							<!--<?= Html::submitButton('Submit', ['class' => 'btn btn-success pull-right']) ?>-->
							<!--<?= Html::submitButton((isset($model->id)?'Update':'Add'), ['class' => 'btn btn-success pull-right']) ?>-->
						</div>
						<?php ActiveForm::end(); ?>


						</div>
                        </div>
                        </div>
						<?php } ?>
                        </div>
                    </div>
                    <!-- End Panel Add &amp; Remove Rows -->
                </div>
            </div>
        </div>
    
	
    
</div>
