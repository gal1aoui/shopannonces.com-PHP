<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','7');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;
require_once("header.inc.php");
$stat=@$_REQUEST['stat'];
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=12:$pagesize;
$columns = "select * ";
$sql = " from tbl_faq where page_status ='1' order by rec_order asc ";
$sql_count = "select count(*) ".$sql; 
$sql .= " limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
?>

<div class="grid_3">
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">
    
    <div class="tree"><a href="index.php">Accueil</a> >> FAQ </div>

    <div class="p7">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><span class="title_clad">FAQ</span></div>
            <div class="panel-body">

                <div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                                <?php
                                $affiche=true;
                                $i=1;
                                $collapse='';
                                $in='in';
                                    while($row=mysql_fetch_array($result)){
                                        ?>
                  <div class="panel panel-default">
                    <div class="panel-heading" role="tab" id="heading<?=$i?>">
                      <h4 class="panel-title">
                        <a <?=$collapse ?>  data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i ?>" aria-expanded="<?=$affiche ?>" aria-controls="collapse<?=$i?>">
                          <?= Rec_display_formate($row['faq_quest']) ?>
                        </a>
                      </h4>
                    </div>
                    <div id="collapse<?=$i?>" class="panel-collapse collapse <?=$in ?>" role="tabpanel" aria-labelledby="heading<?=$i?>">
                      <div class="panel-body">
                        <?= html_entity_decode($row['faq_ans']) ?>
                      </div>
                    </div>
                  </div>	  
                                        <?php
                                        $affiche=false;
                                        $collapse='class="collapsed"';
                                        $in='';
                                        $i++;
                                    }
                                ?>
                   
                </div>

    
            </div>
        </div>
	</div>
    
    
</div>
<?php require_once("footer.inc.php"); ?>