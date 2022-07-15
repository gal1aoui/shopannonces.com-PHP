<?php 
error_reporting(E_ALL ^ E_NOTICE);
//putenv("TZ=EST5EDT");
//echo gmdate("M d Y H:i:s");
//putenv("TZ=Europe/London");
if ($_SERVER['HTTP_HOST']=="127.0.0.1") {
    define('LOCAL_MODE', true);
	//$url=explode('/', $_GET['url']);
    define('PATH', '');
	
	
} else {
 	define('LOCAL_MODE', false);
    define('PATH', 'http://'.$_SERVER['SERVER_NAME'].":8080"."/shopannonces.com/web/");
}

// File system path
$tmp = dirname(__FILE__);
$tmp = str_replace('\\' ,'/',$tmp);
$tmp = substr($tmp, 0, strrpos($tmp, '/'));
define('SITE_FS_PATH', $tmp); 

if(strtolower($_SERVER['HTTPS'])=='on') 
{
	define('IN_SSL', true);
	define('HTTP_OR_HTTPS_PATH', SITE_SSL_PATH);
	define('HSSL','https');
} 
else 
{
	define('IN_SSL', false);
	define('HTTP_OR_HTTPS_PATH', SITE_WS_PATH);
	define('HSSL','http');
}


// include all the library files needed here
require_once("config.inc.php");
require_once("funcs_lib.inc.php");
require_once("funcs_cur.inc.php");
require_once("arrays.inc.php");
ob_start();
session_start();
// Script start time used to test site performance
//define('SCRIPT_START_TIME', getmicrotime());
//echo "<br>SCRIPT_START_TIME: ".SCRIPT_START_TIME."<br>";
// magic_quotes_gpc needs to be "on"
if(get_magic_quotes_gpc()==0) {
	$_GET		= ms_addslashes($_GET);
	$_POST		= ms_addslashes($_POST);
	$_COOKIE	= ms_addslashes($_COOKIE);
	@extract($_GET);
	@extract($_POST);
} else {
	$_GET		= ms_trim($_GET);
	$_POST		= ms_trim($_POST);
	$_COOKIE	= ms_trim($_COOKIE);
	import_request_variables('gp');
}
// magic_quotes_runtime needs to be "off"
if(get_magic_quotes_runtime()) {
	set_magic_quotes_runtime(0);
}
if ($handle = opendir(SITE_FS_PATH.'/'.PLUGINS_DIR)) { 
   while (false !== ($file = readdir($handle))) { 
       if ($file != "." && $file != "..") { 
		   $curr_dir = SITE_FS_PATH.'/'.PLUGINS_DIR.'/'.$file;
           if(is_dir($curr_dir)) {
			   if(file_exists($curr_dir.'/plugin.php')) {
				   require_once($curr_dir.'/plugin.php');
			   }
		   }
       } 
   } 
   closedir($handle); 
} 
$admin_email	=	searchSingleRecord("tbl_config","config_txt","config_id",3);
define('ADMIN_EMAIL', $admin_email);

define('SITE_NAME', searchSingleRecord("tbl_config","config_txt","config_id",2));
define('REDIRECT_SERVER', searchSingleRecord("tbl_config","config_txt","config_id",22));
// Script start time used to test site performance

define('SCRIPT_START_TIME', getmicrotime());
define('CURR', 'EUR'); 
define('Feature_cls_EXPIRE', 30);  //30  DAYS 





// Protect admin pages
$PHP_SELF = $_SERVER['PHP_SELF'];
$admin_pos  = strpos($PHP_SELF, '/'.ADMIN_DIR.'/');
if($admin_pos !== false) {
	// Remove following comment to enable admin login check
	protect_admin_page();
}

ini_set(upload_max_filesize, '64M');


?>