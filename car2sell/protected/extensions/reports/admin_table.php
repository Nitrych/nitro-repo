<?php
// added htmlSpecialChars() and text area changed a little
// added upload files....                        fpaginf
// table_definition
//        'table' = table_name
//        'order_by' =
//        'whffre ' = where clause
//          'caption_field'

//        fields definitions
//    sql_name
//    caption
//    type
//
// --- must be magic enabled!!!
//
define("PAGES_TOP",false);
define("PUBLISH_INVERTED",true);
define("prints_format", '/^[\x20-\x7E\x80-\xFF]+$/');
define("email_format", "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)+/");
define("digits_format", '/^[0-9]+$/');
define("chars_format", '/^[0-9A-Za-z_]+$/');
define("symbols_format", '/^[\x21-\x7E]+$/');
define("texts_format", '/^[\x09\x0A\x0D\x20-\x7E\x80-\xFF]+$/');
define("zip_format", '/^[0-9][0-9][0-9][0-9][0-9](-[0-9][0-9][0-9][0-9])?$/');
define("phone_format", '/^(\(( )?\d{2,6}( )?\))?( )?(\d{2,18}(( |\-|( \- )))?){0,8}(\d{1,18}){1,18}$/');
define("float_format", '/^[0-9]+(\\.[0-9]+)?$/');
define("url_format", "~^(?:(?:https?|ftp|telnet)://(?:[a-z0-9_-]{1,32}".
   "(?::[a-z0-9_-]{1,32})?@)?)?(?:(?:[a-z0-9-]{1,128}\.)+(?:com|net|".
   "org|mil|edu|arpa|gov|biz|info|aero|inc|name|[a-z]{2})|(?!0)(?:(?".
   "!0[^.]|255)[0-9]{1,3}\.){3}(?!0|255)[0-9]{1,3})(?:/[a-z0-9.,_@%&".
   "?+=\~/-]*)?(?:#[^ '\"&<>]*)?$~i");

require_once($system_path.'/base.php');
class admin_table extends class_mysql{
var $garna_fl = true;
var $debug_fl = false;
var $errorList;
var $summaries;
        var $formats;
        function formdata()
        {
                $this->errorList = array();
                $this->formats = array(
                                            '*' => prints_format,
                                            "password" => symbols_format,
                                            "identifier" => chars_format,
                                            "number" => digits_format,
                                            "title" => prints_format,
                                            "description" => prints_format,
                                            "text" => texts_format,
                                            "email" => email_format,
                                            "checkbox" => chars_format,
                                            "url" => url_format,
                                            "path" => symbols_format,
                                            "phone" => phone_format,
                                            "zip" => zip_format,
                                            "float" => float_format
                );
        }
        function trim(&$value)
        {
                $value = trim($value);
        }
        function setError($msg)
        {
                $this -> errorList[] = $msg;
        }
        function resetErrorList()
        {
                $this->errorList = array();
        }
        function Validit(&$form, $items)
        {
                $this->resetErrorList();
                foreach($form as $key => $value) {
                        if(isset($items["$key"])){

                                $def = $items["$key"];
                                if(isset($this->formats[$def["type"]])){

                                        $curformat = $this->formats[$def["type"]];
                                        if ($value=="" && $def['min']>0){
                                                 $this -> setError($def['name']." is empty");
                                        }elseif (strlen($value) < $def['min']) {
                                    $this -> setError($def['name']."is too short (min ".$def['min']." number of characters)");
                                } elseif (strlen($value) > $def['max']) {
                                    $this -> setError($def['name']." is too long (max ".$def['max']." number of characters)");
                                }
                                elseif ($value != "" && !preg_match($curformat,$value)) {
                                    $this -> setError("Inadmissible ".$def['name']);
                                }
                                        elseif (($def["type"]=="number"||$def["type"]=="float")&&(isset($def['minv'])&& $value<$def['minv'])) {
                                    $this -> setError($def['name']." must be >=".$def['minv']);
                                }
                                        elseif (($def["type"]=="number"||$def["type"]=="float")&&(isset($def['maxv'])&& $value>$def['maxv'])) {
                                    $this -> setError($def['name']." must be <=".$def['maxv']);
                                }
                                else {
                                        $value = htmlspecialchars(stripslashes(trim($value," ")));
                                                $form[$key] = $value;
                                }
                                }
                        }
                }
                return $this->errorList;
        }


var $countries = array("Afghanistan",
"Albania",
"Algeria",
"American Samoa",
"Andorra",
"Angola",
"Anguilla",
"Antarctica",
"Antigua And Barbuda",
"Argentina",
"Armenia",
"Aruba",
"Australia",
"Austria",
"Azerbaijan",
"Bahamas",
"Bahrain",
"Bangladesh",
"Barbados",
"Belarus",
"Belgium",
"Belize",
"Benin",
"Bermuda",
"Bhutan",
"Bolivia",
"Bosnia and Herzegowina",
"Botswana",
"Bouvet Island",
"Brazil",
"British Indian Ocean Territory",
"Brunei Darussalam",
"Bulgaria",
"Burkina Faso",
"Burma",
"Burundi",
"Cambodia",
"Cameroon",
"Canada",
"Cape Verde",
"Cayman Islands",
"Central African Republic",
"Chad",
"Chile",
"China",
"Christmas Island",
"Cocos (Keeling) Islands",
"Colombia",
"Comoros",
"Congo",
"Congo, the Democratic Republic",
"Cook Islands",
"Costa Rica",
"Cote d'Ivoire",
"Croatia",
"Cyprus",
"Czech Republic",
"Denmark",
"Djibouti",
"Dominica",
"Dominican Republic",
"East Timor",
"Ecuador",
"Egypt",
"El Salvador",
"England",
"Equatorial Guinea",
"Eritrea",
"Estonia",
"Ethiopia",
"Falkland Islands",
"Faroe Islands",
"Fiji",
"Finland",
"France",
"French Guiana",
"French Polynesia",
"French Southern Territories",
"Gabon",
"Gambia",
"Georgia",
"Germany",
"Ghana",
"Gibraltar",
"Great Britain",
"Greece",
"Greenland",
"Grenada",
"Guadeloupe",
"Guam",
"Guatemala",
"Guinea",
"Guinea-Bissau",
"Guyana",
"Haiti",
"Heard and Mc Donald Islands",
"Holy See (Vatican City State)",
"Honduras",
"Hong Kong",
"Hungary",
"Iceland",
"India",
"Indonesia",
"Ireland",
"Israel",
"Italy",
"Jamaica",
"Japan",
"Jordan",
"Kazakhstan",
"Kenya",
"Kiribati",
"Korea (South)",
"Kuwait",
"Kyrgyzstan",
"Lao People's Democratic Republ",
"Latvia",
"Lebanon",
"Lesotho",
"Liberia",
"Liechtenstein",
"Lithuania",
"Luxembourg",
"Macau",
"Macedonia",
"Madagascar",
"Malawi",
"Malaysia",
"Maldives",
"Mali",
"Malta",
"Marshall Islands",
"Martinique",
"Mauritania",
"Mauritius",
"Mayotte",
"Mexico",
"Micronesia, Federated States o",
"Moldova, Republic of",
"Monaco",
"Mongolia",
"Montserrat",
"Morocco",
"Mozambique",
"Namibia",
"Nauru",
"Nepal",
"Netherlands",
"Netherlands Antilles",
"New Caledonia",
"New Zealand",
"Nicaragua",
"Niger",
"Nigeria",
"Niuev",
"Norfolk Island",
"Northern Ireland",
"Northern Mariana Islands",
"Norway",
"Oman",
"Pakistan",
"Palau",
"Panama",
"Papua New Guinea",
"Paraguay",
"Peru",
"Philippines",
"Pitcairn",
"Poland",
"Portugal",
"Puerto Rico",
"Qatar",
"Reunion",
"Romania",
"Russian Federation",
"Rwanda",
"Saint Kitts and Nevis",
"Saint Lucia",
"Saint Vincent and the Grenadin",
"Samoa (Independent)",
"San Marino",
"Sao Tome and Principe",
"Saudi Arabia",
"Scotland",
"Senegal",
"Seychelles",
"Sierra Leone",
"Singapore",
"Slovakia",
"Slovenia",
"Solomon Islands",
"Somalia",
"South Africa",
"South Georgia and the South Sa",
"Spain",
"Sri Lanka",
"St. Helena",
"St. Pierre and Miquelon",
"Suriname",
"Svalbard and Jan Mayen Islands",
"Swaziland",
"Sweden",
"Switzerland",
"Taiwan",
"Tajikistan",
"Tanzania",
"Thailand",
"Togo",
"Tokelau",
"Tonga",
"Trinidad and Tobago",
"Tunisia",
"Turkey",
"Turkmenistan",
"Turks and Caicos Islands",
"Tuvalu",
"Uganda",
"Ukraine",
"United Arab Emiratesv",
"United States of America",
"Uruguay",
"Uzbekistan",
"Vanuatu",
"Venezuela",
"Viet Nam",
"Virgin Islands (British)",
"Virgin Islands (U.S.)",
"Wales",
"Wallis and Futuna Islands",
"Western Sahara",
"Yemen",
"Zambia",
"Zimbabwe"
);


