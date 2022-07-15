<?php
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){
		$str_pd_ids = implode(',', $arr_pd_ids);
		 if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']))
		 {		  
			 $sql = "update ".DB.".tbl_private_message set job_status  = 'Y' where msg_id  in ($str_pd_ids)";			
			 db_query($sql);
			 $_SESSION['site_admin_message']="Feedback Activate Successfully.........";
		 }
		 else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) )
		 {
			$sql = "update ".DB.".tbl_private_message set job_status  = 'N' where msg_id    in ($str_pd_ids)";
			db_query($sql);
			 $_SESSION['site_admin_message']="Feedback Deactivate Successfully.........";
	     }	
		 		
		 else if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']))
		 {
				$selProduct=db_query("update tbl_private_message set msg_status='Delete' where msg_id in ($str_pd_ids)");
				//@unlink($file_path);  
				$_SESSION['site_admin_message']="Message Deleted successfully........";	
                  header("Location:land.php?file=manage_pm");
	                exit();		
			}
		
			
   }
	
}
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ".DB.".tbl_private_message ";
$sql .= " where to_mem_id=0 and msg_status!='Delete' ";
$order_by == '' ? $order_by = DB.'.tbl_private_message.msg_id   ' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 

$sql .= "order by $order_by $order_by2 ";
 $sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?=PageTitle('Manage Private Message');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td align="center"><br />   
		</b>
		<div align="right" class="paddingright"></div><br />
		  <? if(mysql_num_rows($result)==0){?>
		<div class="msg">Sorry, no records found.</div>
		<? } else{ ?>
		<div align="right" class="paddingright"> Showing Records:
			<?= $start+1?>		to
			<?=($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>
		of
			<?= $reccnt?>
		</div>
		<div align="left" class="paddingleft">Records Per Page:
			<?=pagesize_dropdown('pagesize', $pagesize);?>
		</div><br />
    	<form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
			<table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
	    <tr>
				  <th width="13%" height="20" align="center" nowrap="nowrap"> Poster Name </th>
				  <th width="20%" align="center" nowrap="nowrap">View Member Details </th>
				  <th width="55%" align="center" nowrap="nowrap">Poster Message </th>
				  <th width="9%" align="center" nowrap="nowrap">Posted Date </th>
				  <th width="3%" align="center" nowrap="nowrap"><input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" /></th>
			  </tr>
				<?php
				while ($line_raw = mysql_fetch_array($result)) {
				@extract($line_raw);
				$css = ($css=='trOdd')?'trEven':'trOdd';
				$rec_status=($job_status  =='Y') ? "Active":"In-active";										
				?>
				<tr class="<?=$css?>">
				  <td align="center" valign="top"><?=ucfirst($poster_name);?></td>
				  <td align="center" valign="top">
<a href="javascript:poptastic('userDetail.php?id=<?php echo $from_mem_id ; ?>');">View</a></td>
				  <td align="center" valign="top"><?=$poster_msg;?></td>
				  <td align="center" valign="top"><?=ucfirst($date);?></td>
				  <td nowrap="nowrap" align="center"><input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?=$msg_id ?>" /></td>
			  </tr>
				<? } ?>
			</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td align="right" style="padding:2px"><input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_pd_ids[]')"/></td>
				</tr>
          </table>
    	</form>
    <? }?>
	<? include("paging.inc.php");?>
	</td>
  </tr>
</table>