<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("header.inc.php");
require_once("multiple-currency.php");
//chk_user_login();

$clsId = secureValue($_REQUEST[clsId]);

if($clsId=='')
	$clsId=$_COOKIE['clsId'];
else
	$_COOKIE['clsId']=$clsId;
	$date_fin_premium = secureValue($_REQUEST[date_fin_premium]);
	$date_fin_couleur = secureValue($_REQUEST[date_fin_couleur]);
	$date_fin_republication = secureValue($_REQUEST[date_fin_republication]);
	$date_fin_urgent = secureValue($_REQUEST[date_fin_urgent]);

?>
<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-1.js"></script>

<?php
	$sql_clsi="select * from tbl_classified where classified_id=$clsId and classified_status!='Delete' "; 
	
	$sql_rs_set=db_query($sql_clsi);
	$res=mysql_fetch_array($sql_rs_set);
	
	$sql_img="select * from tbl_classified_image where clsd_id='$res[classified_id]' and img_status='Y'";
	$sql_img_set=db_query($sql_img);
	
		if(mysql_num_rows($sql_img_set) > 0 ) {
			$km=0;
			while($res1=mysql_fetch_array($sql_img_set)){        
				$file_sm="mobile/uploaded_files/classified_img/".$res1[cls_img_file];    
				$autoID[]=$res1['clsd_img_id']; 
				if($res1[cls_img_file]!=""){
					//$file_path_sm	 =	 show_thumb($file_sm,"65","65","width");
					//$file_path_big	 =	show_thumb($file_sm,"450","550","width");
					//$sz=getimagesize($file_path_sm);
					//$sz_big=getimagesize($file_path_big);
					
					$dis=($km==0) ? 'display:block;' : 'display:none;';
					
					$im_small='<a href="javascript:void(0);" onmouseover="show_gall('.$km.',7);"">
								<img src="'.$file_sm.'" alt="" width="90" height="90" border="0" />
								</a>';
					$im_big='
							<div class="m-item">
								<img src="'.$file_sm.'" alt=""  border="0" width="90px" height="90px">
							</div>
							';		  
					
					$im_arr_small[]= $im_small;
					$joom_link[]= '<a href="'.$file_path_big.'" title="" class="link" id="gallzoom_1_'.$km.'" style="'.$dis.'" rel="lightbox[me]"></a>';
					$im_arr_big[]= $im_big;	  
					$km++;
				}
			}
	   }
