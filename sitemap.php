<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','5');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;
require_once("header.inc.php");
$link_pravicy=get_config_setting(6);
if($link_pravicy!=""){
$prvicy_link="<a href='".$link_pravicy."' class='link'>Privacy Policy</a>";
}else{
$prvicy_link="<a href='privacy-policy.php' class='link' >Privacy Policy</a>";
}
?>

<div class="grid_3">
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">
    
	<div class="tree">
    	<a href="index.php">Accueil</a> >> Carte du site 
	</div>
    
    <div class="p7">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><span class="title_clad">Carte du site</span></div>
            <div class="panel-body">
        		<table width="100%" border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="70%" valign="top">
                            <table width="100%" border="0" cellspacing="2" cellpadding="6">
                            <tr>
                            <td><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td><a href="index.php" class="link">Accueil</a></td>
                            <td width="2%"><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td width="47%"><?php echo $prvicy_link;?></td>
                            </tr>
                            <tr class="bg-stripcolor">
                            <td width="2%"><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td width="49%"><a href="aboutus.php" class="link">À propos de nous</a></td>
                            <td><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td><a href="terms-use.php" class="link">Conditions d'utilisation</a></td>
                            </tr>
                            <tr>
                            <td><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td>		
                            <a href="my-account-post.php" class="link">Placer une annonce</a>
                            </td>
                            <td><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td><a href="faq.php" class="link">FAQ</a></td>
                            </tr>
                            <tr class="bg-stripcolor">
                            <td><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td><a href="advertise.php" class="link">Publier chez nous</a></td>
                            <td><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td><a href="popular-searches.php" class="link">Recherche populaire</a></td>
                            </tr>
                            <tr>
                            <td><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td><a href="register.php" class="link">S'enregistrer</a></td>
                            <td><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td><a href="contactus.php" class="link">Contactez nous</a></td>
                            </tr>
                            <tr class="bg-stripcolor">
                            <td><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td><a href="signin.php" class="link">Connexion</a></td>
                            <td><img src="mobile/images/arrow1.gif" alt=""/></td>
                            <td><a href="help.php" class="link">Aide</a></td>
                            </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                            <table width="100%" border="0" cellspacing="1" cellpadding="5" class="mt17 b cate-border">
                            <tr>
                            <td colspan="4" class="blue-heading">Catégories : </td>
                            </tr>
                            <tr>
                                <?php $cat_Arr_fotter=main_cat_array();
                                $i=0;
                                foreach($cat_Arr_fotter as $keyfoot=>$valfoot){ 			
                                
                                    ?> 
                                    <td width="6%"><img src="mobile/images/arrow.gif" alt=""/></td>
                                    <td  align="left">
                                        <a href="classified-listing.php?catId=<?php echo $valfoot['catId'];?>" class="link">
                                            <?php echo ucfirst($valfoot['catName']);?>
                                        </a>
                                    </td>				  
                                    <?php if($i==1){ echo "<tr>"; $i=0; }else{ $i++; }
                                } ?>
                                <td></td><td></td>
                            </tr>
                            </table>
                        </td>
                        <td width="30%" valign="top"><img src="mobile/images/sitemap-img.jpg" alt="" vspace="10"/></td>
                    </tr>
                </table>
            </div>
        </div>
	</div>
    
</div>
<?php require_once("footer.inc.php"); ?>