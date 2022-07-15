<?php
function Root_cat($id=""){	 
	  $sql_cat=db_query("select * from tbl_category where cat_parent ='0' AND cat_status='Y' order by cat_order ");
	  $num=mysql_num_rows($sql_cat);
	  $var= '<option value="">Sélectionner catégories</option>';
	  if($num > 0 )
	  {
	      while($rw=mysql_fetch_array($sql_cat))
	      { 
		  if($rw['cat_id']==$id){		 
		     $sel="selected";
		   }else{  $sel="";	}  
		  $var.='<option value="'.$rw['cat_id'].'" '.$sel.' >'.$rw['cat_name'].'</option>';
		
	       }
	   }
return $var;
}


function prin_select(/*$select*/){
	  $sql_cat=db_query("select * from tbl_category where cat_parent ='0' AND `cat_status`='Y' order by cat_order ");
	  $var= '<option value="">Nos catégories</option>';
	 
	  while($rw=mysql_fetch_array($sql_cat))
	  {
		  $var.='<option value="'.$rw['cat_id'].'" disabled="disabled" >-- '.$rw['cat_name'].' --</option>';
		  /*
			if($rw['cat_id']==8){
				$var.='<option value="793" >Publier une offre d\'emploi</option>';
				$var.='<option value="818" >Publier votre CV</option>';
			}
			else{
				*/
			  $sql_sous_cat=db_query("select * from tbl_category where cat_parent ='".$rw['cat_id']."' AND `cat_status`='Y' order by cat_order ");
			  
			  while($rw_sc=mysql_fetch_array($sql_sous_cat))
			  {
				  /*if($select==$rw_sc['cat_id'])
				  		$sel='selected';
				  else
				  		$sel='';*/
				$var.='<option value="'.$rw_sc['cat_id'].'" '.$sel.' >'.$rw_sc['cat_name'].'</option>';
			  }
			//}
	  }
	   
return $var;
}

function prin_select_selected($select){
	  $sql_cat=db_query("select * from tbl_category where cat_parent ='0' AND `cat_status`='Y' order by cat_order ");
	  
	  $var= '<option value="">Nos catégories</option>';
	  while($rw=mysql_fetch_array($sql_cat))
	  {
		  $var.='<option value="'.$rw['cat_id'].'" disabled="disabled" >-- '.$rw['cat_name'].' --</option>';
			if($rw['cat_id']==8){
				  if($select==817)
				  		$sel='selected';
				  else
				  		$sel='';
				$var.='<option value="793"  '.$sel.'>Publier une offre d\'emploi</option>';
				$var.='<option value="818" >Publier votre CV</option>';
			}
			else{
			  $sql_sous_cat=db_query("select * from tbl_category where cat_parent ='".$rw['cat_id']."' AND `cat_status`='Y' order by cat_order ");
			  
			  while($rw_sc=mysql_fetch_array($sql_sous_cat))
			  {
				  if($select==$rw_sc['cat_id'])
				  		$sel='selected';
				  else
				  		$sel='';
				$var.='<option value="'.$rw_sc['cat_id'].'" '.$sel.' >'.$rw_sc['cat_name'].'</option>';
			  }
			}
	  }
	   
return $var;
}

/* Make Sub category drop down */
function cat_search($id="",$idsubcat1="",$idsubcat=""){
	
		if($idsubcat!=""){
			$select=$idsubcat;
		}
		else if($idsubcat1!=""){
			$select=$idsubcat1;
		}
		else if($id!=""){
			$select=$id;
		}
	  $sql_cat=db_query("select * from tbl_category where cat_parent ='0' AND `cat_status`='Y' order by cat_order ");
	  
	  $var.= '<option value="">Sélectionner catégorie</option>';
	  while($rw=mysql_fetch_array($sql_cat))
	  {
				  if($select==$rw['cat_id']){
				  		$sel='selected';
				  }
				  else
				  		$sel='';
						
		  $var.='<option value="'.$rw['cat_id'].'" style="background: #85cc43;" '.$sel.' >--'.$rw['cat_name'].' --</option>';
			/*if($rw['cat_id']==8){
				  if($select==817)
				  		$sel='selected';
				  else
				  		$sel='';
				$var.='<option value="793"  '.$sel.'>Publier une offre d\'emploi</option>';
				$var.='<option value="794" >Publier votre CV</option>';
			}
			else{*/
		  $sql_sous_cat=db_query("select * from tbl_category where cat_parent ='".$rw['cat_id']."' AND `cat_status`='Y' order by cat_order ");
		  
		  while($rw_sc=mysql_fetch_array($sql_sous_cat))
		  {
			  if($select==$rw_sc['cat_id']){
					$sel='selected';
		  }
			  else
					$sel='';
			$var.='<option value="'.$rw_sc['cat_id'].'" '.$sel.' >'.$rw_sc['cat_name'].'</option>';
				
				$sql_sous_sous_cat=db_query("select * from tbl_category where cat_parent ='".$rw_sc['cat_id']."' AND `cat_status`='Y' order by cat_order ");
				
				while($rw_ssc=mysql_fetch_array($sql_sous_sous_cat))
				{
				  if($select==$rw_ssc['cat_id']){
						$sel='selected';
				}
				  else
						$sel='';
				$var.='<option value="'.$rw_ssc['cat_id'].'" '.$sel.' > &emsp;'.$rw_ssc['cat_name'].'</option>';
				}
		  }
			//}
	  }
	   
return $var;
}


function getPidcategory($catID){
	$catID = (!empty($catID) && is_numeric($catID)) ? intval($catID) : 0;
   $SQL="select cat_id,cat_paid from tbl_category where cat_id=$catID";
   $rs=db_query($SQL);
   $nm=mysql_num_rows($rs);
  if($nm > 0 ){
     $row=mysql_fetch_array($rs);
	   $res=$row['cat_paid']; 
  }
 return  $res ;
}

function main_cat_array(){
  $sql_cat=db_query("select * from tbl_category where cat_status='Y' And cat_parent='0' order by cat_order asc");
  $x=mysql_num_rows($sql_cat);
  $i=1;
  if($x > 0 ){
	  while($row=mysql_fetch_array($sql_cat)){		  
	  $cat_Arr[$i]=array('catId'=>$row['cat_id'],'catName'=>$row['cat_name'],'catImg'=>$row['cat_image'],'status'=>$row['cat_status']);		  
	   $i++;  
		}
    }
return $cat_Arr;
}

function check_parent($cat_parent){
	 if($cat_parent!=""){
	$cat_parent = secureValue($cat_parent);
	  $re1=db_query("select * from tbl_category where cat_parent ='$cat_parent'");
	  $num=mysql_num_rows($re1);
	 }
return $num;
}

function chk_keyword_exits($key){
	 if($key!=""){
	 $cat_parent = secureValue($key);
	  $re1=db_query("select keyword from tbl_searched_keyword  where keyword ='$key'");
	  $num=mysql_num_rows($re1);
	 }
return $num;
}

function get_state($id=""){
	  $sql_cat=db_query("select * from tbl_state where 	state_status ='Active'  order by state_name");
	  $num=mysql_num_rows($sql_cat);
	  $var= '<option value="">Choisir Province</option>';
	  if($num > 0 )
	  {
	      while($rw=mysql_fetch_array($sql_cat))
	      { 
		  if($rw['state_id']==$id){
		     $sel="selected";
		   }else{  $sel="";	}  
		  $var.='<option value="'.$rw['state_id'].'" '.$sel.' >'.$rw['state_name'].'</option>';
		
	       }
	   }
return $var;
}

function get_statebyName($name=""){
	$sql_cat=db_query("select * from tbl_state where 	state_status ='Active' and state_name='".$name."' order by state_name");
	$num=mysql_num_rows($sql_cat);
	$var= "";
	if($num > 0 )
	{
		$rw=mysql_fetch_array($sql_cat);
		$var=$rw['state_id'];
	}
return $var;
}

function get_state_index($id=""){
	  $sql_cat=db_query("select * from tbl_state where 	state_status ='Active'  order by state_order");
	  $num=mysql_num_rows($sql_cat);
	  $var= '<option value="">Toute la France</option>';
	  if($num > 0 )
	  {
	      while($rw=mysql_fetch_array($sql_cat))
	      { 
		  if($rw['state_id']==$id){
		     $sel="selected";
		   }else{  $sel="";	}  
		  $var.='<option value="'.$rw['state_id'].'" '.$sel.' >'.$rw['state_name'].'</option>';
		
	       }
	   }
return $var;
}

function spam_words(){
	$sql=db_query("select * from tbl_spam_words");
	$num=mysql_num_rows($sql);
	if($num > 0 ){
		while($rw=mysql_fetch_array($sql)){
			$word[]=$rw['words'];
		}
	}
	return $word;
}

function testSpamWords($word_arr, $pmethod){
	$problem='N';
	
	foreach ($word_arr as $key1 => $value) {		
		foreach ($pmethod as $key2 => $text) {
			if(isset($text)){
				if (preg_match('#'.$value.'#', $text) ) {        
					$problem = 'Y';	  
				}
			}
		}
	}
return $problem;
}

