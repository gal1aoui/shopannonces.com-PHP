<?php
// Initialisation
require 'geoipcity.inc.php';
$database = geoip_open('GeoLiteCity.dat',GEOIP_STANDARD);
 
// Géolocalisation de l'adresse IP 74.41.65.128
//$ip = '74.41.65.128';
$ip = '178.51.239.233';
$record = geoip_record_by_addr($database, $ip);
print_r($record); // affiche les informations récupérées dans la base
echo "<br>".$record->country_name;
echo "<br>".$record->region;
?>