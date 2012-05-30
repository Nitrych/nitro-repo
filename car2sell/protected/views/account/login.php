<div id="content">

<h2 class="bold fs_lh_14_18 color_62">Авторизация</h2>
<div class="registraion-form br_4 bd_e3">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<?php //echo $form->errorSummary($reg_form); ?>

	<div class="row">
		<?php echo $form->labelEx($login_form,'email'); ?>
		<?php echo $form->textField($login_form,'email', array('class'=>'wt_gr br_4')); ?>
		<?php echo $form->error($login_form,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($login_form,'password'); ?>
		<?php echo $form->passwordField($login_form,'password', array('class'=>'wt_gr br_4')); ?>
		<?php echo $form->error($login_form,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->checkBox($login_form,'rememberMe'); ?>
		<?php echo $form->label($login_form,'rememberMe'); ?>
		<?php echo $form->error($login_form,'rememberMe'); ?>
	</div>

	<?php if(FALSE)://CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($login_form,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($login_form,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($login_form,'verifyCode'); ?>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Войти'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

</div>
