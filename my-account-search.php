<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("header.inc.php");
chk_user_login();

$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=15:$pagesize;
$columns = " select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(date,'%D %M %Y') as post_date ";
$sql = " from tbl_save_search
where mem_id  ='$_SESSION[memId]' and status='Y' limit $start, $pagesize ";

$sql = $columns.$sql; 
$rs_msg=db_query($sql);	
$res_msg = mysql_fetch_array(db_query("Select FOUND_ROWS() as total")); 
$reccnt=$res_msg['total'];


/* Member Delete  own  message classified */
if(isset($_REQUEST[act]) && $_REQUEST[act]=="del"){
$tmpID = intval($_REQUEST[Id]);
$condition="where rId=$tmpID and mem_id ='$_SESSION[memId]'";
	  db_query("UPDATE tbl_save_search  SET status ='N' $condition ");
	  Set_Display_Message("Votre recherche supprimé avec succès");
	  header("Location:my-account-search.php");
	  exit();
	 
}
/* End Member Delete  own  message classified */

?>

<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td valign="top" align="center">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td >
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" style="padding:5px 5px 0 15px;"><table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td class="main-heading">Voir Sauvegarder la recherche</td>
        </tr>
      <tr>
        <td width="33%" valign="top" class="tree">Voir recherche sauvegardée &lt;&lt; <a href="my-account.php">Mon compte</a> &lt;&lt; <a href="index.php">Accueil</a></td>
      </tr>
      <tr>
        <td style="padding-top:3px;"><span class="p3 ar">Bienvenue <span class="heading">
        <?php echo $_SESSION['user_name'];?>
        </span>&nbsp;&nbsp; <a href="my-account.php" class="link1 b">(Mon compte)</a>&nbsp;&nbsp; <a href="logout.php" class="link1 b">(Se déconnecter)</a></span></td>
      </tr>
      <tr>
        <td style="padding-top:3px;">
          <div align="left"><?php echo Display_Message();?></div>
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="78%" valign="top" class="col-border pr15"><table width="100%" border="0" cellpadding="4"  cellspacing="2" class="cate-border mt10">
              <tr class="cate-stripcolor white-style b">
                 <td width="4%">S. No.</td>
                <td width="16%">Nom</td>
                <td width="55%"> critère de recherche</td>
                <td width="17%">Voir résultat</td>
                <td width="8%">Effacer</td>
                </tr>
				<?php include("paging.inc.php"); ?>
			    <?php
				if($reccnt > 0 ) {
                $count=0;
                while($rw=mysql_fetch_array($rs_msg)){ 
                 $count++;
				 $bg=($count%2==0) ? "bg-stripcolor" : "";
				?>
               <tr class="<?php echo $bg;?>">
                <td align="left"><?php echo $count;?></td>
                <td><?php echo $rw[save_title];?></td>
                <td>
				<?php
				$var="";				
				if($rw[catId]!="" && $rw[catId]!=0){				
				$var.='<p class="b">Catégorie : 
				<span class="blue-heading">'.get_catinfo($rw['catId'],'cat_name').'</span></p>';
				}
				if($rw[subcatId]!="" && $rw[subcatId]!=0){				
				$var.='<p><strong>Sous catégorie : </strong>'.get_catinfo($rw['subcatId'],'cat_name').'</p>';
				}
				if($rw[sub_subcatId]!="" && $rw[sub_subcatId]!=0){				
				$var.='<p><strong>Sous Sous catégorie : </strong>'.get_catinfo($rw['sub_subcatId'],'cat_name').'</p>';
				}				
				if($rw[state_id]!="" && $rw[state_id]!=0){				 
				$state=getResult('tbl_state',"WHERE state_id=$rw[state_id]");
				$var.=' <p><em><strong>État :</strong>'.$state[state_name].'</em></p></td>';
				}
				if($rw[city_id]!="" && $rw[city_id]!=0){				
				$city=getResult('tbl_city',"WHERE city_id=$rw[city_id]"); 
				$var.=' <p><em><strong>Ville :</strong>'.$city[city_name].'</em></p></td>';
				}				
				if($rw[keyword]!=""){				
				$var.=' <p><em><strong>Mot clé :</strong>'.$rw[keyword].'</em></p></td>';
				}
								 
				?> <?php echo $var;?></td>
                <td align="left">
				<?php if($rw['link']!="") {?>
				<a href="search-result.php<?php echo $rw['link'];?>" class="link1 u">Voir le résultat</a>
				<?php } ?>
				</td>
                <td align="left"><a href="my-account-search.php?Id=<?php echo $rw['rId'];?>&act=del"><img src="<?php echo $theem_img;?>/delete-icon.gif" border="0" alt=""/></a></td>
                </tr>
			  <?php } 
			  }else{ ?>
			  <tr align="center"><td colspan="8"><strong>Aucun dossier trouvé...</strong></td>
			       </tr>
				<?php } ?>          
              </table></td>
            <td width="22%" valign="top" class="account-link pl15 pt11">
			<?php require_once("my_account_links.php"); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>

</td>
</tr>
</table>
<?php require_once("footer.inc.php"); ?>