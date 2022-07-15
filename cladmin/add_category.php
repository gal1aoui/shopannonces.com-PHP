<?php
$action=@$_REQUEST['action'];
$cat_name=@$_REQUEST['cat_name'];
$cat_order=@$_REQUEST['cat_order'];
$cat_desc=@$_REQUEST['cat_desc'];
$Parent_id=isset($_REQUEST['parentId']) ? $_REQUEST['parentId']  : "0";
$title_page=($Parent_id > 0 ) ? "Sub Category" : "Category";

$max_cat_order=db_query("select max(cat_order) from tbl_category");
$max_order=mysql_fetch_array($max_cat_order);
$max_ord=$max_order[0]+1;

$sql_dupcat=db_query("select cat_name from tbl_category where cat_name ='$cat_name'and cat_parent='$Parent_id'");
if(mysql_num_rows($sql_dupcat) > 0 )
{
	$_SESSION['site_admin_message']=" Category name already exits ...";
	$dup=1;
}

if($action=='Add' && $dup!=1)
 {
 db_query("insert into tbl_category set cat_name ='$cat_name',cat_desc='$cat_desc',cat_order ='$max_ord',cat_parent='$Parent_id'");
	    $insid=mysql_insert_id();	
	    $_SESSION['site_admin_message']=" Category Added successfully....";
		header("Location:land.php?file=catalog&parentId=$Parent_id");  
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
	 
	 /*if(document.form1.file1.value == "")
      {
       alert("Please upload category image .")
       document.form1.file1.focus()
       return false;
     }
	 */
	  
  }
</script>
<?php echo PageTitle('Add Category'); ?>

<div align="left"><?php page_nav($Parent_id);?></div>	
<div align="right"><a href="?file=catalog">Back to <?php echo$title_page;?> List</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();" action="land.php?file=add_category">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="2" class="tdLabel"></td>
    </tr>
	 <tr>
	   <td width="333" class="tdLabel"><strong><?php echo$title_page;?> Name : <font color="#FF0000">*</font></strong></td>
	   <td width="643" align="left" ><input type="text" name="cat_name" id="cat_name" value="<?php echo $cat_name?>" /></td>
    </tr>
	<!--
     <tr>
       <td class="tdLabel"><strong><?php echo$title_page;?> Description : </strong></td>
       <td align="left" class="tdData"><label>
         <textarea name="cat_desc" id="cat_desc" cols="50" rows="8"><?=$cat_desc?></textarea>
       </label></td>
     </tr>
	 -->
    <tr>
		<td class="tdLabel">&nbsp;</td>
	  <td align="left" class="tdData"><input type="image" name="imageField" src="images/buttons/submit.gif" />
	  <input type="hidden" name="action" value="Add">
      <input type="hidden" name="parentId" value="<?php echo$_REQUEST['parentId'];?>">
</td>
    </tr>
  </table>
</form>
