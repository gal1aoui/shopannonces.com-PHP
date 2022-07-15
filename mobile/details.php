<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$cryptinstall="cryptographp.fct.php";
include $cryptinstall;

$link_curr=get_config_setting(15);
$link_details=get_config_setting(17);

if($_REQUEST[clsId]!='')
	$id=secureValue($_REQUEST[clsId]);

$tmpClsID = (isset($id) && $id!="") ? intval($id) : 0;
/**************** Display records ***************/
if(!empty($tmpClsID)){	
	if(isset($_SESSION['memId']) && $_SESSION['memId']!=""){
	 $sql_clsi_show="select *,DATE_FORMAT(classified_post_date ,'%d-%m-%Y') as cli_post_date
	 from tbl_classified where classified_id=$tmpClsID and classified_status!='Delete' "; 
	}else{
	 $sql_clsi_show="select *,DATE_FORMAT(classified_post_date ,'%d-%m-%Y') as cli_post_date
	 from tbl_classified where classified_id=$tmpClsID and classified_status='Active' ";
	}

	$sql_rs_set=db_query($sql_clsi_show);
	$reccnt = mysql_num_rows($sql_rs_set);
	
	if($reccnt!=0)
	{
		$res=mysql_fetch_array($sql_rs_set);
		
		$sql_img="select * from tbl_classified_image where clsd_id='$res[classified_id]' and img_status='Y'";
		$sql_img_set=db_query($sql_img);
		
		if($res[classified_poster_state]!="" && $res[classified_poster_state]!=0){				 
			$state=getResult('tbl_state',"WHERE state_id=$res[classified_poster_state]");				
		}
		if($res[classified_city_id]!="" && $res[classified_city_id]!=0){				
			$city=getResult('tbl_city',"WHERE city_id=$res[classified_city_id]"); 
		}
		
		if(mysql_num_rows($sql_img_set) > 0 ) {
			$km=0;
			while($res1=mysql_fetch_array($sql_img_set)){        
				$file_sm="uploaded_files/classified_img/".$res1[cls_img_file];    
				$autoID[]=$res1['clsd_img_id']; 
				if($res1[cls_img_file]!=""){
					//$file_path_sm	 =	 show_thumb($file_sm,"65","65","width");
					//$file_path_big	 =	show_thumb($file_sm,"450","550","width");
					//$sz=getimagesize($file_path_sm);
					//$sz_big=getimagesize($file_path_big);
					
					$dis=($km==0) ? 'display:block;' : 'display:none;';
					
					$im_small='<a href="javascript:void(0);" onmouseover="show_gall('.$km.',7);"">
								<img src="'.$file_sm.'" alt="" width="65" height="65" border="0" />
								</a>';
								
					$im_big='
								<div class="m-item">
									<img src="'.$file_sm.'" alt=""  border="0" width="100%" height="400px">
								</div>
								/>';		  
					
					$im_arr_small[]= $im_small;
					$joom_link[]= '<a href="'.$file_path_big.'" title="" class="link" id="gallzoom_1_'.$km.'" style="'.$dis.'" rel="lightbox[me]"></a>';
					$im_arr_big[]= $im_big;	  
					$km++;
				}
			}
		}
		/**************** End Display Records ***************/
		
		$meta_titles=strip_tags(truncateText($res[classified_title],150,' ','.',true));
		$meta_titles = ($res[classified_price_option]!=0) ? $meta_titles." prix:".$res[classified_price_option].$link_curr : $meta_titles;
		$sm_title=strip_tags(truncateText($res[classified_title],40,' ','.',true));
		$sm_title = ($res[classified_price_option]!=0) ? $sm_title." prix:".$res[classified_price_option].$link_curr : $sm_title;
		$meta_desc=strip_tags(truncateText($res[classified_desc],80,' ','.',true));
		$meta_keywords=$sm_title;
		require_once("header.php");
		
		?>
		
        
<div class="heading">
    <span class="title_clad">
        <?php
        echo Rec_display_formate(truncateText($res[classified_title],70,' ','...',true));
        
        $date_comp=date('y-m-d h:i:s', strtotime('+1 days'));
        if(strtotime($date_comp) < strtotime($res[date_fin_urgent])) echo "<span class='urgent'>Urgent</span>";
        ?>
	</span>
    
    <?php
    if($res[classified_price_option]!="") { ?>
        <span class="heading">Prix :
        <?php echo $res[classified_price_option];?> <?php echo $link_curr;?>
        </span>
    <?php
    }else{ ?>
        <span class="heading"><?php echo $res[offer];?></span>
    <?php
    } ?>
</div>
        
        <div class="body">
        	<div>
                <div style="background-color:#FFFFFF;" class="mt17">
                    <table width="100%" border="0" cellspacing="2" cellpadding="2">
                        <tr>
                            <td>
                                <table width="100%">
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
                                                <tr>
                                                    <td>
                                                        <span class="heading"><?php echo $opname;?>:</span><?php echo $vaname;?>
                                                    </td>
                                                </tr>
                                                <?php 
                                                $opname=$option_name;
                                                $vaname= $val_name;
                                            }else if($li==$ends){
                                            
                                                $opname=$option_name;
                                                $vaname.= $val_name;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <span class="heading"><?php echo $opname;?>:</span><?php echo $vaname;?>
                                                    </td>
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
                                    <tr>
                                        <td>
                                            <span class="heading"><?php echo $option_name;?>:</span><?php echo $val_name;?>
                                        </td>
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
                                <tr>
                                    <td><?php $r1[option_id];?><span class="heading">Fonction:</span><?php echo $rcat[cat_name];?></td>
                                </tr>
                                <?php
                                }
                                else if($r1[option_id] == "153"){
                                
                                $ncat=db_query("select * from tbl_category where cat_id ='$rw2[other_value]'") or die (mysql_error());
                                $rcat=mysql_fetch_array($ncat);
                                ?>
                                <tr>
                                    <td><?php $r1[option_id];?><span class="heading">Fonction:</span><?php echo $rcat[cat_name];?></td>
                                </tr>
                                <?php
                                }
                                else{
                                ?>
                                    <tr>
                                        <td><span class="heading"><?php echo $r1[option_nom];?>:</span><?php echo $rw2['other_value'];?></td>
                                    </tr>
                                <?php
                                }
                                }
                                ?>
                                <tr class="bg-stripcolor">
                                    <td><span class="heading">Publiée le  :</span> <?php echo $res[cli_post_date];?></td>
                                </tr>
                                <tr>
                                    <td><span class="heading">Type d'annonce   : </span> <?php echo $res[classified_type];?></td>
                                </tr>
                                </table>
                            </td>
                        
                            <td align="right">
                                <table width="80%" border="0" cellspacing="0" cellpadding="4" class="cate-border p7">
                                    <tr class="bg-stripcolor1">
                                      <td valign="top"><strong>Province:</strong></td>
                                      <td valign="top"><?php echo $state['state_name'];?></td>
                                    </tr>
                                
                                    <tr>
                                      <td valign="top"><strong>Ville:</strong></td>
                                      <td valign="top"><?php echo $city['city_name'];?></td>
                                    </tr>                                            
                                
                                    <tr class="bg-stripcolor1">
                                        <td valign="top"><strong>Code Postal:</strong></td>
                                        <td valign="top"><?php echo $res[classified_poster_zipcode];?></td>
                                    </tr>
                                
                                <?php
                                if($res[classified_poster_street]!=""){
                                ?>
                                    <tr>
                                        <td valign="top"><span class="pb10">Rue:</span></td>
                                        <td valign="top"><?php echo $res[classified_poster_street];?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <div class="mt17">
                    <?php
                    if(!empty($im_arr_big)){
                    ?>
                        <link rel="stylesheet" href="src/scooch.css">
                        <link rel="stylesheet" href="src/scooch-style.css">
                
                        <div class="m-scooch m-fluid m-scooch-photos" id="m-scooch-example-1">
                          <div class="m-scooch-inner">
                            <?php
                                print_r($im_arr_big);
                            ?>
                          </div>
                          
                          <?php
                          if(count($im_arr_big)>1){?>
                              <div class="m-scooch-controls">
                                <a href="#" data-m-slide="prev">&lsaquo; Pr&eacute;c&eacute;dent</a>
                                <a href="#" data-m-slide="next">Suivant &rsaquo;</a>            
                              </div>
                          <?php
                            }
                            ?>
                        </div>
                        
                        <!-- <script src="http://zeptojs.com/zepto.js"></script> -->
                        <script src="src/scooch.js"></script>
                        <script>$('#m-scooch-hide-arrows').scooch({autoHideArrows:true});</script>
                        <script>$('#m-scooch-no-animate').scooch({animate:false});</script>
                        <script>$('.m-scooch').scooch();</script>
                    <?php
                    }
                    ?>
                </div>
                            
                <div class="">
                    <?php //require_once("ads-by-google2.php"); ?>
                </div>
                
                <div class=" mt17">
                    <h3 class="heading">Description</h3>
                    <p style=" padding-left:10px; padding-right:10px;"><?php echo nl2br($res[classified_desc]);?></p>
                </div>
            </div>

            <div id="menuright">
                <div class="grid_5 tc" style="padding:5px;">
                            <a class="button button-green link" href="contact.php?clsId=<?php echo $tmpClsID?>"><!-- rel="facebox">-->
                                Contacter cet annonceur
                            </a>
                            &nbsp;
                            <a class="button button-orange link-signaler" href="signaler.php?clsId=<?php echo $tmpClsID?>" style="color:#cc0000;">
                                Signaler cette annonce
                            </a>
                            &nbsp;
                            <a href="#"  onClick="window.print();" class="button button-grey">
                                <span class="" style=" display:inline-block;width:17px;height:21px;
                                    background:url('images/print.gif');background-repeat:no-repeat;vertical-align: middle;"></span>
                                    Imprimer
                            </a>
                            
                        <?php
                            /* Update visiter count*/
                            $visites=classified_visits($tmpClsID)+1;
                            $sql_visit="UPDATE tbl_classified set classified_visit=$visites where classified_id='$tmpClsID'";  
                            db_query($sql_visit);
                            /* End Update visiter count */
                        ?>
                            &nbsp;
                            <a href="#">Visite: <?php echo $visites; ?></a>
                </div>
            </div>

		</div>

	<?php
	
	}
	else{
		header('Location: index.php');		
	}

}?>

<?php
	require_once("footer.php");
?>