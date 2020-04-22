<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\ProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Question';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page"><!-- program-index -->
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
                                  aria-controls="exampleCollapseDefaultLevel">
                             Question
                                </a>
                        </div>
						<div class="panel-collapse collapse in" id="exampleCollapseDefaultLevel" aria-labelledby="exampleHeadingDefaultLevel"
                    role="tabpanel">
							<div class="panel-body">
								<div class="form-inline padding-bottom-15">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <!--<a href="javascript:void(0);" data-no-link="true" id="addRowBtn" class="btn btn-success btn-sm"><i class="icon md-plus" aria-hidden="true"></i>Add New
                                                Level</a>-->
											<?= Html::a('Create Question', ['create'], ['class' => 'btn btn-success']) ?>
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
						<div class="table-responsive">
						<?= GridView::widget([
							'dataProvider' => $dataProvider,
							'filterModel' => $searchModel,
							'columns' => [
								['class' => 'yii\grid\SerialColumn'],

								//'id',
								'name',
								//'description:ntext',
								
								//'status',
								//'created_at',
								//'updated_at',
								//'created_by',
								//'updated_by',

								//['class' => 'yii\grid\ActionColumn'],
								[
									'class' => 'yii\grid\ActionColumn',
									'template' => '{update}&nbsp;{delete}',
								],
							],
						]); ?>
                            
                        </div>
                        </div>
                        </div>
                        </div>
                    </div>
                    <!-- End Panel Add &amp; Remove Rows -->
                </div>
            </div>
        </div>
    
	
    
</div>
