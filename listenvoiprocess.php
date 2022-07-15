<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$action=@$_REQUEST['action'];
$subscribe_email=secureValue(@$_REQUEST['subscribe_email']);
//$req=secureValue(@$_REQUEST['req']);
$substatus=secureValue(@$_REQUEST['substatus']);
$msg2="";
if($action=='Add'){
	 
	$sel1=db_query("select * from tbl_newslattersubscriber  where subscr_email='$subscribe_email'");
	$num1=mysql_num_rows($sel1);
	if($num1 > 0){
	   $update1=db_query("update tbl_newslattersubscriber set status='0' where subscr_email='$subscribe_email'");
		$msg2="Votre requète pour être enlevé de notre liste d'envoi est en cours de transmission.";
	}else{
	 //$msg2="Vous n'êtes pas enregistrés pour recevoir notre liste d'envoi.";
		$ins=db_query("insert into tbl_newslattersubscriber(subscr_email,status) values('$subscribe_email','0')");
		$msg2="Votre requète pour être enlevé de notre liste d'envoi est en cours de transmission.";		
	}
}
 
 ?>
 
<script type="text/javascript" language="javascript">
	var str;
	str=parent.document.getElementById("msg_new").innerHTML="<?php echo $msg2;?>";
</script>	 