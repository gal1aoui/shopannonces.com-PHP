<!-- AddThis Button BEGIN -->
<div class="addthis_toolbox addthis_default_style" style="width:140px; margin:0 auto">
<a class="addthis_button_preferred_1"></a>
<a class="addthis_button_preferred_2"></a>
<a class="addthis_button_preferred_3"></a>
<a class="addthis_button_preferred_4"></a>
<a class="addthis_button_compact"></a>
<a class="addthis_counter addthis_bubble_style"></a>
</div>
<script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4fd33abb29e8be4b"></script>
<!-- AddThis Button END -->


<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
?>
<div>
<form  name="" action="search-result.php" method="get" >
      <div style="width:202px;">
        <p><img src="images/left-box-top.jpg" alt=""/></p>
        <div class="bg-left-box pl15 pr15">
		
          <div>
            <p class="fl"><img src="images/view-classified-icon.jpg" alt=""/> &nbsp;&nbsp;</p>
            <p class="fl"><span class="heading">Voir Annonces</span><br />
                <span class="blue-heading" style="margin-left:38px;">Par lieu</span></p>
            <p class="cb"></p>
            <select name="classi_state" class="textbox1" style="width:100%; margin-top:12px;" onChange="return get_city_by_state(this.value,'','250px')" >
             <?=get_state($classi_state);?>
            </select>
			 <div id="city_link" style="width:100%; margin-top:9px; ">
            <select name="classi_city" class="textbox1" style="width:100%; margin-top:9px;">             
            </select>
			 </div>
            <p style="margin-top:10px;"><input name="button3" type="submit" class="button" id="button2" value="Soumettre"/>
              <input type="hidden" name="searchkey" value="search_record">
            </p>
          </div>
		 
        </div>
        <p><img src="images/left-box-bot.jpg" alt=""/></p>
      </div>
	  
    
	  
      <div style="width:202px; margin-top:6px;">
        <p><img src="images/left-box1-top.jpg" alt=""/></p>
        <div class="bg-left-box1 pl10 pr10">
          <div>
       
           
            </p>
            <p class="cb"></p>
            <div class="left-cate">
			
			 <table width="100%" border="0" cellpadding="3" cellspacing="0">
			 
			 
			 <tr>
  <span class="heading" style="margin-left:21px;">Annonces Récentes</span></p>
            <p class="cb"></p>
  </tr>
<?php
	 // $mysql="select * from tbl_classified order by rand() limit 0,1 ";
	 
	// $mysql="select * from tbl_classified where classified_status!='Delete' order by classified_id DESC limit 0,9";
	$mysql = 'SELECT tbl_classified.classified_id, tbl_classified.classified_title, tbl_classified_image.cls_img_file FROM tbl_classified'
			.' LEFT JOIN tbl_classified_image ON tbl_classified.classified_id = tbl_classified_image.clsd_id'
			." WHERE tbl_classified.classified_status='Active' AND tbl_classified.paid_status IN ('Free', 'Paid') AND tbl_classified_image.img_status='Y'"
			.' GROUP BY tbl_classified.classified_id ORDER BY tbl_classified.classified_id DESC limit 0,7';
	  
	//$mysql="select * from tbl_classified where classified_id=4 ";
	
	$resultnav = mysql_query($mysql);
	while($rownav = mysql_fetch_array($resultnav)) {
		if($rownav['cls_img_file'] != '') {
			$file_sm = 'classified_img/'.$rownav['cls_img_file']; 
			$file_path_sm =	show_thumb($file_sm, '85', '100', 'width');
?>
<tr>
	<td><div align="center"><a href="classified-details.php?clsId=<?php echo $rownav['classified_id']; ?>" style="text-decoration:none;"><?php echo $rownav['classified_title']; ?></a></div></td>
</tr>

<tr>
	<td><div align="center"><img src="<?php echo $file_path_sm;?>" alt="" width="65" height="45" border="0" class="border-img" /></div></td>
</tr>
<?php			
			
		}
	}
?>	
  
</table>

			</div>
          </div>
        </div>
        <p><img src="<?=$theem_img;?>/left-box1-bot.jpg" alt=""/></p>
      </div>

	   </form>
    </div>