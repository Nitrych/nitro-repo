<div id="content" >
	<?php 
    if($post_deleted)
		echo Helper::SiteMessage('Объявление помечено как скрытое',''); 
    else{
		echo "<form method=post >
		<input type=hidden name='delete_post' value='1'>	
		<input type=submit value='Действительно удалить объявление'>
		</form>";
	}
	?>
    
	
</div>
