<?php
$act=$_REQUEST['act'];
if($_REQUEST[rid]!=""){
 $sql_dis=db_query("select * from tbl_site_setting where id =$_REQUEST[rid]");
 $rw=mysql_fetch_array($sql_dis);
 @extract($rw);
}
if($act=="updat"){ 
 $sql="UPDATE `tbl_site_setting` SET `title_font_type` = '$_REQUEST[title_font_type]',
`title_font_size` = '$_REQUEST[title_font_size]',
`title_font_color` = '$_REQUEST[title_font_color]',
`desc_font_type` = '$_REQUEST[desc_font_type]',
`desc_font_size` = '$_REQUEST[desc_font_size]',
`desc_font_color` = '$_REQUEST[desc_font_color]',
`price_font_color` = '$_REQUEST[price_font_color]'
 WHERE id = $_REQUEST[rid] ";
db_query($sql);	
$_SESSION['site_admin_message']="Site Setting  Updated Successfully.........";
header("Location:land.php?file=manage_site_setting");
exit(); 
 } 
?>
<?=PageTitle('Add/Edit Site Setting'); ?>
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
	   <input name="title_font_type" type="text" id="title" size="40" value="<?=$title_font_type;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel">Font Size </td>
       <td align="left" class="tdData"><input name="title_font_size" type="text" id="word" size="40" value="<?=$title_font_size;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel">Font color </td>
       <td align="left" class="tdData"><input name="title_font_color" type="text" id="word2" size="40" value="<?=$title_font_color;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel"><strong>Classified description </strong></td>
       <td align="left" class="tdData">&nbsp;</td>
     </tr>
     <tr>
       <td class="tdLabel">Font Type </td>
       <td align="left" class="tdData"><input name="desc_font_type" type="text" id="word3" size="40" value="<?=$desc_font_type;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel">Font Size </td>
       <td align="left" class="tdData"><input name="desc_font_size" type="text" id="word4" size="40" value="<?=$desc_font_size;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel">Font color </td>
       <td align="left" class="tdData"><input name="desc_font_color" type="text" id="word5" size="40" value="<?=$desc_font_color;?>"></td>
     </tr>
     <tr>
       <td class="tdLabel"><strong>Classified Price </strong></td>
       <td align="left" class="tdData">&nbsp;</td>
     </tr>
     <tr>
       <td class="tdLabel">Font color </td>
       <td align="left" class="tdData"><input name="price_font_color" type="text" id="word6" size="40" value="<?=$price_font_color;?>"></td>
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