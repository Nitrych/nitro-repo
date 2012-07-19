<?php

class DomenFilter extends CFilter
{

	protected function preFilter($filterChain)
	{
		$sub_name = str_replace(Yii::app()->params['baseServerName'], '', $_SERVER['SERVER_NAME']);
		$domain = Domen::model()->findByAttributes(array('name'=>$sub_name,));
		if($domain!=NULL)
		{
			Yii::app()->setParams(array('CURRENT_DOMAIN'=>(int)$domain->id));
		}
		else
		{
			$filterChain->controller->redirect('http://www'.Yii::app()->params['baseServerName'], TRUE);
		}
		if (!defined('CURRENT_DOMAIN'))
		{
			define('CURRENT_DOMAIN', (int)$domain->id);
		}

		return true;
	}

	protected function postFilter($filterChain)
	{
		;
	}
}
?>
