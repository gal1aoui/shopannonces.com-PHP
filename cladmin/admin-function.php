<?php

/* Function set page title in all admin  pages */
function PageTitle($title)
{
 $var="<table width='100%' border='0' cellspacing='0' cellpadding='0'>
	  <tr>
		<td class='myTitle' align='left'>".$title."</td>
	  </tr>
	</table>
	<hr color='#ccc000'><tr><td>".Display_Message()."</td></tr>";
return $var;
}

function check_classified_exits($catId){
 if($catId!=""){
    $sql="select clsd_sub_subcat_id,classified_status from tbl_classified where clsd_sub_subcat_id in ($catId) and 	classified_status!='Delete'";  
      $re1=mysql_query($sql);
	  $num=mysql_num_rows($re1);
	 }
return $num;
}

function Root_cat($id=""){	 
	  $sql_cat=mysql_query("select * from tbl_category where cat_parent ='0' order by cat_order");
	  $num=mysql_num_rows($sql_cat);
	  $var= '<option value="">Select Category</option>';
	  if($num > 0 )
	  {
	      while($rw=mysql_fetch_array($sql_cat))
	      { 
		  if($rw[cat_id]==$id){		 
		     $sel="selected";
		   }else{  $sel="";	}  
		  $var.='<option value="'.$rw[cat_id].'" '.$sel.' >'.$rw[cat_name].'</option>';
		
	       }
	   }
return $var;
}
function sub_cat($catID,$subcat=""){
 if($catID!=""){	 
	  $sql_cat=mysql_query("select * from tbl_category where cat_parent ='$catID' order by cat_order");
	  $num=mysql_num_rows($sql_cat);
	  $var= '<option value="">Select Subcategory</option>';
	  if($num > 0 )
	  {
	      while($rw=mysql_fetch_array($sql_cat))
	      { 
		  if($rw[cat_id]==$subcat){		 
		     $sel="selected";
		   }else{  $sel="";	}  
		  $var.='<option value="'.$rw[cat_id].'" '.$sel.' >'.$rw[cat_name].'</option>';
		
	       }
	   }
  }	   
return $var;
}

function country_name($id){
     if($id!=""){
	    $sql_country=mysql_query("select * from tbl_country where country_id=$id order by country_name");	
	    $rw=mysql_fetch_array($sql_country);
	     $var=$rw[country_name];
	   }
return $var;
}
function get_config_setting($id)
{
	if($id!=""){	
	 $sql_res=db_query("select * from tbl_config where config_id=".$id);
	 
	 $arr=mysql_fetch_assoc($sql_res)  or die(mysql_error() );
	 $result=$arr['config_txt']; 
	 }
 return $result;
}

function Display_Message()
{
 if(@$_SESSION['site_admin_message']!=""){	 
		$var='<table width="80%" cellpadding="0" cellspacing="0" align="center"><tr><td align="center"><div class="msg_dg">'.$_SESSION['site_admin_message'].'</div></td></tr></table><br />';
	 unset($_SESSION['site_admin_message']);	
	}else{
	$var="";
	}
	return $var;
}

function page_nav($catid){
 global $count_level;
	$res=mysql_fetch_array(db_query("select * from tbl_category where cat_id='$catid'"));
	$flag=0;
	$catparent=$catid;
	while($flag!=1){
		$res1=db_query("select * from tbl_category where cat_id='$catparent'");
		$record=mysql_fetch_array($res1);
		if($record['cat_parent']!=0){

			$catparent=$record['cat_parent'];
			@$array.="$record[cat_id]~";
		}else{
			if($record['cat_id']!=""){
				@$array.="$record[cat_id]~";
			}
			$flag=1;
		}
	}
	$arr=explode("~",@$array);
    $count_level=count($arr);
	$result = array_reverse($arr);
	echo "<a href='?file=catalog'>Home</a> ";
	for($i=1;$i<count($result);$i++){
	  $rw1=db_query("select * from tbl_category where cat_id='$result[$i]'");
		$res=mysql_fetch_array($rw1);		
		if(mysql_num_rows($rw1)> 0)
	echo " <b>&rsaquo;&rsaquo;</b> <a href='?file=catalog&parentId=".$res['cat_id']."'>".ucfirst($res['cat_name'])."</a>";
		
	}
}

