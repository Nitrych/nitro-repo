<?php
///////////////////////////////////////////////////////////////////
// mysql.lass
///////////////////////////////////////////////////////////////////
//The class introduces variables and functions to work with MySQL database
//
//Updated 4.07.2003
//
///////////////////////////////////////////////////////////////////

class class_mysql
{

var $sql_login="fdmoz2"; 
var $sql_passwd="dima777";
var $sql_database="fernx";
var $sql_host="localhost";
var $sql_type="mysql";   //or postgres


var $conn_id;
var $sql_query;
var $sql_err;
var $sql_res;
function sql_connect()
{
if ($this->sql_type=='mysql'){
 $this->conn_id=mysql_connect($this->sql_host,$this->sql_login,$this->sql_passwd);
 mysql_select_db($this->sql_database);
 //mysql_query ("set character_set_client='koi8r'");
 //mysql_query ("set character_set_results='koi8r'");
 //mysql_query ("set collation_connection='cp1251_general_ci'");
 //mysql_query("SET NAMES 'koi8r'");

}else{//postgres
$this->connect_string = "";
if( $this->sql_login!=''){
        $this->connect_string .= "user=$this->sql_login ";
}
if( $this->sql_passwd!='' ){
        $this->connect_string .= "password=$this->sql_passwd ";
}
if( $this->sql_host!='' ){
  if( ereg(":", $this->sql_host) )        {
          list($sqlserver, $sqlport) = split(":", $this->sql_host);
          $this->connect_string .= "host=$sqlserver port=$sqlport ";
  }else{
          if( $this->sql_host != "localhost" )        {
                  $this->connect_string .= "host=$this->sql_host";
          }
  }
}

if( $this->sql_database !=''){
                        $this->dbname = $this->sql_database;
                        $this->connect_string .= "dbname=$this->sql_database";
                }
$this->conn_id = pg_connect($this->connect_string);
}//end postgres
}
function sql_connect_nobase()
{
$this->conn_id=mysql_connect($this->sql_host,$this->sql_login,
$this->sql_passwd);

}
function sql_execute()
{
   global $my;

                       // $this->query_result = @mysql_query($query, $this->db_connect_id);

                //}
   if ($this->sql_type=='mysql'){

      //$my->reset_time();
      $this->sql_res=mysql_query($this->sql_query,$this->conn_id);
      //$my->set_time('<font size=small>'.$this->sql_query.'</font>');
      $this->sql_err=mysql_error();
      if ((!isset($this->conn_id) || $this->sql_err) ){
              echo "<font color=red>Mysql Error: $this->sql_query<br>$this->sql_err</font>";
      }
	  if(isset($_GET['mysql']))
		  echo "<br>$this->sql_query";
      if ($this->sql_err){
          $this->pushErr("SQL ERROR: $this->sql_err(((".$this->sql_query);
      }
   }else{
       $this->sql_query        = preg_replace("/LIMIT ([0-9]+),([ 0-9]+)/", "LIMIT \\2 OFFSET \\1", $this->sql_query);
       $this->sql_res=pg_query($this->conn_id,$this->sql_query);
       $this->sql_err=pg_result_error();
       if ((!isset($this->conn_id) || $this->sql_err) ){
              echo "<font color=red>Mysql Error: $this->sql_query</font>";
       }
       if ($this->sql_err){
          $this->pushErr("SQL ERROR: $this->sql_err");
       }
   }
}
function sql_close()
{
   if ($this->sql_type=='mysql'){
       $res = mysql_close($this->conn_id);
       return $res;
   }else{
       $res = pg_close($this->conn_id);
       return $res;
   }
}
function sql_num_rows($res){
  if ($this->sql_type=='mysql'){
           return mysql_num_rows($res);
  }else{
     return pg_num_rows($res);
  }

}
function sql_result($result,$offset,$field=''){

  if ($this->sql_type=='mysql'){
     if ($field=='')
              return mysql_result($result,$offset);
           else
            return mysql_result($result,$offset,$field);
  }else{
     if ($field==''){
        return pg_fetch_result($result,$offset,0);
     }else{
              return pg_fetch_result($result,$offset,$field);
     }

  }
}
function sql_fetch_row($result=''){
  if ($result=='')
      $result = $this->sql_res;
  if ($this->sql_type=='mysql'){
        return mysql_fetch_row($result);
  }else{
        return pg_fetch_result($result);
  }
}
function sql_fetch_column(){
  $res = array();
  if ($this->sql_type=='mysql'){
        while($temp = mysql_fetch_row($this->sql_res)){
                $res[] = $temp[0];
        }
        return $res;

  }else{
        while($temp = pg_fetch_result($this->sql_res)){
                $res[] = $temp[0];
        }
        return $res;

  }
}
function sql_fetch_assoc($result){

  if ($this->sql_type=='mysql'){
        return mysql_fetch_assoc($result);
  }else{
        return pg_fetch_assoc($result);
  }
}
function sql_fetch_array($result){

  if ($this->sql_type=='mysql'){
        return mysql_fetch_array($result);
  }else{
        return pg_fetch_array($result);
  }
}
function execSQL($str){
        $this->sql_query = $str;
        $this->sql_execute();
}
function getFromSQL($str){
        $this->sql_query = $str;
        $this->sql_execute();
        return $this->sql_result($this->sql_res,0);

}
function sql_reconnect($conn_id)
{
$this->conn_id = $conn_id;

}
function pushErr($str)
{
global $system_path;
$str = "<font color=red>".$str."</font>";
$time = date("d.m.Y�.",time());
$time .= date("G:i:s",time());
$res = debug_backtrace();

 /*foreach($res as $item){
            $class1 = "N/A";
            if (isset($item['class']))
                    $class1 = $item['class'];
            $arguments = "";
            foreach($item['args'] as $argument)
                    $arguments .= "+++".$argument;
                $time .= " function: ".$item['function']." file: ".$item['file']." line: ".$item['line']." class: ".$class1." args: ".$arguments."<br>";
    }*/
        error_log("<br>".$time.$str,3,$system_path."log/sys_error.htm");
        return 0;
}

}

class class_messages
{
var $ADD_URL = '��������';
var $EDIT_URL = '�������������';
var $DELETE_URL = '�������';
var $CHANGE = '��������';
var $PAGES = 'Pages';
var $YES = '��';
var $NO = '���';
var $DISABLE = '������';
var $ENABLE = '�������';
var $ERROR_HAPPENED = 'Error';
var $ARE_YOU_SURE_TO_DELETE = "�������?";
var $NO_ACCESS = '��� ����������� ����';
var $DEL_URL = 'delete';

}
?>