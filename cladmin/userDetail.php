<?php
require_once("../includes/main.inc.php");
require_once("admin-function.php");

require 'geoip/geoipcity.inc.php';
$database = geoip_open('geoip/GeoLiteCity.dat',GEOIP_STANDARD);

$id=@$_REQUEST['id'];
$seluser=db_query("select * from ".DB.".tbl_member where mem_id='$id'");
$rw=mysql_fetch_array($seluser);
$alerts=$rw['class_alerts'];
$alerts_arr=explode(",",$alerts);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo SITE_TITLE;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="css/styles.css" rel="stylesheet" type="text/css">
</head>
<body>
<table width="100%" border="0" cellpadding="4"  cellspacing="1">
                <tr bgcolor="#1588BB" class="white">
                  <td colspan="2" bgcolor="#CCCCCC" class="border_bot"><span class="b white"><strong> Company Details : </strong></span></td>
  </tr>
				 
                <tr valign="top" class="border_bot">
                  <td width="50%" align="right" class="border_bot">  Company Name : </td>
                  <td width="50%" align="left" class="border_bot"><?php echo $rw['comp_name'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td width="50%" align="right" class="border_bot">  Address : </td>
                  <td width="50%" align="left" class="border_bot"><?php echo $rw['comp_address'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">City : </td>
                  <td align="left" class="border_bot"><?php echo $rw['comp_city'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Province : </td>
                  <td align="left" class="border_bot"><?php echo $rw['comp_province'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Postal code : </td>
                  <td align="left" class="border_bot"><?php echo $rw['comp_postalcode'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Country : </td>
                  <td align="left" class="border_bot"> <?php echo country_name($rw['comp_country']);?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Website url : </td>
                  <td align="left" class="border_bot"><?php echo $rw['comp_url'];?></td>
                </tr>
                <tr align="left" valign="top" class="border_bot">
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr align="left" valign="top" bgcolor="#1588BB" class="border_bot">
                  <td colspan="2" bgcolor="#CCCCCC" class="border_bot"><span class="b white"><strong> <strong>Personal  Details :</strong></strong></span></td>
  </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> First name: </td>
                  <td align="left" class="border_bot"><?php echo $rw['fname'];?></td>
                </tr>
                
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Last name: </td>
                  <td align="left" class="border_bot"><?php echo $rw['lname'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Email id: </td>
                  <td align="left" class="border_bot"><?php echo $rw['email'];?></td>
                </tr>
                
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Type: </td>
                  <td align="left" class="border_bot"><?php echo $rw['type'];?></td>
                </tr>
                
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Register Date: </td>
                  <td align="left" class="border_bot"><?php echo $rw['reg_date'];?></td>
                </tr>
                
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Street Address : </td>
                  <td align="left" class="border_bot"><?php echo $rw['address'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Postal code : </td>
                  <td align="left" class="border_bot"><?php echo $rw['post_code'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">City :</td>
                  <td align="left" class="border_bot"><?php echo $rw['city'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">State/Province :</td>
                  <td align="left" class="border_bot"><?php echo $rw['state'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">  Country  : </td>
                  <td align="left" class="border_bot">
                    <?php echo country_name($rw['country']);?>
</td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Telephone Number: </td>
                  <td align="left" class="border_bot"><?php echo $rw['tel_no'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Daily Alerts:</td>
					<td align="left" class="border_bot">
					<?php if(count($alerts_arr) > 0 ){
						foreach($alerts_arr as $key=>$val){       
						 echo get_catinfo($val,"cat_name")." | ";
						}
					 } ?>
					</td>
                </tr>
                
			<td align="center">
            </td>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Status: </td>
                  <td align="left" class="border_bot">
					<?php
                    if($rw['mem_status']=='Y'){ echo "Active"; } else { echo "In-active";}?>
                  </td>
                </tr>
                
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Solde: </td>
                  <td align="left" class="border_bot"><?php echo $rw['solde'];?></td>
                </tr>
                                
                <tr valign="top" class="border_bot">
                    <td align="right" class="border_bot"> Address Ip: </td>
                    <td align="left" class="border_bot">
						<?php echo $adresse_ip=$rw['adresse_ip'];
                        $record = geoip_record_by_addr($database, $adresse_ip);
                        // affiche les informations récupérées dans la base
                        echo " (".$record->continent_code." -> ".$record->country_name." -> ".$record->region." -> ".$record->city." -> ".$record->postal_code." ) ";
                        ?>
                    </td>
                </tr>
                
                
                <tr align="left" valign="top" class="border_bot">
                  <td colspan="2">&nbsp;</td>
                </tr>
				 <tr align="left" valign="top" bgcolor="#1588BB" class="border_bot">
                  <td colspan="2" bgcolor="#CCCCCC" class="border_bot"><span class="b white"><strong> 


 Login Details

 : </strong></span></td>
  </tr>
				   <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Login Id:</td>
                  <td align="left" class="border_bot"><?php echo $rw['user_id'];?></td>
                </tr>
			  </table>
</body>
</html>