function check_parent($cat_parent){
	 if($cat_parent!=""){
	  $re1=mysql_query("select * from tbl_category where cat_parent ='$cat_parent'");
	  $num=mysql_num_rows($re1);
	 }
return $num;
}
function check_product_exits($cat_parent){
	 if($cat_parent!=""){
	  $re1=mysql_query("select * from tbl_products  where product_catid ='$cat_parent'");
	  $num=mysql_num_rows($re1);
	 }
return $num;

}

function get_catinfo($catID,$col_name){
   if($catID!="" && $col_name!=""){
   $sql_cname=mysql_query("select * from tbl_category where cat_id=$catID and cat_status='Y'");
   $cat_Rows=mysql_fetch_array($sql_cname); 
   }   
 return $cat_Rows[$col_name];  
}

function truncateText($string, $limit, $break = '.', $pad = '...', $strict = false)
{
    // If the $string is shorter than the $limit, return the original source
    if (strlen($string) <= $limit)
    {
        return $string;
    }
    
    // If the string MUST be shorter than the $limit set.
    // Otherwise shorten to the first $break after the $limit
    if ($strict)
    {
        $string = substr($string, 0, $limit);
        
        if (($breakpoint = strrpos($string, $break)) !== false)
        {
            $string = substr($string, 0, $breakpoint).$pad;
        }
    }
    else
    {
        // If $break is present between $limit and the end of the string
        if (($breakpoint = strpos($string, $break, $limit)) !== false)
        {
            if ($breakpoint < strlen($string) - 1)
            {
                $string = substr($string, 0, $breakpoint).$pad;
            }
        }
    }
    
    return $string;
} 

/*If you wanted to shorten some text to 250 characters and break at the nearest full stop (default) then you would do this.
$text = truncateText($string, 250, '.'); 
If you wanted to shorten some text to 250 characters and break at the next word, you would do this. 
$text = truncateText($string, 250, ' '); 
And if it was absolutely critical the text was no longer than 250 characters, you would do this. 
$text = truncateText($string, 250, ' ', '...', true);
*/ 
function showImg($field,$folder)
{
	$file_path=SITE_FS_PATH."/uploaded_files/$folder/".$field;
	$file_name=SITE_WS_PATH."/uploaded_files/$folder/".$field;
	$no_img=SITE_WS_PATH."/images/notavailable.jpg";
 $img=(file_exists($file_path) && $field!="") ?  $file_name : $no_img ;	
return $img;
}

function chk_productid_exits($pid)
{
 if($pid!=""){
	  $re1=mysql_query("select * from product_image  where product_id  ='$pid'");
	  $num=mysql_num_rows($re1);
	 }
return $num;
}

