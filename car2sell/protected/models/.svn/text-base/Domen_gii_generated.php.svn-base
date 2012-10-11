<?php

/**
 * This is the model class for table "domen".
 *
 * The followings are the available columns in table 'domen':
 * @property integer $id
 * @property string $name
 * @property string $change
 * @property string $city
 * @property integer $region
 * @property integer $main
 * @property integer $num
 * @property string $geo_city
 * @property integer $cap
 * @property string $button
 * @property string $timezone
 * @property string $title_site
 * @property string $keywords_site
 * @property string $description_site
 */
class Domen extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Domen the static model class
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
		return 'domen';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('name, change, city, geo_city, button, timezone, title_site, keywords_site, description_site', 'required'),
			array('region, main, num, cap', 'numerical', 'integerOnly'=>true),
			array('name', 'length', 'max'=>55),
			array('city, geo_city, timezone', 'length', 'max'=>50),
			array('title_site, keywords_site, description_site', 'length', 'max'=>1000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, name, change, city, region, main, num, geo_city, cap, button, timezone, title_site, keywords_site, description_site', 'safe', 'on'=>'search'),
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
			'name' => 'Name',
			'change' => 'Change',
			'city' => 'City',
			'region' => 'Region',
			'main' => 'Main',
			'num' => 'Num',
			'geo_city' => 'Geo City',
			'cap' => 'Cap',
			'button' => 'Button',
			'timezone' => 'Timezone',
			'title_site' => 'Title Site',
			'keywords_site' => 'Keywords Site',
			'description_site' => 'Description Site',
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
		$criteria->compare('name',$this->name,true);
		$criteria->compare('change',$this->change,true);
		$criteria->compare('city',$this->city,true);
		$criteria->compare('region',$this->region);
		$criteria->compare('main',$this->main);
		$criteria->compare('num',$this->num);
		$criteria->compare('geo_city',$this->geo_city,true);
		$criteria->compare('cap',$this->cap);
		$criteria->compare('button',$this->button,true);
		$criteria->compare('timezone',$this->timezone,true);
		$criteria->compare('title_site',$this->title_site,true);
		$criteria->compare('keywords_site',$this->keywords_site,true);
		$criteria->compare('description_site',$this->description_site,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}