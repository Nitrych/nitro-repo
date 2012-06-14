<?php
class User extends CActiveRecord
{
	const ACTIVATION_SUCCESS = 1, ACTIVATION_ERROR = 2;

    public static function model($className=__CLASS__)
    {
    	return parent::model($className);
    }
    
    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
	return 'user';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
	// NOTE: you should only define rules for those attributes that
	// will receive user inputs.
	return array(
		array('password, email', 'required'),
        array('email', 'email'),
		array('username, password, email', 'length', 'max'=>128),
    	);
    }
    
    /**
     * 
     */
    public function relations()
    {
        return array(
            //'users_info'=>array(self::HAS_ONE, 'Users_Info', 'user_id'),
        );
    }
    
    /**
     * @return session key
     */
    public function updateSessionKey()
    {
		$sessionKey = md5(uniqid('',true));
		$this->session_key = $sessionKey;
		$this->save();
        return $this->session_key;
    }
    
    /**
     * @return confirm key
     */
    private function generateConfirmKey()
    {
        return $this->confirm_key = md5(uniqid('',true)).md5(uniqid('',true));
    }
    
    /**
     * @save new user in database
     */
    public function saveNewUser($password, $email)
    {
        $this->password = md5( md5(substr($password,0,3)).substr($password,3));
        $this->email = $email;
        if (count($this->findAllByAttributes(array('email'=>$this->email,)))>0)
        {
            return 'user_exist';
        }
        $this->created_date = time();
        $this->active = 0;
        $this->generateConfirmKey();
        if($this->save())
        {
            $this->sendConfirmLetter($this->email);
        }
    }
    
    /**
     * @return array of new user info if he was created
     */
    public function getNewUserInfo()
    {
        if ($this->id != NULL)
        {
            return array(
                    'username'=>$this->username,
                    'email'=>$this->email,
                );
        }
        else
        {
            return FALSE;
        }
    }
    
    /**
     * @send registration letter to comfirm account
     */
    private function sendConfirmLetter($email_to)
    {
        $email = Yii::app()->email;
        $email->to = $email_to;
        $email->subject = 'Hello';
        $email->from = Yii::app()->params['adminEmail'];
        $email->view = 'confirm';
        $email->viewVars = array('confirm_key'=>$this->confirm_key, 'id'=>$this->id);
        $email->send();
    }
    
    /**
     * @comfirm account
     */
    public function activate($params=NULL)
    {
        if ($params != NULL)
        {
            if (count($this->findAllByAttributes(array('id'=>$params['id'],'is_active'=>1)))>0)
            {
                return self::ACTIVATION_ERROR;
            }
            $user = $this->findByPk($params['id']);
            if ( $user->confirm_key == $params['key'])
            {
                $user->is_active = 1;
                $user->save();
                return self::ACTIVATION_SUCCESS;
            }
            else 
            {
                return self::ACTIVATION_ERROR;
            }
        }
    }


}
