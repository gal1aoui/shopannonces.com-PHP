<?php
 if(isset($_REQUEST['parentId']))
 {

 $sql=db_query("select * from ".DB.".tbl_category_faq where cat_id ='$_REQUEST[parentId]'") or die(mysql_error());
 $rw=mysql_fetch_array($sql);
 @extract($rw);
 $file_path=SITE_FS_PATH."/uploaded_files/cat_img/".$cat_image;
 $file_name=SITE_WS_PATH."/uploaded_files/cat_img/".$cat_image;
 $no_img=SITE_WS_PATH."/images/notavailable.jpg";				
 $img=(file_exists($file_path) && $cat_image!="") ?  $file_name : $no_img ;		 
 }
 
 
if($action=='Update'){
db_query("update ".DB.".tbl_category_faq set cat_name='$_REQUEST[cat_name]',cat_desc='$_REQUEST[cat_desc]',meta_title='$_REQUEST[meta_title]'
,meta_desc='$_REQUEST[meta_desc]',meta_keyword='$_REQUEST[meta_keyword]' where cat_id='$_REQUEST[parentId]' ");
$insid=mysql_insert_id();
/********* Upload Main image ***********/
		$fileName=$_FILES['file1']['name'];
		if($fileName!='')
		{
		$fileType = $_FILES['file1']['type'];
		$fileTemp = $_FILES['file1']['tmp_name'];
		$fileError = $_FILES['file1']['error'];
		$destFile = date('dMYhms').$fileName;			
		$destLoc = SITE_FS_PATH.'/uploaded_files/cat_img/'.$destFile;			  
			if(move_uploaded_file($_FILES['file1']['tmp_name'],$destLoc))
		    {
			  $update="update ".DB.".tbl_category_faq set `cat_image` ='$destFile' where `cat_id` ='$_REQUEST[parentId]'"; 
			  @mysql_query($update) or die(mysql_error());
			}
		  @unlink($file_path);  
			 
		 }

/**************** End of Upload ****************/		
$_SESSION['site_admin_message']=" Category Updated successfully....";
header("Location:land.php?file=faq_category");   
 }
?>
<script language="javascript">
function validate()
 {
		 if(document.form1.cat_name.value == "")
		  {
		   alert("Please select category name.")
		   document.form1.cat_name.focus()
		   return false;
		 }	 
	  
  }
</script>
<?=PageTitle('Edit Faq Category'); ?>
<div align="left"><?php page_nav($_REQUEST[parentId]);?></div>	
<div align="right"><a href="?file=faq_category">Back to Category List</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="3" class="tdLabel"></td>
    </tr>
	 <tr>
	   <td width="290" class="tdLabel"><strong>category Name : <font color="#FF0000">*</font></strong></td>
	   <td width="669" colspan="2" align="left" ><input type="text" name="cat_name" id="cat_name" value="<?=$cat_name;?>"/></td>
    </tr>
    <!-- <tr>
       <td class="tdLabel"><strong>Category Description : </strong></td>
       <td colspan="2" align="left" class="tdData"><label>
         <textarea name="cat_desc" id="cat_desc" cols="50" rows="8"><?=$cat_desc ;?></textarea>
       </label></td>
     </tr>-->
    <tr>
		<td class="tdLabel">&nbsp;</td>
	  <td colspan="2" align="left" class="tdData"><input type="submit" name="sub" value="Update"/> 
	  <input type="hidden" name="action" value="Update"></td>
    </tr>
  </table>
</form>
