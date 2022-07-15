<?php
	require_once("../includes/main.inc.php");
	
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){
		$str_pd_ids = implode(',', $arr_pd_ids);
		 if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']))
		 {		  
			 $sql = "update tbl_feedback set job_status  = 'Y' where rID   in ($str_pd_ids)";			
			 db_query($sql);
			 $_SESSION['site_admin_message']="Feedback Activate Successfully.........";
		 }
		 else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) )
		 {
			$sql = "update tbl_feedback set job_status  = 'N' where rID    in ($str_pd_ids)";
			db_query($sql);
			 $_SESSION['site_admin_message']="Feedback Deactivate Successfully.........";
	     }	
		 		
		 else if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']))
		 {
				$selProduct=db_query("delete from tbl_feedback  where rID in ($str_pd_ids)");
				//@unlink($file_path);  
				$_SESSION['site_admin_message']="Feedback Deleted successfully........";			
			}
		
			
   }
	header("Location:land.php?file=manage_feedback");
	exit();
}
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from tbl_feedback ";
$sql .= " where 1 ";
$order_by == '' ? $order_by = 'tbl_feedback.rID  ' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 

$sql .= "order by $order_by $order_by2 ";
 $sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?php echo PageTitle('Manage Feedback');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td align="center"><br />   
		</b>
		<div align="right" class="paddingright"></div><br />
		  <?php if(mysql_num_rows($result)==0){?>
		<div class="msg">Sorry, no records found.</div>
		<?php } else{ ?>
		<div align="right" class="paddingright">
        Showing Records:
			<?php echo  $start+1?>		
        to
			<?php echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>
		of
			<?php echo  $reccnt?>
		</div>
		<div align="left" class="paddingleft">Records Per Page:
			<?php echo pagesize_dropdown('pagesize', $pagesize);?>
		</div><br />
    	<form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
			<table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
	    <tr>
				  <th width="16%" height="20" align="center" nowrap="nowrap"> Name </th>
				  <th width="18%" align="center" nowrap="nowrap">Company Name </th>
				  <th width="18%" align="center" nowrap="nowrap">Email</th>
				  <th width="16%" align="center" nowrap="nowrap">Phone</th>
				  <th width="15%" align="center" nowrap="nowrap">Posted Date </th>
				  <th width="24%" align="center" nowrap="nowrap">Function</th>
				  <th width="11%" align="center" nowrap="nowrap"><input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" /></th>
			  </tr>
				<?php
				while ($line_raw = mysql_fetch_array($result)) {
				@extract($line_raw);
				$css = ($css=='trOdd')?'trEven':'trOdd';
				$rec_status=($job_status  =='Y') ? "Active":"In-active";										
				?>
				<tr class="<?php echo $css?>">
				  <td align="center" valign="top"><?php echo ucfirst($name);?></td>
				  <td align="center" valign="top"><?php echo ucfirst($org);?></td>
				  <td align="center" valign="top"><?php echo $email;?></td>
				  <td align="center" valign="top"><?php echo $phone;?></td>
				  <td align="center" valign="top"><?php echo ucfirst($date);?></td>
				  <td nowrap="nowrap" align="center"><a href="javascript:poptastic('feedback_detail.php?rID=<?php echo $rID ; ?>');"><b><font color="#FF0000">view details/send reply </font></b></a> </td>
				  <td nowrap="nowrap" align="center"><input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $rID?>" /></td>
			  </tr>
				<?php } ?>
			</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td align="right" style="padding:2px"><input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_pd_ids[]')"/></td>
				</tr>
          </table>
    	</form>
    <?php }
	include("paging.inc.php");?>
	</td>
  </tr>
</table>