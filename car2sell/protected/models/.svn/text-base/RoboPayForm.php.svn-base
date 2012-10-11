<?php

class RoboPayForm extends CFormModel
{
	public $fio;
	public $summ;
	public $acceptOferta;

	/**
	 * Declares the validation rules.
	 */
	public function rules()
	{
		return array(
			// name, email, subject and body are required
			array('summ', 'required', 'message'=> 'Поле {attribute} не может быть пустым.'),
			// email has to be a valid email address
			array('summ', 'numerical'),
			array('summ', 'compare', 'operator'=>'>=', 'compareValue'=>5, 'message'=>'Минимальная сумма для оплаты &ndash; 100 рублей.'),
			//array('acceptOferta', 'compare', 'operator'=>'==','compareValue'=>1, 'message' => 'Необходимо принять условия Договора-оферты.'),
		);
	}

	/**
	 * Declares customized attribute labels.
	 * If not declared here, an attribute would have a label that is
	 * the same as its name with the first letter in upper case.
	 */
	public function attributeLabels()
	{
		return array(
			'fio' => 'ФИО',
			'summ' => 'Сумма платежа',
			'acceptOferta' => 'Согласен с офертой',
		);
	}
	
	
}
?>