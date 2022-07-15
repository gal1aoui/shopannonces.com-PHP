<?php
	require_once("includes/main.inc.php");
	require_once("front-functions.php");
	
	$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_meta_tags','id','11');
	require_once("header.php");
?>

<div id="content">
<?php

session_start();

// Configuration du script
define('CFG_FORM_ACTION', basename(__FILE__)); // Cela permet de changer le nom du script d index
$forms = array( // Voici la liste des formulaires, pratique pour mettre en place le menu de navigation
    1 => 'Informations Générales',
    2 => 'Détails produits',
    3 => 'Localisation',
    4 => 'Illustration'
    );

// Récupération du numéro de l étape en cours
if(empty($_GET['stage']) or !is_numeric($_GET['stage']))
{
    define('CFG_STAGE_ID', 1);
}
else
{
    // En situation réelle, il faudrait vérifier l existence de cette page
    define('CFG_STAGE_ID', intval($_GET['stage']));
}

// Déclaration de la variable de session
if(empty($_SESSION['forms']))
{
    $_SESSION['forms'] = array();
}


// Affichage du menu en haut de la page
$items = array();
foreach($forms as $form_id => $form_name)
{
    if(empty($_SESSION['forms'][$form_id]))
    {
        $items[] = $form_name;
    }
    else
    {
        $items[] = '<a href="'.basename(__FILE__).'?stage='.$form_id.'">'.$form_name.'</a>';
    }
}
$items[] = '<a href="'.basename(__FILE__).'?stage=4">Résumé</a>';
//echo implode(' - ', $items).'<br /><br />';



// Récupération des informations, affichage du formulaire
switch(CFG_STAGE_ID)
{
    case 5:
				
        // Récupération des informations du formulaire précédent
		
		if (!isset($_SESSION['upload_passe']) || (isset($_SESSION['upload_passe']) && $_SESSION['upload_passe'] == false)) {
			if(!empty($_FILES))
			{
				$_SESSION['forms'][CFG_STAGE_ID-1] = array();
				$i=1;
				foreach ($_FILES['files']['name'] as $index => $nameFile){
					//commandes
					//echo $index." , ".$nameFile.", ";
					
					//$img_file_temp = upload_file_mobile_tempo($index, "img_temp");
					
					 $return=@move_uploaded_file($_FILES['files']['tmp_name'][$index], "img_temp/".time($nameFile).$nameFile);
	
					$_SESSION['forms'][CFG_STAGE_ID-1][$index] = "img_temp/".time($nameFile).$nameFile;
					
					if($i==8)
						break;
					$i++;
				}
				unset($_FILES);
			}
			$_SESSION['upload_passe'] = true;
		}
		/*
		if(empty($_SESSION['forms'][4]))
		{
        	//require('./forms/4-summary.php');
			header("location: post.php?stage=4");
			exit();
		}
		*/
        // Affichage du formulaire
        require('./forms/process_form.php');
		
    break;
	
    case 4:
		
        // Récupération des informations du formulaire précédent
		
            if(!empty($_POST['classi_state'])
                and !empty($_POST['classi_city'])
                and !empty($_POST['classi_zipcode'])
                and !empty($_POST['classi_address']))
            {
                $_SESSION['forms'][CFG_STAGE_ID-1] = array(
                    'classi_state'   => $_POST['classi_state'],
                    'classi_city'   => $_POST['classi_city'],
                    'classi_zipcode'   => $_POST['classi_zipcode'],
                    'classi_address'   => $_POST['classi_address']
                    );
            }
			
			if(empty($_SESSION['forms'][3])){
				header("location: post.php?stage=3");
				exit();
			}

        // Affichage du formulaire
        require('./forms/4-summary.php');
    break;


    case 3:
		
        // Valeurs par défaut
		/*
        if(empty($_SESSION['forms'][CFG_STAGE_ID-1]))
        {
            $_SESSION['forms'][CFG_STAGE_ID] = array(
                'classi_state'   => '',
                'classi_city'   => '',
                'classi_zipcode'   => '',
                'classi_address'   => ''
                );
        }
		*/

                //$_SESSION['forms'][CFG_STAGE_ID-1] = array();
				
        // Récupération des informations du formulaire précédent
        if(!empty($_POST))
        {
			$_SESSION['forms'][CFG_STAGE_ID-1] = array();
			foreach($_POST as $key => $val){
				
				$_SESSION['forms'][CFG_STAGE_ID-1][$key] = $val;
			}
        }

		if(empty($_SESSION['forms'][2])){
			header("location: post.php?stage=2");
			exit();
		}
        // Affichage du formulaire
        require('./forms/stage3.php');
    break;

    case 2:
        // Valeurs par défaut
		
        // Récupération des informations du formulaire précédent
        //if(!empty($_POST))
        //{
            if(!empty($_POST['cat_level_two'])
                and !empty($_POST['classi_title'])
                and !empty($_POST['classified_ad_type'])
                and !empty($_POST['classi_desc'])
                and !empty($_POST['classi_prix']))
            {
                $_SESSION['forms'][CFG_STAGE_ID-1] = array(
                    'principale_select'   => $_POST['principale_select'],
                    'cat_level_two'   => $_POST['cat_level_two'],
                    'classi_title' => $_POST['classi_title'],
                    'classified_ad_type'  => $_POST['classified_ad_type'],
                    'classi_desc'  => $_POST['classi_desc'],
                    'classi_prix'  => $_POST['classi_prix']
                    );
            }
			else{
				header("location: post.php?stage=1");
				exit();
			}
        //}

        require('./forms/stage2.php');
    break;

    case 1:
    default:
        // Valeurs par défaut
		/*
        if(empty($_SESSION['forms'][CFG_STAGE_ID]))
        {
            $_SESSION['forms'][CFG_STAGE_ID] = array(
                'principale_select'   => '',
                'cat_level_two'   => '',
                'classi_title' => '',
                'classified_ad_type'  => '',
                'classi_desc'  => '',
                'classi_prix'  => ''
                );
        }
		*/

        require('./forms/stage1.php');
    break;
}

?>

</div>

<?php
	require_once("footer.php");
?>