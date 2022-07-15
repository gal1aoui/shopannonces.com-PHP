<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("header.inc.php");
chk_user_login();

$action=$_REQUEST['action'];

$mid=$_SESSION[memId];
$pmethod=$_POST;
$empty_fld=checkEmptyData($pmethod,array("heading","comment"),array("Title","Comment"));

$tmpTopicID = intval($_REQUEST['topicID']);
$tmpRID = intval($_REQUEST['rId']);

$result=getResult("forum_topics"," where topicID='$tmpTopicID' ");
$qry= db_query("select * from forum_responses where replyID='$tmpRID' and topicID='$result[topicID]' and status ='Y' ");
$res=mysql_fetch_array($qry);

/* Edit post comment section */
if($action=="edit" && $_SESSION['memId']!=""){
if(!$empty_fld[err_flag]){
$name=secureValue(strip_tags($_POST[name]));
$email=secureValue($_POST[email]);
$reply=secureValue(strip_tags($_REQUEST['comment']));

echo $_SESSION['rand_val'];
     if($_SESSION['rand_val']!=$verif_box){ 
	  Set_Display_Message("Mauvais code de vérification");	 
	  }else{
	  $heading = secureValue($heading);
      $sql_respons="UPDATE forum_responses set heading='$heading',comments='$reply' where replyID ='$tmpRID' and memberID='$_SESSION[memId]' ";	  
	   db_query($sql_respons);	   
	   Set_Display_Message("Votre commentaire mis à jour avec succès.");
	   unset($action);	         
		header("Location: forum-details.php?topicID=$tmpTopicID");
		exit();
	  }	
    }else{
     Set_Display_Message("Please specify following fields :<br />".$empty_fld[msg]);
	}
}
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
		<tr><td><?php if(isset($_SESSION[memId])&& $_SESSION[memId]!=""){ ?>
		   <form name="frm" id="frm" method="post" action="" >
          <table width="100%" cellpadding="2" cellspacing="0" class="mt17 cate-border bg-stripcolor">
            <tr>
              <td colspan="2" align="left" class=" green-bgcolor wht-heading pl10"><a name="post"></a>Éditer commentaire</td>
              </tr>
            <tr>
              <td height="5" align="right"></td>
              </tr>
            <tr align="left">
              <td colspan="2"><?php echo Display_Message();?></td>
              </tr>
			  <!--
            <tr>
              <td align="right"><span class="star">*</span> Votre nom : </td>
              <td align="left">
			<input name="name" type="text" class="textbox1" id="name"  style="width:300px;" value="<?php echo $res[name];?>"/></td>
            </tr>
            <tr>
              <td width="42%" align="right"><span class="star">*</span> Email ID :</td>
              <td width="58%" align="left">
			  <input name="email" type="text" class="textbox1" id="email"  style="width:300px;" value="<?php echo $res[email];?>"/></td>
              </tr>
			  -->
            <tr>
              <td align="right">* Titre</td>
              <td align="left">
	<input name="heading" type="text" class="textbox1" id="name2"  style="width:300px;" value="<?php echo $res[heading];?>"/></td>
            </tr>
            <tr>
              <td align="right"><span class="star">* </span>Commentaire :</td>
              <td align="left">
		<textarea name="comment" rows="6" class="textbox1" id="comment" style="width:300px;"><?php echo $res[comments];?></textarea></td>
              </tr>
            <tr>
              <td align="right">* Code de vérification: </td>
              <td align="left" style="padding-top:10px;"><input name="verif_box" type="text" size="20" id="verif_box"  /> <img src="verificationimage.php" alt="verification image, type it in the box" width="80" height="24"  style="vertical-align:middle "/> </td>
            </tr>
            <tr>
              <td align="right">&nbsp;</td>
              <td align="left" style="padding-top:10px;">
			  <input name="button3" type="submit" class="button" id="button5" value="Update Comment"/>
                <input type="hidden" name="action" value="Éditer"></td>
              </tr>
            <tr>
              <td height="5" colspan="2" align="right"></td>
              </tr>
          </table>
		   </form>
		   <?php } ?></td></tr>
    </table></td>
  </tr>
</table>
</td>
</tr>
</table>
<?php require_once("footer.inc.php"); ?>