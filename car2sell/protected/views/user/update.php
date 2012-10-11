<?php
$this->layout = 'admin';

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	
	array('label'=>'Создать пользователя', 'url'=>array('create')),

);
?>

<h1>Редактирование <?php echo $model->email; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'cities'=>$cities,
			'dropdown'=>$dropdown,)); ?>