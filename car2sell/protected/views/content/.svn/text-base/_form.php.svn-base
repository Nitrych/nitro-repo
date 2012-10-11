<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'content-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>
		<?php echo $form->textField($model,'title',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'slug'); ?>
		<?php echo $form->textField($model,'slug',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'slug'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'content'); ?>
		<?
		 
		  $this->widget('ext.ckeditor.CKEditorWidget',array(
		  "model"=>$model,                 # Data-Model
		  "attribute"=>'content',          # Attribute in the Data-Model
		  //"defaultValue"=>"Test Text",     # Optional

		  # Additional Parameter (Check http://docs.cksource.com/ckeditor_api/symbols/CKEDITOR.config.html)
		  "config" => array(
			  "height"=>"400px",
			  "width"=>"100%",
			  "toolbar"=>"Full",
			  ),

		  #Optional address settings if you did not copy ckeditor on application root
		  "ckEditor"=>Yii::app()->basePath."/../ckeditor/ckeditor.php",
										  # Path to ckeditor.php
		  "ckBasePath"=>Yii::app()->baseUrl."/ckeditor/",
										  # Realtive Path to the Editor (from Web-Root)
		  ) );
		?>
		
		<?php echo $form->error($model,'content'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'parent_id'); ?>
		<?php echo $form->dropdownlist($model, 'parent_id', $parents, array('class'=>'wt_gr br_4')); ?>
		<?php echo $form->error($model,'parent_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->