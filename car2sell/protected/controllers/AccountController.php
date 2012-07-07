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
