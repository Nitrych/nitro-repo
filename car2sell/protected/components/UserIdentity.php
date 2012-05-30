<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */

	private $_id;

	public function authenticate()
    {
	    $record=User::model()->findByAttributes(array('email'=>$this->email, 'active'=>1));
        if($record===null)
	        $this->errorCode=self::ERROR_USERNAME_INVALID;
        else if($record->password!==md5( md5(substr($this->password,0,3)).substr($this->password,3)) )
	        $this->errorCode=self::ERROR_PASSWORD_INVALID;
        else
		{
            $this->_id=$record->id;
            $sessionKey = $record->updateSessionKey();
            $this->setState('id', $record->id);
            $this->errorCode=self::ERROR_NONE;
        }
	    return !$this->errorCode;
	}

	public function getId()
    {
    	return $this->_id;
    }
}
