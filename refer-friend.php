<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require_once("includes/main.inc.php");
require_once("front-functions.php");
$mail_content=get_config_setting(7);
$mail_content=nl2br($mail_content);	

$action       = secureValue(@$_REQUEST['action']);
$your_name    = secureValue(@$_REQUEST['your_name']);
$your_email   = secureValue(@$_REQUEST['your_email']);
$friend_name  = secureValue(@$_REQUEST['friend_name']);
$friend_email = secureValue(@$_REQUEST['friend_email']);
$clsId2=intval($_REQUEST['clsId']);

if($action=='Add'){
  $sel=db_query("select * from tbl_refer_friend  where friend_email='$friend_name'");
  $num=mysql_num_rows($sel);
	if($num==0){
	$ins=db_query("insert into tbl_refer_friend (your_name,your_email,friend_name,friend_email,status)   values('$your_name','$your_email','$friend_name','$friend_email','0')");
 }

/********** Send mail to member *****************/
		$link="<a href='http://$_SERVER[HTTP_HOST]/classified-details.php?clsId=".$clsId2."'>cliquez ici</a>";
		$email_subject	=	"Reference from ".$your_name."";
		
		$body=html_mail_content($mail_content);
		$body			=	str_replace('{friend_name}',$friend_name,$body);
		$body			=	str_replace('{your_name}',$your_name,$body);
		$body			=	str_replace('{link}',$link,$body);
		$email_to		=	$friend_email;
		$email_toname	=	$friend_name;
		
		sendMail($email_to,$emailto_name,$email_subject,$body,ADMIN_EMAIL,ADMIN_EMAIL,$html=true);	
					 
/*********** End of  Send mail to member ***************/ 	
      Set_Display_Message("Votre Message envoyé avec succès......");	
	  header("Location:classified-details.php?clsId=$clsId2");
	  exit();
}


require_once("header.inc.php");
?>

<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td valign="top" align="center">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td width="100%" valign="top" class="cate-border" bgcolor="#FFFFFF">
            <fieldset>
            <legend class="bg-heading">Référer à un ami:</legend>
            
            <div style="margin-top:5px;">
            <form name="frm2" method="post" action="refer-friend.php?clsId=<?php echo $clsId2;?>" onSubmit="return validate_refriend(this);">
            <table width="99%"  border="0" cellspacing="0" cellpadding="4">
            <tr align="left">
            <td colspan="2" class="border-bottom">
            <table width="100%"  border="0" cellspacing="0" cellpadding="0">
              
              <tr>
             <td width="726" height="25" class=" ar fs11" style="padding-left:5px;">( <span class="star">* </span>) obligatoire.</td>
              </tr>
              
            </table>
            </td>
            </tr>
            <tr>
            <td width="40%" align="right"><span class="star">*</span> Votre nom:</td>
            <td width="60%"><input type="text" name="your_name" style="width:200px;"/></td>
            </tr>
            <tr>
            <td align="right" class="bg-strip-color1"><span class="star">*</span>Votre Email ID :</td>
            <td class="bg-strip-color1"><input type="text" name="your_email" style="width:200px;"/></td>
            </tr>
            <tr>
            <td align="right"><span class="star">*</span> Nom de votre ami:</td>
            <td><input type="text" name="friend_name" style="width:200px;"/></td>
            </tr>
            <tr>
            <td align="right" class="bg-strip-color1"><span class="star">*</span>Email ID votre ami:</td>
            <td class="bg-strip-color1"><input type="text" name="friend_email" style="width:200px;"/></td>
            </tr>
            
            <tr>
            <td colspan="2" align="center" valign="top"><input name="Submit22" type="submit" class="button" value="Soumettre"/>
            &nbsp;
            <input name="Submit" type="reset" class="button" value="Anuller"/>
            <span class="style-sml">
            <input type="hidden" name="action" value="Add" />
            </span></td>
            </tr>
            </table>
            </form>
            
            </div>
            </fieldset>
        </td>
    </tr>
</table>

<?php require_once("footer.inc.php"); ?>