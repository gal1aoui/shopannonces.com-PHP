

<?php
echo PageTitle("Manage Actualité");
?>

<form id="form1" name="form1" method="post" action="">

      <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
      
    <?php            
	  $sql_cat=db_query("select * from tbl_compteur_visite ");
      
	  $co=0;
	  $nbre_visiteur=mysql_num_rows($sql_cat);
	  while($rw=mysql_fetch_array($sql_cat))
	  {
		   $co+=$rw[compteur];
	  }
		  ?>
        <tr>
        	<td>Nbre Total de visiteur</td>
            <td><?php echo $nbre_visiteur;?></td>
            <td>Compteur de pagination</td>
            <td><?php echo $co;?></td>
        </tr>
        <tr>
            <th>id_compteur</th>
            <th>ip_client</th>
            <th>class_mail</th>
            <th>compteur</th>
        </tr>
    
    <?php            
	  $sql_cat=db_query("select * from tbl_compteur_visite  ORDER BY compteur DESC");
      
   $nm=mysql_num_rows($sql_cat);
  if($nm > 0 ){
	  
	  $co=0;
	  while($rw=mysql_fetch_array($sql_cat))
	  {
                
					$css = (@$css=='trOdd')?'trEven':'trOdd';
		  ?>
        <tr  class="<?php echo $css;?>">
				<td><?php echo $rw[id_compteur];?></td>
				<td><?php echo $rw[ip_client];?></td>
				<td><?php echo $rw[class_mail];?></td>
				<td><?php echo $rw[compteur];?></td>
		   </tr>
		   <?php
		   $co+=$rw[compteur];
	  }
  }
  else{
	  echo "Aucune news";
  }
	  ?>
        <tr>
         <th></th>
         <th></th>
	     <th></th>
	     <th><?php echo $co;?></th>
    	</tr>
</table>

</form>