function change_display_orders($cat_id,$new_order,$id,$type,$parent)
{		
if($type=='state')
{
	$table_name = "tbl_state";
	$col1       = "state_order";
	$col2       = "state_id";
	$id_head    = "";
	$id_head_value = "";
}elseif($type=='category')
{
	$table_name = "tbl_category";
	$col1       = "cat_order";
	$col2       = "cat_id";
	$col3		="cat_parent_id";	
	$id_head    = "";
	$id_head_value = "";
}elseif($type=='city')
{
	$table_name = "tbl_city";
	$col1       = "city_order";
	$col2       = "city_id";
	$col3		="city_state_id";	
	$id_head    = "";
	$id_head_value = "";
}elseif($type=='alert')
{
	$table_name = "tbl_mail_alert_questions";
	$col1       = "faq_order";
	$col2       = "faq_id";
	$id_head    = "";
	$id_head_value = "";
}elseif($type=='faq')
{
	$table_name = "tbl_faqs";
	$col1       = "faq_order";
	$col2       = "faq_id";
	$id_head    = "";
	$id_head_value = "";
}
elseif($type=='testimonial')
{
	$table_name = "tbl_testimonial";
	$col1       = "testimonial_order";
	$col2       = "testimonial_id";
	$id_head    = "";
	$id_head_value = "";
}

	$sql = " select $col1 from $table_name where $col2='$id'";
	$order_old=db_scalar($sql);
	if(intval($order_old) > intval($new_order))
	{
		if($type=='city' or $type=='category'){
		$sql= "select $col1,$col2 from $table_name where $col1 >='$new_order' and $col1<'$order_old' And $col3='$parent'";
		}else{
		$sql= "select $col1,$col2 from $table_name where $col1 >='$new_order' and $col1<'$order_old'";
		}
		if($id_head_value!='' && $id_head!='') { 
			$sql .= " and $id_head ='$id_head_value' ";
		}
		$sql .= " order by $col1 asc ";
		$result=mysql_query($sql);
		while($line = mysql_fetch_array($result))
		{
			$orderx = $line[$col1];
			$idx	 = $line[$col2];
			$orderx++;
			if($type=='city' or $type=='category'){
				$sql_update="update $table_name set $col1='$orderx' where $col2='$idx' And $col3='$parent'";
			}else{
				$sql_update="update $table_name set $col1='$orderx' where $col2='$idx'";
			}
			mysql_query($sql_update);
		}
	}
	else
	{
		if($type=='city' or $type=='category'){
		$sql= "select $col1,$col2 from $table_name where $col1>$order_old  and $col1<=$new_order And $col3='$parent'";
		}else{
		 $sql= "select $col1,$col2 from $table_name where $col1>$order_old  and $col1<=$new_order";
		}
		if($id_head_value!='' && $id_head!='') { 
			$sql .= " and $id_head ='$id_head_value' ";
		}
		$sql .= " order by $col1 asc ";
		$result=mysql_query($sql);
		while($line = mysql_fetch_array($result))
		{
			$orderx  = $line[$col1];
			$idx	 = $line[$col2];
			$orderx--;
		if($type=='city' or $type=='category'){
			$sql_update="update $table_name set $col1='$orderx' where $col2='$idx' And $col3='$parent'";
		}else{
			$sql_update="update $table_name set $col1='$orderx' where $col2='$idx'";
		}	
			mysql_query($sql_update);
		}		
	}
	if($type=='city' or $type=='category'){
		$sql= "update $table_name set $col1='$new_order' where $col2='$id' And $col3='$parent'";
	}else{
		$sql= "update $table_name set $col1='$new_order' where $col2='$id'";
	}	
	mysql_query($sql);
}
/*
function sent_mail($ContactPerson,$eMail,$To,$subject,$message){
		$headers = "From: $ContactPerson<$eMail> \n";
		$headers .= "Reply-To: $eMail \r\n";
		$headers .= "X-Mailer: PHP/". phpversion();
		$headers .= "X-Priority: 3 \n";
		$headers .= "MIME-version: 1.0\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\n";
		#$msg=mail_header_top();
		$msg.=$message;
		#$msg.=mail_footer();
		@mail($To,$subject,$msg,$headers);
}
*/

function sent_mail($to,$subject,$message){
	
	$header = "From: ".SITE_NAME." <".ADMIN_EMAIL."> \n";
	$header .= "Reply-To: contact@flyannonces.com \r\n";
	
	$header .= "X-Mailer: PHP/". phpversion();
	$header .= "X-Priority: 3 \n";
	$header .= "MIME-version: 1.0\n";
	$header .= "Content-Type: text/html; charset=UTF-8\n";
	
	#$msg=mail_header_top();
	#$msg.=$message;
	#$msg.=mail_footer();
	
/*	echo $to;
	echo "<br>";
	echo $subject;
	echo "<br>";
	echo $message;
	echo "<br>";
	echo $header;
*/

return @mail($to,$subject,$message,$header);		
}
function forumchangedate($date){
	$split_time=explode(" ",$date);
	$cdate=explode("-",$split_time[0]);
	$year=$cdate[0];
	$month=$cdate[1];
	$day=$cdate[2];	
	$ctime=explode(":",$split_time[1]);
	$hours=$ctime[0];
	$minutes=$ctime[1];
	return date('D M d, Y g:i A', mktime($hours, $minutes, 0, $month, $day, $year)); 

 }
 function getTopicReply($topic_id){
	$response_sql=mysql_query("select * from forum_responses where topicID='$topic_id' and status ='Y'");
	return mysql_num_rows($response_sql);
}
  
 function getMemberFullName($memID){
	$res=mysql_fetch_array(mysql_query("select * from tbl_member where mem_id='$memID'"));
	$res=ms_stripslashes($res);
	return $res[fname]." ".$res[lname];
}
  
function getMemberStatus($memID){
	$status=false;
	$res=mysql_fetch_array(mysql_query("select * from tbl_member where mem_id='$memID'"));
	$status=($res[mem_status]=='Y') ? true : false;
return $status;
}
  
function getMemberRembourseParrain($memID){
	$status=false;
	$res=mysql_fetch_array(mysql_query("select * from tbl_member where mem_id='$memID'"));
	$status=($res[rembourseparrain]=='Y') ? true : false;
return $status;
}
  
function getMemberParrainId($memID){
	$res=mysql_fetch_array(mysql_query("select * from tbl_member where mem_id='$memID'"));
return $res[parrain_id];
}

