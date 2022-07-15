<?php
//unset($_SESSION['forms']);
//unset($_SESSION['forms'][4][0]);
//unset($_SESSION['forms'][4]);
/*
if(!empty($_SESSION['forms']))
{
	echo "<pre>";
	print_r($_SESSION['forms'][4]);
	echo "</pre>";
}
*/

		
	if(chk_user_login()){
		
		if(!empty($_SESSION['forms'])){
			// Déposer l'annonce
			$clsd_cat_id=getCat_parent($_SESSION['forms'][1]['principale_select']);
			$clsd_subcat_id=$_SESSION['forms'][1]['principale_select'];
			$clsd_sub_subcat_id=$_SESSION['forms'][1]['cat_level_two'];
			
			$classi_title = $_SESSION['forms'][1]['classi_title'];
			$classified_ad_type = $_SESSION['forms'][1]['classified_ad_type'];
			$classi_desc = $_SESSION['forms'][1]['classi_desc'];
			$classi_prix = $_SESSION['forms'][1]['classi_prix'];
			
			$classi_state = $_SESSION['forms'][3]['classi_state'];
			$classi_city = $_SESSION['forms'][3]['classi_city'];
			$classi_zipcode = $_SESSION['forms'][3]['classi_zipcode'];
			$classi_address = $_SESSION['forms'][3]['classi_address'];
			 
			 
			$contact_number = $_SESSION['tel_no'];
			//$clas_fax = $_SESSION['clas_fax'];
			 
			 
			 $set_paid_status=($cat_paid=="Paid") ? "Pending" : "Free";	
			 $paid_cls_expire_date=($cat_paid=="Paid") ? $paid_cls_expire_date : "0000-00-00";
			 $feature_expire_date=($set_feat=='N') ? "0000-00-00"  : $feature_expire_date;
			 $cls_status="Inactive";
		
			$clsd_cat_id = secureValue($clsd_cat_id);
			$clsd_subcat_id = secureValue($clsd_subcat_id);
			$clsd_sub_subcat_id = secureValue($clsd_sub_subcat_id);
			$classi_title = secureValue($classi_title);
			$classified_ad_type = secureValue($classified_ad_type);
			$classi_desc = secureValue($classi_desc);
			$classi_prix = secureValue($classi_prix);
			
			$classi_state = secureValue($classi_state);
			$classi_city = secureValue($classi_city);
			$classi_zipcode = secureValue($classi_zipcode);
			$classi_address = secureValue($classi_address);
			
			$contact_number = secureValue($contact_number);
			$clas_fax = secureValue($clas_fax);
			
			
			/********* Check Bad words  **********/
				$problem = testSpamWords(spam_words(), $_SESSION['forms'][1] );
				 
				if($problem=="Y"){
					Set_Display_Message("Votre contenu semble inaproprié. Svp vérifez votre contenu.");
					header("Location:post.php");
					exit();
				}
			/********* End Check Bad words  **********/
			
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
			
			$dt=MYSQL_DATE_TIME;
			$sql="INSERT INTO `tbl_classified` SET
				`mem_id`='".$_SESSION['signin']['mem_id']."',
				`clsd_cat_id` = '$clsd_cat_id',`clsd_subcat_id` = '$clsd_subcat_id',`clsd_sub_subcat_id` = '$clsd_sub_subcat_id',
				`classified_title` = '$classi_title',
				`classified_type` = '$classified_ad_type',
				`classified_desc` = '$classi_desc',
				`classified_price_option` = '$classi_prix',
				`offer` = '$my_offer',
				`classified_poster_street` = '$classi_address',
				`classified_city_id`='$classi_city',`classified_poster_state` = '$classi_state',
				`contact_number`='$contact_number',`classi_fax`='$clas_fax',
				`classified_poster_zipcode` = '$classi_zipcode',
				`classified_poster_name`='".$_SESSION['signin']['lname']."',
				`classified_poster_email` = '".$_SESSION['signin']['email']."',
				`classified_key` = '".getRandomString()."',
				classified_expired_date='$paid_cls_expire_date',
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
			$_SESSION["recID"]=$recID;
			
			$dest_dir="uploaded_files/classified_img/";
			foreach ($_SESSION['forms'][4] as $index => $nameFile){
				
				$img=upload_file_mobile($recID, $nameFile, $dest_dir);
				db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img', clsd_id='$recID', mem_id='".$_SESSION['signin']['mem_id']."' ");
				echo "img_temp/".img;
				unlink_file_mobile("img_temp", $img);
			}
			
			
			unset($_SESSION['forms'][4]);
		
			foreach($_SESSION['forms'][2] as $key => $val){
				//$_SESSION['forms'][2][$key] = $val;
				
				$sql_val=db_query("select * from tbl_value_option where option_id ='".$key."' order by val_id");
				
				$rec_v=$_POST[$rw[option_id]];
				if(mysql_num_rows($sql_val)>0){
					$sql="INSERT INTO `tbl_classif_option` SET `classif_id`='$recID', `option_id`='".$key."', `val_id`='".$val."'";
				}
				else{
					$sql="INSERT INTO `tbl_classified_other` SET `classifief_id`='$recID', `option_id`='".$key."',`other_value`='".$val."'";
				}
				db_query($sql);
			}
			
			unset($_SESSION['forms']);
		}
	}


