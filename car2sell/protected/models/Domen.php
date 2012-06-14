<?php
class Domen extends CActiveRecord
{

    public static function model($className=__CLASS__)
    {
    	return parent::model($className);
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
	return 'domen';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
				//array('name, text', 'required'),
                //array('category', 'in', 'range'=>array(1,2,3)),
                //array('private', 'in', 'range'=>array(1,2,3)),
    	);
    }
    
    /**
     * 
     */
    public function relations()
    {
        return array(
            //'creator_info'=>array(self::BELONGS_TO, 'User', 'creator_id'),
        );
    }

	public function getCitiesForDropdown()
	{
		$condition = '';
		$oderBy = 'city';
		$cities = $this->findAllbyAttributes(array('main'=>1), array('order'=>'num DESC, city ASC'));
		$return = array('not'=>'Выбрать');
		if(count($cities)) foreach($cities as $city) $return[$city->id] = '--> '.$city->city;
		return $return;
	}

	public function getCityByRegion($region_id=NULL)
	{
		$cities = $this->findAllbyAttributes(array('region'=>$region_id), array('order'=>'num DESC, city ASC'));
		return $cities;
	}

	public function getArrayOfCities()
	{
		$q = $this->findAllByAttributes(array(), array('order'=>'id'));
		$city_array = array();
		foreach($q as $item)
		{
			$city_array[$item->id] = $item->city;
		}
		return $city_array;
	}

}
