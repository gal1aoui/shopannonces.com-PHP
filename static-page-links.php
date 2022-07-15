<?php
if($pagename=="aboutus.php"){
 $link1='<span class="other-link-active">À propos de nous</span>';
}else{
 $link1= '<a href="aboutus.php">&Agrave; propos de nous</a>';
}
if($pagename=="faq.php"){
 $link2='<span class="other-link-active">FAQ</span>';
}else{
 $link2= '<a href="faq.php">FAQ</a>';
}
if($pagename=="contactus.php"){
 $link3='<span class="other-link-active">Contactez nous</span>';
}else{
 $link3= '<a href="contactus.php">Contactez nous</a>';
}
if($pagename=="privacy-policy.php"){
 $link4='<span class="other-link-active">Politique de confidentialité</span>';
}else{
 $link4= '<a href="privacy-policy.php">Politique de confidentialité</a>';
}
if($pagename=="terms-use.php"){
 $link5='<span class="other-link-active">Conditions d&rsquo;utilisation</span>';
}else{
 $link5= '<a href="terms-use.php">Conditions d&rsquo;utilisation</a>';
}
?>
<div style="width:202px;">
      <p><img src="images/left-box-top.jpg" alt=""/></p>
      <div class="bg-left-box">
        <div class="other-link">
          <p class="p3 cate-stripcolor wht-head">Information</p>
          <?php echo $link1;?>  <?php echo $link2;?> <?php echo $link3;?> <?php echo $link4;?> <?php echo $link5;?> </div>
      </div>
      <p><img src="images/left-box-bot.jpg" alt=""/></p>
    </div>