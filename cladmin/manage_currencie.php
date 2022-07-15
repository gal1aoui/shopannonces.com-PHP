<?php
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
if(is_post_back()){
  $arr_pd_ids = $_REQUEST['arr_pd_ids'];
  $arr_ord=$_REQUEST['ord'];
  if(is_array($arr_pd_ids) || is_array($arr_ord) ){
		$str_pd_ids = implode(',', $arr_pd_ids);
		  /* Activate category */
			 if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x'])){	
				 $sql = "UPDATE tbl_currency  SET status = 'Active' WHERE curr_id in ($str_pd_ids)";			
				 db_query($sql);
				 $_SESSION['site_admin_message']="Currency Activated Successfully.........";
				 header("Location:land.php?file=manage_currencie&start=$start");
				 exit();		
			 }			 
			 /* Deactivate category */
			 if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x'])){	
		 $sql = "UPDATE tbl_currency SET status = 'Inactive' WHERE curr_id in ($str_pd_ids) AND curr_base!='Yes' ";			
				 db_query($sql);
				 $_SESSION['site_admin_message']="Currency Deactivated Successfully.........";
				 header("Location:land.php?file=manage_currencie&start=$start");
				 exit();		
			 }
			 
	      /******* Delete category */
			 if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x'])){			     	
		           $sql="DELETE FROM tbl_currency WHERE curr_id in ($str_pd_ids) AND curr_base!= 'Yes'";				
					 db_query($sql);				    
					 $_SESSION['site_admin_message']="Currency Deleted Successfully.........";
					 header("Location:land.php?file=manage_currencie&start=$start");
					 exit();
			 }
			 
			 /* Re Order category */
			 if(isset($_REQUEST['reorder']) || isset($_REQUEST['reorder_x'])){			    
			     foreach($arr_ord as $key=>$val){
				  $sql = "UPDATE tbl_currency set rec_order  = '$val' where curr_id=$key ";			
				  db_query($sql);				
				 }
				 $_SESSION['site_admin_message']="Currency Re Order  Successfully.........";
				 header("Location:land.php?file=manage_currencie&start=$start");
				 exit();		
			 }
		 
			 
	  }
		  
}

$sql ="SELECT SQL_CALC_FOUND_ROWS * FROM tbl_currency 
WHERE 1 order by rec_order limit $start, $pagesize ";
$result=db_query($sql);
$res_total = mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
$reccnt=$res_total['total'];
?>
<?=PageTitle('Manage Currency for PayPal');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
  	<td align="center"><br />
    <div align="right" class="paddingright">
	<a href="land.php?file=add_currencie">Add Currency</a><br /></div>   
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
				  <th width="14%" align="center" nowrap="nowrap"> Symbol </th>
				  <th width="17%" align="center" nowrap="nowrap">Currency Code </th>
				  <th width="21%" align="center" nowrap="nowrap">Value</th>
				  <th width="7%" align="center" nowrap="nowrap"> Order</th>
				  <th width="10%" align="center" nowrap="nowrap">Status</th>
				  <th width="14%" align="center" nowrap="nowrap">Edit</th>
				  <th width="5%" align="center">
	   <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />					</th>
			  </tr>
				<?php
				$k=1;
				while ($line_raw = mysql_fetch_array($result)) {
				@extract($line_raw);
				$css = ($css=='trOdd')?'trEven':'trOdd';										
				?>
				<tr class="<?=$css?>">
				  <td align="center"><?=html_entity_decode($curr_symbol);?>                  </td>
				  <td align="center" valign="top"><?=ucfirst($curr_code);?></td>
				  <td align="center" valign="top"><?=$curr_value;?></td>
				  <td align="center" valign="top">
				 <input type="text" name="ord[<?=$curr_id;?>]" value="<?=$rec_order;?>" size="3" id="cat<?=$k;?>"></td>
				 <td nowrap="nowrap" align="center"><?=$status?></td>
				 <?php if($curr_base== 'Yes'){ ?>
				 <td>Base Currency </td>
				 <? }else{ ?>
			<td align="center">
		  <a href="land.php?file=edit_currencie&neID=<?=$curr_id;?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
		  <? } ?>
	<td width="12%" align="center"><input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?=$curr_id;?>" /></td>
				</tr>
				<? $k++;} ?>
			</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td align="right" style="padding:2px">&nbsp;</td>
				  <td align="left" style="padding:2px">&nbsp;</td>
		  </tr>
				<tr bgcolor="#DBDBDB">
					<td width="56%" align="right" style="padding:2px">				   </td>
		            <td width="44%" align="left" style="padding:2px">
					<input name="reorder" type="image" id="reorder" src="images/buttons/btn_reorder.gif" onClick="return urlConfirmFromUser('arr_pd_ids[]')"/>
					<input name="Activate" type="image" id="Activate2" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
		              <input name="Deactivate" type="image" id="Deactivate2" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>
				   <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onclick="return deleteConfirmFromUser('arr_pd_ids[]')"/></td>
		  </tr>
          </table>
    	</form>
    <? }?>
	<? include("paging.inc.php");?>
	</td>
  </tr>
</table>