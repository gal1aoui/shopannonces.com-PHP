<?php
/*
echo '<pre>';
echo  get_catinfo($_SESSION['forms'][1]['cat_level_two'], 'cat_name');
echo "<br>";
echo $_SESSION['forms'][1]['classi_title'];
echo "<br>";
echo Get_statename($_SESSION['forms'][3]['classi_state']) .': '. Get_cityname($_SESSION['forms'][3]['classi_city']);
echo '</pre>';
*/

/*
echo '<pre>';
print_r($_SESSION);
echo '</pre>';
*/

/*
if( isset($_POST['upload']) ) // si formulaire soumis
{
	$file_name  = stripslashes($file['fichier']);
	
	if (move_uploaded_file($file_name, $upload_dir."/".$file_name)) {
    echo "success";
} else {
    echo "failed";
}
	
    $content_dir = 'upload/'; // dossier où sera déplacé le fichier

    $tmp_file = $_FILES['fichier']['tmp_name'];
	
	//echo realpath($tmp_file);
	if(is_uploaded_file(realpath($tmp_file)))
	{
		echo "done";
	}
	else
	{
		echo "fail";
	}
		
    if( !is_uploaded_file($tmp_file) )
    {
        exit("Le fichier est introuvable");
    }

    // on vérifie maintenant l'extension
    $type_file = $_FILES['fichier']['type'];

    if( !strstr($type_file, 'jpg') && !strstr($type_file, 'jpeg') && !strstr($type_file, 'bmp') && !strstr($type_file, 'gif') )
    {
        exit("Le fichier n'est pas une image");
    }

    // on copie le fichier dans le dossier de destination
    $name_file = $_FILES['fichier']['name'];

    if( !move_uploaded_file($tmp_file, $content_dir . $name_file) )
    {
        exit("Impossible de copier le fichier dans $content_dir");
    }

    echo "Le fichier a bien été uploadé";
}
*/



unset($_SESSION['upload_passe']);
?>
<div class="heading">
    Publier mon annonce gratuite
    <span class="post-steps">4 / 4: </span>
</div>

<div class="body">

        <form name="frm" action="<?php echo CFG_FORM_ACTION; ?>?stage=<?php echo CFG_STAGE_ID+1; ?>" method="post" data-ajax="false" enctype="multipart/form-data">
        
        <input type='file' name='files[]' multiple="multiple"  />
                        
                <fieldset>
                    <legend>Ajouter des photos: </legend>
                    
                    <div class="form-group">
                        <label for="titre">                        
                            Titre: <?php echo $_SESSION['forms'][1]['classi_title'];?>                        
                        </label>
                    </div>
                    
                    <div class="form-group">
                        <label for="titre">
                            <?php echo  get_catinfo($_SESSION['forms'][1]['cat_level_two'], 'cat_name');?>
                            :
                            <?php echo Get_statename($_SESSION['forms'][3]['classi_state']) .' - '. Get_cityname($_SESSION['forms'][3]['classi_city']);?>
                    </label>
                    </div>
                    
                    
                    <div class="form-group">
                        <div class="col-lg-12">
                            <input type="submit" class="button button-green" value="Envoyer et continuer" />
                        </div>
                    </div>
                </fieldset>
                
			</form>
                
</div>

