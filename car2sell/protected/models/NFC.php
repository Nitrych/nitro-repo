<?php

class NFC {
   static function setMessage($message,$error=false){
	   $_SESSION['nfc_site_message'] = $message;
	   $_SESSION['nfc_error'] = $error;
   }
   static function getMessage(){
	  if(isset($_SESSION['nfc_site_message'])){ 
		$res  =  $_SESSION['nfc_site_message'];
		unset($_SESSION['nfc_site_message']);
		return $res;
	  }  else {
		return "";  
	  }
	   
   }
   static function getError(){
	   if(isset($_SESSION['nfc_error'])){ 
		   $res = $_SESSION['nfc_error'];

		   unset($_SESSION['nfc_error']);
		   return $res;
	   }
	   else{
		   return "";
	   }
	   
   }
}
?>
