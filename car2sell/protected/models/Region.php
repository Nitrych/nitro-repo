<?php
class Region extends CActiveRecord
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
	return 'regions';
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

	public function getAddRegionsToCityForDropdown($cities=array())
	{
		$condition = '';
		$regoins = $this->findAllbyAttributes(array(), array('order'=>'name'));
		if(count($regoins)) foreach($regoins as $region) $cities['region_'.$region->id] = $region->name;
		return $cities;
	}

}
