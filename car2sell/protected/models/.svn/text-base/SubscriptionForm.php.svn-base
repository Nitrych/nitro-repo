<?php

/**
 * SubscriptionForm class.
 * SubscriptionForm is the data structure for keeping
 * subscription form data. It is used by the 'addnew' action of 'SubscriptionController'.
 */
class SubscriptionForm extends CFormModel
{
    public $keywords;
    public $email;
    public $category;
    public $region;
    public $category_choices;
    public $region_choices;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			array('email, keywords', 'required', 'message'=>'Это поле не может быть пустым'),
            array('email', 'email', 'message'=>'Не похоже на E-mail'),
            array('region', 'exist', 'allowEmpty'=>TRUE, 'attributeName' => 'id', 'className' => 'Region'),
            array('category', 'exist', 'allowEmpty'=>TRUE, 'attributeName' => 'id', 'className' => 'Category'),
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'title'=>'Заголовок',
                        'email'=>'E-mail',
                        'category'=>'Категория',
                        'keywords'=>'Ключевые слова',
						'region'=>'Регион',
		);
	}
    
    public function setChoices()
    {
        $this->category_choices = array('Все категории');
        $categories = Category::model()->findAll(array('order'=>'id'));
        foreach($categories as $cat)
        {
            $this->category_choices[$cat->id] = $cat->name;
        }
        $this->region_choices = array('Вся Россия');
        $regoins = Region::model()->findAll(array('order'=>'name'));
        foreach($regoins as $regoin)
        {
            $this->region_choices[$regoin->id] = $regoin->name;
        }
    }

}
