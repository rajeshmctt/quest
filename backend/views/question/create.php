<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\Program */

$this->title = 'Add Question';
$this->params['breadcrumbs'][] = ['label' => 'Question', 'url' => ['question/index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page">

	<?php if(!Yii::$app->request->isAjax){?>
		<div class="page-header">
			<h1 class="page-title"><?= Html::encode($this->title) ?></h1>
			<ol class="breadcrumb">
				<li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index");?>" data-link-to='site'>Home</a></li>
				<?php foreach($this->params['breadcrumbs'] as $k=>$v){
					if(isset($v['label'])){
						echo "<li><a href=".Yii::$app->urlManager->createAbsoluteUrl($v['url'][0])." data-link-to='question-index'>".$v['label']."</a></li>";
					}else{
						echo "<li class='active'>$v</li>";
					}
				}?>
			</ol>
		</div>
	<?php }?>
    <?= $this->render('_form', [
        'model' => $model,
		// 'oarr' => $oarr,
		// 'oarr' => [],
    ]) ?>

</div>
