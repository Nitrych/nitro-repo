<?php

$this->layout = 'admin';

$this->breadcrumbs=array(
	'Users'=>array('index'),
	'Create',
);


?>

<h1>Добавление пользователя</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model,'cities'=>$cities,
			'dropdown'=>$dropdown,)); ?>