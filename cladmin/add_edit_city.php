<?php
	require_once("../includes/main.inc.php");
	
if(is_post_back()) {
	if($city_id!='') {
    	$check		=	checkAvailableRecord('tbl_city',"count(*)"," city_name='$city_name' And city_id!='$city_id' And city_state_id='$city_state_id' And city_status!='Delete'");
	    if($check=="" or $check==0){
			 $sql = "update tbl_city set city_name='$city_name' where city_id = $city_id";
			 db_query($sql);			
			 $_SESSION['site_admin_message']="City has been updated successfully.";
			 header("Location: land.php?file=manage_city&city_state_id=$city_state_id&start=$start");
			 exit;
		}else{			
		    $_SESSION['site_admin_message']="This Sub Location is already exist.";
   		}
	} else{
	    $condition		=	" city_name='$city_name' And city_state_id='$city_state_id' And city_status!='Delete'";	
		$num			=	checkAvailableRecord('tbl_city','count(*)',$condition);		
		

		if($num==0){
			$order	=db_scalar("select max(city_order)+1 from tbl_city where city_state_id='$city_state_id' And city_status!='Delete'");
			$sql 	= "insert into tbl_city set city_state_id='$city_state_id', city_name='$city_name',city_order='$order' ";
			db_query($sql);
			 $_SESSION['site_admin_message']="City has been added successfully.";
			header("Location: land.php?file=manage_city&city_state_id=$city_state_id&start=$start");
			exit;
		}else{
			 $_SESSION['site_admin_message']="This City is already exist.";
		}			
	}
}

if($_REQUEST['city_id']!='' && $_REQUEST['city_id']!=0) {
	$sql = "select * from tbl_city where city_id = '$city_id'";
	$result = db_query($sql);
	if ($line_raw = mysql_fetch_array($result)) {
		$line = ms_form_value($line_raw);
		@extract($line);
	}
}
?>
<?php echo PageTitle('Add/Edit City');?>

<script language="javascript">
function validate_city(obj){
	if(obj.city_name.value==""){
	alert("Please enter city name");
	return false;
	}
}
</script>
<div align="right">&laquo; <a href="land.php?file=manage_city&city_state_id=<?php echo $_REQUEST[city_state_id];?>"><strong> Back To Listing</strong></a></div>
<form name="form1" method="post"  action="" onsubmit="return validate_city(this);" enctype="multipart/form-data">
  <table width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
      <td colspan="2" align="center"><font color="#BB0000" ><strong> <?php echo $msg?></strong></font></td>
    </tr>  
    <tr>
      <td valign="top"  class="bold">City Name<font color="red" >*</font>:</td>
      <td align="center" valign="top">:</td>
      <td align="left" valign="middle" class="tdLabel"><input name="city_name" type="text" class="textfield" id="city_name" value="<?php echo $city_name?>" size="35" ></td>
    </tr> 
    <tr>
        <td colspan="3" align="left">&nbsp;</td>
    </tr>

    <tr>
        <td height="25" colspan="2" align="left">&nbsp;</td>
        <td height="25" align="left"><span class="title">
            <input type="hidden" name="city_id" value="<?php echo $city_id?>">
            <input type="hidden" name="city_state_id" value="<?php echo $city_state_id?>">
            <input type="hidden" name="start" value="<?php echo $start?>">
            <input type="hidden" name="start" value="<?php echo $start?>">
            <input type="submit" name="Save"  value="Submit" class="btn_orange" />&nbsp;&nbsp;
            <input type="reset" name="reset"  value="Reset" class="btn_orange" />
          </span>
        </td>
   </tr>
 </table>
</form>