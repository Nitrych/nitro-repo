<?php

class StaffController extends Controller
{
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	} 
	/**
	 * Declares class-based actions.
	 */
	public function accessRules()
	{
		return array(
			array('allow',
				'actions'=>array('login','logout'),
				'users'=>array('*'),
			),
			array('allow',
				'actions'=>array('index'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

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
			if($model->validate()){
				Yii::app()->user;
				echo "<hr>";
				print_r(Yii::app()->user);
				if(Yii::app()->user->getIsGuest())
					echo "guest";
				else
					echo "logged";

				echo "gs ".Yii::app()->user->getState("name");
				Yii::app()->user->setName( Yii::app()->user->getState("name") );

				echo "name:". Yii::app()->user->getName();

				//if(Yii::app()->user->isGuest())
				//	echo "guest";
				//exit("ok");
				$this->redirect(Yii::app()->user->returnUrl);
			}
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
