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
    public $owner_type;
    public $img; public $img_1; public $img_2; public $img_3; public $img_4; public $img_5; public $img_6; public $img_7; public $img_8;
    public $contact_name;
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
			array('title, text, contact_name, email, category, city, region', 'required', 'message'=>'Ето поле не может быть пустым.'),
        	array('email', 'email', 'message'=>'Email-адрес не похож на настоящий'),
			array('title', 'length', 'min'=>'2', 'tooShort'=>'Длина названия не менее 2 символов'),
        	array('text', 'length', 'min'=>'20', 'tooShort'=>'Длина тескта обьявления не менее 20 символов'),
			// TODO normal check array('category', 'in', 'range'=>array(1,2,3), 'message'=>'Выберите одну из категорий'),
			array('buy_sell', 'in', 'range'=>array(Post::BUY_TYPE, Post::SELL_TYPE), 'message'=>'Пожалуйста, укажите, вы предлагаете товар или услугу или ищете?'),
			array('owner_type', 'in', 'range'=>array(Post::USER_OWNER_TYPE, Post::COMPANY_OWNER_TYPE), 'message'=>'Пожалуйста, укажите, это объявление от частного лица или от компании?'),
			array('rule_agreement', 'required', 'requiredValue'=>1, 'message'=>'Поле обязательно для заполнения' ),
			//array('city', 'in', 'range'=>array(1,2,3), 'message'=>'Пожалуйста, укажите регион и город'),
			array('img', 'file', 'allowEmpty'=>TRUE, 'maxSize'=>1024*1024*1024*5, 'types'=>'jpg, png, gif', 'wrongType'=>'<i class="error_i"></i><b class="error_b"></b><p>Запрещенный формат файла</p>', 'tooLarge'=>'<i class="error_i"></i><b class="error_b"></b>Файл слишком большой</p>'),
			array('region, city', 'match', 'pattern'=>'/not/', 'not'=>TRUE, 'message'=>'Пожалуйста, укажите регион и город'),
		);
		//
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
                        'buy_sell'=>'Предлагаете / Ищете?',
						'owner_type'=>'Частное лицо / Компания',
                        'contact_name'=>'Контактное лицо',
                        'phone_number'=>'Номер телефона',
                        'icq'=>'ICQ',
                        'skype'=>'Skype',
                        'category'=>'Рубрика',
						'rule_agreement'=>'Согласие',
						'region'=>'Регион',
						'city'=>'Город',
						'near_adress'=>'Подробный адрес',
						'img_1'=>'Фотографии',
		);
	}
}
