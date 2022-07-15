<?php
require_once("header.php");

chk_user_login();

$codeDoc = secureValue($_REQUEST['codeoption']);
$amount = secureValue($_REQUEST['amount']);
$clsId=$_SESSION['clsId'];
$memId=$_SESSION['signin']['mem_id'];

@mail("adnene_braham@hotmail.fr",'paiement (credit) option fr','annonce '.$clsId.', code '.$codeDoc);
$option_paiee=array();
$total_paiee=array();


	$sql_clsi="select * from tbl_classified where classified_id=$clsId"; 
	
	$sql_rs_set=db_query($sql_clsi);
	$res=mysql_fetch_array($sql_rs_set);
	
	$dt=MYSQL_DATE_TIME;
	$date_fin_urgent=$res[date_fin_urgent];
	$date_fin_couleur=$res[date_fin_couleur];
	$date_fin_premium=$res[date_fin_premium];
	$date_fin_republication=$res[date_fin_republication];
	
	if (!isset($_SESSION['deja_passe']) || (isset($_SESSION['deja_passe']) && $_SESSION['deja_passe'] == false)) {
		$sqlpre="UPDATE `tbl_classified` SET
			`classified_update_date`='".$dt."'
			 WHERE classified_id =$clsId";
	
		 db_query($sqlpre) or die(mysql_error());
		/*********************************************/

switch ($codeDoc) {
    case 152765:
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
    break;
		
    case 152760:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
    break;
		
    case 152761:
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
		
    case 152762:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
	break;
		
    case 152763:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
	break;
		
    case 152777:
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
		
    case 152764:
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
		
    case 152766:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
	break;
		
    case 152767:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
	break;
		
    case 152768:
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
    break;
		
    case 152770:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
    break;
		
    case 152771:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
	break;
		
    case 152773:
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
		
    case 152774:
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
		
    case 152775:
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
}

	$mode_paiement = "Crédits  Flyannonces";
		
	$facture_total = total_payee();
	$classified_id = $clsId;	
	
	$facture_id=ajouter_facture($mode_paiement, $facture_total, $classified_id);

	$bonus_credit=$facture_total/10;
	
	$sql_credit="UPDATE `tbl_member` SET `solde`=`solde`+'".$bonus_credit."'-'".$amount."' WHERE `mem_id`=".$memId;		
	db_query($sql_credit) or die(mysql_error());

	$sql="UPDATE `tbl_classified` SET
		`classified_post_date`='$dt',
		`date_fin_urgent` = '$date_fin_urgent',
		`date_fin_couleur` = '$date_fin_couleur',
		`date_fin_premium` = '$date_fin_premium',
		`date_fin_republication` = '$date_fin_republication'
		WHERE classified_id =$clsId";
	
		db_query($sql) or die(mysql_error());
		
		$_SESSION['deja_passe'] = true;
		 //echo "deja passe";
	}

	setMemberActive($memId);	
	
?>

<div class="heading">
		<div style="background: #eee url('images/yes.png') no-repeat 0 0 ; height: 25px; width:100%;display: block;">
        	<span style="color: #537d11; font-weight: bold; line-height: 25px; font-size: 20px; font-weight: bold; margin-left: 25px;">
            	Paiement validé
            </span>
        </div>
</div>


<div class="body">
    <div style="padding:20px;font-family: 'Arial', 'Lucida grande', 'Bitstream Charter', 'Liberation sans', 'FreeSans', sans-serif;
    font-size: 12px;
    color: #3C3C3C;
    line-height: 16px;
    padding: 0;
    margin: 0;
    z-index: 1;">
        <p>
        <span style="color: #0068B1;font-weight: bold;">Votre paiement a été validé, merci d'avoir choisi Flyannonces.</span>
        </p>
        <p>
            Notre système va prendre en compte votre paiement dans quelques minutes.
        <br>
            Vous recevrez un email de confirmation sur l'adresse <urgent><?php echo $_SESSION['signin']['email'];?></urgent>.
        </p>
        <p>
            Pour voir vos annonces, <a href="<?php echo PATH;?>my-account-manage.php" class="link2">cliquez ici</a>.
        </p>
    </div>
</div>



<?php
	require_once("footer.php");
?>