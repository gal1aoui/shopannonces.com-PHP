<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
if($_REQUEST['save_search']!="" && $_COOKIE['userId']!="" ){
    $link_url=$_REQUEST[str];
    $memId=$_COOKIE['memId'];    
	$key_word=secureValue($_REQUEST[keyword]);
	$catId1=intval($_REQUEST[cat_level_root]);
	$catId2=intval($_REQUEST[cat_level_one]);
	$catId3=intval($_REQUEST[cat_level_two]);
	$cityID=intval($_REQUEST[classi_city]);
	$stateID=intval($_REQUEST[classi_state]);
	$ad_id=intval($_REQUEST[ad_id]);
	$title=secureValue($_REQUEST[save_title]);	
     $sql_key_search="select save_title,keyword from tbl_save_search 
	 where status='Y' and mem_id ='$_COOKIE[memId]'and save_title ='$title'";
	 
    $rs_key=db_query($sql_key_search);
    $num=mysql_num_rows($rs_key);
 	if($num >0 ){
	  Set_Display_Message("Votre recherche existe déjà... ");
	  unset($_REQUEST['save_search']);
	  @header("Location:".$_SERVER['HTTP_REFERER']);
	   exit(); 
	}else{		
		$sql_save_search="INSERT INTO  `tbl_save_search` SET `mem_id` = '$memId',
		`save_title` = '$title',
		`keyword` = '$key_word',
		`ad_key` = '$ad_id',
		`catId` = '$catId1',
		`subcatId` = '$catId2',
		`sub_subcatId` = '$catId3',
		`state_id` = '$stateID',
		`city_id` = '$cityID',
		`link`= '$link_url', 
		`date` = '".MYSQL_DATE_TIME."',
		`status` = 'Y'";		
	     db_query($sql_save_search);
	     Set_Display_Message("Votre recherche a été sauvegardée avec succès.... ");
	     unset($_REQUEST['save_search']);
	     @header("Location:".$_SERVER['HTTP_REFERER']);
		 exit();
	}     	
}else{
$ref=$_SERVER['REQUEST_URI']; 
@header("Location:signin.php?ref=$ref");
exit(); 
}
?>