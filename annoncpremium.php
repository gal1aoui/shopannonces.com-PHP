<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($title,$description,$keyword)=get_meta_details('tbl_staticpage','pid','1');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;

require_once("header.inc.php");

?>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
        <td valign="top" align="center">
        <br />
         <?php session_start(); echo $link_left;?>
        </td>
        <td valign="top">
          <table border="0" align="center" cellpadding="0" cellspacing="0" class="cate-border" bgcolor="#FFFFFF">
          <tr>
            <td width="193" valign="top" style="padding:5px 0 0 3px;">
              <?php include("static-page-links.php");?></td>
            <td width="807" valign="top" style="padding:5px 5px 0 15px;"><table width="100%" border="0" cellpadding="2" cellspacing="0">
              <tr>
                
                </tr>
              <tr>
                <td width="33%" valign="top" class="tree">< <a href="index.php">Accueil</a></td>
                </tr>
              <tr>
        <p><span style="color: #d0ac2e; font-size: medium;"><strong>Offrez une meilleure visibilit&eacute; a votre annonce et augmentez votre nombre de contact</strong></span></p>

<p>&nbsp;
  </p>
<p>
  <strong>1ere etape:<br />
  D&eacute;poser votre annonce gratuitement sur notre site (<span style="color:#800080;">Noter bien le r&eacute;f&eacute;rence de l&#39;annonce</span> )<br />
  <br />
  2eme etape :</strong><br />
  <br />
  <strong> Compl&eacute;ter la proc&eacute;dure de paiement&nbsp;</strong></p>
<p>
  <strong>paiement Via micropaiement &nbsp; &nbsp; &nbsp;</strong>&nbsp; &nbsp;<strong>&nbsp;</strong><img alt="" src="http://www.isurf-media.com/site_pro/userfiles/10007856-001/image/tlchargement.jpg" style="width: 176px; height: 60px;" /></p>
<p>&nbsp;
  </p>
<div>
  &nbsp;</div>
<div>
  prix de mettre l&#39;annonce<span style="background-color:#ffffff;"> </span><span style="font-size:14px;"><span style="color: rgb(255, 0, 0);"><strong><span style="background-color: rgb(255, 255, 255);">&quot; A la une&quot;</span></strong></span></span><span style="background-color:#ffffff;"> </span>: 3 euros &nbsp;</div>
<div>
  &nbsp;</div>
<div>
  par t&eacute;l&eacute;phone : (2 x 1.35 &euro; TTC/Appel 0.34 &euro; /Minute )</div>
<div>
  &nbsp;</div>
<div>
  &nbsp;</div>
<div>
  Obtention du code : Cliquez sur le drapeau correspondant &agrave; votre pays afin d&#39;obtenir le num&eacute;ro audiotel que vous devez composer.</div>
<div>
  &nbsp;</div>
<div>
  Conseil : Nous vous conseillons de noter &agrave; la main sur un bout de papier les diff&eacute;rents codes qui vous seront dict&eacute;s et de les saisir ensuite dans les champs ci-dessous. Vous pourrez ainsi les ressaisir en cas d&#39;erreur.</div>
<p>&nbsp;
  </p>
<h1 style="padding: 8px; margin-top: 5px; margin-bottom: 0px; font-size: 14px; font-family: Verdana, Geneva, sans-serif; width: auto; background-color: rgb(10, 61, 107); color: rgb(255, 255, 255); border-top-left-radius: 7px; border-top-right-radius: 7px; border-bottom-right-radius: 7px; border-bottom-left-radius: 7px; clear: both;">
  Paiement via starpass</h1>
<p>&nbsp;
  </p>
<p>&nbsp;
  </p>
<div id="starpass_163398"></div>
<script type="text/javascript" src="http://script.starpass.fr/script.php?idd=163398&amp;datas=">
</script>
<noscript>Veuillez activer le Javascript de votre navigateur s'il vous pla&icirc;t.<br />
<a href="http://www.starpass.fr/">Micropaiement StarPass</a>
</noscript>
                <td valign="top" style="padding-top:3px;"><?php echo pagecontent(1);?></td>
              </tr>
            </table></td>
          </tr>
          <tr>
            <td valign="top" style="padding:5px 0 0 3px;">&nbsp;</td>
            <td height="70" style="padding:5px 5px 0 15px;">&nbsp;</td>
          </tr>
        </table>
      </td>
    </tr>
</table>
<?php require_once("footer.inc.php"); ?>