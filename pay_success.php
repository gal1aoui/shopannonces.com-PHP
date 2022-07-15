<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$recordId=intval($_REQUEST['DATAS']);

 $expdays=get_config_setting(13);	
/* Advertisement Banner  Section  */ 
?>

<noscript><meta http-equiv="refresh" content="0;url=http://script.starpass.fr/error_code2.php?idd=253107&idp=157655"></noscript><script type="text/javascript" src="http://script.starpass.fr/error_code.php?idd=253107&idp=157655"></script>

<?php
if($recordId){	
   //,status='Y'
        db_query("UPDATE tbl_advertise SET pay_option='Paid' WHERE id='$recordId'");
        Set_Display_Message("Votre paiement est effectué avec succès...... ");
		header("Location:advertise.php");
		exit();
}

/*End Advertisement Banner  Section  */



?>