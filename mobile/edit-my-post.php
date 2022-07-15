<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$link_curr=get_config_setting(15);
chk_user_login();

$clsID = intval($_REQUEST['clsId']);

/**************** Display records ***************/
$sql_clsi_show="select * from tbl_classified where classified_id=$clsID  AND mem_id='".$_SESSION['signin']['mem_id']."'";
$sql_rs_set=db_query($sql_clsi_show);
$reccnt = mysql_num_rows($sql_rs_set);
$res=mysql_fetch_array($sql_rs_set);
// $res[paid_status];

if(!empty($reccnt) && $reccnt > 0 ){

	$sql_img="select * from tbl_classified_image where clsd_id='".$res[classified_id]."' AND mem_id='".$_SESSION['signin']['mem_id']."' ";
	$sql_img_set=db_query($sql_img);
	
	if(mysql_num_rows($sql_img_set) > 0 ) {
		
		while($res1=mysql_fetch_array($sql_img_set)){
			
			$file_sm="uploaded_files/classified_img/".$res1[cls_img_file];
			$img_name[]=$res1[cls_img_file];
			$autoID[]=$res1['clsd_img_id']; 
			if($res1[cls_img_file]!="" && file_exists($file_sm)){
				$link[]= '
				<a href="uploaded_files/classified_img/'.$res1[cls_img_file].'">Voir Photo</a>
				| 
				<a href="edit-my-post.php?clsId='.$clsID.'&imgdelId='.$res1[clsd_img_id].'&im='.trim($res1[cls_img_file]).'" class="link1 u">Effacer</a>'  ;
			}
		}
	}

}else{
	header("Location:my-account-manage.php");
	exit();
}

/**************** End Display records ***************/


/* Delete member images  */
if($_REQUEST[imgdelId]!="" && $_REQUEST[imgdelId]>0){
	$file_unlink="uploaded_files/classified_img/".$_REQUEST[im];  
	$imgdelId = intval($_REQUEST['imgdelId']);
	$sql_del="delete from tbl_classified_image where clsd_img_id='$imgdelId' and clsd_id=$clsID and mem_id='".$_SESSION['signin']['mem_id']."'";
	db_query($sql_del);
	if(file_exists($file_unlink)){
		@unlink($file_unlink);		
	}
		Set_Display_Message("Votre Photo supprimé avec succès...");
		header("Location:edit-my-post.php?clsId=$clsID");
		exit();

}
/* Delete member images  */

