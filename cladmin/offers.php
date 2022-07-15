<?php
	require_once("../includes/main.inc.php");
	
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){	
		$str_pd_ids = implode(',', $arr_pd_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from tbl_offers where offer_id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="Offer deleted Successfully.........";
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update tbl_offers set status = 'Y' where offer_id in ($str_pd_ids)";
			db_query($sql);			
			$_SESSION['site_admin_message']="Offer Activated Successfully.........";
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			 $sql = "update tbl_offers  set status = 'N' where offer_id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="Offer Deactivate Successfully.........";
		}		
	 }
	
} 
$start = intval(@$start);
$pagesize = intval(@$pagesize)==0? 20 : $pagesize;
$columns = "select * ";
$sql = " from tbl_offers  ";
$sql.= "where 1 ";
$sql = apply_filter($sql, @$pd_name, @$u_name_filter,'pd_name');
@$order_by == '' ? $order_by = 'tbl_offers.offer_id' : true;
@$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 
 $sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?php echo PageTitle('Offers List');?>
<script language="javascript">
function validateorder(obj){
var len=obj.elements.length;
	for(var tx=1;tx<len;tx++)
	{
	if(obj.elements[tx].type=='text'){
	if(obj.elements[tx].id.indexOf('cat')!=-1){
		var res= obj.elements[tx].value;	
		 if(parseInt(res)<=0){
				alert("Order must be greater than zero!!");
				obj.elements[tx].value='';
				obj.elements[tx].focus();
				return false;
			}
		}
	}
		
  }
}

</script>
<div align="left">

<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>	  
     </b>
		<div align="right" > <br>
		<a href="land.php?file=add_offer"><b>Add New Offer </b></a>
		<br><br>
		</div>
		<?php if(mysql_num_rows($result)==0){?>
		<div class="msg">Sorry, no records found.</div>
			<?php } else{ ?>
		<div align="right"> Showing Records:
			<?php echo  $start+1?>
		to
			<?php echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>
		of
			<?php echo  $reccnt?>
		</div>
		<div align="left">Records Per Page:
			<?=pagesize_dropdown('pagesize', $pagesize);?>

      <br>
      <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
          <tr>
             <th width="15%" align="left" >Offer Name</th>
             <th width="15%" align="left"> Category </th>
			 <th width="20%" align="left"> Description </th>
             <th width="15%" align="left">Cost</th>
			 <th width="15%" align="left">Duration </th>
			 <th width="15%" align="center">Status </th>
			 <th width="15%" align="left">Edit </th>
			 
			  <th width="5%">
			 <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />
			  </th>
          </tr>
             <?php
			 $k=1;
			 while ($line_raw = mysql_fetch_array($result)) {				
			 @extract($line_raw);
			 @$css = ($css=='trOdd')?'trEven':'trOdd';
			 $rec_status=($status  =='Y') ? "Active":"In-active";			 
             ?>
          <tr class="<?php echo $css?>">
                         <td align="left"><?php echo ucfirst($name);?></td>
						 <td align="left"><?php echo get_catinfo($category,'cat_name');?></td>
						 <td align="left"><?php echo ucfirst($description);?></td>
						 <td align="left"><?php echo ucfirst($cost);?></td>
						 <td align="left" ><?php echo ucfirst($duration);?></td>
						 <td align="center"><?php echo $status;?></td>
				        <td align="left">
						<a href="?file=edit_offer&id=<?php echo $offer_id?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
						
						<td align="center">
						<input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $offer_id?>" /></td>
          </tr>
          <?php $k++; }?>
        </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="81%" align="right" style="padding:2px">
			<!--<input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>-->                          </td>
            <td width="37%" align="left" style="padding:2px"><span class="txt12">
              <input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>
              </span>
            <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_pd_ids[]')"/></td></tr>
        </table>
      </form>
    <?php }?>
	<? include("paging.inc.php");?></td>
  </tr>
</table>