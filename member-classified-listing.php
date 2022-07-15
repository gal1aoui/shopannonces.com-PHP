<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
if($_REQUEST['clsId']!=""){
 $id=intval($_REQUEST['clsId']);  
 $arr_mem= getQuery('tbl_classified'," where classified_id=$id",'mem_id,classified_id,clsd_sub_subcat_id');
 $memId=$arr_mem['mem_id'];
   $_REQUEST['subcatId']=$arr_mem['clsd_sub_subcat_id'];
}

$arr=list($title,$description,$keyword)=get_meta_details('tbl_category','cat_id',$id);
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;
require_once("header.inc.php");
$cat_name=get_catinfo($id,'cat_name');
$arr_font=get_site_setting();
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;

if($_REQUEST['sort_by']!=""){     
	$sort=$_REQUEST['sort_by'];
	$cond_all="AND classified_status='Active' AND paid_status!='Pending' AND 
	IF(feature_expired_date!=0000-00-00 && classified_featured='Yes',IF(feature_expired_date >= DATE(NOW()),true,false),true)";
	
	if($sort=="new"){
	  $cond=" $cond_all ORDER BY classified_featured asc,classified_post_date desc "; 
	}
	
	if($sort=="oldest"){
	  $cond=" $cond_all ORDER BY classified_featured,classified_post_date asc "; 
	}
	
	if($sort=="popular"){
	  $cond=" $cond_all ORDER BY classified_featured asc,classified_visit  desc "; 
	}	
}else{
   $cond=" $cond_all ORDER BY classified_featured asc,classified_post_date desc "; 
}



if($_REQUEST['clsId']!=""){
	$columns = "SELECT SQL_CALC_FOUND_ROWS * ";
	$sql = " FROM ".DB.".tbl_classified where mem_id ='$memId'
	and classified_status='Active' $cond LIMIT  $start, $pagesize ";

}
$sql = $columns.$sql; 
if(!empty($sql)) {
	$rs_classi=db_query($sql);
	$res_classi = mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
	$reccnt=$res_classi['total'];
}

