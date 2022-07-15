<?php
	
require_once("includes/main.inc.php");
require_once("front-functions.php");
$news_id=$_REQUEST['news_id'];
$sql_cat=db_query("select * from news WHERE news_id='$news_id'");
$rw=mysql_fetch_array($sql_cat);	
	$meta_titles=$rw['sujet_news'];
	$meta_desc=$rw['sujet_news'];
require_once("header.inc.php");
					
?>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
        <table border="0" align="center" cellpadding="0" cellspacing="0" width="100%" class="mt17 cate-border" style="background-color:#FFFFFF;">
        <tr>
	<td>
    	<style type="text/css">

.glossymenu{
	position: relative;
	padding: 0 0 0 34px;
	margin: 0 auto 0 auto;
	background: url(images/menug_bg.gif) repeat-x; /*tab background image path*/
	height: 46px;
	list-style: none;
}

.glossymenu li{
	float:left;
}

.glossymenu li a{
	float: left;
	display: block;
	color:#000;
	text-decoration: none;
	font-family: sans-serif;
	font-size: 13px;
	font-weight: bold;
	padding:0 0 0 16px; /*Padding to accomodate left tab image. Do not change*/
	height: 46px;
	line-height: 46px;
	text-align: center;
	cursor: pointer;	
}

.glossymenu li a b{
	float: left;
	display: block;
	padding: 0 24px 0 8px; /*Padding of menu items*/
}

.glossymenu li.current a, .glossymenu li a:hover{
	color: #fff;
	background: url(images/menug_hover_left.gif) no-repeat; /*left tab image path*/
	background-position: left;
}

.glossymenu li.current a b, .glossymenu li a:hover b{
	color: #fff;
	background: url(images/menug_hover_right.gif) no-repeat right top; /*right tab image path*/
}

</style>

<ul class="glossymenu">
	<li><a href="news.php"><b>A la une</b></a></li>
			<?php
                $sql_cat=db_query("select * from categories_news ORDER BY categ_news_id ASC");
				$pos=1;
                while($rw=mysql_fetch_array($sql_cat))
                {
					if($_REQUEST['cat_news_id']== $rw['categ_news_id'])
					$sel="class='current'";
					else
					$sel="";
					?>
					<li <?php echo $sel;?>><a href="news.php?cat_news_id=<?php echo $rw[categ_news_id]; ?>"><b><?php echo $rw[categ_news_name]; ?></b></a></li>
    		<?php
				}
			?>	
</ul>

    </td>
</tr>
<?php

