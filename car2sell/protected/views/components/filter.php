<?php $sugges_year = array('1989', '1996', '1999', '2002', '2004', '2005', '2007', '2008', '2009', '2011',); ?>
<?php $sugges_price = array('10000', '50000', '100000', '150000', '200000', '250000', '300000', '400000', '500000',); ?>
<?php $sugges_ev = array('3', '200', '1500', '1750', '2000', '2250', '3000',); ?>
<?php $sugges_mileage = array('125', '25000', '50000', '70000', '80000', '100000', '125000', '150000', '175000', '250000',); ?>
<div id="filter">
	
	<div class="filter_wraper">
		<div class="mrgin_bot_10">
			<form id="search-form" action="/" name="SearchForm" method="GET" >
				<div class="row" style="padding:10px 0 0 0;">
					<input id="main_search_field" style="" class="f_left wt_gr" type="text" name="q[text]" value="<?=(isset($gdata['q']['text']) && $gdata['q']['text']!='' )? $gdata['q']['text']:"";?>" placeholder="<?=(isset($gdata['q']['text']) && $gdata['q']['text']!='' )? "":" Поиск...";?>" />
					<div id="sel-reg-button" >
						   <a href="javascript:void(0)">
					       <?=DomenFilter::getCurrentGeoName()?></a></div>
										
					<span class="button" style="width:78px;border-radius:0 3px 3px 0; height:28px" >
						<input style="width:100%; " type="submit" name="q[submit]" class="color_f" value="Искать" />
					</span>
				</div>
				<div class="clear"></div>
                
				<div class="regions_select_area">
					<ul class="regions" >
						<? 
						   $k = 0;
						   echo "<ul class='fleft part25'>";
						   foreach ($regions as $rid=>$rname):
							   if ($k==0)
								   echo "<li><a class='select-region'  href='".Helper::getBU()."/post/allregions/'>Все регионы</a></li>";	   
							   if($k==20 || $k==41 || $k==61)
								   echo "</ul>
									     <ul class='fleft part25'>";
							   echo "<li><a class='select-region' id='r$rid' href='javascript:void()'>$rname</a></li>";	   
							   $k++;	   
							   
							
							
						   endforeach;	
						   echo "</ul>";
							?>
						
					</ul>	
					
					
				</div>
				<div class="cities_select_area"></div>
				<!--div class="row" >
					<div class="col_1 f_left">
						<span>Выберите регион</span>
						<select id="PostForm_region" name="q[region]" class="wt_gr br_4">
							<option value="0">Вcе</option>
							<?php foreach($regions as $k => $v): ?>
								<option <?php if(isset($gdata['q']['region']) && $gdata['q']['region'] == $k ) echo 'selected="selected"' ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					
				</div-->
				<div class="clear"></div>
				<div class="hidable">
						<div class="row" >
							<input class="checkb" <?=Helper::getCheckedAttr('in_content','ON')?> name="q[in_content]" type="checkbox" value="ON">  Искать в тексте объявлений
							<input class="checkb" <?=Helper::getCheckedAttr('with_photo','ON')?> name="q[with_photo]" type="checkbox" value="ON">  Только с фото
						</div>
						<div class="row" >
							<div class="col_2 f_left">
								<span>Марка</span>
								<select id="PostForm_fuel" name="q[category]" class="wt_gr br_4">
									<option value="0">Любая</option>
									<?php foreach($categories as $k => $v): ?>
										<option <?php if(isset($category) && $category->id == $k ) echo 'selected="selected"' ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
							<div class="col_2 f_left">
								<span>Коробка передач</span>
								<select id="PostForm_gear" name="q[gear]" class="wt_gr br_4">
									<option value="0">Любая</option>
									<option <?=Helper::getSelectedAttr('gear','auto')?> value="auto">Автоматическая</option>
									<option <?=Helper::getSelectedAttr('gear','manual')?> value="manual">Ручная</option>
									<option <?=Helper::getSelectedAttr('gear','other')?> value="other">Другая</option>
								</select>
							</div>

							<div class="col_2 f_left">
								<span>Вид топлива</span>
								<select id="PostForm_fuel" name="q[fuel]" class="wt_gr br_4">
									<option value="0">Любой</option>
									<option <?=Helper::getSelectedAttr('fuel','gas')?> value="gas">Бензин</option>
									<option <?=Helper::getSelectedAttr('fuel','diesel')?> value="diesel">Дизель</option>
									<option <?=Helper::getSelectedAttr('fuel','other')?> value="other">Другой</option>
								</select>
							</div>
							<div class="col_2 f_left">
								<span>Частное лицо / Компания</span>
								<select id="PostForm_owner_type" name="q[owner_type]" class="wt_gr br_4">
									<option value="0">Не важно</option>
									<option <?=Helper::getSelectedAttr('owner_type','user')?> value="user">Частное лицо</option>
									<option <?=Helper::getSelectedAttr('owner_type','company')?> value="company">Компания</option>
								</select>
							</div>
						</div>


						<div class="clear"></div>


						<div class="row" >
							<div class="col_2 f_left">
								<span>Цена (руб.)</span>
								<span> от</span>
								<input type="text" id="PostForm_price" name="q[price_f]" class="wt_gr br_4 with_suggest" value="<?php if(isset($filters['price_f'])) echo $filters['price_f'];?>" />
								<div class="absolute in_bl wh_1" >
									<ul class="relative suggest_box" suggestfor="q[price_f]"  >
										<?php foreach($sugges_price as $item): ?>
											<li class="color_0"><?=$item?></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="absolute in_bl wh_1" >
									<ul class="relative suggest_box second" suggestfor="q[price_t]" >
										<?php foreach($sugges_price as $item): ?>
											<li class="color_0"><?=$item?></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<span> до</span>
								<input type="text" id="PostForm_price" name="q[price_t]" class="wt_gr br_4 with_suggest" value="<?php if(isset($filters['price_t'])) echo $filters['price_t'];?>" />
							</div>
							<div class="col_2 f_left">
								<span>Год выпуска</span>
								<span> от</span>
								<input type="text" id="PostForm_year" name="q[year_f]" class="wt_gr br_4 with_suggest" value="<?php if(isset($filters['year_f'])) echo $filters['year_f'];?>" />
								<div class="absolute in_bl wh_1" >
									<ul class="relative suggest_box" suggestfor="q[year_f]"  >
										<?php foreach($sugges_year as $item): ?>
											<li class="color_0"><?=$item?></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="absolute in_bl wh_1" >
									<ul class="relative suggest_box second" suggestfor="q[year_t]" >
										<?php foreach($sugges_year as $item): ?>
											<li class="color_0"><?=$item?></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<span> до</span>
								<input type="text" id="PostForm_year" name="q[year_t]" class="wt_gr br_4 with_suggest" value="<?php if(isset($filters['year_t'])) echo $filters['year_t'];?>" />
							</div>
							<div class="col_2 f_left">
								<span>Объем двигателя (см<sup>3</sup>)</span>
								<span> от</span>
								<input type="text" id="PostForm_engine_value" name="q[engine_value_f]" class="wt_gr br_4 with_suggest" value="<?php if(isset($filters['engine_value_f'])) echo $filters['engine_value_f'];?>" />
								<div class="absolute in_bl wh_1" >
									<ul class="relative suggest_box" suggestfor="q[engine_value_f]" >
										<?php foreach($sugges_ev as $item): ?>
											<li class="color_0"><?=$item?></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="absolute in_bl wh_1" >
									<ul class="relative suggest_box second" suggestfor="q[engine_value_t]" >
										<?php foreach($sugges_ev as $item): ?>
											<li class="color_0"><?=$item?></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<span> до</span>
								<input type="text" id="PostForm_engine_value" name="q[engine_value_t]" class="wt_gr br_4 with_suggest" value="<?php if(isset($filters['engine_value_t'])) echo $filters['engine_value_t'];?>" />
							</div>
							<div class="col_2 f_left">
								<span>Пробег (км)</span>
								<span> от</span>
								<input type="text" id="PostForm_mileage" name="q[mileage_f]" class="wt_gr br_4 with_suggest" value="<?php if(isset($filters['mileage_f'])) echo $filters['mileage_f'];?>" />
								<div class="absolute in_bl wh_1" >
									<ul class="relative suggest_box" suggestfor="q[mileage_f]" >
										<?php foreach($sugges_mileage as $item): ?>
											<li class="color_0"><?=$item?></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<div class="absolute in_bl wh_1" >
									<ul class="relative suggest_box second" suggestfor="q[mileage_t]" >
										<?php foreach($sugges_mileage as $item): ?>
											<li class="color_0"><?=$item?></li>
										<?php endforeach; ?>
									</ul>
								</div>
								<span> до</span>
								<input type="text" id="PostForm_mileage" name="q[mileage_t]" class="wt_gr br_4 with_suggest" value="<?php if(isset($filters['mileage_t'])) echo $filters['mileage_t'];?>" />
							</div>
						</div>
						<div class="clear"></div>
						<div class="clear"></div>
						
		         </div>
				 <a class="hide_hidable" href="javascript:void(0)" rel="Расширеный поиск">Скрыть параметры</a>

				<input type="hidden" id="PostForm_buy_sell" name="q[buy_sell]" value="<?php if(isset($filters['buy_sell'])) echo $filters['buy_sell'];?>" />
			</form>
		</div>
		<div class="bottom-tab">
			<ul class="tabs">
				<li class="f_left">
					<?php if(isset($filters['buy_sell'])): ?>
					<span class="tab">
						<?php $sell_url = str_replace('&q[buy_sell]=buy', '', Yii::app()->request->getRequestUri()); ?>
						<?php $sell_url = str_replace('?q[buy_sell]=buy', '', $sell_url); ?>
						<a class="bold" href="<?php echo $sell_url; ?>">Продам</a>
					<?php else: ?>
					<span class="tab selected">
						<span>Продам</span>
					<?php endif; ?>
					</span>
				</li>
				<li class="f_left">
					<?php if(isset($filters['buy_sell'])): ?>
					<span class="tab selected">
						<span>Куплю</span>
					<?php else: ?>
					<span class="tab">
						<?php $pre = (count($filters)>0 && $filters!=FALSE) ? '&' : '?';?>
						<a class="bold" href="<?php echo Yii::app()->request->getRequestUri().$pre.'q[buy_sell]=buy'; ?>">Куплю</a>
					<?php endif; ?>
					</span>
				</li>
                <div id="view-selector">
                    <div id="fcaption">Вид списка:</div> 
                    <a class="view-icon list <?=Helper::getLinkClass("view=","default")?>"        href="<?=Helper::addUrlParameter("view",'')?>"></a>
                    <a class="view-icon galleryWide <?=Helper::getLinkClass("view=gallery_wide")?>" href="<?=Helper::addUrlParameter("view",'gallery_wide')?>"></a>
                    <a class="view-icon gallery <?=Helper::getLinkClass("view=gallery_simple")?>"     href="<?=Helper::addUrlParameter("view",'gallery_simple')?>"></a>
                    <a class="view-icon galleryBig <?=Helper::getLinkClass("view=gallery_big")?>"  href="<?=Helper::addUrlParameter("view",'gallery_big')?>"></a>
                </div>
			</ul>
		</div>
	</div>
    <div class="order_link_box_wraper">
        <div class="order_link_box pding_10_0">
            <?php $r_active = ''; $l_active= '';
                    if(isset($filters['order']) && ($filters['order']=='price_desc' || $filters['order']=='price_asc'))
                    {
                        $r_active = 'active';
                    }
                    else
                    {
                        $l_active = 'active';;
                    }?>
            <div class="f_left mrgin_left_15 <?php echo $l_active; ?>" >
                <?php if(!isset($filters['order'])): ?>
                    <a href="<?php echo Helper::addUrlParameter('q[order]', 'date_asc'); ?>"><b>Дата</b><span class="bottom_arrow"></span></a>
                <?php else: ?>
                    <a href="<?php echo Helper::addUrlParameter('q[order]', ''); ?>"><b>Дата</b><span class="top_arrow"><span></a>
                <?php endif; ?>
            </div>
            <div class="f_right mrgin_righ_15 <?php echo $r_active; ?>">
                <?php if(isset($filters['order']) && $filters['order']=='price_desc'): ?>
                    <a href="<?php echo Helper::addUrlParameter('q[order]' ,'price_asc'); ?>"><b>Цена</b><span class="bottom_arrow"></span></a>
                <?php else: ?>
                    <a href="<?php echo Helper::addUrlParameter('q[order]' ,'price_desc'); ?>"><b>Цена</b><span class="top_arrow"><span></a>
                <?php endif; ?>
            </div>
            <div class="clear"></div>
        </div>
    </div>

</div>
