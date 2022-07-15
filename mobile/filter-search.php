
	<form name="frm" id="frm" action="list.php" method="get" >    

    <input type="hidden" name="x" value="<?php echo $_REQUEST[x];?>" />
    <input type="hidden" name="y" value="<?php echo $_REQUEST[y];?>" />


	<input type="text" name="keyword" id="keyword"
            class="textbox" value="<?php if($_REQUEST['keyword']!="") echo $_REQUEST['keyword']; ?>"
            placeholder="<?php if($_REQUEST['keyword']!="") echo $_REQUEST['keyword']; else echo 'mot(s) clé(s)';?>"  />
        
    <select name="cat" onChange="cat_drop_down_search(this.value,'')" class="textbox" data-native-menu="false" />
        <?php echo cat_search($cat_id,$subcat_id,$sub_subcat_id);?>
    </select>

    <select name="stateId" onChange="serach_city_by_state(this.value,'')" class="textbox" data-native-menu="false" />	       
	    <?php echo get_state_index(@$_REQUEST['stateId']);?>
    </select>
    
    <select name='cityId' id="classi_city" class="textbox" data-native-menu="false"  />
        <div id="bloc_city" >
        <?php echo get_city(@$_REQUEST['cityId'],@$_REQUEST['stateId']);?>	
        </div>	
    </select>
    	  
    <div>
    <input type="radio" name="offer_type" id="offre1" class="textbox" value="Offre" <?php if($_REQUEST[offer_type]=="Offre") echo "checked='checked'"; ?> />
    <label for="offre1">Je offre</label>
    
    <input type="radio" id="offre2" name="offer_type" class="textbox" value="Cherche" <?php if($_REQUEST[offer_type]=="Cherche") echo "checked='checked'"; ?> />
    <label for="offre2">Je cherche</label>
    |
    <input type="checkbox" name="picture" id="picture" class="textbox" <?php if($_REQUEST[picture]=="on") echo "checked='checked'"; ?> />
    <label for="picture">Avec photo</label>
    </div>
    <input type="submit" value="Chercher" class="button button-green" />

    
</form> 
                
