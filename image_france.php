<script type="text/javascript" src="js/mapper.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
			
		$("#regions a").add("area").mouseover(function() {
			var id=this.id.substring(this.id.indexOf("_") + 1);				
			var regionmap = $("#hoverregion_" + id);
			if (regionmap && regionmap.length > 0) {
				//$("#hoverregion_" + id).setAreaOver(this,'gmipam_0_canvas','0,0,255','0,0,0','0.33',0,0,0);


				$("#region_"+id).removeClass().addClass("region map_state");

			}
		});
		$("#regions a").add("area").mouseout(function() {
			var id=this.id.substring(this.id.indexOf("_") + 1);
			var regionmap = $("#hoverregion_" + id);
			if (regionmap && regionmap.length > 0) {
				//$("#hoverregion_" + id).removeClass().css("display","none");
				//$("#hoverregion_" + id).setAreaOut(this,'gmipam_0_canvas',0,0);
//alert($("#hoverregion_" + id).css("display"));
				$("#region_"+id).removeClass().addClass("region link");
			}
		});
	});
	
</script>
<?php

	$mysql = "SELECT * FROM  `tbl_state` where state_status ='Active'  order by state_order";	
	$result = db_query($mysql);
?>


<table border="0" cellspacing="0" width="100%">
    <tr>
        <td>
        <div style="position:relative;">        
			<img class="mapper" src="uploaded_files/carte/carte.png" border="0" usemap="#Map">            
          	<map name="Map">
    <?php
	$i=1;
	while($row = mysql_fetch_array($result)) {
		@extract($row);
	?>
            
            <area shape="poly" class="noborder icolorffff00"
            	coords="<?php echo $coords;?>"
                id="hoverregion_<?php echo $state_id;?>"
                href="search-result.php?classi_state=<?php echo $state_id;?>&button3=Soumettre&searchkey=search_record"
                target="_self"
                title="<?php echo $state_name;?>"> 

	<?php
	$i++;
	}	 
	?>
          </map>
          </div>
		</td>
        <td valign="top" width="25%">
        	<div style="float:right; width:300px;" >
        <div>
            <div class="blue-heading">
                <a href="#categories" class="link1">R&eacute;gion: Toute la France</a>
            </div>
                        
            <div id="regions" style="display:inline-block;">
                <ul class="region_list">
					<?php 
                    $result = db_query($mysql);
                    $p=0;
                    while($row = mysql_fetch_array($result)) {
                        @extract($row);
                        ?>
                                <li>
                                    <a id="region_<?php echo $state_id;?>" href="search-result.php?classi_state=<?php echo $state_id;?>"
                                        class="region link"
                                        style="text-decoration: none;">
                                        <?php echo $state_name;?>
                                    </a>
                                </li>
                        <?php 
                        if($p==13){
                            ?>
                </ul>
                <ul class="region_list">
                            <?php
                        }
                        $p++;
                    }
                    ?>
                </ul>
            </div>
        </div>
        
        <div>
            <div id="fb-root"></div>
			<script>(function(d, s, id) {
              var js, fjs = d.getElementsByTagName(s)[0];
              if (d.getElementById(id)) return;
              js = d.createElement(s); js.id = id;
              js.src = "//connect.facebook.net/fr_FR/sdk.js#xfbml=1&version=v2.0";
              fjs.parentNode.insertBefore(js, fjs);
            }(document, 'script', 'facebook-jssdk'));</script>
    
            <div class="fb-like-box" data-href="https://www.facebook.com/pages/Petites-annonces/668700739811707?ref=hl&amp;ref_type=bookmark" data-width="300" data-height="300" data-colorscheme="light" data-show-faces="true" data-header="true" data-stream="false" data-show-border="true"></div>
        </div></div>
        </td>
	</tr>
</table>