$news_id=$_REQUEST['news_id'];
$sql_cat=db_query("select * from news WHERE news_id='$news_id'");
$rw=mysql_fetch_array($sql_cat);	
?>
                                    
              <tr>
                <td valign="top" style="padding:5px 5px 0 15px;">
                    <table border="0" cellpadding="2" cellspacing="0" width="100%">
                        <tr>
                            <td  class="main-heading">
                                <table width="100%" border="0">
                                <tr>
                                    <td>
                                        
                                                            <?php echo $rw['sujet_news'];?>
                                            
                                    </td>
                                    <td align="right">
                                        <h4 class="posted">
                                            Posté le:
                                            <?php echo $rw['date_news'];?>
                                        </h4>
                                    </td>
                                </tr>
                                </table>
                          </td>
                        </tr>
                        <tr>
                            <td style="padding-top:3px;">
                                    <table border="0" cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td width="18%" valign="top">
                                                <table border="0" align="center" cellpadding="5" cellspacing="0" class="box-head">
                                                    <tr align="center" valign="middle" height="220">
                                                        <td width="45%" align="center">
                                                            <?php
                                                            if($rw['video']!=''){
                                                                ?>
                                                            <img src="http://img.youtube.com/vi/<?php echo $rw['video'];?>/0.jpg" width="1" height="1" />
                                                            <iframe width="420" height="345"
                                                            src="http://www.youtube.com/embed/<?php echo $rw['video'];?>">
                                                            </iframe>
    <?php
                                                            }
                                                            else{
                                                                $news_id=$_REQUEST['news_id'];
                                                                $sql_images=db_query("select * from tbl_news_image WHERE news_id='$news_id'");
                                                                    
                                                                while($rw_images=mysql_fetch_array($sql_images)){
    
    $dimensions=getimagesize("uploaded_files/news_img/".$rw_images[news_img_file]);
    $largeur=$dimensions[0];
    $hauteur=$dimensions[1];
    
    $coef=$largeur/300;
    $height=$hauteur/$coef;																?>
    
                                                                <div id="gall_dis_area">
                                                             <img src="uploaded_files/news_img/<?php echo $rw_images['news_img_file'];?>" 
                                                                width="300" height="<?php echo $height;?>"
                                                                 onclick="document.getElementById('ima').style.visibility='visible';"
                                                                />
                                                                </div>
                                                                
    <div style=" 
    position: fixed;
                left: 20%;
                top: 30%;
                z-index:1;
                visibility:hidden;
                border: #000 solid 2px;
    "
                 id="ima"  onclick="this.style.visibility='hidden';" >
    
    <img src="uploaded_files/news_img/<?php echo $rw_images['news_img_file'];?>" name="image"  />
    </div>
                                                             <br />
                                                                <?php
                                                                }
                                                            }?>
                                                            
    
                                                        </td>
                                                     </tr>
                                                     <tr>
                                                        <td>
                                                            <?php
                                                                echo $left_news=get_config_setting(22);
                                                            ?>
                                                        </td>
                                                     </tr>
                                                </table>            
                                            </td>
                                            <td width="82%" valign="top" class="pl15">
                                           	<table>                
                                                <tr>
                                                <td align="center">  
                        <script type="text/javascript">var switchTo5x=true;</script>
                        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
                        <script type="text/javascript">stLight.options({publisher: "c39660c0-7c27-4a42-8e4b-b16c76975157", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
                        
                        
                        <span class='st_facebook_large' displayText='Facebook'></span>
                        <span class='st_twitter_large' displayText='Tweet'></span>
                        <span class='st_linkedin_large' displayText='LinkedIn'></span>
                        <span class='st_pinterest_large' displayText='Pinterest'></span>
                        <span class='st_email_large' displayText='Email'></span>
                        <span class='st_sharethis_large' displayText='ShareThis'></span>
                                                                </td>
                                                </tr>
                                                
                                                <tr>
                                                	<td>
                                                    <?php
                                                        if($rw[contenu_news]!=''){
                                                    ?>
                                                            <table width="100%" border="0" cellspacing="0" cellpadding="5" class="mt17 cate-border">
                                                                <tr class="bg-stripcolor">
                                                                    <td>
                                                                        <div class="mt17">
                                                                          <p><?php //echo nl2br($rw[contenu_news]);
                                                                            $cn=$rw[contenu_news];
                                                                            $nbrepoint=0;
                                                                            for($pcn=0;$pcn<strlen($cn);$pcn++){
                                                                                echo $cn[$pcn];
                                                                                if($cn[$pcn]==".")
                                                                                {
                                                                                    $nbrepoint++;
                                                                                    
                                                                                    if($nbrepoint==3 )
                                                                                    {																			
                                                                                        ?>
                                                                                        <br />
                                                                                        <br />
                                                                                        <?php
                                                                                        echo $link_center_details;
                                                                                        ?>
                                                                                        <br />
                                                                                        <br />
                                                                                        <?php
                                                                                    }
                                                                                }
                                                                                
                                                                            }
                                                                          ?></p>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            <?php
                                                        }?>
                                                	</td>
                                            	</tr>         
                                                <tr>
                                                <td align="center">  
                        <script type="text/javascript">var switchTo5x=true;</script>
                        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
                        <script type="text/javascript">stLight.options({publisher: "c39660c0-7c27-4a42-8e4b-b16c76975157", doNotHash: false, doNotCopy: false, hashAddressBar: false});</script>
                        
                        
                        <span class='st_facebook_large' displayText='Facebook'></span>
                        <span class='st_twitter_large' displayText='Tweet'></span>
                        <span class='st_linkedin_large' displayText='LinkedIn'></span>
                        <span class='st_pinterest_large' displayText='Pinterest'></span>
                        <span class='st_email_large' displayText='Email'></span>
                        <span class='st_sharethis_large' displayText='ShareThis'></span>
                                                                </td>
                                                </tr>
                                    	</table>
                            </td>
                        </tr>
                        <tr>
                                            <td colspan="2" align="center">
    <?php 
    /* Update visiter count*/
        $sql="select visite_news from news where  news_id='$news_id'";
        $vis=db_query($sql);
         
        $res_num=mysql_fetch_array($vis);
        $total_visit=$res_num[visite_news];
    
         
        $visites=$total_visit+1;
        $sql_visit="UPDATE news set visite_news=$visites where news_id='$news_id'";
        db_query($sql_visit);
    /* End Update visiter count */
    ?>
            <div style="text-align:center;">
            <b>Visite: <?php echo $visites; ?></b>
            </div>
                                            </td>
                                        </tr>
                        <tr>
    <table border="0">
    <tr>
        <td colspan="4" align="right" class="mt17 cate-border" >
            <h4 class="visited">Voir Aussi</h4>        
        </td>
    </tr>
        <tr>
        <td width="25%" class="mt17 cate-border" >
        <b>Divers:</b><br />
    <?php                                    
    $s_cat="select SQL_CALC_FOUND_ROWS *, LEFT(`contenu_news`,100) AS description_news 
    from news
    WHERE categ_id=11
    ORDER BY date_news DESC, news_id DESC LIMIT 0, 1";
    
    $sql_cat=db_query($s_cat);
    
    $res_classi = mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
    $reccnt=$res_classi['total'];
    
    $nbre=mysql_num_rows($sql_cat);
    if($nbre>0){
    while($rw=mysql_fetch_array($sql_cat))
    {
    ?>
    <a href="contenu_news.php?news_id=<?php echo $rw[news_id];?>" class="link">
    
    <?php
    $news_id=$_REQUEST['news_id'];
    $sql_images=db_query("select * from tbl_news_image WHERE news_id='$rw[news_id]'");
    
    $nbre_image=mysql_num_rows($sql_images);
    if($nbre_image>0){
    $rw_images=mysql_fetch_array($sql_images);
    
    $dimensions=getimagesize("uploaded_files/news_img/".$rw_images[news_img_file]);
    $largeur=$dimensions[0];
    $hauteur=$dimensions[1];
    
    $coef=$largeur/100;
    $height=$hauteur/$coef;
    
    ?>
    <img src="uploaded_files/news_img/<?php echo $rw_images[news_img_file];?>"
    width='100' height='<?php echo $height;?>' style="border-color:#ffffff; border-style:solid; border-radius:5px;"  />
    
    <?php
    }
    else{
    $dimensions=getimagesize("http://img.youtube.com/vi/$rw[video]/0.jpg");
    $largeur=$dimensions[0];
    $hauteur=$dimensions[1];
    
    $coef=$largeur/100;
    $height=$hauteur/$coef;
    
    ?>
    <img src="http://img.youtube.com/vi/<?php echo $rw['video'];?>/0.jpg" 
    width='100' height='<?php echo $height;?>' style="border-color:#ffffff; border-style:solid; border-radius:5px;"  />
    
    <?php
    }
    ?>    
    
    <br />
                    <b><?php echo $rw[sujet_news];?></b>
    <?php
    if($rw['description_news']!=''){
    ?>
    <div style="padding:3px; padding-left:6px; 
    border-left:4px solid #d0d0d0; 
    background-color:#f1f1f1; margin-left:0px; 
    font-style:italic;  height:<?php echo $height;?>px;">
    
    <?php echo $rw['description_news'];?>
    </div>
    
    </a>
    <?php
    }
    ?>
    <?php 		
    }
    }
    ?>
        </td>
        
        <td width="25%" class="mt17 cate-border" >
        
        <b>Sport:</b><br />
    <?php                                    
    $s_cat="select SQL_CALC_FOUND_ROWS *, LEFT(`contenu_news`,100) AS description_news 
    from news
    WHERE categ_id=10
    ORDER BY date_news DESC, news_id DESC LIMIT 0, 1";
    
    $sql_cat=db_query($s_cat);
    
    $res_classi = mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
    $reccnt=$res_classi['total'];
    
    $nbre=mysql_num_rows($sql_cat);
    if($nbre>0){
    while($rw=mysql_fetch_array($sql_cat))
    {
    ?>
    <a href="contenu_news.php?news_id=<?php echo $rw[news_id];?>" class="link">
    
    <?php
    $news_id=$_REQUEST['news_id'];
    $sql_images=db_query("select * from tbl_news_image WHERE news_id='$rw[news_id]'");
    
    $nbre_image=mysql_num_rows($sql_images);
    if($nbre_image>0){
    $rw_images=mysql_fetch_array($sql_images);
    
    $dimensions=getimagesize("uploaded_files/news_img/".$rw_images[news_img_file]);
    $largeur=$dimensions[0];
    $hauteur=$dimensions[1];
    
    $coef=$largeur/100;
    $height=$hauteur/$coef;
    
    ?>
    <img src="uploaded_files/news_img/<?php echo $rw_images[news_img_file];?>"
    width='100' height='<?php echo $height;?>' style="border-color:#ffffff; border-style:solid; border-radius:5px;"  />
    
    <?php
    }
    else{
    $dimensions=getimagesize("http://img.youtube.com/vi/$rw[video]/0.jpg");
    $largeur=$dimensions[0];
    $hauteur=$dimensions[1];
    
    $coef=$largeur/100;
    $height=$hauteur/$coef;
    
    ?>
    <img src="http://img.youtube.com/vi/<?php echo $rw['video'];?>/0.jpg" 
    width='100' height='<?php echo $height;?>' style="border-color:#ffffff; border-style:solid; border-radius:5px;"  />
    
    <?php
    }
    ?>    
    
    <br />
                    <b><?php echo $rw[sujet_news];?></b>
    <?php
    if($rw['description_news']!=''){
    ?>
    <div style="padding:3px; padding-left:6px; 
    border-left:4px solid #d0d0d0; 
    background-color:#f1f1f1; margin-left:0px; 
    font-style:italic;  height:<?php echo $height;?>px;">
    
    <?php echo $rw['description_news'];?>
    </div>
    </a>
    
    <?php
    }
    ?>
    <?php 		
    }
    }
    ?>
        </td>
        
        <td width="25%" class="mt17 cate-border" >
        
        <b>International:</b><br />
    <?php                                    
    $s_cat="select SQL_CALC_FOUND_ROWS *, LEFT(`contenu_news`,100) AS description_news 
    from news
    WHERE categ_id=9
    ORDER BY date_news DESC, news_id DESC LIMIT 0, 1";
    
    $sql_cat=db_query($s_cat);
    
    $res_classi = mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
    $reccnt=$res_classi['total'];
    
    $nbre=mysql_num_rows($sql_cat);
    if($nbre>0){
    while($rw=mysql_fetch_array($sql_cat))
    {
    ?>
    <a href="contenu_news.php?news_id=<?php echo $rw[news_id];?>" class="link">
    
    <?php
    $news_id=$_REQUEST['news_id'];
    $sql_images=db_query("select * from tbl_news_image WHERE news_id='$rw[news_id]'");
    
    $nbre_image=mysql_num_rows($sql_images);
    if($nbre_image>0){
    $rw_images=mysql_fetch_array($sql_images);
    
    $dimensions=getimagesize("uploaded_files/news_img/".$rw_images[news_img_file]);
    $largeur=$dimensions[0];
    $hauteur=$dimensions[1];
    
    $coef=$largeur/100;
    $height=$hauteur/$coef;
    
    ?>
    <img src="uploaded_files/news_img/<?php echo $rw_images[news_img_file];?>"
    width='100' height='<?php echo $height;?>' style="border-color:#ffffff; border-style:solid; border-radius:5px;"  />
    
    <?php
    }
    else{
    $dimensions=getimagesize("http://img.youtube.com/vi/$rw[video]/0.jpg");
    $largeur=$dimensions[0];
    $hauteur=$dimensions[1];
    
    $coef=$largeur/100;
    $height=$hauteur/$coef;
    
    ?>
    <img src="http://img.youtube.com/vi/<?php echo $rw['video'];?>/0.jpg" 
    width='100' height='<?php echo $height;?>' style="border-color:#ffffff; border-style:solid; border-radius:5px;"  />
    
    <?php
    }
    ?>    
    <br />
                    <b><?php echo $rw[sujet_news];?></b>
    <?php
    if($rw['description_news']!=''){
    ?>
    <div style="padding:3px; padding-left:6px; 
    border-left:4px solid #d0d0d0; 
    background-color:#f1f1f1; margin-left:0px; 
    font-style:italic;  height:<?php echo $height;?>px;">
    
    <?php echo $rw['description_news'];?>
    </div>
    
    </a>
    <?php
    }
    ?>
    <?php 		
    }
    }
    ?>
        </td>
        
        <td width="25%" class="mt17 cate-border" >
        
        <b>National:</b><br />
    <?php                                    
    $s_cat="select SQL_CALC_FOUND_ROWS *, LEFT(`contenu_news`,100) AS description_news 
    from news
    WHERE categ_id=8
    ORDER BY date_news DESC, news_id DESC LIMIT 0, 1";
    
    $sql_cat=db_query($s_cat);
    
    $res_classi = mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
    $reccnt=$res_classi['total'];
    
    $nbre=mysql_num_rows($sql_cat);
    if($nbre>0){
    while($rw=mysql_fetch_array($sql_cat))
    {
    ?>
    <a href="contenu_news.php?news_id=<?php echo $rw[news_id];?>" class="link">
    
    <?php
    $news_id=$_REQUEST['news_id'];
    $sql_images=db_query("select * from tbl_news_image WHERE news_id='$rw[news_id]'");
    
    $nbre_image=mysql_num_rows($sql_images);
    if($nbre_image>0){
    $rw_images=mysql_fetch_array($sql_images);
    
    $dimensions=getimagesize("uploaded_files/news_img/".$rw_images[news_img_file]);
    $largeur=$dimensions[0];
    $hauteur=$dimensions[1];
    
    $coef=$largeur/100;
    $height=$hauteur/$coef;
    
    ?>
    <img src="uploaded_files/news_img/<?php echo $rw_images[news_img_file];?>"
    width='100' height='<?php echo $height;?>' style="border-color:#ffffff; border-style:solid; border-radius:5px;"  />
    
    <?php
    }
    else{
    $dimensions=getimagesize("http://img.youtube.com/vi/$rw[video]/0.jpg");
    $largeur=$dimensions[0];
    $hauteur=$dimensions[1];
    
    $coef=$largeur/100;
    $height=$hauteur/$coef;
    
    ?>
    <img src="http://img.youtube.com/vi/<?php echo $rw['video'];?>/0.jpg" 
    width='100' height='<?php echo $height;?>' style="border-color:#ffffff; border-style:solid; border-radius:5px;"  />
    
    <?php
    }
    ?>    
    <br />
                    <b><?php echo $rw[sujet_news];?></b>
    <?php
    if($rw['description_news']!=''){
    ?>
    <div style="padding:3px; padding-left:6px; 
    border-left:4px solid #d0d0d0; 
    background-color:#f1f1f1; margin-left:0px; 
    font-style:italic;  height:<?php echo $height;?>px;">
    
    <?php echo $rw['description_news'];?>
    </div>
    
    </a>
    <?php
    }
    ?>
    <?php 		
    }
    }
    ?>
        </td>
        
        </tr>
    </table>
                                        
                                        </tr>
                        <tr>
                                            <td align="center">
                                            <br />
                                            
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/fr_FR/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>
    
    <div class="fb-comments" data-href="<?php echo $_SERVER['HTTP_REFERER'];?>" data-width="920" data-num-posts="10"></div>
                                            </td>
                                        </tr>
                    </table>
                </td>
            </tr>
        </table>  
    </td>
  </tr>
</table>
<?php require_once("footer.inc.php"); ?>