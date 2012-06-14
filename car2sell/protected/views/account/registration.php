<div id="content">
	<div id="padding_box">
		<h2 class="bold fs_lh_14_18 color_62 mrgin_10_0">Регистрация и изменение пароля</h2>
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
				<?php echo $form->labelEx($reg_form, 'email', array('class'=>'bold color_0 f_left ta_right')); ?>
				<span class="relative in_bl">
					<?php echo $form->textField($reg_form, 'email', array('class'=>'wt_gr br_4')); ?>
					<?php echo $form->error($reg_form, 'email', array('text'=>'<span>a</span>')); ?>
				</span>
			</div>

			<div class="row">
				<?php echo $form->labelEx($reg_form, 'password', array('class'=>'bold color_0 f_left ta_right')); ?>
				<span class="relative in_bl">
					<?php echo $form->textField($reg_form, 'password', array('class'=>'wt_gr br_4')); ?>
					<?php echo $form->error($reg_form, 'password', array('text'=>'<span>a</span>')); ?>
				</span>
			</div>

			<div class="row">
				<?php echo $form->labelEx($reg_form, 're_password', array('class'=>'bold color_0 f_left ta_right')); ?>
				<span class="relative in_bl">
					<?php echo $form->textField($reg_form, 're_password', array('class'=>'wt_gr br_4')); ?>
					<?php echo $form->error($reg_form, 're_password', array('text'=>'<span>a</span>')); ?>
				</span>
			</div>

			<div class="row">
				<label class="bold color_0 f_left ta_right required" style="height:40px;"></label>
				<?php echo $form->checkBox($reg_form,'accept'); ?>
				Я соглашаюсь с правилам использования сервиса, а также с передачей и обработкой моих данных в car2sell Я подтверждаю своё совершеннолетие и ответственность за размещение объявления.
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

			<div class="row buttons ta_center">
				<span class="br_3 button">
					<?php echo CHtml::submitButton('Отправить', array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
				</span>
			</div>

		<?php $this->endWidget(); ?>

		</div><!-- registraion-form -->
	</div><!-- padding_box -->
</div><!-- content -->
