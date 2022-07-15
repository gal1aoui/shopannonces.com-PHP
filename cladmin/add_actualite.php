<?php


if(@$_REQUEST[action]=='Add'){
	db_query("insert into news 
			set categ_id='$_REQUEST[categ]',
				sujet_news='$_REQUEST[sujet]',
				order_news='$_REQUEST[order]',
				date_news='".MYSQL_DATE_TIME."',
				contenu_news='$_REQUEST[desc]',
				video='$_REQUEST[video]'");
		
				$der_id=mysql_insert_id();
	/********* Upload Main image ***********/
		$fileName=$_FILES['file1']['name'];
		if($fileName!=''){
		$fileType = $_FILES['file1']['type'];
		$fileTemp = $_FILES['file1']['tmp_name'];
		$fileError = $_FILES['file1']['error'];
		$destFile = date('dMYhms').$fileName;			
		$destLoc = '../uploaded_files/news_img/'.$destFile;			  
			if(move_uploaded_file($_FILES['file1']['tmp_name'],$destLoc)){
				
				db_query("INSERT INTO `tbl_news_image` SET news_img_file='$destFile', news_id='$der_id' ");
			}
		}
			//-----------------------------------
		$fileName=$_FILES['file2']['name'];
		if($fileName!=''){
		$fileType = $_FILES['file2']['type'];
		$fileTemp = $_FILES['file2']['tmp_name'];
		$fileError = $_FILES['file2']['error'];
		$destFile = date('dMYhms').$fileName;			
		$destLoc = '../uploaded_files/news_img/'.$destFile;			  
			if(move_uploaded_file($_FILES['file2']['tmp_name'],$destLoc)){
				
				db_query("INSERT INTO `tbl_news_image` SET news_img_file='$destFile', news_id='$der_id' ");
			}
		}
			//-----------------------------------
		$fileName=$_FILES['file3']['name'];
		if($fileName!=''){
		$fileType = $_FILES['file3']['type'];
		$fileTemp = $_FILES['file3']['tmp_name'];
		$fileError = $_FILES['file3']['error'];
		$destFile = date('dMYhms').$fileName;			
		$destLoc = '../uploaded_files/news_img/'.$destFile;			  
			if(move_uploaded_file($_FILES['file3']['tmp_name'],$destLoc)){
				
				db_query("INSERT INTO `tbl_news_image` SET news_img_file='$destFile', news_id='$der_id' ");
			}
		}
			//-----------------------------------
		$fileName=$_FILES['file4']['name'];
		if($fileName!=''){
		$fileType = $_FILES['file4']['type'];
		$fileTemp = $_FILES['file4']['tmp_name'];
		$fileError = $_FILES['file4']['error'];
		$destFile = date('dMYhms').$fileName;			
		$destLoc = '../uploaded_files/news_img/'.$destFile;			  
			if(move_uploaded_file($_FILES['file4']['tmp_name'],$destLoc)){
				
				db_query("INSERT INTO `tbl_news_image` SET news_img_file='$destFile', news_id='$der_id' ");
			}
		}
			//-----------------------------------
		 
		 
	/**************** End of Upload ****************/

	 $_SESSION['site_admin_message']=" Category Updated successfully....";
	header("Location: land.php?file=manage_actualites");
	exit();	
 }


echo PageTitle("Ajouter Actualité");
?>


<script src="../js/ckeditor/ckeditor.js"></script>
<script src="../js/ckeditor/sample.js"></script>
<link href="../js/ckeditor/sample.css" rel="stylesheet">

<a href="land.php?file=manage_actualites">Retour</a>
<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">

      <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
        <tr>
	     <th>
         	Sujet
         </th>
         <td>
         	<input type="text" name="sujet" id="sujet">
         </td>
        </tr>
        <tr>
	     <th>
         	Categorie
         </th>
         <td>
<?php            
	  $sql_cat=db_query("select * from categories_news ");
      
   $nm=mysql_num_rows($sql_cat);
  if($nm > 0 ){
	  ?>
		<select name="categ" id="categ">
      <?php
	  while($rw=mysql_fetch_array($sql_cat))
	  {
		  ?>
            	<option value="<?php echo $rw[categ_news_id];?>"><?php echo $rw[categ_news_name];?></option>
                <?php
	  }
	  ?>
       </select>
      <?php
  }
  else{
	  echo "Aucune categories ";
  }
	  ?><a href='land.php?file=categ_actualite'>Ajouter categories</a>
         </td>
        </tr>
        <tr>
         <th>
         	Order
         </th>
         <td>
         	<select name="order" id="order">
            	<option value="1">1</option>
            	<option value="2">2</option>
            	<option value="3">3</option>
            	<option value="4">4</option>
            </select>
            </td>
            </tr>
            <tr>
            	<th>
                	Image
                </th>
                <td>
                	<table>
                    	<tr>
                        	<td>
                	<input type="file" name="file1"  />
                    		</td>
                        	<td>
                	<input type="file" name="file2"  />
                    		</td>
                        	<td>
                	<input type="file" name="file3"  />
                    		</td>
                        	<td>
                	<input type="file" name="file4"  />
                    		</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
            	<th>youtube Code video</th>
                <td><input type="text" name="video" /></td>
            </tr>
            <tr>
          <th>
          	Contenu
            </th>
            <td>
            <textarea name="desc" id="desc" cols="100" rows="4"><?php echo $page_content;?></textarea>
      <script>
    
                    CKEDITOR.replace( 'desc', {
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
    	<td colspan="2" align="center">
        	<input type="submit" value="Ajouter" >
        	<input name="action" type="hidden" value="Add" >
        </td>
    </tr>
</table>

</form>