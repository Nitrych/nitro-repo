<?php
$this->pageTitle=Yii::app()->name . ' - Добавить новое обьявление';
$this->breadcrumbs=array(
	'Contact',
);
?>
<div id="content" >
<h1 class="fs_16 bold pding_10">Подать объявление</h1>

<?php if(Yii::app()->user->hasFlash('contact')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('contact'); ?>
</div>

<?php else: ?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
		'id'=>'contact-form',
		'enableClientValidation'=>true,
		'htmlOptions'=>array('enctype'=>'multipart/form-data',),
		'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
	<?php //echo $form->errorSummary($model); ?>

	<div class="gray_line"></div>
	<div class="row">
		<?php echo $form->labelEx($model,'title', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'title', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'title', array('text'=>'<span>a</span>')); ?>
		</span>
	</div>
        
    <div class="row">
		<?php echo $form->labelEx($model,'category', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->hiddenField($model,'category'); ?>
			<span id="chosen_category_text" class="bold mrgin_righ_15"></span>
	        <a id="choose_category_button" class="fancybox fancybox.ajax button small E5 fs_11 br_3 mrgin_top_5" href="/ajax/category/"><span class="normal">Выбрать</span></a>
			<?php echo $form->error($model,'category'); ?>
		</span>
	</div>
    
	<div class="gray_line"></div>
    <div class="row">
        <?php echo $form->labelEx($model,'buy_sell', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
        	<?php echo $form->dropdownlist($model,'buy_sell', array(0=>'Выбрать', Post::SELL_TYPE=>'Предлагаю', Post::BUY_TYPE=>'Ищу'), array('class'=>'wt_gr br_4')); ?>
        	<?php echo $form->error($model,'buy_sell'); ?>
		</span>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'owner_type', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
	        <?php echo $form->dropdownlist($model,'owner_type',array(0=>'Выбрать', Post::USER_OWNER_TYPE=>'Частное лицо', Post::COMPANY_OWNER_TYPE=>'Компания'), array('class'=>'wt_gr br_4')); ?>
	        <?php echo $form->error($model,'owner_type'); ?>
		</span>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'text', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50, 'class'=>'wt_gr br_4', 'style'=>'height:140px;width:400px;resize:none;overflow-y:hidden;') ); ?>
			<?php echo $form->error($model,'text'); ?>
		</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'img_1', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="in_bl f_left" style="width:350px;">
		<?php for($i=1; $i<9; $i++): ?>
			<span class="relative in_bl" style="margin-bottom:15px;">
				<?php echo $form->fileField($model,'img_'.$i,array() ); ?>
				<?php echo $form->error($model,'img_'.$i); ?>
			</span>
		<?php endfor; ?>
		</span>
		<div class="clear"></div>
	</div>

	<div class="gray_line"></div>
	<div class="row">
        <?php echo $form->labelEx($model,'region', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
	        <?php echo $form->dropdownlist($model,'region', $dropdown, array('class'=>'wt_gr br_4')); ?>
	        <?php echo $form->error($model,'region'); ?>
		</span>
    </div>
	<div class="row">
        <?php echo $form->labelEx($model,'city', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
	        <?php echo $form->dropdownlist($model,'city', array('not'=>'Выбрать'), array('class'=>'wt_gr br_4')); ?>
	        <?php echo $form->error($model,'city'); ?>
		</span>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'near_adress', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'near_adress', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'near_adress'); ?>
		</span>
	</div>

	<div class="gray_line"></div>
	<div class="row">
		<?php echo $form->labelEx($model,'contact_name', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'contact_name', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'contact_name'); ?>
		</span>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model,'email', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'email', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'email'); ?>
		</span>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'phone_number', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'phone_number', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'phone_number'); ?>
		</span>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'icq', array('class'=>'bold color_0 f_left ta_right')); ?>
		<?php echo $form->textField($model,'icq', array('class'=>'wt_gr br_4')); ?>
		<?php echo $form->error($model,'icq'); ?>
	</div>
        
    <div class="row">
		<?php echo $form->labelEx($model,'skype', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'skype', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'skype'); ?>
		</span>
	</div>

	<div class="row rule_agreement">
		<label for="PostForm_skype" class="bold color_0 f_left ta_right">&nbsp;</label>
		<?php echo $form->checkBox($model,'rule_agreement', array('class'=>'f_left', 'style'=>'margin:0 10px 20px 20px;', 'uncheckValue'=>0)); ?>
		<label for="PostForm_rule_agreement">Я соглашаюсь с правилам использования сервиса, а также с передачей и обработкой моих данных. Я подтверждаю своё совершеннолетие и ответственность за размещение объявления</label>
		<span class="relative">
			<?php echo $form->error($model,'rule_agreement'); ?>
		</span>
	</div>
    

	<?php /*if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?>
		<div>
		<?php $this->widget('CCaptcha'); ?>
		<?php echo $form->textField($model,'verifyCode'); ?>
		</div>
		<div class="hint">Please enter the letters as they are shown in the image above.
		<br/>Letters are not case-sensitive.</div>
		<?php echo $form->error($model,'verifyCode'); ?>
	</div>
	<?php endif;*/ ?>
	<div class="gray_line"></div>
	<div class="row buttons ta_right">
		<span class="br_3 button"><?php echo CHtml::submitButton('Опубликовать', array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?></span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>

</div>
