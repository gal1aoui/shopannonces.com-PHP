
<form  action="classified-send-enquiry.php" method="post" onSubmit="return validate_classified_inquire(this);">
             <div class="CollapsiblePanelTab ar">			 
			  <img src="images/close.gif" alt="" border="0"/></div>
                <div>
                  <table width="100%" border="0" cellpadding="4" cellspacing="0" class="green-bgcolor white-style">
                    <tr>
                      <td width="7%" align="left" class="b">Name: &nbsp; </td>
                      <td width="17%" align="left" class="b"><input name="sender_name" type="text" class="textbox1" style="width:120px;"/></td>
                      <td width="28%" class="b">Email  : &nbsp;
                      <input name="sender_email" type="text" class="textbox1" style="width:120px;"/></td>
                      <td width="39%" align="left" class="b">Message : &nbsp;
                      <textarea name="sender_msg" type="text" rows="6" class="textbox1" style="width:300px;"/></textarea></td>
                      <td width="9%"><input name="sub" type="image" src="images/submit-btn.jpg" />					   </td>
                    </tr>
                    <tr>
                      <td colspan="2" align="left" class="b"><span class="fs11">
					  <?php
						$a13_catID = (!empty($_REQUEST['catId']) && is_numeric($_REQUEST['catId'])) ? intval($_REQUEST['catId']) : 0;
						$a13_subcatID = (!empty($_REQUEST['subcatId']) && is_numeric($_REQUEST['subcatId'])) ? intval($_REQUEST['subcatId']) : 0;
						$a13_start = secureValue($_REQUEST['start']);			
					  ?>
                        <input name="catId" type="hidden" value="<?php echo $a13_catID;?>">
                        <input name="subcatId" type="hidden" value="<?php echo $a13_subcatID;?>">
                        <input name="start" type="hidden" value="<?php echo $a13_start;?>">
                        <input name="act" type="hidden" value="snd_inq">
                        <input name="posterId" type="hidden" value="<?php echo $rw['mem_id'];?>">
                        <input name="clsId" type="hidden" value="<?php echo $rw['classified_id'];?>">
                              
                    </tr>
                  </table>
                </div>
				</form>