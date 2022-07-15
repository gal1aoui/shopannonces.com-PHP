<?php


// references http://www.longtailvideo.com/support/forum/Modules/12661/External-PHP-with-FFmpeg-using-readfile-

// generate a preview image from an FLV file on-the-fly, or to save

// call with: ffmpeg_image.php?file=video.flv&time=00:00:05&browser=true

// call with: ffmpeg_image.php?file=video.flv&percent=75.3&browser=true

// no time defaults to "00:00:01" (one second), no browser defaults to "true"



$videofile = (isset($_GET['file'])) ? strval($_GET['file']) : 'C:\Users\ADNENE\Desktop\PC 18-05-2013\Alexandra Stan - Energy(Dj Cristi@no Video Edit).mp4';

$image = substr($videofile, 0, strlen($videofile) - 4);

$time = (isset($_GET['time'])) ? strval($_GET['time']) : '00:00:01';



// debug ("  File: ", $videofile);

// debug (" Image: ", $image);

// debug ("  Time: ", $time);



// check time format

if (!preg_match('/\d\d:\d\d:\d\d/', $time))

{

  $time = "00:00:00";

}



if (isset($_GET['percent']))

{

  $percent = $_GET['percent'];



// debug (" Percent: ", $percent);



  ob_start();

  exec("/usr/bin/ffmpeg -i \"". $videofile . "\" 2>&1");

  $duration = ob_get_contents();

  ob_end_clean();



  // debug ("Duration: ", $duration);



  preg_match('/Duration: (.*?),/', $duration, $matches);

  $duration = $matches[1];



// debug ("Duration: ", $duration);



  $duration_array = split(':', $duration);

  $duration = $duration_array[0] * 3600 + $duration_array[1] * 60 + $duration_array[2];

  $time = $duration * $percent / 100;



// debug (" Time: ", $time);



  $time = intval($time/3600) . ":" . intval(($time-(intval($time/3600)*3600))/60) . ":" . sprintf("%01.3f", ($time-(intval($time/60)*60)));



// debug (" Time: ", $time);



}



$browser = (isset($_GET['browser'])) ? strval($_GET['browser']) : 'true';



// debug (" Browser: ", $browser);



if ($browser == "true")

{

  header('Content-Type: image/png');

  exec("/usr/bin/ffmpeg -vcodec png -i \"" . $videofile . "\" -ss " . $time . " -vframes 1 -f image2 -");

//header('Content-Type: image/jpeg');

//exec("/usr/bin/ffmpeg -vcodec mjpeg -i \"" . $videofile . "\" -ss " . $time . " -vframes 1 -f image2 -");

}

else

{

  exec("/usr/bin/ffmpeg -vcodec png -i \"" . $videofile . "\" -ss " . $time . " -vframes 1 -f image2 \"" . $image . "\"%d.png");

//exec("/usr/bin/ffmpeg -vcodec mjpeg -i \"" . $videofile . "\" -ss " . $time . " -vframes 1 -f image2 \"" . $image . "\"%d.jpg");

}



?>