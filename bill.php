<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$cryptinstall="cryptographp.fct.php";
include $cryptinstall;

$link_curr=get_config_setting(15);
$link_details=get_config_setting(17);

if($_REQUEST[reference]!='')
	$reference=secureValue($_REQUEST[reference]);
	
if($_REQUEST[mode]!='')
	$mode=secureValue($_REQUEST[mode]);
	
	
$tmpReference = (isset($reference) && $reference!="") ? $reference : 0;
/**************** Display records ***************/
if(!empty($tmpReference)){
	
	
	if($mode=="html"){
		//affichage en html
		require_once("header.inc.php");
		if(isset($_COOKIE['memId']) && $_COOKIE['memId']!=""){
			
			$sql_bill_show = "SELECT * , DATE_FORMAT( facture_date,  '%d/%m/%Y' ) AS post_date
								FROM tbl_facture, tbl_classified
								WHERE 
									tbl_classified.mem_id =  '$_COOKIE[memId]' 
									AND tbl_classified.classified_id = tbl_facture.classified_id
									AND tbl_facture.facture_num = '".$tmpReference."'";
									//, tbl_facturer
									//AND tbl_facture.facture_id = tbl_facturer.facture_id
									//AND tbl_facturer.featured_id = tbl_featured_option.featured_id
									//, tbl_featured_option
	
			$rs_bill=db_query($sql_bill_show);
			
			$count_facture = mysql_fetch_array(db_query("Select FOUND_ROWS() as total")); 
			$reccnt=$count_facture['total'];
	
	/**************** End Display Records ***************/
	
			
			while($line_raw = mysql_fetch_array($rs_bill)){
			@extract($line_raw);
	?>
                <div class="grid_16" style="background-color:#FFFFFF">
                  
                    <div class="p7">  
                        <div class="panel panel-default">
                          <!-- Default panel contents -->
                          <div class="panel-heading">
                            <img src="mobile/uploaded_files/logo/logo.png" />
                          </div>
                          <div class="panel-body">
                              
                              <p>
                                <div class="heading">Facture à l'intention de : </div>
                                <?=$classified_poster_email ?>
                              </p>              
                              
                              <p style=" width:400px; float:right; ">
                                <span class="heading">Fait le :  </span> <?=$post_date ?><br />
                                <span class="heading">Facture N° : </span> <?=$facture_num ?><br />
                                <span class="heading">Mode de paiement: </span>  <?=$mode_paiement  ?>
                              </p>
                              
                              
                              
                              <p style="clear: right;">
                                <h1>Facture pour la prestation: <?=$facture_num ?></h1>
                                D&eacute;tails:
                                
                              
                              <br />
                              <br />
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>Référence</th>
                                                <th>Désignation</th>
                                                <th>Quantité</th>
                                                <th>Durée</th>
                                                <th>Prix unitaire HT</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php  
                                            $sql_bill_article = "SELECT * 
                                                                FROM tbl_featured_option, tbl_facturer, tbl_facture
                                                                WHERE
                                                                    tbl_facture.facture_num = '".$facture_num."'
                                                                AND tbl_facture.facture_id = tbl_facturer.facture_id  
                                                                AND tbl_facturer.featured_id  = tbl_featured_option.featured_id ";
                                                                //ORDER BY tbl_featured_option.featured_id 
                                            $rs_article=db_query($sql_bill_article);
                                            
                                            while($line_raw = mysql_fetch_array($rs_article)){
                                                @extract($line_raw);
                                                ?>
                                                    <tr>
                                                        <td>AN-<?=strtoupper($featured_reference) ?></td>
                                                        <td><?=strtoupper($featured_designation) ?></td>
                                                        <td>1</td>
                                                        <td><?=strtoupper($featured_duree_vie) ?> (Jours)</td>
                                                        <td><?=strtoupper($featured_prix) ?> &euro;</td>
                                                    </tr>
                                                <?php
                                            }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">Total:</td><td><?=$facture_total ?> &euro;</td>
                                            </tr>
                                        </tfoot>
                                    </table>
                              </p>
                              
                              
                              <br />
                              <br />
                              <br />
                              <br />
                              <p>
                                Email : contact@mesannonces.site - web : www.mesannonces.site
                              </p>
                              
                         </div>
                        </div>
                </div>
                </div>
                <?php
			}
		}
		require_once("footer.inc.php"); 
	}
	else if($mode=="pdf"){
		//affichage en pdf
		header('Content-type:application/pdf');
		readfile("mobile/uploaded_files/factures/".$tmpReference.".pdf");

		?>
        
		
<?php
		

	}

}

?>