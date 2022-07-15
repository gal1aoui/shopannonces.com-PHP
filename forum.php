<?php
require_once("includes/main.inc.php");
require_once("front-functions.php");

$arr=list($title,$description,$keyword)=get_meta_details('tbl_meta_tags','id','3');
$meta_titles=$title;
$meta_desc=$description;
$meta_keywords=$keyword;
require_once("header.inc.php");
$start=$_REQUEST[start];
$pagesize=$_REQUEST[pagesize];
$start = (intval($start)<0 or $start=="")?0:$start;
$pagesize = intval($pagesize)==0?$pagesize=10:$pagesize;
$key=secureValue($_REQUEST['topic_search']);
$sort_key=secureValue($_REQUEST['sort_by_date']);
$sort_by=secureValue($_REQUEST['sort']);
$ref=$_SERVER['REQUEST_URI'];

if($_REQUEST['auth']!="" && $_SESSION['memId']==""){
	header("Location:signin.php?ref=$ref");
	exit();   
}
if($sort_by=="week"){
	$week_date=date('Y-m-d',mktime(0,0,0,date('m'),date('d')-7,date('Y')));
	$d1=date('Y-m-d');
	$d2=$week_date;
}
if($sort_by=="month"){
	$month_date=date('Y-m-d',mktime(0,0,0,date('m')-1,date('d'),date('Y')));
	$d1=date('Y-m-d');
	$d2=$month_date;
}
if($sort_by=="more"){
	$month_more_date=date('Y-m-d',mktime(0,0,0,date('m')-6,date('d'),date('Y')));
	$d1=date('Y-m-d');
	$d2=$month_more_date;
}

$columns = "select * ";
$sql = " from forum_topics where status='Y' ";
if($key!=""){
 $sql.="and (topicTitle LIKE '%$key%') ";  
}
if($sort_by!="" && $sort_by!="all"){
 $sql.="and recv_date between '$d2' and '$d1' ";  
}
if($key!="" && $sort_by!="" && $sort_by!="all" ){
 $sql.="and (topicTitle LIKE '%$key%') and recv_date between '$d2' and '$d1' ";
}
$sql_count = "select count(*) ".$sql;
$reccnt=db_scalar($sql_count);
$sql.="order by topicID desc limit $start, $pagesize ";
$sql = $columns.$sql;
$qry= db_query($sql);	
?>
<table width="940" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
  	<td valign="top" align="center">
    <br />
     <?php session_start(); echo $link_left;?>
    </td>
    <td valign="top">
