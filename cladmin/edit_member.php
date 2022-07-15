<?php
$mem_id=@$_REQUEST['mem_id'];
$action=@$_REQUEST['action'];
$fname=@$_REQUEST['fname'];
$lname=@$_REQUEST['lname'];
$phone_no=@$_REQUEST['phone_no'];
$email=@$_REQUEST['email'];
$bil_address=@$_REQUEST['bil_address'];
$bil_zip=@$_REQUEST['bil_zip'];
$bil_city=@$_REQUEST['bil_city'];
$bil_state=@$_REQUEST['bil_state'];
$bil_country=@$_REQUEST['bil_country'];
$bil_phone=@$_REQUEST['bil_phone'];
$bil_fax=@$_REQUEST['bil_fax'];
$ship_address=@$_REQUEST['ship_address'];
$ship_zip=@$_REQUEST['ship_zip'];
$ship_city=@$_REQUEST['ship_city'];
$ship_state=@$_REQUEST['ship_state'];
$ship_country=@$_REQUEST['ship_country'];
$ship_phone=@$_REQUEST['ship_phone'];
$ship_fax=@$_REQUEST['ship_fax'];
if($action=='Add')
 {
  $update=db_query("update tbl_member set fname='$fname',lname='$lname',phone_no='$phone_no',email='$email',bil_address='$bil_address',bil_city='$bil_city',bil_state='$bil_state',bil_country='$bil_country',bil_zip='$bil_zip',bil_phone='$bil_phone',bil_fax='$bil_fax',ship_address='$ship_address',ship_city='$ship_city',ship_state='$ship_state',ship_country='$ship_country',ship_zip='$ship_zip',ship_phone='$ship_phone',ship_fax='$ship_fax' where mem_id='$mem_id'");
  $_SESSION['site_admin_message']="Member Information updated  Successfully.........";
  header("Location:?file=manage_member");
  exit();
 }
 ?>
