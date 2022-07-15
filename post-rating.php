<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require_once("includes/main.inc.php");
require_once("front-functions.php");
chk_user_login();
$repID=intval($_REQUEST[rId]);
$topID=intval($_REQUEST[topicID]);
$n=5;
/*************** Rating start here  **********/
if(isset($_REQUEST['rate']) && $_REQUEST['rate']!="")
 {
    $rated_already=chk_member_rated($_SESSION['memId'] , $_REQUEST['rId']);
	 if($rated_already > 0 )
	 {
		 Set_Display_Message("Déjà noté ce commentaire...");
		 header("Location: ".$_SERVER['HTTP_REFERER']);
		 exit();	 
	 }else
	 {	
		$rid = intval($_REQUEST[rId]);
		$tmpVal = secureValue($_REQUEST[val]);
		$topicID = intval($_REQUEST[topicID]);
		 $sql="insert into `tbl_rating` SET `section_id` = '$rid',
		`total_votes` = '1',
		`total_value` = '$tmpVal',
		`mem_id`='$_SESSION[memId]' ";
		 db_query($sql);
		 Set_Display_Message("Vous avez note le commen
		 taire");
		 header("Location: forum-details.php?topicID=$topicID");
		 exit();
	 } 

}
/*************** END  Rating **********/

$sql_theem=db_query("select * from tbl_theem where theem_satus='Y' ");
if(mysql_num_rows($sql_theem) > 0 ){
    $rw_theem=mysql_fetch_array($sql_theem);
     $theem_css=SITE_WS_PATH."/themes/".$rw_theem['theem_value']."/css/clpage-preet.css";
     $theem_img=SITE_WS_PATH."/themes/".$rw_theem['theem_value']."/images/";
  
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Bienvenue à </title>
<link href="css/clpage-preet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td valign="top" align="center">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td >
<table width="400" align="center" cellpadding="0" cellspacing="0" class="bg-color">
  <tr>
    <td valign="top" class="bg-greycolor" style="padding:7px;"><div class="main-heading">
      <p class="bg-heading">Message Note</p>
   </div>
      <div style="margin-top:5px;">
      <table width="99%"  border="0" cellspacing="0" cellpadding="4">

        <tr>
          <td width="40%" align="center" valign="top"><table width="100%" border="0" cellspacing="2" cellpadding="3">
            <tr>
              <td align="center">
			  <?php for($i=1;$i<=5;$i++) { ?>
			 <a href="post-rating.php?rId=<?=$repID;?>&rate=Y&val=<?=$i;?>&topicID=<?=$topID;?>" title="<?=$i;?>">
				    <img src="<?=$theem_img;?>/star.gif" width="12" height="12" alt="<?=$i;?>" border="0" /></a>
					<?php } ?>
					</td>
              </tr>
            </table></td>
        </tr>
        <tr>
          <td align="center" valign="top"><input name="Submit22" type="submit" class="button" value="Soumettre"/></td>
        </tr>
      </table>
    </div>    </td>
  </tr>
</table>
</td>
</tr>
</table>
</body>
</html>