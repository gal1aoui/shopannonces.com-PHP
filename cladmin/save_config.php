<?php 
require_once("../includes/main.inc.php");

if(isset($_REQUEST['Save'])){
 @extract($_REQUEST);
 if($config_id!="" && $config_id=="1"){   
	$fileName=$_FILES['comp_logo']['name'];
	if($fileName!=''){
		$fileType = $_FILES['comp_logo']['type'];
		$fileTemp = $_FILES['comp_logo']['tmp_name'];
		$fileError = $_FILES['comp_logo']['error'];					
		$destLoc = '../uploaded_files/logo/'.$fileName;
	     if(move_uploaded_file($_FILES['comp_logo']['tmp_name'],$destLoc)){
		   $update=db_query("update tbl_config set config_txt ='$fileName' where config_id='$config_id'");
	       }
     }
	$_SESSION['site_admin_message']="Setting has been changed successfully.";
	header("Location: land.php?file=config");
	exit();	
}	 
 ############################ End ##########################################
 
 
   if($config_id!="" && $config_id!="0"){
	$check	=	db_scalar("select count(*) from tbl_config where config_id='$config_id' ");
		if($check!="" && $check!=0)	{
			$update	=	"Update tbl_config set config_txt ='$config_txt ' where config_id='$config_id'";			
			db_query($update) or die(mysql_error());
			$_SESSION['site_admin_message']="Setting has been changed successfully.";
			header("Location: land.php?file=config");
			exit();		
		}else{
  			$_SESSION['site_admin_message']="Setting is not exist.";
		}	
	}
}

if($_REQUEST['config_id']!=""){
	$sql	=	"select * from tbl_config where config_id='$_REQUEST[config_id]'";
	$result	=	db_query($sql) or die(mysql_error());
		if(mysql_num_rows($result)>0){
		  $row	=	mysql_fetch_assoc($result);
		  @extract($row);
		}
}
?>