<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");


$meta_keywords = $meta_desc= $meta_titles = "Mettre à jour Mon compte";

require_once("header.php");
chk_user_login();


if($_POST['action']=='change'){

	@extract(post);
	
	$mem_email = $mem_email;
	$mem_fname = secureValue($mem_fname);
	$mem_lname = secureValue($mem_lname);
	$user_type = secureValue($user_type);
	$mem_address = secureValue($mem_address);
	$mem_postal = secureValue($mem_postal);
	$mem_city = secureValue($mem_city);
	$mem_state = secureValue($mem_state);
	$mem_country = secureValue($mem_country);
	$mem_telno = secureValue($mem_telno);
	$alter_id = secureValue($alter_id);
	
	$sql="Update `tbl_member` 
		SET
		`fname` = '$mem_fname',`lname` = '$mem_lname', 
		`type`='$user_type',
		`address` = '$mem_address',`post_code` = '$mem_postal',`city` = '$mem_city', `state` = '$mem_state', `country` = '$mem_country',
		`tel_no` = '$mem_telno',
		`class_alerts`='$alert_id'
		 WHERE mem_id='".$_SESSION['signin']['mem_id']."'";
		 
	 db_query($sql);

	 Set_Display_Message("Votre compte a été modifié....");
	 header("Location:my-account-edit.php");
	 exit();
}


$old_pwd=secureValue(@$_REQUEST['old_pwd']);
$new_pwd=secureValue(@$_REQUEST['new_pwd']);
$confirm_pass=secureValue(@$_REQUEST['c_pwd']);
$pmethod=$_REQUEST;

if($action=='Changepassword'){
$empty_fld=checkEmptyData($pmethod,array("old_pwd","new_pwd","c_pwd"),array("Ancien mot de passe","Nouveau mot de passe","Confirmer mot de passe"));
 if(!$empty_fld[err_flag]){
	 $sql="select mem_id,password from  tbl_member where password='$old_pwd' and mem_id='$_COOKIE[memId]'";
	 $rw=db_query($sql);
		if(mysql_num_rows($rw)==0){	
			Set_Display_Message("Ancien mot de passe invalide, essayez de nouveau");	 
		}else if ($new_pwd!=$confirm_pass){	 
			Set_Display_Message("Nouveau mot de passe et mot de passe de confirmation différents ");
		}else{
			$update_sql="update tbl_member set password='$new_pwd'
			where password='$old_pwd' and mem_id='$_COOKIE[memId]'";
			db_query($update_sql);
			Set_Display_Message("Mot de passe changé avec succès, svp entrez le nouveau mot de passe.");
			unset($_COOKIE['memId']);
			unset($_COOKIE['userId']);
			unset($_COOKIE['user_name']);
			header("Location:signin.php");
			exit();
		}
  }else{
    Set_Display_Message("S'il vous plaît remplir tous les champs :<br />".$empty_fld[msg]);
  } 
}	
?>

<script type="text/javascript">
	$(document).ready(function() {
		
		//Onclik Controle boutton
		$("#button3").click(function()
		{
			var err=true;
			
//remove all the class add the messagebox classes and start fading
				$("#msgboxold_password").removeClass().addClass('messagebox').fadeIn("slow");
				$("#msgtextold_password").removeClass().addClass('messagebox').fadeIn("slow");
				
				if(document.frm.old_pwd.value=="" )
				{
					$("#msgboxold_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
	
					$("#msgtextold_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
					});
					err=false;
				}else if(document.frm.old_pwd.value.length<6){
					
					$("#msgboxold_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
					
					$("#msgtextold_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{
						$(this).html('').append('<urgent>Minimum 6 characters. </urgent>').fadeTo(900,1);
						
					});
					err=false;
				}
				else {/*
					$("#msgboxuser_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxyes').fadeTo(900,1);
	
					});
					
					$("#msgtextuser_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{
						$(this).html('').append('').fadeTo(900,1);
						
					});*/
					
						$("#msgtextold_password").empty();
				}
				//-----------------
				
				$("#msgboxnew_password").removeClass().addClass('messagebox').fadeIn("slow");
				$("#msgtextnew_password").removeClass().addClass('messagebox').fadeIn("slow");
				
				if(document.frm.new_pwd.value=="" )
				{
					$("#msgboxnew_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
	
					$("#msgtextnew_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
					});
					err=false;
				}else if(document.frm.new_pwd.value.length<6){
					
					$("#msgboxnew_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
					
					$("#msgtextnew_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{
						$(this).html('').append('<urgent>Minimum 6 characters. </urgent>').fadeTo(900,1);
						
					});
					err=false;
				}
				else {/*
					$("#msgboxuser_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxyes').fadeTo(900,1);
	
					});
					
					$("#msgtextuser_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{
						$(this).html('').append('').fadeTo(900,1);
						
					});*/
					
						$("#msgtextnew_password").empty();
				}
				
				//remove all the class add the messagebox classes and start fading
				$("#msgboxconfirm_password").removeClass().addClass('messagebox').fadeIn("slow");
				$("#msgtextconfirm_password").removeClass().addClass('messagebox').fadeIn("slow");
				
				if((document.frm.c_pwd.value==""))
				{
					$("#msgboxconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
					
					$("#msgtextconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
					});
					err=false;
				}
				else if(document.frm.c_pwd.value!=document.frm.new_pwd.value){
					
					$("#msgboxconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
					
					$("#msgtextconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').append('<oblig>Mot de passe et Confirmer le mot de passe ne sont pas conforme.</oblig>').fadeTo(900,1);
					});
					err=false;
				}else if(document.frm.new_pwd.value.length<6){
					
					$("#msgboxconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
					
					$("#msgtextconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{
						$(this).html('').append('<urgent>Minimum 6 characters. </urgent>').fadeTo(900,1);
						
					});

					err=false;
				}else {
					/*
					$("#msgboxconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 

					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxyes').fadeTo(900,1);
	
					});
					*/
					$("#msgtextconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{
						//$(this).html('').append('').fadeTo(900,1);
						$("#msgtextconfirm_password").empty();
						
					});
				}
				
			setTimeout(function() {
			  // wait 1 second before announcing the result
			  	if(err==true){
					document.frm.submit();
				}
			 // "returns" the value
			}, 1000);
			
	});
	
	});

