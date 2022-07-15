<?php

$start = intval(@$start);
$pagesize = intval(@$pagesize)==0?$pagesize=20:$pagesize;
$columns = "select * ";
$sql = " from tbl_config where 1  ";

@$order_by == '' ? $order_by = 'config_id':true;
@$order_by2 == '' ? $order_by2 = 'asc' : true;
$sql_count = "select count(*) ".$sql; 
$sql.= "order by $order_by $order_by2 ";
$sql.= "limit $start, ".$pagesize." ";
$sql = $columns.$sql;

$result = db_query($sql) or die($sql);	
$reccnt = db_scalar($sql_count);


?>
<?php echo PageTitle("Site Setting Management");?>
<table width="100%" align="center">
<tr><td>
      <?php
	  if(mysql_num_rows($result)==0){?>
      <div class="msg" align="center">Sorry, no setting exist.</div>
      <?php } else{ ?>  
      <div align="left">
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
						  <tr>
							<td align="left">Records Per Page:
        <?php echo pagesize_dropdown('pagesize', $pagesize);?></td>
							<td align="right">Showing Records:
        <?php echo  $start+1?>
        to
        <?php echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?>
        of
        <?php echo  $reccnt?></td>
		</tr>
		</table>

      </div>
      <form method="post" action="" name="form1" id="form1">
        	<table width="100%"  border="0" cellpadding="2" cellspacing="2" class="lightBorder2">
				<tr  class="lightGreenBg">
				  <td></td>
				  <td align="left">&nbsp;</td>
				  <td align="left">&nbsp;</td>
				  <td align="left">&nbsp;</td>
				</tr>
				<tr  class="lightGreenBg">
					<td width="4%"></td>
					<td width="21%" align="left"><strong>Setting</strong></td>
					<td width="2%" align="left">&nbsp;</td>
					<td width="73%" align="left"><strong>Set Values</strong></td>
				</tr>
				<?php
				$i=1;
				while ($line_raw = mysql_fetch_array($result)) {
					@extract($line_raw);
					if( ($config_id==9) || ($config_id==10) || ($config_id==11) ){
					   $cur="EUR ";
					 }else{
					   $cur="";
					 }
				
				 ?>
				<tr align="left" class="lightGrayBg" height="5">
				  <td height="5" colspan="4" valign="top"></td>
				</tr>
				<tr class="lightGrayBg" >
					<td align="center" valign="top" nowrap="nowrap">
						<?php echo $i+$start;?>.
					</td>
					<td align="left" valign="top" >
						<a href="land.php?file=edit_config&config_id=<?php echo $config_id?>" class="redcolor">
						<?php echo $config_name;?>
						</a>
					</td>
					<td align="left" valign="top" >&nbsp;	</td>   
					<td align="left" valign="top" >
						<?php
                        if($config_name=="Company logo"){ ?>
                    		<img src="<?php echo "../mobile/uploaded_files/logo/".$config_txt; ?>" width="422" height="118" />
                        <?php }
                        else{ 
                        	echo $cur.$config_txt;
                         } ?>
					</td>  
				</tr>
				<?php $i++;
				}
				?>
			</table>       
    <?php
	}
	 include_once("paging.inc.php");?> 
	  </form>
</table> 
	