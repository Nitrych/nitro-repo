<?php

$this->layout = 'main';

$this->breadcrumbs=array(
	'Contents'=>array('index'),
	$model->title,
);

echo "<h1>".$model->title."</h1>";
echo '<div id="content"><br>';

if($message=='after_act'){
	echo Helper::SiteMessage('Ваше объявление подтверждено','Будет опубликовано на сайте поcле проверки модератором'); 
	echo "<p>&nbsp;</p>";
}
		
echo $model->content;

echo '</div>';
?>
