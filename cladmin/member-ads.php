<?php
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)) {
		$str_classified_ids = implode(',', $arr_pd_ids);
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
		 $sql = "update tbl_classified SET classified_status = 'Delete' where classified_id in ($str_classified_ids)";		
		  db_query($sql);
		   $_SESSION['site_admin_message']="Classifieds has been Deleted successfully.";
		    header("Location: ".$_SERVER['HTTP_REFERER']);
	        exit();
		}else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
		 $sql = "update tbl_classified SET classified_status = 'Active' where classified_id  in ($str_classified_ids)";
		   db_query($sql);		
		   $_SESSION['site_admin_message']="Classifieds has been activated successfully.";
		    header("Location: ".$_SERVER['HTTP_REFERER']);
	        exit();
		}else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {		
			$sql = "update tbl_classified set classified_status = 'Inactive' where classified_id in ($str_classified_ids)";			
			db_query($sql);		
			$_SESSION['site_admin_message']="Classifieds has been deactivated successfully.";	
			header("Location: ".$_SERVER['HTTP_REFERER']);
	        exit();
		}
	}
	
}
	$mem_id=$_REQUEST['mem_id'];

    $sql = "SELECT * FROM ".DB.".tbl_classified WHERE mem_id  =$mem_id AND classified_status!='Delete'";		
    $result=db_query($sql);
?>

        <br>

<table width="90%"  border="0" align="center" cellspacing="0" class="Datatable">
			<div class="msg"><?php echo display_sess_msg()?></div>
            <tr align="left">
            <?php
				$sql_mem = "SELECT * FROM ".DB.".tbl_member WHERE mem_id  =$mem_id";		
				$result_mem=db_query($sql_mem);
				$rm=mysql_fetch_array($result_mem);
			?>
                <th colspan="3"><strong><?php echo $rm['user_id']?> </strong> Classified</th>
            </tr>
          <tr>
	      	<td align="right" colspan="3"><a href="land.php?file=manage_classified">Back manage classified</a></td>
       	  </tr>
            <tr>
            	<td>
<form id="form1" name="form1" method="post" action="">
      <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
        <tr>
          <td></td>
          <td>Annonce ID</td>
          <th width="12%" align="center" >Poster Name 
            <?php echo sort_arrows('classified_poster_name');?>
          </th>
	     
          <th width="9%" align="center" >Poster Email <?php echo sort_arrows('classified_poster_email');?> </th>
          <th width="9%" align="center" >Posted Date 
     
          <th width="11%" align="center" >Final Category </th>
          <th width="24%" align="center" >Classified Title </th>
          <th width="10%" align="center" >Payment status </th>
          <th width="5%" align="center" >View Details</th>
          <th width="6%" align="center" >Featured</th>
          <th width="7%" align="center" >Status
          <?php echo sort_arrows("classified_status");?></th>
          <th>Nbre visited</th>
          <th>Nbre Contact</th>
          <th width="7%" align="center">
            <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />
          </th>
        </tr>
		<?php
			$cn=1;
			while ($line_raw = mysql_fetch_array($result)) 
		 {				  
		   @extract($line_raw);
		   $css = ($css=='trOdd')?'trEven':'trOdd';
		   $featured=($classified_featured =="Yes") ? "Unset" : "Set";
		   $val=($classified_featured =="Yes") ? "No" : "Yes";
		?>
        <tr class="<?php echo $css;?>">
        	<th>
            	<?php echo $cn++;?>
            </th>
        	<td>
            	<?php echo $classified_id;?>
            </td>
			<td align="center">
            	<a href="javascript:poptastic('userDetail.php?id=<?php echo $mem_id; ?>');">
					<?php echo $classified_poster_name;?>            
				</a>
			</td>
			<td align="center"><?php echo $classified_poster_email;?></td>
			<td align="center"><?php echo $classified_post_date;?></td>
			<td align="left"><?php echo get_catinfo($clsd_sub_subcat_id,'cat_name');?></td>
			<td align="left"><?php echo ucfirst(truncateText($classified_title,80,' ','...',true));?></td>
			<td align="left"><?php echo $paid_status;?><br>
					<?php if($paid_status=="Pending")
					{?>
					  <a href="land.php?file=manage_classified&recv=<?php echo $classified_id;?>">Set Received</a>
					<?php }
					if($paid_cat_amount!="0.00"){
				   echo "Amount: ".CURR.$paid_cat_amount;
				  }
				  ?>
			</td>
			<td align="center">
            	<a href="land.php?file=classified_details&clsId=<?php echo $classified_id ; ?>" rel="facebox">
                	<b><font color="#FF0000">Click</font></b>
                </a>
            </td>
			<td align="center">
			   <?php if($classified_featured=="No") { ?>
					<a href="pop_feature.php?id=<?php echo $classified_id;?>&val=<?php echo $val;?>" rel="facebox">
						<strong><?php echo $featured;?></strong>
					</a>
				 <?php }else
				{ ?>
				  <a href="land.php?file=manage_classified&id=<?php echo $classified_id;?>&val=<?php echo $val;?>">
				   <strong><?php echo $featured;?></strong></a>
			   <?php }
			   if($feature_expired_date!="0000-00-00" && $classified_featured=="Yes" ) {
				 echo"<br> Expire on :  ".$feature_expired_date;
				}
				else
				{ echo ""; }
				if($feature_admount!="0.00") {
					echo "Amount: ".CURR.$feature_admount;
				}
				   ?>
			</td>
			<td align="center">
				<?php if($classified_status =='Active'){ echo "Active"; } else { echo "In-active";}?>
			</td>
            <td>
            	<?php echo $visites=classified_visits($classified_id); ?>
            </td>
            <td>
            	<?php echo $contact=classified_contacts($classified_id); ?>
            </td>
			<td align="center">
				<input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $classified_id;?>" />
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
   </td>
   </tr>
   </table>