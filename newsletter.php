<?php
	$meta_titles="Mesannonces newsletter";
	$meta_desc="Mesannonces newsletter";
	$meta_keywords="Mesannonces newsletter";
	
	require_once("header.inc.php");
?>
<script language="javascript">
	function validatesubscribe(){
		if(document.subscribe.subscribe_name.value == ""){
			alert("Svp, entrez votre nom.")
			document.subscribe.subscribe_name.focus()
			return false;
		 }
		if(document.subscribe.subscribe_email.value == ""){
			alert("Svp, entrez votre adresse courriel.")
			document.subscribe.subscribe_email.focus()
			return false;
		 }
		 var email1 = document.subscribe.subscribe_email.value;
		 if(!email1.match(/^[A-Za-z0-9\._\-+]+@[A-Za-z0-9_\-+]+(\.[A-Za-z0-9_\-+]+)+$/)){
			alert("Cet ID courriel n'est pas valide! Svp, veuillez entrer un ID courriel valide.");
			document.subscribe.subscribe_email.focus();
			return false;
		 }
	 }
	 onSubmit="return validatesubscribe();"
</script>

<div class="grid_3">
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">

	<div class="main-heading">
    	Newsletter
	</div>
    
	<div class="tree">
    	<a href="index.php">Accueil</a> >> Newsletter
	</div>
    
	<div class="">
		<h3 style="font-weight: bold; color:#F00;" id="msg_new"><?php echo Display_Message();?></h3>
	</div>
    
	<div class="ar fs11">
        ( <span class="star">* </span>) obligatoire.
	</div>
    
	<div class="commentaire">
    	Inscrire / Désinscrire de la newsletter:
    </div>
    
    
        <form  name="subscribe" method="post"  action="newsletter_process.php" target="postFrame" onsubmit="return validatesubscribe();">
        
            	<div class="grid_3">
                	<span class="star">*</span> Votre Nom : 
            	</div>
            	<div class="grid_9">
                	<input type="text" name="subscribe_name" class="textbox"/>
				</div>
            
            	<div class="grid_3">
                	<span class="star">*</span> Votre email ID : 
            	</div>
            	<div class="grid_9">
                	<input type="text" name="subscribe_email" class="textbox"/>
				</div>
            
            	<div class="grid_13 tc">
                    <input type="radio" name="substatus" id="radio" value="1" checked="checked"  /> S'inscrire&nbsp;
                    <input type="radio" name="substatus" id="radio2" value="0" /> Désinscrire
            </div>
            
            <iframe name="postFrame" src="newsletter_process.php" style="display:none"></iframe>
            
            	<div class="grid_13 tc">
                    <input name="Submit22" type="submit" class="button button-green" value="Soumettre"/>
                    &nbsp;
                    <input name="submit" type="reset" class="button button-green" value="Anuller"/>
                   	<input type="hidden" name="action" value="Add" />
            </div>
        </form>
	
</div>
<?php
require_once("footer.inc.php");
?>