<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$action=secureValue(@$_REQUEST['action']);
$subscribe_name=secureValue(@$_REQUEST['subscribe_name']);
$subscribe_email=secureValue(@$_REQUEST['subscribe_email']);
$req=secureValue(@$_REQUEST['req']);
$substatus=secureValue(@$_REQUEST['substatus']);
 if($action=='Add'){
     if($substatus==1){
		$sel=db_query("select * from ".DB.".tbl_newslattersubscriber where subscr_email='$subscribe_email'");
		$num=mysql_num_rows($sel);
		 if($num > 0){
			$update=db_query("update ".DB.".tbl_newslattersubscriber  set subscr_name='$subscribe_name',status='1' where subscr_email='$subscribe_email'");
			Set_Display_Message("Vous êtes déjà enregistrés pour recevoir nos lettres d'envoi.");
			header("Location:newsletter.php?req=ALREADYSUBSCRIBESUCCESS");
			exit();
		 }else{
			$ins=db_query("insert into ".DB.".tbl_newslattersubscriber(subscr_name,subscr_email,status) values('$subscribe_name','$subscribe_email','1')");
			 Set_Display_Message("Vous êtes déjà enregistrés pour recevoir nos lettres d'envoi.");
			header("Location:newsletter.php?req=SUBSCRIBESUCCESS");
			exit();
		}
	 }	 
	 if($substatus==0){
		$sel1=db_query("select * from ".DB.".tbl_newslattersubscriber  where subscr_email='$subscribe_email'");
		$num1=mysql_num_rows($sel1);
			if($num1 > 0){
			   $update1=db_query("update ".DB.".tbl_newslattersubscriber  set status='0' where subscr_email='$subscribe_email'");
			     Set_Display_Message("Votre requête pour vous désabonner a été envoyée avec succès.");
				header("Location:newsletter.php?req=UNSUBSCRIBESUCCESS"); 
			}else{
			 Set_Display_Message("Vous n'êtes pas enregistrés pour recevoir nos lettres d'envoi.");
				header("Location:newsletter.php?req=NOTSUBMEMBER");
				exit();
			}
	   }
	 
 }
?>