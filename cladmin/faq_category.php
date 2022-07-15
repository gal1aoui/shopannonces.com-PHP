<?php
$Parent_id=isset($_REQUEST['parentId']) ? $_REQUEST['parentId']  : "0";

/* SET category order */
	    if(isset($_REQUEST['Up_order']))
		 { 	
			   while(list($key,$val)=each($ord))
			   {
			   $sql="update ".DB.".tbl_category_faq set cat_order='$val' where cat_id='$key' ";
			   db_query($sql);
			   }
	        $_SESSION['site_admin_message']="Category Order updated Successfully....";
			header("Location:land.php?file=faq_category");
	        exit();
	      }
		  
/* End  SET category order  */

if(is_post_back()){
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){
		$str_pd_ids = implode(',', $arr_pd_ids);
		 if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']))
		 {		  
			 $sql = "update ".DB.".tbl_category_faq set cat_status = 'Y' where cat_id in ($str_pd_ids)";			
			 db_query($sql);
			 $_SESSION['site_admin_message']="Category Activate Successfully.........";
		 }
		 else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) )
		 {
			$sql = "update ".DB.".tbl_category_faq  set cat_status = 'N' where cat_id    in ($str_pd_ids)";
			db_query($sql);
			 $_SESSION['site_admin_message']="Category Deactivate Successfully.........";
	     }		 		 		
		 if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']))
		 {		   
		    $sel_cat=db_query("select * from tbl_category_faq where cat_parent  in ($str_pd_ids)");
			$num1=mysql_num_rows($sel_cat);												
			$sel_prod=db_query("select * from tbl_products where product_catid in ($str_pd_ids)");
			$num2=mysql_num_rows($sel_prod);
			if(($num1==0)&&($num2==0)){
				$selProduct=db_query("delete from tbl_category_faq where cat_id  in ($str_pd_ids)");
				//@unlink($file_path);  
				$_SESSION['site_admin_message']="Category Deleted successfully";			
			}else
			{
		     $_SESSION['site_admin_message']="First Delete Subcategory/Product of this category";
		     }
		}
			
	 }
	header("Location:land.php?file=faq_category");
	exit();
}

$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ".DB.".tbl_category_faq";
$sql .= " where cat_parent='$Parent_id'";
$order_by == '' ? $order_by = DB.'.tbl_category_faq.cat_order' : true;
$order_by2 == '' ? $order_by2 = 'asc' : true;
$sql_count = "select count(*) ".$sql;

$sql .= "order by $order_by $order_by2 ";
 $sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?=PageTitle('Faq Category Lists'); ?>
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

<div align="left"><?php page_nav($Parent_id);?></div>	
<tr align="right"><td><!--<a href="javascript:history.back();">Back To List</a>--></td></tr>
<br>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td>
<!--
<table width="80%"  border="0" align="center" cellpadding="6" cellspacing="2" class="lightBorder">
 <tr>
  <td class="lightGrayBg" align="left"><b>Search Product</b>&nbsp;
  <form name="ffff" method="post" action="land.php?file=products">
  Keyword: [Name, Code  Wise]&nbsp;
  <input type="text" name="keyw" class="input" size="50" value="">
  <input type="submit" class="button" name="msearch" value="Search">	  
  </form>
  </td>
 </tr>
</table>
-->
</td></tr>
  <tr>
  	<td align="center"><br />
    <div align="right" class="paddingright">
	<a href="?file=add_category_faq">Add New Faq Category</a><br /></div>
    <div class="msg"><?php display_sess_msg();?></div> 		
		</b>
		<div align="right" class="paddingright"></div><br />
		  <? if(mysql_num_rows($result)==0){?>
		<div class="msg">Sorry, no records found.</div>
		<? } else{ ?>
		<div align="right" class="paddingright"> Showing Records:
			<?= $start+1?>
		to
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
				  <th width="17%" align="center" nowrap="nowrap">Category Name</th>
				 
				
				  <th width="14%" align="center" nowrap="nowrap">Category Order  </th>
				  <th width="12%" align="center" nowrap="nowrap">Status</th>
				  <th width="4%" align="center" nowrap="nowrap">Edit</th>
				  <th width="14%" align="center">
	   <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />					</th>
			  </tr>
				<?php
				$k=1;
				while ($line_raw = mysql_fetch_array($result)) {
				@extract($line_raw);
				$css = ($css=='trOdd')?'trEven':'trOdd';
				$rec_status=($cat_status =='Y') ? "Active":"In-active";
				
				$chk_parent=check_parent($cat_id);
				$chk_product_exits=check_product_exits($cat_id);
								
				$file_path=SITE_FS_PATH."/uploaded_files/cat_img/".$cat_image;
				$file_name=SITE_WS_PATH."/uploaded_files/cat_img/".$cat_image;
				$no_img=SITE_WS_PATH."/images/notavailable.jpg";				
				$img=(file_exists($file_path) && $cat_image!="") ?  $file_name : $no_img ;				
				?>
				<tr class="<?=$css?>">
				  <td align="center"><?=ucfirst($cat_name);?>                  </td>
				
				
				  <td align="center"><input type="text" name="ord[<?=$cat_id;?>]" value="<?=$cat_order;?>" size="3" id="cat<?=$k;?>">  </td>
				  <td nowrap="nowrap" align="center"><?=$rec_status?></td>
					<td align="center">
		  <a href="?file=edit_category_faq&parentId=<?=$cat_id;?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
	<td align="center"><input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?=$cat_id ;?>" /></td>
				</tr>
				<? $k++; } ?>
			</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="61%" align="right" style="padding:2px">
				<input type="submit" name="Up_order" id="Up_order"  value="Set Order" onClick=" return validateorder(this.form)" /></td>
		            <td width="39%" align="left" style="padding:2px"><input name="Activate" type="image" id="Activate2" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
		              <input name="Deactivate" type="image" id="Deactivate2" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>
	                <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onclick="return deleteConfirmFromUser('arr_pd_ids[]')"/></td>
		  </tr>
          </table>
    	</form>
    <? }?>	
	</td>
  </tr>
</table>