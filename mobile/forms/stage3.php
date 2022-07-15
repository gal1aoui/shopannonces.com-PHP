<div class="heading">
    Publier mon annonce gratuite
    <span class="post-steps">3 / 4: </span>
</div>

<div class="body">
	<form method="post" action="<?php echo CFG_FORM_ACTION; ?>?stage=<?php echo CFG_STAGE_ID+1; ?>">
    
    <fieldset>        
    <div>
        <label for="classi_state">Province :</label>
        <select name="classi_state" id="classi_state" class="textbox" onChange="get_city_by_state_mobile(this.value,'')" data-native-menu="false" required >
            <?php echo get_state($_SESSION['forms'][CFG_STAGE_ID]['classi_state']);?>
        </select>
    </div>
        
    <div>
        <label for="classi_city">Ville :</label>
        <div id="bloc_city" style="display:block" >
            <select name="classi_city" id="classi_city" class="textbox" data-native-menu="false" required />
                <?php echo Get_city($_SESSION['forms'][CFG_STAGE_ID]['classi_city'], $_SESSION['forms'][CFG_STAGE_ID]['classi_state']);?>
            </select>
        </div>
    </div>


    <div>
        <label for="classi_zipcode">Code postal :</label>
        <input type="text" name="classi_zipcode" id="classi_zipcode" maxlength="5" value="<?php echo $_SESSION['forms'][CFG_STAGE_ID]['classi_zipcode'];?>" onkeyup="check(this);" required autocomplete="off" required="required" class="textbox" />

    </div>
     
    <div>
        <label for="classi_address">Adresse :</label>
            <textarea name="classi_address" id="classi_address" rows="3" class="textbox"  maxlength="100" required="required"><?php echo $_SESSION['forms'][CFG_STAGE_ID]['classi_address'];?></textarea>
    </div>
    
    </fieldset>

    <input type="submit" class="button button-green" value="Continuer" />
</form>
</div>