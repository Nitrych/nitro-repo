<div id="content">
	<div id="center_box">
	<h2 class="bold fs_lh_14_18 color_62">Вход в Мои объявления</h2>
		<div class="registraion-form br_4 bd_e3 pding_20">
				<?php $form=$this->beginWidget('CActiveForm', array(
					'id'=>'login-form',
					'enableClientValidation'=>true,
					'clientOptions'=>array(
						'validateOnSubmit'=>true,
					),
				)); ?>

					<?php //echo $form->errorSummary($reg_form); ?>

					<div class="row">
						<?php echo $form->labelEx($login_form, 'email', array('class'=>'bold color_0 f_left ta_right')); ?>
						<span class="relative in_bl">
							<?php echo $form->textField($login_form, 'email', array('class'=>'wt_gr br_4')); ?>
							<?php echo $form->error($login_form, 'email', array('text'=>'<span>a</span>')); ?>
						</span>
					</div>

					<div class="row">
						<?php echo $form->labelEx($login_form, 'password', array('class'=>'bold color_0 f_left ta_right')); ?>
						<span class="relative in_bl">
							<?php echo $form->textField($login_form, 'password', array('class'=>'wt_gr br_4')); ?>
							<?php echo $form->error($login_form, 'password', array('text'=>'<span>a</span>')); ?>
						</span>
					</div>

					<div class="row">
						<?php echo $form->labelEx($login_form, 'rememberMe', array('class'=>'bold color_0 f_left ta_right')); ?>
						<span class="relative in_bl">
							<?php echo $form->checkBox($login_form,'rememberMe'); ?>
							<?php echo $form->error($login_form,'rememberMe'); ?>
						</span>
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

					<div class="row buttons ta_center">
						<span class="br_3 button">
							<?php echo CHtml::submitButton('Вход в Мои объявления', array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
						</span>
						<a href="/account/registration/" class="fs_11 block mrgin_top_15"><span>Регистрация</span></a>
					</div>

				<?php $this->endWidget(); ?>
		</div><!-- registraion-form -->
		<p class="ta_center pding_bot_50 color_41 mrgin_top_10">
			Входя в раздел Мои объявления, вы принимаете
			<a target="_blank" class="link" href="http://slando.ru/terms/"><span>Условия использования</span></a> сайта
		</p>
	</div><!-- center_box -->
</div><!-- content -->
