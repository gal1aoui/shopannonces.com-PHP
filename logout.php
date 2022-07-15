<?php
session_start();
session_destroy();
require_once("front-functions.php");


if($_COOKIE["memId"] || $_COOKIE["userId"] || $_COOKIE["user_name"] || $_COOKIE["classi_email"]){
	setcookie('memId', '', 0);
	setcookie('userId', '', 0);
	setcookie('user_name', '', 0);
	setcookie('classi_email', '', 0);
		
	//efface_cookies();
}

echo "<script>window.location.href='signin.php?msg=logout'</script>";
?>
