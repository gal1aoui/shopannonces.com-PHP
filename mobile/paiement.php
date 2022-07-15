<?php
require_once("header.php");

chk_user_login();

$clsId = secureValue($_POST['clsId']);
if(!empty($clsId))
	$_SESSION['clsId']=$clsId;

$date_fin_urgent = secureValue($_POST["urgent"]);
if(!empty($date_fin_urgent))
	$_SESSION['optionselected']['date_fin_urgent']= $date_fin_urgent;


$date_fin_premium = secureValue($_POST["premium"]);
if(!empty($date_fin_premium))
	$_SESSION['optionselected']['date_fin_premium']=$date_fin_premium;


$date_fin_couleur = secureValue($_POST["couleur"]);
if(!empty($date_fin_couleur))
	$_SESSION['optionselected']['date_fin_couleur']=$date_fin_couleur;


$date_fin_republication = secureValue($_POST["republication"]);
if(!empty($date_fin_republication))
	$_SESSION['optionselected']['date_fin_republication']=$date_fin_republication;

$_SESSION['clsId'];
$_SESSION['optionselected']['date_fin_urgent'];
$_SESSION['optionselected']['date_fin_premium'];
$_SESSION['optionselected']['date_fin_couleur'];
$_SESSION['optionselected']['date_fin_republication'];

	
unset($_SESSION['deja_passe']);
?>

<label>
	Vous avez sélectionné le plan suivant:
</label>
    <br />


<table width="100%">
<thead>
</thead>

