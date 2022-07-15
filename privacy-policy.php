<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($title,$description,$keyword)=get_meta_details('tbl_staticpage','pid','3');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;

require_once("header.inc.php");
?>

<div class="grid_3">
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">

	<div class="tree">
    	<a href="index.php">Accueil</a> >> Politique de confidentialité
	</div>
	
    <div class="p7">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><span class="title_clad">Politique de confidentialité</span></div>
            <div class="panel-body">
                    <?php echo pagecontent(3);?>
            </div>
        </div>
	</div>

</div>
<?php require_once("footer.inc.php"); ?>