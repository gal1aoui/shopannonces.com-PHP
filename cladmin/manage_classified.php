<?php
$paid_category_amount=get_config_setting(10);
if(is_post_back()) {
	$arr_pd_ids = $_REQUEST['arr_pd_ids'];
	if(is_array($arr_pd_ids)) {
		$str_classified_ids = implode(',', $arr_pd_ids);
		//exit();
		
		if(isset($_REQUEST['Delete']) || isset($_REQUEST['Delete_x']) ) {
			$sql = "update tbl_classified SET classified_status = 'Delete' where classified_id in ($str_classified_ids)";		
			db_query($sql);
			$_SESSION['site_admin_message']="Classifieds has been Deleted successfully.";
			header("Location: ".$_SERVER['HTTP_REFERER']);
			exit();
		}
		else if(isset($_REQUEST['Changement']) || isset($_REQUEST['Changement_x']) ) {
			echo $classified_id=$_REQUEST['Changement'];

			header("Location: changement.php?retour=".$_SERVER['HTTP_REFERER']."&classified_id=".$classified_id);
			exit();
		}
		else if(isset($_REQUEST['Activate']) || isset($_REQUEST['Activate_x']) ) {
		 	$sql = "update tbl_classified SET classified_status = 'Active' where classified_id  in ($str_classified_ids)";
		   	db_query($sql);
			
			$result_email=db_query("select * from tbl_member,tbl_classified
			 						where 
										tbl_member.mem_id=tbl_classified.mem_id
									AND
										tbl_classified.classified_id  in ($str_classified_ids)");

			while ($line_email = mysql_fetch_array($result_email)) 
		 	{
				if( getMemberStatus($line_email[mem_id]) && getMemberRembourseParrain($line_email[mem_id]))
				{
					SetCreditParrainId(getMemberParrainId($line_email[mem_id]), 1);
					
					$sql_credit="UPDATE `tbl_member` SET  rembourseparrain='N' WHERE `mem_id`=".$line_email[mem_id];		
					db_query($sql_credit) or die(mysql_error());
				}
				
				$namead=$line_email[classified_title];
				$clsId=$line_email[classified_id];
				$mem_id=$line_email[mem_id];
				$rand_key=$line_email[register_key];
			
			
				/****Send mail active ads***************************/
				$link=REDIRECT_SERVER."/activer.php?key=".$rand_key."&ui=".$mem_id."&nextpage=classified-preview.php&clsId=".$clsId;
				
				$email_subject	=	$line_email[classified_poster_name].": Votre petite annonce ' {namead} ' a été publiée.";
					
				$AnnonceCouleur=(strtotime(MYSQL_DATE_TIME) < strtotime($line_email[date_fin_couleur])) ? 'couleur' : '';
				$AnnoncePremium=(strtotime(MYSQL_DATE_TIME) < strtotime($line_email[date_fin_premium])) ? 'PREMIUM' : ''; 
				$AnnonceUrgent=strtotime(MYSQL_DATE_TIME) < strtotime($line_email[date_fin_urgent]) ? 'URGENT' : ''; 
				$AnnonceRepublication=(strtotime(MYSQL_DATE_TIME) < strtotime($line_email[date_fin_republication])) 
									? 'Republication' : '';
				$body = '<table style="clear:both;border:1px solid #E3E3E3;border-radius:3px;max-width:622px;text-align:left;padding:10px 5px;width:100%;background-color:#ffffff;">
			<tbody>
				<tr>
				<td style="padding-left:10px;padding-right:10px;width:100%;">
					<div style="font-family:Arial, sans-serif;font-size:14px;color:#1b1a19;">
					Bonjour {username}, <br>
							Votre annonce <b>{namead}</b> est en ligne. <br>
							Pour prévisualiser votre annonce <a href=\'{link}\'>cliquez ici</a>. <br> <br>
							Si le lien est inactif, vous pouvez copier l\'url ci dessous dans la barre d\'adresse de votre navigateur internet<br><br>
							{link}
							<br>
					</div>
				</td>
				</tr>
			</tbody></table><br>';
				
				//Ajouter des photos							
				if(getNumberPhoto($line_email[classified_id])==0){
					
					$link_addPhoto='<a href="'.REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'&nextpage=edit-my-post.php&clsId='.$clsId.'" style="font-family:Arial, sans-serif;padding:7px 15px;background-color:#86C222;color:#fff;font-size:14px;width:278px;border-radius:2px;border:solid 1px #86C222;text-decoration:none;text-align:center;height:15px;font-weight:bold;" target="_blank">Ajouter des photos</a>';
					
					$body.= '<table style="clear:both;border:1px solid #E3E3E3;border-radius:3px;max-width:622px;text-align:left;padding:10px 5px;width:100%;background-color:#ffffff;">
			<tbody>
				<tr>
				<td style="padding-left:10px;padding-right:10px;width:100%;">
				<div style="font-family:Arial, sans-serif;font-size:14px;color:#1b1a19;">
				Attention ! Vous n’avez mis aucune photo sur votre annonce "<b>{namead}</b>"
				<br><br>
				<div style="text-align:center;">
					'.$link_addPhoto.'
				</div>
				<br><br>
				Les photos sont votre vitrine...<br><br>
				Prouvé et rapporté par les meilleurs vendeurs : six photos minimum sont nécessaires pour illustrer correctement une petite annonce.<br><br>
				On vous en propose huit, gratuites. Profitez-en !
				</div></td></tr></tbody></table>
				<br>';
				}
				
				//offrez une meilleur visibilté
				if($AnnonceCouleur=="" && $AnnoncePremium=="" && $AnnonceUrgent=="" && $AnnonceRepublication==""){
					
					$link_premium='<strong><a href="'.REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'&nextpage=my-account-classified-preview.php&clsId='.$line_email[classified_id].'&date_fin_premium=y" style="font-family:Arial, sans-serif;display:inline-block;padding:5px 5px;background-color:#86C222;color:#fff;font-size:14px;width:150px;border-radius:2px;border:solid 1px #86C222;text-decoration:none;text-align:center;height:15px;" target="_blank" class="c_nobdr t_prs">Choisir cette offre</a></strong>';
					
					$link_couleur='<strong><a href="'.REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'&nextpage=my-account-classified-preview.php&clsId='.$line_email[classified_id].'&date_fin_couleur=y" style="font-family:Arial, sans-serif;display:inline-block;padding:5px 5px;background-color:#86C222;color:#fff;font-size:14px;width:150px;border-radius:2px;border:solid 1px #86C222;text-decoration:none;text-align:center;height:15px;" target="_blank" class="c_nobdr t_prs">Choisir cette offre</a></strong>';
					
					$link_republication='<strong><a href="'.REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'&nextpage=my-account-classified-preview.php&clsId='.$line_email[classified_id].'&date_fin_republication=y" style="font-family:Arial, sans-serif;display:inline-block;padding:5px 5px;background-color:#86C222;color:#fff;font-size:14px;width:150px;border-radius:2px;border:solid 1px #86C222;text-decoration:none;text-align:center;height:15px;" target="_blank" class="c_nobdr t_prs">Choisir cette offre</a></strong>';
					
					$body.= '<table style="clear:both;border:1px solid #E3E3E3;border-radius:3px;max-width:622px;text-align:left;padding:10px 5px;width:100%;background-color:#ffffff;">
			<tbody>
			<tr>
				<td width="100%" style="padding-left:10px;padding-right:10px;" colspan="2">
					<h1 style="color:#626364;font-weight: bold;font-size: 20px;">               
						<span class="vs-step-subtitle" id="vs-featured-step-caption">
							Offrez une meilleure visibilité à votre annonce
						</span>
					</h1>
				
				
					<font style="font-family:Arial, sans-serif;font-size:14px;color:#1b1a19;">
					Augmentez dès aujourd\'hui la visibilité de votre annonce \'<b>{namead}</b>\' et recevez plus de contacts.<br><br>
					On vous propose 3 options de mise en avant :			
					</font>
				</td>						
			</tr>
			<tr>
				<td colspan="2"><hr></td>
			</tr>
			<tr>
				<td valign="middle">
					<font style="font-family:Arial, sans-serif;font-size:14px;color:#1b1a19;">
						<div id="personel_y">
							<form id="upgrade_form" method="POST" action="">
								<input type="hidden" name="clsId" id="clsId" value="1963">					
								<table>
									<tr>
										<td>
											<img src="'.REDIRECT_SERVER.'/images/premium.png" height="85" width="160">
										</td>
										<td>
											<div class="plan-block">
												<h3>Annonce Premium</h3>
												<p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p>															
											</div>		
											
											'.$link_premium.'
										</td>
									</tr>
									<tr>
										<td colspan="2"><br></td>
									</tr>
									<tr>
										<td>
											<img src="'.REDIRECT_SERVER.'/images/couleur.png" height="85" width="160">
										</td>
										<td>
											<div class="plan-block">
												<h3>Annonce en Couleur</h3>
												<p class="commentaire">Votre annonce sera surlignée en orange</p>															
											</div>
											
											'.$link_couleur.'
										</td>
									</tr>
									<tr>
										<td colspan="2"><br></td>
									</tr>
									<tr>
										<td>
											<img src="'.REDIRECT_SERVER.'/images/republication.png" height="85" width="160">
										</td>
										<td>
											<div class="plan-block">
												<h3>Republication Auto</h3>
												<p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste tous les jours</p>
											</div>
											
											'.$link_republication.'
										</td>
									</tr>
								</table>
							</form>
						</div>
					</font>
				</td>	
			</tr>
</tbody></table>';
				}
				
				//$body=nl2br($body);
				//$body=html_mail_content($body);
				
				$body			=	str_replace('{username}',$line_email[classified_poster_name],$body);
				$body			=	str_replace('{namead}',$namead,$body);
				$body			=	str_replace('{link}',$link,$body);
				$email_subject	=	str_replace('{namead}',$namead,$email_subject);
				
				$email_to		=	$line_email[classified_poster_email];
				$email_toname	=	$line_email[classified_poster_name];
				
						
	            //@mail($email_to, $email_subject, $body, $header);
				sent_mail($email_to,$email_subject,$body);
				/******************************/				
			}
			$_SESSION['site_admin_message']="Classifieds has been activated successfully.";
			header("Location: ".$_SERVER['HTTP_REFERER']);
			exit();
		}
		else if(isset($_REQUEST['Rappel']) || isset($_REQUEST['Rappel_x'])){
			
			$result_email=db_query("select * from tbl_member,tbl_classified
			 						where 
										tbl_member.mem_id=tbl_classified.mem_id
									AND 
										tbl_classified.classified_status!='Delete'
									AND 
										tbl_classified.classified_status!='Inactive'
									AND
										tbl_classified.classified_id  in ($str_classified_ids)");

			while ($line_email = mysql_fetch_array($result_email)) 
		 	{
				/****Send mail active ads***************************/
				
				$namead=$line_email[classified_title];
				$adsId=$line_email[classified_id];
				$link=REDIRECT_SERVER."/classified-details.php?clsId=".$line_email[classified_id];
				$email_subject	=	$line_email[classified_poster_name].": Augmenter la visibilite de votre annonce: {namead}.";

				$imgPre=REDIRECT_SERVER."/images/premium.png";
				$imgCol=REDIRECT_SERVER."/images/couleur.png";
				$imgRep=REDIRECT_SERVER."/images/republication.png";
				
				$mem_id=$line_email[mem_id];
				$rand_key=$line_email[rand_key];
				
				$linkPremium=REDIRECT_SERVER."/activer.php?key=".$rand_key."&ui=".$mem_id."&nextpage=my-account-classified-preview.php&clsId=".$adsId."&date_fin_premium=y";
				
				$linkCouleur=REDIRECT_SERVER."/activer.php?key=".$rand_key."&ui=".$mem_id."&nextpage=my-account-classified-preview.php&clsId=".$adsId."&date_fin_couleur=y";
				
				$linkRepublication=REDIRECT_SERVER."/activer.php?key=".$rand_key."&ui=".$mem_id."&nextpage=my-account-classified-preview.php&clsId=".$adsId."&date_fin_republication=y";

				$body= '<table align="center" border="0" cellspacing="10" cellpadding="5" width="100%" bgcolor="#ffffff" style="clear:both;border:1px solid #E3E3E3;border-radius:3px;max-width:622px;">
			<tbody>
			<tr>
				<td width="100%" style="padding-left:10px;padding-right:10px;" colspan="2">	
					<font style="font-family:Arial, sans-serif;font-size:14px;color:#1b1a19;">
					Augmentez dès aujourd\'hui la visibilité de votre annonce \'<b>{namead}</b>\' et recevez plus de contacts.<br><br>
					On vous propose 3 options de mise en avant :			
					</font>
				</td>						
			</tr>
			<tr>
				<td colspan="2"><hr></td>
			</tr>
			<tr>
				<td valign="middle">
					<h1 style="color:#626364;font-weight: bold;font-size: 20px;">               
						<span class="vs-step-subtitle" id="vs-featured-step-caption">
							Offrez une meilleure visibilité à votre annonce
						</span>
					</h1>
					<font style="font-family:Arial, sans-serif;font-size:14px;color:#1b1a19;">
						<div id="personel_y">
							<form id="upgrade_form" method="POST" action="">
								<input type="hidden" name="clsId" id="clsId" value="1963">					
								<table>
									<tr>
										<td>
											<img src="'.$imgPre.'" height="85" width="160">
										</td>
										<td>
											<div class="plan-block">
												<h3>Annonce Premium</h3>
												<p class="commentaire">Votre annonce sera placée au dessus des annonces gratuites</p>															
											</div>
											<strong>
<a href="'.$linkPremium.'" style="font-family:Arial, sans-serif; display:inline-block; padding:5px 5px; background-color:#86C222; color:#fff; font-size:14px; width:150px; border-radius:2px; border:solid 1px #86C222; text-decoration:none; text-align:center; height:15px;" target="_blank" >
Choisir cette offre
</a>
											</strong>
										</td>
									</tr>
									<tr>
										<td colspan="2"><br></td>
									</tr>
									<tr>
										<td>
											<img src="'.$imgCol.'" height="85" width="160">
										</td>
										<td>
											<div class="plan-block">
												<h3>Annonce en Couleur</h3>
												<p class="commentaire">Votre annonce sera surlignée en orange</p>															
											</div>
											<strong>
<a href="'.$linkCouleur.'" style="font-family:Arial, sans-serif; display:inline-block; padding:5px 5px; background-color:#86C222; color:#fff; font-size:14px; width:150px; border-radius:2px; border:solid 1px #86C222; text-decoration:none; text-align:center height:15px;" target="_blank">
Choisir cette offre
</a>
											</strong>
										</td>
									</tr>
									<tr>
										<td colspan="2"><br></td>
									</tr>
									<tr>
										<td>
											<img src="'.$imgRep.'" height="85" width="160">
										</td>
										<td>
											<div class="plan-block">
												<h3>Republication Auto</h3>
												<p class="commentaire">Votre annonce sera automatiquement republiée en tête de liste tous les jours</p>
											</div>
											<strong>
<a href="'.$linkRepublication.'" style="font-family:Arial, sans-serif; display:inline-block; padding:5px 5px; background-color:#86C222; color:#fff; font-size:14px; width:150px; border-radius:2px; border:solid 1px #86C222; text-decoration:none; text-align:center height:15px;" target="_blank">
Choisir cette offre
</a>
											</strong>
										</td>
									</tr>
								</table>
							</form>
						</div>
					</font>
				</td>	
			</tr>
</tbody></table>';
				
				$body			=	str_replace('{username}',$line_email[classified_poster_name],$body);
				$body			=	str_replace('{namead}',$namead,$body);
				$body			=	str_replace('{link}',$link,$body);
				
				$email_subject	=	str_replace('{namead}',$namead,$email_subject);
				$email_to		=	$line_email[classified_poster_email];				
				$email_toname	=	$line_email[classified_poster_name];
				
				
				sent_mail($email_to,$email_subject,$body);
				/******************************/
						
				
			}
			
			$_SESSION['site_admin_message']="Rappel has been sended successfully.";
			//exit;
			header("Location: ".$_SERVER['HTTP_REFERER']);
			exit();
		}
		else if(isset($_REQUEST['Deactivate']) || isset($_REQUEST['Deactivate_x']) ) {		
			$sql = "update tbl_classified set classified_status = 'Inactive' where classified_id in ($str_classified_ids)";			
			db_query($sql);		
			$_SESSION['site_admin_message']="Classifieds has been deactivated successfully.";
			header("Location: ".$_SERVER['HTTP_REFERER']);
	        exit();
		}
	}
	exit();
}
if(isset($_REQUEST['val']) && isset($_REQUEST['id']) ) {
	$featured=($classified_featured =="Yes") ? "Set" : "Unset";
	$sql = "update tbl_classified SET classified_featured = '$_REQUEST[val]' where classified_id=$_REQUEST[id] ";
	db_query($sql);
	$_SESSION['site_admin_message']="Classifieds has been $featured successfully.";
	header("Location:land.php?file=manage_classified");
	exit();
}

if(@$_REQUEST["recv"]!="" && @$_REQUEST["recv"]>0 ){
    $sql = "UPDATE ".DB.".tbl_classified  SET classified_status  ='Active',paid_status='Paid',paid_cat_amount='$paid_category_amount' 
    WHERE classified_id  =$_REQUEST[recv]";		
    db_query($sql);
    $_SESSION['site_admin_message']="Classified Paid  Activate Successfully.........";
    header("Location: ".$_SERVER['HTTP_REFERER']);
	exit();		
}

$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from tbl_classified ";
//classified_status!='Delete'
$sql.= " where  1 ";

if(@$classified_cat_id!=""){
$fl=$classified_cat_id;
  $sql.=	" And classified_cat_id='$classified_cat_id' ";
}

if(@$classified_subcat_id!=""){
$fl=$classified_subcat_id;
  $sql.=	" And classified_subcat_id='$classified_subcat_id' ";
}

if(@$classified_city_id!=""){
  $sql.=	" And classified_city_id='$classified_city_id' ";
}

if(@$classified_poster_state!=""){
  $sql.=	" And classified_poster_state='$classified_poster_state' ";
}

if(@$from_date!=''){
$x_f=explode('-',$from_date);
$f=$x_f[2]."-".$x_f[0]."-".$x_f[1];
$sql	.=	" And Date(classified_post_date) >='$from_date' ";
}

if(@$to_date!=''){
$y_t=explode('-',$to_date);
$t=$y_t[2]."-".$y_t[0]."-".$y_t[1];
$sql.=	" And Date(classified_post_date) <='$to_date' ";
}
$keyword=@$_REQUEST["keyword"];
if($keyword!=''){
$sql.=" And (classified_id like '%".$keyword."%' or classified_title like '%".$keyword."%' or clsd_cat_id In (select cat_id from tbl_category where cat_name like '%".$keyword."%' And cat_status!='Delete') or clsd_subcat_id In (select cat_id from tbl_category where cat_name like '%".$keyword."%' And cat_status!='Delete') or classified_city_id In (select city_id from tbl_city where city_status!='Delete' And city_name like '%".$keyword."%') or classified_desc like '%".$keyword."%' Or  classified_poster_email like '%".$keyword."%' or paid_status like '%".$keyword."%' or classified_key like '%".$keyword."%')";
}

if(@$_REQUEST[stateId]!=""){
 $columns = "select * ";
  $sql = " from tbl_classified  where classified_poster_state =$_REQUEST[stateId] ";
}

if(@$_REQUEST[cityId]!=""){
 $columns = "select * ";
  $sql = " from tbl_classified  where classified_city_id =$_REQUEST[cityId] ";
}

if(@$_REQUEST['sortcls']!=""){
 $columns = "select * ";
 // classified_status!='Delete' AND
  $sql = " from tbl_classified  where clsd_cat_id like '%$_REQUEST[cat_level_root]%' and clsd_subcat_id like '%$_REQUEST[cat_level_one]%' and   clsd_sub_subcat_id like '%$_REQUEST[cat_level_two]%' ";
}	 

@$order_by == '' ? $order_by = 'classified_update_date' : true;
@$order_by2 == '' ? $order_by2 = 'desc' : true;
$sql_count = "select count(*) ".$sql; 
$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);

$reccnt = db_scalar($sql_count);

echo PageTitle("Manage Classified");
?>


<form method="get" name="form2" id="form2"  action="" >
        <br>
        <table width="90%"  border="0" align="center" cellspacing="0"  class="lightBorder">
			<div class="msg"><?php echo display_sess_msg()?></div>
            <tr align="left">
                <th colspan="3">Search Classified</th>
            </tr>
            <tr>
				<td width="23%" align="left" class="tdLabel">
					<strong>Keyword : </strong>
				</td>
				<td colspan="2" align="left" class="tdLabel">
					<input type="hidden" name="file" value="manage_classified" />
					<input name="keyword" type="text" class="textfield3" value="<?php echo $keyword;?>"  size="45"/>
					( Poster Name, Poster Email, Classified Title, Ad-ID)              
				</td>
			</tr>
            <tr>
              <td align="left" class="tdLabel">&nbsp;</td>
              <td align="left" class="tdLabel">&nbsp;</td>
              <td align="left" class="tdLabel">&nbsp;</td>
            </tr><!--
            <tr><td width="23%" align="left" class="tdLabel"><strong>From</strong>:</td>
                <td width="16%" align="left" valign="top" class="tdLabel"><?php //echo get_date_picker("from_date",$from_date,'','');?></td>
                <td width="61%" align="left" valign="top" class="tdLabel"><strong>To</strong>: 
                <?php //echo get_date_picker("to_date",$to_date,'','');?></td>
			</tr>-->
            <tr>
              <td align="left" class="tdLabel">&nbsp;</td>
              <td align="center" class="tdLabel">&nbsp;</td>
              <td align="center" class="tdLabel">&nbsp;</td>
            </tr>
            <tr><td width="23%" align="left" class="tdLabel">&nbsp;</td>
                <td align="left" class="tdLabel">				
                  <input type="submit" class="btn_orange" name="search" value="Search"></td>
                <td align="center" class="tdLabel">&nbsp;</td>
          </tr>
       </table>
</form>
	   
<br /><br />  
<form name="form3" method="get" action="">
	 <table width="100%"  border="0" align="center" bgcolor="#D8D8D8">
	   <tr>
	     <td  align="left"><strong>Sort by:</strong></td>
	     <td   align="left"><strong>Category :</strong></td>
	     <td align="left"><strong>Subcategory : </strong></td>
	     <td  align="left"><strong>Sub subategory :</strong></td>
	     <td align="left"><input type="hidden" name="file" value="manage_classified"></td>
       </tr>
	   <tr>
			<td align="left">&nbsp;</td>
			<td align="left"><select name="cat_level_root" onChange="Acat_drop_down(this.value,'')">
				<?php echo Root_cat($_REQUEST[cat_level_root]);?>
				</select>
				<?php if($_REQUEST[cat_level_root]!="") { ?>
					<script language="javascript">
						Acat_drop_down('<?php echo $_REQUEST[cat_level_root];?>','<?php echo $_REQUEST[cat_level_one];?>')
					</script>
			<?php } ?>
			</td>
			<td align="left">
				<div id="cat_tree1">
					<select name='cat_level_one' onChange="Acat_drop_down2(this.value,'')" />
						<option value="">Select subcategory</option>
					</select>
				</div>
				<?php
				if(@$_REQUEST['cat_level_one']!="") { ?>
					<script language="javascript">
						Acat_drop_down2('<?php echo $_REQUEST['cat_level_one'];?>','<?php echo $_REQUEST['cat_level_two'];?>')
					</script>
				<?php } ?>
			</td>
			<td  align="left">
				<div id="cat_tree2">
					<select name="cat_level_two" id="cat_level_two" >
						<option value="">Select Sub subcategory</option>
					</select>
				</d
			><td align="left">		 
				<input type="submit" name="Submit" value=" Go ">
				<input type="hidden" name="sortcls" value="yes">
			</td>
       </tr>
	   <tr>
    	   <td width="7%"  align="left">&nbsp;</td>
    	   <td width="25%"   align="center">&nbsp;
   	      </td>
  	       <td width="31%" align="center">
  	           <div id="cat_tree1">		     </div>				  
		   </td>
  	       <td width="24%"  align="center"> 
		 <div id="cat_tree2">		     </div>	   </td>
  	       <td width="13%" align="left">&nbsp;           </td>
   	    </tr></table>
</form>
	  
 <br /><br />      
 <?php
 //echo $sql;
 
  if(mysql_num_rows($result)==0){?>
	<div class="msg">Sorry, no records found.</div>
 <?php 
 }
 else{ ?>
	  <table width="100%"  border="0" align="center" cellspacing="0"  cellpadding="4"  class="Datatable">
    	 
    	 <tr>
            <td align="left"><span class="tdLabel bold">Records Per Page:<?php echo pagesize_dropdown('pagesize', $pagesize);?></span></td>
            <td colspan="3" align="right"><span class="tdLabel bold">Showing Records:
            	<?php echo $start+1?> to <?php echo ($reccnt<$start+$pagesize)?($reccnt-$start):($start+$pagesize)?> of <?php echo $reccnt?>
              </span>
            </td>
	     </tr>	
      </table>
   <form id="form1" name="form1" method="post" action="">
      <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
        <tr>
          <th align="center">ID Annonce</th>
          <th align="center" >Poster Name <?php echo sort_arrows('classified_poster_name');?></th>
          <th>Payment status</th>
	     <th width="10px">Number of member ads</th>
          <th width="10px" align="center" >Poster Email <?php echo sort_arrows('classified_poster_email');?> </th>
          <!--<th>Member Status</th>-->
          <th width="100px" align="center" >Posted Date<?php echo sort_arrows("classified_post_date");?></th>     
          <th width="100px" align="center" >Final Category </th>
          <th width="150px" align="center" >Classified Title </th>
          <th width="10px" align="center" >View Details</th>
          <th width="10px" align="center" >Status
          <?php echo sort_arrows("classified_status");?></th>
          <th width="10px">Nbre visited</th>
          <th width="10px">Nbre Contact</th>
          <th width="10px" align="center">
            <input name="check_all" type="checkbox" id="check_all" value="1" onClick="checkall(this.form)" />
          </th>
        </tr>
		<?php while ($line_raw = mysql_fetch_array($result)) 
		 {				
                
                
		   @extract($line_raw);
		   $css = ($css=='trOdd')?'trEven':'trOdd';
		   $featured=($classified_featured =="Yes") ? "Unset" : "Set";
		   $val=($classified_featured =="Yes") ? "No" : "Yes";
		     
				$sql_status = "SELECT * FROM tbl_member WHERE mem_id  =$mem_id";		
				$result_status=db_query($sql_status);
				$rst=mysql_fetch_array($result_status);
                
		   $color_ligne = ($rst[mem_status]=='Y')?'#FFFFFF':'#FFAB66';
		?>
        <tr  bgcolor="<?php echo $color_ligne;?>" style="border-bottom:#999 1px solid">
            <td>
            	<?php echo $classified_id;?>
            </td>
			<td align="center">
            	<a href="javascript:poptastic('userDetail.php?id=<?php echo $mem_id; ?>');">
					<?php if($classified_poster_name!="")
							echo $classified_poster_name;
						else
							echo "_";?>
				</a>
			</td>
            <td>
            	<?php
				/*
$date_comp=date('y-m-d h:i:s', strtotime('+1 days'));
echo $AnnonceCouleur=(strtotime($date_comp) < strtotime($date_fin_couleur)) ? 'COULEUR' : ''; 
echo '<br>';
echo $Urgent=(strtotime($date_comp) < strtotime($date_fin_urgent))? 'URGENT':'';
echo '<br>';
echo $AnnoncePremium=(strtotime($date_comp) < strtotime($date_fin_premium)) ? 'PREMIUM' : ''; 
echo '<br>';
echo $AnnonceRepublication=(strtotime($date_comp) < strtotime($date_fin_republication)) ? 'REPUBLICATION' : ''; 
*/

									$sql = "SELECT * 
											FROM tbl_featured_option, tbl_facturer, tbl_facture, tbl_classified
											WHERE
												tbl_classified.classified_id = '".$classified_id."'
											AND tbl_classified.classified_id = tbl_facture.classified_id  
											AND tbl_facture.facture_id = tbl_facturer.facture_id  
											AND tbl_facturer.featured_id  = tbl_featured_option.featured_id";
												
									$rs_option=db_query($sql);	
									while ($line_option = mysql_fetch_array($rs_option)) 
									{
										echo '<span class="premium">'.$line_option[featured_designation].'</span> <br>';
									}
				?>
            </td>
            <td>
            <?php
				$sql_count = "SELECT * FROM tbl_classified WHERE mem_id  =$mem_id";// AND classified_status!='Delete'";		
				$result_count=db_query($sql_count);
			?>
            	<a href="land.php?file=manage_classified&keyword=<?php echo $classified_poster_email;?>&search=Search">
					<?php echo mysql_num_rows($result_count);?>
                </a>
            </td>
			<td align="center"><?php echo $classified_poster_email;?></td>
            <!--
            <td align="center">
            	<?php if($rst[mem_status]=='Y')
						echo "Active";
					else
						echo "Inactive";?>
            </td>-->
			<td align="center"><?php echo front_date_format($classified_post_date);?></td>
			<td align="left"><?php echo get_catinfo($clsd_sub_subcat_id,'cat_name');?></td>
			<td align="left"><?php echo ucfirst(truncateText($classified_title,80,' ','...',true));?></td>
			<td align="center"><a href="classified_details.php?clsId=<?php echo $classified_id ; ?>" target="_blank"><b><font color="#FF0000">Click</font></b></a></td>
			<td align="center">
				<?php echo $classified_status;?>
			</td>
            <td>
            	<?php echo $visites=classified_visits($classified_id); ?>
            </td>
            <td>
            	<?php echo $contact=classified_contacts($classified_id); ?>
            </td>
			<td align="center">
				<input name="arr_pd_ids[]" type="checkbox" id="arr_pd_ids[]" value="<?php echo $classified_id;?>" />
			</td>
			<td align="center">
            	<input name="Changement" type="image" id="Changement" value="<?php echo $classified_id;?>" src="images/buttons/changement.jpg" onClick="return ChangeConfirmFromUser(this)"/>
            </td>
        </tr>
        <?php }?>
      </table>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="right" style="padding:2px">
				<input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
				<input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/> 
				<input name="Rappel" type="image" id="Rappel" src="images/buttons/rappel.gif" onClick="return rappelConfirmFromUser('arr_pd_ids[]')"/>
                <a href="rappelrenouvellement.php" target="_blank"><b>Alert Expiration</b></a> 
				<input name="Delete" type="image" id="Delete" src="images/buttons/delete.gif" onClick="return deleteConfirmFromUser('arr_pd_ids[]')"/>
		    </td>
          </tr>
		</table>
   </form>
<?php }
include("paging.inc.php");?>