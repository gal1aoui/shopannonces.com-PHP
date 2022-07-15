<?php
$act=$_REQUEST['act'];
if($act=="Add")
{	
$sql=db_query("update forum_responses set comments ='$_REQUEST[desc]' where replyID  =$_REQUEST[rID] ");	
	
	$_SESSION['site_admin_message']="Forum Topic Updated Successfully.........";
	  header("Location: ".$_SERVER['HTTP_REFERER']);
	  exit;
}
$sql_state=db_query("select * from forum_responses ");
$sql_dis=db_query("select * from forum_responses where replyID =$_REQUEST[rID] ");
$rw=mysql_fetch_array($sql_dis);
@extract($rw);

?>
<?=PageTitle('Edit Forum Reply '); ?>
<form name="form1" method="post" action="">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="2" class="tdLabel"></td>
    </tr>
	 <tr align="right">
       <td colspan="2" class="tdLabel">
	 <strong>&laquo; <a href="land.php?file=manage_forum_reply&topicID=<?=$topicID;?>">Back To List</a></strong></td>
    </tr>
	 <?php if($_REQUEST[type]=="US"){ ?>
	<? } ?>
     <tr>
       <td width="155" align="left" class="tdLabel"><strong>Description :</strong></td>
       <td width="813" align="left" class="tdData">
	   <textarea name="desc" cols="60" rows="10" id="address"><?=$comments;?></textarea></td>
     </tr>	

    <tr>
      <td class="tdLabel">&nbsp;</td>
      <td align="left" class="tdData"><input type="submit" name="Submit" value="Submit">
      <input type="hidden" name="act" value="Add"></td>
    </tr>
  </table>
</form>
