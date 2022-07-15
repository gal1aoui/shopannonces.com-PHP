<?php
	require_once("../includes/main.inc.php");
	require_once("../includes/funcs_lib.inc.php");
	require_once("admin-function.php");
	require_once("admin_header.inc.php");
$ms=@$_REQUEST['ms'];

?>
<form action="authen.php" method="POST">
  <table width="480"  border="0" align="center" cellpadding="2" cellspacing="2">
    <tr>
      <td align="left" valign="top"><strong>
        <?php echo Display_Message();?>
      </strong></td>
    </tr>
	<?php
	if($ms==1)
	{
		echo "<tr><td align='center' class='msg_dg'>Logout Successfully.......</td></tr>";	
	} ?>
    <tr>
      <td><table width="100%"  border="0" cellpadding="15" cellspacing="1" bgcolor="#CFCFCF">
          <tr>
            <td bgcolor="#F5F5F5"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="8%" align="left"><img src="images/icons/keys.gif" width="32" height="32" /></td>
                  <td width="92%" align="left" valign="top">
						<span style="font-family:Verdana, Arial, Helvetica, sans-serif; font-size:11px; color:#1E518F; font-weight:bold">
							Welcome to Administration Suite!
						</span>
				  </td>
                </tr>
                <tr>
                  <td align="left">&nbsp;</td>
                  <td align="left" valign="top" class="blue_txt">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" align="left"><table width="100%"  border="0" cellspacing="0" cellpadding="0">
                      <tr>
                        <td valign="top" class="txtLight">Please enter a valid username and password to gain access to the administration console.</td>
                      </tr>
                      <tr>
                        <td valign="top" class="txtLight">&nbsp;</td>
                      </tr>
                      <tr>
                        <td width="66%" align="right" valign="top"><table width="90%"  border="0" align="center" cellpadding="7" cellspacing="1" bgcolor="#CFCFCF">
                          <tr>
                            <td bgcolor="#EFEFEF"><table width="100%"  border="0" cellspacing="0" cellpadding="1">
                                <tr>
                                  <td align="left"><strong>Username</strong></td>
                                </tr>
                                <tr>
                                  <td align="left">
		<input name="login_id" type="text" class="textfield" id="login_id"  size="30" /></td>
                                </tr>
                                <tr>
                                  <td align="left"><strong>Password</strong></td>
                                </tr>
                                <tr>
                                  <td align="left">
				<input name="password" type="password" class="textfield"  size="30" /></td>
                                </tr>
                                <tr>
                                  <td align="left" style="padding-top:5px">
								  <a href="#" onclick="window.open('../admin_forgot_password.php','royale', 'toolbar=no,width=500,height=250,left=20,top=20, screenX=500,screenY=500,status=no,scrollbars=no, resizable=yes,');return false" class="star">Forgot Password?</a><br /></td>
                                </tr>
                                <tr>
                                  <td align="left" style="padding-top:5px"><input type="image" src="images/buttons/submit.gif" alt="Submit" border="0" /></td>
                                </tr>
                            </table></td>
                          </tr>
                        </table></td>
                      </tr>
                  </table></td>
                </tr>
            </table></td>
          </tr>
      </table></td>
    </tr>
  </table>
  <br />
  <br />
  <br /> 
</form>
<?php include_once("admin_footer.inc.php"); ?>