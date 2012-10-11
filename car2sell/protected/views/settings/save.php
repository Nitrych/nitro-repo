<?
$this->layout = 'admin';

?>

<div class="well">
	<!--h2 class="top">Update Config <?php echo $model->key; ?></h2-->

	<?php echo $this->renderPartial('_form',array('model'=>$model)); ?>
</div>