<?php


require_once("arrays.inc.php");


$cat_Arr=main_cat_array();
if($_REQUEST[catId]!=""){
  $main_catId=intval($_REQUEST[catId]);
}
else if($_REQUEST[subcatId1]!=""){
  $main_catId=get_catinfo($_REQUEST[subcatId1],'cat_parent');
}
else if($_REQUEST[subcatId]!=""){
  $main_catId=get_catinfo(get_catinfo($_REQUEST[subcatId],'cat_parent'),'cat_parent');
}
?>
<div>
      <div style="width:202px; margin-top:6px;">
        <div style="width:202px; margin-top:6px;">
        <p><img src="<?php echo $theem_img;?>/left-box1-top.jpg" alt=""/></p>
        <div class="bg-left-box1">
          <div>
            <p class="fl"><img src="<?php echo $theem_img;?>/popular-searches-icon.jpg" alt="" hspace="10"/></p>
            <p class="fl"><span class="heading">  Catégories principales</span><br />
            </p>
            <p class="cb"></p>
           <div class="mt10 pl10 pr10">
		   <?php
		    $i=1;
		    foreach($cat_Arr as $key2=>$val2){ 
			   $clsss=($i==0) ? "blue-heading" : "blue-heading mt10 border-bot";
			   if($cat_Arr[$i]['catId']!=$_REQUEST['catId']){
			   
	//$html_link=GetValidFileName(strtolower($cat_Arr[$i]['catName']))."-".$cat_Arr[$i][catId].".htm";		   
	$html_link="classified-listing.php?catId=".$cat_Arr[$i]['catId'];
			     $link="<a href='$html_link' class='link1'>".ucfirst($cat_Arr[$i]['catName'])."</a>";
			   }else{
			     $link=ucfirst($cat_Arr[$i]['catName']);
			   }			 
			?>         
            <p class="<?php echo $clsss;?>"><?php echo $link;?></p>
		    <?php
		     if($_REQUEST['catId']!=""){
			     	  
		       echo get_searched_catlist($cat_Arr[$i]['catId'],$_REQUEST['catId'],'');
		      }
			  if($_REQUEST['subcatId1']!=""){
				   
		       echo get_searched_catlist($cat_Arr[$i]['catId'],'',$_REQUEST['subcatId1']);
			   
		      }
			  if($_REQUEST['subcatId']!=""){
			  	#echo "test==".$cat_Arr[$i]['catId']."==".$_REQUEST['subcatId'];			  			
			   echo get_searched_catlist($cat_Arr[$i]['catId'],'','',$_REQUEST['subcatId']);
			  }
			  if($_REQUEST['clsId']!=""){			  		   
		       echo get_searched_catlist($cat_Arr[$i]['catId'],'','','',$_REQUEST['clsId']);
		      }			  
		     ?>
		   <?php $i++; } ?>		   
          </div>
          </div></div>
        <p><img src="<?php echo $theem_img;?>/left-box1-bot.jpg" alt=""/></p>
      </div>
    </div>
     <form  name="" action="search-result.php" method="get" >
    <div style="width:202px; margin-top:10px;">
        <p><img src="<?php echo $theem_img;?>/left-box-top.jpg" alt=""/></p>
        <div class="bg-left-box pl10 pr10">
        <p class="fl"><img src="<?php echo $theem_img;?>/view-classified-icon.jpg" alt=""/> &nbsp;&nbsp;</p>
          <p class="fl heading">Recherche</p>
          <p class="cb"></p>
		  <table width="100%" border="0" cellspacing="0" cellpadding="0">






  <tr>
    <td>Mot clé</td>
    </tr>
  <tr>
    <td><center><input name="keyword" type="text" class="textbox1" style="width:160px;" value=""/></td></center>
    </tr>
  <tr>
    <td height="5"></td>
    </tr>




