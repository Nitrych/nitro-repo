<div id="content">

<h2 class="bold fs_lh_14_18 color_62">Регистрация и изменение пароля</h2>
<div class="registraion-form br_4 bd_e3">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'registration-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php //echo $form->errorSummary($reg_form); ?>

	<div class="row">
		<?php echo $form->labelEx($reg_form,'username'); ?>
		<?php echo $form->textField($reg_form,'username', array('class'=>'wt_gr br_4')); ?>
		<?php echo $form->error($reg_form,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($reg_form,'email'); ?>
		<?php echo $form->textField($reg_form,'email', array('class'=>'wt_gr br_4')); ?>
		<?php echo $form->error($reg_form,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($reg_form,'password'); ?>
		<?php echo $form->passwordField($reg_form,'password', array('class'=>'wt_gr br_4')); ?>
		<?php echo $form->error($reg_form,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($reg_form,'re_password'); ?>
		<?php echo $form->passwordField($reg_form,'re_password', array('class'=>'wt_gr br_4')); ?>
		<?php echo $form->error($reg_form,'re_password'); ?>
	</div>

	<?php if(FALSE)://CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($reg_form,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($reg_form,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($reg_form,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Зарегестироваться'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
