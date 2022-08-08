<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
			 
$link_curr=get_config_setting(15);
chk_user_login();
$action=@$_POST['action'];
$pmethod=$_POST;
$recID=intval($_REQUEST['clsId']);
$mid=$_COOKIE['memId'];
$mem_lname=$_COOKIE['user_name'];
$clsID = intval($_REQUEST['clsId']);
/**************** Display records ***************/
$sql_clsi_show="select * from tbl_classified where classified_id=$clsID  AND mem_id='$_COOKIE[memId]'";
$sql_rs_set=db_query($sql_clsi_show);
$reccnt = mysql_num_rows($sql_rs_set);
$res=mysql_fetch_array($sql_rs_set);
// $res[paid_status];


if(!empty($reccnt) && $reccnt > 0 ){
	
	$sql_img="select * from tbl_classified_image where clsd_id=$res[classified_id]	AND mem_id='$_COOKIE[memId]' ";
	$sql_img_set=db_query($sql_img);
	
	$i=1;
	if(mysql_num_rows($sql_img_set) > 0 ) {
		while($res1=mysql_fetch_array($sql_img_set)){   
			$file_sm="mobile/uploaded_files/classified_img/".$res1[cls_img_file];
			$img_name[]=$res1['cls_img_file'];
			$autoID[]=$res1['clsd_img_id']; 
			if($res1[cls_img_file]!="" && file_exists($file_sm)){
				$link[]= '<div style="display: flex">
						<img src="mobile/uploaded_files/classified_img/'.$res1[cls_img_file].'" class="img-light">									
                <div style="margin-top: 60px; margin-left: 10px;">
				<a href="mobile/uploaded_files/classified_img/'.$res1[cls_img_file].'" class="link1 u btn btn-success " rel="facebox">Voir Photo</a>
                <br/>
				<a href="edit-my-post.php?clsId='.$recID.'&imgdelId='.$res1[clsd_img_id].'&im='.trim($res1[cls_img_file]).'" class="link1 u btn btn-danger" style="margin-top: 15px">Effacer</a>
                </div></div>
                ';
			}
			$i++;
		}
	}

}else{
	
 header("Location:my-account-manage.php");
 exit();
	
	
}
/**************** End Display records ***************/


/* Delete member images  */
if($_REQUEST[imgdelId]!="" && $_REQUEST[imgdelId]>0){
	 $file_unlink=UP_FILES_FS_PATH."/classified_img/".intval($_REQUEST[im]);  
	 $imgdelId = intval($_REQUEST['imgdelId']);
	 $sql_del="delete from tbl_classified_image 
	 where clsd_img_id='$imgdelId' and clsd_id=$recID and mem_id='$mid'"; 
	 db_query($sql_del);
	 if(file_exists($file_unlink)){
	   @unlink($file_unlink);
	 }
	  Set_Display_Message("Votre Photo supprimé avec succès...");
	  header("Location:edit-my-post.php?clsId=$recID");
	  exit();

}
/* Delete member images  */

/**************** Update  records ***************/

$empty_fld=checkEmptyData($pmethod,
array("principale_select","classi_title","classi_ad_type","classi_desc","classi_state","classi_city","classi_zipcode","classi_email"),
array("Sub Category","Title","Ad Type","Description","State","City","Postal Code","Email ID"));

