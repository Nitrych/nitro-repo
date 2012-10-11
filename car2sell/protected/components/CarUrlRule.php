<?php
class CarUrlRule extends CBaseUrlRule
{
    public $connectionID = 'db';
    //NOT USED???
    public function createUrl($manager,$route,$params,$ampersand)
    {
        if ($route==='post/show')
        {
			if(isset($params['id'])){
				list($post,$domen) =  Post::getData($params['id']);
				$title = CarUrlRule::prepareUrl($post->title);
				$res =  '/auto/'.$title.';'.$post->id;
			}
			return $res;	
        }
		if ($route==='post/print')
        {
			if(isset($params['id'])){
				list($post,$domen) =  Post::getData($params['id']);
				$title = CarUrlRule::prepareUrl($post->title);
				$res =  '/print/'.$title.';'.$post->id;
			}
			return $res;	
        }
        return false;  // this rule does not apply
    }
 
    public function parseUrl($manager,$request,$pathInfo,$rawPathInfo)
    {   
		
		
        if (preg_match('%auto/([A-Za-z0-9_;]*)%', $pathInfo, $matches))
        {
			$str = $matches['1'];
			list($musor,$id) = explode(";",$str);
			$_GET['id'] = $id;
			return 'post/show';
        }
		if (preg_match('%print/([A-Za-z0-9_;]*)%', $pathInfo, $matches))
        {
			$str = $matches['1'];
			list($musor,$id) = explode(";",$str);
			$_GET['id'] = $id;
			return 'post/print';
        }
		if (preg_match('%pdf/([A-Za-z0-9_;]*)%', $pathInfo, $matches))
        {
			$str = $matches['1'];
			list($musor,$id) = explode(";",$str);
			$_GET['id'] = $id;
			return 'post/pdf';
        }
        return false;  // this rule does not apply
    }
	
	static function translitIt($str) {
		$tr = array(
			"А"=>"a","Б"=>"b","В"=>"v","Г"=>"g",
			"Д"=>"d","Е"=>"e","Ж"=>"j","З"=>"z","И"=>"i",
			"Й"=>"y","К"=>"k","Л"=>"l","М"=>"m","Н"=>"n",
			"О"=>"o","П"=>"p","Р"=>"r","С"=>"s","Т"=>"t",
			"У"=>"u","Ф"=>"f","Х"=>"h","Ц"=>"ts","Ч"=>"ch",
			"Ш"=>"sh","Щ"=>"sch","Ъ"=>"","Ы"=>"yi","Ь"=>"",
			"Э"=>"e","Ю"=>"yu","Я"=>"ya","а"=>"a","б"=>"b",
			"в"=>"v","г"=>"g","д"=>"d","е"=>"e","ж"=>"j",
			"з"=>"z","и"=>"i","й"=>"y","к"=>"k","л"=>"l",
			"м"=>"m","н"=>"n","о"=>"o","п"=>"p","р"=>"r",
			"с"=>"s","т"=>"t","у"=>"u","ф"=>"f","х"=>"h",
			"ц"=>"ts","ч"=>"ch","ш"=>"sh","щ"=>"sch","ъ"=>"y",
			"ы"=>"yi","ь"=>"","э"=>"e","ю"=>"yu","я"=>"ya", 
			" "=> "_", "."=> "", "/"=> "_"
		);
		return strtr($str,$tr);
	}
    static function prepareUrl($urlstr){
		//if (preg_match('/[^A-Za-z0-9_\-]/', $urlstr)) {
		
			$urlstr = CarUrlRule::translitIt($urlstr);
			$urlstr = preg_replace('/[^A-Za-z0-9_\-]/', '', $urlstr);
		//}
		return $urlstr;
	}
}
?>