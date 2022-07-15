<?php

require 'geoip/geoipcity.inc.php';
$database = geoip_open('geoip/GeoLiteCity.dat',GEOIP_STANDARD);

if(is_post_back()) {
	$arr_pd_ids = @$_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)) {
		$str_pd_ids = implode(',', $arr_pd_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "delete from tbl_member where  mem_id in ($str_pd_ids)";
			db_query($sql);
			
			$sql = "delete from tbl_classified where mem_id in ($str_pd_ids)";		
		    db_query($sql);
			
			$_SESSION['site_admin_message']="Member Deleted Successfully.........";
			header("Location: ".$_SERVER['HTTP_REFERER']);
	         exit;
		} else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
			echo $sql = "update tbl_member   set mem_status = 'Y' where mem_id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="Member Activated Successfully.........";
			header("Location: ".$_SERVER['HTTP_REFERER']);
	        exit;
		} else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {
			 $sql = "update tbl_member set mem_status = 'N' where mem_id in ($str_pd_ids)";
			db_query($sql);
			$_SESSION['site_admin_message']="Member Deactivated Successfully.........";
			header("Location: ".$_SERVER['HTTP_REFERER']);
	       exit;
		}
	}
	  
}
$key=@$_REQUEST['keyword'];
$start = intval(@$start);
$pagesize = intval(@$pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql= " from tbl_member  ";
$sql.= "where 1 ";
if($key!=""){
  $sql.="and (comp_name LIKE '%$key%' or fname LIKE '%$key%' or lname  LIKE '%$key%' or fname  LIKE '%$key%' or email LIKE '%$key%' or tel_no LIKE '%$key%')"; 
}
$sql = apply_filter($sql, @$pd_name, @$u_name_filter,'pd_name');
@$order_by == '' ? $order_by = 'tbl_member.mem_id' : true;
@$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 
$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);

$reccnt = db_scalar($sql_count);
?>
<?php echo PageTitle('Manage Member');?>
<script language="javascript">
var win = null;
function NewWindow(mypage,myname,w,h,scroll){
LeftPosition = (screen.width) ? (screen.width-w)/2 : 0;
TopPosition = (screen.height) ? (screen.height-h)/2 : 0;
settings =
'height='+h+',width='+w+',top='+TopPosition+',left='+LeftPosition+',scrollbars='+scroll+',resizable'
win = window.open(mypage,myname,settings)
}

</script>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
 <tr>
  <td>
  <table width="80%"  border="0" align="center" cellpadding="6" cellspacing="2" class="lightBorder">
 <tr>
  <td class="lightGrayBg" align="left"><b>Search Member</b>&nbsp;
  <form name="ffff" method="post" action="land.php?file=manage_member">
      Keyword: [Name, Company name,email,phone Wise]&nbsp;
      <input type="text" name="keyword" class="input" size="50" value="<?php echo $key; ?>">
      <input type="submit" class="button" name="msearch" value="Search">	  
  </form>
  </td>
 </tr>
</table></td>
 </tr>
  <tr>
    <td>	  
     </b>
		<div align="right" > 
		</div>
		<br>
			<?php
			if(mysql_num_rows($result)==0){?>
		<div class="msg">Sorry, no records found.</div>
			<?php } else{ ?>
		<div align="right"> Showing Records:
			<?php echo $start+1?>
		to
			<?php echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>
		of
			<?php echo  $reccnt?>
		</div>
		<div align="left">Records Per Page:
			<?php echo pagesize_dropdown('pagesize', $pagesize);?>
		</div>
		<br>
      <form method="post" name="form1" id="form1" onSubmit="confirm_submit(this)">
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
        <tr>
             <th width="11%" align="center" >Name
             <?php echo sort_arrows('fname')?></th>
			  <th width="13%" align="center" >Email <?php echo sort_arrows('email')?></th>
			  <th width="18%" align="center" >Type <?php echo sort_arrows('type')?></th>
		      <th width="13%" align="center" >City</th>
	          <th align="center" >Address</th>
	          <th width="20%" align="center" >Tel N°</th>
	          <th width="10%" align="center" >Register Date</th>
	          <th width="20%" align="center" >Ip Address</th>
		    <th width="7%" align="center" >View Details</th>
		    <th width="7%" align="center" >Solde <?php echo sort_arrows('solde')?></th>
		    <th width="7%" align="center" >Status <?php echo sort_arrows('mem_status')?></th>
		    <th width="9%" align="center">
			 <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />
		    </th>
          </tr>
				<?php
				 while ($line_raw = mysql_fetch_array($result)) {
					@extract($line_raw);
					$css = (@$css=='trOdd')?'trEven':'trOdd';
				?>
          <tr class="<?php echo $css?>">
            <td align="center">
            <a href="javascript:poptastic('userDetail.php?id=<?php echo $mem_id; ?>');">
            <?php echo ucfirst($fname);?>,<?php echo ucfirst($lname);?></a></td>
            <td align="center"><?php echo $user_id?></td>
            <td align="center"><?php echo $type;?></td>
            <td align="center"><?php echo $city;?></td>
            <td align="center"><?php echo $address;?></td>
            <td align="center"><?php echo $tel_no;?></td>
            <td align="center"><?php echo $reg_date;?></td>
            <td align="center">
				<?php echo $adresse_ip;			
                $record = geoip_record_by_addr($database, $adresse_ip);
                // affiche les informations récupérées dans la base
                echo " (".$record->continent_code." -> ".$record->country_name." -> ".$record->region." -> ".$record->city." -> ".$record->postal_code." ) ";
                ?>
			</td>
		    <td align="center"><a href="javascript:poptastic('userDetail.php?id=<?php echo $mem_id; ?>');"><b><font color="#FF0000">Click</font></b></a></td>
			<td align="center"><?php echo $solde;?> </td>
            
			<td align="center">
				<?php
				if($mem_status=='Y'){ echo "Active"; } else { echo "In-active";}?>
            </td>
  <td align="center">
			  <input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $mem_id?>" />
			  </td>
                   </tr>
          <?php }?>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">
			<input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/> 
                          <input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_pd_ids[]')"/>
		    </td>
          </tr>
        </table>
      </form>
    <?php }
	include("paging.inc.php");?>
    </td>
  </tr>
</table>