function SetCreditParrainId($memID, $solde){
	$sql_credit="UPDATE `tbl_member` SET `solde`=`solde`+'".$solde."' WHERE `mem_id`=".$memID;		
	db_query($sql_credit) or die(mysql_error());
}


function getLastForumReply($topID)
{ 
  if(getTopicReply($topID)>0)
  {   
    $response_sql=mysql_query("select * from forum_responses where topicID='$topID' order by replyID  desc ");
	$num=mysql_num_rows($response_sql);	    
	    $rw=mysql_fetch_array($response_sql);
	    $res[]=$rw[name];
	    $res[]=$rw['recv_date'];       
	 } 
  return $res;
}

function getResult($tableName,$cond=""){
	$sql=mysql_query("select * from $tableName $cond");
	$res=mysql_fetch_array($sql);	
	return $res;
}

function get_member_name($id){
  if($id!=""){
  $sql="select fname,lname from tbl_member  mem_id where  mem_id= $id ORDER BY lname desc ";
   $rs=mysql_query($sql);    
    if(mysql_num_rows($rs) > 0 ) {
      $res=mysql_fetch_array($rs);
       $f_name=$res[fname];
	   $l_name=$res[lname];
	   $name="$f_name". " " ."$l_name";
    }
  }	
 return $name;
}

function main_cat_array(){
  $sql_cat=db_query("select * from tbl_category where cat_status='Y' And cat_parent='0' order by cat_order asc");
  $x=mysql_num_rows($sql_cat);
  $i=1;
  if($x > 0 ){
	  while($row=mysql_fetch_array($sql_cat)){		  
	  $cat_Arr[$i]=array('catId'=>$row['cat_id'],'catName'=>$row['cat_name'],'catImg'=>$row['cat_image'],'status'=>$row['cat_status']);		  
	   $i++;  
		}
    }
return $cat_Arr;
}

function html_mail_content($mail_content){
	$logo=get_config_setting(1);
$body="
	<div style='box-shadow:0px 0px 1px 1px #CCCCCC; background-color:#f4f5f7;'>
		<table align='center' border='0' cellspacing='10' cellpadding='5' width='100%' style='clear:both;max-width:622px;'>
			<tbody>
				<tr>
					<td width='100%' style='padding-left:10px;padding-right:10px;' colspan='2'>	
						<div style='position: relative;	display:inline-block; width:500px;text-align:center'>
							<a href='http://$_SERVER[HTTP_HOST];'>
								<img src='http://$_SERVER[HTTP_HOST]/mobile/uploaded_files/logo/$logo' alt='Logo'>
							</a><br>
								".SITE_NAME."
						</div>
					</td>
				</tr>
			</tbody>
		</table>
        
		<table align='center' border='0' cellspacing='10' cellpadding='5' width='100%' style='clear:both;max-width:622px;'>
			<tbody>
				<tr>
					<td width='100%' style='padding-left:10px;padding-right:10px;' colspan='2'>
						$mail_content
					</td>
				</tr>
			</tbody>
		</table>
        
		<table align='center' border='0' cellspacing='10' cellpadding='5' width='100%' style='clear:both;max-width:622px;'>
			<tbody>
				<tr>
					<td width='100%' style='padding-left:10px;padding-right:10px;' colspan='2'>
					<!--
Notre service client est à votre écoute. Pour toutes questions, contactez-nous au 09.70.40.54.73. Notre équipe répond à vos appels du lundi au vendredi de 9h00 à 17h00 et le samedi de 9h00 à 13h00.
-->

Merci d'utiliser ".SITE_NAME.",<br />

L'équipe ".SITE_NAME."<br />
					</td>
				</tr>
			</tbody>
		</table>
</div>
";
return $body;
}


