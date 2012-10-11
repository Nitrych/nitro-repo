<?php

function wrapper_transparent($str,$id){
		return $str;
	}
/*
function wrapper_prepare_period($date_start,$date_end){
	   //2012-08-01
	   list($y,$m,$d) = explode('-',$date_start);
	   $date_start = "$d/$m/$y";
	   
	   list($y,$m,$d) = explode('-',$date_end);
	   $date_end = "$d/$m/$y";
	   
	   return "$date_start - $date_end";
	   
}

function wrapper_decimal($str,$id){
	   $res = intval($str);
	   if($res == '' || $res===false)
		   $r = 0;
	   else
		$r = intval($str);
	   
	   return $r;
}

function wrapper_currency($str,$id){
	   
	   return "&#36;".money_format('%i', $str);
}

function wrapper_transaction_type($str,$id){
	   
       $res = ($str==0) ? "Cash Sale":"Account Sale";	   
	   return $res;
}
*/
?>
