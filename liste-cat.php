<form name="frm" action="search-result.php" method="get">

<div class="green-bgcolor white-style b" style="border-radius: 3px 3px 0 0; padding:5px; border-width:2px 2px 2px 2px; border-style: solid;">

    <input type="hidden" name="x" value="<?php echo $_REQUEST[x];?>" />
    <input type="hidden" name="y" value="<?php echo $_REQUEST[y];?>" />

	<div>
        <input type="text" name="keyword"
            class="textbox" 
            placeholder="<?php if($_REQUEST['keyword']!="") echo $_REQUEST['keyword']; else echo 'mot(s) clé(s)';?>" />
            
        <select name="cat" onChange="cat_drop_down_list(this.value,'')" class="textbox">
            <?php echo cat_search($cat_id,$subcat_id,$sub_subcat_id);?>
        </select>
<br />
        <select name="classi_state" onChange="serach_city_by_state(this.value,'')" class="textbox" style="width:auto;">
        <?php echo get_state_index(@$_REQUEST['classi_state']);?>
        </select>
        
        <div id="bloc_city" style="display:inline-block">
            <select name='classi_city' id="classi_city" class="textbox" style="width:auto;" />
            <?php echo get_city(@$_REQUEST['classi_city'],@$_REQUEST['classi_state']);?>
            </select>
        </div>
    </div>
    
    <div id="filtre">
    <?php
		
		if($cat!=835 && $cat!=888 && $cat!=889 && $cat!=892 && $cat!=893){
		?>                
            Prix:
            <select  name="prixmin" class="textbox" style="width:auto;">
                <option value="" selected="" <?php if(@$_REQUEST['prixmin']=='') echo 'selected'; ?>>min</option>
                <option value="20" <?php if(@$_REQUEST['prixmin']=='20') echo 'selected'; ?>>20</option>
                <option value="50" <?php if(@$_REQUEST['prixmin']=='50') echo 'selected'; ?>>50</option>
                <option value="100" <?php if(@$_REQUEST['prixmin']=='100') echo 'selected'; ?>>100</option>
                <option value="500" <?php if(@$_REQUEST['prixmin']=='500') echo 'selected'; ?>>500</option>
                <option value="1000" <?php if(@$_REQUEST['prixmin']=='1000') echo 'selected'; ?>>1 000</option>
                <option value="1500" <?php if(@$_REQUEST['prixmin']=='1500') echo 'selected'; ?>>1 500</option>
                <option value="2000" <?php if(@$_REQUEST['prixmin']=='2000') echo 'selected'; ?>>2 000</option>
                <option value="2500" <?php if(@$_REQUEST['prixmin']=='2500') echo 'selected'; ?>>2 500</option>
                <option value="3000" <?php if(@$_REQUEST['prixmin']=='3000') echo 'selected'; ?>>3 000</option>
                <option value="4000" <?php if(@$_REQUEST['prixmin']=='4000') echo 'selected'; ?>>4 000</option>
                <option value="5000" <?php if(@$_REQUEST['prixmin']=='5000') echo 'selected'; ?>>5 000</option>
                <option value="7500" <?php if(@$_REQUEST['prixmin']=='7500') echo 'selected'; ?>>7 500</option>
                <option value="10000" <?php if(@$_REQUEST['prixmin']=='10000') echo 'selected'; ?>>10 000</option>
                <option value="15000" <?php if(@$_REQUEST['prixmin']=='15000') echo 'selected'; ?>>15 000</option>
                <option value="20000" <?php if(@$_REQUEST['prixmin']=='20000') echo 'selected'; ?>>20 000</option>
                <option value="30000" <?php if(@$_REQUEST['prixmin']=='30000') echo 'selected'; ?>>30 000</option>
                <option value="40000" <?php if(@$_REQUEST['prixmin']=='40000') echo 'selected'; ?>>40 000</option>
                <option value="50000" <?php if(@$_REQUEST['prixmin']=='50000') echo 'selected'; ?>>50 000</option>
                <option value="75000" <?php if(@$_REQUEST['prixmin']=='75000') echo 'selected'; ?>>75 000</option>
                <option value="100000" <?php if(@$_REQUEST['prixmin']=='100000') echo 'selected'; ?>>100 000</option>            
            </select>
            
            
            <select name="prixmax" class="textbox" style="width:auto;">
                <option value="" selected="" <?php if(@$_REQUEST['prixmax']=='') echo 'selected'; ?>>max</option>
                <option value="20" <?php if(@$_REQUEST['prixmax']=='20') echo 'selected'; ?>>20</option>
                <option value="50" <?php if(@$_REQUEST['prixmax']=='50') echo 'selected'; ?>>50</option>
                <option value="100" <?php if(@$_REQUEST['prixmax']=='100') echo 'selected'; ?>>100</option>
                <option value="500" <?php if(@$_REQUEST['prixmax']=='500') echo 'selected'; ?>>500</option>
                <option value="1000" <?php if(@$_REQUEST['prixmax']=='1000') echo 'selected'; ?>>1 000</option>
                <option value="1500" <?php if(@$_REQUEST['prixmax']=='1500') echo 'selected'; ?>>1 500</option>
                <option value="2000" <?php if(@$_REQUEST['prixmax']=='2000') echo 'selected'; ?>>2 000</option>
                <option value="2500" <?php if(@$_REQUEST['prixmax']=='2500') echo 'selected'; ?>>2 500</option>
                <option value="3000" <?php if(@$_REQUEST['prixmax']=='3000') echo 'selected'; ?>>3 000</option>
                <option value="4000" <?php if(@$_REQUEST['prixmax']=='4000') echo 'selected'; ?>>4 000</option>
                <option value="5000" <?php if(@$_REQUEST['prixmax']=='5000') echo 'selected'; ?>>5 000</option>
                <option value="7500" <?php if(@$_REQUEST['prixmax']=='7500') echo 'selected'; ?>>7 500</option>
                <option value="10000" <?php if(@$_REQUEST['prixmax']=='10000') echo 'selected'; ?>>10 000</option>
                <option value="15000" <?php if(@$_REQUEST['prixmax']=='15000') echo 'selected'; ?>>15 000</option>
                <option value="20000" <?php if(@$_REQUEST['prixmax']=='20000') echo 'selected'; ?>>20 000</option>
                <option value="30000" <?php if(@$_REQUEST['prixmax']=='30000') echo 'selected'; ?>>30 000</option>
                <option value="40000" <?php if(@$_REQUEST['prixmax']=='40000') echo 'selected'; ?>>40 000</option>
                <option value="50000" <?php if(@$_REQUEST['prixmax']=='50000') echo 'selected'; ?>>50 000</option>
                <option value="75000" <?php if(@$_REQUEST['prixmax']=='75000') echo 'selected'; ?>>75 000</option>
                <option value="100000" <?php if(@$_REQUEST['prixmax']=='100000') echo 'selected'; ?>>100 000</option>
                <option value="9999999" <?php if(@$_REQUEST['prixmax']=='9999999') echo 'selected'; ?>>illimité</option>
            </select>
        <?php
		}
		
    	switch($cat){
		
        case 900:
        ?>
            Km:
            <select  name="kmmin" class="textbox" style="width:auto;">
                <option value="" <?php if(@$_REQUEST['kmmin']=='') echo 'selected'; ?>>min</option>
                <option value="10000" <?php if(@$_REQUEST['kmmin']=='10000') echo 'selected'; ?>>10 000</option>
                <option value="20000" <?php if(@$_REQUEST['kmmin']=='20000') echo 'selected'; ?>>20 000</option>
                <option value="30000" <?php if(@$_REQUEST['kmmin']=='30000') echo 'selected'; ?>>30 000</option>
                <option value="40000" <?php if(@$_REQUEST['kmmin']=='40000') echo 'selected'; ?>>40 000</option>
                <option value="50000" <?php if(@$_REQUEST['kmmin']=='50000') echo 'selected'; ?>>50 000</option>
                <option value="60000" <?php if(@$_REQUEST['kmmin']=='60000') echo 'selected'; ?>>60 000</option>
                <option value="70000" <?php if(@$_REQUEST['kmmin']=='70000') echo 'selected'; ?>>70 000</option>
                <option value="80000" <?php if(@$_REQUEST['kmmin']=='80000') echo 'selected'; ?>>80 000</option>
                <option value="90000" <?php if(@$_REQUEST['kmmin']=='90000') echo 'selected'; ?>>90 000</option>
                <option value="100000" <?php if(@$_REQUEST['kmmin']=='100000') echo 'selected'; ?>>100 000</option>
                <option value="125000" <?php if(@$_REQUEST['kmmin']=='125000') echo 'selected'; ?>>125 000</option>
                <option value="150000" <?php if(@$_REQUEST['kmmin']=='150000') echo 'selected'; ?>>150 000</option>
                <option value="175000" <?php if(@$_REQUEST['kmmin']=='175000') echo 'selected'; ?>>175 000</option>
                <option value="200000" <?php if(@$_REQUEST['kmmin']=='200000') echo 'selected'; ?>>200 000</option>
                <option value="250000" <?php if(@$_REQUEST['kmmin']=='250000') echo 'selected'; ?>>250 000</option>
            </select>
            
            <select name="kmmax" class="textbox" style="width:auto;">
                <option value="" <?php if(@$_REQUEST['kmmax']=='') echo 'selected'; ?>>max</option>
                <option value="10000" <?php if(@$_REQUEST['kmmax']=='10000') echo 'selected'; ?>>10 000</option>
                <option value="20000" <?php if(@$_REQUEST['kmmax']=='20000') echo 'selected'; ?>>20 000</option>
                <option value="30000" <?php if(@$_REQUEST['kmmax']=='30000') echo 'selected'; ?>>30 000</option>
                <option value="40000" <?php if(@$_REQUEST['kmmax']=='40000') echo 'selected'; ?>>40 000</option>
                <option value="50000" <?php if(@$_REQUEST['kmmax']=='50000') echo 'selected'; ?>>50 000</option>
                <option value="60000" <?php if(@$_REQUEST['kmmax']=='60000') echo 'selected'; ?>>60 000</option>
                <option value="70000" <?php if(@$_REQUEST['kmmax']=='70000') echo 'selected'; ?>>70 000</option>
                <option value="80000" <?php if(@$_REQUEST['kmmax']=='80000') echo 'selected'; ?>>80 000</option>
                <option value="90000" <?php if(@$_REQUEST['kmmax']=='90000') echo 'selected'; ?>>90 000</option>
                <option value="100000" <?php if(@$_REQUEST['kmmax']=='100000') echo 'selected'; ?>>100 000</option>
                <option value="125000" <?php if(@$_REQUEST['kmmax']=='125000') echo 'selected'; ?>>125 000</option>
                <option value="150000" <?php if(@$_REQUEST['kmmax']=='150000') echo 'selected'; ?>>150 000</option>
                <option value="175000" <?php if(@$_REQUEST['kmmax']=='175000') echo 'selected'; ?>>175 000</option>
                <option value="200000" <?php if(@$_REQUEST['kmmax']=='200000') echo 'selected'; ?>>200 000</option>
                <option value="250000" <?php if(@$_REQUEST['kmmax']=='250000') echo 'selected'; ?>>250 000</option>
                <option value="9999999" <?php if(@$_REQUEST['kmmax']=='9999999') echo 'selected'; ?>>illimité</option>
            </select>
            
            Année:
            <select name="anneemin" class="textbox" style="width:auto;">
                <option value="" <?php if(@$_REQUEST['anneemin']=='') echo 'selected'; ?>>min</option>
                <?php
                    for ($i = date("Y"); $i >= 1900; $i--) {
                        if(@$_REQUEST['anneemin']==$i)
                            echo "<option value='$i' selected>$i</option>";
                        else
                            echo "<option value='$i'>$i</option>";
                    }
                ?>
            </select>
        
            <select name="anneemax" class="textbox" style="width:auto;">
                <option value="" <?php if(@$_REQUEST['anneemax']=='') echo 'selected'; ?>>max</option>
                <?php
                    for ($i = date("Y"); $i >= 1900; $i--) {
                        if(@$_REQUEST['anneemax']==$i)
                            echo "<option value='$i' selected>$i</option>";
                        else
                            echo "<option value='$i'>$i</option>";
                    }
                ?>
            </select>


		
			Energie:
			<select name="energy" class="textbox" style="width:auto;">
				<option value="">Indifférent</option>
				<option value="1" <?php  if(@$_REQUEST['energy']==1) echo 'selected'; ?>>Essence</option>
				<option value="2" <?php  if(@$_REQUEST['energy']==2) echo 'selected'; ?>>Diesel</option>
				<option value="3" <?php  if(@$_REQUEST['energy']==3) echo 'selected'; ?>>GPL</option>
				<option value="4" <?php  if(@$_REQUEST['energy']==4) echo 'selected'; ?>>Electrique</option>
				<option value="5" <?php  if(@$_REQUEST['energy']==5) echo 'selected'; ?>>Hybride</option>
			</select>
            <?php
            break;
        
        case 901:
    ?>
        Km:
        <select  name="kmmin" class="textbox" style="width:auto;">
            <option value="" <?php if(@$_REQUEST['kmmin']=='') echo 'selected'; ?>>min</option>
            <option value="10000" <?php if(@$_REQUEST['kmmin']=='10000') echo 'selected'; ?>>10 000</option>
            <option value="20000" <?php if(@$_REQUEST['kmmin']=='20000') echo 'selected'; ?>>20 000</option>
            <option value="30000" <?php if(@$_REQUEST['kmmin']=='30000') echo 'selected'; ?>>30 000</option>
            <option value="40000" <?php if(@$_REQUEST['kmmin']=='40000') echo 'selected'; ?>>40 000</option>
            <option value="50000" <?php if(@$_REQUEST['kmmin']=='50000') echo 'selected'; ?>>50 000</option>
            <option value="60000" <?php if(@$_REQUEST['kmmin']=='60000') echo 'selected'; ?>>60 000</option>
            <option value="70000" <?php if(@$_REQUEST['kmmin']=='70000') echo 'selected'; ?>>70 000</option>
            <option value="80000" <?php if(@$_REQUEST['kmmin']=='80000') echo 'selected'; ?>>80 000</option>
            <option value="90000" <?php if(@$_REQUEST['kmmin']=='90000') echo 'selected'; ?>>90 000</option>
            <option value="100000" <?php if(@$_REQUEST['kmmin']=='100000') echo 'selected'; ?>>100 000</option>
            <option value="125000" <?php if(@$_REQUEST['kmmin']=='125000') echo 'selected'; ?>>125 000</option>
            <option value="150000" <?php if(@$_REQUEST['kmmin']=='150000') echo 'selected'; ?>>150 000</option>
            <option value="175000" <?php if(@$_REQUEST['kmmin']=='175000') echo 'selected'; ?>>175 000</option>
            <option value="200000" <?php if(@$_REQUEST['kmmin']=='200000') echo 'selected'; ?>>200 000</option>
            <option value="250000" <?php if(@$_REQUEST['kmmin']=='250000') echo 'selected'; ?>>250 000</option>
        </select>
        <select name="kmmax"  class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['kmmax']=='') echo 'selected'; ?>>max</option>
            <option value="10000" <?php if(@$_REQUEST['kmmax']=='10000') echo 'selected'; ?>>10 000</option>
            <option value="20000" <?php if(@$_REQUEST['kmmax']=='20000') echo 'selected'; ?>>20 000</option>
            <option value="30000" <?php if(@$_REQUEST['kmmax']=='30000') echo 'selected'; ?>>30 000</option>
            <option value="40000" <?php if(@$_REQUEST['kmmax']=='40000') echo 'selected'; ?>>40 000</option>
            <option value="50000" <?php if(@$_REQUEST['kmmax']=='50000') echo 'selected'; ?>>50 000</option>
            <option value="60000" <?php if(@$_REQUEST['kmmax']=='60000') echo 'selected'; ?>>60 000</option>
            <option value="70000" <?php if(@$_REQUEST['kmmax']=='70000') echo 'selected'; ?>>70 000</option>
            <option value="80000" <?php if(@$_REQUEST['kmmax']=='80000') echo 'selected'; ?>>80 000</option>
            <option value="90000" <?php if(@$_REQUEST['kmmax']=='90000') echo 'selected'; ?>>90 000</option>
            <option value="100000" <?php if(@$_REQUEST['kmmax']=='100000') echo 'selected'; ?>>100 000</option>
            <option value="125000" <?php if(@$_REQUEST['kmmax']=='125000') echo 'selected'; ?>>125 000</option>
            <option value="150000" <?php if(@$_REQUEST['kmmax']=='150000') echo 'selected'; ?>>150 000</option>
            <option value="175000" <?php if(@$_REQUEST['kmmax']=='175000') echo 'selected'; ?>>175 000</option>
            <option value="200000" <?php if(@$_REQUEST['kmmax']=='200000') echo 'selected'; ?>>200 000</option>
            <option value="250000" <?php if(@$_REQUEST['kmmax']=='250000') echo 'selected'; ?>>250 000</option>
            <option value="9999999" <?php if(@$_REQUEST['kmmax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        
		Cylindrée:
        <select name="cylindreemin" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['cylindreemin']=='') echo 'selected'; ?>>min</option>
            <option value="50" <?php if(@$_REQUEST['cylindreemin']=='50') echo 'selected'; ?>>50</option>
            <option value="80" <?php if(@$_REQUEST['cylindreemin']=='80') echo 'selected'; ?>>80</option>
            <option value="125" <?php if(@$_REQUEST['cylindreemin']=='125') echo 'selected'; ?>>125</option>
            <option value="250" <?php if(@$_REQUEST['cylindreemin']=='250') echo 'selected'; ?>>250</option>
            <option value="400" <?php if(@$_REQUEST['cylindreemin']=='400') echo 'selected'; ?>>400</option>
            <option value="500" <?php if(@$_REQUEST['cylindreemin']=='500') echo 'selected'; ?>>500</option>
            <option value="600" <?php if(@$_REQUEST['cylindreemin']=='600') echo 'selected'; ?>>600</option>
            <option value="750" <?php if(@$_REQUEST['cylindreemin']=='750') echo 'selected'; ?>>750</option>
            <option value="900" <?php if(@$_REQUEST['cylindreemin']=='900') echo 'selected'; ?>>900</option>
            <option value="1000" <?php if(@$_REQUEST['cylindreemin']=='1000') echo 'selected'; ?>>1 000</option>
            <option value="1100" <?php if(@$_REQUEST['cylindreemin']=='1100') echo 'selected'; ?>>1 100</option>
            <option value="1200" <?php if(@$_REQUEST['cylindreemin']=='1200') echo 'selected'; ?>>1 200</option>
		</select>
        
        <select name="cylindreemax" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['cylindreemax']=='') echo 'selected'; ?>>max</option>
            <option value="50" <?php if(@$_REQUEST['cylindreemax']=='50') echo 'selected'; ?>>50</option>
            <option value="80" <?php if(@$_REQUEST['cylindreemax']=='80') echo 'selected'; ?>>80</option>
            <option value="125" <?php if(@$_REQUEST['cylindreemax']=='125') echo 'selected'; ?>>125</option>
            <option value="250" <?php if(@$_REQUEST['cylindreemax']=='250') echo 'selected'; ?>>250</option>
            <option value="400" <?php if(@$_REQUEST['cylindreemax']=='400') echo 'selected'; ?>>400</option>
            <option value="500" <?php if(@$_REQUEST['cylindreemax']=='500') echo 'selected'; ?>>500</option>
            <option value="600" <?php if(@$_REQUEST['cylindreemax']=='600') echo 'selected'; ?>>600</option>
            <option value="750" <?php if(@$_REQUEST['cylindreemax']=='750') echo 'selected'; ?>>750</option>
            <option value="900" <?php if(@$_REQUEST['cylindreemax']=='900') echo 'selected'; ?>>900</option>
            <option value="1000" <?php if(@$_REQUEST['cylindreemax']=='1000') echo 'selected'; ?>>1 000</option>
            <option value="1100" <?php if(@$_REQUEST['cylindreemax']=='1100') echo 'selected'; ?>>1 100</option>
            <option value="1200" <?php if(@$_REQUEST['cylindreemax']=='1200') echo 'selected'; ?>>1 200</option>
            <option value="9999999" <?php if(@$_REQUEST['cylindreemax']=='9999999') echo 'selected'; ?>>illimité</option>
		</select>
        
		Année:
        <select name="anneemin" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['anneemin']=='') echo 'selected'; ?>>min</option>
            <?php
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemin']==$i)
						echo "<option value='$i' selected>$i</option>";
					else
						echo "<option value='$i'>$i</option>";
				}
			?>
        </select>
        
        <select name="anneemax" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['anneemax']=='') echo 'selected'; ?>>max</option>
            <?php
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemax']==$i)
						echo "<option value='$i' selected>$i</option>";
					else
						echo "<option value='$i'>$i</option>";
				}
			?>
        </select>
        <?php
            break;
    
        
        case 902:
    ?>
        Km:
        <select  name="kmmin" class="textbox" style="width:auto;">
            <option value="" <?php if(@$_REQUEST['kmmin']=='') echo 'selected'; ?>>min</option>
            <option value="10000" <?php if(@$_REQUEST['kmmin']=='10000') echo 'selected'; ?>>10 000</option>
            <option value="20000" <?php if(@$_REQUEST['kmmin']=='20000') echo 'selected'; ?>>20 000</option>
            <option value="30000" <?php if(@$_REQUEST['kmmin']=='30000') echo 'selected'; ?>>30 000</option>
            <option value="40000" <?php if(@$_REQUEST['kmmin']=='40000') echo 'selected'; ?>>40 000</option>
            <option value="50000" <?php if(@$_REQUEST['kmmin']=='50000') echo 'selected'; ?>>50 000</option>
            <option value="60000" <?php if(@$_REQUEST['kmmin']=='60000') echo 'selected'; ?>>60 000</option>
            <option value="70000" <?php if(@$_REQUEST['kmmin']=='70000') echo 'selected'; ?>>70 000</option>
            <option value="80000" <?php if(@$_REQUEST['kmmin']=='80000') echo 'selected'; ?>>80 000</option>
            <option value="90000" <?php if(@$_REQUEST['kmmin']=='90000') echo 'selected'; ?>>90 000</option>
            <option value="100000" <?php if(@$_REQUEST['kmmin']=='100000') echo 'selected'; ?>>100 000</option>
            <option value="125000" <?php if(@$_REQUEST['kmmin']=='125000') echo 'selected'; ?>>125 000</option>
            <option value="150000" <?php if(@$_REQUEST['kmmin']=='150000') echo 'selected'; ?>>150 000</option>
            <option value="175000" <?php if(@$_REQUEST['kmmin']=='175000') echo 'selected'; ?>>175 000</option>
            <option value="200000" <?php if(@$_REQUEST['kmmin']=='200000') echo 'selected'; ?>>200 000</option>
            <option value="250000" <?php if(@$_REQUEST['kmmin']=='250000') echo 'selected'; ?>>250 000</option>
        </select>
        <select name="kmmax" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['kmmax']=='') echo 'selected'; ?>>max</option>
            <option value="10000" <?php if(@$_REQUEST['kmmax']=='10000') echo 'selected'; ?>>10 000</option>
            <option value="20000" <?php if(@$_REQUEST['kmmax']=='20000') echo 'selected'; ?>>20 000</option>
            <option value="30000" <?php if(@$_REQUEST['kmmax']=='30000') echo 'selected'; ?>>30 000</option>
            <option value="40000" <?php if(@$_REQUEST['kmmax']=='40000') echo 'selected'; ?>>40 000</option>
            <option value="50000" <?php if(@$_REQUEST['kmmax']=='50000') echo 'selected'; ?>>50 000</option>
            <option value="60000" <?php if(@$_REQUEST['kmmax']=='60000') echo 'selected'; ?>>60 000</option>
            <option value="70000" <?php if(@$_REQUEST['kmmax']=='70000') echo 'selected'; ?>>70 000</option>
            <option value="80000" <?php if(@$_REQUEST['kmmax']=='80000') echo 'selected'; ?>>80 000</option>
            <option value="90000" <?php if(@$_REQUEST['kmmax']=='90000') echo 'selected'; ?>>90 000</option>
            <option value="100000" <?php if(@$_REQUEST['kmmax']=='100000') echo 'selected'; ?>>100 000</option>
            <option value="125000" <?php if(@$_REQUEST['kmmax']=='125000') echo 'selected'; ?>>125 000</option>
            <option value="150000" <?php if(@$_REQUEST['kmmax']=='150000') echo 'selected'; ?>>150 000</option>
            <option value="175000" <?php if(@$_REQUEST['kmmax']=='175000') echo 'selected'; ?>>175 000</option>
            <option value="200000" <?php if(@$_REQUEST['kmmax']=='200000') echo 'selected'; ?>>200 000</option>
            <option value="250000" <?php if(@$_REQUEST['kmmax']=='250000') echo 'selected'; ?>>250 000</option>
            <option value="9999999" <?php if(@$_REQUEST['kmmax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        
        
		Année:
        <select name="anneemin" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['anneemin']=='') echo 'selected'; ?>>min</option>
            <?php
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemin']==$i)
						echo "<option value='$i' selected>$i</option>";
					else
						echo "<option value='$i'>$i</option>";
				}
			?>
        </select>
        
        <select name="anneemax" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['anneemax']=='') echo 'selected'; ?>>max</option>
            <?php
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemax']==$i)
						echo "<option value='$i' selected>$i</option>";
					else
						echo "<option value='$i'>$i</option>";
				}
			?>
        </select>
        
            <?php
		
		$Type_vehicule6=(@$_REQUEST['Type_vehicule']==6) ? 
		 			'<option value="6" selected="selected">Caravane</option>':
					'<option value="6">Caravane</option>';
		$Type_vehicule7=(@$_REQUEST['Type_vehicule']==7) ? 
		 			'<option value="7" selected="selected">Camping car</option>':
					'<option value="7">Camping car</option>';
		$Type_vehicule8=(@$_REQUEST['Type_vehicule']==8) ? 
		 			'<option value="8" selected="selected">Mobile home</option>':
					'<option value="8">Mobile home</option>';
		$Type_vehicule9=(@$_REQUEST['Type_vehicule']==9) ? 
		 			'<option value="9" selected="selected">Accessoire</option>':
					'<option value="9">Accessoire</option>';
            echo '
		Type de véhicule:
			<select name="Type_vehicule" class="textbox" style="width:auto;" >
				<option value="">Choisir une option</option>'.
				$Type_vehicule6.
				$Type_vehicule7.
				$Type_vehicule8.
				$Type_vehicule9.
				'
			</select>
			';
            break;
        
        case 903:
		
		$type_camion10=(@$_REQUEST['type_camion']==10) ? 
		 			'<option value="10" selected="selected">Utilitaire</option>':
					'<option value="10">Utilitaire</option>';
					
		 $type_camion11=(@$_REQUEST['type_camion']=='11') ? 
		 			'<option value="11" selected="selected">Fourgon</option>':
					'<option value="11">Fourgon</option>';
					
		 $type_camion12=(@$_REQUEST['type_camion']=='12') ? 
		 			'<option value="12" selected="selected">Frigorifique</option>':
					'<option value="12">Frigorifique</option>';
					
		 $type_camion13=(@$_REQUEST['type_camion']=='13') ? 
		 			'<option value="13" selected="selected">Benne, Plateau</option>':
					'<option value="13">Benne, Plateau</option>';
					
		 $type_camion14=(@$_REQUEST['type_camion']=='14') ? 
		 			'<option value="14" selected="selected">Poids lourd</option>':
					'<option value="14">Poids lourd</option>';
					
		 $type_camion15=(@$_REQUEST['type_camion']=='15') ? 
		 			'<option value="15" selected="selected">Autre</option>':
					'<option value="15">Autre</option>';
					?>
        Km:
        <select  name="kmmin" class="textbox" style="width:auto;">
            <option value="" <?php if(@$_REQUEST['kmmin']=='') echo 'selected'; ?>>min</option>
            <option value="10000" <?php if(@$_REQUEST['kmmin']=='10000') echo 'selected'; ?>>10 000</option>
            <option value="20000" <?php if(@$_REQUEST['kmmin']=='20000') echo 'selected'; ?>>20 000</option>
            <option value="30000" <?php if(@$_REQUEST['kmmin']=='30000') echo 'selected'; ?>>30 000</option>
            <option value="40000" <?php if(@$_REQUEST['kmmin']=='40000') echo 'selected'; ?>>40 000</option>
            <option value="50000" <?php if(@$_REQUEST['kmmin']=='50000') echo 'selected'; ?>>50 000</option>
            <option value="60000" <?php if(@$_REQUEST['kmmin']=='60000') echo 'selected'; ?>>60 000</option>
            <option value="70000" <?php if(@$_REQUEST['kmmin']=='70000') echo 'selected'; ?>>70 000</option>
            <option value="80000" <?php if(@$_REQUEST['kmmin']=='80000') echo 'selected'; ?>>80 000</option>
            <option value="90000" <?php if(@$_REQUEST['kmmin']=='90000') echo 'selected'; ?>>90 000</option>
            <option value="100000" <?php if(@$_REQUEST['kmmin']=='100000') echo 'selected'; ?>>100 000</option>
            <option value="125000" <?php if(@$_REQUEST['kmmin']=='125000') echo 'selected'; ?>>125 000</option>
            <option value="150000" <?php if(@$_REQUEST['kmmin']=='150000') echo 'selected'; ?>>150 000</option>
            <option value="175000" <?php if(@$_REQUEST['kmmin']=='175000') echo 'selected'; ?>>175 000</option>
            <option value="200000" <?php if(@$_REQUEST['kmmin']=='200000') echo 'selected'; ?>>200 000</option>
            <option value="250000" <?php if(@$_REQUEST['kmmin']=='250000') echo 'selected'; ?>>250 000</option>
        </select>
        <select name="kmmax" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['kmmax']=='') echo 'selected'; ?>>max</option>
            <option value="10000" <?php if(@$_REQUEST['kmmax']=='10000') echo 'selected'; ?>>10 000</option>
            <option value="20000" <?php if(@$_REQUEST['kmmax']=='20000') echo 'selected'; ?>>20 000</option>
            <option value="30000" <?php if(@$_REQUEST['kmmax']=='30000') echo 'selected'; ?>>30 000</option>
            <option value="40000" <?php if(@$_REQUEST['kmmax']=='40000') echo 'selected'; ?>>40 000</option>
            <option value="50000" <?php if(@$_REQUEST['kmmax']=='50000') echo 'selected'; ?>>50 000</option>
            <option value="60000" <?php if(@$_REQUEST['kmmax']=='60000') echo 'selected'; ?>>60 000</option>
            <option value="70000" <?php if(@$_REQUEST['kmmax']=='70000') echo 'selected'; ?>>70 000</option>
            <option value="80000" <?php if(@$_REQUEST['kmmax']=='80000') echo 'selected'; ?>>80 000</option>
            <option value="90000" <?php if(@$_REQUEST['kmmax']=='90000') echo 'selected'; ?>>90 000</option>
            <option value="100000" <?php if(@$_REQUEST['kmmax']=='100000') echo 'selected'; ?>>100 000</option>
            <option value="125000" <?php if(@$_REQUEST['kmmax']=='125000') echo 'selected'; ?>>125 000</option>
            <option value="150000" <?php if(@$_REQUEST['kmmax']=='150000') echo 'selected'; ?>>150 000</option>
            <option value="175000" <?php if(@$_REQUEST['kmmax']=='175000') echo 'selected'; ?>>175 000</option>
            <option value="200000" <?php if(@$_REQUEST['kmmax']=='200000') echo 'selected'; ?>>200 000</option>
            <option value="250000" <?php if(@$_REQUEST['kmmax']=='250000') echo 'selected'; ?>>250 000</option>
            <option value="9999999" <?php if(@$_REQUEST['kmmax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        
		Année:
        <select name="anneemin" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['anneemin']=='') echo 'selected'; ?>>min</option>
            <?php
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemin']==$i)
						echo "<option value='$i' selected>$i</option>";
					else
						echo "<option value='$i'>$i</option>";
				}
			?>
        </select>
        
        <select name="anneemax" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['anneemax']=='') echo 'selected'; ?>>max</option>
            <?php
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemax']==$i)
						echo "<option value='$i' selected>$i</option>";
					else
						echo "<option value='$i'>$i</option>";
				}
			?>
        </select>
		<?php
            echo '
		Type de camion:
			<select name="type_camion" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$type_camion10.
				$type_camion11.
				$type_camion12.
				$type_camion13.
				$type_camion14.
				$type_camion15.
				'</select>'	;
        break;
		
        case 904:
		?>
        Longueur(m):
        <select name="longueurmin" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['longueurmin']=='') echo 'selected'; ?>>min</option>
            <option value="4" <?php if(@$_REQUEST['longueurmin']=='4') echo 'selected'; ?>>4</option>
            <option value="6" <?php if(@$_REQUEST['longueurmin']=='6') echo 'selected'; ?>>6</option>
            <option value="8" <?php if(@$_REQUEST['longueurmin']=='8') echo 'selected'; ?>>8</option>
            <option value="10" <?php if(@$_REQUEST['longueurmin']=='10') echo 'selected'; ?>>10</option>
            <option value="12" <?php if(@$_REQUEST['longueurmin']=='12') echo 'selected'; ?>>12</option>
            <option value="14" <?php if(@$_REQUEST['longueurmin']=='14') echo 'selected'; ?>>14</option>
            <option value="16" <?php if(@$_REQUEST['longueurmin']=='16') echo 'selected'; ?>>16</option>
            <option value="18" <?php if(@$_REQUEST['longueurmin']=='18') echo 'selected'; ?>>18</option>
            <option value="20" <?php if(@$_REQUEST['longueurmin']=='20') echo 'selected'; ?>>20</option>
            <option value="22" <?php if(@$_REQUEST['longueurmin']=='22') echo 'selected'; ?>>22</option>
		</select>
        
        <select name="longueurmax" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['longueurmax']=='') echo 'selected'; ?>>max</option>
            <option value="4" <?php if(@$_REQUEST['longueurmax']=='4') echo 'selected'; ?>>4</option>
            <option value="6" <?php if(@$_REQUEST['longueurmax']=='6') echo 'selected'; ?>>6</option>
            <option value="8" <?php if(@$_REQUEST['longueurmax']=='8') echo 'selected'; ?>>8</option>
            <option value="10" <?php if(@$_REQUEST['longueurmax']=='10') echo 'selected'; ?>>10</option>
            <option value="12" <?php if(@$_REQUEST['longueurmax']=='12') echo 'selected'; ?>>12</option>
            <option value="14" <?php if(@$_REQUEST['longueurmax']=='14') echo 'selected'; ?>>14</option>
            <option value="16" <?php if(@$_REQUEST['longueurmax']=='16') echo 'selected'; ?>>16</option>
            <option value="18" <?php if(@$_REQUEST['longueurmax']=='18') echo 'selected'; ?>>18</option>
            <option value="20" <?php if(@$_REQUEST['longueurmax']=='20') echo 'selected'; ?>>20</option>
            <option value="22" <?php if(@$_REQUEST['longueurmax']=='22') echo 'selected'; ?>>22</option>
            <option value="9999999">illimité</option>
        </select>
        
		Année:
        <select name="anneemin" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['anneemin']=='') echo 'selected'; ?>>min</option>
            <?php
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemin']==$i)
						echo "<option value='$i' selected>$i</option>";
					else
						echo "<option value='$i'>$i</option>";
				}
			?>
        </select>
        
        <select name="anneemax" class="textbox" style="width:auto;">
        	<option value="" <?php if(@$_REQUEST['anneemax']=='') echo 'selected'; ?>>max</option>
            <?php
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemax']==$i)
						echo "<option value='$i' selected>$i</option>";
					else
						echo "<option value='$i'>$i</option>";
				}
			?>
        </select>
        <?php
		$type_bateau16=(@$_REQUEST['type_bateau']==16) ? 
		 			'<option value="16" selected="selected">Voilier</option>':
					'<option value="16">Voilier</option>';
		$type_bateau17=(@$_REQUEST['type_bateau']==17) ? 
		 			'<option value="17" selected="selected">Bateau moteur</option>':
					'<option value="17">Bateau moteur</option>';
    
            echo '
			Type de bateau:
				<select name="type_bateau" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$type_bateau16.
				$type_bateau17.'
				</select>';
            break;
        
        case 911:
		case 912:
		case 913:
		case 914:
		case 916:
		case 917:
		case 918:
		case 919:
		?>
        Pièce:
        <select name="piecemin" class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['piecemin']=='') echo 'selected'; ?>>min</option>
            <option value="1" <?php if(@$_REQUEST['piecemin']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemin']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemin']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemin']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemin']=='5') echo 'selected'; ?>>5</option>
        </select>
        
        <select name="piecemax" class='textbox' style='width:auto;'>
        	<option value=""  <?php if(@$_REQUEST['piecemax']=='') echo 'selected'; ?>selected="">max</option>
            <option value="1" <?php if(@$_REQUEST['piecemax']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemax']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemax']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemax']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemax']=='5') echo 'selected'; ?>>5</option>
            <option value="9999999" <?php if(@$_REQUEST['piecemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        
        Surface:
		<select name='surfacemin' class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['surfacemin']=='') echo 'selected'; ?>>min</option>
            <option value="20" <?php if(@$_REQUEST['surfacemin']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemin']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemin']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemin']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemin']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemin']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemin']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemin']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemin']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemin']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemin']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemin']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemin']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemin']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemin']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemin']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemin']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemin']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemin']=='300') echo 'selected'; ?>>300</option>
        </select>
        
		<select name='surfacemax' class='textbox' style='width:auto;'>
            <option value="" selected="">max</option>
            <option value="20" <?php if(@$_REQUEST['surfacemax']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemax']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemax']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemax']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemax']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemax']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemax']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemax']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemax']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemax']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemax']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemax']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemax']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemax']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemax']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemax']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemax']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemax']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemax']=='300') echo 'selected'; ?>>300</option>
            <option value="9999999" <?php if(@$_REQUEST['surfacemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
    <?php
            break;
		
		case 923:
		?>
        
        Surface:
		<select name='surfacemin' class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['surfacemin']=='') echo 'selected'; ?>>min</option>
            <option value="20" <?php if(@$_REQUEST['surfacemin']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemin']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemin']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemin']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemin']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemin']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemin']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemin']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemin']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemin']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemin']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemin']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemin']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemin']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemin']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemin']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemin']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemin']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemin']=='300') echo 'selected'; ?>>300</option>
        </select>
        
		<select name='surfacemax' class='textbox' style='width:auto;'>
            <option value="" selected="">max</option>
            <option value="20" <?php if(@$_REQUEST['surfacemax']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemax']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemax']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemax']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemax']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemax']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemax']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemax']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemax']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemax']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemax']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemax']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemax']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemax']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemax']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemax']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemax']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemax']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemax']=='300') echo 'selected'; ?>>300</option>
            <option value="9999999" <?php if(@$_REQUEST['surfacemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        <?php
		$typebien118=(@$_REQUEST['typebien']==118) ? 
		 			'<option value="118" selected="selected">Maison</option>':
					'<option value="118">Maison</option>';
		$typebien119=(@$_REQUEST['typebien']==119) ? 
		 			'<option value="119" selected="selected">Appartement</option>':
					'<option value="119">Appartement</option>';
		$typebien120=(@$_REQUEST['typebien']==120) ? 
		 			'<option value="120" selected="selected">Parking</option>':
					'<option value="120">Parking</option>';
		$typebien121=(@$_REQUEST['typebien']==121) ? 
		 			'<option value="121" selected="selected">Immeuble</option>':
					'<option value="121">Immeuble</option>';
		$typebien122=(@$_REQUEST['typebien']==122) ? 
		 			'<option value="122" selected="selected">Terrain</option>':
					'<option value="122">Terrain</option>';
			echo '
			
		Type de bien:
			<select name="typebien" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$typebien118.
				$typebien119.
				$typebien120.
				$typebien121.
				$typebien122.'
			</select>';	
            break;
			
		case 915:
		?>
        
        Surface:
		<select name='surfacemin' class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['surfacemin']=='') echo 'selected'; ?>>min</option>
            <option value="20" <?php if(@$_REQUEST['surfacemin']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemin']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemin']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemin']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemin']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemin']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemin']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemin']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemin']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemin']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemin']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemin']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemin']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemin']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemin']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemin']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemin']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemin']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemin']=='300') echo 'selected'; ?>>300</option>
        </select>
        
		<select name='surfacemax' class='textbox' style='width:auto;'>
            <option value="" selected="">max</option>
            <option value="20" <?php if(@$_REQUEST['surfacemax']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemax']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemax']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemax']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemax']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemax']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemax']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemax']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemax']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemax']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemax']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemax']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemax']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemax']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemax']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemax']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemax']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemax']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemax']=='300') echo 'selected'; ?>>300</option>
            <option value="9999999" <?php if(@$_REQUEST['surfacemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        <?php
		$constructible143=(@$_REQUEST['constructible']==143) ? 
		 			'<option value="143" selected="selected">Constructible</option>':
					'<option value="143">Constructible</option>';
		$constructible144=(@$_REQUEST['constructible']==144) ? 
		 			'<option value="144" selected="selected">Non Constructible</option>':
					'<option value="144">Non Constructible</option>';
			echo '
		Constructible:
			<select name="constructible" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$constructible143.
				$constructible144.'
			</select>
			';
            break;
			
			
		case 920:
		?>
        
        Nbre Pièce:
        <select name="piecemin" class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['piecemin']=='') echo 'selected'; ?>>min</option>
            <option value="1" <?php if(@$_REQUEST['piecemin']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemin']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemin']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemin']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemin']=='5') echo 'selected'; ?>>5</option>
        </select>
        
        <select name="piecemax" class='textbox' style='width:auto;'>
        	<option value=""  <?php if(@$_REQUEST['piecemax']=='') echo 'selected'; ?>selected="">max</option>
            <option value="1" <?php if(@$_REQUEST['piecemax']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemax']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemax']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemax']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemax']=='5') echo 'selected'; ?>>5</option>
            <option value="9999999" <?php if(@$_REQUEST['piecemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        
        Surface:
		<select name='surfacemin' class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['surfacemin']=='') echo 'selected'; ?>>min</option>
            <option value="20" <?php if(@$_REQUEST['surfacemin']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemin']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemin']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemin']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemin']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemin']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemin']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemin']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemin']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemin']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemin']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemin']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemin']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemin']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemin']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemin']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemin']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemin']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemin']=='300') echo 'selected'; ?>>300</option>
        </select>
        
		<select name='surfacemax' class='textbox' style='width:auto;'>
            <option value="" selected="">max</option>
            <option value="20" <?php if(@$_REQUEST['surfacemax']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemax']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemax']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemax']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemax']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemax']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemax']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemax']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemax']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemax']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemax']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemax']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemax']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemax']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemax']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemax']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemax']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemax']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemax']=='300') echo 'selected'; ?>>300</option>
            <option value="9999999" <?php if(@$_REQUEST['surfacemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        <?php
		$typebien245=(@$_REQUEST['typebien']==245) ? 
		 			'<option value="245" selected="selected">Maison</option>':
					'<option value="245">Maison</option>';
		$typebien246=(@$_REQUEST['typebien']==246) ? 
		 			'<option value="246" selected="selected">Appartement</option>':
					'<option value="246">Appartement</option>';
		$typebien247=(@$_REQUEST['typebien']==247) ? 
		 			'<option value="247" selected="selected">Parking</option>':
					'<option value="247">Parking</option>';
		$typebien248=(@$_REQUEST['typebien']==248) ? 
		 			'<option value="248" selected="selected">Immeuble</option>':
					'<option value="248">Immeuble</option>';
			echo '
		Type de bien:
			<select name="typebien" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$typebien245.
				$typebien246.
				$typebien247.
				$typebien248.'
			</select>
			';
            break;
			
		case 921:
		?>
        Nbre de chambre:
        <select name="piecemin" class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['piecemin']=='') echo 'selected'; ?>>min</option>
            <option value="1" <?php if(@$_REQUEST['piecemin']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemin']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemin']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemin']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemin']=='5') echo 'selected'; ?>>5</option>
        </select>
        
        <select name="piecemax" class='textbox' style='width:auto;'>
        	<option value=""  <?php if(@$_REQUEST['piecemax']=='') echo 'selected'; ?>selected="">max</option>
            <option value="1" <?php if(@$_REQUEST['piecemax']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemax']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemax']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemax']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemax']=='5') echo 'selected'; ?>>5</option>
            <option value="9999999" <?php if(@$_REQUEST['piecemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        <?php
            break;
			
		case 777:
		?>
        
        Nbre Pièce:
        <select name="piecemin" class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['piecemin']=='') echo 'selected'; ?>>min</option>
            <option value="1" <?php if(@$_REQUEST['piecemin']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemin']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemin']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemin']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemin']=='5') echo 'selected'; ?>>5</option>
        </select>
        
        <select name="piecemax" class='textbox' style='width:auto;'>
        	<option value=""  <?php if(@$_REQUEST['piecemax']=='') echo 'selected'; ?>selected="">max</option>
            <option value="1" <?php if(@$_REQUEST['piecemax']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemax']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemax']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemax']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemax']=='5') echo 'selected'; ?>>5</option>
            <option value="9999999" <?php if(@$_REQUEST['piecemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        
        Surface:
		<select name='surfacemin' class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['surfacemin']=='') echo 'selected'; ?>>min</option>
            <option value="20" <?php if(@$_REQUEST['surfacemin']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemin']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemin']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemin']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemin']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemin']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemin']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemin']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemin']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemin']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemin']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemin']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemin']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemin']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemin']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemin']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemin']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemin']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemin']=='300') echo 'selected'; ?>>300</option>
        </select>
        
		<select name='surfacemax' class='textbox' style='width:auto;'>
            <option value="" selected="">max</option>
            <option value="20" <?php if(@$_REQUEST['surfacemax']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemax']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemax']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemax']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemax']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemax']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemax']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemax']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemax']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemax']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemax']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemax']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemax']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemax']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemax']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemax']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemax']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemax']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemax']=='300') echo 'selected'; ?>>300</option>
            <option value="9999999" <?php if(@$_REQUEST['surfacemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        <br />
        <?php
		
		$Situation629=(@$_REQUEST['Situation']==629) ? 
		 			'<option value="629" selected="selected">Ville</option>':
					'<option value="629">Ville</option>';
		$Situation630=(@$_REQUEST['Situation']==630) ? 
		 			'<option value="630" selected="selected">Campagne</option>':
					'<option value="630">Campagne</option>';
		$tSituation631=(@$_REQUEST['Situation']==631) ? 
		 			'<option value="631" selected="selected">Montagne</option>':
					'<option value="631">Montagne</option>';
		$Situation632=(@$_REQUEST['Situation']==632) ? 
		 			'<option value="632" selected="selected">Bord de mer</option>':
					'<option value="632">Bord de mer</option>';
					
		$Type633=(@$_REQUEST['Type']==633) ? 
		 			'<option value="633" selected="selected">Maison</option>':
					'<option value="633">Maison</option>';
		$Type634=(@$_REQUEST['Type']==634) ? 
		 			'<option value="634" selected="selected">Appartement</option>':
					'<option value="634">Appartement</option>';
		$Type635=(@$_REQUEST['Type']==635) ? 
		 			'<option value="635" selected="selected">Hôtel</option>':
					'<option value="635">Hôtel</option>';
		$Type636=(@$_REQUEST['Type']==636) ? 
		 			'<option value="636" selected="selected">Gite</option>':
					'<option value="636">Gite</option>';
		$Type637=(@$_REQUEST['Type']==637) ? 
		 			'<option value="637" selected="selected">Chambre d\'hôte</option>':
					'<option value="637">Chambre d\'hôte</option>';
		$Type638=(@$_REQUEST['Type']==638) ? 
		 			'<option value="638" selected="selected">Chalet</option>':
					'<option value="638">Chalet</option>';
		$Type639=(@$_REQUEST['Type']==639) ? 
		 			'<option value="639" selected="selected">Camping/Mobile home</option>':
					'<option value="639">Camping/Mobile home</option>';
		$Type640=(@$_REQUEST['Type']==640) ? 
		 			'<option value="640" selected="selected">Insolite</option>':
					'<option value="640">Insolite</option>';
			echo '
		Situation:
			<select name="Situation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$Situation629.
				$Situation630.
				$Situation631.
				$Situation632.'
			</select>
		Type:
			<select name="Type" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$Type633.
				$Type634.
				$Type635.
				$Type636.
				$Type637.
				$Type638.
				$Type639.
				$Type640.'
			</select>
			';
            break;
			
		case 784:
		?>
        
        Surface:
		<select name='surfacemin' class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['surfacemin']=='') echo 'selected'; ?>>min</option>
            <option value="20" <?php if(@$_REQUEST['surfacemin']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemin']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemin']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemin']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemin']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemin']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemin']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemin']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemin']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemin']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemin']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemin']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemin']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemin']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemin']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemin']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemin']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemin']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemin']=='300') echo 'selected'; ?>>300</option>
        </select>
        
		<select name='surfacemax' class='textbox' style='width:auto;'>
            <option value="" selected="">max</option>
            <option value="20" <?php if(@$_REQUEST['surfacemax']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemax']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemax']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemax']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemax']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemax']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemax']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemax']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemax']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemax']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemax']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemax']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemax']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemax']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemax']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemax']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemax']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemax']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemax']=='300') echo 'selected'; ?>>300</option>
            <option value="9999999" <?php if(@$_REQUEST['surfacemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        <?php
		$ventelocation405=(@$_REQUEST['ventelocation']==405) ? 
		 			'<option value="405" selected="selected">A vendre</option>':
					'<option value="405">A vendre</option>';
		$ventelocation406=(@$_REQUEST['ventelocation']==406) ? 
		 			'<option value="406" selected="selected">A louer</option>':
					'<option value="406">A louer</option>';
			echo '
		Vente/Location:
			<select name="ventelocation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$ventelocation405.
				$ventelocation406.'
			</select>
			';
            break;
			
		case 785:
		?>
        
        Surface:
		<select name='surfacemin' class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['surfacemin']=='') echo 'selected'; ?>>min</option>
            <option value="20" <?php if(@$_REQUEST['surfacemin']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemin']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemin']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemin']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemin']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemin']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemin']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemin']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemin']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemin']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemin']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemin']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemin']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemin']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemin']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemin']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemin']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemin']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemin']=='300') echo 'selected'; ?>>300</option>
        </select>
        
		<select name='surfacemax' class='textbox' style='width:auto;'>
            <option value="" selected="">max</option>
            <option value="20" <?php if(@$_REQUEST['surfacemax']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemax']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemax']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemax']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemax']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemax']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemax']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemax']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemax']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemax']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemax']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemax']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemax']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemax']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemax']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemax']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemax']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemax']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemax']=='300') echo 'selected'; ?>>300</option>
            <option value="9999999" <?php if(@$_REQUEST['surfacemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        <?php
            break;
			
		case 787:
		?>
        Nbre Pièce:
        <select name="piecemin" class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['piecemin']=='') echo 'selected'; ?>>min</option>
            <option value="1" <?php if(@$_REQUEST['piecemin']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemin']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemin']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemin']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemin']=='5') echo 'selected'; ?>>5</option>
        </select>
        
        <select name="piecemax" class='textbox' style='width:auto;'>
        	<option value=""  <?php if(@$_REQUEST['piecemax']=='') echo 'selected'; ?>selected="">max</option>
            <option value="1" <?php if(@$_REQUEST['piecemax']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemax']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemax']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemax']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemax']=='5') echo 'selected'; ?>>5</option>
            <option value="9999999" <?php if(@$_REQUEST['piecemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        
        Surface:
		<select name='surfacemin' class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['surfacemin']=='') echo 'selected'; ?>>min</option>
            <option value="20" <?php if(@$_REQUEST['surfacemin']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemin']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemin']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemin']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemin']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemin']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemin']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemin']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemin']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemin']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemin']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemin']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemin']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemin']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemin']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemin']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemin']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemin']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemin']=='300') echo 'selected'; ?>>300</option>
        </select>
        
		<select name='surfacemax' class='textbox' style='width:auto;'>
            <option value="" selected="">max</option>
            <option value="20" <?php if(@$_REQUEST['surfacemax']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemax']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemax']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemax']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemax']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemax']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemax']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemax']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemax']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemax']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemax']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemax']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemax']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemax']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemax']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemax']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemax']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemax']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemax']=='300') echo 'selected'; ?>>300</option>
            <option value="9999999" <?php if(@$_REQUEST['surfacemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        <br />
        <?php
		$typebien245=(@$_REQUEST['typebien']==245) ? 
		 			'<option value="245" selected="selected">Maison</option>':
					'<option value="245">Maison</option>';
		$typebien246=(@$_REQUEST['typebien']==246) ? 
		 			'<option value="246" selected="selected">Appartement</option>':
					'<option value="246">Appartement</option>';
		$typebien247=(@$_REQUEST['typebien']==247) ? 
		 			'<option value="247" selected="selected">Parking</option>':
					'<option value="247">Parking</option>';
		$typebien248=(@$_REQUEST['typebien']==248) ? 
		 			'<option value="248" selected="selected">Immeuble</option>':
					'<option value="248">Immeuble</option>';
			echo '
        Pays:
            <input type="text" name="Pays" value="'.@$_REQUEST['Pays'].'" style="width:75px;" />
        Ville:
            <input type="text" name="Ville" value="'.@$_REQUEST['Ville'].'" style="width:75px;" />
		Type de bien:
			<select name="typebien" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$typebien245.
				$typebien246.
				$typebien247.
				$typebien248.'
			</select>';
            break;
			
		case 788:
		?>
        Nbre Pièce:
        <select name="piecemin" class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['piecemin']=='') echo 'selected'; ?>>min</option>
            <option value="1" <?php if(@$_REQUEST['piecemin']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemin']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemin']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemin']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemin']=='5') echo 'selected'; ?>>5</option>
        </select>
        
        <select name="piecemax" class='textbox' style='width:auto;'>
        	<option value=""  <?php if(@$_REQUEST['piecemax']=='') echo 'selected'; ?>selected="">max</option>
            <option value="1" <?php if(@$_REQUEST['piecemax']=='1') echo 'selected'; ?>>Studio</option>
            <option value="2" <?php if(@$_REQUEST['piecemax']=='2') echo 'selected'; ?>>2</option>
            <option value="3" <?php if(@$_REQUEST['piecemax']=='3') echo 'selected'; ?>>3</option>
            <option value="4" <?php if(@$_REQUEST['piecemax']=='4') echo 'selected'; ?>>4</option>
            <option value="5" <?php if(@$_REQUEST['piecemax']=='5') echo 'selected'; ?>>5</option>
            <option value="9999999" <?php if(@$_REQUEST['piecemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        
        Surface:
		<select name='surfacemin' class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['surfacemin']=='') echo 'selected'; ?>>min</option>
            <option value="20" <?php if(@$_REQUEST['surfacemin']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemin']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemin']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemin']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemin']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemin']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemin']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemin']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemin']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemin']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemin']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemin']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemin']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemin']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemin']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemin']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemin']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemin']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemin']=='300') echo 'selected'; ?>>300</option>
        </select>
        
		<select name='surfacemax' class='textbox' style='width:auto;'>
            <option value="" selected="">max</option>
            <option value="20" <?php if(@$_REQUEST['surfacemax']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemax']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemax']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemax']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemax']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemax']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemax']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemax']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemax']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemax']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemax']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemax']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemax']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemax']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemax']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemax']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemax']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemax']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemax']=='300') echo 'selected'; ?>>300</option>
            <option value="9999999" <?php if(@$_REQUEST['surfacemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        <br />
        <?php
		$Situation371=(@$_REQUEST['Situation']==371) ? 
		 			'<option value="371" selected="selected">Ville</option>':
					'<option value="371">Ville</option>';
		$Situation372=(@$_REQUEST['Situation']==372) ? 
		 			'<option value="372" selected="selected">Campagne</option>':
					'<option value="372">Campagne</option>';
		$tSituation373=(@$_REQUEST['Situation']==373) ? 
		 			'<option value="373" selected="selected">Montagne</option>':
					'<option value="373">Montagne</option>';
		$Situation374=(@$_REQUEST['Situation']==374) ? 
		 			'<option value="374" selected="selected">Bord de mer</option>':
					'<option value="374">Bord de mer</option>';
					
		$Type377=(@$_REQUEST['Type']==377) ? 
		 			'<option value="377" selected="selected">Maison</option>':
					'<option value="377">Maison</option>';
		$Type378=(@$_REQUEST['Type']==378) ? 
		 			'<option value="378" selected="selected">Appartement</option>':
					'<option value="378">Appartement</option>';
		$Type376=(@$_REQUEST['Type']==376) ? 
		 			'<option value="376" selected="selected">Hôtel</option>':
					'<option value="376">Hôtel</option>';
		$Type382=(@$_REQUEST['Type']==382) ? 
		 			'<option value="382" selected="selected">Gite</option>':
					'<option value="382">Gite</option>';
		$Type375=(@$_REQUEST['Type']==375) ? 
		 			'<option value="375" selected="selected">Chambre d\'hôte</option>':
					'<option value="375">Chambre d\'hôte</option>';
		$Type381=(@$_REQUEST['Type']==381) ? 
		 			'<option value="638" selected="selected">Chalet</option>':
					'<option value="381">Chalet</option>';
		$Type380=(@$_REQUEST['Type']==380) ? 
		 			'<option value="380" selected="selected">Camping/Mobile home</option>':
					'<option value="380">Camping/Mobile home</option>';
		$Type379=(@$_REQUEST['Type']==379) ? 
		 			'<option value="379" selected="selected">Insolite</option>':
					'<option value="379">Insolite</option>';
			echo '
        Pays:
            <input type="text" name="Pays" value="'.@$_REQUEST['Pays'].'" style="width:75px;" />
        Ville:
            <input type="text" name="Ville" value="'.@$_REQUEST['Ville'].'" style="width:75px;" />
		Situation:
			<select name="Situation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$Situation371.
				$Situation372.
				$tSituation373.
				$Situation374.'
			</select>
		Type:
			<select name="Type" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$Type377.
				$Type378.
				$Type378.
				$Type376.
				$Type375.
				$Type381.
				$Type380.
				$Type379.'
			</select>
			';
            break;
			
		case 789:
		?>
        
        Surface:
		<select name='surfacemin' class='textbox' style='width:auto;'>
            <option value=""  <?php if(@$_REQUEST['surfacemin']=='') echo 'selected'; ?>>min</option>
            <option value="20" <?php if(@$_REQUEST['surfacemin']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemin']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemin']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemin']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemin']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemin']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemin']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemin']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemin']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemin']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemin']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemin']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemin']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemin']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemin']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemin']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemin']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemin']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemin']=='300') echo 'selected'; ?>>300</option>
        </select>
        
		<select name='surfacemax' class='textbox' style='width:auto;'>
            <option value="" selected="">max</option>
            <option value="20" <?php if(@$_REQUEST['surfacemax']=='20') echo 'selected'; ?>>20</option>
            <option value="30" <?php if(@$_REQUEST['surfacemax']=='30') echo 'selected'; ?>>30</option>
            <option value="40" <?php if(@$_REQUEST['surfacemax']=='40') echo 'selected'; ?>>40</option>
            <option value="50" <?php if(@$_REQUEST['surfacemax']=='50') echo 'selected'; ?>>50</option>
            <option value="60" <?php if(@$_REQUEST['surfacemax']=='60') echo 'selected'; ?>>60</option>
            <option value="70" <?php if(@$_REQUEST['surfacemax']=='70') echo 'selected'; ?>>70</option>
            <option value="80" <?php if(@$_REQUEST['surfacemax']=='80') echo 'selected'; ?>>80</option>
            <option value="90" <?php if(@$_REQUEST['surfacemax']=='90') echo 'selected'; ?>>90</option>
            <option value="100" <?php if(@$_REQUEST['surfacemax']=='100') echo 'selected'; ?>>100</option>
            <option value="120" <?php if(@$_REQUEST['surfacemax']=='120') echo 'selected'; ?>>120</option>
            <option value="140" <?php if(@$_REQUEST['surfacemax']=='140') echo 'selected'; ?>>140</option>
            <option value="160" <?php if(@$_REQUEST['surfacemax']=='160') echo 'selected'; ?>>160</option>
            <option value="180" <?php if(@$_REQUEST['surfacemax']=='180') echo 'selected'; ?>>180</option>
            <option value="200" <?php if(@$_REQUEST['surfacemax']=='200') echo 'selected'; ?>>200</option>
            <option value="220" <?php if(@$_REQUEST['surfacemax']=='220') echo 'selected'; ?>>220</option>
            <option value="240" <?php if(@$_REQUEST['surfacemax']=='240') echo 'selected'; ?>>240</option>
            <option value="260" <?php if(@$_REQUEST['surfacemax']=='260') echo 'selected'; ?>>260</option>
            <option value="280" <?php if(@$_REQUEST['surfacemax']=='280') echo 'selected'; ?>>280</option>
            <option value="300" <?php if(@$_REQUEST['surfacemax']=='300') echo 'selected'; ?>>300</option>
            <option value="9999999" <?php if(@$_REQUEST['surfacemax']=='9999999') echo 'selected'; ?>>illimité</option>
        </select>
        
        <?php
		$constructible403=(@$_REQUEST['constructible']==403) ? 
		 			'<option value="403" selected="selected">Constructible</option>':
					'<option value="403">Constructible</option>';
		$constructible404=(@$_REQUEST['constructible']==404) ? 
		 			'<option value="404" selected="selected">Non Constructible</option>':
					'<option value="404">Non Constructible</option>';
		echo '
		Constructible:
			<select name="constructible" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$constructible403.
				$constructible404.'
			</select>
		<br />
        Pays:
            <input type="text" name="Pays" value="'.@$_REQUEST['Pays'].'" style="width:75px;" />
        Ville:
            <input type="text" name="Ville" value="'.@$_REQUEST['Ville'].'" style="width:75px;" />
		';
			break;
		case 926:
		$ventelocation549=(@$_REQUEST['ventelocation']==549) ? 
		 			'<option value="549" selected="selected">A vendre</option>':
					'<option value="549">A vendre</option>';
		$ventelocation550=(@$_REQUEST['ventelocation']==550) ? 
		 			'<option value="550" selected="selected">A louer</option>':
					'<option value="550">A louer</option>';
		echo '
		Vente/Location:
			<select name="ventelocation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$ventelocation549.
				$ventelocation550.'
			</select>
			</select>
		';
			break;
			
		case 927:
		$ventelocation577=(@$_REQUEST['ventelocation']==577) ? 
		 			'<option value="577" selected="selected">A vendre</option>':
					'<option value="577">A vendre</option>';
		$ventelocation578=(@$_REQUEST['ventelocation']==578) ? 
		 			'<option value="578" selected="selected">A louer</option>':
					'<option value="578">A louer</option>';
		echo '
        Taille:
            <input type="text" name="taillemin" value="'.@$_REQUEST['taillemin'].'" style="width:75px;" />
            <input type="text" name="taillemax" value="'.@$_REQUEST['taillemax'].'" style="width:75px;" />
		Vente/Location:
			<select name="ventelocation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$ventelocation577.
				$ventelocation578.'
			</select>
		';
			break;
		
        case 793:
        
		$contrat551=(@$_REQUEST['contrat']==551) ? 
		 			'<option value="551" selected="selected">CDI</option>':
					'<option value="551">CDI</option>';
		$contrat552=(@$_REQUEST['contrat']==552) ? 
		 			'<option value="552" selected="selected">CDD</option>':
					'<option value="552">CDD</option>';
		$contrat553=(@$_REQUEST['contrat']==553) ? 
		 			'<option value="553" selected="selected">Intérim</option>':
					'<option value="553">Intérim</option>';
		$contrat554=(@$_REQUEST['contrat']==554) ? 
		 			'<option value="554" selected="selected">Stage</option>':
					'<option value="554">Stage</option>';
		$contrat555=(@$_REQUEST['contrat']==555) ? 
		 			'<option value="555" selected="selected">Alternance</option>':
					'<option value="555">Alternance</option>';
		$contrat556=(@$_REQUEST['contrat']==556) ? 
		 			'<option value="556" selected="selected">Job étudiant</option>':
					'<option value="556">Job étudiant</option>';
		$contrat557=(@$_REQUEST['contrat']==557) ? 
		 			'<option value="557" selected="selected">Saisonnier</option>':
					'<option value="557">Saisonnier</option>';
		$contrat558=(@$_REQUEST['contrat']==558) ? 
		 			'<option value="558" selected="selected">Saisonnier</option>':
					'<option value="558">Saisonnier</option>';
					
		$formation559=(@$_REQUEST['formation']==559) ? 
		 			'<option value="559" selected="selected">BEP/CAP</option>':
					'<option value="559">BEP/CAP</option>';
		$formation560=(@$_REQUEST['formation']==560) ? 
		 			'<option value="560" selected="selected">Bac</option>':
					'<option value="560">Bac</option>';
		$formation561=(@$_REQUEST['formation']==561) ? 
		 			'<option value="561" selected="selected">Bac+2</option>':
					'<option value="561">Bac+2</option>';
		$formation562=(@$_REQUEST['formation']==562) ? 
		 			'<option value="562" selected="selected">Bac+3</option>':
					'<option value="562">Bac+3</option>';
		$formation563=(@$_REQUEST['formation']==563) ? 
		 			'<option value="563" selected="selected">Bac+4</option>':
					'<option value="563">Bac+4</option>';
		$formation564=(@$_REQUEST['formation']==564) ? 
		 			'<option value="564" selected="selected">Bac+5</option>':
					'<option value="564">Bac+5</option>';
		$formation565=(@$_REQUEST['formation']==565) ? 
		 			'<option value="565" selected="selected">Bac+6 et plus</option>':
					'<option value="565">Bac+6 et plus</option>';
					
		$experience566=(@$_REQUEST['experience']==566) ? 
		 			'<option value="566" selected="selected">Jeune diplômé</option>':
					'<option value="566">Jeune diplômé</option>';
		$experience567=(@$_REQUEST['experience']==567) ? 
		 			'<option value="567" selected="selected">1 à 2 ans</option>':
					'<option value="567">1 à 2 ans</option>';
		$experience568=(@$_REQUEST['experience']==568) ? 
		 			'<option value="568" selected="selected">3 à 5 ans</option>':
					'<option value="568">3 à 5 ans</option>';
		$experience569=(@$_REQUEST['experience']==569) ? 
		 			'<option value="569" selected="selected">6 à 10 ans</option>':
					'<option value="569">6 à 10 ans</option>';
		$experience570=(@$_REQUEST['experience']==570) ? 
		 			'<option value="570" selected="selected">Plus de 10 ans</option>':
					'<option value="570">Plus de 10 ans</option>';
					
		$Mobilite571=(@$_REQUEST['Mobilite']==571) ? 
		 			'<option value="571" selected="selected">Internationale</option>':
					'<option value="571">Internationale</option>';
		$Mobilite572=(@$_REQUEST['Mobilite']==572) ? 
		 			'<option value="572" selected="selected">Nationale</option>':
					'<option value="572">Nationale</option>';
		$Mobilite573=(@$_REQUEST['Mobilite']==573) ? 
		 			'<option value="573" selected="selected">Régionale</option>':
					'<option value="573">Régionale</option>';
		$Mobilite574=(@$_REQUEST['Mobilite']==574) ? 
		 			'<option value="574" selected="selected">Locale</option>':
					'<option value="574">Locale</option>';
					
		$emploi571=(@$_REQUEST['emploi']==575) ? 
		 			'<option value="575" selected="selected">Temps plein</option>':
					'<option value="575">Temps plein</option>';
		$emploi572=(@$_REQUEST['emploi']==576) ? 
		 			'<option value="576" selected="selected">Temps partiel</option>':
					'<option value="576">Temps partiel</option>';
					
            echo '
			<br>
		Type de contrat:
			<select name="contrat" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$contrat551.
				$contrat552.
				$contrat553.
				$contrat554.
				$contrat555.
				$contrat556.
				$contrat557.
				$contrat558.'
			</select>
		Niveau de formation:
			<select name="formation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$formation559.
				$formation560.
				$formation561.
				$formation562.
				$formation563.
				$formation564.
				$formation565.'
			</select>
		Niveau d\'expérience:
			<select name="experience" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$experience566.
				$experience567.
				$experience568.
				$experience569.
				$experience570.'
			</select>
			<br>
		Mobilité:
			<select name="Mobilite" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$Mobilite571.
				$Mobilite572.
				$Mobilite573.
				$Mobilite574.'
			</select>
		Type d\'emploi	:
			<select name="emploi" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$emploi571.
				$emploi572.'
			</select>
			';
            break;
            
        case 821:
        
		$typeemploi512=(@$_REQUEST['typeemploi']==512) ? 
		 			'<option value="512" selected="selected">Auxiliaire de vie</option>':
					'<option value="512">Auxiliaire de vie</option>';
		$typeemploi513=(@$_REQUEST['typeemploi']==513) ? 
		 			'<option value="513" selected="selected">Assistante de vie</option>':
					'<option value="513">Assistante de vie</option>';
		$typeemploi514=(@$_REQUEST['typeemploi']==514) ? 
		 			'<option value="514" selected="selected">Aide a domicile</option>':
					'<option value="514">Aide a domicile</option>';
		$typeemploi515=(@$_REQUEST['typeemploi']==515) ? 
		 			'<option value="515" selected="selected">Aide ménagère</option>':
					'<option value="515">Aide ménagère</option>';
		$typeemploi516=(@$_REQUEST['typeemploi']==516) ? 
		 			'<option value="516" selected="selected">Aide soignante</option>':
					'<option value="516">Aide soignante</option>';
		$typeemploi517=(@$_REQUEST['typeemploi']==517) ? 
		 			'<option value="517" selected="selected">Garde a domicile</option>':
					'<option value="517">Garde a domicile</option>';
		$typeemploi518=(@$_REQUEST['typeemploi']==518) ? 
		 			'<option value="518" selected="selected">Garde de nuit</option>':
					'<option value="518">Garde de nuit</option>';
		$typeemploi519=(@$_REQUEST['typeemploi']==519) ? 
		 			'<option value="519" selected="selected">Autre</option>':
					'<option value="519">Autre</option>';
					
		$autretache520=(@$_REQUEST['autretache']==520) ? 
		 			'<option value="520" selected="selected">Menage</option>':
					'<option value="520">Menage</option>';
		$autretache521=(@$_REQUEST['autretache']==521) ? 
		 			'<option value="521" selected="selected">Repassage</option>':
					'<option value="521">Repassage</option>';
		$autretache522=(@$_REQUEST['autretache']==522) ? 
		 			'<option value="522" selected="selected">Cuisine</option>':
					'<option value="522">Cuisine</option>';
		$autretache523=(@$_REQUEST['autretache']==523) ? 
		 			'<option value="523" selected="selected">Courses</option>':
					'<option value="523">Courses</option>';
		$autretache524=(@$_REQUEST['autretache']==524) ? 
		 			'<option value="524" selected="selected">Infirmier(e) diplome(e)</option>':
					'<option value="524">Infirmier(e) diplome(e)</option>';
		$autretache525=(@$_REQUEST['autretache']==525) ? 
		 			'<option value="525" selected="selected">Permis de conduire</option>':
					'<option value="525">Permis de conduire</option>';
            echo '
		Type d\'emploi:
			<select name="typeemploi" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$typeemploi512.
				$typeemploi513.
				$typeemploi514.
				$typeemploi515.
				$typeemploi516.
				$typeemploi517.
				$typeemploi518.
				$typeemploi519.'
			</select>
		Autres tâches:
			<select name="autretache" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$autretache520.
				$autretache521.
				$autretache522.
				$autretache523.
				$autretache524.
				$autretache525.'
			</select>
			';
            break;
			            
        case 875:
        
            echo '
			<br>
