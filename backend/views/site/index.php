<?php

/* @var $this yii\web\View */
use backend\models\enums\SessionStatusTypes;
use backend\models\enums\UserTypes;
use yii\widgets\ActiveForm;
use common\models\User;
use common\models\Batches;
use common\models\Announcement;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\web\Controller;
use yii\web\View;
use yii\helpers\Url;
use backend\models\enums\DirectoryTypes;

$this->title = 'LMS Quest';
?>
<?php if(isset($choose) && $choose==1){
	$this->title = 'CTT';
	?>
	<div class="counter-label text-capitalize" style="height:100%; width:100%" class="text-center">
				<div class="parts " >
					<?php if($caas->role==1 || $caas->role==2 || $caas->role==3 || $caas->role==4 ){?>
					<h1 class="chh1" style="background:#006666" >
						<?php 
							$path = Yii::$app->urlManager->createAbsoluteUrl("site/index"); 
							if(strpos($path,'lmslocal')!== false){
								$caaspath = str_replace('lmslocal','coach-to-transform',$path);
							}else{
								$caaspath = str_replace('lms','caas',$path);
							}
						?><!---  \yii\helpers\Url::to('https://coach-to-transformation.com/caas/backend/web/index.php'); -->
						<a class="text-center link-theme" href="<?= $caaspath ?>"> Caas</a>
					</h1>
					<?php }else{?> 
					<h1 class="chh1" style="background:#5d5d5d"><!--003366-->
						<!--<a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index"); ?>">-->
							<span class="link-theme">CaaS</span>
						<!--</a>-->
					</h1>
					<?php } ?>
				</div>
				<!--http://www.coachasaservice.com/admin/backend/web/index.php?r=site%2Findex-->
				<div class="parts" >
					<?php if(Yii::$app->user->identity->role==1 || Yii::$app->user->identity->role== 6 || Yii::$app->user->identity->role== 5){?>
					<h1 class="chh1" style="background:#e65a00">
						<a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index"); ?>"> LMS</a>
					</h1>
					<?php }else{?> 
					<h1 class="chh1" style="background:#5d5d5d"><!--003366-->
						<!--<a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index"); ?>">-->
							<span class="link-theme">LMS Quest</span>
						<!--</a>-->
					</h1>					
					<?php } ?>
				</div>
				<div class="parts" >
					<?php if($ces->role==1 || $ces->role==7){?>
					<h1 class="chh1" style="background:#003366">
						<?php 
							$path = Yii::$app->urlManager->createAbsoluteUrl("site/index"); 
							if(strpos($path,'lmslocal')!== false){
								$cpath = str_replace('lmslocal','ecosystem',$path);
							}else{
								$cpath = str_replace('lms','ecosystem',$path);
							}
						?>
						<a class="link-theme" href="<?= $cpath ?>">CES</a>
					</h1>
					<?php }else{?> 
					<h1 class="chh1" style="background:#5d5d5d"><!--003366-->
						<!--<a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index"); ?>">-->
							<span class="link-theme">CES</span>
						<!--</a>-->
					</h1>
					<?php } ?>
				</div>
				<div class="parts chh2" style="background:#e65a00">
					
					<div class="pull-left">
						<!--© <?= date('Y'); ?> <a target="_blank" rel="noopener noreferrer" href="https://coach-to-transformation.com/">-->
						Coach-To-Transformation
						<!--</a>-->
					</div>
					<div class="pull-right">
						<a class="animsition-link" id="mainLogout3" href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/logout2"); ?>">
							<i class="site-menu-icon md-power" ></i>Logout
						</a>
						<!--<img src="<?php echo Url::to('@web/images/logo2.jpg', true); ?>" class="profile-photo image responsive" id="profile-photo" width="15" height="20" alt="logo Image"/>-->
					</div>
					
				</div>
			</div>
<?php }else{ ?>
<div class="page">
	
    <div class="site-index">
        <div class="page-content">

            <?php if (Yii::$app->user->identity->role == UserTypes::SUPER_ADMIN) { ?>
                <div class="panel dashboard-panel">
                    <div class="panel-body container-fluid">
                        <div class="row">
                            <div class="col-md-3 col-xs-12">
                                <div class="widget">
                                    <div class="widget-content padding-30 bg-blue-custom-600">
                                        <div class="widget-watermark darker font-size-60 margin-15"><i
                                                class="icon md-graduation-cap" aria-hidden="true"></i></div><!--md-balance-->
                                        <div class="counter counter-md counter-inverse text-left">
                                            <div class="counter-number-group">
                                                <!--<span class="counter-number"><?= "$ program_count" ?></span>
                                                <span class="counter-number-related text-capitalize">Categories</span>-->
                                            </div>
                                            <div class="counter-label text-capitalize"><a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl("category/index"); ?>"> Manage Category</a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <div class="widget">
                                    <div class="widget-content padding-30 bg-red-600">
                                        <div class="widget-watermark darker font-size-60 margin-15"><i
                                                class="icon md-group-work" aria-hidden="true"></i></div>
                                        <div class="counter counter-md counter-inverse text-left">
                                            <div class="counter-number-group">
                                                <!--<span class="counter-number"><?= "$ batch_count" ?></span>
                                                <span class="counter-number-related text-capitalize">Questionnaires</span>-->
                                            </div>
                                            <div class="counter-label text-capitalize"><a class="link-theme"
                                                                                          href="<?= Yii::$app->urlManager->createAbsoluteUrl(["questionnaire/index"]); ?>">
                                                    Manage Questionnaires</a></div>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <div class="widget">
                                    <div class="widget-content padding-30 bg-green-600">
                                        <div class="widget-watermark darker font-size-60 margin-15"><i
                                                class="icon md-accounts" aria-hidden="true"></i></div>
                                        <div class="counter counter-md counter-inverse text-left">
                                            <div class="counter-number-group">
                                                <!--<span class="counter-number"><?= "$ participant_count" ?></span>
                                                <span class="counter-number-related text-capitalize">Questions</span>-->
                                            </div>
                                            <div class="counter-label text-capitalize">
												<a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl(["question/index"]); ?>">Manage Questions</a>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12">
                                <div class="widget">
                                    <div class="widget-content padding-30 bg-orange-600">
                                        <div class="widget-watermark darker font-size-60 margin-15"><i
                                                class="icon md-collection-text" aria-hidden="true"></i></div>
                                        <div class="counter counter-md counter-inverse text-left">
                                            <div class="counter-number-group">
                                               <!-- <span class="counter-number"><?= "$ faculty_count" ?></span>
                                                <span class="counter-number-related text-capitalize">Participants</span>-->
                                            </div>
                                            <div class="counter-label text-capitalize">
												<a class="link-theme" href="<?= Yii::$app->urlManager->createAbsoluteUrl(["user/index","type"=>UserTypes::PARTICIPANT]); ?>">Manage Participants</a>
											</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display:none"> 
                            <div class="col-md-3 col-xs-12 ">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Clients/Organization</h3>
                                    </div>
                                    <div class="example-wrap text-center">
                                            <canvas id="exampleChartjsPie4" height="250" >clients</canvas>
									</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 ">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Sessions/Coaches</h3>
                                    </div>
                                    <div class="example-wrap text-center">
                             <canvas id="exampleChartjsPie5" height="250"></canvas>
                            </div>
                                </div>
                            </div>

                            <div class="col-md-3 col-xs-12 ">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Sessions/Client</h3>
                                    </div>

<div class="example-wrap text-center">
                                            <canvas id="exampleChartjsPie6" height="250"></canvas>
</div>
                                </div>
                            </div>
                            <div class="col-md-3 col-xs-12 ">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h3 class="panel-title">Sessions/Date</h3>
                                </div>
                                <div class="text-center">
                                        <canvas id="exampleChartjsBar4"  height="330" width="280"></canvas>
</div>
                            </div>
                            </div>



                            </div>
                            

                    </div>
                </div>


            <?php }
            if (Yii::$app->user->identity->role == UserTypes::PARTICIPANT || Yii::$app->user->identity->role == UserTypes::FACULTY) {  //Yii::$app->user->identity->role == UserTypes::COACH || 
                
                    if (Yii::$app->user->identity->role == UserTypes::PARTICIPANT ) {
                        ?>
                        <div class="panel dashboard-panel">
                            <div class="panel-body container-fluid">
                                <div class="row">
                                    <div class="col-md-12 col-xs-12 masonry-item">
									</div>
								</div>
                                <div class="row">
								
									<div class="col-md-8 col-xs-12">
                                    
                                        <div class="row">
                                        
                                            <div class="col-md-12 col-xs-12">
                                                <div class="widget">
                                                    <div class="widget-content"><!-- padding-30-->
                                                        <div class="counter counter-md counter-inverse text-left">
                                                            <div class="counter-number-group">
                                                                <span class="counter-number-related text-capitalize indb">Your Programs</span>
                                                            </div>
                                                            <div class="counter-label text-capitalize"><!-- row-->
                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            
                                            
                                            <div class="col-md-12 col-xs-12">
                                                <div class="widget">
                                                    <div class="widget-content"><!-- padding-30 bg-orange-600-->
                                                        <div class="counter counter-md counter-inverse text-left">
                                                            <div class="counter-number-group">
                                                                <span class="counter-number-related text-capitalize indb">Programs you might be interested in</span>
                                                            </div>
                                                            <div class="counter-label text-capitalize">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 col-xs-12">               
                                        <div class="announce"><!--panel dashboard-panel -->
                                            <div class="ann-cont">
                                                <span class="indb">ANNOUNCEMENT</span><br>
                                                <ul class="ann-ct">
                                                    
                                                </ul>
                                            </div>
                                            <div class="ann-img" style="width:100%">
                                                <img src="<?php echo Url::to('@web/images/announce.jpg', true); ?>"class="profile-photo image responsive progpic2" id="profile-photo" width="75" height="75" alt="Announce Image"/>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <?php
                    }

                    if (Yii::$app->user->identity->role == UserTypes::FACULTY) {
                        ?>


                        <div class="panel dashboard-panel">
                            <div class="panel-body container-fluid">

								<div class="row">
                                    <div class="col-md-12 col-xs-12">
										<div class="panel-group" id="exampleAccordionDefault" aria-multiselectable="true" role="tablist">
											<div class="panel">
												<div class="col-md-6">
												<?php
													$array = [
														['id' => 10, 'name' => 'Active'],
														['id' => 0, 'name' => 'Inactive'],
													];
													?>
													<?= GridView::widget([
														'dataProvider' => $dataProvider,
														'filterModel' => $searchModel,
														'columns' => [
															['class' => 'yii\grid\SerialColumn'],

															//'id',
															// 'name',
															[
																'label' => 'Program',
																'attribute' => 'program_id',
																'value' => function ($model) {
																	return $model->program->name;
																},
															],											
															[
																'label' => 'Batch',
																'attribute' => 'name',
																// 'value' => function ($model) {
																	// return $model->program->name;
																// },
															],
															//'program_id',
															
															//['class' => 'yii\grid\ActionColumn'],
															// [
																// 'class' => 'yii\grid\ActionColumn',
																// 'template' => '{update}&nbsp;{delete}',
															// ],
															[
																'header'=>'Participants',
																'class' => 'yii\grid\ActionColumn',
																'template' => '{view}',
																'buttons' => [
																	'view' => function ($url, $model) {
																		return Html::a('<span class="icon md-group"></span>', Yii::$app->getUrlManager()->createUrl(['/user/details', 'batch' => $model->id,'type'=>UserTypes::PARTICIPANT]), [
																			'title' => Yii::t('yii', 'Participants'),
																		]);
																	},
																],
															],
														],
													]); ?>
												</div>
											</div>
										</div>
									</div>
								</div>
                            </div>
                        </div>


                    <?php }

            }
            ?>
        </div>
    </div>
		<?php } ?>
