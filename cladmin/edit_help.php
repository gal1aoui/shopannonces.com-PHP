<?php 
	require_once("../includes/main.inc.php");
	
$action=@$_REQUEST['action'];
$help_quest=htmlentities(@$_REQUEST['help_quest'],ENT_QUOTES);
$help_ans=htmlentities(@$_REQUEST['help_ans'],ENT_QUOTES);
$help_id=@$_REQUEST['help_id'];
if($action=='Add'){
 $ins=db_query("update ".DB.".tbl_help set help_quest='$help_quest',help_ans='$help_ans',help_catid='$category' where help_id='$help_id'");
 $_SESSION['site_admin_message']="Help Updated Successfully.........";
		header("Location: land.php?file=manage_help");
		exit();	
}
$selfaq=db_query("select * from ".DB.".tbl_help where help_id='$help_id'");
$rw=mysql_fetch_array($selfaq);
$help_ans=html_entity_decode($rw['help_ans']);   
?>
<?php echo PageTitle('Edit Help');?>
<script src="../js/ckeditor/ckeditor.js"></script>
<script src="../js/ckeditor/sample.js"></script>
<link href="../js/ckeditor/sample.css" rel="stylesheet">

<script language="javascript">
function validate()
 {
 if(document.form1.category.value == ""){
   alert("Please enter help Category.")
   document.form1.category.focus()
   return false;
    }
 if(document.form1.faq_quest.value == ""){
   alert("Please enter help question.")
   document.form1.faq_quest.focus()
   return false;
  }
 }
</script>
<div align="right"><a href="?file=manage_help">Back to Help Management</a>&nbsp;</div>
<form name="form1" method="post" enctype="multipart/form-data" onSubmit="return validate();">
  <table width="95%"  border="0" align="center" cellpadding="0" cellspacing="0" class="tableForm">	
	  <tr>
		<td width="183" valign="top" class="tdLabel">
		<b> <b>Help Category :</b><font color="#FF0000">*</font> </b></td>
        <td width="575" align="left" class="tdData"><select name="category">
          <option value="">Select Category</option>
          <?php
	  $str="select * from tbl_help_category where cat_status='Y'";
	  $result=mysql_query($str) or die(mysql_error());
	  while($row=mysql_fetch_array($result)){
	  if($row[cat_id]==$rw[help_catid])
	  $sel="selected";
	  else
	  $sel="";
	  ?>
          <option value="<?php echo $row[cat_id]?>" <?php echo $sel?>>
          <?php echo $row[cat_name]?>
          </option>
          <?php 
	  }
	  ?>
        </select></td>
	 </tr>	 
	  <tr>
	    <td valign="top" class="tdLabel"><b>Help Question :</b><font color="#FF0000">*</font></td>
	    <td align="left" class="tdData"><input type="text" name="help_quest" size="90" value="<?php echo $rw['help_quest'];?>" ></td>
    </tr>
     <tr>
		<td width="183" valign="top" class="tdLabel">&nbsp;		</td>
	    <td width="575" align="left" class="tdData">&nbsp;
	  </td>
	</tr>
	 <tr>
		<td width="183" valign="top" class="tdLabel"><b>Help Answer:</b></td>
		<td width="575" class="tdData">
        	<textarea name="help_ans" cols="40" rows="3" id="faq_ans"><?php echo $rw['help_ans'];?></textarea>
        <script>

				CKEDITOR.replace( 'help_ans', {
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
		<td class="tdLabel">&nbsp;</td>
	  <td class="tdData"><input type="image" name="imageField" src="images/buttons/submit.gif" />
		  <span class="tdLabel">
		  <input type="hidden" name="action2" value="Add">
          <input type="hidden" name="help_id" value="<?php echo $rw['help_id'];?>">
          <input type="hidden" name="action" value="Add">
      </span></td>
	</tr>
	<tr>
	<td class="tdLabel">&nbsp;</td>
	<td  class="tdData">&nbsp;</td>
	</tr>
  </table>
</form>