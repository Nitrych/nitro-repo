<?php

/**
 * This is the model class for table "content".
 *
 * The followings are the available columns in table 'content':
 * @property integer $id
 * @property string $title
 * @property string $slug
 * @property string $content
 * @property integer $parent_id
 */
class Report extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Content the static model class
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
		return 'report';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, template, code', 'required'),
			array('title', 'length', 'max'=>255),
			array('hashsum', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, ', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'slug' => 'Slug',
			'content' => 'Content',
			'template' => 'Template',
			'code' => 'Code',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('slug',$this->slug,true);
		
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	public function getPossibleParents(){
		$res = array('0' => "Нет");
		$attributes = array('parent_id'=>'0');
		$condition = array('order'=>'id asc','condition'=>"slug<>'_bottom_area'");
		$rest = $this->findAllByAttributes($attributes, $condition);
		
		foreach($rest as $item){
			$res[ $item->id ] = $item->title;
		}
		
		return $res;
	}
	public function getContentBySlug($slug){
		$attributes = array('slug'=>$slug);
		$condition = array();
		$rest = $this->findAllByAttributes($attributes, $condition);
		
		//return "";
		return $rest['0']->content;
		
	}
	/*
	To catch a parse error in eval()'ed code with a custom error handler, use error_get_last() (PHP >= 5.2.0).


	$return = eval( 'parse error' );

	if ( $return === false && ( $error = error_get_last() ) ) {
		myErrorHandler( $error['type'], $error['message'], $error['file'], $error['line'], null );

		// Since the "execution of the following code continues normally", as stated in the manual,
		// we still have to exit explicitly in case of an error
		exit;
	}
	*/
	static function isGoodHash($id,$hash){
	
		$report = Report::model()->findByPk($id);
		if($report->hashsum==$hash)
			return true;
		return false;
		
	}
	static function reportByData($table_def,$fields){
		
		$table = new admin_table;
		$msg = new class_messages;
		
		//print_r(Yii::app()->_connection);
		
		//print_r(Yii::app());
		//print_r(Yii::app()->componentConfig);
		$curDb = Yii::app()->getDb();
	
		
		list($host,$dbname)	= explode(';',$curDb->connectionString);
		
		$dbname = str_replace('dbname=','',$dbname);
		//echo "<br>".$curDb->connectionString;
		//echo "<br>".$dbname;
		$table->sql_login    = $curDb->username; 
		$table->sql_passwd   = $curDb->password;
		$table->sql_database = $dbname;
		$table->sql_host     = 'localhost';
	
		 //echo "$table->sql_login $table->sql_passwd $table->sql_database $table->sql_host"; 
		$table->configTable($msg);
		$table->sql_connect();
			
		$temp_out = $table->showTable($table_def,$fields);
		
		//echo $temp_out;
		return $temp_out;
		
	}		
	static function formatReport($id,$db_id,$print_version=false){
			$report = Report::model()->findByPk($id);
		
			
			$sourceDb = Dba::model()->findByPk($db_id);
			
			
			$table = new admin_table;
			$msg = new class_messages;
			
			$table->sql_login    = $sourceDb->user; 
			$table->sql_passwd   = $sourceDb->password;
			$table->sql_database = $sourceDb->dbname;
			$table->sql_host     = $sorceDb->host;
	
			$table->configTable($msg);
			$table->sql_connect();
			
			
			//replace placeholders
			foreach($_GET as $id=>$val){
				$report->code = str_replace(":$id:",$val,$report->code);
			}
			
			//find wrappers
		    preg_match_all("/wrapper_([A-Za-z_]+)\(/",$report->code,$names);
			foreach($names[1] as $func_name){
				$functions[$func_name] = true;
			}
			
			preg_match_all("/'wrapper'=>'([A-Za-z_]+)'/",$report->code,$names);
			foreach($names[1] as $func_name){
				$functions[$func_name] = true;
			}
			
			
			error_reporting(E_ALL);
			ini_set("display_errors","1");
		
			
			foreach($functions as $func_name=>$dummy){
				$wrapper = Wrapper::model()->findByAttributes(array('name'=>$func_name));
				eval($wrapper->code);
			}
			
			
			
			eval($report->code);
			
			//parse data arrays
			foreach($data as $name=>$dataValue){
				if(is_array($dataValue) && isset($dataValue['sql'])){
					
					
					$realValue = $table->getFromSQL($dataValue['sql']);
					if(isset($dataValue['wrapper'])){
						$funcName = "wrapper_".$dataValue['wrapper'];
						$realValue = $funcName($realValue,0);
					}
					$data[$name] = $realValue;
					
				}
			}
			
			error_reporting(E_ALL);
			ini_set("display_errors","0");
			
		
		    if(isset($table_def) && isset($fields)){
				if($print_version!==false){
					$table_def['sortable'] = false;
				}
				if($_GET['docformat']=='pdf'){
					$table_def['pdf'] = true;
				}
				$temp_out = $table->showTable($table_def,$fields);
				$data['table'] = $temp_out;
			}
			
            $result = Report::parseTemplate($report->template,$data);
			return $result;
	}
	
	static function parseTemplate($template,$data){
		
		$result = $template;
		
		$result = preg_replace("/(<td>([^<]*)\{([A-Za-z]+)\|([A-Za-z]+)\}([^<]*)<\/td>)/",'<td class="$4-td">$2<span class="$4">{$3}</span>$5</td>',$result); 
		
		//$result = preg_replace("/(<td>[^<]*\{([A-Za-z]+)\|([A-Za-z]+)\}[^<]*<\/td>)/",'<td class="$3-td"><div class="$3">{$2}</div></td> ',$result);
		$result = preg_replace("/\{([A-Za-z_]+)\|([A-Za-z_]+)\}/",'<div class="$2">{$1}</div>',$result);
		
		foreach($data as $variable=>$value){
				$result = str_replace("{".$variable."}","".$value."",$result);
			}
		return $result;	
	}
}
