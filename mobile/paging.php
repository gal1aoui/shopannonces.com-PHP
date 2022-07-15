<?php

if($reccnt>$pagesize){	
$num_pages=$reccnt/$pagesize;
$PHP_SELF=$_SERVER['PHP_SELF'];
echo $qry_str=$_SERVER['argv'][0];
$m=$_GET;
unset($m['start']);

$qry_str=qry_str($m);

//echo "$qry_str : $p<br>";
$j=abs($num_pages/10)-1;
$j=$start/$pagesize-5;
//echo("<br>$j");
if($j<0) {
	$j=0;
}
$k=$j+10;
if($k>$num_pages){
	$k=$num_pages;
}
$j=intval($j);
?>
<?php //echo "reccnt=$reccnt, start=$start, pagesize=$pagesize, num_pages=$num_pages : j=$j : k=$k" ?>

<table width="100%" >
	<tr>
    	<td width="25%">
        	<?php	if($start!=0){ ?>
          
          <div class="btn-np">
	          <a class="link"  href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start-$pagesize?>" >
              	<b>« Précédente</b>
              </a>
          </div>
	  <?php	}?>
        </td>
    	<td width="50%" align="center">
        	<?php
		for($i=$j;$i<$k;$i++){
			//if($i==$j)echo "Page: ";
			if(($pagesize*($i))!=$start) {
			   ?>
               
				 <a href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $pagesize*($i)?>" class="link" >
					<b><?php echo $i+1?></b>
				</a>
                
				
			  <?php  }else{
			  ?>
				  
								<?php echo $i+1?>
				  
			  <?php 
			  }
		 }?>
        </td>
    	<td width="25%" align="center">
        	<?php 
	if($start+$pagesize < $reccnt){
		?>
          <div class="btn-np">
<a class="link" href="<?php echo $PHP_SELF?><?php echo $qry_str?>&start=<?php echo $start+$pagesize?>">
<b>Suivante »</b></a>
		</div>
<?php
		}
  ?>
        </td>
	</tr>
</table>

<?php  } ?>