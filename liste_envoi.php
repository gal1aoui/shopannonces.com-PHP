<?php
	$meta_titles="Mesannonces désinscription";
	$meta_desc="Mesannonces désinscription";
	$meta_keywords="Mesannonces désinscription";
	
	require_once("header.inc.php");
?>
<script language="javascript">
	function validatesubscribe(){
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

	<div class="tree"><a href="index.php">Accueil</a> >> Bulletin </div>
   
    <div class="p7">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><span class="title_clad">Bulletin</span></div>
            <div class="panel-body">
        		<form  name="subscribe" method="post" action="listenvoiprocess.php" target="postFrame" onsubmit="return validatesubscribe();">
            		<table width="100%">
                <tr>
                    <td height="25" class=" ar fs11" align="center">( <span class="star">* </span>) obligatoire.</td>                    
                </tr>
                <tr>
                	<td><h4 style="font-weight: bold; color:#F00;" id="msg_new"><?php echo Display_Message();?></h4></td>
                </tr>
                <tr>
                	<td class="commentaire" align="center">Désinscription de la liste d'envoi:</td>
                </tr>
                <tr>
                    <td align="center">
                    	<span class="star">*</span> Votre email ID : <input type="text" name="subscribe_email" class="textbox"/>
                    </td>
                </tr>
                <tr>
                    <td align="center">
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                        <input name="Submit22" type="submit" class="button button-green" value="Désinscrire"/>
                        <input type="hidden" name="action" value="Add" />
                    </td>
                </tr>
                
                	<iframe name="postFrame" src="listenvoiprocess.php" style="display:none"></iframe> 	
            </table>
        		</form>
            </div>
        </div>
	</div>
    
</div>
<?php
require_once("footer.inc.php");
?>