<style>.mt10 ul {
        margin-left: 0px;
    }
    select {
  font:12px Arial,Helvetica,sans-serif;
    color:black;
    padding: 5px 10px 5px 10px;
    margin: 0px 5px 5px 5px;
    border-radius: 8px;
    -moz-border-radius: 8px;
    -webkit-border-radius: 8px;
    -webkit-box-shadow: 0 1px 0 #ccc, 0 -1px #eaeaea inset;
    -moz-box-shadow: 0 3px 0 #ccc, 0 -1px #eaeaea inset;
/*    box-shadow: 0 3px 0 #ccc, 0 -1px #eaeaea inset;*/
    
    border:none;
    outline:none;
    display: inline-block;
    -webkit-appearance:none;
    -moz-appearance:none;
    appearance:none;
    cursor:pointer;
}

</style>




  <tr>  
    <tr>
    <td>ID de l'annonce</td>
    </tr>
  <tr>
    <td><center><input name="ad_id" type="text" class="textbox1" style="width:160px;" value="" /></td></center>
    </tr>
  <tr>
    <td height="5"></td>
    </tr>
  <tr>
  
  
    <td>Catégorie</td>
    </tr>
  <tr>
    <td><center><select name="cat_level_root" class="textbox1" style="width:160px;" onChange="Acat_drop_down(this.value,'')">
	 <?php echo Root_cat($cat_level_root);?>
    </select></center></td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <td>Sous Catégorie</td>
  </tr>
  <tr>
    <td>
	 <div id="cat_tree1">	
	<center><select name="cat_level_one" class="textbox1" style="width:160px;" onChange=" cat_drop_down2(this.value,'')">
    </select></center>
	</div>	
	</td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <td>Sous Sous Catégorie</td>
  </tr>
  <tr>
    <td>
	<div id="cat_level_two">
	<center><select name="cat_level_two" class="textbox1" style="width:160px;"></center>
    </select>
	 </div>  
	</td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>


<tr>
  <td height="5">Type d'annonce</td>
    </tr>
  <tr>
    <td><center><select name="classi_ad_type" class="textbox1" style="width:160px;" onChange="cat_drop_down(this.value,'')"></center>
<option value="">Choisir Type d'annonce</option>
				   <?php foreach($Ads_type as $key=>$val){
				      $sel=($classi_ad_type!="" && ($classi_ad_type==$val))? "selected" : "";
				   ?>
                     <option value="<?php echo $val;?>" <?php echo $sel;?> ><?php echo $val;?></option>
				 <?php } ?>	
    </select></td>
  </tr>




 <tr>
    <td height="5"></td>
  </tr>
<tr>
 <td height="5">Fourchette de Prix</td>
    </tr>
    
 
                   
                    <tr>
                        <td>
                            <div id="" style="margin-bottom: 8px;">
                                <input type="text" name="min" style="width:75px;height:20px;margin-left: 8px;" value="de"    onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;" />
                                <input type="text" name="max" style="margin-left: 0px;width:75px;height:20px;" value="à"  onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;"  />
                            </div>  
                        </td>
                    </tr>




 <tr>
    <td height="5"></td>
  </tr>








  <tr>
    <td>Province</td>
  </tr>
  <tr>
    <td><center><select name="classi_state" class="textbox1" style="width:160px;" onChange="return get_city_by_state(this.value,'')"></center>
	<?php echo get_state();?>
    </select></td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <td>Ville</td>
  </tr>
  <tr>
    <td>
	<div id="city_link">
	<center><select name="classi_city" class="textbox1" style="width:160px;"></center>
    </select>	  
	  </div>
	</td>
  </tr>
  <tr>
    <td height="5"></td>
  </tr>
  <tr>
    <td><input name="sub" type="image" src="<?php echo $theem_img;?>/submit-btn.jpg"></td>
  </tr>
          </table>
		   
        </div>
        <p><img src="<?php echo $theem_img;?>/left-box-bot.jpg" alt=""/></p></div>
        <input type="hidden" name="searchkey" value="search_record">
		</form>
		 <?php
		 if($main_catId!="" && $main_catId>0){		 
		    manage_banner_requests($main_catId,"Classified Listing Left");
		 }else{
		    manage_banner_requests($res['clsd_cat_id'],"Classified Detail Left");
		 }
		 ?>  
        </div>



