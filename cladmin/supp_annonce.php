
<?php
/*
require_once("../includes/main.inc.php");
require_once("admin-function.php");
*/

$clsid=$_REQUEST[clsid];

$sql = "UPDATE tbl_classified SET classified_status='Delete' WHERE classified_id='$clsid'";
db_query($sql);

$_SESSION['site_admin_message']="Classified Deleted Successfully.........";
header("Location: ".$_SERVER['HTTP_REFERER']);

?>