  function mySlashes($str){
     if (!get_magic_quotes_gpc())
        return addSlashes($str);
     else
        return $str;
  }
  function myStripSlashes($str){
     if (get_magic_quotes_gpc())
        return stripSlashes($str);
     else
        return $str;
  }
  var $msg;
  function configTable($msg){
       $this->msg=$msg;
  }
  function configForm($msg){
       $this->msg=$msg;
  }
  
  function makeURL($url,$id,$action,$disabled_button_fl='enabled'){
     global $table_def,$sparam;
     //echo '<br>'.$url.'|'.$action;
     $image_postfix = '';
     if ($disabled_button_fl=='disabled'){
     	$image_postfix = '_dis';
     	
     }
     if (!isset($table_def['get_prefix']))
          $table_def['get_prefix'] = '';

     if ($action=='del')
        $id_caption = $table_def['get_prefix'].'delete';
     else
        $id_caption = $table_def['get_prefix'].'id';

     //$url = preg_replace("/".$id_caption."=\d+([&]?)/",'',$url);
     //$url = preg_replace("/".$table_def['get_prefix']."action=[^\s]+([&]?)/",'',$url);

     if (PUBLISH_INVERTED && $action=='enable')
          $action='disable';
     elseif (PUBLISH_INVERTED && $action=='disable')
          $action='enable';
     //echo '<br/>1<br/>'.$url;
     $url = $this->deleteArgument($url,$table_def['get_prefix'].'action');
     //echo '<br/>1.5<br/>'.$url;
     $url = $this->deleteArgument($url,$id_caption);
     //echo '<br/>2<br/>'.$url;
     //echo $id.'--<font color=red>'.$url.'</font>';
     if (strpos($url,'?')===false)

          $url = $url."?$id_caption=".$id."&".$table_def['get_prefix']."action=".$action;
     else
          $url = $url."&$id_caption=".$id."&".$table_def['get_prefix']."action=".$action;
     //echo '<br/>3<br/>'.$url;
     //echo '<font color=green>'.$url.'</font><br>';
     $url = str_replace('&&','&',$url);
     $url = str_replace('?&','?',$url);
     //echo '<br/>4<br/>'.$url;

     if (PUBLISH_INVERTED){
            $this->msg->ENABLE = '������';
            $this->msg->DISABLE = '�������';
     }
     if ($action=='enable')
         $action_name = '<img border=0 src="./admin/img/publish'.$image_postfix.'.gif" alt="'.$this->msg->ENABLE.'">';
     if ($action=='disable')
         $action_name = '<img border=0 src="./admin/img/publish'.$image_postfix.'.gif" alt="'.$this->msg->DISABLE.'">';
     if ($action=='del'){
         $action_name = '<img style="border:0;cursor:hand;" onclick="del('.$id.')" src="./admin/img/delete'.$image_postfix.'.gif" alt="'.$this->msg->DEL_URL.'">';
         $url = $_SERVER['REQUEST_URI'];
     }
     elseif($action=='edit')
         $action_name = '<img border=0 src="./admin/img/edit'.$image_postfix.'.gif" alt="'.$this->msg->EDIT_URL.'">';
     if ($action=='add')
         $action_name = $this->msg->ADD_URL;

     if ($disabled_button_fl=='disabled'){    
     	 if ($action=='del'){
            $action_name = '<img style="border:0;cursor:hand;"  src="./admin/img/delete'.$image_postfix.'.gif" alt="'.$this->msg->DEL_URL.'">';     
         	return "<a href='javascript:alert(\"��� �������\")' >$action_name</a>";
     	 }else
        	return "<a href='javascript:alert(\"��� �������\")' >$action_name</a>";
     }else{
     	 if ($action=='del')
     
         	return "$action_name";
     	else
        	return "<a href='$url' >$action_name</a>";
     }   
  }

