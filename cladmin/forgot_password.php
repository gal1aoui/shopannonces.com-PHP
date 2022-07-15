<?php
require_once("../includes/main.inc.php");
//require_once("../front-functions.php");
/* $action=@$_REQUEST['action'];
$email=@$_REQUEST['email'];
$admin_email=get_config_setting(3);
if($action=='Check'){
  $seluser=db_query("select * from ".DB.".tbl_member where email='$email'");
  $num=mysql_num_rows($seluser);
   if($num > 0){
		$rs=mysql_fetch_array($seluser);
		$fname=$rs['fname'];
		$lname=$rs['lname'];
		$to=$rs['email'];
		
		##################### Email send #########################
		$seladmin=db_query("select * from ".DB.".tbl_admin");
		$rw=mysql_fetch_array($seladmin);		
		$eMail=$rw['email'];
		$ContactPerson="$admin_email";
		$eMail=$_REQUEST['email'];
		$headers = "From: $ContactPerson<$eMail> \n";
		$headers .= "Reply-To: $eMail \r\n";
		$headers .= "X-Mailer: PHP/". phpversion();
		$headers .= "X-Priority: 3 \n";
		$headers .= "MIME-version: 1.0\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\n";
		$contents="Hi,";		
		$contents = $contents .$fname.' '.$lname;	
		$contents = $contents ."\r\n";
		$contents = $contents ."\r\n";
		$contents = $contents ."Here is your login Details";
		$contents = $contents ."\r\n";
		$contents = $contents ."\r\n";
		$contents = $contents ."Login Id :".$rs['user_id'];
		$contents = $contents ."\r\n";
		$contents = $contents ."Password :".$rs['upass']."<br>";
		$contents = $contents ."\r\n";
		$contents = $contents ."Thanks<br>";
		$contents = $contents ."\r\n";		
		$contents = $contents ."";	
		$contents = $contents ."";
		$contents = $contents ."\r\n";
		$contents =nl2br($contents);
		$subject1= "Login Details";
		mail($to,$subject1,$contents,$headers);
	    Set_Display_Message("Your password has been sent to your email");
		header("Location:forgot_password.php");
		exit();
		 ##################### End ###################################3
	}else{
	  Set_Display_Message("Your email id does not exits in my database ");
	  header("Location:forgot_password.php");
	  exit();
	}
} */

?>
<table width="98%" border="0" align="center" cellpadding="0" cellspacing="0">
      <tr>
        <td width="10"><img src="../images/top-left.gif" alt="" width="10" height="9" /></td>
        <td width="720" bgcolor="#bac3cd"><img src="../images/spacer.gif" alt="" width="1" height="1" /></td>
        <td width="10"><img src="../images/top-right.gif" alt="" width="10" height="9" /></td>
      </tr>
      <tr bgcolor="#FFFFFF">
        <td bgcolor="#bac3cd">&nbsp;</td>
        <td>
		<form name="wedding" id="wedding" method="POST" action="" class="border" onsubmit="return validate(this);">
		<table width="100%" border="0" cellpadding="3" cellspacing="1">
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
        <td><img src="../images/bot-left.gif" alt="" width="10" height="9" /></td>
        <td bgcolor="#bac3cd"><img src="../images/spacer.gif" alt="" width="1" height="1" /></td>
        <td><img src="../images/bot-right.gif" alt="" width="10" height="9" /></td>
      </tr>
    </table>