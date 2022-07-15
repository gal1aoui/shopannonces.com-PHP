<?php
require_once("../includes/main.inc.php");
require_once("admin-function.php");
$inq_id=@$_REQUEST['rID'];
$inq_info=db_query("select * from ".DB.".tbl_feedback where rID='$inq_id'");
$inq_rw=mysql_fetch_array($inq_info);
@extract($inq_rw);
$mememail=$email;
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>CL page Feedback Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<script language="JavaScript" type="text/javascript">
function val()
 {
	if(document.form1.subject.value == "")
	 {
		alert("Please enter your subject")
		document.form1.subject.focus()
		return false;
	 }
	 if(document.form1.msg.value == "")
	 {
		alert("Please enter your Message.")
		document.form1.msg.focus()
		return false;
	 }
 }

</script>
<?
$action=@$_REQUEST['action'];
$to=$mememail;
$subject="$sub";
$sub=@$_REQUEST['subject'];
$msg=@$_REQUEST['msg'];
if($action=='send'){
        $ContactPerson="clpage.com";
		$eMail="info@clpage.com";
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
                  <td width="100%" colspan="2" bgcolor="#CCCCCC" class="border_bot"><span class="b white"><strong> Private Message Reply : </strong></span></td>
  </tr>
				 <tr valign="top" class="msg_dg">
				   <td colspan="2" align="left" class="msg_dg">
				   <?php
				   if(isset($_REQUEST['ms'])){				   
				   echo "mail sent successfully...............";
				   }
				   ?></td>
  </tr>
				 <tr valign="top" class="border_bot">
				   <td colspan="2" align="right" class="border_bot">
        <form name="form1" method="post" action="feedback_detail.php?ms=1&rID=<?=$inq_id;?>" onSubmit="return val();">
				     <table width="100%" border="0" align="center">
                       <tr>
                         <td width="19%">* Subject :<b>
                         </b></td>
                       <td width="81%" align="left"><label>
                           <input name="subject" type="text" id="textfield" size="75">
                         </label></td>
                       </tr>
                       <tr>
                         <td>* Message</td>
                         <td align="left"><label>
                           <textarea name="msg" id="msg" cols="76" rows="10"></textarea>
                         </label></td>
                       </tr>
                       <tr>
                         <td align="center">&nbsp;</td>
                         <td align="left"><input type="submit" name="button" id="button" value="Send"> <b>
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
