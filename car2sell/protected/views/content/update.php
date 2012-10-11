<?php
$this->layout = 'admin';

$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->title=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'Созлать страницу', 'url'=>array('create')),
);
?>

<h1>Update Content <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'parents'=>$parents)); ?>