<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Compose Message"); ?>


<?
$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Сообщение пользователю'
	//$model->title,
);
?>

<h1>Сообщение пользователю</h1>

<?php
	//$this->breadcrumbs=array(
	//	MessageModule::t("Messages"),
	//	MessageModule::t("Compose"),
	//);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation'); ?>



<div class="contact_form">
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-form',
		'enableAjaxValidation'=>false,
	)); ?>

	
     <div class="yiiForm">
	<?=Helper::SiteNote()?>
	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php 
		//echo $form->labelEx($model,'receiver_id',array('class'=>'bold color_0 f_left ta_right')); 
		?>
		<?php 
		//echo CHtml::textField('receiver', $receiverName, array('class'=>'wt_gr br_4')) 
				?>
		<?php echo $form->hiddenField($model,'receiver_id'); ?>
		<?php echo $form->error($model,'receiver_id'); ?>
	</div>

	<div class="row">
		
			
		<?php if(Yii::app()->user->isGuest): ?>
		    <?php echo $form->labelEx($model,'subject',array('class'=>'bold color_0 f_left ta_right')); ?>
			<?php echo $form->textField($model,'subject',array('class'=>'wt_gr br_4')); ?>
		
		<?php else: ?>
			<?php echo $form->hiddenField($model,'subject'); ?>
		<?php endif; ?>
		
		<?php echo $form->error($model,'subject'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'body',array('class'=>'bold color_0 f_left ta_right')); ?>
		<?php echo $form->textArea($model,'body',array('rows'=>6, 'cols'=>50,'class'=>'wt_gr br_4')); ?>
		<?php echo $form->error($model,'body'); ?>
	</div>

	<div class="row">
	<?php echo CHtml::activeLabel($model,'verifyCode',array('class'=>'bold color_0 f_left ta_right')); ?>
	<?php echo "".CHtml::activeTextField($model,'verifyCode',array('class'=>'wt_gr br_4')); ?>
	<br>
	
	</div>
	<div class="row" id="captcha" >
		<?php 
		
		$temp = $this->widget('CCaptcha',array(),true);
		$temp = str_replace("/message/compose","/post",$temp);
		echo $temp;
		
		?>

	</div>
	</div>

	
	<div class="row buttons" style="padding-left: 95px;">
		<span class="br_3 button">
		<?php echo CHtml::submitButton(MessageModule::t("Отправить"), array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
		</span>	
	</div>
	
	<?php $this->endWidget(); ?>


	
</div>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_suggest'); ?>
