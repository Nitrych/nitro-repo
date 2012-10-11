<?php

/**
 * This is the model class for table "user".
 *
 * The followings are the available columns in table 'user':
 * @property integer $id
 * @property string $username
 * @property string $email
 * @property string $password
 * @property string $session_key
 * @property string $confirm_key
 * @property integer $created_date
 * @property integer $is_active
 * @property string $phone_number
 * @property string $skype
 * @property string $icq
 * @property integer $domen
 */
class user2 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return user2 the static model class
	 */
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
			array('username, email, password, confirm_key, created_date, phone_number, skype, icq, domen', 'required'),
			array('created_date, is_active, domen', 'numerical', 'integerOnly'=>true),
			array('username, email, password', 'length', 'max'=>255),
			array('session_key', 'length', 'max'=>32),
			array('confirm_key', 'length', 'max'=>70),
			array('phone_number', 'length', 'max'=>20),
			array('skype, icq', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, username, email, password, session_key, confirm_key, created_date, is_active, phone_number, skype, icq, domen', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'username' => 'Username',
			'email' => 'Email',
			'password' => 'Password',
			'session_key' => 'Session Key',
			'confirm_key' => 'Confirm Key',
			'created_date' => 'Created Date',
			'is_active' => 'Is Active',
			'phone_number' => 'Phone Number',
			'skype' => 'Skype',
			'icq' => 'Icq',
			'domen' => 'Domen',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('session_key',$this->session_key,true);
		$criteria->compare('confirm_key',$this->confirm_key,true);
		$criteria->compare('created_date',$this->created_date);
		$criteria->compare('is_active',$this->is_active);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('icq',$this->icq,true);
		$criteria->compare('domen',$this->domen);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}