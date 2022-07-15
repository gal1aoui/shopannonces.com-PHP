<?php
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
<?php echo PageTitle('Update Setting Management');?>
<table width="100%" align="center">
		  	<tr><td>
			
    		 <form action="save_config.php" method="post" action="" enctype="multipart/form-data" name="form1" id="form1" onSubmit="return validate(this);">
        <table width="100%" align="center" border=0 cellpadding="0"  cellspacing="0" class="text">
    	<tr>
		<td  colspan="2"height="23"  align="right"><a href="land.php?file=config" class="redcolor">Back To Manage Settings</a></td>
		</tr>
		<tr><td height="23" colspan="2"></td></tr>
		<tr>
		  <td width="25%" height="23">&nbsp;&nbsp;Setting Name:</td>
		  <td height="23" align="left"><strong><?php echo ucfirst($config_name);?></strong></td>
	   </tr>
	   <tr>
		  <td height="23"  valign="top">&nbsp;&nbsp;Setting Value<?php echo ($config_id==1)?"($)":"";?>:</td>
		  <td height="23" align="left">
		  <?php if($config_id==1){ ?>
		  <input name="comp_logo" type="file"> &nbsp;&nbsp; Size: 422(width) x 118(high)
		  <?php }else{ ?> 
		  <textarea name="config_txt" cols="80" rows="15" class="textfield3" id="config_txt "><?php echo $config_txt?></textarea>
 <?php } ?>
 </td>
		  </tr>
		<tr>
		  <td height="23"    align="right">&nbsp;</td>
		  <td align="left"></td>
		  </tr>
		<tr>
		<td height="23"    align="right">
			<input type="hidden" name="config_id" value="<?php echo $config_id?>">		    </td>
			<td align="left"><input class="button" name="Save" type="submit" value="Update"></td>
		</tr>	
   </table>
    </form></td></tr>
</table>