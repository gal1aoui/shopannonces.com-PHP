<?php
$action=@$_REQUEST['action'];
$cat_name=$_REQUEST['cat_name'];
$cat_order=$_REQUEST['cat_order'];
$cat_desc=$_REQUEST['cat_desc'];
$Parent_id=isset($_REQUEST['parentId']) ? $_REQUEST['parentId']  : "0";

$max_cat_order=db_query("select max(cat_order) from tbl_category_faq");
$max_order=mysql_fetch_array($max_cat_order);
$max_ord=$max_order[0]+1;

$title_page=($Parent_id > 0 ) ? "Sub Category" : "Category";

if($action=='Add')
 {
 db_query("insert into ".DB.".tbl_category_faq set cat_name ='$cat_name',cat_desc='$cat_desc',cat_order ='$max_ord',cat_parent='$Parent_id'");
	$insid=mysql_insert_id();
	################# Upload Main image ################################	
		   $fileName=$_FILES['file1']['name'];
			if($fileName!='')
			{
						$fileType = $_FILES['file1']['type'];
						$fileTemp = $_FILES['file1']['tmp_name'];
						$fileError = $_FILES['file1']['error'];
						$destFile = date('dMYhms').$fileName;			
					  $destLoc = '../uploaded_files/cat_img/'.$destFile;			  
				   if(move_uploaded_file($_FILES['file1']['tmp_name'],$destLoc))
				   {
				   $update="update ".DB.".tbl_category_faq set `cat_image` ='$destFile' where `cat_id` ='$insid'";		   
				   @mysql_query($update) or die(mysql_error());;
					
				  }
				
		  }  
	 ############################ End ########################################## 
	   $_SESSION['site_admin_message']=" Category Added successfully....";
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
	 
	 /*if(document.form1.file1.value == "")
      {
       alert("Please upload category image .")
       document.form1.file1.focus()
       return false;
     }
	 */
	  
  }
</script>
<?=PageTitle('Add Faq Category'); ?>
<div align="left"><?php page_nav($Parent_id);?></div>	
<div align="right"><a href="?file=faq_category">Back to faq category List</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="100%"  border="0" align="center" cellpadding="3" cellspacing="3" class="tableForm">	 
	 <tr align="left">
	   <td colspan="2" class="tdLabel"></td>
    </tr>
	 <tr>
	   <td class="tdLabel"><strong><?=$title_page;?> Name : <font color="#FF0000">*</font></strong></td>
	   <td align="left" ><input type="text" name="cat_name" id="cat_name" /></td>
    </tr>
	 
	<!-- <tr>
		<td width="333" class="tdLabel"><b> <strong><?=$title_page;?></strong> image  : <strong><font color="#FF0000">*</font></strong></b></td>
	    <td width="643" align="left" ><input type="file" name="file1" id="file1" > File type : [.gif, .jpg, .png ]</td>
	</tr>
     <tr>
       <td class="tdLabel"><strong><?=$title_page;?> Description : </strong></td>
       <td align="left" class="tdData"><label>
         <textarea name="cat_desc" id="cat_desc" cols="50" rows="8"></textarea>
       </label></td>
     </tr>-->
    <tr>
		<td class="tdLabel">&nbsp;</td>
	  <td align="left" class="tdData"><input type="image" name="imageField" src="images/buttons/submit.gif" />
	  <input type="hidden" name="action" value="Add">
	  </td>
    </tr>
  </table>
</form>
