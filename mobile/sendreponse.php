<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$cryptinstall="../cryptographp.fct.php";
include $cryptinstall;

if($_POST['sub']=='Envoyer'){
	
	if (chk_crypt($_POST['code'])) {
			$plage = explode(".", $_SERVER['REMOTE_ADDR']);
			//if($plage[0]=="41" || $plage[0]=="188" || $plage[0]=="85" || $plage[0]=="213" || $plage[0]=="105")
			//{
				//$msg2="Votre message n'est pas envoyé, ce site n'est pas accessible dans votre pays";
				$msg2="Votre message est envoyé";
			/*
			}
			else{	*/		
				/******** Send Reply Message  ********/ 
		if($_REQUEST['act_rep']!="" && $_REQUEST['act_rep']=="sendYes"){
		
			$subject=secureValue($_REQUEST['subject']);
			$message=secureValue($_REQUEST['msg']);
			$sender_name=secureValue($_REQUEST['sender_name']);
			$sender_email=$_COOKIE['userId'];
			$alter_id = secureValue(@$_REQUEST['$alter_id']);
			
			$sqlname = "select * from tbl_member where user_id ='$_COOKIE[userId]' ";
			$rs_name=db_query($sqlname);
			if($rw=mysql_fetch_array($rs_name)){ 
				if($rw["lname"]==""){
					$sql="Update `tbl_member` SET `lname` = '$sender_name' WHERE user_id='$_COOKIE[userId]'";
					 db_query($sql);
				}
			}
			
			$msg2="<span  class='msg_dg'>Votre message envoyé avec succès....</span>";
			
			
				//sent_mail($sender_name,$sender_email,$to,$subject,$message);
			
			$to_email=$_POST[to_email];
			$msg2.=$_POST[enq_sender_name];
			$msg2.=$sender_name;
			$msg2.=$sender_email;
			
			$headers ="From: ".ADMIN_EMAIL." \r\n"; 
			$headers .= "MIME-Version: 1.0\r\nContent-Type: multipart/mixed;\r\n"; 
			$titre.=secureValue($_REQUEST[subject]);
			$body.=secureValue($_REQUEST[msg]);

			mail($to_email, "RE:".$titre , $body, $headers);
			?>
				 <script type="text/javascript" language="javascript">
				 var str;
				 str=parent.document.getElementById("subject").value="";
				 str=parent.document.getElementById("msg").value="";
				 str=parent.document.getElementById("code").value="";
				 </script>
			<?php
		}
		/******** End Send Reply Message ********/
			//}
	}
	else{
		$msg2="<span  class='msg_dg'>Le code Captcha est incorrect...</span>";
	}
				
	
}
		header("Location:my-account-enquiry.php");
?>