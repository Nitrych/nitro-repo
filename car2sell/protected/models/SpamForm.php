<?php

/**
 * ContactForm class.
 * ContactForm is the data structure for keeping
 * contact form data. It is used by the 'contact' action of 'SiteController'.
 */
class SpamForm extends CFormModel
{
	public $reason;
	public $content;
	public $post_id;
	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('reason, content, post_id', 'required'),
			// email has to be a valid email address
			//array('email', 'email'),
			// verifyCode needs to be entered correctly
			//array('verifyCode', 'captcha', 'allowEmpty'=>!extension_loaded('gd')),
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
			'email'=>'Email',
			'subject'=>'Тема',
			'body'=>'Текст'
		);
	}
	
	public function sendReportLetter()
    {
		
		$titles = array(
					 'spam'=>'Спам',
					 'badCategory'=>'Неверная рубрика',
					 'violation'=>'Запрещенный товар/услуга',
					 'outofdate'=>'Объявление не актуально',
				);
				//$title = "<b>".$titles[$spam->reason]."</b><br>";
				//$post = "<br><b><a href='".Helper::getBU()."/auto/".$spam->post_id."'>".Helper::getBU()."/auto/".$spam->post_id."</a></b><br>";
			
				
        $email = Yii::app()->email;
        $email->to = Config::model()->params['adminEmail'];
        $email->subject = 'Репорт на объявление';
        $email->from = Config::model()->params['adminEmail'];
        $email->view = 'report';
        $email->viewVars = array('titles'=>$titles, 'reason'=>$this->reason, 'post_id'=>$this->post_id, 'baseUrl'=>Helper::getBU(), 'content'=>$this->content );
        $email->send();
    }
}
