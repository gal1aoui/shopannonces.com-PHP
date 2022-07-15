<?php
	require_once("../includes/main.inc.php");
	
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)) {
		$str_pd_ids = implode(',', $arr_pd_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from ".DB.".tbl_meta_tags  where id in ('$str_pd_ids')";
			db_query($sql);
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			echo $sql = "update ".DB.".tbl_meta_tags set page_status = '1' where id in ('$str_pd_ids')";
			db_query($sql);
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			 $sql = "update ".DB.".tbl_meta_tags set page_status = '0' where id in ('$str_pd_ids')";
			db_query($sql);
		}
	}
	  header("Location: ".$_SERVER['HTTP_REFERER']);
	exit;
}
$start = intval(@$start);
$pagesize = intval(@$pagesize)==0?$pagesize=15:$pagesize;
$columns = "select * ";
$sql = " from tbl_meta_tags  ";
$sql.= "where 1 ";
//$sql.=" and ys_products.pd_catid=ys_product_category.cat_id ";

$sql = apply_filter($sql, @$pd_name, @$u_name_filter,'pd_name');

@$order_by == '' ? $order_by = 'tbl_meta_tags.page_name ' : true;
@$order_by2 == '' ? $order_by2 = 'asc' : true;
$sql_count = "select count(*) ".$sql; 
 $sql .= "order by $order_by $order_by2 ";

$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>
<?php echo PageTitle('Manage Meta Content');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>   
			<?php
			 if(mysql_num_rows($result)==0){?>
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
		</div><br />
		<?php $req=@$_REQUEST['req'];
		 if($req!=''){ ?>
		  <div class="msg">Information added successfully</div>
		<?php } ?>
      <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
        
      <tr>
             <th width="18%" height="28" align="left" >Page Name </th>
            <th width="6%" align="left"> </th>
	      </tr>
          <?php
while ($line_raw = mysql_fetch_array($result)) {
	//$line = ms_display_value($line_raw);
	@extract($line_raw);
    $css = (@$css=='trOdd')?'trEven':'trOdd';
  ?>
          <tr class="<?php echo $css?>">
                         <td align="left"><?php echo ucfirst(strtolower($page_name));?></td>
 <td align="center">
						<a href="land.php?file=edit_meta_tags&id=<?php echo $id;?>"><img src="images/icons/edit.png" alt="Edit" width="16" height="16" border="0" /></a></td> 
		  </tr>
          <?php }?>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">			
          </tr>
        </table>
      </form>
    <?php }?> <? include("paging.inc.php");?>    </td>
  </tr>
</table>