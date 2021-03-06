<?php

/**
 * SettingsForm class.
 * SettingsForm is the data structure for keeping
 * settings form data. It is used by the 'settings' action of 'AccountController'.
 */
class SettingsForm extends CFormModel
{

	public $username;
	public $email;
	public $password;
	public $re_password;
	public $phone_number;
	public $icq;
    public $skype;
    public $domen;
    public $region;
	public $city;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// username and password and email are required
			//array('password, email, re_password', 'required','message'=>'Это поле не может быть пустым'),
            // passsword min length 6 chars
            array('icq, phone_number, skype, username, city', 'length', 'min'=>'2', 'tooShort'=>'Длина пароля не менее 6 символов'),
			array('password', 'length', 'min'=>'6', 'tooShort'=>'Длина пароля не менее 6 символов'),
            // email is email
			array('email', 'email','message'=>'Неверный формат електронного адреса'),
            // email is unique
			//array('email', 'unique', 'className'=>'User', 'caseSensitive'=>TRUE, 'attributeName'=>'email', 'message'=>'Данный електронный адресс уже используется'),
            // email is unique
			//array('username', 'unique', 'className'=>'User', 'caseSensitive'=>TRUE, 'attributeName'=>'username', 'message'=>'Данный псевдоним уже используется'),
            // password and re_password are equal
			array('re_password', 'compare','compareAttribute'=>'password', 'message'=>'Пароли не совпадают'),
            // verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'message'=>'Введенный вами код неверен.'),
            //array('region, city', 'match', 'pattern'=>'/not/', 'not'=>TRUE, 'message'=>'Пожалуйста, укажите регион и город'),
			//array('city', 'exist', 'attributeName' => 'id', 'className' => 'Domen'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'username' => 'Имя',
			'email' => 'Email-адрес',
			'password' => 'Новый пароль',
			're_password'=> 'Повторите пароль',
            'phone_number'=>'Номер телефона',
            'icq'=>'ICQ',
            'skype'=>'Skype',
            'region'=>'Регион',
			'city'=>'Город',
		);
	}
    
    public function setUserInfo(User $user)
    {
        $this->city = $user->domen;
        $attrs = array('username', 'email', 'icq', 'phone_number', 'skype');
        foreach($attrs as $attr)
        {
            $this->$attr = $user->$attr;
        }
        
        return $this;
    }
    
}
