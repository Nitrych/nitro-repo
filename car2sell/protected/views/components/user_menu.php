<div class=submenu>Баланс: <?=Balance::getUserBalance(Yii::app()->user->id)?> руб. 
	<a class="<?=Helper::getLinkClass("/pay/form")?>" href="/pay/form">Пополнить баланс</a> | 
	<a class="<?=Helper::getLinkClass("/pay/history")?>" href="/pay/history">История платежей</a> |
	<a class="<?=Helper::getLinkClass("/message/")?>" href="/message/inbox">Сообщения</a> |
	<a class="<?=Helper::getLinkClass("/account/settings")?>" href="/account/settings">Настройки</a> 
</div>