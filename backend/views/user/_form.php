<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\user */
/* @var $form yii\widgets\ActiveForm */
?>

<!--<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'auth_key')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_hash')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password_reset_token')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'role')->textInput() ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'updated_at')->textInput() ?>

    <?= $form->field($model, 'verification_token')->textInput(['maxlength' => true]) ?>

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
                                    Add Category
                                </h3>-->
                                <?php $form = ActiveForm::begin(['options' => ['data-link-to' => 'category-create']]); ?>
                                
                                <div class="form-group row">
                                    <div class="col-sm-6">
                                        <label class="control-label">Name</label>
                                        <?= $form->field($model, 'username')->textInput()->label(false) ?>										
                                    </div>
                                </div>                                
                                <div class=" form-group row"><!-- form-material-->
                                    <div class="col-sm-6">
                                        <label class="control-label">Email</label>
                                        <?=  ($model->isNewRecord) ? $form->field($model, 'email')->textInput()->label(false) : $form->field($model, 'email')->textInput(['readonly'=>true])->label(false) ?>
                                        <!--<?//= $form->field($model, 'email')->textArea()->label(false) ?>-->
                                    </div>
									<div class="col-sm-6">
										<label class="control-label">Password</label><!--<span class="red-theme">*</span>-->
										<?= $form->field($model, 'password_hash')->passwordInput(['readonly'=>true,'value'=>'12345'])->label(false) ?>
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
