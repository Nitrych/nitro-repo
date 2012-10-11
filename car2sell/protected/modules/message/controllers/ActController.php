<?
class ActController extends Controller
{
	
public $defaultAction = 'act';	
public function actionAct($id)
	{
		
		$command = Yii::app()->db->createCommand();
		
		
		$command->update('messages', array(
				'hide' => 0,
				//'moderated_at' => time(),
			     ), 'id=:id', array(':id' => $id));
		//send email to owner
		
		$referer = $_SERVER['HTTP_REFERER'];
		if(strpos($referer,'moderate')!==false)
			$this->redirect(array('/message/moderate'));
		else
			$this->redirect(array('admin'));
	}
	
}	
?>