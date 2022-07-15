<?php
require_once("header.inc.php");

chk_user_login();

$codeDoc = $_REQUEST[DATAS];
$memId=$_COOKIE['memId'];

?>

<noscript><meta http-equiv="refresh" content="0;url=http://script.starpass.fr/error_code2.php?idd=298977&idp=69875"></noscript><script type="text/javascript" src="http://script.starpass.fr/error_code.php?idd=298977&idp=69875"></script>


<?php
if (!isset($_SESSION['deja_passe']) || (isset($_SESSION['deja_passe']) && $_SESSION['deja_passe'] == false)) {
//	if(!empty($codeDoc)) {
	
		$sql_credit="UPDATE `tbl_member` SET `solde`=`solde`+3 WHERE `mem_id`=".$memId;		
		db_query($sql_credit) or die(mysql_error());
		
		$_SESSION['deja_passe'] = true;		 
//	}
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
							Votre solde est crédité par 3 &euro;.
						</p>
			</div>
		</div>
		
	</div>';

    Set_Display_Message("Votre solde est crédité par 3 &euro;.");
    header("Location: ".$_SERVER['HTTP_REFERER']);
	exit();	
?>
<meta http-equiv="refresh" content="3; URL=credits.php">


<?php require_once("footer.inc.php"); ?>