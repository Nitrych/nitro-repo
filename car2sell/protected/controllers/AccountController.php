<?php

class AccountController extends Controller
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
		$this->render('index');
	}

	public function actionRegistration()
	{
		if (!Yii::app()->user->getIsGuest()) $this->redirect(Yii::app()->homeUrl);

		$reg_form = new RegistrationForm();
		// collect user input data
		if(isset($_POST['RegistrationForm']))
		{
			$reg_form->attributes=$_POST['RegistrationForm'];
			// validate user input and redirect to the previous page if valid
			if($reg_form->validate())
            {
				$user = new User();
            	$result = $user->saveNewUser($reg_form->username, $reg_form->password, $reg_form->email);
            	//$this->redirect(Yii::app()->user->returnUrl);
            }
		}

		$this->render('registration', array('reg_form'=>$reg_form, ));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('login_form'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

}
