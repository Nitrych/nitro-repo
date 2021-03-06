<?php

class AjaxController extends Controller
{
        public $layout='//layouts/ajax';
         /**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionCategory()
	{
		$categories = Category::model()->getAllCategory();
        $this->render('category', array('categories'=>$categories));
	}

	public function actionCityByRegion()
	{
		$region_id = (int)$_POST['region_id'];
		$cities = Domen::model()->getCityByRegion($region_id);
        $this->render('city_by_region', array('cities'=>$cities));
	}
	public function actionCityByRegionList()
	{
		$region_id = (isset($_POST['region_id'])) ? (int)$_POST['region_id'] : 1;
		$cities = Domen::model()->getCityByRegion($region_id);
		$region = Region::model()->findByPk($region_id);
		//$regions = Region::model()->getRegions();
		//$command = Yii::app()->db->createCommand();
			
		
		/*foreach($regions as $id=>$name){
			echo "<br>".$name." == ".encodestring($name);
			$command->update('regions', array(
				'reg_domain'=>encodestring($name),
			), 'id=:id', array(':id' => $id));
		}
		exit("done");
		 */
		
        $this->render('city_by_region_list', array('cities'=>$cities,'region'=>$region));
	}
	public function actionAddFavor(){
		
		$post_to_add = (int)$_POST['post_to_add'];
		$total = Post::model()->addBookmark($post_to_add);
		$this->render('add_to_favorite', array('total'=>$total));
	}
	public function actionGetPhone(){
		$post_id = (int)$_POST['post_id'];
		$post = Post::model()->findByPk($post_id);
		echo $post->phone_number;
	}
	
	
	

}

//to do move out use later
function Transliterate($string){
  $cyr=array(
     "Щ", "Ш", "Ч","Ц", "Ю", "Я", "Ж","А","Б","В",
     "Г","Д","Е","Ё","З","И","Й","К","Л","М","Н",
     "О","П","Р","С","Т","У","Ф","Х","Ь","Ы","Ъ",
     "Э","Є", "Ї","І",
     "щ", "ш", "ч","ц", "ю", "я", "ж","а","б","в",
     "г","д","е","ё","з","и","й","к","л","м","н",
     "о","п","р","с","т","у","ф","х","ь","ы","ъ",
     "э","є", "ї","і"
  );
  $lat=array(
     "Shch","Sh","Ch","C","Yu","Ya","J","A","B","V",
     "G","D","e","e","Z","I","y","K","L","M","N",
     "O","P","R","S","T","U","F","H","", 
     "Y","" ,"E","E","Yi","I",
     "shch","sh","ch","c","Yu","Ya","j","a","b","v",
     "g","d","e","e","z","i","y","k","l","m","n",
     "o","p","r","s","t","u","f","h",
     "", "y","" ,"e","e","yi","i"
  );
  for($i=0; $i<count($cyr); $i++)  {
     $c_cyr = $cyr[$i];
     $c_lat = $lat[$i];
     $string = str_replace($c_cyr, $c_lat, $string);
  }
  $string = 
  	preg_replace(
  		"/([qwrtpsdfghklzxcvbnmQWRTPSDFGHKLZXCVBNM]+)[jJ]e/", 
  		"\${1}e", $string);
  $string = 
  	preg_replace(
  		"/([qwrtpsdfghklzxcvbnmQWRTPSDFGHKLZXCVBNM]+)[jJ]/", 
  		"\${1}'", $string);
  $string = preg_replace("/([eyuioaEYUIOA]+)[Kk]h/", "\${1}h", $string);
  $string = preg_replace("/^kh/", "h", $string);
  $string = preg_replace("/^Kh/", "H", $string);
  return $string;
}
function encodestring($string){

  $string = preg_replace("/[_\s\.,?!\[\](){}]+/", "_", $string);
  $string = preg_replace("/-{2,}/", "--", $string);
  $string = preg_replace("/_-+_/", "--", $string);
  $string = preg_replace("/[_\-]+$/", "", $string);
  $string = Transliterate($string);
  $string = strtolower($string);
  $string = preg_replace("/j{2,}/", "j", $string);
  $string = preg_replace("/[^0-9a-z_\-]+/", "", $string);
  $first = substr($string,0,1);
  $second = substr($string,1);
  $second = str_replace(array('a','o','i','u','y','e'),'',$second);
  $string = $first.$second;
  $string = substr($string,0,4);
  $string = str_replace(array('-','_'),'',$string);
  return $string;
}
