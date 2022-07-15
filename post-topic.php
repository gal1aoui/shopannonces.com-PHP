<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require_once("includes/main.inc.php");
require_once("front-functions.php");
chk_user_login();
$memID=$_SESSION['memId'];
$pmethod=$_POST;
$empty_fld=checkEmptyData($pmethod,array("topicTitle","topicDesc"),array("Topic","Topic Description"));

if(isset($_REQUEST[action]) &&($_REQUEST[action]=="topic")){
   if(!$empty_fld[err_flag]){	
   
   $tmpTopicTitle = secureValue($_POST[topicTitle]);
   $tmpTopicDesc = secureValue($_POST[topicDesc]);
   
    db_query("insert into forum_topics set memberID='$memID',topicTitle='$tmpTopicTitle',topicDesc='$tmpTopicDesc',recv_date=now(),status='N'");	
	Set_Display_Message("Nouveau sujet ajouté avec succès...");
	header("Location:forum.php");
	exit();
	}else{
	  Set_Display_Message("Svp spécifier les champs suivant :<br />".$empty_fld[msg]);	
	  header("Location:forum.php");
	 exit();
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Welcome to </title>
<link href="css/clpage-preet.css" rel="stylesheet" type="text/css" />
<script language="javascript">
function validate_topic(obj){	
	if(RemoveLTSpace(obj.topicTitle.value)==""){
		alert('Please Forum Topic.');
		obj.topicTitle.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.topicDesc.value)==""){
		alert('Please Forum Topic Description .');
		obj.topicDesc.focus();
        return false;
	}	
	
}
</script>
</head>
<body>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td valign="top" align="center">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td >
<table width="500" align="center" cellpadding="0" cellspacing="0" class="bg-color">
  <tr>
    <td valign="top" class="bg-greycolor" style="padding:7px;">
	<div class="main-heading">
      <p class="bg-heading">Afficher le sujet</p>
   </div>
      <div style="margin-top:5px;">
	  <form name="frm" action="post-topic.php" method="post" onsubmit="return validate_topic(this);">
      <table width="99%"  border="0" cellspacing="0" cellpadding="4">
        <tr align="left">
          <td colspan="2" class="border-bottom"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
              
              <tr>
                <td height="25"><?=Display_Message();?></td>
              </tr>
              <tr>
              <td width="726" height="25" class=" ar fs11" style="padding-left:5px;">( <span class="star">* </span>) obligatiore.</td>
              </tr>
			  <tr><td></td></tr>
              
          </table></td>
        </tr>
        <tr>
          <td width="33%" align="right" class="bg-strip-color1"><span class="star">*</span> Sujet :</td>
          <td width="67%" class="bg-strip-color1"><input name="topicTitle" type="text" class="textbox1" style="width:250px;"/></td>
        </tr>
        <tr class="bg-stripcolor">
          <td align="right"><span class="star">*</span>Description :</td>
          <td class="bg-strip-color1"><textarea name="topicDesc" rows="4" class="textbox1" style="width:250px;"></textarea></td>
        </tr>

        <tr>
          <td colspan="2" align="center" valign="top">
		  <input name="Submit22" type="submit" class="button" value="Afficher" />
		  <input type="hidden" name="action" value="topic" />
		  </td>
        </tr>
      </table>
	  </form>
    </div>    </td>
  </tr>
</table>

</td>
</tr>
</table>
</body>
</html>