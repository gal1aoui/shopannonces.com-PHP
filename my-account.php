<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_meta_tags','id','12');
require_once("header.inc.php");

chk_user_login();
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
    
    
	<center><img src="mobile/images/account-img.gif" alt=""/></center>
</div>
<?php require_once("footer.inc.php"); ?>