<?php $this->pageTitle = Helper::getTitle('one_post', array('post_title'=>$post->title)); 

$this->layout = 'print';

?>
<div id="content" >

  
	<div class=" mrgin_bot_5" style='width:690px; text-indent: 10px;'>
		<h1 id="auto_title" class="lh_28 bold fs_21"><?php echo $post->title; ?></h1>
		<p class="fs_11 color_62"><b><?php echo $domen->city; ?></b> Добавлено: <?php echo Helper::timeToString($post->time); ?>, номер: <?php echo $post->id; ?></p>
	</div>

	<div>
		<div class="post_body mrgin_top_10 f_left" style='width:680px'>
            <?php if(isset($fotos[0]['path'])): ?>
                <div class="foto_slider mrgin_bot_10">
                    <div id="foto_1" style="text-align:center">
						<img src="<?php echo $fotos[0]['path']; ?>" width="609px" height="379px" />
					</div>
                </div>
            <?php endif; ?>

			<table width="100%" cellspacing="0" cellpadding="0" class="details fixed mrgin_bot_10 mrgin_top_5">
			<tbody>
				<tr>
					<td width="33%" class="bd_righ_das_c8">
						<div class="pding_5_10 "> Модель: <strong class="block mrgin_top_5 "> <?php echo $category->name; ?> </strong></div>
					</td>
					<td width="33%" class="bd_righ_das_c8">
						<div class="pding_5_10"> Год выпуска: <strong class="block mrgin_top_5"> <?php echo $post->year; ?> </strong></div>
					</td>
					<td width="33%">
						<div class="pding_5_10"> Цвет: <strong class="block mrgin_top_5"> <?php echo $post->color; ?> </strong></div>
					</td>
				</tr>
				<tr>
					<td width="33%" class="bd_das_c8" style="border-left:none;">
						<div class="pding_5_10"> Пробег: <strong class="block mrgin_top_5"> <?php echo Helper::numberToString($post->mileage); ?> км</strong></div>
					</td>
					<td width="33%" class="bd_das_c8" style="border-left:none;">
						<div class="pding_5_10"> Объем двигателя: <strong class="block mrgin_top_5"> <?php echo Helper::numberToString($post->engine_value); ?> см<sup>3</sup> </strong></div>
					</td>
					<td width="33%" class="bd_das_c8" style="border-right:none;border-left:none;">
						<div class="pding_5_10"> Вид топлива: <strong class="block mrgin_top_5"><?php echo Helper::getFuelLink($post->fuel); ?></strong></div>
					</td>
				</tr>
				<tr>
					<td width="33%" class="bd_righ_das_c8">
						<div class="pding5_10"> Коробка передач: <strong class="block mrgin_top_5"><?php echo Helper::getGearLink($post->gear); ?></strong></div>
					</td>
					<td width="33%" class="bd_righ_das_c8">&nbsp;</td>
					<td width="33%"></td>
				</tr>
			</tbody>
			</table>

			<p class="fs_lh_14_20 mrgin_bot_30 pding_righ_20"><?php echo $post->text; ?></p>
			
					<div class="">
			
			Цена:	<strong ><?php echo Helper::numberToString($post->price); ?> <?=Helper::getCurrencySign($post->currency)?></strong>
				<?php if($post->auction == 1): ?>
					<small class="block lh_15">Торг возможен</small>
				<?php endif; ?>
			
			<div >
				
					
					<p class="color_0 fs_lh_16 over_h">
						
						<?php echo "<br>Контактное лицо: ".$post->username; 
						
						?>
                      
					</p>
				
				<div class="clear"></div>
				<ul id="contact_methods">
                    <?php if($post->phone_number!=''): ?>
                        <li class="mrgin_10_0">
                            <!--TODO <span class="phone_icon">&nbsp;</span>-->
                            Тел.: <strong class="phone_place"><?php echo $post->phone_number?></strong>
                            
                        </li>
                    <?php endif; ?>
                    <?php if($post->icq!=''): ?>
                        <li class="mrgin_10_0">
                            
                            ICQ: <strong><?php echo $post->icq;?></strong>
                        </li>
                    <?php endif; ?>
                    <?php if($post->skype!=''): ?>
                        <li class="mrgin_10_0">
                            
                            Skype: <strong><?php echo $post->skype;?></strong>
                        </li>
                    <?php endif; ?>
				</ul>
			</div>
			<div class="location_info">
				<address>
					<p class="tcenter small lheight14 margin5_0"><strong class="block"><?=Domen::getGeoNameById($post->domen)?></strong>
					
					</p>
				</address>
			</div>
		</div>
		</div>


	</div>
	<div class="clear"></div>

</div>

