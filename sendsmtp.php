<?php
session_start();

if(@$_REQUEST['logout']=='close'){
	session_destroy();
	header("Location:sendsmtp.php");
	exit();
}

if(@$_REQUEST['login']=='global' && @$_REQUEST['password']=='marketing12345678'){
	$_SESSION['login']=@$_REQUEST['login'];
	$_SESSION['password']=@$_REQUEST['password'];
	 
	header("Location:sendsmtp.php");
	exit();
}
else if(@$_SESSION['login']=='global' && @$_SESSION['password']=='marketing12345678'){
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>SMTP-Mailer:</title>

<style type="text/css">
	.style1 {font-size: x-small;}
	.style2 {direction: ltr;}
	.info {font-size: 8px;}
	.style3 {font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 8px;}
	.style4 {font-size: x-small;direction: ltr;font-family: Verdana, Arial, Helvetica, sans-serif;}
	.style5 {font-size: xx-small;direction: ltr;font-family: Verdana, Arial, Helvetica, sans-serif;}
</style>

<script src="ckeditor/ckeditor.js"></script>
<script src="ckeditor/sample.js"></script>
<link href="ckeditor/sample.css" rel="stylesheet">
<script>

	window.onload = funchange;
	
	var alt = false;	

	function funchange(){

		var etext = document.getElementById("emaillist").value;
		var myArray=new Array();
		myArray = etext.split("\n");

		document.getElementById("enum").innerHTML=myArray.length+"<br />";

		if(!alt && myArray.length > 40000){
			alert('If Mail list More Than 40000 Emails This May Hack The Server');
			alt = true;
		}
	}

	function mlsplit(){

		var ml = document.getElementById("emaillist").value;
		var sb = document.getElementById("txtml").value;

		var myArray=new Array();
		myArray = ml.split(sb);

		document.getElementById("emaillist").value="";

		var i;

		for(i=0;i<myArray.length;i++){
			document.getElementById("emaillist").value += myArray[i]+"\n";
		}

		funchange();
	}


	function mlleach(){

		var ml = document.getElementById("emaillist").value;
		var lb = document.getElementById("blacklist").value;

		var myArrayemail=new Array();
		var myArrayblack=new Array();

		myArrayemail = ml.split("\n");
		myArrayblack = lb.split("\n");

		var i,j,newlist;
		document.getElementById("emaillist").value="";

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
		document.getElementById("emaillist").value =newlist;
		
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
</head>



<body onLoad="funchange">
<?php

if(isset($_POST['action']) ){
	include("class.phpmailer.php");
	$mail = new PHPMailer();
	$mail->IsSMTP();

	$action=@$_POST['action'];

	$mail->Host =$Host=@$_POST['Host'];
	$mail->Port =$Port=@$_POST['Port'];
	$mail->SMTPAuth = true;
	$mail->Username =$Username=@$_POST['Username'];
	$mail->From =$from =$Username;
	$mail->Password =$Password=@$_POST['Password'];
	$mail->FromName = $FromName=@$_POST['FromName'];
	
	$mail->WordWrap = 50; // set word wrap
	$mail->IsHTML(true); // send as HTML
	
	$mail->Subject =$subject=@$_POST['subject'];
	$mail->Body =$message=@$_POST['message'];
	
	$emaillist=@$_POST['emaillist'];
	$blacklist=@$_POST['blacklist'];
	
	


	$wait=@$_POST['wait'];
	$tem=@$_POST['tem'];
	$smv=@$_POST['smv'];



	$message = urlencode($message);
	$message = str_replace("%5C%22", "%22", $message);
	$message = urldecode($message);
	$message = stripslashes($message);
	$subject = stripslashes($subject);
}
?>
<form name="form" method="post" enctype="multipart/form-data" action="">
	<table width="100%" border="0">
    
    	<tr>
        	<td colspan="4" align="right" >
            	<a href="?logout=close">Close</a>
            </td>
        </tr>

		<tr>
			<td  colspan="4" bgcolor="#CCCCCC" >
				<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Adresse SMTP:</font>
                
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                    <input name="Host" value="<?php echo(@$Host); ?>" size="30" type="text" required="required" />
                </font>
                
				<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Port:</font>
                
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                	<input name="Port" value="<?php echo(@$Port); ?>" size="30" type="text" required="required" />
                </font>
            </td>
		</tr>
        
        <tr>
			<td  colspan="4" bgcolor="#CCCCCC" >
				<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Email:</font>
                
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                    <input name="Username" value="<?php echo(@$Username); ?>" size="30" type="text" required="required" />
                </font>
                
				<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Mot de passe:</font>
                
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                	<input name="Password" value="<?php echo(@$Password); ?>" size="30" type="text" required="required" />
                </font>
                
				<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">FromName:</font>
                
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                    <input name="FromName" value="<?php echo(@$FromName); ?>" size="30" type="text" required="required" />
                </font>
            </td>
        </tr>

		<tr>

			<td colspan="2">
            	<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">test send:</font>
                    
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                    <input name="tem" type="text" size="30" value="<?php echo(@$tem); ?>" />
                    <br>
                    <span class="info">Type </span>
                </font>
                <span class="style3">Your Email To Test The Mailer Still Work Or No</span>
            </td>
			<td colspan="2">
                    <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Send Test Mail After:</font>
                
                <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                    <input name="smv" type="text" size="30" value="<?php echo(@$smv); ?>" />
                    <br>
                    <span class="info">Send Mail For Your Email After Which Email(s)</span>
                </font>
			</td>

		</tr>

        <tr>
            <td colspan="4">
                	<font size="-3" face="Verdana, Arial, Helvetica, sans-serif">Subject:</font>
                               
                <font face="Verdana, Arial, Helvetica, sans-serif">
                	<input name="subject" value="<?php echo(@$subject); ?>" size="90" type="text" />
                </font>
            </td>
        </tr>
        
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
                <input value="Start Spam" type="submit" />
                
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
                                <br />
                                <textarea id="emaillist" name="emaillist" cols="30" style="height:200px;"
                                onselect="funchange()" onchange="funchange()" onkeydown="funchange()" onkeyup="funchange()" onchange="funchange()" ><?php echo (@$emaillist); ?></textarea>
                            </font>
                        
                        </td>
                        <td class="style2" style="height: 210px; vertical-align:top;">
                            <font size="-3" face="Verdana, Arial, Helvetica, sans-serif">
                                Black List
                                <br />
                                <textarea id="blacklist" name="blacklist" cols="30"  style="height:200px;"
                                onselect="funchange()" onchange="funchange()" onkeydown="funchange()" onkeyup="funchange()" onchange="funchange()" ><?php echo (@$blacklist); ?></textarea> 
                            </font>
                        </td>
                    </tr>
                    <tr>
                    	<td>
                            <div class="style1">
                                Emails Number :<span  id="enum" class="style1">0<br /></span>
                                <span>Split The Mail List By:</span>
                                <input name="textml" id="txtml" type="text" value="," size="8" />
                                <input type="button" onClick="mlsplit()" value="Split" style="height: 23px" />
                            </div>
                        </td>
                        <td>
                        	<input type="button" onClick="mlleach()" value="leach" style="height: 23px" />
                        </td>
                    </tr>
                </table>
            </td>

		</tr>

	</table>
</form>

<?php


function before ($this, $inthat)
{
	return substr($inthat, 0, strpos($inthat, $this));
}

if (@$action){

    if (!$Host || !$Port || !$Username || !$Password || !$FromName || !$subject || !$message || !$emaillist){
    	print "Please complete all fields before sending your message.";
		exit;
	}
	
    print "<b style='color:#F00;'>Rapport et statistique détaillés sont envoyées à adnene_braham@hotmail.fr.</b><br />";
	
	$nse=array();
	$allemails = explode("\n", $emaillist);

	$numemails = count($allemails);
	
	if(!empty($_POST['wait']) && $_POST['wait'] > 0){	
		set_time_limit(intval($_POST['wait'])*$numemails*3600);	
	}else{	
		set_time_limit($numemails*3600);	
	}

	$nbreerreur=0;

          	for($x=0; $x<$numemails; $x++){

                $to = $allemails[$x];
				
				$name = before ('@', $to);
				$pos=$x+1;
				/*
				if($x==0)
					$mail->AddAddress($to,$name);
				*/
				$mail->AddAddress($to,$name);
				//$mail->AddBCC($to,$name);
				
				$mail->AddReplyTo($from,"Webmaster");
					//$msent = mail($to, $subject, $message, $header);//sendMail($to,$realname,$subject,$message,$from,$from,$html=true);
					$msent =$mail->Send();
					if(!$msent)
					{
						echo $pos."- ".$to." .... Mailer Error: " . $mail->ErrorInfo." <br>";
					}
					else
					{
						echo $pos."- ".$to." .... Message has been sent <br>";
					}
					
				$mail->ClearAddresses();
					
            }
				if($nbreerreur==3000)
					exit;
			
			
}
?><div>

&nbsp;<?php

if(isset($_POST['action']) && $numemails !==0 ){

	$sn=$numemails-$ns;

	if($ns==""){
		$ns=0;
	}

	if($tmns==""){
		$tmns=0;
	}

	echo "<script>alert('Sur The Mailer Finish His Job\\r\\nSend $sn mail(s)\\r\\nError $ns mail(s)\\r\\From $numemails mail(s)\\r\\About Test Mail(s)\\r\\Send @$tms mail(s)\\r\\Error $tmns mail(s)\\r\\From $tmn mail(s)');</script>";

}



?>

	

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