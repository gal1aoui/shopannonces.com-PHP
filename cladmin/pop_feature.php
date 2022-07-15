<?php
 require_once("../includes/main.inc.php");
 require_once("admin-function.php");
$action=@$_REQUEST['action'];
$clsId=@$_REQUEST['id'];
$val=$_REQUEST['val'];
$feature_cls_amount=get_config_setting(9);
if($action=='Add'){
$days=$_REQUEST['exp_day'];
      $fet_expire_date=date('y-m-d',mktime(0,0,0,date('m'),date('d')+$days,date('Y')));;
	  $sql = "update tbl_classified SET classified_featured = '$_REQUEST[val]',feature_expired_date='$fet_expire_date',feature_admount='$feature_cls_amount'
	  where classified_id=$_REQUEST[clsId]";
	  db_query($sql);
	  $_SESSION['site_admin_message']="Classifieds has been $featured successfully.";
	  header("Location:land.php?file=manage_classified");
	  exit();
}
?>
<?=PageTitle('Set Featured Classified');?>
<script language="javascript">
function validate(){
  if(document.frm.day.value == "") {
      alert("Please enter expire time.")
      document.frm.day.focus()
      return false;
    }
 }
</script>
<form name="frm" method="post"  action="pop_feature.php" onSubmit="return validate();">
  <table width="400"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">	
	  <tr>
		<td width="183" valign="top" class="tdLabel">
	    <b>Expire Time  :</b><font color="#FF0000">*</font></td>
<td width="575" class="tdData">
<input type="text" name="exp_day" size="20"> 
( Days ) </td>
	 </tr>	 
	  <tr>
	    <td valign="top" class="tdLabel">&nbsp;</td>
	    <td class="tdData">&nbsp;</td>
    </tr>
	<tr>
		<td class="tdLabel">&nbsp;</td>
		<td class="tdData"><input type="image" name="imageField" src="images/buttons/submit.gif" />
		  <span class="tdLabel">
		  <input type="hidden" name="action" value="Add">
          <input type="hidden" name="clsId" value="<?=$clsId;?>">
		  <input type="hidden" name="val" value="<?=$val;?>">
	    </span></td>
	</tr>
  </table>
</form>