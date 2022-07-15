<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$meta_titles="Mes Factures";
$meta_desc="Mes Factures";
$meta_keywords="Mes Factures";
require_once("header.php");
chk_user_login();
$set_div="none";
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=10:$pagesize;
$columns = "select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(facture_date,'%d/%m/%Y') as post_date ";
$sql = " from tbl_facture, tbl_classified
		where tbl_classified.mem_id  ='".$_SESSION['signin']['mem_id']."' 
		and tbl_classified.classified_id=tbl_facture.classified_id
		ORDER BY tbl_facture.facture_date  DESC limit $start, $pagesize ";

$sql = $columns.$sql; 
$rs_facture=db_query($sql);	
$count_facture = mysql_fetch_array(db_query("Select FOUND_ROWS() as total")); 
$reccnt=$count_facture['total'];

?>

<div class="heading">
    Mes Factures:
</div>

<div class="body">
    
	<div class="account-link">
		<?php require_once("my_account_links.php"); ?>
	</div>
    
	<div class=""><?php echo Display_Message();?> </div>
    
	<div class=""><?php include("paging.php"); ?></div>
	  <?php
      
        if($reccnt > 0 ) { 
        ?>
                 
            <table width="100%" class="table table-striped">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Référence</th>
                        <th>Moyen de paiement</th>
                        <th>Montant TTC</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
       <?php
            while ($line_raw = mysql_fetch_array($rs_facture)) 
            {
                @extract($line_raw);
            ?>     
                    <tr>
                        <th><?=$post_date?></th>
                        <th><?=$facture_num?></th>
                        <th><?=$mode_paiement?></th>
                        <th><?=$facture_total?></th>
                        <th>
                            <a href="bill.php?reference=<?=$facture_num?>&mode=html" target="_blank"><i class="fa fa-file-text"></i></a>
                            <a href="bill.php?reference=<?=$facture_num?>&mode=pdf" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                        </th>
                    </tr>
          
            <?php
            }
        ?>
        
                </tbody>
              </table>
        <?php
        }else{ 
        ?>
            <div class="b">Aucune Facture .....</div>
        <?php
        } 
        ?>
	</div>
    
</div>
<?php require_once("footer.php"); ?>