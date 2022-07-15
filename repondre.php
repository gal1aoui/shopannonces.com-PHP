<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$cryptinstall="cryptographp.fct.php";
include $cryptinstall;


$enq_id=$_REQUEST['enq_id'];
$sql = "select * from tbl_classified_inquiry
where memId ='$_COOKIE[memId]' and enq_id='$enq_id'";

$rs_msg=db_query($sql);


$rw=mysql_fetch_array($rs_msg);
?>

<form  action="sendreponse.php" method="post" enctype="multipart/form-data" onSubmit="return validate_classified_inquire(this);" target="postFrame">
	<table  width="100%" border="0" cellpadding="2" cellspacing="2">
    <tr>
        <td align="left" valign="top">&nbsp;Votre Nom </td>
        <td align="left" valign="top">
        <?php
            $sqlname = "select * from tbl_member where user_id ='$_COOKIE[userId]' ";
            $rs_name=db_query($sqlname);
            if($rw_n=mysql_fetch_array($rs_name)){ 
                if($rw_n["lname"]==""){
                ?>
                    <input type="sender_name" name="sender_name" class="textbox" value="<?php echo $_COOKIE['user_name'];?>" required="required">
                <?php
                }
                else{?>
                    <input type="sender_name" name="sender_name" class="textbox" value="<?php echo $rw_n["lname"];?>" readonly  required="required">
                    <?php
                }
            }
        ?>
        </td>
    </tr>
    
    <tr class="<?php echo $bg;?>">
        <td width="17%" align="left" valign="top">* Sujet </td>
        <td width="83%" align="left" valign="top">
            <input type="text" name="subject" class="textbox" required="required">
        </td>
    </tr>
    <tr class="<?php echo $bg;?>">
        <td align="left" valign="top">* Message</td>
        <td align="left" valign="top">
        <textarea name="msg" cols="50" rows="4" class="textbox" required></textarea>
        </td>
    </tr>
    
    <tr>
        <td align="right"><?php dsp_crypt(0,1); ?></td>
        <td><input type="text" name="code" id="code" class="textbox" required="required"></td>
    </tr>
    <tr>
        <td colspan="2" align="center">
            <h3 style="font-weight: bold;" id="msg_new" class="commentaire"></h3>
        </td>
    </tr>
    <tr align="center">
        <td align="center" colspan="2">
            <input type="hidden" name="enq_sender_name" value="<?php echo $rw[enq_sender_name];?>">
            <input type="hidden" name="to_email" value="<?php echo $rw[enq_sender_email];?>">
            <input type="hidden" name="act_rep" value="sendYes">
            <input type="hidden" name="email_arr[]" value="<?php echo $to_email;?>">
            
            <input type="submit" name="sub" value="Envoyer" class="button button-green" />
        </td>
    </tr>
    </table>
	<iframe name="postFrame" src="sendreponse.php" style="display:none"></iframe> 	
</form>
