<div class="heading">
    Publier mon annonce gratuite
    <span class="post-steps">1 / 4: </span>
</div>

<div class="body">
	<form id="mobile_post" name="mobile_post" action="<?php echo CFG_FORM_ACTION; ?>?stage=<?php echo CFG_STAGE_ID+1; ?>" method="POST" class="post">
        <input type="hidden" name="step" value="2">
            
        <div id="msgtextcategory" class="error" style="display:none;">Ce champ est obligatoire.</div>
        <div>
            <label class="select-label" for="principale_select">Cat&eacute;gorie: *</label>
            
            <select name="principale_select" id="principale_select" class="textbox" data-native-menu="false" tabindex="-1" 
            onChange="cat_drop_prin_select_mobile(this.value,'');" required >
                <?php
                    echo prin_select_selected($_SESSION['forms'][CFG_STAGE_ID]['principale_select']);
                ?>
            </select>
        </div>
        
        <div id="ogiga">
            <?php echo subsub_cat($_SESSION['forms'][CFG_STAGE_ID]['cat_level_two'], $_SESSION['forms'][CFG_STAGE_ID]['principale_select']); ?>
        </div>
        
        <div id="msgtexttitle" class="error" style="display:none;">Ce champ est obligatoire.</div>
        <div>
            <label class="select-label" for="classi_title">Titre de l'annonce: *</label>
            <input type="text" class="textbox" name="classi_title" id="classi_title"
                value="<?php echo $_SESSION['forms'][CFG_STAGE_ID]['classi_title']; ?>" maxlength="60" autocomplete="off" required="required">
        </div>
        
        <div id="msgtexttitle" class="error" style="display:none;">Ce champ est obligatoire.</div>
        <div>
            <label>Type de l'annonce :</label>
            <select name="classified_ad_type" id="classified_ad_type" class="textbox" data-native-menu="false" required >
                <option value="">Type d'annonce</option>
                <?php
                foreach($Ads_type as $key=>$val){
                    $sel=$_SESSION['forms'][CFG_STAGE_ID]['classified_ad_type']==$val ? "selected" : "";
                    ?>
                    <option value="<?php echo $val;?>" <?php echo $sel;?>><?php echo $val;?></option>
                    <?php 
                } ?>	
            </select>
        </div>
        
        
        <div id="msgtextdesc" class='error' style="display:none;">Ce champ est obligatoire.</div>
        <div>
            <label class="select-label">Description: *</label>
            <textarea name="classi_desc" class="textbox" cols="55" rows="4" 
            required="required"><?php echo $_SESSION['forms'][CFG_STAGE_ID]['classi_desc'];?></textarea>
        </div>
        
        <div id="msgtexttitle" class="error" style="display:none;">Ce champ est obligatoire.</div>
        <div>
            <label class="select-label">Prix: *</label>
            <input type="text" class="textbox" name="classi_prix" 
            value="<?php echo $_SESSION['forms'][CFG_STAGE_ID]['classi_prix']; ?>" maxlength="60" required="required">
        </div>
        
        
		<input type="submit" class="button button-green" name="publier1" id="publier1" value="Continuer">
	</form>
</div>