<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

/*
$link="<a href=http://92.222.168.189/pay_advertise.php?rid=1&rf=advertise><b style='color:#FF0000'>Cliquez ici</b></a>"; 
$link1="http://92.222.168.189/pay_advertise.php?rid=1&rf=advertise";  
$email_subject	=	"Bannière";

$body.="<div style='margin-top:-20px'><a href='http://92.222.168.189'><img src='".$_SERVER['HTTP_HOST']."/uploaded_files/logo/".$logo."' alt='Logo' width='100' height='100'></a></div>";
$body.=	"Cher(e) Client(e),

Nous avons constatés un impayé sur votre Bannière.

Afin de regulariser et afficher votre bannière avec nous, Nous vous invitons à suivre la procédure de paiement par le lien suivant :

Merci de {link}

Si le lien est inactif, vous pouvez copier l'url ci dessous dans la barre d'adresse de votre navigateur internet

{link1}

Cordialement";

//$body="test";
*/
				$link=REDIRECT_SERVER."/classified-details.php?clsId=".$line_email[classified_id];
				$email_subject	=	"Confirmer votre compte";
				
				$body= '
				<div><font style="font-family:Arial, sans-serif;font-size:14px;color:#1b1a19;"><table align="center" border="0" width="100%" bgcolor="#ffffff" style="clear:both; border:1px solid #E3E3E3;"><tbody><tr><td colspan="2">
Cher {membername},

Vos details de connexion sont les suivants:
Email:  {username}
Mot de passe:  {pass}

Cliquez ici pour vous connecter {link}
Merci</td></tr></tbody></table></font>
</div>';



					$body=nl2br($body);	
	echo $body;
	echo "<hr>";		
	$header = "From: petites annonces <contact@petitesannonces.com> \n";
	$header .= "Reply-To: contact@flyannonces.com \r\n";
	
	
	$header .= "X-Mailer: PHP/". phpversion();
	$header .= "X-Priority: 3 \n";
	$header .= "MIME-version: 1.0\n";
	echo $header .= "Content-Type: text/html; charset=UTF-8\n";
	
	echo "<hr>";	
	//echo $email_to="adnraham@hotmail.fr";
	echo $email_to="adnj2@yopmail.com";
	#$msg=mail_header_top();
	#$msg.=$message;
	#$msg.=mail_footer();
	
	/*
	echo $to;
	echo "<br>";
	echo $subject;
	echo "<br>";
	echo $message;
	echo "<br>";
	echo $header;
*/

//$email_subject="adnene Activez votre annonce";
	echo "<hr>";	
echo sent_mail($email_to,$email_subject,$body);
?>
