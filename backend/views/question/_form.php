<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\Url;
use common\models\Questionnaire;
use backend\models\enums\DirectoryTypes;
/* @var $this yii\web\View */
/* @var $model common\models\Program */
/* @var $form yii\widgets\ActiveForm */
?>

<!--<div class="program-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>-->
<div class="page-content container-fluid">
        <div class="panel">
            <div class="panel-body">
                <div class="row row-lg">
                    <div class="col-sm-10 col-md-offset-1">
                        <!-- Example Basic Form -->

                        <div class="example-wrap">
                            <div class="example">
                                <!--<h3 class="example-theme">
                                    Add Question
                                </h3>-->
                                <?php $form = ActiveForm::begin(['options' => ['data-link-to' => 'question-create']]); ?>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label">Question Name</label>
                                        <?= $form->field($model, 'name')->textInput()->label(false) ?>										
                                    </div>
                                </div>  
                                <div class=" form-group row"><!-- form-material-->
                                    <div class="col-sm-6">
                                        <label class="control-label">Questionnaire</label>
                                        <?= $form->field($model, 'questionnaire_id')->label(false)->widget(Select2::classname(), [
											//'name' => 'User[location_id]',
											//'id' => 'location', // location 6-4-18
											//'value' => $location_name, // initial value
											'data' => Questionnaire::getAll(),
											'options' => ['placeholder' => 'Select Questionnaire', 'id' => 'qstnre'],
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
                                        <label class="control-label">Options (Select the correct answer)</label><br>
                                        <!--<div class="col-sm-12">
                                            <?//= $form->field($model, 'status')->radio(['label' => 'yes', 'value' => 1])?>
                                        </div>-->
                                        <!--<div class="col-sm-12">-->
                                            <!--<input type="radio" id="o1" name="select" value="1">
                                            <label for="male">
                                                <input type="text" id="option1-name" class="form-control" name="Option[1]" aria-invalid="false">
                                            </label><br>
                                            <input type="radio" id="o2" name="select" value="2">
                                            <label for="female">
                                                <input type="text" id="option2-name" class="form-control" name="Option[2]" aria-invalid="false">
                                            </label><br>
                                            <input type="radio" id="o3" name="select" value="3">
                                            <label for="other">
                                                <input type="text" id="option3-name" class="form-control" name="Option[3]" aria-invalid="false">
                                            </label><br>
                                            <input type="radio" id="o4" name="select" value="4">
                                            <label for="other">
                                                <input type="text" id="option4-name" class="form-control" name="Option[4]" aria-invalid="false">
                                            </label>-->
                                            <?php for($i=1;$i<=4;$i++){?>
                                                <input type="radio" id="o<?=$i?>" name="select" value="<?=$i?>" <?=isset($oarr)?($oarr[$i]['is_correct']==1)?'checked':'':''?> >
                                                <label for="o<?=$i?>">
                                                    <input type="text" id="option<?=$i?>-name" class="form-control" name="Option[<?=$i?>]" aria-invalid="false" value="<?=isset($oarr)?$oarr[$i]['name']:''?>">
                                                </label><br>    
                                            <?php } ?>
                                        <!--</div>-->
                                    </div>
                                </div>


                                <div class="form-group form-material">
                                    <?= Html::submitButton($model->isNewRecord?'Add':'Update', ['class' => 'btn btn-success pull-right btn_prog']) ?>
                                </div>
                                <!--<?//php ActiveForm::end(); ?>-->
                            </div>
                        </div>
                        <!-- End Example Basic Form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
	<div class="modal fade modal-fade-in-scale-up modal-theme" id="viewAgreement" aria-hidden="true"
         aria-labelledby="exampleModalTitle" role="dialog" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content agreement-modal" id="modal-content">
                
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>

<?php

$this->registerJs('
function readURL(input) {
    console.log(879282);
    if (input.files && input.files[0]) {
		var reader = new FileReader();
        reader.onload = function (e) {
            $("#program-photo").attr("src", e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
$(document).ready(function(){
    

	var agn = $(".agreement_temp option:selected").text();
	console.log(agn);
	$("#agnam").html(agn);
		
	$(".agreement_temp").change(function(){
		var agn = $(".agreement_temp option:selected").text();
		console.log(agn);
		$("#agnam").html(agn);
	});
	
	$("#program-file_id").change(function(){
		readURL(this);
		console.log("test2");
	});
	$("#text").hide();
	$("#common-name").hide();
	$("#save").click(function(){
		if($("#save").prop("checked")== true){
			$("#text").show();
		}
		else{
			$("#text").hide();
		}
    });
	$(".agreement_temp").change(function() {
        var id = $(".agreement_temp option:selected").val();
         $.ajax({
                    type:"GET",
                    url: "' . Yii::$app->getUrlManager()->createUrl(['agreement/search-model']) . '",
                    data: {id: id},
                    success: function (data) {
                        $("#summernote").code(data);
                    }
            });
    });
	$(".btn_prog").click(function(){
		$(".hidden_agreement").val($("#summernote").code());
		/*if($("#summernote").code()=="")
		{
			// $(".agreement_error").show();
			$(".agreement_error").show();
			return false;
		}
		else
		{
			$(".agreement_error").hide();
			return true;
		}*/

		/*var level_value=$("#user-level_id").val();
		if(level_value==null)
		{
			$(".error_level").show();
			return false;
		}
		else
		{
			$(".error_level").hide();
			return true;
		}*/
	});
});
');