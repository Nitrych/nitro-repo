<?php //TODO использовать полный путь чтобы не было лагов под виндой; ?>
<h1>Избранные объявления</h1>
<?
if(isset($favs_cleared)){
	

}else{	
	echo '<div class=submenu><a href="/post/clearFavorites">Очистить список избранных</a></div>';
?>

<div id="content">
	<? if(isset($favs_cleared)) echo Helper::siteNotify("Список избранных успешно очищен")?>
    <?php include('./protected/views/components/post_block_default.php'); ?>
</div>
<? } ?>
