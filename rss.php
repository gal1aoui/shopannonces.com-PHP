<?php
     require_once("includes/main.inc.php");
     require_once("front-functions.php");	 
	 header("Content-Type: application/xml; charset=ISO-8859-1");
	 include_once("classes/RSS.class.php");
	 $rss = new RSS();	
	if($_REQUEST['catId']!='' && $_REQUEST['catId']!='0'){
		$flg=intval($_REQUEST['catId']);
		$x="cat";
	}		
	if($_REQUEST['subcatId']!='' && $_REQUEST['subcatId']!='0'){
		 $flg=intval($_REQUEST['subcatId']);
		 $x="subcat";		
	}
	if($_REQUEST['cityId']!='' && $_REQUEST['cityId']!='0'){
		 $flg=intval($_REQUEST['cityId']);
		 $x="city";		
	}	
	echo $rss->GetFeed($flg,$x);
	
?>