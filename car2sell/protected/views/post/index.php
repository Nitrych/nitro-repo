<?php $this->pageTitle = Helper::getTitle('main'); ?>
<h1>Каталог объявлений</h1>
<?php //TODO использовать полный путь чтобы не было лагов под виндой; ?>
<?php include('./protected/views/components/filter.php'); ?>
<?php $cclass= ($view_mode=="gallery_wide")? "wide_gallery":""; ?>

<div id="content" class="<?=$cclass?>">

    <?php 
	$block = "post_block_default.php";
	switch ($view_mode){
	    case 'default':
		    $block = "post_block_default.php";
		    break;
		case 'gallery_wide':
		    $block = "post_block_gallery_wide.php";
		    break;
		case 'gallery_simple':
		    $block = "post_block_gallery_simple.php";
		    break;
		case 'gallery_big':
		    $block = "post_block_gallery_big.php";
		    break;
	}
	$top_posts_fl = true;
	?>
	<? if ($show_all_top_ads): ?>
	<div class="block_subheader">Топ объявления - <a href='<?=Helper::addUrlParameter('show_all_ads','')?>'>назад к списку объявлений</a> <div class="top_hint"><a href='<?=Helper::getBU().'/cont/help_top'?>'>Как попасть в Топ?</a></div></div>
	<? else: ?>
	<div class="block_subheader">Топ объявления <a href='<?=Helper::addUrlParameter('show_all_ads',1)?>'>Все объявления</a> <div class="top_hint"><a href='<?=Helper::getBU().'/cont/help_top'?>'>Как попасть в Топ?</a></div></div>
	<? endif;  ?>
	
	<?
	include('./protected/views/components/'.$block);
	
	?>
	
	
	<?
	if(!$show_all_top_ads){
		echo '<div class="block_subheader">Обычные объявления</div>';
		$top_posts_fl = false;
		$posts = $all_posts;
		include('./protected/views/components/'.$block); 
	}
	?>
</div>