<tbody>
    
	<?php	
    if($_SESSION['optionselected']["date_fin_urgent"]!='' && $_SESSION['optionselected']["date_fin_couleur"]!='' && $_SESSION['optionselected']["date_fin_premium"]!='' && $_SESSION['optionselected']["date_fin_republication"]!=''){
    
    $codeDoc='152773';		
    ?>
    <tr class="bg-stripcolor">
        <td><b>Urgent</b><p class="commentaire">Attirez l'attention sur votre annonce!  15 jours - 3 €</p></td>
        <td>15 Jours</td>
        <td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Annonce Premium</b><p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p></td>
        <td>30 Jours</td>
        <td>13€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Annonce en Couleur</b><p class="commentaire">Votre annonce sera surlignée en orange</p></td>
        <td>30 Jours</td>
        <td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Republication Auto</b><p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste tous les jours</p></td>
        <td>30 Jours</td>
        <td>8€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>27€</td>
    </tr>
    <?php
    $total=27;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]!='' && $_SESSION['optionselected']["date_fin_couleur"]=='' && $_SESSION['optionselected']["date_fin_premium"]=='' && $_SESSION['optionselected']["date_fin_republication"]==''){
    $codeDoc='152766';
    ?>
    <tr class="bg-stripcolor">
        <td><b>Urgent</b><p class="commentaire">Attirez l'attention sur votre annonce!  15 jours - 3 €</p></td>
        <td>15 Jours</td>
        <td>3€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>3€</td>
    </tr>
    <?php
    $total=3;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]=='' && $_SESSION['optionselected']["date_fin_couleur"]!='' && $_SESSION['optionselected']["date_fin_premium"]=='' && $_SESSION['optionselected']["date_fin_republication"]==''){
    $codeDoc='152760';		
    ?>
    <tr class="bg-stripcolor">
    	<td><b>Annonce en Couleur</b><p class="commentaire">Votre annonce sera surlignée en orange</p></td><td>30 Jours</td><td>3€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>3€</td>
    </tr>
    <?php
    $total=3;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]=='' && $_SESSION['optionselected']["date_fin_couleur"]=='' && $_SESSION['optionselected']["date_fin_premium"]!='' && $_SESSION['optionselected']["date_fin_republication"]==''){
    $codeDoc='152762';		
    ?>
    <tr class="bg-stripcolor">
        <td><b>Annonce Premium</b><p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p></td>
        <td>30 Jours</td>
        <td>13€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>13€</td>
    </tr>
    <?php
    $total=13;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]=='' && $_SESSION['optionselected']["date_fin_couleur"]=='' && $_SESSION['optionselected']["date_fin_premium"]=='' && $_SESSION['optionselected']["date_fin_republication"]!=''){
    $codeDoc='152765';		
    ?>
    <tr class="bg-stripcolor">
        <td><b>Republication Auto</b><p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste tous les jours</p></td>
        <td>30 Jours</td>
        <td>8€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>8€</td>
    </tr>
    <?php
    $total=8;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]!='' && $_SESSION['optionselected']["date_fin_couleur"]=='' && $_SESSION['optionselected']["date_fin_premium"]!='' && $_SESSION['optionselected']["date_fin_republication"]==''){
    $codeDoc='152770';		
    ?>
    <tr class="bg-stripcolor">
        <td><b>Urgent</b><p class="commentaire">Attirez l'attention sur votre annonce!  15 jours - 3 €</p></td>
        <td>15 Jours</td>
        <td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Annonce Premium</b><p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p></td>
        <td>30 Jours</td>
        <td>13€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>16€</td>
    </tr>
    <?php
    $total=16;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]!='' && $_SESSION['optionselected']["date_fin_couleur"]!='' && $_SESSION['optionselected']["date_fin_premium"]=='' && $_SESSION['optionselected']["date_fin_republication"]==''){
    $codeDoc='152767';		
    ?>
    <tr class="bg-stripcolor">
        <td><b>Urgent</b><p class="commentaire">Attirez l'attention sur votre annonce!  15 jours - 3 €</p></td>
        <td>15 Jours</td>
        <td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Annonce en Couleur</b><p class="commentaire">Votre annonce sera surlignée en orange</p></td>
        <td>30 Jours</td>
        <td>3€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>6€</td>
    </tr>
    <?php
    $total=6;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]=='' && $_SESSION['optionselected']["date_fin_couleur"]!='' && $_SESSION['optionselected']["date_fin_premium"]!='' && $_SESSION['optionselected']["date_fin_republication"]==''){
    $codeDoc='152763';		
    ?>
    <tr class="bg-stripcolor">
        <td><b>Annonce Premium</b><p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p></td>
        <td>30 Jours</td>
        <td>13€</td>
    </tr>
    <tr class="bg-stripcolor">
    	<td><b>Annonce en Couleur</b><p class="commentaire">Votre annonce sera surlignée en orange</p></td><td>30 Jours</td><td>3€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>16€</td>
    </tr>
    <?php
    $total=16;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]!='' && $_SESSION['optionselected']["date_fin_couleur"]!='' && $_SESSION['optionselected']["date_fin_premium"]!='' && $_SESSION['optionselected']["date_fin_republication"]==''){
    $codeDoc='152771';		
    ?>
    <tr class="bg-stripcolor">
        <td><b>Urgent</b><p class="commentaire">Attirez l'attention sur votre annonce!  15 jours - 3 €</p></td>
        <td>15 Jours</td>
        <td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Annonce Premium</b><p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p></td>
        <td>30 Jours</td>
        <td>13€</td>
    </tr>
    <tr class="bg-stripcolor">
    	<td>Annonce en Couleur</b><p class="commentaire">Votre annonce sera surlignée en orange</p></td><td>30 Jours</td><td>3€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>19€</td>
    </tr>
    <?php
    $total=19;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]!='' && $_SESSION['optionselected']["date_fin_couleur"]=='' && $_SESSION['optionselected']["date_fin_premium"]=='' && $_SESSION['optionselected']["date_fin_republication"]!=''){
    $codeDoc='152775';
    
    ?>
    <tr class="bg-stripcolor">
        <td><b>Urgent</b><p class="commentaire">Attirez l'attention sur votre annonce!  15 jours - 3 €</p></td>
        <td>15 Jours</td>
        <td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Republication Auto</b><p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste tous les jours</p></td>
        <td>30 Jours</td>
        <td>8€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>11€</td>
    </tr>
    <?php
    $total=11;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]=='' && $_SESSION['optionselected']["date_fin_couleur"]=='' && $_SESSION['optionselected']["date_fin_premium"]!='' && $_SESSION['optionselected']["date_fin_republication"]!=''){
    $codeDoc='152764';		
    ?>
    <tr class="bg-stripcolor">
        <td><b>Annonce Premium</b><p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p></td>
        <td>30 Jours</td>
        <td>13€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Republication Auto</b><p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste tous les jours</p></td>
        <td>30 Jours</td>
        <td>8€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>21€</td>
    </tr>
    <?php
    $total=21;
    }
    else if(
    ($_SESSION['optionselected']["date_fin_urgent"]!='' && $_SESSION['optionselected']["date_fin_couleur"]=='' && $_SESSION['optionselected']["date_fin_premium"]!='' && $_SESSION['optionselected']["date_fin_republication"]!='')
    ){
    $codeDoc='152774';
    
    ?>
    <tr class="bg-stripcolor">
        <td><b>Urgent</b><p class="commentaire">Attirez l'attention sur votre annonce!  15 jours - 3 €</p></td>
        <td>15 Jours</td>
        <td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Annonce Premium</b><p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p></td>
        <td>30 Jours</td>
        <td>13€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Republication Auto</b><p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste tous les jours</p></td>
        <td>30 Jours</td>
        <td>8€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>24€</td>
    </tr>
    <?php
    $total=24;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]=='' && $_SESSION['optionselected']["date_fin_couleur"]!='' && $_SESSION['optionselected']["date_fin_premium"]=='' && $_SESSION['optionselected']["date_fin_republication"]!=''){
    $codeDoc='152761';
    
    ?>
    <tr class="bg-stripcolor">
    	<td><b>Annonce en Couleur</b><p class="commentaire">Votre annonce sera surlignée en orange</p></td>
        <td>30 Jours</td>
        <td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Republication Auto</b><p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste tous les jours</p></td>
        <td>30 Jours</td>
        <td>8€</td>
    </tr>
    <tr class="">
    	<td colspan="2" align="left">Total:</td><td>11€</td>
    </tr>
    <?php
    $total=11;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]!='' && $_SESSION['optionselected']["date_fin_couleur"]!='' && $_SESSION['optionselected']["date_fin_premium"]=='' && $_SESSION['optionselected']["date_fin_republication"]!=''){
    $codeDoc='152768';
    
    ?>
    <tr class="bg-stripcolor">
        <td><b>Urgent</b><p class="commentaire">Attirez l'attention sur votre annonce!  15 jours - 3 €</p></td>
        <td>15 Jours</td>
        <td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
    	<td><b>Annonce en Couleur</b><p class="commentaire">Votre annonce sera surlignée en orange</p></td><td>30 Jours</td><td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Republication Auto</b><p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste tous les jours</p></td>
        <td>30 Jours</td>
        <td>8€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>14€</td>
    </tr>
    <?php
    $total=14;
    }
    else if($_SESSION['optionselected']["date_fin_urgent"]=='' && ($_SESSION['optionselected']["date_fin_couleur"]!='' && $_SESSION['optionselected']["date_fin_premium"]!='' && $_SESSION['optionselected']["date_fin_republication"]!='' || $_SESSION['optionselected']["selectall_plan_id"]=='y')){
    $codeDoc='152777';		
    ?>
    <tr class="bg-stripcolor">
        <td><b>Annonce Premium</b><p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p></td>
        <td>30 Jours</td>
        <td>13€</td>
    </tr>
    <tr class="bg-stripcolor">
    	<td><b>Annonce en Couleur</b><p class="commentaire">Votre annonce sera surlignée en orange</p></td><td>30 Jours</td><td>3€</td>
    </tr>
    <tr class="bg-stripcolor">
        <td><b>Republication Auto</b><p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste tous les jours</p></td>
        <td>30 Jours</td>
        <td>8€</td>
    </tr>
    <tr>
    	<td colspan="2" align="left">Total:</td><td>24€</td>
    </tr>
    <?php
    $total=24;
    }
    
    ?>
