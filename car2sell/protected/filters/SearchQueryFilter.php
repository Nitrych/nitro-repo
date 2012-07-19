<?php
  /**
   *  Фильтр предназначен для фильтрации поискового GET запроса.
   *  Результатом выполнения явлеется массив GET['q'] не содержащий пустых переменных.
   */
class SearchQueryFilter extends CFilter
{

	protected function preFilter($filterChain)
	{
		if(isset($_GET['q']))
		{
			//echo '<pre>';
			//print_r(Yii::app()->request);exit;
			//var_dump($_GET['q']);exit;
			$filters = array();
			foreach($_GET['q'] as $k => $v)
			{
				if( $v!==NULL && $v!=='' && $v!==0 && $v!=='0')
				{
					$filters[$k] = "q[$k]=$v";
				}
			}
			if( count($_GET['q']) == count($filters) )
			{
				return TRUE;
			}
			if(isset($_GET['q']['category']) && $_GET['q']['category']!=0)
			{
				$request_module = 'post/category/id/'.(int)$_GET['q']['category'];
				unset($filters['category']);
			}
			else
			{
				$request_path = preg_split('/\//', Yii::app()->request->pathInfo);
        		$request_module = (isset($request_path[1])) ? $request_path[0].'/'.$request_path[1] : $request_path[0];
			}
			$q_list = implode('&', $filters);
			$filterChain->controller->redirect('/'.$request_module.'/?'.$q_list, TRUE);
		}

		return TRUE;
	}

	protected function postFilter($filterChain)
	{
		;
	}
}
?>
