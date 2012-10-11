<!--
Email:<?php echo $email->subject ?>
<br />
From:<?php echo $email->from ?>
<br />
-->
Вы успешно подписались на рассылку объявлений на сайте car2sell.ru, для её активации перейдите по ссылке 
<a href="<?php echo $baseUrl; ?>/subscription/activate/id/<?php echo $id; ?>/key/<?php echo $activate_code; ?>" ><?php echo $baseUrl; ?>/account/activate/id/<?php echo $id; ?>/key/<?php echo $activate_code; ?></a>
