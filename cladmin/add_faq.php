<?php
	require_once("../includes/main.inc.php");
	
$action=@$_REQUEST['action'];
$faq_quest=htmlentities(@$_REQUEST['faq_quest'],ENT_QUOTES);
$faq_ans=htmlentities(@$_REQUEST['faq_ans'],ENT_QUOTES);

$max_porder=db_query("select max(rec_order) from tbl_faq");
$max_res_order=mysql_fetch_array($max_porder);
$max_ord=$max_res_order[0]+1;

if($action=='Add'){
$selcat=db_query("select * from ".DB.".tbl_faq where faq_quest ='$faq_quest'");
$num=mysql_num_rows($selcat);
if($num==0){
		$ins=db_query("insert into ".DB.".tbl_faq (faq_quest,faq_ans,rec_order)
		 values('$faq_quest','$faq_ans','$max_ord')");
		 $_SESSION['site_admin_message']="FAQ Added Successfully.........";
		 
  } else {
   $_SESSION['site_admin_message']="FAQ Added Successfully.........";
  }  
	header("Location: land.php?file=manage_faq");
	exit();	
}
?>
<script language="javascript">
function validate()
 {
if(document.form1.faq_quest.value == "")
  {
   alert("Please enter faq question.")
   document.form1.faq_quest.focus()
   return false;
  }
  if(document.form1.category.value == "")
  {
   alert("Please enter faq Category.")
   document.form1.category.focus()
   return false;
  }
 }
</script>
<?php echo PageTitle('Add FAQ');?>
<div align="right"><a href="?file=manage_faq">Back to Faq Management</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">	
	<tr>
		<td width="183" valign="top" class="tdLabel">
		<b>FAQ Question :</b><font color="#FF0000">*</font></td>
	  <td width="575" align="left" class="tdData"><input type="text" name="faq_quest" size="90"></td>
	</tr>
	<tr>
		<td width="183" valign="top" class="tdLabel"><b>FAQ Answer:</b></td>
		<td width="575" class="tdData">
			<textarea cols="75" name="faq_ans" ></textarea>
		</td>
	 </tr>
	
	<tr>
		<td class="tdLabel">&nbsp;</td>
	  <td class="tdData"><input type="image" name="imageField" src="images/buttons/submit.gif" />
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