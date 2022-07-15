<?php
	require_once("includes/main.inc.php");
	require_once("front-functions.php");
	require_once("header.inc.php");
?>

<table width="940" border="0" align="center" cellpadding="0" cellspacing="0" >
  <tr>
  	<td valign="top" align="center" width="120px">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td valign="top">
<!--            <div style="margin:20px; border-radius:5px; box-shadow:0px 0px 4px 1px #1c1a19;background-color:#FFFFFF;">-->
            <table border="0" align="center" class="mt17 cate-border" style="background-color:#FFFFFF;">
                <tr>
                    <td>
                        <style type="text/css">
                  
                /*Credits: By Santosh Setty (http://webdesigninfo.wordpress.com) */
                /*Posted to: Dynamic Drive CSS Library (http://www.dynamicdrive.com/style/) */
                
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
                
.bouton_rouge
{
	display:inline-block;
	height:25px;
	position:absolute;
	right:5px;
	bottom:5px;
	background:url(images/fond-degrade-rouge.jpg) repeat-x;
	border:1px solid #760001;
	border-radius:5px;
	font-size:1.2em;
	text-align:center;
	padding:3px 6px 0px 8px;
	color:white;
	text-decoration:none;
}
                </style>
 
<ul id="nav">
<!-- <ul id="menu_horizontal">-->
                <?php
                                    if(@$_REQUEST['cat_news_id']== '')
                                    $sel="class='current'";
                                    else
                                    $sel="";
                                    ?>
                    <li <?php echo $sel;?>><!--<li class="bouton_gauche>--><a href="news.php"><b>A la une</b></a></li>
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
                <tr>
                    <td align="center">
                        <table border="0">
                        
                                <?php
                                    $categ_news_id=$_REQUEST['cat_news_id'];
                                    
                                    if($categ_news_id!='')
                                    $sel="WHERE categ_id='$categ_news_id'";
                                   /* else
                                    $sel="WHERE categ_id!='12' AND  categ_id!='13'";*/
                                    
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
									$s_cat="select SQL_CALC_FOUND_ROWS *, LEFT(`contenu_news`,500) AS description_news 
											from news 
											$sel 
											ORDER BY date_news DESC, news_id DESC LIMIT $start, $pagesize";
									
                                $sql_cat=db_query($s_cat);

									$res_classi = mysql_fetch_array(db_query("Select FOUND_ROWS() as total"));
									$reccnt=$res_classi['total'];
						?>
                                    <tr>
                                        <td>  
                                        <?php
                                
                                $nbre=mysql_num_rows($sql_cat);
                                if($nbre>0){
                                while($rw=mysql_fetch_array($sql_cat))
                                {
                                    ?>
                                        <div style="margin:10px; border-radius:5px;
                                        			box-shadow:0px 0px 4px 1px #1c1a19; background-color:#f4f5f7; width:760px;">                                                                                         
                                            <div style="position: relative; bottom: 0; border-radius: 5px;
                                            			width:750px; height:40px; backgroung-color:rgb(24,24,24);
                                            			background-color:rgba(24,24,24,0.8); color:#f4f5f7; margin:auto;">
                                                <div style="width:600px;">
                                                    <b><?php echo $rw[sujet_news];?></b>
                                                </div>
                                                <a href="contenu_news.php?news_id=<?php echo $rw[news_id];?>" 
                                                    class="bouton_rouge">
                                                    Voir l'article
                                                    <img src="images\fleche_blanche_droite.gif" alt="" id="bouton_rouge">
                                                </a>
                                            </div>
                                            
                                            <table>
                                                <tr>
                                                    <td>
              <h4 class="posted">
              	Posté le: <?php echo $rw[date_news];?>
                
              </h4>
              <?php
			  	if($rw[visite_news]>0){
					?>
                    	<h4 class="visited">
                    	Vue: <?php echo $rw[visite_news];?> fois
                        </h4>
                    <?php
				}
			  ?>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>
                                                            <a href="contenu_news.php?news_id=<?php echo $rw[news_id];?>" class="link1">
                                                            
                                                                <?php
                                                                $news_id=$_REQUEST['news_id'];
                                                                $sql_images=db_query("select * from tbl_news_image WHERE news_id='$rw[news_id]'");
                                                                
                                                                $nbre_image=mysql_num_rows($sql_images);
                                                                if($nbre_image>0){
                                                                    $rw_images=mysql_fetch_array($sql_images);
                                                                    
                                                                    $dimensions=getimagesize("uploaded_files/news_img/".$rw_images[news_img_file]);
                                                                    $largeur=$dimensions[0];
                                                                    $hauteur=$dimensions[1];
                                                                    
                                                                    $coef=$largeur/250;
                                                                    $height=$hauteur/$coef;
                                                                    
                                                                    ?>
                                                                    <img src="uploaded_files/news_img/<?php echo $rw_images[news_img_file];?>"
                                                                    width='250' height='<?php echo $height;?>' style="border-color:#ffffff; border-style:solid; border-radius:5px;"  />
                                                                    
                                                                <?php
                                                                }
                                                                else{
                                                                    $dimensions=getimagesize("http://img.youtube.com/vi/$rw[video]/0.jpg");
                                                                    $largeur=$dimensions[0];
                                                                    $hauteur=$dimensions[1];
                                                                    
                                                                    $coef=$largeur/250;
                                                                    $height=$hauteur/$coef;
                                                                    
                                                                ?>
                                                                    <img src="http://img.youtube.com/vi/<?php echo $rw['video'];?>/0.jpg" 
                                                                    width='250' height='<?php echo $height;?>' style="border-color:#ffffff; border-style:solid; border-radius:5px;"  />
                                                                
                                                                <?php
                                                                }
                                                                ?>    
                                                            </a>
                                                    </td>
                                                    
                                                    <td>
                                                    <?php
                                                    if($rw['description_news']!=''){
                                                    ?>
                                                        <div style="padding:3px; padding-left:6px; 
                                                        			border-left:4px solid #d0d0d0; 
                                                                    background-color:#f1f1f1; margin-left:10px; 
                                                                    font-style:italic;  height:<?php echo $height;?>px;">
														
															<?php echo $rw['description_news'];?>
                                                        </div>

                                                    <?php
                                                    }
                                                    ?>
                                                    </td>
                                                 </tr>
                                            </table>
                                        </div>
                                    <?php 					
                                }
                                }
                                else{
                                    ?>
                                        <br />
                                        <div class="msg">Désolé, aucun news trouvé dans cette catégorie.</div>
                                    <?php
                                }
                                ?>
                                        </td>
                                    </tr>
                                    
                                    <tr>
                                        <td>	 
                                            <?php include("paging.inc.php"); ?>
                                        </td>
                                    </tr>
                         </table>
                    </td>
                </tr>
            </table>
<!--            </div>-->
    </td>
  </tr>
</table>
<?php require_once("footer.inc.php"); ?>