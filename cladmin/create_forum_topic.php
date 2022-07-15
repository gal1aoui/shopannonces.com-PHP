<?php
	require_once("../includes/main.inc.php");
	require_once("admin-function.php");
$act=$_REQUEST['action'];

if(isset($_REQUEST["action"]) && ($act=="topic"))
{
   $post_type="admin";
   $rec_status= "Y";
	
	$query="insert into forum_topics set topicTitle='".$_POST['title']."', topicDesc='".$_POST['desc']."',recv_date=now(),topicType='".$post_type."',status='".$rec_status."'";

   db_query($query);
	
   $_SESSION['site_admin_message']="New Topic added successfully";
	//header("Location:land.php?file=manage_forum");
	//exit();
}
?>
<?php echo PageTitle('Create Forum Topics '); ?>
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
	   <td colspan="2" class="tdLabel">
		<strong>
			&laquo; <a href="land.php?file=manage_forum">Back To List</a>
		</strong>
		</td>
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
        <input type="hidden" name="action" value="topic"></td>
    </tr>
  </table>
</form>
