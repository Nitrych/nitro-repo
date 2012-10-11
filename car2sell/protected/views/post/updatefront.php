<?php $this->pageTitle = Helper::getTitle('add_post'); ?>

<?
if($key=='admin'){
	$this->layout = 'admin';
}
?>

<h1> Обновить объявление</h1>
<?php if($key!='admin'): ?>
	
	<div class=submenu>Баланс: <?=Balance::getUserBalance(Yii::app()->user->id)?> руб. <a href="/pay/form">Пополнить баланс</a></div>
<?php endif; ?>	


<div id="content" >
	
<?php

if($post_edited)
	echo Helper::siteNotify("Объявление сохранено");

?>
	
<?php if(Yii::app()->user->hasFlash('post_add')): ?>

<div class="flash-success">
	<?php echo Yii::app()->user->getFlash('post_add'); ?>
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
		<?php echo $form->labelEx($model, 'title', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model, 'title', array('class'=>'wt_gr br_4 left_count', 'maxlength'=>'130')); ?>
			<?php echo $form->error($model, 'title', array('text'=>'<span>a</span>')); ?>
            <div style="" id="PostForm_price_im_" class="infoMessage" >
                <i class="info_i"></i><b class="info_b"></b>
                <p>Введите понятный и подробный заголовок, чтобы привлечь внимание к объявлению.</p>
            </div>
            <div class="number_left color_a6 fs_11"><b>130</b> знаков осталось</div>
		</span>
	</div>

    <div class="row">
		<?php echo $form->labelEx($model, 'category', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->hiddenField($model,'category'); ?>
			<span id="chosen_category_text" class="bold mrgin_righ_15"><?=$cat_name?></span>
	        <a id="choose_category_button" class="fancybox fancybox.ajax button small E5 fs_11 br_3 mrgin_top_5" href="/ajax/category/"><span class="normal">Выбрать</span></a>
			<?php echo $form->error($model, 'category'); ?>
		</span>
	</div>
    
	<div class="gray_line"></div>
    <div class="row">
        <?php echo $form->labelEx($model, 'buy_sell', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
        	<?php echo $form->dropdownlist($model,'buy_sell', array(0=>'Выбрать', Post::SELL_TYPE=>'Предлагаю', Post::BUY_TYPE=>'Ищу'), array('class'=>'wt_gr br_4')); ?>
        	<?php echo $form->error($model, 'buy_sell'); ?>
		</span>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model, 'price', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model, 'price', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model, 'price', array('text'=>'<span>a</span>')); ?>
		</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'auction', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->checkBox($model, 'auction'); ?>
			<?php echo $form->error($model, 'auction'); ?>
		</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'model', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model, 'model', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model, 'model', array('text'=>'<span>a</span>')); ?>
		</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'year', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model, 'year', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model, 'year', array('text'=>'<span>a</span>')); ?>
		</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'color', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model, 'color', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model, 'color', array('text'=>'<span>a</span>')); ?>
		</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'mileage', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model, 'mileage', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model, 'mileage', array('text'=>'<span>a</span>')); ?>
		</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model, 'engine_value', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model, 'engine_value', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model, 'engine_value', array('text'=>'<span>a</span>')); ?>
		</span>
	</div>

	<div class="row">
        <?php echo $form->labelEx($model,'fuel', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
	        <?php echo $form->dropdownlist($model, 'fuel', array(0=>'Выбрать', Post::FUEL_GAS=>'Бензин', Post::FUEL_DIESEL=>'Дизель', Post::FUEL_OTHER=>'Другой'), array('class'=>'wt_gr br_4')); ?>
	        <?php echo $form->error($model,'fuel'); ?>
		</span>
    </div>
	
	<div class="row">
        <?php echo $form->labelEx($model,'gear', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
	        <?php echo $form->dropdownlist($model, 'gear', array(0=>'Выбрать', Post::GEAR_AUTO=>'Автоматическая', Post::GEAR_MANUAL=>'Ручная', Post::GEAR_OTHER=>'Другая'), array('class'=>'wt_gr br_4')); ?>
	        <?php echo $form->error($model,'gear'); ?>
		</span>
    </div>
    
    <div class="row">
        <?php echo $form->labelEx($model,'owner_type', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
	        <?php echo $form->dropdownlist($model,'owner_type',array(0=>'Выбрать', Post::USER_OWNER_TYPE=>'Частное лицо', Post::COMPANY_OWNER_TYPE=>'Компания'), array('class'=>'wt_gr br_4')); ?>
	        <?php echo $form->error($model,'owner_type'); ?>
            <div style="" id="PostForm_price_im_" class="infoMessage" >
                <i class="info_i"></i><b class="info_b"></b>
                <p>Ваше предложение частное (продаете/покупаете личные вещи, предметы, собственную недвижимость) или Вы посредник/представитель компании, фирмы, агентства, интернет-магазина и размещаете бизнес-предложение? Если Вы посредник или представитель агентства - выберите параметр Компания.</p>
            </div>
		</span>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'text', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textArea($model,'text',array('rows'=>6, 'cols'=>50, 'class'=>'wt_gr br_4 left_count', 'maxlength'=>'4096', 'style'=>'height:140px;width:400px;resize:none;overflow-y:hidden;') ); ?>
			<?php echo $form->error($model,'text'); ?>
            <div style="" id="PostForm_price_im_" class="infoMessage" >
                <i class="info_i"></i><b class="info_b"></b>
                <p>Сделайте ваше описание побуждающим к действию. Укажите преимущества вашего товара или услуги.<br />
                    Предоставьте как можно больше подробностей - так вы избежите лишних вопросов и вызовете больше доверия.<br />
                    Старайтесь писать грамотно и корректно. Избегайте неприличных слов.<br />
                    Избегайте слов с ЗАГЛАВНЫМИ БУКВАМИ
                </p>
            </div>
            <div class="number_left color_a6 fs_11"><b>4096</b> знаков осталось</div>
		</span>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'img_1', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="in_bl f_left" style="width:350px;">
			<? echo Helper::getUploadedPhotos($model->id) ?>
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
	<!--div class="row">
        <?php echo $form->labelEx($model,'region', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
	        <?php echo $form->dropdownlist($model, 'region', $dropdown, array('class'=>'wt_gr br_4')); ?>
	        <?php echo $form->error($model,'region'); ?>
		</span>
    </div>-->
	<!-- div class="row">
        <?php echo $form->labelEx($model,'domen', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
	        <?php echo $form->dropdownlist($model, 'domen', $cities, array('class'=>'wt_gr br_4')); ?>
	        <?php echo $form->error($model,'domen'); ?>
		</span>
    </div-->

	<div class="row">
		<?php echo $form->labelEx($model,'near_adress', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'near_adress', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'near_adress'); ?>
		</span>
	</div>

	<div class="gray_line"></div>
	<div class="row">
		<?php echo $form->labelEx($model,'username', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'username', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'username'); ?>
            <div style="" id="PostForm_price_im_" class="infoMessage" >
                <i class="info_i"></i><b class="info_b"></b>
                <p>Как к вам обращаться?</p>
            </div>
		</span>
	</div>

    <!--div class="row">
		<?php echo $form->labelEx($model,'email', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'email', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'email'); ?>
            <div style="" id="PostForm_price_im_" class="infoMessage" >
                <i class="info_i"></i><b class="info_b"></b>
                <p>Введите ваш email-адрес. Этот e-mail не будет показан в объявлении.<br />
                    Вы будете использовать этот email-адрес для входа на сайт.<br />
                </p>
            </div>
		</span>
	</div-->
    
    <div class="row">
		<?php echo $form->labelEx($model,'phone_number', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'phone_number', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'phone_number'); ?>
		</span>
	</div>
    
    <div class="row">
		<?php echo $form->labelEx($model,'icq', array('class'=>'bold color_0 f_left ta_right')); ?>
        <span class="relative in_bl">
            <?php echo $form->textField($model,'icq', array('class'=>'wt_gr br_4')); ?>
            <?php echo $form->error($model,'icq'); ?>
            <div style="" id="PostForm_price_im_" class="infoMessage" >
                <i class="info_i"></i><b class="info_b"></b>
                <p>Введите номер ICQ.</p>
            </div>
        </span>
	</div>
        
    <div class="row">
		<?php echo $form->labelEx($model,'skype', array('class'=>'bold color_0 f_left ta_right')); ?>
		<span class="relative in_bl">
			<?php echo $form->textField($model,'skype', array('class'=>'wt_gr br_4')); ?>
			<?php echo $form->error($model,'skype'); ?>
            <div style="" id="PostForm_price_im_" class="infoMessage" >
                <i class="info_i"></i><b class="info_b"></b>
                <p>Введите вашш логин в Skype.</p>
            </div>
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
		<span class="br_3 button">
			<?php echo CHtml::submitButton('Cохранить', array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
		</span>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<?php endif; ?>

</div>
