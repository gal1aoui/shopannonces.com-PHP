<?php
require_once("../includes/main.inc.php");
require_once("admin-function.php");

require 'geoip/geoipcity.inc.php';
$database = geoip_open('geoip/GeoLiteCity.dat',GEOIP_STANDARD);

/**************** Display records ***************/
if(isset($_REQUEST[clsId]) && $_REQUEST[clsId]!=""){
	$sql_clsi_show="select *,
							DATE_FORMAT(classified_post_date ,'%d %M %Y %H:%i:%s') as cli_post_date, 
							DATE_FORMAT(classified_update_date ,'%d %M %Y %H:%i:%s') as cli_update_date 
					from tbl_classified 
					where classified_id=$_REQUEST[clsId] ";
	$sql_rs_set=db_query($sql_clsi_show);
	$reccnt = mysql_num_rows($sql_rs_set);
	$res=mysql_fetch_array($sql_rs_set);
}

$sql_img="select * from tbl_classified_image where clsd_id=$res[classified_id]";
$sql_img_set=db_query($sql_img);
 if(mysql_num_rows($sql_img_set) > 0 ) {
   while($res1=mysql_fetch_array($sql_img_set)){   
    $file_sm="../".UP_FILES_FS_PATH."/classified_img/".$res1[cls_img_file];
    $img_name[]=$res1[cls_img_file];
	  $autoID[]=$res1['clsd_img_id']; 	   
	   if($res1[cls_img_file]!="" && file_exists($file_sm)){
         $link[]= '<img src="../mobile/uploaded_files/classified_img/'.$res1[cls_img_file].'" width=100 height=100" border="1"/>';
         $lien[]= '../mobile/uploaded_files/classified_img/'.$res1[cls_img_file];
         $delete[]= "<a href='sup_photo.php?clsd_img_id=$res1[clsd_img_id]&clsId=$res[classified_id]'>Supprimer</a>";
		}
     
   }
}
//print_r($im_arr_big);
/**************** End Display Records ***************/
if($res[classified_poster_state]!="" && $res[classified_poster_state]!=0){				 
 $state=getResult('tbl_state',"WHERE state_id=$res[classified_poster_state]");				
 }
 if($res[classified_city_id]!="" && $res[classified_city_id]!=0){				
   $city=getResult('tbl_city',"WHERE city_id=$res[classified_city_id]"); 
 }
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title><?php echo SITE_TITLE;?></title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<link href="css/styles.css" rel="stylesheet" type="text/css">
<script src="../facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
<link href="../facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
<script src="../facefiles/facebox.js" type="text/javascript"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
      $('a[rel*=facebox]').facebox() 
    })
</script>
</head>
<body>
<table width="940" border="0" align="center" cellpadding="1"  cellspacing="1">
    <tr bgcolor="#FFFFFF" class="white">
    	<td class="border_bot"><strong> Poster Details : </strong></td>
    </tr>
				 
    <tr valign="top" class="border_bot">
        <td width="30%" align="right" class="border_bot">   Name : </td>
        <td align="left" class="border_bot">
        <?php echo get_member_name($res[mem_id]);?>
        </td>
    </tr>
    <tr>
                  <td width="50%" align="right" class="border_bot"> Adresse IP:</td>
                    <?php

$sqlmember=db_query("select * from tbl_member, tbl_classified where `tbl_member`.mem_id=`tbl_classified`.mem_id AND `tbl_classified`.classified_id=$_REQUEST[clsId]");
      
	 $rw=mysql_fetch_array($sqlmember);
	 

