<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
function get_alert_emails($catId){
     $aler_emails=array();
	 $catId = intval($catId);
	 $sql="select email,mem_id from tbl_member where find_in_set($catId,class_alerts)";
	 $rs=db_query($sql);
	 $num=mysql_num_rows($rs);
	 if($num>0){
		  while($row=mysql_fetch_array($rs)){
		    $aler_emails[]=$row[email]."~".getMemberFullName($row[mem_id]);		 
		   }
	
	}
return $aler_emails;
}
//
 
$sql="select classified_id,mem_id,clsd_cat_id,DATE_FORMAT(classified_post_date,'%Y-%m-%d') as dt from tbl_classified where DATE_FORMAT(classified_post_date ,'%Y-%m-%d')='CURDATE()'";
$rs=db_query($sql);
  mysql_num_rows($rs);
if(mysql_num_rows($rs)> 0){
  while($res=mysql_fetch_array($rs)){  
    $email_arr=get_alert_emails($res[clsd_cat_id]);
    $link="<a href='http://www.mesannonces.site/classified-details.php?clsId=".$res[classified_id]."'>click here</a>";
	$link=trim($link);
    $cat_name= get_catinfo($res[clsd_cat_id],'cat_name');   
    foreach($email_arr as $toemail){	
	     $arr_date=split("~",$toemail);
		 $to=$arr_date[0];		 	 
	     $member_name =$arr_date[1]; 
         $email_subject	=	"New Classified";
		 $body			=	$mail_content;
		 $body			=	str_replace('{membername}',$member_name,$body);
		 $body			=	str_replace('{catname}',$cat_name,$body);
		 $body			=	str_replace('{link}',$link,$body);       							
		 $body			= 	nl2br($body);							
		 $email_to		=   $to;		
		$email_toname	=	$member_name;	
        sendMail($email_to,$emailto_name,$email_subject,$body,ADMIN_EMAIL,ADMIN_EMAIL,$html=true);

         }     
    
   }
}
//print_r($email_arr);
//exit;
?>