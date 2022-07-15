<?php
if($_REQUEST['catId']!=""){
	$catID = intval($_REQUEST['catId']);
  $columns_feature = "select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(classified_post_date ,'%d %M %Y') as cli_post_date ";
 $sql_feature = " from ".DB.".tbl_classified
  where clsd_cat_id ='$catID' and classified_status='Active' and classified_featured='Yes' limit $start,   $pagesize ";
}
if($_REQUEST['subcatId']!=""){
	$subCatID = intval($_REQUEST['subcatId']);
  $columns_feature = "select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(classified_post_date ,'%d %M %Y') as cli_post_date ";
  $sql_feature = " from ".DB.".tbl_classified
  where clsd_sub_subcat_id ='$subCatID' and classified_status='Active' and classified_featured='Yes' limit $start, $pagesize ";
}
$sql_feat= $columns_feature.$sql_feature; 
$rs_feat_classi=db_query($sql_feat);
$res_feat_classi = mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
$reccnt_feat=$res_feat_classi['total'];


?>
<?php
	if($reccnt_feat > 0 ) {
	 $count=0;
	 while($rw=mysql_fetch_array($rs_classi)){ 
	 $count++;
	 $bg=($count%2==0) ? "mt10" : "";
	 $city=getResult('tbl_city',"WHERE city_id=$rw[classified_city_id]");
	 $contact_info=($rw[classified_price_option] !="") ? "<strong>Price: </strong> $rw[classified_price_option]" : "       <strong>$rw[offer]</strong>";	 
	  $sql_img="select * from tbl_classified_image where clsd_id=$rw[classified_id] and img_status='Y'";
      $sql_img_set=db_query($sql_img);
     if(mysql_num_rows($sql_img_set) > 0 ) { 
        $res1=mysql_fetch_array($sql_img_set); 
		
          $file_sm=UP_FILES_WS_PATH."/classified_img/".$res1[cls_img_file];
		  $file_csm=UP_FILES_FS_PATH."/classified_img/".$res1[cls_img_file];
		 
	      if($res1[cls_img_file]!="" && file_exists($file_csm_root) ){
			  
	          $file_path_sm	 =	 show_thumb($file_sm,"80","80","width");		 
		      $sz=getimagesize($file_path_sm);			  			 
			  $width=($sz[0]>=80) ?  '80' :  $sz[0];
			  $height=($sz[1]>=80) ? '80'  : $sz[1];		  			  			  		  
			  $im_small='<a href="classified-details.php?clsId='.$rw[classified_id].'">
			 <img src="'.$file_path_sm.'" alt="" border="0" class="border-img"/></a>';
	         $im_arr_small[]= $im_small;       
      }
  }
?>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td valign="top" align="center">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td >
<table width="100%" border="0" cellpadding="4" cellspacing="0" class="<?php echo $bg;?>">
            <tr>
              <td colspan="2"><span class="green-heading">
			  <a href="#" class="link2"><?php echo Rec_display_formate($city[city_name]);?>:</a>
			  </span>
			  <a href="classified-details.php?clsId=<?php echo $rw[classified_id];?>" class="link1 b">
			  <?php echo Rec_display_formate(truncateText($rw[classified_title],80,' ','...',true));?></a></td>
              </tr>
            <tr>
              <td width="11%" valign="top">
			  <?php if(count($im_arr_small) > 0 ) {
			   echo $im_arr_small[0];
			   }else{?>			 
			  <a href="classified-details.php?clsId=<?php echo $rw[classified_id];?>">
			  <img src="<?php echo $theem_img;?>/blank-img.jpg" alt="" border="0" class="border-img"/>
			  </a> 
			  <?php } ?>
			  </td>
              <td width="89%" valign="top"><div>
                <p class="fl"><?php echo $contact_info ;?></p>
                <p class="fr b"><?php echo $rw[cli_post_date];?></p>
                <p class="cb"></p>
                </div>
                <div class="mt10">
				<?php echo Rec_display_formate(truncateText($rw[classified_desc],200,' ','...',true));?>
				</div></td>
              </tr>
            <tr>
              <td colspan="2" align="left" class="border-bot">			  			          
             <div class="CollapsiblePanelTab ar">
			 <a id="rep<?php echo $rw['classified_id'];?><?php echo $rw[classified_key];?>" title="">
			  <img src="<?php echo $theem_img;?>/reply-btn.gif" alt="" border="0"/></a></div>			  			  			   
		<div id="inq<?php echo $rw['classified_id'];?><?php echo $rw[classified_key];?>" class="CollapsiblePanel" style="display:none">
             <form id="" action="" method=post>
             <div class="CollapsiblePanelTab ar">
			 <a id="R-64730522" title="">
			  <img src="<?php echo $theem_img;?>/close.gif" alt="" border="0"/></a></div>
                <div class="CollapsiblePanelContent">
                  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="green-bgcolor white-style">
                    <tr>
                      <td width="24%" class="b">Name&nbsp;
                        <input name="input4" type="text" class="textbox1" style="width:120px;"/></td>
                      <td width="23%" class="b">Email&nbsp;
                        <input name="input4" type="text" class="textbox1" style="width:120px;"/></td>
                      <td width="26%" class="b">Message&nbsp;
                        <input name="input4" type="text" class="textbox1" style="width:120px;"/></td>
                      <td width="8%"><a href="#"><img src="<?php echo $theem_img;?>/submit-btn.jpg" alt="" border="0"/></a></td>
                      <td width="19%" class="fs11"><input type="checkbox" name="checkbox3" id="checkbox3" />
                        Vous acceptez nos <a href="terms-use.htm" class="link3 u">Politique de confidentialité</a> &amp; <a href="privacy-policy.htm" class="link3 u">Politique de confidentialité</a></td>
                    </tr>
                  </table>
                </div>
				</form>
              </div></td>
              </tr>
            </table>
			<?php  }			
			    }else{
			 ?>
			  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="mt10">
             <tr>
			  <td><strong>Aucune annonce classée trouvée dans cette catégorie...</strong></td>
			  </tr>
            </table>
            <?php
				}
				?>

</td>
</tr>
</table>