unset($_SESSION['optionselected']);
$clsId= !empty($_SESSION["recID"]) ? $_SESSION["recID"] : $_REQUEST['clsId'];

	$sql_clsi="select * from tbl_classified where classified_id='".$clsId."' and classified_status!='Delete' ";	
	$sql_rs_set=db_query($sql_clsi);
	if($res=mysql_fetch_array($sql_rs_set)){
	
		$sql_img="select * from tbl_classified_image where clsd_id='$res[classified_id]' and img_status='Y'";
		$sql_img_set=db_query($sql_img);
		
		if(mysql_num_rows($sql_img_set) > 0 ) {
			$km=0;  
			while($res1=mysql_fetch_array($sql_img_set)){        
				$file_sm="uploaded_files/classified_img/".$res1[cls_img_file];    
				$autoID[]=$res1['clsd_img_id']; 
				if($res1[cls_img_file]!=""){
					$file_path_sm	 =	 show_thumb($file_sm,"65","65","width");
					$file_path_big	 =	show_thumb($file_sm,"450","550","width");
					$sz=getimagesize($file_path_sm);
					$sz_big=getimagesize($file_path_big);			  
												  
					$im_small='<img src="'.$file_sm.'" alt="" width="100" height="100" border="0" class="border-img" />';	
				}
			}
		}
	}


?>


<form id="upgrade_form" method="POST" action="my-account-manage.php" data-ajax="false" >
    <input type="hidden" name="clsId" id="clsId" value="<?php echo $clsId;?>" />

        
            <h1 style="color:#626364;font-weight: bold; font-size: 20px;">               
                <span class="vs-step-subtitle" id="vs-featured-step-caption">
                    Offrez une meilleure visibilité à votre annonce:
                </span>
            </h1>
            

    <div data-role="fieldcontain">
        <fieldset data-role="controlgroup">
            <legend style="text-align: center;">
            <h3 class="green-heading">
            	<?php echo Rec_display_formate(truncateText($res[classified_title],70,' ','...',true));?>
            </h3>
			<?php if($im_small!="" ) {
                echo "<a href='".$html_link."' title='".$alt."'>".$im_small."</a>";
            }else{?>
                <a href="<?php echo $html_link;?>">
                <img src="images/blank-img.gif" alt="<?php echo $alt;?>" border="0" class="border-img"/>
                </a> 
            <?php 
            } ?>
            </legend>
            
            
			<?php
            	$checked_urgent= $_REQUEST['date_fin_urgent']=='y' ? 'checked="checked"' : ""; 
            	$checked_premium= $_REQUEST['date_fin_premium']=='y' ? 'checked="checked"' : ""; 
            	$checked_couleur= $_REQUEST['date_fin_couleur']=='y' ? 'checked="checked"' : ""; 
            	$checked_republication= $_REQUEST['date_fin_republication']=='y' ? 'checked="checked"' : ""; 
			?>
            
<div style="margin-bottom:10px;">
<label for="urgent" name="date_fin_urgent" id="date_fin_urgent">
<input type="checkbox" name="urgent" id="urgent" value="3" force_extend_p2p="" class="target" onclick="check_checkbox()" <?=$checked_urgent;?>  > 
    Annonce en Urgent: Attirer l'attention sur votre annonce! " 15 jours - 3€ "
