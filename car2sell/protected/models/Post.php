<?php
class Post extends CActiveRecord
{

	const BUY_TYPE = 'buy', SELL_TYPE = 'sell', USER_OWNER_TYPE = 'user', COMPANY_OWNER_TYPE = 'company';
	const FUEL_GAS = 'gas', FUEL_DIESEL = 'diesel', FUEL_OTHER = 'other';
	const GEAR_AUTO = 'auto', GEAR_MANUAL = 'manual', GEAR_OTHER = 'other';

    public static function model($className=__CLASS__)
    {
    	return parent::model($className);
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
	return 'post';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
		array('title, text, email, category, contact_name', 'required'),
		array('buy_sell', 'in', 'range'=>array(self::BUY_TYPE, self::SELL_TYPE), ),
		array('owner_type', 'in', 'range'=>array(self::USER_OWNER_TYPE, self::COMPANY_OWNER_TYPE), ),
    	);
    }
    
    /**
     * 
     */
    public function relations()
    {
        return array(
            'creator_info'=>array(self::BELONGS_TO, 'User', 'creator_id'),
        );
    }
    
    /**
     * 
     */
    public function createNew($form)
    {
        $this->creator_id = ($id=Yii::app()->user->id) ? $id : 0;
        $this->time = time();
		$this->domen = $form->city;
		$attr_array = array('title', 'text', 'price', 'auction', 'model', 'year', 'color', 'mileage', 'engine_value', 'fuel', 'gear', 'skype', 'icq',
							'phone_number', 'contact_name', 'buy_sell', 'owner_type', 'email', 'category');
		foreach($form->attributes as $k => $field)
		{
			if(!in_array($k, $attr_array)) continue;
			$this->$k = $form->$k;
		}
        if ($this->save())  return $this->id;
        else return FALSE;
    }
    
    public function getHomePagePost()
    {
        return $this->findAllByAttributes(array(), array('order'=>'id DESC', 'limit'=>20));
    }

	public function increaseView()
	{
		$this->view += 1;
		$this->save();
		return $this->view;
	}

	public function getFirstImgSrc()
	{
		$q = PostFoto::model()->findByAttributes( array('post_id'=>$this->id), array('order'=>'id') );
		if($q!=NULL) return $q->path;
		else return '/images/post-default.png';
	}
    
   
}
