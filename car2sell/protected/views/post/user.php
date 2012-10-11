<?php include('./protected/views/components/filter.php'); ?>
<?php $cclass= ($view_mode=="gallery_wide")? "wide_gallery":""; ?>
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

?>
<div id="content" class="<?=$cclass?>">
    <?php include('./protected/views/components/'.$block); ?>
</div>
