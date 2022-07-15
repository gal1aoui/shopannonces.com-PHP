<?php
require_once("header.php");

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
    
    
	<center><img src="img/account-img.gif" alt=""/></center>
</div>
<?php //require_once("footer.php"); ?>