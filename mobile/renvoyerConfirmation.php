<!-- Histats.com  START (hidden counter)-->
<!--
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="web statistics"><script  type="text/javascript">
try {Histats.start(1,2681174,4,0,0,0,"");
Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img src="http://sstatic1.histats.com/0.gif?2681174&101" alt="web statistics" border="0"></a></noscript>
-->
<!-- Histats.com  END  -->

<?php

require_once("includes/main.inc.php");
require_once("front-functions.php");

$mail_content=get_config_setting(4);

$mem_id=$_SESSION['signin']['mem_id'];
$user_id=$_SESSION['signin']['user_id'];
$user_name=$_SESSION['signin']['lname'];

$action=$_POST['action'];
$msg2="";


if($action=="renvoyerEmailConfirmation"){
//	header("Location: ".$_SERVER['HTTP_REFERER']);


	
	/********** Send mail to member *****************/
	
				$link='<div style="text-align:center;">
					<a href='.REDIRECT_SERVER.'/activer.php?user_id='.$user_id.'&ui='.$mem_id.' style="font-family:Arial, sans-serif;padding:7px 15px;background-color:#86C222;color:#fff;font-size:14px;width:278px;border-radius:2px;border:solid 1px #86C222;text-decoration:none;text-align:center;height:15px;font-weight:bold;" target="_blank">Confirmer votre email</a>				
				</div>';
	
	$link1=REDIRECT_SERVER."/activer.php?user_id=$user_id&ui=$mem_id";  
	$email_subject	=	$user_name." Activez votre annonce";
	$server=$_SERVER['SERVER_NAME'];


	$mail_content=nl2br($mail_content);	
	//$body=html_mail_content($mail_content);
	$body=$mail_content;
	
	$body= '<table style="clear:both;border:1px solid #E3E3E3;border-radius:3px;max-width:622px;text-align:left;padding:10px 5px;width:100%;background-color:#ffffff;">
	<tbody>
	<tr>
	<td style="padding-left:10px;padding-right:10px;width:100%;">
	<div style="font-family:Arial, sans-serif;font-size:14px;color:#1b1a19;">
	'.$body.'
	</div></td></tr></tbody></table>
	<br>';
	
	$body			=	str_replace('{name}',$user_name,$body);
	$body			=	str_replace('{password}',$user_password,$body);
	$body			=	str_replace('{link}',$link,$body);		
	$body			=	str_replace('{link1}',$link1,$body);
	$body			=	str_replace('{server}',$server,$body);
	
	
	sent_mail($user_id,$email_subject,$body);
	setcookie("envoie_confirm_email", "Y", time() + (time()+120));
	

    $msg2="<p><urgent>Consultez vos emails pour confirmer votre adresse email et activer votre compte.<br>
				Si vous ne recevez pas l'email : vérifiez le dossier Spam ou Courrier indésirable de votre boite email.</urgent></p>";


header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
}
?>
