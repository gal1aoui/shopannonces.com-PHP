<?php
$action=@$_REQUEST['action'];
$email=$_REQUEST['email'];
$member_type=$_REQUEST['type'];
if($action=='Add')
{
    @extract(post); 
	$useID=db_query("select * from ".DB.".tbl_member where user_id='$user_id'");
	$emailID=db_query("select * from ".DB.".tbl_member where email ='$email'");
	$num1=mysql_num_rows($useID);
	$num2=mysql_num_rows($emailID);
	if($num1>0 || $num2 > 0 )
	{  
	Set_Display_Message("Userid/Emailid All ready exits..."); 
	header("Location:register.php");
    exit();
	}else
	{	 
$ins=db_query("insert into ".DB.".tbl_member(user_id,mem_type,upass,fname,lname,phone_no,email,bil_address,bil_city,bil_state,bil_country,bil_zip,bil_phone,bil_fax,ship_address,ship_city,ship_state,ship_country,ship_zip,ship_phone,ship_fax,status) values('$user_id','$member_type','$upass','$fname','$lname','$phone_no','$email','$bil_address','$bil_city','$bil_state','$bil_country','$bil_zipcode','$bil_phone','$bil_fax','$ship_address','$ship_city','$ship_state','$ship_country','$ship_zipcode','$ship_phone','$ship_fax','1')");	
	$mem_id=mysql_insert_id();	
             /****** Email *********/
			$seladmin=db_query("select * from ".DB.".tbl_admin");
			$rw=mysql_fetch_array($seladmin);
			$admin_Mail=$rw['admin_email'];
			$to="$email";
			$ContactPerson="avalan";
			$eMail="info@avalan.com";
			$headers = "From: $ContactPerson<$eMail> \n";
			$headers .= "Reply-To: $eMail \r\n";
			$headers .= "X-Mailer: PHP/". phpversion();
			$headers .= "X-Priority: 3 \n";
			$headers .= "MIME-version: 1.0\n";
			$headers .= "Content-Type: text/html; charset=UTF-8\n";
			$contents="Dear ";
			$contents = $contents .$fname.$lname.",";
			$contents = $contents ."\r\n";
			$contents = $contents ."\r\n";
			$contents = $contents ."Thanks for your registration to the avalan site";
			$contents = $contents ."\r\n";
			$contents = $contents ."\r\n";
			$contents = $contents ."Your login details are as follows:";
			$contents = $contents ."\r\n";
			$contents = $contents ."\r\n";			
			$contents = $contents ."<b>User name :</b>".@$_REQUEST['user_id'];
			$contents = $contents ."\r\n";
			$contents = $contents ."<b>Password  :</b>".@$_REQUEST['upass'];
			$contents = $contents ."\r\n";
			$contents = $contents ."\r\n";			
			$contents = $contents."Click here if you would like to log-in: ".SITE_WS_PATH;	
			$contents = $contents ."\r\n";
			$contents = $contents ."\r\n";	
			$contents = $contents ."Yours sincerely,";
			$contents = $contents ."\r\n";
			$contents = $contents ."The avalan Team";	
	        $contents =nl2br($contents);
	       $subject1= "Welcome to avalan.com";
           mail($to,$subject1,$contents,$headers);	  
	       $_SESSION['userId']=$mem_id;		 
	       $_SESSION['user_name']=$user_id;
		   $_SESSION['mem_type']=$member_type;
		   Set_Display_Message("Welcome $user_name , you have successfully registered at www.avalan.com");	    	    
           header("Location:?file=manage_member");
		   exit();	
          /*****************End mail section  ***********************/ 
     }
 } 
 ?>
  <script type="text/javascript" src="../js/common-functions.js"></script>
  <script type="text/javascript" src="../js/ajax.js"></script>
