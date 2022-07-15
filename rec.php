<?php 
require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("header.inc.php");
require_once("arrays.inc.php");


session_start();
$p=$_SESSION['parametre'];
			foreach($p as $key => $val) echo '$_POST["'.$key.'"]='.$val.'<br />';
$f=$_SESSION['files'];
			foreach($f as $key => $val) echo 'val '.$val['file1']['name'].'<br />';
?>