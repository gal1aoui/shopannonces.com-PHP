<?
require_once("includes/main.inc.php");
require_once("includes/funcs_lib.inc.php");
require_once("front-functions.php");
$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','10');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;
require_once("header.inc.php");
?>
<table width="1000" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td width="193" valign="top" style="padding:5px 0 0 3px;">
	<?php require_once("left.inc.php"); ?>
	</td>
    <td width="807" valign="top" style="padding:5px 5px 0 5px;">
	<?php require_once("cat-subcat-box.php"); ?>
	</td>
  </tr>
</table>
<?php require_once("footer.inc.php"); ?>