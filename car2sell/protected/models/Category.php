<?php
class Category extends CActiveRecord
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
	return 'category';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
		array('name, text', 'required'),
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

    public function getAllCategory()
    {
        return $this->findAllByAttributes(array(), array('order'=>'id'));
    }

	public function getArrayOfCategory()
	{
		$q = $this->findAllByAttributes(array(), array('order'=>'id'));
		$category_array = array();
		foreach($q as $item)
		{
			$category_array[$item->id] = $item->name;
		}
		return $category_array;
	}
   
}
