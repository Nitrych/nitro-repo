<?php

class Balance {
   static function getUserBalance($user_id){
	    $connection=Yii::app()->db; 

		$sum = 0;
		$sql = "select * from robopays where user_id='".intval($user_id)."'";
		$command = $connection->createCommand($sql);
		$rows = $command->queryAll();
		foreach($rows as $row)
			$sum += $row['summ'];
		return $sum;
	   
   }
   static function reduceBalance($user_id,$summ_by){
	   
	   $command = Yii::app()->db->createCommand();
	   $command->insert('robopays', array(
					'user_id' => $user_id,
					'created_at' => date("Y-m-d H:i:s"),
					'summ' => (-1)*$summ_by,
				));
	   return true;
   }
  
}
?>
