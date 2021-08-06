<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 10/3/2016
 * Time: 3:23 PM
 */
use backend\models\enums\UserTypes;
use common\models\Batches;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
<?php $form = ActiveForm::begin([
    'action' => ['part-report'],
    'method' => 'get',
]); ?>
<div class="row">
	<?php if(yii::$app->user->identity->role == UserTypes::SUPER_ADMIN){?>
<div class="col-md-3">
<?= Html::dropDownList('batch',isset($_GET['batch'])?$_GET['batch']:null,Batches::getBatches(),['class'=>'form-control','prompt'=>'Select Batch']);?>
</div>
	<?php }?>


						<div class="col-sm-3 col-xs-12" style="display:none">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="icon md-calendar"></span>
								</span>
								<?php if(Yii::$app->request->get('start_date') != "")
								{
									$start_dt = Yii::$app->request->get('start_date');
								}?>
								<input type="text" name="start_date" data-provide="datepicker" id="start_date" class="form-control"
									   placeholder="Start Date" value="<?=isset($start_dt)? $start_dt:''?>" >
							</div>
						</div>


						<div class="col-md-3 col-xs-12" style="display:none">
							<div class="input-group">
								<span class="input-group-addon">
									<span class="icon md-calendar"></span>
								</span>
								<?php if(Yii::$app->request->get('end_date') != "")
								{
									$end_dt = Yii::$app->request->get('end_date');
								}?>
								<!--<input type="text" name="end_date" class="form-control"  id="end_date" data-provide="datepicker" placeholder="End Date" value="<?= isset($end_dt)?$end_dt:date("m/d/Y")?>"   >-->
								<input type="text" name="end_date" class="form-control"  id="end_date" data-provide="datepicker" placeholder="End Date" value="<?= isset($end_dt)?$end_dt:''?>" >
							</div>
						</div>

<div class="col-md-3">
    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-success', 'name' => 'search']) ?>
        <?= Html::submitButton( '<i class="icon md-download"></i> Export To Excel', ['class' => 'btn btn-info', 'name' => 'export']) ?>
    </div>
</div>
</div>

<?php ActiveForm::end(); ?>
<?php $this->registerJs('
$(document).ready(function(){
$("#end_date").datepicker("setEndDate",new Date());

});

');?>
