<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");




$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
	
    //Remove any html/javascript.
    $keyword = secureValue($_REQUEST['keyword']);
/*	if($keyword=='')
		$keyword=' ';*/

	$cat_id=intval($_REQUEST['catId']);
	$subcat_id=intval($_REQUEST['subcatId1']);
	$sub_subcat_id=intval($_REQUEST['subcatId']);

	$cat=intval($_REQUEST['cat']);
	if($cat_id==0 && $subcat_id==0 && $sub_subcat_id==0){
		
			switch(chekcat($cat)){
				case "clsd_sub_subcat_id":
					$sub_subcat_id=$cat;
					$cl="clsd_sub_subcat_id";				
				break;
				
				case "clsd_subcat_id":
					$subcat_id=$cat;
					$cl="clsd_subcat_id";				
				break;
				
				case "clsd_cat_id":
					$cat_id=$cat;
					$cl="clsd_cat_id";				
				break;
			}	
	}
	else if($cat_id!=0){
					$cl="clsd_cat_id";	
	}
	else if($subcat_id!=0){
					$cl="clsd_subcat_id";	
	}
	else if($sub_subcat_id!=0){
					$cl="clsd_sub_subcat_id";
	}	
	
	$stateId = intval($_REQUEST['classi_state']);
	$cityId = intval($_REQUEST['classi_city']);
	$ad_type =strip_tags(trim(secureValue($_REQUEST['offer_type'])));
	$user_type =strip_tags(trim(secureValue($_REQUEST['user_type'])));
	$ad_key =strip_tags(trim(secureValue($_REQUEST['ad_id'])));
	
$cat_name=get_catinfo($cat,'cat_name');
$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_category','cat_id',$cat);
	
$state_name=Get_statename($stateId);
$city_name=Get_cityname($cityId);

$arr=list($meta_titles,$meta_desc,$meta_keywords)=get_meta_details('tbl_category','cat_id',$cat);
$meta_titles=$state_name." ".$city_name." ".$meta_titles;
$meta_desc=$state_name." ".$city_name." ".$meta_desc;
$meta_keywords=$state_name." ".$city_name." ".$meta_keywords;

