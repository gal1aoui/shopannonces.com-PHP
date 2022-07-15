<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$meta_titles="Mes Factures";
$meta_desc="Mes Factures";
$meta_keywords="Mes Factures";
require_once("header.inc.php");
chk_user_login();
$set_div="none";
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=10:$pagesize;
$columns = "select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(facture_date,'%d/%m/%Y') as post_date ";
$sql = " from tbl_facture, tbl_classified
		where tbl_classified.mem_id  ='$_COOKIE[memId]' 
		and tbl_classified.classified_id=tbl_facture.classified_id
		ORDER BY tbl_facture.facture_date  DESC limit $start, $pagesize ";

$sql = $columns.$sql; 
$rs_facture=db_query($sql);	
$count_facture = mysql_fetch_array(db_query("Select FOUND_ROWS() as total")); 
$reccnt=$count_facture['total'];

?>


<div class="grid_3">
    <br />
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF">
    
	<div class="account-link">
		<?php require_once("my_account_links.php"); ?>
	</div>
    
	<div class=""><?php echo Display_Message();?> </div>
    
	<div class=""><?php include("paging.inc.php"); ?></div>
    
    
    <div class="p7">        
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading"><div class="main-heading">Mes Factures</div></div>
          <div class="panel-body">
              <!-- Table -->
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
                                <td><?=$post_date?></td>
                                <td><?=$facture_num?></td>
                                <td><?=$mode_paiement?></td>
                                <td><?=$facture_total?></td>
                                <td>
                                    <a href="bill.php?reference=<?=$facture_num?>&mode=html" target="_blank"><i class="fa fa-file-text"></i></a>
                                    <a href="bill.php?reference=<?=$facture_num?>&mode=pdf" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
                                </td>
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
        
	</div>
    
</div>
<?php require_once("footer.inc.php"); ?>