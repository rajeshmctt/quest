<?php
// YOUR_APP/views/list/_list_item.php

use yii\helpers\Html;
use yii\helpers\Url;
use backend\models\enums\DirectoryTypes;
use backend\models\enums\QuestionTypes;
?>
<?php 
// echo "<pre>"; print_r($model); exit; // Yii::$app->getUrlManager()->createUrl(["resource/view-res",'rid'=>$model->id])
// $model_name = Html::encode($model['name']);
$model_name = $model->name; //question->
$img_sr = Url::to('@web/images/profile_pic.png', true);
$arr = [];
// foreach($model->assignment->assignmentMedia as $am){
	// $arr[] = "<span class='label label-success'><a  style='color:white;text-decoration: none;' href=". (isset($am->media)?DirectoryTypes::getParticipantDirectory(true) . $am->media->file_name:'' )." download>".$am->media->alt."</a></span>";
// }
// $files = implode(", ",$arr);
// if($model->status==0){
	// $status = '<span class="label  label-danger">Pending</span>';
// }else if($model->status==3){
	// $status =  '<span class="label  label-warning">Submitted but not approved</span>';
// }else if($model->status==6){
	// $status = '<span class="label  label-primary">Resubmit</span>';
// }else{
	// $status = '<span class="label label-success">Completed</span>';
// }
// echo "<pre>"; print_r($arr); exit;

?>
<div class="list-item col-sm-12 col-md-12 rescard" data-key="<?= $model['id'] ?>"><!--article-->
    <!--<a href="https://coach-to-transformation.com"> $model_name-->
	
	<div class="incardasm"> <!--incardasn-->
		<div class="row tp_res" >
			<div class="col-xs-8" >
				<!--<span><?=$model_name ?></span><br>-->
				<h5><?php foreach($qkey as $k=>$val){
						if($val == $key)
							echo $k+1 .". ";
					}
				?>
				 <?=$model_name ?></h5>
					<?php 
					$ans = '';
					// echo "<pre>"; print_r($model->options); exit;		
					foreach($model->options as $opt){?>
						<input type="radio" id="o<?=$opt->id?>" name="<?=$model->id?>" value="<?=$opt->name?>" >
						<label for="o<?=$opt->id?>">
							<?= $opt->name ?>
						</label>
					<?php }
					?>
					<?php if(1){
						if($model->status == 1){?>
							<div class="answer"><?php  //style="width:450px;"
							for($i=0;$i<=5;$i++){
					?>
							<input type="radio" name="AssessmentAnswers[<?= $model->id ?>]" id="<?= $model->id.$i ?>" value="<?= $i ?>"> <label for="<?= $model->id.$i ?>"><?= $i ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php 	
							}?>
							<div style="width:250px"><span>Lowest</span><span class="pull-right">Highest</span></div>
							</div>
							<?php 
						}
					} ?>
			</div>
		</div><br>
		<div class="row tp_res" >
			
		</div><br>
	</div>
	
	<!--</a>--><!--article-->
</div>