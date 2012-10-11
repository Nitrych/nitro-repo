<ul class="clr margintop15 marginbott10 marginleft5 adoptions lheight14">
			<li class="fleft part25">
				<a href="<?=$post->getLink('print')?>" class="block tdnone tcenter x-small clicker {clickerID:'ad_print'}">
					<span class="inlblk icon print">&nbsp;</span>
					<span class="link gray2 block"><span>Печать</span></span>
				</a>
			</li>
			<li class="fleft part25">
				<a href="<?=Helper::getBU()?>/post/myads" class="block tdnone tcenter x-small clicker {clickerID:'ad_edit'}">
					<span class="inlblk icon edit">&nbsp;</span>
					<span class="link gray2 block"><span>Изменить</span></span>
				</a>
			</li>
			<li class="fleft part25">
				<a href="<?=$post->getLink('pdf')?>" rel="nofollow" class="block tdnone tcenter x-small clicker {clickerID:'ad_leaflet'}">
					<span class="inlblk icon leaflet">&nbsp;</span>
					<span class="link gray2 block"><span>Листовка</span></span>
				</a>
			</li>
			<li class="fleft part25">
				<a href="#report-data" title="Жалоба" class="block tdnone tcenter x-small report-links clicker {clickerID:'ad_report'}" id="reportMe">
					<span class="inlblk icon report2">&nbsp;</span>
					<span class="link report block"><span>Жалоба</span></span>
				</a>
				<div style="display:none">
				<div id="report-data">
					
					<form action="<?=Helper::getBU()?>/ajax/spam" method="post" class="rel default report" id="report-form" >
					
    				<fieldset class="pding0_20 margintop10 overh">
						<input type="hidden" name="report[post_id]" value="<?=$post->id?>">
 	    				    					<div class="fblock clr">
    						<input type="radio" class="radio" name="report[reason]" value="spam" id="reason-spam" class="fleft marginright5">
    						<label for="reason-spam"><strong>Спам</strong></label>
    					</div>
    					    					<div class="fblock clr">
    						<input type="radio" class="radio" name="report[reason]" value="badCategory" id="reason-badCategory" class="fleft marginright5">
    						<label for="reason-badCategory"><strong>Неверная рубрика</strong></label>
    					</div>
    					    					<div class="fblock clr">
    						<input type="radio" class="radio" name="report[reason]" value="violation" id="reason-violation" class="fleft marginright5">
    						<label for="reason-violation"><strong>Запрещенный товар/услуга</strong></label>
    					</div>
    					    					<div class="fblock clr">
    						<input type="radio" class="radio" name="report[reason]" value="outofdate" id="reason-outofdate" class="fleft marginright5">
    						<label for="reason-outofdate"><strong>Объявление не актуально</strong></label>
    					</div>
    					    					<div class="fblock clr margin10_0">
    					<div class="focusbox">
	    					<textarea
	    						class="x-normal light required c73 br4"
	    						id="report-textarea"
	    						name="report[content]"
								
	    						><напишите всю важную для проверки информацию. Если вы хотите, чтобы мы вам ответили, укажите тут ваш email-адрес></textarea>
    					</div>
    						<!--p class="small margintop10">Знаков осталось: <b class="report-countdown">1000</b></p-->
    					</div>
    				</fieldset>
    				<div class="fblock brtop-1 clr pding20">
    					<span class="button br3 fright"><input type="submit" class="submit cfff {id: '5rOjF'}" value="Отправить" id="report-submit" ></span>
    	            </div>
				</form>
				</div>
				</div>
			</li>
		</ul>
