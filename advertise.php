<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','1');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;
require_once("header.inc.php");
$cat_Arr=main_cat_array();
if($_REQUEST[act]!="" && $_REQUEST[act]=="add"){
	@extract(strip_tags($_POST));
	
	$name = secureValue($name);
	$email = secureValue($email);
	$contact_no = secureValue($contact_no);
	$cat_level_root = secureValue($cat_level_root);
	$final_catId = secureValue($final_catId);
	$ban_position = secureValue($ban_position);
	
	$urls = secureUrl($urls);
	$comments = secureValue($comments);
	$pay_option = secureValue($pay_option);
	
	if(empty($name) || empty($email) || empty($org) || empty($contact_no) || empty($cat_level_root) || empty($ban_position) || empty($urls) || empty($comments)) {
		Set_Display_Message("S'il vous plaît remplir tous les champs obligatoires! ");
		header("Location:advertise.php");
		exit();
	} else {	
		
		$final_catId=($cat_level_two!="") ? $cat_level_two : $cat_level_one;
		$pay_option="Pending";
		$sql="INSERT INTO `tbl_advertise` SET `name` = '$name',
		`email` = '$email',
		`company_name` = '$org',
		`contact_no` = '$contact_no',
		`cat_id` = '$cat_level_root',
		`dis_subcat`='$final_catId',
		`banner_position` = '$ban_position',
		`url` = '$urls',
		`status` = 'N',
		`comments` = '$comments',
		`date` = '".date('Y-m-d')."',pay_option='$pay_option' ";
		 db_query($sql);
		 $insid=mysql_insert_id();
	 ################# Upload  image ################
		$fileName=$_FILES['file']['name']; 
		$NotVail_files = file_validation('image',$_FILES['file']['tmp_name']);
		if($fileName!='' && $NotVail_files){	 
		  
			$fileType = $_FILES['file']['type'];
			$fileTemp = $_FILES['file']['tmp_name'];
			$fileError = $_FILES['file']['error'];
			$destFile = date('dMYhms').$fileName;			
			$destLoc = 'mobile/uploaded_files/advertise/'.$destFile;
			if(move_uploaded_file($_FILES['file']['tmp_name'],$destLoc))
			{
				$update=db_query("update tbl_advertise set image='$destFile' where id ='$insid'");
			}	
		} 
	############### End ##########################
		Set_Display_Message("Votre publicité soumise avec succès...... ");
	    header("Location:pay_advertise.php?rid=$insid&rf=advertise");
		exit();
	}
}

