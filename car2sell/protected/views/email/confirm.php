Email:<?php echo $email->subject ?>
<br />
From:<?php echo $email->from ?>
<br />
Вы успешно зарегестрировались на сайте car2sell.ru, для активации вашей учетной записи перейдите по ссылку 
<a href="http://www.<?php echo $baseUrl; ?>/account/activate/id/<?php echo $id ?>/key/<?php echo $confirm_key ?>" >Активировать</a>
