<?php
	require_once("../includes/main.inc.php");
$act=$_REQUEST['act'];
if($act=="Add")
{	
$sql=db_query("update forum_topics  set topicTitle ='$_REQUEST[title]',topicDesc ='$_REQUEST[desc]' where topicID  =$_REQUEST[topicID] ");	
	
	$_SESSION['site_admin_message']="Forum Topic Updated Successfully.........";
	/*header("Location:land.php?file=manage_forum");
	exit();*/
}
$sql_state=db_query("select * from forum_topics ");
$sql_dis=db_query("select * from forum_topics  where topicID =$_REQUEST[topicID] ");
$rw=mysql_fetch_array($sql_dis);
@extract($rw);

?>
<?php echo PageTitle('Edit Forum Topics '); ?>
<script language="javascript">
function validate()
 {
	 if(document.form1.title.value == "")
      {
       alert("Please enter topic title .")
       document.form1.title.focus()
       return false;
     }
	 
	 if(document.form1.desc.value == "")
      {
       alert("Please enter topic description .")
       document.form1.desc.focus()
       return false;
     }
	  
  }
</script>
<form name="form1" method="post" action="" onSubmit="return validate();">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="2" class="tdLabel"></td>
    </tr>
	 <tr align="right">
	   <td colspan="2" class="tdLabel"><strong>&laquo; <a href="land.php?file=manage_forum">Back To List</a></strong></td>
    </tr>
	 <?php if($_REQUEST[type]=="US"){ ?>
	 <tr>
	   <td align="left" class="tdLabel">&nbsp;</td>
	   <td align="left" >&nbsp;</td>
	 </tr>
	<?php } ?>
	 <tr>
		<td width="155" align="left" class="tdLabel"><strong>* Title :</strong></td>
	    <td width="813" align="left" >
		<input name="title" type="text" id="comp_name" size="50" value="<?php echo $topicTitle;?>"></td>
	 </tr>	
     <tr>
       <td align="left" class="tdLabel"><strong>* Description :</strong></td>
       <td align="left" class="tdData">
	   <textarea name="desc" cols="50" rows="6" id="address"><?php echo $topicDesc;?></textarea></td>
     </tr>	

    <tr>
      <td class="tdLabel">&nbsp;</td>
      <td align="left" class="tdData"><input type="submit" name="Submit" value="Submit">
      <input type="hidden" name="act" value="Add"></td>
    </tr>
  </table>
</form>
