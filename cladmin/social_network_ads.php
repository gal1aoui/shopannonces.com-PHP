<?php
	require_once("../includes/main.inc.php");
	
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){	
		$str_pd_ids = implode(',', $arr_pd_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from tbl_social_network where id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="Ads deleted Successfully.........";
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update tbl_social_network set status = 'Y' where id in ($str_pd_ids)";
			db_query($sql);			
			$_SESSION['site_admin_message']="Ads Activated Successfully.........";
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			 $sql = "update tbl_social_network  set status = 'N' where id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="Ads Deactivate Successfully.........";
		}		
	 }
	
} 
$start = intval(@$start);
$pagesize = intval(@$pagesize)==0? 20 : $pagesize;
$columns = "select * ";
$sql = " from tbl_social_network  ";
$sql.= "where 1 ";
$sql = apply_filter($sql, @$pd_name, @$u_name_filter,'pd_name');
@$order_by == '' ? $order_by = 'tbl_social_network.id' : true;
@$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 
 $sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?php echo PageTitle('Social Network');?>
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
		<a href="land.php?file=add_social_ads"><b>Add New Ads </b></a>
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

<div align="left"><b>We can recommend the Website  "Addthis.com"  to include Social Network Buttons.</b>
		</div><br>
      <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
          <tr>
             <th width="29%" align="center" >Title</th>
             <th width="27%" align="center"> Category </th>
             <th width="21%" align="left">Status</th>
			  <th width="18%" align="left"> </th>
			 
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
                         <td align="left"><?php echo ucfirst($title);?></td>
						 <td align="center" ><?php echo get_catinfo($cat_id,'cat_name');?></td>
						 <td align="center"><?php echo $rec_status;?></td>
				        <td align="center">
						<a href="?file=edit_social_adg&id=<?php echo $id?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
						
						<td align="center">
						<input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $id?>" /></td>
          </tr>
          <?php $k++; }?>
        </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="63%" align="right" style="padding:2px">
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