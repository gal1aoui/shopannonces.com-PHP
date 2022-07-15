<?php
	require_once("../includes/main.inc.php");
	require_once("../includes/funcs_lib.inc.php");
	require_once("admin-function.php");
	
	$comp_name=get_config_setting(2);
?>
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<title></title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        

        <link rel="stylesheet" href="../css/ekko-lightbox.css">
		<link rel="stylesheet" href="../css/font-awesome.css">
		<link rel="stylesheet" href="./css/styles.css" type="text/css" />	      


		<script language="javascript" src="js/admin_js.js"></script>
		<script language="javascript" src="js/common_js.js"></script>
		<script language="javascript">
			var site_ws_path='<?php echo SITE_WS_PATH?>';
		</script>
		<script src="../facefiles/jquery-1.2.2.pack.js" type="text/javascript"></script>
		<link href="../facefiles/facebox.css" media="screen" rel="stylesheet" type="text/css" />
		<script src="../facefiles/facebox.js" type="text/javascript"></script>

<!--
		<script type="text/javascript">
			jQuery(document).ready(function($) {
			  $('a[rel*=facebox]').facebox() 
			})
		</script>
-->

		<script type="text/javascript" src="js/ajax.js"></script>

	</head>
	<body>
	 <DIV id=header>
		<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
		<TBODY>
			<TR>
				<TD style="PADDING-RIGHT: 0px; PADDING-LEFT: 25px; BACKGROUND: url(images/abstract.jpg) #295d9c no-repeat right 50%; PADDING-BOTTOM: 10px; PADDING-TOP: 25px; WHITE-SPACE: nowrap; HEIGHT: 61px; TEXT-ALIGN: left" align="middle" colSpan="2">
					<A style="TEXT-DECORATION: none" href="land.php"><STRONG><H4><?php echo $comp_name;?></H4></STRONG></A>
                    <?php echo $_SERVER['REMOTE_ADDR'];?>
				</TD>
			</TR>
			<TR>
				<TD colSpan=2 height=1></TD>
			</TR>
			<TR bgColor="#92b2d6">
				<TD colSpan=2 height=6></TD>
			</TR>
			<TR>
				<TD colSpan=2 height=1></TD>
			</TR>
			<TR>
				<TD background="images/top_bg.gif" height=66>
					<IMG alt="Control Panel" hspace=20 src="images/control_panel.gif">
				</TD>
				<TD vAlign=top background="images/top_bg.gif" height=66>
					<TABLE cellSpacing=0 cellPadding=0 width="100%" border=0>
					<TBODY>
						<TR>
							<TD align=right height=25>

							</TD>
						</TR>
						<TR>
							<TD align=right height=41>&nbsp; </TD>
						</TR>
					</TBODY>
					</TABLE>
				</TD>
			</TR>
		</TBODY>
		</TABLE>
	</DIV>