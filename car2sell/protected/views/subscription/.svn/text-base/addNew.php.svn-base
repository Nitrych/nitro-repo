<div id="content" >
    <h1>Подписка</h1>
    <div class="form">
        <?php $form=$this->beginWidget('CActiveForm', array(
                'id'=>'subscription-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                'validateOnSubmit'=>true,
            ),
        )); ?>
        <?php //echo $form->errorSummary($sub_form); ?>

        <div class="gray_line"></div>

        <div class="row">
            <?php echo $form->labelEx($sub_form, 'email', array('class'=>'bold color_0 f_left ta_right')); ?>
            <span class="relative in_bl">
                <?php echo $form->textField($sub_form, 'email', array('class'=>'wt_gr br_4')); ?>
                <?php echo $form->error($sub_form, 'email', array('text'=>'<span>a</span>')); ?>
            </span>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($sub_form, 'keywords', array('class'=>'bold color_0 f_left ta_right')); ?>
            <span class="relative in_bl">
                <?php echo $form->textField($sub_form, 'keywords', array('class'=>'wt_gr br_4')); ?>
                <?php echo $form->error($sub_form, 'keywords', array('text'=>'<span>a</span>')); ?>
            </span>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($sub_form, 'region', array('class'=>'bold color_0 f_left ta_right')); ?>
            <span class="relative in_bl">
                <?php echo $form->dropdownlist($sub_form, 'region', $sub_form->region_choices, array('class'=>'wt_gr br_4')); ?>
                <?php echo $form->error($sub_form, 'region'); ?>
            </span>
        </div>
        
        <div class="row">
            <?php echo $form->labelEx($sub_form, 'category', array('class'=>'bold color_0 f_left ta_right')); ?>
            <span class="relative in_bl">
                <?php echo $form->dropdownlist($sub_form, 'category', $sub_form->category_choices, array('class'=>'wt_gr br_4')); ?>
                <?php echo $form->error($sub_form, 'category'); ?>
            </span>
        </div>

        <div class="gray_line"></div>
        <div class="row buttons ta_right">
            <span class="br_3 button">
                <?php echo CHtml::submitButton('Подписаться', array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
            </span>
        </div>

        <?php $this->endWidget(); ?>
    </div>
</div>