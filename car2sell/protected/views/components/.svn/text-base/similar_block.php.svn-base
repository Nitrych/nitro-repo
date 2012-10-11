<?php if(count($similar)>0){ ?>
<div id="post_block">
	<div class="bg_f8 pding_5_10 bd_bot_sl_e8">
    	<h4 class="fs_lh_11_16 color_a2">Похожие объявления</h4>
    </div>
    <?php foreach($similar as $spost): ?>
    	<div class="post_row bd_bot_ds_c8">
    	    <div class="time ta_center f_left">
    		    <p class="fs_lh_12_18"><?php echo date('j  M',$spost->time); ?></p>
    	         <p class="fs_lh_12_18"><?php echo date('H:i', $spost->time); ?></p>
            </div>
			<img class="f_left block pding_3 thumb mrgin_righ_15" width="94px" height="70px" src="<?php echo Helper::getThumb($spost->getFirstImgSrc(),94,70); ?>" />
            <div class="post_info f_left">
    	        <h3 class="title fs_lh_14_20 bold pding_10_0"><a href="<?=$spost->getLink()?>"><?php echo $spost->title; ?></a></h3>
                <p class="color_b4 fs_lh_11_14"><?php echo $cities[$spost->domen]; ?></p>
           </div>
			<div class="post_price_part f_right">
				<div class="list-price"><?=$spost->price?> <?=Helper::getCurrencySign($post->currency)?></div>
			</div>
   		</div>
	<?php endforeach; ?>

</div>

<?  } ?>
