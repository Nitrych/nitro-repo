<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class UserContactForm extends CFormModel
{
	public $name;
	public $email;
	public $subject;
	public $body;
	public $verifyCode;
	public $post_id;
	

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array(' email, body', 'required'),
			// email has to be a valid email address
			array('email', 'email'),
			// verifyCode needs to be entered correctly
			array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
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
			'verifyCode'=>'Защита от спама',
			'name'=>'Имя',
			'email'=>'Ваш Email',
			'subject'=>'Тема',
			'body'=>'Текст'
		);
	}
	
	public function sendLetter($author_email)
    {
		
        $email = Yii::app()->email;
        $email->to = $author_email;
        $email->subject = 'Сообщения автору объявления';
        $email->from = Config::model()->params['adminEmail'];
        $email->view = 'user2author';
        $email->viewVars = array('titles'=>$titles, 'back_email'=>$this->email, 'body'=>$this->body, 'post_id'=>$this->post_id, 'baseUrl'=>Helper::getBU() );
        $email->send();
    }
}
