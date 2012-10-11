<?php

$this->pageTitle=Yii::app()->name . ' - Пополнение баланса'; ?>

<h1>Пополнение баланса</h1>

<?php include('./protected/views/components/user_menu.php'); ?>
<div style="width:500px; margin: 0 auto; ">
	
<h2 class="bold fs_lh_14_18 color_62 mrgin_10_0">Зачисление на баланс через ROBOKASSA</h2>
<div id="contact_form" class="br_4 bd_e3" style="width:500px; margin: 0 auto; margin-top: 20px">
<?php if(Yii::app()->user->hasFlash('balance')): ?>
<div class="confirmation">
<?php echo Yii::app()->user->getFlash('balance'); ?>
</div>
<?php else: ?>


<div class="yiiForm">

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($model); ?>

<div class="row">
<?php echo CHtml::activeLabel($model,'summ',array('class'=>'bold color_0 f_left ta_right')); ?>
<?php echo CHtml::activeTextField($model,'summ',array('class'=>'wt_gr br_4')); ?> руб.
</div>

</div>
	
	



	<div class="row buttons">
		<span class="br_3 button">
			<?php echo CHtml::submitButton('Отправить', array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
		</span>
</div>

<br><br>

<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
<?php endif; ?>

</div>

</div>