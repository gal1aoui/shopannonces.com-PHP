<?php


if(@$_REQUEST[action]=='Update'){
	db_query("UPDATE news 
			set categ_id='$_POST[categ]',
				sujet_news='$_POST[sujet]',
				order_news='$_POST[order]',
				date_news='$_POST[date_news]',
				contenu_news='$_POST[desc]',
				video='$_REQUEST[video]'
			WHERE news_id='$_POST[news_id]'");


	$der_id=$_POST[news_id];


	/********* Upload Main image ***********/
		$fileName=$_FILES['file1']['name'];
		if($fileName!=''){
		$fileType = $_FILES['file1']['type'];
		$fileTemp = $_FILES['file1']['tmp_name'];
		$fileError = $_FILES['file1']['error'];
		$destFile = date('dMYhms').$fileName;			
		$destLoc = '../uploaded_files/news_img/'.$destFile;	
		
			if($_POST['photo1']==''){
				if(move_uploaded_file($_FILES['file1']['tmp_name'],$destLoc)){
					
					db_query("INSERT INTO `tbl_news_image` SET news_img_file='$destFile', news_id='$der_id' ");
				}
			}
			else{
				$sql_de=db_query("select * FROM `tbl_news_image` WHERE news_img_id='$_POST[photo1]' ");
				$rw_del=mysql_fetch_array($sql_de);
				
				 $file_unlink="../uploaded_files/news_img/".$rw_del[news_img_file];  
				 if(file_exists($file_unlink)){
				   @unlink($file_unlink);
				 }
				 
				if(move_uploaded_file($_FILES['file1']['tmp_name'],$destLoc)){
					
					db_query("update `tbl_news_image` SET news_img_file='$destFile' WHERE news_img_id='$_POST[photo1]' ");
				}
			}
		}
		else{
			if($_POST['photo1']==''){
				/* Delete news images  */
				 $file_unlink="../uploaded_files/news_img/".$res1[news_img_file];  
				 if(file_exists($file_unlink)){
				   @unlink($file_unlink);
				 }
				 
				 
				 $sql_del="delete from tbl_news_image where news_img_id='$_POST[photo1]'"; 
				 db_query($sql_del);
				/* Delete news images  */
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
			
			if($_POST['photo2']==''){
				if(move_uploaded_file($_FILES['file2']['tmp_name'],$destLoc)){
					
					db_query("INSERT INTO `tbl_news_image` SET news_img_file='$destFile', news_id='$der_id' ");
				}
			}
			else{
				$sql_de=db_query("select * FROM `tbl_news_image` WHERE news_img_id='$_POST[photo2]' ");
				$rw_del=mysql_fetch_array($sql_de);
				
				 $file_unlink="../uploaded_files/news_img/".$rw_del[news_img_file];  
				 if(file_exists($file_unlink)){
				   @unlink($file_unlink);
				 }
				 
				if(move_uploaded_file($_FILES['file2']['tmp_name'],$destLoc)){
					
					db_query("update `tbl_news_image` SET news_img_file='$destFile' WHERE news_img_id='$_POST[photo2]' ");
				}
			}
		}
		else{
			if($_POST['photo2']==''){
				/* Delete news images  */
				 $file_unlink="../uploaded_files/news_img/".$res1[news_img_file];  
				 if(file_exists($file_unlink)){
				   @unlink($file_unlink);
				 }
				 
				 
				 $sql_del="delete from tbl_news_image where news_img_id='$_POST[photo2]'"; 
				 db_query($sql_del);
				/* Delete news images  */
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
			
			if($_POST['photo3']==''){
				if(move_uploaded_file($_FILES['file3']['tmp_name'],$destLoc)){
					
					db_query("INSERT INTO `tbl_news_image` SET news_img_file='$destFile', news_id='$der_id' ");
				}
			}
			else{
				$sql_de=db_query("select * FROM `tbl_news_image` WHERE news_img_id='$_POST[photo3]' ");
				$rw_del=mysql_fetch_array($sql_de);
				echo $rw_del[news_img_file];
				 $file_unlink="../uploaded_files/news_img/".$rw_del[news_img_file];  
				 if(file_exists($file_unlink)){
				   @unlink($file_unlink);
				 }
				 
				if(move_uploaded_file($_FILES['file3']['tmp_name'],$destLoc)){
					
					db_query("update `tbl_news_image` SET news_img_file='$destFile' WHERE news_img_id='$_POST[photo3]' ");
				}
			}
		}
		else{
			if($_POST['photo3']==''){
				/* Delete news images  */
				 $file_unlink="../uploaded_files/news_img/".$res1[news_img_file];  
				 if(file_exists($file_unlink)){
				   @unlink($file_unlink);
				 }
				 
				 
				 $sql_del="delete from tbl_news_image where news_img_id='$_POST[photo3]'"; 
				 db_query($sql_del);
				/* Delete news images  */
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
			
			if($_POST['photo4']==''){
				if(move_uploaded_file($_FILES['file4']['tmp_name'],$destLoc)){
					
					db_query("INSERT INTO `tbl_news_image` SET news_img_file='$destFile', news_id='$der_id' ");
				}
			}
			else{
				$sql_de=db_query("select * FROM `tbl_news_image` WHERE news_img_id='$_POST[photo4]' ");
				$rw_del=mysql_fetch_array($sql_de);
				
				 $file_unlink="../uploaded_files/news_img/".$rw_del[news_img_file];  
				 if(file_exists($file_unlink)){
				   @unlink($file_unlink);
				 }
				 
				if(move_uploaded_file($_FILES['file4']['tmp_name'],$destLoc)){
					
					db_query("update `tbl_news_image` SET news_img_file='$destFile' WHERE news_img_id='$_POST[photo4]' ");
				}
			}
		}
		else{
			if($_POST['photo4']==''){
				/* Delete news images  */
				 $file_unlink="../uploaded_files/news_img/".$res1[news_img_file];  
				 if(file_exists($file_unlink)){
				   @unlink($file_unlink);
				 }
				 
				 $sql_del="delete from tbl_news_image where news_img_id='$_POST[photo4]'"; 
				 db_query($sql_del);
				/* Delete news images  */
			}
		}
	/**************** End of Upload ****************/	
	
	 $_SESSION['site_admin_message']=" News Updated successfully....";
	header("Location: land.php?file=manage_actualites");
	exit();
 }


echo PageTitle("Ajouter Actualité");
?>


<script src="../js/ckeditor/ckeditor.js"></script>
<script src="../js/ckeditor/sample.js"></script>
<link href="../js/ckeditor/sample.css" rel="stylesheet">

<a href="land.php?file=manage_actualites">Retour</a>
<?php
$news_id=$_REQUEST[news_id];
if(!isset($news_id))
	$news_id=$_POST[news_id];
	
	  $sql_new=db_query("select * from news WHERE news_id='".$news_id."'");
      
	  $rn=mysql_fetch_array($sql_new);
	  
	  ?>
   
<form id="form1" name="form1" method="post" enctype="multipart/form-data" action="">
	<input type="hidden" name="news_id" id="news_id" value="<?php echo $news_id;?>">
      <table width="100%"  border="0" cellpadding="0" cellspacing="1" class="tableList">
        <tr>
	     <th>
         	Sujet
         </th>
         <td>
         	<input type="text" name="sujet" id="sujet" value="<?php echo $rn[sujet_news]; ?>">
         </td>
        </tr>
        <tr>
	     <th>
         	Date
         </th>
         <td>
         	<input type="text" name="date_news" id="date_news" value="<?php echo $rn[date_news]; ?>">
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
	  ?>
		<select name="categ" id="categ">
      <?php
	while($rw=mysql_fetch_array($sql_cat))
	{
		if($rn[categ_id]==$rw[categ_news_id])
		  	$sel='selected';
		else
			$sel='';
		  ?>
            	<option value="<?php echo $rw[categ_news_id];?>" <?php echo $sel;?>><?php echo $rw[categ_news_name];?></option>
                <?php
	  }
	  ?>
       </select><a href='land.php?file=categ_actualite'>Ajouter categories</a>
         </td>
        </tr>
        <tr>
         <th>
         	Order
         </th>
         <td>
         	<select name="order" id="order">
            	<option value="1" <?php echo ($rn[order_news]=="1") ? "selected" : ""; ?>>1</option>
            	<option value="2" <?php echo ($rn[order_news]=="2") ? "selected" : ""; ?>>2</option>
            	<option value="3" <?php echo ($rn[order_news]=="3") ? "selected" : ""; ?>>3</option>
            	<option value="4" <?php echo ($rn[order_news]=="4") ? "selected" : ""; ?>>4</option>
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
							<?php
                            $sql_img="select * from tbl_news_image where news_id='".$news_id."' ";
                            $sql_img_set=db_query($sql_img);
							
                            $i=1;
						   while($res1=mysql_fetch_array($sql_img_set)){  ?>
						   
												<td valign="top">
										<input type="file" name="file<?php echo $i;?>" value="<?php echo $res1[news_img_file]; ?>"  />
                                        <input type="hidden" name="photo<?php echo $i;?>" value="<?php echo $res1[news_img_id]; ?>"
                                        <br />
										<img src="../uploaded_files/news_img/<?php echo $res1[news_img_file]; ?>" width="100" height="100" />
                                        <br />
                                        <a href="sup_photo.php?news_id=<?php echo $res1[news_id]; ?>&news_img_id=<?php echo $res1[news_img_id]; ?>">Supprimer</a>
												</td>
											<?php
								$i++;
						   }
						   while($i<=4){?>
												<td valign="top">
										<input type="file" name="file<?php echo $i;?>"  /><br />
												</td>
											<?php
								$i++;
						   }
                           ?>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
            	<th>youtube Code video</th>
                <td><input type="text" name="video" value="<?php echo $rn[video]; ?>" /></td>
            </tr>
            <tr>
          <th>
          	Contenu
            </th>
            <td>
            <textarea name="desc" id="desc" cols="100" rows="4"><?php echo $rn[contenu_news];?></textarea>
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
        	<input type="submit" value="Modifier" >
        	<input name="action" type="hidden" value="Update" >
        </td>
    </tr>
</table>

</form>