function rappel_expiration($periode){
	
	$dtj= date("d/m/Y");
	$dtex=date("d/m/Y", strtotime('+'.$periode.' days'));	
	$date_fin=date('Y-m-d', strtotime('+'.$periode.' days'));
	
	$sql="SELECT *
			FROM tbl_classified
			
			WHERE
			(
				classified_status='Active'
				OR
				classified_status='Inactive'
				OR
				classified_status='Tempr'
			)
			AND 
			(
					DATE_FORMAT(`date_fin_premium`, '%Y-%m-%d') = DATE_FORMAT('".$date_fin."', '%Y-%m-%d')
				OR
					DATE_FORMAT(`date_fin_republication`, '%Y-%m-%d') = DATE_FORMAT('".$date_fin."', '%Y-%m-%d')
				OR
					DATE_FORMAT(`date_fin_couleur`, '%Y-%m-%d') = DATE_FORMAT('".$date_fin."', '%Y-%m-%d')
				OR
					DATE_FORMAT(`date_fin_urgent`, '%Y-%m-%d') = DATE_FORMAT('".$date_fin."', '%Y-%m-%d')
			)
			";

	$result = db_query($sql);
	
	if(mysql_num_rows($result)==0){?>
        <div class="msg"><?php echo "Rappel de ".$periode." jours: Sorry, no records found.";?></div>
        <?php
	}else{
		while ($line_raw = mysql_fetch_array($result))
		{
			@extract($line_raw);
			
			/****Send mail active ads***************************/
			$namead=$classified_title;
			$email_toname	=	$line_email[comp_name];	
			$link=REDIRECT_SERVER."/classified-details.php?clsId=".$line_raw[classified_id];
			$email_subject	=	"Rappel de renouvellement.";

			$linkRenouvellement=REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'&nextpage=my-account-classified-preview.php&clsId='.$classified_id;
			$linkMoncompte=REDIRECT_SERVER.'/activer.php?key='.$rand_key.'&ui='.$mem_id.'&nextpage=my-account.php';


			$body='
			<table align="center" border="0" cellspacing="10" cellpadding="5" width="100%" style="clear:both;max-width:622px;">
				<tbody>
					<tr>
						<td>
							<p>
								Le: '.$dtj.'
							</p>
							<p>
									Objet : Offre de renouvellement (option payante).
							</p>
							<p>
								Cher client,
							</p>
							<p>								
								Nous vous informons que le(s) option(s) payante(s) de votre annonce <strong><a href="'.$link.'" target="_blank">'.$namead.'</a></strong> arrive à expiration dans '.$periode.' jours le '.$dtex.'.
							</p>
							<p>
								Si vous renouvelez dés à présent aucun jour ne sera perdu. Votre renouvellement permettra de poursuivre votre abonnement actuel.
							</p>
							<p>								
								Pour effectuer le renouvellement, cliquez ici :<br>
								<a href="'.$linkRenouvellement.'" target="_blank">
									'.$linkRenouvellement.'
								</a>
							</p>
							<p>
								ou veuillez vous rendre dans votre Espace client :<br>								
								<a href="'.$linkMoncompte.'" target="_blank">
									'.$linkMoncompte.'
								</a>
							</p>
							<p>								
								Rappel:
								Si vous ne souhaitez pas renouveler, il suffit 
								de ne pas tenir compte de nos courriers de rappel
							</p>
						</td>
					</tr>
				</tbody>
			</table>
			';
			
			//$body=nl2br($body);
			$body=html_mail_content($body);
			
			$body			=	str_replace('{username}',$line_email[fname],$body);
			$body			=	str_replace('{namead}',$namead,$body);
			$body			=	str_replace('{link}',$link,$body);
			$email_subject	=	str_replace('{namead}',$namead,$email_subject);
			
			//echo "<pre>".$body."</pre>";	
			sent_mail($classified_poster_email,$email_subject,$body);
			/******************************/
		}
		
		echo "<pre>".$date_fin.": Rappel de ".$periode." jours: ".mysql_num_rows($result)." envoy&eacute;(s)</pre>";
	}
}


function classified_visits($clsId){
	if($clsId!=""){
		$clsId = (!empty($clsId) && is_numeric($clsId)) ? intval($clsId) : 0;
		$sql="select classified_visit,classified_id from tbl_classified where classified_id = $clsId ";
		$vis=db_query($sql);
		$num=mysql_num_rows($vis);	 
		if($num > 0 ){
			$res_num=mysql_fetch_array($vis);
			$total_visit=$res_num[0];
		}	
	}
return $total_visit;
}

function classified_contacts($clsId){
	if($clsId!=""){
		$clsId = (!empty($clsId) && is_numeric($clsId)) ? intval($clsId) : 0;
		$sql="select classified_contact,classified_id from tbl_classified where classified_id = $clsId ";
		$cnt=db_query($sql);
		$num=mysql_num_rows($cnt);	 
		if($num > 0 ){
			$res_num=mysql_fetch_array($cnt);
			$total_contact=$res_num[0];
		}	
	}
return $total_contact;
}


function front_date_format($d){
  if($d!=""){
     $date=date("d-m-Y H:i A",strtotime($d)); 
   }
 return $date;
}