require_once("header.inc.php");
	
	$picture=secureValue(@$_REQUEST['picture']);
	
	//echo "prix";
    $fromprix = intval(secureValue($_REQUEST['prixmin']));
	$toprix = intval(secureValue($_REQUEST['prixmax']));
	$fromprix=trim($fromprix);
	$toprix=trim($toprix);
	//echo "<br>";

	//echo "annee";
    $fromannee = intval(secureValue($_REQUEST['anneemin']));
	$toannee = intval(secureValue($_REQUEST['anneemax']));
	$fromannee=trim($fromannee);
	$toannee=trim($toannee);
	//echo "<br>";
		
	//echo "km";
    $fromkm = intval(secureValue($_REQUEST['kmmin']));
	$tokm = intval(secureValue($_REQUEST['kmmax']));
	$fromkm=trim($fromkm);
	$tokm=trim($tokm);
	//echo "<br>";
	
	//echo "energie";
	$energy=secureValue(@$_REQUEST['energy']);
	//echo "<br>";
	
	//echo "type vehicule";
	$Type_vehicule=secureValue(@$_REQUEST['Type_vehicule']);
	//echo "<br>";
	
	//echo "type camion";
	$type_camion=secureValue(@$_REQUEST['type_camion']);
	//echo "<br>";
	
	//echo "Type de bateau";
	$type_bateau=secureValue(@$_REQUEST['type_bateau']);
	//echo "<br>";
	
	//echo "type de bien";
	$typebien=secureValue(@$_REQUEST['typebien']);
	//echo "<br>";
	
	//echo "type Pays";
	$typePays=secureValue(@$_REQUEST['Pays']);
	//echo "<br>";
	
	//echo "type Pays";
	$typeVille=secureValue(@$_REQUEST['Ville']);
	//echo "<br>";
	
	//echo "type Pays";
	$typevilledestination=secureValue(@$_REQUEST['villedestination']);
	//echo "<br>";
	
	//echo "type Pays";
	$typedu=secureValue(@$_REQUEST['du']);
	//echo "<br>";
	
	//echo "type Pays";
	$fraissiege=secureValue(@$_REQUEST['fraissiege']);
	//echo "<br>";
	
	//echo "type de bien";
	$typeconstructible=secureValue(@$_REQUEST['constructible']);
	//echo "<br>";
	
	//echo "Situation";
	$typesituation=secureValue(@$_REQUEST['Situation']);
	//echo "<br>";
	
	//echo "type Type";
	$typeType=secureValue(@$_REQUEST['Type']);
	//echo "<br>";
	
	//echo "type ventelocation";
	$typeventelocation=secureValue(@$_REQUEST['ventelocation']);
	//echo "<br>";
	
	//echo "type contrat";
	$typecontrat=secureValue(@$_REQUEST['contrat']);
	//echo "<br>";
	
	//echo "type formation";
	$typeformation=secureValue(@$_REQUEST['formation']);
	//echo "<br>";
	
	//echo "type experience";
	$typeexperience=secureValue(@$_REQUEST['experience']);
	//echo "<br>";
	
	//echo "type Mobilite";
	$typeMobilite=secureValue(@$_REQUEST['Mobilite']);
	//echo "<br>";
	
	//echo "type emploi";
	$typeemploi=secureValue(@$_REQUEST['emploi']);
	$typetypeemploi=secureValue(@$_REQUEST['typeemploi']);
	//echo "<br>";
	
	//echo "type autretache";
	$typeautretache=secureValue(@$_REQUEST['autretache']);
	//echo "<br>";
	
	//echo "type placesdispo";
	$typeplacesdispo=secureValue(@$_REQUEST['placesdispo']);
	//echo "<br>";
	
	//echo "cylindre";
    $fromcylindree = intval(secureValue($_REQUEST['cylindreemin']));
	$tocylindree = intval(secureValue($_REQUEST['cylindreemax']));
	$fromcylindree=trim($fromcylindree);
	$tocylindree=trim($tocylindree);
	//echo "<br>";
	
	//echo "longueur";
    $fromlongueur = intval(secureValue($_REQUEST['longueurmin']));
	$tolongueur = intval(secureValue($_REQUEST['longueurmax']));
	$fromlongueur=trim($fromlongueur);
	$tolongueur=trim($tolongueur);
	//echo "<br>";
	
	//echo "piece";
    $frompiece = intval(secureValue($_REQUEST['piecemin']));
	$topiece = intval(secureValue($_REQUEST['piecemax']));
	$frompiece=trim($frompiece);
	$topiece=trim($topiece);
	//echo "<br>";
       
    $fromsurface = intval(secureValue($_REQUEST['surfacemin']));
	$tosurface = intval(secureValue($_REQUEST['surfacemax']));
	$fromsurface=trim($fromsurface);
	$tosurface=trim($tosurface);
	
    $fromchambre = intval(secureValue($_REQUEST['Nbrechambresmin']));
	$tochambre = intval(secureValue($_REQUEST['Nbrechambresmax']));
	$fromchambre=trim($fromchambre);
	$tochambre=trim($tochambre);
	
	//echo "age";
    $fromage = intval(secureValue($_REQUEST['agemin']));
	$toage = intval(secureValue($_REQUEST['agemax']));
	$fromage=trim($fromage);
	$toage=trim($toage);
	//echo "<br>";

 /**** Save keywords  search by  visiters  ******/
if($keyword!="" && $keyID==""){
	if(chk_keyword_exits($keyword)==0){     
		$sql_save_search="INSERT INTO `tbl_searched_keyword` SET `cat_id`='$cat_id',
		`keyword` = '$keyword',
		`ipaddress` = '$_SERVER[REMOTE_ADDR]',
		`date` = '".MYSQL_DATE_TIME."',
		`status` = 'Y' " ;
		db_query($sql_save_search);
	}
}
/**** End  Save keywords  search by  visiters  ****/

$cat=($sub_subcat_id!="")? $sub_subcat_id:
		(
			($subcat_id!="")? $subcat_id :
			$cat_id
		);

$types = array();

$mots = explode(" ", $keyword);
foreach($mots as $valeur)
{
	$types[]=($keyword!="") ? " AND (`classified_title` LIKE '%{$valeur}%' OR`classified_desc` LIKE '%{$valeur}%')" : " ";	
}

//$types[]=($keyword!="") ? " AND (`classified_title` LIKE '%{$keyword}%' OR`classified_desc` LIKE '%{$keyword}%')" : " ";	
$types[] = ($cat_id!="")? " AND tbl_classified.`clsd_cat_id`=$cat_id" : "";
$types[] = ($subcat_id!="")? " AND tbl_classified.`clsd_subcat_id`= $subcat_id" : "";
$types[] = ($sub_subcat_id!="")? " AND tbl_classified.`clsd_sub_subcat_id`=$sub_subcat_id" : "";
$types[] = ($stateId!="")? " AND `classified_poster_state` = $stateId" : "";
$types[] = ($cityId!="")? " AND `classified_city_id`='$cityId'" : "";
$types[] = ($fromprix && $toprix==0)? " AND `classified_price_option` > $fromprix" : 
			(
				($fromprix==0 && $toprix)? " AND `classified_price_option` < $toprix"
					:(
						($fromprix && $toprix)? " AND `classified_price_option` BETWEEN $fromprix AND $toprix" : ""
					)
			);
