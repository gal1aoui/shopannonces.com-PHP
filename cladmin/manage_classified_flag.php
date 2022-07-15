<?php


echo PageTitle("Manage Classified Flag");
?>

<br /><br />      
<?php
$clsId=@$_REQUEST[clsId];
if(!isset($clsId)){
$ids='';
	$sql = " select * from tbl_classified WHERE classified_status!='Delete'";
    $result=db_query($sql);
	 while($line_raw = mysql_fetch_array($result)) 
	 {
		 if($ids=='')
			 $ids=$line_raw[classified_id];
		 else
	 		$ids.=', '.$line_raw[classified_id];
	 }
	
	$sql = "select * from signale where cls_id in ($ids)";
    $result=db_query($sql);
}
else{
	
	$sql = "select * from signale where cls_id =$clsId";
    $result=db_query($sql);
}
  if(mysql_num_rows($result)==0){?>
	<div class="msg">Sorry, no records found.</div>
 <?php }

else{ ?>
<table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
        <tr>
        <th width="15px"></th>
              <th align="center" width="10%">
                ID Flag
              </th>
              <th align="center" width="15%">
                ID Annonce
              </th>
              <th>
              	count
              </th>
              <th width="12%" align="center" >
              	type signal
             </th>
              <th width="12%" align="center" >
              	date signal
             </th>
             <th>
                message_signal
             </th>
              
          </tr>
          <?php while ($line_raw = mysql_fetch_array($result)) 
		 {				
                
                
		   @extract($line_raw);
		   $css = ($css=='trOdd')?'trEven':'trOdd';
                
		?>
            <tr  class="<?php echo $css;?>">
                <td><a href="land.php?file=supp_flag&signal_id=<?php echo $signal_id;?>"><img src="images/btn-del.jpg" /></a></td>
                  <td align="center">
                    <?php echo $signal_id;?>
                  </td>
                  <td align="center">
                  <a href="land.php?file=classified_details&clsId=<?php echo $cls_id;?>">
                    <?php echo $cls_id;?>
                    </a>
                    
                    	&nbsp;&nbsp;
                 		<a href="land.php?file=supp_annonce&clsid=<?php echo $cls_id;?>">Supprimer Annonce</a>
                  </td>
  <?php				  
    $sql_count = "select count(*) from signale where cls_id in ($cls_id)"; 
    
    $reccnt = db_scalar($sql_count);
  ?>
                  <td width="12%" align="center" >
                  <a href="land.php?file=manage_classified_flag&clsId=<?php echo $cls_id;?>">
                    <?php echo $reccnt;?>
                   </a>
                 </td>
                  <td width="12%" align="center" >
                    <?php echo $type_signal;?>
                 </td>
                  <td width="12%" align="center" >
                    <?php echo $date_flag;?>
                 </td>
                 <td>
                    <?php echo $message_signal;?>
                 </td>
             </tr>
            <?php
		 }
		 ?>
          </table>
<?php

}
?>