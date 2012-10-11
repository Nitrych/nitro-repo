<?

class Ip2city extends CApplicationComponent {

	public function getCityName($ip_address){
		$ip =  ip2long($ip_address);
		
		$connection=Yii::app()->db; 

		$sql = "select gi.*,gc.city_name from geo_ip gi ,geo_city gc where $ip>=ip_start and $ip<=ip_end and gi.city_id=gc.city_id";
		$command = $connection->createCommand($sql);

		$rows = $command->queryAll();
		
		$min = 999999999999;
		$result = false;
		foreach ($rows as $r){
			//echo "<br>".$r['city_name']."-".long2ip("$r[ip_start]")."-".long2ip("$r[ip_end]"); 
			$diff = ($r['ip_end'] - $r['ip_start']);
			if($diff<$min){
				$result = $r['city_name'];
				$min = $diff;
			}
		}
		return $result;
	
		
	
	}
}

?>