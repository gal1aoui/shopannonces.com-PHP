<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','6');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;
require_once("header.inc.php");
//DEF_PAGE_SIZE
$stat=@$_REQUEST['stat'];
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=20:$pagesize;
$columns = "select * ";
$sql = " from ".DB.".tbl_help_category where cat_status ='Y' order by cat_order asc ";
$sql_count = "select count(*) ".$sql; 
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
if($reccnt >0 ) {
 while($row=mysql_fetch_array($result)){
 $cat_arr[]=array('cat_id'=>$row['cat_id'],'cat_name'=>$row['cat_name']);
  }
}

?>
<script type="text/javascript">

$(document).ready(function(){
	$("a[id^='mostrar']").each(function(){
			$(this).click(function(event) {
			var objId=$(this).attr('id').substring(7);
			event.preventDefault();
			$("#caja"+objId).slideToggle();
			});
	});
});
</script>



<div class="grid_3">
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">

    <div class="tree"><a href="index.php">Accueil</a> >> Aide </div>

    <div class="p7">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><span class="title_clad">Aide</span></div>
            <div class="panel-body">
                <div class=""><?php include("paging.inc.php");?></div>
            
                <?php 
                if($reccnt >0 ) {
					?>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
                <?php
				$affiche=true;
				$i=1;
				$collapse='';
				$in='in';
				
                    foreach ($cat_arr as $ikey=>$ival){ ?>
                    

  <div class="panel panel-default">
    <div class="panel-heading" role="tab" id="heading<?=$i?>">
      <h4 class="panel-title">
        <a <?=$collapse ?>  data-toggle="collapse" data-parent="#accordion" href="#collapse<?=$i ?>" aria-expanded="<?=$affiche ?>" aria-controls="collapse<?=$i?>">
          <?= ucfirst($ival['cat_name']) ?>
        </a>
      </h4>
    </div>
    <div id="collapse<?=$i?>" class="panel-collapse collapse <?=$in ?>" role="tabpanel" aria-labelledby="heading<?=$i?>">
      <div class="panel-body">
        <?php		
                            $ival[cat_id] = intval($ival[cat_id]);
                            $str1="select * from tbl_help where help_catid=$ival[cat_id] order by help_order asc ";
                            $result1=mysql_query($str1);
                            if(mysql_num_rows($result1) > 0 ){		
								while($row1=mysql_fetch_array($result1)){
								?>
								<p class="ptb3">
								<a href="help-details.php" class="link1" id="mostrar<?php echo $i;?>">Q:- <?php echo ucfirst($row1['help_quest']);?></a>
								</p>
								<div  id="caja<?php echo $i;?>" class="shared" style="display:none; background-color:#eeeeee; border:1px solid #cccccc; margin-top:8px; margin-left:10px; margin-bottom:5px; padding-left:6px; padding-right:6px;"><?php echo (html_entity_decode($row1['help_ans']));?></div>
								<?php $i++;
								}
                            }
                            
                            ?>
      </div>
    </div>
  </div>	  
						<?php
						$affiche=false;
						$collapse='class="collapsed"';
						$in='';
						$i++;
					
				?>
                <!--
                        <table width="100%" border="0" cellpadding="3" cellspacing="0" class="cate-border mt10">
                            <tr>
                            <td width="91%" class="bg-stripcolor heading p7">
                            <a href="#javascript();" onclick="show(1)" class="link"><?php echo ucfirst($ival['cat_name']);?></a></td>
                            </tr>			
                            <tr>
                            <td class="bg-stripcolor">
                            <div id="t1" style="display:block;">
                            <?php		
                            $ival[cat_id] = intval($ival[cat_id]);
                            $str1="select * from tbl_help where help_catid=$ival[cat_id] order by help_order asc ";
                            $result1=mysql_query($str1);
                            if(mysql_num_rows($result1) > 0 ){		
								while($row1=mysql_fetch_array($result1)){
								?>
								<p class="ptb3">
								<a href="help-details.php" class="link1" id="mostrar<?php echo $i;?>">Q:- <?php echo ucfirst($row1['help_quest']);?></a>
								</p>
								<div  id="caja<?php echo $i;?>" class="shared" style="display:none; background-color:#eeeeee; border:1px solid #cccccc; margin-top:8px; margin-left:10px; margin-bottom:5px; padding-left:6px; padding-right:6px;"><?php echo (html_entity_decode($row1['help_ans']));?></div>
								<?php $i++;
								}
                            }
                            
                            ?>
                            </div>
                            </td>
                            </tr>
                        </table>
            -->
                    <?php 
                    }
					?>
	</div>
<?php
                } ?>
                <div class=""><?php include("paging.inc.php");?></div>

            </div>
        </div>
	</div>
    
</div>
<?php require_once("footer.inc.php"); ?>