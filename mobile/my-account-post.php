<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_meta_tags','id','11');

require_once("header.inc.php");
require_once("arrays.inc.php");

$cryptinstall="cryptographp.fct.php";
include $cryptinstall;

$action=$_POST['action'];
$mail_content=get_config_setting(4);
$user_id=secureValue($_REQUEST['user_id']);
$user_type=secureValue($_REQUEST['user_type']);
$user_name=$mem_lname=secureValue($_REQUEST['mem_lname']);
$user_password=secureValue($_REQUEST['user_password']);
$pmethod=$_POST;

$link_curr=get_config_setting(15);

$rand_key=getRandomString();
$classi_state = intval($_REQUEST['classi_state']);

if(is_post_back()) {

	if($action=="Add" && ($_COOKIE[SERVER_NAME]=$_SERVER['SERVER_NAME'])){
		
			if(
				(
					$record->continent_code=="AF" 
					&& ($record->country_name!="Tunisia" && $record->country_name!="Algeria" && $record->country_name!="Morocco")
				)
				|| $record->country_name=="Ukraine")
			{
				//echo "ce site n'est pas accessible dans votre pays";
				header("Location:my-account-post.php");
				exit();
			}
	
			//testé si le membre est connecté ou non!!!!!
			if(!chk_login()){
				//si le membre n'est pas connecté
				
				$empty_fld=checkEmptyData($pmethod,array("user_id", "mem_lname", "user_password", "confirm_password"),array("User ID", "Nom","Password","Confirm Password" ));
				if(!$empty_fld['err_flag'])
				{
					$useID=db_query("select * from tbl_member where user_id='$user_id'");
					
					if(mysql_num_rows($useID)>0){
						//Email existe déjà...=> Authentification
					   
						$sel_mem_rec=db_query("select * from tbl_member where user_id='$user_id' and password='$user_password' ");
						$num_mem_rec=mysql_num_rows($sel_mem_rec);
						if($num_mem_rec > 0 )
						{
							$row_mem_rec=mysql_fetch_array($sel_mem_rec);
							@extract($row_mem_rec);
														
							setcookie("memId", $mem_id, time() + (86400 * 30));
							setcookie("userId", $user_id, time() + (86400 * 30));
							setcookie("user_name", $fname." ".$lname, time() + (86400 * 30));
							setcookie("classi_email", $user_id, time() + (86400 * 30));
						}else{
							Set_Display_Message("Mauvais nom d'utilisateur/mot de passe....!!");
							header("Location:signin.php");
							exit();   
						} 
					}else{
						//Email n'existe pas =>Ajouter Nouveau Utilisateur *********************************
						$ip=$_SERVER['REMOTE_ADDR'];
		
						$sql="INSERT INTO `tbl_member`
						SET `user_id` = '$user_id',`password` = '$user_password',
							`register_key` = '$rand_key',
							`lname` = '$mem_lname',
							`email` = '$user_id',
							`type`='$user_type',
							`mem_status` = 'N', `reg_date` = '".date('Y-m-d')."',
							`solde` = '0',
							`adresse_ip` = '$ip'";
	
						db_query($sql);
						$mem_id=mysql_insert_id();
							
						$mem_id=$mem_id;
						$userId=$user_id;
						$user_name=$mem_lname;
						$classi_email=$user_id;
						
						setcookie("memId", $mem_id, time() + (86400 * 30));
						setcookie("userId", $user_id, time() + (86400 * 30));
						setcookie("user_name", $user_name, time() + (86400 * 30));
						setcookie("classi_email", $user_id, time() + (86400 * 30));
						
						$link='<div style="text-align:center;">
									<a href='.REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.' 
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
										target="_blank">
										Confirmer votre email
									</a>
							</div>';
							
						$link1=REDIRECT_SERVER."/activer.php?key=".$rand_key."&ui=".$mem_id;
						
						$email_subject	=	$mem_lname." Activez votre annonce";
						$server=$_SERVER['SERVER_NAME'];
						
						$mail_content=nl2br($mail_content);	
						//$body=html_mail_content($mail_content);
						$body=$mail_content;
					
						$body			=	str_replace('{name}', $mem_lname, $body);
						$body			=	str_replace('{password}', $user_password, $body);
						$body			=	str_replace('{link}', $link, $body);		
						$body			=	str_replace('{link1}', $link1, $body);
						$body			=	str_replace('{server}', $server, $body);
						
						sent_mail($userId,$email_subject,$body);
					}
				}
			}
			
			// Inscription Newsletter
			
			 if(isset($_REQUEST['newsletter'])){
				inscritNewsletter($user_id);
			 }
			 
			// Déposer l'annonce
			$_COOKIE['cat_level_root'] = $_POST["principale_select"];
			$_COOKIE['cat_level_one'] = $_POST["cat_level_one"];
			$_COOKIE['cat_level_two'] = $_POST["cat_level_two"];
			
			 $_COOKIE['classi_title'] = secureValue($_POST["classi_title"]);
			 $_COOKIE['classi_ad_type'] = secureValue($_POST["classi_ad_type"]);
			 $_COOKIE['classi_desc'] = secureValue($_POST["classi_desc"]);
			 if($_POST["classi_price"] != ""){
				$_COOKIE['classi_price'] = secureValue($_POST["classi_price"]);
			 }else {
				$_COOKIE['my_offer'] = secureValue($_POST["my_offer"]); 
			 }
			 $_COOKIE['classi_address'] = secureValue($_POST["classi_address"]);
			 $_COOKIE['classi_state'] = secureValue($_POST["classi_state"]);
			 $_COOKIE['classi_city'] = secureValue($_POST["classi_city"]);
			 $_COOKIE['classi_zipcode'] = secureValue($_POST["classi_zipcode"]);
			 $_COOKIE['contact_number'] = secureValue($_POST["contact_number"]);
			 $_COOKIE['clas_fax'] = secureValue($_POST["clas_fax"]);
			 
			 $_COOKIE['set_feat'] = secureValue($_POST["set_feat"]);
			 $_COOKIE['contact_status'] = secureValue($_POST["contact_status"]);
		  
			$empty_fld=checkEmptyData($pmethod,
			array("principale_select","classi_title","classi_ad_type","classi_desc","classi_state","classi_city","classi_zipcode"),
			array("Category","Title","Ad Type","Description","State","City","Postal Code"));
			
			//if(!$empty_fld[err_flag]){
			 @extract($_POST);	
			 $contact_status=($contact_status!="") ? $contact_status : "Y";
			 $cat_paid=getPidcategory($cat_level_root);
			 $set_paid_status=($cat_paid=="Paid") ? "Pending" : "Free";	
			 $cls_status="Inactive";
			 
			 $paid_cls_expire_date=($cat_paid=="Paid") ? $paid_cls_expire_date : "0000-00-00";
			 $feature_expire_date=($set_feat=='N') ? "0000-00-00"  : $feature_expire_date;	
	
			$cat_level_root = secureValue($principale_select);
			$cat_level_one = secureValue($cat_level_one);
			$cat_level_two = secureValue($cat_level_two);
			$classi_title = secureValue($classi_title);
			$classi_ad_type = secureValue($classi_ad_type);
			$classi_desc = secureValue($classi_desc);
			$classi_price = secureValue($classi_price);
			$my_offer = secureValue($my_offer);
			$classi_address = secureValue($classi_address);
			$classi_city = secureValue($classi_city);
			$classi_state = secureValue($classi_state);
			$contact_number = secureValue($contact_number);
			$clas_fax = secureValue($clas_fax);
			$classi_zipcode = secureValue($classi_zipcode);
			
			 
			/********* Check Bad words  **********/
				$word_arr=spam_words();
				$problem = testSpamWords($word_arr, $pmethod);
				 
				if($problem=="Y"){
					Set_Display_Message("Votre contenu semble inaproprié. Svp vérifez votre contenu.");
					header("Location:my-account-post.php");
					exit();
				}
			/********* End Check Bad words  **********/
			
			foreach($_POST as $key => $val) echo '$_POST["'.$key.'"]='.$val.'<br />';
			
			$ft = db_query("select cat_parent from tbl_category where cat_id=$cat_level_root");
			$line_raw = mysql_fetch_row($ft);
			$cat_level_root=$line_raw[0];
			
			$clsd_cat_id = $cat_level_root;
			$clsd_subcat_id = $principale_select;
			$clsd_sub_subcat_id = $clsd_sub_subcat_id;
			
			//Si on est dans " publier une offre " on doit la classer dans espace candidat
			if($principale_select == "817"){
				$clsd_cat_id=8;
				$clsd_subcat_id=793;
				$clsd_sub_subcat_id = $_POST["149"];
			}
			//Si on est dans " publier un CV " on doit la classer dans espace recruteur
			else if($principale_select == "818"){
				$clsd_cat_id=8;
				$clsd_subcat_id=794	;
				$clsd_sub_subcat_id=818;
			}
			else{
				$clsd_sub_subcat_id=$_POST["cat_level_two"];
			}
		
			$mem_id=$mem_id!="" ? $mem_id : $_COOKIE[memId];			
			$userId=$userId!="" ? $userId : $_COOKIE[userId];			
			$user_name=$user_name!="" ? $user_name : $_COOKIE[user_name];			
			$classi_email=$classi_email!="" ? $classi_email : $_COOKIE[classi_email];
			
			
		if($mem_id!="" && $userId!="" && $user_name!="" && $classi_email!=""){
			//chk_login();
	
			$dt=MYSQL_DATE_TIME;
				 $sql="INSERT INTO `tbl_classified` SET
				`mem_id`='".$mem_id."',
				`clsd_cat_id` = '$clsd_cat_id',`clsd_subcat_id` = '$clsd_subcat_id',`clsd_sub_subcat_id` = '$clsd_sub_subcat_id',
				`classified_title` = '$classi_title',`classified_type` = '$classi_ad_type',
				`classified_desc` = '$classi_desc',	`classified_price_option` = '$classi_price',
				`offer` = '$my_offer',`classified_poster_street` = '$classi_address',
				`classified_city_id`='$classi_city',`classified_poster_state` = '$classi_state',
				`contact_number`='$contact_number',`classi_fax`='$clas_fax',
				`classified_poster_zipcode` = '$classi_zipcode',
				`classified_poster_name`='".$user_name."',
				`classified_poster_email` = '".$classi_email."',
				`classified_key` = '$rand_key',classified_expired_date='$paid_cls_expire_date',
				`feature_expired_date`='$feature_expire_date',
				 paid_status='$set_paid_status',
				`classified_post_date`='".$dt."',
				`classified_update_date`='".$dt."',
				`contact_status` = 'N',`classified_status` = '$cls_status' ,
				`date_fin_urgent` = '".$dt."',
				`date_fin_couleur` = '".$dt."',
				`date_fin_premium` = '".$dt."',
				`date_fin_republication` = '".$dt."' ";	
			
			 db_query($sql);
			
			 $recID=mysql_insert_id();
			 $dest_dir="mobile/uploaded_files/classified_img/";
			 
			if($_FILES['file1']['name']!=""){		  			  
			  $img=upload_file($recID,"file1",$dest_dir);
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img', clsd_id='$recID', mem_id='$mem_id' ");
			}
			if($_FILES['file2']['name']!=""){						 
			  $img2=upload_file($recID,"file2",$dest_dir);
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img2',clsd_id='$recID',mem_id='$mem_id'");
			}		
			if($_FILES['file3']['name']!=""){					
			  $img3=upload_file($recID,"file3",$dest_dir);
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img3',clsd_id='$recID',mem_id='$mem_id'");
			}
			if($_FILES['file4']['name']!=""){							 
			  $img4=upload_file($recID,"file4",$dest_dir);
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img4',clsd_id='$recID',mem_id='$mem_id'");
			}
			if($_FILES['file5']['name']!=""){							 
			  $img5=upload_file($recID,"file5",$dest_dir);
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img5',clsd_id='$recID',mem_id='$mem_id'");
			}
			if($_FILES['file6']['name']!=""){							 
			  $img6=upload_file($recID,"file6",$dest_dir);
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img6',clsd_id='$recID',mem_id='$mem_id'");
			}
			if($_FILES['file7']['name']!=""){							 
			  $img7=upload_file($recID,"file7",$dest_dir);
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img7',clsd_id='$recID',mem_id='$mem_id'");
			}
			if($_FILES['file8']['name']!=""){							 
			  $img8=upload_file($recID,"file8",$dest_dir);
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img8',clsd_id='$recID',mem_id='$mem_id'");
			}
	
		if($principale_select == "818"){
			$clsd_cat_id=8;
			$clsd_subcat_id=794	;
			$clsd_sub_subcat_id=818;
		}if(/*($principale_select == "817")||*/($principale_select == "818")||($principale_select == "875")||($clsd_sub_subcat_id == "")){
			$sq="select * from tbl_option_cat where cat_id ='$principale_select' order by cat_id";
		}
		else
			$sq="select * from tbl_option_cat where cat_id ='$cat_level_two' order by cat_id";
			
			$sql_cat=db_query($sq);
			while($rw=mysql_fetch_array($sql_cat)){ 
				
				$sql_val=db_query("select * from tbl_value_option where option_id =$rw[option_id] order by val_id");
				
				$rec_v=$_POST[$rw[option_id]];
				if(mysql_num_rows($sql_val)>0){
					//echo " insert in tbl_cla_op";
					$sql="INSERT INTO `tbl_classif_option` SET `classif_id`='$recID', `option_id`='$rw[option_id]', `val_id`='$rec_v'";
				}
				else{
					//echo " insert in tbl_cla_other";
					$sql="INSERT INTO `tbl_classified_other` SET `classifief_id`='$recID', `option_id`='$rw[option_id]',`other_value`='$rec_v'";
				}
				db_query($sql);
			
			}
		
				
				//Set_Display_Message("Votre Annonce Postée avec succès......");
				//exit;
				unset($_POST['action']);
					
				if(
					$_POST["date_fin_urgent"]=='y' || $_POST["date_fin_couleur"]=='y'
					||
					$_POST["date_fin_premium"]=='y' || $_POST["date_fin_republication"]=='y'
					)
				{
					header("Location:classified-option.php?date_fin_premium=".$_POST["date_fin_premium"]."&date_fin_couleur=".$_POST["date_fin_couleur"]."&date_fin_republication=".$_POST["date_fin_republication"]."&date_fin_urgent=".$_POST["date_fin_urgent"]."&clsId=$recID");
					exit();
				}
				else{
					
					header("Location:my-account-classified-preview.php?clsId=$recID");
					exit();
				}
		}
		
	}
	
}

