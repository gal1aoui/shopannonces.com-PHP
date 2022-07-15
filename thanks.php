<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("header.inc.php");

?>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td valign="top" align="center">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td >
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="193" valign="top" style="padding:5px 0 0 3px;">
    <div style="width:202px;">
        <p><img src="<?php echo $theem_img;?>/left-box-top.jpg" alt=""/></p>
        <div class="bg-left-box">
          <div class="other-link">
          <p class="p3 cate-stripcolor wht-head">Information</p>
           <span class="other-link-active">À propos de nous</span> <a href="faq.htm">FAQ</a> <a href="contactus.htm">Contactez nous</a> <a href="privacy-policy.htm">Politique de confidentialité</a> <a href="terms-use.htm">Condition d'utilisation</a>
</div>
        </div>
        <p><img src="<?php echo $theem_img;?>/left-box-bot.jpg" alt=""/></p>
      </div>
    </td>
    <td width="807" valign="top" style="padding:5px 5px 0 15px;"><table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td class="main-heading">Merci</td>
        </tr>
      <tr>
        <td width="33%" valign="top" class="tree">Merci &lt;&lt; <a href="index.php">Accueil</a></td>
        </tr>
      <tr>
          <td valign="top" style="padding-top:3px;">Merci de vous enregister avec nous.</strong></p>
                    <p><strong>Vous allez bientôt recevoir un courriel de confirmation.</strong></td>
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