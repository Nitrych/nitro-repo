<?php
$this->breadcrumbs=array(
	'Regions'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(

);
?>

<h1>Управление регионами</h1>


<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>