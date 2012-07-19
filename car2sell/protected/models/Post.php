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
		array('title, text, email, category, username', 'required'),
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
    public function createNew(PostForm $form)
    {
        $this->creator_id = ($id=Yii::app()->user->id) ? $id : 0;
        $this->time = time();
		$this->domen = $form->city;
		$attr_array = array('title', 'text', 'price', 'auction', 'model', 'year', 'color', 'mileage', 'engine_value', 'fuel', 'gear', 'skype', 'icq',
							'phone_number', 'username', 'buy_sell', 'owner_type', 'email', 'category');
		foreach($form->attributes as $k => $value)
		{
			if(!in_array($k, $attr_array)) continue;
			$this->$k = $form->$k;
		}
        if ($this->save())
        {
            return $this->id;
        }
        else
        {
            return FALSE;
        }
    }
    
    public function getHomePagePost($filters=FALSE)
    {
		if($filters===FALSE)
		{
			$attributes = array('buy_sell'=>'sell');
			$condition = array('order'=>'id DESC', 'limit'=>20);
		}
		else
		{
			$attr_cond = $this->getSearchAttrCond($filters);
			$attributes = $attr_cond['attributes'];
			$condition = $attr_cond['condition'];
		}

        return $this->findAllByAttributes($attributes, $condition);
    }
    
    public function getUsersPost($user_id=NULL)
    {
        if($user_id==NULL)
        {
            return FALSE;
        }
		$attributes = array(
						'creator_id'=>(int)$user_id,
		);

        return $this->findAllByAttributes($attributes, array('order'=>'id DESC', 'limit'=>20));
    }

	public function getCategorysPost($category_id=NULL, $filters=FALSE)
    {
        if($category_id==NULL)
        {
            return FALSE;
        }
		if($filters===FALSE)
		{
			$attributes = array('category'=>(int)$category_id, 'buy_sell'=>'sell');
			$condition = array('order'=>'id DESC', 'limit'=>20);
		}
		else
		{
			$attr_cond = $this->getSearchAttrCond($filters);
			$attributes = $attr_cond['attributes'];
			$condition = $attr_cond['condition'];
		}

        return $this->findAllByAttributes($attributes, $condition);
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
		if($q!=NULL)
		{
			return $q->path;
		}
		else
		{
			return '/images/post-default.png';
		}
	}

	protected function getSearchAttrCond($filters=FALSE)
	{
		if($filters==FALSE)
        {
            return array('attributes'=>array('buy_sell'=>'sell'), 'condition'=>array('order'=>'id DESC', 'limit'=>20), );
        }
		else
		{
			$attr_return = array();
			$cond_return = array('order'=>'id DESC', 'limit'=>20);
			$attr_array = array('fuel', 'owner_type', 'gear');
			foreach($attr_array as $attr)
			{
				if(isset($filters[$attr]))
				{
					$attr_return[$attr] = $filters[$attr];
				}
			}
			if(isset($filters['buy_sell']) && $filters['buy_sell']=='buy')
			{
				$attr_return['buy_sell'] = 'buy';
			}
			else
			{
				$attr_return['buy_sell'] = 'sell';
			}
			//var_dump($attr_return);exit;
			$where = array();
			$cond_array_f = array('price_f', 'engine_value_f', 'mileage_f', );
			foreach($cond_array_f as $cond)
			{
				if(isset($filters[$cond]))
				{
					$where[] = ' '.substr($cond, 0, -2).' >= '.(int)$filters[$cond];
				}
			}
			$cond_array_t = array('price_t', 'engine_value_t', 'mileage_t', );
			foreach($cond_array_t as $cond)
			{
				if(isset($filters[$cond]))
				{
					$where[] = ' '.substr($cond, 0, -2).' <= '.(int)$filters[$cond];
				}
			}
			$cond_return['condition'] = implode(' AND ', $where);

			return array('attributes'=>$attr_return, 'condition'=>$cond_return);
		}
	}


}
