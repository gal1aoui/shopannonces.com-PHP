<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$sql = "select * from tbl_newslattersubscriber where status=0 ORDER BY  `subscr_id` DESC";
//$sql = "select DISTINCT(classified_poster_email) from tbl_classified where classified_status='Active' ORDER BY `classified_poster_email` DESC";

$result = db_query($sql);


while ($line_raw = mysql_fetch_array($result)) {
	$line = ms_display_value($line_raw);
	@extract($line);
	echo $subscr_email."<br>";
	//echo $classified_poster_email."<br>";
}
?>

