<?php

/**
 * RegistrationForm class.
 * RegistrationForm is the data structure for keeping
 * registration form data. It is used by the 'registration' action of 'AccountController'.
 */
class ForgotForm extends CFormModel
{

	
	public $email;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
		
			array('email', 'email','message'=>'Неверный формат електронного адреса'),
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

			'email' => 'Email',
			
		);
	}
}
