<?php
class Post extends CActiveRecord
{

	const BUY_TYPE = 'buy', SELL_TYPE = 'sell', USER_OWNER_TYPE = 'user', COMPANY_OWNER_TYPE = 'company';
	const FUEL_GAS = 'gas', FUEL_DIESEL = 'diesel', FUEL_OTHER = 'other';
	const GEAR_AUTO = 'auto', GEAR_MANUAL = 'manual', GEAR_OTHER = 'other';
	const CURRENCY_RUBL = 'RUB';
	const CURRENCY_DOLLAR = 'USD';
	const CURRENCY_EURO = 'EUR';
    var $paging = array();
	var $creator;
	var $region;
	var $near_adress;
	var $rule_agreement;
	var $city;
	
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
		//array('title, text, email, category, username', 'required'),
		//array('buy_sell', 'in', 'range'=>array(self::BUY_TYPE, self::SELL_TYPE), ),
		//array('owner_type', 'in', 'range'=>array(self::USER_OWNER_TYPE, self::COMPANY_OWNER_TYPE), ),
		array('creator_id','numerical'),
		array( 'creator', 'safe', 'on'=>'search' ),
		array('title, text, username, email, category, city, region, price, fuel, gear, year, engine_value, owner_type', 'required', 'message'=>'Это поле не может быть пустым'),
			array('phone_number, model, icq, skype, near_adress, color', 'length', 'min'=>'2', 'allowEmpty'=>TRUE, 'tooShort'=>'Не менее 2 символов'),
        	array('email', 'email', 'message'=>'Email-адрес не похож на настоящий'),
			array('title', 'length', 'min'=>'2', 'tooShort'=>'Длина названия не менее 2 символов'),
        	array('text', 'length', 'min'=>'20', 'tooShort'=>'Длина тескта обьявления не менее 20 символов'),
			array('category', 'exist', 'attributeName' => 'id', 'className' => 'Category'),
			array('buy_sell', 'in', 'range'=>array(Post::BUY_TYPE, Post::SELL_TYPE), 'message'=>'Пожалуйста, укажите, вы предлагаете товар или услугу или ищете?'),
			array('auction', 'boolean'),
			array('fuel', 'in', 'range'=>array(Post::FUEL_GAS, Post::FUEL_DIESEL, Post::FUEL_OTHER), 'message'=>'Это поле не может быть пустым'),
			array('gear', 'in', 'range'=>array(Post::GEAR_AUTO, Post::GEAR_MANUAL, Post::GEAR_OTHER), 'message'=>'Это поле не может быть пустым'),
			array('owner_type', 'in', 'range'=>array(Post::USER_OWNER_TYPE, Post::COMPANY_OWNER_TYPE), 'message'=>'Пожалуйста, укажите, это объявление от частного лица или от компании?'),
			array('rule_agreement', 'required', 'requiredValue'=>1, 'message'=>'Поле обязательно для заполнения' ),
			//array('city', 'in', 'range'=>array(1,2,3), 'message'=>'Пожалуйста, укажите регион и город'),
			array('region, city', 'match', 'pattern'=>'/not/', 'not'=>TRUE, 'message'=>'Пожалуйста, укажите регион и город'),
			array('city', 'exist', 'attributeName' => 'id', 'className' => 'Domen'),
			array('price', 'numerical', 'allowEmpty'=>TRUE, 'integerOnly'=>TRUE, 'max'=>1000000000, 'tooBig'=>'Указаная вами цена слишком большая'),
			array('year', 'numerical', 'allowEmpty'=>TRUE, 'integerOnly'=>TRUE, 'max'=>10000, 'tooBig'=>'Указаный вами год слишком большой'),
			array('mileage', 'numerical', 'allowEmpty'=>TRUE, 'integerOnly'=>TRUE, 'max'=>1000000000, 'tooBig'=>'Указаный вами пробег слишком большой'),
			array('engine_value', 'numerical', 'allowEmpty'=>TRUE, 'integerOnly'=>TRUE, 'max'=>100000, 'tooBig'=>'Указаный вами объем слишком большой'),

    	);
    }
    
    /**
     * 
     */
    public function relations()
    {
        return array(
            'creator_info'=>array(self::BELONGS_TO, 'User', 'creator_id'),
			'domen'=>array(self::BELONGS_TO, 'Domen', 'domen'),
			'post_photo'=>array(self::HAS_MANY, 'PostFoto', 'post_id'),
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

		//why do we need da  code?

		$attr_array = array('title', 'text', 'price', 'auction', 'model', 'year', 'color', 'mileage', 'engine_value', 'fuel', 'gear', 'skype', 'icq',
							'phone_number', 'username', 'buy_sell', 'owner_type', 'email', 'category','currency','near_adress');
		foreach($form->attributes as $k => $value)
		{
			if(!in_array($k, $attr_array)) continue;
			$this->$k = $form->$k;
		}
		
		if ($this->creator_id==0){
			
		   User::saveSecretKey($form->email);	
		   
		}
		
		
		if($this->save(false)){
			//echo "saved";
		}else{
			//print_r($this->atttributes);
			//$msg = print_r($this->getErrors(),1);
			//echo $msg;

			//echo "not_saved";
		}
		//echo "activate code:";
		//echo $this->activate_code;
		//echo "zzz";
		//$msg = print_r($this->getErrors(),1);
		//exit("mpr");
		
        if ($this->save(false))
        {
			
			User::increaseAdsCounter($this->creator_id);
            return $this->id;
        }
        else
        {
            return FALSE;
        }
    }
    public function getSimilar($category_id,$post_id){
		//todo set certain city
		$post = Post::model()->findByPk($post_id);
		
		$attributes = array('buy_sell'=>'sell','category'=>$category_id,'domen'=>$post->domen);
		$condition = array('condition'=>" id<>$post_id", 'order'=>'id DESC','limit'=>5);
		$res = $this->findAllByAttributes($attributes, $condition);
		
		return $res;
	}
	public function getSimilarOtherCities($category_id,$post_id){
		//todo set certain city
		$post = Post::model()->findByPk($post_id);
		$attributes = array('buy_sell'=>'sell','category'=>$category_id);
		$condition = array('condition'=>" id<>$post_id and domen<>$post->domen", 'order'=>'id DESC','limit'=>3);
		$res = $this->findAllByAttributes($attributes, $condition);
		
		return $res;
	}
    public function getPostList($filters=FALSE, $category_id=false, $is_top=false)
    {
		if(DomenFilter::getCurrentRegionId()!==false);
					$filters['region'] = DomenFilter::getCurrentRegionId();
		if(DomenFilter::getCurrentCityId()!==false);
					$filters['city'] = DomenFilter::getCurrentCityId();

		if($filters===FALSE)
		{  
			$attributes = array('buy_sell'=>'sell');
			if($category_id!==false)
				$attributes['category'] = (int)$category_id;
			$condition = array('order'=>'id DESC');//, 'offset'=>4, 'limit'=>5);
		}
		else
		{
			$attr_cond = $this->getSearchAttrCond($filters);
			$attributes = $attr_cond['attributes'];
			if($category_id!==false)
				$attributes['category'] = (int)$category_id;
			$condition = $attr_cond['condition'];
		}
		
		$attributes['top'] = ($is_top===false)? 0:1;
		if($is_top!==false){
			$condition['order'] =  'rand()';
			$condition['offset'] = 0;
			$condition['limit'] = 4;
		}
		
        $res = $this->findAllByAttributes($attributes, $condition);
		
		if($is_top==false && ((count($res)>Config::model()->params['listPerPage']) || isset($_GET['page']))){
			    
				$this->paging['total'] = count($res);
				$this->paging['page'] = (isset($_GET['page']))? intval($_GET['page']-1) : 0;
				$this->paging['page_size'] = Config::model()->params['listPerPage'];
				$condition['offset'] = $this->paging['page'] * Config::model()->params['listPerPage'];
				$condition['limit'] = Config::model()->params['listPerPage'];
				$res = $this->findAllByAttributes($attributes, $condition);
		}
        //echo "is_top $is_top count: ".count($res);
		return $res;
    }
    	
		
    public function getUsersPost($user_id=NULL, $filters=FALSE, $category_id=FALSE)
    {
        if($user_id==NULL)
        {
            return FALSE;
        }
		/*$attributes = array(
						'creator_id'=>(int)$user_id,
		);

        return $this->findAllByAttributes($attributes, array('order'=>'id DESC', 'limit'=>20));*/
        if(DomenFilter::getCurrentRegionId()!=false);
					$filters['region'] = DomenFilter::getCurrentRegionId();
		if(DomenFilter::getCurrentCityId()!=false);
					$filters['city'] = DomenFilter::getCurrentCityId();					
		//var_dump($filters);exit;
		$attributes = array();			
		if($filters===FALSE)
		{
			$attributes['buy_sell'] = 'sell';
            $attributes['creator_id'] = (int)$user_id;
			if($category_id!==false)
				$attributes['category'] = (int)$category_id;
            $attributes['creator_id'] = (int)$user_id;
			$condition = array('order'=>'id DESC');//, 'offset'=>4, 'limit'=>5);
		}
		else
		{
			$attr_cond = $this->getSearchAttrCond($filters);
			$attributes = $attr_cond['attributes'];
			if($category_id!==false)
				$attributes['category'] = (int)$category_id;
            $attributes['creator_id'] = (int)$user_id;
			$condition = $attr_cond['condition'];
		}
		
        $res = $this->findAllByAttributes($attributes, $condition);
		
		if((count($res)>Config::model()->params['listPerPage']) || isset($_GET['page'])){
            $this->paging['total'] = count($res);
			$this->paging['page'] = (isset($_GET['page']))? intval($_GET['page']-1) : 0;
			$this->paging['page_size'] = Config::model()->params['listPerPage'];
			$condition['offset'] = $this->paging['page'] * Config::model()->params['listPerPage'];
			$condition['limit'] = Config::model()->params['listPerPage'];
			$res = $this->findAllByAttributes($attributes, $condition);
		}

		return $res;
    }

	public function getCategorysPost1($category_id=NULL, $filters=FALSE)
    {
	
		if(DomenFilter::getCurrentRegionId()!==false);
					$filters['region'] = DomenFilter::getCurrentRegionId();
		if(DomenFilter::getCurrentCityId()!==false);
					$filters['city'] = DomenFilter::getCurrentCityId();					
		//$filters['city'] = DomenFilter::getCurrentCityId();
					print_r($filters);
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
		//print_r($filters);
       //$nfc_cond = isset($filters['region']) ? 'domen.id=t.domen AND domen.region='.$filters['region'] : "domen.id=t.domen";
	   
        return $this->findAllByAttributes($attributes, $condition);
    }

	public function increaseView()
	{
		$this->view += 1;
		$this->save();
		return $this->view;
	}

	public function getFirstImgSrc($width=false)
	{
		$q = PostFoto::model()->findByAttributes( array('post_id'=>$this->id), array('order'=>'id') );
		if($q!=NULL)
		{
			return $q->path;
		}
		else
		{
			if($width!==false)
				return "/images/post-default-$width.png";
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
            $cond_return = array();
            if(isset($filters['order']))
            {
                switch($filters['order'])
                {
                    case 'date_asc':
                        $cond_return['order'] = 't.id ASC';
                        break;
                    case 'price_desc':
                        $cond_return['order'] = 't.price DESC';
                        break;
                    case 'price_asc':
                        $cond_return['order'] = 't.price ASC';
                        break;
                    default:
                        $cond_return['order'] = 't.id DESC';
                        break;
                }
            }
            else
            {
                $cond_return['order'] = 't.id DESC';
            }
			$cond_return['limit'] = 20;
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
			$attr_return['hide'] = 0;
			$attr_return['active'] = 1;
			
			//if(isset($filters['region']))
			//	$attr_return['domen.region'] = $filters['region'];
				
			//var_dump($attr_return);exit;
			$where = array();
			$cond_array_f = array('price_f', 'engine_value_f', 'mileage_f', 'year_f' );
			foreach($cond_array_f as $cond)
			{
				if(isset($filters[$cond]))
				{
					$where[] = ' '.substr($cond, 0, -2).' >= '.(int)$filters[$cond];
				}
			}
			$cond_array_t = array('price_t', 'engine_value_t', 'mileage_t', 'year_t' );
			foreach($cond_array_t as $cond)
			{
				if(isset($filters[$cond]))
				{
					$where[] = ' '.substr($cond, 0, -2).' <= '.(int)$filters[$cond];
				}
			}
			$where[] =  ' moderated_at>0 ';
			
			
			$cond_return['condition'] = implode(' AND ', $where);
			
			if(isset($filters['text']) && $filters['text']!=''){
				$sample = addSlashes($filters['text']);
				$search = " AND (title like '%$sample%'";
				if(isset($filters['in_text']) && $filters['in_text']=='ON')
					$search .= " or text like '%$sample%'";
				$search .= ") ";
			}
			
			
			
            $nfc_cond = (isset($filters['region']) && $filters['region']!==false) ? 'domen.id=t.domen AND domen.region='.$filters['region']  : " domen.id=t.domen";
			
			$nfc_cond .= (isset($filters['text']) && $filters['text']!='')? $search : "";
			
			$nfc_cond .= (isset($filters['city']) && $filters['city']!==false)?" AND (t.domen) = ". $filters['city'] : "";
			
			//echo "debug: $search";
			//echo "<br>".$nfc_cond;
			//echo "ok";
			
			$cond_return['with'] =
					array(
					'domen'=>array(
					// записи нам не нужны
					'select'=>false,
					// но нужно выбрать только пользователей с опубликованными записями
					'joinType'=>'INNER JOIN',
					'condition'=>$nfc_cond,
					));
			
			if(isset($filters['with_photo']) && $filters['with_photo']=='ON'){
					$cond_return['with']['post_photo'] = array(
														// записи нам не нужны
														'select'=>false,
														// но нужно выбрать только пользователей с опубликованными записями
														'joinType'=>'INNER JOIN',
														'condition'=>'post_photo.post_id=t.id',
														);
					$cond_return['together'] = true;
			}
			
			
			return array('attributes'=>$attr_return, 'condition'=>$cond_return);
		}
	}
	
	

		/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search($moderated=false)
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		if($moderated===false){
			///$criteria->addCondition('moderated_at>0');
		}else{
			$criteria->addCondition('moderated_at=0');
		}
			
		
		$criteria->compare('id',$this->id);
		$criteria->compare('creator_id',$this->creator_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('buy_sell',$this->buy_sell,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('auction',$this->auction);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('mileage',$this->mileage);
		$criteria->compare('engine_value',$this->engine_value);
		$criteria->compare('fuel',$this->fuel,true);
		$criteria->compare('gear',$this->gear,true);
		$criteria->compare('owner_type',$this->owner_type,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('icq',$this->icq,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('category',$this->category);
		$criteria->compare('domen',$this->domen);
		$criteria->compare('time',$this->time);
		$criteria->compare('view',$this->view);
		$criteria->compare('active',1);
        $criteria->compare('creator_info.email',$this->creator,true);


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
	
	public function addBookmark($post_id){
		//todo for registered user
		//+ cross-domain
		$current = (isset($_COOKIE['bookmarks'])) ? $_COOKIE['bookmarks'] : '';
		
		
		$cur_arr = explode(',',$current);
		foreach($cur_arr as $id)
			$cur_temp[$id] = 1;
		$cur_temp[$post_id] = 1;
		foreach($cur_temp as $pid=>$val)
			$cur_final[] = $pid;
		
		$new = implode(',',$cur_final);
		$total = count($cur_final);
		
		if(substr($new,0,1)==','){
			$new = substr($new,1);
			$total--;
		}
		
				
		setcookie('bookmarks', $new, time()+60*60*24*30*6, '/'); //6 months
		return $total;
		
	}
	
	public function getBookmarks(){
		
		$res =  array();
		if(!isset($_COOKIE['bookmarks']))
			return $res;
		
		$bookmarks = $_COOKIE['bookmarks'];
		if(substr($bookmarks,0,1)==',')
			$bookmarks = substr($bookmarks,1);	
		$attributes = array('buy_sell'=>'sell');
		$condition = array('order'=>'id DESC');//, 'offset'=>4, 'limit'=>5);
		$condition['condition'] = ' id IN ('.$bookmarks.') ';
		
        $res = $this->findAllByAttributes($attributes, $condition);
		
		if((count($res)>Config::model()->params['listPerPage']) || isset($_GET['page'])){
			    
				$this->paging['total'] = count($res);
				$this->paging['page'] = (isset($_GET['page']))? intval($_GET['page']-1) : 0;
				$this->paging['page_size'] = Config::model()->params['listPerPage'];
				$condition['offset'] = $this->paging['page'] * Config::model()->params['listPerPage'];
				$condition['limit'] = Config::model()->params['listPerPage'];
				$res = $this->findAllByAttributes($attributes, $condition);
		}
		
		return $res;
	}

    public function getRssPosts()
    {
        $domen_id = array();
        if(DomenFilter::getCurrentCityId() != FALSE)
        {
            $domen_id[] = DomenFilter::getCurrentCityId();
        }
        elseif(DomenFilter::getCurrentRegionId() != FALSE )
        {
            $attrs = array('region'=>DomenFilter::getCurrentRegionId());
            $cond = array('select'=>'id');
            $domens = Domen::model()->findAllByAttributes($attrs, $cond);
            if(count($domens))
            {
                foreach($domens as $item)
                {
                    $domen_id[] = $item->id;
                }
            }
        }
        $condition = array(
                        'limit' => Config::model()->params['numberOfRssItem'],
                        'order' => 'id DESC',
        );
        if(count($domen_id))
        {
            $posts = $this->findAllByAttributes(array('domen'=>$domen_id), $condition);
        }
        else
        {
            $posts = $this->findAllByAttributes(array(), $condition);
        }

        return $posts;
    }
    
    public function getLink($for=false)
    {
        $domen = Domen::model()->findByPk($this->domen);
		$title = CarUrlRule::prepareUrl($this->title);
		$relative =  '/auto/'.$title.';'.$this->id;
		if($for=='print')
			$relative =  '/print/'.$title.';'.$this->id;	
		if($for=='pdf')
			$relative =  '/pdf/'.$title.';'.$this->id;	
        return 'http://'.$domen->name.'.'.$domen->region_name.Yii::app()->params['baseServerName'].$relative;
    }
	
	static function getData($id)
    {
        
		$post = Post::model()->findByPk($id);
		$domen = Domen::model()->findByPk($post->domen);
		return array('post'=>$post,'domen'=>$domen);
        //return 'http://'.$domen->name.'.'.$domen->region_name.Yii::app()->params['baseServerName'].'/post/show/id/'.$this->id.'/';
    }
	
	public function sendPublishedEmail($id){
		
		$post = Post::model()->findBypk($id);
		
		if($post->creator_id>0)
			$user = Post::model()->findBypk($post->creator_id);
		
		$secret_key = false;
		
		if($post->creator_id==0)
			$secret_key = User::getSecretKey($post->email);
		
		$email = Yii::app()->email;
        $email->to = $post->email;
        $email->subject = 'Ваше объявление опубликовано';
        $email->from = Config::model()->params['adminEmail'];
        $email->view = 'post_published';
		
        $email->viewVars = array('user'=>$user, 'post'=>$post, 'id'=>$post->id, 'baseUrl'=>Helper::getBU(),'secret_key'=>$secret_key );
        $email->send();
	} 
	
		public function attributeLabels()
	{
		return array(
			'title'=>'Заголовок',
                        'text'=>'Текст обьявления',
                        'category'=>'Категория',
                        'buy_sell'=>'Продаете/Покупаете?',
						'owner_type'=>'Частное лицо/Компания',
                        'username'=>'Контактное лицо',
                        'phone_number'=>'Номер телефона',
                        'icq'=>'ICQ',
                        'skype'=>'Skype',
                        'category'=>'Рубрика',
						'rule_agreement'=>'Согласие',
						'region'=>'Регион',
						'city'=>'Город',
						'near_adress'=>'Подробный адрес',
						'img_1'=>'Фотографии',
						'price'=>'Цена',
						'auction'=>'Торг возможен',
						'model'=>'Модель',
						'year'=>'Год выпуска',
						'color'=>'Цвет',
						'mileage'=>'Пробег',
						'engine_value'=>'Объем двигателя',
						'gear'=>'Коробка передач',
						'fuel'=>'Вид топлива',
		);
	}
	
	static function resetIds(){
		$_SESSION['saved_ids'] = array();
		return true;
	}
	static function saveId($id){
		$_SESSION['saved_ids'][] = $id;
		//"sv".print_r($_SESSION['saved_ids']);
		//exit("sdsasa");
		return true;
	}
	static function getIds(){
		//"gt".print_r($_SESSION['saved_ids']);
		return $_SESSION['saved_ids'];
		
	}
	
	public function setActivateCode()
    {
        $this->activate_code = $this->generateActivateCode();
    }
	
	
    
    private function generateActivateCode()
    {
        return sha1(uniqid('', true)).sha1(uniqid('', true));
    }

  
	
	public function sendActivateLetter()
    {
		
		$secret_key = User::getSecretKey($this->email);
		
        $email = Yii::app()->email;
        $email->to = $this->email;
        $email->subject = 'Confirm ad';
        $email->from = Config::model()->params['adminEmail'];
        $email->view = 'post_activate';
        $email->viewVars = array('activate_code'=>$this->activate_code, 'id'=>$this->id, 'baseUrl'=>Helper::getBU(), 'secret_key'=>$secret_key);
        $email->send();
    }
	
	static function getEmailByPost($post_id){
		$post = Post::model()->findByPk($post_id);
		//print_r($post);
		if(!is_object($post))
			echo "post not object";
		if(strlen($post->email==''))
			echo "email is empty";
				
		return $post->email;
		//if($post->creator_id!=0){
		//	$user = User::model()->findByPk();
		//}
	}
	
}
