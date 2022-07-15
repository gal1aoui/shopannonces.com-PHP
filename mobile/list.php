<?php
	require_once("includes/main.inc.php");
	require_once("front-functions.php");

	
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;

$cat_id=intval($_REQUEST['catId']);
$subcat_id=intval($_REQUEST['subcatId1']);
$sub_subcat_id=intval($_REQUEST['subcatId']);

$cat=intval($_REQUEST['cat']);
if($cat_id==0 && $subcat_id==0 && $sub_subcat_id==0){
	
		switch(chekcat($cat)){
			case "clsd_sub_subcat_id":
				$sub_subcat_id=$cat;
				$cl="clsd_sub_subcat_id";				
			break;
			
			case "clsd_subcat_id":
				$subcat_id=$cat;
				$cl="clsd_subcat_id";				
			break;
			
			case "clsd_cat_id":
				$cat_id=$cat;
				$cl="clsd_cat_id";				
			break;
		}	
}
else if($cat_id!=0){
				$cl="clsd_cat_id";	
}
else if($subcat_id!=0){
				$cl="clsd_subcat_id";	
}
else if($sub_subcat_id!=0){
				$cl="clsd_sub_subcat_id";
}	

	if(@$_REQUEST['stateId']!=""){
		$stateId=intval(@$_REQUEST['stateId']);
		$statename=Get_statename($stateId);
	}

	$ad_type =strip_tags(trim(secureValue($_REQUEST['offer_type'])));
	$picture=secureValue(@$_REQUEST['picture']);
	
$types = array();
$mots = explode(" ", $keyword);
foreach($mots as $valeur)
{
	$types[]=($keyword!="") ? " AND (`classified_title` LIKE '%{$valeur}%' OR`classified_desc` LIKE '%{$valeur}%')" : " ";	
}

$types[] = ($cat_id!="")? " AND tbl_classified.`clsd_cat_id`=$cat_id" : "";
$types[] = ($subcat_id!="")? " AND tbl_classified.`clsd_subcat_id`= $subcat_id" : "";
$types[] = ($sub_subcat_id!="")? " AND tbl_classified.`clsd_sub_subcat_id`=$sub_subcat_id" : "";
$types[] = ($stateId!="")? " AND `classified_poster_state` = $stateId" : "";
$types[] = ($cityId!="")? " AND `classified_city_id`='$cityId'" : "";
$types[] = ($fromprix && $toprix==0)? " AND `classified_price_option` > $fromprix" : 
			(
				($fromprix==0 && $toprix)? " AND `classified_price_option` < $toprix"
					:(
						($fromprix && $toprix)? " AND `classified_price_option` BETWEEN $fromprix AND $toprix" : ""
					)
			);
$types[] = ($ad_type!="")? " AND `classified_type`='$ad_type'" : "";

$types = array_filter($types,"removeEmpty");
$types=implode($types);

$dtjour= date("Y-m-d");
					
