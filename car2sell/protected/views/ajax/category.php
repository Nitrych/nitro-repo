<div class="category_ajax_box">
    <div class="category_title bold fs_lh_16">Выберите рубрику</div>
	<div class="bg_F pding_10_0">
		<?php if(count($categories)): ?>
		    <ul class="f_left">
		    <?php /*foreach($categories as $item): ?>
		        <li name="<?php echo $item->id; ?>" class="category_choose"><?php echo $item->name; ?></li>
		    <?php endforeach; */?>
			<?php 
			$i = 0;
			foreach ($categories as $key => $item): ?>
				<?php if ($i && ($i % 11) == false) :?>
					</ul><ul class="f_left">
				<?php endif;?>
				<li name="<?php echo $item->id; ?>" class="category_choose pointer" ><span class="block pding_5_10 lh_14"><?php echo $item->name; ?></span></li>
			<?php
			$i++;
			endforeach; ?>
		    </ul>
		<?php endif; ?>
		<div class="clear"></div>
	</div>
</div>
