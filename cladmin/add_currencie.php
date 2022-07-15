<?php
$act=$_REQUEST['act'];
$max_new_order=db_query("select max(rec_order) from tbl_currency ");
$max_order=mysql_fetch_array($max_new_order);
$max_ord=$max_order[0]+1;

if($act=="Add_news"){
    $sql="INSERT INTO tbl_currency  SET
    curr_symbol = '$_REQUEST[curr_symbol]',   
    curr_code = '$_REQUEST[curr_code]',
    curr_value  = '$_REQUEST[curr_value]',	
	rec_order = '$max_ord',up_date = '".CURR_DATE." ' ";
	db_query($sql);	
	$_SESSION['site_admin_message']="Currency Added Successfully.........";
	header("Location:land.php?file=manage_currencie");
	exit();
	
}
?>
<script language="javascript">
function validate(obj) {
	if(obj.curr_symbol.value == "") {
		alert("Please enter Symbol")
		obj.curr_symbol.focus()
		return false;
	}
	if(obj.curr_code.value == "") {
		alert("Please enter Currency Code")
		obj.curr_code.focus()
		return false;
	}
	
	if(obj.curr_value.value == "") {
		alert("Please enter Price/Value")
		obj.curr_value.focus()
		return false;
	}  
}
</script>
<?=PageTitle('Add Currency');?>
<form name="form1" method="post" action="" onSubmit="return validate(this);">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="2" class="tdLabel"></td>
    </tr>
	 <tr align="right">
	   <td colspan="2" class="tdLabel"><a href="land.php?file=manage_currencie">Back To Listing Page</a></td>
    </tr>
	 
	 <tr>
		<td width="155" align="left" class="tdLabel"><strong>Symbol : * </strong></td>
	    <td width="813" align="left" >
		<input name="curr_symbol" type="text" id="NOBLANK~Please enter Symbol~DM~" size="50"></td>
	 </tr>
	 <tr>
		<td width="155" align="left" class="tdLabel"><strong>Currency Code : * </strong></td>
	    <td width="813" align="left" ><input name="curr_code" type="text" id="NOBLANK~Please enter Currency Code~DM~" size="50"></td>
	 </tr>
	 
     <tr>
       <td align="left" class="tdLabel"><strong>Price/Value <strong>: * </strong></strong></td>
       <td align="left"><input name="curr_value" type="text" id="NOBLANK~Please enter Price/Value~DM~" size="50"></td>
     </tr>
	 
    <tr>
      <td class="tdLabel">&nbsp;</td>
      <td align="left" class="tdData"><input type="submit" name="Submit" value="Submit">
      <input type="hidden" name="act" value="Add_news"></td>
    </tr>
  </table>
     
</form>
