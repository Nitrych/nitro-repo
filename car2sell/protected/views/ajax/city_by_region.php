<option value="not">Выбрать</option>
<?php foreach($cities as $city): ?>
	<option value="<?php echo $city->id; ?>"><?php echo $city->city; ?></option>
<?php endforeach;?>