</label>
</div>

<div style="margin-bottom:10px;">   
<label for="premium" name="date_fin_premium" id="date_fin_premium">
<input type="checkbox" name="premium" id="premium" value="13" force_extend_p2p="" class="target" onclick="check_checkbox()" <?=$checked_premium;?>/>
   Annonce en Premium: Votre annonce sera placée au dessus des annonces gratuites " 30 jours - 13€ "
</label>
</div>

<div style="margin-bottom:10px;">
<label for="couleur" name="date_fin_couleur" id="date_fin_couleur">
<input type="checkbox" name="couleur" id="couleur" value="3" force_extend_p2p="" class="target" onclick="check_checkbox()" <?=$checked_couleur;?>/>
    Annonce en Couleur: Votre annonce sera surlignée en orange " 30 jours - 3€ "
</label>
</div>

<div style="margin-bottom:10px;">
<label for="republication" name="date_fin_republication" id="date_fin_republication">
<input type="checkbox" name="republication" id="republication" value="8" force_extend_p2p="" class="target" onclick="check_checkbox()" <?=$checked_republication;?>/>
    Republication Auto: Votre annonce sera automatiquement republiée en tête de liste toutes les jours " 30 jours - 8€ "
</label>
</div>

        </fieldset>
    </div>
    
    <input id="submit_button" name="submit_button" type="submit" class="button button-green"  /><!--value="Non merci, aller sur mon compte" >-->
         
</form>


<script type="text/javascript">
	
