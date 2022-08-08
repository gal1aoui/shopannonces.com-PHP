<?php
$cat_Arr=main_cat_array();
$main_cat_link1="classified-listing.php?catId=".$cat_Arr[1]['catId'];
$main_cat_link2="classified-listing.php?catId=".$cat_Arr[2]['catId'];
$main_cat_link3="classified-listing.php?catId=".$cat_Arr[3]['catId'];
$main_cat_link4="classified-listing.php?catId=".$cat_Arr[4]['catId'];
$main_cat_link5="classified-listing.php?catId=".$cat_Arr[5]['catId'];
$main_cat_link6="classified-listing.php?catId=".$cat_Arr[6]['catId'];
$main_cat_link7="classified-listing.php?catId=".$cat_Arr[7]['catId'];
$main_cat_link8="classified-listing.php?catId=".$cat_Arr[8]['catId'];
$main_cat_link9="classified-listing.php?catId=".$cat_Arr[9]['catId'];
$main_cat_link10="classified-listing.php?catId=".$cat_Arr[10]['catId'];
$main_cat_link11="classified-listing.php?catId=".$cat_Arr[11]['catId'];
?>

<div>
	<?php require_once("carte.php"); ?>
</div>

<div>
	<?php require_once("featured.inc.php"); ?>
</div>


<div>
	<div style="position:relative; left:0px; top:0px; z-index:10; " dir="ltr">
		<?php echo $link_footer;?>
	</div>
</div>