$sql="SELECT SQL_CALC_FOUND_ROWS *,
			IF( DATE_FORMAT(`date_fin_republication`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d')
				AND
				DATE_FORMAT(`date_fin_premium`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d') ,
				'1',
					IF( DATE_FORMAT(`date_fin_premium`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d') ,
					'2',
						IF( DATE_FORMAT(`date_fin_republication`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d') ,
						'3',
						'4' ) ) ) AS trie  
							FROM tbl_classified";

$sql=($picture=='')? $sql : $sql." INNER JOIN tbl_classified_image as tblimage
										ON tblimage.clsd_id=tbl_classified.classified_id ";
										
			
	$sql.=($fromannee==0 && $toannee==0 && $fromkm==0 && $tokm==0 && $energy==""  && $fromcylindree==0 && $tocylindree==0 && $Type_vehicule=="" && $type_camion=="" && $fromlongueur==0 && $tolongueur==0 && $frompiece==0 && $topiece==0  && $fromssurface==0 && $tossurface==0 && $typeconstructible=="" && $typesituation=="" && $typeType=="" && $ventelocation=="" && $fromchambre==0 && $tochambre==0 && $typePays=="" && $typeVille=="" && $typeventelocation=="" && $typecontrat=="" && $typeformation=="" && $typeexperience=="" && $typeMobilite=="" && $typeemploi=="" && $typetypeemploi=="" && $typeautretache=="" && $typevilledestination=="")? " 
											WHERE classified_status='Active'
											
											$types":"";
	
	$sql.=" GROUP BY tbl_classified.`classified_id`";
	
	if($prix!=""){
		$sql.=" ORDER BY tbl_classified.classified_price_option $prix LIMIT $start, $pagesize";
	}
	else if($datepub!=""){
		$sql.=" ORDER BY tbl_classified.classified_post_date $datepub LIMIT $start, $pagesize";
	}
	else{ /*  , `date_fin_premium` DESC */
		$sql.=" ORDER BY trie ASC, `classified_update_date` DESC LIMIT $start, $pagesize";
	}


//echo $sql;

$rs_classi=db_query($sql);
$res_classi = mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
$reccnt=$res_classi['total'];

$cat_name=get_catinfo($cat,'cat_name');
$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_category','cat_id',$cat);
	
$state_name=Get_statename($stateId);
$city_name=Get_cityname($cityId);
	
$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_category','cat_id',$cat);
$meta_titles=$state_name." ".$city_name." ".$meta_titles;
$meta_desc=$state_name." ".$city_name." ".$meta_desc;
$meta_keywords=$state_name." ".$city_name." ".$meta_keywords;

$meta_titles=$meta_titles=="  "? "Boutiques": $meta_titles;
$meta_desc=$meta_desc=="  "? "Boutiques": $meta_desc;
$meta_keywords=$meta_keywords=="  "? "Boutiques": $meta_keywords;

require_once("header.php");
?>


<div id="searchform" class="searchform" >
    <?php include("filter-search.php"); ?>
</div>

<div class="heading">
	<?=$reccnt?> Annonces : <?=$statename?>
</div>

<div class="body">

                
        <div>
        <?php    
            if($reccnt > 0 ) {
        ?>
                <div id="classifieds">
                    <ul class="results">
                    <?php
                    $count=0;
                    while($rw=mysql_fetch_array($rs_classi)){ 
                        $count++;	
                        $html_link="details.php?clsId=".$rw[classified_id];
                    
                        $date_comp=date('y-m-d h:i:s', strtotime('+1 days'));
                        $AnnonceCouleur=(strtotime($date_comp) < strtotime($rw[date_fin_couleur])) ? '#FFCC99' : '';
                        
                        //$backgroundcolor=($AnnonceCouleur=='') ? '#c5e099': $AnnonceCouleur;
                        
                        
                        $sql_img="select * from tbl_classified_image where clsd_id=$rw[classified_id] and img_status='Y'";
                        $sql_img_set=db_query($sql_img);
                        
                        if(mysql_num_rows($sql_img_set) > 0 ) { 
                            $res1=mysql_fetch_array($sql_img_set);          
                            $file_sm="uploaded_files/classified_img/".$res1[cls_img_file];	
                            $file_sm_root="uploaded_files/classified_img/".$res1[cls_img_file]; 
                            
                            if($res1[cls_img_file]!="" && file_exists($file_sm_root) ){
                            
                                $file_path_sm	 =	 show_thumb($file_sm,"80","80","width");
                                $sz=getimagesize("".$file_path_sm);
                                $im_small='<img src="'.$file_path_sm.'" alt="'.$alt.'" border="0" width="95" height="95" class="border-img"/>';
                            }else{
                                $im_small ='<img src="uploaded_files/cat_img/'.$rw[clsd_cat_id].'.png" alt="'.$alt.'" border="0" width="95" height="95" class="border-img"/>';
                            }
                        }else{
                                $im_small ='<img src="uploaded_files/cat_img/'.$rw[clsd_cat_id].'.png" alt="'.$alt.'" border="0" width="95" height="95" class="border-img"/>';
                        }
                    ?>
                        <li class="evenrow">
                            <a href="<?=$html_link?>" class="list-link">
                                    <table border="0" width="100%" style="background-color:<?php echo $AnnonceCouleur;?>">
                                        <tr>
                                            <td width="95">
                                                <?php
                                                echo $AnnoncePremium=(strtotime($date_comp) < strtotime($rw[date_fin_premium])) 
                                                                    ? 
                                                                        '<span class="premium">PREMIUM</span>' 
                                                                    : 
                                                                        '';
                                                ?>
                                                
                                                <div class="results-img">
                                                    <?php
                                                        echo $im_small;
                                                        if(getNumberPhoto($rw['classified_id']))
                                                        echo "<span class='photo-num'>".getNumberPhoto($rw['classified_id'])."</span>";
                                                    ?>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="results-title">
													<?=$rw[classified_title]?>
                                                    
                                                    <nobr>
														<?php
                                                        if(strtotime($date_comp) < strtotime($rw[date_fin_urgent]))
                                                        {
                                                            ?>
                                                            <span class="premium">Urgent</span>
                                                            <?php
                                                        }?> 
                                                    </nobr>
                                                    
                                                </div> 
                                                <div class="results-subtitle"> 
                                                    <nobr class="price"><?=$rw[classified_price_option]?> €</nobr> 
                                                    <!--<span class="vs-spec-divider">|</span> <nobr> Particulier </nobr>-->
                                                    <span class="vs-spec-divider">|</span>
                                                    <nobr> <?=Get_cityname($rw[classified_city_id])?> </nobr> 
                                                </div>                                    
                                            </td>
                                        </tr>
                                    </table>
                                    
                            </a>
                        </li> 
                <?php
                    }
                ?>
                </ul>
                </div>
        <?php
            }
            else{
                ?>
                <div>
                    Il n'y a pas de résultats correspondants à votre recherche.
                </div>
        <?php
            }
        ?>
        
        </div>
        
        <div>
            <?php include("paging.php"); ?>
        </div>

</div>
<?php
	require_once("footer.php");
?>