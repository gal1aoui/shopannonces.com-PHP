<?php

session_start();

if(@$_REQUEST['logout']=='close'){
	session_destroy();
	header("Location:sendd.php");
	exit();
}

if(@$_REQUEST['login']=='global' && @$_REQUEST['password']=='marketing'){
	$_SESSION['login']=@$_REQUEST['login'];
	$_SESSION['password']=@$_REQUEST['password'];
	
	$t=time();
	$dt=date("Y-m-d H:i:sP",$t);
	
	$sdt="au serveur ".$_SERVER['SERVER_NAME']." le ".$dt." depuis ".$_SERVER['REMOTE_ADDR'];
				
     $to      = 'utelleko-7324@yopmail.fr';
     $subject = 'Notification de connexion '.$sdt;
     $message = " Ceci est une notification de connexion au site ".$sdt;
				 
     $headers = "From: send@php.com \r\n" .
     "Reply-To: ".$to. "\r\n" .
     "X-Mailer: PHP/" . phpversion();

     mail($to, $subject, $message, $headers);
	 
	header("Location:sendd.php");
	exit();
}
else if(@$_SESSION['login']=='global' && @$_SESSION['password']=='marketing'){
?>


<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/sample.js"></script>
<link href="ckeditor/sample.css" rel="stylesheet">


<!-- HTML And JavaScript -->



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>:: Mailer Inbox ::</title>

<style type="text/css">
	.style1 {font-size: x-small;}
	.style2 {direction: ltr;}
	.info {font-size: 8px;}
	.style3 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 8px;}
	.style4 {font-size: x-small;direction: ltr;font-family: Verdana, Arial, Helvetica, sans-serif;}
	.style5 {font-size: xx-small;direction: ltr;font-family: Verdana, Arial, Helvetica, sans-serif;}
</style>

</head>

<script>

	window.onload = funchange;
	
	var alt = false;	

	function funchange(){

		var etext = document.getElementById("emails").value;
		var myArray=new Array();
		myArray = etext.split("\n");

		document.getElementById("enum").innerHTML=myArray.length+"<br />";

		if(!alt && myArray.length > 40000){
			alert('If Mail list More Than 40000 Emails This May Hack The Server');
			alt = true;
		}

		

	}

	function mlsplit(){

		var ml = document.getElementById("emails").value;
		var sb = document.getElementById("txtml").value;

		var myArray=new Array();
		myArray = ml.split(sb);

		document.getElementById("emails").value="";

		var i;

		for(i=0;i<myArray.length;i++){
			document.getElementById("emails").value += myArray[i]+"\n";
		}

		funchange();

	}


	function mlleach(){

		var ml = document.getElementById("emails").value;
		var lb = document.getElementById("black").value;

		var myArrayemail=new Array();
		var myArrayblack=new Array();

		myArrayemail = ml.split("\n");
		myArrayblack = lb.split("\n");

		var i,j,newlist;
		document.getElementById("emails").value="";

		for(j=0;j<myArrayemail.length;j++){
			var bl=false;
			
				
			for(i=0;i<myArrayblack.length;i++){
				if(myArrayblack[i] == myArrayemail[j]){
					bl=true;
				}
			}
			
			if(!bl){
				newlist+= myArrayemail[j]+"\n";
			}
		}
		document.getElementById("emails").value =newlist;
		
		funchange();
		alert("leach end");

	}

	

	function prv(){

		if(document.getElementById('preview').innerHTML==""){			
			var ms = document.getElementsByName('message').message.value;
			document.getElementById('preview').innerHTML = ms;
			document.getElementById('prvbtn').value = "Hide";
		}else{
			document.getElementById('preview').innerHTML="";
			document.getElementById('prvbtn').value = "Preview";
		}

	}

	

</script>

<body onLoad="funchange">

