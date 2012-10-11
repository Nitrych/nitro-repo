<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'username', array('class'=>'bold color_0 f_left ta_right')); ?>
		<?php echo $form->textField($model,'username',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email', array('class'=>'bold color_0 f_left ta_right')); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password', array('class'=>'bold color_0 f_left ta_right')); ?>
		<?php echo $form->passwordField($model,'password',array('size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	
	<div class="row">
		
		<?php echo $form->hiddenField($model,'created_date'); ?>
		
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_active', array('class'=>'bold color_0 f_left ta_right')); ?>
		<?php echo $form->checkBox($model,'is_active', array('checked'=>'checked')); ?>
		<?php echo $form->error($model,'is_active'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone_number', array('class'=>'bold color_0 f_left ta_right')); ?>
		<?php echo $form->textField($model,'phone_number',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'phone_number'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'skype', array('class'=>'bold color_0 f_left ta_right')); ?>
		<?php echo $form->textField($model,'skype',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'skype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'icq', array('class'=>'bold color_0 f_left ta_right')); ?>
		<?php echo $form->textField($model,'icq',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'icq'); ?>
	</div>

	<div class="row">
                <?php echo $form->labelEx($model, 'region', array('class'=>'bold color_0 f_left ta_right')); ?>
                <span class="relative in_bl">
                    <?php echo $form->dropdownlist($model, 'region', $dropdown, array('class'=>'form_region wt_gr br_4')); ?>
                    <?php echo $form->error($model, 'region'); ?>
                </span>
    </div>
   <div class="row">
                <?php echo $form->labelEx($model, 'city', array('class'=>'bold color_0 f_left ta_right')); ?>
                <span class="relative in_bl">
                    <?php echo $form->dropdownlist($model, 'city', array('not'=>'Выбрать'), array('class'=>'form_city wt_gr br_4')); ?>
                    <?php echo $form->error($model, 'city'); ?>
                </span>
  </div>
<div class="row">
		<?php echo $form->labelEx($model,'roles', array('class'=>'bold color_0 f_left ta_right')); ?>
		<?php echo $form->dropdownlist($model,'roles',array('user' => 'user', 'admin' => 'admin'),array('class'=>'form_city wt_gr br_4')); ?>
		<?php echo $form->error($model,'roles'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Создать' : 'Сохранить'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->