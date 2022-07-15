<?php
	require_once("../includes/main.inc.php");
	
if(is_post_back()) {
	$arr_city_ids = $_REQUEST['arr_city_ids'];
	if(is_array($arr_city_ids)) {
		$str_city_ids = implode(',', $arr_city_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "update tbl_city set city_status='Delete' where city_id in ($str_city_ids)";
			db_query($sql);
			 $_SESSION['site_admin_message']="Selected City have been deleted successfully";
			 header("Location: ".$_SERVER['HTTP_REFERER']);
	         exit();
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update tbl_city set city_status = 'Active' where city_id in ($str_city_ids)";
			db_query($sql);
			  $_SESSION['site_admin_message']="Selected City have been activated successfully";
			  header("Location: ".$_SERVER['HTTP_REFERER']);
	          exit();
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
		  $sql = "update tbl_city set city_status = 'Inactive' where city_id in ($str_city_ids)";
			db_query($sql);
			 $_SESSION['site_admin_message']="Selected City have been deactivated successfully";
			 header("Location: ".$_SERVER['HTTP_REFERER']);
	         exit();
		}
	}
	
}



$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from tbl_city ";
$sql .= " where 1  And city_status!='Delete'";

if($city_state_id!=''){
$sql	.=" And city_state_id='$city_state_id' "; 
}

if($_REQUEST['city_name']!=''){
 $sql	.=" And city_name like '%$city_name%'";
}

$order_by == '' ? $order_by = 'city_order' : true;
$order_by2 == '' ? $order_by2 = 'asc' : true;
$sql_count = "select count(*) ".$sql; 
$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<script type="text/JavaScript">
function Category_order(city_id,order,id,start,parent)
{
var str;
str="land.php?file=change_order&cat_id="+city_id+"&order="+order+"&id="+id+"&start="+start+"&type=city&parent="+parent;
location.href=str;
}
</script>
<?php echo PageTitle('Manage City');?>
      <form name="ffff" method="post" action="land.php?file=manage_city"> 
        <br />
        <table width="60%"  border="0" align="center" cellspacing="0" class="tableList">
		 <div class="msg"><?php echo display_sess_msg()?></div>
          <tr align="center">
            <th colspan="2">Search City </th>
          </tr>
		    <tr><td class="tdLabel" width="49%"><strong>City Name</strong></td>
		    <td class="tdLabel" width="51%"><input name="city_name" type="text" id="city_name" value="<?php echo $city_name?>" /></td>
		</tr>
        <tr>
            <td colspan="2" align="center"><input name="pagesize" type="hidden" id="pagesize" value="<?php echo $pagesize?>" />
            	<input name="city_state_id" type="hidden" id="city_state_id" value="<?php echo $city_state_id?>" />
                <input type="submit" class="btn_orange" name="search" value="Search">
            </td>
        </tr>
	    </table>
      </form>
      <br />
	  <div align="right">&laquo; <a href="land.php?file=manage_states"><strong> Back To Listing</strong></a></div> 
	   <br />
	<div align="right"><a href="land.php?file=add_edit_city&city_state_id=<?php echo $_REQUEST['city_state_id']?>"><strong>Add City</strong></a></div>      
 <?php
 if(mysql_num_rows($result)==0){?>
      <div class="msg">Sorry, no records found.</div><br /><br /><div align="right"><input name="add" type="button"  value="Add New City " class="btn_orange" id="add"   onClick="location.href='land.php?file=add_edit_city&city_state_id=<?php echo $_REQUEST['city_state_id']?>';"/></div>
 <?php
  } else{ ?>
	  <table width="100%"  border="0" align="center" cellspacing="0"  cellpadding="4"  class="Datatable">
    	 <tr>
            <td align="left"><span class="tdLabel bold">Records Per Page:<?php echo pagesize_dropdown('pagesize', $pagesize);?></span></td>
            <td align="right"><span class="tdLabel bold">Showing Records:
            	<?php echo $start+1?> to <?php echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?> of <?php echo $reccnt?>
              </span>
            </td>
	     </tr>	
      </table>
   <form id="form1" name="form1" method="post" action="">
      <table width="100%" border="0" cellpadding="2" cellspacing="0" class="tableList">
        <tr>
          <th><input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" /></th>
          <th>Update</th>
          <th>City </th>
          <th>Order</th>
          <th>Classifieds</th>
          <th>STATUS</th>
        </tr>
<?php
 
while ($line_raw = mysql_fetch_array($result)) {
	$line = ms_display_value($line_raw);
	@extract($line);
	$css = ($css=='trOdd')?'trEven':'trOdd';
	
	//echo $enq_w_type;	
?>
        <tr class="<?php echo $css?>">
           <td align="center"><label> <input name="arr_city_ids[]" type="checkbox" id="arr_city_ids[]" value="<?php echo $city_id?>" /><input type="hidden" name="u_status_arr[]"  value="<?php echo ($city_status=='Active')?'Activate':'Deactivate';?>" /></label></td>
       	   <td align="center"><a href="land.php?file=add_edit_city&city_state_id=<?php echo $city_state_id?>&city_id=<?php echo $city_id?>&start=<?php echo $start?>">Update</a></td>
           <td class="head_blue" align="center"><?php echo $city_name;?></td>
           
           <td class="head_blue" align="center"><select name="city_order" class="textfield" onChange="javascript:Category_order('<?php echo $city_id?>',this.value,'<?php echo $city_id?>','<?php echo $start?>','<?php echo $city_state_id?>')">

                                    <?php
  for($i=1;$i<=$reccnt;$i++){?>

                                    <option value="<?php echo $i?>" <? if($i==$city_order){  echo "selected"; }?> >

                                    <?php echo $i?>

                                    </option>

                                    <?php
  } ?>

       						  </select></td>
           <td class="head_blue" align="center"><a href='land.php?file=manage_classified&cityId=<?php echo $city_id?>'>View</a></td>           <td class="head_blue" align="center"><?php echo $city_status?></td>	                 
        </tr>
<?php
  }
?>       
        <tr>
          <td colspan="6" align="left"> 
         <input name="Activate" type="submit"  value="Reactivate" class="btn_orange" id="Activate"   onClick="return deactivateConfirmFromUser('arr_city_ids[]','Activate','Sub Location','u_status_arr[]');"/>&nbsp;&nbsp;
         <input name="Deactivate" type="submit" class="btn_orange" value="Deactivate" id="Deactivate"  onClick="return deactivateConfirmFromUser('arr_city_ids[]','Deactivate','Sub Location','u_status_arr[]');"/>&nbsp;&nbsp;
         <input name="Delete" type="submit" class="btn_orange" id="Delete" value="Delete"  onClick="return deleteConfirmFromUser('arr_city_ids[]','delete','Sub Location');"/>
         </td>
        </tr>
     </table>
    </form>
<?php
  }
   include("paging.inc.php");?>