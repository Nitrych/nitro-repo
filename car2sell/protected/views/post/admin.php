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

<h1>Управление объявлениями</h1>


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
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'rowCssClassExpression'=>'($data->moderated_at>0)?"row-moderated":"row-not_moderated"',
	'columns'=>array(
		'id',
		/*'creator_id',*/
		array(            
            'name' => 'creator',
			'header' => 'Автор',
			'type' => 'html',
            'value' => 
			'"<a href=".Helper::addUrlParameter("Post[email]",$data->email)." >$data->email</a>"',
			//'((is_object($data->creator_info) && $data->creator_info->ads_count>1)?" <a href=".Helper::addUrlParameter("Post[email]",$data->creator_info->id)." >".$data->creator_info->email."</a>":(($data->creator_info->email!="")?$data->creator_info->email:$data->email));',
			
        ),
		'title',
		'text',
		//'buy_sell',
		'price',
		
		array(            
            'name' => 'moderated_at',
			'header' => 'статус',
			'type' => 'html',
            'value' => '($data->moderated_at==0) ? " - ": date("d-m-Y",$data->moderated_at)',
			'cssClassExpression' => '',
        ),
		
		
		array(            
            'name' => 'hide',
			'header' => 'модерация',
			'type' => 'html',
            'value' => '($data->hide==1)?"<a href=\"/post/act/$data->id\">одобрить</a>":"<a href=\"/post/hid/$data->id\">скрыть</a>"',
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
				'update'=>array(
					//'url'=>'/post/show/id/'.$data->primaryKey,
					'url'=>'$this->grid->controller->createUrl("/post/updatepost/$data->primaryKey/key/admin")',
					//'options'=>array ( 'target'=>'_blank'),
		            'label'=>'Редактировать'
				),
				'delete'=>array(
					
					'url'=>'$this->grid->controller->createUrl("/post/show/id/$data->primaryKey/")',
					'options'=>array ( 'target'=>'_blank'),
		            'visible'=>'false'
				)
			)
		),
	),
)); ?>