$_COOKIE[SERVER_NAME]=$_SERVER['SERVER_NAME'];
?>

<div class="grid_3">
	<br />
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">

	<div class="main-heading">
        <h1 style="color:#626364;font-weight: bold;font-size: 20px;">Publier votre petite annonce:</h1>
        <!--
        <div class="commentaire tr" style="color:#009900; font-weight:bold;">
        	Une question ? Contactez notre service client au 09.70.40.54.73
        </div>
        -->
	</div>
        
    <div class=""><?php echo Display_Message();?></div>
    
    <div class="tree">
        <form name="frm" action="my-account-post.php" method="post" enctype="multipart/form-data">
            <table width="100%" cellpadding="5" cellspacing="0" >
                <tr>
                  <td colspan="3"><p class="fr"><span class="fs11">( <span class="star">* </span>)obligatoire.</span></p></td>
                </tr>
                <tr class="bg-stripcolor">
                  <td width="20%" align="right"><span class="star">*</span> Catégorie : </td>
                  <td>
                    <select name="principale_select" id="principale_select" 
                    		onChange="cat_drop_prin_select(this.value,'');" class='textbox' required >                        
                        <?php
                        $subcatId=$_REQUEST['subcatId'];
                        if(isset($subcatId))
                            echo prin_select_selected($subcatId);
                        else
                            echo prin_select();
                         ?>
                    </select>
                    <span id="msgboxcategory" style="display: none;"></span>
                    <span id="msgtextcategory" style="display:none;"></span>
                  </td>
        </tr>
                <tr class="bg-stripcolor">
                    <td></td>
                    <td>
                        <div id="ogiga" style="display:inline-block" ></div>
                        <span id="msgboxogiga" style="display:none"></span>
                        <span id="msgtextogiga" style="display:none"></span> 
                    </td>
                </tr>
                <tr>
                  <td align="right"><span class="star">*</span> Vous êtes :</td>
                  <td align="left">
                      <input type="radio" name="user_type" id="user_type1" value="Particulier" checked />
                      <label for="user_type1">Particulier</label>
                      
                      <input type="radio" name="user_type" id="user_type2" value="Professionnel" />
                      <label for="user_type2">Professionnel </label>
                      <span id="msgboxusertype" style="display: none;"></span>
                      <span id="msgtextusertype" style="display: none;"></span>
                  </td>
                </tr> 
                <tr class="bg-stripcolor">
                  <td align="right" valign="top"><span class="star">* </span>Titre :</td>
                  <td align="left">
                    <input name="classi_title" id="classi_title" type="text" class="textbox"  value="<?php echo $classi_title;?>" maxlength="45" onclick="document.getElementById('urgent').style.visibility='visible';" required autocomplete="off" />
                    <span id="msgboxtitle" style="display: none;"></span>   
                    <span id="msgtexttitle" style="display: none;"></span>
                    <br />
                    <div id="urgent" class="commentaire" style="visibility:hidden;">
                        <input type="checkbox" name="date_fin_urgent" value="y">  
                        Choisissez l'option <span class="premium">URGENT</span> et attirez l'attention sur votre annonce!  15 jours - 3 €
                    </div>
                  </td>           
                </tr>
                <tr>
                  <td align="right"><span class="star">*</span> Type d'annonce :</td>
                  <td align="left">
                      <select name="classi_ad_type" id="classi_ad_type" class='textbox' required >
                       <option value="">Type d'annonce</option>
                       <?php foreach($Ads_type as $key=>$val){
                          $sel=($classi_ad_type!="" && ($classi_ad_type==$val))? "selected" : "";
                       ?>
                         <option value="<?php echo $val;?>" <?php echo $sel;?> ><?php echo $val;?></option>
                     <?php } ?>	
                      </select>
                      <span id="msgboxadtype" style="display: none;"></span>
                      <span id="msgtextadtype" style="display: none;"></span>
                  </td>
                </tr>              
                <tr class="bg-stripcolor">
                  <td align="right" ><span class="star">*</span> Description :</td>
                  <td align="left">
                  <textarea name="classi_desc" id="classi_desc" class="textbox1" rows="10" cols="80" onblur="verif_nbre_caract(this)"  maxlength="8000" required ><?php echo $classi_desc;?></textarea>
                  <br />
                  <span id="msgboxdesc" style="display: none;"></span>
                  <span id="msgtextdesc" ></span>
                  <br /><br /><br /><br />
                   <?php //get_fck_editor_small('classi_desc',$classi_desc);?> </td>
                </tr>
                <tr class="bg-stripcolor">
                    <td colspan="2">
                        <div id="omega" >
                        </div>
                    </td>
                </tr>
                
                <tr height="20">
                  <td height="30" align="right"><!--<span class="star">*</span>--> Prix <?php echo $link_curr;?> :</td>
                  <td height="30" align="left">
                    <input name="classi_price" id="classi_price" type="text" class="textbox"  style="width:100px;"  value="<?php echo $classi_price;?>"
                        onkeyup="check(this);" onKeyDown="document.frm.my_offer.disabled='disabled';" 
                        onBlur="if(this.value==''){document.frm.my_offer.disabled='';}" maxlength="12" autocomplete="off" />
                        
                    &nbsp;ou choisir:
                    <select name="my_offer" class="textbox" style="width:120px;" onchange="document.frm.classi_price.disabled='disabled';" onBlur="if(this.value==''){document.frm.classi_price.disabled='';}">
                        <option value="">Choisir une</option>
                        <?php foreach($Offers_arr as $key=>$val){
                            $sel=($my_offer!="" &&($my_offer==$val))? "selected" : "";
                        ?>
                        <option value="<?php echo $val;?>" <?php echo $sel;?> ><?php echo $val;?></option>
                    <?php } ?>
                    </select>
                      
                  <span id="msgboxprice" style="display: none;"></span>
                  <span id="msgtextprice" style="display: none;"></span>
                  </td>
                </tr>
                <tr class="bg-stripcolor">
                  <td align="right" valign="top">Télécharger Images :</td>
                  <td align="left">
                
                  <div id="filestore">
                    <input name="file1" id="file1" type="file" class="textbox1" size="44" onChange="readURL(this,blah1);" />
                        <span style="font-size:9px;">
                        PHOTO PRINCIPALE
                        </span> &nbsp; &nbsp; &nbsp; &nbsp;
                        <span class="remarque">Taille Max: 3 Mo.</span><br />
                    <input name="file2" id="file2" type="file" class="textbox1" size="44" onChange="readURL(this,blah2);" /><br />
                    <input name="file3" id="file3" type="file" class="textbox1" size="44" onChange="readURL(this,blah3);" /><br />
                    <input name="file4" id="file4" type="file" class="textbox1" size="44" onChange="readURL(this,blah4);" /><br />
                    <input name="file5" id="file5" type="file" class="textbox1" size="44" onChange="readURL(this,blah5);" /><br />
                    <input name="file6" id="file6" type="file" class="textbox1" size="44" onChange="readURL(this,blah6);" /><br />
                    <input name="file7" id="file7" type="file" class="textbox1" size="44" onChange="readURL(this,blah7);" /><br />
                    <input name="file8" id="file8" type="file" class="textbox1" size="44" onChange="readURL(this,blah8);" /><br />
                    </div>
                  </td>
                </tr>
                <tr class="bg-stripcolor">
                  <td colspan="2" align="center">
                    <table cellspacing="2">
                        <tr>
                            <td><img name="blah1" id="blah1" ></td>
                            <td><img name="blah2" id="blah2" ></td>
                        
                            <td><img src="" name="blah3" id="blah3"></td>
                            <td><img src="" name="blah4" id="blah4" ></td>
                       
                            <td><img src="" name="blah5" id="blah5"></td>
                            <td><img src="" name="blah6" id="blah6"></td>
                       
                            <td><img src="" name="blah7" id="blah7"></td>
                            <td><img src="" name="blah8" id="blah8" ></td>
                        </tr>
                    </table>
                      
                  </td>
                </tr>
        
                <tr>
          <td align="right">Adresse :</td>
          <td align="left">
            <textarea name="classi_address" id="classi_address" rows="3" class="textbox"  maxlength="100"><?php echo $mem_arr[address];?></textarea>
            <span id="msgboxaddress" style="display: none;"></span>
            <span id="msgtextaddress" style="display: none;"></span>
          </td>
        </tr>
                <tr class="bg-stripcolor">
          <td align="right"><span class="star">*</span> Province :</td>
          <td align="left">
          <select name="classi_state" id="classi_state" class="textbox"  onChange="get_city_by_state(this.value,'')" required>
                <?php echo get_state($classi_state);?>
          </select>
          
          <?php if($classi_state!="") { ?>
             <script language="javascript">
              get_city_by_state('<?php echo $classi_state;?>','<?php echo $classi_city;?>')
              </script>
          <?php } ?>	
          <span id="msgboxstate" style="display: none;"></span>
          <span id="msgtextstate" style="display: none;"></span>
          </td>
        </tr>
                <tr class="bg-stripcolor">
          <td align="right"><span class="star">*</span> Ville :</td>
          <td align="left">
          <div id="bloc_city" style="display:inline-block" >
              <select name='classi_city' id="classi_city" class='textbox' required />
              </select>
          </div>
          <span id="msgboxcity" style="display: none;"></span>
          <span id="msgtextcity" style="display: none;"></span>
          </td>
        </tr>
                <tr class="bg-stripcolor">
          <td align="right"><span class="star">*</span> Code postal :</td>
          <td align="left">
             <input name="classi_zipcode" id="classi_zipcode" type="text" maxlength="5" class="textbox" value="" onkeyup="check(this);" required autocomplete="off" />
             <span id="msgboxzipcode" style="display: none;"></span>
             <span id="msgtextzipcode" style="display: none;"></span>
          </td>
        </tr>
                <tr>
                    <td align="right">Téléphone : </td>
                    <td align="left">
                        <input name="contact_number" type="text" min="6" maxlength="20" class="textbox" onkeyup="check(this);" value="" autocomplete="off"/>
                    </td>
                </tr>
                <tr>
                    <td align="right">Fax :</td>
                    <td align="left">
                    <input name="clas_fax" type="text" class="textbox"  maxlength="20" onkeyup="check(this);" value="" autocomplete="off"/></td>
                </tr>
            <?php 
            if(isset($_COOKIE['userId']) && $_COOKIE['userId']!=""){ 
                ?>
                <tr>
                    <td colspan="2">
                <div id="connect_member" style="display:none" ></div>
                <input name="mem_lname" id="mem_lname" type="hidden" class="textbox" value="<?php echo $_COOKIE['user_name'];?>" maxlength="20" />
                    </td>
                </tr>
                
                <?php
            }
            else{?>
                <tr>
                    <td colspan="2">
                        <div id="connect_member" class="mt17"> <!--style="display:none"connect--></div>
                    </td>
                </tr>
                
                <tr class="bg-stripcolor">
                    <td align="right" ><span class="star">*</span> Email :</td>
                    <td align="left">
                        <input name="user_id" id="user_id" type="text" class="textbox"  maxlength="50" required autocomplete="off" />
                        <span id="msgboxuser_id" style="display: none;"></span>
                        <span id="msgtextuser_id" style="display: none;"></span>
                        <br />
                        <span class="commentaire">Votre adresse de messagerie ne sera pas publiée.</span>
                    </td>
                </tr>
                
                <tr>
                    <td align="right"><span class="star">*</span> Nom :</td>
                    <td>
                    	<input name="mem_lname" id="mem_lname" type="text" class="textbox" value="<?php echo $mem_lname;?>" maxlength="20" required autocomplete="off" />
                        <span id="msgboxuser_name" style="display: none;"></span>
                        <span id="msgtextuser_name" style="display: none;"></span>
					</td>
                </tr>
                
                <tr class="bg-stripcolor">
                    <td align="right"><span class="star">* </span>Mot de passe : </td>
                    <td align="left">
                        <input name="user_password" id="user_password" type="password" class="textbox" maxlength="10" required />
                        <span id="msgboxuser_password" style="display: none;"></span>
                        <span id="msgtextuser_password" style="display: none;"></span>
                  </td>
                </tr>
                
                <tr class="bg-stripcolor">
                    <td align="right" ><span class="star">* </span>Confirmer le Mot de passe : </td>
                    <td align="left">
                        <input name="confirm_password" id="confirm_password" type="password" class="textbox" maxlength="10" required />
                        <span id="msgboxconfirm_password" style="display: none;"></span>
                        <span id="msgtextconfirm_password" style="display: none;"></span>
                    </td>
                </tr>
            <?php
            }
            ?> 
                <tr>
                    <td colspan="2">
                        <h1 style="color:#626364;font-weight: bold; font-size: 20px;">               
                            <span class="vs-step-subtitle" id="vs-featured-step-caption">
                                Offrez une meilleure visibilité à votre annonce
                            </span>
                        </h1>
                
                        <div class="ligne-col-post">
                            <div id="personel_y" style=" display:block; padding:10px;">
                                <div class="plan-block">
                                    <h4 class="green-heading">
                                        Toutes les Options
                                    </h4> 
                                    <p class="commentaire">
                                        Votre annonce sera mise en Premium, en Couleur et Automatiquement repostée toutes les 12 heures
                                    </p>
                                    <div class="icon-slect-all"></div>
                                    <div class="commentaire">                 
                                        <input type="checkbox" id="selectall_plan_id" name="selectall_plan_id" value="y" price="y"   force_extend_p2p="" checked />
                                        Sélectionner toutes les options
                                    </div>
                                </div>
                                
                                <div class="select-all">
                                    <img src="mobile/images/select-all.png">
                                </div>
                                
                                <div class="plan-block">
                                    <h3 class="green-heading">Annonce Premium</h3>0
                                    <p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p>
                                    <div class="icon-premium"></div>
                                    <div class="commentaire">                            
                                    <input type="checkbox" name="date_fin_premium" id="date_fin_premium" value="y" force_extend_p2p="" checked  />30 jours - 13€
                                    </div>
                                </div>
                                                                
                                <div class="plan-block">
                                    <h3 class="green-heading">Annonce en Couleur</h3>
                                    <p class="commentaire">Votre annonce sera surlignée en orange</p>
                                    <div class="icon-couleur"></div>
                                    <div class="commentaire">
                                        <input type="checkbox" name="date_fin_couleur" id="date_fin_couleur" value="y" force_extend_p2p="" checked />30 jours - 3€ 
                                    </div>
                                </div>
                                                                
                                <div class="plan-block">
                                    <h3 class="green-heading">Republication Auto</h3>
                                    <p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste toutes les jours</p>
                                    <div class="icon-republication"></div>
                                    <div class="commentaire">
                                        <input type="checkbox" name="date_fin_republication" id="date_fin_republication" value="y" force_extend_p2p="" checked />30 jours - 8€
                                    </div>
                                </div>
                        	</div>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                
                        <div class="commentaire">
                            <input type="checkbox" name="newsletter" checked />Je souhaite s'inscrire au Newsletter de <?php echo SITE_NAME;?>.
                        </div>
                
                		<!--
                        <urgent class="" >
                            <p>
                            	Économisez vos revenus, en toute souscription d'option payante vous donnera lieu à cumuler un crédit de 10% dans votre compte en Mesannonces.com, qui vous permet de souscrire à une ou des option(s) payante(s).
                            </p>
                        </urgent>
                        -->
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                
                    </td>
                </tr>
                <tr>
                  <td align="center" colspan="2">
                  <div style="text-align:center;">
                        <input name="button5" type="button" class="button button-green" id="publier-annonce" value="Publier cette annonce" />
                        <input type="hidden" name="action" id="hiddenField" value="Add" />                        
                        <span id="msgtextverifier" style="display: none;"></span>
                   </div>
                    </td>
                </tr>
                <tr>
                  <td align="center" style="padding-top:10px;" colspan="2">
                    <div class="commentaire">
                        En cliquant sur "Publier cette annonce", j'accepte les conditions d'utilisation de <?php echo SITE_NAME;?> et la politique de confidentialité.
                    </div>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    
    <p>
        <span style="font-size:10px">
        Avec Mesannonces site d'annonces gratuites en France déposez votre petite annonce gratuitement. Publier son annonce de bien ou de service et passer une annonce partout en france sans aucun frais. Publiez une petite annonce immo gratuite ? Vendre sa voiture ? Vendre un appartement ou vendre une maison neuve ou ancienne ? Mesannonces propose une service de particulier a particulier 100% gratuit. Passer une annonce immobiliere gratuite ou mettre une annonce d'occasion c'est simple rapide et efficace sur Mesannonces. Retrouvez toutes nos annonce facilement: vendre sa maison | vendre son appartement | vendre voiture| vendre moto| vendre mobile| louer une maison | louer appartement | services aux particuliers.
        </span>
    </p>

</div>
<script type="text/javascript">
var total=0;
	$(document).ready(function() {
		
		$("#selectall_plan_id").click(function(){
			
			if($(this).attr('checked')) {
				$("#date_fin_premium").attr("checked",true);
				$("#date_fin_couleur").attr("checked",true);
				$("#date_fin_republication").attr("checked",true);
			}
			else{
				$("#date_fin_premium").attr("checked",false);
				$("#date_fin_couleur").attr("checked",false);
				$("#date_fin_republication").attr("checked",false);
			}
			
		});
		
		
	});		
</script>

<?php require_once("footer.inc.php"); ?>