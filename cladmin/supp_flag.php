<?php

$signal_id=$_REQUEST[signal_id];

$sql = "delete from signale where signal_id=$signal_id";
db_query($sql);

$_SESSION['site_admin_message']="Flag Deleted Successfully.........";
header("Location: ".$_SERVER['HTTP_REFERER']);
exit;
?>