<table border="0" align="center" cellpadding="0" cellspacing="0" class="cate-border" bgcolor="#FFFFFF">
  <tr>
    <td valign="top" style="padding:5px 5px 0 15px;"><table width="100%" border="0" cellpadding="2" cellspacing="0">
      <tr>
        <td class="main-heading">Forum</td>
        </tr>
      <tr>
        <td width="33%" valign="top" class="tree">Forum &lt;&lt; <a href="index.php">Accueil</a></td>
        </tr>
      <tr>
        <td valign="top" style="padding-top:3px;">
		<form name="frm" action="" method="get">
          <table width="100%" border="0" cellspacing="0" cellpadding="2">
            <tr>
              <td width="26%"><p class=" pb10"><strong>Organisé par : </strong>
    <select name="sort_by_date" class="textbox1" onChange="document.location.href='forum.php?sort='+this.value;" >
				<option value="week" <?php if($sort_by=="week" ||$_REQUEST['sort_by_date']=="week") {echo"selected";} ?> >Une semaine</option><option value="month" <?php if($sort_by=="month" || $_REQUEST['sort_by_date']=="month") {echo"selected";} ?>>Un mois </option><option value="more" <?php if($sort_by=="more" || $_REQUEST['sort_by_date']=="more") {echo"selected";} ?>>Plus d'un mois</option><option value="more" <?php if($sort_by=="more" || $_REQUEST['sort_by_date']=="more") {echo"selected";} ?>>More than one month</option>
                </select></p></td>
              <td width="57%" align="center">
			 <input name="topic_search" type="text" class="textbox1"  style="width:200px; padding-top:5px;" value="Recherche sujet" onFocus="if(this.value=='Recherche sujet') this.value='';" onBlur="if(this.value=='') this.value='Recherche sujet';" /> 
                <input name="search" type="submit" value="GO" class="button" ></td>
              <td width="17%" align="right">
			  <?php if(isset($_SESSION['memId']) && $_SESSION['memId']!="") { ?>
			  <a href="post-topic.php?mid=<?php echo $_SESSION['memId'];?>" class="button" rel="facebox">Afficher sujet</a>
			  <?php } ?>
			  </td>
              </tr>
       </table>
	   </form> 
	    <?php echo Display_Message();?>         
         <?php include("paging.inc.php"); ?>
          <table width="100%" border="0" cellpadding="4"  cellspacing="2" class="cate-border mt10">
            <tr class="cate-stripcolor white-style b">
              <td width="22%">Sujet</td>
              <td width="6%">Répliques</td>
              <td width="13%">Créé</td>
              <td width="12%">Dernière réplique</td>
              <td width="15%">date d'adhésion </td>
              <td width="14%">Répliques affichées</td>
              <td width="6%">Voir profile</td>
              <td width="12%" align="left">Envoyer un message privé </td>
              </tr>
			   <?php
			   if($reccnt > 0) {
                $count=0;
                while($res=mysql_fetch_array($qry)){ 
                $count++;
				$bg=($count%2==0) ? "bg-stripcolor" : "";
				?> 
              <tr class="<?php echo $bg;?>">
              <td align="left">
			  <a href="forum-details.php?topicID=<?php echo $res[topicID];?>" class="link1 b"><?php echo str_stop(ucfirst(strtolower($res[topicTitle])),50); ?></a></td>
              <td><?php echo getTopicReply($res[topicID]);?></td>
              <td align="left"><?php echo forumchangedate($res[recv_date]);?> par<strong>
			 <?php if($res[memberID]>0) { echo getMemberFullName($res[memberID]); }else{ echo "Admin"; } ?>
			 </strong></td>
			   <td align="left">
			   <?php if(getTopicReply($res[topicID])>0) { 
			   list($name,$repdate)=getLastForumReply($res[topicID]);
			   echo forumchangedate($repdate);?><strong><?php echo $name;?></strong>
			  <?php }else{ echo "No Reply"; } ?>
			 </td>
              <td align="left"><?php if($res[memberID]>0) { echo member_join_date($res[memberID]); }else{ echo "Added by admin" ;}?></td>
              <td>
	<?php if(isset($_SESSION['memId'])&& $_SESSION['memId']!=""){ ?>
	<a href="forum-details.php?topicID=<?php echo $res[topicID];?>" class="link1 u">Répliques affichées</a>	 
	 <?php }else{ ?>
	  <a href="forum-details.php?topicID=<?php echo $res[topicID];?>&reply=Y" class="link1 u">Répliques affichées</a>	 
	 <?php } ?>
	 
	    </td>
              <td>
			  <?php if(isset($_SESSION['memId'])&& $_SESSION['memId']!=""){ ?>
			  <a href="view-profile.php?mId=<?php echo $res[memberID];?>" class="link1 u" rel="facebox">Voir</a>
			  <?php }else{ ?>
			   <a href="forum.php?auth=N" class="link1 u" >Voir</a>
			   <?php } ?>
			  </td>			  
              <td>
			  <?php if(isset($_SESSION['memId'])&& $_SESSION['memId']!=""){ ?>
			  	<a href="send-message.php?mId=<?php echo $res[memberID];?>" class="link1 u" rel="facebox">Message</a>
			  <?php 
			  }else{ ?>
			  	<a href="forum.php?auth=N" class="link1 u" >Message</a>
			   <?php 
			   }?>
			  </td>
			  </tr>
			  
			  <?php }			   
			   }else{
			   ?>
			     <tr class="bg-stripcolor"><td align="center" colspan="8">
				 <p>
				 <strong> Aucun dossier trouvé....</strong>
				 </p>
				 </td>
				 </tr>
			 <?php } ?>
            </table>
          <?php include("paging.inc.php"); ?></td>
        </tr>
    </table></td>
  </tr>
</table>
</td>
</tr>
</table>
<?php require_once("footer.inc.php"); ?>