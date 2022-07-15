<?php
$sql_dis=db_query("select * from tbl_site_setting where id =1");
$rw=mysql_fetch_assoc($sql_dis);
//@extract($rw);
?>
<?php echo PageTitle('Site Setting Management');?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td>	  
     </b>
		<div align="right" > <br>
		<a href="land.php?file=add_edit_site_setting"><b>Update Setting </b></a>
		<br><br>
		</div>		   
        <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
          <tr align="left">
             <th width="19%" height="22" >Classified Title </th>
             <th width="18%">Classified Description </th>
             <th width="20%">Classified Price </th>
             <th width="23%">Classified Footer </th>
          </tr>
             <?			
			 $css = (@$css=='trOdd')?'trEven':'trOdd';			 		 
             ?>
          <tr align="left" class="<?php echo $css;?>">
                         <td>
						 	<p>Font Type :<?php echo $rw['title_font_type'];?></p>
						 	<p>Font Size :<?php echo $rw['title_font_size'];?></p>
							<p>Font Color :<?php echo $rw['title_font_color'];?></p>		    
                         </td>
						 <td><p>Font Type :<?php echo $rw['desc_font_type'];?></p>
						   <p>Font Size :<?php echo $rw['desc_font_size'];?></p>
						   <p>Font Color :<?php echo $rw['desc_font_color'];?></p>
                         </td>
						 <td>Font Color :<?php echo $rw['price_font_color'];?></td>
						 <td>
                         	<p>Font Type :<?php echo $rw['footer_font_type'];?></p>
						   <p>Font Size : <?php echo $rw['footer_font_size'];?></p>
						   <p>Font Color : <?php echo $rw['footer_font_color'];?></p>
                         </td>
	      </tr>         
      </table>
                <table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="63%" align="right" style="padding:2px">
			<!--<input name="Activate" type="image" id="Activate" src="images/buttons/activate.gif" onClick="return activateConfirmFromUser('arr_pd_ids[]')"/>
              <input name="Deactivate" type="image" id="Deactivate" src="images/buttons/deactivate.gif" onClick="return deactivateConfirmFromUser('arr_pd_ids[]')"/>-->                          </td>
            <td width="37%" align="left" style="padding:2px"><span class="txt12">
              </span>
            </td>
          </tr>
        </table>
	</td>
  </tr>
</table>