<?php

$id1=$_REQUEST['id1'];
	session_start();
	if($id1=="Logout"){
	session_destroy();
	header("Location:index.php?ms=1");
	exit();
}
?>