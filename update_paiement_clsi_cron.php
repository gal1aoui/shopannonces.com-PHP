<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
/* Update classified  feature status no when classified expire from feature */
 $sql="SELECT classified_id , classified_post_date , date_fin_republication FROM tbl_classified 
 		WHERE 
			DATE(NOW()) < date_fin_republication 
		AND DATE(NOW()) > classified_post_date";
$rs=db_query($sql);
$num=mysql_num_rows($rs);
 if($num>0){
   while($row=mysql_fetch_array($rs)){
   
		echo $date_comp=date($row[classified_post_date], strtotime('1 days'));
		echo '<br>';
		echo $row[classified_id].', '.$row[classified_post_date].', '.$row[date_fin_republication];
		echo '<br>';
		db_query("UPDATE tbl_classified SET classified_post_date=ADDDATE(classified_post_date, 1) WHERE classified_id='$row[classified_id]'");	 
    }  
 }
/* End Update classified  feature status no when classified expire from feature */








?>