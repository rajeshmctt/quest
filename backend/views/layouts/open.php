<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use backend\models\enums\DirectoryTypes;
use backend\models\enums\UserTypes;
use common\models\User;
use common\models\Payment;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\helpers\Url;
use yii\widgets\Breadcrumbs;
use common\widgets\Alert;
use common\widgets\Toastr;
use yii\web\View;
use common\models\Notification;


AppAsset::register($this);
//$dashboardNotifications = Yii::$app->user?Yii::$app->user->identity->dashboardNotifications:[];
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="icon" type="image/x-icon" href="/img/favicon.ico">
    <?php $this->head() ?>
    <!--stylesheet-->
    <?php $this->registerCssFile("@web/css/bootstrap-editable.css"); ?>
    <?php $this->registerCssFile("@web/css/bootstrap.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/bootstrap-extend.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/site.min3f0d.css?v2.2.0"); ?>

    <!--skintools-->
    <?php //$this->registerCssFile("@web/css/skintools.min3f0d.css?v2.2.0");?>
    <?php //$this->registerJsFile('@web/js/skintools.min.js');?>

    <!--plugins-->
    <?php $this->registerCssFile("@web/css/animsition.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/asScrollable.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/switchery.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/asSpinner.min3f0d.css"); ?>
    <?php $this->registerCssFile("@web/css/introjs.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/slidePanel.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/flag-icon.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/waves.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/toastr.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/summernote.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/font-awesome/font-awesome.min3f0d.css?v2.2.0"); ?>


    <?php $this->registerCssFile("@web/css/sweet-alert.css"); ?>
    <?php $this->registerCssFile("@web/css/modals.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/checkBo.min.css"); ?>
    <?php $this->registerCssFile("@web/css/chosen.min.css"); ?>
    <?php $this->registerCssFile("@web/css/clockpicker.min3f0d.css"); ?>
    <?php $this->registerCssFile("@web/css/bootstrap-datetimepicker.css"); ?>

    <!-- Page -->
    <?php //$this->registerCssFile("@web/css/login-v3.min3f0d.css?v2.2.0");?>
    <?php $this->registerCssFile("@web/css/v1.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/toastr.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/alerts.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/summernote.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/rating.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/social.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/chartjs.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/chart.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/chartist.min3f0d.css?v2.2.0"); ?>

    <!--fonts-->
    <?php $this->registerCssFile("@web/css/material-design.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile("@web/css/brand-icons.min3f0d.css?v2.2.0"); ?>
    <?php $this->registerCssFile('https://fonts.googleapis.com/css?family=Roboto:400,400italic,700'); ?>
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans" rel="stylesheet">

    <?php $this->registerJsFile('@web/js/modernizr.min.js', ["position" => View::POS_HEAD], 'modernizer'); ?>
    <?php $this->registerJsFile('@web/js/breakpoints.min.js', ["position" => View::POS_HEAD], 'breakpoint'); ?>


    <?php $this->registerJs('Breakpoints();', View::POS_HEAD, 'breakpoint-call'); ?>

</head>
<body class="dashboard site-navbar-small">


<?= toastr::widget() ?>
<?php $this->beginBody() ?>
<!--[if lt IE 8]>
<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade
    your browser</a> to improve your experience.</p>
<![endif]-->

<nav class="site-navbar navbar navbar navbar-fixed-top navbar-mega navbar"
     role="navigation">
    <div class="navbar-header">
        
    </div>

    <div class="navbar-container container-fluid">
        <button type="button" class="navbar-toggle hamburger hamburger-close navbar-toggle-left hided"  
                data-toggle="menubar">
            <span class="sr-only">Toggle navigation</span>
            <span class="hamburger-bar"></span>
        </button>
        <button type="button" class="navbar-toggle collapsed btmore" data-target="#site-navbar-collapse"
                data-toggle="collapse">
            <i class="icon md-more" aria-hidden="true"></i>
        </button>
        <!-- Navbar Collapse -->
        <div class="collapse navbar-collapse navbar-collapse-toolbar" id="site-navbar-collapse">
            <!-- Navbar Toolbar Right -->
            <ul class="nav navbar-toolbar navbar-right navbar-toolbar-right">
                <li class="dropdown">
                    <a class="navbar-avatar dropdown-toggle" data-toggle="dropdown" href="#" aria-expanded="false"
                       data-animation="scale-up" role="button">
              <span class="avatar avatar-online">
              </span>
                    </a>


                </li>
            </ul>
            <!-- End Navbar Toolbar Right -->
        </div>
        <!-- End Navbar Collapse -->
    </div>
</nav>
<div class="site-menubar">
<div class="site-menubar-body">
<div>
    <div>
    <ul class="site-menu">
        <li>
            <a href="#" style="position:relative"><!-- Yii::$app->urlManager->createAbsoluteUrl("site/index"); -->
                <?php 
					$log1 =  Url::to('@web/img/group-271.jpg', true); 
					$log2 = str_replace('http','https',$log1);
				?>
				<img src="img/group-271.jpg?v=2" srcset="img/group-271@2x.jpg 2x, img/group-271@3x.jpg 3x" class="Group-271">
                <!--<span class="site-menu-title lmstitle">LMS Quest</span>-->
            </a>
        </li>
        <li class="site-menu-item">
            <a href="#"><!-- Yii::$app->urlManager->createAbsoluteUrl("site/index"); -->
                <!--<i class="site-menu-icon md-home" aria-hidden="true"></i>-->
                <span class="site-menu-title"></span><!--Home-->
            </a>
        </li>
        <?php 
            $session = Yii::$app->session;
            $chsess = $session->get('choose'); 
            // echo "<pre>".$chsess; exit;
            if($chsess==1){
        ?>
        <li class="site-menu-item">
            <a href="<?= Yii::$app->urlManager->createAbsoluteUrl(["site/index",'choose'=>$chsess]); ?>">
                <i class="site-menu-icon md-bookmark" aria-hidden="true"></i>
                <span class="site-menu-title">Change App</span>
            </a>
        </li>
            <?php } ?>
        

</ul>
</div>
</div>
</div>
</div>


<?= $content ?>


<!-- Footer -->
<footer class="site-footer">
    <!--<div class="site-footer-legal">© <?= date('Y'); ?> <a href="#">InMuto Consulting LLP</a></div>-->
    <div class="site-footer-legal">© <?= date('Y'); ?> <a target="_blank" rel="noopener noreferrer" href="https://quest.meeraq.com/">InMuto Consulting Pvt Ltd
	</a></div>
    <div class="site-footer-right">
        <!--Crafted with <i class="red-600 icon md-favorite"></i> by <a href="http://fierydevs.com">Fierydevs</a>-->
		<img src="<?php echo Url::to('@web/images/logo2.jpg', true); ?>" class="profile-photo image responsive" id="profile-photo" height="20" alt="logo Image"/>
    </div>
</footer>
<!-- Core  -->

<?php echo $this->render("change_password_popup"); ?>

<?php $this->registerJs('
		// $("nav").css("position","fixed");
		$("#mainLogout").on("click",function(e){
			e.preventDefault();
			var url = $(this).attr("href");
			var login = "'.Yii::$app->urlManager->createAbsoluteUrl("site/login").'";
			$.ajax({
				type:"post",
				url:url,
                contentType:"application/json; charset=utf-8",
                dataType:"json"
            });
			// HANDLING IE LOGOUT ISSUE 24-2-2020
            // location.reload();
			setTimeout(function(){ window.location.replace(login); }, 1000);
			// window.location.replace(login);
		});
		$("#mainLogout2").on("click",function(e){
			e.preventDefault();
			var url = $(this).attr("href");
			var login = "'.Yii::$app->urlManager->createAbsoluteUrl("site/login").'";
			$.ajax({
				type:"post",
				url:url,
                contentType:"application/json; charset=utf-8",
                dataType:"json"
			});
			// HANDLING IE LOGOUT ISSUE 24-2-2020
			setTimeout(function(){ window.location.replace(login); }, 1000);
		});
		$(".toastclose").on("click",function(e){
			$("#toast-top-right").remove();
			
		
		});
		$(".change-password").on("click", function() {
			$.ajax({
				url: "' . Yii::$app->urlManager->createUrl('site/change-password') . '",
				data: {},
				method: "POST",
				success: function(data) {
					$("#modal-content-password").html(data);
					$("#examplePasswordPopup").modal("show");
				},
				error: function(error) {
					
				}
			});
		});
		
		if ($(window).width() < 750) {
		   // alert("Less than 750");
		   $(".site-menu-title").css("color","#fff");
		   $(".btmore").hide();
		   $(".editpr").show();
		   $(".logout").show();
		   // $(".row").css("margin-right","0");
		   // $(".row").css("margin-left","0");
		   $(".example-wrap").parent().css("padding","0");
		}
		else {
		   // alert("More than 750");
		   // $(".site-menu-title").css("color","#e65a00");
		   $(".clientlnk").show();
		   $(".editpr").hide();
		   $(".logout").hide();
		}
		console.log($(window).width());
	// $(document).ready(function() {
		// $("#examplePasswordPopup").hide();
	// });
			
			
			
		
		
		
', View::POS_END, 'logout');?>

<?php echo $this->render("_js_css_includes"); ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
