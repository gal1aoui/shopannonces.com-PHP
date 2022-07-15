<?php

/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');

/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';



function sendMail($email_to,$emailto_name,$email_subject,$email_body,$email_from,$reply_to,$html=true)
{
	include_once 'class.phpmailer.php';
	$mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	//$mail->IsSMTP(); // send via SMTP]
	$mail->IsMail(); // send via PHP mail function]
	$mail->Mailer   = 'mail'; 
	//$mail->Host   = ""; // SMTP servers
	$mail->From     = $email_from;
	$mail->FromName = $emailto_name;
	$mail->AddAddress($email_to,$emailto_name); 
	
	$mail->AddReplyTo($reply_to,$emailto_name);
	//$mail->WordWrap = 50;                              // set word wrap
	$mail->IsHTML($html);                               // send as HTML
	$mail->Subject  =  $email_subject;
	$mail->Body     =  $email_body;
	if(!$mail->Send())
	{
		return false;
	}
	else
	{
		return true; 
	}
}
/**********************************************************************************************************************************************/

// Création de l'objet Reader pour un fichier Excel 2007 
$objReader = new PHPExcel_Reader_Excel2007(); 
// Permet de ne récupérer que les valeurs des cellules sans les propriétés de style 
$objReader->setReadDataOnly(true); 
// Lecture du fichier. 
$objPHPExcel = $objReader->load("base.xlsx"); 

// Si on ignore le format du fichier, utiliser PHPExcel_IOFactory 
//$objPHPExcel = PHPExcel_IOFactory::load("base.xlsx");

$objPHPExcel->setActiveSheetIndex(0);

// Lecture du contenu de la cellule B2 
//echo $b2 = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(1, 2)->getValue();
$from = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 1)->getValue();
$realname = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 2)->getValue();
$subject = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 3)->getValue();
$message = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 4)->getValue();
$numemails = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, 5)->getValue();

$p=6;
$x=1;		
$nbreerreur=0;

echo "<br> Start Sending<br>";
while($to = $objPHPExcel->getActiveSheet()->getCellByColumnAndRow(0, $p)->getValue()){

	$msent = sendMail($to,$realname,$subject,$message,$from,$from,$html=true);

	
	$txtspamed = "Sended";
	
	if(!$msent){
	
		$txtspamed = "error";		
		$nbreerreur++;
	
	}
	
	print "$to $x / $numemails .......  $txtspamed <br>";
	
	flush();	
	
	if($nbreerreur==3000)
		exit;
		
	$p++;
	$x++;
}
echo "<br>End Sending<br>";
/**********************************************************************************************************************************************/
?>