<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
/* Update classified  feature status no when classified expire from feature */
 $sql="SELECT classified_id ,feature_expired_date ,classified_featured FROM tbl_classified WHERE feature_expired_date <= DATE(NOW()) AND feature_expired_date!=0000-00-00 AND classified_featured='Yes' ";
$rs=db_query($sql);
$num=mysql_num_rows($rs);
 if($num>0){
   while($row=mysql_fetch_array($rs)){  
   
      db_query("UPDATE tbl_classified SET classified_featured='No' WHERE classified_id='$row[classified_id]'");	 
    }  
 }
/* End Update classified  feature status no when classified expire from feature */



/* Update classified  Paid Category, status no when classified expire from feature */

 $sql2="SELECT classified_id ,classified_expired_date,classified_status FROM tbl_classified WHERE classified_expired_date <= DATE(NOW()) AND classified_expired_date!=0000-00-00 AND classified_status='Active' ";
$rs2=db_query($sql2);
$num2=mysql_num_rows($rs2);
 if($num2>0){
   while($row2=mysql_fetch_array($rs2)){  
   
      db_query("UPDATE tbl_classified SET classified_status='Inactive' WHERE classified_id='$row2[classified_id]'");	 
    }  
 }
 
/* End Update classified  Paid Category, status no when classified expire  */





?>