</tbody>
</table>


<label>
        <?php
        $optionSelected="classified-option.php?clsId=".$_SESSION['clsId'];
        
        if($_SESSION['optionselected']["date_fin_urgent"]!=''){
            $optionSelected.="&date_fin_urgent=y";
        }
        if($_SESSION['optionselected']["date_fin_couleur"]!=''){
            $optionSelected.="&date_fin_couleur=y";
        }
        if($_SESSION['optionselected']["date_fin_premium"]!=''){
            $optionSelected.="&date_fin_premium=y";
        }
        if($_SESSION['optionselected']["date_fin_republication"]!=''){
            $optionSelected.="&date_fin_republication=y";
        }
        ?>
        
        <a href="<?php echo PATH.$optionSelected;?>" style="text-decoration:none">Modifier mes options</a>
</label>

    <label class="titre">Paiement 100% sécurisé <img src="images/cadenat.png" width="16" height="16" /></label>


<input type="radio" name="methode" id="starpass" value="starpass" checked="checked" onclick="click_radiobox()" />
<label for="starpass">Starpass</label>


<br />
<input type="radio" name="methode" id="credit" value="credit" onclick="click_radiobox()" />
<label for="credit">Utiliser Votre Crédit</label>
<br />

<div id="div_starpass">

<div id="starpass_<?php echo $codeDoc;?>"></div>
<script type="text/javascript" src="http://script.starpass.fr/script.php?idd=<?php echo $codeDoc;?>&amp;datas=<?php echo $codeDoc;?>"></script>
<noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br /><a href="http://www.starpass.fr/">Micropaiement StarPass</a></noscript>

