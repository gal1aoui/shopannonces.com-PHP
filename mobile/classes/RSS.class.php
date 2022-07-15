<? 
class RSS
{
    function GetFeed($cat_id,$type){
		return $this->getDetails($cat_id,$type).$this->getItems($cat_id,$type);
	}
	
 function front_navigation($cat_id,$type){
  $str="";
 if($cat_id!="" && $type=="cat"){
   $res1=Rec_display_formate(get_catinfo($cat_id,'cat_name'));
    $str ="<title>".$res1." >> ".Home."</title>";	 
   $str	.='<link>'.SITE_WS_PATH.'/index.php</link>';   
  }
  
   if($cat_id!="" && $type=="city"){
       $qur1="select clsd_cat_id,classified_city_id from tbl_classified where classified_city_id= $cat_id";		
		$rs=mysql_query($qur1);	
		if(mysql_num_rows($rs) >0 ){
		  $res2=mysql_fetch_array($rs);
		  $maincatId=$res2['clsd_cat_id'];
		}		
    $res1=Rec_display_formate(get_catinfo($maincatId,'cat_name'));
    $str ="<title>".Get_cityname($res2[classified_city_id])." >> ".$res1." >> ".Home."</title>";	 
   $str	.='<link>'.SITE_WS_PATH.'/index.php</link>';   
  }
  
  if($cat_id!="" && $type=="subcat"){   
		$qur1="select clsd_cat_id from tbl_classified where clsd_sub_subcat_id= $cat_id";
		$rs=mysql_query($qur1);	
		if(mysql_num_rows($rs) >0 ){
		$res2=mysql_fetch_array($rs);
		$maincatId=$res2['clsd_cat_id'];
	    }else{
	    $maincatId=get_catinfo(get_catinfo($cat_id,'cat_parent'),'cat_parent');	  
	    }
      $cat_name=Rec_display_formate(get_catinfo($maincatId,'cat_name'));
      $subcat_name=Rec_display_formate(get_catinfo($cat_id,'cat_name')); 
	  $str ="<title>".$cat_name." >> ".$subcat_name." >> ".Home."</title>";	  
	  $str	.="<link>".SITE_WS_PATH."/classified-listing.php?catId=".$maincatId."</link>"; 
	 	
   }      
 return $str;
}	
	function getDetails($cat_id,$type)
	{
		$details = '<?xml version="1.0" encoding="iso-8859-1"?>
					<rss version="2.0">
						<channel>';						
		if($type=="cat"){						
        $details .=$this->front_navigation($cat_id,$type);
		}elseif($type=="subcat"){
		$details .=$this->front_navigation($cat_id,$type);
		}elseif($type=="city"){
		$details .=$this->front_navigation($cat_id,$type);
		}
		$details .='<language>en</language>';		
		return $details;
		}
	  function getItems($cat_id,$x){
	  if($x=="cat"){
	   $col = "select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(classified_post_date ,'%d %M %Y') as cli_post_date ";
       $sql_rss = " from ".DB.".tbl_classified
       where clsd_cat_id ='$cat_id' and classified_status='Active' order by classified_featured asc ";	  
	   }
	   if($x=="subcat"){
	   $col = "select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(classified_post_date ,'%d %M %Y') as cli_post_date ";
       $sql_rss = " from ".DB.".tbl_classified
       where clsd_sub_subcat_id ='$cat_id' and classified_status='Active' order by classified_featured asc ";	  
	   }
	   if($x=="city"){
	   $col = "select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(classified_post_date ,'%d %M %Y') as cli_post_date ";
       $sql_rss = " from ".DB.".tbl_classified
       where classified_city_id ='$cat_id' and classified_status='Active' order by classified_featured asc ";	  
	   }
	     $sql_ww = $col.$sql_rss; 		
         $rs_rss=mysql_query($sql_ww);
         $res_rss = mysql_fetch_array(mysql_query("Select FOUND_ROWS() as total"));
         $reccnt_rss=$res_rss['total'];      
		  if($reccnt_rss > 0) {
		    while($rw_rss=mysql_fetch_array($rs_rss)){ 
		  $items .= ' 
		  			 <item>		  
		  				 <title>'. xml_character_decode(Rec_display_formate($rw_rss[classified_title])).'</title>
						 <link>'.SITE_WS_PATH.'/classified-details.php?clsId='.$rw_rss[classified_id].'</link>
						 <author>'. $rw_rss[classified_poster_email].' </author> 	
						 <pubDate>'.$rw_rss[cli_post_date].' </pubDate>
						 <location>Location: '. $loc.' </location>
						 <image><title>'.$rw_rss[classified_title].'</title>
		  				 <url>'.$file_path.'</url>						 
						 <link>'.SITE_WS_PATH.'/classified_detail.php?clsId='.$rw_rss[classified_id].'</link>
					     </image>  		
	<description><![CDATA['.xml_character_decode(Rec_display_formate($rw_rss[classified_desc])).']]> </description>
						 
					 </item>';
			  }
		}
		$items .= '</channel></rss>';
		return $items;
	}
	
}
?>