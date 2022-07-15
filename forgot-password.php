<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require_once("includes/main.inc.php");
require_once("front-functions.php");

$action=@$_REQUEST['action'];
$email=secureValue(@$_POST['email']);
$mail_content=nl2br(get_config_setting(5));

if($action=="yes_send"){
	$seluser=db_query("select * from tbl_member where user_id ='$email'"); 
	$num=mysql_num_rows($seluser);
	
	if($num == 1 && $email!="" ){
		$rs=mysql_fetch_array($seluser);

		$mem_id=$rs[mem_id];
		$rand_key=$rs[register_key];
		
		$password=$rs['password'];
		$userId=$rs['user_id'];
		$email_to=$rs['user_id'];
		$name	=	$rs['fname']." ".$rs['lname'];
		
		/********** Send mail to member *****************/   			 
		$link='<a href="'.REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'">Cliquez ici</a>';
        //$link_contact="<a href='".REDIRECT_SERVER."/contactus.php>Contactez-nous</a>";
		
		$link_contact='<strong><a href="'.REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'&diff=" style="color:#fff;" rel="nofollow">Choisir cette offre</a></strong>';
		
		$email_subject	=	"Détails de connexion";
		
		$body			.=	$mail_content;
		$body			=	str_replace('{membername}',$name,$body);
		$body			=	str_replace('{username}',$userId,$body);
		$body			=	str_replace('{pass}',$password,$body);
		$body			=	str_replace('{link}',$link,$body);   
		$body			=	str_replace('{link_contact}',$link_contact,$body);         						
		//$body			= 	nl2br($body);			

		
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
?>

    <div class="p7">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <!--<div class="panel-heading"><span class="title_clad">Contactez nous</span></div>-->
            <div class="panel-body">
              <form action="forgot-password.php" method="post">
                <table width="100%">
                    <tr>
                        <td colspan="2" class=" ar fs11">( <span class="star">* </span>) obligatoire.</td>
                    </tr>
                    <tr>
                        <td><!-- width="40%" align="right" class="bg-strip-color1">-->
                            <span class="star">*</span> Votre Email ID :
                        </td>
                        <td><!-- width="60%" class="bg-strip-color1">-->
                            <input type="text" name="email" class="textbox" style="width:200px;"/>
                        </td>
                    </tr>
                    
                    <tr>
                        <td colspan="2" align="center" valign="top">
                            <input name="Submit22" type="submit" class="button button-green" value="Soumettre"/>
                            <input type="hidden" name="action"  value="yes_send" />
                        </td>
                    </tr>
                </table>
              </form>
            </div>
        </div>
	</div>