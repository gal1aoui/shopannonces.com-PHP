<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$key=urldecode(urldecode(secureValue($_GET['key'])));
$ui=secureValue($_REQUEST['ui']);
$nextpage=secureValue($_REQUEST['nextpage']);
$clsId=secureValue($_REQUEST['clsId']);

$option="";
	$date_fin_premium = secureValue($_REQUEST[date_fin_premium]);
	$date_fin_couleur = secureValue($_REQUEST[date_fin_couleur]);
	$date_fin_republication = secureValue($_REQUEST[date_fin_republication]);
	$date_fin_urgent = secureValue($_REQUEST[date_fin_urgent]);
	
if($date_fin_premium=="y"){
	$option="&date_fin_premium=".$date_fin_premium;
}
else if($date_fin_couleur=="y"){
	$option="&date_fin_couleur=".$date_fin_couleur;
}
else if($date_fin_republication=="y"){
	$option="&date_fin_republication=".$date_fin_republication;
}
else if($date_fin_urgent=="y"){
	$option="&date_fin_urgent=".$date_fin_urgent;
}



	$sql="update tbl_member set mem_status='Y' where register_key='".$key."' and mem_id='$ui'";
    db_query($sql) or die(mysql_error());
	
	$result_mem=db_query("select * from tbl_member where register_key='".$key."' and mem_id='".$ui."'");
	
	if($line_raw = mysql_fetch_array($result_mem)){
		@extract($line_raw);

		setcookie("memId", $line_raw['mem_id'], time() + (86400 * 30));
		setcookie("userId", $line_raw['user_id'], time() + (86400 * 30));
		setcookie("user_name", $line_raw['fname']." ".$line_raw['lname'], time() + (86400 * 30));
		setcookie("classi_email", $line_raw['user_id'], time() + (86400 * 30));
		
		if($nextpage=="edit-my-post.php"){
			header("Location:edit-my-post.php?clsId=$clsId");
			exit;
		}
		else if($nextpage=="my-account-classified-preview.php"){
			header("Location:my-account-classified-preview.php?clsId=$clsId".$option);
			exit;
		}
		else if($nextpage=="classified-preview.php"){
			header("Location:classified-preview.php?clsId=$clsId");
			exit;
		}
		else{
			Set_Display_Message("Votre Compte est activé avec succés....");
			header("Location:my-account-manage.php");
			exit;
		}
	}
	
?>