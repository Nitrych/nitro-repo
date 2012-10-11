<h2>Позравляем</h2>
Ваше объявление <b><?=$post->title?></b> опубликовано на сайте car2sell.ru.<br> 
<br>
Не удаляйте письмо с помощью ссылок вы можете редактировать ваше объявление.

<p>Повысить эффективность <a href="<?=$baseUrl?>/cont/help_top/"><?=$baseUrl?>/cont/help_top/</a></p>
<p>Увидеть объявление на сайте <a href="<?=$post->getLink()?>"><?=$post->getLink()?></a></p>
<p>Редактировать объявление <a href="<?=$baseUrl?>/post/updatepost/<?=$post->id?>/key/<?=$secret_key?>"><?=$baseUrl?>/post/updatepost/<?=$post->id?>/key/<?=$secret_key?></a></p>
<p>Удалить объявление <a href="<?=$baseUrl?>/post/hidepost/<?=$post->id?>/key/<?=$secret_key?>"><?=$baseUrl?>/post/hidepost/<?=$post->id?>/key/<?=$secret_key?></a></p>


