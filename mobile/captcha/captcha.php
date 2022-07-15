<?php    
	session_start(); 
   //unset($_SESSION['captcha_spam']); 

   function randomString($len) { 
      function make_seed(){ 
         list($usec , $sec) = explode (' ', microtime()); 
         return (float) $sec + ((float) $usec * 100000); 
      } 
      srand(make_seed());  
      //Der String $possible enthält alle Zeichen, die verwendet werden sollen 
      $possible="0123456789"; 
      $str=""; 
      while(strlen($str)<$len) { 
        $str.=substr($possible,(rand()%(strlen($possible))),1); 
      } 
   return($str); 
   } 

   $text = randomString(5);  //Die Zahl bestimmt die Anzahl stellen 
   $_SESSION['captcha_spam'] = $text; 

header("Content-type: image/png");

$img = imagecreate (50,15) or die ("Problème de création GD");
$background_color = imagecolorallocate ($img, 255, 255, 255);
$ecriture_color = imagecolorallocate($img, 0, 0, 0);
imagestring ($img, 20, 4, 0, $_SESSION['captcha_spam'] , $ecriture_color);
imagepng($img); 
?> 