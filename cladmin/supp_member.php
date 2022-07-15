
<?php

$mem_id=$_REQUEST[memid];
$sql = "delete from tbl_member where mem_id=$mem_id";
db_query($sql);

$sql = "delete from tbl_classified where mem_id=$mem_id";
db_query($sql);

$_SESSION['site_admin_message']="Member Deleted Successfully.........";
header("Location: land.php?file=manage_classified");
exit;
?>