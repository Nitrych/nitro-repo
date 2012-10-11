<div id="region_name_for_submenu"><?=$region->name?></div>
<?php foreach($cities as $city): ?>
<a class='select-city'  href='http://<?=$city->regionx->reg_domain.Yii::app()->params['baseServerName']?>'>Весь регион</a> 
<?php 
break;
endforeach;?>
<?php foreach($cities as $city): ?>
   <a class='select-city' id='c<?=$city->id?>' href='http://<?=$city->name?>.<?=$city->regionx->reg_domain.Yii::app()->params['baseServerName']?>'><?=$city->city?></a> 
<?php endforeach;?>