$tCatID = (!empty($_REQUEST['catId']) && is_numeric($_REQUEST['catId'])) ? intval($_REQUEST['catId']) : 0;
$tSubCatID1 = (!empty($_REQUEST['subcatId1']) && is_numeric($_REQUEST['subcatId1'])) ? intval($_REQUEST['subcatId1']) : 0;
$tSubCatID = (!empty($_REQUEST['subcatId']) && is_numeric($_REQUEST['subcatId'])) ? intval($_REQUEST['subcatId']) : 0;
$tCityID = (!empty($_REQUEST['cityId']) && is_numeric($_REQUEST['cityId'])) ? intval($_REQUEST['cityId']) : 0;
$tClsID = (!empty($_REQUEST['clsId']) && is_numeric($_REQUEST['clsId'])) ? intval($_REQUEST['clsId']) : 0;
$tStart = secureValue($_REQUEST['start']);
?>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td valign="top" align="center">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td >
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="193" valign="top" style="padding:5px 0 0 3px;">
      <?php require_once("left-search.php"); ?></td>
    <td width="807" valign="top" style="padding:5px 5px 0 15px;"><table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td width="33%" class="main-heading"><?php echo strip_tags($cat_name);?></td>
      </tr>
      <tr>
        <td valign="top" class="tree">
		 <?php	
		 if($_REQUEST['subcatId']!=""){		 
		  echo front_navigation('','',$_REQUEST['subcatId']);
		 }		 
		?>
		</td>
      </tr>
      <tr>
        <td valign="top" style="padding-top:3px;">
  <form name="frm" action="" method="get">
  <table width="100%" border="0" cellpadding="2" cellspacing="0" class="green-bgcolor white-style b">
          <tr>
            <td width="44%" class="pl10">À l affiche <?php echo  $start+1?> to <?php echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>	of <?php echo  $reccnt?> Annonces </td>
            <td width="56%" align="right">Sort :
              <select name="sort_by" class="textbox1" style="width:150px;" onChange="document.frm.submit();">
                    <option value="new" <?php if($_REQUEST[sort_by]=="new"){ echo "selected"; } ?> >Nouvelles annonces</option>
               <option value="oldest" <?php if($_REQUEST[sort_by]=="oldest"){ echo "selected"; } ?>>Annonces plus vieilles</option>
            <option value="popular" <?php if($_REQUEST[sort_by]=="popular"){ echo "selected"; } ?>>Annonces populaires</option>
                </select></td>
        <?php if($_REQUEST['catId']!=""){ ?>
        <input name="catId" type="hidden" value="<?php echo $tCatID;?>">
        <?php } ?>
        <?php if($_REQUEST['subcatId1']!=""){ ?>
        <input name="subcatId1" type="hidden" value="<?php echo $tSubCatID1;?>">
        <?php } ?>
        <?php if($_REQUEST['subcatId']!=""){ ?>
        <input name="subcatId" type="hidden" value="<?php echo $tSubCatID;?>">
        <?php } ?>
        <?php if($_REQUEST['start']!=""){ ?>
        <input name="start" type="hidden" value="<?php echo $tStart;?>">
        <?php } ?>
       <?php if($_REQUEST['cityId']!=""){ ?>
        <input name="cityId" type="hidden" value="<?php echo $tCityID;?>">
        <?php } ?>
		<?php if($_REQUEST['clsId']!=""){ ?>
        <input name="clsId" type="hidden" value="<?php echo $tClsID;?>">
        <?php } ?>		
        </tr>
          </table>
           </form> 
		   <?php echo Display_Message();?>
		    <div align="right" style="margin-top:5px;">
	<div align="left">Annonces par page:<?php echo pagesize_dropdown('pagesize', $pagesize);?></div>
			<a href="rss.php?subcatId=<?php echo $tSubCatID;?>">
			<img src="<?php echo $theem_img;?>/rss.jpg" alt="" border="0"/></a>&nbsp;<a href="sitemap.xml"><img src="<?php echo $theem_img;?>/xml.jpg" alt="" border="0"/></a>
			</div>
          <?php require_once("google-ads.php"); ?>		 
          <div class="p7 blue-heading bg-stripcolor">Annonce vedette</div>
