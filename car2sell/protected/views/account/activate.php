<div id="content">
    <p>&nbsp;</p>
    <p>&nbsp;</p>
    <?php  if($result == User::ACTIVATION_SUCCESS): ?>
        <div class="activate_success">
        <center><h1 class="bold fs_lh_14_18 color_62">Ваш акаунт успешно активирован</h1></center>
        <p class="message_text">
            В течении 5 секунд Вас будет перенаправлено на страницу <i><b>авторизации</b></i>. Если етого не произошло, воспользуйтесь этой 
            <a href="/account/login/">ссылкой</a>.
            </p>
        </div>
    <?php elseif($result == User::ACTIVATION_ERROR): ?>
        <div class="activate_error">
            <center><h1 class="bold fs_lh_14_18 color_62">Код активации неверен</h1></center>
            <p class="message_text">
                Вполне вероятно, что вы пытаетесь воспользоватся <i><b>устаревшей</b></i> ссылкой активации. Пожалуйсто обратитесь к администрации ресурса.
            </p>
        </div>
    <?php endif; ?>
</div>


