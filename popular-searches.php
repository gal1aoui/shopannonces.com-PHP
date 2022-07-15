<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','4');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;
require_once("header.inc.php");
$cat_Arr=main_cat_array();
//print_r($cat_Arr);
//echo get_keyword_searched($cat_Arr[1]['catId']);

?>

<div class="grid_3">
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">

	<div class="main-heading">Recherche populaire</div>
    
	<div class="tree">
    	<a href="index.php">Accueil</a> >> Petites Annonces
	</div>
	
	<div class="">
        <table width="100%" border="0" cellpadding="2" cellspacing="0" class="cate-border">
            <tr>
                <td width="33%" valign="top" class="col-border">
                    <p class="box-head ptb9"><span class="heading"><?=$cat_Arr[1]['catName'];?></span></p>
                    <?php echo pupolar_search($cat_Arr[1]['catId'],'',10); ?>
                    <p class="box-head mt10 ptb9"><span class="heading"><?=$cat_Arr[2]['catName'];?></span></p>
                    <?php echo pupolar_search($cat_Arr[2]['catId'],'',10); ?>
                    <p class="box-head ptb9"><span class="heading"><?=$cat_Arr[3]['catName'];?></span></p>
                    <?php echo pupolar_search($cat_Arr[3]['catId'],'',10); ?>
                </td>
                <td width="34%" valign="top" class="col-border">
                    <p class="box-head ptb9"><span class="heading"><?=$cat_Arr[4]['catName'];?></span></p>
                    <?php echo pupolar_search($cat_Arr[4]['catId'],'',10); ?>
                    <p class="box-head mt10 ptb9"><span class="heading"><?=$cat_Arr[5]['catName'];?></span></p>
                    <?php echo pupolar_search($cat_Arr[5]['catId'],'',10); ?>
                </td>
                <td width="33%" valign="top">
                	<p class="box-head ptb9">
                    <span class="heading"><?=$cat_Arr[6]['catName'];?></span></p>
                    <?php echo pupolar_search($cat_Arr[6]['catId'],'',10); ?>
                    <p class="box-head mt10 ptb9"><span class="heading"><?=$cat_Arr[7]['catName'];?></span></p>
                    <?php echo pupolar_search($cat_Arr[7]['catId'],'',10); ?>
                </td>
            </tr>
        </table>
	</div>

</div>
<?php require_once("footer.inc.php"); ?>