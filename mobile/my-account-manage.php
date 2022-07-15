<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$meta_titles="Gérer Mes Annonces";
$meta_desc="Gérer Mes Annonces";
$meta_keywords="Gérer Mes Annonces";
require_once("header.php");

require_once("multiple-currency.php");
chk_user_login();


$fetconfig_amount=get_config_setting(9);
$catPaid_amount=get_config_setting(10);
$expdays=get_config_setting(13);
$paid_category_expire_days=get_config_setting(12);
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=5:$pagesize;
$columns = "select SQL_CALC_FOUND_ROWS *,
				DATE_FORMAT(classified_post_date ,'%d-%m-%Y') as cli_post_date,
				DATE_FORMAT(classified_update_date ,'%d-%m-%Y') as cli_update_date ";
$sql = " from tbl_classified
where mem_id ='".$_SESSION['signin']['mem_id']."' and classified_status!='Delete' order by classified_id desc,cli_post_date  limit $start, $pagesize ";

$sql = $columns.$sql; 
$rs_classi=db_query($sql);	
$res_classi = mysql_fetch_array(db_query("Select FOUND_ROWS() as total")); 
$reccnt=$res_classi['total'];


/* Member Activate and Deactivate own  classified */
if(isset($_REQUEST[act]) && $_REQUEST[act]!="")
{
	$clsID = intval($_REQUEST[clsId]);
	$condition="where classified_id=$clsID and mem_id ='".$_SESSION['signin']['mem_id']."' ";
	
	if($_REQUEST[act]=='N'){
		db_query("UPDATE tbl_classified SET classified_status='Tempr' $condition ");
		Set_Display_Message("Votre annonce est désactivée......");
		header("Location:my-account-manage.php");
		exit();
		}
	if($_REQUEST[act]=="D"){
		db_query("UPDATE tbl_classified SET classified_status='Delete' $condition ");
		Set_Display_Message("Votre annonce est effacée......");
		header("Location:my-account-manage.php");
		exit();
	}
	if($_REQUEST[act]=="Y"){
		$dt=MYSQL_DATE_TIME;
		
		db_query("UPDATE tbl_classified SET 
			classified_status='active'
			$condition ");
		Set_Display_Message("Votre annonce est activée......");
		header("Location:my-account-manage.php");	
		exit();
	}  
}
/* Member Activate and Deactivate own  classified */
?>


<div class="heading">
    Mes Annonces:
</div>

<div class="body">
    
    
	<div class="account-link">
		<?php require_once("my_account_links.php"); ?>
	</div>
    
	<div class=""><?php echo Display_Message();?> </div>
			<?php
            if($reccnt > 0 ) {?>
            
                <div class="">
                    <?php include("paging.php"); ?>
                </div>
                
                <div class="p7">
                    <table width="100%" class="table table-striped">
                            <tr class="">
                                <th>Détails de l'annonce</th>
                                <th width="350px">Statut </th>
                                <th width="300px">Options disponibles</th>
                            </tr>
                            
                        
                        <?php
                        $count=0;
                        while($rw=mysql_fetch_array($rs_classi)){ 
                            $count++;
                            
                            $city=getResult('tbl_city',"WHERE city_id=$rw[classified_city_id]");				
                            $cls_status=($rw[classified_status]=='Inactive') ? "Activer" : "Désactiver";				
                            $cls_status_val=($rw[classified_status]=='Inactive') ? "Y":"N";			
                            /* Update classified  feature status no when classified expire from feature */
                            if($rw['feature_expired_date'] < date('Y-m-d')){
                                db_query("UPDATE tbl_classified SET classified_featured='No' WHERE classified_id='$rw[classified_id]'");			
                            }
                            /* End Update classified  feature status no when classified expire from feature */
                            
                            $date_comp=date('y-m-d h:i:s', strtotime('+1 days'));
                            if(
                                (strtotime($date_comp) < strtotime($rw[date_fin_urgent]))
                                ||
                                (strtotime($date_comp) < strtotime($rw[date_fin_premium]))
                                ||
                                (strtotime($date_comp) < strtotime($rw[date_fin_couleur]))
                                ||
                                (strtotime($date_comp) < strtotime($rw[date_fin_republication]))
                            )
                            $AnnonceCouleur='#FFCC99';
                            else
                            $AnnonceCouleur='#f5f5f5';
                            ?>
                            <tr class="b"  bgcolor="<?php echo $AnnonceCouleur;?>" style="border-bottom:#666 solid 1px;">
                                <td>
                                    <p><b><?php echo Rec_display_formate($rw['classified_title']);?></b></p>
                                    
                                    <!-- Afficher Categories-->
                                    <p class="blue-heading"><?php echo get_catinfo($rw['clsd_cat_id'],'cat_name');?></p>
                                    <p><strong><?php echo get_catinfo($rw['clsd_subcat_id'],'cat_name');?></strong>
                                    (<?php echo get_catinfo($rw['clsd_sub_subcat_id'],'cat_name');?>)</p>
                                    <p><em><?php echo $city['city_name'];?></em></p>
                                    
                                    <p>Annonce N°:<?php echo $rw[classified_id];?> <br />
                                    Publier le :<?php echo $rw['cli_post_date'];?> 
                                    <?php if($rw[cli_post_date]!=$rw[cli_update_date]){ echo ", Mise à jour le :".$rw['cli_update_date'];}?></p>
                                    
                                    <p class="tc">
                                        <a href="edit-my-post.php?clsId=<?php echo $rw[classified_id];?>" class="link1 u">Edit</a>
                                        /
                                        <a href="classified-preview.php?clsId=<?php echo $rw[classified_id];?>" class="link1 u" target="_blank">Voir</a>
                                        /
                                        <a href="my-account-manage.php?clsId=<?php echo $rw[classified_id];?>&act=D" class="link1 u" onClick=" return confirm('Etes-vous sûr de vouloir supprimer cette annonce');">Effacer</a>
                                        <?php
                                        if($rw['classified_status']=="Active"){
                                        ?>/
                                        <a href="my-account-manage.php?clsId=<?php echo $rw[classified_id];?>&act=N" class="link1 u" onClick=" return confirm('Etes-vous sûr de vouloir Désactiver cette annonce');">Désactiver</a>
                                        <?php
                                        }
                                        else if($rw['classified_status']=="Tempr"){
                                        ?>/
                                        <a href="my-account-manage.php?clsId=<?php echo $rw[classified_id];?>&act=Y" class="link1 u" onClick=" return confirm('Etes-vous sûr de vouloir Activer cette annonce');">Publier</a>
                                        <?php
                                        }?>
                                    </p>
                                </td>
                                <td>                        
                                    <table width="100%" >
                                        <tr>
                                                <td>
                                                    <?php
                                                    if($rw['classified_status']=="Active")
                                                        echo "Publiée";
                                                    else if($rw['classified_status']=="Inactive")
                                                        echo "En cours de publication";
                                                    else if($rw['classified_status']=="Tempr")
                                                        echo "Inactive";
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        $date_comp=date('y-m-d h:i:s', strtotime('+1 days'));
                                        if(strtotime($date_comp) < strtotime($rw[date_fin_urgent]))
                                        {
                                        ?>
                                            <tr>
                                                <td>
                                                    <span class="premium">Urgent</span> 
                                                    <label>Expire le <?php echo $rw[date_fin_urgent];?></label>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        
                                        if(strtotime($date_comp) < strtotime($rw[date_fin_couleur]))
                                        {
                                        ?>
                                            <tr><td><span class="premium">Couleur</span>
                                                    <label>expire le <?php echo $rw[date_fin_couleur];?></label></td></tr>
                                        <?php
                                        }
                                        if(strtotime($date_comp) < strtotime($rw[date_fin_premium]))
                                        {
                                        ?>
                                            <tr><td><span class="premium">Premium</span>
                                                    <label>expire le <?php echo $rw[date_fin_premium];?></label></td></tr>
                                        <?php
                                        }
                                        if(strtotime($date_comp) < strtotime($rw[date_fin_republication]))
                                        {
                                        ?>
                                            <tr><td><span class="premium">Republication</span>
                                                    <label>expire le <?php echo $rw[date_fin_republication];?></label></td></tr>
                                        <?php
                                        }?>
                                    </table>
                                </td>
                                <td>
                                    <p>
                                        <a href="post.php?stage=5&clsId=<?php echo $rw[classified_id];?>&date_fin_premium=y" class="link2" >
                                            <b>Annonce Premium</b>
                                        </a>
                                        &nbsp;
                                        <a href="help_option_paiement.php?option=PREMIUM"
                                                data-title="" 
                                                data-toggle="lightbox" 
                                                data-parent="" 
                                                data-gallery=""
                                                style="text-decoration:underline;color:#cc0000;">
                                                <span class="iconboxhelp"></span>
                                        </a>
                                    </p>
                                    <p>
                                        <a href="post.php?stage=5&clsId=<?php echo $rw[classified_id];?>&date_fin_couleur=y" class="link2" >
                                            <b>Annonce en Couleur</b>
                                        </a>
                                        &nbsp;
                                        <a href="help_option_paiement.php?option=COULEUR"
                                                data-title="" 
                                                data-toggle="lightbox" 
                                                data-parent="" 
                                                data-gallery=""
                                                style="text-decoration:underline;color:#cc0000;">
                                                <span class="iconboxhelp"></span></a>
                                    </p>
                                    <p>
                                        <a href="post.php?stage=5&clsId=<?php echo $rw[classified_id];?>&date_fin_republication=y" class="link2" >
                                            <b>Republication Auto</b>
                                        </a>
                                        &nbsp;
                                        <a href="help_option_paiement.php?option=REPUBLICATION"
                                                data-title="" 
                                                data-toggle="lightbox" 
                                                data-parent="" 
                                                data-gallery=""
                                                style="text-decoration:underline;color:#cc0000;">
                                                <span class="iconboxhelp"></span>
                                        </a>
                                    </p>
                                    <p>
                                        <a href="post.php?stage=5&clsId=<?php echo $rw[classified_id];?>&date_fin_urgent=y" class="link2" >
                                            <b>Option Urgent</b>
                                        </a>
                                        &nbsp;
                                        <a href="help_option_paiement.php?option=URGENT"
                                                data-title="" 
                                                data-toggle="lightbox" 
                                                data-parent="" 
                                                data-gallery=""
                                                style="text-decoration:underline;color:#cc0000;">
                                                <span class="iconboxhelp"></span></a>
                                    </p>
                                </td>
                            </tr>
                            <?php
                        }?>
                        </table>
                </div>   
                <div class="">
                    <?php include("paging.php"); ?>
                </div>
                
                <?php
            }else{
            ?>
                <div class="b" >Aucune annonce trouvée.....</div>   		 
            <?php 
            } ?>
	</div>   

</div>
<?php require_once("footer.php"); ?>