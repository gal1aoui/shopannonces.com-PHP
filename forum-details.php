<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("header.inc.php");

$ref=$_SERVER['REQUEST_URI'];
if($_REQUEST['reply']!="" && $_REQUEST['reply']=="Y"){
header("Location:signin.php?ref=$ref");
exit();   
}
$act=$_REQUEST['act'];
$start=$_REQUEST[start];
$pagesize=$_REQUEST[pagesize];
$start = (intval($start)<0 or $start=="")?0:$start;
$pagesize = intval($pagesize)==0?$pagesize=10:$pagesize;
$mid=$_SESSION[memId];
$pmethod=$_REQUEST;
$empty_fld=checkEmptyData($pmethod,array("name","email","heading","comment"),array("Name","Email","Title","Comment"));

$topicID = intval($_REQUEST[topicID]);
$result=getResult("forum_topics"," where topicID='$topicID' ");
$query= db_query("select * from forum_responses where topicID='$result[topicID]' and status ='Y' order by replyID ");
$reccnt = mysql_num_rows($query);
$qry= db_query("select * from forum_responses where topicID='$result[topicID]' and status ='Y' order by replyID limit $start, $pagesize");

/* Start post comment section */
if($act=="post" && $_SESSION[memId]!=""){
 if(!$empty_fld[err_flag]){
$name=secureValue(strip_tags($_POST[name]));
$email=secureValue($_POST[email]);
$reply=secureValue(strip_tags($_POST['comment']));
   if($_SESSION['rand_val']!=$verif_box){ 
	Set_Display_Message("Mauvais code de vérification");    
	//header("Location: forum-details.php?topicID=$_REQUEST[topicID]#post");
	//exit();  
	}else{
		$heading = secureValue($heading);
		$mid = intval($mid);
	
      $sql_respons="INSERT INTO forum_responses set name='$name',email='$email',recv_date=now(),
       heading='$heading',comments='$reply',topicID='$topicID',memberID='$mid',status='Y'";	  
	   db_query($sql_respons);
	   Set_Display_Message("Votre commentaire est affiché avec succès.");	   
	       /********** Drop the mail to admin **************/	   
	        $seladmin=db_query("select * from ".DB.".tbl_admin");
			$rw=mysql_fetch_array($seladmin);
			$to=$rw['admin_email'];			
			$ContactPerson="Classified Site";
			$eMail="info@classifieds.com";			
			$headers = "From: $ContactPerson<$eMail> \n";
			$headers .= "Reply-To: $eMail \r\n";
			$headers .= "X-Mailer: PHP/". phpversion();
			$headers .= "X-Priority: 3 \n";
			$headers .= "MIME-version: 1.0\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\n";
			$msg="New comment has been posted in the topic <strong> $result[topicTitle] </strong> <br><br> <br>
			By $name [$email] <br><br> <br> Cliquer ici pour le voir <br><br> <br> ";		
			$msg.=SITE_WS_PATH."/cpanel/index.php";	
			$subject1= "Welcome";			
            //mail($to,$subject1,$msg,$headers);
		/*********** Drop the mail to admin ***********/	   
		header("Location: forum-details.php?topicID=$topicID#post");
		exit();   
	  }
  }else{
    Set_Display_Message("SVP spécifier les champs suivants :<br />".$empty_fld[msg]);
  }		

}

/* Delete comments posted by  that member */
if($_REQUEST[rId]!="" && $_SESSION['memId']!="" && $_REQUEST[act]=="del")
{
$rID = intval($_REQUEST['rId']);
$sql_del_comments="UPDATE `forum_responses` SET `status` = 'D'
 WHERE `replyID` ='$rID' and memberID= '$_SESSION[memId]'";
    db_query($sql_del_comments);
	Set_Display_Message("Votre commentaire a été retiré.");
	header("Location: forum-details.php?topicID=$topicID");
	exit(); 
}
/* Delete comments posted by  that member */


