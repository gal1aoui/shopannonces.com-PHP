<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$cryptinstall="cryptographp.fct.php";
include $cryptinstall;

$clsId=$_REQUEST['clsId'];

$sql_clsi_show="select * from tbl_classified where classified_id=$clsId and classified_status='Active' ";
	 
$sql_rs_set=db_query($sql_clsi_show);
$reccnt = mysql_num_rows($sql_rs_set);
$res=mysql_fetch_array($sql_rs_set);


/* contact count*/
$contacts=classified_contacts($clsId);
/* contact count */

?>

<form  action="classified-send-enquiry.php" method="post" enctype="multipart/form-data" onSubmit="return validate_classified_inquire(this);" target="postFrame">
                         
	<table  width="500px" border="0" cellpadding="5" cellspacing="0">
        <tr>
        	<td>
                <div style="border:#cccccc 1px solid;">
                	<div class="title_clad">
                    	Info. cet Annonceur:
                    </div>
                    <div style="padding:10px;">
						<?php if(getMemberFullName($res['mem_id'])!="") { ?>
                            <div>
                                <strong>Nom Annonceur: </strong><?php echo getMemberFullName($res['mem_id']);?>                       
                            </div>
                        <?php } ?>
                        
						<?php if($res['contact_number']!="") { ?>
                            <div>                                            	
                                <strong>Téléphone Annonceur: </strong><?php echo $res['contact_number'];?>                            
                            </div>
                        <?php } ?>
                        
						<?php if(getMemberWebSite($res['mem_id'])!="") { ?>
                            <div>
                                <strong>Site Web: </strong><?php echo getMemberWebSite($res['mem_id']);?>                       
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </td>
            
        </tr>
        <tr>
            <td align="">
            	<div>Votre Email *:</div>
                <div><input name="sender_email" id="sender_email" type="text" class="textbox" /></div>
            </td>
        </tr>
        <tr>
            <td align="">
            	<div>Votre Nom :</div>
                <div><input name="sender_name" id="sender_name" type="text" class="textbox" /></div>
            </td>
        <tr>
        <tr>
            <td align="">
            	<div>Votre Téléphone :</div>
                <div><input name="sender_tel" id="sender_tel" type="text" class="textbox" /></div>
            </td>
        <tr>
        <tr>
            <td align="">
            	<div>Pièce jointe :</div>
                <div><input type="file" name="file_name" id="file_name"></div>
            </td>
        </tr>
        <tr>
            <td align="">
            	<div>Message *:</div>
                <div><textarea name="sender_msg" id="sender_msg" type="text" rows="6" class="textbox" /></textarea></div>
            </td>
        </tr>
        
        <tr>
            <td align="left">
            	<div>code de validation *: <?php dsp_crypt(0,1); ?></div>
                <div><input type="text" name="code" id="code" class="textbox"></div>
            </td>
        </tr>
        
        <tr>
            <td align="center">
                <h3 style="font-weight: bold;" id="msg_new" class="commentaire"></h3>
            </td>
        </tr>
        <tr>
            <td align="center">
                <input name="catId" type="hidden" value="<?php echo $_REQUEST['catId'];?>">
                <input name="subcatId" type="hidden" value="<?php echo $_REQUEST['subcatId'];?>">
                <input name="start" type="hidden" value="<?php echo $_REQUEST['start'];?>">
                <input name="act" type="hidden" value="snd_inq">
                <input name="posterId" type="hidden" value="<?php echo $res['mem_id'];?>">
                <input name="clsId" type="hidden" value="<?php echo $res['classified_id'];?>">
            
            	<input type="submit" name="sub" value="Envoyer" class="button button-green" />
        	</td>
        </tr>
</table>
	<iframe name="postFrame" src="classified-send-enquiry.php" style="display:none"></iframe> 	
</form>
