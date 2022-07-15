<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$pagename=basename($_SERVER['PHP_SELF']);

$link_left=get_config_setting(19);
$link_center_details=get_config_setting(20);
$link_top=get_config_setting(18);
$link_footer=get_config_setting(16);
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap 101 Template</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="dist/css/bootstrap.min.css">
    
    <!-- Optional theme -->
    <link rel="stylesheet" href="dist/css/bootstrap-theme.min.css">
    
    <!-- Latest compiled and minified JavaScript -->
    <script src="dist/js/bootstrap.min.js"></script>
  </head>
  <body>
	<div class="container">
        <div class="col-md-4" style="background-color:#BF6F71;">
            <a href="index.php" class="link">
                <div class="logo">
                    <h1 class="slogo">mesannonces.site <br /><span style="font-size:12px;">Petites annonces gratuites</span></h1>
                </div>
            </a>
        </div>
        
        <div class="col-md-8" style="background-color:#398311;">
            <?php echo $link_top;?> salut, je suis la bannière.
        </div>
    </div>
  </body>
</html>