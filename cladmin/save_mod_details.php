<?php
require_once("../includes/main.inc.php");
require_once("admin-function.php");

if($_POST['action']=='Modifier') {
	$sql = "update tbl_classified
				set classified_desc='$_POST[classified_desc]', 	
					contact_number='$_POST[contact_number]', 	
					classi_fax='$_POST[classi_fax]', 	
					classified_poster_street='$_POST[classified_poster_street]',
					classified_title='$_POST[classified_title]'
				where classified_id='$_POST[classified_id]'";
	db_query($sql);
	
	$recID=$_POST[classified_id];
	$dest_dir="../mobile/uploaded_files/classified_img/";
	 
	if($_FILES['file1']['name']!=""){		  			  
	  $img=upload_file($recID,"file1",$dest_dir);
	  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img', clsd_id='$recID', mem_id='$mem_id' ");
	}
	if($_FILES['file2']['name']!=""){						 
	  $img2=upload_file($recID,"file2",$dest_dir);
	  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img2',clsd_id='$recID',mem_id='$mem_id'");
	}		
	if($_FILES['file3']['name']!=""){					
	  $img3=upload_file($recID,"file3",$dest_dir);
	  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img3',clsd_id='$recID',mem_id='$mem_id'");
	}
	if($_FILES['file4']['name']!=""){							 
	  $img4=upload_file($recID,"file4",$dest_dir);
	  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img4',clsd_id='$recID',mem_id='$mem_id'");
	}
	if($_FILES['file5']['name']!=""){							 
	  $img5=upload_file($recID,"file5",$dest_dir);
	  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img5',clsd_id='$recID',mem_id='$mem_id'");
	}
	if($_FILES['file6']['name']!=""){							 
	  $img6=upload_file($recID,"file6",$dest_dir);
	  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img6',clsd_id='$recID',mem_id='$mem_id'");
	}
	if($_FILES['file7']['name']!=""){							 
	  $img7=upload_file($recID,"file7",$dest_dir);
	  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img7',clsd_id='$recID',mem_id='$mem_id'");
	}
	if($_FILES['file8']['name']!=""){							 
	  $img8=upload_file($recID,"file8",$dest_dir);
	  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img8',clsd_id='$recID',mem_id='$mem_id'");
	}
}

header("Location:classified_details.php?clsId=$_POST[classified_id]");   

?>