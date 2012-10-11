<?php $this->pageTitle=Yii::app()->name . ' - '.MessageModule::t("Messages:inbox"); ?>
<?php
	$this->breadcrumbs=array(
		MessageModule::t("Messages"),
		MessageModule::t("Inbox"),
	);
?>

<?php $this->renderPartial(Yii::app()->getModule('message')->viewPath . '/_navigation') ?>

<h1><?php echo MessageModule::t('Сообщения'); ?></h1>
<?php include('./protected/views/components/user_menu.php'); ?>

<?php if ($messagesAdapter->data): ?>
	<?php $form = $this->beginWidget('CActiveForm', array(
		'id'=>'message-delete-form',
		'enableAjaxValidation'=>false,
		'action' => $this->createUrl('delete/')
	)); ?>
	<div class="report bd_e3" style="width:400px">
	<table class="dataGrid " style="width:100%" >
		<tr class="admin-table-header-row">
			<!--th  class="label">From</th-->
			<th  class="label darkh"  align="left"></th>
			<th  class="label darkh"  align="left">Автор</th>
			<th  class="label darkh"  align="right">Сообщение</th>
			<th  class="label darkh"  align="right">Дата</th>
		</tr>
		<?php foreach ($messagesAdapter->data as $index => $message): ?>
			<tr class="<?php echo $message->is_read ? 'read' : 'unread' ?>" >
				
				<!--td>
					
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
					<?php echo $message->getSenderName(); ?>
				</td-->
				<td align="left">
					<?php echo CHtml::checkBox("Message[$index][selected]"); ?>
					<?php echo $form->hiddenField($message,"[$index]id"); ?>
				</td>
			
				<td align="left">
					
					<a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo $message->subject ?></a></td>
				<td align="right"><a href="<?php echo $this->createUrl('view/', array('message_id' => $message->id)) ?>"><?php echo substr($message->body,0,30)."..." ?></a></td>
				<td align="right"><span class="date"><?php echo date(Yii::app()->getModule('message')->dateFormat, strtotime($message->created_at)) ?></span></td>
			</tr>
		<?php endforeach ?>
	</table>
    
		<div class="row buttons">
			<span class="br_3 button">
			<?php echo CHtml::submitButton(MessageModule::t("Удалить выбранное"),array('class'=>'color_F pding_0_15', 'style'=>'padding-bottom:3px;')); ?>
			</span>	
		</div>
	</div>	
	
<?php $this->endWidget(); ?>
	<?php $this->widget('CLinkPager', array('pages' => $messagesAdapter->getPagination())) ?>
<?php endif; ?>