function manage_banner_requests($catId,$position){
	
	if($catId!="" && $position!=""){
		$catId = (!empty($catId) && is_numeric($catId)) ? intval($catId) : 0;
		$position = secureValue($position);
		$sql="select * from  tbl_advertise 
			WHERE cat_id ='$catId'
				AND status='Y'
				AND banner_position='$position'
			order by rand() limit 0,3 ";
		
		$rw=db_query($sql);
		
		if(mysql_num_rows($rw)> 0 ) {
			while($res=mysql_fetch_array($rw)){
	$var="r";
				$img=$res['image'];
				$file_path=UP_FILES_WS_PATH."/advertise/".$img;
				$file_path_root = UP_FILES_WS_PATH."/advertise/".$img;
				//$file_path_sm	 =	 show_thumb($file_path,"200","75","width");	
				
				if(file_exists($file_path_root) && $res['image']!=""){		
					$sz=getimagesize($file_path);
					
					if($position=="Classified Detail Left"){
						$width=($sz[0]>=200) ?  '300' :  $sz[0];
						$height=($sz[1]>=75) ? '75'  :  $sz[1];		
					}
					else{
						$width=($sz[0]>=200) ?  '200' :  $sz[0];
						$height=($sz[1]>=75) ? '75'  :  $sz[1];	
					}
					$var="<a href='$res[url]' target='_blank'><img src='$file_path' alt='' border='0' width='$width' height='$height'/></a>";
				}
			}	
		}	
	}
return $var;
}

function manage_paidbanner($catId,$position="Top Banner"){
	if($catId!="" && $position!=""){  
		$catId = (!empty($catId) && is_numeric($catId)) ? intval($catId) : 0;
		$position = secureValue($position);
		$sql="select * from  tbl_advertise where IF(dis_subcat >0,IF(dis_subcat='$catId',true , false),IF(cat_id='$catId',true , false) ) 
		AND status='Y'
		AND pay_option='Paid' and banner_position='$position' order by rand() limit 0,3";
		$rw=db_query($sql);
		
		if(mysql_num_rows($rw)> 0 ) {
			while($res=mysql_fetch_array($rw)){
				$img=$res['image'];
				$file_path=UP_FILES_WS_PATH.'/advertise/'.$img;
				$file_path_banner_root =UP_FILES_FS_PATH.'/advertise/'.$img;
				
				if(file_exists($file_path_banner_root) && $res['image']!=""){ 			
					$file_path_sm	 =	 show_thumb($file_path,"728","90","width");		 
					$sz=getimagesize($file_path_sm);			  			 
					$width=($sz[0]>=728) ?  '728' :  $sz[0];
					$height=($sz[1]>=90) ? '90'  :  $sz[1];		
					$var="<a href='$res[url]' target='_blank'>
					<img src='$file_path_banner_root' alt='' border='0' width='$width' height='$height'/>
					</a>";
				
				}			
			}		
		}	
	}
return $var;
}

function classified_visits($clsId){
  if($clsId!=""){
	$clsId = (!empty($clsId) && is_numeric($clsId)) ? intval($clsId) : 0;
    $sql="select classified_visit,classified_id from tbl_classified where classified_id = $clsId ";
     $vis=db_query($sql);
	 $num=mysql_num_rows($vis);	 
	 if($num > 0 ){
	   $res_num=mysql_fetch_array($vis);
	   $total_visit=$res_num[0];
	 }
  
  }
return $total_visit;
}

function classified_contacts($clsId){
	if($clsId!=""){
		$clsId = (!empty($clsId) && is_numeric($clsId)) ? intval($clsId) : 0;
		$sql="select classified_contact,classified_id from tbl_classified where classified_id = $clsId ";
		$cnt=db_query($sql);
		$num=mysql_num_rows($cnt);	 
		if($num > 0 ){
			$res_num=mysql_fetch_array($cnt);
			$total_contact=$res_num[0];
		}	
	}
return $total_contact;
}

function pupolar_search($catId,$visit="",$show=""){
if($catId!=""){
	$catId = (!empty($catId) && is_numeric($catId)) ? intval($catId) : 0;
	$show = (!empty($show) && is_numeric($show)) ? intval($show) : 0;
	$visit = secureValue($visit);
     if($visit!=""){
	   $sql_key_search="select classified_id,classified_title from tbl_classified
	   where clsd_cat_id='$catId' and classified_visit > $visit order by rand() limit 0,$show ";
	  }else{
	   $sql_key_search="select classified_id,classified_title from tbl_classified
	   where clsd_cat_id='$catId' and classified_visit > 0 order by rand() limit 0,$show ";
	  }
	$rs_key=db_query($sql_key_search);
	$num=mysql_num_rows($rs_key); 
    if($num>0){
     $var.='<ul class="cate-list">';    
      while($reskey=mysql_fetch_array($rs_key)){
      $var.='<li>
	  <a href="classified-details.php?clsId='.$reskey['classified_id'].'">
	  '.Rec_display_formate(truncateText($reskey['classified_title'],100,' ','...',true)).'
	   </a>
	  </li>';
	   }
    $var.='</ul>';                  
    }else{ echo "<p>&nbsp;</p>"; }
    $var.='</div>';   
 } 
return $var;
}

/* Get City drop down from database */
function Get_city($id="", $statesid=""){	 
	$sql_city=db_query("select * from tbl_city where city_state_id='$statesid' AND city_status ='Active' order by city_name");
	$num=mysql_num_rows($sql_city);
	$var= '<option value="">Choisir Ville</option>';
	if($num > 0 ){
		while($rw=mysql_fetch_array($sql_city)){ 
			if($rw['city_id']==$id){
				$sel="selected";
			}else{
				$sel="";
			}
			$var.='<option value="'.$rw['city_id'].'" '.$sel.' >'.$rw['city_name'].'</option>';
		}
	}
return $var;
}

function Get_cityname($id){
      if($id!=""){
			$id = (!empty($id) && is_numeric($id)) ? intval($id) : 0;
		  $sql_city=db_query("select city_id,city_name from tbl_city where city_id=$id and city_status ='Active' order by city_order");
		  $num=mysql_num_rows($sql_city);	 
		  if($num > 0 ){
			$rw=mysql_fetch_array($sql_city);		  
			 $var =$rw['city_name'];	
		   }
		}	
return $var;
}

function Get_statename($id){
      if($id!=""){
			$id = (!empty($id) && is_numeric($id)) ? intval($id) : 0;
		  $sql_city=db_query("select * from tbl_state where state_id=$id and state_status ='Active' order by state_order");
		  $num=mysql_num_rows($sql_city);	 
		  if($num > 0 ){
			$rw=mysql_fetch_array($sql_city);		  
			 $var =$rw['state_name'];	
		   }
		}	
return $var;
}
/* End of Get City drop down from database */


function get_site_setting(){  
	$sql=db_query("select * from tbl_site_setting WHERE 1 ");
	$rw_arr=mysql_fetch_array($sql,MYSQL_ASSOC);    
	return $rw_arr;
}
function removeEmpty($var){
   return (!empty($var)); 
}
function country_lists($id="")
{
	 $sql_country=db_query("select * from tbl_country order by country_name");
	 $var= '<option value="">Select Country</option>';
	 while($rw=mysql_fetch_array($sql_country))
	 {
				 
		  if($rw['country_id']==$id){
		     $sel="selected";
		   }else{  $sel="";	}  
		 $var.='<option value="'.$rw['country_id'].'" '.$sel.' >'.$rw['country_name'].'</option>';
		
	 }
	 
return $var;
}

function get_meta_details($table,$id_name,$id)
{
	if($id!=""){
		$id = (!empty($id) && is_numeric($id)) ? intval($id) : 0;
		$table = secureValue($table);
		$id_name = secureValue($id_name);
		
		$arr_mata=array();
		$sql_meta=db_query("select * from ".DB.".$table where $id_name=$id ");
		$meta=mysql_fetch_array($sql_meta);
		$arr_mata[]=$meta['meta_title'];
		$arr_mata[]=$meta['meta_desc'];
		$arr_mata[]=$meta['meta_keyword'];
	 }
 return $arr_mata;
}

function get_config_setting($id){
 if($id!=""){
	 $id = (!empty($id) && is_numeric($id)) ? intval($id) : 0;
	 $sql_res=db_query("select * from tbl_config where config_id =$id ");
	 $arr=mysql_fetch_array($sql_res);
	 $result=$arr['config_txt']; 
  }
 return $result;
}

function get_catinfo($catID,$col_name){
  if($catID!="" && $col_name!=""){
	$catID = (!empty($catID) && is_numeric($catID)) ? intval($catID) : 0;
    $sql_cname=db_query("select * from tbl_category where cat_id=$catID and cat_status='Y'");
    $cat_Rows=mysql_fetch_array($sql_cname); 
   }   
 return $cat_Rows[$col_name];  
}

