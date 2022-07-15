<?php
	require_once("../includes/main.inc.php");
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){
		$str_pd_ids = implode(',', $arr_pd_ids);
		 if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']))
		 {		  
			 $sql = "update ".DB.".forum_responses set status  = 'Y' where replyID  in ($str_pd_ids)";			
			 db_query($sql);
			 $_SESSION['site_admin_message']="Reply has been activated successfully.";
		 }
		 else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) )
		 {
			$sql = "update ".DB.".forum_responses set status = 'N' where replyID   in ($str_pd_ids)";
			db_query($sql);
			 $_SESSION['site_admin_message']="Reply has been deactivated successfully";
	     }	
		 		
		 else if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']))
		 {
				$selProduct=db_query("delete from forum_responses  where replyID   in ($str_pd_ids)");
				//@unlink($file_path);  
				$_SESSION['site_admin_message']="Forum reply Deleted successfully........";			
			}
		
			
   }
	header("Location:land.php?file=manage_forum_reply&topicID=$_REQUEST[topicID]");
	exit();
}
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ".DB.".forum_responses";
$sql .= " where topicID =$_REQUEST[topicID] ";
$sql = apply_filter($sql, $pd_name, $u_name_filter,'pd_name');
$order_by == '' ? $order_by = DB.'.forum_responses.replyID ' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql;
$sql .= "order by $order_by $order_by2 ";
 $sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);

		echo "<pre>";
		print_r(mysql_num_rows($result));
		echo "<pre>";
$rw=getResult("forum_topics"," where topicID='$_REQUEST[topicID]'");
?>
<?php echo PageTitle('Manage Forum');?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr align="right"><td colspan="2"> <strong>&laquo; <a href="land.php?file=manage_forum">Back To List</a></strong></td>
</tr>
		<br>
  <tr>
  	<td align="center"><br />
    <div align="right" class="paddingright">
	</div>  
		</b>
		<div align="right" class="paddingright"></div><br />
		  <?php if(mysql_num_rows($result)==0){?>
		<div class="msg">Sorry, no records found.</div>
		<?php } else{ ?>
		<div align="right" class="paddingright"> Showing Records:
			<?php echo  $start+1?>		to
			<?php echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>
		of
			<?php echo  $reccnt?>
		</div>
		<div align="left" class="paddingleft">Records Per Page:
			<?php echo pagesize_dropdown('pagesize', $pagesize);?>
		</div><br />
    	<form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
			<table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
	    <tr align="left">
	      <th height="20" colspan="7" nowrap="nowrap">Reply of the
		  <?php echo ucfirst(truncateText($rw[topicTitle],50,' ','...',true)); ?> </th>
	      </tr>
	    <tr align="left">
				  <th width="12%" height="20" nowrap="nowrap"><span class="price-style">Name</span></th>
				  <th width="13%" nowrap="nowrap">Email </th>
				  <th width="21%" nowrap="nowrap"><span class="price-style">Receive  Date
				    <?php echo  sort_arrows('recv_date')?>
				  </span></th>
				  <th width="39%" nowrap="nowrap"><span class="price-style">Comment</span></th>
				  <th width="6%" nowrap="nowrap">Status</th>
				  <th width="3%" nowrap="nowrap">Edit</th>
				  <th width="6%">
	   <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />					</th>
			  </tr>
				<?php
				while ($line_raw = mysql_fetch_array($result)) {
				@extract($line_raw);
				$css = ($css=='trOdd')?'trEven':'trOdd';
				$rec_status=($status  =='Y') ? "Active":"In-active";							
				?>
				<tr align="left" class="<?php echo $css?>">
				  <td valign="top"><?php echo $name;?></td>
				  <td valign="top"><?php echo $email;?></td>
				  <td valign="top"><?php echo forumchangedate($recv_date);?></td>
				  <td>
				  <?php echo nl2br($comments);?></td>
				  <td nowrap="nowrap"><?php echo $rec_status?></td>
					<td>
		  <a href="land.php?file=edit_replays&rID=<?php echo $replyID ;?>&topicID=<?php echo $topicID;?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
	<td><input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $replyID;?>" /></td>
				</tr>
				<?php } ?>
			</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td align="right" style="padding:2px"><input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
				  <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>
				  <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onclick="return deleteConfirmFromUser('arr_pd_ids[]')"/></td>
		  </tr>
          </table>
    	</form>
    <?php }?>
	<?php include("paging.inc.php");?>
	</td>
  </tr>
</table>