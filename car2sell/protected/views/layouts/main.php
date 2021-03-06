<!DOCTYPE html">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru" lang="ru">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="ru" />
    <meta http-equiv="X-UA-Compatible" content="IE=8" >
    
        <!-- javascript -->
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
		<?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/jquery.cookie.js' ); ?>
        <?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/site.js' ); ?>
		<?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/sregion.js' ); ?>
        <?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/jquery.fancybox.pack.js' ); ?>
        <?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/jquery.mousewheel-3.0.6.pack.js' ); ?>
		<?php Yii::app()->getClientScript()->registerScriptFile( Yii::app()->assetManager->baseUrl.'/js/jquery.selectbox.js' ); ?>
	
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css?1" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css?1" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.fancybox.css?1" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/selectbox.css?1" />
	<!--[if gte IE 8]>
		<style>
		input[type="text"]{
			//height:16px;
			height: 16px;
		}
 		#filter #main_search_field{
 
			height:18px;
			width:620px;
 
			//height:18px;
			//width:620px;
           
 
   	    }
        #smallsearchform{
 
          top:-43px;
		}
		.searchsmall input[type="text"]{
			//height:15px !important;
			height: 15px !important;
		}
 
		.mrgin_righ_15{
            margin-right: 25px;
		}
		.suggest_box{
		left:-95px;
		}

		</style>
	<![endif]-->
	
</head>

<body>

<div class="container" id="page">

	<div id="header">
		<div id="logo"><a href="/"><?php echo CHtml::encode(Yii::app()->name); ?></a></div>
		<div id="menu-top"><span id="favor_area"><?php $this->widget('application.components.Bookmarks'); ?></span>
			<a class="<?=Helper::getLinkClass("/post/addNewPost")?>" href="<?=Helper::getBU()?>/post/addNewPost">Подать Объявление</a> |
			<? echo "<a class=\"".Helper::getLinkClass("/post/myads")."\" href=\"".Helper::getBU()."/post/myads\">Мои объявления</a>";  ?>
							<?=(Yii::app()->user->getIsGuest()) ? ""
								//"<a class=\"".Helper::getLinkClass("/account/login")."\" href=\"".Helper::getBU()."/account/login\">Авторизация</a>
								//	
								//| <a class=\"".Helper::getLinkClass("/account/registration")."\" href=\"".Helper::getBU()."/account/registration\">Регистрация</a> " 
				               : 
			                    "
								
								| <a href=\"".Helper::getBU()."/account/logout\">Выход</a>";
			
			//| <a class=\"".Helper::getLinkClass("/account/settings")."\" href=\"".Helper::getBU()."/account/settings\">Мои настройки</a> 
			?>
		</div>
	</div><!-- header -->
       
    <div id="main_wraper">
        <?php echo $content; ?>
    </div>

    <?php if(Yii::app()->params['showSubscription']): ?>
        <?php include(__DIR__.'/../components/subscription_form.php'); ?>
    <?php endif; ?>

	<div id="footer" class="bd_top_sl_e3 relative">
		<div class="absolute shadow"></div>
		<div class="footer_menu mrgin_10_0 ta_center">
			<?
			$footer = Content::model()->getContentBySlug("_bottom_area");
			$footer = str_replace('href="/','href="'.Helper::getBU().'/',$footer);
			echo $footer;
			
			?>
			<!--span><a href="#" class="color_41 fs_11" >Помощь</a></span>
			<span><a href="#" class="color_41 fs_11" >Топ-объявления</a></span>
			<span><a href="#" class="color_41 fs_11" >Обратная связь</a></span>
			<span><a href="#" class="color_41 fs_11" >Карта сайта</a></span-->
		</div>
	</div><!-- footer -->
    
    <a class="" id="gototop">
        <span class="icon">&nbsp;</span>
        <span class="text_box">
            <span class="link">Вернуться наверх</span>
        </span>
    </a>

</div><!-- page -->

</body>
</html>