$types[] = ($ad_type!="")? " AND `classified_type`='$ad_type'" : "";
//$types[] = ($ad_key!="")? " AND `classified_key`='$ad_key' " : "";			


$typesannee = ($fromannee && $toannee==0)? " AND CAST(c1.`other_value` AS DECIMAL( 10, 0 ) ) > '$fromannee'" : 
			(
				($fromannee==0 && $toannee)? " AND CAST(c1.`other_value` AS DECIMAL( 10, 0 ) ) < '$toannee'"
					:(
						($fromannee && $toannee)? " AND CAST(c1.`other_value` AS DECIMAL( 10, 0 ) ) BETWEEN '$fromannee' AND '$toannee'" : ""
					)
			);

$typeskm = ($fromkm && $tokm==0)? " AND CAST(c2.`other_value` AS DECIMAL( 10, 0 ) ) > '$fromkm'" : 
			(
				($fromkm==0 && $tokm)? " AND CAST(c2.`other_value` AS DECIMAL( 10, 0 ) ) < '$tokm'"
					:(
						($fromkm && $tokm)? " AND CAST(c2.`other_value` AS DECIMAL( 10, 0 ) ) BETWEEN '$fromkm' AND '$tokm'" : ""
					)
			);

$typescylindree = ($fromcylindree && $tocylindree==0)? " AND CAST(c5.`other_value` AS DECIMAL( 10, 0 ) ) > $fromcylindree" : 
			(
				($fromcylindree==0 && $tocylindree)? " AND CAST(c5.`other_value` AS DECIMAL( 10, 0 ) ) < $tocylindree"
					:(
						($fromcylindree && $tocylindree)? " AND CAST(c5.`other_value` AS DECIMAL( 10, 0 ) ) BETWEEN $fromcylindree AND $tocylindree" : ""
					)
			);

$typeslongueur = ($fromlongueur && $tolongueur==0)? " AND CAST(c5.`other_value` AS DECIMAL( 10, 2 ) ) > $fromlongueur" : 
			(
				($fromlongueur==0 && $tolongueur)? " AND CAST(c5.`other_value` AS DECIMAL( 10, 2 ) ) < $tolongueur"
					:(
						($fromlongueur && $tolongueur)? " AND CAST(c5.`other_value` AS DECIMAL( 10, 2 ) ) BETWEEN $fromlongueur AND $tolongueur" : ""
					)
			);

$typesage = ($fromage && $toage==0)? " AND CAST(c5.`other_value` AS DECIMAL( 3, 0 ) ) > $fromage" : 
			(
				($fromage==0 && $toage)? " AND CAST(c5.`other_value` AS DECIMAL( 3, 0 ) ) < $toage"
					:(
						($fromage && $toage)? " AND CAST(c5.`other_value` AS DECIMAL( 2, 0 ) ) BETWEEN $fromage AND $toage" : ""
					)
			);

$typespiece = ($frompiece && $topiece==0)? " AND CAST(v1.`val_nom` AS DECIMAL( 2, 0 ) ) > '$frompiece'" : 
			(
				($frompiece==0 && $topiece)? " AND CAST(v1.`val_nom` AS DECIMAL( 2, 0 ) ) < '$topiece'"
					:(
						($frompiece && $topiece)? " AND CAST(v1.`val_nom` AS DECIMAL( 2, 0 ) ) BETWEEN '$frompiece' AND '$topiece'" : ""
					)
			);

$typessurface = ($fromsurface && $tosurface==0)? " AND CAST(c5.`other_value` AS DECIMAL( 10, 2 ) ) > '$fromsurface'" : 
			(
				($fromsurface==0 && $tosurface)? " AND CAST(c5.`other_value` AS DECIMAL( 10, 2 ) ) < '$tosurface'"
					:(
						($fromsurface && $tosurface)? " AND CAST(c5.`other_value` AS DECIMAL( 10, 2 ) ) BETWEEN '$fromsurface' AND '$tosurface'" : ""
					)
			);
			

