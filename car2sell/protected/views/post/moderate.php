<?php

$this->layout = 'admin';

$this->breadcrumbs=array(
	'Posts'=>array('index'),
	'Manage',
);

$this->menu=array(
	
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('post-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Модерация объявлений</h1>

(показаны объявления подтвержденные пользоватем по ссылке в почте)


<?=Helper::siteNotify(NFC::getMessage(),NFC::getError());?>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>

<div class="strong bold pding_10_0">Автор: <?=Helper::getAuthorFilter()?></div>
<br>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'post-grid',
	'dataProvider'=>$model->search("moderate"),
	'filter'=>$model,
	'rowCssClassExpression'=>'($data->urgent==1)?"row-urgent":""',
	'columns'=>array(
		array(            
            'name' => 'urgent',
			'header' => 'срочность',
			'type' => 'html',
            'value' => '( $data->urgent==1 )?"<b>срочно</b>":""',
			
        ),
		/*'creator_id',*/
		array(            
            'name' => 'creator',
			'header' => 'Автор',
			'type' => 'html',
            'value' => 
			'"<a href=".Helper::addUrlParameter("Post[email]",$data->email)." >$data->email</a>"',
			//'((is_object($data->creator_info) && $data->creator_info->ads_count>1)?" <a href=".Helper::addUrlParameter("Post[creator_id]",$data->creator_info->id)." >".$data->creator_info->email."</a>":$data->creator_info->email);',
			
        ),
		'title',
		'text',
		'buy_sell',
		'price',
		array(            
            'name' => 'hide',
			'header' => 'модерация',
			'type' => 'html',
            'value' => '( Post::saveId($data->id) && $data->hide==1 )?"<a href=\"/post/act/$data->id\">одобрить</a>":"<a href=\"/post/hid/$data->id\">скрыть</a>"',
			'cssClassExpression' => '($data->hide==1)?"hidden_post":"shown_post"',
        ),
		
		
		  //array( 'name'=>'region_search', 'value'=>'$data->regionx->name' ),
		
	
		 /*
		 */
		/*
		'auction',
		'model',
		'year',
		'color',
		'mileage',
		'engine_value',
		'fuel',
		'gear',
		'owner_type',
		'username',
		'email',
		'phone_number',
		'icq',
		'skype',
		'category',
		'domen',
		'time',
		'view',
		*/
		array(
			'class'=>'CButtonColumn',
			'buttons'=>array(
				'view'=>array(
					//'url'=>'/post/show/id/'.$data->primaryKey,
					'url'=>'$this->grid->controller->createUrl("/post/show/id/$data->primaryKey/")',
					'options'=>array ( 'target'=>'_blank'),
		            'label'=>'Посмотреть (в новом окне)'
				),
				'delete'=>array(
					
					'url'=>'$this->grid->controller->createUrl("/post/show/id/$data->primaryKey/")',
					'options'=>array ( 'target'=>'_blank'),
		            'visible'=>'false'
				)
			)
		),
	),
)); 


?>
<div style="float:right; width:300px">
<form method="POST"  >
	<input type="hidden" name="moderate_all" value="1">
	<input type="submit" value="Отмодерировать все на странице">
</form>
</div>	