if($action=="updateNow"){
	if(!$empty_fld[err_flag]){
		@extract($_POST);
		
$sql_cat="select * from tbl_category where cat_id=".$_POST["principale_select"];
$sql_rs_catt=db_query($sql_cat);
$line_raw = mysql_fetch_array($sql_rs_catt);

$cat_level_root = $line_raw['cat_parent'];
$cat_level_one = $_POST["principale_select"];
$cat_level_two = $_POST["cat_level_two"];

		$cat_level_root = secureValue($cat_level_root);
		$cat_level_one = secureValue($cat_level_one);
		$cat_level_two = secureValue($cat_level_two);
		$classi_title = secureValue($classi_title);
		$classi_ad_type = secureValue($classi_ad_type);
		$classi_desc = secureValue($classi_desc);
		$classi_price = secureValue($classi_price);
		$my_offer = secureValue($my_offer);
		$classi_address = secureValue($classi_address);
		$classi_city = secureValue($classi_city);
		$classi_state = secureValue($classi_state);
		$contact_number = secureValue($contact_number);
		$clas_fax = secureValue($clas_fax);
		$classi_zipcode = secureValue($classi_zipcode);
		$classi_email = secureValue($classi_email);
		$contact_status = secureValue($contact_status);
		$tmpClsID = intval($_REQUEST['clsId']);
	
		$sql = "SELECT * FROM  `tbl_classified` WHERE classified_id='$tmpClsID'";
		
		$rs_classi=db_query($sql);
		$rw=mysql_fetch_array($rs_classi);
		//$date_comp=date('y-m-d h:i:s', strtotime('+1 days'));
		$date_comp=date('y-m-d h:i:s');
		
		$date_fin_urgent=(strtotime(MYSQL_DATE_TIME) < strtotime($rw[date_fin_urgent])) ? $rw[date_fin_urgent] : MYSQL_DATE_TIME;
		$date_fin_premium=(strtotime(MYSQL_DATE_TIME) < strtotime($rw[date_fin_premium])) ? $rw[date_fin_premium] : MYSQL_DATE_TIME; 
		$date_fin_couleur=(strtotime(MYSQL_DATE_TIME) < strtotime($rw[date_fin_couleur])) ? $rw[date_fin_couleur] : MYSQL_DATE_TIME; 
		$date_fin_republication=(strtotime(MYSQL_DATE_TIME) < strtotime($rw[date_fin_republication])) ? $rw[date_fin_republication] : MYSQL_DATE_TIME; 

		$contact_status=($contact_status!="") ? $contact_status : "Y";  	  
		$sql="UPDATE `tbl_classified` SET
		`clsd_cat_id` = '$cat_level_root',
		`clsd_subcat_id` = '$cat_level_one',`clsd_sub_subcat_id` = '$cat_level_two',
		`classified_title` = '$classi_title',`classified_type` = '$classi_ad_type',
		`classified_desc` = '$classi_desc',	`classified_price_option` = '$classi_price',
		`offer` = '$my_offer',`classified_poster_street` = '$classi_address',
		`classified_city_id`='$classi_city',`classified_poster_state` = '$classi_state',
		`contact_number`='$contact_number',`classi_fax`='$clas_fax',
		`classified_poster_zipcode` = '$classi_zipcode',
		`classified_poster_name`='".$_COOKIE['user_name']."',
		`classified_poster_email` = '".$_COOKIE['classi_email']."',
		`classified_update_date`='".MYSQL_DATE_TIME."',
		`date_fin_urgent`='".$date_fin_urgent."',
		`date_fin_premium`='".$date_fin_premium."',
		`date_fin_couleur`='".$date_fin_couleur."',
		`date_fin_republication`='".$date_fin_republication."',
		`classified_status` = 'Inactive'
		
		 WHERE classified_id =$tmpClsID";
		 //exit;		 
		 db_query($sql);		
		 if($_FILES['file1']['name']!=""){
		 		 
		      if($autoID[0]=="" || $autoID[0]=="0"){
				  $img=upload_file($mid,"file1","mobile/uploaded_files/classified_img");
				  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img',clsd_id='$recID' ,mem_id='$mid' ");
			  }else{	 	  	
				  $img=upload_file($mid,"file1","mobile/uploaded_files/classified_img");			  
				  db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img'
				  WHERE clsd_img_id='$autoID[0]' and  clsd_id='$recID'and mem_id='$mid' ");
				  unlink_file('classified_img',$img_name[0]);
			  }
			  			  
			}
			if($_FILES['file2']['name']!=""){
			  if($autoID[1]=="" || $autoID[1]=="0"){
				  $img2=upload_file($mid,"file2","mobile/uploaded_files/classified_img");
				  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img2',clsd_id='$recID' ,mem_id='$mid' ");
			   }else{			 
				  $img2=upload_file($mid,"file2","mobile/uploaded_files/classified_img");			  
				  db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img2'
				  where clsd_img_id='$autoID[1]' and  clsd_id='$recID'and mem_id='$mid'");
				  unlink_file('classified_img',$img_name[1]);
			   }
			}		
			if($_FILES['file3']['name']!=""){
			  	if($autoID[2]=="" || $autoID[2]=="0"){
					$img3=upload_file($mid,"file3","mobile/uploaded_files/classified_img");
			  		db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img3',clsd_id='$recID',mem_id='$mid' "); 
				}else{			  	
					$img3=upload_file($mid,"file3","mobile/uploaded_files/classified_img");			
					db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img3'
					where clsd_img_id='$autoID[2]' and clsd_id='$recID'and mem_id='$mid'");
					unlink_file('classified_img',$img_name[2]);
				  }
			}
			if($_FILES['file4']['name']!=""){
			  if($autoID[3]=="" || $autoID[3]=="0"){
				  $img4=upload_file($mid,"file4","mobile/uploaded_files/classified_img");
				  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img4',clsd_id='$recID',mem_id='$mid' "); 
			  }else{			 	
			    $img4=upload_file($mid,"file4","mobile/uploaded_files/classified_img");			 
			    db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img4'
			    where clsd_img_id='$autoID[3]' and  clsd_id='$recID'and mem_id='$mid'");
			    unlink_file('classified_img',$img_name[3]);
			  }
			}

			if($_FILES['file5']['name']!=""){
			  if($autoID[4]=="" || $autoID[4]=="0"){
				  $img5=upload_file($mid,"file5","mobile/uploaded_files/classified_img");
				  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img5',clsd_id='$recID',mem_id='$mid' "); 
			  }else{			 	
			    $img5=upload_file($mid,"file5","mobile/uploaded_files/classified_img");			 
			    db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img5'
			    where clsd_img_id='$autoID[4]' and  clsd_id='$recID'and mem_id='$mid'");
			    unlink_file('classified_img',$img_name[4]);
			  }
			}
			
			if($_FILES['file6']['name']!=""){
			  if($autoID[5]=="" || $autoID[5]=="0"){
				  $img6=upload_file($mid,"file6","mobile/uploaded_files/classified_img");
				  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img6',clsd_id='$recID',mem_id='$mid' "); 
			  }else{			 	
			    $img6=upload_file($mid,"file6","mobile/uploaded_files/classified_img");			 
			    db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img6'
			    where clsd_img_id='$autoID[5]' and  clsd_id='$recID'and mem_id='$mid'");
			    unlink_file('classified_img',$img_name[5]);
			  }
			}
			
			if($_FILES['file7']['name']!=""){
			  if($autoID[6]=="" || $autoID[6]=="0"){
				  $img7=upload_file($mid,"file7","mobile/uploaded_files/classified_img");
				  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img7',clsd_id='$recID',mem_id='$mid' "); 
			  }else{			 	
			    $img7=upload_file($mid,"file7","mobile/uploaded_files/classified_img");			 
			    db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img7'
			    where clsd_img_id='$autoID[6]' and  clsd_id='$recID'and mem_id='$mid'");
			    unlink_file('classified_img',$img_name[6]);
			  }
			}
			
			if($_FILES['file8']['name']!=""){
			  if($autoID[7]=="" || $autoID[7]=="0"){
				  $img8=upload_file($mid,"file8","mobile/uploaded_files/classified_img");
				  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img8',clsd_id='$recID',mem_id='$mid' "); 
			  }else{			 	
			    $img8=upload_file($mid,"file8","mobile/uploaded_files/classified_img");			 
			    db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img8'
			    where clsd_img_id='$autoID[7]' and  clsd_id='$recID'and mem_id='$mid'");
			    unlink_file('classified_img',$img_name[7]);
			  }
			}
/*----------------------------------------------------------*/

	if($res['clsd_sub_subcat_id']!=0 && $res['clsd_sub_subcat_id']!=''){
		$cat=$res['clsd_sub_subcat_id'];
	}
	else{
		$cat=$res['clsd_subcat_id'];
	}
//----------------------------------------------------------
	$subCatID = intval($_REQUEST['subcatId']);
	$sql_cat=db_query("select * from tbl_option_cat where cat_id ='$cat' order by cat_id");
	$num=mysql_num_rows($sql_cat);

	if($num > 0 ){
		$sbCatID = intval($_REQUEST['sbcatId']);
		while($rw=mysql_fetch_array($sql_cat)){
			//------------------------------
			$sql=db_query("select * from tbl_classified_other where option_id ='$rw[option_id]' AND classifief_id=$recID ORDER BY other_value");
			$num2=mysql_num_rows($sql);
			$rw2=mysql_fetch_array($sql);
			
			if($num2 == 0 ){
				//echo $rw['option_nom'].' '.$rw['option_id'].' '.$_REQUEST[$rw['option_id']];
				$sql="UPDATE `tbl_classif_option` SET
				`val_id`='".$_REQUEST[$rw['option_id']]."'
				where option_id ='".$rw[option_id]."' AND classif_id='".$recID."'";
				$sql_selected=db_query($sql);
			}
			else{
				//echo $rw['option_nom'].' '.$rw['option_id'].' '.$_REQUEST[$rw['option_id']];
				$sql="UPDATE `tbl_classified_other` SET
				`other_value` = '".$_REQUEST[$rw['option_id']]."'
				WHERE option_id='".$rw['option_id']."'
				AND	classifief_id='".$recID."'";
				
				db_query($sql);		
			}
			
			if($rw['option_nom']=="Surface"){
				$var.="m²";
			}else if($rw['option_nom']==htmlentities("Kilométrage", ENT_QUOTES, "UTF-8")){
				$var.="Km";
			}else if($rw['option_nom']==htmlentities("Cylindrée", ENT_QUOTES, "UTF-8")){
				$var.="CC";
			}else if($rw['option_nom']==htmlentities("Longueur", ENT_QUOTES, "UTF-8")){
				$var.="M";
			}else if($rw['option_nom']==htmlentities("Nbre de pièces", ENT_QUOTES, "UTF-8")){
				$var.="pièce(s)";
			}else if($rw['option_nom']==htmlentities("Loyer", ENT_QUOTES, "UTF-8")){
				$var.="/mois";
			}else if($rw['option_nom']==htmlentities("Nbre de chambres", ENT_QUOTES, "UTF-8")){
				$var.="chambre(s)";
			}else if($rw['option_nom']==htmlentities("Couchages", ENT_QUOTES, "UTF-8")){
				$var.="Couchages";
			}else if($rw['option_nom']==htmlentities("Loyer / semaine", ENT_QUOTES, "UTF-8")){
				$var.="/semaine";
			}else if($rw['option_nom']==htmlentities("Prix/Loyer", ENT_QUOTES, "UTF-8")){
				$var.="€";
			}else if($rw['option_nom']==htmlentities("Taille", ENT_QUOTES, "UTF-8")){
				$var.="Ha";
			}
			
			//------------------------------
		}
	}
//----------------------------------------------------------
	       Set_Display_Message("Votre annonce a été modifiée avec succès......");
	       header("Location:my-account-manage.php");
	       exit();
		   unset($action);		
	}else{
	  Set_Display_Message("Spécifier les champs suivants :<br />".$empty_fld[msg]);	
	 }	
	
}
/**************** End  Update  records ***************/
//onSubmit="return validate_post_classified(this)"
//echo $sql_clsi_show="select clsi.*,clsimg.* from tbl_classified as clsi left join tbl_classified_image as clsimg on clsi.classified_id=clsimg.clsd_id where clsi.classified_id=$_REQUEST[clsId] and clsi.mem_id='$_COOKIE[memId]' ";

	$meta_titles=strip_tags(truncateText($res[classified_title],150,' ','.',true));
	$meta_titles = ($res[classified_price_option]!=0) ? "Edit Annonces - ".$meta_titles." prix:".$res[classified_price_option].$link_curr : $meta_titles;
	$sm_title=strip_tags(truncateText($res[classified_title],40,' ','.',true));
	$sm_title = ($res[classified_price_option]!=0) ? "Edit Annonces - ".$sm_title." prix:".$res[classified_price_option].$link_curr : $sm_title;
	$meta_desc=strip_tags(truncateText($res[classified_desc],80,' ','.',true));
	$meta_keywords="Edit Annonces _ ".$sm_title;
	require_once("header.inc.php");
