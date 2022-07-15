<?php
	require_once("../includes/main.inc.php");
	
 $action=$_REQUEST['action'];
 $ids_str=$_REQUEST['ids'];
 
 $chk_inactive=db_query("select * from ".DB.".tbl_newslattersubscriber where subscr_id in ($ids_str) and status='0'");
 $num_inactive=mysql_num_rows($chk_inactive);
 if($num_inactive > 0 ){
	 $_SESSION['site_admin_message']=" You have selected an inactive members please activated the status first or select an activeded member ..";
	 header("Location:land.php?file=newsletter_subscriber");
	 exit();
 }
 
if($action=='send')
{
$subject1=$_REQUEST['subject'];
// FIX no utf8 chars - added @ 2012-06-05 19:45
mb_internal_encoding('UTF-8');
$subject1 = mb_encode_mimeheader($subject1);
//file_put_contents('debug.txt', $subject1."\n", FILE_APPEND);
$message = html_entity_decode($_REQUEST['message'], ENT_COMPAT | ENT_HTML401, 'UTF-8');
//$message=html_entity_decode($_REQUEST['message']);
    $ids=explode(',',$_REQUEST['ids']);	 
	 $a=count($ids);
	 for($i=0;$i<$a;$i++){
			$subId=$ids[$i];		    	 
			//$from     = "CL page";    
			//echo "select * from ".DB.".tbl_newslattersubscriber where subscr_id='$subId' and status='1'";        
        $seluser=db_query("select * from ".DB.".tbl_newslattersubscriber where subscr_id='$subId' and status='1'");
		$r4=mysql_fetch_array($seluser);
		$to1=$r4['subscr_email'];                  
		$ContactPerson=mb_encode_mimeheader("cce.in");
		$eMail=ADMIN_EMAIL;;		
		$headers = "From: $ContactPerson<$eMail> \n";
		$headers .= "Reply-To: $eMail \r\n";
		$headers .= "X-Mailer: PHP/". phpversion();
		$headers .= "X-Priority: 3 \n";
		$headers .= "MIME-version: 1.0\n";
		$headers .= "Content-Type: text/html; charset=UTF-8\n";
        @mail($to1,$subject1,$message,$headers);
        }  
	  $_SESSION['site_admin_message']="Newsletter sent  Successfully.........";
      header("Location:land.php?file=newsletter_subscriber");
	  exit();    
	}
	   
 ?>
<script language="javascript">
function validate(){
	if(document.form1.subject.value == ""){
	   alert("Please enter subject.")
	   document.form1.subject.focus()
	   return false;
	  }
  
} 
</script>
<script src="../js/ckeditor/ckeditor.js"></script>
<script src="../js/ckeditor/sample.js"></script>
<link href="../js/ckeditor/sample.css" rel="stylesheet">
<?php echo PageTitle('Send Newsletter');?>
<form action="" method="post" name="form1" id="form1" onSubmit="return validate();" enctype="multipart/form-data">   
  <table width="658" border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">  
  <tr> 
  <td width="120" class="tdLabel"><strong>Subject: <font color="#FF0000">*</font></strong>
  </td> 
  <td> 
  <input type="text" name="subject" class="textfield" size="90"> 
  </td> 
  </tr> 
  <tr> 
  <td valign="top" class="tdLabel"><strong>Message: </strong></td> 
  <td> 
  <?php // echo get_fck_editor("message", $message)?>  
  
		<textarea name="message" id="message" cols="100" rows="4"><?php echo $page_content;?></textarea>
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
  </td> 
  </tr> 
    <tr>
    <td class="label">&nbsp;</td>
    <td><input type="image" name="imageField" src="images/buttons/submit.gif" />
	 <input type="hidden" name="ids" value="<?php echo $ids;?>">
  <input type="hidden" name="action" value="send"> </td>
  </tr>   
  </table> 
</form>