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
		        array('name, reg_domain', 'required'),
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
			//'domen'=>array(self::BELONGS_TO, 'Domen', 'domen'),
            //'creator_info'=>array(self::BELONGS_TO, 'User', 'creator_id'),
        );
    }

	public function getAddRegionsToCityForDropdown($cities=array())
	{
        if(count($cities)==0)
        {
            $cities['not'] = 'Выбрать';
        }
		$condition = '';
		$regoins = $this->findAllbyAttributes(array(), array('order'=>'name'));
		if(count($regoins))
        {
            foreach($regoins as $region)
            {
                $cities['region_'.$region->id] = $region->name;
            }
        }

		return $cities;
	}
	
	public function getRegions($cities=array())
	{
		$condition = '';
		$regions = $this->findAllbyAttributes(array(), array('order'=>'name'));
		if(count($regions)) foreach($regions as $region) $cities[$region->id] = $region->name;
		return $cities;
	}
	
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'name' => 'Название',
			'geo_id' => 'Geo',
			'reg_domain' => 'Субдомен',
		);
	}

	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('geo_id',$this->geo_id,true);
		$criteria->compare('reg_domain',$this->reg_domain,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination'=>array(
                        'pageSize'=>100,
            ),
			'sort'=>array(
				'defaultOrder'=>'id DESC',
			),
		));
	}

}
