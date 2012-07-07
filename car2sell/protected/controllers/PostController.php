<?php

class PostController extends Controller
{

	public function filters()   
	{   
           return array(     
              array('application.filters.DomenFilter')
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
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
        if (Yii::app()->user->getIsGuest())
        {
        	//exit;
        }
        $posts = Post::model()->getHomePagePost();
		$categories = Category::model()->getArrayOfCategory();
		$cities = Domen::model()->getArrayOfCities();
    	$this->render('index', array('posts'=>$posts, 'categories'=>$categories, 'cities'=>$cities));
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
		$model = new PostForm;
		$cities = Domen::model()->getCitiesForDropdown();
		$dropdown = Region::model()->getAddRegionsToCityForDropdown($cities);
		if(isset($_POST['PostForm']))
		{
			$model->attributes=$_POST['PostForm'];
			for($i=1; $i<9; $i++)
			{
				$image = 'img_'.$i;
				$model->$image = $_FILES['PostForm']['name'][$image];
			}
			//var_dump($model->attributes);exit;
			//echo '<pre>';
			//print_r($model->attributes);exit;
			if($model->validate())
			{
				//var_dump($model->city);exit;
				$new_post = new Post();
                $result = $new_post->createNew($model);
				for($i=1,$j=1; $i<9; $i++)
				{
					if($_FILES['PostForm']['name']['img_'.$i]!='' && $new_post->id)
					{
						//var_dump($_POST['PostForm']['img_'.$i]);exit;
						$upload_path = Yii::app()->basePath.DIRECTORY_SEPARATOR.'../images/foto/'.$new_post->id;
						if(!is_dir($upload_path)) mkdir($upload_path, 0777);
						$image = 'img_'.$i;
						$model->$image=CUploadedFile::getInstance($model, $image);
						$img_save = $model->$image->saveAs($upload_path.'/foto_'.$j.'.'.$model->$image->extensionName);
						if($img_save)
						{
							$post_foto = new PostFoto();
							$post_foto->createNew($new_post->id, '/images/foto/'.$new_post->id.'/foto_'.$j.'.'.$model->$image->extensionName);
						}
						$j++;
					}
				}
                if($result)
                {
                    $this->redirect('/post/');
                }
			}
		}
		//echo '<pre>';
		//print_r($dropdown);exit;
        if(Yii::app()->user->id)
        {
            $model = $model->setCreatorInfo();
        }
		$this->render('add',array('model'=>$model, 'dropdown'=>$dropdown));
	}

	public function actionShow()
	{
		$id = (int)$_GET['id'];
		$post = Post::model()->findByPk($id);
		$post->increaseView();
		$category = Category::model()->findByPk($post->category);
		$domen = Domen::model()->findByPk($post->domen);
		$fotos = PostFoto::model()->getAllForPost($post->id);
		$this->render('show',array('post'=>$post, 'fotos'=>$fotos, 'category'=>$category, 'domen'=>$domen));
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
		$user = User::model()->findByPk(Yii::app()->user->id);
		if($user==NULL)
		{
			//TODO redirect to 404
			return;
		}
        $posts = Post::model()->getUsersPost($user->id);
		$categories = Category::model()->getArrayOfCategory();
		$cities = Domen::model()->getArrayOfCities();
    	$this->render('user', array('posts'=>$posts, 'categories'=>$categories, 'cities'=>$cities));
	}

}
