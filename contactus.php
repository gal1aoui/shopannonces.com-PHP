<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($titlepage,$description,$keyword)=get_meta_details('tbl_staticpage','pid','2');
$meta_titles=$titlepage;
$meta_desc=$description;
$meta_keywords=$keyword;

require_once("header.inc.php");
if(is_post_back()) {
	$act=$_REQUEST['act'];
	if($act=="send")
	{
		 @extract(strip_tags($_POST));
		 
		 $name = secureValue($name);
		 $email = $email;
		 $title = secureValue($title);
		 $message = secureValue($message);
		 
		 echo $sql="insert into `tbl_enquiry` 
			 SET `name` = '$name', `title` = '$title', `email` = '$email', `message` = '$message',
			 `date` = '".MYSQL_DATE_TIME."' ";	
		  db_query($sql);
		  Set_Display_Message("Votre demande soumises avec succès... ");
		  header("Location:contactus.php");
		  exit();
	}
}
?>


<div class="grid_3">
	&nbsp;
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">

    <div class="tree"><a href="index.php">Accueil</a> <h3>&gt;&gt; Contactez nous :&nbsp;<b>si vous avez besoin de plus de renseignements ,</b></h3>

<h3><b>merci de laisser un message sur notre boite vocal : au 08 90 61 32 50 </b></h3>
</b></h3>
</div>
    
	<div class="mt17">
		<?php echo Display_Message();?>
	</div>

    <div class="p7">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><span class="title_clad">Contactez nous</span></div>
            <div class="panel-body">
                <form name="frn" id="frn" method="post" action="contactus.php" class="border" onsubmit="return validate_contactus(this);">
                    <table width="100%" cellpadding="5" cellspacing="5" >
                    <tr>
                        <td colspan="2">
                        	Merci de remplir le formulaire ci-dessous:
                            <br />
                        </td>
                    </tr>
                    <!--
                    <tr>
                        <td colspan="2" align="left">
                            <div class="commentaire" style="color:#009900; font-weight:bold;">
                                Une question ? Contactez notre service client au 09.70.40.54.73
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p>Ou contactez-nous par skype en cliquant sur ce bouton:</p>
                            <script type="text/javascript" src="http://www.skypeassets.com/i/scom/js/skype-uri.js"></script>
                            <div id="SkypeButton_Call_mesannoncesite_1">
                              <script type="text/javascript">
                                Skype.ui({
                                  "name": "dropdown",
                                  "element": "SkypeButton_Call_mesannoncesite_1",
                                  "participants": ["mesannonces"],
                                  "imageSize": 32
                                });
                              </script>
                            </div>
                        </td>
                    </tr>
                    -->
                    <tr>
                      <td colspan="2" align="left">
                      	<div align="right"><span class="fs11">( <span class="star">* </span>) obligatoire.</span></div>
                      </td>
                    </tr>
                    <tr>
                      <td width="38%" align="right" class="bold" >Votre nom : </td>
                      <td width="62%" align="left" valign="top">
                      <input name="name" type="text" class="textbox" id="name"  style="width:220px;" required="required"/></td>
                    </tr>
                    <tr>
                      <td align="right" class="bold"><span class="star">*</span> Votre mail:</td>
                      <td align="left"><input name="email" id="email" type="text" class="textbox"  style="width:220px;" required="required"/></td>
                    </tr>
                    <tr>
                      <td align="right" class="bold"><span class="star">*</span> Sujet :</td>
                      <td align="left"><input name="title" type="text" class="textbox"  style="width:220px;" required="required"/></td>
                    </tr>
                    <tr>
                      <td align="right" class="bold"><span class="star">*</span> Message  :</td>
                      <td align="left"><textarea name="message" rows="6" class="textbox" style="width:220px;" required="required"></textarea></td>
                    </tr>
                    <tr>
                      <td align="right">&nbsp;</td>
                      <td align="left" valign="bottom">
                        <input name="button3" type="submit" class="button button-green" id="button2" value="Envoyer"/>
                        &nbsp;
                        <input name="button3" type="reset" class="button button-green" value="Effacer" />
                        <input type="hidden" name="act" value="send">
                      </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="left">
                        <br>
                        </td>
                    </tr>
                  </table>
                </form>
            </div>
        </div>
	</div>
    
</div>
<?php require_once("footer.inc.php"); ?>