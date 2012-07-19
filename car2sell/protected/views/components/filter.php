<div id="filter">
	<div class="filter_wraper">
		<div class="mrgin_bot_10">
			<form id="search-form" action="" name="SearchForm" method="GET" >
				<div class="row" style="padding:10px 0 0 0;">
					<input style="height:30px;border-radius:3px 0 0 3px;width:800px;" class="f_left wt_gr" type="text" name="q[text]" placeholder="Поиск..." />
					<span class="button" style="width:78px;border-radius:0 3px 3px 0;" >
						<input style="width:100%" type="submit" name="q[submit]" class="" value="" />
					</span>
				</div>
				<div class="clear"></div>

				<div class="row" >
					<div class="col_1 f_left">
						<span>Выберите марку</span>
						<select id="PostForm_fuel" name="q[category]" class="wt_gr br_4">
							<option value="0">Выбрать</option>
							<?php foreach($categories as $k => $v): ?>
								<option <?php if(isset($category) && $category->id == $k ) echo 'selected="selected"' ?> value="<?php echo $k; ?>"><?php echo $v; ?></option>
							<?php endforeach; ?>
						</select>
					</div>
					<div class="col_1 f_left">
						<span>Коробка передач</span>
						<select id="PostForm_gear" name="q[gear]" class="wt_gr br_4">
							<option value="0">Выбрать</option>
							<option value="auto">Автоматическая</option>
							<option value="manual">Ручная</option>
							<option value="other">Другая</option>
						</select>
					</div>
				</div>
				<div class="clear"></div>

				<div class="row" >
					<div class="col_1 f_left">
						<span>Вид топлива</span>
						<select id="PostForm_fuel" name="q[fuel]" class="wt_gr br_4">
							<option value="0">Выбрать</option>
							<option value="gas">Бензин</option>
							<option value="diesel">Дизель</option>
							<option value="other">Другой</option>
						</select>
					</div>
					<div class="col_1 f_left">
						<span>Частное лицо / Компания</span>
						<select id="PostForm_owner_type" name="q[owner_type]" class="wt_gr br_4">
							<option value="0">Выбрать</option>
							<option value="user">Частное лицо</option>
							<option value="company">Компания</option>
						</select>
					</div>
				</div>
				<div class="clear"></div>

				<div class="row" >
					<span>Цена (руб.)</span>
					<span> от</span>
					<input type="text" id="PostForm_price" name="q[price_f]" class="wt_gr br_4" value="<?php if(isset($filters['price_f'])) echo $filters['price_f'];?>" />
					<span> до</span>
					<input type="text" id="PostForm_price" name="q[price_t]" class="wt_gr br_4" value="<?php if(isset($filters['price_t'])) echo $filters['price_t'];?>" />
				</div>

				<div class="row" >
					<span>Объем двигателя (см<sup>3</sup>)</span>
					<span> от</span>
					<input type="text" id="PostForm_engine_value" name="q[engine_value_f]" class="wt_gr br_4" value="<?php if(isset($filters['engine_value_f'])) echo $filters['engine_value_f'];?>" />
					<span> до</span>
					<input type="text" id="PostForm_engine_value" name="q[engine_value_t]" class="wt_gr br_4" value="<?php if(isset($filters['engine_value_t'])) echo $filters['engine_value_t'];?>" />
				</div>

				<div class="row" >
					<span>Пробег (км)</span>
					<span> от</span>
					<input type="text" id="PostForm_mileage" name="q[mileage_f]" class="wt_gr br_4" value="<?php if(isset($filters['mileage_f'])) echo $filters['mileage_f'];?>" />
					<span> до</span>
					<input type="text" id="PostForm_mileage" name="q[mileage_t]" class="wt_gr br_4" value="<?php if(isset($filters['mileage_t'])) echo $filters['mileage_t'];?>" />
				</div>

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
						<span>Продам</span>
					<?php else: ?>
					<span class="tab">
						<?php $pre = (count($filters)>0 && $filters!=FALSE) ? '&' : '?';?>
						<a class="bold" href="<?php echo Yii::app()->request->getRequestUri().$pre.'q[buy_sell]=buy'; ?>">Куплю</a>
					<?php endif; ?>
					</span>
				</li>
			</ul>
		</div>
	</div>
</div>
<div class="clear"></div>
