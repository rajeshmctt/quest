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

$this->title = isset($model)?$model->name:'No active Assessment';//'Questions of Assessment: '.
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page assessment-index"><!-- program-index -->
		<!--<div class="page-header">
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
        </div>-->
		<div class="page-content">
            <div class="row row-lg mgcut">
                <div class="col-lg-12">
                    <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
					<?php if($model!=''){?>
					<div class="panel" style="<?= ($model=='')?'display:none':'' ?>">
                        <div class="panel-heading" id="exampleHeadingDefaultLevel" role="tab">
                         <a class="panel-title collapsed" id="panel-theme" data-toggle="collapse" href="#exampleCollapseDefaultLevel"
                                  data-parent="#exampleAccordionDefault" aria-expanded="true"
                                  aria-controls="exampleCollapseDefaultLevel">
								              <?= Html::encode($this->title) ?>
                                </a>


                        </div>
						<div class="panel-collapse collapse in" id="exampleCollapseDefaultLevel" aria-labelledby="exampleHeadingDefaultLevel"
                    role="tabpanel">
							<div class="panel-body">
								<!--<div class="form-inline padding-bottom-15" style="display:none">
									<div class="row" style="display:none">
										<div class="col-sm-4">
											<p><b>Assessment: </b><?=$model->name?></p>
										</div>
										<div class="col-sm-4">
											<p><b>Category: </b><?=$model->category->name?></p>
										</div>
									</div>
									<div class="row">
										<div class="col-sm-8">
											<p><b>Description: </b><?=$model->description ?></p>
										</div>
									</div>
									<div class="row row-lg">
										<div class="col-sm-10 col-md-offset-1">
										</div>
									</div>
								</div>--->



					<?php $form = ActiveForm::begin(['options' => ['data-link-to' => 'assessment-answers-create']]); ?>
<?php
	$count =  count($dataProvider->getModels()); 
	foreach($dataProvider->getModels() as $mod){
		
	$model_name = $mod->name; //question-> 
	
?>
<div class="tab">


<div class="row">
                                  <div class="col-sm-8">
                                  </div>
                                </div>

                                
<div class="list-item col-sm-12 col-md-12 rescard" data-key="<?= $mod->id ?>"><!--article-->
    <!--<a href="https://coach-to-transformation.com"> $model_name-->
	

                                      <div style="padding-left:20px; padding-bottom:20px"><p><?=$model->description ?></p></div>

	<div class="incardasm"> <!--incardasn-->
		<div class="row tp_res" >
			<div class="col-xs-12" >
			
			
  
  
				<!--<h3><?=$mod->section ?></h3>--><!--HIDDEN SECTION temporarily RDM 13may-->
				<br>
				<!--<span><?=$model_name ?></span><br>-->
				<?php 
					/*foreach($qkey as $k=>$val){
						if($val == $key)
							echo $k+1 .". ";
					}*/
				?>
				<h5><?=$model_name ?></h5>
					<?php 
					$ans = '';
					// echo "<pre>"; print_r($mod->options); exit;		
					foreach($mod->options as $opt){?>
						<input type="radio" id="o<?=$opt->id?>" name="<?=$mod->id?>" value="<?=$opt->id?>" >
						<label for="o<?=$opt->id?>">
							<?= $opt->name ?>
						</label><br>
					<?php }
					?>
					<?php if(1){
						if($mod->status == 1){?>
							<div class="answer"><?php  //style="width:450px;"
							for($i=0;$i<=5;$i++){
					?>
							<input type="radio" name="AssessmentAnswers[<?= $mod->id ?>]" id="<?= $mod->id.$i ?>" value="<?= $i ?>"> <label for="<?= $mod->id.$i ?>"><?= $i ?></label>&nbsp;&nbsp;&nbsp;&nbsp;
					<?php 	
							}?>
							<div style="width:250px"><span>Lowest</span><span class="pull-right">Highest</span></div>
							</div>
							<?php 
						}
					} ?>
				
  
  
			</div>
		</div>
		<!--<br><div class="row tp_res" >
			
		</div><br>-->
	</div>
	
	<!--</a>--><!--article-->
</div>

</div>
	<?php } ?>
	
<div style="text-align:center;margin-top:40px;">
<?php for($i=0;$i<$count;$i++){?>
    <span class="step"></span>
<?php } ?>
	
	  <div style="overflow:auto; padding-top:20px">
		<div style="float:right;">
		  <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
		  <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
		  <input type="submit" id="js-submit-form" name="submit" value="Submit" style="background-color:#4CAF50; color:#fff; display: none;">
		</div>
	  </div>
	  
	  
  </div>

						<div class="form-group form-material">
							<!--<?//= Html::submitButton('Submit', ['class' => 'btn btn-success pull-right']) ?>-->
							<!--<?//= Html::submitButton((isset($model->id)?'Update':'Add'), ['class' => 'btn btn-success pull-right']) ?>-->
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

<?php
Yii::$app->view->registerCss('
* {
  box-sizing: border-box;
}

body {
  background-color: #f1f1f1;
}

#regForm {
  background-color: #ffffff;
  margin: 100px auto;
  font-family: Raleway;
  padding: 40px;
  width: 70%;
  min-width: 300px;
}

h1 {
  text-align: center;  
}

input {
  padding: 10px;
  /*width: 100%;*/
  font-size: 17px;
  font-family: Raleway;
  border: 1px solid #aaaaaa;
}

/* Mark input boxes that gets an error on validation: */
input.invalid {
  background-color: #ffdddd;
}

/* Hide all steps by default: */
.tab {
  display: none;
}

button {
  background-color: #4CAF50;
  color: #ffffff;
  border: none;
  padding: 10px 20px;
  font-size: 17px;
  font-family: Raleway;
  cursor: pointer;
}

button:hover {
  opacity: 0.8;
}

#prevBtn {
  background-color: #bbbbbb;
}

