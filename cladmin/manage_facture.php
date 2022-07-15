<?php

$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;

//if(@$_REQUEST['sortcls']!=""){
$columns = "select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(facture_date,'%d/%m/%Y') as post_date ";
$sql = " from tbl_facture, tbl_classified
		where 
			tbl_classified.classified_id=tbl_facture.classified_id ";
		/*ORDER BY tbl_facture.facture_date  DESC limit $start, $pagesize ";
				where classified_status!='Delete' AND clsd_cat_id like '%$_REQUEST[cat_level_root]%' and clsd_subcat_id like '%$_REQUEST[cat_level_one]%' and   clsd_sub_subcat_id like '%$_REQUEST[cat_level_two]%' ";*/
//}	 

$keyword=@$_REQUEST["keyword"];
if($keyword!=''){
	$sql.=" And (
					facture_num like '%".$keyword."%' 
					
					or tbl_facture.classified_id like '%".$keyword."%' 
					or classified_title like '%".$keyword."%' 
					
					Or  classified_poster_name like '%".$keyword."%' 
					Or  classified_poster_email like '%".$keyword."%'
					
				) ";
}
/*


$count_facture = mysql_fetch_array(db_query("Select FOUND_ROWS() as total")); 
$reccnt=$count_facture['total'];*/


@$order_by == '' ? $order_by = 'facture_date' : true;
@$order_by2 == '' ? $order_by2 = 'desc' : true;

$sql_count = "select count(*) ".$sql; 
$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$rs_facture = db_query($sql);

$reccnt = db_scalar($sql_count);

echo PageTitle("Factures");
?>


<form method="get" name="form2" id="form2"  action="" >
        <br>
        <table width="90%"  border="0" align="center" cellspacing="0"  class="lightBorder">
			<div class="msg"><?php echo display_sess_msg()?></div>
            <tr align="left">
                <th colspan="3">Search Facture</th>
            </tr>
            <tr>
				<td width="23%" align="left" class="tdLabel">
					<strong>Keyword : </strong>
				</td>
				<td colspan="2" align="left" class="tdLabel">
					<input type="hidden" name="file" value="manage_facture" />
					<input name="keyword" type="text" class="textfield3" value="<?php echo $keyword;?>"  size="45"/>
					( Poster Name, Poster Email, Classified Title, Ad-ID, N° Facture) 
                                
				</td>
			</tr>
            <tr>
            	<td width="23%" align="left" class="tdLabel">&nbsp;</td>
                <td align="left" class="tdLabel">	
                    <br>			
                  <input type="submit" class="btn_orange" name="search" value="Search">
                </td>
                <td align="center" class="tdLabel">&nbsp;</td>
          </tr>
       </table>
                    <br>
</form>
    

              <?php
			  
            	if($reccnt > 0 ) { 
				?>
                         
      				<table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>ID Annonce <?php echo sort_arrows('tbl_facture.classified_id');?></th>
                                <th>Email Annonceur</th>
                                <th>Référence</th>
                                <th>Moyen de paiement <?php echo sort_arrows('mode_paiement');?></th>
                                <th>Montant TTC <?php echo sort_arrows('facture_total');?></th>
                                <th>Option Payée(s)</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
               <?php
					while ($line_raw = mysql_fetch_array($rs_facture)) 
					{
						@extract($line_raw);
		   				$css = ($css=='trOdd')?'trEven':'trOdd';
				  	?>     
                            <tr  class="<?php echo $css;?>" style="border-bottom:#999 1px solid">
                                <td><?=$post_date?></td>
                                <td>
                                	<a href="classified_details.php?clsId=<?=$classified_id?>" target="_blank">
                                    	<b><font color="#FF0000"><?=$classified_id?></font></b>
                                    </a>
                                 </td>
                                <td><?=$classified_poster_email?></td>
                                <td><?=$facture_num?></td>
                                <td><?=$mode_paiement?></td>
                                <td><?=$facture_total?></td>
                                <td>
                                <?php
									$sql = "SELECT * 
											FROM tbl_featured_option, tbl_facturer, tbl_facture
											WHERE
												tbl_facture.facture_num = '".$facture_num."'
											AND tbl_facture.facture_id = tbl_facturer.facture_id  
											AND tbl_facturer.featured_id  = tbl_featured_option.featured_id";
												
									$rs_option=db_query($sql);	
									while ($line_option = mysql_fetch_array($rs_option)) 
									{
										echo '<span class="premium">'.$line_option[featured_designation].'</span> ';
									}
								?>
                                
                                </td>
                                <td>
                                    <a href="../mobile/uploaded_files/factures/<?= $facture_num?>.pdf" target="_blank"><i class="fa fa-file-pdf-o"></i></a>
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
				
include("paging.inc.php");?>