<?php 
	require_once("../includes/main.inc.php");
	
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){
		$str_pd_ids = implode(',', $arr_pd_ids);
		 if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']))
		 {		  
			 $sql = "update ".DB.".forum_topics set status   = 'Y' where topicID  in ($str_pd_ids)";			
			 db_query($sql);
			 $_SESSION['site_admin_message']="Topic has been activated successfully.....";
		 }
		 else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) )
		 {
			$sql = "update ".DB.".forum_topics set status   = 'N' where topicID   in ($str_pd_ids)";
			db_query($sql);
			 $_SESSION['site_admin_message']="Topic has been Deactivate successfully....";
	     }	
		 		
		 else if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']))
		 {
				$selProduct=db_query("delete from forum_topics  where topicID   in ($str_pd_ids)");
				//@unlink($file_path);  
				$_SESSION['site_admin_message']="Forum Deleted successfully........";	
			}
		
   }
	 
}
$key=$_REQUEST['keyword'];
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ".DB.".forum_topics";
$sql .= " where 1 ";
if($key!=""){
  $sql.="and (topicTitle LIKE '%$key%')";  
}
$sql = apply_filter($sql, $pd_name, $u_name_filter,'pd_name');
$order_by == '' ? $order_by = DB.'.forum_topics.topicID ' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 
$sql .= "order by $order_by $order_by2 ";
 $sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?php  echo PageTitle('Manage Forum');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><table width="80%"  border="0" align="center" cellpadding="6" cellspacing="2" class="lightBorder">
 <tr>
  <td class="lightGrayBg" align="left"><b>Search Forum</b>&nbsp;
  <form name="ffff" method="get" action="">
  Keyword: [topic &nbsp;
   <input type="hidden" name="file" class="input"  value="manage_forum">
  <input type="text" name="keyword" class="input" size="50" value="">
  <input type="submit" class="button" name="msearch" value="Search">	  
  </form>
  </td>
 </tr>
</table>
</td></tr>
  <tr>
  	<td align="center"><br />
   <div align="right" > <br>
	<a href="land.php?file=create_forum_topic"><b>Create New Topic </b></a></div>
		<br><br>  
		</b>
		<div align="right" class="paddingright"></div><br />
		  <?php  if(mysql_num_rows($result)==0){?>
		<div class="msg">Sorry, no records found.</div>
		<?php  } else{ ?>
		<div align="right" class="paddingright"> Showing Records:
			<?php  echo  $start+1?>		to
			<?php  echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>
		of
			<?php  echo  $reccnt?>
		</div>
		<div align="left" class="paddingleft">Records Per Page:
			<?php  echo pagesize_dropdown('pagesize', $pagesize);?>
		</div><br />
    	<form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
			<table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
	    <tr align="left">
				<th width="32%" height="20" nowrap="nowrap"><span class="price-style">Topic</span></th>
				<th width="5%" nowrap="nowrap"> <span class="price-style">Replies</span></th>
				<th width="19%" nowrap="nowrap"><span class="price-style">Created Date <?php  echo  sort_arrows('recv_date')?> </span></th>
				<th width="16%" nowrap="nowrap"><span class="price-style">Created By </span></th>
				<th width="15%" nowrap="nowrap">Status</th>
				<th width="7%" nowrap="nowrap">Edit</th>
				<th width="6%">
	   <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />					</th>
			  </tr>
				<?php 
				while ($line_raw = mysql_fetch_array($result)) {
				@extract($line_raw);
				$css = ($css=='trOdd')?'trEven':'trOdd';
				$rec_status=($status  =='Y') ? "Active":"In-active";
				//$create_by=getMemberFullName($memberID); 						
				?>
				<tr align="left" class="<?php  echo $css?>">
				  <td valign="top">
				  <a href="land.php?file=manage_forum_reply&topicID=<?php  echo $topicID;?>">
				    <?php  echo ucfirst(strtolower($topicTitle)); ?>
				  </a></td>
				  <td valign="top"><?php  echo getTopicReply($topicID);?></td>
				  <td valign="top"><?php  echo forumchangedate($recv_date);?></td>
				  <td nowrap="nowrap">
                  
				  <?php 
				  if(!$memberID=='0') { ?>
				  <a href="javascript:poptastic('userDetail.php?id=<?php  echo $memberID; ?>');">
                  	<strong>
				    	<?php  echo $create_by;?>
				 	</strong
                  ></a>
				  <?php  
				  }else { echo "Admin"; } ?> </td>
				  <td nowrap="nowrap"><?php  echo $rec_status?></td>
					<td>
		  <a href="land.php?file=edit_topics&topicID=<?php  echo $topicID ;?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
	<td><input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php  echo $topicID;?>" /></td>
				</tr>
				<?php  } ?>
			</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
				<td align="right" style="padding:2px"><input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
				<input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>
				<input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onclick="return deleteConfirmFromUser('arr_pd_ids[]')"/></td>
			</tr>
          </table>
    	</form>
    <?php  }
	include("paging.inc.php");?>
	</td>
  </tr>
</table>