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
if($j<0) {
	$j=0;
}
$k=$j+10;
if($k>$num_pages)	{
	$k=$num_pages;
}
$j=intval($j);

?>
<?php //="reccnt=$reccnt, start=$start, pagesize=$pagesize, num_pages=$num_pages : j=$j : k=$k"?>
<!--<link href="css/forte.css" rel="stylesheet" type="text/css">-->
<table width="100%" border="0" cellspacing="2" cellpadding="0" align="center">
  <tr>
    <td  width="11%" align="center"><a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=0">First</a></td>
    <td  width="14%" height="20" align="center" nowrap><a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start-$pagesize?>" >
      <?php
		if($start!=0)
		{

?>
&laquo;&nbsp;Previous&nbsp;<?php echo $pagesize?>
      </a><?php
		}
?>
    </td>
    <td class="main" width="52%" align="center" height="20">
	<?php
			
			for($i=$j;$i<$k;$i++)
			{
				if($i==$j)echo "Page:";
			   if(($pagesize*($i))!=$start)
				  {
	  ?>
      <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $pagesize*($i)?>" style="text-decoration:none;" class="white_txt">
      <?php echo $i+1?>
      </a>
      <?php
				  }
	  else{
	  ?>
      <b>
      <?=$i+1?>
      </b>
      <?php
	  }
 }?>
    </td>
    <td  width="13%" height="20" align="center" nowrap><?php
	if($start+$pagesize < $reccnt){
		?>&nbsp;<a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start+$pagesize?>">Next&nbsp;
      <?php //echo("$reccnt,$start,$pagesize");
		if($start+($pagesize*2)>$reccnt)
		{
			echo($reccnt-($start+$pagesize));
		}
		else{
			echo($pagesize);}?>	&nbsp;&raquo;</a>
		<?php
		}
  ?>
    </td>
    <td  width="10%" align="center"><?php echo $mod=$reccnt%$pagesize; if($mod==0){$mod=$pagesize;}?>
    <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $reccnt-$mod?>">Last</a></td>
  </tr>
</table>
<?php }
?>
