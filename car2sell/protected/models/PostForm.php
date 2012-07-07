<?php

/**
 * VideoForm class.
 * VideoForm is the data structure for keeping
 * video form data. It is used by the 'addnewvideo' action of 'AccountController'.
 */
class PostForm extends CFormModel
{
	public $title;
    public $id;
	public $text;
    public $buy_sell;
	public $price;
	public $auction;
	public $model;
	public $year;
	public $color;
	public $mileage;
	public $engine_value;
	public $fuel;
	public $gear;
    public $owner_type;
    public $img_1; public $img_2; public $img_3; public $img_4; public $img_5; public $img_6; public $img_7; public $img_8;
    public $username;
    public $email;
    public $phone_number;
    public $icq;
    public $skype;
    public $category;
	public $rule_agreement;
	public $region;
	public $city;
	public $near_adress;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		$return = array(
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
		// files validation
		for($i=1; $i<9; $i++)
			$return[] = array('img_'.$i, 'file', 'allowEmpty'=>TRUE, 'maxSize'=>1024*1024*1024*5, 'types'=>'jpg, png, gif', 'wrongType'=>'<i class="error_i"></i><b class="error_b"></b><p>Запрещенный формат файла</p>', 'tooLarge'=>'<i class="error_i"></i><b class="error_b"></b>Файл слишком большой</p>');

		return $return;
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'title'=>'Заголовок',
                        'text'=>'Текст обьявления',
                        'category'=>'Категория',
                        'buy_sell'=>'Продаете/ Покупаете?',
						'owner_type'=>'Частное лицо / Компания',
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

    public function setCreatorInfo()
    {
        $user = User::model()->findByPk(Yii::app()->user->id);
        if($user==NULL)
        {
            return $this;
        }
        $attrs = array('username', 'email', 'icq', 'phone_number', 'skype');
        foreach($attrs as $attr)
        {
            $this->$attr = $user->$attr;
        }
        
        return $this;
    }


}
