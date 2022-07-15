<?php
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$cityId=intval($res['classified_city_id']);
 if($cityId!=""){ 
	$tmpID = intval($_REQUEST[clsId]);
  $col = "select SQL_CALC_FOUND_ROWS * ";
  $sqlcity = " from ".DB.".tbl_classified
    where classified_id!=$tmpID and classified_city_id ='$cityId'
	and classified_status='Active' limit $start,$pagesize "; 
    $sqlcity = $col.$sqlcity; 
	$rs_city=db_query($sqlcity);
	$res_cls_city= mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
  $reccnt_city=$res_cls_city['total'];
   }
?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
            <tr>
              <td width="50%" valign="top">
			 <?php
			  if($reccnt_city > 0 ) {
				 $count=0;
				while($rw_city=mysql_fetch_array($rs_city)){
				$city=getResult('tbl_city',"WHERE city_id=$rw_city[classified_city_id]");
				
				 $html_link="classified-details.php?clsId=".$rw_city[classified_id];
 //$html_link="classified/clsId/$rw_city[classified_id]/".GetValidFileName(Rec_display_formate(truncateText($rw_city[classified_title],40,' ','...',true)))."/";
 
				 ?> 
			   <p>
			  <a href="<?php echo $html_link;?>" class="link1">
			  <?php echo Rec_display_formate(truncateText($rw_city[classified_title],80,' ','...',true));?> </a>
			   - <?php echo Rec_display_formate($city['city_name']);?></p>
			   <?php }			
			    }else{
			  ?> 
			  <p>
			   <strong>Aucune autre annonce classée dans cette ville...</strong>
			   </p>
			   <?php } ?>
              </td>
              </tr>
</table>