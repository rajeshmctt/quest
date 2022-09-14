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
                                  Thank you for your responses!
                                </a>
                        </div>
						<div class="panel-collapse collapse in" id="exampleCollapseDefaultLevel" aria-labelledby="exampleHeadingDefaultLevel"
                    role="tabpanel">
							<div class="panel-body">
					
                            <h3 style="text-align:center">
				<!--<div style="width:285px; height:65px;  background-image: url('https://coach-to-transformation.com/wp-content/uploads/2022/03/meeraqSM.png');"></div>-->
				<img src="https://coach-to-transformation.com/wp-content/uploads/2022/03/meeraqSM.png" alt="meeraqlogo"></h3>
            <br>

            <!--hide temporarily-->
			<div class="panel panel-default"><!---->
				<div class="panel-heading">
					<h3 class="panel-title" style="text-align:center">Your Awareness Levels</h3><!--< ?= trim($title) . " Levels" ?>-->
				</div>
				<div class="panel-body">
					<div id="piechart"><!-- style="width: 100%; max-width:900px; height: 500px; "-->
                        <!--< ?php foreach($com as $k=>$v){ ?>
                            <label >< ?=$k?>:</label>
                            <progress value="< ?=$v?>" max="20"> < ?=$v?></progress><br>
                        < ?php } ?>-->
                        <?php $col = ['#eb0081','#b91689','#7a3191','#374e9c','#0463a3']; ?>
                        <table style="width:100%">
                        <?php  
                            $c = 0;
                            foreach($com as $k=>$v){ 
                            
                            ?>
                            <tr>
                                <td style="text-align: right"><?=$k?>&nbsp;&nbsp;</td>
                                <?php for($i=0;$i<$v;$i++){?>
                                <td bgcolor="<?=$col[$c]?>" style="border: 2px solid white; color:<?=$col[$c]?>">-------------</td><!--#a30158-->
                                <?php }
                                for($i=0;$i<$ttl[$k]-$v;$i++){?>
                                    <td bgcolor="#c8c8c8" style="border: 2px solid white; color:#c8c8c8">-------------</td><!--#a30158-->
                                    <?php }
                                ?>
                                <!--space on the right -->
                                <td style="text-align:center"><!--<b>&nbsp;< ?=$v?></b>--></td>
                                <?php for($j=0;$j<(10-$v);$j++){?>
                                <td bgcolor="white" style="color:white" class="bigc">__</td>
                                <?php } ?>
                            </tr>
                        <?php $c++; } ?>
                        </table>
                    </div>
				</div>
			</div>



		<?php if(trim($title)=='IC2Manager Post-assessment' || trim($title)=='IC2Manager Pre-assessment' || trim($title)=='CBTSO Assessment' || trim($title)=='CBTSO Post Assessment'){ ?>
		
		
		<?php if(trim($title)=='IC2Manager Post-assessment'  || trim($title)=='CBTSO Post Assessment'){ ?>
			<p style="font-size:1.2em">
			<!--Discuss the scores with your facilitator during the first session. All the best!	-->
			Now that you have your post-assessment scores, you can compare this with your pre-assessment scores and understand the categories in which you have made progress, and the category which would need extra efforts. Try implementing what you have learnt in this program as much as possible, and you will be able to recognize the improvement in your performance. All the best!
			</p>
			<?php }else{ ?><br>
			<p style="font-size:1.2em">Discuss the scores with your facilitator during the first session. All the best!</p>
			<?php } ?>
		
		<?php }else{ ?>
			<?php if(trim($title)=='Storytelling Skills Pre Assessment'){ ?>
				<p style="font-size:1.2em">Discuss the scores with your facilitator during the first session. All the best!</p>
			<?php }else{ ?>
				<?php if(trim($title)=='EI Post Assessment' ){ ?>
				Now that you have your post-assessment scores, you can compare this with your pre-assessment scores and understand the dimension/s in which you have made progress, and the dimension/s which would need extra efforts. Try implementing what you have learnt in this program as much as possible, and you will be able to recognize the improvement in your emotional quotient. All the best!
				<?php }else{ ?>
				<!--Now that you understand where you are in each dimension, you can start working on any dimension/s you want to improve on. All the best.	-->
                <br><p style="font-size:1.2em">Here is what these parameters mean:</p>
                
                <br>
				<h4>Foundation of coaching  	</h4>
                <p style="font-size:1.2em">Coaching involves the belief that the individual has the answers to their own problems within them. The coach is not a subject expert, but rather is focused on helping the individual to unlock their own potential. The focus is very much on the individual and what is inside their head.</p>

<br><h4>Listening with Empathy </h4>
<p style="font-size:1.2em">Empathic listening is a structured listening and questioning technique that allows you to develop and enhance relationships with a stronger understanding of what is being conveyed, both intellectually and emotionally.</p>
<br><h4>Asking questions with curiosity  	 </h4>
<p style="font-size:1.2em">Curiosity acts as a catalyst to discovery. Being curious when asking our questions means we are neither judgmental nor expecting a certain answer. On the contrary, we are becoming more welcoming and open to unknown space and have the questioning ability that allows us to navigate the employee’s thinking in the best possible way. </p>
<br>
<h4>Action Planning & Support </h4>
<p style="font-size:1.2em">A coaching action plan is meant to develop the employee’s skills, guide them towards a specific outcome, and complete goals faster, easier, and more efficiently. A good employee coaching plan for managers should continually serve as a guideline for the continuation of the employee’s growth even after her time with his coach is up.
</p>
<br>
<p style="font-size:1.2em">We have curated the course structure in a way that will enable you to experience a shift in these areas after the course.</p>

				<?php } ?><br>
				<p style="font-size:1.2em">Happy Learning! </p>
			<?php } ?>
		<?php } ?>
	</p>
    <!--<div style="width:285px; height:65px;  background-image: url('https://coach-to-transformation.com/wp-content/uploads/2022/03/meeraqSM.png');"></div>-->
    <img src="https://coach-to-transformation.com/wp-content/uploads/2022/03/meeraqSM.png" alt="meeraqlogo" style="margin-left: -3px;">
    <!--<p style="font-size:1.2em">Regards,<br>
Team Meeraq</p>-->




					

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
/*th, td {
    border: 1px solid;
  }*/
  
@media screen and (max-width: 767px) {
    .bigc{
        display:none;
    }
}

');?>