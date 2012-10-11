<?php if(count($similar_other)>0){ ?>
<div id="post_block">
	<div class="bg_f8 pding_5_10 bd_bot_sl_e8">
    	<h4 class="fs_lh_11_16 color_a2">Похожие объявления в других регионах</h4>
    </div>
    <?php foreach($similar_other as $spost): ?>
	
	    <br/><a href="<?=$spost->getLink()?>"><?php echo $spost->title ." - ". Domen::getGeoNameById($spost->domen) ?></a>
	<?php endforeach; ?>

</div>
<br/><br/>
<?  } ?>
