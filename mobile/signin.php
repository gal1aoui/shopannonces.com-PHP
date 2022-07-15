<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','8');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;

require_once("header.php");

if(chk_login()){
	header("Location:my-account-manage.php");
	exit();
}

if(!empty($_POST))
{
	$ref = $_POST['ref'];
	if($_POST['action']=='check' && !empty($_POST['userid']) && !empty($_POST['userpass']))
	{
		Signin_member($userid, $userpass, $ref);
		
	}else{
		Set_Display_Message("Mauvais nom d'utilisateur/mot de passe ....!!");
		header("Location:signin.php");
		exit();    
	}
	
}

?>
<div class="heading">
    Se connecter à votre compte:
</div>

<div class="body">
    
	<div class=""><?php echo Display_Message();?> </div>
	<table width="100%" border="0" cellspacing="0" cellpadding="0" class="mt10">
        <tr>
            <td align="left" valign="top" class="blue-heading">
                <?php if(($_REQUEST['msg']!="") && ($_REQUEST['msg']=="logout"))
                { 
                    echo '<span class="tree">Fermeture de session effectuée avec succès...</span>';
                    unset($_REQUEST['msg']);
                }
                ?>
            </td>
        </tr>
        <tr>
        <td height="250" valign="top">
                <label>
                    Nouveau client:
                    <br />Cliquez sur<strong> Créer un compte</strong>
                </label>
                
                        <?php //?ref=<?php echo basename($_SERVER["HTTP_REFERER"]);?>
                                    <input name="button3" type="submit" class="button button-green"  value="Créer un compte" onclick="window.open('register.php','_parent');"/>
            
            <br />
            <br />
            <form name="form1" id="form1" action="signin.php" method="POST" class="post">
            
                <label>
                    Entrez votre email et mot de passe et cliquez sur <strong>S'enregister</strong>.
                </label>
                <br />
                <br />
                
                <label for="userid"><strong>Email: </strong><span class="style1">*</span></label>
                <input name="userid" id="userid" type="text" class="textbox" />
                
                <label for="userpass"><strong>Mot de passe: </strong><span class="style1">*</span></label>
                <input name="userpass" id="userpass" type="password" class="textbox" />
                <br />
                <br />
                <input type="text" name="ref" value="<?php echo basename($_SERVER["HTTP_REFERER"]);?>"  />
                <input type="hidden" name="action" value="check">
                <input name="button2" type="submit" class="button button-green" id="button2" value="Identification" />
            </form>
            
            
            <label>
                <a href="forgot-password.php">Oublié mot de passe?</a>
            </label>
        </td>
        </tr>
    </table>
    
</div>
<?php require_once("footer.php"); ?>