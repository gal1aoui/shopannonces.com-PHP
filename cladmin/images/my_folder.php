<?php
require_once("include/front-application.php");
if($_SESSION[mySessionId]==''){
	header("location:member_login.php");
	exit;
}else{
	$id=getSessionMemberDetail($_SESSION[mySessionId],0);
$fqry1=db_query("select * from mymembers  where memberId='$id'");


}
	?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<title>inside</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<link href="style.css" rel="stylesheet" type="text/css">
<script src="Scripts/AC_RunActiveContent.js" type="text/javascript"></script>
</head>
<body>
<!-- ImageReady Slices (inside.psd) -->
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="136" background="images/pgtopbg.jpg"><table width="940" border="0" align="center" cellpadding="0" cellspacing="0" id="Table_01">
      <tr>
        <td height="136"><script type="text/javascript">
AC_FL_RunContent( 'codebase','http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0','width','940','height','136','src','flash/top','quality','high','pluginspage','http://www.macromedia.com/go/getflashplayer','movie','flash/top' ); //end AC code
</script><noscript><object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=6,0,29,0" width="940" height="136">
            <param name="movie" value="flash/top.swf">
            <param name="quality" value="high">
            <embed src="flash/top.swf" quality="high" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" width="940" height="136"></embed>
        </object></noscript></td>
      </tr>
    </table></td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td valign="top">
	  <div class="lnkpgcarea">
	  <div class="outer">
		  <div class="inner">
			  <div class="lnkpgcontent">
				<table width="100%"  border="0" align="center" cellpadding="00" cellspacing="0">
				  <tr>
				    <td class="heading_underline"><table width="100%"  border="0" cellspacing="0" cellpadding="00">
                      <tr>
                        <td><span class="heading_01">My</span> <span class="heading_01a">Folder</span></td>
                        <td align="right" valign="bottom" class="content_unjustify_wht"><a href="http://localhost/toywalanew/index.php?work=out" class="content_unjustify_wht">Logout</a></td>
                      </tr>
                    </table></td>
			      </tr>
				  <tr>
					<td>&nbsp;</td>
				  </tr>
				  <tr>
					<td>
					<table width="100%"  border="0" cellspacing="0" cellpadding="00">
					<tr><td>
					<?php
print 				"<table width='100%'  border='0' cellspacing='0' cellpadding='15'>";
                    $row=mysql_fetch_array($fqry1);
					$arr=explode(',',$row[bid]);
					$count=count($arr);
					$xx=1;
					for($i=0;$i<$count;$i++)
					{			
					if(($xx%5==0) or $xx==1)
					print "<tr>";
					$strimg="select * from tbl_brands where bid='$arr[$i]'";
					$fqry1=db_query($strimg);
					$fetch=mysql_fetch_array($fqry1);
					$imgx=$fetch['brand_logo'];
					$bname=$fetch['brand_name'];
					print "<td> <a href='my_folder_form.php?id=$arr[$i]&bname=$bname' ><img src='images/brandimages/$imgx' height='100' width='100'  style='border:#FFFFFF'></a></td>";
					if($xx%4==0)
					print "</tr>";
					$xx++;
					}
				print "</table>"
					?>
                    </td>
                    </tr>
                    </table>                    
                    </td>
				  </tr>
				  <tr>
				    <td>&nbsp;</td>
			      </tr>
				  <tr>
				    <td>&nbsp;</td>
			      </tr>
				</table>
			</div>
			</div>
		</div>
</div>	</td>
  </tr>
</table>
<table width="100%"  border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td height="42" align="center" background="images/footer_bg.jpg" class="footer">Copyright &copy; 2008 EnnEss Trade Private Limited</td>
  </tr>
</table>
<!-- End ImageReady Slices -->
</body>
</html>