</div>

<?php 
	$chse = 0; 
	$chse = isset($choose)?$choose:0; 
	// echo "testttt ".$chse; exit;
	
?>
<?php
$this->registerJs('

	
	var e1 = [];
	var e2 = [];
	var client_id = $(this).data("id");
	
	setTimeout(function(){
		console.log(e1);
	  
		var e1  = [
				{
					title  : "eventb",
					start  : "2018-03-03",
					end    : "2018-03-05"
				},
				{
					title  : "eventc",
					start  : "2018-03-09T12:30:00",
					allDay : false // will make the time show
				}
			];
		var calendar = $("#calendar").fullCalendar({  
			header: {
				left: "prev,next today",
				center: "title",
				right: "month,agendaWeek,agendaDay,listWeek"
			},
			navLinks: true, 
			editable: false,
			eventLimit: true, 
			events: e2,
			
		});
	},2000);
', View::POS_READY, 'init-calendar');

$this->registerJs('

$(document).ready(function() {
	
	
	
	$("#mainLogout3").on("click",function(e){
		e.preventDefault();
		var url = $(this).attr("href");
		$.ajax({
			type:"post",
			url:url
		});
	});
	
	var chs = '. $chse .';
	console.log(chs);
	if(chs==1){
		$("nav").hide();
		$("footer").hide();
		$(".site-menubar").hide();
		$("body").css({"padding-top":"0px","background":"#003366"});
	}
	var role = '.Yii::$app->user->identity->role.';

	$("#dt").val("'.date("M-d-Y").'");

        $(".rate-update").click(function(){
            var com_id = $(this).data("id");

            var name = "current_value"+com_id;


            var current_val = $("input[name="+name+"]").val();


             $.ajax({
                     type:"GET",
                    url: "' . Yii::$app->getUrlManager()->createUrl(['assignment/add-current-value']) . '",
                    data: {com_id: com_id, current_val:current_val},
                });
         });
if(role=='.UserTypes::CLIENT.'){

        $.ajax({
            type:"GET",
            url: "' . Yii::$app->getUrlManager()->createUrl(['site/get-competencies-for-graph']) . '",
            success: function(data) {
                var obj = JSON.parse(data);

                var barChartData = {
                    labels: obj.competency,
                    scaleShowGridLines: !0,
                    scaleShowVerticalLines: !1,
                    scaleGridLineColor: "#ebedf0",
                    barShowStroke: !1,
                    datasets: [{
                        fillColor: $.colors("blue", 500),
                        strokeColor: $.colors("blue", 500),
                        highlightFill: $.colors("blue", 500),
                        highlightStroke: $.colors("blue", 500),
                        data: obj.start_values
                    }, {
                        fillColor: $.colors("grey", 400),
                        strokeColor: $.colors("grey", 400),
                        highlightFill: $.colors("grey", 400),
                        highlightStroke: $.colors("grey", 400),
                        data: obj.current_values
                    }]
                };

                if(obj.competency=="" && obj.start_values=="" && obj.current_values=="" )
                {
					$(".ul-hide").hide();
					
                $("#exampleChartjsBar").parent().html("<h3 class=\'red-theme\'>No Pre-Post Ratings Yet</h3>").addClass("example-wrap");
                  
                }
                else{
					
                new Chart(document.getElementById("exampleChartjsBar").getContext("2d")).Bar(barChartData);
				
            }
            }
        });

        }


if(role=='.UserTypes::ORGANIZATION.'){
        $.ajax({
            type:"GET",
            url: "' . Yii::$app->getUrlManager()->createUrl(['site/get-sessions-per-coach']) . '",
            success: function(data) {
    var obj = JSON.parse(data);
            var pieData =obj
               if(pieData=="")
            {

              $("#exampleChartjsPie2").parent().html("<h3 class=\'red-theme\'>No Sessions Yet</h3>");

            }
            else
            {

           new Chart(document.getElementById("exampleChartjsPie2").getContext("2d")).Pie(pieData)
}

            }

        });

        $.ajax({
            type:"GET",
            url: "' . Yii::$app->getUrlManager()->createUrl(['site/get-sessions-per-client']) . '",
            success: function(data) {
         var obj = JSON.parse(data);
            var pieData =obj
                if(pieData=="")
            {

              $("#exampleChartjsPie3").parent().html("<h3 class=\'red-theme\'>No Sessions Yet</h3>");

            }
            else
            {

           new Chart(document.getElementById("exampleChartjsPie3").getContext("2d")).Pie(pieData)
}

            }

        });

         $.ajax({
            type:"GET",
            url: "' . Yii::$app->getUrlManager()->createUrl(['site/get-sessions-per-dates']) . '",
            success: function(data) {
                var obj = JSON.parse(data);

                var barChartData = {
                    labels: obj.date_unique,
                    scaleShowGridLines: !0,
                    scaleShowVerticalLines: !1,
                    scaleGridLineColor: "#ebedf0",
                    barShowStroke: !1,
                    datasets: [{
                        fillColor: $.colors("blue", 500),
                        strokeColor: $.colors("blue", 500),
                        highlightFill: $.colors("blue", 500),
                        highlightStroke: $.colors("blue", 500),
                        data: obj.date_session
                    }]
                };

                    if(obj.date_unique=="" && obj.date_session=="")
            {

              $("#exampleChartjsBar3").parent().html("<h3 class=\'red-theme\'>No Sessions Yet</h3>").addClass("example-wrap-custom");

            }
            else
            {
                new Chart(document.getElementById("exampleChartjsBar3").getContext("2d")).Bar(barChartData)
            }
            }
        });

        }


if(role=='.UserTypes::COACH.'){

 $.ajax({
            type:"GET",
            url: "' . Yii::$app->getUrlManager()->createUrl(['site/get-assignment-for-graph']) . '",
            success: function(data) {
         var obj = JSON.parse(data);
            var pieData =obj
               if(pieData=="")
            {

              $("#exampleChartjsPie").parent().html("<h3 class=\'red-theme\'>No Assignments Yet</h3>");

            }
            else
            {

           new Chart(document.getElementById("exampleChartjsPie").getContext("2d")).Pie(pieData)
           }

            }

        });

        $.ajax({
            type:"GET",
            url: "' . Yii::$app->getUrlManager()->createUrl(['site/get-session']) . '",
            success: function(data) {
           var obj = JSON.parse(data);
        var barChartData = {
                    labels: obj.name,
                    scaleShowGridLines: !0,
                    scaleShowVerticalLines: !1,
                    scaleGridLineColor: "#ebedf0",
                    barShowStroke: !1,
                    datasets: [
                     {
                        fillColor: $.colors("grey", 400),
                        strokeColor: $.colors("grey", 400),
                        highlightFill: $.colors("grey", 400),
                        highlightStroke: $.colors("grey", 400),
                        data: obj.clients
                    },{
                        fillColor: $.colors("blue", 500),
                        strokeColor: $.colors("blue", 500),
                        highlightFill: $.colors("blue", 500),
                        highlightStroke: $.colors("blue", 500),
                        data: obj.scheduled
                    },

                    {
                        fillColor: $.colors("orange", 400),
                        strokeColor: $.colors("orange", 400),
                        highlightFill: $.colors("orange", 400),
                        highlightStroke: $.colors("orange", 400),
                        data: obj.cancelled
                    },
                    {
                        fillColor: $.colors("red", 400),
                        strokeColor: $.colors("red", 400),
                        highlightFill: $.colors("red", 400),
                        highlightStroke: $.colors("red", 400),
                        data: obj.paid
                    },
                    {
                        fillColor: $.colors("green", 400),
                        strokeColor: $.colors("green", 400),
                        highlightFill: $.colors("green", 400),
                        highlightStroke: $.colors("green", 400),
                        data: obj.finished
                    },


                    ]
                };

                 if(obj.name=="")
            {

              $("#exampleChartjsBar2").parent().html("<h3 class=\'red-theme\'>No Clients and Sessions Yet</h3>").css("margin-bottom","80px");
			  $(".ul-coach-hide").hide();

            }
            else
            {



                new Chart(document.getElementById("exampleChartjsBar2").getContext("2d")).Bar(barChartData)
}
}
});
}

	if(role=='.UserTypes::SUPER_ADMIN.'){
		console.log($(window).width());
	}

});


'); ?>
