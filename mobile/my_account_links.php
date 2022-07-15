<table width="100%" align="center" style="text-align:center">
	<tr>
    	<td>
<?php
$pagename=basename($_SERVER['PHP_SELF']);

if($pagename=="my-account-edit.php"){?>
	<input name="compte" type="submit" class="button button-green-active" style="width:300px; margin:5px;" value="Mes Informations" onclick="window.open('<?php echo PATH;?>my-account-edit.php','_parent');"/>
<?php 
}else{ ?>
	<input name="compte" type="submit" class="button button-green" style="width:300px; margin:5px;" value="Mes Informations" onclick="window.open('<?php echo PATH;?>my-account-edit.php','_parent');"/>
            
<?php 
}

if($pagename=="my-account-manage.php"){?>

        	<input name="compte" type="submit" class="button button-green-active" style="width:300px; margin:5px;" value="Mes annonces" onclick="window.open('<?php echo PATH;?>my-account-manage.php','_parent');"/>
            
<?php
}else{ ?>

        	<input name="compte" type="submit" class="button button-green" style="width:300px; margin:5px;" value="Mes annonces" onclick="window.open('<?php echo PATH;?>my-account-manage.php','_parent');"/>
            
<?php
}

$sql = "select * from tbl_classified_inquiry 
		where memId ='".$_SESSION['signin']['mem_id']."'
		and enq_status='Active'
		and Show_inq='N'";

$res_msg=db_query($sql);	
$msg_non_lus=mysql_num_rows($res_msg);

if($pagename=="my-account-enquiry.php"){ 

	$sql_msg = "update tbl_classified_inquiry SET Show_inq='Y'
					where memId ='".$_SESSION['signin']['mem_id']."'";
	
	$res_msg=db_query($sql_msg);
	?>
        	<input name="compte" type="submit" class="button button-green-active" style="width:300px; margin:5px;" value="Mes Messages" onclick="window.open('<?php echo PATH;?>my-account-enquiry.php','_parent');"/>
<?php
}else{ ?>

        	<input name="compte" type="submit" class="button button-green" style="width:300px; margin:5px;" value="Mes Messages (<?php echo $msg_non_lus;?> Non vus)" onclick="window.open('<?php echo PATH;?>my-account-enquiry.php','_parent');"/>
            
<?php
}




if($pagename=="my-account-bill.php"){ 

	?>
        	<input name="compte" type="submit" class="button button-green-active" style="width:300px; margin:5px;" value="Mes Factures" onclick="window.open('<?php echo PATH;?>my-account-bill.php','_parent');"/>
<?php
}else{ ?>

        	<input name="compte" type="submit" class="button button-green" style="width:300px; margin:5px;" value="Mes Factures" onclick="window.open('<?php echo PATH;?>my-account-bill.php','_parent');"/>
            
<?php
}

if($pagename=="credits.php"){
	?>
    
            <input name="credits" type="submit" class="button button-green-active" style="width:300px; margin:5px;" value="Créditer votre compte" onclick="window.open('<?php echo PATH;?>credits.php','_parent');"/>
<?php 
}
else{
?>

            <input name="credits" type="submit" class="button button-green" style="width:300px; margin:5px;" value="Créditer votre compte" onclick="window.open('<?php echo PATH;?>credits.php','_parent');"/>
<?php
}
?>
</td>
	</tr>
    <tr>
    	<td>
			<?php
            	if(!member_confirm_email($_SESSION['signin']['mem_id'])){
            ?>
            <div class="" style="padding:10px; text-align:center;">
            
                
                Ajoutez <urgent>contact@flyannonces.com</urgent> à votre liste de contact<br>
                
                <br />
                
                <!-- onSubmit="return validate_classified_inquire(this);" target="postFrame"-->
                
                <form  action="<?php echo PATH;?>renvoyerConfirmation.php" method="post" enctype="multipart/form-data" data-ajax="false">
                
                
                    <input name="renvoyerConfirmation" type="submit" value="Me renvoyer l'email de confirmation" 
						<?php 
							if($_COOKIE["envoie_confirm_email"]!="Y") 
								echo 'class="button button-orange"'; 
								
							else if($_COOKIE["envoie_confirm_email"]=="Y")
								echo 'class="button "  disabled="disabled" ';?> />
                                
                    <input type="hidden" name="action" value="renvoyerEmailConfirmation" />
                    <h3 style="font-weight: bold;" id="msg_new" class="commentaire"></h3>
                    <!--
                    <iframe name="postFrame" src="<?php echo PATH;?>renvoyerConfirmation.php" style="display:none"></iframe>
                    -->
                </form>
                
            </div>
            <?php
            }
            ?>
        </td>
    </tr>
</table>