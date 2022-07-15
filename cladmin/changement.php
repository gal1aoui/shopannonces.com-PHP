<?php
require_once("../includes/main.inc.php");
require_once("admin-function.php");

$classified_id=$_REQUEST['classified_id'];
?>
<form action="" method="post">
	<input type="hidden" name="classified_id" value="<?php echo $classified_id;?>" />
<table>
	<tr>
    	<td><input type="radio" name="cause" value="mauvaise_cat" />Votre annonce n'appartient pas à la bonne catégorie</td>
    </tr>
    <tr>
    	<td><input type="radio" name="cause" value="aucun_produit" />Votre annonce ne fait pas mention à un produit spécifique</td>
    </tr>
    <tr>
    	<td><input type="radio" name="cause" value="produit_non_conforme" />Votre annonce n'est pas conforme au condition d'utilisation</td>
    </tr>
    <tr>
    	<td><input type="radio" name="cause" value="lien_indesirable" />Votre annonce contient un lien indésirable</td>
    </tr>
    <tr>
    	<td align="center"><input type="submit" name="action" value="Envoyer"></td>
	</tr>
</table>
</form>




<?php
$classified_id=$_REQUEST['classified_id'];
$action=$_REQUEST['action'];

if(isset($action) && $action=="Envoyer"){
	$result_email=db_query("select * from tbl_member, tbl_classified
							where
								tbl_member.mem_id=tbl_classified.mem_id
							AND tbl_classified.classified_id = $classified_id");

$link='<div style="text-align:center;">
					<a href="http://'.$_SERVER[HTTP_HOST].'/activer.php?user_id='.$line_email[user_id].'&ui='.$line_email[mem_id].'&nextpage=edit-my-post.php&clsId='.$classified_id.'" style="font-family:Arial, sans-serif;padding:7px 15px;background-color:#86C222;color:#fff;font-size:14px;width:278px;border-radius:2px;border:solid 1px #86C222;text-decoration:none;text-align:center;height:15px;font-weight:bold;" target="_blank">Ajouter des photos</a>				
				</div>';
				
				
$body="Bonjour! 
Merci d'avoir déposé votre annonce sur ".$_SERVER[SERVER_NAME].".
Malheureusement, quelque chose dans votre annonce ne correspond pas à ce que nous autorisons sur notre site.
Voici ce qui pose un problème: 

Votre annonce ne fait pas mention à un produit spécifique et on n’accepte pas de la publicité générique. S’il vous plaît, mettez à jour votre annonce en incluant un produit spécifique et déposez votre annonce à nouveau. 

Voici un bouton pour modifier votre annonce: {link} Assurez-vous que vous utilisez la même adresse e-mail que celle que vous avez utilisée lorsque vous avez déposé l'annonce.

Lorsque vous aurez déposé votre annonce modifiée, nous la vérifierons à nouveau, si elle est approuvée elle sera alors publiée! 

---
Merci d'utiliser ".$_SERVER[SERVER_NAME]."
Veuillez ne répondez pas à cet email car nous ne recevrons pas votre message. 
Pour contacter ".$_SERVER[SERVER_NAME]." directement, veuillez visiter le site.";

	$body=nl2br($body);
	echo $body=html_mail_content($body);
	
	while ($line_email = mysql_fetch_array($result_email)) 
	{
		echo $email_to	=	$line_email[user_id];
		
		echo "<br />";
	}
}

$retour=$_REQUEST['retour'];

?>