<?php
$dtjour= date("Y-m-d");

$mysql_featured="SELECT *
				FROM tbl_classified, tbl_classified_image
				WHERE 
				(
					DATE_FORMAT(`date_fin_premium`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d')
				OR 
					DATE_FORMAT(`date_fin_republication`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d')
				OR 
					DATE_FORMAT(`date_fin_couleur`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d')
				OR 
					DATE_FORMAT(`date_fin_urgent`, '%Y-%m-%d') > DATE_FORMAT('".$dtjour."', '%Y-%m-%d')
				)
				AND tbl_classified.classified_status='Active'
			
				GROUP BY tbl_classified.classified_id
				ORDER BY tbl_classified.date_fin_premium DESC LIMIT 0,7";

$resultnav_featured = db_query($mysql_featured);
if(mysql_num_rows($resultnav_featured)!=0){?>
	<div id="resultfeatured">
        <h3 class="OnOne">Vos annonces (en avant) ici:</h3>
	<?php
		$resultnav_featured = db_query($mysql_featured);
		while($rownav_featured = mysql_fetch_array($resultnav_featured)){			
			?>
			<div class="items">
				<!--<div class="premium">PREMIUM</div>
				<br />-->
				<span>
                    <a href="classified-details.php?clsId=<?php echo $rownav_featured['classified_id']; ?>" rel="nofollow">
					<?php
                        $mysql_featured_img="SELECT *
                        FROM tbl_classified_image
                        WHERE tbl_classified_image.clsd_id = '".$rownav_featured['classified_id']."' and img_status='Y'";
                        
                        $resultnav_featured_img = db_query($mysql_featured_img);
                        if(mysql_num_rows($resultnav_featured_img)!=0) {
							$rownav_featured_img = mysql_fetch_array($resultnav_featured_img);
							$file_sm = 'mobile/uploaded_files/classified_img/'.$rownav_featured_img['cls_img_file'];
                        }
                        else{
							$file_sm = 'mobile/uploaded_files/cat_img/'.$rownav_featured['clsd_cat_id'].'.png';
                        }
					?>
                        <img src="<?php echo $file_sm;?>" border="0" width="100" height="100" class="border-img"
                        title="<?php echo $rownav_featured['classified_title'];?>"
                        alt="<?php echo $rownav_featured['classified_title'];?>" />
                    </a>
                    <?php echo strip_tags(truncateText($rownav_featured['classified_title'],50,' ','...',true));?>
				</span>
			</div>
		<?php
		}
		?>
	</div>
<?php
}
?>