?>
<div class="grid_3">&nbsp;</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">

    <form id="upgrade_form" method="POST" action="" >
    	<input type="hidden" name="clsId" id="clsId" value="<?php echo $clsId;?>" />
        
        <div class="box-simple">
        	<table border="0" width="100%">
            	<tr bgcolor="#FFFFFF">
                	<td colspan="2"><label class="titre">Option(s) choisie(s) de mise en avant:</label></td>
                </tr>
                <tr id="ligneHaut_premium" style="display: none;">
                    <td width="50%">Annonce Premium + Protection Mail:</td>
                    <td width="50%">30 jours (13 + 3)€</td>
                </tr>
                <tr id="ligneHaut_couleur" style="display: none;">
                    <td width="50%">Annonce en Couleur :</td>
                    <td width="50%">30 jours (3)€</td>
                </tr>
                <tr id="ligneHaut_republication" style="display: none;">
                    <td width="50%">Republication Auto :</td>
                    <td width="50%">30 jours (8)€</td>
                </tr>
                <tr id="ligneHaut_urgent" style="display: none;">
                    <td width="50%">Option URGENT :</td>
                    <td width="50%">15 jours (3)€</td>
                </tr>
                <tr>
                    <td width="50%">TOTAL :</td>
                    <td width="50%"><span id="amountHaut">0</span>€</td>
                </tr>
			</table>
		</div>
        <br>
        
        <div>
            <label class="titre">Offrez une meilleure visibilité à votre annonce</label>
        </div>
        
        <div class="box-simple">
            <table style="width: 100%;">
                <tbody>
                <tr>
                    <td>
                          <?php if(count($im_arr_big)>1) {
                             echo $im_arr_big[0];
                           }else{?>
                              <a href="<?php echo $html_link;?>">
                             <img src="images/blank-img.gif" alt="<?php echo $alt;?>" border="0" class="border-img"/>
                              </a> 
                          <?php } ?>
                    </td>
                    <td>
                        <div>
                            <h3 class="green-heading">
                                <?php echo Rec_display_formate(truncateText($res[classified_title],70,' ','...',true));?>
                            </h3>
                        </div>
                        <div>
                        	Choisissez l'option <span class="premium">URGENT</span> et attirez l'attention sur votre annonce!
                        </div>
                <?php
                    $d=$date_fin_urgent=='y' ? 'checked' : '';
					
                ?>
                		<div>
                        	<input type="checkbox" name="date_fin_urgent" id="date_fin_urgent" value="3" <?php echo $d; ?>> 15 jours - 3€
                        </div>
                   </td>
                </tr>
                </tbody>
            </table>
        </div>
            
        <div id="personel_y" style=" display:block; padding:10px; height:350px;" >
            <div class="plan-block">
                <h4 class="green-heading">
                    Toutes les Options
                </h4> 
                <p class="commentaire">
                    Votre annonce sera mise en Premium, en Couleur et Automatiquement repostée toutes les jours
                </p>
                <div class="icon-slect-all"></div>
                <div class="commentaire">                  
                    <input type="checkbox" id="selectall_plan_id" name="selectall_plan_id" value="y" price="y" force_extend_p2p="">
                    Sélectionner toutes les options
                </div>
            </div>

            <div class="select-all">
                <img src="images/select-all.png">
            </div>

            <div class="plan-block">
                <h3 class="green-heading">Annonce Premium</h3>
                <p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p>
                <div class="icon-premium"></div>
                <div class="commentaire">                            
                <?php
                    $d=$date_fin_premium=='y' ? 'checked' : '';
                ?>
                    <input type="checkbox" name="date_fin_premium" id="date_fin_premium" value="13" force_extend_p2p="" <?php echo $d; ?>>30 jours - 13€
                </div>
            </div>

            <div id="upgrade_highlight" class="plan-block">
                <h3 class="green-heading">Annonce en Couleur</h3>
                <p class="commentaire">Votre annonce sera surlignée en orange</p>
                <div class="icon-couleur"></div>
                <div class="commentaire">
                <?php
                    $d=$date_fin_couleur=='y' ? 'checked' : '';
                ?>
                    <input type="checkbox" name="date_fin_couleur" id="date_fin_couleur" value="3" force_extend_p2p=""
                    <?php echo $d; ?>>30 jours - 3€ 
                </div>
            </div>

            <div id="upgrade_repost" class="plan-block">
                <h3 class="green-heading">Republication Auto</h3>
                <p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste toutes les jours.</p>
                <div class="icon-republication"></div>
                <div class="commentaire">
                <?php
                    $d=$date_fin_republication=='y' ? 'checked' : '';
                ?>
                <input type="checkbox" name="date_fin_republication" id="date_fin_republication" value="8" force_extend_p2p="" <?php echo $d; ?>>30 jours - 8€
                </div>
            </div>
        </div>
        
        <div class="box-simple">
        	<table border="0" width="100%" style="text-align:right;">
                <tr id="ligne_premium" style="display: none;">
                	<td width="50%">&nbsp;</td>
                    <td width="25%">Annonce Premium :</td>
                    <td width="25%">30 jours (13)€</td>
                </tr>
                <tr id="ligne_couleur" style="display: none;">
                    <td width="50%">&nbsp;</td>
                    <td width="25%">Annonce en Couleur :</td>
                    <td width="25%">30 jours (3)€</td>
                </tr>
                <tr id="ligne_republication" style="display: none;">
                    <td width="50%">&nbsp;</td>
                    <td width="25%">Republication Auto :</td>
                    <td width="25%">30 jours (8)€</td>
                </tr>
                <tr id="ligne_urgent" style="display: none;">
                    <td width="50%">&nbsp;</td>
                    <td width="25%">Option URGENT :</td>
                    <td width="25%">15 jours (3)€</td>
                </tr>
                <tr>
                	<td width="50%">&nbsp;</td>
                    <td width="25%">TOTAL :</td>
                    <td width="25%"><span id="amount">0</span>€</td>
                </tr>
			</table>
        </div>
        
        <table style="text-align:right; width:100%">
            <tr>
            	<td>
                	<!--<div class="commentaire tr" style="color:#009900; font-weight:bold;">Contactez notre service client au : 09.70.40.54.73</div>-->
                </td>
                <td>
                    <input id="submit_button" name="submit_button" type="submit" class="button button-green">
                </td>
            </tr>
        </table>
    </form>

</div>
<script type="text/javascript">
var total=0;
	$(document).ready(function() {
		
		if($("#date_fin_urgent").attr('checked')){
			total=Number(total)+Number($("#date_fin_urgent").val());
			
			$("#amount").html('').append(Number(total));
			$("#ligne_urgent").css("display", "");
			$("#amountHaut").html('').append(Number(total));
			$("#ligneHaut_urgent").css("display", "");
		}
		
		if($("#date_fin_premium").attr('checked')){
			total=Number(total)+Number($("#date_fin_premium").val())+3;
			
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
			
			if(Number(total)==0){
				$("#submit_button").val("Non merci, aller sur mon compte");
			}
			else{
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
	});		
</script>

<?php require_once("footer.inc.php"); ?>