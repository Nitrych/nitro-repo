<?php

$this->layout = 'admin';

$this->breadcrumbs=array(
	'Regions'=>array('index'),
	'Manage',
);

$this->menu=array(

	array('label'=>'Добавить', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('region-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление регионами</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'region-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'name',
		'reg_domain',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
