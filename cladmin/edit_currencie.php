<?php
$act=$_REQUEST['act'];
if($act=="Add_news"){	
	$sql="UPDATE tbl_currency SET
    curr_symbol = '$_REQUEST[curr_symbol]',   
    curr_code = '$_REQUEST[curr_code]',
    curr_value  = '$_REQUEST[curr_value]',
	up_date = '".CURR_DATE."' 
	WHERE curr_id='$_REQUEST[neID]' ";
	db_query($sql);	
	$_SESSION['site_admin_message']="Currency Updated Successfully.........";
	header("Location:land.php?file=manage_currencie");
	exit();
}

$sql_dis=db_query("select * from tbl_currency where curr_id =$_REQUEST[neID] and curr_base!= 'Yes' ");
$rw=mysql_fetch_array($sql_dis);
@extract($rw);
?>
<?=PageTitle('Update Currency'); ?>
<form name="form1" method="post" action="" onSubmit="return validateForm(this);">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="2" class="tdLabel"></td>
    </tr>
	 <tr align="right">
	   <td colspan="2" class="tdLabel"><a href="land.php?file=manage_currencie">Back To Listing Page</a></td>
    </tr>
	 
	 <tr>
		<td width="155" align="left" class="tdLabel"><strong>Symbol : * </strong></td>
	    <td width="813" align="left" ><input name="curr_symbol" type="text" id="NOBLANK~Please enter Symbol~DM~" size="50" value="<?=$curr_symbol;?>"></td>
	 </tr>
	 	
     <tr>
		<td width="155" align="left" class="tdLabel"><strong>Currency Code : * </strong></td>
	    <td width="813" align="left" ><input name="curr_code" type="text" id="NOBLANK~Please enter Currency Code~DM~" size="50" value="<?=$curr_code;?>"></td>
	 </tr>
	 
     <tr>
       <td align="left" class="tdLabel"><strong>Price/Value <strong>: * </strong></strong></td>
       <td align="left"><input name="curr_value" type="text" id="NOBLANK~Please enter Price/Value~DM~" size="50" value="<?=$curr_value;?>"></td>
     </tr>
	 
    <tr>
		<td class="tdLabel">&nbsp;</td>
	    <td align="left" class="tdData">&nbsp;</td>
    </tr>
	
    <tr>
      <td class="tdLabel">&nbsp;</td>
      <td align="left" class="tdData"><input type="submit" name="Submit" value="Submit">
      <input type="hidden" name="act" value="Add_news"></td>
    </tr>
  </table> 
</form>
