<?php
	require_once("../includes/main.inc.php");
	
$action=@$_REQUEST['action'];
$faq_quest=htmlentities(@$_REQUEST['faq_quest'],ENT_QUOTES);
$faq_ans=htmlentities(@$_REQUEST['faq_ans'],ENT_QUOTES);
$faq_id=@$_REQUEST['faq_id'];
if($action=='Add')
{
 $ins=db_query("update ".DB.".tbl_faq  set faq_quest='$faq_quest',faq_ans='$faq_ans'where faq_id='$faq_id'");
 $_SESSION['site_admin_message']="FAQ Updated Successfully.........";
		header("Location: land.php?file=manage_faq");
		exit();	
}
$faq_id=@$_REQUEST['faq_id'];
$selfaq=db_query("select * from ".DB.".tbl_faq  where faq_id='$faq_id'");
$rw=mysql_fetch_array($selfaq);
$faq_ans=html_entity_decode($rw['faq_ans']);   
?>
<?php echo PageTitle('Edit FAQ');?>
<script language="javascript">
function validate()
 {
if(document.form1.faq_quest.value == "")
  {
   alert("Please enter faq question.")
   document.form1.faq_quest.focus()
   return false;
  }
 }
</script>
<div align="right"><a href="?file=manage_faq">Back to Faq Management</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">	
	  <tr>
		<td width="183" valign="top" class="tdLabel">
	    <b>FAQ Question :</b><font color="#FF0000">*</font></td>
<td width="575" class="tdData">
<input type="text" name="faq_quest" size="90" value="<?php echo $rw['faq_quest'];?>" ></td>
	 </tr>	 
	 <tr>
		<td width="183" valign="top" class="tdLabel"><b>FAQ Answer:</b></td>
		<td width="575" class="tdData">
			<textarea cols="75" name="faq_ans" > <?php echo $rw['faq_ans'];?></textarea>
		</td>
	 </tr>	 
	<tr>
		<td class="tdLabel">&nbsp;</td>
		<td class="tdData"><input type="image" name="imageField" src="images/buttons/submit.gif" />
		  <span class="tdLabel">
		  <input type="hidden" name="action" value="Add">
          <input type="hidden" name="faq_id" value="<?php echo $rw['faq_id'];?>">
	    </span></td>
	</tr>
	<tr>
	<td class="tdLabel">&nbsp;</td>
	<td  class="tdData">&nbsp;</td>
	</tr>
  </table>
</form>