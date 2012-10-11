<h1>Восстановление доступа</h1>
<div id="content">
	  <?=Helper::siteNote();?>
    <?php if(!$is_sent): ?>
	<div id="center_box">
		<h2 class="bold fs_lh_14_18 color_62 mrgin_10_0"></h2>
		<div class="registraion-form br_4 bd_e3">

		<?php $form=$this->beginWidget('CActiveForm', array(
			'id'=>'forgot-form',
			'enableClientValidation'=>true,
			'clientOptions'=>array(
				'validateOnSubmit'=>true,
			),
		)); ?>

			<?php //echo $form->errorSummary($reg_form); ?>

			<div class="row">
				<?php echo $form->labelEx($forgot_form, 'email', array('class'=>'bold color_0 f_left ta_right')); ?>
				<span class="relative in_bl">
					<?php echo $form->textField($forgot_form, 'email', array('class'=>'wt_gr br_4')); ?>
					<?php echo $form->error($forgot_form, 'email', array('text'=>'<span>a</span>')); ?>
				</span>
			</div>
   		    
			<div class="row buttons ta_center">
				<span class="br_3 button">
					<?php echo CHtml::submitButton('Отправить', array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
				</span>
			</div>

		<?php $this->endWidget(); ?>

		</div><!-- registraion-form -->
	</div><!-- padding_box -->
    <?php else: 
	    //if($is_error===false){
		//	
	//
      //  echo '<div class="mrgin_top_30">
		//	  Новый пароль отправлен на ваш почтовый ящик.
		//	 </div>';
		//}
         endif;?>
</div><!-- content -->

