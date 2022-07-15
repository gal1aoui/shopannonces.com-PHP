<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$action=secureValue(@$_POST['action']);
$userid=secureValue(@$_POST['userid']);
$userpass=secureValue(@$_POST['userpass']);
$redir=secureValue(@$_POST['ref']);

if($action=='check' && !empty($userid) && !empty($userpass))
{
	$result_mem=db_query("select * from tbl_member where user_id='$userid'");
	
	$num_mem_rec=mysql_num_rows($result_mem);
	if($num_mem_rec > 0 )
	{
		$line_raw = mysql_fetch_array($result_mem);
		@extract($line_raw);
		if ($password==$userpass) {
		
			setcookie("memId", $mem_id, time() + (86400 * 30));
			setcookie("userId", $user_id, time() + (86400 * 30));
			setcookie("user_name", $fname." ".$lname, time() + (86400 * 30));
			setcookie("classi_email", $user_id, time() + (86400 * 30));
			
			if(isset($redir)&& $redir!=""){			  
				//echo "1";
				header("Location: ".$redir);	  
				exit();
			}else{
				//echo "2";
				header("Location:my-account.php");
				exit();
			}
		}
		else{
			Set_Display_Message("Mauvais nom d'utilisateur/mot de passe....!!");
			header("Location:signin.php");
			exit(); 
		} 
	 
	}
	else{
		//echo "4";
		Set_Display_Message("Mauvais nom d'utilisateur/mot de passe....!!");
		header("Location:signin.php");
		exit(); 
	} 

}else{
	//echo "5";
    Set_Display_Message("Mauvais nom d'utilisateur/mot de passe ....!!");
    header("Location:signin.php");
    exit();    
}
?>