<?php
$this->layout = 'admin';

$this->breadcrumbs=array(
	'Domens'=>array('index'),
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
	$.fn.yiiGridView.update('domen-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Управление городами</h1>


<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'domen-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		
		'name',
		'city',
		//'regionx.name',
	    array( 'name'=>'region_search', 'value'=>'$data->regionx->name' ),
		
		/*
		'num',
		'geo_city',
		'cap',
		'button',
		'timezone',
		'title_site',
		'keywords_site',
		'description_site',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
