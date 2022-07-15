<?php
if(!defined('LOCAL_MODE')) {
	die('<span style="font-family: tahoma, arial; font-size: 11px">config file cannot be included directly');
}

if (LOCAL_MODE) {    // Settings for local midas server do not edit here
	
	// database settings
    $ARR_CFGS["db_host"] = 'localhost';
	$ARR_CFGS["db_name"] = 'clbase';
    $ARR_CFGS["db_user"] = 'root';
    $ARR_CFGS["db_pass"] = '';
	define('SITE_SUB_PATH', '');
} else {
    // Settings for live server edit whenever shifting site to different server

	// database settings

	$ARR_CFGS["db_host"] = 'localhost';
	$ARR_CFGS["db_name"] = 'clbase';
    $ARR_CFGS["db_user"] = 'admin';
    $ARR_CFGS["db_pass"] = '';
	// Path for site	
define('SITE_SUB_PATH', '');
}

define('SITE_WS_PATH', HSSL.'://'.$_SERVER['HTTP_HOST'].'/');

define('THUMB_CACHE_DIR', 'thumb_cache');
define('PLUGINS_DIR', 'includes/plugins');
define('UP_FILES_FS_PATH', '/uploaded_files');
define('UP_FILES_WS_PATH', '/uploaded_files');
define('UPLOADED_FILE_PATH', '/uploaded_files');

define('DEFAULT_START_YEAR', 2009);
define('DEFAULT_END_YEAR', date('Y')+10);

define("DB","");
define('SITE_TITLE', 'Admin Panel');
define('TEST_MODE', false);
define('DEF_PAGE_SIZE',10);
define('CURR', 'EUR');
define('MYSQL_DATE',date('Y-m-d'));
define('MYSQL_DATE_TIME',date('Y-m-d H:i:s'));
define('ADMIN_DIR', 'cladmin');?>