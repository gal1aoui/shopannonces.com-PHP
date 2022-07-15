<?php
$act=@$_REQUEST['act'];

if($act=="updat"){ 
 $sql="UPDATE `tbl_site_setting` SET `title_font_type` = '".$_REQUEST['title_font_type']."',
`title_font_size` = '".$_REQUEST['title_font_size']."',
`title_font_color` = '".$_REQUEST['title_font_color']."',
`desc_font_type` = '".$_REQUEST['desc_font_type']."',
`desc_font_size` = '".$_REQUEST['desc_font_size']."',
`desc_font_color` = '".$_REQUEST['desc_font_color']."',
`price_font_color` = '".$_REQUEST['price_font_color']."',
`footer_font_type` = '".$_REQUEST['footer_font_type']."',
`footer_font_size` = '".$_REQUEST['footer_font_size']."',
`footer_font_color` = '".$_REQUEST['footer_font_color']."'
 WHERE id = 1 ";
 db_query($sql);	
$_SESSION['site_admin_message']="Site Setting  Updated Successfully.........";
//header("Location:land.php?file=manage_site_setting");
//exit(); 
 } 
 
$sql_dis=db_query("select * from tbl_site_setting where id =1");
$rw=mysql_fetch_assoc($sql_dis);
@extract($rw);
?>
<?php echo PageTitle('Add/Edit Site Setting'); ?>
<div align="right"><a href="?file=manage_site_setting">Back to Page Site Setting Management</a>&nbsp;</div>
<form name="form1" method="post" action="">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="2" class="tdLabel"></td>
    </tr>

	 <tr>
		<td width="155" align="left" class="tdLabel"><strong>Classified Title </strong></td>
	    <td width="813" align="left" >&nbsp;	 </td>
	 </tr>
     <tr>
       <td class="tdLabel">Font Type </td>
       <td align="left" class="tdData">
	   <input name="title_font_type" type="text" id="title" size="40" value="<?php echo $title_font_type;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel">Font Size </td>
       <td align="left" class="tdData"><input name="title_font_size" type="text" id="word" size="40" value="<?php echo $title_font_size;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel">Font color </td>
       <td align="left" class="tdData"><input name="title_font_color" type="text" id="word2" size="40" value="<?php echo $title_font_color;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel"><strong>Classified description </strong></td>
       <td align="left" class="tdData">&nbsp;</td>
     </tr>
     <tr>
       <td class="tdLabel">Font Type </td>
       <td align="left" class="tdData"><input name="desc_font_type" type="text" id="word3" size="40" value="<?php echo $desc_font_type;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel">Font Size </td>
       <td align="left" class="tdData"><input name="desc_font_size" type="text" id="word4" size="40" value="<?php echo $desc_font_size;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel">Font color </td>
       <td align="left" class="tdData"><input name="desc_font_color" type="text" id="word5" size="40" value="<?php echo $desc_font_color;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel"><strong>Classified Price </strong></td>
       <td align="left" class="tdData">&nbsp;</td>
     </tr>
     <tr>
       <td class="tdLabel">Font color </td>
       <td align="left" class="tdData"><input name="price_font_color" type="text" id="word6" size="40" value="<?php echo $price_font_color;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel"><strong>Classified Footer</strong></td>
       <td align="left" class="tdData">&nbsp;</td>
     </tr>
     <tr>
       <td class="tdLabel">Font Type </td>
       <td align="left" class="tdData"><input name="footer_font_type" type="text" id="word7" size="40" value="<?php echo $footer_font_type;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel">Font Size </td>
       <td align="left" class="tdData"><input name="footer_font_size" type="text" id="word8" size="40" value="<?php echo $footer_font_size;?>"></td>
     </tr>
    <tr>
		<td class="tdLabel">Font color </td>
	    <td align="left" class="tdData"><input name="footer_font_color" type="text" id="word9" size="40" value="<?php echo $footer_font_color;?>"></td>
    </tr>
	
    <tr>
      <td class="tdLabel">&nbsp;</td>
      <td align="left" class="tdData">	  
	  <input type="hidden" name="act" value="updat">
	  <input type="submit" name="Submit" value="Update">	  
	  </td>
    </tr>
  </table>
</form>
