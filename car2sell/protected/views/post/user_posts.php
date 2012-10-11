<?php //TODO использовать полный путь чтобы не было лагов под виндой; ?>
<h1>Мои объявления</h1>
<div class=submenu>Баланс: <?=Balance::getUserBalance(Yii::app()->user->id)?> руб. <a href="/pay/form">Пополнить баланс</a></div>

<div id="content">
<?php 
echo Helper::siteNotify( NFC::getMessage(), NFC::getError() );
?>
    <?php include('./protected/views/components/post_block_default.php'); ?>
</div>

