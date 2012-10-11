<?php

class SubscriptionController extends Controller
{
	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('addNew', 'activate'),
				'users'=>array('*'),
			),
			
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin',),
				'roles'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionAddNew()
	{
		$sub = new Subscription();
        $sub_form = new SubscriptionForm();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['SubscriptionForm']))
		{
			$sub_form->attributes = $_POST['SubscriptionForm'];
            if($_POST['SubscriptionForm']['category']==0)
            {
                $sub_form->category = NULL;
            }
            if($_POST['SubscriptionForm']['region']==0)
            {
                $sub_form->region = NULL;
            }
			if($sub_form->validate())
            {
                $sub->attributes = $sub_form->attributes;
                $sub->keywords = mb_strtolower($sub->keywords, 'UTF-8');
                $sub->setActivateCode();
                if($sub->save())
                {
                    $email_id = Helper::getEmailId($sub->email);
                    $sub->sendActivateLetter();
                    $this->redirect('/account/notify/?notify_id=1&mail_id='.$email_id);
                }
            }
		}

        $sub_form->setChoices();
		$this->render('addNew', array(
                                    'sub_form'=>$sub_form,
		));

	}


	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='subscription-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

    public function actionActivate()
    {
        $id = (int)$_GET['id'];
        $key = $_GET['key'];
        $sub = Subscription::model()->findByPk($id);
        if($sub==NULL || $sub->active == 1)
        {
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
        if($sub->activate_code == $key)
        {
            $sub->active = 1;
            $sub->save();
            $error = FALSE;
        }
        else
        {
            $error = TRUE;
        }
        $this->render('activate', array(
                                    'error'=>$error,
		));
    }

}
