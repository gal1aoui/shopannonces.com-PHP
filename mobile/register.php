<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_meta_tags','id','9');

require_once("header.php");
if(chk_login()){
	header("Location:my-account.php");
	exit();
}

$cryptinstall="cryptographp.fct.php";
include $cryptinstall;



if($_POST['action']=='Add'){
	if (chk_crypt($_POST['code'])) {
		//echo "<a><font color='#009700'>=> Bravo, vous avez saisi le bon code !</font></a>" ;
		
		$pmethod=$_POST;
		if($record->continent_code=="AF")
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
					
					$user_id = $user_id;
					$mem_lname = $mem_lname;
					$user_type = $user_type;
					$mem_telno = $mem_telno;
					$user_password = $user_password;
					$confirm_password = $confirm_password;
					
					Register_member($user_id, $mem_lname, $user_type, $mem_telno, $user_password, $confirm_password);
					header("Location:my-account.php");
					exit();
					
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
//}
				
/*
$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_meta_tags','id','9');

if(chk_login()){
	header("Location:my-account.php");
	exit();
}
*/


?>


<div class="heading">
    Créer votre compte:
</div>

<div class="body">
    
	<div class=""><?php echo Display_Message();?> </div>
    
    <div align="right"><span class="fs11">( <span class="star">* </span>) obligatoire.</span></div>
	<form id="form1" name="form1" action="register.php" method="POST" class="post" data-ajax="false">
    <label id="user_id"><span class="star">*</span>Email :</label>
    <input name="user_id" id="user_id" type="email" class="textbox" value="<?=$_SESSION['register']['user_id'];?>" autocomplete="off" required="required" />
    
    <br />    
    <label for="mem_lname"><span class="star">*</span>Nom :</label>
    <input name="mem_lname" id="mem_lname" type="text" class="textbox" value="<?=$_SESSION['register']['mem_lname'];?>" maxlength="15" autocomplete="off" required="required" />
    <br />
    
    <label><span class="star">*</span>Type d'utilisateur :</label>
    <input type="radio" name="user_type" id="user_type1" value="Particulier" checked /><label for="user_type1">Particulier</label>
    <input type="radio" name="user_type" id="user_type2" value="Professionnel" /><label for="user_type2">Professionnel</label>
    <br />
    
    <label for="mem_telno">Tél :</label>
    <input name="mem_telno" id="mem_telno" type="text" class="textbox" value="<?=$_SESSION['register']['mem_telno'];?>" autocomplete="off" />
    <br />
    
    <label for="user_password"><span class="star">* </span>Mot de Passe :</label>
    
    <?php /*if(isset($_COOKIE['user_password']) ){ ?>
            <input name="user_password" type="password" class="textbox1"  style="width:300px;" value="<?=$_COOKIE['user_password'];?>"/></td>
            <?php } else { */?>
    <input id="user_password" name="user_password" class="textbox" type="password" autocomplete="off" required="required" /><?php //} ?>
    <br />   
    
    <label for="confirm_password"><span class="star">*</span>Confirmer le mot de passe  :</label>
    <input id="confirm_password" name="confirm_password" class="textbox" type="password" autocomplete="off" required="required" />
    <br />    
    
    <label>
        <?php dsp_crypt(0,1); ?>
    </label>
    <input type="text" name="code" class="textbox" autocomplete="off" required="required">
    <br />
    <br />
    
    En cliquant sur ' <strong>Inscription</strong> ', vous acceptez <a href="terms-use.php" class="link1" target="_blank">nos conditions d'utilisations</a>.
    <br />
    <br />
    <input type="hidden" name="ref" value="<?php echo $_REQUEST['ref'];?>">

    <input type="hidden" name="parrain_id" name="parrain_id" value="<?=$parrain_id;?>" />
    <input name="button" type="submit" class="button button-green" id="button" value="Inscription" />
    <input type="hidden" name="action" value="Add">
                
</form>

</div>
<?php

 require_once("footer.php"); ?>