<?php

require 'cladmin/geoip/geoipcity.inc.php';
$database = geoip_open('cladmin/geoip/GeoLiteCity.dat',GEOIP_STANDARD);

						echo $adresse_ip="90.28.74.79";
						$record = geoip_record_by_addr($database, $adresse_ip);
						// affiche les informations récupérées dans la base
						print_r($record);
						echo "<br>";
						echo "<br>";
						echo "<br>";
						
						echo " (".$record->country_name.")";
						echo "<br>";
						echo " (".$record->continent_code.")";
/*
require_once("includes/main.inc.php");
require_once("front-functions.php");

function before ($this, $inthat)
{
	return substr($inthat, 0, strpos($inthat, $this));
}


$sql="SELECT * FROM `tbl_classified` ";
$rs_clast=db_query($sql); 
while($rwclass=mysql_fetch_array($rs_clast)){
	
	if($rwclass["classified_poster_name"]!=""){
		echo $rwclass["classified_poster_name"];
		echo "<br>";
	}
	*/
/*	
	$sql="SELECT * FROM `tbl_member` ";
	$rs_list=db_query($sql); 
	while($rw=mysql_fetch_array($rs_list)){
		//$lname=before ('@', $rw["user_id"]);
		echo $fname=$rw["fname"];
		echo " ";
		echo $lname=$rw["lname"];
		echo " ";
		echo $rw["user_id"]." <br>";
		
		
		/*
			$update_sql="update tbl_classified set classified_poster_name='$fname $lname'
			where mem_id='".$rw["mem_id"]."'";
			db_query($update_sql);*/
	//}
//}
?>