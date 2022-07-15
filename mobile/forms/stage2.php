<div class="heading">
    Publier mon annonce gratuite
    <span class="post-steps">2 / 4: </span>
</div>

<div class="body">
    <form method="post" action="<?php echo CFG_FORM_ACTION; ?>?stage=<?php echo CFG_STAGE_ID+1; ?>">
        <fieldset>
            
        
        <div id="omega" >
            <?php echo option_subsub_cat($_SESSION['forms'][CFG_STAGE_ID-1]['cat_level_two']); ?>
        </div>
        
        </fieldset>
        
        <input type="submit" class="button button-green" value="Continuer" />
    </form>
</div>