<div>
		Langue (du):
			<input type="checkbox" name="492">  Allemand
			<input type="checkbox" name="493">  Anglais
			<input type="checkbox" name="494">  Arabe<br>
			<input type="checkbox" name="495">  Espagnol
			<input type="checkbox" name="496">  Français
			<input type="checkbox" name="497">  Italien<br>
			<input type="checkbox" name="498">  Japonais
			<input type="checkbox" name="499">  Mandarin
			<input type="checkbox" name="500">  Portugais<br>
			<input type="checkbox" name="501">  Autre<br><br>
</div>
<div>			
		Traduction (en):<input type="checkbox" name="502">  Allemand
			<input type="checkbox" name="503">  Anglais
			<input type="checkbox" name="504">  Arabe<br>
			<input type="checkbox" name="505">  Espagnol
			<input type="checkbox" name="506">  Français
			<input type="checkbox" name="507">  Italien<br>
			<input type="checkbox" name="508">  Japonais
			<input type="checkbox" name="509">  Mandarin
			<input type="checkbox" name="510">  Portugais<br>
			<input type="checkbox" name="511">  Autre<br><br>
</div>			
			';
            break;
			
        case 882:
					
		$placesdispo526=(@$_REQUEST['placesdispo']==526) ? 
		 			'<option value="526" selected="selected">1</option>':
					'<option value="526">1</option>';
		$placesdispo527=(@$_REQUEST['placesdispo']==527) ? 
		 			'<option value="527" selected="selected">2</option>':
					'<option value="527">2</option>';
		$placesdispo528=(@$_REQUEST['placesdispo']==528) ? 
		 			'<option value="528" selected="selected">3</option>':
					'<option value="528">3</option>';
		$placesdispo529=(@$_REQUEST['placesdispo']==529) ? 
		 			'<option value="529" selected="selected">4</option>':
					'<option value="529">4</option>';
		$placesdispo530=(@$_REQUEST['placesdispo']==530) ? 
		 			'<option value="530" selected="selected">5+</option>':
					'<option value="530">5+</option>';
        
            echo '
		Places disponibles:
			<select name="placesdispo" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$placesdispo526.
				$placesdispo527.
				$placesdispo528.
				$placesdispo529.
				$placesdispo530.'
			</select>
		<br>
		Ville de destination:
			<input type="text" name="villedestination" value="'.@$_REQUEST['villedestination'].'" class="textbox" style="width:100px;">
		Du:
			<input type="text" name="du" value="'.@$_REQUEST['du'].'" class="textbox" style="width:100px;">
			';
            break;
            /*
        case 930:
        case 931:
            echo '
        Espèce:
            <select name="sp_common_main_type" onchange="">
                <option value="" selected="">Indifférent</option>
                <option value="Chat">Chat</option>
                <option value="Chien">Chien</option>
                <option value="Cheval">Cheval</option>
                <option value="Oiseau">Oiseau</option>
                <option value="Rongeur">Rongeur</option>
                <option value="Reptile">Reptile</option>
                <option value="Poisson">Poisson</option>
                <option value="Autre animal">Autre animal</option>
            </select>'	;
        break;
			*/
			
        case 888:
        case 892:
        case 893:
		?>
		<select name="agemin">
        	<option value="" <?php if(@$_REQUEST['agemin']=='') echo 'selected'; ?>>min</option>
            <?php
				for ($i = 18; $i <= 99; $i--) {
					if(@$_REQUEST['agemin']==$i)
						echo "<option value='$i' selected>$i</option>";
					else
						echo "<option value='$i'>$i</option>";
				}
			?>
		</select>
        
		<select name="agemax">
        	<option value="" <?php if(@$_REQUEST['agemax']=='') echo 'selected'; ?>>max</option>
            <?php
				for ($i = 18; $i <= 99; $i--) {
					if(@$_REQUEST['agemax']==$i)
						echo "<option value='$i' selected>$i</option>";
					else
						echo "<option value='$i'>$i</option>";
				}
			?>
		</select>
        
        <?php
		break;
    }
    ?>
