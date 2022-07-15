<?php
require_once("../includes/main.inc.php");
require_once("admin-function.php");

$inq_id=@$_REQUEST['rID'];
$inq_info=db_query("select * from tbl_enquiry where rID='$inq_id'");
$inq_rw=mysql_fetch_array($inq_info);
@extract($inq_rw);

$mememail=$email;
$admin_email=get_config_setting(3);
$admin_comp=get_config_setting(2);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>Feedback Details</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
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
<?php
$action=@$_REQUEST['action'];
$to=$mememail;
$subject="$sub";
$sub=@$_REQUEST['subject'];
$msg=@$_REQUEST['msg'];

if($action=='send'){
	$ContactPerson="$admin_comp";
	$eMail=$admin_email;
	$headers = "From: $ContactPerson<$eMail> \n";
	$headers .= "Reply-To: $eMail \r\n";
	$headers .= "X-Mailer: PHP/". phpversion();
	$headers .= "X-Priority: 3 \n";
	$headers .= "MIME-version: 1.0\n";
	$headers .= "Content-Type: text/html; charset=UTF-8\n";
		
	//mail($to,$sub,$msg,$headers);
	sent_mail($to,$sub,$msg);
}
?>
<table width="90%" border="0" align="center" cellpadding="4"  cellspacing="1">
    <tr bgcolor="#1588BB" class="white">
        <td colspan="2" bgcolor="#CCCCCC" class="border_bot"><span class="b white"><strong> Enquiry Details : </strong></span></td>
    </tr>
    <tr valign="top" class="border_bot">
      <td width="21%" align="left" class="border_bot"><strong>Name: </strong></td>
      <td width="79%" align="left" class="border_bot"><?=ucfirst($name);?></td>
    </tr>
    <tr valign="top" class="border_bot">
      <td align="left" class="border_bot"><strong>Sujet : </strong></td>
      <td align="left" class="border_bot"><?=ucfirst($title);?></td>
    </tr>
    <tr valign="top" class="border_bot">
      <td align="left" class="border_bot"><strong>Email : </strong></td>
      <td align="left" class="border_bot"><?=$email;?></td>
    </tr>
    <tr valign="top" class="border_bot">
      <td align="left" class="border_bot">&nbsp;</td>
      <td align="left" class="border_bot">&nbsp;</td>
    </tr>

     <tr valign="top" class="border_bot">
       <td align="left" class="border_bot"><strong>Message:</strong></td>
       <td align="left" class="border_bot"><?=$message;?></td>
    </tr>
    
    <tr valign="top" class="border_bot">
        <td align="left" class="border_bot"><strong>Date:</strong></td>
        <td align="left" class="border_bot"><?=$date;?></td>
    </tr>
<?php 
if(isset($_REQUEST['ms'])){	?>
    <tr valign="top" class="msg_dg">
        <td colspan="2" align="left" class="msg_dg">mail sent successfully...............</td>
    </tr>
<?php } ?>
     <tr valign="top" class="border_bot">
       <td colspan="2" align="right" class="border_bot">
            <form name="form1" method="post" action="enquiry_detail.php?ms=1&rID=<?=$inq_id;?>" onSubmit="return val();">
                <table width="100%" border="0" align="center">
                <tr>
                    <td width="19%">* Subject :<b>
                    </b></td>
                    <td width="81%" align="left">
                        <label>
                        <input name="subject" type="text" id="textfield" size="50" value="RE: <?=ucfirst($title);?>" >
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>* Message</td>
                    <td align="left">
<label>
<textarea name="msg" id="msg" rows="10" cols="100">




------------------------------------------
<?=$message;?>
</textarea> 
</label>
                    </td>
                </tr>
                <tr>
                    <td align="center">&nbsp;</td>
                    <td align="left">
                        <input type="submit" name="button" id="button" value="Send">
                        <b>
                        <input type="hidden" name="action" value="send" />
                        </b>
                    </td>
                </tr>
                <tr>
                <td align="left"><a href="#" onclick="window.close();"><img src="images/close-window.gif" width="95" height="24" border="0" /></a></td>
                <td align="left">&nbsp;</td>
                </tr>
                </table>
            </form>
       </td>
    </tr>
</table>

</body>
</html>
