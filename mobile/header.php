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
<meta name="alexaVerifyID" content="WujUcHP2d06QGrywPLJ9FfWF0Js"/>

<?php echo meta_tags($meta_titles,$meta_desc,$meta_keywords);?>
<link rel="shortcut icon" href="favicon.ico" />
<meta name="viewport" content="width=device-width, initial-scale=1" />

<script type="text/javascript" src="js/jquery-1.6.4.min.js"></script>

<script type="text/javascript" src="js/form_validater.js"></script>

<link rel="stylesheet" href="css/bootstrap.min.css" />
<link rel="stylesheet" href="css/font-awesome.css" />

<link rel="stylesheet" type="text/css" href="css/printer.css" media="print" rel="nofollow" />

<script src="http://code.jquery.com/jquery-1.10.1.js"></script>
<script src="http://flyannonces.com/dist/js/bootstrap.min.js"></script>



<!--
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-58148304-1', 'auto');
  ga('send', 'pageview');
</script>
-->

<!-- Histats.com  START (hidden counter)-->
<!--
<script type="text/javascript">document.write(unescape("%3Cscript src=%27http://s10.histats.com/js15.js%27 type=%27text/javascript%27%3E%3C/script%3E"));</script>
<a href="http://www.histats.com" target="_blank" title="web statistics"><script  type="text/javascript">
try {Histats.start(1,2681174,4,0,0,0,"");
Histats.track_hits();} catch(err){};
</script></a>
<noscript><a href="http://www.histats.com" target="_blank"><img src="http://sstatic1.histats.com/0.gif?2681174&101" alt="web statistics" border="0"></a></noscript>
-->
<!-- Histats.com  END  -->
</head>
<?php

$adresse_ip=$_SERVER['REMOTE_ADDR'];

require '../cladmin/geoip/geoipcity.inc.php';
$database = geoip_open('../cladmin/geoip/GeoLiteCity.dat',GEOIP_STANDARD);

$record = geoip_record_by_addr($database, $adresse_ip);
?>
<body>

<page>
	<header>
        <table width="100%">
        <tbody>
            <tr>
                <td width="50%">
                	<a href="./">
                    <span>
                        <img src="<?php echo "uploaded_files/logo/".$logo;?>" 
                        	title="Flyannonces Petites Annonces Gratuites" id="logo" class="logo" 
                            alt="Flyannonces Petites Annonces Gratuites" />
                        <div style=" width:206px; text-align:center; ">
                        	Flyannonces.com<br />
                        	Petites annonces gratuites
                    	</div>
                    </span>
                    </a>
                </td>
                <td width="50%" style="text-align:right;">
                    <div id="banner">
                        <?php
                        if(chk_login())
                        {
                            ?>
                            <a href="<?php echo PATH;?>credits.php"  class="post-btn" style="float:right; margin: 5px;">Crédits: <?php echo $credits;?></a>
                            
                            <a href="<?php echo PATH;?>logout.php"  class="post-btn" style="float:right; margin: 5px;">Se déconnecter</a>
                            <?php
                        }
                        ?>
                        <a href="<?php echo PATH;?>post.php"  class="post-btn" style="float:right; margin: 5px;">Publier une annonce gratuite</a>
                    </div>
                </td>
            </tr>
        </tbody>
        </table>
        
	</header>