?>
<div class="grid_3">
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">
    
	<div class="tree">
    	<a href="index.php">Accueil</a> >> Annoncez avec nous 
	</div>
    
	<div class="mt17">
		<?php echo Display_Message();?>
	</div>
    
    <div class="p7">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><span class="title_clad">Annoncez avec nous</span></div>
            <div class="panel-body">
				<?php echo pagecontent(5);?>
            </div>
            
			<div class="mt17">
                <div class="fs11" align="right">( <span class="star">* </span>) obligatoire.</div>
            	<form action="advertise.php" method="post" enctype="multipart/form-data" >
                  <table width="100%" border="0" cellpadding="4"  cellspacing="0">
                  <tr>
                    <td width="34%" align="right"> <span class="star">*</span> Nom : </td>
                    <td width="66%" align="left"><input name="name" type="text" class="textbox" id="name"  style="width:300px;" required="required"/></td>
                  </tr>
                  <tr class="bg-stripcolor">
                    <td width="34%" align="right"> <span class="star">*</span> Email ID: </td>
                    <td width="66%" align="left"><input name="email" type="email" class="textbox" id="email"  style="width:300px;" required="required"/></td>
                  </tr>
                  <tr>
                    <td width="34%" align="right"><span class="star">*</span> Nom de compagnie : </td>
                    <td width="66%" align="left"><input name="org" type="text" class="textbox" id="org"  style="width:300px;" required="required"/></td>
                  </tr>
                  <tr class="bg-stripcolor" >
                    <td align="right"><span class="star">*</span> No Tél: : </td>
                    <td align="left"><input name="contact_no" type="text" class="textbox" id="contact_no"  style="width:300px;"  required="required"/></td>
                  </tr>
                  <tr>
                  <?php
                    $cat_level_root = secureValue($cat_level_root);
                    $cat_level_one = secureValue($_REQUEST['cat_level_one']);
                    $cat_level_two = secureValue($_REQUEST['cat_level_two']);
                  ?>	  
                    <td align="right"> <span class="star">*</span> Choisir la Categorie : </td>
                    <td align="left">
                     <select name="cat_level_root" class="textbox" style="width:308px;" onChange="cat_drop_down_advertise(this.value,'')" required>
                          <?php echo Root_cat($cat_level_root);?>
                          </select>
                          <?php if($cat_level_root!="") { ?>
                             <script language="javascript">
                               cat_drop_down('<?php echo $cat_level_root;?>','<?php echo $cat_level_one;?>')
                             </script>
                          <?php } ?>				  </td>
                      </tr>
                     <tr>
                    <td align="right">Sous Categorie :</td>
                    <td align="left"><div id="cat_tree1">
                          <select name='cat_level_one' class='textbox' style='width:308px;' onChange="cat_drop_down2_advertise(this.value,'')" />				 			  
                          </select>
                           </div>				  
                          <?php if($_REQUEST['cat_level_one']!="") { ?>
                            <script language="javascript">
                               cat_drop_down2('<?php echo $cat_level_one;?>','<?php echo $cat_level_two;?>')
                            </script>
                          <?php } ?></td>
                  </tr>
                  <tr>
                    <td align="right"> Sous Sous Categorie :</td>
                    <td align="left">
                    <div id="cat_tree2">
                          <select name="cat_level_two" class="textbox" style="width:308px;">
                          </select>
                  </div>		  </td>
                  </tr>
                  <tr>
                    <td align="right"> <span class="star">*</span>  Position de la Bannière  : </td>
                    <td align="left">
                    <select name="ban_position" class="textbox" id="ban_position" style="width:308px;"  required="required">
                      <option value="">---Position---</option>
                         <option value="Top Banner">Bannière en haut</option>
                      <option value="Classified Listing Left"> Listing gauche</option>
                      <option value="Classified Detail Left">Détails à gauche</option>            
                    </select></td>
                  </tr>
                  <tr class="bg-stripcolor" >
                    <td align="right"><span class="star">*</span> Image de la Bannière : </td>
                    <td align="left">
                    <input name="file" type="file" class="textbox1" id="file" size="41"  required="required"/>			</td>
                  </tr>
                  <tr>
                    <td align="right">&nbsp;</td>
                     <td align="left">Bannière en haut: 728 x 90 ,Listings ou détails à gauche: 75 x 200  </td>          </tr>
                  <tr>
                    <td align="right"><span class="star">*</span> URL de la Bannière : </td>
                    <td align="left"><input name="urls" type="text" class="textbox" id="urls"  style="width:300px;"  required="required"/> 
                      Ex: http://www.abc.com/</td>
                  </tr>
                  <tr valign="top" class="bg-stripcolor" >
                    <td align="right"> <span class="star">*</span> Commentaires : </td>
                    <td align="left"><textarea name="comments"  rows="4" class="textbox" id="comments" style="width:300px;"  required="required"></textarea></td>
                  </tr>
                  <tr valign="top" >
                    <td align="right" >&nbsp;</td>
                    <td align="left">
                        <input name="Submit" type="submit" class="button button-green" value="Envoyer" />
                        <input name="Submit2" type="submit" class="button button-green" value="Effacer" />
                        <input type="hidden" name="amount" value="<?php echo $banner_amount;?>">
                        <input type="hidden" name="act" value="add">
                      
                      </td>
                  </tr>
                </table>
                  </form>
            </div>
        </div>
	</div>   
    
</div>
<?php require_once("footer.inc.php"); ?>