?>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td valign="top" align="center">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td >
<table border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top" style="padding:5px 5px 0 15px;"><table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td class="main-heading">Forum</td>
        </tr>
		
      <tr>
        <td width="33%" valign="top" class="tree"><?php echo str_stop(ucfirst(strtolower($result[topicTitle])),50); ?> &lt;&lt; <a href="forum.php">Forum</a> &lt;&lt; <a href="index.php">Accueil</a></td>
        </tr>
		<tr><td> <?php echo Display_Message();?> </td></tr>
      <tr>
        <td valign="top" style="padding-top:3px;"><table width="100%" border="0" cellpadding="4"  cellspacing="2" class="cate-border">
          <tr class="cate-stripcolor">
            <td width="28%"><p class="fl wht-head"><?php echo str_stop(ucfirst(strtolower($result[topicTitle])),50); ?></p><p class="fr white-style">( <strong><?php echo getMemberFullName($result[memberID]);?></strong> - <?php echo forumchangedate($result[recv_date]);?> )</p></td>
            </tr>
          <tr>
            <td align="left">              
              <p><?php echo ucfirst(strtolower($result[topicDesc]));?></p></td>
            </tr>
          </table>
          <div class="ar mt5">
		  <?php if(isset($_SESSION['memId'])&& $_SESSION['memId']!=""){ ?>
		<a href="forum-details.php?topicID=<?php echo $result[topicID];?>#post" class="button">Affiché le commentaire</a>
		<?php  }else{ ?>		
		<a href="forum-details.php?topicID=<?php echo $result[topicID];?>&reply=Y#post" class="button">Affiché le commentaire</a>
		<?php  } ?>
		</div>
          <?php include("paging.inc.php"); ?>
          <table width="100%" border="0" cellspacing="0" cellpadding="5" class="mt10 bg-stripcolor">
            <tr>
              <td class=" bg-stripcolor1 blue-heading">Répliquez à ce commentaire</td>
              </tr>
            <tr>
              <td>
			  
			<?php
			   $n=5; 
		       if(mysql_num_rows($qry) > 0 ){ 
			     while($res=mysql_fetch_array($qry)){
				 $rate_star=calculate_rate($res[replyID]);		 
				?>
				<table width="100%" border="0" cellpadding="6"  cellspacing="0" class="cate-border">
                <tr>
                  <td width="55%" align="left" class="b"><?php echo str_stop(ucfirst(strtolower($res[heading])),50); ?>
				 </td>
                  <td width="45%" align="right">
				  <strong><?php echo ucwords($res[name]);?></strong> - <?php echo forumchangedate($res[recv_date]);?></td>
                  </tr>
                <tr>
                  <td colspan="2" align="left" class="bg-left-box1"><?php echo ucfirst(strip_tags($res[comments]));?></td>
                  </tr>
                <tr class="bg-left-box1">
                  <td colspan="2">
                    <div class="fl">
					 <?php for($i=1;$i<=$rate_star;$i++) {
					  $num=$n-$i;		
					  ?>	
                   <a href="#"><img src="<?php echo $theem_img;?>/star.gif" hspace="2" border="0" alt="<?php echo $i;?>"/></a>
					  <?php  } ?>
					  <?php for($j=$i;$j<=$n;$j++) { ?>
                      <a href="#"><img src="<?php echo $theem_img;?>/star1.gif" hspace="2" border="0" alt="<?php echo $j;?>"/></a>
					  <?php  } ?>
					  </div>					  
                   <?php if($_SESSION['memId']!="" && $res[memberID]==$_SESSION['memId']){	?>
                    <div class="fr" style="width:500px;">
                 <p class="b fr ml20">
				 <a href="forum-details.php?rId=<?php echo $res[replyID ];?>&topicID=<?php echo $res[topicID];?>&act=del" class="link1"onClick=" return confirm('Are you sure you want to delete this record');" >effacer</a> / <a href="edit-forum-comment.php?rId=<?php echo $res[replyID ];?>&topicID=<?php echo $res[topicID];?>" class="link1">éditer</a>
				 </p>
				 <?php  } ?>	
				<?php if(isset($_SESSION['memId'])&& $_SESSION['memId']!=""){ ?>
                <p class="b fr ml20">
			<a href="post-rating.php?rId=<?php echo $res[replyID ];?>&topicID=<?php echo $res[topicID];?>" rel="facebox" class="link1 b">Noter le commentaire</a></p>
				 <?php  } ?>
                    </div>									
                    </td>
                  </tr>
                </table>				
				<?php }
				  }else{ ?>
				  <table width="100%" border="0" cellpadding="6"  cellspacing="0" class="cate-border">
				  <tr>
				  <td>Aucun commentaire affiché pour ce sujet</td>
				  </tr></table>
				  <?php  } ?>
			    </td>
            </tr>
            </table>
          <?php include("paging.inc.php"); ?>
		  <?php if(isset($_SESSION[memId])&& $_SESSION[memId]!=""){ ?>
		   <form name="wedding" id="wedding" method="post" action="forum-details.php?topicID=<?php echo $_REQUEST[topicID];?>#post" class="border" onsubmit="return validate_forumreply(this);">
          <table width="100%" cellpadding="2" cellspacing="0" class="mt17 cate-border bg-stripcolor">
            <tr>
              <td colspan="2" align="left" class=" green-bgcolor wht-heading pl10"><a name="post"></a>Afficher le commentaire</td>
              </tr>
            <tr>
              <td height="5" align="right"></td>
              </tr>
            <tr align="left">
              <td colspan="2"><?php echo Display_Message();?></td>
              </tr>
            <tr>
              <td align="right"><span class="star">*</span> Votre Nom : </td>
              <td align="left"><input name="name" type="text" class="textbox1" id="name"  style="width:300px;" value="<?php echo $name;?>"/></td>
            </tr>
            <tr>
              <td width="42%" align="right"><span class="star">*</span> Email :</td>
              <td width="58%" align="left">
	<input name="email" type="text" class="textbox1" id="email"  style="width:300px;" value="<?php echo $email;?>"/></td>
              </tr>
            <tr>
              <td align="right">* Titre</td>
              <td align="left">
	<input name="heading" type="text" class="textbox1" id="name2"  style="width:300px;" value="<?php echo $heading;?>"/></td>
            </tr>
            <tr>
              <td align="right"><span class="star">* </span>Commentaire :</td>
              <td align="left">
		<textarea name="comment" rows="6" class="textbox1" id="comment" style="width:300px;"><?php echo $comment;?></textarea></td>
              </tr>
            <tr>
              <td align="right">* Code de vérification : </td>
              <td align="left" style="padding-top:10px;"><input name="verif_box" type="text" size="20" id="verif_box"  /> <img src="verificationimage.php" alt="verification image, type it in the box" width="80" height="24"  style="vertical-align:middle "/> </td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="left" style="padding-top:10px;"><input name="button3" type="submit" class="button" id="button5" value="Affiché le commentaire"/>
                <input type="hidden" name="act" value="post"></td>
              </tr>
            <tr>
              <td height="5" colspan="2" align="right"></td>
              </tr>
          </table>
		   </form>
		   <?php  } ?>		  
		  </td>
        </tr>
    </table></td>
  </tr>
</table>
</td>
</tr>
</table>
<?php require_once("footer.inc.php"); ?>