?>

<script type="text/javascript">
	$(document).ready(function() {
		
		$("#principale_select").focus(function(){
			//remove all the class add the messagebox classes and start fading
			$("#msgboxcategory").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextcategory").removeClass().addClass('messagebox').fadeIn("slow");
			
				$("#msgtextcategory").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<urgent> Sélectionner la bonne catégorie est essentiel !<br /> 1/ La rubrique principale dans le menu déroulant<br /> 2/ Les sous-rubriques s’afficheront dessous. <br /> Regarder bien toutes les options <br /> avant de faire votre choix. </urgent>').fadeTo(900,1);
				});
		});		
		
		//Onclik Controle boutton
	});
</script>


<div class="grid_3">
    <br />
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF">
    
    
	<div class="account-link">
		<?php require_once("my_account_links.php"); ?>
	</div>
    
	<div class=""><?php echo Display_Message();?> </div>
    

    <div class="p7">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><div class="main-heading">Modifier votre petite annonce:</div></div>
            <div class="panel-body">
        		<form name="frm" action="" method="post" enctype="multipart/form-data">
            	<table width="100%" cellpadding="2" cellspacing="0" border="0">
                <tr>
                    <td colspan="3"><p class="fr"><span class="fs11">( <span class="star">* </span>)obligatoire.</span></p></td>
                </tr>
                <tr class="bg-stripcolor">
                    <td width="20%" align="right"><span class="star">*</span> Catégorie : </td>
                    <td>                                          
                    <select name="principale_select" id="principale_select" onChange="cat_drop_prin_select(this.value,'');" class="textbox">
                        <?php echo prin_select_selected($res['clsd_subcat_id']);?>
                    </select>
                    <span id="msgboxcategory" style="display: none;"></span>
                    <span id="msgtextcategory" style="display:none;"></span>
                    </td>
                </tr>
                
                <tr class="bg-stripcolor">
                    <td></td>
                    <td>
                        <div id="ogiga" style="display:inline-block" ><?php    
                            $select=$res['clsd_sub_subcat_id'];
                            $sql_sous_cat=db_query("select * from tbl_category where cat_parent ='".$res['clsd_subcat_id']."' order by cat_order ");
                            while($rw_sc=mysql_fetch_array($sql_sous_cat))
                            {
                                if($select==$rw_sc['cat_id'])
                                    $sel='checked';
                                else
                                    $sel='';
                                echo "<input name='cat_level_two'
                                        id='cat_level_two'
                                        value='".$rw_sc['cat_id']."'
                                        type='radio'
                                        onclick='cat_drop_down3(this.value,\"\")' 
                                        $sel >".$rw_sc['cat_name'].'<br>';
                            
                                echo "<span id='msgboxcat_level_two' style='display: none;'></span>";
                            }
                            ?></div>
                        <span id="msgboxogiga" style="display:none"></span>
                        <span id="msgtextogiga" style="display:none"></span> 
                    </td>
                </tr>
                
                <tr class="bg-stripcolor">
                    <td align="right"><span class="star">* </span>Titre :</td>
                    <td align="left">
                    <input name="classi_title" id="classi_title" type="text" class="textbox" style="width:310px;" value="<?php echo $res['classified_title'];?>" maxlength="60" />
                    <span id="msgboxtitle" style="display: none;"></span>   
                    <span id="msgtexttitle" style="display: none;"></span>                        
                    </td>           
                </tr>
                <tr>
                    <td align="right"><span class="star">*</span>Type d'annonce :</td>
                    <td align="left">
                    <select name="classi_ad_type" id="classi_ad_type" class="textbox">
                        <option value="">Type d'annonce</option>
                        <?php foreach($Ads_type as $key=>$val){
                        $sel=($res['classified_type']!="" && ($res['classified_type']==$val))? "selected" : "";
                        ?>	
                        <option value="<?php echo $val;?>" <?php echo $sel;?> ><?php echo $val;?></option>					
                        <?php } ?>	
                    </select>
                    <span id="msgboxadtype" style="display: none;"></span>
                    <span id="msgtextadtype" style="display: none;"></span>
                    </td>
                </tr>
                <tr class="bg-stripcolor">
                <td align="right" ><span class="star">*</span> Description  :</td>
                <td align="left">
                <textarea name="classi_desc" id="classi_desc" class="textbox1" rows="10" cols="80" onblur="verif_nbre_caract(this)"  ><?php echo $res[classified_desc];?></textarea>
                    
                <span id="msgboxdesc" style="display: none;"></span>
                <br />
                <span id="msgtextdesc" ></span>
                <br /><br /><br /><br />
                <?php //get_fck_editor_small('classi_desc',$classi_desc);?> </td>
                </tr>
                <tr class="bg-stripcolor">
                <td colspan="2"><!--style="display:none"-->
                    <div id="omega" >
                    </div>
                </td>
                </tr>
                
                <tr height="20">
                <td height="30" align="right"><!--<span class="star">*</span>--> Prix <?php echo $link_curr;?> :</td>
                <td height="30" align="left">
                <input name="classi_price" id="classi_price" type="text" class="textbox"  style="width:100px;" onkeyup="check(this);" onKeyDown="document.frm.my_offer.disabled='disabled';" onBlur="if(this.value==''){document.frm.my_offer.disabled='';}" value="<?php echo $res['classified_price_option'];?>" />&nbsp;ou choisir:
                <select name="my_offer" class="textbox" style="width:120px;" onchange="document.frm.classi_price.disabled='disabled';" onBlur="if(this.value==''){document.frm.classi_price.disabled='';}">
                    <option value="">Choisir une</option>
                       <?php foreach($Offers_arr as $key=>$val){
                     $sel=($res['offer']!="" && ($res['offer']==$val))? "selected" : "";
                     ?>					  
                    <option value="<?php echo $val;?>" <?php echo $sel;?> ><?php echo $val;?></option>                     
                    <?php } ?>
                  </select>
                  
                <span id="msgboxprice" style="display: none;"></span>
                <span id="msgtextprice" style="display: none;"></span>
                </td>
                </tr>
                <tr class="bg-stripcolor">
                <td align="right" valign="top">Télécharger Images :</td>
                <td align="left">
                <script>
                function readURL(input,pos)
                {
                if (input.files && input.files[0])
                {
                var reader = new FileReader();
                reader.onload = function (e)
                                  {
                                        $("#"+pos.id)
                                        .attr('src',e.target.result)
                                        .width(90)
                                        .height(60);
                                  };
                reader.readAsDataURL(input.files[0]);
                }
                }
                </script>
                <div id="filestore">
                    <div class="border_img">
                        <input name="file1" id="file1" type="file" class="textbox1" size="44" onChange="readURL(this,blah1);" /><?php echo $link[0];?><br />
                    </div>
                    <div class="border_img">
                        <input name="file2" id="file2" type="file" class="textbox1" size="44" onChange="readURL(this,blah2);" /><?php echo $link[1];?><br />
                    </div>
                    <div class="border_img">
                        <input name="file3" id="file3" type="file" class="textbox1" size="44" onChange="readURL(this,blah3);" /><?php echo $link[2];?><br />
                    </div>
                    <div class="border_img">
                        <input name="file4" id="file4" type="file" class="textbox1" size="44" onChange="readURL(this,blah4);" /><?php echo $link[3];?><br />
                    </div>
                    <div class="border_img">
                        <input name="file5" id="file5" type="file" class="textbox1" size="44" onChange="readURL(this,blah5);" /><?php echo $link[4];?><br />
                    </div>
                    <div class="border_img">
                        <input name="file6" id="file6" type="file" class="textbox1" size="44" onChange="readURL(this,blah6);" /><?php echo $link[5];?><br />
                    </div>
                    <div class="border_img">
                        <input name="file7" id="file7" type="file" class="textbox1" size="44" onChange="readURL(this,blah7);" /><?php echo $link[6];?><br />
                    </div>
                    <div class="border_img">
                        <input name="file8" id="file8" type="file" class="textbox1" size="44" onChange="readURL(this,blah8);" /><?php echo $link[7];?><br />
                    </div>
                </div>
                </td>
                </tr>
                <tr class="bg-stripcolor">
                    <td colspan="2" align="center">
                        <table cellspacing="2">
                            <tr>
                                <td><img name="blah1" id="blah1" ></td>
                                <td><img name="blah2" id="blah2" ></td>
                            
                                <td><img src="" name="blah3" id="blah3"></td>
                                <td><img src="" name="blah4" id="blah4" ></td>
                           
                                <td><img src="" name="blah5" id="blah5"></td>
                                <td><img src="" name="blah6" id="blah6"></td>
                           
                                <td><img src="" name="blah7" id="blah7"></td>
                                <td><img src="" name="blah8" id="blah8" ></td>
                            </tr>
                        </table>
                      
                    </td>
                </tr>
                
                
                
                
                <?php
                if($res['clsd_sub_subcat_id']!=0 && $res['clsd_sub_subcat_id']!=''){
                $cat=$res['clsd_sub_subcat_id'];
                }
                else{
                $cat=$res['clsd_subcat_id'];
                }
                //----------------------------------------------------------
                $subCatID = intval($_REQUEST['subcatId']);
                $sql_cat=db_query("select * from tbl_option_cat where cat_id ='$cat' order by cat_id");
                $num=mysql_num_rows($sql_cat);
                $var='';
                if($num > 0 ){
                $sbCatID = intval($_REQUEST['sbcatId']);
                while($rw=mysql_fetch_array($sql_cat)){
                $var.='<tr>';
                $var.='<td align="right">'.$rw['option_nom'].':</td>';
                //------------------------------
                $sql=db_query("select * from tbl_classified_other where option_id ='$rw[option_id]' AND classifief_id=$recID ORDER BY other_value");
                $num2=mysql_num_rows($sql);
                $rw2=mysql_fetch_array($sql);
                $var.='<td align="left">';
                if($num2 == 0 ){
                $sql_selected=db_query("select * from tbl_classif_option where option_id ='$rw[option_id]' AND classif_id=$recID ORDER BY val_id");
                $num3=mysql_num_rows($sql_selected);
                $rw_selected=mysql_fetch_array($sql_selected);
                
                $sql_select=db_query("select * from tbl_value_option where option_id ='$rw[option_id]' ORDER BY val_id");
                $var.="<select name='".$rw[option_id]."' class='textbox'  />"; 
                $var.='<option value="">Choisir une option</option>';	
                
                while($rw_select=mysql_fetch_array($sql_select)){
                $sel=($rw_select[val_id]==$rw_selected[val_id]) ? "selected" : "";	
                $var.='<option value="'.$rw_select[val_id].'" '.$sel.'>'.$rw_select['val_nom'].'</option>';				
                }
                $var.="</select>";
                }
                else{
                $var.=$rw2[val_nom]."<input type='text' name='$rw[option_id]' value='$rw2[other_value]' class='textbox'  style='width:205px;' >";
                }
                
                if($rw['option_nom']=="Surface"){
                $var.="m²";
                }else if($rw['option_nom']==htmlentities("Kilométrage", ENT_QUOTES, "UTF-8")){
                $var.="Km";
                }else if($rw['option_nom']==htmlentities("Cylindrée", ENT_QUOTES, "UTF-8")){
                $var.="CC";
                }else if($rw['option_nom']==htmlentities("Longueur", ENT_QUOTES, "UTF-8")){
                $var.="M";
                }else if($rw['option_nom']==htmlentities("Nbre de pièces", ENT_QUOTES, "UTF-8")){
                $var.="pièce(s)";
                }else if($rw['option_nom']==htmlentities("Loyer", ENT_QUOTES, "UTF-8")){
                $var.="/mois";
                }else if($rw['option_nom']==htmlentities("Nbre de chambres", ENT_QUOTES, "UTF-8")){
                $var.="chambre(s)";
                }else if($rw['option_nom']==htmlentities("Couchages", ENT_QUOTES, "UTF-8")){
                $var.="Couchages";
                }else if($rw['option_nom']==htmlentities("Loyer / semaine", ENT_QUOTES, "UTF-8")){
                $var.="/semaine";
                }else if($rw['option_nom']==htmlentities("Prix/Loyer", ENT_QUOTES, "UTF-8")){
                $var.="€";
                }else if($rw['option_nom']==htmlentities("Taille", ENT_QUOTES, "UTF-8")){
                $var.="Ha";
                }
                
                $var.='</td>';
                $var.='</tr>';
                //------------------------------
                }
                }
                echo $var;
                //----------------------------------------------------------
                
                ?>    
                
                
                
                <tr class="bg-stripcolor">
                <td align="right">Addresse :</td>
                <td align="left">
                <textarea name="classi_address" id="classi_address" rows="3" class="textbox"><?php echo $res['classified_poster_street'];?></textarea>
                <span id="msgboxaddress" style="display: none;"></span>
                <span id="msgtextaddress" style="display: none;"></span>
                </td>
                </tr>
                <tr class="bg-stripcolor">
                <td align="right"><span class="star">*</span> Province :</td>
                <td align="left">	  
                    <select name="classi_state" 
                        id="classi_state" 
                        class="textbox"
                        onChange="return get_city_by_state(this.value,'')">
                        <?php echo get_state( $res[classified_poster_state]);?>
                    </select>
					<?php if($res[classified_poster_state]!="") { ?>
						<script language="javascript">
                        get_city_by_state('<?php echo $res[classified_poster_state];?>','<?php echo $res[classified_city_id];?>')
                        </script>
                    <?php } ?>
                    <span id="msgboxstate" style="display: none;"></span>
                    <span id="msgtextstate" style="display: none;"></span>
                </td>
                </tr>
                <tr class="bg-stripcolor">
                    <td align="right"><span class="star">*</span> Ville :</td>
                    <td align="left">
                        <div id="bloc_city" style="display:inline-block;" >
                            <select name='classi_city' id="classi_city" class='textbox'>
                            </select>
                        </div>
                        
                        <span id="msgboxcity" style="display: none;"></span>
                        <span id="msgtextcity" style="display: none;"></span>
                    </td>
                </tr>
                <tr class="bg-stripcolor">
                    <td align="right"><span class="star">*</span> Code postal :</td>
                    <td align="left">
                        <input name="classi_zipcode" id="classi_zipcode" type="text" maxlength="5" class="textbox" style="width:305px;" value="<?php echo $res[classified_poster_zipcode];?>" onkeyup="check(this);"/>
                        <span id="msgboxzipcode" style="display: none;"></span>
                        <span id="msgtextzipcode" style="display: none;"></span>
                    </td>
                </tr>
                <tr>
                <td align="right">Téléphone : </td>
                <td align="left">
                <input name="contact_number" type="text" min="6" maxlength="20" class="textbox"  style="width:305px;" value="<?php echo $res[contact_number];?>"/>
                </td>
                </tr>
                <tr>
                    <td align="right">Fax :</td>
                    <td align="left">
                    <input name="clas_fax" type="text" class="textbox"  maxlength="20" style="width:305px;" value="<?php echo $res[classi_fax];?>"/>
                    </td>
                </tr>  
                <tr>
                    <td align="center" style="padding-top:10px;" colspan="2">
                        <input type="hidden" name="classi_email" id="classi_email" value="<?php echo $res[classified_poster_email];?>" />
                        <input type="hidden" name="clsId" id="clsId" value="<?php echo $res[classified_id];?>" />
                        <input name="button5" type="button" class="button button-green" id="editer-annonce" value="Enregistrer"/>
                        <span class="border_bot"><input type="hidden" name="action" id="hiddenField" value="updateNow" /></span>
                        
                        <span id="msgtextverifier" style="display: none;"></span>
                    </td>
                </tr>
            </table>
        	</form>
            </div>
        </div>
	</div>   

</div>
<?php require_once("footer.inc.php"); ?>