<?php
require_once("includes/main.inc.php");

$ref=($_SERVER['HTTP_REFERER']!="") ? $_SERVER['HTTP_REFERER'] :  "index.php";

if($_REQUEST['currId']!="" && $_COOKIE['curSymbol']!=''){
	$currId=intval($_REQUEST['currId']);
	$sql=db_query("select * from tbl_currency where curr_id=$currId");	
	if(mysql_num_rows($sql)>0){	
	      $rw=mysql_fetch_array($sql);
		  $_COOKIE['curSymbol'] =  $rw['curr_symbol'];
		  $_COOKIE['curValue']  =  $rw['curr_value'];
		  $_COOKIE['curId']     =   $rw['curr_id'];
		  $_COOKIE['cur_code']  =  	 $rw['curr_code'];
	}
header("location: $ref"); 
exit();
}else if($_COOKIE['curSymbol']=='' && $_COOKIE['curValue']==''){
	 $sql="select * from tbl_currency where curr_base='Yes'";
	 $rs=db_query($sql);
	 if(mysql_num_rows($rs) > 0 ){	
	    $res=mysql_fetch_array($rs);
		 $_COOKIE['curSymbol'] =  $res['curr_symbol'];
		 $_COOKIE['curValue']  =  $res['curr_value']; 
		 $_COOKIE['cur_code']  =  	 $rw['curr_code'];
	 }

}

?>