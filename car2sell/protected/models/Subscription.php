<?php
class Subscription extends CActiveRecord
{

    public static function model($className=__CLASS__)
    {
    	return parent::model($className);
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
	return 'subscription';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
		        array('email, keywords', 'required'),
                array('email', 'email'),
                //array('region', 'exist', 'allowEmpty'=>TRUE, 'attributeName' => 'id', 'className' => 'Region'),
                //array('category', 'exist', 'allowEmpty'=>TRUE, 'attributeName' => 'id', 'className' => 'Category'),
                array('category, region', 'numerical', 'allowEmpty'=>TRUE ),
    	);
    }
    
    /**
     * 
     */
    public function relations()
    {
        return array(
			'region'=>array(self::BELONGS_TO, 'Region', 'region'),
        );
    }

    public function setActivateCode()
    {
        $this->activate_code = $this->generateActiveteCode();
    }
    
    private function generateActiveteCode()
    {
        return sha1(uniqid('', true)).sha1(uniqid('', true));
    }

    /**
     * @send letter to comfirm subscription
     */
    public function sendActivateLetter()
    {
        $email = Yii::app()->email;
        $email->to = $this->email;
        $email->subject = 'Activate your Subscription';
        $email->from = Config::model()->params['adminEmail'];
        $email->view = 'subscription_activate';
        $email->viewVars = array('activate_code'=>$this->activate_code, 'id'=>$this->id, 'baseUrl'=>Helper::getBU(), );
        $email->send();
    }

    /**
     * @send subscription letter
     */
    public function sendSubLetter($email_to, $post)
    {
        $email = Yii::app()->email;
        $email->to = $email_to;
        $email->subject = 'New post on '.Yii::app()->name;
        $email->from = Config::model()->params['adminEmail'];
        $email->view = 'subscription_letter';
        $email->viewVars = array('post_title'=>$post->title, 'post_link'=>$post->getLink(), );
        $email->send();
    }

}
