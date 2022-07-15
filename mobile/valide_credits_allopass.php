<?php
require_once("header.php");

chk_user_login();

$memId=$_SESSION['signin']['mem_id'];

?>

<noscript>
    <meta http-equiv="Refresh" content="0;url=https://payment.allopass.com/error.apu?ids=324098&idd=1435692">
</noscript>

<script type="text/javascript" src="https://payment.allopass.com/api/secure.apu?ids=324098&idd=1435692"></script>

<script type="text/javascript">
    //<![CDATA[
        if(typeof loaded == 'undefined') {
            window.location.href = 'https://payment.allopass.com/error.apu?ids=324098&idd=1435692';
        }
    //]]>
</script>


<?php
if (!isset($_SESSION['deja_passe']) || (isset($_SESSION['deja_passe']) && $_SESSION['deja_passe'] == false)) {

	$sql_credit="UPDATE `tbl_member` SET `solde`=`solde`+3 WHERE `mem_id`=".$memId;	
	db_query($sql_credit) or die(mysql_error());	
	
	$_SESSION['deja_passe'] = true;
}
	
$msg='
	<div class="grid_16" style="background-color:#FFFFFF; ">
	
		
		<div class="grid_16" style="padding:15px;">
		  
			<div style="background: #eee url(images/yes.png) no-repeat 0 0 ; height: 25px; width:90%;display: block;">
				<span style="color: #537d11; font-weight: bold; line-height: 25px; font-size: 20px; font-weight: bold; margin-left: 25px;">
					Opération crédit validé
				</span>
			</div>
			
			<div style="padding:20px;font-family: Arial, Lucida grande, Bitstream Charter, Liberation sans, FreeSans, sans-serif;
			font-size: 12px;
			color: #3C3C3C;
			line-height: 16px;
			padding: 0; margin: 0;
			z-index: 1;">
						<p>
							Votre solde est crédité par 2 &euro;.
						</p>
			</div>
		</div>
		
	</div>';

    Set_Display_Message("Votre solde est crédité par 3 &euro;.");
    header("Location: credits.php");
	exit();	
?>
<meta http-equiv="refresh" content="3; URL=credits.php">


<?php require_once("footer.php"); ?>