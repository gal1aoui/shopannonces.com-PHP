<?php
session_start();
header('Content-type: image/jpeg');
$width = 60;
$height = 25;

$my_image = imagecreatetruecolor($width, $height);

imagefill($my_image, 0, 0, 0xFFFFFF);

// add noise
for ($c = 0; $c < 40; $c++){
	$x = rand(0,$width-1);
	$y = rand(0,$height-1);
	imagesetpixel($my_image, $x, $y, 0x000000);
	}

$x = rand(1,10);
$y = rand(1,10);

$rand_string = rand(1000,9999);
imagestring($my_image, 5, $x, $y, $rand_string, 0x000000);
$_SESSION['rand_val']=$rand_string;
imagejpeg($my_image);
imagedestroy($my_image);
?>