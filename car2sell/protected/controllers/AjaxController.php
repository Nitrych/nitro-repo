<?php

class AjaxController extends Controller
{
        public $layout='//layouts/ajax';
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
	public function actionCategory()
	{
		$categories = Category::model()->getAllCategory();
        $this->render('category', array('categories'=>$categories));
	}

	public function actionCityByRegion()
	{
		$region_id = (int)$_POST['region_id'];
		$cities = Domen::model()->getCityByRegion($region_id);
        $this->render('city_by_region', array('cities'=>$cities));
	}

}