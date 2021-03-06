<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		if(!Yii::app()->user->getIsGuest())
		{
			//$this->redirect('post/');
		}
		$this->render('index');
	}
	
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error){
			
			if($error['code']==404)
				$error['message'] = 'Cтраница не найдена';
			
			
			$this->render('error',array('error'=>$error));
			
		}
	}
	
	public function actionContact()
	{
		$contact=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$contact->attributes=$_POST['ContactForm'];
			if($contact->validate())
			{
				$headers="From: {$contact->email}\r\nReply-To: {$contact->email}";
				mail(Config::model()->params['adminEmail'],$contact->subject,$contact->body,$headers);
				Yii::app()->user->setFlash('contact','Сообщение отправлено.');
				$this->refresh();
			}
		}
		$this->render('contact',array('contact'=>$contact));
	}
	
	public function actionSpam()
	{
		$spam=new SpamForm;
		//echo "spam";
		if(isset($_GET['report']))
		{
			//print_r($_POST['report']);
			$spam->attributes=$_GET['report'];
			if($spam->validate())
			{
				//$headers="From: {$contact->email}\r\nReply-To: {$contact->email}";
				$titles = array(
					 'spam'=>'Спам',
					 'badCategory'=>'Неверная рубрика',
					 'violation'=>'Запрещенный товар/услуга',
					 'outofdate'=>'Объявление не актуально',
				);
				$spam->sendReportLetter();
				$arr = array('res'=>"<div style='display:block; width:400px; height:200px; color:green'><h2><center>Сообщение отправлено.</center></h2></div>");
				$arr['name'] = "response";
				echo $_GET['callback']."(".json_encode($arr).");"; 
			}else{
				//echo "not validated";
				//print_r($spam->getErrors());
			}
			exit("");
		}
		//$this->render('contact',array('contact'=>$contact));
	}
	

}