<?php include("paging.inc.php"); ?>
<?php
if($reccnt > 0 ) {
			$count=0;
			while($rw=mysql_fetch_array($rs_classi)){ 
			$count++;				
			$bg=($rw[classified_featured]=="Yes") ? "mt10 bg-stripcolor1" : "mt10";
           $alt= strip_tags(truncateText($rw[classified_title],40,' ','...',true));
			$city=getResult('tbl_city',"WHERE city_id=$rw[classified_city_id]");	 
			$sql_img="select * from tbl_classified_image where clsd_id=$rw[classified_id] and img_status='Y'";
			$sql_img_set=db_query($sql_img);
			
     if(mysql_num_rows($sql_img_set) > 0 ) { 
              $res1=mysql_fetch_array($sql_img_set);          
              $file_sm=UP_FILES_WS_PATH."/classified_img/".$res1[cls_img_file];	 
			  $file_sm_root=UP_FILES_FS_PATH."/classified_img/".$res1[cls_img_file];
			  
	          if($res1[cls_img_file]!="" && file_exists($file_sm_root)){
				  
			
	          $file_path_sm	 =	 show_thumb($file_sm,"80","80","crop");		 
		      $sz=getimagesize($file_path_sm);			  			 
			  $width=($sz[0]>=80) ?  '80' :  $sz[0];
			  $height=($sz[1]>=80) ? '80'  : $sz[1];		  			  			  		  
			  $im_small='<img src="'.$file_path_sm.'" alt="'.$alt.'" border="0" class="border-img"/>';
	               
          }else{
			  
			  $im_small = ""; 			 
			
		  }
     }else{
		 $im_small = ""; 
     }
	  //classified-details.php?clsId=<?php echo $rw[classified_id];
 $html_link=SITE_WS_PATH."/classified-details.php?clsId=".$rw[classified_id];
	
 ?> 
    <?php if($rw[classified_featured]=="No" && $cnt=="") { //class="user_cl link1 b" ?>
      <div class="p7 blue-heading bg-stripcolor mt17">Annonces</div>
	  <?php $cnt=1;} ?>	  
      <table width="100%" border="0" cellpadding="4" cellspacing="0" class="<?php echo $bg;?>">
            <tr>
              <td colspan="2"><span class="green-heading">
			  <a href="classified-listing.php?cityId=<?php echo $rw[classified_city_id];?>" class="link2"><?php echo strip_tags($city[city_name]);?></a> : 
			  </span>
			  <a href="<?php echo $html_link;?>" class="user_cl"  style="font-family:<?php echo $arr_font[title_font_type]?>;font-size:<?php echo $arr_font[title_font_size]?>; color:<?php echo $arr_font[title_font_color]?>; text-decoration:none;">
		    <span>
			  <?php echo strip_tags(truncateText($rw[classified_title],80,' ','...',true));?>
			  </span>
			  </a>			  		  
			  </td>
              </tr>
            <tr>
              <td width="11%" valign="top">
			  <?php if(mysql_num_rows($sql_img_set) > 0 ) {
			   echo "<a href='".$html_link."' title='".$alt."'>".$im_small."</a>";
			   }else{?>			 
			  <a href="classified-details.php?clsId=<?php echo $rw[classified_id];?>">
			  <img src="<?php echo $theem_img;?>/blank-img.gif" alt="<?php echo $alt;?>" border="0" class="border-img"/>
			  </a> 
			  <?php } ?>
			  </td>
              <td width="89%" valign="top"><div>
                <p class="fl">
				<?php if($rw[classified_price_option] !="") {?>
				<strong>Prix: $</strong>
				<font color="<?php echo $arr_font[price_font_color];?>">
				<?php echo number_format($rw[classified_price_option],2);?>
				</font>
				<?php }else{ ?>
				<strong><?php echo $rw[offer];?></strong>
				<?php }?>
				</p>
                <p class="fr b"><?php echo front_date_format($rw[classified_post_date]);?></p>
                <p class="cb"></p>
                </div>
                <div class="mt10">
				<span style="font-family:<?php echo $arr_font[desc_font_type]?>;font-size:<?php echo $arr_font[desc_font_size]?>; color:<?php echo $arr_font[desc_font_color]?>; text-decoration:none">
				<?php echo strip_tags(truncateText($rw[classified_desc],200,' ','...',true));?>
				</span>
				</div></td>
              </tr>
            <tr>
              <td colspan="2" align="left" class="border-bot">
             <div class="CollapsiblePanelTab ar">
			 <a id="rep<?php echo $rw['classified_id'];?><?php echo $rw[classified_key];?>" title="">
			  <img src="<?php echo $theem_img;?>/reply-btn.gif" alt="" border="0"/></a></div>		 			  			  			   
	<div id="inq<?php echo $rw['classified_id'];?><?php echo $rw[classified_key];?>" class="CollapsiblePanel" style="display:none">
           <?php include("inquiry_form.php"); ?>
              </div>
			  </td>
              </tr>
            </table>
			<?php }			
			    }else{
			 ?>
			  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="mt10">
             <tr>
			  <td><strong>Aucune annonce trouvée dans cette catégorie....</strong></td>
			  </tr>
            </table>
			<?php } ?>			
           <?php include("paging.inc.php"); ?>
	      </td>
       </tr>
    </table></td>
  </tr>
</table>
</td>
</tr>
</table>
<?php require_once("footer.inc.php"); ?>