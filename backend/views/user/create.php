<?php

use backend\models\enums\UserTypes;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\user */

$this->title = 'Add Participant';
$this->params['breadcrumbs'][] = ['label' => 'Participants', 'url' => ['user/index','type' => 5]];
// $this->params['breadcrumbs'][] = ['label' => 'Participants', 'url' => [Yii::$app->urlManager->createAbsoluteUrl(['index', 'type' => 5])]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page user-create">

    <?php if(!Yii::$app->request->isAjax){?>
		<div class="page-header">
			<h1 class="page-title"><?= Html::encode($this->title) ?></h1>
			<ol class="breadcrumb">
				<li><a href="<?= Yii::$app->urlManager->createAbsoluteUrl("site/index");?>" data-link-to='site'>Home</a></li>
				<?php foreach($this->params['breadcrumbs'] as $k=>$v){
					if(isset($v['label'])){
						echo "<li><a href=".Yii::$app->urlManager->createAbsoluteUrl($v['url'])." data-link-to='category-index'>".$v['label']."</a></li>";
					}else{
						echo "<li class='active'>$v</li>";
					}
				}?>
			</ol>
		</div>
	<?php }?>
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
