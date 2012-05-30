<?php
class PostFoto extends CActiveRecord
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
	return 'post_foto';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
		//array('title, text', 'required'),
		//array('buy_sell', 'in', 'range'=>array(self::BUY_TYPE, self::SELL_TYPE), ),
		//array('owner_type', 'in', 'range'=>array(self::USER_OWNER_TYPE, self::COMPANY_OWNER_TYPE), ),
    	);
    }
    
    /**
     * 
     */
    public function relations()
    {
        return array(
            'Post'=>array(self::BELONGS_TO, 'Post', 'post_id'),
        );
    }
    
    /**
     * 
     */
    public function createNew($post_id=NULL, $path=NULL)
    {
        $this->post_id = $post_id;
        $this->path = $path;
        if ($this->save())  return $this->id;
        else return FALSE;
    }
    
    /*
     * 
     */
    public function getAllForPost($post_id=NULL)
    {
		//var_dump($post_id);exit;
        $fotos = $this->findAllByAttributes(array('post_id'=>$post_id), array('order'=>'id', 'limit'=>8));
		$return = array();
		if(count($fotos)) foreach($fotos as $foto) $return[] = $foto;
		return $return;
    }

}
