<?php $sub_form = new SubscriptionForm(); ?>
<?php $sub_form->setChoices(); ?>
<div class="subscription_wrap">
    <div id="subscription_box">
        <div class="bold mrgin_bot_10">Подпишитесь на новые объявления</div>
        <div>
            <?php $form=$this->beginWidget('CActiveForm', array(
                                                                'id'=>'subscription-form',
                                                                'enableClientValidation'=>true,
                                                                'action'=>'/subscription/addNew/',
                                                                'clientOptions'=>array(
                                                                    'validateOnSubmit'=>true,
                                                                ),
            )); ?>
            <div class="col_5 mrgin_righ_15 f_left">
                <?php echo $form->labelEx($sub_form, 'email', array('class'=>'')); ?>
                <br />
                <?php echo $form->textField($sub_form, 'email', array('class'=>'wt_gr br_4 small')); ?>
            </div>
            <div class="col_5 mrgin_righ_15 f_left">
                <?php echo $form->labelEx($sub_form, 'keywords', array('class'=>'')); ?>
                <br />
                <?php echo $form->textField($sub_form, 'keywords', array('class'=>'wt_gr br_4 small')); ?>
            </div>
            <div class="col_5 mrgin_righ_15 f_left">
                <?php echo $form->labelEx($sub_form, 'region', array('class'=>'')); ?>
                <br />
                <?php echo $form->dropdownlist($sub_form, 'region', $sub_form->region_choices, array('class'=>'wt_gr br_4 small')); ?>
            </div>
            <div class="col_5 mrgin_righ_15 f_left">
                <?php echo $form->labelEx($sub_form, 'category', array('class'=>'')); ?>
                <br />
                <?php echo $form->dropdownlist($sub_form, 'category', $sub_form->category_choices, array('class'=>'wt_gr br_4 small')); ?>
            </div>
            <div class="buttons">
                <label class="color_0" for="">&nbsp;</label>
                <br />
                <span class="br_3 button">
                    <?php echo CHtml::submitButton('Подписаться', array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
                </span>
            </div>
            <div class="clear"></div>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>