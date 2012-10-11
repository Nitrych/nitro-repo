<?php

$system_path = "./protected/extensions/reports/";

require_once($system_path."admin_table.php");
require_once($system_path."wrappers.php");

class PayController extends Controller
{

	public function actionIndex()
	{
		$this->render('about',array());
	}
	public function actionForm()
	{
		$model = new RoboPayForm;

		if(isset($_POST['RoboPayForm']))
		{
			$model->attributes=$_POST['RoboPayForm'];

			if($model->validate())
			{
				$command = Yii::app()->db->createCommand();
				$command->insert('robopays', array(
					'user_id' => Yii::app()->user->id,
					'created_at' => date("Y-m-d H:i:s"),
				));

				$invId = Yii::app()->db->getLastInsertID();
				$mrhLogin = "dmi2nfc";      // your login here
				
				$mrhLogin = Config::read('mrhLogin');      // your login here
				
				$mrhPass1 = "somesome1";   // merchant pass1 here
				
				
				$mrhPass1 = Config::read('mrhPass1');      // your login here
				
				$invDesc = "Оплата услуг";
				$outSum = intval($model->summ) > 1 ? intval($model->summ) : 1; // invoice summ

				// build CRC value
				$crc = md5("$mrhLogin:$outSum:$invId:$mrhPass1");
				// build URL
				
				$roboUrl = "http://test.robokassa.ru/Index.aspx?MrchLogin=" . $mrhLogin. "&OutSum=" . $outSum . "&InvId=" . $invId . "&Desc=" . $invDesc . "&SignatureValue=" . $crc;
				//$roboUrl = "https://merchant.roboxchange.com/Index.aspx?MrchLogin=" . $mrhLogin. "&OutSum=" . $outSum . "&InvId=" . $invId . "&Desc=" . $invDesc . "&SignatureValue=" . $crc;
				Yii::app()->request->redirect($roboUrl); // redirect to the gate
			}
		}
		$this->render('form',array(
			'model'=>$model,
		));

	}
	public function actionProcess() {
		// your registration data
		$mrhPass1 = "somesome2";  // merchant pass1 here
	    $mrhPass1 = Config::read('mrhPass2'); 
		// HTTP parameters:
		$outSum = $_REQUEST["OutSum"];
		$invId = $_REQUEST["InvId"];
		$crc = $_REQUEST["SignatureValue"];
		$crc = strtoupper($crc);  // force uppercase
		// build own CRC
		//print_r($_REQUEST);
		//echo strtoupper(md5("$outSum:$invId:$mrhPass1"));
		//exit("");
	
		$my_crc = strtoupper(md5("$outSum:$invId:$mrhPass1"));
		if (strtoupper($my_crc) != strtoupper($crc))  {
			// rendering bad page
			$this->render('declined');
		}
		else {
			$command = Yii::app()->db->createCommand();
			$command->update('robopays', array(
				'summ'=>$outSum,
			), 'id=:id', array(':id' => $invId));
			// rendering success page
			//$this->render('accepted',array('outSum' => $outSum));
			echo "OK".$invId;
			exit("");
		}
	}
	public function actionCancel(){
		// if user cancelled
		$this->render('canceled');
	}
	public function actionSuccess(){
		// if user cancelled
		$this->render('accepted');
	}
	
	public function actionHistory(){
		$report = $this->getHistory();
		

	    $this->render('history', array('content' => $report));
	}
    
	public function getHistory(){
			$table_def = array(

				  'table' => "robopays r", 
				  'primary' => "r.id",
				  //'actions_position' => "right",
				  'where' => "  user_id=".Yii::app()->user->id,
				  'order_by' => "  r.id desc ",

				  );



			$fields = array(

				 'r.created_at'=>array(
							  'caption'=>'Дата',
							  'align'=>'left'
							   ),

				 'r.summ'=>array(
							  'caption'=>'Сумма',
							  'align'=>'right',
					          'summary'=>'sum'
							   ),
				 'r.summ as e'=>array(
							  'caption'=>'Детали',
							  'align'=>'right',
					          'wrapper'=>'details'
							   ),

			);
			
			$report = Report::reportByData($table_def,$fields);
			return $report;
	}
}

function wrapper_details($str,$id){
	$number = intval($str);
	if($number>0)
		return "пополнение баланса";
	else
		return "оплата услуг";
}

?>