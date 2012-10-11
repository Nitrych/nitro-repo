<?php
$this->breadcrumbs=array(
	'Domens'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Domen', 'url'=>array('index')),
	array('label'=>'Create Domen', 'url'=>array('create')),
	array('label'=>'Update Domen', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Domen', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Domen', 'url'=>array('admin')),
);
?>

<h1>View Domen #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'change',
		'city',
		'region',
		'main',
		'num',
		'geo_city',
		'cap',
		'button',
		'timezone',
		'title_site',
		'keywords_site',
		'description_site',
	),
)); ?>
