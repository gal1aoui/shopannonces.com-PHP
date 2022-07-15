<?php
require_once("../includes/main.inc.php");
require_once("../arrays.inc.php");
	
$action=@$_REQUEST['action'];

if($action=='Add'){
	$cat_level_root=@$_REQUEST['cat_level_root'];
	$cat_level_one=@$_REQUEST['cat_level_one'];
	$cat_level_two=@$_REQUEST['cat_level_two'];
	
	$option_id=htmlentities($_REQUEST['option_id'],ENT_QUOTES);
	$val_nom=htmlentities($_REQUEST['val_nom'],ENT_QUOTES);

	$ins=db_query("insert into ".DB.".tbl_value_option (option_id,val_nom)	values('$option_id','$val_nom')");
	$_SESSION['site_admin_message']="Value Added Successfully.........";
	
	header("Location:land.php?file=manage_value_option&option_id=$option_id&cat_level_root=$cat_level_root&cat_level_one=$cat_level_one&cat_level_two=$cat_level_two");
	exit();	
}
echo PageTitle('Add Option Categorie');?>
<script type="text/javascript" src="../js/ajax.js"></script>
<?php
	$option_id=@$_REQUEST['option_id'];
	$cat_level_root=@$_REQUEST['cat_level_root'];
	$cat_level_one=@$_REQUEST['cat_level_one'];
	$cat_level_two=@$_REQUEST['cat_level_two'];
	
	$res_opt=db_query("select * from tbl_option_cat WHERE option_id='".$option_id."'");	
	$line_raw = mysql_fetch_array($res_opt);
	@extract($line_raw);
	
?>
<table width="100%">
	<tr>
		<td  colspan="2" height="23"  align="right">
        	<a href="land.php?file=manage_option_cat&cat_level_root=<?php echo $cat_level_root;?>&cat_level_one=<?php echo $cat_level_one;?>&cat_level_two=<?php echo $cat_level_two;?>" class="redcolor">Back To Option Categories</a>
        </td>
	</tr>
</table>


<br />
<table border="0" width="50%">		
            	<tr>
                	<th align="left">Option Name</th>
                	<th align="left">Possible Value</th>
                </tr>
			<tr>
            	<td><?php echo $option_nom;?></td>
                    	
                <td>
                            <?php
								$res_val=db_query("select * from tbl_value_option WHERE option_id='".$option_id."'");
								
								if(mysql_num_rows($res_val)==0){
									echo "----";
								}
								else{
							?>
                            		<table>
							<?php
									while ($line_val = mysql_fetch_array($res_val)) {
									@extract($line_val);
										echo "<tr><td>".$val_nom."</td></tr>";
									}
									?>
                                    </table>
                                    <?php
								}
								?>
                    </td>
                </tr>
			
            <?php
		
		?>
        <tr>
        	<td colspan="2"><hr /></td>
        </tr>
		<form name="form4" method="get" action="manage_value_option.php">
			<input type="hidden" name="option_id" value="<?php echo $option_id;?>" />
			<input type="hidden" name="cat_level_root" value="<?php echo $cat_level_root;?>" />
			<input type="hidden" name="cat_level_one" value="<?php echo $cat_level_one;?>" />
			<input type="hidden" name="cat_level_two" value="<?php echo $cat_level_two;?>" />
			<tr>
				<td></td>
                <td>
					<input type="text" name="val_nom">
					<input type="submit" name="action" value="Add">
				</td>
			</tr>
		  </table>
		</form>
		<?php
	
?>

  