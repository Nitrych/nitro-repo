<?php

/**
 * This is the model class for table "configuration".
 *
 * The followings are the available columns in table 'configuration':
 * @property string $key
 * @property string $value
 * @property string $created
 * @property string $updated
 */
class Config extends CActiveRecord
{
    /**
     * Returns the static model of the specified AR class.
     * @param string $className active record class name.
     * @return Configuration the static model class
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
        return 'config';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('value, created, updated', 'required'),
            array('value', 'length', 'max'=>255),
            // The following rule is used by search().
            // Please remove those attributes that should not be searched.
            array('key, value, created, updated, title', 'safe', 'on'=>'search'),
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
            'key' => 'Key',
            'value' => 'Значение',
			'title' => 'Название',
            'created' => 'Created',
            'updated' => 'Updated',
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

        $criteria->compare('key',$this->key,true);
        $criteria->compare('value',$this->value,true);
        $criteria->compare('created',$this->created,true);
		$criteria->compare('title',$this->title,true);
        $criteria->compare('updated',$this->updated,true);
		$criteria->order = "created DESC";
		
        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
			 'sort'=>array(
                'defaultOrder'=>'title DESC',
             ),
        ));
    }
    
	public function beforeValidate()
	{
		if ($this->isNewRecord)
		{
			// Implicit flush to delete the URL rules
			$this->created = new CDbExpression('NOW()');
			$this->updated = new CDbExpression('NOW()');
		}
		else
			$this->updated = new CDbExpression('NOW()');

		return parent::beforeValidate();
	}
	static function read($key){
			$res = Config::model()->findByAttributes(array('key'=>$key))->value;
			return $res;
	}
	
	function __get($attr){
		$params['listPerPage'] = 10;
	
		if($attr=='params'){
			$temp = Config::model()->findAll();
			foreach($temp as $item)
				$params[$item->key] = $item->value;
			return $params;
		}
		//echo "*".$this->$name;
		//$data = $this->
		return parent::__get($attr);
	}
	
}
