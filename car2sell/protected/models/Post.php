<?php
class Post extends CActiveRecord
{

	const BUY_TYPE = 'buy', SELL_TYPE = 'sell', USER_OWNER_TYPE = 'user', COMPANY_OWNER_TYPE = 'company';

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
		array('title, text', 'required'),
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
        $this->title = $form->title;
        $this->text = $form->text;
        $this->creator_id = 1;//Yii::app()->user->id;
        $this->time = time();
		$this->skype = $form->skype;
		$this->icq = $form->icq;
		$this->phone_number = $form->phone_number;
		$this->contact_name = $form->contact_name;
		$this->skype = $form->skype;
		$this->buy_sell = $form->buy_sell;
		$this->owner_type = $form->owner_type;
		$this->domen = $form->city;
        if ($this->save())  return $this->id;
        else return FALSE;
    }
    
    /*
     * 
     */
    public function getAllVideo()
    {
        return $this->findAllByAttributes(array('private'=>1), array('order'=>'id DESC'));
    }
    
    public function getHomePagePost()
    {
        return $this->findAllByAttributes(array(), array('order'=>'id DESC', 'limit'=>20));
    }
    
   
}
