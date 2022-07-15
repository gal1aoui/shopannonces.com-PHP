<?php
	require_once("../includes/main.inc.php");
	require_once("admin-function.php");
	
	$clsd_img_id=$_REQUEST['clsd_img_id'];
	$clsId=$_REQUEST['clsId'];
	$_SERVER['PHP_SELF'];

	$sql_de=db_query("select * FROM `tbl_classified_image` WHERE clsd_img_id='$clsd_img_id'");
	$rw_del=mysql_fetch_array($sql_de);
	//echo $rw_del[cls_img_file];
	//exit;
	
	 $file_unlink="../uploaded_files/classified_img/".$rw_del[cls_img_file];  
	 if(file_exists($file_unlink)){
	 	@unlink($file_unlink);
	 }
	 
	 $sql_del="delete from `tbl_classified_image` where clsd_img_id='$clsd_img_id'";
	 db_query($sql_del);
		
	$_SESSION['site_admin_message']=" Delete successfully....";
	header("Location: classified_details.php?clsId=$clsId");
	exit();
?>