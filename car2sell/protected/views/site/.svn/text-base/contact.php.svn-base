<?php
//страница с форомой "Контакты"
$this->pageTitle=Yii::app()->name . ' - Контакты'; ?>

<h1>Обратная связь</h1>

<div id="contact_form">
<?php if(Yii::app()->user->hasFlash('contact')): ?>
<div class="confirmation">
<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>
<?php else: ?>

<p>
Если у Вас есть вопрос, отправьте его с помощью этой формы.
</p>

<div class="yiiForm">

<?php echo CHtml::beginForm(); ?>

<?php echo CHtml::errorSummary($contact); ?>

<div class="row">
<?php echo CHtml::activeLabel($contact,'name',array('class'=>'bold color_0 f_left ta_right')); ?>
<?php echo CHtml::activeTextField($contact,'name',array('class'=>'wt_gr br_4')); ?>
</div>
<div class="row">
<?php echo CHtml::activeLabel($contact,'email',array('class'=>'bold color_0 f_left ta_right')); ?>
<?php echo CHtml::activeTextField($contact,'email',array('class'=>'wt_gr br_4')); ?>
</div>
<div class="row">
<?php echo CHtml::activeLabel($contact,'subject',array('class'=>'bold color_0 f_left ta_right')); ?>
<?php echo CHtml::activeTextField($contact,'subject',array('size'=>60,'maxlength'=>128,'class'=>'wt_gr br_4')); ?>
</div>
<div class="row">
<?php echo CHtml::activeLabel($contact,'body',array('class'=>'bold color_0 f_left ta_right')); ?>
<?php echo CHtml::activeTextArea($contact,'body',array('rows'=>6, 'cols'=>50,'class'=>'wt_gr br_4')); ?>
</div>

<?php if(extension_loaded('gd')): ?>
<div class="row">
	<?php echo CHtml::activeLabel($contact,'verifyCode',array('class'=>'bold color_0 f_left ta_right')); ?>
	<?php echo "".CHtml::activeTextField($contact,'verifyCode',array('class'=>'wt_gr br_4')); ?>
	<br>
	
</div>
<div class="row" id="captcha" >
	<?php $this->widget('CCaptcha'); ?>
		
</div>
	
</div>
<?php endif; ?>


	<div class="row buttons">
		<span class="br_3 button">
			<?php echo CHtml::submitButton('Отправить', array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
		</span>
</div>



<?php echo CHtml::endForm(); ?>

</div><!-- yiiForm -->
<?php endif; ?>

</div><!-- contact_form -->