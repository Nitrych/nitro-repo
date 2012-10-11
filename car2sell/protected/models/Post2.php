<?php

/**
 * This is the model class for table "post".
 *
 * The followings are the available columns in table 'post':
 * @property integer $id
 * @property integer $creator_id
 * @property string $title
 * @property string $text
 * @property string $buy_sell
 * @property integer $price
 * @property integer $auction
 * @property string $model
 * @property integer $year
 * @property string $color
 * @property integer $mileage
 * @property integer $engine_value
 * @property string $fuel
 * @property string $gear
 * @property string $owner_type
 * @property string $username
 * @property string $email
 * @property string $phone_number
 * @property string $icq
 * @property string $skype
 * @property integer $category
 * @property integer $domen
 * @property integer $time
 * @property integer $view
 */
class Post2 extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Post2 the static model class
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
		return 'post';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, text, buy_sell, model, year, color, mileage, engine_value, fuel, gear, owner_type, username, email, phone_number, icq, skype, category, domen, time', 'required'),
			array('creator_id, price, auction, year, mileage, engine_value, category, domen, time, view', 'numerical', 'integerOnly'=>true),
			array('buy_sell', 'length', 'max'=>4),
			array('model, username, email, phone_number, icq, skype', 'length', 'max'=>255),
			array('color', 'length', 'max'=>100),
			array('fuel, gear', 'length', 'max'=>6),
			array('owner_type', 'length', 'max'=>7),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, creator_id, title, text, buy_sell, price, auction, model, year, color, mileage, engine_value, fuel, gear, owner_type, username, email, phone_number, icq, skype, category, domen, time, view', 'safe', 'on'=>'search'),
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
			'creator_id' => 'Creator',
			'title' => 'Title',
			'text' => 'Text',
			'buy_sell' => 'Buy Sell',
			'price' => 'Price',
			'auction' => 'Auction',
			'model' => 'Model',
			'year' => 'Year',
			'color' => 'Color',
			'mileage' => 'Mileage',
			'engine_value' => 'Engine Value',
			'fuel' => 'Fuel',
			'gear' => 'Gear',
			'owner_type' => 'Owner Type',
			'username' => 'Username',
			'email' => 'Email',
			'phone_number' => 'Phone Number',
			'icq' => 'Icq',
			'skype' => 'Skype',
			'category' => 'Category',
			'domen' => 'Domen',
			'time' => 'Time',
			'view' => 'View',
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
		$criteria->compare('creator_id',$this->creator_id);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('text',$this->text,true);
		$criteria->compare('buy_sell',$this->buy_sell,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('auction',$this->auction);
		$criteria->compare('model',$this->model,true);
		$criteria->compare('year',$this->year);
		$criteria->compare('color',$this->color,true);
		$criteria->compare('mileage',$this->mileage);
		$criteria->compare('engine_value',$this->engine_value);
		$criteria->compare('fuel',$this->fuel,true);
		$criteria->compare('gear',$this->gear,true);
		$criteria->compare('owner_type',$this->owner_type,true);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('phone_number',$this->phone_number,true);
		$criteria->compare('icq',$this->icq,true);
		$criteria->compare('skype',$this->skype,true);
		$criteria->compare('category',$this->category);
		$criteria->compare('domen',$this->domen);
		$criteria->compare('time',$this->time);
		$criteria->compare('view',$this->view);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}