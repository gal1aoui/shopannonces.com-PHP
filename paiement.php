<?php

require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("header.inc.php");
require_once("arrays.inc.php");

chk_user_login();

$clsId = secureValue($_POST[clsId]);
$_SESSION['clsId']=$clsId;

unset($_SESSION['deja_passe']);
?>

<script type="text/javascript" src="js/jquery.js"></script>
<script type="text/javascript" src="js/jquery-1.js"></script>

<br>


<div class="grid_16 box-simple">
	<table width="100%" bgcolor="#FFFFFF" cellspacing="0">
    	<tr>
        	<td colspan="3" class="tree">
                <table width="100%" border="0">
                    <tr>
                        <td width="75%">
                            Vous avez sélectionné le plan suivant:
                        </td>
                        <td width="25%" align="right">
                        	<?php
                        	$optionSelected="classified-option.php?clsId=".$clsId;
							
							if($_POST["selectall_plan_id"]!=''){
								$optionSelected.="&date_fin_premium=y&date_fin_republication=y&date_fin_urgent=y&date_fin_couleur=y";
							}
							if($_POST["date_fin_urgent"]!=''){
								$optionSelected.="&date_fin_urgent=y";
							}
							if($_POST["date_fin_couleur"]!=''){
								$optionSelected.="&date_fin_couleur=y";
							}
							if($_POST["date_fin_premium"]!=''){
								$optionSelected.="&date_fin_premium=y";
							}
							if($_POST["date_fin_republication"]!=''){
								$optionSelected.="&date_fin_republication=y";
							}
							?>
                            
                            <a href="<?php echo PATH.$optionSelected;?>" style="text-decoration:none">Modifier mes options</a>
                        </td>
                    </tr>
                </table>
			</td>
        </tr>
                
