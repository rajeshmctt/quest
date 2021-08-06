<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 9/30/2016
 * Time: 6:51 PM
 */
use backend\models\enums\UserTypes;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ListView;
use backend\models\enums\DirectoryTypes;
use common\models\Assignment;
use common\models\UserAssignment;
use common\models\Invoice;

if(Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN) {
    $this->title = 'Participant Report';
	$this->params['breadcrumbs'][] = $this->title;
}else{
    $this->title = 'Report';
	$this->params['breadcrumbs'][] = $this->title;
}
?>
<div class="page">
		<div class="page-header">
            <h1 class="page-title"><?= Html::encode($this->title) ?></h1>
            <ol class="breadcrumb">
                <li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index"); ?>"
                       data-link-to="site">Home</a></li>
                <?php foreach ($this->params['breadcrumbs'] as $k => $v) {
                    if (isset($v['label'])) {
                        echo "<li><a href=" . Yii::$app->urlManager->createAbsoluteUrl($v['url'][0]) . ">" . $v['label'] . "</a></li>";
                    } else {
                        echo "<li class='active'>$v</li>";
                    }
                }?>
            </ol>
        </div>

<div class="page-content">
    <div class="row row-lg mgcut">
        <div class="col-lg-12">
            <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
                <div class="panel">
                    <div class="panel-heading" id="exampleHeadingDefaultLevel" role="tab">
                        <a class="panel-title collapsed" id="panel-theme" data-toggle="collapse" href="#exampleCollapseDefaultLevel"
                           data-parent="#exampleAccordionDefault" aria-expanded="true"
                           aria-controls="exampleCollapseDefaultLevel" data-no-link="true">
                            <?= Html::encode($this->title) ?>
                        </a>
                    </div>
                    <div class="panel-collapse collapse in" id="exampleCollapseDefaultLevel" aria-labelledby="exampleHeadingDefaultLevel" role="tabpanel">
                        <div class="panel-body">
                             <?php // ListView::widget([
                                 /*'dataProvider' => $dataProvider,
                                 'itemView' => function ($model) {

                                     return $this->render('_competency_list', ['dataProvider' => $model]);
                                 },

                             ]);*/?>
                             <!-- <?/*php echo $this->render('_pr_search', [
                                 'model' => $searchModel,
                               ])*/?>  -->
                             <?php
							 //if(isset($search)){	// 13-2  //// initial search(remove if()) for all data 29-5
								$columns = [
                               
                               //'client.first_name',
									[
										'label' => 'Name',
										//'attribute' => 'assignment.coach.email',
										//'attribute' => 'assignment_id',
										'value' =>  function($data){
											//return 'assignment.coach.first_name'.' '.'assignment.coach.last_name' ;
											return $data->username;
										},
									],
									[
										'label' => 'Score',
										//'attribute' => 'assignment.coach.email',
										// 'attribute' => 'assignment_id',
										'value' =>  function($data){
											//return 'assignment.coach.first_name'.' '.'assignment.coach.last_name' ;
											$corr = 0;
											$tot = 0;
											foreach($data->answers as $ans){
												if($ans->question->questionnaire_id == 5){
													if($ans->option->is_correct){
														$corr++;
													}
													$tot++;
												}
											}
											return $corr."/".$tot;
										},
										'contentOptions' => ['style' => 'width:35%; white-space: normal;'],
									],
									/*[
										'label' => 'Client Email',
										'attribute' => 'client.email',
									],*/
									[
										// 'format'=>'raw',
										// 'label'=>'File(s) [Click on the files to Download]',
										'header'=>'Percentage',  //<br><span class="red-theme">*Click on the filename to Download</span>
										'value'=>function($data){
											$corr = 0;
											$tot = 0;
											foreach($data->answers as $ans){
												if($ans->question->questionnaire_id == 5){
													if($ans->option->is_correct){
														$corr++;
													}
													$tot++;
												}
											}
											return ($tot==0)?"0%":(100 * $corr/$tot)."%";
										}
									],
                                ];
                             	?>
								<div class="table-responsive">
                             <?= GridView::widget([
                                 'dataProvider' => $dataProvider,
                                 'columns'=>$columns,
                                 ]);
								 
							 //}	//13-2  // initial search for all data 29-5?>


							</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>