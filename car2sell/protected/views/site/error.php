<h1>Ошибка</h1>
<div id="content">
<?php
$this->pageTitle=Yii::app()->name . ' - Ошибка';
$this->breadcrumbs=array(
	'Error',
);

echo  Helper::SiteMessage( "Ошибка ".$error['code'], $error['message'], "error" );
?>
</div>
