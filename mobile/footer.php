
	<footer style="text-align: center;">
    
    	<div  class="footer_printer mb17">
            <div>
            	<ul>
                    <li>            
                        <a href="./">Accueil</a>
                    </li>
                    <li>                    
                        <a href="./post.php">Publiez une annonce</a>
                    </li>
				<?php
                
                    if(chk_login()){	
                ?>
                    <li>
                        <a href="./signin.php">Mon compte</a>
                    </li>
                    <li>                    
                        <a href="./register.php">Se Déconnecter</a>
                    </li>
				<?php
                    }
                    else{
				?>
                    <li>
                        <a href="./signin.php">Se Connecter</a>
                    </li>
                    <li>                    
                        <a href="./register.php">Créer un compte</a>
                    </li>
				<?php
                    }
                ?>
                </ul>
            </div>
        
            <div class=" mt17">
                <a href="http://flyannonces.com/?full_site=1">Flyannonces version PC</a>
            </div>
        </div>
        
        <p class="commentaire">
            Copyright © 2015 Flyannonces
        </p>
	</footer><!-- /footer -->
</page><!-- /page -->

    
</body>
</html>