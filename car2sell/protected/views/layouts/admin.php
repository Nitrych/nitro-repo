<!DOCTYPE html ...>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<title><?php echo $this->pageTitle; ?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/jquery.cookie.js' ); ?>
<?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/jquery.fancybox.pack.js' ); ?>
<?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/site.js' ); ?>
</head>
 
<body>
<div id="page" class="container_12">
 
<div id="header" class="grid_12">
<div id="logo"><a href="/staff/">Панель управления</a></div>
<div id="admin_menu">
	
	<a class="<?=Helper::getLinkClass("/settings/")?>" href="/settings/admin/">Настройки</a>
	<a class="<?=Helper::getLinkClass("/user/")?>" href="/user/admin/">Пользователи</a> 
	<a class="<?=Helper::getLinkClass("/content/")?>" href="/content/admin/">Контент</a>
	<a class="<?=Helper::getLinkClass("/category/")?>" href="/category/admin/">Марки авто</a> 
	<a class="<?=Helper::getLinkClass("/region/")?>" href="/region/admin/">Регионы</a> 
	<a class="<?=Helper::getLinkClass("/domen/")?>" href="/domen/admin/">Города</a> 
	<a class="<?=Helper::getLinkClass("/post/admin/")?>" href="/post/admin/">Администрирование объявлений</a> 
	<a class="<?=Helper::getLinkClass("/post/moderate/")?>" href="/post/moderate/">Модерация</a> 

</div>
</div><!-- header -->
 
<div id="sidebar" class="grid_4">
<?php 
//$this->widget('application.components.AdminMenu'); 
?>

<?php
	$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'',
			));
	$this->widget('zii.widgets.CMenu', array(
				'items'=>$this->menu,
				'htmlOptions'=>array('class'=>'operations'),
			));
	$this->endWidget();
?>


</div><!-- sidebar -->
 
<div class="grid_8">
<div id="content" class="backend">
<?php echo $content; ?>
<div class="clear"></div>
</div><!-- content -->
</div>
 
<div id="footer" class="grid_12">
...
</div><!-- footer -->
 
<div class="clear"></div>
</div><!-- page -->
</body>
</html>