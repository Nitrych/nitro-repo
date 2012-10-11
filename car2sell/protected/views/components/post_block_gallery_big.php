<div id="post_block">

	<div class="post_blocks clr">
	<? if($top_posts_fl===false && (!isset($posts) || count($posts)==0) ) echo "<br><center><font color='red'>Объявления не найдены</font></center>"; ?>
    <?php 
	    $i=0;
	    foreach($posts as $post): 
		
		?>
		<div class="post bd_bot_ds_c8 tcenter pureleft">
    	    
			<a href="/post/show/id/<?php echo $post->id; ?>"><img class="block pding_3 thumb mrgin_righ_15 clr" style="max-width:600px; margin:0 auto" src="<?=Helper::getThumb($post->getFirstImgSrc(200),600,300,'width'); ?>" /></a>
            <div class="post_info " style="margin:0 auto; text-align:center; width:100%">
    	        <h3 class="title fs_lh_14_20 bold pding_10_0"><a href="<?=$post->getLink()?>"><?php echo $post->title; ?></a></h3>
				<div class="color_a1"><?=$post->price?> <?=Helper::getCurrencySign($post->currency)?></div>
                <p class="color_b4 fs_lh_11_14"><?php echo $categories[$post->category]; ?></p>
                <p class="color_b4 fs_lh_11_14"><?php echo $cities[$post->domen]; ?></p>
				
           </div>
			
   		</div>
	<?php 
		$i++;
		endforeach; ?>
	
	<div class="paging navicontainer">
	<?
	if((!isset($top_posts_fl) || $top_posts_fl===false) && count($paging)>0)
		// the pagination widget with some options to mess
		$this->widget('CLinkPager', array(
				'currentPage'=>$paging['page'],
				'itemCount'=>$paging['total'],
				'pageSize'=>$paging['page_size'],
				'maxButtonCount'=>5,
				//'nextPageLabel'=>'My text >',
				'header'=>'',
			'htmlOptions'=>array('class'=>'yiiPager wrpr'),
			));
	?>
	</div>
	<div class="clear"></div>
</div>
