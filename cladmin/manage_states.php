<?php
	require_once("../includes/main.inc.php");
	
if(is_post_back()) {
	$arr_state_ids = $_REQUEST['arr_state_ids'];
	if(is_array($arr_state_ids)) {
		$str_state_ids = implode(',', $arr_state_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "update tbl_state set state_status='Delete' where state_id in ($str_state_ids)";
			db_query($sql);
			 $_SESSION['site_admin_message']="Selected State have been deleted successfully";
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update tbl_state set state_status = 'Active' where state_id in ($str_state_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="Selected State have been activated successfully";
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
		    $sql = "update tbl_state set state_status = 'Inactive' where state_id in ($str_state_ids)";
			 db_query($sql);
			 $_SESSION['site_admin_message']="Selected State have been deactivated successfully";
		}
	}
//	header("Location: ".$_SERVER['HTTP_REFERER']);
	//exit;
}
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from tbl_state ";
$sql .= " where 1  And state_status!='Delete'";
if($_REQUEST['state_name']!=''){
 $sql	.=" And state_name like '%$state_name%'";
}
$order_by == '' ? $order_by = 'state_order' : true;
$order_by2 == '' ? $order_by2 = 'asc' : true;
$sql_count = "select count(*) ".$sql; 
$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<script type="text/JavaScript">
function Category_order(state_id,order,id,start)
{
	str="land.php?file=change_order&cat_id="+state_id+"&order="+order+"&id="+id+"&start="+start+"&type=state";
	location.href=str;
}
</script>
<?php echo PageTitle('Manage States');?>
   <form name="frmm" method="get" action="" onSubmit="confirm_submit(this)" >  
     <table width="60%"  border="0" align="center" cellspacing="0" class="tableList">
       <tr align="center"> </tr>
       <tr align="center">
         <th colspan="2">Search States </th>
       </tr>
       <tr>
         <td class="tdLabel" width="40%"><strong>State Name</strong></td>
         <td class="tdLabel" width="60%">
           <input name="file" type="hidden" id="dd" value="manage_states" />
           <input name="state_name" type="text" id="state_name" value="<?php echo $state_name?>" size="40" /></td>
       </tr>
       <tr>
         <td align="center">&nbsp;
         </td>
         <td align="left"><input type="submit" class="btn_orange" name="search" value="Search"></td>
       </tr>
     </table>
   </form>
      <br />
	<br />
	<div align="right"><a href="land.php?file=add_edit_state"><strong>Add State</strong></a></div>     
 <?php if(mysql_num_rows($result)==0){?>
      <div class="msg">Sorry, no records found.</div><br /><br /><div align="right"><input name="add" type="button"  value="Add New State" class="btn_orange" id="add"   onClick="location.href='land.php?file=add_edit_state';"/></div>
 <?php } else{ ?>
	  <table width="100%"  border="0" align="center" cellspacing="0"  cellpadding="4"  class="Datatable">
    	 <tr>
            <td align="left"><span class="tdLabel bold">Records Per Page:<?php echo pagesize_dropdown('pagesize', $pagesize);?></span></td>
            <td align="right"><span class="tdLabel bold">Showing Records:
            	<?php echo $start+1?> to <?php echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?> of <?php echo $reccnt?>
              </span>
            </td>
	     </tr>	
      </table>
   <form id="form1" name="form1" method="post">
      <table width="100%" border="0" cellpadding="2" cellspacing="0" class="tableList">
        <tr>
          <th><input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" /></th>
          <th>Update</th>
          <th>State</th>
          <th>Order</th>
          <th>Classifieds</th>
          <th>City</th>
          <th>STATUS</th>
        </tr>
<?php while ($line_raw = mysql_fetch_array($result)) {
	$line = ms_display_value($line_raw);
	@extract($line);
	$css = ($css=='trOdd')?'trEven':'trOdd';	
	//echo $enq_w_type;	
?>
        <tr class="<?php echo $css?>">
           <td align="center"><label> <input name="arr_state_ids[]" type="checkbox" id="arr_state_ids[]" value="<?php echo $state_id?>" /><input type="hidden" name="u_status_arr[]"  value="<?php echo ($state_status=='Active')?'Activate':'Deactivate';?>" /></label></td>
       	   <td align="center"><a href="land.php?file=add_edit_state&state_id=<?php echo $state_id?>&start=<?php echo $start?>">Update</a></td>
           <td class="head_blue" align="center"><?php echo $state_name;?></td>
           
           <td class="head_blue" align="center"><select name="state_order" class="textfield" onChange="javascript:Category_order('<?php echo $state_id?>',this.value,'<?php echo $state_id?>','<?php echo $start?>','<?php echo $state_id?>')">

                                    <?php for($i=1;$i<=$reccnt;$i++){?>

                                    <option value="<?php echo $i?>" <?php if($i==$state_order){  echo "selected"; }?> >

                                    <?php echo $i?>

                                    </option>

                                    <?php } ?>

       						  </select></td>
           <td class="head_blue" align="center"><a href='land.php?file=manage_classified&stateId=<?php echo $state_id?>'>View</a></td>           <td class="head_blue" align="center"><a href='land.php?file=manage_city&city_state_id=<?php echo $state_id?>'>View</a></td>
           <td class="head_blue" align="center"><?php echo $state_status?></td>	                 
        </tr>
<?php }
?>      <tr>
          <td colspan="7" align="left">
<input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_state_ids[]')"/>
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_state_ids[]')"/>&nbsp;&nbsp;
<input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_state_ids[]')"/>
</td>
        </tr>
     </table>
</form>
<?php }?>
<?php include("paging.inc.php");?>