?>
                    <td><?php
						echo $rw[adresse_ip];
						$record = geoip_record_by_addr($database, $rw[adresse_ip]);
						// affiche les informations récupérées dans la base
						echo " (".$record->country_name.") region => ".$record->region.", city => ".$record->city.", postal_code =>  ".$record->postal_code;
						
						   
						?>
                    	<a href="land.php?file=supp_member&memid=<?php echo $rw[mem_id];?>">Supprimer Member</a>
                    </td>
                </tr>
    
    <form action="save_mod_details.php" method="post" enctype="multipart/form-data">
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">Email : </td>
                  <td align="left" class="border_bot"><?php echo $res[classified_poster_email];?></td>
                </tr>
                
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">Phone : </td>
                  <td align="left" class="border_bot">
                  	<input type="text" name="contact_number" value="<?php echo $res[contact_number];?>">				  	
                  </td>
                </tr>
                
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">Fax: </td>
                  <td align="left" class="border_bot">
                  	<input type="text" name="classi_fax" value="<?php echo $res[classi_fax];?>">
               	  </td>
                </tr>
                
                <tr valign="top" class="border_bot">
                    <td width="50%" align="right" class="border_bot">  Address : </td>
                    <td width="50%" align="left" class="border_bot">
                    	<textarea name="classified_poster_street"><?php echo $res[classified_poster_street];?></textarea>
                    </td>
                </tr>
                
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">City : </td>
                  <td align="left" class="border_bot"><?php echo $city['city_name'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Province/state : </td>
                  <td align="left" class="border_bot"><?php echo $state['state_name'];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Postal code : </td>
                  <td align="left" class="border_bot"><?php echo $res['classified_poster_zipcode'];?></td>
                </tr>
                <tr align="left" valign="top" bgcolor="#FFFFFF" class="border_bot">
                  <td colspan="2" class="border_bot"><strong> <strong>Classified   Details :</strong></strong>
				  </td>
                </tr>
                
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">Posted In : </td>
                <td align="left" class="border_bot">
				<?php
					$var="";				
					if($res[clsd_cat_id]!="" && $res[clsd_cat_id]!=0){				
						$var.='&raquo; '.get_catinfo($res['clsd_cat_id'],'cat_name').'&nbsp;';
					}
					if($res[clsd_subcat_id]!="" && $res[clsd_subcat_id]!=0){				
						$var.='&raquo; '.get_catinfo($res['clsd_subcat_id'],'cat_name').'&nbsp;';
					}
					if($res[clsd_sub_subcat_id]!="" && $res[clsd_sub_subcat_id]!=0){				
						$var.='&raquo;  '.get_catinfo($res['clsd_sub_subcat_id'],'cat_name').'&nbsp;';
					}				 
					
					echo $var;
				?>
				</td>
                </tr>
                
                <tr valign="top" class="border_bot">
                    <td align="right" class="border_bot">
                        Classified Title: 
                    </td>
                    <td align="left">
                        <input type="text" name="classified_title" value="<?php echo $res['classified_title'];?>" style="width: 300px;" />
                    </td>
                </tr>
                
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">Featured : </td>
                  <td align="left" class="border_bot"><?php echo $res[classified_featured];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">Published on :</td>
                  <td align="left" class="border_bot"><?php echo $res[cli_post_date];?></td>
                </tr>
                <?php
				if($res[cli_post_date]!=$res[cli_update_date]){
				?>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">Update on :</td>
                  <td align="left" class="border_bot"><?php echo $res[cli_update_date];?></td>
                </tr>
                <?php
				}
				?>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Offer : </td>
                  <td align="left" class="border_bot">
				  <?php if($res[classified_price_option]!="") { ?>
				<span class="heading">Price : </span><span class="blue-heading">
				<?php echo $res[classified_price_option];?>
				</span>
				<?php }else{ ?>
				<span class="heading"><?php echo $res[offer];?></span>
				<?php } ?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Ad ID : </td>
                  <td align="left" class="border_bot"><?php echo $res[classified_key];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">Classified Type : </td>
                  <td align="left" class="border_bot"><?php echo $res[classified_type];?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot">Ad Type :</td>
                  <td align="left" class="border_bot"><?php echo $res[classified_type];?></td>
                </tr>

				<tr>
                	<td colspan="2"><br><br></td>
                </tr>

                <?php
                $sql=db_query("select * from tbl_classif_option where classif_id ='$res[classified_id]'") or die (mysql_error());
                $li=1;
                while($rw2=mysql_fetch_array($sql)){
                
                $sql1=db_query("select * from tbl_option_cat where option_id ='$rw2[option_id]'") or die (mysql_error());
                $r1=mysql_fetch_array($sql1);
                $option_name=$r1[option_nom];
                
                
                $sql2=db_query("select * from tbl_value_option where val_id ='$rw2[val_id]'") or die (mysql_error());
                $r2=mysql_fetch_array($sql2);
                $ends=mysql_num_rows($sql);
                $val_name=$r2[val_nom];
                if(($r1[option_id]==159)||($r1[option_id]==160)){
                
                if(($opname=="")||($opname!=$option_name)||($li==$ends)){
                
                if($opname==""){
                    $opname=$option_name;
                    $vaname= $val_name;
                }
                if($opname!=$option_name){
                    ?>
                    <tr valign="top" class="border_bot">
                          <td align="right" class="border_bot"><span class="heading"><?php echo $opname;?>:</span></td>
                          <td align="left" class="border_bot"><?php echo $vaname;?></td>
                    </tr>
                    <?php 
                    $opname=$option_name;
                    $vaname= $val_name;
                }else if($li==$ends){
                
                    $opname=$option_name;
                    $vaname.= $val_name;
                    ?>
                    <tr valign="top" class="border_bot">
                          <td align="right" class="border_bot">
                            <span class="heading"><?php echo $opname;?>:</span></td>
                          <td align="left" class="border_bot"><?php echo $vaname;?></td>
                    </tr>
                    <?php
                }
                }
                else{
                $opname=$option_name;
                $vaname.= $val_name;
                }
                
                }
                else{
                ?>
                    <tr valign="top" class="border_bot">
                          <td align="right" class="border_bot">
                            <span class="heading"><?php echo $option_name;?>:</span></td>
                          <td align="left" class="border_bot"><?php echo $val_name;?></td>
                    </tr>
                <?php 
                }
                $li++;
                }
                $sql=db_query("select * from tbl_classified_other where classifief_id ='$res[classified_id]'") or die (mysql_error());
                while($rw2=mysql_fetch_array($sql)){
                
                $sql1=db_query("select * from tbl_option_cat where option_id ='$rw2[option_id]'") or die (mysql_error());
                $r1=mysql_fetch_array($sql1);
                
                if( $r1[option_id] == "183" || $r1[option_id] == "149" ){
                
                $ncat=db_query("select * from tbl_category where cat_id ='$res[clsd_sub_subcat_id]'") or die (mysql_error());
                $rcat=mysql_fetch_array($ncat);
                ?>
                    <tr valign="top" class="border_bot">
                          <td align="right" class="border_bot"><?php $r1[option_id];?><span class="heading">Fonction:</span></td>
                          <td align="left" class="border_bot"><?php echo $rcat[cat_name];?></td>
                	</tr>
                <?php
                }
                else if($r1[option_id] == "153"){
                
                $ncat=db_query("select * from tbl_category where cat_id ='$rw2[other_value]'") or die (mysql_error());
                $rcat=mysql_fetch_array($ncat);
                ?>
                    <tr valign="top" class="border_bot">
                        <td align="right" class="border_bot"><?php $r1[option_id];?><span class="heading">Fonction:</span></td>
                        <td align="left" class="border_bot"><?php echo $rcat[cat_name];?></td>
                	</tr>
                <?php
                }
                else{
                ?>
                    <tr valign="top" class="border_bot">
                        <td align="right" class="border_bot"><span class="heading"><?php echo $r1[option_nom];?>:</span></td>
                        <td align="left" class="border_bot"><?php echo $rw2['other_value'];?></td>
                    </tr>
                <?php
                }
                }
                ?>
                <tr align="left" valign="top" bgcolor="#FFFFFF" class="border_bot">
                	<td colspan="2" class="border_bot"><strong> <strong>Classified   Details :</strong></strong></td>
                </tr>
                <tr valign="top" class="border_bot">
                    <td align="right" class="border_bot"><span class="heading">Nbre visited:</span></td>
                    <td align="left" class="border_bot"><?php echo $visites=classified_visits($res['classified_id']); ?></td>
                </tr>
                <tr valign="top" class="border_bot">
                    <td align="right" class="border_bot"><span class="heading">Nbre Contact:</span></td>
                    <td align="left" class="border_bot"><?php echo $contact=classified_contacts($res['classified_id']); ?></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="left" class="border_bot"><strong>Description : </strong></td>
                  <td align="left" class="border_bot">&nbsp;</td>
                </tr>
                <input type="hidden" name="classified_id" value="<?php echo $res['classified_id'];?>">
                <tr align="left" valign="top" class="border_bot">
					<td colspan="2" class="border_bot">
                    	<textarea name="classified_desc" id="classified_desc" cols="200" rows="8"><?php echo $res['classified_desc'];?></textarea>
                	</td>
                </tr>
                
                <tr align="left" valign="top" class="border_bot">
					<td colspan="2" class="border_bot"><strong>View Pictures :</strong></td>
                </tr>

<?php 
function FileSizeConvert($bytes)
{
    $bytes = floatval($bytes);
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

    foreach($arBytes as $arItem)
    {
        if($bytes >= $arItem["VALUE"])
        {
            $result = $bytes / $arItem["VALUE"];
            $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
            break;
        }
    }
    return $result;
}

function getSize($file) { 
        $size = filesize($file); 
        if ($size < 0) 
            if (!(strtoupper(substr(PHP_OS, 0, 3)) == 'WIN')) 
                $size = trim(`stat -c%s $file`); 
            else{ 
                $fsobj = new COM("Scripting.FileSystemObject"); 
                $f = $fsobj->GetFile($file); 
                $size = $file->Size; 
            } 
        return $size; 
    } 
?>
                <tr align="center" valign="top" class="border_bot">
                	<td colspan="2" align="center">
            <table>
                <tr>
                    <td align="center"><?php echo $delete[0];?> <br><br><?php echo $link[0];?> <br><?php echo FileSizeConvert(filesize($lien[0]));?></td>
                    <td align="center"><?php echo $delete[1];?> <br><br><?php echo $link[1];?> <br><?php echo FileSizeConvert(filesize($lien[1]));?></td>
                    <td align="center"><?php echo $delete[2];?> <br><br><?php echo $link[2];?> <br><?php echo FileSizeConvert(filesize($lien[2]));?></td>
                    <td align="center"><?php echo $delete[3];?> <br><br><?php echo $link[3];?> <br><?php echo FileSizeConvert(filesize($lien[3]));?></td>
                    <td align="center"><?php echo $delete[4];?> <br><br><?php echo $link[4];?> <br><?php echo FileSizeConvert(filesize($lien[4]));?></td>
                    <td align="center"><?php echo $delete[5];?> <br><br><?php echo $link[5];?> <br><?php echo FileSizeConvert(filesize($lien[5]));?></td>
                    <td align="center"><?php echo $delete[6];?> <br><br><?php echo $link[6];?> <br><?php echo FileSizeConvert(filesize($lien[6]));?></td>
                    <td align="center"><?php echo $delete[7];?> <br><br><?php echo $link[7];?> <br><?php echo FileSizeConvert(filesize($lien[7]));?></td>

                        
                        
                    <td align="center">
                       <?php
                        $nbre_link=count($link);
                        if($nbre_link<8){
                            ?>
                                <?php
                                    for($i=$nbre_link; $i<8 ; $i++)
                                    {
                                        echo $i+1;
                                ?>
                                        <input type="file" name="file<?=$i+1?>" id="file<?=$i+1?>" >
                                        <br>
                                <?php
                                    }
                        }
                       ?>
                    </td>
               
               </tr>
            </table>
                  </td>
                </tr>
       
                <tr>
                	<td colspan="2" align="center">
                    	<input type="submit" name="action" id="action" value="Modifier">
                    </td>
                </tr>
                
			</form>
</table>
</body>
</html>
