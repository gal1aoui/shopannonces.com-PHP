<?php
require_once("../includes/main.inc.php");
$state_id=@$_REQUEST['state_id'];
if(is_post_back()) {
	if($state_id!='') {
    	$check		=	checkAvailableRecord('tbl_state',"count(*)"," state_name='$state_name' And state_id!='$state_id' And state_country_id='$state_country_id' And state_status!='Delete' ");
	    if($check=="" or $check==0){
		  $oldfile	=	searchSingleRecord("tbl_state","state_img","state_id",$state_id); 
		   if($_FILES['state_img']['name']!='') {
			$state_img_1 = get_unique_file_name($_FILES['state_img']['name']);
			copy($_FILES['state_img']['tmp_name'], UP_FILES_FS_PATH."/state/".$state_img_1) or die("File is not uploaded");
		   }elseif($_POST['v_thumb_del']!='') {
			$state_img_1 	= '' ;
		   }elseif($statefile!=""){		   
		    $state_img_1	=	$statefile; 
		   }		
			$sql = "update tbl_state set state_name='$state_name',state_abbr='$state_abbr',state_img='$state_img_1' where state_id='$state_id'";
			//exit;
			 db_query($sql);
			 if($state_img_1!=$oldfile && $oldfile!=''){
				 @unlink(UP_FILES_FS_PATH."/state/".$oldfile);
			 }
			$state_img_1='';
			$_SESSION['site_admin_message']=" State has been updated successfully.";
		}else{			
		  $_SESSION['site_admin_message']="This State is already exist.";
   		}
	} else{
	    $condition		=	" state_name='$state_name' And state_country_id='220' And state_status!='Delete'";	
		$num			=	checkAvailableRecord('tbl_state','state_id',$condition);
			
		if($_FILES['state_img']['name']!='') {
			$state_img_1 = get_unique_file_name($_FILES['state_img']['name']);
			if(!copy($_FILES['state_img']['tmp_name'], UP_FILES_FS_PATH."/state/".$state_img_1)){
				set_session_msg(showUploadError($_FILES['state_img']['error']));
				exit;
			}
		}

		if($num==0){
			$order	=db_scalar("select max(state_order)+1 from tbl_state where state_country_id='220' And state_status!='Delete'");
			$sql 	= "insert into tbl_state set state_country_id='220', state_name='$state_name',state_abbr='$state_abbr',state_img='$state_img_1',state_order='$order' ";
			db_query($sql);
			$_SESSION['site_admin_message']="State has been added successfully.";
		}else{
			$_SESSION['site_admin_message']="This State is already exist.";
		}			
	}
	header("Location: land.php?file=manage_states");
	exit();	
}

if($state_id!='' && $state_id!=0) {
	$sql = "select * from tbl_state where state_id = '$state_id'";
	$result = db_query($sql);
	if ($line_raw = mysql_fetch_array($result)) {
		$line = ms_form_value($line_raw);
		@extract($line);
	}
}

?>
<?php echo PageTitle('Add/Edit State');?>
<script language="javascript">
function validate_state(obj){
	if(obj.state_name.value==""){
	alert("Please enter state name");
	return false;
	}
}
</script>
<div align="right">&laquo; <a href="land.php?file=manage_states"><strong> Back To Listing</strong></a></div> 
<form name="form1" method="post"  action="" onsubmit="return validate_state(this);" enctype="multipart/form-data">
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td colspan="2" align="center"><font color="#BB0000" ><strong> <?php echo $msg;?></strong></font></td>
    </tr>  
  
    <tr>
      <td valign="top"  class="bold">State Name<font color="red" >*</font>:</td>
      <td align="center" valign="top">:</td>
      <td align="left" valign="middle" class="tdLabel">
	  <input name="state_name" type="text" class="textfield" id="state_name" value="<?php echo @$state_name;?>" size="35"></td>
    </tr>
    
    <tr>
      <td valign="top"  class="bold">Abbrivation:</td>
      <td align="center" valign="top">:</td>
      <td align="left" valign="middle" class="tdLabel"><input name="state_abbr" type="text" class="textfield" id="state_abbr" value="<?php echo @$state_abbr;?>" size="35"  alt="NOBLANK~State Abbrivation~DM~"></td>
    </tr> 
    <!--
    <tr>
      <td valign="top"  class="bold">Image:</td>
      <td align="center" valign="top">:</td>
      <td align="left" valign="middle" class="tdLabel"> <?php if($state_img!=""){ 				
				 $state_img2 = UP_FILES_WS_PATH."/state/".$state_img;
				 if(LOCAL_MODE){
					$file_path	=	$state_img2;
						$sz		=   @getimagesize($file_path);	
						if($sz[0]>=100){  $width	=	100;}else{  $width	=	$sz[0];}
						if($sz[1]>=100){  $height	=	100;}else{  $height	=	$sz[1];}	
				  }else{
					 	$file_path		 =	show_thumb($state_img2,"100","100","width");
						$sz				 =  @getimagesize($file_path);	
						if($sz[0]>=100){  $width	=	100;}else{  $width	=	$sz[0];}
						if($sz[1]>=100){  $height	=	100;}else{  $height	=	$sz[1];}	
				  }
			if($file_path!=''){?>
			   <img src="<?php echo $file_path?>" border="0" width="<?php echo $width?>" height="<?php echo $height?>"><br>Delete <input type="checkbox" name="v_thumb_del" value="1"><br />
			<?php }?><input type="hidden" value="<?php echo $state_img;?>" name='statefile'>
		<?php }?><input name="state_img" id="state_img" type="file" class="textfield1"></td>
    </tr> 
	-->
		       
    <tr>
        <td colspan="3" align="left">&nbsp;</td>
    </tr>

    <tr>
        <td height="25" colspan="2" align="left">&nbsp;</td>
        <td height="25" align="left"><span class="title">
           	<input type="hidden" name="state_id" value="<?php echo $state_id?>">
			<input type="hidden" name="state_country_id" value="<?php echo $state_country_id?>">
            <input type="hidden" name="start" value="<?php echo $start?>">
            <input type="submit" name="Save"  value="Submit" class="btn_orange" />&nbsp;&nbsp;
            <input type="reset" name="reset"  value="Reset" class="btn_orange" />
          </span>
        </td>
   </tr>
 </table>
</form>