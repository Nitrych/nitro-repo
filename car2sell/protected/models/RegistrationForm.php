<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * registration form data. It is used by the 'registration' action of 'AccountController'.
 */
class RegistrationForm extends CFormModel
{

	public $username;
	public $email;
	public $password;
	public $re_password;
	public $verifyCode;
	public $accept;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// username and password and email are required
			array('accept, password, email, re_password', 'required','message'=>'Ето поле не может быть пустым'),
            // passsword min length 6 chars
			array('password', 'length', 'min'=>'6', 'tooShort'=>'Длина пароля не менее 6 символов'),
            // email is email
			array('email', 'email','message'=>'Неверный формат електронного адреса'),
            // email is unique
			array('email', 'unique', 'className'=>'User', 'caseSensitive'=>FALSE, 'attributeName'=>'email', 'message'=>'Данный електронный адресс уже используется'),
            // email is unique
			array('username', 'unique', 'className'=>'User', 'caseSensitive'=>TRUE, 'attributeName'=>'username', 'message'=>'Данный псевдоним уже используется'),
            // password and re_password are equal
			array('re_password', 'compare','compareAttribute'=>'password', 'message'=>'Пароли не совпадают'),
			array('accept', 'boolean'),
            // verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'message'=>'Введенный вами код неверен.'),
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
			'verifyCode' => 'Verification Code',
			'username' => 'Логин',
			'email' => 'Email-адрес',
			'password' => 'Новый пароль',
			're_password'=> 'Повторите пароль'
		);
	}
}
