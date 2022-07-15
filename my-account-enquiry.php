<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$meta_titles="Mes Messages";
$meta_desc="Mes Messages";
$meta_keywords="Mes Messages";
require_once("header.inc.php");
chk_user_login();
$set_div="none";
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=10:$pagesize;
$columns = "select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(enq_post_date,'%D %M %Y') as post_date ";
$sql = " from tbl_classified_inquiry
where memId ='$_COOKIE[memId]' and enq_status='Active' ORDER BY enq_post_date DESC limit $start, $pagesize ";

$sql = $columns.$sql; 
$rs_msg=db_query($sql);	
$res_msg = mysql_fetch_array(db_query("Select FOUND_ROWS() as total")); 
$reccnt=$res_msg['total'];

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
    
    <div class="p7">   
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><div class="main-heading">Mes Messages</div></div>
            <div class="panel-body">
                <?php
                if($reccnt > 0 ) {?>
                    
                    <div class=""><?php include("paging.inc.php"); ?></div>
                    
                    
                    <div class="p7">
                         <form name="form1" method="post" action="">            
                            <table width="100%" class="table table-striped">
                           <?php
                            if($reccnt > 0 ) {
                                ?>
                                    <tr class="">
                                        <th align="left">Petites Annonce</th>
                                        <th align="left" width="25%">Email de l'expéditeur</th>
                                        <th colspan="2" align="left">Message</th>
                                    </tr>
                                <?php
                             $count=0;
                             while($rw=mysql_fetch_array($rs_msg)){ 
                             $count++;
                             $bg=($count%2==0) ? "bg-stripcolor" : "";
                             $sql_cls="select `classified_title`,`classified_key` from `tbl_classified`
                             where classified_id=$rw[enq_classified_id] ";				
                             $rs_cls=db_query($sql_cls);
                             $res=mysql_fetch_array($rs_cls);										
                            ?>
                            <tr class="<?php echo $bg;?>">
                                <td align="left" valign="top">
                                        <?php echo Rec_display_formate(truncateText($res[classified_title],80,' ','...',true));?>
                                </td>
                                <td align="left" valign="top">
                                <strong>Date env.</strong>: <?=$rw['enq_post_date'];?>
                                <br />
                                <strong>Nom</strong>: <?=Rec_display_formate($rw['enq_sender_name']);?>
                                <br />
                                        <?php if($rw['enq_sender_tel']!="") { ?>
                                <strong>Tel</strong>: <?=$rw['enq_sender_tel'];?>
                                <br />
                                        <?php } ?>
                                <strong>Email</strong>: <?=$rw[enq_sender_email];?>
                                </td>
                                <td align="left" valign="top">
                                    <?php echo Rec_display_formate($rw['enq_msg']);?>
                                    <?php 
                                    
                                    /*
                                    echo strip_tags(truncateText($rw['enq_msg'],100,' ','...',true));
                                    if (strlen($rw['enq_msg']) >100 ){?>
                                        
                                        <button  onclick="alert('<?php echo $rw[enq_msg]; ?>')"><b>Plus</b></button>
                                        
                                        
                                    <?php 
                                    }*/
                                    ?>
                                    
                                </td>
                                <td align="left" valign="top" width="30px">
                                    
                                    <button class="flcontact white b">
                                        <a href="classified-preview.php?clsId=<?php echo $rw['enq_classified_id']?>" class="link" target="_blank">
                                            Voir Ann.
                                        </a>
                                    </button><br />
                                    <button class="flcontact white b">
                                        <a href="repondre.php?enq_id=<?php echo $rw['enq_id']?>" rel="facebox" class="link">
                                            Répondre
                                        </a>
                                    </button><br />
                                    <button class="flcontact white b">
                                        <a href="supprimer_enq.php?enq_id=<?php echo $rw['enq_id']?>" rel="facebox" class="link">
                                            Supp.
                                        </a>
                                    </button>
                                </td>
                            </tr>
                            <?php } ?>
                          <?php
                          }else{ ?>
                                <div class="b">Aucune enquête trouvée .....</div>
                            <?php
                          } ?>
                            </table>				
                         </form>	
                    </div>
                
                    <?php
                }else{
                ?>
                    <div class="b" >Aucun message.....</div>   		 
                <?php 
                } ?>
            </div>
        </div>
	</div>
</div>
<?php require_once("footer.inc.php"); ?>