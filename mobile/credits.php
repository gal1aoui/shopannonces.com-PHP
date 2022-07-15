<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$meta_titles="Gérer Mes Crédits";
$meta_desc="Gérer Mes Crédits";
$meta_keywords="Gérer Mes Crédits";
require_once("header.php");

require_once("multiple-currency.php");
chk_user_login();

$fetconfig_amount=get_config_setting(9);
$catPaid_amount=get_config_setting(10);
$expdays=get_config_setting(13);
$paid_category_expire_days=get_config_setting(12);
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=5:$pagesize;

$_SESSION['memId']=$_SESSION['signin']['mem_id'];
unset($_SESSION['deja_passe']);
?>

<div class="grid_3">
    <br />
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF">
    
    
	<div class="account-link">
		<?php require_once("my_account_links.php"); ?>
	</div>
    
    
    
    
    <div class="p7">   
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><div class="main-heading">Mes crédits</div></div>
            <div class="panel-body">
    			<p class="heading">Crédits disponibles : <?php echo $credits;?> TTC</p>
    
                <p class="" style="font-size: 13px;">
                Facile, Rapide, Pratique ! Grâce aux crédits, vous pré-chargez votre Compte Personnel du montant de votre choix. Vous n'aurez ainsi plus besoin de saisir vos coordonnées bancaires à chaque achat d'option sur le site web . Vous gagnez du temps et gérez ainsi mieux votre budget.
                </p>    
    
	<div class=""><?php echo Display_Message();?> </div>
    
    <ul class="nav nav-tabs" role="tablist" id="myTab">

      <li role="presentation" class="active"><a href="#allopass" aria-controls="allopass" role="tab" data-toggle="tab">Via Allopass</a></li>
      <li role="presentation"><a href="#starpass" aria-controls="starpass" role="tab" data-toggle="tab">Via Starpass</a></li>

      <!--<li role="presentation"><a href="#parrainage" aria-controls="parrainage" role="tab" data-toggle="tab">Via Parrainage</a></li>-->
    </ul>
    
    <div class="tab-content">

      <div role="tabpanel" class="tab-pane active" id="allopass">
      
      	<iframe width="550" height="480" frameborder="0" marginheight="0" marginwidth="0" scrolling="no" src="https://payment.allopass.com/buy/buy.apu?ids=324098&idd=1435692"></iframe>
        
      </div>
      
      <div role="tabpanel" class="tab-pane" id="starpass">
        <div id="starpass_298977"></div><script type="text/javascript" src="http://script.starpass.fr/script.php?idd=298977&amp;datas="></script>
        <noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br />
        <a href="http://www.starpass.fr/">Micropaiement StarPass</a></noscript>
      </div>
      
      <!--
      <div role="tabpanel" class="tab-pane" id="parrainage">
      <p>
      	Faites gagner de credits:
        
        Créditez votre compte d'un montant de 1 euro à chaque ami parrainé.
        </p>
        
        <p>
        <form action="parrainage.php" method="post" class="form-inline">
            <table class="table">
            <thead>
            	<tr>
                	<th></th><th>Nom</th><th>Prénom</th><th>Email</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <th scope="row">
                    	1
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nom1" placeholder="Nom">
                    </td>
                    <td>       
                        <input type="text" class="form-control" name="prenom1" placeholder="Pr&eacute;nom">
                    </td>
                    <td>
                        <input type="email" class="form-control" name="email1" placeholder="email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    	2
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nom2" placeholder="Nom">
                    </td>
                    <td>       
                        <input type="text" class="form-control" name="prenom2" placeholder="Pr&eacute;nom">
                    </td>
                    <td>
                        <input type="email" class="form-control" name="email2" placeholder="email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    	3
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nom3" placeholder="Nom">
                    </td>
                    <td>       
                        <input type="text" class="form-control" name="prenom3" placeholder="Pr&eacute;nom">
                    </td>
                    <td>
                        <input type="email" class="form-control" name="email3" placeholder="email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    	4
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nom4" placeholder="Nom">
                    </td>
                    <td>       
                        <input type="text" class="form-control" name="prenom4" placeholder="Pr&eacute;nom">
                    </td>
                    <td>
                        <input type="email" class="form-control" name="email4" placeholder="email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    	5
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nom5" placeholder="Nom">
                    </td>
                    <td>       
                        <input type="text" class="form-control" name="prenom5" placeholder="Pr&eacute;nom">
                    </td>
                    <td>
                        <input type="email" class="form-control" name="email5" placeholder="email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    	6
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nom6" placeholder="Nom">
                    </td>
                    <td>       
                        <input type="text" class="form-control" name="prenom6" placeholder="Pr&eacute;nom">
                    </td>
                    <td>
                        <input type="email" class="form-control" name="email6" placeholder="email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    	7
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nom7" placeholder="Nom">
                    </td>
                    <td>       
                        <input type="text" class="form-control" name="prenom7" placeholder="Pr&eacute;nom">
                    </td>
                    <td>
                        <input type="email" class="form-control" name="email7" placeholder="email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    	8
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nom8" placeholder="Nom">
                    </td>
                    <td>       
                        <input type="text" class="form-control" name="prenom8" placeholder="Pr&eacute;nom">
                    </td>
                    <td>
                        <input type="email" class="form-control" name="email8" placeholder="email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    	9
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nom9" placeholder="Nom">
                    </td>
                    <td>       
                        <input type="text" class="form-control" name="prenom9" placeholder="Pr&eacute;nom">
                    </td>
                    <td>
                        <input type="email" class="form-control" name="email9" placeholder="email">
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                    	10
                    </th>
                    <td>
                        <input type="text" class="form-control" name="nom10" placeholder="Nom">
                    </td>
                    <td>       
                        <input type="text" class="form-control" name="prenom10" placeholder="Pr&eacute;nom">
                    </td>
                    <td>
                        <input type="email" class="form-control" name="email10" placeholder="email">
                    </td>
                </tr>
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="4">
                            <input type="submit" name="action" class="button button-green" value="Ajouter" />
                        </th>
                    </tr>                
                </tfoot>
            </table>
        </form>
        </p>
        
        <p>
        c'est rapide et facile. Il suffit de remplir les noms, prénoms et adresses e-mails de vos amis. Quand l'un d'entre eux passera au moins 1 annonce, vous recevez 1 &euro; de crédit consommable sur flyannonces.com
      </p>
      </div>
      -->
      

    
    <script>
      $(function () {
        $('#myTab a:first').tab('show')
      })
    </script>
    

    
    
            </div>
        </div>
	</div>
    
</div>
<?php require_once("footer.php"); ?>