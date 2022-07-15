<?php
	require_once("../includes/funcs_lib.inc.php");	
	require_once("admin-function.php");
	
	$_SESSION['site_admin_message']="";

$action=@$_REQUEST['action'];
$admin_uesrname=@$_REQUEST['admin_uesrname'];
$old_password=@$_REQUEST['old_password']; 
$admin_email=@$_REQUEST['admin_email'];
if($action=='Check')
{
	$sql="update tbl_admin   set admin_username = '".$admin_uesrname."',
	admin_password='".$old_password."', admin_email ='".$admin_email."' 
	where admin_id = '".$_SESSION['sess_admin_login_id']."'";
	
	db_query($sql) or die(mysql_error());
	$_SESSION['site_admin_message']="Password Change Successfully......";
	//header("Location:land.php?file=admin_change_pass");
	//exit();

}	
$seladmin="select * from tbl_admin   where admin_id='".$_SESSION['sess_admin_login_id']."'";
$sqlsel=db_query($seladmin) or die(mysql_error());
$rw=mysql_fetch_array($sqlsel);

echo PageTitle('Change Admin Password'); ?>
<script language="javascript">
	function validate()
	{
		if(document.form1.admin_uesrname.value == "")
		{
		alert("Please enter user name")
		document.form1.admin_uesrname.focus()
		return false;
		}

		if(document.form1.old_password.value == "")
		{
		alert("Please enter password ")
		document.form1.old_password.focus()
		return false;
		}

		 if(document.form1.admin_email.value == "")
		{
		  alert("Please enter your email address .")
		  document.form1.admin_email.focus()
		  return false;
		}

		var email = document.form1.admin_email.value;
		if(!email.match(/^[A-Za-z0-9\._\-+]+@[A-Za-z0-9_\-+]+(\.[A-Za-z0-9_\-+]+)+$/))
		{
		 alert("This is not a valid email id! Please fill a valid Email ID.");
		 document.form1.admin_email.focus();
		 return false;
		}
	}
</script>
<form action="" method="post" name="form1" id="form1" onSubmit="return validate();">  
	  <table width="458" border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm"> 
			<tr> 
			  <td width="120" class="tdLabel">Username:</td> 
			  <td> 
			  <input type="hidden" name="action" value="Check" />
			  <input type="text" name="admin_uesrname" class="textfield" value="<?php echo $rw['admin_username'];?>"> 
			  </td> 
			</tr> 
			<tr> 
			  <td width="120" class="tdLabel">Password:</td> 
			  <td> 
			  <input type="hidden" name="action" value="Check" />
			  <input type="password" name="old_password" class="textfield" value="<?php echo $rw['admin_password'];?>"> 
			  </td> 
			</tr> 
			<tr> 
				<td class="tdLabel"> Email:</td> 
				<td> 
				<input type="text" name="admin_email" class="textfield" value="<?php echo $rw['admin_email'];?>"> 
				</td> 
			</tr>
			<tr>
				<td class="label">&nbsp;</td>
				<td><input type="image" name="imageField" src="images/buttons/submit.gif" /></td>
			</tr> 
	  </table> 
</form>