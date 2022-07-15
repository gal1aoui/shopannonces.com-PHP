<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");
require_once("header.inc.php");

$stat=@$_REQUEST['stat'];
$start = intval($start);
$pagesize = intval($pagesize)==0?$pagesize=DEF_PAGE_SIZE:$pagesize;
$columns = "select * ";
$sql = " from ".DB.".tbl_help_category ";
$order_by == '' ? $order_by = DB.'.tbl_help_category .cat_order' : true;
$sql_count = "select count(*) ".$sql; 
$sql .= "order by $order_by $order_by2 ";
$sql .= "limit $start, $pagesize ";
$sql = $columns.$sql;
$result = db_query($sql);
$reccnt = db_scalar($sql_count);
if($reccnt >0 ) {
 while($row=mysql_fetch_array($result)){
 $cat_arr[]=array('cat_id'=>$row['cat_id'],'cat_name'=>$row['cat_name']);
  }
}

if($_REQUEST[hpId]!=""){
$tmpID = intval($_REQUEST[hpId]);
$sql_help="select * from tbl_help where help_catid='$tmpID' ";
$rs_help = db_query($sql_help);
}
if($_REQUEST[qId]!=""){
$tmpID = intval($_REQUEST[qId]);
$sql_help="select * from tbl_help where help_id='$tmpID' ";
$rs_help = db_query($sql_help);
}
$main_catId=($_REQUEST[hpId]!="") ? intval($_REQUEST[hpId]) : intval($_REQUEST['divId']);
$main_cat=getResult('tbl_help_category',"where cat_id=$main_catId");
?>

<table border="0" align="center" cellpadding="0" cellspacing="0" class="cate-border" bgcolor="#FFFFFF">
  <tr>
    
    <td width="807" valign="top" style="padding:5px 5px 0 15px;"><table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td class="main-heading"><?php echo ucfirst($main_cat['cat_name']);?></td>
        </tr>
      <tr>
        <td width="33%" valign="top" class="tree"><a href="index.php">Accueil</a> >> Aide </td>
        </tr>
      <tr>
        <td valign="top" style="padding-top:3px;">
		<?php if(mysql_num_rows($rs_help) > 0){
		    while($res_help=mysql_fetch_array($rs_help)){			
			 ?>
		<table width="100%" border="0" cellpadding="3" cellspacing="0" class="cate-border mt10">
          <tr>
            <td width="91%" class="bg-stripcolor heading p7"><?php echo ucfirst($res_help['help_quest']);?></td>
            </tr>
          <tr>
            <td class="pl10 pr10"><?php echo (html_entity_decode($res_help['help_ans']));?></td>
            </tr>
        </table>
		<?php }
		 }
		?>	
          </td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td valign="top" style="padding:5px 0 0 3px;">&nbsp;</td>
    <td valign="top" style="padding:5px 5px 0 15px;">&nbsp;</td>
  </tr>
</table>
<?php require_once("footer.inc.php"); ?>