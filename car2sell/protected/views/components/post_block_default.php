<div id="post_block">
	
	<? if($top_posts_fl===false && (!isset($posts) || count($posts)==0) ) echo "<br><center><font color='red'>Объявления не найдены</font></center>"; ?>
    <?php foreach($posts as $post): ?>
	<div class="post_row bd_bot_ds_c8" id="b<?=$post->id?>">
    	    <div class="time ta_center f_left">
				
				 <? if($top_posts_fl===false): ?>
					 <p class="fs_lh_12_18"><?php echo Helper::dateToString($post->time); ?></p>
					 <p class="fs_lh_12_18"><?php echo date('H:i', $post->time); ?></p>
				 <? endif; ?>
				<?=(!isset($fav_page_fl) && !isset($user_page_fl))?"<a href=\"javascript:void(0)\" class=\"add_to_favor\" id=\"$post->id\" title='В избранное'></a>" : "" ?>
				
            </div>
			<?php 
			/*
			$this->beginWidget('application.extensions.thumbnailer.Thumbnailer', array(

					'thumbsDir' => 'images/thumbs',
					'thumbWidth' => 94,
					'thumbHeight' => 70, // Optional
				)
			);
			*/
			?>
			<a href="<?=$post->getLink()?>"><img class="f_left block pding_3 thumb mrgin_righ_15" width="94px" height="70px" src="<?php echo Helper::getThumb($post->getFirstImgSrc(),94,70); ?>" /></a>
			<?php 
			//$this->endWidget(); 
			?>
			
			
            <div class="post_info f_left">
    	        <h3 class="title fs_lh_14_20 bold"><a href="<?=$post->getLink()?>"><?php
				if($post->urgent){
					echo '<span class="inlblk normal fbold label-promoted2 br4">Срочно</span> ';
				}
				echo $post->title; 
				?></a></h3>
                <p class="color_b4 fs_lh_11_14"><?php echo $categories[$post->category]; ?></p>
                <p class="color_b4 fs_lh_11_14"><?php if(!isset($user_page_fl)) echo $cities[$post->domen]; ?></p>
				<p class="color_b4 fs_lh_11_14"><?php if(isset($user_page_fl) && $post->top!=1) echo "<a href='/post/fortop/".$post->id."'>Вывести объявление в топ</a>" ?></p>
				<p class="color_b4 fs_lh_11_14"><?php if(isset($user_page_fl) && $post->urgent!=1) echo "<a href='/post/forurgent/".$post->id."'>Пометить как срочное</a>" ?></p>
				<p class="color_b4 fs_lh_11_14"><?php if(isset($user_page_fl)) echo "<a href='/post/updatepost/".$post->id."/key/auto'>Редактировать</a>" ?></p>
				
           </div>
			<div class="post_price_part f_right">
				<div class="list-price"><?=$post->price?> <?=Helper::getCurrencySign($post->currency)?></div>
			</div>
   		</div>
	<?php endforeach; ?>
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
