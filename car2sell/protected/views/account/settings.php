<?php $this->pageTitle = Helper::getTitle('my_page'); ?>
<h1>Настройки</h1>

<?php include('./protected/views/components/user_menu.php'); ?>

<? 
if(!is_object($settings_form))
	echo "setting form missed";
?>
<div id="content">
   
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
					<?
					$region_id = Domen::getRegionByCity($settings_form->city);
					
					//$temp_options = array('options' => array($region_id=>array('selected'=>true));
					?>
					<script>
					loadCities(<?=$region_id?>,<?=$settings_form->city?>);
				
				    </script>
                    <?php echo $form->dropdownlist($settings_form, 'region', $dropdown, array('class'=>'form_region wt_gr br_4','options' => array("region_".$region_id=>array('selected'=>true)))); ?>
                    <?php echo $form->error($settings_form, 'region'); ?>
                </span>
            </div>
            <div class="row">
                <?php echo $form->labelEx($settings_form, 'city', array('class'=>'bold color_0 f_left ta_right')); ?>
                <span class="relative in_bl">
                    <?php echo $form->dropdownlist($settings_form, 'city', array('not'=>'Выбрать'), array('class'=>'form_city wt_gr br_4')); ?>
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
      
		<?=Helper::siteNotify("Данные вашей учетной записи успешно обновлены.")?>
    <?php endif;?>
</div><!-- content -->