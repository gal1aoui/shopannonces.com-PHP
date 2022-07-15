<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("header.inc.php");
chk_user_login();

$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=15:$pagesize;
$columns = "select SQL_CALC_FOUND_ROWS *,DATE_FORMAT(date,'%D %M %Y') as post_date ";
$sql = " from ".DB.".tbl_private_message
where to_mem_id ='$_COOKIE[memId]' and msg_status!='Delete' limit $start, $pagesize ";

$sql = $columns.$sql; 
$rs_msg=db_query($sql);	
$res_msg = mysql_fetch_array(db_query("Select FOUND_ROWS() as total")); 
$reccnt=$res_msg['total'];

/* Member Delete  own  message classified */
if(isset($_REQUEST[act]) && $_REQUEST[act]!="")
{
$tmpID = intval($_REQUEST['Id']);
$condition="where msg_id=$tmpID and to_mem_id ='$_COOKIE[memId]'";
if($_REQUEST[act]=="D"){
	  db_query("UPDATE tbl_private_message SET msg_status ='Delete' $condition ");
	  Set_Display_Message("Votre message effacé avec succès....");
	  header("Location:my-account-messages.php");
	  exit();
	  }
}
/* End Member Delete  own  message classified */

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
    <td valign="top" style="padding:5px 5px 0 15px;"><table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td class="main-heading">Voir message privé (Forum)</td>
        </tr>
      <tr>
         <td width="33%" valign="top" class="tree">Voir message privé &lt;&lt; <a href="my-account.php">Mon compte</a> &lt;&lt; <a href="index.php">Accueil</a></td>
      </tr>
      <tr>
        <td style="padding-top:3px;">
           <div class="p3 ar">Bienvenue <span class="heading">
            <?php echo $_COOKIE['user_name'];?>
          </span>&nbsp;&nbsp; <a href="my-account.php" class="link1 b">(Mon compte)</a>&nbsp;&nbsp; <a href="logout.php" class="link1 b">(Déconnecter)</a></div>
		 
          <table width="100%" border="0" cellspacing="0" cellpadding="0">
		  <tr><td align="left"><?php echo Display_Message();?></td></tr>
          <tr>
            <td width="78%" valign="top" class="col-border pr15">
			<?php include("paging.inc.php"); ?>
			<?php
				if($reccnt > 0 ) {
                $count=0;
                while($rw=mysql_fetch_array($rs_msg)){ 
                $count++;
				$bg=($count%2==0) ? "bg-stripcolor" : "";
				?>
              <table width="100%" border="0" cellpadding="2" cellspacing="0" class="mt10">
                <tr>
                  <td width="74%">
				  <span class="b"><?php echo Rec_display_formate($rw['poster_name']);?></span>
				  </td>
                  <td width="26%" align="right">[
                    <?php echo $rw['post_date'];?>
                    ] </td>
                </tr>
                <tr>
                  <td colspan="2" valign="top">&nbsp;</td>
                </tr>
                <tr>
                  <td colspan="2" valign="top"><?php echo Rec_display_formate($rw['poster_msg']);?></td>
                </tr>
                <tr>
                  <td colspan="2" align="right" class="border-bot">
			<a href="my-account-messages.php?act=D&Id=<?php echo $rw[msg_id];?>" class="link1 b" onClick=" return confirm('Êtes vous certain de vouloir effacer cette entrée?');">Effacer</a></td>
                </tr>
              </table>
			  <?php } 
			  }else{ ?>
			   <table width="100%" border="0" cellpadding="2" cellspacing="0" class="mt10">
              <tr class="bg-stripcolor">
			  <td colspan="5" align="center">
			  <strong>Aucun message trouvé....</strong>
			  </td>
			  </tr>
			   </table>          		 
			 <?php } ?>
			  <?php include("paging.inc.php"); ?></td>
            <td width="22%" valign="top" class="account-link pl15 pt11">
			<?php require_once("my_account_links.php"); ?></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
</td>
</tr>
</table>
<?php require_once("footer.inc.php"); ?>