</script>


<div class="heading">
    Mes Informations:
</div>

<div class="body">
    
	<div class="account-link">
		<?php require_once("my_account_links.php"); ?>
	</div>
	<div class=""><?php echo Display_Message();?> </div>
    
                <form name="frm" method="post" action="">
                    <table width="100%">
                        <tr>
                            <td colspan="3" class="heading">Changer le mot de passe</td>
                        </tr>
                        <tr>
                            <td width="30%"><span class="star">*</span> Ancien mot de passe :</td>
                            <td><input name="old_pwd" id="old_pwd" type="password" class="textbox" required="required" /></td>
                            <td>
                                <span id="msgboxold_password" style="display: none;"></span>
                                <span id="msgtextold_password" style="display: none;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="star">*</span> Nouveau mot de passe : </td>
                            <td><input name="new_pwd" type="password" class="textbox" required="required" /></td>
                            <td>
                            <span id="msgboxnew_password" style="display: none;"></span>
                            <span id="msgtextnew_password" style="display: none;"></span></td>
                        </tr>
                        <tr>
                            <td><span class="star">*</span> Confirmer mot de passe :</td>
                            <td><input name="c_pwd" type="password" class="textbox" required="required" /></td>
                            <td>
                            <span id="msgboxconfirm_password" style="display: none;"></span>
                            <span id="msgtextconfirm_password" style="display: none;"></span>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center">
                                <input name="button3" type="button" class="button button-green" id="button3" value="Valider"/>
                                <input type="hidden" name="action" id="hiddenField" value="Changepassword" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </form>
                
                
                <?php
                $sql="select * from tbl_member where mem_id='".$_SESSION['signin']['mem_id']."'";
                $rw=db_query($sql);
                $res=mysql_fetch_array($rw);
                
                $alerts=$res[class_alerts];
                $alerts_arr=explode(",",$alerts);
                $main_cat_arr=main_cat_array();
                if(is_array($_POST['alrt'])){
                    $alert_id=implode(",",$_POST['alrt']);
                } 
                ?>
                
                <div class="mt17"><hr /></div>
                <form name="form1" method="post" action="">    
                    <table width="100%">
                        <tr>
                            <td colspan="3" class="heading">Changer mes coordonnées</td>
                        </tr>
                        <tr>
                            <td width="30%">Identifiant :</td>
                            <td>
                                <input type="text" value="<?php echo $res[mem_id]?>" name="id" class="textbox" readonly />
                            </td>
                        </tr>
                        <tr class="bg-stripcolor">
                            <td width="30%"><span class="star">*</span> Email :</td>
                            <td>
                                <input name="mem_email" type="text" class="textbox" id="mem_email" value="<?php echo $res[user_id]?>" required="required" readonly="readonly" />
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>Prénom :</td>
                            <td><input name="mem_fname" type="text" class="textbox" id="mem_fname" value="<?php echo $res[fname]?>"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>Nom :</td>
                            <td><input name="mem_lname" type="text" class="textbox" id="mem_lname" value="<?php echo $res[lname];?>"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td>Type d'utilisateur :</td>
                            <td>
                            <input type="radio" name="user_type" id="user_type1" value="Particulier" <?php if($res[type]=="Particulier") echo "checked";?> />
                            <label for="user_type1">Particulier</label>
                            <input type="radio" name="user_type" id="user_type2" value="Professionnel" <?php if($res[type]=="Professionnel") echo "checked";?> />
                            <label for="user_type2">Professionnel</label>
                             </td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>Pays :</td>
                            <td>             
                                <select name="mem_country" id="mem_country" size="1" class="textbox" >
                                <?php echo country_lists($res[country]);?>
                                </select>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>Ville :</td>
                            <td><input name="mem_city" type="text" class="textbox" id="mem_city" value="<?php echo $res[city];?>" /></td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>Province :</td>
                            <td><input name="mem_state" type="text" class="textbox" id="mem_state" value="<?php echo $res[state]?>" /></td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>Code postal :</td>
                            <td><input name="mem_postal" type="text" class="textbox" id="mem_postal" value="<?php echo $res[post_code]?>"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>Adresse :</td>
                            <td><textarea name="mem_address" rows="3" class="textbox" id="mem_address" ><?php echo $res[address];?></textarea></td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td>No. Tél. :</td>
                            <td><input name="mem_telno" type="text" class="textbox" id="mem_telno" value="<?php echo $res[tel_no]?>"/></td>
                            <td>&nbsp;</td>
                        </tr>
                        
                        <tr>
                            <td colspan="3" class="tc">
                                <input name="button" type="submit" class="button button-green" id="button" value="Valider" />
                                &nbsp;
                                <input type="hidden" name="action" value="change">
                            </td>
                        </tr>
                        
                    </table>    
                </form>

	</div>
</div>
<?php require_once("footer.php"); ?>