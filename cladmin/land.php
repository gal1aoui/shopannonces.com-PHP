<?php
session_start();
	require_once("admin_header.inc.php");	?>
    
	<table cellSpacing=0 cellPadding=0 width="100%">	
		<TR>
			<TD width="170" vAlign="top" id="leftnav">
				<?php include_once("admin_left.inc.php"); ?>
			</TD>
			<TD vAlign=top id="tdRight" align="center" >
				<table width="100%" border="0" cellspacing="0" cellpadding="0">
				  <tr>
					<td align="center" valign="top"><?php echo Display_Message();?></td>
				  </tr>
				  <tr>
					<td align="center" valign="top">
				<?php					 
				 if(isset($_REQUEST['file'])&& $_REQUEST['file']!="")
				 {
					   $req=$_REQUEST['file'];                           
					   $file=$req;
						$file.=".php";					   
						//$real_file_path="CLscript_French_upload/cladmin/".$file;
						//exit();
						  if(file_exists($file))
						  {
							include_once($file);
						   }
						   else{
						   echo "File not exists !!....";
						   exit();
						   }			   					   
						   
				 }else{
				 include_once("admin_welcome.php");
				  }
				  ?></td>					  
				</tr>
				</table>
			</TD>
		</TR>	
	</TABLE>
	<?php include_once("admin_footer.inc.php"); ?>
	