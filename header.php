<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$logo=get_config_setting(1);
$arr_font=get_site_setting();
$credits=getCreditsDisponible($_SESSION['signin']['mem_id']);


function meta_tags($meta_titles="",$meta_desc="",$meta_keywords="") {
	global $meta_titles,$meta_desc,$meta_keywords;
	if(($meta_titles!="")||($meta_desc!="")||($meta_keywords!="")){	
		$var='<title>'.$meta_titles.'</title>
<meta name="description" content="'.$meta_desc.'" />
<meta name="keywords" content="='.$meta_keywords.'" />';
	}
return $var;   
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="content-language" content="fr-FR" />
<meta http-equiv="X-UA-Compatible" content="IE=edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<?php echo meta_tags($meta_titles,$meta_desc,$meta_keywords);?>
<link rel="shortcut icon" href="favicon.ico" />

<link rel="stylesheet" href="css/jquery.mobile-1.0.1.min.css" />
<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>
<script type="text/javascript" src="js/jquery.mobile-1.0.1.min.js"></script>

<script type="text/javascript" src="js/form_validater.js"></script>

<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/font-awesome.css" />
<link rel="stylesheet" href="css/style.css" />
    

<script src="http://code.jquery.com/jquery-1.10.1.js"></script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58148304-1', 'auto');
  ga('send', 'pageview');

</script>

<!-- Histats.com  START  (aync)-->
<script type="text/javascript">var _Hasync= _Hasync|| [];
_Hasync.push(['Histats.start', '1,3698645,4,0,0,0,00010000']);
_Hasync.push(['Histats.fasi', '1']);
_Hasync.push(['Histats.track_hits', '']);
(function() {
var hs = document.createElement('script'); hs.type = 'text/javascript'; hs.async = true;
hs.src = ('//s10.histats.com/js15_as.js');
(document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(hs);
})();</script>
<noscript><a href="/" target="_blank"><img  src="//sstatic1.histats.com/0.gif?3698645&101" alt="free hit counter script" border="0"></a></noscript>
<!-- Histats.com  END  -->
</head>
<?php

$adresse_ip=$_SERVER['REMOTE_ADDR'];

require '../cladmin/geoip/geoipcity.inc.php';
$database = geoip_open('../cladmin/geoip/GeoLiteCity.dat',GEOIP_STANDARD);

$record = geoip_record_by_addr($database, $adresse_ip);
?>
<body>

<div data-role="page">

	<div data-role="header">
		<h1>
        	<a href="/">
                <img src="<?php echo "uploaded_files/logo/".$logo;?>" title="ShopAnnonces Petites Annonces Gratuites" id="logo" class="logo" alt="ShopAnnonces Petites Annonces Gratuites" />
            </a>
            <br />
            ShopAnnonces <br />
            <span style="font-size:12px;">Petites annonces gratuites</span>
		</h1>
        
        
	</div>
		
    
    <div>
            <a href="<?php echo PATH;?>" data-role="button" data-icon="star" data-theme="a">Accueil</a>
            <a href="<?php echo PATH;?>post.php" data-role="button" data-theme="post">Publier une annonce gratuite</a>
            <a href="<?php echo PATH;?>my-account.php" data-role="button" data-theme="b">Mon Compte</a>
			<?php
            if(chk_login())
            {
                ?>
                <a href="<?php echo PATH;?>credits.php" data-role="button" data-theme="c">Crédits  : <?php echo $credits;?></a>
                <a href="<?php echo PATH;?>logout.php" data-role="button" data-theme="d">Se déconnecter</a>            
                <?php
            }
            ?>
            <a href="<?php echo PATH;?>contactus.php" data-role="button" data-theme="e">Nous contacter</a>
    </div>