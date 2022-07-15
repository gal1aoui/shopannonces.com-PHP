<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$action=@$_REQUEST['action'];
$subscribe_name=secureValue(@$_REQUEST['subscribe_name']);
$subscribe_email=secureValue(@$_REQUEST['subscribe_email']);
//$req=secureValue(@$_REQUEST['req']);
$substatus=secureValue(@$_REQUEST['substatus']);
 if($action=='Add'){
	 
     if($substatus==1){
		$sel=db_query("select * from tbl_newslattersubscriber where subscr_email='$subscribe_email'");
		$num=mysql_num_rows($sel);
		 if($num > 0){
			$update=db_query("update tbl_newslattersubscriber  set status='1' where subscr_email='$subscribe_email'");
			$msg2= "Vous êtes déjà enregistrés à la Newsletter.";			
		 }else{
			$ins=db_query("insert into tbl_newslattersubscriber(subscr_email,status) values('$subscribe_email','1')");
			$msg2="Vous êtes enregistrés pour recevoir notre Newsletter.";
		}
	 }	 
	 if($substatus==0){

		$sel1=db_query("select * from tbl_newslattersubscriber  where subscr_email='$subscribe_email'");
		$num1=mysql_num_rows($sel1);
			if($num1 > 0){
				$update1=db_query("update tbl_newslattersubscriber  set status='0' where subscr_email='$subscribe_email'");
				$msg2="Votre requète pour être enlevé de la Newsletter est en cours de transmission.";
			}else{
				$msg2="Vous n'êtes pas enregistrés à la Newsletter.";				
			}
	   }
	 
 }
 
 ?>
 
 <script type="text/javascript" language="javascript">
 var str;
 str=parent.document.getElementById("msg_new").innerHTML="<?php echo $msg2;?>";
 //alert(str); 
 </script>	 