<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('name')); ?>:</b>
	<?php echo CHtml::encode($data->name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('geo_id')); ?>:</b>
	<?php echo CHtml::encode($data->geo_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('reg_domain')); ?>:</b>
	<?php echo CHtml::encode($data->reg_domain); ?>
	<br />


</div>