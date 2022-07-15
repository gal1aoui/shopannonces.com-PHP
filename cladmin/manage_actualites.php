

<?php
echo PageTitle("Manage Actualité");
?>
<table>
<tr>
	<td>
        <A href="land.php?file=add_actualite">Ajouter Actualités</A>
    </td>
</tr>
</table>
<form id="form1" name="form1" method="post" action="">

      <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
        <tr>
        <td>&nbsp;</td>
         <th>ID News</th>
         <th width="15px">Date</th>
	     <th>Sujet</th>
	     <th>Categories</th>
         <th>Order</th>
          <th>Nbre Visites</th>
    </tr>
    
    <?php            
	  $sql_cat=db_query("select * from news ORDER BY news_id DESC ");
      
   $nm=mysql_num_rows($sql_cat);
  if($nm > 0 ){
	  
	  while($rw=mysql_fetch_array($sql_cat))
	  {
	  ?>
      <tr>
            <th width="150px"><a href="land.php?file=mod_actualite&news_id=<?php echo $rw[news_id];?>">Modifier</a>,
            	<a href="land.php?file=sup_actualite&news_id=<?php echo $rw[news_id];?>">Supprimer</a></th>
			<td><?php echo $rw[news_id];?></td>
			<td><?php echo $rw[date_news];?></td>
			<td><?php echo $rw[sujet_news];?></td>
            <td>
            <?php            
				$res=db_query("select * from categories_news WHERE categ_news_id='".$rw[categ_id]."'");
				
				$resw=mysql_fetch_array($res);
				echo $resw[categ_news_name];
			?>
            </td>
			<td><?php echo $rw[order_news];?></td>
			<td><?php echo $rw[visite_news];?></td>
       </tr>
	   <?php
	  }
  }
  else{
	  echo "Aucune news";
  }
	  ?>
</table>

</form>