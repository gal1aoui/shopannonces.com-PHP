<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$action=@$_REQUEST['action'];
$email=@$_REQUEST['email'];
$admin_email=get_config_setting(3);
if(!filter_var($email, FILTER_VALIDATE_EMAIL))
	$email = '';
if($action=='Check' && !empty($email)){
  $seladmin=db_query("select * from tbl_admin where admin_email='$email' "); 
  $num=mysql_num_rows($seladmin);
   if($num > 0){
		$rs=mysql_fetch_array($seladmin);		
		$to=$rs['admin_email'];
		
		##################### Email send #########################		
			
		$eMail=$rs['admin_email'];;
		$ContactPerson="$admin_email";
		$eMail=$_REQUEST['email'];
		$headers = "From: $ContactPerson<$eMail> \n";
		$headers .= "Reply-To: $eMail \r\n";
		$headers .= "X-Mailer: PHP/". phpversion();
		$headers .= "X-Priority: 3 \n";
		$headers .= "MIME-version: 1.0\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\n";
		$contents="Hi,";		
		$contents = $contents ."\r\n";
		$contents = $contents ."\r\n";
		$contents = $contents ."Here is your login Details";
		$contents = $contents ."\r\n";
		$contents = $contents ."\r\n";
		$contents = $contents ."Login Id :".$rs['admin_username'];
		$contents = $contents ."\r\n";
		$contents = $contents ."Password :".$rs['admin_password']."<br>";
		$contents = $contents ."\r\n";
		$contents = $contents ."Thanks<br>";
		$contents = $contents ."\r\n";		
		$contents = $contents ."Admin<br>";
		$contents = $contents ."\r\n";
		$contents =nl2br($contents);
		$subject1= "Admin Login Details";
		mail($to,$subject1,$contents,$headers);
	    Set_Display_Message("Your password has been sent to your email");
		header("Location:admin_forgot_password.php");
		exit();
		 ##################### End ###################################3
	}else{
	  Set_Display_Message("Your email id does not exits in my database ");
	  header("Location:admin_forgot_password.php");
	  exit();
	}
} 
?>
<script type="text/javascript" src="js/validation.js"></script>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="77%" align="left" valign="top" bgcolor="#BAC3CD"><table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10" bgcolor="#BAC3CD">&nbsp;</td>
        <td width="720" bgcolor="#bac3cd"><img src="<?=$theem_img;?>/spacer.gif" alt="" width="1" height="1" /></td>
        <td width="10" bgcolor="#BAC3CD">&nbsp;</td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td bgcolor="#bac3cd">&nbsp;</td>
        <td>
		<form name="wedding" id="wedding" method="POST" action="" class="border" onsubmit="return validate(this);">
		<table width="100%" border="0" cellpadding="3" cellspacing="1">
          <tr align="center" bgcolor="#FFFFFF">
            <td colspan="3" bgcolor="#e8ebee" style="padding-left:15px; "><?=Display_Message();?></td>
            </tr>
          <tr bgcolor="#FFFFFF">
            <td colspan="3" align="right" style="padding-left:15px; ">&nbsp;</td>
            </tr>
          <tr bgcolor="#FFFFFF">
            <td width="39%" align="right" bgcolor="#e8ebee" style="padding-left:15px; ">Email ID</td>
            <td width="3%" align="center" bgcolor="#e8ebee">:</td>
            <td width="58%" bgcolor="#e8ebee"><input type="text" name="email" style="width:200px; "  id="NOBLANK~Please enter your email~DM~EMAIL~Please enter valid email~DM~"/></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td align="right" style="padding-left:15px; ">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td><input name="Submit" type="submit" class="but3" value="Submit" /> <span class="style-sml"><strong>
              <input type="hidden" name="action" value="Check" />
            </strong></span></td>
          </tr>
          <tr bgcolor="#FFFFFF">
            <td align="right" style="padding-left:15px; ">&nbsp;</td>
            <td align="center">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
        </table>
		</form>
		</td>
        <td bgcolor="#bac3cd">&nbsp;</td>
      </tr>
      <tr>
        <td bgcolor="#BAC3CD">&nbsp;</td>
        <td bgcolor="#bac3cd"><img src="<?=$theem_img;?>/spacer.gif" alt="" width="1" height="1" /></td>
        <td bgcolor="#BAC3CD">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
