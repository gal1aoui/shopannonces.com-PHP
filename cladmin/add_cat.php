<?php
$Parent_id=isset($_REQUEST['parentId']) ? $_REQUEST['parentId']  : "0";
$title_page=($Parent_id > 0 ) ? "Sub Category" : "Category";



if(@$_REQUEST[action]=='Add'){
	db_query("insert into tbl_category 
			set cat_name='$_REQUEST[cat_name]', cat_desc='$_REQUEST[cat_desc]', meta_title='$_REQUEST[meta_title]', meta_desc='$_REQUEST[meta_desc]', meta_keyword='$_REQUEST[meta_keyword]'");
	
	/********* Upload Main image ***********/
		$fileName=$_FILES['file1']['name'];
		if($fileName!=''){
		$fileType = $_FILES['file1']['type'];
		$fileTemp = $_FILES['file1']['tmp_name'];
		$fileError = $_FILES['file1']['error'];
		$destFile = date('dMYhms').$fileName;			
		$destLoc = '../uploaded_files/cat_icon/'.$destFile;			  
			if(move_uploaded_file($_FILES['file1']['tmp_name'],$destLoc)){
				$der_id=mysql_insert_id();
			  $update="update tbl_category set `cat_image` ='$destFile' where `cat_id` =$der_id";			
			  db_query($update);
			}
		 }
/**************** End of Upload ****************/		
	
	 $_SESSION['site_admin_message']=" Category Updated successfully....";
	header("Location: land.php?file=catalog&parentId=$Parent_id");
	exit();	
 }
?>
<script language="javascript">
function validate(){
		 if(document.form1.cat_name.value == ""){
		   alert("Please select category name.")
		   document.form1.cat_name.focus()
		   return false;
		 }	 
	  
  }
</script>
<?php echo PageTitle('Edit Category');?>
<div align="left"><?php page_nav($_REQUEST['parentId']);?></div>	
<div align="right"><a href="?file=catalog">Back to Category List</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="3" class="tdLabel"></td>
    </tr>
	 <tr>
	   <td width="290" class="tdLabel"><strong><?php echo $title_page;?> Name : <font color="#FF0000">*</font></strong></td>
	   <td colspan="2" align="left" ><input type="text" name="cat_name" id="cat_name" value="<?php echo $cat_name;?>"/></td>
    </tr>
     <tr>
		<td width="290" class="tdLabel"><b> <strong>Category</strong> image  : <strong><font color="#FF0000">*</font></strong></b></td>
	    <td width="396" align="left" >
		<input type="file" name="file1" id="file1" >
	    (Icon with size 34 X 36)</td>
	    <td width="256" align="left" >
	   <img src="<?php echo $img?>" height="34" width="36" border="1" style="vertical-align:middle "> &nbsp; <a href="land.php?file=edit_category&parentId=<?php echo $_REQUEST[parentId];?>&del=Y&rId=<?php echo $_REQUEST['rId'];?>">Delete</a></td>
    </tr>
     <tr>
       <td class="tdLabel"><strong><?php echo $title_page;?> Description : </strong></td>
       <td colspan="2" align="left" class="tdData"><label>
         <textarea name="cat_desc" id="cat_desc" cols="50" rows="6"><?php echo $cat_desc ;?></textarea>
       </label></td>
     </tr>
     <tr>
       <td class="tdLabel"><strong>Meta Title : </strong></td>
       <td colspan="2" align="left" class="tdData">
	   <textarea name="meta_title" cols="50" rows="6"><?php echo $rw['meta_title'];?></textarea></td>
     </tr>
     <tr>
       <td class="tdLabel"><strong>Meta Keyword : </strong></td>
       <td colspan="2" align="left" class="tdData">
	   <textarea name="meta_keyword" cols="50" rows="6"><?php echo $rw['meta_keyword'];?></textarea></td>
     </tr>
     <tr>
       <td class="tdLabel"><strong>Meta Description : </strong></td>
       <td colspan="2" align="left" class="tdData">
	   <textarea name="meta_desc" cols="50" rows="6"><?php echo $rw['meta_desc'];?></textarea></td>
     </tr>
    <tr>
		<td class="tdLabel">&nbsp;</td>
	  <td colspan="2" align="left" class="tdData"><input type="submit" name="sub" value="Add"/> 
	  <input type="hidden" name="action" value="Add"></td>
    </tr>
  </table>
</form>
