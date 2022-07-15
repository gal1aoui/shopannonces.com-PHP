<?php
	require_once("../includes/main.inc.php");
	
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)) {
		$str_pd_ids = implode(',', $arr_pd_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from tbl_newslattersubscriber    where subscr_id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="Member deleted Successfully.........";
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			$sql = "update  tbl_newslattersubscriber  set status = '1' where subscr_id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="Member Activated Successfully.........";
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			$sql = "update tbl_newslattersubscriber set status = '0' where subscr_id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="Member Deactivate Successfully.........";
		}
		else if(isset($_REQUEST['Send']) || isset($_REQUEST['Send_x']) ) {		
			header("Location:land.php?file=newsletter&ids=$str_pd_ids");
			exit();
		}
	
	}
	else if(@$_POST['action']=="ajouter"){
		$sel1=db_query("select * from tbl_newslattersubscriber  where subscr_email='$subscribe_email'");
		$num1=mysql_num_rows($sel1);
		if($num1 > 0){
			$update1=db_query("update tbl_newslattersubscriber set status='0' where subscr_email='$subscribe_email'");
			$_SESSION['site_admin_message']="La mise à jour d'email est effectuée avec succès, email est dans la liste de désinscription.";		
		}else{
			//$msg2="Vous n'êtes pas enregistrés pour recevoir notre liste d'envoi.";
			$ins=db_query("insert into tbl_newslattersubscriber(subscr_email,status) values('$subscribe_email','0')");
			$_SESSION['site_admin_message']="L'insertion d'email est effectuée avec succès.";		
		}
		header("Location: ".$_SERVER['HTTP_REFERER']);
		exit();
	}
}
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=10:$pagesize;
$columns = "select * ";
$sql = " from tbl_newslattersubscriber    ";
$sql.= "where 1 ";
//$sql.=" and ys_products.pd_catid=ys_product_category.cat_id ";

$sql = apply_filter($sql, $pd_name, $u_name_filter,'pd_name');

$order_by == '' ? $order_by = 'tbl_newslattersubscriber .subscr_id' : true;
$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 
 $sql .= "order by $order_by $order_by2 ";

$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);

?>
<?php echo PageTitle('Newsletter Subscriber List');?>


<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	<td align="center">
    	<form action="" method="post">
        	<input type="text" name="subscribe_email" id="subscribe_email" />
            <input type="submit" name="action" value="ajouter" />
        </form>
    </td>
</tr>
  <tr>
    <td>				
	<?php
	 if(mysql_num_rows($result)==0){ ?>
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
     		 <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
          <tr>
              <th width="21%" align="left" >Name</th>
			 <th width="59%" align="left" >Email</th>
             <th width="14%" align="left">Status </th>
			  <th width="6%">
			 <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />
			  </th>
          </tr>
					<?php
					while ($line_raw = mysql_fetch_array($result)) {
						$line = ms_display_value($line_raw);
						@extract($line);
						$css = ($css=='trOdd')?'trEven':'trOdd';
					?>
                      <tr class="<?php echo $css?>">
					    <td><?php echo $subscr_name;?></td>
                         <td><?php echo $subscr_email;?></td>
						 <td>
						 <?php 
						  if($status==1){
						 ?>
						 <b>Active</b>
						 <?php } else { ?>
						 <b>In-active</b>
						 <?php } ?>
						 </td>
					<td align="center">
				     <input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $subscr_id?>" /></td>
                   </tr>
          <?php }?>
        </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">
		    <input name="Send" type="image" id="Send" src="images/buttons/send.gif" onClick="return sendemailConfirmFromUser('arr_pd_ids[]')"/>
			<input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
            <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>
            <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_pd_ids[]')"/>
            </td>
		  </tr>
        </table>
            </form>
    <?php }?> 
 <?php include("paging.inc.php");?>    </td>
  </tr>
</table>