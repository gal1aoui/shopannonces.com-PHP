<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$paypal_account=get_config_setting(14);


if($_REQUEST['rf']!="" ){	
   $rf=$_REQUEST[rf];              //Payment for banner or classified or feature classified //
}
if($_REQUEST['rid']!="") {	
   $recordId=intval($_REQUEST['rid']);        // Record  id 
}

//exit();



?>
<?php
require_once("header.inc.php");
?>


<div class="grid_16">
    <label class="titre">Paiement 100% sécurisé (via StarPass) <img src="images/cadenat.png" width="16" height="16" /></label>
</div>


<div class="grid_5">
    <div class="box-simple">
        <p>
            <b>Etape 1 :</b>Cliquez sur le drapeau correspondant à votre pays.
        </p>
        
        <p>
            <b>Etape 2 :</b> Choisissez le mode de paiement préfèré (carte bancaire,paypal,internet+, ou par télèphone)<br>
                  entrez vos coordonnées : prénon, nom, Email et cliquez sur achetez.
        </p>
           
        <p>
            <b>Dernière étape :</b> Saisissez le code starpass reçu par mail et cliquez sur ok.
        </p>
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
    <div id="starpass_319366"></div><script type="text/javascript" src="http://script.starpass.fr/script.php?idd=319366&amp;datas="></script><noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br /><a href="http://www.starpass.fr/">Micropaiement StarPass</a></noscript>
        
</div>

<?php require_once("footer.inc.php"); ?>