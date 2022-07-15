<?php
	require_once("../includes/main.inc.php");
	
$act=$_REQUEST['act'];
if($_REQUEST[sp_id]!=""){
	$sql_dis=db_query("select * from tbl_spam_words where sp_id =$_REQUEST[sp_id]");
    $rw=mysql_fetch_array($sql_dis);
    @extract($rw);
 } 
 if($act=="updat"){
    $sql="UPDATE `tbl_spam_words` SET `words` = '$_REQUEST[word]',
   `status` = 'Y' WHERE `sp_id` =$_REQUEST[sp_id] ";
        db_query($sql);	
        $_SESSION['site_admin_message']="Record Updated Successfully.........";
	header("Location: land.php?file=manage_spam_words");
	exit();	
 }
 
if($act=="add"){
  $duplicate=db_query("select * from tbl_spam_words where words ='$_REQUEST[word]'");
	 if(mysql_num_rows($duplicate) > 0 ) {
	    $_SESSION['site_admin_message']="Spam Word Already Added ...";
	 }else{    
         $sql="Insert into `tbl_spam_words` SET `words` = '$_REQUEST[word]',
        `status` = 'Y' ";
         db_query($sql);	
         $_SESSION['site_admin_message']="Record Added Successfully.........";
		
	header("Location: land.php?file=manage_spam_words");
	exit();	
	 }
}  
?>
<?php echo PageTitle('Add/Edit Spam Words'); ?>
<form name="form1" method="post" action="add_edit_spam_words.php">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="2" class="tdLabel"></td>
    </tr>
	 <tr align="left">
	   <td colspan="2" class="tdLabel">&nbsp;</td>
     </tr>
	 
	 <tr>
		<td width="155" align="left" class="tdLabel"><strong>Word :</strong></td>
	    <td width="813" align="left" >
	 <input name="word" type="text" id="title" size="50" value="<?php echo $rw[words];?>"></td>
	 </tr>
    <tr>
		<td class="tdLabel">&nbsp;</td>
	    <td align="left" class="tdData">&nbsp;</td>
    </tr>
	
    <tr>
      <td class="tdLabel">&nbsp;</td>
      <td align="left" class="tdData">	 
	  <?php if($_REQUEST['sp_id']==""){ ?>
      <input type="hidden" name="act" value="add">
	  <input type="submit" name="Submit" value="Submit">
	  <?php }else{ ?>
	  <input type="hidden" name="act" value="updat">
	  <input type="hidden" name="sp_id" value="<?php echo $_REQUEST['sp_id']; ?>">
	  <input type="submit" name="Submit" value="Update">
	  <?php } ?>	  
	  </td>
    </tr>
  </table>
</form>
