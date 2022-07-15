<?php
	require_once("../includes/main.inc.php");
	
$id=@$_REQUEST['id'];
$action=@$_REQUEST['action'];
if($action=='Add'){
 @extract($_POST);
 $ins=db_query("update tbl_manage_google_ads  set title='$title',cat_id='$category',google_ads='$ads' where id='$id'");
 $_SESSION['site_admin_message']="Ads Updated Successfully.........";
		 header("Location:land.php?file=manage_google_ads");
		 exit();
}

$selfaq=db_query("select * from tbl_manage_google_ads   where id='$id'");
$rw=mysql_fetch_array($selfaq);
?>
<?=PageTitle('Edit Google Ads');?>
<script language="javascript">
function validate()
 {
if(document.form1.title.value == "")
  {
   alert("Please enter your title.")
   document.form1.title.focus()
   return false;
  }
  if(document.form1.category.value == "")
  {
   alert("Please select Category.")
   document.form1.category.focus()
   return false;
  }
 if(document.form1.ads.value == "")
  {
   alert("Please enter google ads.")
   document.form1.ads.focus()
   return false;
  }

 }
</script>
<div align="right"><a href="?file=manage_google_ads">Back to Listing</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">
    <tr>
      <td width="183" valign="top" class="tdLabel"> <b>Title :</b><font color="#FF0000">*</font></td>
      <td width="575" align="left" class="tdData"><input type="text" name="title" size="70" value="<?php echo $rw['title'];?>"></td>
    </tr>
    <tr>
      <td valign="top" class="tdLabel"><strong>Category:</strong><font color="#FF0000">*</font></td>
      <td align="left" class="tdData"><select name="category">
       <?php echo Root_cat($rw[cat_id]);?>
      </select></td>
    </tr>
    <tr>
      <td width="183" valign="top" class="tdLabel"><b>Ads<strong>:</strong><font color="#FF0000">*</font></b></td>
      <td width="575" align="left" class="tdData"><textarea name="ads" cols="70" rows="10"><?php echo $rw['google_ads'];?></textarea></td>
    </tr>
    <tr>
      <td class="tdLabel">&nbsp;</td>
      <td align="left" class="tdData"><input type="image" name="imageField" src="images/buttons/submit.gif" />
          <span class="tdLabel">
          <input type="hidden" name="action" value="Add">
        </span></td>
    </tr>
    <tr>
      <td class="tdLabel">&nbsp;</td>
      <td  class="tdData">&nbsp;</td>
    </tr>
  </table>
</form>