<?php
	require_once("../includes/funcs_cur.inc.php");
	require_once("../includes/funcs_lib.inc.php");
	session_start();
// Déterminer si la page a été demandée via la méthode GET ou POST. 

if(is_post_back()){
	$username=secureValue($_POST['login_id']);
	$pass=secureValue($_POST['password']);
	
	$sql="select * from tbl_admin where admin_username='".$username."'";
	$result = db_query($sql);
	if ($line_raw = mysql_fetch_assoc($result)) {
		@extract($line_raw);
		if ($admin_password==$pass) {
			$_SESSION['sess_admin_login_id']=$admin_id;
				
	 
			if($return_page=='') {
				header("location:land.php");
				exit;
			} else {
				header("location: ".$return_page);
				exit;
			}
		} else {
		$_SESSION['ms']="Invalid Login ID or Password......";	
				header("location:index.php");		
		}
	} else {
	$_SESSION['ms']="Invalid Login ID or Password......";		
				header("location:index.php");		
	}
	unset($_REQUEST['ms']);
}
?>