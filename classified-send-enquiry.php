
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

$cryptinstall="cryptographp.fct.php";
include $cryptinstall;

$adresse_ip=$_SERVER['REMOTE_ADDR'];
require 'cladmin/geoip/geoipcity.inc.php';
$database = geoip_open('cladmin/geoip/GeoLiteCity.dat',GEOIP_STANDARD);

$record = geoip_record_by_addr($database, $adresse_ip);


$action=$_REQUEST['sub'];

if($action=='Envoyer'){
	if (chk_crypt($_POST['code'])) {
		
			if(($record->continent_code=="AF" && ($record->country_name!="Tunisia" && $record->country_name!="Algeria" && $record->country_name!="Morocco")) || $record->country_name=="Switzerland" || $record->country_name=="United States")
			{
				//$msg2="Votre message n'est pas envoyé, ce site n'est pas accessible dans votre pays";
				$msg2="Votre message est envoyé";
			}
			else{		

				$comp_name=get_config_setting(2);
				/**** Submit visiter inquire *****/
				if($_REQUEST['act']!="" && $_REQUEST['act']=="snd_inq"){
				
					$posterID = intval($_POST['posterId']);
					$clsID = intval($_POST['clsId']);
					$sender_email = secureValue($_POST['sender_email']);
					$sender_name = secureValue($_POST['sender_name']);
					$sender_tel = secureValue($_POST['sender_tel']);
					$sender_msg = secureValue($_POST['sender_msg']);
					/*
					$empty_fld=checkEmptyData($pmethod,array("sender_email", "sender_msg", "code"),
												array("Email", "Message", "Code Captcha"));
					if(!$empty_fld['err_flag'])
					{*/	
						if($sender_email!="" && $sender_msg!=""){
							

/* Update contact count*/

$contacts=classified_contacts($clsId)+1;
$sql_contact="UPDATE tbl_classified set classified_contact=$contacts where classified_id='$clsID'";  
db_query($sql_contact);
/* End Update contact count */

			echo $sql_inq=" INSERT INTO `tbl_classified_inquiry` SET `memId` = '$posterID',
			`enq_classified_id` = '$clsID',
			`enq_sender_email` = '$sender_email',
			`enq_sender_name` = '$sender_name',
			`enq_sender_tel` = '$sender_tel',
			`enq_msg` = '$sender_msg',
			`enq_sender_ip` = '".$_SERVER['REMOTE_ADDR']."',
			`enq_post_date` = '".MYSQL_DATE_TIME."'";
			db_query($sql_inq);  
			
			$msg2="<span  class='msg_dg'>Votre message envoyé avec succès....</span>";
			// send notification to enquiry owner
			$sql = 'SELECT `classified_title`, `classified_poster_name`, `classified_poster_email` FROM `tbl_classified` WHERE `classified_id` = '.$clsID.' LIMIT 1';
			$result = mysql_query($sql);
			if($row = mysql_fetch_array($result)) {
			//---------------
			
			
			$boundary = md5 (uniqid (rand())); 
			$file_name=$_FILES['file_name']['tmp_name'];
			$file_nom=$_FILES['file_name']['name'];
			$attached_file = file_get_contents($file_name); //file name ie: ./image.jpg 
			$attached_file = chunk_split(base64_encode($attached_file)); 
			
			if($file_name)
			$attached = "\n\n". "--" .$boundary . "\nContent-Type: application; name=\"$file_nom\"\r\nContent-Transfer-Encoding: base64\r\nContent-Disposition: attachment; filename=\"$file_nom\"\r\n\n".$attached_file . "--" . $boundary . "--"; 
			
			$headers = "From: ".$sender_name." <".$sender_email."> \n";
			$headers .= "Reply-To: ".$sender_email." \r\n";
			$headers .= "Content-Type: text/html; charset='UTF-8' ";
									
				$message =
				"Bonjour,<br>
				Vous avez reçu un message sur ".SITE_NAME." concernant votre annonce :<br>
				'{$row['classified_title']}' !<br><br>
				Soyez vigilant! Certains messages peuvent être des arnaques.<br>
				Un doute sur ce message? Consultez nos conseils de sécurité.<br><br>
				
				Coordonnées du contact<br>
				Nom de l'expediteur: {$sender_name}<br>
				l'Expediteur de mail : {$sender_email}<br>
				Message:\n{$sender_msg}<br><br>
				Envoye le: ".date('Y-m-d H:i')."<br>" . $attached;
										
									//$message=html_mail_content($message);
									$body = $message;
									
									
									mail($row['classified_poster_email'],"Message pour Petite Annonce '{$row['classified_title']}' ",$body,$headers);
									
									//sendMail($row['classified_poster_email'],"annonceur","Message pour Petite Annonce '{$row['classified_title']}' sur $comp_name ",$body,$headers,ADMIN_EMAIL,$html=true);	
									//---------------
								}
								/*
								unset($_REQUEST['snd_inq']);
								@header("Location:".$_SERVER['HTTP_REFERER']);
								exit();
							   */
							?>
								 <script type="text/javascript" language="javascript">
									 var str;
									 str=parent.document.getElementById("sender_email").value="";
									 str=parent.document.getElementById("sender_name").value="";
									 str=parent.document.getElementById("sender_msg").value="";
									 str=parent.document.getElementById("sender_tel").value="";
									 str=parent.document.images.cryptogram.src='./cryptographp.php?cfg=0&&'+Math.round(Math.random(0)*1000)+1;
									 str=parent.document.getElementById("code").value="";
								 </script>
							<?php
								}
								else{
									$msg2="<span  class='msg_dg'>Il faut Remplir les champs Obligatoires...</span>";
								}
					/*}else{
						//$msg2="<span  class='msg_dg'>SVP spécifier les champs suivants :<br />".$empty_fld[msg]."</span>");
		$msg2=$sender_email."<span  class='msg_dg'>SVP spécifier les champs suivants :<br />".$empty_fld[msg]."</span>";
					}*/
				
				}
			}
	}
	else{
		$msg2="<span  class='msg_dg'>Le code Captcha est incorrect...</span>";
	}
	
	$page = $_SERVER['HTTP_REFERER'];
	$sec = "0";
	header("Refresh: $sec; url=$page");
}

	?>
 <script type="text/javascript" language="javascript">
 var str;
 str=parent.document.getElementById("msg_new").innerHTML="<?php echo $msg2;?>";
 //alert(str); 
 </script>