  function getCommonURL($url,$id,$action){
     global $table_def;

     if (!isset($table_def['get_prefix']))
          $table_def['get_prefix'] = '';
     if ($action=='del')
        $id_caption = $table_def['get_prefix'].'delete';
     else
        $id_caption = $table_def['get_prefix'].'id';


     $url = $this->deleteArgument($url,$table_def['get_prefix'].'action');
     $url = $this->deleteArgument($url,$id_caption);
     //$url = preg_replace("/".$id_caption."=\d+([&]?)/",'',$url);
     //$url = preg_replace("/".$table_def['get_prefix']."action=[^\s]+([&]?)/",'',$url);


     if (strpos($url,'?')===false)
          $url = $url."?$id_caption=__id__"."&".$table_def['get_prefix']."action=".$action;
     else
          $url = $url."&$id_caption=__id__"."&".$table_def['get_prefix']."action=".$action;
          
     if (isset($_GET['paging'])){     
     	if (strpos($url,'?')===false)
          $url = "xxx";
     	else
          $url = $url."&paging=$_GET[paging]";
     }     
              
     $url = str_replace('&&','&',$url);
     $url = str_replace('?&','?',$url);

     return $url;
  }
  //better showReport
  function showTable($table_def,$fields=1){

           global $param,$sparam;
           $_SESSION['garna_original_url'] = $_SERVER['REQUEST_URI'];
           $result = '';
           if (isset($_GET['adebug']))
               $result .= $_SESSION['echo'];

           if (isset($table_def['unique']) && !is_array($table_def['unique']))
            $table_def['primary'] = $table_def['unique'];



       //return 1;

       //echo
       if (!isset($table_def['get_prefix']))
          $table_def['get_prefix'] = '';

       if (isset($table_def['publish_property'])){
                 //check if chnage needed

                 $get_index = $table_def['get_prefix'].'action';
                 $get_index_id = $table_def['get_prefix'].'id';
                 //echo 'publishing '.$get_index;
                 //print_r($_GET);
          if (isset($_GET[$get_index]) && $sparam['usr']!=463){//465 anonymous news
                    if ($_GET[$get_index]=='enable'){

                              //echo $this->sql_query;

                              $this->sql_query = "update $table_def[table] set $table_def[publish_property]='1' where $table_def[primary]='".$_GET[$get_index_id]."'";
                              //echo $this->sql_query;
                              $this->sql_execute();
                    }
                     if ($_GET[$get_index]=='disable'){

                              //echo $this->sql_query;
                              $this->sql_query = "update $table_def[table] set $table_def[publish_property]='0' where $table_def[primary]='".$_GET[$get_index_id]."'";
                              //echo $this->sql_query;
                              $this->sql_execute();
                    }

          }
       }
       if (false) {

       }else{


       //exit(1);
       $temp_set = array();
       $k = 0;

       foreach($fields as $keyf=>$f){
           $k++;
           if ($k==100)
              exit(1);
           if (isset($f['sql'])){
                $this->sql_query = $f['sql'];
                $this->sql_execute();
                while($temp_sql = $this->sql_fetch_row($this->sql_res)){
                        $k++;
                         if ($k==100)
                            exit(1);
                    $temp_set[$keyf][$temp_sql['0']]=$temp_sql['1'];
                    flush();
                }
           }
       }
//       exit(1);
       reset($fields);


      if (isset($table_def['paging'])){
           

      	   if (strpos($table_def['table'],',')!==false)
               list($main_table,$s_table) = explode(',',$table_def['table']);
           else    
               $main_table = $table_def['table'];

        if (isset($_GET['char']))
           $char_part = "where  $table_def[abc_navigator] regexp \"^($_GET[char]).*\"";
        else
                   $char_part = "";

        $where_part = "$char_part";


        if (isset($table_def['category_selector']))
           $category_part = " (games.id=\"$param[game]\" or \"$param[game]\"=\"0\" or \"$param[game]\"=\"-1\")";
        else
           $category_part = "";


           if (strlen($where_part)>0 and $category_part!="")
                $where_part .= " and ".$category_part;
           elseif($category_part!=""){
                $where_part .= "where ".$category_part;
           }


           if (strlen($where_part)>0 && ($char_part!="" || $table_def['where']!=''))
                $where_part .= " and ";
           elseif(isset($table_def['where']) && $table_def['where']!="")
                $where_part = " where ";


           $this->sql_query = "select count(".$table_def['primary'].") from $table_def[table] $where_part  $table_def[where]";
		   if(isset($table_def['sql'])){
			   $from_pos = strpos($table_def['sql'],'from');
			   if($from_pos===false){
				   //echo "*";
				   $from_pos = strpos($table_def['sql'],'FROM');
			   }
			   //echo $from_pos."--from_pos";
			   $sql_part = substr($table_def['sql'],$from_pos);
			   $this->sql_query = "select count(".$table_def['primary'].") ". $sql_part;
		   }
		   
           if (isset($_GET['adebug']))
                echo $this->sql_query;

           $this->sql_execute();
           $rows_count = $this->sql_result($this->sql_res,0);
           if ( isset($_GET['paging']) ){
              $first_limit = $_GET['paging']*$table_def['paging'];
              $second_limit = $table_def['paging'];
              $limit = "limit $first_limit,$second_limit";
           }else{
              $first_limit = 0;
              $second_limit = $table_def['paging'];
              $limit = "limit $first_limit,$second_limit";
           }
           $page_num = $rows_count/$table_def['paging'];
           $url = $_SERVER['REQUEST_URI'];

		   if(isset($table_def['url'])){
			   $r = strpos($table_def['url'],'&paging=');
			   if ($r!==false){
				  $url = substr($url,0,$r);
			   }

			   $r = strpos($table_def['url'],'?paging=');
			   if ($r!==false){
				  $url = substr($url,0,$r);
			   }
		   }
           if (strpos($url,'?')===false)
              $url_delimiter = '?';
           else
              $url_delimiter = '&';
           if (isset($_GET['paging']))
              $cur_page = $_GET['paging'];
           else
              $cur_page = 0;

              $pages_result = '<div align=left>&nbsp;'.$this->msg->PAGES.': ';
              $filtered_url = preg_replace('/&paging=[0-9]*/','',$url);
               $i =0;
               $i_out = $i+1;
               if ($i!=$cur_page)
                      $pages_result .= '<a href="'.$filtered_url.$url_delimiter.'paging='.$i.'">[ '.$i_out.' ]</a> ';
                   elseif($i_out!=0)
                      $pages_result .= '[ '.$i_out.' ]';

               $startp =  $cur_page-3;
               if ($startp<=0)
                   $startp = 1;
               $endp=$cur_page+4;
               if ($endp>=$page_num)
                   $endp = $page_num;
               
               for ($i=$startp;$i<$endp;$i++){
                   $i_out = $i+1;
                   if ($i!=$cur_page)
                      $pages_result .= '<a href="'.$filtered_url.$url_delimiter.'paging='.$i.'">[ '.$i_out.' ]</a> ';
                   elseif($i_out!=0)
                      $pages_result .= '[ '.$i_out.' ]';
               }
               $i = $page_num-1;
               //$i = intval($i);
               $i_out = $i+1;
              if (intval($i)!=$cur_page)
                      $pages_result .= '... <a href="'.$filtered_url.$url_delimiter.'paging='.intval($i).'">[ '.intval($i_out).' ]</a> ';
              elseif(intval($i_out)!=0)
                      $pages_result .= '[ '.intval($i_out).' ]';


              $pages_result .= '</div>';

       }else{
           $limit = '';
       }
  //echo abc navigator
  if (isset($table_def['abc_navigator']))
       $result .= $this->showABCNavigator($table_def['abc_navigator']);

  if (isset($table_def['category_selector']))
       $result .= $table_def['category_selector'];

  //echo paging support
  if (PAGES_TOP)
       $result .= $pages_result;
  if (isset($table_def['common_add_url']))
       $result .= "<div align=right><a href='$table_def[common_add_url]'><img src='admin/img/new.gif' width='32' height='32' border='0'>".$this->msg->ADD_URL."</a></div>";

   //$table_def['del_url']  = (isset($table_def['del_url'])) ? $table_def['del_url'] : '';
   $result .= '
  <script>
  function f($i)
  {
   document.getElementById($i).style.background="#D5F2E6";
  }
  function f1($i)
  {
   document.getElementById($i).style.background="#FFFFFF";
  }
  function del($id)
  {
     if(!confirm("'.$this->msg->ARE_YOU_SURE_TO_DELETE.'"))return;
     location.href="'.
     str_replace('__id__','"+$id+"',$this->getCommonURL(((isset($table_def['del_url'])) ? $table_def['del_url'] : ''), 0, 'del')).
     '";
  }
</script>';
       //include_once($system_path."modules/mass_delete.php");
       
       if (isset($table_def['mass_delete']) && $table_def['mass_delete']=1){
       	    $mdtable = $table_def['table'];
       	    if (strpos($mdtable,',')!==false){
       	    	list($mdtable,$dummy) = explode(',',$mdtable);
       	    }
       	    $mdsql_id = $table_def['primary'];
       	    if (strpos($mdsql_id,'.')!==false){
       	    	list($dummy,$mdsql_id) = explode('.',$mdsql_id);
       	    }
       		//MDeleteUpdate($mdtable,$mdsql_id,'','');
       }
       
       if (isset($table_def['mass_delete']) && $table_def['mass_delete']==1){
       	  $result .= formatMDeleteForm();
       }
       
       $result .= "<table autosize=\"1\" width=\"100%\" class=\"admin-table\" align=center border=0><tr class=\"admin-table-header-row\">";
       if (isset($table_def['actions_position']) && $table_def['actions_position']=='left'){
          $result .= "<th colspan=2 class=darkh></th>";
       }else
          $result .= "";


       //if (isset($table_def['caption_field'])){
       //        $caption_field = ",$table_def[caption_field]";
       //}
//  if (isset)
       if (isset($_GET['char']))
          $char_part = " $table_def[abc_navigator] regexp \"^($_GET[char]).*\"";
       else
          $char_part = "";


        if (isset($table_def['category_selector']))
           $category_part = " (games.id=\"$param[game]\" or \"$param[game]\"=\"0\" or \"$param[game]\"=\"-1\")";
        else
           $category_part = "";


        if (isset($where_part) && strlen($where_part)>0 and $category_part!="")

                $where_part .= " and ".$category_part;
           elseif($category_part!=""){
                $where_part .= "where ".$category_part;
           }


      if (isset($table_def['where'])){
         if ($char_part!='') $char_part.= " and ";
         $where_part = "where $char_part".$table_def['where'];
      }elseif($char_part != "")
         $where_part = "where $char_part";
      else
         $where_part = "";

      if ($where_part==''){
          if (isset($table_def['where'])){
              if ($category_part!='') $category_part.= " and ";
              $where_part = "where $category_part".$table_def['where'];
          }elseif($category_part != "")
              $where_part = "where $category_part";
          else
              $where_part = "";
      }

      if ($where_part!=''){
          if (isset($table_def['where'])){
              if ($category_part!='') $category_part.= " and ";
              $where_part .= " and $category_part".$table_def['where'];
          }elseif($category_part != "")
              $where_part .= "and $category_part";
          else
              $where_part .= "";
      }




      if (isset($_GET['sort']) && isset($_GET['ord'])){
         $order_part = "order by $_GET[sort] $_GET[ord]";
      }elseif(isset($table_def['order_by']))
         $order_part = "order by ".$table_def['order_by'];

       else
                 $order_part = "";


       $select_part = "";
       reset($fields);
       foreach($fields as $key=>$value){
            if (isset($value['sql']))
               continue;
            $select_part .= ",".$key;
       }

//       $result .= 'good heer';
  //     exit(1);

       if (isset($table_def['publish_property'])){
               $select_part .= ",$table_def[publish_property]";
       }
       if (isset($table_def['owner_property'])){
               $select_part .= ",$table_def[owner_property]";
       }
       if (isset($table_def['property_id'])){
               $select_part .= ",$table_def[property_id]";
       }
       foreach($fields as $key=>$value){
		   
                       $align = (isset($value['align'])) ? "a".$value['align'] : "aright my2";
					   $width = (isset($value['percent']) && $table_def['pdf']===true ) ?  $width = " width='$value[percent]%' " : "";
					   
					   $result .= (!isset($table_def['sortable']) || $table_def['sortable']!==false) ?
                           "<th $width class='darkh $align'><nobr>".$this->formatSortableCaption($value['caption'],$key)."</nobr> </th>"
				           : "<th $width class='darkh $align'><nobr>".$value['caption']."</nobr></th>";;

        }
		
       if (isset($table_def['actions_position']) && $table_def['actions_position']=='left'){
          $result .= "";
       }else
          $result .= "<th colspan=2 class=darkh></th></tr>";

       
       $this->sql_query = "select distinct ".$table_def['primary']."$select_part from $table_def[table] $where_part $order_part $limit";
	   
	   if(isset($table_def['sql'])){
			   $this->sql_query = $table_def['sql']." $limit";
	}
	   
       if (isset($_GET['red']))
            echo  $this->sql_query;
       if (isset($_GET['adebug']))
                echo $this->sql_query;

       $this->sql_execute();
       $n = $this->sql_num_rows($this->sql_res);
       $i = 0;

       //$result .=$n;
       //exit("GOOD");


       if (isset($table_def['publish_property'])){
       	  if (strpos($table_def['publish_property'],'.')!==false)
          			list($firstpart,$secondpart) = explode('.',$table_def['publish_property']);
          else	{		
               $firstpart = $table_def['publish_property'];
               $secondpart = '';
          }     
          if ($secondpart!='')
              $table_def['publish_property'] = $secondpart;
       }

        
       //echo $table_def['publish_property'];
       while($i<$n){
          $res = $this->sql_fetch_array($this->sql_res);
      

          if (PUBLISH_INVERTED && isset($table_def['publish_property'])) 
			  $res[$table_def['publish_property']] = 1-$res[$table_def['publish_property']];
          $result .= "\n\r<tr id=$i style=\"background:FFFFFF\" onmouseover=\"f($i)\" onmouseout=\"f1($i)\">";
          if (false && isRestrictedAccess($sparam['usr'])){
          	  $action_disabled_flag = 'disabled'; //all default actions disabled
          	  $edit_action_disabled_flag = 'disabled'; //all default actions disabled
          	  if ($res[$table_def['owner_property']]==$sparam['usr']) 
          	      $edit_action_disabled_flag = 'enabled'; //user can edit his own documents
          }else{
          	      $action_disabled_flag = 'enabled';//supeuser can do all
          }
          
          if (isset($table_def['actions_position']) && $table_def['actions_position']=='left'){
                   if (isset($table_def['prop_url']))
                       $result .= "<td class=dark>".$this->makeURL($table_def['prop_url'].'?item='.$res[0],$res[$table_def['property_id']],'property')."</td>";
                   if (isset($table_def['url']))
                       $result .= "<td class=dark>".$this->makeURL($table_def['url'],$res[0],'edit',$edit_action_disabled_flag)."</td>";
                   if (isset($table_def['add_url']))
                       $result .= "<td class=dark>".$this->makeURL($table_def['add_url'],$res[0],'add')."</td>";
                   if (isset($table_def['del_url']))
                       $result .= "<td class=dark>".$this->makeURL($table_def['del_url'],$res[0],'del',$action_disabled_flag)."</td>";
                   if (isset($table_def['publish_property'])){

                       if ($res[$table_def['publish_property']]==2)
                            $result .= "<td class=dark>disable</td>";
                       if ($res[$table_def['publish_property']]==1)
                            $result .= "<td class=dark>".$this->makeURL($_SERVER['REQUEST_URI'],$res[0],'disable',$action_disabled_flag)."</td>";
                       if ($res[$table_def['publish_property']]==0)
                            $result .= "<td class=dark>".$this->makeURL($_SERVER['REQUEST_URI'],$res[0],'enable',$action_disabled_flag)."</td>";
                   }else
                       $result .= "<td class=dark>&nbsp;</td>";
          }

          //$result .= "<td class=dark>";
          reset($fields);

          $cur_result_id  = 1;
          foreach($fields as $key=>$value){
               if (isset($value['sql'])){
                          //is there unsetted count for certain iteration?
//                          $result .='['.$key.']['.$res[$table_def['primary']].']';
                         //if (!isset($temp_set[$key][$res[$table_def['primary']]]))
                         if (!isset($temp_set[$key][$res[$table_def['primary']]]))
                           $item_count_to_show = '0';
                         else
                           $item_count_to_show = $temp_set[$key][$res[$table_def['primary']]];
                         $result .= "<td class=dark>$item_count_to_show</td>";
                         continue;
              }
          $align = (isset($value['align'])) ? "a".$value['align'] : "aright my3";
          $importance = ' class="dark '.$align.'" ';
          if (!isset($value['wrapper'])){
                 $func = 'transparent';
          }else{
                 $func = $value['wrapper'];
          }

		  if (isset($value['summary'])){
	
			  $this->summaries[$key] = (isset($this->summaries[$key])) ? $this->summaries[$key]+$res[$cur_result_id] : $res[$cur_result_id];
          }
		  
          if (isset($value['nonimportant']))
               $importance = ' class=nondark ';
		  $func  =  "wrapper_$func";
          $res[$cur_result_id] = htmlSpecialChars($res[$cur_result_id],ENT_QUOTES);
		  
		  
		  
               if (isset($table_def['publish_property'])){
                     if ($res[$table_def['publish_property']]==0)
                         $result .= "<td align=left class=disabled_dark>".$func($res[$cur_result_id],$res['0'])."</td>";
                     else{
                         if (!isset($value['nobr']))
                                $result .= "<td   $importance>".$func($res[$cur_result_id],$res['0'])."</td>";
                         else
                                $result .= "<td   $importance><nobr>".$func($res[$cur_result_id],$res['0'])."</nobr></td>";
                     }
           }else{
                if (!isset($value['nobr']))
                   $result .= "<td   $importance>".$func($res[$cur_result_id],$res['0'])."</td>";
                else
                   $result .= "<td   $importance ><nobr>".$func($res[$cur_result_id],$res['0'])."</nobr></td>";
           }
          $cur_result_id++;

          }
          if (false && isRestrictedAccess($sparam['usr'])){
          	  $action_disabled_flag = 'disabled'; //all default actions disabled
          	  $edit_action_disabled_flag = 'disabled'; //all default actions disabled
          	  if ($res[$table_def['owner_property']]==$sparam['usr']) 
          	      $edit_action_disabled_flag = 'enabled'; //user can edit his own documents
          }else{
          	      $action_disabled_flag = 'enabled';//supeuser can do all
          }
          
          if (isset($table_def['mass_delete']) && $table_def['mass_delete']=1){
       	  $result .= "<td class=dark>".formatMDeleteCheckbox($res[0])."</td>";
       }
          
          
          if (!isset($table_def['actions_position']) || $table_def['actions_position']=='right'){
                   if (isset($table_def['prop_url']))
                       $result .= "<td class=dark>".$this->makeURL($table_def['prop_url'].'?item='.$res[0],$res[$table_def['property_id']],'property')."</td>";
                   if (isset($table_def['url']))
                       $result .= "<td class=dark>".$this->makeURL($table_def['url'],$res[0],'edit',$edit_action_disabled_flag)."</td>";
                   if (isset($table_def['add_url']))
                       $result .= "<td class=dark>".$this->makeURL($table_def['add_url'],$res[0],'add')."</td>";
                   if (isset($table_def['del_url']))
                       $result .= "<td class=dark>".$this->makeURL($table_def['del_url'],$res[0],'del',$action_disabled_flag)."</td>";
                   
                   if (isset($table_def['publish_property'])){

                       if ($res[$table_def['publish_property']]==2)
                            $result .= "<td class=dark>disable</td>";
                       if ($res[$table_def['publish_property']]==1)
                            $result .= "<td class=dark>".$this->makeURL($_SERVER['REQUEST_URI'],$res[$table_def['primary']],'disable',$action_disabled_flag)."</td>";
                       if ($res[$table_def['publish_property']]==0)
                            $result .= "<td class=dark>".$this->makeURL($_SERVER['REQUEST_URI'],$res[$table_def['primary']],'enable',$action_disabled_flag)."</td>";
                   }
          }
          $result .=  "<tr>";
       $i++;
       }
	   
	   $result .=  "<tr>";
	   
	   $sum_present = false;
	   foreach($fields as $key=>$value){
		     if(isset($value['summary']))
					 $sum_present = true;
		   
	   }
	   $ijk = 0;
	   foreach($fields as $key=>$value){
		   
		      $ijk++;
			  
              $value['wrapper'] = isset($value['wrapper']) ? $value['wrapper']:false;
		      $align = (isset($value['align'])) ? "a".$value['align'] : "aright my4";
			  
			  if($ijk==1){
				 $result .= "<td class='summary $align'>Всего</td>";
				 continue;
			  }
			  
			  if(isset($value['summary']) && $value['summary']=='sum')
				$result .= "<td class='summary $align'>".$this->formatSum($key,$value['wrapper'])." </td>";
			  else
				$result .= "<td class='summary $align'>&nbsp;</td>";
			  

        }
		$result .=  "</tr>";
	   
	   
       $result .= "</table>";
       }//else show advanced table
if (isset($table_def['mass_delete']) && $table_def['mass_delete']=1){
       	  $result .= "<div align=right width=100% style='text-align:right'>".formatMDeleteButton("������� ����������","no_javascript")."</div>";
       }
  if (!PAGES_TOP && isset($table_def['paging']))
       $result .= $pages_result;


  //       echo $result;
//exit ('Done');
return $result;
  }
  function needUpdate(){
     if (isset($_POST['table_update']))
         return true;
     else
         return false;
  }
  function needDelete(){
     global $table_def;
     $get_prefix = '';
     if (isset($table_def['get_prefix']))
        $get_prefix = $table_def['get_prefix'];
     if (isset($_GET[$get_prefix.'delete']))
         return true;
     else
         return false;
  }
  function handleUpload($varname,$dest){


  $image_upload_path = $dest;
  //$image_upload_path = '../../images/downloads/';
  if(!empty($_FILES[$varname]['tmp_name']) && $_FILES[$varname][tmp_name] != "none")
        {

            if($_FILES[$varname][size] > (1000 * 1024))
            {
                $ERR.= "File is larger than &nbsp;1000&nbsp;Kbytes";
            }
            elseif(!strpos($_FILES[$varname][type],"gif") &&
                   !strpos($_FILES[$varname][type],"png") &&
                   !strpos($_FILES[$varname][type],"jpeg") &&
                   !strpos($_FILES[$varname][type],"jpg")
                   )
            {
                $ERR.= "File has wrong format(".$_FILES[$varname][type].")";
            }
            else
            {
                $photo_id = md5(uniqid(rand()));
                #// Create a TMP directory for this session (if not already created)
                #// Move uploaded file into TMP directory
                // really save this file
                if (strpos($_FILES[$varname][type],"gif"))
                                           $ext = ".gif";
                if (strpos($_FILES[$varname][type],"png"))
                                           $ext = ".png";
                if (strpos($_FILES[$varname][type],"jpeg"))
                                           $ext = ".jpeg";
                if (strpos($_FILES[$varname][type],"jpg"))
                                           $ext = ".jpg";
                $fname = $image_upload_path.$photo_id.$ext;

                if ( file_exists($fname) )
                           @unlink ($fname);
                $TMP = pathinfo($_FILES[$varname]['tmp_name']);
                if(strpos(PHP_OS,'WIN') !== false)
                    list($dummy,$tmpfile) = explode('\\',$TMP[basename]);

                //$result .="<b>".$image_upload_path.$tmpfile."</b>";
                $res = move_uploaded_file($_FILES[$varname]['tmp_name'],$image_upload_path.$tmpfile);
                copy ( $image_upload_path.$tmpfile, $fname );
                unlink($image_upload_path.$tmpfile);
                //move_uploaded_file($_FILES[userfile][tmp_name],
                //$fname);

             }
      return $photo_id.$ext;
  }else
      return "";
  }
  function Update($table_def,$fields){
      global $show_sql_fl;
           if (!is_array($table_def['unique']))
            $table_def['primary'] = $table_def['unique'];

      $i = 0;
      while(isset($_POST['id'.$i])){
           reset($fields);
           $str = "";
           $crc_str = "";
           foreach($fields as $key=>$value){

               if (isset($_POST[$key.$i]))
                    $val_to_insert = $_POST[$key.$i];
               else
                    $val_to_insert = '';

               if(!empty($_FILES[$key.$i]['tmp_name']) && $_FILES[$key.$i][tmp_name] != "none"){
                    $val_to_insert = $this->handleUpload($key.$i,$value['destination']);
               }
               if (isset($table_def['files']) && in_array($key,$table_def['files']) && $val_to_insert == '' )
                   continue;

               if (strlen($str)>0)
                  $str .= ",";
               //class_utils::red("<font color=red><br>".$value['type'].strpos(trim($val_to_insert),' ')."</font>");
               if ($value['type'] == 'varname' && strpos(trim($val_to_insert),' ')!==false){
                     $result .= "Warning: whitespaces are not allowed in $key field. Some rows are not changed";
                     continue;
                   }
               if ($value['type'] == 'boolean'){
                 $val_to_insert = ($val_to_insert=='ON')?1:0;
               }

               $str .= "$key='".$this->mySlashes($val_to_insert)."'";
               $crc_str .= $this->myStripSlashes($val_to_insert);
           }

           if (crc32($crc_str)!=$_POST['crc'.$i]){



               $this->sql_query = "update $table_def[table] set $str where $table_def[primary]='".$_POST['id'.$i]."'";
               if ($show_sql_fl)
                  echo($this->sql_query);
               $this->sql_execute();
           }
      $i++;
      }

      //adding new item
      $i = '_new';
      reset($fields);
      list($first_key,$value) = each($fields);
      reset($fields);
      $str = '';
      $str_values = '';
      $crc_str = "";
      $di = $first_key.$i;
      if ($_POST[$di]!=''){
          foreach($fields as $key=>$value){
            if (isset($_POST[$key.$i]))
                  $dummy1 = '';
            else
                  $_POST[$key.$i] = '';

            if(!empty($_FILES[$key.$i]['tmp_name']) && $_FILES[$key.$i][tmp_name] != "none"){
                    $val_to_insert = $this->handleUpload($key.$i,$value['destionation']);
            }
            if (isset($table_def['files']) && in_array($key,$table_def['files']) && $val_to_insert == '' )
                   continue;

            if (strlen($str)>0)
                 $str .= ',';
            if (strlen($str_values)>0)
                 $str_values .= ',';
            $str .= $key;
            if ($key['type'] == 'varname' && strpos(trim($_POST[$key.$i]),' ')!==false){
                     $result .= "Warning: whitespaces are not allowed in $key field. Not saved!";
                     return 0;
                   }

            if ($value['type'] == 'boolean'){
                 $_POST[$key.$i] = ($_POST[$key.$i]=='ON')?1:0;
            }

            $str_values .= "'".$this->mySlashes($_POST[$key.$i])."'";
            $crc_str .= $this->mySlashes($_POST[$key.$i]);
           }
       //$result .=$crc_str;
       //$result .='<br>'.crc32($crc_str)."=".$_POST['crc'.$i];
          if (crc32($crc_str)!=$_POST['crc'.$i]){
               $this->sql_query = '
               insert into  '.$table_def['table'].'('.$str.') values('.$str_values.')';
               if ($show_sql_fl)
                  $result .= $this->sql_query;
               $this->sql_execute();
          if ($this->garna_fl and isset($_GET['stid'])){
              //$this->sql_query = "update tbl_cats set c_empty_fl='1' where c_id='".$_GET['id']."'";
              //$this->sql_execute() or die(mysql_error());
          }
      }
      }

  }
  function Delete($table_def){
       if (!is_array($table_def['unique']))
            $table_def['primary'] = $table_def['unique'];


       $get_prefix = '';
       if (isset($table_def['get_prefix']))
          $get_prefix = $table_def['get_prefix'];

       $this->sql_query = "delete from $table_def[table] where $table_def[primary]='".$_GET[$get_prefix.'delete']."' limit 1";
       //$this->sql_query = "delete from $table_def[table] where $table_def[primary]='".$_GET['delete']."'";
       $this->sql_execute();
       //$this->red($this->sql_query);

  }
  function showEditTable($table_def,$fields,$err_array=false){
       if (!is_array($table_def['unique']))
            $table_def['primary'] = $table_def['unique'];
             if ($err_array!==false){
                     foreach($err_array as $error)
                         $result .= "<br><font color=red>$error</font>";
           }

       if (isset($table_def['where'])){
         $where_part = 'where '.$table_def['where'];
       }else
         $where_part = "";
      if (isset($table_def['order_by'])){
         $order_part = "order by ".$table_def['order_by'];
      }elseif(isset($_GET['sort']) && isset($_GET['ord']))
         $order_part = "order by $_GET[sort] $_GET[ord]";
      else
                 $order_part = "";


       $table_def['url'] = preg_replace("/delete=(\d)+[&]?/","",$table_def['url']);

       if (isset($table_def['paging'])){
           $this->sql_query = "select count(".$table_def['primary'].") from $table_def[table] $where_part";
           //echo $this->sql_query;
           myRed($this->sql_query);
           $this->sql_execute();
           $rows_count = $this->sql_result($this->sql_res,0);
           if ( isset($_GET['paging']) ){
              $first_limit = $_GET['paging']*$table_def['paging'];
              $second_limit = $table_def['paging'];
              $limit = "limit $first_limit,$second_limit";
           }else{
              $first_limit = 0;
              $second_limit = $table_def['paging'];
              $limit = "limit $first_limit,$second_limit";
           }
           $page_num = $rows_count/$table_def['paging'];
           $url = $table_def['url'];
           $r = strpos($table_def['url'],'&paging=');
           if ($r!==false){
              $url = substr($url,0,$r);
           }
           $r = strpos($table_def['url'],'?paging=');
           if ($r!==false){
              $url = substr($url,0,$r);
           }
           if (strpos($url,'?')===false)
              $url_delimiter = '?';
           else
              $url_delimiter = '&';
           if (isset($_GET['paging']))
              $cur_page = $_GET['paging'];
           else
              $cur_page = 0;
           $result .= '<center>'.$this->msg->PAGES.':';
           for ($i=0;$i<$page_num;$i++){
                      $i_out = $i+1;
               if ($i!=$cur_page)
                    $result .= '<a href="'.$url.$url_delimiter.'paging='.$i.'">[ '.$i_out.' ]</a> ';
               else
                    $result .= '[ '.$i_out.' ]';
           }
           $result .= '</center>';
       }else{
           $limit = '';
       }

       $result .= "<form action='$table_def[url]' method=POST ENCTYPE=\"multipart/form-data\">";
       $result .= "<table border=0><tr><th class=dark></th>";
       //if (isset($table_def['caption_field'])){
       //        $caption_field = ",$table_def[caption_field]";
       //}


       $select_part = "";
       reset($fields);
       foreach($fields as $key=>$value){
            $select_part .= ",".$key;
       }

       //$this->sql_query = "select * from $table_def[table] $where_part $order_part limit 0,$table_def[combine_by]";
       //$result .= $this->sql_query;
       //$this->sql_execute();
       //$n = $this->sql_num_rows($this->sql_res);
       foreach($fields as $key=>$value){
            //if (isset($value['show'])){
               //r($i=0;$i<$table_def['combine_by'];$i++){
             //      $show_part = $this->sql_num_rows($this->sql_res,$i,$value['show']);
             //      $result .= "<th class=dark>$value[caption] </th>";
               //}
            //}else
               $result .= "<th class=dark>".$this->formatSortableCaption($value['caption'],$key)." </th>";
        }
       $result .= "<th class=dark></th></tr>";


       //$result .="select ".$table_def['unique']."$select_part from $table_def[table] $where_part $order_part";
       $this->sql_query = "select ".$table_def['primary']."$select_part from $table_def[table] $where_part $order_part $limit";

       if (isset($_GET['adebug']))
           $result .=$this->sql_query;


       $this->sql_execute();
       $n = $this->sql_num_rows($this->sql_res);
       $i = 0;
       while($i<$n){
          $res = $this->sql_fetch_array($this->sql_res);

          $result .= "<tr>";

          $result .= "<td class=dark><input type=hidden name='id$i' value='".$res[$table_def['primary']]."'></td>";
          reset($fields);
          $crc_str = "";

          foreach($fields as $key=>$value){
               $res[$key] = htmlSpecialChars($res[$key],ENT_QUOTES);
               //$result .= "1";

               $crc_str .= $res[$key];
               //if (!isset($value['show']) && $first_fl){
               //   $first_fl =0;
               //   continue;
               //}
               if ($value['type']=='text' ){
                  $result .= "<td class=dark><input name='$key$i' type=text value='$res[$key]'></td>";
                  }
               if ($value['type']=='varname' ){
                  $result .= "<td class=dark><input name='$key$i' type=text value='$res[$key]'></td>";
                  }
               if ($value['type']=='zip'){
                  $result .= "<td class=dark><input size=7 name='$key$i' type=text value='$res[$key]'></td>";
                  }
               if ($value['type']=='file'){
                  $result .= "<td class=dark><input size=15 name='$key$i' type=file value='$res[$key]'></td>";
                  }
               if ($value['type']=='url'){
                      if ($res[$key]=='')    $vl = 'http://';
                          else $vl = $res[$key];

                  $result .= "<td class=dark><input size=40 name='$key$i' type=text value='$vl'></td>";
               }
               if ($value['type']=='mediumtext'){
                  $result .= "<td class=dark><input size=40 name='$key$i' type=text value='$res[$key]'></td>";
                  }
               if ($value['type']=='password'){
                  $result .= "<td class=dark><input name='$key$i' type=password value='$res[$key]'></td>";
                  }
               if ($value['type']=='hidden'){
                  $result .= "<td class=dark><input name='$key$i' type=hidden value='$res[$key]'></td>";
                  }
               if ($value['type']=='count'){
                  $result .= "<td class=dark><input size=3 width=3 name='$key$i' type=text value='$res[$key]'></td>";
                  }
               if ($value['type']=='blob'){
                  $result .= "<td class=dark><textarea cols=50 name='$key$i'>". $res[$key]."</textarea></td>";
                  }
               if ($value['type']=='country'){
                  $result .= "<td class=dark><select name='$key$i'>";
                  foreach($this->countries as $keyz=>$valuez){
                      if ($keyz!=$res[$key])
                          $result .= "<option value='$keyz'>$valuez</option>";
                      else
                          $result .= "<option selected value='$keyz'>$valuez</option>";
                      }
                  $result .= "</select></td>";
               }
               if ($value['type']=='set'){
                  $result .= "<td class=dark><select name='$key$i'>";
                  foreach($value['set'] as $keyz=>$valuez){
                      if ($keyz!=$res[$key])
                          $result .= "<option value='$keyz'>$valuez</option>";
                      else
                          $result .= "<option selected value='$keyz'>$valuez</option>";
                      }
                  $result .= "</select></td>";
                  }
               if ($value['type']=='boolean'){
                  //$result .= "<td class=dark><select name='$key$i'>";
                  $result .= "<td class=dark>";

                  //$cur_set['0'] = $this->msg->NO;
                  //$cur_set['1'] = $this->msg->YES;

                  //foreach($cur_set as $keyz=>$valuez){
                      if ($res[$key]==1)
                          $result .= "<input class='checkbox' checked name='$key$i' type='checkbox' value='ON'>";
                          //$result .= "<option value='$keyz'>$valuez</option>";
                      else
                          $result .= "<input class='checkbox' name='$key$i' type='checkbox' value='ON'>";
                          //$result .= "<option selected value='$keyz'>$valuez</option>";
                      //}
                  $result .= "</td>";
                  //$result .= "</select></td>";
                  }
          }
          if (strpos($table_def['url'],'?')===false)
            $delimiter = '?';
          else
            $delimiter = '&';

          $del_url = $table_def['url'].$delimiter."delete=".$res[$table_def['primary']];
          //if (isset($table_def['combine_by']) && $first_fl )
          $result .= "<td class=dark><a href='$del_url'>".$this->msg->DELETE_URL."</a>";
          //$result .="($crc_str)";
          $result .= "<input type=hidden name='crc$i' value='".crc32($crc_str)."'></td>";
          //if (isset($table_def['combine_by']) && ($i%$table_def['combine_by'])==0)
             //$result .= "";
          //else
          $result .= "<tr>";


       $i++;
       }
//new record
          $res = $this->sql_fetch_array($this->sql_res);
          $result .= "<tr><td class=dark>".$this->msg->ADD_URL."</td>";
          reset($fields);
          $crc_str = "";
          foreach($fields as $key=>$value){
               $crc_str .= "";
               if ($value['type']=='text'){
                  $result .= "<td class=dark><input name='$key"."_new' type=text value=''></td>";
                  }
               if ($value['type']=='varname'){
                  $result .= "<td class=dark><input name='$key"."_new' type=text value=''></td>";
                  }

               if ($value['type']=='file'){
                  $result .= "<td class=dark><input size=15 name='$key"."_new' type=file></td>";
                  }
              if ($value['type']=='zip'){
                  $result .= "<td class=dark><input size=7 name='$key"."_new' type=text value=''></td>";
                  }
               if ($value['type']=='mediumtext'){
                  $result .= "<td class=dark><input size=40 name='$key"."_new' type=text value=''></td>";
                  }
               if ($value['type']=='url'){
                  if ($res[$key]==''){
               $vl = 'http://';
               $crc_str .= "http://";
                      }else $vl = $res[$key];

                  $result .= "<td class=dark><input size=40 name='$key"."_new' type=text value='$vl'></td>";
               }
               if ($value['type']=='password'){
                  $result .= "<td class=dark><input name='$key"."_new' type=password value=''></td>";
                  }
               if ($value['type']=='hidden'){
                  $crc_str .= $value['value'];
                  $result .= "<td class=dark><input name='$key"."_new' type=hidden value='$value[value]'></td>";
                  }
               if ($value['type']=='count'){
                  $result .= "<td class=dark><input size=3 width=3 name='$key"."_new' type=text value=''></td>";
                  }
               if ($value['type']=='blob'){
                  $result .= "<td class=dark><textarea cols=50 name='$key"."_new'></textarea> </td>";
                  }
               if ($value['type']=='country'){
                  $result .= "<td class=dark><select name='$key"."_new'>";
                  foreach($this->countries as $keyz=>$valuez){
                          $result .= "<option value='$keyz'>$valuez</option>";
                      }
                  $result .= "</select></td>";
                  $crc_str .= "0";
               }
               if ($value['type']=='set'){
                  $result .= "<td class=dark><select name='$key"."_new'>";
                  $fir = 1;
                  foreach($value['set'] as $keyz=>$valuez){
                         if ($fir){
                            $crc_str .= $keyz;
                            $fir = 0;
                         }
                         $result .= "<option value='$keyz'>$valuez</option>";
                      }
                  $result .= "</select></td>";
                  }
                  if ($value['type']=='boolean'){
                     $result .= "<td class=dark>";//<select name='$key"."_new'>";

                     //$cur_set['0'] = $this->msg->NO;
                     //$cur_set['1'] = $this->msg->YES;
                     $fir = 1;
                     //foreach ($cur_set as $keyz=>$valuez){
                        //            if ($fir){
                        //                  $crc_str .= $keyz;
                        //                     $fir = 0;
                        //              }
                          if (isset($value['default']) && $value['default']==1){
                                    $checked = 'checked';
                          }else
                              $checked = '';
                          $result .= "<input class=checkbox $checked name='$key"."_new' type='checkbox' value='ON'>";
                          //$result .= "<option $checked value='$keyz'>$valuez</option>";
                     //}
//                     $result .= "</select></td>";
                     $result .= "</td>";
                   }


          }
          //$del_url = $table_def['url']."?delete=".$res[$table_def['unique']];
          //$result .= "($crc_str)";
          $result .= "<td class=dark><input type=hidden name='crc_new' value='".crc32($crc_str)."'></td></tr>";





  $result .= "</table>";
  $result .=  "<input name=\"table_update\" type=\"hidden\" value=\"YES\">
  <br><input type=\"submit\" value=\"".$this->msg->CHANGE."\">\n
  </form>";
return $result;
  }
//

