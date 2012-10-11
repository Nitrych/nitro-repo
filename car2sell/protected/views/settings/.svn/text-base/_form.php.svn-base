<?
$this->layout = 'admin';
?>

<?php $form=$this->beginWidget('bootstrap.widgets.BootActiveForm',array(
	'id'=>'Config-form',
	'enableAjaxValidation'=>false,
)); ?>

	<?php echo $form->errorSummary($model); ?>
    
	<b><?=$model->title?></b>
	<br><br>
	<?php $form->textFieldRow($model,'key',array('class'=>'span5','maxlength'=>64)); ?>

	<input type="hidden" name="Config_key" value="<?=$model->key?>">
	<?php echo $form->textFieldRow($model,'value',array('class'=>'span5','maxlength'=>255)); ?>

	<div class="form-actions">
		<?php $this->widget('bootstrap.widgets.BootButton', array(
			'buttonType'=>'submit',
			'type'=>'primary',
			'label'=>$model->isNewRecord ? 'Create' : 'Сохранить',
		)); ?>
	</div>

<?php $this->endWidget(); ?>
