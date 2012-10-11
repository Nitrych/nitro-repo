<?
class ModerateController extends Controller
{
	
public $defaultAction = 'list';	
public function actionList()
	{
		$messagesAdapter = Message::getAdapterForSent(Yii::app()->user->getId());
		if(isset($_POST['moderate_all'])){
		
		    $ids = Post::getIds();
			print_r($ids);
			
			foreach($ids as $id){
				$command = Yii::app()->db->createCommand();
				$command->update('messages', array(
								'moderated_at'=>time()
								)
								, 'id=:id', array(':id'=>$id));
				//Post::sendPublishedEmail($id);	
			}
			NFC::SetMessage("Сообщения отмодерированы");
			
		}
		
		$model=new Message;
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];
		
		//foreach($model as $id=>$item){
		//	$model[$id]->receiver_id =  
		//}
        Post::resetIds();
		$this->render(Yii::app()->getModule('message')->viewPath .'/moderate',array(
			'model'=>$model,
			'messageAdapter'=>$messageAdapter,
		));
	}
	
}	
?>