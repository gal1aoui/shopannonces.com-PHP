<?php
require_once("../includes/main.inc.php");
$Parent_id=isset($_REQUEST['parentId']) ? $_REQUEST['parentId']  : "0";
$title_page=($Parent_id > 0 ) ? "Sub Category" : "Category";
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=10:$pagesize;

if(is_post_back()){
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){
		$str_pd_ids = implode(',', $arr_pd_ids);
		 if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x'])) {	
		     $sql = "update ".DB.".tbl_category set cat_status = 'Y' where cat_id in ($str_pd_ids)";			
			 db_query($sql);
			 $_SESSION['site_admin_message']="Category Activate Successfully.........";
		 }
		  else if(isset($_REQUEST['catPaid']) && $_REQUEST['catPaid']!="") {	
		     $sql = "update ".DB.".tbl_category set cat_paid  = 'Paid' where cat_id in ($str_pd_ids)";			
			 db_query($sql);
			 $_SESSION['site_admin_message']="Category Set Paid Successfully.........";
		 }
		   else if(isset($_REQUEST['catFree']) && $_REQUEST['catFree']!="") {	
		     $sql = "update ".DB.".tbl_category set cat_paid  = 'Free' where cat_id in ($str_pd_ids)";			
			 db_query($sql);
			 $_SESSION['site_admin_message']="Category Set Free Successfully.........";
		 }
		 else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			 $sel_cat=db_query("select * from tbl_category where cat_parent  in ($str_pd_ids) and cat_status='Y' ");
			 $num1=mysql_num_rows($sel_cat);
             $num2= check_classified_exits($str_pd_ids);
              if(($num1==0 && $num2==0)){
			   $sql = "update ".DB.".tbl_category  set cat_status = 'N' where cat_id    in ($str_pd_ids)";
				 db_query($sql);
				 $_SESSION['site_admin_message']="Category Deactivated  Successfully ";
                }else{                    
                 $_SESSION['site_admin_message']="First  Deactivate Subcategory/Classifieds OF This Category ";
              }	
	     }		 		 		
		 if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x'])) {		   
		  
		      $sel_cat=db_query("select * from tbl_category where cat_parent  in ($str_pd_ids)");			
			  $num1= mysql_num_rows($sel_cat);
              $num2= check_classified_exits($str_pd_ids);	
				
			if(($num1==0 && $num2==0)){
				$selProduct=db_query("delete from tbl_category where cat_id  in ($str_pd_ids) and cat_parent!=0 ");				
				$_SESSION['site_admin_message']="Category Deleted successfully";
			 }else{
		     $_SESSION['site_admin_message']="First Delete Subcategory/Classifieds OF This Category";
		    }
		}
			
	 }
	 else if(isset($_REQUEST['Up_order']) || $_REQUEST['Up_order']!=""){				
		   while(list($key,$val)=each($ord)){
		   $sql="update ".DB.".tbl_category set cat_order='$val' where cat_id='$key'";
		   db_query($sql);
		   }
		  $_SESSION['site_admin_message']="Category Order updated Successfully....";
  }
	
}
$key=$_REQUEST['keyw'];
$columns = "select * ";
$sql = " from ".DB.".tbl_category";
$sql .= " where 1 ";
if($key!=""){
  $sql.="and (cat_name LIKE '%$key%')";  
}else{
$sql .= " and cat_parent='$Parent_id'";
}
$order_by == '' ? $order_by = DB.'.tbl_category.cat_order' : true;
$order_by2 == '' ? $order_by2 = 'asc' : true;
$sql_count = "select count(*) ".$sql;

$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?php echo PageTitle('Category Lists'); ?>
<div align="left"><?php page_nav($Parent_id);?></div>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td><table width="80%"  border="0" align="center" cellpadding="6" cellspacing="2" class="lightBorder">
 <tr>
  <td class="lightGrayBg" align="left"><b>Search Category </b>
    <form name="ffff" method="get" action="land.php?file=catalog">
  Keyword: [Name  Wise]&nbsp;
  <input type="hidden" name="file" class="input" size="50" value="catalog">
  <input type="text" name="keyw" class="input" size="50" value="">
  <input type="submit" class="button" name="msearch" value="Search">	  
  </form>
  </td>
 </tr>
