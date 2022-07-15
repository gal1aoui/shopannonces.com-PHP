<?php

require_once("includes/main.inc.php");
require_once("front-functions.php");


require_once("header.inc.php");
require_once("arrays.inc.php");

$cryptinstall="cryptographp.fct.php";
include $cryptinstall;

$dtjour= date("Y-m-d");

$ft = db_query("SELECT * from tbl_classified where  DATE_FORMAT(`date_fin_premium`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d') ");
echo mysql_num_rows($ft);

while($line_raw = mysql_fetch_row($ft)){
echo "<pre><h1>";

echo $line_raw[3];
echo "</h1></pre>";
}
?>