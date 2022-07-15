<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$meta_titles="Gérer Mon solde";
$meta_desc="Gérer Mon solde";
$meta_keywords="Gérer Mon solde";
require_once("header.inc.php");

require_once("multiple-currency.php");
chk_user_login();
//print_r($_COOKIE);

$fetconfig_amount=get_config_setting(9);
$catPaid_amount=get_config_setting(10);
$expdays=get_config_setting(13);
$paid_category_expire_days=get_config_setting(12);
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=6:$pagesize;

?>

<div class="grid_3">
    <br />
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF">
    
    
	<div class="account-link">
		<?php require_once("my_account_links.php"); ?>
	</div>
    
	<div class=""><?php echo Display_Message();?> </div>
   
                        

</div>
<?php require_once("footer.inc.php"); ?>