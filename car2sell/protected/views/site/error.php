<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>
<div id="main_block">
    <h2>Error <?php echo $code; ?></h2>

    <div class="error">
    <?php echo CHtml::encode($message); ?>
    </div>
</div>