function createToSize($DirName, $ImageName, $w1, $h1, $Thumb_name){ 
	require_once("classes/image.class.php"); 
	$to_name=$DirName."/".$Thumb_name."_".$ImageName;
	$from_name=$DirName."/".$ImageName;	
	$Img = new Zubrag_image;
	/* initialize properties */
	$Img->max_x        = $w1;
	$Img->max_y        = $h1;
	$Img->cut_x        = 0;
	$Img->cut_y        = 0;
	$Img->quality      = 100;
	$Img->save_to_file = true;
	$Img->image_type   = -1;
	$Img->GenerateThumbFile($from_name,$to_name);
}

function Show_Thumbnail($floder,$res_img,$thumb,$w,$h,$class="",$align="",$alt=""){
   $flag=0;	
   $no_img=SITE_WS_PATH."/images/no_image.jpg";  
   if($res_img!=""){
		
		$file_org=$file=SITE_FS_PATH."/".UPLOADED_FILE_PATH."/".$floder."/".$res_img;
		
		$thumb_file=SITE_FS_PATH."/".UPLOADED_FILE_PATH."/".$floder."/".$thumb."_".$res_img;
		
		$File_dir=SITE_FS_PATH."/".UPLOADED_FILE_PATH."/".$floder."/";
		
		$img=SITE_WS_PATH."/".UPLOADED_FILE_PATH."/".$floder."/".$thumb."_".$res_img;
		
		if(file_exists($file_org) && !file_exists($thumb_file) && $res_img!="" )
		{
		  createToSize($File_dir,$res_img, $w,$h,$thumb);
		}else if(!file_exists($file_org))
		{
			 $var="Orignal Image Deleted From Folder";	
			 $flag=1;
		}
		if(!$flag)
		{	
			if(file_exists($thumb_file) && $res_img!="" )
			{
			$var='<img src='."'$img'".' alt="" class='."'$class'".' />';
			}else{			
			$var='<img src='."$no_img".' alt="" class='."'$class'".' height='."'$h'".' />';
			}
		  }
  }else{
  $var='<img src='."'$no_img'".' alt="" class='."'$class'".' height='."'$h'".' />';
  }
return $var;

/* How  to call the  function  */
//$img=Show_Thumbnail('product_img',$value[product_img],'thumb_product_110x85','110','85','border-pro');
/* End  How  to call the  function  */
}
function GetValidFileName($fname){
	$pattern="[?() \/&#\,\;\.$@+]";
//	$valid_file=ereg_replace($pattern,"_",trim($fname));
$valid_file=$fname;
	$valid_file=strtolower($valid_file);
	$valid_file=str_replace("'","",$valid_file);
	$valid_file=str_replace('"','',$valid_file);
	$valid_file=str_replace("-","_",$valid_file);
	$valid_file=str_replace("__","_",$valid_file);
	$valid_file=str_replace("__","_",$valid_file);
	$valid_file=str_replace("__","_",$valid_file);
	if (substr($valid_file,-1)=="_") {
		$valid_file=substr($valid_file,0,-1);
	}
	if (substr($valid_file,0,1)=="_") {
		$valid_file=substr($valid_file,1,strlen($valid_file));
	}
	return $valid_file;
}
function getExtension($str){
         $i = strrpos($str,".");
         if (!$i) { return ""; }
         $l = strlen($str) - $i;
         $ext = substr($str,$i+1,$l);
         return $ext;
 }
 function getfileName($str){
         $i = strrpos($str,".");
         if (!$i) { return ""; }
          $ext = substr($str,0,$i);
          return $ext;
 }
 function file_validation($type,$path){
    $image_data = fopen($path, "rb");
    $header_bytes = fread($image_data, 8);
    fclose ($image_data);
    if($type=='image'){
	
		if (!strncmp ($header_bytes, "\xFF\xD8", 2))
			$file_format = "JPEG";
		else if (!strncmp ($header_bytes, "\x89\x50\x4E\x47\x0D\x0A\x1A\x0A", 8))
			$file_format = "PNG";
		//else if (!strncmp ($header_bytes, "BM", 2))
        	//$file_format = "BMP";
		else if (!strncmp ($header_bytes, "GIF", 3))
        	$file_format = "GIF";
	}
	if($type=='video'){
		 if (!strncmp ($header_bytes, "\x30\x26\xB2\x75\x8E\x66\xCF\x11", 8))
			$file_format = "WMV";
		else if (!strncmp ($header_bytes, "\x49\x44\x33", 3))
			$file_format = "MP3";
		else if (!strncmp ($header_bytes, "\x00\x00\x00\x18\x66\x74\x79\x70", 8))
			$file_format = "MP4";
		else if (!strncmp ($header_bytes, "\x46\x4C\x56\x01", 4))
			$file_format = "FLV";
	}
	
	if($type=='text'){
		 if (!strncmp ($header_bytes, "\x7B\x5C\x72\x74\x66\x31", 4))
			$file_format = "RTF";
		else if (!strncmp ($header_bytes, "\x50\x4B\x03\x04\x14\x00\x06\x00", 8))
			$file_format = "DOCX";
		
		else if (!strncmp ($header_bytes, "\x25\x50\x44\x46", 4))
			$file_format = "PDF";
	}

    
	if($type=='zip'){
    	 if (!strncmp ($header_bytes, "\x50\x4b\x03\x04", 4))
        	$file_format = "ZIP";
	}	
   
    	if($file_format=='')
           $file_format = false;
    
	return $file_format;
} 
 function unlink_file($folder_name,$filename){	
	$folder=SITE_FS_PATH."/".UPLOADED_FILE_PATH."/".$folder_name;
	$file=$folder."/".$filename;
	if(file_exists($file) && $filename!=""){
		unlink($file);	
	}
}