<?
$mem_id=@$_REQUEST['mem_id'];
$selcat=db_query("select * from tbl_member where mem_id='$mem_id'");
$rw=mysql_fetch_array($selcat);
?>
<?=PageTitle('Update Member Information');?>
<div align="right"><a href="?file=manage_member">Back to Decades</a>&nbsp;</div><br>
<form name="buyerreg" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="100%" border="0" cellpadding="4"  cellspacing="1">
                <tr bgcolor="#CCCCCC" class="white">
					<input type="hidden" name="action" value="Add">
					<input type="hidden" name="mem_id" value="<?=$mem_id;?>">
                  <td colspan="2" class="border_bot"><span class="b white"><strong> Personal Details : </strong></span></td>
    </tr>
				 
                <tr valign="top" class="border_bot">
                  <td width="50%" align="right" class="border_bot"> <span class="style1">*</span> First Name : </td>
                  <td width="50%" align="left" class="border_bot"><input name="fname" type="text" class="input2" size="25" value="<?=$rw['fname'];?>"></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td width="50%" align="right" class="border_bot"> <span class="style1">*</span> Last Name : </td>
                  <td width="50%" align="left" class="border_bot"><input name="lname" type="text" class="input2" size="25" value="<?=$rw['lname'];?>"></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td width="50%" align="right" class="border_bot"> <span class="style1">*</span> Phone No. : </td>
                  <td width="50%" align="left" class="border_bot"><input name="phone_no" type="text" class="input2" size="25" value="<?=$rw['phone_no'];?>"></td>
                </tr>
				 <tr valign="top" class="border_bot">
                  <td width="50%" align="right" class="border_bot"> <span class="style1">*</span>Email. : </td>
                  <td width="50%" align="left" class="border_bot"><input name="email" type="text" class="input2" size="25" value="<?=$rw['email'];?>"></td>
                </tr>
                <tr align="left" valign="top" class="border_bot">
                  <td colspan="2">&nbsp;</td>
                </tr>
                <tr align="left" valign="top" bgcolor="#CCCCCC" class="border_bot">
                  <td colspan="2" class="border_bot"><span class="b white"><strong>Your Billing Address
 :
                  </strong></span></td>
    </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> Street Address : </td>
                  <td align="left" class="border_bot"><textarea name="bil_address" cols="25" rows="3" class="input2"><?=$rw['bil_address'];?></textarea></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"><span class="style1">*</span> Zip code : </td>
                  <td align="left" class="border_bot"><input name="bil_zip" type="text" class="input2" size="25" value="<?=$rw['bil_zip'];?>"></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> City  : </td>
                  <td align="left" class="border_bot"><input name="bil_city" type="text" class="input2" size="25" value="<?=$rw['bil_city'];?>"></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> State/Province  : </td>
                  <td align="left" class="border_bot"><input name="bil_state" type="text" class="input2" size="25" value="<?=$rw['bil_state'];?>"></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> Country  : </td>
                  <td align="left" class="border_bot">
				  <select name="bil_country" id="bil_country" size="1" class="input2">
                    <option value="">Country </option>
                    <?
					 $selbilcountry=db_query("select * from tbl_country  order by country_name");
					 while($bilcon=mysql_fetch_array($selbilcountry)){
					?>
					<option value="<?=$bilcon['country_id'];?>" <? if($bilcon['country_id']==$rw['bil_country']){ echo "Selected";}?>><?=$bilcon['country_name'];?></option>
					<? } ?>
                  </select></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> Telephone Number: <span class="style1">*</span></td>
                  <td align="left" class="border_bot"><input name="bil_phone" type="text" class="input2" size="25" value="<?=$rw['bil_phone'];?>"></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"><span class="style1">*</span> Fax Number:</td>
                  <td align="left" class="border_bot"><input name="bil_fax" type="text" class="input2" size="25" value="<?=$rw['bil_fax'];?>"></td>
                </tr>
                <tr align="left" valign="top" class="border_bot">
                  <td colspan="2">&nbsp;</td>
    </tr>
                <tr align="left" valign="top" bgcolor="#CCCCCC" class="border_bot">
                  <td colspan="2" class="border_bot"><span class="b white"><strong>Your 


 Shipping Details

 : </strong></span></td>
    </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> Street Address : </td>
                  <td align="left" class="border_bot"><textarea name="ship_address" cols="25" rows="3" class="input2"><?=$rw['ship_address'];?></textarea></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> Zip code : </td>
                  <td align="left" class="border_bot"><input name="ship_zip" type="text" class="input2" size="25" value="<?=$rw['ship_zip'];?>"></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> City : </td>
                  <td align="left" class="border_bot"><input name="ship_city" type="text" class="input2" size="25" value="<?=$rw['ship_city'];?>"></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> State/Province : </td>
                  <td align="left" class="border_bot"><input name="ship_state" type="text" class="input2" size="25" value="<?=$rw['ship_state'];?>"></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> Country : </td>
                  <td align="left" class="border_bot"><select name="ship_country" id="ship_country" size="1" class="input2">
                    <option value="">Country </option>
                    <?
					 $selshipcountry=db_query("select * from tbl_country  order by country_name");
					 while($shipcon=mysql_fetch_array($selshipcountry)){
					?>
					<option value="<?=$shipcon['country_id'];?>" <? if($shipcon['country_id']==$rw['ship_country']){ echo "Selected";}?>><?=$shipcon['country_name'];?></option>
					<? } ?>
                  </select></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> <span class="style1">*</span> Telephone Number: </td>
                  <td align="left" class="border_bot"><input name="ship_phone" type="text" class="input2" size="25" value="<?=$rw['ship_phone'];?>"></td>
                </tr>
                <tr valign="top" class="border_bot">
                  <td align="right" class="border_bot"> Fax Number:</td>
                  <td align="left" class="border_bot"><input name="ship_fax" type="text" class="input2" size="25" value="<?=$rw['ship_fax'];?>"></td>
                </tr>
                <tr align="left" valign="top" class="border_bot">
				 <td align="right" class="border_bot">&nbsp;</td>
                  <td><input type="submit" name="submit" value="Update Information"></td>
                </tr>
  </table>
</form>