/* Make circles that indicate the steps of the form: */
.step {
  height: 15px;
  width: 15px;
  margin: 0 2px;
  background-color: #bbbbbb;
  border: none;  
  border-radius: 50%;
  display: inline-block;
  opacity: 0.5;
}

.step.active {
  opacity: 1;
}

/* Mark the steps that are finished and valid: */
.step.finish {
  background-color: #4CAF50;
}

');

?>
<?php
Yii::$app->view->registerJs('
var xlen = '. $count .';
var currentTab = 0; // Current tab is set to be the first tab (0)
showTab(currentTab); // Display the current tab

function showTab(n) {
  // This function will display the specified tab of the form...
  var x = document.getElementsByClassName("tab");
  x[n].style.display = "block";
  //... and fix the Previous/Next buttons:
  if (n == 0) {
    document.getElementById("prevBtn").style.display = "none";
  } else {
    document.getElementById("prevBtn").style.display = "inline";
  }
 console.log(n);
  if (n == (xlen - 1)) {
	  //(x.length - 1)
	  // (xlen - 1)
	  console.log("yes");
		// document.getElementById("nextBtn").innerHTML = "Submit";
	  document.getElementById("nextBtn").style.display = "none";
	  // $("#js-submit-form").show();
	   document.getElementById("js-submit-form").style.display = "inline";
  } else {
	  console.log("no");
		document.getElementById("nextBtn").innerHTML = "Next";
	  document.getElementById("nextBtn").style.display = "inline";
	   document.getElementById("js-submit-form").style.display = "none";
  }
  //... and run a function that will display the correct step indicator:
  fixStepIndicator(n)
}

function nextPrev(n) {
  // This function will figure out which tab to display
  var x = document.getElementsByClassName("tab");
  // Exit the function if any field in the current tab is invalid:
  // if (n == 1 && !validateForm()) return false;
  // Hide the current tab:
  x[currentTab].style.display = "none";
  // Increase or decrease the current tab by 1:
  currentTab = currentTab + n;
  // if you have reached the end of the form...
  if (currentTab >= xlen) { 
	//x.length
    // ... the form gets submitted:
    document.getElementById("regForm").submit();
    return false;
  }
  // Otherwise, display the correct tab:
  showTab(currentTab);
  console.log(xlen);
}

function validateForm() {
  // This function deals with validation of the form fields
  var x, y, i, valid = true;
  x = document.getElementsByClassName("tab");
  y = x[currentTab].getElementsByTagName("input");
  // A loop that checks every input field in the current tab:
  /*for (i = 0; i < y.length; i++) {
    // If a field is empty...
    if (y[i].value == "") {
      // add an "invalid" class to the field:
      y[i].className += " invalid";
      // and set the current valid status to false
      valid = false;
    }
  }*/
  // If the valid status is true, mark the step as finished and valid:
  if (valid) {
    document.getElementsByClassName("step")[currentTab].className += " finish";
  }
  return valid; // return the valid status
}

function fixStepIndicator(n) {
  // This function removes the "active" class of all steps...
  var i, x = document.getElementsByClassName("step");
  for (i = 0; i < xlen; i++) { 
  //x.length
    x[i].className = x[i].className.replace(" active", "");
  }
  //... and adds the "active" class on the current step:
  x[n].className += " active";
}

', \yii\web\View::POS_END);?>