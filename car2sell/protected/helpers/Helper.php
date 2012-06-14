<?php
class Helper
{
	static public function numberToString($number=NULL)
	{
		if($number==NULL) return 'Вы не передали число для форматирования';
		$str = (string)$number;
		$return = array();
		for($j=1,$i=strlen($str); $i>0; $i--,$j++)
		{
			if($j%3==0) $return[($i-1)] = ' '.$str[($i-1)];
			else $return[($i-1)] = $str[($i-1)];
		}
		ksort($return);
		return implode('', $return);
	}

	static public function getFuelLink($name=NULL)
	{
		if(!in_array($name, array('gas', 'diesel', 'other'))) return 'Название топлива не соотвествует норме';
		switch($name)
		{
			case 'gas':
					return '<a title="Бензин" href="#">Бензин</a>';
					break;
			case 'diesel':
					return '<a title="Дизель" href="#">Дизель</a>';
					break;
			case 'other':
					return '<a title="Другой" href="#">Другой</a>';
					break;
		}
	}

	static public function getGearLink($name=NULL)
	{
		if(!in_array($name, array('auto', 'manual', 'other'))) return 'Название КПП не соотвествует норме';
		switch($name)
		{
			case 'auto':
					return '<a title="Автоматичексая" href="#">Автоматическая</a>';
					break;
			case 'manual':
					return '<a title="Ручная" href="#">Ручная</a>';
					break;
			case 'other':
					return '<a title="Другая" href="#">Другая</a>';
					break;
		}
	}

	static public function getRusMonth($month=NULL)
	{
		if($month==NULL) return 'Вы не ввели номер месяца';
		$monthes = array(
						1=>	'январь',
						2=>'февраль',
						3=>'март',
						4=>'апрель',
						5=>'май',
						6=>'июнь',
						7=>'июль',
						8=>'август',
						9=>'сентябрь',
						10=>'октябрь',
						11=>'ноябрь',
						12=>'декабрь',
					);
		return $monthes[(int)$month];
	}

	static public function timeToString($time=NULL)
	{
		if($time==NULL) $time=time();
		return date('H:i', $time).', '.date('d').' '.self::getRusMonth(date('m', $time)).' '.date('Y', $time);
	}

}
