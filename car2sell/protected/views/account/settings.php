<div id="content">
    <div class="account_nav">
        <a href="/account/">Мои объявления</a>
        <a href="/account/settings/">Настройки</a>
    </div>
    <?php if(!$is_saved): ?>
	<div id="padding_box">
		<h2 class="bold fs_lh_14_18 color_62 mrgin_10_0">Настройки акаунта</h2>
		<div class="registraion-form br_4 bd_e3">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'settings-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

			<?php //echo $form->errorSummary($reg_form); ?>
            <div class="row">
				<?php echo $form->labelEx($settings_form, 'username', array('class'=>'bold color_0 f_left ta_right')); ?>
				<span class="relative in_bl">
					<?php echo $form->textField($settings_form, 'username', array('class'=>'wt_gr br_4')); ?>
					<?php echo $form->error($settings_form, 'username', array('text'=>'<span>a</span>')); ?>
				</span>
			</div>

			<div class="row">
				<?php echo $form->labelEx($settings_form, 'email', array('class'=>'bold color_0 f_left ta_right')); ?>
				<span class="relative in_bl">
					<?php echo $form->textField($settings_form, 'email', array('class'=>'wt_gr br_4')); ?>
					<?php echo $form->error($settings_form, 'email', array('text'=>'<span>a</span>')); ?>
				</span>
			</div>

			<div class="row">
				<?php echo $form->labelEx($settings_form, 'password', array('class'=>'bold color_0 f_left ta_right')); ?>
				<span class="relative in_bl">
					<?php echo $form->textField($settings_form, 'password', array('class'=>'wt_gr br_4')); ?>
					<?php echo $form->error($settings_form, 'password', array('text'=>'<span>a</span>')); ?>
				</span>
			</div>

			<div class="row">
				<?php echo $form->labelEx($settings_form, 're_password', array('class'=>'bold color_0 f_left ta_right')); ?>
				<span class="relative in_bl">
					<?php echo $form->textField($settings_form, 're_password', array('class'=>'wt_gr br_4')); ?>
					<?php echo $form->error($settings_form, 're_password', array('text'=>'<span>a</span>')); ?>
				</span>
			</div>
            
            <div class="row">
                <?php echo $form->labelEx($settings_form, 'region', array('class'=>'bold color_0 f_left ta_right')); ?>
                <span class="relative in_bl">
                    <?php echo $form->dropdownlist($settings_form, 'region', $dropdown, array('class'=>'wt_gr br_4')); ?>
                    <?php echo $form->error($settings_form, 'region'); ?>
                </span>
            </div>
            <div class="row">
                <?php echo $form->labelEx($settings_form, 'city', array('class'=>'bold color_0 f_left ta_right')); ?>
                <span class="relative in_bl">
                    <?php echo $form->dropdownlist($settings_form, 'city', array('not'=>'Выбрать'), array('class'=>'wt_gr br_4')); ?>
                    <?php echo $form->error($settings_form, 'city'); ?>
                </span>
            </div>
            
            <div class="row">
                <?php echo $form->labelEx($settings_form,'phone_number', array('class'=>'bold color_0 f_left ta_right')); ?>
                <span class="relative in_bl">
                    <?php echo $form->textField($settings_form,'phone_number', array('class'=>'wt_gr br_4')); ?>
                    <?php echo $form->error($settings_form,'phone_number'); ?>
                </span>
            </div>

            <div class="row">
                <?php echo $form->labelEx($settings_form, 'icq', array('class'=>'bold color_0 f_left ta_right')); ?>
                <?php echo $form->textField($settings_form, 'icq', array('class'=>'wt_gr br_4')); ?>
                <?php echo $form->error($settings_form, 'icq'); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($settings_form, 'skype', array('class'=>'bold color_0 f_left ta_right')); ?>
                <span class="relative in_bl">
                    <?php echo $form->textField($settings_form, 'skype', array('class'=>'wt_gr br_4')); ?>
                    <?php echo $form->error($settings_form, 'skype'); ?>
                </span>
            </div>

			<div class="row buttons ta_center">
				<span class="br_3 button">
					<?php echo CHtml::submitButton('Сохранить', array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
				</span>
			</div>

		<?php $this->endWidget(); ?>

		</div><!-- registraion-form -->
	</div><!-- padding_box -->
    <?php else: ?>
        <div class="mrgin_top_30">
            Даные вашей учетной записи успешно обновлены.
        </div>
    <?php endif;?>
</div><!-- content -->