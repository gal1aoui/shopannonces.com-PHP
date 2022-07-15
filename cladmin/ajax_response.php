<?php
	include ("../include/config.php");
	if (strlen($q) > 0){
	$query=mysql_query("select *from category_master where parent_id='$_GET[q]' and final_product='N'");
?>
	
				<select name="subcat">
					<option value="">-----Subcategory-----</option>
					<?while($rs=mysql_fetch_array($query)){?>
					<option value="<?=$rs[catg_id];?>"><?=$rs[catg_name];?></option>
					<?}?>
				</select>
					
	<?
	}
	?>