$typeschambre = ($fromchambre && $tochambre==0)? " AND CAST(v1.`val_nom` AS DECIMAL( 2, 0 ) ) > '$fromchambre'" : 
			(
				($fromchambre==0 && $tochambre)? " AND CAST(v1.`val_nom` AS DECIMAL( 2, 0 ) ) < '$tochambre'"
					:(
						($fromchambre && $tochambre)? " AND CAST(v1.`val_nom` AS DECIMAL( 2, 0 ) ) BETWEEN '$fromchambre' AND '$tochambre'" : ""
					)
			);
			
$types = array_filter($types,"removeEmpty");
$types=implode($types);


/*$sql="SELECT SQL_CALC_FOUND_ROWS *, NOW( ) as today,
						IF( TO_DAYS( `date_fin_republication` ) > TO_DAYS( NOW( ) ) 
							AND
							TO_DAYS(  `date_fin_premium` ) > TO_DAYS( NOW( ) ) ,
							'1',
								IF( TO_DAYS(  `date_fin_premium` ) > TO_DAYS( NOW( ) ) ,
								'2',
									IF( TO_DAYS(  `date_fin_republication` ) > TO_DAYS( NOW( ) ) ,
									'3',
									'4' ) ) ) AS trie  
										FROM tbl_classified";
*/

$dtjour= date("Y-m-d");
					
