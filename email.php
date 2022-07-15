<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$mail_content=get_config_setting(4);
$mail_content=nl2br($mail_content);	


						$link="<a href='http://".$_SERVER['HTTP_HOST']."/activer.php?id=$mem_id' style='color:#FF0000; text-decoration:none;'>
									<b>Cliquez ici</b>
								</a>";
						$link1="http://".$_SERVER['HTTP_HOST']."/activer.php?id=$mem_id";  
						$email_subject	=	"Activation, Ceci n'est pas un SPAM! Registration";
						
$body=html_mail_content($mail_content);


						$body			=	str_replace('{username}',$user_id,$body);
						$body			=	str_replace('{password}',$user_password,$body);
						$body			=	str_replace('{link}',$link,$body);		
						$body			=	str_replace('{link1}',$link1,$body);
								
echo $body;
?>