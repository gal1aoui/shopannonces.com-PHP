<?php
require_once("../includes/main.inc.php");
require_once("../arrays.inc.php");
	
$action=@$_REQUEST['action'];

if($action=='Add'){
	$cat_level_root=htmlentities($_REQUEST['cat_level_root'],ENT_QUOTES);
	$cat_level_one=htmlentities($_REQUEST['cat_level_one'],ENT_QUOTES);
	$cat_level_two=htmlentities($_REQUEST['cat_level_two'],ENT_QUOTES);
	$option_name=htmlentities($_REQUEST['option_name'],ENT_QUOTES);

	$ins=db_query("insert into ".DB.".tbl_option_cat (cat_id,option_nom)
	values('$cat_level_two','$option_name')");
	$_SESSION['site_admin_message']="Option Added Successfully.........";
	
	header("Location:land.php?file=manage_option_cat&cat_level_root=$cat_level_root&cat_level_one=$cat_level_one&cat_level_two=$cat_level_two");
	exit();	
}
?>
<script language="javascript">
function validate()
 {
if(document.form1.faq_quest.value == "")
  {
   alert("Please enter nom de la variable.")
   document.form1.faq_quest.focus()
   return false;
  }
  if(document.form1.category.value == "")
  {
   alert("Please enter faq Category.")
   document.form1.category.focus()
   return false;
  }
 }
</script>
<?php echo PageTitle('Add Option Categorie');?>
<form method="get" name="form2" id="form2"  action="" >
        <br>
        <table width="90%"  border="0" align="center" cellspacing="0" class="Datatable">
			<div class="msg"><?php echo display_sess_msg()?></div>
            <tr align="left">
                <th colspan="3"></th>
            </tr>
            <tr>
				<td width="23%" align="left" class="tdLabel">
					<strong> </strong>
				</td>
				<td colspan="2" align="left" class="tdLabel">
                <td align="center" class="tdLabel">&nbsp;</td>
          </tr>
       </table>
</form>
<form name="form3" method="get" action="">
	 <table width="100%"  border="0" align="center" bgcolor="#D8D8D8">
	   <tr>
	     <td  align="left"><strong>Sort by:</strong></td>
	     <td   align="left"><strong>Category :</strong></td>
	     <td align="left"><strong>Subcategory : </strong></td>
	     <td  align="left"><strong>Sub subategory :</strong></td>
	     <td align="left"><input type="hidden" name="file" value="manage_option_cat"></td>
       </tr>
	   <tr>
			<td align="left">&nbsp;</td>
			<td align="left"><select name="cat_level_root" onChange="Acat_drop_down(this.value,'')">
				<?php echo Root_cat($_REQUEST['cat_level_root']);?>
				</select>
				<?php
				if(@$_REQUEST['cat_level_root']!="") { ?>
					<script language="javascript">
						Acat_drop_down('<?php echo $_REQUEST['cat_level_root'];?>','<?php echo $_REQUEST['cat_level_one'];?>')
					</script>
			<?php } ?>		
			</td>
			<td align="left">
				<div id="cat_tree1">
					<select name='cat_level_one' class='textbox1' onChange="Acat_drop_down2(this.value,'')" />
						<option value="">Select subcategory</option>
					</select>
				</div>
				<?php
				if(@$_REQUEST['cat_level_one']!="") { ?>
					<script language="javascript">
						Acat_drop_down2('<?php echo $_REQUEST['cat_level_one'];?>','<?php echo $_REQUEST['cat_level_two'];?>')
					</script>
				<?php } ?>
			</td>
			<td  align="left">
				<div id="cat_tree2">
					<select name="cat_level_two" id="cat_level_two" class="textbox1" >
						<option value="">Select Sub subcategory</option>
					</select>
				</div>
			</td>
			<td align="left">
				<input type="submit" name="Submit" value=" Go ">
			</td>
       </tr>
	   <tr>
    	   <td width="7%"  align="left">&nbsp;</td>
    	   <td width="25%"   align="center">&nbsp;
   	      </td>
  	       <td width="31%" align="center">
  	           <div id="cat_tree1">		     </div>				  
		   </td>
  	       <td width="24%"  align="center"> 
		 <div id="cat_tree2">		     </div>	   </td>
  	       <td width="13%" align="left">&nbsp;           </td>
   	   </tr>
    </table>
</form>

<?php
	$cat_level_two=@$_REQUEST['cat_level_two'];
	
	if(isset($cat_level_two)){ 
		$cat_level_root=@$_REQUEST['cat_level_root'];
		$cat_level_one=@$_REQUEST['cat_level_one'];
		
		if($cat_level_two=="")
			$cat_level_two=$cat_level_one;
		$res_opt=db_query("select * from tbl_option_cat WHERE cat_id='".$cat_level_two."'");
?>
<br />
<table border="0" width="50%">		
<?php		if(mysql_num_rows($res_opt)!=0){?>
            	<tr>
                	<th align="left">Option Name</th>
                	<th align="left">Possible Value</th>
                </tr>
		<?php
		while ($line_raw = mysql_fetch_array($res_opt)) {
			@extract($line_raw);?>
			<tr>
            	<td><?php echo $option_nom;?></td>
                    	
                <td>
					<table>
							<tr>
                            <td>
                	<?php
						$res_val=db_query("select * from tbl_value_option WHERE option_id=$option_id");
						if(mysql_num_rows($res_val)==0){
							?>
                        		<a href="land.php?file=manage_value_option&option_id=<?php echo $option_id;?>&cat_level_root=<?php echo $cat_level_root;?>&cat_level_one=<?php echo $cat_level_one;?>&cat_level_two=<?php echo $cat_level_two;?>"><img src="images/add_btn.gif" /></a>
							<?php
						}else{
							?>
                        <a href="land.php?file=manage_value_option&option_id=<?php echo $option_id;?>&cat_level_root=<?php echo $cat_level_root;?>&cat_level_one=<?php echo $cat_level_one;?>&cat_level_two=<?php echo $cat_level_two;?>"><img src="images/add_btn.gif" /></a>
                            <?php
							while ($line_val = mysql_fetch_array($res_val)) {
							@extract($line_val);?>
								<?php echo $val_nom;?> 
						<?php
						}?>
                        </td
							></tr>
							
							<?php
						}?>
						</table>            
         		</td>
            </tr>
			
            <?php
		}
		?>
        <?php
		}
		?>
        <tr>
        	<td colspan="2"><hr /></td>
        </tr>
		<form name="form4" method="get" action="manage_option_cat.php">
			<input type="hidden" name="cat_level_root" value="<?php echo $cat_level_root;?>" />
			<input type="hidden" name="cat_level_one" value="<?php echo $cat_level_one;?>" />
			<input type="hidden" name="cat_level_two" value="<?php echo $cat_level_two;?>" />
			<tr>
				<td valign="top" class="tdLabel" colspan="2">
					<b>Add Option Name:</b><font color="#FF0000">*</font><input type="text" name="option_name" size="45">
					<span class="tdLabel">
						<input type="submit" name="action" value="Add">
					</span>
				</td>
			</tr>
		  </table>
		</form>
		<?php
	}
?>

  