<?php
require_once("../includes/main.inc.php");
require_once("admin-function.php");
$inq_id=@$_REQUEST['id'];
$inq_info=db_query("select * from ".DB.".tbl_advertise where id='$inq_id'");
$inq_rw=mysql_fetch_array($inq_info);
$admin_comp=get_config_setting(2);
$admin_email=get_config_setting(3);
@extract($inq_rw);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Advertise Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<script language="JavaScript" type="text/javascript">
function val() {
	if(document.form1.subject.value == ""){
		alert("Please enter your subject")
		document.form1.subject.focus()
		return false;
	 }
	 
	 if(document.form1.msg.value == ""){
		alert("Please enter your Message.")
		document.form1.msg.focus()
		return false;
	 }
	 
}
</script>
<?php
$action=@$_REQUEST['action'];
if($action=='send'){
$to=$_REQUEST['to_email'];
$sub=@$_REQUEST['subject'];
$msg=@$_REQUEST['msg'];

        $ContactPerson="$admin_comp";
		$eMail="$admin_email";
		$headers = "From: $ContactPerson<$eMail> \n";
		$headers .= "Reply-To: $eMail \r\n";
		$headers .= "X-Mailer: PHP/". phpversion();
		$headers .= "X-Priority: 3 \n";
		$headers .= "MIME-version: 1.0\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\n";
         mail($to,$sub,$msg,$headers);
}
?>
<table width="90%" border="0" align="center" cellpadding="4"  cellspacing="1">
<tr bgcolor="#1588BB" class="white">
                  <td colspan="2" bgcolor="#CCCCCC" class="border_bot"><span class="b white"><strong> Advertise Details : </strong></span></td>
  </tr>
                <tr valign="top" class="border_bot">
                  <td width="25%" align="left" class="border_bot"><strong>Name: </strong></td>
                  <td width="75%" align="left" class="border_bot"><?php echo ucfirst($name);?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="left" class="border_bot"><strong>Company Name : </strong></td>
                  <td align="left" class="border_bot"><?php echo ucfirst($company_name);?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="left" class="border_bot"><strong>Email : </strong></td>
                  <td align="left" class="border_bot"><?php echo $email;?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="left" class="border_bot"><strong>Phone No: </strong></td>
                  <td align="left" class="border_bot"><?php echo $contact_no;?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="left" class="border_bot"><strong>Banner Position : </strong></td>
                  <td align="left" class="border_bot"><?php echo $banner_position;?></td>
                </tr>
                <?php if($image!="" && file_exists(SITE_FS_PATH."/uploaded_files/advertise/$image") ) { ?>
                <tr valign="top" class="border_bot">
                  <td align="left" class="border_bot"><strong>Banner : </strong></td>
                  <td align="left" class="border_bot">
				  <img src="../uploaded_files/advertise/<?php echo $image;?>" height="75" width="200"></td>
                </tr>
                <?php } ?>
                <tr valign="top" class="border_bot">
                  <td align="left" class="border_bot"><strong>URL : </strong></td>
                  <td align="left" class="border_bot"><?php echo $url;?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="left" class="border_bot">&nbsp;</td>
                  <td align="left" class="border_bot">&nbsp;</td>
                </tr>


				 <tr valign="top" class="border_bot">
				   <td align="left" class="border_bot"><strong>Comment:</strong></td>
				   <td align="left" class="border_bot"><?php echo $comments;?></td>
  </tr>
				 <tr valign="top" class="border_bot">
				   <td align="left" class="border_bot"><strong>Date:</strong></td>
				   <td align="left" class="border_bot"><?php echo $date;?></td>
  </tr>
				
                 <?php   if(isset($_REQUEST['ms'])){ ?>	
                 <tr valign="top" class="msg_dg">
				   <td colspan="2" align="left" class="msg_dg"> mail send successfully..........</td>
                </tr>
                <?php } ?>
				 <tr valign="top" class="border_bot">
				   <td colspan="2" align="right" class="border_bot">
<form name="form1" method="post" action="advertise_detail.php?ms=1&id=<?php echo $inq_id;?>" onSubmit="return val();">
				     <table width="100%" border="0" align="center">
                       <tr>
                         <td width="19%">* Subject :<b>
                         </b></td>
                       <td width="81%" align="left"><label>
                           <input name="subject" type="text" id="textfield" size="50">
                         </label></td>
                       </tr>
                       <tr>
                         <td>* Message</td>
                         <td align="left"><label>
                           <textarea name="msg" id="msg" cols="50" rows="8"></textarea>
                         </label></td>
                       </tr>
                       <tr>
                         <td align="center">&nbsp;</td>
                         <td align="left"><input type="submit" name="button" id="button" value="Send"> <b>
						    <input type="hidden" name="to_email" value="<?php echo $email;?>" />
                           <input type="hidden" name="action" value="send" />
                         </b></td>
                       </tr>
                       <tr>
                         <td align="left"><a href="#" onclick="window.close();"><img src="images/close-window.gif" width="95" height="24" border="0" /></a></td>
                         <td align="left">&nbsp;</td>
                       </tr>
                     </table>
                     </form>				   </td>
  </tr>
</table>
</body>
</html>