  function isSent(){
     if (isset($_POST['form_sent']))
         return true;
     else
         return false;
  }

function validate($form_def,$fields)  {
   $validation_params = array();
   foreach($fields as $key=>$value){
          if ($value['type'] == 'hidden')
              continue;
                 if (isset($form_def['required'][$key]))
                  $temp['min'] = 1;
          else
                  $temp['min'] = 0;

          if ($value['type'] == 'text' || $value['type'] == 'mediumtext'){
                     $temp['type'] = 'text';

                  $temp['max'] = 255;
                  $temp['name'] = $value['caption'];
                  $validation_params[$key] = $temp;
              }
          if ($value['type'] == 'content'){
                     $temp['type'] = 'text';
                  $temp['max'] = 65555;
                  $temp['name'] = $value['caption'];
                  $validation_params[$key] = $temp;
              }
          if ($value['type'] == 'password'){
                     $temp['type'] = 'password';
                  $temp['max'] = 50;
                  $temp['name'] = $value['caption'];
                  $validation_params[$key] = $temp;
              }
          if ($value['type'] == 'zip'){
                     $temp['type'] = 'zip';
                  $temp['max'] = 50;
                  $temp['name'] = $value['caption'];
                  $validation_params[$key] = $temp;
              }
          if ($value['type'] == 'url'){
                     $temp['type'] = 'url';
                  $temp['max'] = 255;
                  $temp['name'] = $value['caption'];
                  $validation_params[$key] = $temp;
              }
          if ($value['type'] == 'country'){
                     $temp['type'] = 'text';
                  $temp['max'] = 255;
                  $temp['name'] = $value['caption'];
                  $validation_params[$key] = $temp;
              }
   }

   //$result .= _r($validation_params);
   $errors = $this->Validit($_POST,$validation_params);
   if (isset($form_def['unique']) && is_array($form_def['unique'])){
       if (isset($table_def['where']))
         $where_part = 'and '.$table_def['where'];
       else
         $where_part = '';
       foreach($form_def['unique'] as $value){
           $this->sql_query = "select * from $form_def[table] where $value='".$this->myStripSlashes($_POST[$value.'_new'])."' $where_part";
           $this->sql_execute();
           if ($this->sql_num_rows($this->sql_res)>0){
               $errors[] = $this->msg->SUCH." '".$fields[$value]['caption']."' ".$this->msg->ALREADY_EXIST;
           }
       }
   }
   if (count($errors)==0)
      return false;
   else
      return $errors;

  }
//default wrapper
 function showABCnavigator($order_by=''){
     $res = '';
     $english_chars = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
     $russian_chars = "АБВГДЕЖЗИЙКЛМНОПРСУФХЦЧШЩЭЮЯ";
     $ru  =  $_SERVER['REQUEST_URI'];
     $len = strlen($english_chars);
     $len_ru = strlen($russian_chars);
     if (strlen($order_by)>0)
         $order_by_args="&sort=$order_by&ord=asc";
     $res .= "<a href='$_SERVER[REQUEST_URI]$order_by_args&char=0|1|2|3|4|5|6|7|8|9' class=alfabet>0 - 9</a>  &nbsp;  ";
     for($i=0;$i<$len;$i++){
           $char = $english_chars[$i];
           $res .= "<a href='$_SERVER[REQUEST_URI]$order_by_args&char=$char' class=alfabet>$char</a> ";
     }
     $res .= '<br><br>';
     for($i=0;$i<$len_ru;$i++){
           $char = $russian_chars[$i];
           $res .= "<a href='$_SERVER[REQUEST_URI]$order_by_args&char=$char' class=alfabet>$char</a> ";

     }
     $res = preg_replace('/&paging=[0-9]*/','',$res);
         return '<center>'.$res.'<center>'."<table width='97%' border='0' cellspacing='0' cellpadding='0'>
         <tr>
         <td width='1'><img src='img/0.gif' width='25' height='1'></td>
         <td width='100%' bgcolor='#CBD1E7'><img src='img/0.gif' width='1'></td>
         </tr></table>\n";



 }
 function formatSortableCaption($str,$field){

     $url = $_SERVER['REQUEST_URI'];
     //echo '<br/><br/>'.$url;
     $url = $this->deleteArgument($url,'sort');
     //echo '<br/><br/>'.$url;
     $url = $this->deleteArgument($url,'ord');
     //echo '<br/><br/>'.$url;
     //exit("ok");
     if (!isset($_GET['sort']) || !isset($_GET['ord'])){
          return "<a href='$url&sort=$field&ord=desc'>$str</a>";
         }
     if ($field==$_GET['sort']){
             if (isset($_GET['sort']) && $_GET['ord']=="asc"){
                  return "<a href='$url&sort=$_GET[sort]&ord=desc'>$str ^</a>";
                 }
             if (isset($_GET['sort']) && $_GET['ord']=="desc"){
                  return "<a href='$url&sort=$_GET[sort]&ord=asc'>$str v</a>";
                 }
         }else{
         if (isset($_GET['sort']) && $_GET['ord']=="asc"){
                  return "<a href='$url&sort=$field&ord=desc'>$str </a>";
                 }
             if (isset($_GET['sort']) && $_GET['ord']=="desc"){
                  return "<a href='$url&sort=$field&ord=asc'>$str </a>";
                 }
     }
 }
 function deleteArgument($str,$argname){
   $start = strpos($str,'&'.$argname.'=');
   if ($start===false)
      return $str;
   $end = strpos($str,'&',$start+1);
   //echo "<font color=red>start [$start] end [$end]</font>";
   //if ($end===false) echo "false";

   $res = substr($str,0,$start);
   if ($end!==false)
      $res.= substr($str,$end);
   return $res;

}

