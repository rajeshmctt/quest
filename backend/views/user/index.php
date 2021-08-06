<?php

use backend\models\enums\ICFTypes;
use backend\models\enums\UserTypes;
use common\models\Organization;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\web\View;

/* @var $this yii\web\View */
/* @var $searchModel common\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = $type == UserTypes::PARTICIPANT ? 'Participants' : 'Faculty';
$this->params['breadcrumbs'][] = $this->title;
?>

    <!-- Page -->
<div class="page">
    <?php if (!Yii::$app->request->isAjax) { ?>
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
    <?php } ?>
    <div class="page-content container-fluid">
        <div class="row row-lg mgcut">
            <div class="col-lg-12">
                <div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
                    <div class="panel">
                        <div class="panel-heading" id="exampleHeadingDefaultCoachindex" role="tab">
                            <a class="panel-title collapsed" id="panel-theme" data-toggle="collapse"
                               href="#exampleCollapseDefaultCoachindex"
                               data-parent="#exampleAccordionDefault" aria-expanded="true"
                               aria-controls="exampleCollapseDefaultCoachindex">
                                <?= Html::encode($this->title) ?>
                            </a>
                        </div>
                        <div class="panel-collapse collapse in" id="exampleCollapseDefaultCoachindex"
                             aria-labelledby="exampleHeadingDefaultCoachindex" role="tabpanel">
                            <div class="panel-body">
                                <div class="form-inline padding-bottom-15">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <?= Html::a(($type == UserTypes::PARTICIPANT ? 'Add Participant' : 'Add Faculty'), [($type == UserTypes::PARTICIPANT ?'create-participant':'create-faculty')], ['class' => 'btn btn-success']) ?>
												<!--<?php $label = $type == UserTypes::PARTICIPANT ? 'Add Participant' : 'Add Coach'; ?>
                                                <a href="javascript:void(0);" data-no-link="true" id="addRowBtn" class="btn btn-success btn-sm"><i
                                                        class="icon md-plus" aria-hidden="true"></i><?= $label; ?></a>-->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel" id="user_panel" style="display: none;">
                                    <div class="panel-heading">
                                        <h5><?= $label; ?></h5>
                                    </div>

                                        <div class="row row-lg mgcut">
                                             <div class="col-sm-10 col-md-offset-1">
                                                <div class="example-wrap">
                                                    <div class="example">
                                        
													</div>
                                                </div>
                                             </div>
                                        </div>

                                </div>

                            <?php
                            $array = [
                                ['id' => 10, 'name' => 'Active'],
                                ['id' => 0, 'name' => 'Inactive'],
                            ];
                            ?>
                            <?php
                            $columns = [
                                [
									'label' => 'Name',
									/*'label' => function($data){
										if ($data->role == UserTypes::CLIENT) {
											return 'Client Name';
										}else{
											return 'Coach Name';
										}
									},*/
									//'attribute' => 'assignment.coach.email',
									// 'attribute' => 'fullName',
									'attribute' => 'username',
									/*'value' =>  function($data){
										//return 'assignment.coach.first_name'.' '.'assignment.coach.last_name' ;
										return $data->first_name .' '. $data->last_name ;
									},*/
								],
								'email',
                            ];
                            ?>
                            <?php
                            if (Yii::$app->user->identity->role == UserTypes::FACULTY) {
                                $columns[] = [

                                    'label' => 'Location',
                                    'value' => function ($model) {
										foreach($model->userLocations as $ul){
											$loc = isset($ul->location)?$ul->location->name:'';
										}
										return $loc;
										
									},
                                    //'filter' => Html::activeDropDownList($searchModel, 'organization_id', ArrayHelper::map(Organization::find()->where(['status' => 10])->asArray()->all(), 'id', 'name'),['class'=>'form-control','prompt' => 'Select Organization']),

                                ];

                            } ?>
						<?php	if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN){
								$columns[] = [
									'format' => 'raw',
									'attribute' => 'status',
									'value' => function ($model) {
										if ($model->status == 10) {
											return '<span class="label label-lg label-success">Active</span>';
										} else {
											return '<span class="label label-lg label-danger">Inactive</span>';
										}
									},
									'contentOptions' => function ($model) {
										return [
											// 'class' => Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN ? $model->agreement_content != "" ?'client_status editable-pointer': '' : '',
											'class' => Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN ? 'client_status editable-pointer': '',
											'data-pk' => $model->id,
											'data-value' => $model->status,

										];
									},
									'filter' => Html::activeDropDownList($searchModel, 'status', ArrayHelper::map($array, 'id', 'name'), ['class' => 'form-control', 'prompt' => 'Select Status']),
								];

							?>

                           <?php
                            $columns[] = [
                                'header'=>'View / Delete',
                                'class' => 'yii\grid\ActionColumn',
                                'template' => '{view}{delete}&nbsp;&nbsp;&nbsp;{agreement}',

                                'buttons' => [
                                    'view' => function ($url, $model) {
                                        return Html::a('<span class="icon md-eye"></span>', Yii::$app->getUrlManager()->createUrl(['/user/update', 'id' => $model->id]), [
                                            'title' => Yii::t('yii', 'View'),
                                            'data' => [
                                                'link-to' => 'user-view',
                                            ],
                                        ]);
                                    },
                                    'delete' => function ($url, $model) {
                                        return $model->status == 10 ? "&nbsp;&nbsp;&nbsp;" . Html::a('<span class="icon md-delete"></span>', '#', [
                                            'title' => Yii::t('yii', 'Deactivate'),
                                            'class' => 'swal-warning-confirm',
                                            'data' => [
                                                'url' => Yii::$app->getUrlManager()->createUrl(['/user/delete', 'id' => $model->id]),
                                                'no-link' => "true",
                                            ],
                                        ]) : '';
                                    },
                                    'agreement' => function ($url, $model) {
                                        return $model->role == UserTypes::CLIENT ? $model->agreement_content == '' ? Html::a('<span class="icon md-assignment client_agreement" data-id=' . $model->id . '></span>', "javascript:void(0);", [
                                            'title' => Yii::t('yii', 'Agreement'),
                                        ])  : '' : '';
                                    },
                                ],
                            ];
						}
                            ?>
							<div class="table-responsive">
                            <?= GridView::widget([

                                'dataProvider' => $dataProvider,
                                'filterModel' => $searchModel,
                                'columns' => $columns,

                            ]); ?>
							</div>
                </div>
             </div>
          </div>
         </div>
        </div>
    </div>
  </div>
