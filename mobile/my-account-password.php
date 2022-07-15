<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("header.inc.php");
chk_user_login();
$action=@$_REQUEST['action'];
$old_pwd=secureValue(@$_REQUEST['old_pwd']);
$new_pwd=secureValue(@$_REQUEST['new_pwd']);
$confirm_pass=secureValue(@$_REQUEST['c_pwd']);
$pmethod=$_REQUEST;

if($action=='Add'){
$empty_fld=checkEmptyData($pmethod,array("old_pwd","new_pwd","c_pwd"),array("Ancien mot de passe","Nouveau mot de passe","Confirmer mot de passe"));
 if(!$empty_fld[err_flag]){
	 $sql="select mem_id,password from  tbl_member where password='$old_pwd' and mem_id='$_COOKIE[memId]'";
	 $rw=db_query($sql);
	 if(mysql_num_rows($rw)==0){	
	     Set_Display_Message("Ancien mot de passe invalide, essayez de nouveau");	 
	 }else if ($new_pwd!=$confirm_pass){	 
	     Set_Display_Message("Nouveau mot de passe et mot de passe de confirmation différents ");
	  }else{
	     $update_sql="update tbl_member set password='$new_pwd'
		 where password='$old_pwd' and mem_id='$_COOKIE[memId]'";
	     db_query($update_sql);
	      Set_Display_Message("Mot de passe changé avec succès, svp entrez le nouveau mot de passe.");
		 unset($_COOKIE['memId']);
		 unset($_COOKIE['userId']);
		 unset($_COOKIE['user_name']);
	     header("Location:signin.php");
	     exit();
	  }
  }else{
    Set_Display_Message("S'il vous plaît remplir tous les champs :<br />".$empty_fld[msg]);
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
    <td valign="top" style="padding:5px 5px 0 15px;">
	<form name="form1" method="post" action="">
      <table width="100%" border="0" cellpadding="2" cellspacing="0">
        <tr>
           <td class="main-heading">Changer de mot de passe</td>
        </tr>
        <tr>
          <td width="33%" valign="top" class="tree">Changer de mot de passe &lt;&lt; <a href="my-account.php">Mon compte</a> &lt;&lt; <a href="index.php">Accueil</a></td>
        </tr>
        <tr>
          <td style="padding-top:3px;">
            <div class="p3 ar">Bienvenue<span class="heading">
              <?php echo $_COOKIE['user_name'];?>
            </span>&nbsp;&nbsp; <a href="my-account.php" class="link1 b">(Mon compte)</a>&nbsp;&nbsp; <a href="logout.php" class="link1 b">(Se déconnecter)</a></div>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
              <tr>
                <td width="78%" valign="top" class="col-border pr15"><table width="100%" cellpadding="6" cellspacing="0">
                    <tr>
                      <td colspan="2"><?php echo Display_Message();?></td>
                    </tr>
                    <tr>
                      <td colspan="2" class="heading">Détails du mot de passe</td>
                    </tr>
                    <tr>
                      <td width="42%" align="right" ><span class="star">*</span>Ancien mot de passe :</td>
                      <td width="58%" align="left">
                        <input name="old_pwd" type="password" class="textbox1"  style="width:300px;"/></td>
                    </tr>
                    <tr class="bg-stripcolor">
                      <td align="right" ><span class="star">* </span>Nouveau mot de passe : </td>
                   <td align="left"><input name="new_pwd" type="password" class="textbox1"  style="width:300px;"/></td>
                    </tr>
                    <tr>
                      <td align="right"><span class="star">*</span>Confirmer mot de passe :</td>
                    <td align="left"><input name="c_pwd" type="password" class="textbox1"  style="width:300px;"/></td>
                    </tr>
                  </table>
                    <table width="100%" cellpadding="2" cellspacing="0">
                      <tr>
                        <td width="42%" align="right">&nbsp;</td>
                        <td width="58%" align="left" style="padding-top:10px;">
						<input name="button3" type="submit" class="button" id="button3" value="Soumettre"/>
                            <span class="border_bot">
                            <input type="hidden" name="action" id="hiddenField" value="Add" />
                          </span></td>
                      </tr>
                  </table></td>
                <td width="22%" valign="top" class="account-link pl15 pt11">
                  <?php require_once("my_account_links.php"); ?></td>
              </tr>
          </table>
          </td>
        </tr>
      </table>
    </form></td>
  </tr>
</table>

</td>
</tr>
</table>
<?php require_once("footer.inc.php"); ?>