<?php
	require_once("../includes/main.inc.php");
	
$action=@$_REQUEST['action'];
if($action=='Add'){
        @extract($_POST);
		$ins=db_query("insert into ".DB.".tbl_offers(name,description,duration,cost,category)
		 values('$offer_name','$offer_description','$offer_duration','$offer_cost','$category')");
		 $_SESSION['site_admin_message']="Offer Added Successfully.........";
		 header("Location:land.php?file=offers");
		 exit();
  }

?>
<script language="javascript">
function validate()
 {
if(document.form1.offer_name.value == "")
  {
   alert("Please enter your offer name.")
   document.form1.offer_name.focus()
   return false;
  }
  if(document.form1.offer_duration.value == "")
  {
   alert("Please enter your Duration.")
   document.form1.offer_duration.focus()
   return false;
  }
  if(document.form1.offer_cost.value == "")
  {
   alert("Please enter your offer cost.")
   document.form1.offer_cost.focus()
   return false;
  }
  if(document.form1.category.value == "")
  {
   alert("Please select Category.")
   document.form1.category.focus()
   return false;
  }
 if(document.form1.offer_description.value == "")
  {
   alert("Please enter offer description.")
   document.form1.offer_description.focus()
   return false;
  }

 }
</script>
<?php echo PageTitle('Add Offer');?>

<div align="right"><a href="?file=offers">Back to Listing</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">	
	<tr>
		<td width="183" valign="top" class="tdLabel">
		<b>Offer Name :</b><font color="#FF0000">*</font></td>
	    <td width="575" align="left" class="tdData"><input type="text" name="offer_name" size="70"></td>
	</tr>

    <tr>
		<td width="183" valign="top" class="tdLabel">
		<b>Duration :</b><font color="#FF0000">*</font></td>
	    <td width="575" align="left" class="tdData"><input type="number" name="offer_duration" size="70"> Days</td>
	</tr>

    <tr>
		<td width="183" valign="top" class="tdLabel">
		<b>Cost :</b><font color="#FF0000">*</font></td>
	    <td width="575" align="left" class="tdData"><input type="number" name="offer_cost" size="70"> &#8364;</td>
	</tr>

	<tr>
	  <td valign="top" class="tdLabel"><strong>Category :</strong><font color="#FF0000">*</font></td>
	  <td align="left" class="tdData"><select name="category"><?php echo Root_cat();?></select></td>
    </tr>

	<tr>
		<td width="183" valign="top" class="tdLabel"><b>Offer Description <strong>:</strong><font color="#FF0000">*</font></b></td>
		<td width="575" align="left" class="tdData"><textarea name="offer_description" cols="70" rows="10"></textarea></td>
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