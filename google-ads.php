<?php
if($_REQUEST[catId]=='' and ($_REQUEST[subcatId1]!='' or $_REQUEST[subcatId]!=''))
{
	if($_REQUEST[subcatId1]!='')
		$catidx=intval($_REQUEST['subcatId1']);
	if($_REQUEST[subcatId]!='')
	{
		$catidx=intval($_REQUEST['subcatId']);
		$strcc="select * from tbl_category where cat_id='$catidx'";
		$resultcc=mysql_query($strcc) or die(mysql_error());
		$rowcc=mysql_fetch_array($resultcc);
		$catidx=$rowcc[cat_parent];
	}
	$strbb="select * from tbl_category where cat_id='$catidx'";
	$resultbb=mysql_query($strbb) or die(mysql_error());
	$rowbb=mysql_fetch_array($resultbb);
	$strg="select * from tbl_manage_google_ads where cat_id='$rowbb[cat_parent]' and status='Y' order by rand() limit 2";
	$resultg=mysql_query($strg) or die(mysql_error());
	$numg=mysql_num_rows($resultg);
}else{
$tmpCatID = intval($_REQUEST[catId]);
$strg="select * from tbl_manage_google_ads where cat_id='$tmpCatID' and status='Y' order by rand() limit 2";
$resultg=mysql_query($strg) or die(mysql_error());
$numg=mysql_num_rows($resultg);
}
?>
<?php
if($numg>0){
?>
<table width="100%" border="0" cellspacing="0" cellpadding="3" class="mt10">
            <tr>
              <td class="bg-stripcolor b"></td>
              </tr>
            <tr>
              <td valign="top">
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