function upload_file($mid,$image,$folder){

$LienImageNews="";

	// Je crée un array dans lequel figurent seulement les extensions acceptées, avec le type MIME qui leur est associé (qui peut varier sous IE et qu'on va donc devoir différencier) :
	$ListeExtension = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
	$ListeExtensionIE = array('jpg' => 'image/pjpg', 'jpeg'=>'image/pjpeg'); // Il fallait une nouvelle fois qu'IE se différencie.


	if (!empty($_FILES[$image]))
	{
		if ($_FILES[$image]['error'] <= 0)
		{
			if ($_FILES[$image]['size'] <= 2097152)
			{
				$ImageNews = $_FILES[$image]['name'];
				
				// Je vérifie l'extension présumée du fichier :
				$ExtensionPresumee = explode('.', $ImageNews);
				$ExtensionPresumee = strtolower($ExtensionPresumee[count($ExtensionPresumee)-1]);
				if ($ExtensionPresumee == 'jpg' || $ExtensionPresumee == 'jpeg' || $ExtensionPresumee == 'pjpg' || $ExtensionPresumee == 'pjpeg' || $ExtensionPresumee == 'gif' || $ExtensionPresumee == 'png')
				{
					// On pourra alors continuer notre vérification.
					$ImageNews = getimagesize($_FILES[$image]['tmp_name']);
					if($ImageNews['mime'] == $ListeExtension[$ExtensionPresumee]  || $ImageNews['mime'] == $ListeExtensionIE[$ExtensionPresumee])
					{
						$TailleImageChoisie = getimagesize($_FILES[$image]['tmp_name']);
						
						$NouvelleLargeur = 800;
						// Étape 2 :
						$Reduction = ( ($NouvelleLargeur * 100)/$TailleImageChoisie[0] );
						 
						// Étape 3 :
						//$NouvelleHauteur = ( ($TailleImageChoisie[1] * $Reduction)/100 );
						$NouvelleHauteur =800;
						
						switch($ExtensionPresumee){
							case 'jpg':
							case 'jpeg':
							case 'pjpg':
							case 'pjpeg':
								
								$ImageChoisie = imagecreatefromjpeg($_FILES[$image]['tmp_name']);								
								
								//Etape 1 :
								$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
								 
								//Etape 2 :
								imagecopyresampled($NouvelleImage , $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
								break;
							
							case 'png':
							
								$ImageChoisie = imagecreatefrompng($_FILES[$image]['tmp_name']);

								//Etape 1 :
								$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
								
								//Etape 2 :
								imagecopyresampled($NouvelleImage , $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
								break;
							
							case 'gif':
							
								$ImageChoisie = imagecreatefromgif($_FILES[$image]['tmp_name']);

								$NouvelleImage = imagecreate ($NouvelleLargeur , $NouvelleHauteur );
								
								imagecopyresampled($NouvelleImage , $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
								break;
						}
						
						
						imagedestroy($ImageChoisie);
						
						$NomImageChoisie = explode('.', $_FILES[$image]['name']);
						
						//on  « crypte » le nom original de l'image
						//$NomImageExploitable = time($NomImageChoisie[0]);
						$NomImageExploitable=$mid.time($NomImageChoisie[0]).".".$ExtensionPresumee;
						
						imagejpeg($NouvelleImage , $folder.$NomImageExploitable, 100);
						
						$LienImageNews = $NomImageExploitable;
					}
				}
				else{
					 Set_Display_Message("Invalid format please use the following formats: .jpg,.jpeg,.gif,.png......");
					 echo "Invalid format please use the following formats: .jpg,.jpeg,.gif,.png......";
				}
			}
			else{
				 Set_Display_Message("Invalid size......");
				 echo "Invalid size......";
			}
		}
		else{
			 Set_Display_Message("Invalid file......");
			 echo "Invalid file......";
		}
	}

return $LienImageNews;
}

function member_join_date($memID)
{
   if($memID > 0 && $memID!="" ) {   
	    $sql="select DATE_FORMAT(reg_date,'%D %M %Y') as mem_join_date from tbl_member where mem_id =$memID ";
		$rs=db_query($sql);		
		if(mysql_num_rows($rs) > 0 ) {
		$res=mysql_fetch_array($rs);
		$res['mem_join_date'];
		}
	}
return $res[mem_join_date];
}

function member_confirm_email($memID)
{
	$status=false;
   if($memID > 0 && $memID!="" ) {   
	    $sql="select * from tbl_member where mem_id =$memID ";
		$rs=db_query($sql);		
		if(mysql_num_rows($rs) > 0 ) {
			$res=mysql_fetch_array($rs);
			if($res['mem_status']=='Y')
				$status=true;
		}
	}
return $status;
}

function setMemberActive($memID)
{
	$status=false;
	if($memID > 0 && $memID!="" ) {   
		$sql="update tbl_member set mem_status='Y' where mem_id='".$memID."'";
		$result_mem=db_query($sql) or die(mysql_error());

		if(mysql_affected_rows() >0 ) {
			$status=true;
		}
	}
return $status;
}

function addMember($user_id, $user_password, $rand_key, $lname, $tel_no, $email, $solde, $type, $parrain_id, $adresse_ip, $alert_id)
{
	/*
		`comp_name` = '$comp_name',`comp_address` = '$comp_address',`comp_city` = '$comp_city',
		`comp_province` = '$comp_state',`comp_postalcode` = '$comp_postal',`comp_country` = '$comp_country',
		`comp_url` = '$comp_website',
	*/
		
	$sql="INSERT INTO `tbl_member` 
	SET `user_id` = '$user_id',`password` = '$user_password',
		`register_key` = '$rand_key',
		`fname` = '$mem_fname',`lname` = '$mem_lname',
		`email` = '$user_id',
		`type`='$user_type',
		`tel_no` = '$mem_telno',
		`class_alerts` = '$alert_id',
		`mem_status` = 'N',`reg_date` = '".date('Y-m-d H:i:s')."',
		`solde` = '0',
		`parrain_id` = '$parrain_id',
		`adresse_ip` = '$ip'";
		
	db_query($sql); 
	$mem_id=mysql_insert_id();
	/********** Send mail to member *****************/
						
	$link='<strong><a href="'.REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'" style="font-family:Arial, sans-serif;padding:5px 5px;background-color:#86C222;color:#fff;font-size:14px;width:150px;border:solid 1px #86C222;text-decoration:none;text-align:center;height:15px;" rel="nofollow">Confirmer votre email</a></strong>';			

	$link1=REDIRECT_SERVER."/activer.php?key=".$rand_key."&ui=".$mem_id;
	$faux_link='<strong><a href="'.REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'&diff=1" style="color:#fff;" rel="nofollow">Choisir cette offre</a></strong>';  
	
	$email_subject	=	$mem_lname." Confirmer votre compte";
	$server=$_SERVER['SERVER_NAME'];
	
	$mail_content=nl2br($mail_content);	
	//$body=html_mail_content($mail_content);
	$body=$mail_content;

	$body			=	str_replace('{name}', $mem_lname, $body);
	$body			=	str_replace('{password}', $user_password, $body);
	$body			=	str_replace('{link}', $link, $body);	
	$body			=	str_replace('{link1}', $link1, $body);
	$body			=	str_replace('{faux_link}',$faux_link,$body);
	$body			=	str_replace('{server}', $server, $body);
	
	//echo $body;
	//echo $email_subject;
	
	$email_to		=	$user_id;
	$email_toname	=	$mem_lname;
	
	sent_mail($email_to,$email_subject,$body);
	/*********** End of  Send mail to member ***************/
	
	Set_Display_Message("Bienvenue $mem_lname , vous avez été enregistré avec succès...<br>
						Un Email vous est envoyé, pour activer votre Compte....!!");
	
return $mem_id;
}

function getMemberbyMail($mail)
{
	$member=array();
	if(secureValue($mail) && $mail!="" ) {   
		$sql="select * from tbl_member where user_id ='".$mail."'";
		$rs=db_query($sql);
		
		
		if(mysql_num_rows($rs) > 0 ) {
			$member=mysql_fetch_array($rs);
		}
	}
return $member;
}

function Rec_display_formate($rec){
 if($rec!="" ){ 	    
   $result=ucfirst(strtolower(strip_tags($rec)));
 }
return $result;
}

function Set_Display_Message($msg)
{
 $_SESSION['site_front_message']=$msg;
}

function Display_Message()
{
 if(isset($_SESSION['site_front_message']) && $_SESSION['site_front_message']!=""){
	 
	$var='<div class="msg_dg"><strong>'.$_SESSION['site_front_message'].'</strong></div>';
			   
	//  $var="<strong style='color:#FF0000;'>$_SESSION[site_front_message]</strong>";
	unset($_SESSION['site_front_message']);	
	}
  return $var;
}

function getTopicReply($topic_id){
	$topic_id = (!empty($topic_id) && is_numeric($topic_id)) ? intval($topic_id) : 0;
	$response_sql=mysql_query("select * from forum_responses where topicID='$topic_id' and status ='Y'");
	return mysql_num_rows($response_sql);
}

function forumchangedate($date){
    if($date!="")
	{ 
		$split_time=explode(" ",$date);
		$cdate=explode("-",$split_time[0]);
		$year=$cdate[0];
		$month=$cdate[1];
		$day=$cdate[2];	
		$ctime=explode(":",$split_time[1]);
		$hours=$ctime[0];
		$minutes=$ctime[1];
	 return date('D M d, Y g:i A', mktime($hours, $minutes, 0, $month, $day, $year)); 
	}
 }
  
function getMemberClassifiedName($classifiedID){
	$memID = (!empty($classifiedID) && is_numeric($classifiedID)) ? intval($classifiedID) : 0;
	$res=mysql_fetch_array(mysql_query("select * from tbl_classified where classified_id='$classifiedID'"));
	//$res=ms_stripslashes($res);
return ucfirst($res['classified_poster_name']);
}
  
function getMemberFullName($memID){
	$memID = (!empty($memID) && is_numeric($memID)) ? intval($memID) : 0;
	$res=mysql_fetch_array(mysql_query("select * from tbl_member where mem_id='$memID'"));
	//$res=ms_stripslashes($res);
	return ucfirst($res['fname']." ".$res['lname']);
}
  
function getMemberType($memID){
	$memID = (!empty($memID) && is_numeric($memID)) ? intval($memID) : 0;
	$res=mysql_fetch_array(mysql_query("select * from tbl_member where mem_id='$memID'"));
	//$res=ms_stripslashes($res);
	return ucfirst($res['type']);
}

function getMemberWebSite($memID){
	$memID = (!empty($memID) && is_numeric($memID)) ? intval($memID) : 0;
	$res=mysql_fetch_array(mysql_query("select * from tbl_member where mem_id='$memID'"));
	$res=ms_stripslashes($res);
	return $res['comp_url'];
}

function getLastForumReply($topID)
{ 
  if(getTopicReply($topID)>0)
  {   
    $response_sql=mysql_query("select * from forum_responses where topicID='$topID' order by replyID  desc ");
	$num=mysql_num_rows($response_sql);	    
	    $rw=mysql_fetch_array($response_sql);
	    $res[]=$rw[name];
	    $res[]=$rw['recv_date'];       
	 } 
  return $res;
}

function getResult($tableName,$cond=""){
    if($tableName!=""){
	 $sql=mysql_query("select * from $tableName $cond");
	 $res=mysql_fetch_array($sql);
	}	
	return $res;
}

function getQuery($tblname,$cond='',$fld=''){
    $opt=$fld=="" ? "*" : "$fld" ;
	$tblname = secureValue($tblname);
	$cond = secureValue($cond);
	$fld = secureValue($fld);
	$exe_qry=db_query("select $opt from $tblname $cond");
    $num_rec=mysql_num_rows($exe_qry);
	if($num_rec>0){
	 $res_arr= mysql_fetch_array($exe_qry,MYSQL_ASSOC);	
	}
 return $res_arr;
}

function str_stop($string, $max_length){
	if (strlen($string) > $max_length){
		$string = substr($string, 0, $max_length);
		$pos = strrpos($string, " ");
		if($pos === false) {
			  return substr($string, 0, $max_length)."...";
		  }
		return substr($string, 0, $pos)."..";
	}else{
		return $string;
	}
}
function chk_member_rated($memID,$recID){
	$memID = (!empty($memID) && is_numeric($memID)) ? intval($memID) : 0;
	$recID = (!empty($recID) && is_numeric($recID)) ? intval($recID) : 0;
	$sql=mysql_query("select * from tbl_rating WHERE mem_id= $memID and section_id = $recID ");
	$num=mysql_num_rows($sql);	
	return $num;
}
function calculate_rate($recID)
{
   if($recID!="")
    {
		 $recID = (!empty($recID) && is_numeric($recID)) ? intval($recID) : 0;
		 $sql_rate=db_query("select * from tbl_rating WHERE section_id = $recID");
		 $num_row=mysql_num_rows($sql_rate);
		 $total_vote=0;
		 $total_vote_value=0;
		 if($num_row > 0 )
		 {
				 while($ratings=mysql_fetch_array($sql_rate))
				 {
					$total_vote=$ratings[total_votes] + $total_rate;
					$total_vote_value=$ratings[total_value] + $total_vote_value;
					$current =  $total_vote_value /  $total_vote;
					$current_rate=round($current, 1);
				 }						  
							  
		 }else{
		 $current_rate="0";
		 }
		 
	}
return $current_rate;
}
function pagecontent($page_id)
{
  if($page_id!=""){
   $page_id = (!empty($page_id) && is_numeric($page_id)) ? intval($page_id) : 0;
   $selepagecontent=db_query("select page_desc from tbl_staticpage where pid='$page_id'");
   $rowpagecontent=mysql_fetch_array($selepagecontent);
   $pagecont=html_entity_decode($rowpagecontent[0]);
   }
 return $pagecont;
}

function pagecontentshort($page_id)
{
  if($page_id!=""){
   $page_id = (!empty($page_id) && is_numeric($page_id)) ? intval($page_id) : 0;
   $selepagecontentshort=db_query("select page_desc from tbl_staticpage where pid='$page_id'");
   $rowpagecontentshort=mysql_fetch_array($selepagecontentshort);
   $pagecontshort=html_entity_decode(str_stop($rowpagecontentshort[0],500));
   }
 return $pagecontshort;
}

function truncateText($string, $limit, $break = '.', $pad = '...', $strict = false)
{
    // If the $string is shorter than the $limit, return the original source
    if (strlen($string) <= $limit){
        return $string;
    }
    
    // If the string MUST be shorter than the $limit set.
    // Otherwise shorten to the first $break after the $limit
    if ($strict){	
        $string = substr($string, 0, $limit);        
        if (($breakpoint = strrpos($string, $break)) !== false){
            $string = substr($string, 0, $breakpoint).$pad;
		  
        }
    }else{
        // If $break is present between $limit and the end of the string
        if (($breakpoint = strpos($string, $break, $limit)) !== false){
            if ($breakpoint < strlen($string) - 1){
                $string = substr($string, 0, $breakpoint).$pad;
            }
        }
    }
    
   return $string;
}
function getRandomString($len=6){
$base='ABCDEFGHKLMNOPQRSTWXYZabcdefghjkmnpqrstwxyz123456789';
$max=strlen($base)-1;
$code='';
mt_srand((double)microtime()*1000000);
while (strlen($code)<$len+1)
  $code.=$base{mt_rand(0,$max)};
  
return $code;
}

function sent_mail($to,$subject,$message){
	
	$header = "From: ".Shopannonces." <".ADMIN_EMAIL."> \n";
	$header .= "Reply-To: contact@shopannonces.com\r\n";
	
	$header .= "X-Mailer: PHP/". phpversion();
	$header .= "X-Priority: 3 \n";
	$header .= "MIME-version: 1.0\n";
	$header .= "Content-Type: text/html; charset=UTF-8\n";
	
	#$msg=mail_header_top();
	#$msg.=$message;
	#$msg.=mail_footer();
	
/*	echo $to;
	echo "<br>";
	echo $subject;
	echo "<br>";
	echo $message;
	echo "<br>";
	echo $header;
*/

return @mail($to,$subject,$message,$header);		
}


/* Form validation  functions */
function checkEmptyData($method,$fld,$fld_msg){
	$res_arr=array("err_flag"=>0,"msg"=>"");
	foreach($fld as $key=>$value){
		$valchk=array_key_exists($value,$_FILES) ? $_FILES[$value]['name'] : $method[$value];
		if($valchk==""){
			$res_arr['err_flag']=1;
			$res_arr['msg'].="*$fld_msg[$key]<br />";
		}
	}
	return $res_arr;
}
function validateData($method,$str_data){
	$valid_arr=array("err_flag"=>0,"msg"=>"");
	foreach($str_data as $key=>$value){
		$fld=$str_data[$key]['fld'];
		$val=array_key_exists($fld,$_FILES) ? $_FILES[$fld]['name'] :$method[$fld];
		$case=$str_data[$key]['type'];
		foreach($case as $keycase=>$keyvalue){
			switch($keycase){
				case "EMAIL":
					if(!ereg("^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z])+$",$val)){
						$valid_arr['err_flag']=1;
						$valid_arr['msg'].="*$keyvalue<br />";
					}
				break;
				case "USERNAME":
					if(!ereg("^[a-zA-Z0-9_\-]+$",$val)){
						$valid_arr['err_flag']=1;
						$valid_arr['msg'].="*$keyvalue<br />";
					}
				break;
				case "USERNAME_LTH":
					if(strlen($val)<4){
						$valid_arr['err_flag']=1;
						$valid_arr['msg'].="*$keyvalue<br />";
					}
				break;
				case "PWD_LTH":
					if(strlen($val)<4){
						$valid_arr['err_flag']=1;
						$valid_arr['msg'].="*$keyvalue<br />";
					}
				break;
				case "VALID_TEMP":
					if(!file_exists(SITE_DIR_PATH."/".trim($val))){
						$valid_arr['err_flag']=1;
						$valid_arr['msg'].="*$keyvalue<br />";
					}
				break;
				case "IMAGE":
					if(!eregi(".+(.[jJ][pP][gG]|.[gG][iI][fF]|.[bB][mM][pP]|.[jJ][pP][eE][gG]|.[pP][nN][gG])$",trim($val)) && $val!=''){
						$valid_arr['err_flag']=1;
						$valid_arr['msg'].="*$keyvalue<br />";
					}
				break;
				case "VIDEO":
					if(!eregi(".+(.[mM][oO][vV]|.[mM][pP][gG]|.[mM][pP][eE][gG]|.[wW][mM][vV]|.[fF][lL][vV])$",trim($val)) && $val!=''){
						$valid_arr['err_flag']=1;
						$valid_arr['msg'].="*$keyvalue<br />";
					}
				break;
			}
		}
	}
	return $valid_arr;
}

function chk_user_login(){
	if(!chk_login()){
		header("Location:signin.php");
		exit();
	}

}
function efface_cookies()
{
	global $HTTP_COOKIE_VARS;
	if (0 < sizeof($HTTP_COOKIE_VARS))
	{
		while (list ($k_cookie, $v_cookie) = each ($HTTP_COOKIE_VARS))
		{
			setcookie($k_cookie);
		}
	}
}

function chk_login(){
	if($_COOKIE["classi_email"]=="" || $_COOKIE["userId"]=="" || $_COOKIE["user_name"]==""
		|| $_COOKIE["memId"]=="" || $_COOKIE["memId"]==0)
	{		
		efface_cookies(); //  efface toute les infos contenus dans les cookies
		return false;
		exit();
	}
return true;
}

function Total_classified($Id,$col){
 if($Id!="" && $col!=""){
	 $cond_all=" AND 
	IF(feature_expired_date!=0000-00-00 && classified_featured='Yes',IF(feature_expired_date >= DATE(NOW()),true,false),true)";
	
    $sql="select count(*) from tbl_classified
    where $col = $Id and classified_status='Active' and paid_status!='Pending' $cond_all";
  $total=db_scalar($sql);  
  }
 return $total;	
}
function get_index_catlist($parentId){
 $fixed_cat=GetValidFileName(get_catinfo($parentId,'cat_name'));
  if($parentId!=""){
	$parentId = (!empty($parentId) && is_numeric($parentId)) ? intval($parentId) : 0;
    $sql_cat1="select * from tbl_category where cat_parent=$parentId and cat_status='Y' order by cat_order ";
    $sql_rw1=db_query($sql_cat1);
	 $num1=mysql_num_rows($sql_rw1);
     if($num1>0){
	       $var='<div>';
	        while($res1=mysql_fetch_array($sql_rw1)){			 
		$sql_cat2="select * from tbl_category where cat_parent={$res1['cat_id']} and cat_status='Y' order by cat_order ";
              $sql_rw2=db_query($sql_cat2);
			  $num2=mysql_num_rows($sql_rw2);
			  	
			  $html_link2=GetValidFileName(Rec_display_formate($res1['cat_name']))."-".$res1['cat_id'].".htm";
			    
			//$var.='<a href="classified-listing.php?subcatId1='.$res1['cat_id'].'" class="link"><p class="b pl11 pt11">'.Rec_display_formate($res1['cat_name']).'</p></a>';
//			  $var.='<a href="'.$fixed_cat.'-'.$html_link2.'" class="link"><p class="b pl11 pt11">'.$res1['cat_name'].'</p></a>';
			  
			if($res1['cat_id']==817)
				$var.='<h3 class="OnOne"><a href="my-account-post.php?subcatId1='.$res1['cat_id'].'" class="link">Job Seekers - CVs</a></h3>';
			else
				$var.='<h3 class="OnOne"><a href="search-result.php?subcatId1='.$res1['cat_id'].'" class="link">'.$res1['cat_name'].'</a></h3>';
			if($num2>0){				     
					$var.='<ul class="cate-list">';
					while($res2=mysql_fetch_array($sql_rw2)){
					 $toltal_classified=Total_classified($res2['cat_id'],'clsd_sub_subcat_id');
					 $html_link3=GetValidFileName(Rec_display_formate($res2['cat_name']))."-".$res2['cat_id'].".htm";
			//$var.='<li><a href="classified-listing.php?subcatId='.$res2['cat_id'].'">'.Rec_display_formate($res2['cat_name']).'</a>('.$toltal_classified.')</li>';
				 
//				 $var.='<li><a href="'.$fixed_cat.'-'.GetValidFileName($res1['cat_name']).'-'.$html_link3.'">'.$res2['cat_name'].'</a>('.$toltal_classified.')</li>';
			 if($res2['cat_id']==817)
				 $var.='<li><h4 class="OnOne"><a href="my-account-post.php?subcatId='.$res2['cat_id'].'">'.$res2['cat_name'].'</a></h4></li>';
			 else
				 $var.='<li><h4 class="OnOne"><a href="search-result.php?subcatId='.$res2['cat_id'].'">'.$res2['cat_name'].'</a></h4></li>';
				 
				 //$var.='<li><a href="classified-listing.php?subcatId='.$res2['cat_id'].'">'.$res2['cat_name'].'</a>('.$toltal_classified.')</li>';
				 
					}
					$var.='</ul>';
				 }			
		    }
		 $var.='</div>';
		}
		
    }
 return $var;	
}
function get_keyword_searched($catId){
if($catId!=""){
 $catId = (!empty($catId) && is_numeric($catId)) ? intval($catId) : 0;
 $sql_key_search="select * from tbl_searched_keyword where cat_id='$catId'";
 $rs_key=db_query($sql_key_search);
 $num=mysql_num_rows($rs_key);
 $var='<div>';
  if($num>0){
     $var.='<ul class="cate-list">';    
      while($reskey=mysql_fetch_array($rs_key)){
      $var.='<li>
	  <a href="search-result.php?keyId='.$reskey['rid'].'">
	  '.Rec_display_formate(truncateText($reskey['keyword'],100,' ','...',true)).'
	   </a>
	  </li>';
	   }
    $var.='</ul>';                  
    }else{ echo "<p>&nbsp;</p>"; }
   $var.='</div>';
  }
 return $var;
}
function get_searched_catlist($parentId,$catid="",$subcatid1="",$subcatid="",$clsId=""){
//print_r($_REQUEST);
 if($parentId!=""){
 $parentId = (!empty($parentId) && is_numeric($parentId)) ? intval($parentId) : 0;
 $catid = (!empty($catid) && is_numeric($catid)) ? intval($catid) : '';
 $subcatid1 = (!empty($subcatid1) && is_numeric($subcatid1)) ? intval($subcatid1) : '';
 $subcatid = (!empty($subcatid) && is_numeric($subcatid)) ? intval($subcatid) : '';
 $clsId = (!empty($clsId) && is_numeric($clsId)) ? intval($clsId) : '';
 
 
 $fixed_cat=SITE_WS_PATH."/".GetValidFileName(get_catinfo($parentId,'cat_name'));
			$maincatId=($catid!="") ? $catid : get_catinfo(get_catinfo($subcatid,'cat_parent'),'cat_parent');			
			 if($catid=="" && $subcatid1!=""){
		      $maincatId=get_catinfo($subcatid1,'cat_parent');
			 }		   				
			if($catid=="" && $subcatid1=="" && $subcatid!="" ){				
			   $maincatId=get_catinfo(get_catinfo($subcatid,'cat_parent'),'cat_parent');
			   $subcatid1=get_catinfo($subcatid,'cat_parent');				
			 }
			if($catid=="" && $subcatid1=="" && $subcatid=="" && $clsId!=""){			
			    $cls_res=getQuery('tbl_classified',"WHERE classified_id=$clsId",
				   'classified_id,clsd_cat_id,clsd_subcat_id,clsd_sub_subcat_id');			
			     $maincatId=$cls_res['clsd_cat_id'];
			     $subcatid1=$cls_res['clsd_subcat_id'];				
			 }
			 			 						
			$sql_cat1="select * from tbl_category where cat_parent=$parentId and cat_status='Y' order by cat_order ";
			$sql_rw1=db_query($sql_cat1);
			$num1=mysql_num_rows($sql_rw1);
		 if($num1>0){
				$disply=($maincatId==$parentId)? "block" : "none";
				$var='<div style="display:'.$disply.'">';
				while($res1=mysql_fetch_array($sql_rw1)){						 
		$sql_cat2="select * from tbl_category where cat_parent={$res1['cat_id']} and cat_status='Y' order by cat_order ";
				$sql_rw2=db_query($sql_cat2);
				$num2=mysql_num_rows($sql_rw2);					
				$html_link2=GetValidFileName(Rec_display_formate($res1['cat_name']))."-".$res1['cat_id'].".htm";	     
				//$var.='<a href="classified-listing.php?subcatId1='.$res1['cat_id'].'" class="link"><p class="b pl11 pt11">'.Rec_display_formate($res1['cat_name']).'</p></a>';				
	$var.='<a href="search-result.php?subcatId1='.$res1['cat_id'].'" class="link"><p class="b pl11 pt11">'.Rec_display_formate($res1['cat_name']).'</p></a>';
				if($num2>0){				     
					$var.='<ul class="cate-list">';
					while($res2=mysql_fetch_array($sql_rw2)){
						$toltal_classified=Total_classified($res2['cat_id'],'clsd_sub_subcat_id');
						$dis=($subcatid1==$res1['cat_id'])? "block" : "none";
						$var.='<p class="mt5" style="display:'.$dis.'">';
					 if(($subcatid!="" && $subcatid==$res2['cat_id'])||($res2['cat_id']==$cls_res['clsd_sub_subcat_id'])){   
						  $var.=''.Rec_display_formate($res2['cat_name']).'('.$toltal_classified.')';
						}else{
						$html_link3=GetValidFileName(Rec_display_formate($res2['cat_name']))."-".$res2['cat_id'].".htm";
						
						 $var.='<a href="search-result.php?subcatId='.$res2['cat_id'].'" class="link1">
						'.Rec_display_formate($res2['cat_name']).'</a>('.$toltal_classified.')'; 
						
				/*$var.='<a href="'.$fixed_cat.'-'.GetValidFileName($res1['cat_name']).'-'.$html_link3.'" class="link1">
						'.Rec_display_formate($res2['cat_name']).'</a>('.$toltal_classified.')'; */
						
						
						}				 
						$var.='</p>';
					}
					$var.='</ul>';
				  }			
				}
				$var.='</div>';
			}
		
   }
 return $var;	
}

function front_navigation($catId,$subcatId1="",$subcatId="",$clsId="",$stateId=""){
	
	$catId = (!empty($catId) && is_numeric($catId)) ? intval($catId) : 0;
	$subcatId1 = (!empty($subcatId1) && is_numeric($subcatId1)) ? intval($subcatId1) : '';
	$subcatId = (!empty($subcatId) && is_numeric($subcatId)) ? intval($subcatId) : '';
	$clsId = (!empty($clsId) && is_numeric($clsId)) ? intval($clsId) : '';
	$stateId = (!empty($stateId) && is_numeric($stateId)) ? intval($stateId) : '';
	
	if($catId!=""){
	$res1=Rec_display_formate(get_catinfo($catId,'cat_name'));
	$nav='<div class="tree">'.
			'<a href="./" class="link1 b">Accueil</a>'.' >> '.$res1
		.'</div>';
	}
	if($catId=="" && $subcatId1!=""){
	 $main_cat_name=Rec_display_formate(get_catinfo(get_catinfo($subcatId1,'cat_parent'),'cat_name'));
	 $main_cat_id=get_catinfo(get_catinfo($subcatId1,'cat_parent'),'cat_id');  
	 $sub_cat_name=Rec_display_formate(get_catinfo($subcatId1,'cat_name'));	
	 $res1=Rec_display_formate(get_catinfo($catId,'cat_name'));
	 
	 $nav='<div class="tree">'.
			'<a href="./" class="link1 b">Accueil</a> >> 
			<a href="search-result.php?catId='.$main_cat_id.'" class="link1 b">'.$main_cat_name.'</a> >> '
			.$sub_cat_name
		.'</div>';  
	}     
	if($catId=="" && $subcatId1=="" && $subcatId!=""){
		 $catId1=get_catinfo(get_catinfo($subcatId,'cat_parent'),'cat_parent');		
		 $catId2=get_catinfo($subcatId,'cat_parent');			  
		 $cat_name=Rec_display_formate(get_catinfo($catId1,'cat_name'));
		 $subcat_name=Rec_display_formate(get_catinfo($catId2,'cat_name'));		
		 $sub_subcat_name=Rec_display_formate(get_catinfo($subcatId,'cat_name'));
		
		$nav='<div class="tree">'.
				'<a href="./" class="link1 b">Accueil</a> >> 
				<a href="search-result.php?catId='.$catId1.'" class="link1 b">'.$cat_name.'</a> >> 
				<a href="search-result.php?subcatId1='.$catId2.'" class="link1 b">'.$subcat_name.'</a> >> '.$sub_subcat_name
			.'</div>';
	}   
	if($catId=="" && $subcatId1=="" && $subcatId=="" && $clsId!=""){
	   $qur2="select clsd_cat_id,clsd_subcat_id,clsd_sub_subcat_id,classified_title,classified_city_id
	   from tbl_classified where  classified_id=$clsId";
	   $rs2=db_query($qur2);
	  if(mysql_num_rows($rs2) >0 ){
			$res2=mysql_fetch_array($rs2);
			$maincatId=$res2['clsd_cat_id'];			
			$catId_level1=$res2['clsd_subcat_id'];			
			$catId_level2=$res2['clsd_sub_subcat_id'];			
			$cityId=$res2['classified_city_id'];
			$cat_name=Rec_display_formate(get_catinfo($maincatId,'cat_name'));
			$subcat_name=Rec_display_formate(get_catinfo($catId_level1,'cat_name'));
			$sub_subcat_name=Rec_display_formate(get_catinfo($catId_level2,'cat_name')); 
		}
	 $nav='<div class="tree">'.
			 '<a href="./" class="link1 b">Accueil</a> >>
			 <a href="search-result.php?catId='.$maincatId.'" class="link1 b">'.$cat_name.'</a> >>
			 <a href="search-result.php?subcatId1='.$catId_level1.'" class="link1 b">'.$subcat_name.'</a>';
			 if($sub_subcat_name!='')
			 	$nav.=' >> <a href="search-result.php?subcatId='.$catId_level2.'" class="link1 b">'.$sub_subcat_name.'</a> ';
	$nav.='</div>';
			 //Rec_display_formate(truncateText($res2['classified_title'],70,' ','...',true)); 
	}
	
	if($catId=="" && $subcatId1=="" && $subcatId=="" && $clsId=="" && $stateId!=""){   
		$qur2="select * from tbl_state where state_id=$stateId ";
		$rs2=db_query($qur2);
		if(mysql_num_rows($rs2) >0 ){
			$res2=mysql_fetch_array($rs2);
			$stateId=$res2['stateId'];
			$state_name=$res2['state_name'];
		}
		$nav='<div class="tree">'.
				'<a href="./" class="link1 b">Accueil</a> >>'
				.$state_name
			.'</div>';
		/*
		<a href="classified-listing.php?subcatId='.$catId_level2.'" class="link1 b">'.$sub_subcat_name.'</a>
		&laquo;  <a href="classified-listing.php?subcatId1='.$catId_level1.'" class="link1 b">'.$subcat_name.'</a>
		&laquo;  <a href="classified-listing.php?catId='.$maincatId.'" class="link1 b">'.$cat_name.'</a>'; */
	}
return $nav;
}

function xml_character_decode($string, $trans='') {
    $trans=(is_array($trans))? $trans:get_html_translation_table(HTML_ENTITIES, ENT_QUOTES);
    foreach ($trans as $k=>$v)
        $trans[$k]= "&#".ord($k).";";
    $trans=array_flip($trans);
    return strtr($string, $trans);
}

function front_date_format($d){
  if($d!=""){
	$jour=date("d");
	$mois=date("m");
	$annee=date("Y");
	$db=date("d",strtotime($d)); 
	$mb=date("m",strtotime($d)); 
	$yb=date("Y",strtotime($d)); 
	
	if($jour==$db && $mois==$mb && $annee==$yb){
		$aff="Aujourd'hui";
	}
	else if(($jour-1)==$db && $mois==$mb && $annee==$yb){
		$aff="Hier";
	}
	else if(($jour)==01 && ( $db==30 || $db==31) && ($mois-1)==$mb && $annee==$yb){
		$aff="Hier";
	}
	else{
		$aff=date("d-m-Y H:i A",strtotime($d));
	}
	
   }
 return $aff;
}

function curreny_drop_down($id=""){	 
	  $sql=db_query("select * from tbl_currency WHERE status='Active' ");
	  $num=mysql_num_rows($sql);
	  $var = '<option value="1">Sélectionnez Currency</option>';
	  if($num > 0 )
	  {
	      while($rw=mysql_fetch_array($sql))
	      {
		  
		  $sel  = ($rw[curr_id]==$id) ? "selected" : "" ;		  
		  $var.= '<option value="'.$rw[curr_id].'" '.$sel.' >'.$rw['curr_code'].'</option>';
		
	       }
	   }
return $var;
}
function display_price($price){
 if($price!=""){
	 /*
	if(isset($_SESSION['curSymbol']) && ($_SESSION['curValue'])>0 ) {	
		$convert_rate=$_SESSION['curValue'];		
		$new_price=($price/$convert_rate);
		//$symbol=($_SESSION['curSymbol']=="&euro;") ? $_SESSION['curSymbol'] :html_entity_decode($_SESSION['curSymbol']); 
		$final_price=number_format($new_price,2);
  	  }		
		*/
		$final_price=number_format($price,2);
   }
  return $final_price;
} 

function current_theme(){
	
	$sql_theem=db_query("select * from tbl_theem where theem_satus='Y' ");
	if(mysql_num_rows($sql_theem) > 0 ){
		$rw_theem=mysql_fetch_array($sql_theem);
		 $theem_css=SITE_WS_PATH."/themes/".$rw_theem['theem_value']."/css/clpage-preet.css";
		 $theem_img=SITE_WS_PATH."/themes/".$rw_theem['theem_value']."/images/";
	  
	}

 return $theem_img;
}

function html_mail_content($mail_content){
	$logo=get_config_setting(1);
$body=/*"
	<div style='box-shadow:0px 0px 1px 1px #CCCCCC; background-color:#f4f5f7;'>
		<table align='center' border='0' cellspacing='10' cellpadding='5' width='100%' style='clear:both;max-width:622px;'>
			<tbody>
				<tr>
					<td width='100%' style='padding-left:10px;padding-right:10px;' colspan='2'>	
						<div style='position: relative;	display:inline-block; width:500px;text-align:center'>
							<a href='http://$_SERVER[HTTP_HOST];'>
								<img src='http://$_SERVER[HTTP_HOST]/uploaded_files/logo/$logo' alt='Logo'>
							</a><br>
								Mesannonces
						</div>
					</td>
				</tr>
			</tbody>
		</table>*/
        "
		<table align='center' border='0' cellspacing='10' cellpadding='5' width='100%' style='clear:both;max-width:622px;'>
			<tbody>
				<tr>
					<td width='100%' style='padding-left:10px;padding-right:10px;' colspan='2'>
						$mail_content
					</td>
				</tr>
			</tbody>
		</table>";
        /*
		<table align='center' border='0' cellspacing='10' cellpadding='5' width='100%' style='clear:both;max-width:622px;'>
			<tbody>
				<tr>
					<td width='100%' style='padding-left:10px;padding-right:10px;' colspan='2'>
Notre service client est à votre écoute. Pour toutes questions, contactez-nous au 09.70.44.57.66. Notre équipe répond à vos appels du lundi au vendredi de 9h00 à 17h00 et le samedi de 9h00 à 13h00.

Merci d'utiliser Mesannonces,<br />

L'équipe Mesannonces<br />
					</td>
				</tr>
			</tbody>
		</table>
</div>
";*/
return $body;
}

function stats($ip, $path){
$sql="select compteur from tbl_compteur_visite where  ip_client='$ip'";
$vis=db_query($sql);

$res_num=mysql_fetch_array($vis);
$visites=$res_num[compteur]+1;

	if(mysql_num_rows($vis)==0){
		$sql_visit="INSERT INTO `tbl_compteur_visite` SET  ip_client='$ip', compteur='1'";
		db_query($sql_visit);
		
	}
	else{/*
		if(@$_SESSION['classi_email']=="")
			$sql_visit="UPDATE tbl_compteur_visite set compteur='$visites' where  ip_client='$ip'";
		else */
			$sql_visit="UPDATE tbl_compteur_visite set compteur='$visites', class_mail='".@$_SESSION['classi_email']."' where  ip_client='$ip'";
		db_query($sql_visit);
	}	
}

function chekcat($cat){
	$var="";
        $sql = "select * from tbl_category where `cat_id`='".$cat."'";
        
		$rw=mysql_fetch_array(db_query($sql));
		if($rw['cat_parent']==0){
			$var="clsd_cat_id";
		}
		else{
        	$sql1 = "select * from tbl_category where `cat_id`='".$rw['cat_parent']."'";
			$rw1=mysql_fetch_array(db_query($sql1));
			
			if($rw1['cat_parent']==0){
				$var="clsd_subcat_id";
			}
			else{
				$var="clsd_sub_subcat_id";
			}
				
		}
return $var;
}


function getNumberPhoto($clsid){
	$var="";
        $sql = "select count(*) from tbl_classified_image where `clsd_id`='".$clsid."'";
        
		$rw=mysql_fetch_array(db_query($sql));
		if($rw[0]>0)
			$var=$rw[0]." Photos";
		
return $var;
	
}

function getCreditsDisponible($memid){
	$var="";
        $sql = "select solde from `tbl_member` where `mem_id`='".$memid."'";
        
		$rw=mysql_fetch_array(db_query($sql));
			$var=$rw['solde']." &euro;";
		
return $var;
	
}

function inscritNewsletter($email){
	$sel=db_query("select * from tbl_newslattersubscriber where subscr_email='$email'");
	$num=mysql_num_rows($sel);
	if($num > 0){
		$update=db_query("update tbl_newslattersubscriber  set status='1' where subscr_email='$email'");
	}else{
		$ins=db_query("insert into tbl_newslattersubscriber(subscr_email,status) values('$email','1')");
	}
}

function getNextFactureNumber(){
	
	$mois_courant=strftime('%m');
	
	//LPAD( COUNT( * ) , 2,  '0' ) AS n
	
	/*
	SELECT MONTH(  `facture_date` ) AS mois, YEAR(  `facture_date` ) AS annee, COUNT( * ) 
	FROM  `tbl_facture` 
	GROUP BY annee, mois
	*/
	
	$result=db_query("SELECT COUNT( * ) AS n FROM  `tbl_facture` WHERE MONTH(  `facture_date` )='".$mois_courant."'");
	$line_raw = mysql_fetch_array($result);
		 
	$nbre_facture = $line_raw['n']+1;
	
	$nbre_facture=sprintf('%02d', $nbre_facture); //ecrire le nombre sur au moins deux chiffres
	$nouveau_num="F".$nbre_facture.strftime('%d%m%Y');

return $nouveau_num;
}


function Get_optionPayante_ID($optionName){
	if($optionName!=""){
		$sql_option=db_query("select * from tbl_featured_option where featured_designation='".$optionName."'");
		$num=mysql_num_rows($sql_option);	 
		if($num > 0 ){
			$rw=mysql_fetch_array($sql_option);		  
			$var =$rw['featured_id'];	
		}
	}	
return $var;
}

function Get_optionPayante_montant($optionName){
	if($optionName!=""){
		$sql_option=db_query("select * from tbl_featured_option where featured_designation='".$optionName."'");
		$num=mysql_num_rows($sql_option);	 
		if($num > 0 ){
			$rw=mysql_fetch_array($sql_option);		  
			$var =$rw['featured_prix'];	
		}
	}	
return $var;
}

function Get_optionPayante_Designation($optionId){
	if($optionId!=""){
		$sql_option=db_query("select * from tbl_featured_option where featured_id='".$optionId."'");
		$num=mysql_num_rows($sql_option);	 
		if($num > 0 ){
			$rw=mysql_fetch_array($sql_option);		  
			$var =$rw['featured_designation'];	
		}
	}	
return $var;
}

function Get_optionPayante_Reference($optionId){
	if($optionId!=""){
		$sql_option=db_query("select * from tbl_featured_option where featured_id='".$optionId."'");
		$num=mysql_num_rows($sql_option);	 
		if($num > 0 ){
			$rw=mysql_fetch_array($sql_option);		  
			$var =$rw['featured_reference'];	
		}
	}	
return $var;
}

function Get_optionPayante_Duree($optionId){
	if($optionId!=""){
		$sql_option=db_query("select * from tbl_featured_option where featured_id='".$optionId."'");
		$num=mysql_num_rows($sql_option);	 
		if($num > 0 ){
			$rw=mysql_fetch_array($sql_option);		  
			$var =$rw['featured_duree_vie'];	
		}
	}	
return $var;
}


function Get_optionPayante_montantID($optionId){
	if($optionId!=""){
		$sql_option=db_query("select * from tbl_featured_option where featured_id='".$optionId."'");
		$num=mysql_num_rows($sql_option);	 
		if($num > 0 ){
			$rw=mysql_fetch_array($sql_option);		  
			$var =$rw['featured_prix'];	
		}
	}	
return $var;
}


function addition_option($opttion_designation){
	global $option_paiee, $total_paiee;
	$featuredOption_id=Get_optionPayante_ID($opttion_designation);
	$featuredOption_montant=Get_optionPayante_montant($opttion_designation);

	$option_paiee[]=$featuredOption_id;
	$total_paiee[]=$featuredOption_montant;
}

function total_payee(){
	global $total_paiee;
	$total=0;
	foreach ($total_paiee as $value) {
		$total+=$value;
	}
return $total;
}

function ajouter_facture($mode_paiement, $facture_total, $classified_id){
	global $option_paiee;
	define('EURO',chr(128)); 

	$nouveau_num_facture=getNextFactureNumber();

	$sql_facture="INSERT INTO `tbl_facture` 
					SET facture_num='".$nouveau_num_facture."', 
						facture_date='".MYSQL_DATE_TIME."', 
						mode_paiement='".$mode_paiement."', 
						facture_total='".$facture_total."', 
						classified_id='".$classified_id."'";
	db_query($sql_facture);
	$facture_id=mysql_insert_id();

	require('classes/fpdf.php');	
	class PDF extends FPDF
	{
		// en-tête
		function Header()
		{
			//Police Arial gras 15
			$this->SetFont('Arial','B',14);
			//Décalage à droite
			//$this->Cell(80);
			//Titre    
			$this->Image('mobile/uploaded_files/logo/logo.png');//$this->Cell(30,10,'Mon joli fichier PDF',0,0,'C');
			//Saut de ligne
			$this->Ln(20);
		}
		
		// pied de page
		function Footer()
		{
			//Positionnement à 1,5 cm du bas
			$this->SetY(-15);
			//Police Arial italique 8
			$this->SetFont('Arial','I',8);
			//Numéro de page
			//$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
			
			$this->Cell(0,10,'Email : contact@Mesannonces.site - web : www.Mesannonces.site');
		}
	}
	
	$pdf = new PDF();
	$pdf->AddPage();
	$pdf->SetFont('Arial','B',16);
		
	
	$pdf->Cell(0,10,utf8_decode('Facture à l\'intention de :'));
	$pdf->ln();
	$pdf->SetFont('Arial','',10);
	$pdf->Cell(0,10,$_COOKIE[classi_email]);
	$pdf->ln();
	
	$pdf->Cell(95,10,' ');
	$pdf->MultiCell(80,5, utf8_decode("Fait le : ".MYSQL_DATE_TIME."\nFacture N° : ".$nouveau_num_facture."\nMode de paiement: ".$mode_paiement.""),1,1);
	
	$pdf->ln();
	$pdf->ln();
	$pdf->ln();
	$pdf->SetFont('Arial','B',16);
	$pdf->Cell(0,10,'Facture pour la prestation : '.$nouveau_num_facture);
	
	$pdf->ln();
	$pdf->SetFont('Arial','B',12);
	$pdf->Cell(0,10,utf8_decode('Détails:'));
	
	$pdf->ln();
	$pdf->SetFont('Arial','B',10);
	$pdf->Cell(35,10,utf8_decode('Référence'),1,0,'C');
	$pdf->Cell(35,10,utf8_decode('Désignation'),1,0,'C');
	$pdf->Cell(35,10,utf8_decode('Quantité'),1,0,'C');
	$pdf->Cell(35,10,utf8_decode('Durée'),1,0,'C');
	$pdf->Cell(35,10,utf8_decode('Prix unitaire HT'),1,0,'C');
	
	

	foreach ($option_paiee as $featuredOption_id) {
		$sql_facture_option="INSERT INTO `tbl_facturer` 
								SET featured_id='".$featuredOption_id."', 
									facture_id='".$facture_id."'";
		db_query($sql_facture_option);

		$pdf->ln();
		$pdf->Cell(35,10, strtoupper("an-".Get_optionPayante_Reference($featuredOption_id)),1);
		$pdf->Cell(35,10, strtoupper(Get_optionPayante_Designation($featuredOption_id)),1);
		$pdf->Cell(35,10,'1',1);
		$pdf->Cell(35,10,Get_optionPayante_Duree($featuredOption_id)."  (Jours)",1);
		$pdf->Cell(35,10, number_format(Get_optionPayante_montantID($featuredOption_id), 2, ',', '')." ".EURO,1);
	}
		
	$pdf->ln();
	$pdf->ln();
	$pdf->ln();
	$pdf->ln();
	$pdf->Cell(140,10,'Total:',1);
	$pdf->Cell(35,10, number_format($facture_total, 2, ',', '')." ".EURO,1);
	
	
	//$pdf->Output();
	$pdf->Output("mobile/uploaded_files/factures/".$nouveau_num_facture.".pdf");


	$body="Bonjour,

Vous pouvez consulter votre facture ".$nouveau_num_facture." via le lien suivant en cliquant dessus ou en le recopiant:

http://www.Mesannonces.site/bill.php?reference=".$nouveau_num_facture."&mode=html


Pour la version pdf:

http://www.Mesannonces.site/bill.php?reference=".$nouveau_num_facture."&mode=pdf


Sachez que vous pouvez retrouver l'ensemble de votre facturation dans votre compte, rubrique mes factures.


Cordialement.";
	
	sent_mail($_COOKIE['classi_email'], "FACTURE ".$nouveau_num_facture, $body);
	
return $facture_id;
}



?>