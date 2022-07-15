<?php
require_once("../includes/main.inc.php");
if($_GET['c']!="")
{
$username = @$_GET['c'];
$valid = preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $username);
     if(!$valid)
     {
		 echo $msg1=" <b><font color='#FF0000'><li>
		 This is not a valid email address! Please fill a valid email address </li></font></b>";
		}else{
			$count = mysql_num_rows(db_query("select * from ".DB.".tbl_member  where user_id='".$username."'"));
			if($count > 0)
			{
			echo $msg2=" <b><font color='#FF0000'><li>
			This username already exists, please select another one.</li></font></b>";
			}else{
			 echo $msg3=" <b><font color='#FF0000'><li>This username is available.</li></font></b>";
			}
		
	}
		
}

/* Make Sub category drop down */
if(isset($_REQUEST[catId]) && $_REQUEST[catId]!=""){
      $sql_cat=db_query("select * from tbl_category where cat_parent ='$_REQUEST[catId]' and cat_status='Y' ");
	  $num=mysql_num_rows($sql_cat);
       $var='<select name="cat_level_one"  onChange="cat_drop_down2(this.value,\'\')" />';	  
	  $var.= '<option value="">Select Sub Category</option>';
	  if($num > 0 ){
	      while($rw=mysql_fetch_array($sql_cat)){ 
		  if($rw[cat_id]==$_REQUEST[sbcatId]){
		     $sel="selected";
		   }else{
		     $sel="";
		   	}  
		  $var.='<option value="'.$rw[cat_id].'" '.$sel.' >'.ucfirst(strtolower($rw[cat_name])).'</option>';		
	       }
		   $var.='</select>';		 
	   }
echo $var;
}

/* Make Sub Sub category drop down second level */
if(isset($_REQUEST[subcatId]) && $_REQUEST[subcatId]!=""){
      $sql_cat=db_query("select * from tbl_category where cat_parent ='$_REQUEST[subcatId]' and cat_status='Y' ");
	   $num=mysql_num_rows($sql_cat);
	   $var='<select name="cat_level_two"  />'; 
	   $var.= '<option value="">Select Sub Sub Category</option>';
	  if($num > 0 ){
	      while($rw=mysql_fetch_array($sql_cat)){ 
		  if($rw[cat_id]==$_REQUEST[sbcatId]){
		     $sel="selected";
		   }else{
		     $sel="";
		   	}  
		  $var.='<option value="'.$rw[cat_id].'" '.$sel.' >'.ucfirst(strtolower($rw[cat_name])).'</option>';		
	       }
		 $var.='</select>';		 
	   }
echo $var;
}

/* Make city drop down second level */
if(isset($_REQUEST[statId]) && $_REQUEST[statId]!=""){
      $sql_cat=db_query("select * from tbl_city where city_state_id ='$_REQUEST[statId]' and city_status='Active' ");
	  $num=mysql_num_rows($sql_cat);
	  $var='<select name="classi_city" class="textbox1"  />'; 	 
	  $var.= '<option value="">Select City</option>';
	  if($num > 0 ){
	      while($rw=mysql_fetch_array($sql_cat)){ 
		  if($rw[city_id]==$_REQUEST[sbcatId]){
		     $sel="selected";
		   }else{
		     $sel="";
		   	}  
		  $var.='<option value="'.$rw[city_id].'" '.$sel.' >'.ucfirst(strtolower($rw[city_name])).'</option>';		
	       }
		  $var.='</select>';			 
	   }
echo $var;
}

?>