
<div id="content" >
	<div class="mrgin_top_20 mrgin_bot_5">
		<h1 class="lh_28 bold fs_21"><?php echo $post->title; ?></h1>
		<p class="fs_11 color_62"><b><?php echo $domen->city; ?></b> Добавлено: <?php echo Helper::timeToString($post->time); ?>, номер: <?php echo $post->id; ?></p>
	</div>

	<div>
		<div class="post_body mrgin_top_10 f_left">
            <?php if(isset($fotos[0]['path'])): ?>
                <div class="foto_slider mrgin_bot_10">
                    <div id="foto_1"><img src="<?php echo $fotos[0]['path']; ?>" /></div>
                </div>
            <?php endif; ?>

			<table width="100%" cellspacing="0" cellpadding="0" class="details fixed mrgin_bot_10 mrgin_top_5">
			<tbody>
				<tr>
					<td width="33%" class="bd_righ_das_c8">
						<div class="pding_5_10"> Модель: <strong class="block mrgin_top_5"> <?php echo $post->model; ?> </strong></div>
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
			<?php if(count($fotos)): ?>
				<?php foreach($fotos as $key => $foto): ?>
					<?php if($key==0) continue; ?>
					<p><img src="<?php echo $foto->path; ?>" /></p><br />
				<?php endforeach; ?>
			<?php endif; ?>
			<p>Просмотры: <strong><?php echo $post->view; ?></strong> </p>
		</div>

		<div class="relative f_left post_right">
			<div class="post_price ta_center br_5">
				<strong class="fs_lh_22_24 block"><?php echo Helper::numberToString($post->price); ?> руб.</strong>
				<?php if($post->auction == 1): ?>
					<small class="block lh_15">Торг возможен</small>
				<?php endif; ?>
			</div>
			<div class="contact_info">
				<div class="mrgin_bot_10 mrgin_top_10 pding_5_0 ">
					<div class="f_left user_icon  mrgin_righ_15">
					</div>
					<p class="color_0 fs_lh_16 over_h">
						<?php echo $post->username; ?>
                        <?php if($post->creator_id>0): ?>
                            <span class="block">
                                <a class="fs_11" href="/post/user/id/<?php echo $post->creator_id; ?>"><span>Все объявления автора</span></a>
                            </span>
                        <?php endif; ?>
					</p>
				</div>
				<div class="clear"></div>
				<ul id="contact_methods">
                    <?php if($post->phone_number!=''): ?>
                        <li class="mrgin_10_0">
                            <!--TODO <span class="phone_icon">&nbsp;</span>-->
                            Тел.: <strong><?php echo substr($post->phone_number, 0, 2);?>XXXXX</strong>
                            <a class="" href="#"><span>«&nbsp;Показать</span></a>
                        </li>
                    <?php endif; ?>
                    <?php if($post->icq!=''): ?>
                        <li class="mrgin_10_0">
                            <!--TODO <span class="phone_icon">&nbsp;</span>-->
                            ICQ: <strong><?php echo $post->icq;?></strong>
                        </li>
                    <?php endif; ?>
                    <?php if($post->skype!=''): ?>
                        <li class="mrgin_10_0">
                            <!--TODO <span class="phone_icon">&nbsp;</span>-->
                            Skype: <strong><?php echo $post->skype;?></strong>
                        </li>
                    <?php endif; ?>
				</ul>
			</div>
			<div class="location_info ta_center">
				<address>
					<p class="tcenter small lheight14 margin5_0">Адрес:<strong class="block">аксай</strong></p>
				</address>
			</div>
		</div>
	</div>
	<div class="clear"></div>

</div>