$sql="SELECT SQL_CALC_FOUND_ROWS *,
			IF( DATE_FORMAT(`date_fin_republication`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d')
				AND
				DATE_FORMAT(`date_fin_premium`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d') ,
				'1',
					IF( DATE_FORMAT(`date_fin_premium`, '%Y-%m-%d') < DATE_FORMAT('".$dtjour."', '%Y-%m-%d') ,
					'2',
						IF( DATE_FORMAT(`date_fin_republication`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d') ,
						'3',
						'4' ) ) ) AS trie  
							FROM tbl_classified";
									//, tbl_option_cat, tbl_classif_option, tbl_classified_other
//$sql=($fromannee==0 && $toannee==0 && $fromkm==0 && $tokm==0)? " FROM tbl_classified" : " FROM tbl_classified, tbl_option_cat, tbl_classified_other";


$sql = (empty($user_type))? $sql : $sql."  
										
										INNER JOIN tbl_member as member
											ON tbl_classified.mem_id=member.mem_id 
											AND member.type='$user_type' 
											AND classified_status='Active'
											
											$types";


	$sql=($fromannee==0 && $toannee==0)? $sql : $sql."  
										
										INNER JOIN tbl_option_cat as t1
											ON tbl_classified.$cl=t1.cat_id 
											AND t1.option_nom='Ann&eacute;e' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c1
										 	ON tbl_classified.classified_id=c1.classifief_id
											AND t1.option_id=c1.option_id
											$typesannee";
//echo $fromkm;
//echo $tokm;
	$sql=($fromkm==0 && $tokm==0)? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t2
											ON tbl_classified.$cl=t2.cat_id 
											AND t2.option_nom='Kilom&eacute;trage' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c2
										 	ON tbl_classified.classified_id=c2.classifief_id
											AND t2.option_id=c2.option_id
											$typeskm";
											
	$sql=($typePays=="")? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t2
											ON tbl_classified.$cl=t2.cat_id 
											AND t2.option_nom='Pays' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c2
										 	ON tbl_classified.classified_id=c2.classifief_id
											AND t2.option_id=c2.option_id
											 AND c2.`other_value` LIKE '%{$typePays}%'";
											
	$sql=($typeVille=="")? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Ville' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c3
										 	ON tbl_classified.classified_id=c3.classifief_id
											AND t3.option_id=c3.option_id
											 AND c3.`other_value` LIKE '%{$typeVille}%'";
											
	$sql=($typevilledestination=="")? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t30
											ON tbl_classified.$cl=t30.cat_id 
											AND t30.option_nom='Ville de destination' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c30
										 	ON tbl_classified.classified_id=c30.classifief_id
											AND t30.option_id=c30.option_id
											 AND c30.`other_value` LIKE '%{$typevilledestination}%'";
											
	$sql=($typedu=="")? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t31
											ON tbl_classified.$cl=t31.cat_id 
											AND t31.option_nom='Du' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c31
										 	ON tbl_classified.classified_id=c31.classifief_id
											AND t31.option_id=c31.option_id
											 AND c31.`other_value` LIKE '%{$typedu}%'";
											
	$sql=($typefraissiege=="")? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t32
											ON tbl_classified.$cl=t32.cat_id 
											AND t32.option_nom='Partage des frais / si&egrave;ge' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c32
										 	ON tbl_classified.classified_id=c32.classifief_id
											AND t32.option_id=c32.option_id
											 AND c32.`other_value` = '$typefraissiege'";

	$sql=($frompiece==0 && $topiece==0)? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Nbre de pi&egrave;ces' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c2
										 	ON c2.option_id=t3.option_id
											AND tbl_classified.classified_id=c2.classif_id

										 INNER JOIN tbl_value_option as v1
										 	ON v1.val_id=c2.val_id
											$typespiece";
	
	$sql=($energy=="")? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Energie' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$energy";
											
	$sql=($Type_vehicule=="")? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Type de v&eacute;hicule' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$Type_vehicule";
											
	$sql=($type_camion=="")? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Type de camion' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$type_camion";
											
	$sql=($type_bateau=="")? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Type de bateau' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$type_bateau";
											
	$sql=($typebien=="")? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t4
											ON tbl_classified.$cl=t4.cat_id 
											AND t4.option_nom='Type de bien' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c4
										 	ON c4.option_id=t4.option_id
											AND tbl_classified.classified_id=c4.classif_id
											AND c4.val_id=$typebien";
											
	$sql=($typeconstructible=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Constructible' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typeconstructible";
											
	$sql=($typesituation=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Situation' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typesituation";
											
	$sql=($typeType=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Type' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typeType";
											
	$sql=($typeventelocation=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Vente/Location' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typeventelocation";
											
	$sql=($typecontrat=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Type de contrat' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typecontrat";
											
	$sql=($typeformation=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Niveau de formation' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typeformation";
											
	$sql=($typeexperience=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Niveau d&#039;exp&eacute;rience' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typeexperience";
											
	$sql=($typeMobilite=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Mobilit&eacute;' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typeMobilite";
											
	$sql=($typeemploi=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Type d&#039;emploi' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typeemploi";
											
	$sql=($typetypeemploi=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Type d&#039;emploi' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typetypeemploi";
											
	$sql=($typeautretache=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Autres t&acirc;ches' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typeautretache";
											
	$sql=($typeplacesdispo=="")? $sql : $sql."
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Places disponibles' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c3
										 	ON c3.option_id=t3.option_id
											AND tbl_classified.classified_id=c3.classif_id
											AND c3.val_id=$typeplacesdispo";

	$sql=($fromcylindree==0 && $tocylindree==0)? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t4
											ON tbl_classified.$cl=t4.cat_id 
											AND t4.option_nom='Cylindr&eacute;e' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c5
										 	ON tbl_classified.classified_id=c5.classifief_id
											$typescylindree";

	$sql=($fromlongueur==0 && $tolongueur==0)? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t4
											ON tbl_classified.$cl=t4.cat_id 
											AND t4.option_nom='Longueur' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c5
										 	ON tbl_classified.classified_id=c5.classifief_id
											$typeslongueur";

	$sql=($fromage==0 && $toage==0)? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t4
											ON tbl_classified.$cl=t4.cat_id 
											AND t4.option_nom='Mon &acirc;ge' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c5
										 	ON tbl_classified.classified_id=c5.classifief_id
											$typesage";

	$sql=($fromsurface==0 && $tosurface==0)? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t4
											ON tbl_classified.$cl=t4.cat_id 
											AND t4.option_nom='Surface' 
											AND classified_status='Active'
											
											$types
										 INNER JOIN tbl_classified_other as c5
										 	ON tbl_classified.classified_id=c5.classifief_id
											$typessurface";

	$sql=($fromchambre==0 && $tochambre==0)? $sql : $sql."  										
										INNER JOIN tbl_option_cat as t3
											ON tbl_classified.$cl=t3.cat_id 
											AND t3.option_nom='Nbre de chambres' 
											AND classified_status='Active'

											$types

										 INNER JOIN tbl_classif_option as c2
										 	ON c2.option_id=t3.option_id
											AND tbl_classified.classified_id=c2.classif_id

										 INNER JOIN tbl_value_option as v1
										 	ON v1.val_id=c2.val_id
											$typeschambre";
	
	$sql=($picture=='')? $sql : $sql." INNER JOIN tbl_classified_image as tblimage
											ON tblimage.clsd_id=tbl_classified.classified_id";
											
	$sql.=($fromannee==0 && $toannee==0 && $fromkm==0 && $tokm==0 && $energy==""  && $fromcylindree==0 && $tocylindree==0 && $Type_vehicule=="" && $type_camion=="" && $fromlongueur==0 && $tolongueur==0 && $frompiece==0 && $topiece==0  && $fromssurface==0 && $tossurface==0 && $typeconstructible=="" && $typesituation=="" && $typeType=="" && $ventelocation=="" && $fromchambre==0 && $tochambre==0 && $typePays=="" && $typeVille=="" && $typeventelocation=="" && $typecontrat=="" && $typeformation=="" && $typeexperience=="" && $typeMobilite=="" && $typeemploi=="" && $typetypeemploi=="" && $typeautretache=="" && $typevilledestination=="")? " 
											WHERE classified_status='Active'
											
											$types":"";
	
	$sql.=" GROUP BY tbl_classified.`classified_id`";
	
	if($prix!=""){
		$sql.=" ORDER BY tbl_classified.classified_price_option $prix LIMIT $start, $pagesize";
	}
	else if($datepub!=""){
		$sql.=" ORDER BY tbl_classified.classified_post_date $datepub LIMIT $start, $pagesize";
	}
	else{ /*  , `date_fin_premium` DESC */
		$sql.=" ORDER BY trie ASC, `classified_update_date` DESC LIMIT $start, $pagesize";
	}

	//

	//echo "<pre>".$sql."</pre>";
	$rs_classi=db_query($sql);

	$res_classi = mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
	$reccnt=$res_classi['total'];
?>

<div class="grid_3">
    <br />
	<div>
		<?php
            //--------------------Banner Advertise-----------
            $cat_Arr=main_cat_array();
            if($_REQUEST[subcatId]!=""){
                //$main_catId=get_catinfo(get_catinfo(intval($_REQUEST[subcatId]),'cat_parent'),'cat_parent');
                $main_catId=intval($_REQUEST[subcatId]);
            }
            else if($_REQUEST[subcatId1]!=""){
                //$main_catId=get_catinfo(intval($_REQUEST[subcatId1]),'cat_parent');
                $main_catId=intval($_REQUEST[subcatId1]);
            }
            else if($_REQUEST[cat]!=""){
                $main_catId=intval($_REQUEST[cat]);
            }
			
            if($main_catId!="" && $main_catId>0){?>
                <div style="padding:5px;">
                    <?php
                    echo manage_banner_requests($main_catId,"Classified Listing Left");
                    ?>
                </div>
            <?php
            }			 
        ?>
    </div>
    
    <br />
     <?php session_start(); echo $link_left;?>
    
</div>

<div class="grid_13" style="background-color:#FFFFFF">

		<?php
            $sql_cat=db_query("select * from tbl_state where state_status ='Active' AND state_id='".$stateId."'  order by state_order");	 
            $rw=mysql_fetch_array($sql_cat);
            
            if(!empty($cat_id)){
                echo front_navigation($cat_id);	
            }
            else if(!empty($subcat_id)){
                echo front_navigation('',$subcat_id);
            }		 
            else if(!empty($sub_subcat_id)){		 
                echo front_navigation('','',$sub_subcat_id);
            }
            else if(!empty($stateId)){
                echo front_navigation('','','','',$stateId);
            }         
        ?>
    
	<div class="">
    	<?php echo $link_center=get_config_setting(21);?>
    </div>
    

    <!--<div class="p7">-->
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div> <!--class="panel-heading">-->
                    <?php include("liste-cat.php"); ?>
            </div>
            <div class="panel-body">
                <?php
				/*
                if($cat_id==0 && $subcat_id==0 && $sub_subcat_id==0 && $stateId==0){
                ?>
                	<div class="grid_16 b" >
                        Il n'y a pas de résultats correspondants à votre recherche
                    </div>
                <?php
                }
                else{
					*/
					if($start < 30){
					$premium_query = "SELECT * from tbl_classified where DATE_FORMAT(`date_fin_premium`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d') and classified_poster_state = $stateId";

					if(!empty($_REQUEST['cat'])){
						$premium_query .= " and clsd_cat_id = ".$_REQUEST['cat']." order by date_fin_premium ";
					}

					$premium_annonces = db_query($premium_query);

					while($premium_result = mysql_fetch_array($premium_annonces)){
                    ?>
                    <div class="" >
                        <?php   // echo $premium_query;?>	
                        <?php  // require_once("google-ads.php"); ?>		 
                        <?php // include("paging.inc.php"); ?>
						<div class="chapo" style="background-color:<?php echo $AnnonceCouleur;?>"
                                onmouseout="this.style.backgroundColor='<?php echo $AnnonceCouleur;?>'"
                                onclick="document.location='<?php echo $html_link;?>';">
                                <table width="100%">
                                    <tr>
                                        <td valign="top" align="center" style="width:95px;">
                                        
                                            <div style="padding:10px;">
                                                <div style="text-align:center;width:95px;">
                                                    <?php
                                                    echo  '<span class="premium">À la une</span>';
													?>
													<?php
                                                    if($im_small!="" ) {
                                                        echo "<a href='".$html_link."' title='".$alt."'>".$im_small."</a>";
                                                    }else{?>
                                                        <a href="<?php echo $html_link;?>">
                                                        <img src="<?php echo "mobile/uploaded_files/cat_img/".$premium_result['clsd_cat_id'].".png";?>" 
                                                        		border="0" width="80" height="80" class="border-img"/>
                                                        </a> 
                                                    <?php
                                                    }
                                                    echo "<label class='photo-num'>".getNumberPhoto($premium_result['classified_id'])."</label>";
                                                    ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td valign="top">
                                                <div class="mt10 b">
                                                    <a href="<?php echo $html_link;?>" class="user_cl"  
                                                        style="font-size:14px; color:<?php echo $arr_font['title_font_color']?>; text-decoration:none;">
                                                        <strong>
                                                            <?php echo strip_tags(truncateText($premium_result['classified_title'],80,' ','...',true));?>
                                                        </strong>
                                                        
                                                        <?php
														$date_comp=date('y-m-d h:i:s', strtotime('+1 days'));
                                                        if(strtotime($date_comp) < strtotime($premium_result[date_fin_urgent]))
                                                        {
                                                            ?>
                                                            <span class="kiwii-label-badge-urgent">Urgent</span>
                                                            <?php
                                                        }?>
                                                    </a>
                                                </div>
                                        
                                                <div class="mt10">
                                                <?php echo nl2br(strip_tags(truncateText($premium_result['classified_desc'],200,' ','...',true)));?>
                                                </div>                 
                                        </td>
                                        <td valign="top" align="center" style="width:150px;">
                                            <div  class="mt10">
                                                    <?php
                                                    $date_affichee=(strtotime(MYSQL_DATE_TIME) <= strtotime($premium_result[date_fin_republication])) ? MYSQL_DATE_TIME : $premium_result[classified_post_date];
                                                    ?>
                                                    
                                                    <p class="b"><?php echo front_date_format($date_affichee);?></p>
                                                    <br />
                                                    <p>
                                                        <?php
                                                        if($premium_result['classified_price_option'] !="") {?>
                                                            <strong>Prix: </strong>
                                                            <font color="<?php echo $arr_font['price_font_color'];?>">
                                                            <?php echo $premium_result['classified_price_option'];?>
                                                            </font>
                                                            <strong><?php echo $link_curr;?></strong>
                                                        <?php  
                                                        }else{ ?>
                                                            <strong><?php echo $premium_result['offer'];?></strong>
                                                        <?php
                                                        }
                                                        ?>
                                                    </p>
                                                    
                                                    <p class="green-heading">
                                                        <?php echo Rec_display_formate($city['city_name']);?>
                                                    </p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                    </div>

                    <?php
					}
				}
                    if($reccnt > 0 ) {
                    ?>                  
                        
                    <?php
                        $count=0;
                        while($rw=mysql_fetch_array($rs_classi)){ 
                            $count++;
                            //$bg=($count%2==0) ? "mt10" : "";
                            $city=getResult('tbl_city',"WHERE city_id=$rw[classified_city_id]");
                            $state=getResult('tbl_state',"WHERE state_id=$rw[classified_poster_state]");
                            
                            $contact_info=($rw[classified_price_option] !="") ? 
                                        "<strong>Prix: $link_curr: </strong> $rw[classified_price_option]" : 
                                        "<strong>$rw[offer]</strong>";
                                        
                            $sql_img="select * from tbl_classified_image where clsd_id=$rw[classified_id] and img_status='Y'";
                            $sql_img_set=db_query($sql_img);
                                
                            if(mysql_num_rows($sql_img_set) > 0 ) { 
                                $res1=mysql_fetch_array($sql_img_set);          
                                $file_sm="mobile/uploaded_files/classified_img/".$res1[cls_img_file];	
                                $file_sm_root="mobile/uploaded_files/classified_img/".$res1[cls_img_file]; 
                                
                                if($res1[cls_img_file]!="" && file_exists($file_sm_root) ){
                                /*
                                    $file_path_sm	=	 show_thumb($file_sm,"150","150","width");
                                    $sz=getimagesize($file_path_sm);
								*/
                                    $width=95;   //($sz[0]>=80) ?  '80' :  $sz[0];
                                    $height=95; //($sz[1]>=80) ? '80'  : $sz[1];
                                    $im_small='<img src="'.$file_sm.'" alt="'.$alt.'" border="0" width="'.$width.'" height="'.$height.'" class="border-img"/>'; 
                                }else{
                                    $im_small ='<img src="mobile/uploaded_files/cat_img/'.$rw[clsd_cat_id].'.png" alt="'.$alt.'" border="0" width="95" height="95" class="border-img"/>';
                                }
                            }else{
                                $im_small ='<img src="mobile/uploaded_files/cat_img/'.$rw[clsd_cat_id].'.png" alt="'.$alt.'" border="0" width="95" height="95" class="border-img"/>';  
                            }
                    
                            $html_link="classified-details.php?clsId=".$rw[classified_id];
                        
                            $date_comp=date('y-m-d h:i:s', strtotime('+1 days'));
                            $AnnonceCouleur=(strtotime($date_comp) < strtotime($rw[date_fin_couleur])) ? '#FFCC99' : '';
                            
                            $backgroundcolor=($AnnonceCouleur=='') ? '#c5e099': $AnnonceCouleur; ?>
                
                            <div class="chapo" style="background-color:<?php echo $AnnonceCouleur;?>"
                                onmouseout="this.style.backgroundColor='<?php echo $AnnonceCouleur;?>'"
                                onclick="document.location='<?php echo $html_link;?>';">
                                <table width="100%">
                                    <tr>
                                        <td valign="top" align="center" style="width:95px;">
                                        
                                            <div style="padding:10px;">
                                                <div style="text-align:center;width:95px;">
													<?php
                                                    if($im_small!="" ) {
                                                        echo "<a href='".$html_link."' title='".$alt."'>".$im_small."</a>";
                                                    }else{?>
                                                        <a href="<?php echo $html_link;?>">
                                                        <img src="<?php echo "mobile/uploaded_files/cat_img/".$rw['clsd_cat_id'].".png";?>" 
                                                        		border="0" width="80" height="80" class="border-img"/>
                                                        </a> 
                                                    <?php
                                                    }
                                                    echo "<label class='photo-num'>".getNumberPhoto($rw['classified_id'])."</label>";
                                                    ?>
                                                </div>
                                            </div>
                                        </td>
                                        <td valign="top">
                                                <div class="mt10 b">
                                                    <a href="<?php echo $html_link;?>" class="user_cl"  
                                                        style="font-size:14px; color:<?php echo $arr_font['title_font_color']?>; text-decoration:none;">
                                                        <strong>
                                                            <?php echo strip_tags(truncateText($rw['classified_title'],80,' ','...',true));?>
                                                        </strong>
                                                        
                                                        <?php
                                                        if(strtotime($date_comp) < strtotime($rw[date_fin_urgent]))
                                                        {
                                                            ?>
                                                            <span class="kiwii-label-badge-urgent">Urgent</span>
                                                            <?php
                                                        }?>
                                                    </a>
                                                </div>
                                        
                                                <div class="mt10">
                                                <?php echo nl2br(strip_tags(truncateText($rw['classified_desc'],200,' ','...',true)));?>
                                                </div>                 
                                        </td>
                                        <td valign="top" align="center" style="width:150px;">
                                            <div  class="mt10">
                                                    <?php
                                                    $date_affichee=(strtotime(MYSQL_DATE_TIME) <= strtotime($rw[date_fin_republication])) ? MYSQL_DATE_TIME : $rw[classified_post_date];
                                                    ?>
                                                    
                                                    <p class="b"><?php echo front_date_format($date_affichee);?></p>
                                                    <br />
                                                    <p>
                                                        <?php
                                                        if($rw['classified_price_option'] !="") {?>
                                                            <strong>Prix: </strong>
                                                            <font color="<?php echo $arr_font['price_font_color'];?>">
                                                            <?php echo $rw['classified_price_option'];?>
                                                            </font>
                                                            <strong><?php echo $link_curr;?></strong>
                                                        <?php  
                                                        }else{ ?>
                                                            <strong><?php echo $rw['offer'];?></strong>
                                                        <?php
                                                        }
                                                        ?>
                                                    </p>
                                                    
                                                    <p class="green-heading">
                                                        <?php echo Rec_display_formate($city['city_name']);?>
                                                    </p>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        <?php
                        }
                        
                    ?>
                    
                    <?php
                    }else{
                    ?>
                        <div class="b">
                            Aucune annonce dans cette catégorie....
                        </div>
                <?php
                    } 
                    ?>
                            <div class="" >
                                <?php include("paging.inc.php");?>
                            </div>
                <?php
                //}
                ?>
                
            </div>
        </div>
    <!--</div>-->

</div>
<?php require_once("footer.inc.php"); ?>