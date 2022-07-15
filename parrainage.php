<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$mail_content=get_config_setting(7);


if(is_post_back()) {
	
	for($i=1;$i<=10;$i++)
	{
		$nom=$_POST['nom'.$i];
		$prenom=$_POST['prenom'.$i];
		$email=$_POST['email'.$i];
		
		if($nom && $prenom && $email){
			$sql="select * from tbl_feuille, tbl_member where feuille_email='".$email."'";		
		$rs_classi=db_query($sql);//$req = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
		 $reccnt1= mysql_num_rows($rs_classi);
		
		$sql="select * from tbl_member where email='".$email."'";		
		$rs_classi=db_query($sql);//$req = mysql_query($sql) or die('Erreur SQL !'.$sql.'<br>'.mysql_error()); 
		$reccnt2= mysql_num_rows($rs_classi);
				
		if($reccnt1==0 && $reccnt2==0){
			
			$sql="INSERT INTO `tbl_feuille` 
				SET `feuille_nom`='".$nom."',
				`feuille_prenom`='".$prenom."',
				`feuille_email`='".$email."',
				`mem_id`='".$_COOKIE[memId]."',
				`date_invite`='".MYSQL_DATE_TIME."'";
						
			db_query($sql);
			
			/********** Send mail to member *****************/
			/*
							style="font-family:Arial, sans-serif; 
									padding:7px 15px; 
									background-color:#86C222; 
									color:#fff; font-size:14px; 
									width:278px; 
									border-radius:2px;
									border:solid 1px #86C222;
									text-decoration:none;
									text-align:center;
									height:15px;
									font-weight:bold;" 
			*/
			$link="<span style='text-align:center;'><a href='".REDIRECT_SERVER."/register.php?parrain_id=".$_COOKIE[memId]."' target='_blank'>Inscription</a></span>";
		
		
			$link1=REDIRECT_SERVER.'/register.php?parrain_id='.$_COOKIE[memId];
			$email_subject	=	"Invitation de ".$_COOKIE[user_name];
			$server=$_SERVER['SERVER_NAME'];
			
			$mail_content=nl2br($mail_content);	
			//$body=html_mail_content($mail_content);
			$body=$mail_content;

			$body			=	str_replace('{friend_name}', $nom, $body);
			$body			=	str_replace('{your_name}', $_COOKIE[user_name], $body);
			$body			=	str_replace('{link}', $link, $body);		
			$body			=	str_replace('{link1}', $link1, $body);
			$body			=	str_replace('{server}', $server, $body);
				
			//mail("adnene_braham@hotmail.fr",$email_subject,$body);
			//sent_mail("adnene_braham@hotmail.fr",$email_subject,$body);
			
		//globwbmarketing@hotmail.fr
			if(sent_mail($email,$email_subject,$body)){
				//echo "Invitations envoyées avec succès.";
				Set_Display_Message("Invitations envoyées avec succès.");
			}
			else
			{
				//echo "Invitations non envoyées.";
				Set_Display_Message("Invitations non envoyées.");
			}
			/*
			echo "<br>";
			echo $email;
			echo "<br>";
			echo $email_subject;
			echo "<br>";
			echo $body;
			exit();*/
		}
		}
	}
	
	header("Location: ".$_SERVER['HTTP_REFERER']);
	exit();
}
?>