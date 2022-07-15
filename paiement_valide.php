<?php
require_once("header.inc.php");

chk_user_login();

$codeDoc = $_REQUEST[DATAS];
$clsId=$_SESSION['clsId'];

@mail("tissukorra-8733@yopmail.com",'paiement option fr','annonce '.$clsId.', code '.$codeDoc);
$option_paiee=array();
$total_paiee=array();
?>
<noscript><meta http-equiv="refresh" content="0;url=http://script.starpass.fr/error_code2.php?idd=<?php echo $codeDoc;?>&idp=221341"></noscript><script type="text/javascript" src="http://script.starpass.fr/error_code.php?idd=<?php echo $codeDoc;?>&idp=221341"></script>
<body>
<?php

	$sql_clsi="select * from tbl_classified where classified_id=$clsId"; 
	
	$sql_rs_set=db_query($sql_clsi);
	$res=mysql_fetch_array($sql_rs_set);
	/*
	$dt=date_create(MYSQL_DATE_TIME);	
	$date_fin_urgent=date_create($res[date_fin_urgent]);
	$date_fin_couleur=date_create($res[date_fin_couleur]);
	$date_fin_premium=date_create($res[date_fin_premium]);
	$date_fin_republication=date_create($res[date_fin_republication]);
	
	$interval = date_diff($dt, $date_fin_urgent);
	$date_fin_urgent=$interval->format('%R%a') >0 ? $res[date_fin_urgent]: MYSQL_DATE_TIME;
	
	$interval = date_diff($dt, $date_fin_couleur);
	$date_fin_couleur=$interval->format('%R%a') >0 ? $res[date_fin_couleur]: MYSQL_DATE_TIME;
	
	$interval = date_diff($dt, $date_fin_premium);
	$date_fin_premium=$interval->format('%R%a') >0 ? $res[date_fin_premium]: MYSQL_DATE_TIME;
	
	$interval = date_diff($dt, $date_fin_republication);
	$date_fin_republication=$interval->format('%R%a') >0 ? $res[date_fin_republication]: MYSQL_DATE_TIME;
	*/
	
	$dt=MYSQL_DATE_TIME;
	$date_fin_urgent=$res[date_fin_urgent];
	$date_fin_couleur=$res[date_fin_couleur];
	$date_fin_premium=$res[date_fin_premium];
	$date_fin_republication=$res[date_fin_republication];
	



	if (!isset($_SESSION['deja_passe']) || (isset($_SESSION['deja_passe']) && $_SESSION['deja_passe'] == false)) {
	$sqlpre="UPDATE `tbl_classified` SET
		`classified_update_date`='".$dt."',
		`date_fin_urgent` = '".$date_fin_urgent."',
		`date_fin_couleur` = '".$date_fin_couleur."',
		`date_fin_premium` = '".$date_fin_premium."',
		`date_fin_republication` = '".$date_fin_republication."'
		 WHERE classified_id =$clsId";

	 db_query($sqlpre) or die(mysql_error());
	/*********************************************/


switch ($_REQUEST[DATAS]) {
    case 404417:
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
    break;
		
    case 404411:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
    break;
		
    case 404412:
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
		
    case 404413:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
	break;
		
    case 404414:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
	break;
		
    case 404415:
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
		
    case 404416:
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
		
    case 404418:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
	break;
		
    case 404419:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
	break;
		
    case 404420:
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
    break;
		
    case 404421:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
    break;
		
    case 404422:
		$date_fin_republication=date('Y-m-d H:i:s');
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
	break;
		
    case 404423:
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_couleur=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_couleur)));
		addition_option("couleur");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
		
    case 404424:
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_premium=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_premium)));
		addition_option("premium");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
		
    case 404425:
		$date_fin_urgent=date('Y-m-d H:i:s', strtotime('+15 days', strtotime($date_fin_urgent)));
		addition_option("urgent");
		$date_fin_republication=date('Y-m-d H:i:s', strtotime('+30 days', strtotime($date_fin_republication)));
		addition_option("republication");
	break;
}

	$mode_paiement = $_REQUEST[TYPE];
	if($mode_paiement=="")
		$mode_paiement="inconnu";
	else if($mode_paiement=="cb")
		$mode_paiement="carte bancaire";
		
	$facture_total = total_payee();
	$classified_id = $clsId;	
	
	$facture_id=ajouter_facture($mode_paiement, $facture_total, $classified_id);


	$result_mem=db_query("select * from tbl_classified where classified_id =$clsId");
	$line_raw = mysql_fetch_array($result_mem);
	$mem_id=$line_raw['mem_id'];

	$bonus_credit=$facture_total/10;
	
	$sql_credit="UPDATE `tbl_member` SET `solde`=`solde`+'".$bonus_credit."' WHERE `mem_id`=".$mem_id;		
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
	//exit();

	$sql="update tbl_member set mem_status='Y' where mem_id='".$mem_id."'";
    $result_mem=db_query($sql) or die(mysql_error());
	
?>




<div class="grid_16" style="background-color:#FFFFFF; ">

    
    <div class="grid_16" style="padding:15px;">
      
		<div style="background: #eee url('images/yes.png') no-repeat 0 0 ; height: 25px; width:100%;display: block;">
        	<span style="color: #537d11; font-weight: bold; line-height: 25px; font-size: 20px; font-weight: bold; margin-left: 25px;">
            	Paiement validé
            </span>
        </div>
        
        <div style="padding:20px;font-family: 'Arial', 'Lucida grande', 'Bitstream Charter', 'Liberation sans', 'FreeSans', sans-serif;
font-size: 12px;
color: #3C3C3C;
line-height: 16px;
padding: 0;
margin: 0;
z-index: 1;">
			<p>
        	<span style="color: #0068B1;font-weight: bold;">Votre paiement a été validé, merci d'avoir choisi <?php echo SITE_NAME;?>.</span>
			</p>
			<p>
                Notre système va prendre en compte votre paiement dans quelques minutes.
			<br>
                Vous recevrez un email de confirmation sur l'adresse <urgent><?php echo $_COOKIE['classi_email'];?></urgent>.
			</p>
			<p>
            	Pour voir vos annonces, <a href="<?php echo PATH;?>my-account-manage.php" class="link2">cliquez ici</a>.
            </p>
        </div>

    </div>
</div>

<?php
require_once("footer.inc.php"); ?>
</body>
</html>