</div>



<div class="box-simple" id="div_credit" style="display:none;">
	<p>
        Votre crédit disponible: <?=$credits;?> TTC
	</p>
    <p>
    	vous désirez payer: <?=$total;?> 
	</p>
    
    <!-- test solde-->
    <?php
    	if($credits>=$total){
			//paiement autorisé
			?>
                <form id="upgrade_form" method="POST" action="<?php echo PATH;?>paiement_credits.php" >
                	<input type="hidden" name="codeoption" value="<?=$codeDoc?>" />
                	Montant total: <input type="text" name="amount" value="<?=display_price($total);?>" class="textbox" readonly="" />
                    <input type="submit" name="Submit" value="Payer maintenant" class="button button-green">
                </form>
            <?php
		}
		else{
			//paiement non autorisé
			?>
                <form id="upgrade_form" method="POST" action="<?php echo PATH;?>credits.php" >
                    Votre crédit est insuffisant, si vous désirez créditer votre compte
                    <input id="submit_button" name="submit_button" type="submit" class="button button-green" value="créditer">
                </form>
            <?php
		}
	?>
</div>





<script type="text/javascript">

	function click_radiobox(){
		
		if($("#starpass").is(':checked')){
			$("#div_starpass").css("display", "");
			$("#div_credit").css("display", "none");
		}
		
		if($("#credit").is(':checked')){
			$("#div_starpass").css("display", "none");
			$("#div_credit").css("display", "");
		}
		
	}

</script>

<style>
	#starpass_152773 #sk-kit,
	#starpass_152766 #sk-kit,
	#starpass_152760 #sk-kit,
	#starpass_152762 #sk-kit,
	#starpass_152765 #sk-kit,
	#starpass_152770 #sk-kit,
	#starpass_152767 #sk-kit,
	#starpass_152763 #sk-kit,
	#starpass_152771 #sk-kit,
	#starpass_152775 #sk-kit,
	#starpass_152764 #sk-kit,
	#starpass_152774 #sk-kit,
	#starpass_152761 #sk-kit,
	#starpass_152768 #sk-kit,
	#starpass_152777 #sk-kit{
		margin:0px;
	}
</style>
<?php require_once("footer.php"); ?>