  function categorySelector($url,$label,$caption,$sql,$current){

           $res = "<br/><form name=$label"."_filter method=GET>";
           $res .= "<input type='hidden' value='$url' name='page_id'>";

           $this->sql_query = $sql;
           $this->sql_execute();

             $res .= "<nobr><b>$caption&nbsp;&nbsp;</b><SELECT onchange='$label"."_filter.submit()' name='$label'>";
             if ($current==-1)
                  $res .= "             <OPTION value='-1' selected>---</OPTION>\n";
             else     
                  $res .= "             <OPTION value='-1'>---</OPTION>\n";
             while($sqlres = $this->sql_fetch_row($this->sql_res)){
                  $id = $sqlres['0'];
                  $name = $sqlres['1'];
                  $res .= "<OPTION value=$id";
                  if($id==$current)
                    $res .=  " selected ";
                  $res .= ">$name</OPTION>";
             }
             $res .= '</select></nobr></form>';
             return $res;
  }
  
  function formatSum($key, $wrapper){
	  
	  $func =  ($wrapper==false)? 'transparent' : $wrapper;
      $func = "wrapper_".$func;
	  
	  $r = $func($this->summaries[$key],0);
	  
	  
	  return $r;
	  
  }
}


 // $table = array('table' => "tbl_txt",
 // 'order_by' => "t_value desc"
 //            'where' => "t_c_id = '$ID'"
 //             'unique' => t_id
 //             'caption_field' => t_name
 //             'caption_name' => t_name
 //             'order' => t_value
 //             'url' => ../../admin/item/index.php?addon=textcatalog
//added nonimportand
//added wrapper (transparent default)
//added alone_add_url
?>