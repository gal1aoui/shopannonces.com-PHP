<?php

require_once("includes/main.inc.php");
require_once("front-functions.php");


$enq_id=$_REQUEST['enq_id'];

$sql = "UPDATE tbl_classified_inquiry SET enq_status='Delete' WHERE enq_id='$enq_id'";
db_query($sql);

$_COOKIE['site_admin_message']="Message Supprimé.........";
Set_Display_Message("Message Supprimé.........");	
header("Location: my-account-enquiry.php");

?>

 