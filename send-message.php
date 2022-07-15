<?php
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Sat, 26 Jul 1997 05:00:00 GMT");
require_once("includes/main.inc.php");
require_once("front-functions.php");
chk_user_login();
$to_memId=intval($_REQUEST['mId']);
$from_memId=intval($_COOKIE['memId']);
$pmethod=$_REQUEST;
$empty_fld=checkEmptyData($pmethod,array("poster_name","poster_msg"),array("Your Name ","Your Message"));
if(isset($_REQUEST[action]) &&($_REQUEST[action]=="topic")){
  if(!$empty_fld[err_flag]){
    $poster_msg=secureValue($_REQUEST['poster_msg']);  
	$poster_name = secureValue($_REQUEST['poster_name']);
	
     $sql="INSERT INTO  `tbl_private_message` SET `from_mem_id` = '$from_memId',
	 `to_mem_id`='$to_memId',
	 `poster_name` = '$poster_name',
	 `msg_status`='Active',
	  `poster_msg` = '$poster_msg',
	  `date` = '".date('Y-m-d')."' ";  
	   @db_query($sql);
	   Set_Display_Message("Votre message affiché avec succès");
	   header("Location:forum.php");
	   exit();
	 }else{
	   Set_Display_Message("SVP spécifier les champs suivants :<br />".$empty_fld[msg]);	
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
	if(RemoveLTSpace(obj.poster_name.value)==""){
		alert('Please enter your  name.');
		obj.poster_name.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.poster_msg.value)==""){
		alert('Please enter your  message..');
		obj.poster_msg.focus();
        return false;
	}	
}
</script>
</head>
<body>
<table width="393" align="center" cellpadding="0" cellspacing="0" class="bg-color">
  <tr>
    <td width="391" valign="top" class="bg-greycolor" style="padding:7px;"><div class="main-heading">
      <p class="bg-heading">Envoyer un message privé</p>
       </div>
      <div style="margin-top:5px;">
	   <form name="frm" action="send-message.php?mId=<?php echo $_REQUEST['mId'];?>" method="post" onsubmit="return validate_topic(this);">
      <table width="99%"  border="0" cellspacing="0" cellpadding="4">
        <tr align="left">
          <td colspan="2" class="border-bottom"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
            
            <tr>
              <td width="726" height="25" class=" ar fs11" style="padding-left:5px;">( <span class="star">* </span>) obligatoire.</td>
              </tr>
            
          </table></td>
          </tr>
        <tr>
          <td width="23%" align="right" class="bg-strip-color1"><strong><span class="star">*</span>Nom :</strong></td>
          <td width="77%" class="bg-strip-color1"><input name="poster_name" type="text" class="textbox1"  style="width:250px;" /></td>
          </tr>
        <tr>
          <td align="right" class="bg-strip-color1"><strong><span class="star">*</span>Message :</strong></td>
          <td class="bg-strip-color1"><textarea name="poster_msg" rows="6" class="textbox1" style="width:250px;"></textarea></td>
          </tr>

        <tr>
          <td align="center" valign="top">&nbsp;</td>
          <td valign="top"><input name="Submit22" type="submit" class="button" value="Envoyer Message"/>
            <input type="hidden" name="action" value="Sujet" /></td>
        </tr>
      </table>
	    </form>
    </div>    </td>
  </tr>
</table>
</body>
</html>