<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("multiple-currency.php");
$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','1');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;
require_once("header.inc.php");
$cat_Arr=main_cat_array();
$Paid_amount=get_config_setting(11);
$rID = intval($_REQUEST[rid]);
db_query("update tbl_advertise set amount ='$Paid_amount' where id ='$rID'");
?>

<div class="grid_3">
    <?php session_start(); echo $link_left;?>
</div>

<div class="grid_13" style="background-color:#FFFFFF; min-height:600px;">

	<div class="main-heading">Payer maintenant</div>
    

	<div class="tree">
    	<a href="index.php">Accueil</a> >> Payer maintenant
	</div>
    
	<div class="mt17">
		<?php echo Display_Message();?>
	</div>

	<div class="mt17">
		<form action="my-account-pay.php" method="post" enctype="multipart/form-data" onSubmit="return validate_advertise(this);">
		    <table width="100%" border="0" cellpadding="4"  cellspacing="2" class="cate-border mt10">
              <tr align="center" class="cate-stripcolor white-style b">
                <td colspan="3" align="left">Payer maintenant</td>
              </tr>             
              <tr>
                <td align="left">&nbsp;</td>
              </tr>
              <tr align="center">
                <td align="left">Montant total : </td>
                <td width="29%" align="left">
                  <?php echo $_SESSION['curSymbol'];?>
                  <input name="amount" type="text" value="<?php echo display_price($Paid_amount);?>" size="8" class="textbox1" readonly=""></td>
                <td width="47%" align="left"> <img src="images/paypal-icon.jpg" width="194" height="66"></td>
              </tr>
              <tr align="center">
                <td align="left">&nbsp;</td>
                <td colspan="2" align="left"><input type="submit" name="Submit" value="Payer maintenant" class="button button-green"></td>
              </tr>
              <tr align="center">
                <td width="24%" align="left">&nbsp;</td>
                <td colspan="2" align="left">				
                  <input name="rf" type="hidden" value="advertise">
                  <input name="rid" type="hidden" value="<?php echo $rID;?>"> 
				  <input name="curr_type" type="hidden" value="<?php echo $_SESSION['cur_code'];?>">                
                </td>
              </tr>
            </table>
          </form>
	</div>
</div>
<?php require_once("footer.inc.php"); ?>