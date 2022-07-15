<?php
if($reccnt>$pagesize){
	
$num_pages=$reccnt/$pagesize;

$PHP_SELF=$_SERVER['PHP_SELF'];
$qry_str=$_SERVER['argv'][0];

$m=$_GET;
unset($m['start']);

$qry_str=qry_str($m);
//echo "$qry_str : $p<br>";
//$j=abs($num_pages/10)-1;
$j=$start/$pagesize-5;
//echo("<br>$j");
if($j<=0) {
	$j=0;
}
$k=$j+10;
if($k>$num_pages)	{
	$k=$num_pages;
}
$j=intval($j);
?><? if($start!=0){?><a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start-$pagesize?>" class="floatLeft white">&laquo; Previous</a><? }else{?> <? }?><div class="tabs"  align="center">
<? for($i=$j;$i<$k;$i++)
			{	if(($pagesize*$i)!=$start){?><a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$pagesize*$i?>" class="navBarTxt"><?=$i+1?></a><? }else{ ?><?=$i+1?><? }
		   }?>
</div><? if($start+$pagesize < $reccnt){?><a href="<?=$PHP_SELF?><?=$qry_str?>&start=<?=$start+$pagesize?>" class="floatRight white">Next &raquo;</a><? } }?>