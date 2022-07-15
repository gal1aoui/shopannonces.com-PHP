<?php


if(@$_REQUEST[action]=='Add'){
	db_query("insert into categories_news 
			set categ_news_name='$_REQUEST[name_categ]'");
		
	 $_SESSION['site_admin_message']=" Category Updated successfully....";
	header("Location: land.php?file=categ_actualite");
	exit();	
 }
else if(@$_REQUEST[action]=='Modifier'){
	db_query("UPDATE categories_news 
			set categ_news_name='$_POST[name_categ]'
			WHERE categ_news_id='$_POST[cat_id]'");
}
else if(@$_REQUEST[action]=='sup'){
	db_query("DELETE FROM `categories_news` WHERE `categ_news_id`='$_REQUEST[cat_id]'");
//	exit();	
}


echo PageTitle("Ajouter Categorie Actualité");


?>

<a href="land.php?file=manage_actualites">Retour</a>
<form id="form1" name="form1" method="post" action="">

      <table  border="0" cellpadding="0" cellspacing="1">
        <tr>
             <th>
                Nom Categorie
             </th>
             <td>
             <?php
             if(@$_REQUEST[action]=='mod'){
					$sql_cat=db_query("select * from categories_news where categ_news_id=".$_REQUEST['cat_id']);
					$rw=mysql_fetch_array($sql_cat);
				 	?>
                    <input type="hidden" name="cat_id" value="<?php echo $rw[categ_news_id];?>" />
                    <input type="text" name="name_categ" value="<?php echo $rw[categ_news_name];?>" />
                    <?php
				}
				else{
					?>
                    <input type="text" name="name_categ" />
                    <?php
				}
				?>                
             </td>
            <td align="center">
            	
             <?php
             if(@$_REQUEST[action]=='mod'){				
				 ?>
                    <input type="submit" value="Modifier" >
                    <input name="action" type="hidden" value="Modifier" >
                    <?php
				}
				else{
					?>
                    <input type="submit" value="Ajouter" >
                    <input name="action" type="hidden" value="Add" >
                <?php
				}
				?>
            </td>
        </tr>
	<?php            
    $sql_cat=db_query("select * from categories_news");
    
    $nm=mysql_num_rows($sql_cat);
    if($nm > 0 ){
		while($rw=mysql_fetch_array($sql_cat))
		{
			?>
			<tr>
            	<td><?php echo $rw[categ_news_id];?></td>
                <th align="left">
	                <?php echo $rw[categ_news_name];?>
                </th>
                <td>
                	<a href="land.php?file=categ_actualite&action=mod&cat_id=<?php echo $rw[categ_news_id]; ?>">Modifier</a>
                	&nbsp;
                    <a href="land.php?file=categ_actualite&action=sup&cat_id=<?php echo $rw[categ_news_id]; ?>">Supprimer</a></td>
			</tr>
			<?php
		}
    }
    else{
	    echo "Aucune categories";
    }
    ?>
</table>
<br />


</form>