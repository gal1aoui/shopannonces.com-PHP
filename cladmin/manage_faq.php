<?php
	require_once("../includes/main.inc.php");
	
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){
		$str_pd_ids = implode(',', $arr_pd_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from ".DB.".tbl_faq    where faq_id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="FAQ deleted Successfully.........";
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update ".DB.".tbl_faq set page_status = '1' where faq_id in ($str_pd_ids)";
			db_query($sql);			
			$_SESSION['site_admin_message']="FAQ Activated Successfully.........";
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			 $sql = "update ".DB.".tbl_faq  set page_status = '0' where faq_id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="FAQ Deactivate Successfully.........";
		}		
	 }
	 else if(isset($_REQUEST['Up_order']) || $_REQUEST['Up_order']!=""){				
		   while(list($key,$val)=each($ord))
		   {
		   $sql="update ".DB.".tbl_faq set rec_order='$val' where faq_id='$key' ";
		   db_query($sql);
		   }
		$_SESSION['site_admin_message']="Faq Order updated Successfully....";
  }
} 
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ".DB.".tbl_faq  ";
$sql .= "where 1 ";
$sql = apply_filter($sql, $pd_name, $u_name_filter,'pd_name');
$order_by == '' ? $order_by = DB.'.tbl_faq.rec_order' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 
 $sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?php echo PageTitle('Faq Management');?>
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>	  
     </b>
		<div align="right" > <br>
		<a href="land.php?file=add_faq"><b>Add New Faq </b></a>
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
			<?php echo pagesize_dropdown('pagesize', $pagesize);?>
		</div><br>
      <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
          <tr>
             <th width="34%" align="center" >Question </th>
             <th width="6%" align="center"> Order </th>
             <th width="41%" align="center">Answer </th>
			  <th width="7%" align="left">Status</th>
			  <th width="4%" align="left"> </th>
			 
			  <th width="8%">
			 <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />
			  </th>
          </tr>
             <?php
			 $k=1;
			 while ($line_raw = mysql_fetch_array($result)) {				
			 @extract($line_raw);
			 $css = ($css=='trOdd')?'trEven':'trOdd';
			 $rec_status=($page_status  =='1') ? "Active":"In-active";			 
             ?>
          <tr class="<?php echo $css?>">
                         <td align="left"><?php echo ucfirst($faq_quest);?></td>
						 <td align="center" >
		<input type="text" name="ord[<?php echo $faq_id;?>]" value="<?php echo $rec_order;?>" size="2" id="cat<?php echo $k;?>"></td>
						 <td align="center" ><?php echo strip_tags(html_entity_decode(substr($faq_ans,0,500)));?></td>
						 
					     <td align="center"><?php echo $rec_status;?></td>
				        <td align="center">
						<a href="?file=edit_faq&faq_id=<?php echo $faq_id?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
						
						<td align="center">
						<input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $faq_id?>" /></td>
          </tr>
          <?php $k++; }?>
        </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="63%" align="right" style="padding:2px">
			<!--<input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>-->
                          <input type="submit" name="Up_order" id="Up_order"  value="Set Order" onClick=" return validateorder(this.form)" /> </td>
            <td width="37%" align="left" style="padding:2px"><span class="txt12">
              <input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>
              </span>
            <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_pd_ids[]')"/></td></tr>
        </table>
      </form>
    <?php }
	include("paging.inc.php");?></td>
  </tr>
</table>