</div>
<span style="border-right:#FFF solid 2px; padding:5px;">
<input type="radio" name="user_type" id="user_type1" value="Particulier" <?php if($_REQUEST[user_type]=="Particulier") echo "checked='checked'"; ?> />
<label for="user_type1">Particulier</label>

<input type="radio" name="user_type" id="user_type2" value="Professionnel" <?php if($_REQUEST[user_type]=="Professionnel") echo "checked='checked'"; ?>/>
<label for="user_type2">Professionnel</label>
</span>

<span style="border-right:#FFF solid 2px; padding:5px;">
<input type="radio" name="offer_type" id="offer_type1" value="Offre" <?php if($_REQUEST[offer_type]=="Offre") echo "checked='checked'"; ?> /> 
<label for="offer_type1">Offre</label>

<input type="radio" name="offer_type" id="offer_type2" value="Cherche" <?php if($_REQUEST[offer_type]=="Cherche") echo "checked='checked'"; ?> />
<label for="offer_type2">Cherche</label>
</span>


<span style=" padding:5px;">
    <input type="checkbox" name="picture" id="picture" <?php if($_REQUEST[picture]=="on") echo "checked='checked'"; ?> />
	<label for="picture">Avec photo</label>
</span>
    
    <input type="submit" value="Chercher" class="post-btn button button-green" style="height:30px;" />