/**************** Update  records ***************/

	
	if($_POST['action']=='updateNow'){
		$sql_cat="select * from tbl_category where cat_id=".$_POST["principale_select"];
		$sql_rs_catt=db_query($sql_cat);
		$line_raw = mysql_fetch_array($sql_rs_catt);
		
		$cat_level_root = $line_raw['cat_parent'];
		$cat_level_one = $_POST["principale_select"];
		$cat_level_two = $_POST["cat_level_two"];
		
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
		`classified_poster_name`='".$_SESSION['signin']['lname']."',
		`classified_poster_email` = '".$_SESSION['signin']['email']."',
		`classified_update_date`='".MYSQL_DATE_TIME."',
		`date_fin_urgent`='".$date_fin_urgent."',
		`date_fin_premium`='".$date_fin_premium."',
		`date_fin_couleur`='".$date_fin_couleur."',
		`date_fin_republication`='".$date_fin_republication."',
		`classified_status` = 'Inactive'
		
		 WHERE classified_id =$tmpClsID";
		 db_query($sql);
 
		$mid=$_SESSION['signin']['mem_id'];
		
		if($_FILES['file1']['name']!=""){
			  if($autoID[0]=="" || $autoID[0]=="0"){
				  $img=upload_file($mid,"file1","uploaded_files/classified_img");
				  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img',clsd_id='$clsID' ,mem_id='$mid' ");
			  }else{	 	  	
				  $img=upload_file($mid,"file1","uploaded_files/classified_img");			  
				  db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img'
				  WHERE clsd_img_id='$autoID[0]' and  clsd_id='$clsID'and mem_id='$mid' ");
				  unlink_file('classified_img',$img_name[0]);
			  }
		}
		
		if($_FILES['file2']['name']!=""){
		  if($autoID[1]=="" || $autoID[1]=="0"){
			  $img2=upload_file($mid,"file2","uploaded_files/classified_img");
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img2',clsd_id='$clsID' ,mem_id='$mid' ");
		   }else{			 
			  $img2=upload_file($mid,"file2","uploaded_files/classified_img");			  
			  db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img2'
			  where clsd_img_id='$autoID[1]' and  clsd_id='$clsID'and mem_id='$mid'");
			  unlink_file('classified_img',$img_name[1]);
		   }
		}		
		if($_FILES['file3']['name']!=""){
			if($autoID[2]=="" || $autoID[2]=="0"){
				$img3=upload_file($mid,"file3","uploaded_files/classified_img");
				db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img3',clsd_id='$clsID',mem_id='$mid' "); 
			}else{			  	
				$img3=upload_file($mid,"file3","uploaded_files/classified_img");			
				db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img3'
				where clsd_img_id='$autoID[2]' and clsd_id='$clsID'and mem_id='$mid'");
				unlink_file('classified_img',$img_name[2]);
			  }
		}
		if($_FILES['file4']['name']!=""){
		  if($autoID[3]=="" || $autoID[3]=="0"){
			  $img4=upload_file($mid,"file4","uploaded_files/classified_img");
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img4',clsd_id='$clsID',mem_id='$mid' "); 
		  }else{			 	
			$img4=upload_file($mid,"file4","uploaded_files/classified_img");			 
			db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img4'
			where clsd_img_id='$autoID[3]' and  clsd_id='$clsID'and mem_id='$mid'");
			unlink_file('classified_img',$img_name[3]);
		  }
		}
	
		if($_FILES['file5']['name']!=""){
		  if($autoID[4]=="" || $autoID[4]=="0"){
			  $img5=upload_file($mid,"file5","uploaded_files/classified_img");
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img5',clsd_id='$clsID',mem_id='$mid' "); 
		  }else{			 	
			$img5=upload_file($mid,"file5","uploaded_files/classified_img");			 
			db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img5'
			where clsd_img_id='$autoID[4]' and  clsd_id='$clsID'and mem_id='$mid'");
			unlink_file('classified_img',$img_name[4]);
		  }
		}
		
		if($_FILES['file6']['name']!=""){
		  if($autoID[5]=="" || $autoID[5]=="0"){
			  $img6=upload_file($mid,"file6","uploaded_files/classified_img");
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img6',clsd_id='$clsID',mem_id='$mid' "); 
		  }else{			 	
			$img6=upload_file($mid,"file6","uploaded_files/classified_img");			 
			db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img6'
			where clsd_img_id='$autoID[5]' and  clsd_id='$clsID'and mem_id='$mid'");
			unlink_file('classified_img',$img_name[5]);
		  }
		}
		
		if($_FILES['file7']['name']!=""){
		  if($autoID[6]=="" || $autoID[6]=="0"){
			  $img7=upload_file($mid,"file7","uploaded_files/classified_img");
			  db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img7',clsd_id='$clsID',mem_id='$mid' "); 
		  }else{			 	
			$img7=upload_file($mid,"file7","uploaded_files/classified_img");			 
			db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img7'
			where clsd_img_id='$autoID[6]' and  clsd_id='$clsID'and mem_id='$mid'");
			unlink_file('classified_img',$img_name[6]);
		  }
		}
			
		if($_FILES['file8']['name']!=""){
			if($autoID[7]=="" || $autoID[7]=="0"){
				$img8=upload_file($mid,"file8","uploaded_files/classified_img");
				db_query("INSERT INTO `tbl_classified_image` SET cls_img_file='$img8',clsd_id='$clsID',mem_id='$mid' "); 
			}else{			 	
				$img8=upload_file($mid,"file8","uploaded_files/classified_img");			 
				db_query("UPDATE `tbl_classified_image` SET cls_img_file='$img8'
				where clsd_img_id='$autoID[7]' and  clsd_id='$clsID'and mem_id='$mid'");
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
				$sql=db_query("select * from tbl_classified_other where option_id ='$rw[option_id]' AND classifief_id=$clsID ORDER BY other_value");
				$num2=mysql_num_rows($sql);
				$rw2=mysql_fetch_array($sql);
				
				if($num2 == 0 ){
					//echo $rw['option_nom'].' '.$rw['option_id'].' '.$_REQUEST[$rw['option_id']];
					echo $sql="UPDATE `tbl_classif_option` 
						SET
							`val_id`='".$_REQUEST[$rw['option_id']]."'
							where option_id ='".$rw[option_id]."' AND classif_id='".$clsID."'";
							
					$sql_selected=db_query($sql);
				}
				else{
					//echo $rw['option_nom'].' '.$rw['option_id'].' '.$_REQUEST[$rw['option_id']];
					echo $sql="UPDATE `tbl_classified_other` 
						SET
							`other_value` = '".$_REQUEST[$rw['option_id']]."'
							WHERE option_id='".$rw['option_id']."'
							AND	classifief_id='".$clsID."'";
					
					db_query($sql);		
				}
				//------------------------------
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
//echo $sql_clsi_show="select clsi.*,clsimg.* from tbl_classified as clsi left join tbl_classified_image as clsimg on clsi.classified_id=clsimg.clsd_id where clsi.classified_id=$_REQUEST[clsId] and clsi.mem_id='".$_SESSION['signin']['mem_id']."' ";

	$meta_titles=strip_tags(truncateText($res[classified_title],150,' ','.',true));
	$meta_titles = ($res[classified_price_option]!=0) ? "Edit Annonces - ".$meta_titles." prix:".$res[classified_price_option].$link_curr : $meta_titles;
	$sm_title=strip_tags(truncateText($res[classified_title],40,' ','.',true));
	$sm_title = ($res[classified_price_option]!=0) ? "Edit Annonces - ".$sm_title." prix:".$res[classified_price_option].$link_curr : $sm_title;
	$meta_desc=strip_tags(truncateText($res[classified_desc],80,' ','.',true));
	$meta_keywords="Edit Annonces _ ".$sm_title;
	
	require_once("header.php");
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


<div class="heading">
    Modifier votre petite annonce:
</div>

<div class="body">
    
	<div class="account-link">
		<?php require_once("my_account_links.php"); ?>
	</div>
	<div class=""><?php echo Display_Message();?> </div>
    
    	<form id="frm" name="frm" action="?clsId=<?=$res[classified_id]?>" method="post" enctype="multipart/form-data">
            	<table width="100%" cellpadding="2" cellspacing="0" border="0">
                <tr>
                    <td colspan="2"><p class="fr"><span class="fs11">( <span class="star">* </span>)obligatoire.</span></p></td>
                </tr>
                <tr class="bg-stripcolor">
                    <td><span class="star">*</span> Catégorie : </td>
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
                        <div id="ogiga" style="display:inline-block" >
			        		<?php echo subsub_cat($res['clsd_sub_subcat_id'], $res['clsd_subcat_id']);?>
                        </div>
                        
                        <span id="msgboxogiga" style="display:none"></span>
                        <span id="msgtextogiga" style="display:none"></span> 
                    </td>
                </tr>
                
                <tr class="bg-stripcolor">
                    <td><span class="star">* </span>Titre :</td>
                    <td align="left">
                    <input name="classi_title" id="classi_title" type="text" class="textbox" value="<?php echo $res['classified_title'];?>" maxlength="60" />
                    <span id="msgboxtitle" style="display: none;"></span>   
                    <span id="msgtexttitle" style="display: none;"></span>                        
                    </td>           
                </tr>
                <tr>
                    <td><span class="star">*</span>Type d'annonce :</td>
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
                <td ><span class="star">*</span> Description  :</td>
                <td align="left">
                <br /><br />
                <textarea name="classi_desc" id="classi_desc" onblur="verif_nbre_caract(this)"  ><?php echo $res[classified_desc];?></textarea>
                    
                <span id="msgboxdesc" style="display: none;"></span>
                <br />
                <span id="msgtextdesc" ></span>
                <?php //get_fck_editor_small('classi_desc',$classi_desc);?> </td>
                </tr>
                
                <tr height="20">
                <td height="30"><!--<span class="star">*</span>--> Prix <?php echo $link_curr;?> :</td>
                <td height="30" align="left">
                
                    <input name="classi_price" id="classi_price" type="text" class="textbox"  style="width:100px;" onkeyup="check(this);" onKeyDown="document.frm.my_offer.disabled='disabled';" onBlur="if(this.value==''){document.frm.my_offer.disabled='';}" value="<?php echo $res['classified_price_option'];?>" />
                    
                    &nbsp;ou choisir:
                    		
                    <select name="my_offer" style="width:200px;" onchange="document.frm.classi_price.disabled='disabled';" onBlur="if(this.value==''){document.frm.classi_price.disabled='';}">
                        <option value="">Choisir une</option>
							<?php foreach($Offers_arr as $key=>$val){
                            	$sel= $res['offer']==$val ? "selected" : "";
                            ?>					  
                        <option value="<?php echo $val;?>" <?php echo $sel;?> ><?php echo $val;?></option>                     
                        <?php } ?>
                      </select>
                      
                <span id="msgboxprice" style="display: none;"></span>
                <span id="msgtextprice" style="display: none;"></span>
                </td>
                </tr>
                <tr class="bg-stripcolor">
                <td valign="top">Télécharger Images :</td>
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
                <input name="file1" id="file1" type="file" class="textbox1" size="44" onChange="readURL(this,blah1);" /><?php echo $link[0];?><br />
                <input name="file2" id="file2" type="file" class="textbox1" size="44" onChange="readURL(this,blah2);" /><?php echo $link[1];?><br />
                <input name="file3" id="file3" type="file" class="textbox1" size="44" onChange="readURL(this,blah3);" /><?php echo $link[2];?><br />
                <input name="file4" id="file4" type="file" class="textbox1" size="44" onChange="readURL(this,blah4);" /><?php echo $link[3];?><br />
                <input name="file5" id="file5" type="file" class="textbox1" size="44" onChange="readURL(this,blah5);" /><?php echo $link[4];?><br />
                <input name="file6" id="file6" type="file" class="textbox1" size="44" onChange="readURL(this,blah6);" /><?php echo $link[5];?><br />
                <input name="file7" id="file7" type="file" class="textbox1" size="44" onChange="readURL(this,blah7);" /><?php echo $link[6];?><br />
                <input name="file8" id="file8" type="file" class="textbox1" size="44" onChange="readURL(this,blah8);" /><?php echo $link[7];?><br />
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
                
                <tr>
                    <td colspan="2">
                        <div id="omega" style="display:inline-block" >
                                <?php
                                    if($res['clsd_sub_subcat_id']!=0 && $res['clsd_sub_subcat_id']!=''){
                                    $cat=$res['clsd_sub_subcat_id'];
                                    }
                                    else{
                                    $cat=$res['clsd_subcat_id'];
                                    }
                                    
                                    echo edit_option_subsub_cat($cat, $clsID);
                                ?>
                        </div>
                    </td>
                </tr>
                
                <tr class="bg-stripcolor">
                <td>Addresse :</td>
                <td align="left">
                <textarea name="classi_address" id="classi_address" rows="3" class="textbox"><?php echo $res['classified_poster_street'];?></textarea>
                <span id="msgboxaddress" style="display: none;"></span>
                <span id="msgtextaddress" style="display: none;"></span>
                </td>
                </tr>
                <tr class="bg-stripcolor">
                <td><span class="star">*</span> Province :</td>
                <td align="left">
                
        <select name="classi_state" id="classi_state" class="textbox" onChange="get_city_by_state_mobile(this.value,'')" data-native-menu="false" required >
            <?php echo get_state($res[classified_poster_state]);?>
        </select>
        
                    
                    <span id="msgboxstate" style="display: none;"></span>
                    <span id="msgtextstate" style="display: none;"></span>
                </td>
                </tr>
                <tr class="bg-stripcolor">
                    <td><span class="star">*</span> Ville :</td>
                    <td align="left">
                                    
                        <div id="bloc_city" style="display:block" >
                            <select name="classi_city" id="classi_city" class="textbox" data-native-menu="false" required />
                                <?php echo Get_city($res[classified_city_id], $res[classified_poster_state]);?>
                            </select>
                        </div>
                        
                        <span id="msgboxcity" style="display: none;"></span>
                        <span id="msgtextcity" style="display: none;"></span>
                    </td>
                </tr>
                <tr class="bg-stripcolor">
                    <td><span class="star">*</span> Code postal :</td>
                    <td align="left">
                        <input name="classi_zipcode" id="classi_zipcode" type="text" maxlength="5" class="textbox" style="width:305px;" value="<?php echo $res[classified_poster_zipcode];?>" onkeyup="check(this);"/>
                        <span id="msgboxzipcode" style="display: none;"></span>
                        <span id="msgtextzipcode" style="display: none;"></span>
                    </td>
                </tr>
                <tr>
                <td>Téléphone : </td>
                <td align="left">
                <input name="contact_number" type="text" min="6" maxlength="20" class="textbox"  style="width:305px;" value="<?php echo $res[contact_number];?>"/>
                </td>
                </tr>
                <tr>
                    <td>Fax :</td>
                    <td align="left">
                    <input name="clas_fax" type="text" class="textbox"  maxlength="20" style="width:305px;" value="<?php echo $res[classi_fax];?>"/>
                    </td>
                </tr>  
                <tr>
                    <td align="center" style="padding-top:10px;" colspan="2">
                        <input type="hidden" name="classi_email" id="classi_email" value="<?php echo $res[classified_poster_email];?>" />
                        
                        <input name="button5" type="submit" class="button button-green" id="editer-annonce" value="Enregistrer"/>
                        <input type="hidden" name="action" id="hiddenField" value="updateNow" />
                        
                        <span id="msgtextverifier" style="display: none;"></span>
                    </td>
                </tr>
            </table>
        </form>
	</div>   

</div>

<?php require_once("footer.php"); ?>