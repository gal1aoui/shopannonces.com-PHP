<?php
	require_once("../includes/main.inc.php");
	
$action=@$_REQUEST['action'];
$faq_quest=htmlentities(@$_REQUEST['faq_quest'],ENT_QUOTES);
$faq_ans=htmlentities(@$_REQUEST['faq_ans'],ENT_QUOTES);

$max_cat_order=db_query("select max(help_order) from tbl_help");
$max_order=mysql_fetch_array($max_cat_order);
$max_ord=$max_order[0]+1;

if($action=='Add'){
$selcat=db_query("select * from ".DB.". tbl_help where help_quest ='$faq_quest'");
$num=mysql_num_rows($selcat);
if($num==0){
		$ins=db_query("insert into ".DB.". tbl_help(help_quest,help_ans,help_catid,help_order) values('$faq_quest','$faq_ans','$category','$max_ord')");
		 $_SESSION['site_admin_message']="Help Added Successfully.........";
		 header("Location:land.php?file=manage_help");
		 
  } else {
       $_SESSION['site_admin_message']="Help already Added Successfully.........";
       header("Location:land.php?file=manage_help");
	  
  }  
}
?>
<script language="javascript">
function validate() {
   if(document.form1.category.value == ""){
   alert("Please enter help Category.")
   document.form1.category.focus()
   return false;
    }
 if(document.form1.faq_quest.value == ""){
   alert("Please enter help question.")
   document.form1.faq_quest.focus()
   return false;
  }

 }
</script>
<?php echo PageTitle('Add Help');?>
<div align="right"><a href="?file=manage_help">Back To Help Management</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">	
	<tr>
	  <td valign="top" class="tdLabel"><input type="hidden" name="action2" value="Add">
        <b><b>Help</b> Category :</b><font color="#FF0000">*</font></td>
	  <td align="left" class="tdData"><select name="category" style="width:300px; ">
        <option value="">Select Category</option>
        <?php
	  $str="select * from tbl_help_category where cat_status='Y'";
	  $result=mysql_query($str) or die(mysql_error());
	  while($row=mysql_fetch_array($result))
	  {
	  ?>
        <option value="<?php echo$row[cat_id]?>">
        <?php echo$row[cat_name]?>
        </option>
        <?php }
	  ?>
      </select></td>
    </tr>
	<tr>
		<td width="183" valign="top" class="tdLabel">
		 <input type="hidden" name="action" value="Add">
		<b>Help Question :</b><font color="#FF0000">*</font></td>
	    <td width="575" align="left" class="tdData"><input type="text" name="faq_quest" size="90"></td>
	</tr>

	 <tr>
	   <td valign="top" class="tdLabel">&nbsp;</td>
	   <td class="tdData">&nbsp;</td>
    </tr>
	 <tr>
		<td width="183" valign="top" class="tdLabel"><b><b>Help</b> Answer:</b></td>
		<td width="575" class="tdData">
        	<textarea name="faq_ans" cols="40" rows="3" id="faq_ans"></textarea>
        </td>
	 </tr>
	
	 <tr>
	   <td class="tdLabel">&nbsp;</td>
	   <td class="tdData">&nbsp;</td>
    </tr>
    <tr>
		<td class="tdLabel">&nbsp;</td>
		<td class="tdData"><input type="image" name="imageField" src="images/buttons/submit.gif" /></td>
	</tr>
	<tr>
	<td class="tdLabel">&nbsp;</td>
	<td  class="tdData">&nbsp;</td>
	</tr>
  </table>
</form>