function check_checkbox(){
	var total=0;

	if($("#urgent").is(':checked')){
		//alert($("#urgent").is(':checked'));
		total=Number(total)+Number($("#urgent").val());
	}
	
	
	if($("#premium").is(':checked')){
		//alert($("#premium").is(':checked'));
		total=Number(total)+Number($("#premium").val());
	}
	
	if($("#couleur").is(':checked')){
		//alert($("#couleur").is(':checked'));
		total=Number(total)+Number($("#couleur").val());
	}
	
	
	if($("#republication").is(':checked')){
		//alert($("#republication").is(':checked'));
		total=Number(total)+Number($("#republication").val());
	}

	if(Number(total)!=0){
		$("#submit_button").val("Continuer vers paiement");
		$("#upgrade_form").attr("action", "paiement.php");
		//alert(total);		
	}
	else{
		$("#submit_button").val("Non merci, aller sur mon compte");
		$("#upgrade_form").attr("action", "my-account-manage.php");
	}

}
		
	
	$(document).ready(function() {
		$("#submit_button").removeClass("ui-btn-hidden");
		check_checkbox();
		/*
		$("#submit_button").click(function(){
			document.frm.submit();
		});
		*/
			/*
			
			
			
		$('input[type="checkbox"]').filter('.target').map(function(){
		   if($(this).is(':checked')){
		   }
		   else{
			 // perform operation for unchecked
				//alert(this.id+' unchecked');
				
				if(this.id == "urgent"){
					total=Number(total)-Number($(this).val());
					
					
					$("#amount").html('').append(Number(total));
					$("#ligne_urgent").css("display", "none");
					$("#amountHaut").html('').append(Number(total));
					$("#ligneHaut_urgent").css("display", "none");
			
			   }
				
				if(this.id == "premium"){
					total=Number(total)-Number($(this).val());
					
					$("#amount").html('').append(Number(total));
					$("#ligne_premium").css("display", "none");
					$("#amountHaut").html('').append(Number(total));
					$("#ligneHaut_premium").css("display", "none");
					
				}
				
				if(this.id == "couleur"){
					total=Number(total)-Number($(this).val());
					
					$("#amount").html('').append(Number(total));
					$("#ligne_couleur").css("display", "none");
					$("#amountHaut").html('').append(Number(total));
					$("#ligneHaut_couleur").css("display", "none");
					
				}
				
				if(this.id == "republication"){
					total=Number(total)-Number($(this).val());
					
					$("#amount").html('').append(Number(total));
					$("#ligne_republication").css("display", "none");
					$("#amountHaut").html('').append(Number(total));
					$("#ligneHaut_republication").css("display", "none");
					
				}
		   }
		   
		   
		   
		   
		$("#urgent").click(function(){
			alert("ur1");
		});
		
		$("#date_fin_urgent").click(function(){
			if($("#urgent").is(':checked')){
				alert(this.id+'checked');
			}
			alert($("#urgent").is(':checked'));
			alert("ur2");
		});
			*/
		/*
	$( ".target" ).click(function() {
		
		alert('rr');
		element=this.id;
		alert(element);
		
		var isChecked =  $('#urgent').is(':checked');
		alert(isChecked);
		
		//alert(("#date_fin_urgent").attr('checked'));
		
		if(("#urgent").is(':checked')){
			alert(total);
			total=Number(total)+Number($("#date_fin_urgent").val());
			
			$("#amount").html('').append(Number(total));
			$("#ligne_urgent").css("display", "");
			$("#amountHaut").html('').append(Number(total));
			$("#ligneHaut_urgent").css("display", "");
		}
	});
	
		
		if($("#date_fin_premium").attr('checked')){
			total=Number(total)+Number($("#date_fin_premium").val());
			
			$("#amount").html('').append(Number(total));
			$("#ligne_premium").css("display", "");
			$("#amountHaut").html('').append(Number(total));
			$("#ligneHaut_premium").css("display", "");
		}
		if($("#date_fin_couleur").attr('checked')){
			total=Number(total)+Number($("#date_fin_couleur").val());
			
			$("#amount").html('').append(Number(total));
			$("#ligne_couleur").css("display", "");
			$("#amountHaut").html('').append(Number(total));
			$("#ligneHaut_couleur").css("display", "");
		}
		
		if($("#date_fin_republication").attr('checked')){
			total=Number(total)+Number($("#date_fin_republication").val());
			
			$("#amount").html('').append(Number(total));
			$("#ligne_republication").css("display", "");
			$("#amountHaut").html('').append(Number(total));
			$("#ligneHaut_republication").css("display", "");
		}
		
		
		if(Number(total)==0){
			$("#submit_button").val("Non merci, aller sur mon compte");
		}
		else{
			$("#submit_button").val("Continuer vers paiement");
		}
		
		
		$("#date_fin_urgent").click(function(){

			if ($(this).attr('checked')) {
				total=Number(total)+Number($(this).val());
				
				$("#amount").html('').append(Number(total));
				$("#ligne_urgent").css("display", "");
				$("#amountHaut").html('').append(Number(total));
				$("#ligneHaut_urgent").css("display", "");
			}
			else{
				total=Number(total)-Number($(this).val());
							
				$("#amount").html('').append(Number(total));
				$("#ligne_urgent").css("display", "none");
				$("#amountHaut").html('').append(Number(total));
				$("#ligneHaut_urgent").css("display", "none");
			}
			
			if(Number(total)==0){
				$("#submit_button").val("Non merci, aller sur mon compte");
			}
			else{
				$("#submit_button").val("Continuer vers paiement");
			}
		});
		
		
		
		$("#date_fin_premium").click(function(){
			
			if ($(this).attr('checked')) {
				total=Number(total)+Number($(this).val());
				
				$("#amount").html('').append(Number(total));
				$("#ligne_premium").css("display", "");
				$("#amountHaut").html('').append(Number(total));
				$("#ligneHaut_premium").css("display", "");
			}
			else{
				total=Number(total)-Number($(this).val());
				
				$("#amount").html('').append(Number(total));
				$("#ligne_premium").css("display", "none");
				$("#amountHaut").html('').append(Number(total));
				$("#ligneHaut_premium").css("display", "none");
			}
			
			if(Number(total)==0){
				$("#submit_button").val("Non merci, aller sur mon compte");
			}
			else{
				$("#submit_button").val("Continuer vers paiement");
			}
		});
		
		
		$("#date_fin_couleur").click(function(){
			
			if ($(this).attr('checked')) {
				total=Number(total)+Number($(this).val());
				
				$("#amount").html('').append(Number(total));
				$("#ligne_couleur").css("display", "");
				$("#amountHaut").html('').append(Number(total));
				$("#ligneHaut_couleur").css("display", "");
			}
			else{
				total=Number(total)-Number($(this).val());
				
				$("#amount").html('').append(Number(total));
				$("#ligne_couleur").css("display", "none");
				$("#amountHaut").html('').append(Number(total));
				$("#ligneHaut_couleur").css("display", "none");
			}
			
			if(Number(total)==0){
				$("#submit_button").val("Non merci, aller sur mon compte");
			}
			else{
				$("#submit_button").val("Continuer vers paiement");
			}
		});
		
		
		
		
		$("#date_fin_republication").click(function(){
			
			if ($(this).attr('checked')) {
				total=Number(total)+Number($(this).val());
				
				$("#amount").html('').append(Number(total));
				$("#ligne_republication").css("display", "");
				$("#amountHaut").html('').append(Number(total));
				$("#ligneHaut_republication").css("display", "");
			}
			else{
				total=Number(total)-Number($(this).val());
				
				$("#amount").html('').append(Number(total));
				$("#ligne_republication").css("display", "none");
				$("#amountHaut").html('').append(Number(total));
				$("#ligneHaut_republication").css("display", "none");
			}
			
			if(Number(total)==0){
				$("#submit_button").val("Non merci, aller sur mon compte");
			}
			else{
				$("#submit_button").val("Continuer vers paiement");
			}
		});
		
		
		$("#selectall_plan_id").click(function(){
			
			if($(this).attr('checked')) {
				$("#date_fin_premium").attr("checked",true);
				$("#date_fin_couleur").attr("checked",true);
				$("#date_fin_republication").attr("checked",true);
				
				total=
						Number($("#date_fin_premium").val())
						+
						Number($("#date_fin_couleur").val())
						+
						Number($("#date_fin_republication").val());
				
				if ($("#date_fin_urgent").attr('checked')) {
					total=Number(total)+Number($("#date_fin_urgent").val());
				}
				
				
				$("#ligne_premium").css("display", "");
				$("#date_fin_premium").attr('disabled','disabled');
				$("#ligneHaut_premium").css("display", "");
				$("#dateHaut_fin_premium").attr('disabled','disabled');
				
				$("#ligne_couleur").css("display", "");
				$("#date_fin_couleur").attr('disabled','disabled');
				$("#ligneHaut_couleur").css("display", "");
				$("#dateHaut_fin_couleur").attr('disabled','disabled');
				
				$("#ligne_republication").css("display", "");
				$("#date_fin_republication").attr('disabled','disabled');
				$("#ligneHaut_republication").css("display", "");
				$("#dateHaut_fin_republication").attr('disabled','disabled');
				
				$("#amount").html('').append(Number(total));
				$("#amountHaut").html('').append(Number(total));
			}
			else{
				$("#date_fin_premium").attr("checked",false);
				$("#date_fin_couleur").attr("checked",false);
				$("#date_fin_republication").attr("checked",false);
				
				total=Number(total)-(
										Number($("#date_fin_premium").val())
										+
										Number($("#date_fin_couleur").val())
										+
										Number($("#date_fin_republication").val())
									);
				
				
				
				$("#ligne_premium").css("display", "none");
				$("#date_fin_premium").removeAttr("disabled");
				$("#ligneHaut_premium").css("display", "none");
				$("#dateHaut_fin_premium").removeAttr("disabled");
				
				$("#ligne_couleur").css("display", "none");
				$("#date_fin_couleur").removeAttr("disabled");
				$("#ligneHaut_couleur").css("display", "none");
				$("#dateHaut_fin_couleur").removeAttr("disabled");
				
				$("#ligne_republication").css("display", "none");
				$("#date_fin_republication").removeAttr("disabled");
				$("#ligneHaut_republication").css("display", "none");
				$("#dateHaut_fin_republication").removeAttr("disabled");
				
				$("#amount").html('').append(Number(total));
				$("#amountHaut").html('').append(Number(total));
			}
			
			if(Number(total)!=0){
				$("#submit_button").val("Continuer vers paiement");
			}
		});
		
		
		$("#submit_button").click(function(){
			
			if(Number(total)==0){
				$("#upgrade_form").attr("action", "my-account-manage.php");
			}
			else{
				$("#upgrade_form").attr("action", "paiement.php");
			}
			
			document.frm.submit();
		});
		*/
	});		
</script>
  