<div id="content" >
    <div class="pding_20">
       
        <div class="bd_top_sl_df bd_bot_sl_df bg_fb">
            <div class="pding_20">
				 <?php if($params['notify_id']==1): ?>
					<h3 class="fs_18 color_2b mrgin_bot_20 bold ">Подтверждение подписки</h3>
					<p class="mrgin5_0">Ваша подписка сохранена, но вам нужно активировать её, пройдя по ссылке в письме, которое мы вам только что отправили. Если письма нет, проверьте папку Спам.</p>
				<?php endif; ?>
				<?php if($params['notify_id']==2): ?>
					<h3 class="fs_18 color_2b mrgin_bot_20 bold ">Подтверждение подачи объявления</h3>
					<p class="mrgin5_0">Ваше объявление сохранено, но вам нужно подтвердить его, пройдя по ссылке в письме, которое мы вам только что отправили. Если письма нет, проверьте папку Спам.</p>
				<?php endif; ?>
            </div>
            <div class="pding_20 bd_top_das_d7" >
                <?php if(Helper::getEmailLink($params['mail_id'])!=NULL): ?>
                    <a target="_blank" class="fs_14 bold" href="<?php echo Helper::getEmailLink($params['mail_id']); ?>">Проверить почту</a>
                <?php else: ?>
                    <p class="fs_14 bold"></p>
                <?php endif; ?>
            </div>
            <div class="pding_20 bd_top_das_d7" >
                <a class="fs_14 bold" href="/">На главную</a>
            </div>
        </div>
        
    </div>
</div>
