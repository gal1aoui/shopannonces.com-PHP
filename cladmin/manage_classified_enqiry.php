<?php
	require_once("../includes/main.inc.php");

require 'geoip/geoipcity.inc.php';
$database = geoip_open('geoip/GeoLiteCity.dat',GEOIP_STANDARD);
	
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)) {
		$str_classified_ids = implode(',', $arr_pd_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
		$sql = "update tbl_classified_inquiry SET enq_status = 'Delete' where enq_id in ($str_classified_ids)";		
		 db_query($sql);
		 $_SESSION['site_admin_message']="Enquiry has been reactivated successfully.";
		}else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
		 $sql = "update tbl_classified_inquiry SET enq_status = 'Active' where enq_id   in ($str_classified_ids)";
		   db_query($sql);		
		   $_SESSION['site_admin_message']="Enquiry has been activated successfully.";
		}else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {		
			$sql = "update tbl_classified_inquiry set enq_status = 'Inactive' where enq_id  in ($str_classified_ids)";			
			db_query($sql);		
			$_SESSION['site_admin_message']="Enquiry has been deleted successfully.";	
		}
	}
}

$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ,DATE_FORMAT(enq_post_date,'%d %M %Y') as cli_post_date ";
$sql = " from tbl_classified_inquiry ";
$sql .= " where 1  And enq_status!='Delete' ";	 
$order_by == '' ? $order_by = 'enq_post_date':true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 
$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);

?>
<?php echo PageTitle('Manage Classified Enquiry');?>  
     <br />
	<br />      
 <?php
 if(mysql_num_rows($result)==0){?>
      <div class="msg">Sorry, no records found.</div>
 <?php
 } else{ ?>
	  <table width="100%"  border="0" align="center" cellspacing="0"  cellpadding="4"  class="Datatable">
    	 <tr>
            <td align="left"><span class="tdLabel bold">Records Per Page:<?php echo pagesize_dropdown('pagesize', $pagesize);?></span></td>
            <td align="right"><span class="tdLabel bold">Showing Records:
            	<?php echo $start+1?>
                to
                <?php echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>
                of
                <?php echo $reccnt?>
              </span>
            </td>
	     </tr>	
      </table>
   <form id="form1" name="form1" method="post" action="">
      <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
        <tr>
          <th width="11%" align="center" >Sender Name</th>
          <th width="14%" align="center" >Sender Email</th>
          <th width="14%" align="center" >Sender Tel</th>
          <th width="11%" align="center" >On  Date</th>
          <th width="32%" align="center" >Message</th>
          <th width="21%" align="center" >View Classified Details</th>
          <th width="21%" align="center" >Sender IP</th>
          <th width="8%" align="center" >Status</th>
          <th width="3%" align="center">
            <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />
          </th>
        </tr>
            <?php
 
				 while ($line_raw = mysql_fetch_array($result)) {				  
					@extract($line_raw);
					$css = ($css=='trOdd')?'trEven':'trOdd';
				?>
        <tr class="<?php echo $css?>">
          <td align="center">
            <?php echo $enq_sender_name;?>            
          </td>
          <td align="center"><?php echo $enq_sender_email;?></td>
          <td align="center"><?php echo $enq_sender_tel;?></td>
          <td align="center"><?php echo $cli_post_date;?></td>
          <td align="left"><?php echo $enq_msg;?></td>
          <td align="center"><a href="javascript:poptastic('classified_details.php?clsId=<?php echo $enq_classified_id  ; ?>');"><b><font color="#FF0000">View Details</font></b></a> |
<a href="javascript:poptastic('cls_enq_reply.php?clsId=<?php echo $enq_classified_id ; ?>');"><strong> send reply</strong></a></td>
          <td align="center">
            <?php
				echo $enq_sender_ip;
				echo "<br>";
				$record = geoip_record_by_addr($database, $enq_sender_ip);
				// affiche les informations récupérées dans la base
				echo $record->country_name;
				?>
          </td>
          <td align="center">
            <?php
  if($enq_status  =='Active'){ echo "Active"; } else { echo "In-active";}?>
          </td>
          <td align="center">
            <input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $enq_id;?>" />
          </td>
        </tr>
        <?php
  }?>
      </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">
			<input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/> 
                          <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_pd_ids[]')"/>
		    </td>
          </tr>
     </table>
   </form>
<?php
  }
  include("paging.inc.php");?> 