<?=PageTitle('Add New Member');?>
<div align="right"><a href="?file=manage_member">Back to List</a>&nbsp;</div><br>
<form name="buyerreg" method="post" action="" onSubmit="return validate_reg();">
      <table width="100%"  border="0" cellpadding="2" cellspacing="2" class="td_btm_brdr">     
        <tr>
          <td colspan="2" align="center" class="price-style" ><?=Display_Message();?></td>
        </tr>       
        <tr>
          <td colspan="2" align="left" class="heading" ><div align="right"><span class="style-sml">(<span >*</span>) <span class="star" style="padding-right:15px;">All fields are mandatory</span></span></div></td>
        </tr>
       
        <tr align="left" valign="top" bgcolor="#e1e4e6" >
         <td colspan="3" align="left" bgcolor="#e1e4e6" class="heading-bg" style="padding-left:15px; "><strong>Login Details </strong></td>
        </tr>
		 <tr valign="top" >
          <td align="right" >&nbsp; </td>
          <td align="left" ><div id="txtHint1" style="font-size: 11px;font-weight: bold;color:#FF3300"> </div></td>
        </tr>		
         <tr valign="top" bgcolor="#e1e4e6" >
           <td align="right" >Select Type: </td>
           <td align="left" ><select name="member_type">
		   <option value="normal">Normal</option>
		    <option value="dealers">Dealers</option>
           </select></td>
         </tr>
        <tr valign="top" bgcolor="#e1e4e6" >
          <td align="right" >* User Id : </td>
          <td align="left" >
            <input name="user_id" type="text"  style="width:220px;" onblur="return check_user()" />
            <input type="button" name="check" id="check" class="but3" value="Check" onclick="return check_user()"/>
          </td>
        </tr>       
        <tr valign="top" >
          <td align="right" >* Password : </td>
          <td align="left" ><input name="upass" type="password"  style="width:220px;" /></td>
        </tr>
        <tr valign="top" bgcolor="#e1e4e6" >
          <td align="right" >* Confirm Password : </td>
          <td align="left" ><input name="cpass" type="password"  style="width:220px;" /></td>
        </tr>
        <tr bgcolor="#e1e4e6">
           <td colspan="3" align="left" bgcolor="#e1e4e6" class="heading-bg" style="padding-left:15px; "><strong> Personal Details</strong></td>
        </tr>
        <tr valign="top" bgcolor="#e1e4e6" >
          <td width="39%" align="right">* First Name : </td>
          <td width="61%" align="left" >
            <input name="fname" type="text"  style="width:220px;" id="fname" value="<?=$fname;?>" /></td>
        </tr>
        <tr valign="top" >
          <td align="right" >* Last Name : </td>
          <td align="left" ><input name="lname" type="text"  style="width:220px;" id="lname" value="<?=$lname;?>" /></td>
        </tr>
        <tr valign="top" bgcolor="#e1e4e6" >
          <td align="right" >* Phone No. : </td>
          <td align="left" ><input name="phone_no" type="text"  style="width:220px;" id="phone_no" value="<?=$phone_no;?>" />
        (660) 111-1111</td>
        </tr>
        <tr valign="top" >
          <td align="right" >*Email. : </td>
          <td align="left" ><input name="email" type="text"  style="width:220px;" id="email" value="<?=$email;?>" /></td>
        </tr>
        <tr bgcolor="#e1e4e6">
          <td colspan="3" align="left" class="heading-bg" style="padding-left:15px; "><strong> Your Billing Address</strong></td>
        </tr>
        <tr valign="top" >
          <td align="right" >* Street Address : </td>
          <td align="left" >
            <textarea name="bil_address" cols="25" rows="3" id="bil_address"><?=trim($bil_address);?></textarea>
          </td>
        </tr>
        <tr valign="top" bgcolor="#e1e4e6" >
          <td align="right" >* City :</td>
          <td align="left" ><input name="bil_city" type="text"  style="width:220px;" value="<?=$bil_city;?>" /></td>
        </tr>
        <tr valign="top" >
          <td align="right" >* State/Province : </td>
          <td align="left" ><input name="bil_state" type="text"  style="width:220px;" value="<?=$bil_state;?>" /></td>
        </tr>
        <tr valign="top" bgcolor="#e1e4e6" >
          <td align="right" >* Zip code : </td>
          <td align="left" ><input name="bil_zipcode" type="text"  style="width:220px;" id="bil_zipcode" value="<?=$bil_zipcode;?>" /></td>
        </tr>
        <tr valign="top" >
          <td align="right" >* Country : </td>
          <td align="left" ><select name="bil_country" id="bil_country" size="1" >
              <option value="">Country</option>
              <?
					 $selbilcountry=db_query("select * from ".DB.".tbl_country order by country_name");
					 while($bilcon=mysql_fetch_array($selbilcountry)){
					 ?>
              <option value="<?=$bilcon['country_id'];?>">
              <?=$bilcon['country_name'];?>
              </option>
              <? } ?>
          </select></td>
        </tr>
        <tr valign="top" bgcolor="#e1e4e6" >
          <td align="right" >* Telephone Number: *</td>
          <td align="left" ><input name="bil_phone" type="text"  style="width:220px;" value="<?=$bil_phone;?>" />
        (660) 111-1111</td>
        </tr>
        <tr valign="top" >
          <td align="right" > Fax Number:</td>
          <td align="left" ><input name="bil_fax" type="text"  style="width:220px;" value="<?=$bil_fax;?>" /></td>
        </tr>
        <tr align="left">
          <td colspan="2"  class="bg_color00"><table width="100%"  border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td class="txt_bluebold"><span class="txt_blackbold"> Your Shipping Details: </span></td>
                <td class="txt_bluebold"><input id="check_add" name="check_add" type="checkbox" value="Y" onclick="Check_Bill_Ship(this.form);" />
                    <span class="txt_blackbold"> Same as billing information</span></td>
              </tr>
          </table></td>
        </tr>
        <tr bgcolor="#e1e4e6">
           <td colspan="3" align="left" bgcolor="#e1e4e6" class="heading-bg" style="padding-left:15px; "><strong> Your Shipping Address </strong></td>
        </tr>
        <tr valign="top" >
          <td align="right" >* Street Address : </td>
          <td align="left" ><textarea name="ship_address" cols="25" rows="3" ></textarea></td>
        </tr>
        <tr valign="top" bgcolor="#e1e4e6" >
          <td align="right" >* City :</td>
          <td align="left" ><input name="ship_city" type="text"  style="width:220px;" id="ship_city" /></td>
        </tr>
        <tr valign="top" >
          <td align="right" >* State/Province :</td>
          <td align="left" ><input name="ship_state" type="text"  style="width:220px;" id="ship_state" /></td>
        </tr>
        <tr valign="top" bgcolor="#e1e4e6" >
          <td align="right" >* Zip code : </td>
          <td align="left" ><input name="ship_zipcode" type="text"  style="width:220px;" id="ship_zipcode" /></td>
        </tr>
        <tr valign="top" >
          <td align="right" >* Country : </td>
          <td align="left" ><select name="ship_country" id="ship_country" size="1" >
              <option value="">Country</option>
              <?
					 $selshipcountry=db_query("select * from ".DB.".tbl_country order by country_name");
					 while($shipcon=mysql_fetch_array($selshipcountry)){
					?>
              <option value="<?=$shipcon['country_id'];?>" >
              <?=$shipcon['country_name'];?>
              </option>
              <? } ?>
          </select></td>
        </tr>
        <tr valign="top" bgcolor="#e1e4e6" >
          <td align="right" >* Telephone Number: </td>
          <td align="left" ><input name="ship_phone" type="text"  style="width:220px;" id="ship_phone" />
        (660) 111-1111</td>
        </tr>
        <tr valign="top" >
          <td align="right" > Fax Number:</td>
          <td align="left" ><input name="ship_fax" type="text"  style="width:220px;" id="ship_fax" /></td>
        </tr>
        <tr align="left">
          <td colspan="2"><?php if($_REQUEST[type]=="dealers" ) { ?>
		  <a href="terms_and_condition.php">Terms and Condition</a> <? } ?></td>
          </tr>
        <tr align="left">
          <td align="right"><input type="submit"  name="Submit" value="Submit" class="but3" /></td>
          <td align="left"><input type="reset"  name="Submit" value="Reset" class="but3" />
              <input type="hidden" name="action" value="Add"></td>
        </tr>
      </table>
</form>