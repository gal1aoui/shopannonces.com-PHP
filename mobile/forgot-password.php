<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require_once("includes/main.inc.php");
require_once("front-functions.php");

$action=@$_REQUEST['action'];
$email=secureValue(@$_REQUEST['email']);
$mail_content=html_entity_decode(get_config_setting(5));
if($action=="yes_send"){
 $seluser=db_query("select * from  tbl_member where user_id ='$email'"); 
  $num=mysql_num_rows($seluser);
   if($num > 0 && $email!="" ){
		$rs=mysql_fetch_array($seluser);
		$password=$rs['password'];
		$userId=$rs['user_id'];
		$to=$rs['user_id'];		
		$name=$rs['fname'];
		/********** Send mail to member *****************/   			 
		$link="<a href='http://". $_SERVER['HTTP_HOST']."/signin.php'>Cliquez ici</a>";
        $link_contact="Please <a href='http://". $_SERVER['HTTP_HOST']."/contactus.php>Contact</a>";    
		$email_subject	=	"Login Details";
		
		$logo=get_config_setting(1);
		$body.="<div style='margin-top:-20px'><a href='http://". $_SERVER['HTTP_HOST']."'><img src=\"". $_SERVER['HTTP_HOST']."/uploaded_files/logo/".$logo."\" alt=\"Logo\"></a></div>";
		$body			.=	$mail_content;
		$body			=	str_replace('{membername}',$name,$body);
		$body			=	str_replace('{username}',$userId,$body);
		$body			=	str_replace('{pass}',$password,$body);
		$body			=	str_replace('{link}',$link,$body);   
		$body			=	str_replace('{link_contact}',$link_contact,$body);   
		$body			=	str_replace('{server}',$_SERVER['HTTP_HOST'],$body);        						
		$body			= 	nl2br($body);							
		$email_to		=	$to;
		$email_toname	=	$rs[fname]." ".$rs[lname];
			
		//sendMail($email_to,$emailto_name,$email_subject,$body,ADMIN_EMAIL,ADMIN_EMAIL,$html=true);
		sent_mail($email_to,$email_subject,$body);
        Set_Display_Message("Mot de passe envoyé à l'adresse que vous nous avez donné  ");
	    header("Location:signin.php");
	    exit();
     
	/*********** End of  Send mail to member ***************/ 
	}else{
	  Set_Display_Message("Votre Email ID n'existe pas dans nos données ");
	  header("Location:signin.php");
	  exit();
	}
}

require_once("header.php");
?>


<div class="heading">
	Mot de passe oublié:
</div>

<div class="body">
    <form action="forgot-password.php" method="post">
    <label for="email"><span class="star">*</span> Votre Email ID :</label>
    <input type="text" name="email" id="email" class="textbox" />
    
    <input name="Submit22" type="submit" class="button button-green" value="Soumettre"/>
    <input type="hidden" name="action"  value="yes_send" />
    </form>
</div>
<?php
require_once("footer.php");
?>