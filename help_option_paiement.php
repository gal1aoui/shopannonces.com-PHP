<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Aide Option</title>
<link rel="stylesheet" href="paquet.css" type="text/css" rel="nofollow" />
</head>

<body>
<?php
$optionAffichee=secureValue($_REQUEST['option']);

switch($optionAffichee){
    case "PREMIUM":
		?>
<div style="width:595px; transform: scale(0.9);"> 
    <span style="font-size:24px; color:#fb8700; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:10px;">
    	VOTRE ANNONCE EN 1ère POSITION
    </span><br>
    <span style="font-family: Arial, Helvetica, sans-serif; font-size: 15px; color: #114d97" class="titre">Une annonce premium c'est 10x plus de contacts!
    </span><br>
</div>

<div style="width:595px; transform: scale(0.9);"> 
<table>
<tbody>
<tr>
    <td>
    <div class="box">
        <p>
            <img src="<?php echo PATH;?>mobile/images/1_number.png" 
            width="32" height="36" alt="option icons"> Visibilité
        </p>
        <span style="font-size:12px;">Votre annonce se démarque visuellement avec sa mention Premium.</span>
    </div>
    </td>
    <td>
    <div class="box">
    <p><img src="<?php echo PATH;?>mobile/images/2_number.png" width="32" height="36" alt="option icons"> Exclusivité</p>
    <span style="font-size:12px;">Votre annonce est positionnée au dessus des annonces classiques.</span>
    </div>
    </td>
    <td>
    <div class="box">
    <p><img src="<?php echo PATH;?>mobile/images/3_number.png" width="32" height="36" alt="option icons"> Proximité</p>
    <span style="font-size:12px;">Votre annonce en Premium est en premiére page de votre département et de sa catégorie</span>
    </div>
    </td>
</tr>
</tbody></table>
<div>
<img src="<?php echo PATH;?>mobile/images/repost_ad2.png" alt="option icons">
</div>

</div>

        <?php
        break;
    case "COULEUR":
	?>

<div style="width:595px; transform: scale(0.9);"> 
    <span style="font-size:24px; color:#fb8700; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:10px;">Annonce en couleur</span>
    <br>
<span style="font-size:15px; color:#114d97; font-family:Arial, Helvetica, sans-serif; padding-bottom:10px;" class="titre">Votre annonce sera colorée et plus visible</span><br>
</div>
<div style="width:595px; transform: scale(0.9);"> 
<img src="<?php echo PATH;?>mobile/images/hightlight.png" alt="Surligner votre annonce" width="595" height="220" style="margin:0;padding:0">
</div>

    <?php
        break;
    case "REPUBLICATION":
	?>
    <div class="vs-lightbox-container ui-dialog-content ui-widget-content" style="width: auto; min-height: 88px; height: auto;"><div class="vs-lightbox-content">
    <div class="vs-lightbox-body" style="padding: 0px !important;">
        <div class="vs-lightbox-screen kiwii-padding-medium" id="lb_repost_ad_explanation_screen_how">
            <p style="margin: 0px 25px;"></p>
		<div style="width:600px; padding-left:10px; padding-bottom:10px;"> 
			<span style="font-size:24px; color:#fb8700; font-family:Arial, Helvetica, sans-serif; font-weight:bold; padding-bottom:10px;">Tête de liste</span><br>

		</div>
<div style="width:595px; transform: scale(0.9);"> 
<div>
	<table class="box" width="100%">
    <tbody>
    	<tr>
        <td height="70">
        <p style="color:#114d97; font-size:13px; padding-left:10px;">
        	votre annonce sera automatiquement <br>
            placée en début de liste tous les jours
        </p>
        </td>
        <td align="center">
        <img src="<?php echo PATH;?>mobile/images/auto_repost_symbol.png" alt="Surligner votre annonce" style="margin:0;padding:0">
        </td>
		</tr>
	</tbody>
    </table>
</div>
	<img src="<?php echo PATH;?>mobile/images/repost_ad.png" alt="Surligner votre annonce" width="595" height="244" style="margin:0;padding:0">
</div>
        </div>
    </div>
</div>
</div>
    <?php
        break;
    case "URGENT":
	?>
    <div class="vs-lightbox-container ui-dialog-content ui-widget-content" style="width: auto; min-height: 88px; height: auto;"><div class="vs-lightbox-content">
    <div class="vs-lightbox-body" style="padding: 0px !important;">
        <div class="vs-lightbox-screen kiwii-padding-medium" id="lb_p2label_urgent_ad_explanation_screen_how">
            <p style="margin: 0px 25px;"></p><div style="float:left;margin-left:-10px;width:610px;font-family: Arial, Helvetica, sans-serif;font-size:12px;">

<div style="width:595px; transform: scale(0.9);"> 
      <h2 style="font-size:15px; color:#626364;font-weight:bold;">
      	Choisissez l'option <font style="color:#f18231;display:inline;">"URGENT"</font><br><br>
        <span  class="titre">
        Attirez l'attention sur votre annonce 
        et augmentez vos chances de contacts!
        </span>
    </h2>
</div>

<div style="width:595px; transform: scale(0.9);"> 
<table  style="padding:0 10px 0 10px;"><tbody><tr>
<td width="263" style="color:#626364; float:left;">  
    
<ul>
 <li> Un label orange apparait avec le titre de votre annonce</li><br>
 <li> Les annonces ont la mention <span class="urgent">URGENT</span> pendant toute la durée de vie de l'option</li><br>
 <li> Parfait pour vous démarquer et augmenter vos contacts </li>
</ul>


</td>
<td style=" float: right; ">
<img src="<?php echo PATH;?>mobile/images/option_urgent_FR.png" width="317px">
</td></tr></tbody></table>
</div>

<div style="float:left;width:610px;font-size:14px; color:#626364;font-family: Arial, Helvetica, sans-serif; padding:10px 10px 10px 10px;">
<p style="font-size:13px;"><strong style="color:#626364;">Plus d'informations ?</strong><br>
Si vous avez des questions sur cette nouvelle option <a href="<?php echo PATH;?>contactus.php" target="_blank" class="link2">cliquez ici</a> pour nous contacter
</p>
</div>
</div>
<div style="clear:both;"></div>
<p></p>
        </div>
    </div>
</div>
</div>
    <?php
        break;
}


?>
</body>
</html>