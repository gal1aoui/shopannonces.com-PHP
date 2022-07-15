<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','2');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;
require_once("header.inc.php");
$act=$_REQUEST['act'];
if($act=="send")
{
	 @extract(strip_tags($_POST));
	 
	 $name = secureValue($name);
	 $org = secureValue($org);
	 $address = secureValue($address);
	 $city = secureValue($city);
	 $sate = secureValue($sate);
	 $country = secureValue($country);
	 $phone_no = secureValue($phone_no);
	 $fax = secureValue($fax);
	 $email = secureValue($email);
	 $comment = secureValue($comment); 
	 
	 $sql="insert into `tbl_feedback` SET `name` = '$name',	
	 `org` = '$org',`address` = '$address',
	 `city` = '$city',`state` = '$sate',
	 `country` = '$country',
	 `phone` = '$phone_no',`fax` = '$fax',
	 `email` = '$email',`comment` = '$comment',
	 `date` = '".date('Y-m-d')."' ";	
	  db_query($sql);
	  Set_Display_Message("Votre commentaire soumis avec succès.... ");
	  header("Location:feedback.php");
	  exit();
}
?>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td valign="top" align="center">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td >
<table border="0" align="center" cellpadding="0" cellspacing="0" class="cate-border" bgcolor="#FFFFFF">
  <tr>
    <td width="807" valign="top" style="padding:5px 5px 0 15px;"><table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td class="main-heading">Commentaires</td>
        </tr>
      <tr>
        <td width="33%" valign="top" class="tree">Commentaires &lt;&lt; <a href="index.php">Accueil</a></td>
        </tr>
      <tr>
        <td valign="top" style="padding-top:3px;">
		
		
		<form name="frn" id="frn" method="post" action="<?=SITE_WS_PATH;?>/feedback.php" class="border" onsubmit="return validate_feedback(this);">
		<table width="100%" cellpadding="4" cellspacing="0">
         <tr>
              <td colspan="2" align="left"><?=Display_Message();?> </td>
            </tr>
          <tr>
            <td colspan="2" align="left"><div align="right"><span class="fs11">( <span class="star">* </span>) obligatoire</span></div></td>
          </tr>
          <tr>
            <td width="33%" align="right" class="bold" ><span class="star">*</span> Nom : </td>
            <td width="67%" align="left" valign="top"><input name="name" type="text" class="textbox1"  style="width:300px;"/></td>
          </tr>
          <tr class="bg-stripcolor">
            <td align="right" class="bold"> Nom de compagnie :</td>
            <td align="left"><input name="org" type="text" class="textbox1"  style="width:300px;"/></td>
          </tr>
          <tr>
            <td align="right" class="bold"><span class="star">*</span> Courriel :</td>
            <td align="left"><input name="email" type="text" class="textbox1"  style="width:300px;"/></td>
          </tr>
          <tr class="bg-stripcolor">
            <td align="right" class="bold"><span class="star">*</span> Téléphone  :</td>
            <td align="left"><input name="phone_no" type="text" class="textbox1"  style="width:300px;"/></td>
          </tr>
          <tr>
            <td align="right" class="bold">Fax  :</td>
            <td align="left"><input name="fax" type="text" class="textbox1"  style="width:300px;"/></td>
          </tr>
          <tr class="bg-stripcolor">
            <td align="right" valign="top" class="bold" ><span class="star">*</span> Address :</td>
            <td align="left"><textarea name="address"  rows="4" class="textbox1" style="width:300px;"></textarea></td>
          </tr>
          <tr>
            <td align="right" class="bold"><span class="star">*</span> Pays :</td>
            <td align="left"><select name="country" id="select" size="1" class="textbox1"  style="width:298px;">
              <?=country_lists($country);?>
            </select></td>
          </tr>
          <tr class="bg-stripcolor">
            <td align="right" ><span class="bold"><span class="star">*</span> Province :</span></td>
            <td align="left"><input name="sate" type="text" class="textbox1"  style="width:300px;"/></td>
          </tr>
          <tr class="bg-stripcolor">
            <td align="right" ><span class="bold"><span class="star">*</span> Ville :</span></td>
            <td align="left"><input name="city" type="text" class="textbox1"  style="width:300px;"/></td>
          </tr>
          <tr class="bg-stripcolor">
            <td align="right" ><span class="star">*</span> Commentaire :</td>
            <td align="left"><textarea name="comment"  rows="6" class="textbox1" style="width:300px;"></textarea></td>
          </tr>
          <tr>
            <td align="right">&nbsp;</td>
            <td align="left" valign="bottom"><input name="button3" type="submit" class="button" id="button2" value="Soumettre"/>
              &nbsp;
              <input name="button3" type="reset" class="button" value="Envoyer" />
              <input type="hidden" name="act" value="send"></td>
          </tr>
        </table>
		</form>	
		</td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
</tr>
</table>
<?php require_once("footer.inc.php"); ?>