</div>
    


<?php
Yii::$app->view->registerJs("
     function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#profile-photo').attr('src', e.target.result);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

	$(document).ready(function() {

		$('.error').hide();
		$('.error1').hide();
		$('.error_level').hide();


	  $('#other_txt').hide();

	     $('#user-media_id').innerHTML = '';
            $('#user-media_id').change(function(){
                readURL(this);
            });
                $('#user-media_id').click(function() {
                    $('input[id=\"profile-photo\"]');
                });

         $('#other_chk').on('click', function() {
            if ($(this).is(':checked')) {
                $('#other_txt').show();
            } else {
                $('#other_txt').hide();
            }
        });

        $('#email').focusout(function(e) {
          var email = $(this).val();
          $.ajax({
                    type:'GET',
                    url: '" . Yii::$app->getUrlManager()->createUrl(["user/validate-email"]) . "',
                    data: {email: email},
                    success: function (data) {
                         if(data == 1){
                            $('#email_error').show();
                         }

                         else
                            $('#email_error').hide();
                    }
            });

        });
         $('.client_agreement').on('click', function() {
            var client_id = $(this).data('id');
            $('.hidden_client_id').val(client_id);
           /*alert(client_id);*/
              $('#viewAgreement').modal('show');
        });

        $('#assign_agreement').on('click', function() {
           var client_id = $('.hidden_client_id').val();
          /* alert(client_id);*/
           var content = $('#summernote').code();
           if(client_id!=''){
                  $.ajax({
                    type:'GET',
                    url: '" . Yii::$app->getUrlManager()->createUrl(["user/assign-agreement"]) . "',
                    data: {client_id: client_id,content: content},
                    success: function (data) {
                      /* alert(data);*/
                    }
            });
           }
        });

        var status = " . json_encode($status) . ";
        $.fn.editable.defaults.ajaxOptions = {type: 'get'}
        $.fn.editable.defaults.mode = 'inline';

		$('.username').editable({
			type: 'text',
			name: 'username',
			//toggle: 'manual',
			url: '" . Yii::$app->getUrlManager()->createUrl(['user/update']) . "',
			title: 'Enter Username',
			validate: function(value) {
                if($.trim(value) == '') {
                    return 'Username is required';
                }
                /*if($.inArray($.trim(value), all_users) !== -1){
                    return 'Username is already exist.';
                }*/
            }
		});

		$('.contact_no').editable({
			type: 'text',
			name: 'contact_no',
			url: '" . Yii::$app->getUrlManager()->createUrl(['user/update']) . "',
			title: 'Enter Contact No',
			validate: function(value) {
                if(!$.isNumeric($.trim(value)) || $.trim(value).length<10) {
                    return 'Enter Valid Contact No.';
                }
            }
		});

		$('.client_status').editable({
            type: 'select',
            name: 'status',
			url: '" . Yii::$app->getUrlManager()->createUrl(['user/update']) . "',
			source: status,
			title: 'Select Status',
        });

	 /*$('#country').change(function() {
  
            var inputVal = $(this).val();
            var numericReg = /^[a-zA-Z]+(\s[a-zA-Z]+)?$/i;
            if(!numericReg.test(inputVal)) {
                $(this).val(' ');
                $('span#select2-country-container').html(' ');
                $('.error').show();
            }
	        else
	        {
		        $('.error').hide();
	        }
        });


        $('#location').change(function() {
  
            var inputVal = $(this).val();
            var numericReg = /^[a-zA-Z]+(\s[a-zA-Z]+)?$/i;
            if(!numericReg.test(inputVal)) {
                $(this).val(' ');
                $('span#select2-country-container').html(' ');
                $('.error1').show();
             }
            else
            {
                 $('.error1').hide();
            }
        });*/

		$('#addRowBtn').click(function(e) {
		     $('#user_panel').animate( { height: 'toggle' }, 800, 'linear' )
          .delay( 500 )
		});

		 $('.agreement_temp').change(function() {
        var id = $('.agreement_temp option:selected').val();
         $.ajax({
                    type:'GET',
                    url: '" . Yii::$app->getUrlManager()->createUrl(["agreement/search-model"]) . "',
                    data: {id: id},
                    success: function (data) {
                        $('#summernote').code(data);
                    }
            });
    });

		$('#sub_client').click(function(){
            $('.hidden_agreement').val($('#summernote').code());
            var level_value=$('#user-level_id').val();
            if(level_value==null)
            {
                $('.error_level').show();
                return false;
            }
            else
            {
                $('.error_level').hide();
                return true;
            }
	});
	$('#sub_coach').click(function(){
       $('.hidden_agreement').val($('#summernote').code());
	});
       
        
		$('document').ready(function(){
		var maskList = $.masksSort($.masksLoad('" . Url::base() . "/js/phone-codes.json'), ['#'], /[0-9]|#/, 'mask');
		var maskOpts = {
			inputmask: {
				definitions: {
					'#': {
						validator: '[0-9]',
						cardinality: 1
					}
				},
				//clearIncomplete: true,
				showMaskOnHover: false,
				autoUnmask: true
			},
			match: /[0-9]/,
			replace: '#',
			list: maskList,
			listKey: 'mask',
			onMaskChange: function(maskObj, completed) {
				if (completed) {
					var hint = maskObj.name_en;
					if (maskObj.desc_en && maskObj.desc_en != '') {
						hint += ' (' + maskObj.desc_en + ')';
					}
					$('#descr').html(hint);
				} else {
					$('#descr').html('');
				}
				$(this).attr('placeholder',' ');
			}
		};

		$('#phone_mask').change(function() {
			if ($('#phone_mask').is(':checked')) {
				$('#customer_phone').inputmasks(maskOpts);
			} else {
				$('#customer_phone').inputmask('+[####################]', maskOpts.inputmask)
				.attr('placeholder',' ');
				$('#descr').html('');
			}
		});

		$('#phone_mask').change();
	});
	
	$('.checkboxlist').on('change', function() {
            var is_checked= $(this).is(':checked');
		  if (is_checked){
              if($(this).val()=='Other')
              {
                    $('#other_txt').show();
              }
		  }
		  if (!is_checked){
              if($(this).val()=='Other')
              {
                  $('#other_txt').hide();
              }
          }
        });
         $('#other_txt') .focusout(function() {
            if($(this).val()=='')
                $('#other_error').show();
            else
                $('#other_error').hide();
        });
	
	$('#user-organization_id').change(function(){
            var o_id = $('#user-organization_id option:selected').val();
            $.ajax({
                    type:'GET',
                    url: '" . Yii::$app->getUrlManager()->createUrl(['user/search-level']) . "',
                    data: {o_id: o_id},
                    dataType: 'json',
                    success: function (data) {
                             
                              $('#user-level_id').find('option').remove();
                                 $.each(data, function(key, value) {
                                   if(key!=''){
                                         $('#user-level_id').append($('<option></option>').attr('value', key).text(value));
                                        
                                    }
                                 });
                                  $('#user-level_id').prepend('<option value=\"default\" selected=\"selected\">Select Level</option>');
                                  $('#user-level_id option:first').prop('disabled', 'disabled');
                    }
            });
		});
	
	});
	
	

", \yii\web\View::POS_END);