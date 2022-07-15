<?php
$news_id=$_REQUEST[news_id];

$sql = "DELETE FROM `news` WHERE `news_id`='$news_id'";
db_query($sql);

$_SESSION['site_admin_message']="news Deleted Successfully.........";
header("Location: ".$_SERVER['HTTP_REFERER']);
exit;
?>