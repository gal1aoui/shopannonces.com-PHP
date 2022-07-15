<?php
	require_once("header.php");


$cryptinstall="../cryptographp.fct.php";
include $cryptinstall;

$clsId=$_REQUEST['clsId'];

$sql_clsi_show="select * from tbl_classified where classified_id=$clsId and classified_status='Active' ";
	 
$sql_rs_set=db_query($sql_clsi_show);
$reccnt = mysql_num_rows($sql_rs_set);
$res=mysql_fetch_array($sql_rs_set);


/* Update contact count*/
$contacts=classified_contacts($clsId)+1;
$sql_contact="UPDATE tbl_classified set classified_contact=$contacts where classified_id='$clsId'";  
db_query($sql_contact);
/* End Update contact count */

?>
<br />
<br />
<form  id="contact" name="contact" action="classified-send-enquiry.php" method="POST" class="post" enctype="multipart/form-data" target="_blank" >


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
                
            	<div>Votre Email *:</div>
                <div><input name="sender_email" id="sender_email" type="text" class="textbox" /></div>

            	<div>Votre Nom :</div>
                <div><input name="sender_name" id="sender_name" type="text" class="textbox" /></div>


            	<div>Votre Téléphone :</div>
                <div><input name="sender_tel" id="sender_tel" type="text" class="textbox" /></div>


            	<div>Pièce jointe :</div>
                <div><input type="file" name="file_name" id="file_name"></div>


            	<div>Message *:</div>
                <div><textarea name="sender_msg" id="sender_msg" type="text" rows="6" class="textbox" /></textarea></div>


            	<div>code de validation *: <?php dsp_crypt(0,1); ?></div>
                <div><input type="text" name="code" id="code" class="textbox"></div>


                <h3 style="font-weight: bold;" id="msg_new" class="commentaire"></h3>


                <input name="catId" type="hidden" value="<?php echo $_REQUEST['catId'];?>">
                <input name="subcatId" type="hidden" value="<?php echo $_REQUEST['subcatId'];?>">
                <input name="start" type="hidden" value="<?php echo $_REQUEST['start'];?>">
                <input name="act" id="act" type="hidden" value="snd_inq">
                <input name="posterId" type="hidden" value="<?php echo $res['mem_id'];?>">
                <input name="clsId" type="hidden" value="<?php echo $res['classified_id'];?>">
            
            	<input type="submit" id="sub" name="sub" value="Envoyer" class="button button-green" />


</form>
