<?php	
$link_pravicy=get_config_setting(6);

if($link_pravicy!=""){
	$prvicy_link="<a href='privacy-policy.php'>Politique de confidentialité</a>";
}else{
	$prvicy_link="<a href='privacy-policy.php'>Politique de confidentialité</a>";
}

?>
	<div class="grid_16">&nbsp;</div>

    <div class="grid_16 bg-footer">
    
        <p class="mt10 bot_link b">
            <span style="font-size: 13px; vertical-align: top">
                <a href="aboutus.php" rel="nofollow">Qui sommes-nous?</a> |
                <a href="advertise.php" rel="nofollow">Annoncez avec nous</a> |
                <a href="liste-envoi.php">Newsletter</a> |
				<?php echo $prvicy_link;?> |
                <a href="terms-use.php" rel="nofollow">Conditions d'utilisations</a> |
                <a href="sitemap.php" rel="nofollow">Carte du site</a>
            </span>
        </p>
    
        <p class="mt10 bot_link b" style="margin:20px 15px 0 15px;">
            <a href="faq.php" rel="nofollow">FAQ</a> |             
            <a href="help.php" rel="nofollow">Aide</a> |             
            <a href="contactus.php" rel="nofollow">contact</a>
        </p>
    </div>
    
    
    <!-- <div class="grid_16 grey-color">&nbsp;
        <div class="grid_12" style="font-size: 11px; color: #FFFFFF; margin:0px;">&nbsp;
            <?php //if($pagename!="index.php" && $pagename!="classified-details.php") echo $link_footer;?>
        </div>
         -->
        <!-- <a href="https://plus.google.com/+mesannonces" rel="publisher">Google+</a> -->
    </div>
</div>

</body>
</html>