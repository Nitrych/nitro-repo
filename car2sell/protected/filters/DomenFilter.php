<?php

class DomenFilter extends CFilter
{

	protected function preFilter($filterChain)
	{   
		
		$sub_name = str_replace(Yii::app()->params['baseServerName'], '', $_SERVER['SERVER_NAME']);

		
		if(strpos($_SERVER['REQUEST_URI'],'post/show/')!==false) {
			//$id = 
			$id = $_GET['id'];
			$post = Post::model()->findByPk($id);
			$new_url = $post->getLink();
			header("Location: $new_url");
			exit("");
		}
		
		if(strpos($sub_name,'.')===false && $_SESSION['geo_redirected']!==true){
			
			require_once("./protected/extensions/ip2city/Ip2city.php");
			$ip2c = new Ip2city; 
			$city_name  = $ip2c->getCityName($_SERVER['REMOTE_ADDR']);
			$res = Domen::getSubdomains($city_name);
		
			if	($res['city_domain']!='' ){
				$new_url = 'http://'.$res['city_domain'].".".$res['region_domain'].Yii::app()->params['baseServerName'];
				$_SESSION['geo_redirected'] = true;
				header("Location: $new_url");
				exit("");
			}
		}
		
		$sub_name = str_replace(Yii::app()->params['baseServerName'], '', $_SERVER['SERVER_NAME']);
		if(strpos($sub_name,'.')!==false){
			list($city_domain,$region_domain)  = explode('.',$sub_name);
			if(!isset($_SESSION['geo_domain']) || (isset($_SESSION['geo_domain']) && $_SESSION['geo_domain']!=$sub_name)){
				$city = Domen::model()->findByAttributes(array('name'=>$city_domain));
				$region = Region::model()->findByAttributes(array('reg_domain'=>$region_domain));
				$_SESSION['geo_domain'] = $sub_name;
				$_SESSION['geo_city'] = $city;
				$_SESSION['geo_region'] = $region;
			}
			
		}else{
			$region_domain = $sub_name;
			if(!isset($_SESSION['geo_domain']) || (isset($_SESSION['geo_domain']) && $_SESSION['geo_domain']!=$sub_name)){
				$region = Region::model()->findByAttributes(array('reg_domain'=>$region_domain));
				$_SESSION['geo_domain'] = $sub_name;
				$_SESSION['geo_region'] = $region;
			}
			
		}
		
		$domain = Domen::model()->findByAttributes(array('name'=>$sub_name,));
		if($domain!=NULL)
		{
			Yii::app()->setParams(array('CURRENT_DOMAIN'=>(int)$domain->id));
		}
		else
		{
			
			Yii::app()->setParams(array('CURRENT_DOMAIN'=>0));
			//$filterChain->controller->redirect('http://www'.Yii::app()->params['baseServerName'], TRUE);
		}
		if (!defined('CURRENT_DOMAIN') )
		{
			$val = is_object($domain)? (int)$domain->id : 0;
			define('CURRENT_DOMAIN', $val);
		}

		return true;
	}

	protected function postFilter($filterChain)
	{
		;
	}
	
	static function getCurrentGeoName(){
		if(isset($_SESSION['geo_city']))
			return $_SESSION['geo_city']->city;
		elseif(isset($_SESSION['geo_region']))
			return $_SESSION['geo_region']->name;
		else
			return 'Выбрать регион';
	}
    static function getCurrentGeoNameIn(){
        //TODO добавить в таблицы доменов и регионов поле склоненных названий типа "Ростове-на-Дону" и возвращать их
		if(isset($_SESSION['geo_city']))
			return $_SESSION['geo_city']->city_in;
		elseif(isset($_SESSION['geo_region']))
			return $_SESSION['geo_region']->name_in;
		else
			return 'Росcии';
	}
	static function getCurrentCityId(){
		if(isset($_SESSION['geo_city']))
			return $_SESSION['geo_city']->id;
		else
			return false;
	}
	static function getCurrentRegionId(){
		if(isset($_SESSION['geo_region']))
			return $_SESSION['geo_region']->id;
		else
			return false;
	}
}
?>