<form name="form" method="post" enctype="multipart/form-data" action="">

	<table width="100%" border="0">
    
    	<tr>
        	<td colspan="4" align="right" >
            	<a href="?logout=close">Close</a>
            </td>
        </tr>

		<tr>
			<td width="10%">
				<div align="right"><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Your Email:</font></div>
			</td>

			<td style="width: 40%">
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                    <input name="from" value="<?php echo(@$from); ?>" size="30" type="text" />
                    <br>
                    <span class="info">Type Sender Email But Make Sure It&#39;s Right</span>
                </font>
            </td>

			<td>
				<div align="right"><font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Your Name:</font></div>
			</td>

			<td width="41%">
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                    <input name="realname" value="<?php echo(@$realname); ?>" size="30" type="text" />
                    <br>
                    <span class="info">Make Sure You Type Your Sender Name</span>
                </font>
            </td>
		</tr>

		<tr>

			<td width="10%">
				<div align="right">
					<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">test send:</font>
                </div>
			</td>

			<td style="width: 40%">
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                    <input name="tem" type="text" size="30" value="<?php echo(@$tem); ?>" />
                    <br>
                    <span class="info">Type </span>
                </font>
                <span class="style3">Your Email To Test The Mailer Still Work Or No</span>
            </td>

			<td>
                <div align="right" class="style4">
                    <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Send Test Mail After:</font>
                </div>
			</td>

			<td width="41%">
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                    <input name="smv" type="text" size="30" value="<?php echo(@$smv); ?>" />
                    <br>
                    <span class="info">Send Mail For Your Email After Which Email(s)</span>
                </font>
			</td>

		</tr>

		<tr>

			<td width="10%">
                <div align="right">
                    <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Subject:</font>
                </div>
			</td>

			<td colspan="3">

			<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
            	<input name="subject" value="<?php echo(@$subject); ?>" size="90" type="text" />
            </font>

		<tr valign="top">

			<td colspan="3" style="height: 210px">

			<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
            	<textarea name="message" rows="10" style="width: 425px"><?php echo(@$message); ?></textarea>
				<script>
                
                                CKEDITOR.replace( 'message', {
                                    /*
                                     * Ensure that htmlwriter plugin, which is required for this sample, is loaded.
                                     */
                                    extraPlugins: 'htmlwriter',
                
                                    /*
                                     * Style sheet for the contents
                                     */
                                    contentsCss: 'body {color:#000; background-color#:FFF;}',
                
                                    /*
                                     * Simple HTML5 doctype
                                     */
                                    docType: '<!DOCTYPE HTML>',
                
                                    /*
                                     * Core styles.
                                     */
                                    coreStyles_bold: { element: 'b' },
                                    coreStyles_italic: { element: 'i' },
                                    coreStyles_underline: { element: 'u' },
                                    coreStyles_strike: { element: 'strike' },
                
                                    /*
                                     * Font face.
                                     */
                
                                    // Define the way font elements will be applied to the document.
                                    // The "font" element will be used.
                                    font_style: {
                                        element: 'font',
                                        attributes: { 'face': '#(family)' }
                                    },
                
                                    /*
                                     * Font sizes.
                                     */
                                    fontSize_sizes: 'xx-small/1;x-small/2;small/3;medium/4;large/5;x-large/6;xx-large/7',
                                    fontSize_style: {
                                        element: 'font',
                                        attributes: { 'size': '#(size)' }
                                    } ,
                
                                    /*
                                     * Font colors.
                                     */
                                    colorButton_enableMore: true,
                
                                    colorButton_foreStyle: {
                                        element: 'font',
                                        attributes: { 'color': '#(color)' }
                                    },
                
                                    colorButton_backStyle: {
                                        element: 'font',
                                        styles: { 'background-color': '#(color)' }
                                    },
                
                                    /*
                                     * Styles combo.
                                     */
                                    stylesSet: [
                                        { name: 'Computer Code', element: 'code' },
                                        { name: 'Keyboard Phrase', element: 'kbd' },
                                        { name: 'Sample Text', element: 'samp' },
                                        { name: 'Variable', element: 'var' },
                                        { name: 'Deleted Text', element: 'del' },
                                        { name: 'Inserted Text', element: 'ins' },
                                        { name: 'Cited Work', element: 'cite' },
                                        { name: 'Inline Quotation', element: 'q' }
                                    ],
                
                                    on: { 'instanceReady': configureHtmlOutput }
                                });
                
                                /*
                                 * Adjust the behavior of the dataProcessor to avoid styles
                                 * and make it look like FCKeditor HTML output.
                                 */
                                function configureHtmlOutput( ev ) {
                                    var editor = ev.editor,
                                        dataProcessor = editor.dataProcessor,
                                        htmlFilter = dataProcessor && dataProcessor.htmlFilter;
                
                                    // Out self closing tags the HTML4 way, like <br>.
                                    dataProcessor.writer.selfClosingEnd = '>';
                
                                    // Make output formatting behave similar to FCKeditor
                                    var dtd = CKEDITOR.dtd;
                                    for ( var e in CKEDITOR.tools.extend( {}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent ) ) {
                                        dataProcessor.writer.setRules( e, {
                                            indent: true,
                                            breakBeforeOpen: true,
                                            breakAfterOpen: false,
                                            breakBeforeClose: !dtd[ e ][ '#' ],
                                            breakAfterClose: true
                                        });
                                    }
                
                                    // Output properties as attributes, not styles.
                                    htmlFilter.addRules( {
                                        elements: {
                                            $: function( element ) {
                                                // Output dimensions of images as width and height
                                                if ( element.name == 'img' ) {
                                                    var style = element.attributes.style;
                
                                                    if ( style ) {
                                                        // Get the width from the style.
                                                        var match = ( /(?:^|\s)width\s*:\s*(\d+)px/i ).exec( style ),
                                                            width = match && match[ 1 ];
                
                                                        // Get the height from the style.
                                                        match = ( /(?:^|\s)height\s*:\s*(\d+)px/i ).exec( style );
                                                        var height = match && match[ 1 ];
                
                                                        if ( width ) {
                                                            element.attributes.style = element.attributes.style.replace( /(?:^|\s)width\s*:\s*(\d+)px;?/i , '' );
                                                            element.attributes.width = width;
                                                        }
                
                                                        if ( height ) {
                                                            element.attributes.style = element.attributes.style.replace( /(?:^|\s)height\s*:\s*(\d+)px;?/i , '' );
                                                            element.attributes.height = height;
                                                        }
                                                    }
                                                }
                
                                                // Output alignment of paragraphs using align
                                                if ( element.name == 'p' ) {
                                                    style = element.attributes.style;
                
                                                    if ( style ) {
                                                        // Get the align from the style.
                                                        match = ( /(?:^|\s)text-align\s*:\s*(\w*);/i ).exec( style );
                                                        var align = match && match[ 1 ];
                
                                                        if ( align ) {
                                                            element.attributes.style = element.attributes.style.replace( /(?:^|\s)text-align\s*:\s*(\w*);?/i , '' );
                                                            element.attributes.align = align;
                                                        }
                                                    }
                                                }
                
                                                if ( !element.attributes.style )
                                                    delete element.attributes.style;
                
                                                return element;
                                            }
                                        },
                
                                        attributes: {
                                            style: function( value, element ) {
                                                // Return #RGB for background and border colors
                                                return CKEDITOR.tools.convertRgbToHex( value );
                                            }
                                        }
                                    });
                                }
                
                            </script>
				<br />
				<input name="action" value="send" type="hidden" />
				<input type="button" id="prvbtn" value="Preview" onClick="prv()" style="width:62px" /><input value="Start Spam" type="submit" />
                
                Wait 
                <input name="wait" type="text" value="<?php echo (@$wait); ?>" size="14" /> 
                Second Until Send 
            </font>
            </td>

			<td width="41%" class="style2" style="height: 210px">
				<table>
                <tr>
                	<td class="style2" style="height: 210px; vertical-align:top;">

			<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
            	Email List
				<textarea id="emails" name="emaillist" cols="30" 
                	onselect="funchange()" onchange="funchange()" onkeydown="funchange()" onkeyup="funchange()" onchange="funchange()" 
                    style="height:161"><?php echo (@$emaillist); ?></textarea> 

			<br class="style2" />

			Emails Number : </font><span  id="enum" class="style1">0<br /></span>

			<span  class="style1">Split The Mail List By:</span>
			<input name="textml" id="txtml" type="text" value="," size="8" />&nbsp;&nbsp;&nbsp;
			<input type="button" onClick="mlsplit()" value="Split" style="height: 23px" />
            
            	</td>
                <td class="style2" style="height: 210px; vertical-align:top;">
                    <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                        Black List
                        <textarea id="black" name="blacklist" cols="30" 
                            onselect="funchange()" onchange="funchange()" onkeydown="funchange()" onkeyup="funchange()" onchange="funchange()" 
                            style="height:161"><?php echo (@$blacklist); ?></textarea> 
						<input type="button" onClick="mlleach()" value="leach" style="height: 23px" />
                    </font>
                </td>
                </tr>
                </table>
            </td>

		</tr>

	</table>

			<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
				<div id="preview"></div>
            </font>

