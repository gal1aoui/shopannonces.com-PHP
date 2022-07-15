<?php
	require_once("../includes/main.inc.php");
	
if(is_post_back()){
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){
		$str_pd_ids = implode(',', $arr_pd_ids);
		 if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x'])) {
			 $sql = "update ".DB.".tbl_advertise set status  = 'Y' where id   in ($str_pd_ids)";			
			 db_query($sql);
			 $_SESSION['site_admin_message']="Banner Activated Successfully.........";
			 header("Location:land.php?file=manage_advertise");
	         exit();
		 }elseif(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ){
			$sql = "update ".DB.".tbl_advertise set status  = 'N' where id    in ($str_pd_ids)";
			db_query($sql);
			 $_SESSION['site_admin_message']="Banner Deactivated Successfully.........";
			 header("Location:land.php?file=manage_advertise");
	         exit();
	     }elseif(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x'])){
				$selProduct=db_query("delete from tbl_advertise  where id in ($str_pd_ids)");
				//@unlink($file_path);  
				$_SESSION['site_admin_message']="Banner Deleted successfully........";
				header("Location:land.php?file=manage_advertise");
	            exit();			
			}
      }
	
}
if($_REQUEST['recv']!="" && $_REQUEST['recv']>0 ){
  $sql = "UPDATE ".DB.".tbl_advertise SET status ='Y',pay_option='Paid' WHERE id =$_REQUEST[recv]";		
  db_query($sql);
  $_SESSION['site_admin_message']="Banner Activate Successfully.........";
  header("Location:land.php?file=manage_advertise");
  exit();			
}
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ".DB.".tbl_advertise ";
$sql .= " where 1 ";
$order_by == '' ? $order_by = DB.'.tbl_advertise.id  ' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 

$sql .= "order by $order_by $order_by2 ";
 $sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?php echo PageTitle('Manage Advertise');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td align="center"><br />   
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
	    <tr>
				  <th width="10%" height="20" align="center" nowrap="nowrap"> Name </th>
				  <th width="13%" align="center" nowrap="nowrap">Company Name </th>
				  <th width="5%" align="center" nowrap="nowrap">Email</th>
				  <th width="11%" align="center" nowrap="nowrap">Phone</th>
				  <th width="16%" align="center" nowrap="nowrap">Posted Date </th>
				  <th width="11%" align="center" nowrap="nowrap">Category</th>
				  <th width="14%" align="center" nowrap="nowrap">Banner Position </th>
				  <th width="9%" align="center" nowrap="nowrap">View</th>
				  <th width="5%" align="center" nowrap="nowrap">Status</th>
				  <th width="6%" align="center" nowrap="nowrap"><input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" /></th>
			  </tr>
				<?php
				while ($line_raw = mysql_fetch_array($result)) {
				@extract($line_raw);
				$css = ($css=='trOdd')?'trEven':'trOdd';
				$rec_status=($job_status  =='Y') ? "Active":"In-active";
				$payment_status=($pay_option=="Pending") ? "Payment Pending" : $pay_option;
				$fcatid=($dis_subcat > 0 )? $dis_subcat :  $cat_id;									
				?>
				<tr class="<?php echo $css?>">
				  <td align="center" valign="top"><?php echo ucfirst($name);?></td>
				  <td align="center" valign="top"><?php echo ucfirst($company_name);?></td>
				  <td align="center" valign="top"><?php echo $email;?></td>
				  <td align="center" valign="top"><?php echo $contact_no;?></td>
				  <td align="center" valign="top"><?php echo ucfirst($date);?></td>
				  <td nowrap="nowrap" align="center"><?php echo get_catinfo($fcatid,'cat_name');?></td>
				  <td nowrap="nowrap" align="center"><?php echo $banner_position;?><br>
				    <strong><?php echo $payment_status;?></strong><br>
					<?php if($pay_option=="Pending"){?>
					  <a href="land.php?file=manage_advertise&recv=<?php echo $id?>">Set Received</a>
					<?php } ?>
					<br>
					<?php if($amount!="0.00"){
					 echo "Amount: ".CURR. $amount;
					}					
					?>
					</td>
				  <td nowrap="nowrap" align="center"><a href="javascript:poptastic('advertise_detail.php?id=<?php echo $id ; ?>');"><b><font color="#FF0000">View Details</font></b></a></td>
				  <td nowrap="nowrap" align="center"><a href="javascript:poptastic('advertise_detail.php?id=<?php echo $id ; ?>');"><b></b></a><?php if($status=='Y'){ echo "Active"; } else { echo "In-active";}?> </td>
				  <td nowrap="nowrap" align="center">
				  <input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $id?>" />
				  <input type="hidden" name="ban_postion" value="<?php echo $banner_position;;?>" >
				  <input type="hidden" name="pay_status" value="<?php echo $pay_option;?>" >
				  </td>
			  </tr>
				<?php } ?>
			</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td align="right" style="padding:2px"><input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/> 
				    <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>
				  <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_pd_ids[]')"/></td>
				</tr>
          </table>
    	</form>
    <?php }?>
	<?php include("paging.inc.php");?>
	</td>
  </tr>
</table>