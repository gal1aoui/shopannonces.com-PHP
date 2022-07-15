<?php
	require_once("header.php");


$action=$_POST['action'];
if($action=="Valider"){
	$cls_id=$_POST['cls_id'];
	$add_flag=$_POST['add_flag'];
	$message=$_POST['message'];
	$dt=MYSQL_DATE_TIME;
		$sql="INSERT INTO `signale` 
			SET 
			`cls_id` = '$cls_id',
			`type_signal` = '$add_flag',
			`message_signal` = '$message',
			`date_flag`='$dt'
			";	
			db_query($sql);
	
	 header("Location:details.php?clsId=".$cls_id);
	 exit();
}
?>

<div id="container">
    <form method="post" action="signaler.php">
        <h1 style="color:#626364;font-weight: bold;font-size: 20px;">Nous alerter sur cette annonce</h1>
        <input type="hidden" name="cls_id" id="cls_id" value="<?php echo $_REQUEST['clsId']?>">
        
        <div class="ligne-col-post">
            <div class="post-label">
                Type de flag:
            </div>
            <div>
                <select name="add_flag" id="add_flag" class="textbox" required="required">
                    <option></option>
                    <option value="arnaque">Arnaque</option>
                    <option value="Mauvaise catégorie">Mauvaise catégorie</option>
                    <option value="Expirée">Expirée</option>
                </select>
            </div>
        </div>
        
        <div class="ligne-col-post">
            <div class="post-label">
            	Message:
            </div>
            <div>
                <textarea class="textbox" rows="7" cols="45" name="message" id="message" required="required"></textarea>
            </div>
        </div>

        <div class="ligne-col-post commentaire">
            Pourquoi souhaitez-vous nous alerter (ceci ne sera pas publié)?
        </div>
        
        <div class="ligne-col-post centrer">
            	<input name="action" type="submit" value="Valider">
        </div>
    </form>
</div>