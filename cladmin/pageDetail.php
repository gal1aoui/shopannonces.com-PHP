<?php
require_once("../includes/main.inc.php");
require_once("admin-function.php");
$pid=@$_REQUEST['pid'];
$sel=db_query("select * from tbl_staticpage where pid='$pid'");
$row=mysql_fetch_array($sel);
$pagecontent=html_entity_decode($row[page_desc]); 
?>
<style type="text/css">
<!--
.style1 {font-weight: bold}
-->
</style>

<table width="98%" border="1" align="center" cellpadding="3" cellspacing="3" bordercolor="#333333" style="border-collapse:collapse ">
  <tr>
    <td width="98%" align="left" bgcolor="#CCCCCC"><span class="style1">
      <?php echo ucfirst($row['pagename']);?>
    </span></td>
  </tr>  
  <tr>
    <td align="left"><?php echo $pagecontent;?></td>
  </tr>
  <tr>
    <td align="right">
    	<a href="#" onclick="window.close();"><img src="images/close-window.gif" width="95" height="24" border="0" /></a>
	</td>
  </tr>
</table>
