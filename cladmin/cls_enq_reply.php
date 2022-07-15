<?php
require_once("../includes/main.inc.php");
require_once("admin-function.php");
$comp_name=get_config_setting(2);
	
$inq_id=@$_REQUEST['clsId'];
$inq_info=db_query("select classified_poster_email  from  tbl_classified  where classified_id='$inq_id'");
$inq_rw=mysql_fetch_array($inq_info);
@extract($inq_rw);
$admin_email=get_config_setting(3);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo SITE_NAME;?> page Feedback Details</title>
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
	 
	 
 }

</script>
<?php
$action=$_REQUEST['action'];
if($action=='send'){
	$to=$_REQUEST['to_email'];
	$sub=$_REQUEST['subject'];
	$msg=$_REQUEST['msg'];
	
	$ContactPerson=$comp_name;
	$eMail=$admin_email;
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
    	<td width="100%" colspan="2" bgcolor="#CCCCCC" class="border_bot"><span class="b white"><strong> Send Reply: </strong></span></td>
    </tr>
    
    <?php
    if(isset($_REQUEST['ms'])){	?>
    <tr valign="top" class="msg_dg">
    	<td colspan="2" align="left" class="msg_dg">mail sent successfully...............</td>
    </tr>
    <?php } ?>
    <tr valign="top" class="border_bot">
    	<td colspan="2" align="right" class="border_bot">
    	<form name="form1" method="post" action="cls_enq_reply.php?ms=1" onSubmit="return val();">
            <table width="100%" border="0" align="center">
                <tr>
                    <td width="19%">* Subject :</td>
                    <td width="81%" align="left">
                        <label>
                        <input name="subject" type="text" id="textfield" size="50">
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;</td>
                    <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td>* Message</td>
                    <td align="left">
                    	<label><textarea name="msg" cols="50" rows="5" ></textarea></label>
                    </td>
                </tr>
                <tr>
                    <td align="center">&nbsp;</td>
                    <td align="left">&nbsp;</td>
                </tr>
                <tr>
                    <td align="center">&nbsp;</td>
                    <td align="left"><input type="submit" name="button" id="button" value="Send Reply">
                    	<b>
                            <input type="hidden" name="action" value="send" />
                            <input type="hidden" name="to_email" value="<?php echo $classified_poster_email;?>" />
                        </b>
                    </td>
                </tr>
                <tr>
                    <td align="left">
                    	<a href="#" onclick="window.close();"><img src="images/close-window.gif" width="95" height="24" border="0" /></a>
                    </td>
                    <td align="left">&nbsp;</td>
                </tr>
            </table>
    	</form>
        </td>
    </tr>
</table>
</body>
</html>
