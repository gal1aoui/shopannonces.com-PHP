<?php

require_once("includes/main.inc.php");
require_once("front-functions.php");


$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_meta_tags','id','11');

require_once("header.inc.php");
require_once("arrays.inc.php");


$meta_titles="Renvoyer email confirmation à ".$_COOKIE['userId'];
$meta_desc="";
$meta_keywords="";


$mail_content=get_config_setting(4);

	$mem_id=$_COOKIE['memId'];
	$user_id=$_COOKIE['userId'];
	$user_name=$_COOKIE['user_name'];

$action=secureValue($_REQUEST['action']);
$msg2="";


if($action=="renvoyerEmailConfirmation"){

		$result_email=db_query("select * from tbl_member
								where 
									tbl_member.mem_id=".$mem_id);
		$line_email = mysql_fetch_array($result_email);
		@extract($line_email);

	
	/********** Send mail to member *****************/
	
	$link='<div style="text-align:center;">
		<a href="'.REDIRECT_SERVER.'/activer.php?key='.$register_key.'&ui='.$mem_id.'" style="font-family:Arial, sans-serif;display:inline-block;padding:5px 5px;background-color:#86C222;color:#fff;font-size:14px;width:150px;border-radius:2px;border:solid 1px #86C222;text-decoration:none;text-align:center;height:15px;" target="_blank">Confirmer votre email</a>				
	</div>';
	
	$link1=REDIRECT_SERVER.'/activer.php?key='.$register_key.'&ui='.$mem_id;  
	$faux_link='<strong><a href="'.REDIRECT_SERVER.'/activer.php?key='.$register_key.'&ui='.$mem_id.'&diff=1" style="color:#fff;" rel="nofollow">Choisir cette offre</a></strong>';  
	
	$email_subject	=	$user_name." Activez votre annonce";
	$server=$_SERVER['SERVER_NAME'];


	$mail_content=nl2br($mail_content);	
	$body=html_mail_content($mail_content);
	$body=$mail_content;
	
	$body			=	str_replace('{name}',$user_name,$body);
	$body			=	str_replace('{password}',$user_password,$body);
	$body			=	str_replace('{link}',$link,$body);		
	$body			=	str_replace('{link1}',$link1,$body);
	$body			=	str_replace('{faux_link}',$faux_link,$body);
	$body			=	str_replace('{server}',$server,$body);
	
	echo $body;
	
	sent_mail($user_id, $email_subject, $body);
	setcookie("envoie_confirm_email", "Y", time() + (time()+120));
	

    $msg2="<p><urgent>Consultez vos emails pour confirmer votre adresse email et activer votre compte.<br>
				Si vous ne recevez pas l'email : vérifiez le dossier Spam ou Courrier indésirable de votre boite email.</urgent></p>";
	
?>
<script type="text/javascript" language="javascript">
	var str;
	str=parent.document.getElementById("msg_new").innerHTML="<?php echo $msg2;?>";
	//alert(str);
</script>
<?php

header("Location: ".$_SERVER['HTTP_REFERER']);
exit();
}
?>