<?php	
	 if($_POST["date_fin_urgent"]!='' && ($_POST["selectall_plan_id"]=='y' 
	 										|| 
										($_POST["date_fin_couleur"]!='' && $_POST["date_fin_premium"]!='' && $_POST["date_fin_republication"]!=''))){
		$codeDoc='404423';		
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
	else if($_POST["date_fin_urgent"]!='' && $_POST["date_fin_couleur"]=='' && $_POST["date_fin_premium"]=='' && $_POST["date_fin_republication"]==''){
		$codeDoc='404418';
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
	else if($_POST["date_fin_urgent"]=='' && $_POST["date_fin_couleur"]!='' && $_POST["date_fin_premium"]=='' && $_POST["date_fin_republication"]==''){
		$codeDoc='404411';		
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
	else if($_POST["date_fin_urgent"]=='' && $_POST["date_fin_couleur"]=='' && $_POST["date_fin_premium"]!='' && $_POST["date_fin_republication"]==''){
		$codeDoc='404413';		
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
	else if($_POST["date_fin_urgent"]=='' && $_POST["date_fin_couleur"]=='' && $_POST["date_fin_premium"]=='' && $_POST["date_fin_republication"]!=''){
		$codeDoc='404417';		
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
	else if($_POST["date_fin_urgent"]!='' && $_POST["date_fin_couleur"]=='' && $_POST["date_fin_premium"]!='' && $_POST["date_fin_republication"]==''){
		$codeDoc='404421';		
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
	else if($_POST["date_fin_urgent"]!='' && $_POST["date_fin_couleur"]!='' && $_POST["date_fin_premium"]=='' && $_POST["date_fin_republication"]==''){
		$codeDoc='404419';		
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
	else if($_POST["date_fin_urgent"]=='' && $_POST["date_fin_couleur"]!='' && $_POST["date_fin_premium"]!='' && $_POST["date_fin_republication"]==''){
		$codeDoc='404414';		
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
	else if($_POST["date_fin_urgent"]!='' && $_POST["date_fin_couleur"]!='' && $_POST["date_fin_premium"]!='' && $_POST["date_fin_republication"]==''){
		$codeDoc='404422';		
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
	else if($_POST["date_fin_urgent"]!='' && $_POST["date_fin_couleur"]=='' && $_POST["date_fin_premium"]=='' && $_POST["date_fin_republication"]!=''){
		$codeDoc='404425';
		
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
	else if($_POST["date_fin_urgent"]=='' && $_POST["date_fin_couleur"]=='' && $_POST["date_fin_premium"]!='' && $_POST["date_fin_republication"]!=''){
		$codeDoc='404416';		
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
		($_POST["date_fin_urgent"]!='' && $_POST["date_fin_couleur"]=='' && $_POST["date_fin_premium"]!='' && $_POST["date_fin_republication"]!='')
		){
		$codeDoc='404424';
		
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
	else if($_POST["date_fin_urgent"]=='' && $_POST["date_fin_couleur"]!='' && $_POST["date_fin_premium"]=='' && $_POST["date_fin_republication"]!=''){
		$codeDoc='404412';
		
		?>
        <tr class="bg-stripcolor">
        	<td><b>Annonce en Couleur</b><p class="commentaire">Votre annonce sera surlignée en orange</p></td><td>30 Jours</td><td>3€</td>
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
	else if($_POST["date_fin_urgent"]!='' && $_POST["date_fin_couleur"]!='' && $_POST["date_fin_premium"]=='' && $_POST["date_fin_republication"]!=''){
		$codeDoc='404420';
		
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
	else if($_POST["date_fin_urgent"]=='' && ($_POST["date_fin_couleur"]!='' && $_POST["date_fin_premium"]!='' && $_POST["date_fin_republication"]!='' || $_POST["selectall_plan_id"]=='y')){
		$codeDoc='404415';		
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
</table>
</div>

<div class="grid_16">
    <label class="titre">Paiement 100% sécurisé (via paypal) <img src="mobile/images/cadenat.png" width="16" height="16" /></label>
</div>

<div class="grid_5">
    <div class="box-simple">
        <p>
            <b>Choisissez le mode de paiement préfèré (Paypal ou Utiliser Votre Crédit)<br>
			et cliquez sur le boutton Souscrire
        </p>
    
        </p>
	</div>
	<br>
    <div class="box-simple">
        <p>
        	<b>Pourquoi mettre en avant votre annonce?</b>
        </p>
        <ul>
            <li> Mise en ligne prioritaire de votre annonce.</li><br>
            <li> Meilleure visibilité de votre annonce parmi les résultats.</li><br>
            <li> Encore plus de contacts par email et téléphone.</li><br>
        </ul>
    </div>
	<br>
    <div class="box-simple">
        <p>
        	<b>Une question, besoin d'aide?</b>
        </p>
        <ul>
            <li> Contactez notre service client : 09.70.40.54.73</li>
        </ul>
        
        <p class="commentaire"> ( Coût d'une communication locale )</p>
            
        <p> Notre équipe répond à vos appels
du lundi au vendredi de 9h00 à 17h00
et le samedi de 9h00 à 13h00</p>
    </div>
</div>

<div class="grid_11">

<br />
<input type="radio" name="methode" id="credit" value="credit" /> <label for="credit">Utiliser Votre Crédit</label>
<br />


<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top">
<input type="hidden" name="cmd" value="_s-xclick">
<input type="hidden" name="hosted_button_id" value="5W6R6Q9R6286Q">
<input type="image" src="https://www.paypalobjects.com/fr_FR/FR/i/btn/btn_subscribeCC_LG.gif" border="0" name="submit" alt="PayPal, le réflexe sécurité pour payer en ligne">
<img alt="" border="0" src="https://www.paypalobjects.com/fr_FR/i/scr/pixel.gif" width="1" height="1">
</form>


</div>



<div class="box-simple" id="div_credit" style="display:none;">
	<p>
        Votre crédit disponible: <?php echo $credits;?> TTC
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
                    <input id="submit_button" name="submit_button" type="submit" class="button button-green">
                </form>
            <?php
		}
	?>
</div>

</div>


</script>


</style>
<?php require_once("footer.inc.php"); ?>