function getNumberPhoto($clsid){
	$var="";
        $sql = "select count(*) from tbl_classified_image where `clsd_id`='".$clsid."'";
        
		$rw=mysql_fetch_array(db_query($sql));
		if($rw[0]>0)
			$var=$rw[0];
		
return $var;	
}

function upload_file($mid,$image,$folder){

$LienImageNews="";

	// Je crée un array dans lequel figurent seulement les extensions acceptées, avec le type MIME qui leur est associé (qui peut varier sous IE et qu'on va donc devoir différencier) :
	$ListeExtension = array('jpg' => 'image/jpeg', 'jpeg' => 'image/jpeg', 'png' => 'image/png', 'gif' => 'image/gif');
	$ListeExtensionIE = array('jpg' => 'image/pjpg', 'jpeg'=>'image/pjpeg'); // Il fallait une nouvelle fois qu'IE se différencie.


	if (!empty($_FILES[$image]))
	{
		if ($_FILES[$image]['error'] <= 0)
		{
			if ($_FILES[$image]['size'] <= 2097152)
			{
				$ImageNews = $_FILES[$image]['name'];
				
				// Je vérifie l'extension présumée du fichier :
				$ExtensionPresumee = explode('.', $ImageNews);
				$ExtensionPresumee = strtolower($ExtensionPresumee[count($ExtensionPresumee)-1]);
				if ($ExtensionPresumee == 'jpg' || $ExtensionPresumee == 'jpeg' || $ExtensionPresumee == 'pjpg' || $ExtensionPresumee == 'pjpeg' || $ExtensionPresumee == 'gif' || $ExtensionPresumee == 'png')
				{
					// On pourra alors continuer notre vérification.
					$ImageNews = getimagesize($_FILES[$image]['tmp_name']);
					if($ImageNews['mime'] == $ListeExtension[$ExtensionPresumee]  || $ImageNews['mime'] == $ListeExtensionIE[$ExtensionPresumee])
					{
						$TailleImageChoisie = getimagesize($_FILES[$image]['tmp_name']);
						
						$NouvelleLargeur = 800;
						// Étape 2 :
						$Reduction = ( ($NouvelleLargeur * 100)/$TailleImageChoisie[0] );
						 
						// Étape 3 :
						//$NouvelleHauteur = ( ($TailleImageChoisie[1] * $Reduction)/100 );
						$NouvelleHauteur =800;
						
						switch($ExtensionPresumee){
							case 'jpg':
							case 'jpeg':
							case 'pjpg':
							case 'pjpeg':
								
								$ImageChoisie = imagecreatefromjpeg($_FILES[$image]['tmp_name']);								
								
								//Etape 1 :
								$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
								 
								//Etape 2 :
								imagecopyresampled($NouvelleImage , $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
								break;
							
							case 'png':
							
								$ImageChoisie = imagecreatefrompng($_FILES[$image]['tmp_name']);

								//Etape 1 :
								$NouvelleImage = imagecreatetruecolor($NouvelleLargeur , $NouvelleHauteur) or die ("Erreur");
								
								//Etape 2 :
								imagecopyresampled($NouvelleImage , $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
								break;
							
							case 'gif':
							
								$ImageChoisie = imagecreatefromgif($_FILES[$image]['tmp_name']);

								$NouvelleImage = imagecreate ($NouvelleLargeur , $NouvelleHauteur );
								
								imagecopyresampled($NouvelleImage , $ImageChoisie, 0, 0, 0, 0, $NouvelleLargeur, $NouvelleHauteur, $TailleImageChoisie[0],$TailleImageChoisie[1]);
								break;
						}
						
						
						imagedestroy($ImageChoisie);
						
						$NomImageChoisie = explode('.', $_FILES[$image]['name']);
						
						//on  « crypte » le nom original de l'image
						//$NomImageExploitable = time($NomImageChoisie[0]);
						$NomImageExploitable=$mid.time($NomImageChoisie[0]).".".$ExtensionPresumee;
						
						imagejpeg($NouvelleImage , $folder.$NomImageExploitable, 100);
						
						$LienImageNews = $NomImageExploitable;
					}
				}
				else{
					 Set_Display_Message("Invalid format please use the following formats: .jpg,.jpeg,.gif,.png......");
					 echo "Invalid format please use the following formats: .jpg,.jpeg,.gif,.png......";
				}
			}
			else{
				 Set_Display_Message("Invalid size......");
				 echo "Invalid size......";
			}
		}
		else{
			 Set_Display_Message("Invalid file......");
			 echo "Invalid file......";
		}
	}

return $LienImageNews;
}
?>