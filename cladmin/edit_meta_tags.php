<?php
	require_once("../includes/main.inc.php");
	
$action=$_REQUEST['action'];
$page_name=htmlentities($_REQUEST['page_name'],ENT_QUOTES);
$diy_id=$_REQUEST['id'];
$page_content=htmlentities($_REQUEST['page_content'],ENT_QUOTES);
if($action=='Add'){

	//echo "update tbl_meta_tags set meta_title='$_REQUEST[meta_title]', meta_desc='$_REQUEST[meta_desc]', meta_keyword='$_REQUEST[meta_keyword]' where id='$diy_id'";
$meta_title=htmlentities($_REQUEST['meta_title'],ENT_QUOTES);
$meta_desc=htmlentities($_REQUEST['meta_desc'],ENT_QUOTES);
$meta_keyword=htmlentities($_REQUEST['meta_keyword'],ENT_QUOTES);

 $ins=db_query("update tbl_meta_tags
 				set `meta_title`='".$meta_title."',
					`meta_desc`='".$meta_desc."',
					`meta_keyword`='".$meta_keyword."'
					where id='".$diy_id."'");
 
  $_SESSION['site_admin_message']="Meta Tags Updated Successfully.........";  
   header("Location:land.php?file=manage_meta");
   exit();
}
$diy_id=@$_REQUEST['id'];
$seldiy=db_query("select * from tbl_meta_tags  where id='$diy_id'");
$rw=mysql_fetch_array($seldiy);
$page_content=html_entity_decode($rw['meta_desc']);
?>
<script language="javascript">
function validate()
 {
if(document.form1.page_name.value == "")
  {
   alert("Please enter page heading.")
   document.form1.page_name.focus()
   return false;
  }
 }
</script>
<?php echo PageTitle('Edit Meta Tags');?>
<div align="right"><a href="?file=manage_meta">Back to Page Content</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">	
	<tr>
	  <td valign="top" class="tdLabel">&nbsp;</td>
	  <td align="left" class="tdData">&nbsp;</td>
    </tr>
	<tr>
		<td width="183" valign="top" class="tdLabel">
	    <b>Page Name :</b><font color="#FF0000">*</font></td>
	  <td width="575" align="left" class="tdData">
	  <input type="text" name="page_name" size="30" value="<?php echo $rw['page_name'];?>" readonly="readonly"></td>
	</tr>
	 <tr>
	   <td valign="top" class="tdLabel">&nbsp;</td>
	   <td class="tdData">&nbsp;</td>
    </tr>
	 <tr>
	   <td valign="top" class="tdLabel"><strong>Meta Title : </strong></td>
	   <td align="left" class="tdData"><textarea name="meta_title" cols="50" rows="4"><?php echo $rw['meta_title'];?></textarea></td>
    </tr>
	 <tr>
	   <td valign="top" class="tdLabel"><strong>Meta Keyword : </strong></td>
	   <td align="left" class="tdData"><textarea name="meta_keyword" cols="50" rows="4"><?php echo $rw['meta_keyword'];?></textarea></td>
    </tr>
	 <tr>
	   <td valign="top" class="tdLabel"><strong>Meta Description : </strong></td>
	   <td align="left" class="tdData"><textarea name="meta_desc" cols="50" rows="4"><?php echo $rw['meta_desc'];?></textarea></td>
    </tr>
	 <tr>
	   <td valign="top" class="tdLabel">&nbsp;</td>
	   <td class="tdData">&nbsp;</td>
    </tr>

	<tr>
		<td class="tdLabel">&nbsp;</td>
	  <td align="left" class="tdData"><input type="image" name="imageField" src="images/buttons/submit.gif" />
		  <span class="tdLabel">
		  <input type="hidden" name="action" value="Add">
          <input type="hidden" name="diy_id" value="<?php echo $rw['pid'];?>">
	    </span></td>
	</tr>
	<tr>
	<td class="tdLabel">&nbsp;</td>
	<td  class="tdData">&nbsp;</td>
	</tr>
  </table>
</form>