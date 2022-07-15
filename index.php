<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
	
$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','10');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;

require_once("header.inc.php");
?>

    <p class="grid_16 Text">
        ShopAnnonces : la bonne affaire est près de chez vous !
        Pour <a href="<?php echo PATH;?>my-account-post.php" class="link1">passer</a> ou <a href="<?php echo PATH;?>search-result.php" class="link1">chercher</a> des annonces, cliquez sur la région de votre choix et trouvez la bonne affaire.
    </p>
    
	<div class="grid_3">&nbsp;
     	<?php session_start(); echo $link_left;?>
    </div>
    
	<div class="grid_13" style="background-color:#FFF;">
            <?php require_once("cat-subcat-box.php"); ?>
    </div>
    
    
    <p class="grid_16 Text">
    Sur le site ShopAnnonces, vous pouvez consulter des petites annonces de <a href="<?php echo PATH;?>search-result.php?user_type=Particulier" class="link1">particuliers</a> et de <a href="<?php echo PATH;?>search-result.php?user_type=Professionnel" class="link1">professionnels</a> partout en France, que vous cherchiez des <a href="<?php echo PATH;?>search-result.php?cat=213" class="link1">annonces immobilières</a>, des <a href="<?php echo PATH;?>search-result.php?cat=208" class="link1">voitures d'occasion</a>, des <a href="<?php echo PATH;?>search-result.php?cat=8" class="link1">offres d'emploi</a>, du <a href="<?php echo PATH;?>search-result.php?cat=833" class="link1">matériel électronique</a> ou tout autre type de <a href="<?php echo PATH;?>search-result.php?cat=832" class="link1">Services</a>.
    </p>
    
<?php require_once("footer.inc.php"); ?>