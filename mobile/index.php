<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
	
$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','10');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;

require_once("header.php");
?>

<div id="searchform" class="searchform" >
	<form name="frm" id="frm" action="list.php" method="post" c>    
        <select name="cat" onChange="cat_drop_down_search(this.value,'')" class="textbox" data-native-menu="false" />
            <?php echo cat_search($cat_id,$subcat_id,$sub_subcat_id);?>
        </select>
    <input type="submit" value="Chercher" class="button button-green" />
</div>

<div class="heading">Sélectionnez une région</div>

<div class="body">
    <ul>
        <?php
        $mysql = "SELECT * FROM  `tbl_state` where state_status ='Active'  order by state_name";	
        $result = db_query($mysql);
        while($row = mysql_fetch_array($result)) {
            @extract($row);
            ?>			 
            <li class="evenrow">
                <a class="list-link" href="list.php?stateId=<?php echo $state_id;?>"><?php echo $state_name;?></a>
            </li>
            <?php
        }
        ?>
    </ul>	
</div>

<?php
	require_once("footer.php");
?>
