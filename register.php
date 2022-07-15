<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_meta_tags','id','9');


$mail_content=get_config_setting(4);

$cryptinstall="cryptographp.fct.php";
include $cryptinstall; 

$parrain_id=@$_REQUEST['parrain_id'];
$action=@$_REQUEST['action'];

$rand_key=getRandomString();

if($action=='Add'){
	if (chk_crypt($_POST['code'])) {
		//echo "<a><font color='#009700'>=> Bravo, vous avez saisi le bon code !</font></a>" ;
		
		$pmethod=$_POST;
		
		if(
			(
				$record->continent_code=="AF" 
				&& 
				($record->country_name!="Tunisia" && $record->country_name!="Algeria" && $record->country_name!="Morocco")
			)
			||
			$record->country_name=="Ukraine"
		)
		{
			header("Location:index.php");
			exit();
		}
		else{
		
			$empty_fld=checkEmptyData($pmethod,array("user_id", "mem_lname", "user_type", "user_password", "confirm_password", "code"),
										array("Email", "Nom", "Type d'utilisateur", "Mot de Passe","Confirmer le mot de passe", "code Captcha"));
			if(!$empty_fld['err_flag'])
			{	
				if(!$valid_data['err_flag'])
				{
					@extract(post);
					if(is_array($_POST['alrt'])){
						$alert_id=implode(",",$_POST['alrt']);
					}
					
					$user_id = secureValue($user_id);
					$user_type = secureValue($user_type);
					$user_password = secureValue($user_password);
					$comp_name = secureValue($comp_name);
					$comp_address = secureValue($comp_address);
					$comp_city = secureValue($comp_city);
					$comp_state = secureValue($comp_state);
					$comp_postal = secureValue($comp_postal);
					$comp_country = secureValue($comp_country);
					$comp_website = secureValue($comp_website);
					$mem_fname = secureValue($mem_fname);
					$mem_lname = secureValue($mem_lname);
					$mem_email = secureValue($user_id);
					$mem_address = secureValue($mem_address);
					$mem_postal = secureValue($mem_postal);
					$mem_city = secureValue($mem_city);
					$mem_state = secureValue($mem_state);
					$mem_country = secureValue($mem_country);
					$mem_telno = secureValue($mem_telno);
					$mem_state = secureValue($mem_state);
					$mem_country = secureValue($mem_country);
					$mem_telno = secureValue($mem_telno);
					$alert_id = secureValue($alert_id);
					 
					$ip=$_SERVER['REMOTE_ADDR'];
					$useID=db_query("select * from tbl_member where user_id='$user_id'");
					
					
					if(mysql_num_rows($useID)>0){  
						Set_Display_Message("Email existe déjà...");	
					}else{
						$sql="INSERT INTO `tbl_member` 
						SET `user_id` = '$user_id',`password` = '$user_password',
							`register_key` = '$rand_key',
							`comp_name` = '$comp_name',`comp_address` = '$comp_address',`comp_city` = '$comp_city',
							`comp_province` = '$comp_state',`comp_postalcode` = '$comp_postal',`comp_country` = '$comp_country',
							`comp_url` = '$comp_website',
							`fname` = '$mem_fname',`lname` = '$mem_lname',
							`email` = '$user_id',
							`type`='$user_type',
							`address` = '$mem_address',`post_code` = '$mem_postal',`city` = '$mem_city',
							`state` = '$mem_state',`country` = '$mem_country',	`tel_no` = '$mem_telno',
							`class_alerts` = '$alert_id',
							`mem_status` = 'N',`reg_date` = '".date('Y-m-d')."',
							`solde` = '0',
							`parrain_id` = '$parrain_id',
							`adresse_ip` = '$ip'";
							
						db_query($sql); 
						$mem_id=mysql_insert_id();
						/********** Send mail to member *****************/
						
						echo $link='<strong><a href="'.REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'" style="font-family:Arial, sans-serif;padding:5px 5px;background-color:#86C222;color:#fff;font-size:14px;width:150px;border:solid 1px #86C222;text-decoration:none;text-align:center;height:15px;" rel="nofollow">Confirmer votre email</a></strong>';			
					
						$link1=REDIRECT_SERVER."/activer.php?key=".$rand_key."&ui=".$mem_id;
						
						$email_subject	=	$mem_lname." Confirmer votre compte";
						$server=$_SERVER['SERVER_NAME'];
						
						$mail_content=nl2br($mail_content);	
						//$body=html_mail_content($mail_content);
						$body=$mail_content;
					
						$body			=	str_replace('{name}', $mem_lname, $body);
						$body			=	str_replace('{password}', $user_password, $body);
						$body			=	str_replace('{link}', $link, $body);	
						$body			=	str_replace('{link1}', $link1, $body);
						$body			=	str_replace('{server}', $server, $body);
						
						//echo $body;
						//echo $email_subject;
						
						$email_to		=	$user_id;
						$email_toname	=	$mem_lname;
						
						sent_mail($email_to,$email_subject,$body);
						/*********** End of  Send mail to member ***************/					
						
						setcookie("memId", $mem_id, time() + (86400 * 30));
						setcookie("userId", $user_id, time() + (86400 * 30));
						setcookie("user_name", $mem_lname, time() + (86400 * 30));
						setcookie("classi_email", $user_id, time() + (86400 * 30));
				
						Set_Display_Message("Bienvenue $mem_lname , vous avez été enregistré avec succès...<br>
											Un Email vous est envoyé, pour activer votre Compte....!!");         	
						header("Location:my-account.php");
						exit();
					}
				}else{
					Set_Display_Message("Champs suivants doivent être correct:<br />".$valid_data[msg]);
				}
			}else{
				Set_Display_Message("SVP spécifier les champs suivants :<br />".$empty_fld[msg]);
			}	
		}
		
	}
	else{
		$wrong = "<center><font class=b pl11 pt11>Vous avez entré un code de vérification invalide!</font></center>";
		Set_Display_Message($wrong);	
	}
		
}
				


require_once("header.inc.php");
if(chk_login()){
	header("Location:my-account.php");
	exit();
}



?>

<div class="grid_3">
    <br />
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">

	<div class="tree"><a href="index.php">Accueil</a> >>S'enregistrer </div>
    
	<div class=""><?php echo Display_Message();?> </div>
    
    
    <div class="p7">   
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><span class="title_clad">Créer votre compte</span></div>
            <div class="panel-body">
                  
        	<div align="right"><span class="fs11">( <span class="star">* </span>) obligatoire.</span></div>
                <form name="form1" method="post" action="register.php" onSubmit="return validate_registration(this);">
                    <table width="100%" cellpadding="2" cellspacing="0" >
                        <tr>
                            <th align="left" ><span class="star">*</span>Email :</th>
                            <td align="left">
                                <input name="user_id" type="text" class="textbox" value="<?php echo $user_id;?>" autocomplete="off" />
                            </td>
                        </tr>
                        <tr>
                            <th align="left"><span class="star">*</span>Nom :</th>
                            <td>
                            	<input name="mem_lname" type="text" class="textbox" value="<?php echo $mem_lname;?>" maxlength="15" autocomplete="off" />
                            </td>
                        </tr>
                        <tr>
                            <th align="left"><span class="star">*</span>Type d'utilisateur :</th>
                            <td>
                                <input type="radio" name="user_type" value="Particulier" checked />Particulier
                                <input type="radio" name="user_type" value="Professionnel" />Professionnel                    
                            </td>
                        </tr>
                        <tr>
                            <th align="left">Tél :</th>
                            <td>
                                <input name="mem_telno" type="text" class="textbox" value="<?php echo $mem_telno;?>" autocomplete="off" />
                            </td>
                        </tr>
                            
                        <tr class="bg-stripcolor">
                            <th align="left" ><span class="star">* </span>Mot de Passe : </th>
                            <td align="left">
                            <?php /*if(isset($_COOKIE['user_password']) ){ ?>
                            <input name="user_password" type="password" class="textbox1"  style="width:300px;" value="<?=$_COOKIE['user_password'];?>"/></td>
                            <?php } else { */?>
                            <input id="user_password" name="user_password" type="password" class="textbox" /></td><?php //} ?>
                        </tr>
                        <tr>
                        <th align="left"><span class="star">*</span>Confirmer le mot de passe  :</th>
                        <td align="left">
                        <input id="confirm_password" name="confirm_password" type="password" class="textbox" /></td>
                        </tr>
                        
                        <tr>
                            <th align="left"><?php dsp_crypt(0,1); ?></th>
                            <td><input type="text" name="code" class="textbox" autocomplete="off"></td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" align="center" class="commentaire">
                            En cliquant sur ' <strong>Inscription</strong> ', vous acceptez <a href="terms-use.php" class="link1" target="_blank">nos conditions d'utilisations</a>.</td>
                        </tr>
                        
                        <tr>
                            <td colspan="2" style="padding-top:10px; text-align:center;">
                            	<input type="hidden" name="parrain_id" name="parrain_id" value="<?=$parrain_id?>" />
                                <input name="button" type="submit" class="button button-green" id="button" value="Inscription" />
                                <input type="hidden" name="action" value="Add">
                            </td>
                        </tr>
                    </table>
                </form>
            </div>
        </div>
	</div>
    
</div>
<?php

 require_once("footer.inc.php"); ?>