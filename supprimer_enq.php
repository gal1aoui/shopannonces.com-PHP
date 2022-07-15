<?php

require_once("includes/main.inc.php");
require_once("front-functions.php");


$enq_id=secureValue($_REQUEST['enq_id']);

$sql = "UPDATE tbl_classified_inquiry SET enq_status='Delete' WHERE enq_id='$enq_id'";
db_query($sql);

$_COOKIE['site_admin_message']="Message Supprimé.........";
Set_Display_Message("Message Supprimé.........");	
//header("Location: ".$_SERVER['HTTP_REFERER']);

?>

	<div class=""><?php echo Display_Message();?> </div>

 <script type="text/javascript" language="javascript">
 var str;
// str=parent.document.getElementById("msg_new").innerHTML="<?php echo $msg2;?>";
 parent.window.location.reload()
 //alert(str); 
 </script>
 