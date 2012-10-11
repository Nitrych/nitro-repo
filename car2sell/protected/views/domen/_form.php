<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'domen-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>55,'maxlength'=>55)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	

	<div class="row">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region'); ?>
		<?php echo $form->dropDownList($model, 'region', CHtml::listData(
			Region::model()->findAll(), 'id', 'name'),
			array('prompt' => 'Выберите регион')
		); ?>
	
		<?php echo $form->error($model,'region'); ?>
	</div>

	
	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->