</div>

<?php
if($cat_id==0 && $subcat_id==0 && $sub_subcat_id==0 && $stateId==0){
}
else{
	?>
	<div>
        <style>
.results {width: 100%;border-collapse: collapse;}

.results tr {
	margin: 0;
	padding: 0;
	display: table-row;
	vertical-align: inherit;
	border-color: inherit;
	background: #e9e7e7;
}

.results th.header {
	cursor: pointer;
	background: #e9e7e7 url('mobile/images/bg.gif') no-repeat 100% 50%;
	padding-right: 5px;
}

.results th.header:hover{
	cursor: pointer;
	background:  url('mobile/images/bg.gif') no-repeat 100% 50%;
	padding-right: 5px;
}

.results th.headerSortUp {background:  url('mobile/images/asc.gif') no-repeat 100% 50%;}
.results th.headerSortUp:hover {background: url('mobile/images/asc.gif') no-repeat 100% 50%;}

.results th.headerSortDown {background:  url('mobile/images/desc.gif') no-repeat 100% 50%;}
.results th.headerSortDown:hover {background: url('mobile/images/desc.gif') no-repeat 100% 50%;}

.results thead th {
border-bottom: solid 1px #c4c4c4;
}
		</style>
        <input type="hidden" name="datepub" id="datepub" value="" />
        <input type="hidden" name="prix" id="trie" value="" />
        <?php
			$prix=$_REQUEST['prix'];
			$datepub=$_REQUEST['datepub'];
		?>
    <table class="results">
        <tr>
            <th width="60%" align="left">
                Montrant <?php echo  $start+1?> 
                à  <?php echo ($reccnt<$start+$pagesize)?($reccnt):($start+$pagesize)?>	
                de <?php echo $reccnt?> Annonces
            </th>
            <th width="10%" class="">Trier par:</th>
            <?php
			
			switch($datepub){
				case "ASC":?>
                	<th width="20%" class="header headerSortDown">
                	<a href="" class="link" onclick="document.getElementById('datepub').value='DESC';document.forms[0].submit();return false;">
                    	Date de publication
                    </a>
                    </th>
                <?php
				break;
				
				case "DESC":?>
    	            <th width="20%" class="header headerSortUp">
                	<a href="" class="link" onclick="document.getElementById('datepub').value='ASC';document.forms[0].submit();return false;">
                    	Date de publication
                    </a>
                </th>
	            <?php
				break;
				
				default:?>
    	            <th width="20%" class="header">
                	<a href="" class="link" onclick="document.getElementById('datepub').value='ASC';document.forms[0].submit();return false;">
                    	Date de publication
                    </a>
                </th>
	            <?php
				break;
			}
			
			switch($prix){
				case "ASC":?>
	                <th width="10%" class="header headerSortDown">
                		<a href="" class="link" onclick="document.getElementById('trie').value='DESC';document.forms[0].submit();return false;">Prix</a>
                </th>
                <?php
				break;
				
				case "DESC":?>
	                <th width="10%" class="header headerSortUp">
                		<a href="" class="link" onclick="document.getElementById('trie').value='ASC';document.forms[0].submit();return false;">Prix</a>
                </th>
	            <?php
				break;
				
				default:?>
	                <th width="10%" class="header">
                		<a href="" class="link" onclick="document.getElementById('trie').value='ASC';document.forms[0].submit();return false;">Prix</a>
                </th>
	            <?php
				break;
			}
			?>
        </tr>
    </table>
            
        </div>
    
        <?php
}
?>
</form> 
                
