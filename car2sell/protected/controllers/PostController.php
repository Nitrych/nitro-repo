<?php

class PostController extends Controller
{

	public function filters()   
	{   
           return array( 
	   			'accessControl', // perform access control for CRUD operations
				array('application.filters.DomenFilter'),
				array('application.filters.SearchQueryFilter + index, category')
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
				'actions'=>
				array('category','index','view','show','addnewpost','user','allregions', 
				'rss','activate','updatepost','fortop','forurgent','hidepost','accessdenied','print','pdf','sendauthor','captcha','delphoto'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create','update','myads','favorites','clearfavorites'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array('admin','delete','act','hid','moderate'),
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

    public function actionAllRegions(){
		unset($_SESSION['geo_domain']);
		unset($_SESSION['geo_city']);
		unset($_SESSION['geo_region']);
		$this->redirect(array('index'));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionHid($id){
		$command = Yii::app()->db->createCommand();
			$command->update('post', array(
				'hide'=>1,
			), 'id=:id', array(':id' => $id));
		
		$referer = $_SERVER['HTTP_REFERER'];
		
		if(strpos($referer,'moderate')!==false)
			$this->redirect(array('moderate'));
		else
			$this->redirect(array('admin'));
	}
	
	public function actionForTop($id){
		$user_id = Yii::app()->user->id;
		$balance = Balance::getUserBalance($user_id);
		$post = Post::model()->findBypk($id);
		if($post->top==1){
			$this->redirect(array('post/myads/'));
			NFC::setMessage("Ошибка, объявление уже поднято в топ.","error");
		}else{
			if($balance>=Config::model()->params['costOfTop']){
				$balance = Balance::reduceBalance($user_id,Config::model()->params['costOfTop']);
				$command = Yii::app()->db->createCommand();
				$command->update('post', array(
					'top'=>1,
					'top_at'=>time(),
				), 'id=:id', array(':id' => $id));
				NFC::setMessage("Объявление успешно поднято в топ. Баланс обновлен.");
			}else{
				NFC::setMessage("Ошибка, недостаточно средств на балансе.","error");
			}
			
			
		}
		$this->redirect(array('post/myads/'));
		
		
		
	}
	
	public function actionForUrgent($id){
		$user_id = Yii::app()->user->id;
		$balance = Balance::getUserBalance($user_id);
		$post = Post::model()->findBypk($id);
		if($post->urgent==1){
			$this->redirect(array('post/myads/'));
			NFC::setMessage("Ошибка, объявление помечено как срочное.","error");
		}else{
			if($balance>=Config::model()->params['costOfUrgent']){
				$balance = Balance::reduceBalance($user_id,Config::model()->params['costOfUrgent']);
				$command = Yii::app()->db->createCommand();
				$command->update('post', array(
					'urgent'=>1,
					//'top_at'=>time(),
				), 'id=:id', array(':id' => $id));
				NFC::setMessage("Объявление успешно помечено как срочное. ");
			}else{
				NFC::setMessage("Ошибка, недостаточно средств на балансе.","error");
			}
			
			
		}
		$this->redirect(array('post/myads/'));
		
		
		
	}

	public function actionAct($id){
		$command = Yii::app()->db->createCommand();
		
		
		$command->update('post', array(
				'hide' => 0,
				//'moderated_at' => time(),
			     ), 'id=:id', array(':id' => $id));
			
		//send email to owner
		
		
			
        //send email to subscription users
        $post = Post::model()->findBypk($id);
        $domen = Domen::model()->findByPk($post->domen);
        $where = "(`category` IS NULL AND `region` IS NULL) OR (`category` = {$post->category} AND `region` = {$domen->region}) OR (`category` = {$post->category} AND `region` IS NULL) OR (`category` IS NULL AND `region` = {$domen->region})";
        $users = Subscription::model()->findAll(array('select'=>'id, keywords', 'condition'=>$where));
        foreach($users as $user)
        {
            $words = explode(' ', $user->keywords);
            foreach($words as $word)
            {
                //if(strpos(mb_strtolower($post->title, 'UTF-8'), $word)!==FALSE || strpos(mb_strtolower($post->text, 'UTF-8'), $word)!==FALSE)
                if(strpos(mb_strtolower($post->title, 'UTF-8'), $word)!==FALSE)
                {
                    Subscription::model()->sendSubLetter($user->email, $post);
                    break;
                }
            }
        }
		$referer = $_SERVER['HTTP_REFERER'];
		if(strpos($referer,'moderate')!==false)
			$this->redirect(array('moderate'));
		else
			$this->redirect(array('admin'));
	}
	/**
	 * Displays the add page
	 */
	public function actionUpdatePost($id,$key=false)
	{
		if($key!==false)
			$_SESSION['nfc_secret'] = $key;
			
		if(!User::isSecretAllowed($id))
			$this->redirect(array('post/AccessDenied'));
		
		$model = new PostForm();
		
		$post_edited = 0;
		if(isset($_POST['Post']))
		{
			
			$model->attributes=$_POST['Post'];
			for($i=1; $i<9; $i++)
			{
				$image = 'img_'.$i;
				$model->$image = $_FILES['Post']['name'][$image];
			}
	
			if(true)
			{
		
				$post =  $this->loadModel($id);
				$post->attributes = $_POST['Post'];
				//$attr_array = array('title', 'text', 'price', 'auction', 'model', 'year', 'color', 'mileage', 'engine_value', 'fuel', 'gear', 'skype', 'icq',
				//			'phone_number', 'username', 'buy_sell', 'owner_type', 'email', 'category');
				
				//foreach($_POST['Post'] as $k => $value)
				//{
				//	if(!in_array($k, $attr_array)) continue;
				//		$post->$k = $_POST['Post'][$k];
				//}
		
				$result = $post->save(false);
			   
			
				//$model = new PostForm();
				
				$model->attachPhotos($id);
				//exit("fotos should be attached");
                if($result)
                {
					$post_edited = 1;
                }
				else
					$post_edited = 0;
			}
		}
		
        //DEPRECATED add main city to the top of region select
		//$cities = Domen::model()->getCitiesForDropdown();
        $cities = array();
		$dropdown = Region::model()->getAddRegionsToCityForDropdown($cities);
		$model=$this->loadModel($id);
		$cat = new Category;
		$cats = $cat->getArrayOfCategory();
        //$model = $model->setCreatorInfo();
        //$model = $model->setDefaultDomen();
        if($model->region != NULL)
        {
            $obj_cities = Domen::model()->getCityByRegion(str_replace('region_', '', $model->region));
            $cities = array('not'=>'Выбрать');
            if(count($obj_cities))
            {
                foreach($obj_cities as $item)
                {
                    $cities[$item->id] = $item->city;
                }
            }
        }
        else
        {
            $cities = array('not'=>'Выбрать');
        }
		
		//$fotos = PostFoto::model()->getAllForPost($id);
		
		$this->render('updatefront', array(
								'model'=>$model,
								'key'=>$key,
								//'fotos'=>$fotos,
								'dropdown'=>$dropdown,
                                'cities'=>$cities,
								'post_edited'=>$post_edited,
								'cat_name'=>$cats[$model->category],
		));
	}
	
	public function actionHidePost($id,$key=false)
	{
		if($key!==false)
			$_SESSION['nfc_secret'] = $key;
			
		if(!User::isSecretAllowed($id))
			$this->redirect(array('post/AccessDenied'));
			
		$post_deleted = false;
		
		if(isset($_POST['delete']) && $_POST['delete']==1)
		{
			$command = Yii::app()->db->createCommand();
			$command->update('post', array(
								'hide'=>1,
								'hidden_by_user'=>1
								)
								, 'id=:id', array(':id'=>$id));
			$post_deleted = true;
		}
	
		
		$this->render('delete_post', array(
								'post_deleted'=>$post_deleted,
		));
	}
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Post']))
		{
			$model->attributes=$_POST['Post'];
			if($model->save(false))
				$this->redirect(array('admin'));
				
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			exit("delete forbidden");
            $model=$this->loadModel($id);
            // we only allow deletion via POST request
			
			User::decreaseAdsCounter($model->creator_id);
			
			$model->delete();

			
			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	public function actionDelPhoto($id)
	{
		if(!User::isSecretAllowed($id))
			$this->redirect(array('post/AccessDenied'));
			
	    $command = Yii::app()->db->createCommand();
		$command->delete('post_foto', 'id=:id', array(':id'=>intval($id)));
	
		$this->redirect($_SERVER['HTTP_REFERER']);

	}
	/**
	 * Manages all models.
	 */
	public function actionModerate()
	{
		
		if(isset($_POST['moderate_all'])){
		
		    $ids = Post::getIds();
			
			foreach($ids as $id){
				$command = Yii::app()->db->createCommand();
				$command->update('post', array(
								'moderated_at'=>time()
								)
								, 'id=:id', array(':id'=>$id));
				Post::sendPublishedEmail($id);	
			}
			NFC::SetMessage("Объявления отмодерированы");
			
		}
		
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];
		//foreach($)
        Post::resetIds();
		$this->render('moderate',array(
			'model'=>$model,
		));
	}

	
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Post('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Post']))
			$model->attributes=$_GET['Post'];
		

		$this->render('admin',array(
			'model'=>$model,
		));
	}	


	public function actionAccessDenied()
	{
		$this->render('access_denied');
	}	



	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=Post::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}


	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='post-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	


	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */



	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'

