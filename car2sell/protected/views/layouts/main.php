<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.fancybox.css" />
        <!-- javascript -->
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
        <?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/site.js' ); ?>
        <?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/jquery.fancybox.pack.js' ); ?>
        <?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/jquery.mousewheel-3.0.6.pack.js' ); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

        <div id="main_wraper">
            <?php echo $content; ?>
        </div>

	<div id="footer" class="bd_top_sl_e3 relative">
		<div class="absolute shadow"></div>
		<div class="footer_menu mrgin_10_0 ta_center">
			<span><a href="#" class="color_41 fs_11" >Помощь</a></span>
			<span><a href="#" class="color_41 fs_11" >Топ-объявления</a></span>
			<span><a href="#" class="color_41 fs_11" >Обратная связь</a></span>
			<span><a href="#" class="color_41 fs_11" >Карта сайта</a></span>
		</div>
	</div><!-- footer -->

</div><!-- page -->

</body>
</html>
