<?php
$tp=$_REQUEST['news_type'];
if($_REQUEST['type']=="E")
{
$title="Event information";
$tp=$_REQUEST['type'];
}
if ($_REQUEST['type']=="A") {
$title="Articles";
$tp=$_REQUEST['type'];
}
if ($_REQUEST['type']=="M") {
$title="Market news";
$tp=$_REQUEST['type'];
}

/* SET news order */
	    if(isset($_REQUEST['Up_order']))
		 { 	
			   while(list($key,$val)=each($ord))
			   {
			   $sql="update ".DB.".tbl_news set r_order='$val' where news_id='$key' ";
			   db_query($sql);
			   }
	        $_SESSION['site_admin_message']=" Order updated Successfully....";
			header("Location:land.php?file=manage_news&type=$_REQUEST[type]");
	        exit();
	      }
		  
/* End  SET news order  */


if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)){
		$str_pd_ids = implode(',', $arr_pd_ids);
		 if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']))
		 {		  
			 $sql = "update ".DB.".tbl_news set news_status = 'Active' where news_id in ($str_pd_ids)";			
			 db_query($sql);
			 $_SESSION['site_admin_message']="News Activate Successfully.........";
		 }
		 else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) )
		 {
			$sql = "update ".DB.".tbl_news set news_status = 'Inactive' where news_id  in ($str_pd_ids)";
			db_query($sql);
			 $_SESSION['site_admin_message']="News Deactivate Successfully.........";
	     }	
		 		
		 else if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']))
		 {
				$selProduct=db_query("delete from tbl_news  where news_id  in ($str_pd_ids)");
				//@unlink($file_path);  
				$_SESSION['site_admin_message']="News Deleted successfully........";			
			}
		
			
   }
	header("Location:land.php?file=manage_news&type=$tp");
	exit();
}
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ".DB.".tbl_news ";
$sql .= " where news_type='$type'";
$order_by == '' ? $order_by = DB.'.tbl_news.news_id' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 

$sql .= "order by $order_by $order_by2 ";
 $sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?=PageTitle($title);?>
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
<tr align="right"><td> &lsaquo; <a href="javascript:history.back();">Back To List</a></td></tr>
		<br>
  <tr>
  	<td align="center"><br />
    <div align="right" class="paddingright">
	<a href="land.php?file=add_news&type=<?=$type;?>">Add <?=$title;?></a><br /></div>
    <div class="msg"><?php display_sess_msg();?></div> 		
		</b>
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
				  <th width="25%" align="center" nowrap="nowrap">News Title</th>
				  <th width="17%" align="center" nowrap="nowrap">News Date</th>
				  <th width="17%" align="center" nowrap="nowrap"> Order</th>
				  <th width="33%" align="center" nowrap="nowrap">Description</th>
				  <th width="7%" align="center" nowrap="nowrap">Status</th>
				  <th width="3%" align="center" nowrap="nowrap">Edit</th>
				  <th width="15%" align="center">
	   <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />					</th>
			  </tr>
				<?php
				$k=1;
				while ($line_raw = mysql_fetch_array($result)) {
				@extract($line_raw);
				$css = ($css=='trOdd')?'trEven':'trOdd';
				$rec_status=($news_status =='Active') ? "Active":"In-active";							
				?>
				<tr class="<?=$css?>">
				  <td align="center"><?=ucfirst($news_title);?>                  </td>
				  <td align="center" valign="top"><?=$news_date;?></td>
				  <td align="center" valign="top">
				  <input type="text" name="ord[<?=$news_id;?>]" value="<?=$r_order;?>" size="3" id="cat<?=$k;?>"></td>
				 <td align="center" valign="top"><?=truncateText($news_desc, 100, ' ', '...', true);?></td>
				  <td nowrap="nowrap" align="center"><?=$rec_status?></td>
					<td align="center">
		  <a href="land.php?file=edit_news&neID=<?=$news_id;?>&type=<?=$_REQUEST['type'];?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
	<td align="center"><input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?=$news_id;?>" /></td>
				</tr>
				<? $k++;} ?>
			</table>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
					<td width="61%" align="right" style="padding:2px">
					<input type="submit" name="Up_order" id="Up_order2"  value="Set Order" onClick=" return validateorder(this.form)" /></td>
		            <td width="39%" align="left" style="padding:2px"><input name="Activate" type="image" id="Activate2" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
                      <input name="Deactivate" type="image" id="Deactivate2" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>
                      <input name="Delete" type="image" id="Delete2" src="images/buttons/delete.gif" onclick="return deleteConfirmFromUser('arr_pd_ids[]')"/>                    </td>
		  </tr>
          </table>
    	</form>
    <? }?>
	<? include("paging.inc.php");?>
	</td>
  </tr>
</table>