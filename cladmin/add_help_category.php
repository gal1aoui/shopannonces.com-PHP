<?php
	require_once("../includes/main.inc.php");
	
$action=@$_REQUEST['action'];
$cat_name=$_REQUEST['cat_name'];
$cat_order=$_REQUEST['cat_order'];
$cat_desc=$_REQUEST['cat_desc'];
$max_cat_order=db_query("select max(cat_order) from tbl_help_category");
$max_order=mysql_fetch_array($max_cat_order);
$max_ord=$max_order[0]+1;
if($action=='Add') {
 db_query("insert into ".DB.".tbl_help_category set cat_name ='$cat_name',cat_order ='$max_ord'");		
$_SESSION['site_admin_message']=" Category Added successfully...."; 
		header("Location: land.php?file=manage_help_category");
		exit();	
 }
?>
<script language="javascript">
function validate()
 {
	 if(document.form1.cat_name.value == "")
      {
       alert("Please select category name.")
       document.form1.cat_name.focus()
       return false;
     } 
  }
</script>
<?php echo PageTitle('Add Help Category'); ?>	
<div align="right"><a href="?file=manage_help_category">Back to Listing</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="2" class="tdLabel"></td>
    </tr>
	 <tr>
	   <td class="tdLabel"><strong><?php echo $title_page;?> Name : <font color="#FF0000">*</font></strong></td>
	   <td align="left" ><textarea name="cat_name" cols="40" rows="3" id="cat_name"></textarea></td>
    </tr>	
    <tr>
	<td class="tdLabel">&nbsp;</td>
	  <td align="left" class="tdData"><input type="image" name="imageField" src="images/buttons/submit.gif" />
	  <input type="hidden" name="action" value="Add">
	  </td>
    </tr>
  </table>
</form>
