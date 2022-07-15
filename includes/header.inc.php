<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$pagename=basename($_SERVER['PHP_SELF']);
require_once("detectmobilebrowser.php");

$link_left=get_config_setting(19);
$link_center_details=get_config_setting(20);
$link_top=get_config_setting(18);
$link_footer=get_config_setting(16);
$credits=getCreditsDisponible($_COOKIE[memId]);

function meta_tags($meta_titles="",$meta_desc="",$meta_keywords="") {
	global $meta_titles,$meta_desc,$meta_keywords;
	if(($meta_titles!="")||($meta_desc!="")||($meta_keywords!="")){	
		$var='<title>'.$meta_titles.'</title>
<meta name="description" content="'.$meta_desc.'" />
<meta name="keywords" content="='.$meta_keywords.'" />';
	}
return $var;   
}
$logo=get_config_setting(1);
$arr_font=get_site_setting();
$link_curr=get_config_setting(15);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="fr-FR" />
<meta http-equiv="X-UA-Compatible" content="IE=edge"/>
<meta name="alexaVerifyID" content="WujUcHP2d06QGrywPLJ9FfWF0Js"/>
<?=meta_tags($meta_titles,$meta_desc,$meta_keywords);?>

<link rel="shortcut icon" href="favicon.ico" />

<link href="dist/css/bootstrap.min.css" rel="stylesheet" />
<link href="css/ekko-lightbox.css" rel="stylesheet" />
<link rel="stylesheet" href="css/font-awesome.css" rel="nofollow" />

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="js/form_validater.js"></script>
<script type="text/javascript" src="js/ajax.js"></script>

<script src="dist/js/bootstrap.min.js"></script>
<script src="js/ekko-lightbox-min.js"></script>

<link rel="stylesheet" href="css/printer.css" media="print" rel="nofollow" />

<style type="text/css">
.logo{
	background:url('<?php echo "mobile/uploaded_files/logo/".$logo;?>') no-repeat 0 0;
}
</style>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58148304-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- Histats.com  START (hidden counter)-->

<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="web statistics"><script  type="text/javascript">
try {Histats.start(1,2681174,4,0,0,0,"");
Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img src="http://sstatic1.histats.com/0.gif?2681174&101" alt="web statistics" border="0"></a></noscript>

<!-- Histats.com  END  -->

</head>

<?php
$adresse_ip=$_SERVER['REMOTE_ADDR'];
//stats($adresse_ip, basename($_SERVER['PHP_SELF']));

require 'cladmin/geoip/geoipcity.inc.php';
$database = geoip_open('cladmin/geoip/GeoLiteCity.dat',GEOIP_STANDARD);

$record = geoip_record_by_addr($database, $adresse_ip);

?>
<body>


<div class="container_16">

<div id="banner">
	<a href="./" class="link" >
        <div class="grid_16 entete">     
        </div>
	</a>
    
    <div class="grid_16" style="text-align:center;">
        <br />
        <?php echo $link_top;?>
    </div>
    
	<div class="grid_16">&nbsp;</div>
<?php

	$classi_state = !empty($_REQUEST['classi_state'])? "?classi_state=".$_REQUEST['classi_state']:"";
?>
	<div class="grid_16">
    	<nav>
    		<ul id="nav_main" class="navmain">
                <li class="<?php if($pagename=="index.php") echo "selected";?>">
                    <a href="./">Accueil</a>
                </li>
                <li class="<?php if($pagename=="my-account-post.php") echo "selected";?>" >
                    <a rel="nofollow" href="<?php echo PATH;?>my-account-post.php<?php echo $classi_state?>">Déposer une annonce</a>
                </li>
                
                <?php 
                if(chk_login()){
                    ?>
                    <li class="<?php if($pagename=="my-account-manage.php") echo "selected";?>">
                        <a id="link_adwatch" href="<?php echo PATH;?>my-account-manage.php">Mes annonces</a>
                    </li>
                    <li class="<?php if($pagename=="credits.php") echo "selected";?>">
                        <a href="<?php echo PATH;?>credits.php">Crédits  : <?php echo $credits;?></a>
                    </li>
                    <li class="<?php if($pagename=="logout.php") echo "selected";?>">
                        <a href="<?php echo PATH;?>logout.php">Se déconnecter</a>
                    </li>
                <?php
                }
                else{
                    ?>
                    <li class="<?php if($pagename=="signin.php") echo "selected";?>">
                        <a href="<?php echo PATH;?>signin.php">Se connecter</a>
                    </li>
                    <li class="<?php if($pagename=="register.php") echo "selected";?>">
                        <a href="<?php echo PATH;?>register.php">Créer un compte</a>
                    </li>
                    <li class="<?php if($pagename=="search-result.php") echo "selected";?>">
                      <a rel="nofollow" href="<?php echo PATH;?>search-result.php">Boutiques</a>
                    </li>
                    <?php
                }
                ?>
                
            </ul>
        </nav>
	</div>
    


	<div class="grid_16">&nbsp;</div>
</div>