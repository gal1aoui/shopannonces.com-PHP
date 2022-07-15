<?php
$tmpID = (empty($_REQUEST[clsId]) || !is_numeric($_REQUEST[clsId])) ? 0 : intval($_REQUEST[clsId]);
$strcat="select clsd_cat_id from tbl_classified where classified_id ='$tmpID'";
$resultcat=mysql_query($strcat) or die(mysql_error());
$rowcat=mysql_fetch_array($resultcat);
$strg="select * from tbl_manage_google_ads where cat_id='$rowcat[clsd_cat_id]' and status='Y' order by rand() limit 4";
$resultg=mysql_query($strg);
$numg=mysql_num_rows($resultg);
?>
<?php if($numg>0){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="3" class="mt17">
        <tr>
          <td class="bg-stripcolor b"></td>
        </tr>
        <tr>
          <td>
		  <?php
		  while($rowg=mysql_fetch_array($resultg)){
		  ?> 
		  <div class="border-bot"><?=$rowg[google_ads]?></div>
		  <?php
		  }
		  ?>            
          </td>
        </tr>
    </table>
<?php
}
?>