<?php
	require_once("includes/main.inc.php");
	require_once("front-functions.php");
	$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','8');
	$meta_titles=$title;
	$meta_desc=$description;
	$meta_keywords=$keyword;
	
	require_once("header.inc.php");

if(chk_login()){
	header("Location:my-account.php");
	exit();
}
?>

<div class="grid_3">
    <br />
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">

	<div class="tree"><a href="index.php">Accueil</a> >> Se connecter </div>
    
	<div class=""><?php echo Display_Message();?> </div>
    
    <div class="p7">        
        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading"><span class="title_clad">Se connecter à votre compte:</span></div>
            <div class="panel-body">
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
            <td width="47%" height="250" valign="top" class="col-border">
				<form name="form1" method="post" action="authorized.php" onSubmit="return validate_loginform(this);">
              		<table width="100%"  border="0" cellpadding="1" cellspacing="0">
                <tr>
                	<td valign="top" class="blue-heading">Membres </td>
                </tr>
                <tr>
                  	<td align="left" valign="top" class="txt_black">
                  		Entrez votre email et mot de passe et cliquez sur <strong>S'enregister</strong>.
                    </td>
                </tr>
                <tr>
                	<td height="25" align="left" valign="bottom"><strong>Email : </strong></td>
                </tr>
                <tr>
               		<td align="left" valign="top">
               			<input name="userid" type="text" class="textbox"  style="width:250px;" autocomplete="off"/>
                    	<span class="style1">*</span>
                    </td>
                </tr>
                <tr>
                  <td align="left" valign="top" ><strong>Mot de passe :</strong></td>
                </tr>
                <tr>
                  <td align="left" valign="top"><input name="userpass" type="password" class="textbox"  style="width:250px;"/>
                      <span class="style1">*</span></td>
                </tr>
                <tr>
                	<td valign="top" style="padding:4px 0;">
                    <input name="button2" type="submit" class="button button-green" id="button2" value="Identification" />
                    <input type="hidden" name="action" value="check">
					<input type="hidden" name="ref" value="<?php echo $ref;?>">
                    </td>
                </tr>
                <tr>
                  <td>
                  	<a href="forgot-password.php"
                    	data-title="Oublié mot de passe?" 
                        data-toggle="lightbox" 
                        data-parent="" 
                        data-gallery="remoteload">Oublié mot de passe?</a>
                  </td>
                </tr>
              </table>
            	</form>
            </td>
            <td width="53%" valign="top">
                <table width="90%"  border="0" align="right" cellpadding="1" cellspacing="0">
                    <tr>
                    	<td valign="top" class="blue-heading">Nouveau client </td>
                    </tr>
                    <tr>
                    	<td align="left" valign="top">Cliquez sur<strong> Créer un compte</strong></td>
                    </tr>
                    <tr>
                        <td align="left" valign="top">
                            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                                <tr>
                                    <td width="53%" align="center">
                                    <input name="button3" type="submit" class="button button-green"  value="Créer un compte" onclick="window.open('register.php','_parent');"/>
                                    </td>
                                    <td width="47%"><img src="mobile/images/login-img.jpg" alt="" vspace="10"/></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
          </tr>
        </table>
            </div>
        </div>
	</div>
    
</div>
<?php require_once("footer.inc.php"); ?>