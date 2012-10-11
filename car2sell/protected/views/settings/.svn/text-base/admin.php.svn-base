<?
$this->layout = 'admin';

?>

<div class="well">
	<?php $this->widget('bootstrap.widgets.BootGridView',array(
		'id'=>'Config-grid',
		'dataProvider'=>$model->search(),
		'filter'=>$model,
		'columns'=>array(
			'title',
			'value',
			array(
				'class'=>'bootstrap.widgets.BootButtonColumn',
				'template'=>'{update}{delete}',
				'updateButtonUrl'=>'Yii::app()->createUrl("/settings/save/id/" . $data->key)',
			),
		),
	)); ?>
</div>