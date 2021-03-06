<?php

class AccountController extends Controller
{
	
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','view','registration','login','logout','activate', 'notify','forgot'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','settings'),
				'roles'=>array('user'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete'),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
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
        $user = User::model()->findByPk(Yii::app()->user->id);
        if($user==NULL)
        {
            return FALSE;
        }
        $posts = Post::model()->getUsersPost($user->id);
        $categories = Category::model()->getArrayOfCategory();
        $cities = Domen::model()->getArrayOfCities();
		$this->render('index', array('posts'=>$posts, 'categories'=>$categories, 'cities'=>$cities, 'user'=>$user,));
	}
    
    /**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionSettings()
	{
        $user = User::model()->findByPk(Yii::app()->user->id);
        if($user==NULL)
        {
            return FALSE;
        }
        $settings_form = new SettingsForm();
        $cities = Domen::model()->getCitiesForDropdown();
		$dropdown = Region::model()->getAddRegionsToCityForDropdown($cities);
        $is_saved = FALSE;
		if(isset($_POST['SettingsForm']))
		{
			$settings_form->attributes=$_POST['SettingsForm'];
			// validate user input and redirect to the previous page if valid
            //var_dump($settings_form->validate());exit;
			if($settings_form->validate())
            {
            	$result = $user->saveSettings($settings_form);
                
            	//$this->redirect(Yii::app()->user->returnUrl);
                $is_saved = TRUE;
            }
		}
        else
        {
            $settings_form = $settings_form->setUserInfo($user);
        }
		$this->render('settings', array('settings_form'=>$settings_form, 'user'=>$user, 'dropdown'=>$dropdown, 'is_saved'=>$is_saved));
	}

	public function actionRegistration()
	{
		if (!Yii::app()->user->getIsGuest()) $this->redirect(Yii::app()->homeUrl);

		$reg_form = new RegistrationForm();
		// collect user input data
        $is_saved = FALSE;
		if(isset($_POST['RegistrationForm']))
		{
			$reg_form->attributes=$_POST['RegistrationForm'];
			// validate user input and redirect to the previous page if valid
			if($reg_form->validate())
            {
				$user = new User();
                $is_saved = $user->saveNewUser($reg_form->password, $reg_form->email);
				//$this->redirect(Yii::app()->user->returnUrl);
            }
		}

		$this->render('registration', array('reg_form'=>$reg_form, 'is_saved'=>$is_saved));
	}
	
	public function actionForgot()
	{
		if (!Yii::app()->user->getIsGuest()) $this->redirect(Yii::app()->homeUrl);

		$forgot_form = new ForgotForm();
		// collect user input data
        $is_sent = FALSE;
		$is_error = false;
		if(isset($_POST['ForgotForm']))
		{
			$forgot_form->attributes=$_POST['ForgotForm'];
			// validate user input and redirect to the previous page if valid
			if($forgot_form->validate())
            {
				$user = new User();
                $is_sent = $user->sendNewPassword($forgot_form->email);
				if($is_sent===false){
					$is_error = true;
					NFC::setMessage("Ошибка. Указанный email не найден в базе пользователей.","error");
				}else{
					NFC::setMessage("Новый пароль отправлен на ваш почтовый ящик.");
					
				}
				
            }
		}

		$this->render('forgot', array('forgot_form'=>$forgot_form, 'is_sent'=>$is_sent,  'is_error'=>$is_error));
	}
    
    public function actionActivate()
    {
        $user=new User();
        $params = array(
                'id'=>(int)$_GET['id'],
                'key'=>htmlspecialchars($_GET['key']),
        );
        $result = $user->activate($params);
        $this->render('activate',array('result'=>$result,));
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
			$_POST['LoginForm']['password'] = trim($_POST['LoginForm']['password']);
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate()){ // && $model->login()){
				$this->redirect(Yii::app()->user->returnUrl);
				echo "<hr>";
				print_r(Yii::app()->user);
				if(Yii::app()->user->getIsGuest())
					echo "guest";
				else
					echo "logged";

				echo "gs ".Yii::app()->user->getState("name");
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
		
		//print_r($_COOKIE);
		/* $cookies = Yii::app()->getRequest()->getCookies();

         if (null !== ($cookie = $cookies[Yii::app()->user->getStateKeyPrefix()]))
         {
            $originalCookie = new CHttpCookie($cookie->name, $cookie->value);
            $cookie->domain = Yii::app()->user->identityCookie['domain'];
            $cookies->remove(Yii::app()->user->getStateKeyPrefix());
            $cookies->add($originalCookie->name, $originalCookie);
			//exit("ok");
         }
		 */
		//unset(Yii::app()->request->cookies[Yii::app()->user->getStateKeyPrefix()]);
		Yii::app()->user->logout(true);
	
		foreach($_COOKIE as $c=>$v){
			
			setcookie($c,'',time() - 3600,'/',Yii::app()->params['baseServerName']);
		}
	
		$this->redirect(Yii::app()->homeUrl);
	}

    public function actionNotify()
    {
        $params = array(
                'mail_id'=>(int)$_GET['mail_id'],
                'notify_id'=>$_GET['notify_id'],
        );
        $this->render('notify', array(
                                    'params'=>$params,
        ));
    }

}
