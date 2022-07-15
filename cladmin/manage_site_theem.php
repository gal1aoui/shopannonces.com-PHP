<?php
$sql_dis=db_query("select * from tbl_theem ");
if(isset($_REQUEST['val']) && isset($_REQUEST['id']) ) {
	$featured=($_REQUEST['val']=="Y") ? "Set" : "Unset";
	$sql = "update tbl_theem SET theem_satus = '$_REQUEST[val]' where th_id=$_REQUEST[id] ";
	db_query($sql);
	
	$sql2 = "update tbl_theem SET theem_satus = 'N' where th_id!=$_REQUEST[id] ";
	db_query($sql2);
	
	$_SESSION['site_admin_message']=" Theme has been $featured successfully.";
	header("Location:land.php?file=manage_site_theem");
	exit();
}

?>
<?php echo PageTitle('Site Theme Management');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>	  
     </b>
		   
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
          <tr align="left">
             <th width="20%" height="22" >Site Color </th>
             <th width="23%">Set theem </th>
            
             <th width="28%">Status</th>
          </tr>
             <?php
			 while($rw=mysql_fetch_array($sql_dis)){
				 @extract($rw);	
				 $css = (@$css=='trOdd')?'trEven':'trOdd';		
				 $rec_status=($theem_satus  =='Y') ? "Active":"In-active";
				 $featured=($theem_satus =="Y") ? "Unset" : "Set"; 
				 $val=($theem_satus =="Y") ? "N" : "Y";		
			
             ?>
          <tr align="left" class="<?php echo $css?>">
                         <td>
						 <p><?php echo $theem_name;?></p>
						 </td>
						 <td><a href="land.php?file=manage_site_theem&id=<?php echo $th_id;?>&val=<?php echo $val;?>"><strong><?php echo $featured;?></strong></a></td>
						
		    </td>
						 <td><p><?php echo $rec_status;?></p>
		    </td>
	      </tr>  
		  <?php } ?>       
      </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">
			<!--<input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>-->                          <span class="txt12">
              </span>            </td>
            </tr>
        </table>
	</td>
  </tr>
</table>