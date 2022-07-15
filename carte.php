
<?php
	$mysql = "SELECT * FROM  `tbl_state` where state_status ='Active'  order by state_name";	
	$result = db_query($mysql);
?>
<table>
	<tr>
    	<td>
        	<div id="map_map" class="sprite_map">
                <img src="mobile/uploaded_files/carte/transparent.gif" id="area_highlight" alt="France" />
                <img src="mobile/uploaded_files/carte/transparent.gif" id="area_map" usemap="#map_map_map" alt="France" />
            </div>
        
            <map name="map_map_map" id="map_map_map">
                <?php
                while($row = mysql_fetch_array($result)) {
                    @extract($row);
                    ?>                            
                    <area tabindex="-1" shape="poly" id="hoverregion_<?php echo $state_id;?>"
                        coords="<?php echo $coords;?>"
                        href="search-result.php?classi_state=<?php echo $state_id;?>"
                        alt="<?php echo $state_name;?>"
                        title="<?php echo $state_name;?>" />                
                    <?php
                }	 
                ?>
            </map>
            
            
 
        </td>
    	<td valign="top">
        	<div id="regions" class="grid_4">
                <div class="grid_4 heading">
                    <h2 class="OnOne"><a href="#categories" class="link1" rel="nofollow">R&eacute;gion: Toute la France</a></h2>
                </div>
            	<div class="grid_4">
					<?php 
                    $result = db_query($mysql);
                    $p=0;
                    while($row = mysql_fetch_array($result)) {
                        @extract($row);
                        ?>
                        <a id="region_<?php echo $state_id;?>" href="search-result.php?classi_state=<?php echo $state_id;?>" class="region link">
                            <?php echo $state_name;?>
                        </a>
                        <br />
                        <?php 
                        if($p==13){
                            ?>
                            </div>
                            <div  class="grid_4">
                            <?php
                        }
                        $p++;
                        
                    }
                    ?>
                </div>
            </div>
            
            <div>
            <iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2Fpages%2FPetites-annonces%2F668700739811707&amp;width&amp;height=62&amp;colorscheme=light&amp;show_faces=false&amp;header=false&amp;stream=false&amp;show_border=false" scrolling="no" frameborder="0" style="border:none; overflow:hidden; height:62px;" allowTransparency="true"></iframe>
            </div>
        </td>
	</tr>
</table>