</table></td></tr>
  <tr>
  	<td align="center"><br />
    <div align="right" class="paddingright">
	<?php if($_REQUEST[parentId]!="" and $_REQUEST[parentId]!=0){ ?>
	<a href="?file=add_category&parentId=<?php echo $Parent_id;?>">Add <?php echo $title_page;?></a><br />
	<?php }else{?>
	<a href="?file=add_cat">Add Category</a><br />
	<?php }?>
	</div>
    <div class="msg"><?php display_sess_msg();?></div> 		
		</b>
		<div align="right" class="paddingright"></div><br />
		  <?php if(mysql_num_rows($result)==0){?>
		<div class="msg">Sorry, no records found.</div>
		<?php } else{ ?>
		<div align="right" class="paddingright"> Showing Records:
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
				  <th width="17%" align="center" nowrap="nowrap">Category Name <?php echo $count;?></th>
                  <?php if($count_level!=3){ ?>
				  <th width="16%" align="center" nowrap="nowrap">Add Subcategory</th>
                  <?php } ?>
				  <th width="14%" align="center" nowrap="nowrap">Category Order  </th>
				  <th width="12%" align="center" nowrap="nowrap">Status</th>
				  <th width="4%" align="center" nowrap="nowrap">Edit</th>
				  <th width="14%" align="center">
	   <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />					       </th>
			  </tr>
				<?php
				$k=1;
				while ($line_raw = mysql_fetch_array($result)) {
				@extract($line_raw);
				$css = ($css=='trOdd')?'trEven':'trOdd';
				$rec_status=($cat_status =='Y') ? "Active":"In-active";				
				$chk_parent=check_parent($cat_id);				
				?>
				<tr class="<?php echo $css?>">
				  <td align="center"><?php echo $cat_name;?>
				 <strong> <p><?php if($Parent_id== 0){ echo $cat_paid; } ?></p></strong>
				   <?php if($count_level==3){ echo "[".check_classified_exits($cat_id)."]"; } ?>
			      </td>
                  <?php if($count_level!=3){ ?>				 
                 <td align="center" valign="top">				
				 <a href="?file=add_category&parentId=<?php echo $cat_id;?>">Add Sub Category</a><br />				
				 <br />
				 <?php if($chk_parent > 0 ) { ?>
				 <a href="?file=catalog&parentId=<?php echo $cat_id;?>">View Sub Category</a>
				 <?php } ?>
				 <br />
				 <br />			 
				 </td>
                 <?php } ?>
				  <td align="center">
			<input type="text" name="ord[<?php echo $cat_id;?>]" value="<?php echo $cat_order;?>" size="3" id="cat<?php echo $k;?>">  </td>
				  <td nowrap="nowrap" align="center"><?php echo $rec_status?></td>
					<td align="center">
		  <a href="?file=edit_category&parentId=<?php echo $Parent_id;?>&rId=<?php echo $cat_id;?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
	<td align="center"><input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $cat_id;?>" /></td>
				</tr>
				<?php $k++; } ?>
			</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td align="right" style="padding:2px">&nbsp;</td>
				  <td align="left" style="padding:2px">&nbsp;</td>
		  </tr>
				<tr>
					<td width="57%" align="right" style="padding:2px">
				<input name="Up_order" type="submit" id="Up_order" onclick="return validateorder(this.form);"  value="Set Order" />
				
				 <?php if($Parent_id== 0){ ?>
				 <input type="submit" name="catPaid" id="paid"  value="Set Paid" onClick="return urlConfirmFromUser('arr_pd_ids[]')" />
				    <input type="submit" name="catFree" id="catFree"  value="Set Free" onClick="return urlConfirmFromUser('arr_pd_ids[]')" />
<?php } ?>
</td>
<td width="43%" align="left" style="padding:2px">
					<input name="Activate" type="image" id="Activate2" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
		              <input name="Deactivate" type="image" id="Deactivate2" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>
					  <?php if($Parent_id > 0){ ?>
	               <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onclick="return deleteConfirmFromUser('arr_pd_ids[]')"/>			   
				    <?php } ?> </td>
		  </tr>
          </table>
    	</form>
    <?php }?>
	<?php include("paging.inc.php");?>	
	</td>
  </tr>
</table>