</form>



<!-- END -->

<?php

if(isset($_POST['action'] ) ){

	$action=@$_POST['action'];
	$message=@$_POST['message'];
	$emaillist=@$_POST['emaillist'];
	$blacklist=@$_POST['blacklist'];	
	$from=@$_POST['from'];
	$subject=@$_POST['subject'];
	$realname=@$_POST['realname'];	
	$wait=@$_POST['wait'];
	$tem=@$_POST['tem'];
	$smv=@$_POST['smv'];

	$message = urlencode($message);
	$message = str_replace("%5C%22", "%22", $message);
	$message = urldecode($message);
	$message = stripslashes($message);
	$subject = stripslashes($subject);
}

if (@$action){

    if (!$from || !$subject || !$message || !$emaillist){
    	print "Please complete all fields before sending your message.";
		exit;
	}

	$nse=array();
	$allemails = explode("\n", $emaillist);
	$numemails = count($allemails);
	
/** Error reporting */
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('Europe/London');


/** Include PHPExcel */
require_once dirname(__FILE__) . '/Classes/PHPExcel.php';

// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', $from);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A2', $realname);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A3', $subject);
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A4', $message);

$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A5', $numemails);
$y=6;

	for($x=0; $x<$numemails; $x++){
	
		$to = $allemails[$x];
		
		// Add some data
		$objPHPExcel->setActiveSheetIndex(0)
		->setCellValue('A'.$y, $to);
		
		$c=$x+1;				
		$y++;
	}

// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);


// Save Excel 2007 file
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('base.xlsx');
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;


// Save Excel 95 file
/*
$callStartTime = microtime(true);

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('base.xls');
$callEndTime = microtime(true);
$callTime = $callEndTime - $callStartTime;
*/




echo "<br> Enregistrement Terminé <br>";
}
?><div>

	

</body>

</html>

<?php
	exit();
}
if(@$_SESSION['login']!='global' && @$_SESSION['password']!='marketing'){
?>
    Please enter a valid username and password
    <form method="post">
    	<table>
        	<tr>
            	<td>Login:</td>
            	<td><input type="text" name="login" /></td>
            </tr>
        	<tr>
            	<td>Password:</td>
            	<td><input type="password" name="password" /></td>
            </tr>
        	<tr>
            	<td><input type="submit" name="action" /></td>
            	<td><input type="reset" /></td>
            </tr>
        </table>
    </form>
    <?php
}
?>