        if (Yii::app()->user->getIsGuest())
        {
        	//exit;
        }
		if(isset($_GET['q']))
		{
			$filters=$_GET['q'];
		}
		else
		{
			$filters=FALSE;
		}
		$pdata = $_POST;
        $posts = Post::model()->getPostList($filters,false,'top');
		
		$all_posts = Post::model()->getPostList($filters);
		$paging = Post::model()->paging;
		$categories = Category::model()->getArrayOfCategory();
		$regions = Region::model()->getRegions();
		$cities = Domen::model()->getArrayOfCities();
		$view_mode = (isset($_GET['view']))? $_GET['view'] : "default";
	    $show_all_top_ads = (isset($_GET['show_all_ads'])) ? true:false;
        Yii::app()->params['showSubscription'] = TRUE;
    	$this->render('index', array(
								'gdata'=>$_GET,
								'pdata'=>$pdata,
								'paging'=>$paging,
			                    'posts'=>$posts,
								'all_posts'=>$all_posts,
								'categories'=>$categories,
								'regions'=>$regions,
								'cities'=>$cities,
								'filters'=>$filters,
								'view_mode'=>$view_mode,
								'show_all_top_ads'=>$show_all_top_ads,
		));
	}
    public function actionClearfavorites(){
		$posts = array();
		setcookie('bookmarks', '', time()+60*60*24*30*6, '/'); //6 months
		$this->render('favorite', array(
								'gdata'=>$_GET,
								'posts'=>$posts,
								'favs_cleared'=>1,
								
		));
	}
	public function actionFavorites()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        if (Yii::app()->user->getIsGuest())
        {
        	//exit;
        }
		if(isset($_GET['q']))
		{
			$filters=$_GET['q'];
		}
		else
		{
			$filters=FALSE;
		}
		
		$pdata = $_POST;
        $posts = Post::model()->getBookmarks();
		$paging = POST::model()->paging;
		$categories = Category::model()->getArrayOfCategory();
		$regions = Region::model()->getRegions();
		$cities = Domen::model()->getArrayOfCities();
		
	
    	$this->render('favorite', array(
								'gdata'=>$_GET,
								'pdata'=>$pdata,
								'paging'=>$paging,
								'posts'=>$posts,
								'categories'=>$categories,
								'regions'=>$regions,
								'cities'=>$cities,
								'filters'=>$filters,
								'fav_page_fl'=>1,
		));
	}
	
	public function actionMyAds()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        if (Yii::app()->user->getIsGuest())
        {
        	exit;
        }
		if(isset($_GET['q']))
		{
			$filters=$_GET['q'];
		}
		else
		{
			$filters=FALSE;
		}
		
		$pdata = $_POST;
        $posts = Post::model()->getUsersPost(Yii::app()->user->id);
		$paging = Post::model()->paging;
		$categories = Category::model()->getArrayOfCategory();
		$regions = Region::model()->getRegions();
		$cities = Domen::model()->getArrayOfCities();
		$balance  = Balance::getUserBalance(Yii::app()->user->id);
	
    	$this->render('myads', array(
								'gdata'=>$_GET,
								'pdata'=>$pdata,
								'paging'=>$paging,
								'posts'=>$posts,
								'categories'=>$categories,
								'regions'=>$regions,
								'cities'=>$cities,
								'filters'=>$filters,
								'balance'=>$balance,
								'user_page_fl'=>1,
		));
	}
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the add page
	 */
	public function actionAddNewPost()
	{
		$model = new PostForm();
		if(isset($_POST['PostForm']))
		{
			$model->attributes=$_POST['PostForm'];
			for($i=1; $i<9; $i++)
			{
				$image = 'img_'.$i;
				$model->$image = $_FILES['PostForm']['name'][$image];
			}
			
			
			if($model->validate())
			{
				$new_post = new Post();
				$new_post->setActivateCode();
                $result = $new_post->createNew($model);
				//exit("created");
				$model->attachPhotos($new_post->id);
				
                if($result)
                {
					$email_id = Helper::getEmailId($model->email);
                    $new_post->sendActivateLetter();
					
                    $this->redirect('/account/notify/?notify_id=2&mail_id='.$email_id);
                    $this->redirect('/post/');
                }
			}
		}
		
		
        //DEPRECATED add main city to the top of region select
		//$cities = Domen::model()->getCitiesForDropdown();
        $cities = array();
		$dropdown = Region::model()->getAddRegionsToCityForDropdown($cities);
        $model = $model->setCreatorInfo();
        $model = $model->setDefaultDomen();
        if($model->region != NULL)
        {
            $obj_cities = Domen::model()->getCityByRegion(str_replace('region_', '', $model->region));
            $cities = array('not'=>'Выбрать');
            if(count($obj_cities))
            {
                foreach($obj_cities as $item)
                {
                    $cities[$item->id] = $item->city;
                }
            }
        }
        else
        {
            $cities = array('not'=>'Выбрать');
        }
		$this->render('add', array(
								'model'=>$model,
								'dropdown'=>$dropdown,
                                'cities'=>$cities,
		));
	}

	public function actionShow()
	{
		$id = (int)$_GET['id'];
		$post = Post::model()->findByPk($id);
	
		$post->increaseView();
		$category = Category::model()->findByPk($post->category);
		$domen = Domen::model()->findByPk($post->domen);
		$fotos = PostFoto::model()->getAllForPost($post->id);
		$similar= Post::model()->getSimilar($post->category,$post->id);
		$similar_other_cities= Post::model()->getSimilarOtherCities($post->category,$post->id);
		//for similar block
		$cities = Domen::model()->getArrayOfCities();
		
		$this->render('show', array(
								'post'=>$post,
								'fotos'=>$fotos,
								'category'=>$category,
								'domen'=>$domen,
								'similar'=>$similar,
								'similar_other'=>$similar_other_cities,
								'cities'=>$cities
		));
	}
	
	public function actionPrint()
	{
		$id = (int)$_GET['id'];
		$post = Post::model()->findByPk($id);
	
		$post->increaseView();
		$category = Category::model()->findByPk($post->category);
		$domen = Domen::model()->findByPk($post->domen);
		$fotos = PostFoto::model()->getAllForPost($post->id);
		$similar= Post::model()->getSimilar($post->category,$post->id);
		//for similar block
		$cities = Domen::model()->getArrayOfCities();
		
		$this->render('print', array(
								'post'=>$post,
								'fotos'=>$fotos,
								'category'=>$category,
								'domen'=>$domen,
								'similar'=>$similar,
								'cities'=>$cities
		));
	}
	
	public function actionPdf()
	{
		$id = (int)$_GET['id'];
		$post = Post::model()->findByPk($id);
	
		$post->increaseView();
		$category = Category::model()->findByPk($post->category);
		$domen = Domen::model()->findByPk($post->domen);
		$fotos = PostFoto::model()->getAllForPost($post->id);
		$similar= Post::model()->getSimilar($post->category,$post->id);
		//for similar block
		$cities = Domen::model()->getArrayOfCities();
		
		if($id!=48){
			 # mPDF
			$mPDF1 = Yii::app()->ePdf->mpdf();
			# You can easily override default constructor's params
			$mPDF1 = Yii::app()->ePdf->mpdf('', 'A4-L');
			//$mPDF1->AddPage('L');
			# render (full page)
			$mPDF1->WriteHTML($this->render('pdf', array(
									'post'=>$post,
									'fotos'=>$fotos,
									'category'=>$category,
									'domen'=>$domen,
									'similar'=>$similar,
									'cities'=>$cities
			), true));


			$mPDF1->Output();
			exit("");
		}
		//$html2pdf = Yii::app()->ePdf->HTML2PDF();
        //$html2pdf->WriteHTML($this->renderPartial('pdf', array(
		//						'post'=>$post,
		//						'fotos'=>$fotos,
		//						'category'=>$category,
		//						'domen'=>$domen,
		//						'similar'=>$similar,
		//						'cities'=>$cities
		//), true));
        //$html2pdf->Output();
		$this->render('pdf', array(
								'post'=>$post,
								'fotos'=>$fotos,
								'category'=>$category,
								'domen'=>$domen,
								'similar'=>$similar,
								'cities'=>$cities
		));
		 
		 
	}

	   
	/**
	 * This is the user action that is invoked
	 * 
	 */
	public function actionUser()
	{
        if (Yii::app()->user->getIsGuest())
        {
        	//exit;
        }
		$id = (int)$_GET['id'];
		$user = User::model()->findByPk($id);
		if($user==NULL)
		{
			//TODO redirect to 404
			return;
		}
        if(isset($_GET['q']))
		{
			$filters=$_GET['q'];
		}
		else
		{
			$filters=FALSE;
		}
        $posts = Post::model()->getUsersPost($user->id, $filters);
		$categories = Category::model()->getArrayOfCategory();
		$cities = Domen::model()->getArrayOfCities();
        //var_dump(count($posts));exit;
        $pdata = $_POST;

		$paging = Post::model()->paging;
		$categories = Category::model()->getArrayOfCategory();
		$regions = Region::model()->getRegions();
		$cities = Domen::model()->getArrayOfCities();
		$view_mode = (isset($_GET['view']))? $_GET['view'] : "default";
        Yii::app()->params['showSubscription'] = TRUE;
        
    	$this->render('user', array(
                                'gdata'=>$_GET,
								'pdata'=>$pdata,
								'paging'=>$paging,
								'posts'=>$posts,
								'categories'=>$categories,
								'regions'=>$regions,
								'cities'=>$cities,
								'filters'=>$filters,
								'view_mode'=>$view_mode,
		));
	}

	/**
	 * This is the user action that is invoked
	 * 
	 */
	public function actionCategory()
	{
        if (Yii::app()->user->getIsGuest())
        {
        	//exit;
        }
		$id = (int)$_GET['id'];
		$category = Category::model()->findByPk($id);
		if($category==NULL)
		{
			//TODO redirect to 404
			return;
		}
		if(isset($_GET['q']))
		{
			$filters=$_GET['q'];
		}
		else
		{
			$filters=FALSE;
		}
		$pdata = $_POST;
		$posts = Post::model()->getPostList($filters,$category->id,'top');
		$all_posts = Post::model()->getPostList($filters,$category->id);
        
		$categories = Category::model()->getArrayOfCategory();
		$paging = Post::model()->paging;			
		$cities = Domen::model()->getArrayOfCities();
		$regions = Region::model()->getRegions();
		$view_mode = (isset($_GET['view']))? $_GET['view'] : "default";
		$show_all_top_ads = (isset($_GET['show_all_ads'])) ? true:false;
        Yii::app()->params['showSubscription'] = TRUE;

    	$this->render('category', array(
									'gdata'=>$_GET,
									'pdata'=>$_POST,
									'posts'=>$posts,
									'all_posts'=>$all_posts,
									'categories'=>$categories,
									'cities'=>$cities,
									'paging'=>$paging,
									'filters'=>$filters,
									'regions'=>$regions,
									'category'=>$category,
			                        'view_mode'=>$view_mode,
									'show_all_top_ads'=>$show_all_top_ads,
		));
	}

    public function actionRss()
    {
        Yii::import('ext.feed.*');
        // RSS 2.0 is the default type
        $feed = new EFeed();

        $feed->title= Yii::app()->name;
        $feed->description = 'Авто: продажа б/у автомобилей, купить подержанную машину с пробегом - объявления';

        $feed->addChannelTag('language', 'ru-ru');
        $feed->addChannelTag('pubDate', date(DATE_RSS, time()));
        $feed->addChannelTag('link', 'http://'.$_SERVER['SERVER_NAME'].'/rss/' );

        $posts = Post::model()->getRssPosts();
        
        if(count($posts))
        {
            foreach($posts as $post)
            {
                $rss_item = $feed->createNewItem();

                $rss_item->title = $post->title;
                $rss_item->link = $post->getLink();
                $rss_item->date = $post->time;
                $rss_item->description = $post->text;

                $feed->addItem($rss_item);
            }
        }

        $feed->generateFeed();
        Yii::app()->end();
    }
	 public function actionActivate()
    {
		
        $id = (int)$_GET['id'];
        $key = $_GET['key'];
        $post = Post::model()->findByPk($id);
        if($post==NULL || $post->active == 1)
        {   
			exit("error");
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
        }
        if($post->activate_code == $key)
        {
            $post->active = 1;
            $post->save(false);
            $error = FALSE;
        }
        else
        {
            $error = TRUE;
        }
		if($error)
			$this->render('activate', array(
                                    'error'=>$error,
			));
		else
			$this->redirect(array('/cont/help_top?after_act'));
		
    }
	
   public function actionSendAuthor($post_id)
	{
		$contact=new UserContactForm;
		if(isset($_POST['UserContactForm']))
		{
			$contact->attributes=$_POST['UserContactForm'];
			if($contact->validate())
			{
				//echo "test";
				//echo $post_id;
				//exit(Post::getEmailByPost($post_id));
				$contact->sendLetter(Post::getEmailByPost($post_id));
				NFC::SetMessage("Сообщение отправлено");
				
			}
		}
		$this->render('user_contact',array('contact'=>$contact,'post_id'=>$post_id));
	}
}
