<?php
	require_once("../includes/main.inc.php");
 if(isset($_REQUEST['parentId'])){
 $sql=db_query("select * from tbl_help_category where cat_id ='$_REQUEST[parentId]'") or die(mysql_error());
 $rw=mysql_fetch_array($sql);
 @extract($rw); 	 
 }
  
if($action=='Update'){
	$cat_name=$_REQUEST[cat_name];
db_query("update tbl_help_category set cat_name='$cat_name' where cat_id='$_REQUEST[parentId]' ");
$_SESSION['site_admin_message']=" Category Updated successfully....";
		header("Location: land.php?file=manage_help_category");
		exit();	
 }
?>
<script language="javascript">
function validate() {
		 if(document.form1.cat_name.value == "") {
		   alert("Please select category name.")
		   document.form1.cat_name.focus()
		   return false;
		 }	 
	  
  }
</script>
<?php echo PageTitle('Edit Help Category'); ?>
<div align="left"><?php echo page_nav($_REQUEST[parentId]);?></div>	
<div align="right"><a href="?file=manage_help_category">Back to Listing</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="3" class="tdLabel"></td>
    </tr>
	 <tr>
	   <td width="290" class="tdLabel"><strong>category Name : <font color="#FF0000">*</font></strong></td>
	   <td width="669" colspan="2" align="left" >
	  <textarea name="cat_name" cols="40" rows="3" id="cat_name"><?php echo $cat_name;?></textarea></td>
    </tr>   
    <tr>
		<td class="tdLabel">&nbsp;</td>
	  <td colspan="2" align="left" class="tdData"><input type="submit" name="sub" value="Update"/> 
	  <input type="hidden" name="action" value="Update"></td>
    </tr>
  </table>
</form>
