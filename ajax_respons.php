<?php
require_once("includes/main.inc.php");
if($_GET['c']!="")
{
$username = @$_GET['c'];
$valid = preg_match( '/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/', $username);
     if(!$valid)
     {
		 echo $msg1=" <b><font color='#FF0000'><li>
		 Ce n'est pas une adresse email valide! S'il vous plaît remplir une adresse email valide </li></font></b>";
		}else{
			$count = mysql_num_rows(db_query("select * from tbl_member  where user_id='".$username."'"));
			if($count > 0)
			{
			echo $msg2=" <b><font color='#FF0000'><li>
			Cet email existe déjà, s'il vous plaît sélectionner un autre.</li></font></b>";
			}else{
			 echo $msg3=" <b><font color='#FF0000'><li>Cet e-mail est disponible .</li></font></b>";
			}
		
	}
		
}

/* Make Sub category drop down */
if(isset($_REQUEST['catId']) && $_REQUEST['catId']!=""){		$catID = intval($_REQUEST['catId']);
      $sql_cat=db_query("select * from tbl_category where cat_parent ='$catID' and cat_status='Y' order by cat_order");
	  $num=mysql_num_rows($sql_cat);
       $var='<select name="cat_level_one" class="textbox1"  onChange="cat_drop_down2(this.value,\'\')" />';	  
	  $var.= '<option value="">Sélectionnez Sous-catégorie</option>';
	  if($num > 0 ){			$sbCatID = intval($_REQUEST['sbcatId']);
	      while($rw=mysql_fetch_array($sql_cat)){ 
		  if($rw[cat_id]==$sbCatID){
		     $sel="selected";
		   }else{
		     $sel="";
		   	}  
		  $var.='<option value="'.$rw['cat_id'].'" '.$sel.' >'.$rw['cat_name'].'</option>';		
	       }
		   $var.='</select>';		 
	   }
echo $var;
}
/* Make Sub category drop down */
if(isset($_REQUEST['catId_advertise']) && $_REQUEST['catId_advertise']!=""){		$catID = intval($_REQUEST['catId']);
      $sql_cat=db_query("select * from tbl_category where cat_parent ='$catId_advertise' and cat_status='Y' order by cat_order");
	  $num=mysql_num_rows($sql_cat);
       $var='<select name="cat_level_one" class="textbox1"  onChange="cat_drop_down2_advertise(this.value,\'\')" />';	  
	  $var.= '<option value="">Sélectionnez Sous-catégorie</option>';
	  if($num > 0 ){			$sbCatID = intval($_REQUEST['sbcatId']);
	      while($rw=mysql_fetch_array($sql_cat)){ 
		  if($rw[cat_id]==$sbCatID){
		     $sel="selected";
		   }else{
		     $sel="";
		   	}  
		  $var.='<option value="'.$rw['cat_id'].'" '.$sel.' >'.$rw['cat_name'].'</option>';		
	       }
		   $var.='</select>';		 
	   }
echo $var;
}
/* Make Sub category drop down */
if(isset($_REQUEST['catId_advertise2']) && $_REQUEST['catId_advertise2']!=""){		$catID = intval($_REQUEST['catId']);
      $sql_cat=db_query("select * from tbl_category where cat_parent ='$catId_advertise2' and cat_status='Y' order by cat_order");
	  $num=mysql_num_rows($sql_cat);
       $var='<select name="cat_level_two" class="textbox1"  " />';	  
	  $var.= '<option value="">Sélectionnez Sous-catégorie</option>';
	  if($num > 0 ){			$sbCatID = intval($_REQUEST['sbcatId']);
	      while($rw=mysql_fetch_array($sql_cat)){ 
				if($rw[cat_id]==$sbCatID){
					$sel="selected";
				}else{
					$sel="";
				}  
				$var.='<option value="'.$rw['cat_id'].'" '.$sel.' >'.$rw['cat_name'].'</option>';		
	       }
		   $var.='</select>';		 
	   }
echo $var;
}

/* Make Sub Sub category drop down second level */
if(isset($_REQUEST['subcatId']) && $_REQUEST['subcatId']!=""){	  $subCatID = intval($_REQUEST['subcatId']);
      $sql_cat=db_query("select * from tbl_category where cat_parent ='$subCatID' and cat_status='Y' order by cat_order");
	   $num=mysql_num_rows($sql_cat);
	   $var='<select name="cat_level_two" class="textbox1"  />'; 
	   $var.= '<option value="">Sélectionnez Sous-catégorie</option>';
	  if($num > 0 ){			$sbCatID = intval($_REQUEST['sbcatId']);
	      while($rw=mysql_fetch_array($sql_cat)){ 
		  if($rw[cat_id]==$sbCatID){
		     $sel="selected";
		   }else{
		     $sel="";
		   	}  
		  $var.='<option value="'.$rw['cat_id'].'" '.$sel.' >'.$rw['cat_name'].'</option>';		
	       }
		 $var.='</select>';		 
	   }
echo $var;
}


/* Make Option Sub Sub category drop down second level */
if(isset($_REQUEST['subcatId']) && $_REQUEST['subcatId']!=""){
	$subCatID = intval($_REQUEST['subcatId']);
      $sql_cat=db_query("select * from tbl_option_cat where cat_id ='$subcatId' order by cat_id");
	   $num=mysql_num_rows($sql_cat);
	   $var=''; 
	  if($num > 0 ){			
			$sbCatID = intval($_REQUEST['sbcatId']);
			while($rw=mysql_fetch_array($sql_cat)){ 
				$var.=$rw['option_nom'];
					  $sql=db_query("select * from tbl_option_cat where cat_id ='$subcatId' order by cat_id");
					   $num=mysql_num_rows($sql_cat);
				//.' <input type="text" value="'.$rw['cat_id'].'" '.$sel.' >';
				$var.='<br>';
			}	 
	   }
echo $var;
}


/* Make Ogiga Sub Sub category drop down First Level*/
if(isset($_REQUEST['pcatId']) && $_REQUEST['pcatId']!=""){
	$pcatId = intval($_REQUEST['pcatId']);
	   $var=''; 
	  
	  $sql_sous_cat=db_query("select * from tbl_category where cat_parent ='".$pcatId."' AND`cat_status`='Y' order by cat_order ");
	  while($rw_sc=mysql_fetch_array($sql_sous_cat))
	  {
		$var.="<label>
				<input name='cat_level_two' id='cat_level_two' value='".$rw_sc['cat_id']."' type='radio' onclick='cat_drop_down3(this.value,\"\")'  required='required'>
				".$rw_sc['cat_name'].'
				</label><br>
			';
	  }
echo $var;
}

/*******
		********/

/* Make Option Sub Sub category drop down second level */
if(isset($_REQUEST['list_osubcatId']) && $_REQUEST['list_osubcatId']!=""){
	$cat=$_REQUEST['list_osubcatId'];
	$var=''; 
		
		if($cat!=835 && $cat!=888 && $cat!=889 && $cat!=892 && $cat!=893){
		
            $var.='
			Prix:
			<select  name="prixmin" class="textbox" style="width:auto;">
                <option value="" >min</option>
                <option value="20"'; if(@$_REQUEST['prixmin']=='20') $var.=' selected'; $var.='>20</option>
                <option value="50"'; if(@$_REQUEST['prixmin']=='50') $var.=' selected'; $var.='>50</option>
                <option value="100"'; if(@$_REQUEST['prixmin']=='100') $var.=' selected'; $var.='>100</option>
                <option value="500"'; if(@$_REQUEST['prixmin']=='500') $var.=' selected'; $var.='>500</option>
                <option value="1000"'; if(@$_REQUEST['prixmin']=='1000') $var.=' selected'; $var.='>1 000</option>
                <option value="1500"'; if(@$_REQUEST['prixmin']=='1500') $var.=' selected'; $var.='>1 500</option>
                <option value="2000"'; if(@$_REQUEST['prixmin']=='2000') $var.=' selected'; $var.='>2 000</option>
                <option value="2500"'; if(@$_REQUEST['prixmin']=='2500') $var.=' selected'; $var.='>2 500</option>
                <option value="3000"'; if(@$_REQUEST['prixmin']=='3000') $var.=' selected'; $var.='>3 000</option>
                <option value="4000"'; if(@$_REQUEST['prixmin']=='4000') $var.=' selected'; $var.='>4 000</option>
                <option value="5000"'; if(@$_REQUEST['prixmin']=='5000') $var.=' selected'; $var.='>5 000</option>
                <option value="7500"'; if(@$_REQUEST['prixmin']=='7500') $var.=' selected'; $var.='>7 500</option>
                <option value="10000"'; if(@$_REQUEST['prixmin']=='10000') $var.=' selected'; $var.='>10 000</option>
                <option value="15000"'; if(@$_REQUEST['prixmin']=='15000') $var.=' selected'; $var.='>15 000</option>
                <option value="20000"'; if(@$_REQUEST['prixmin']=='20000') $var.=' selected'; $var.='>20 000</option>
                <option value="30000"'; if(@$_REQUEST['prixmin']=='30000') $var.=' selected'; $var.='>30 000</option>
                <option value="40000"'; if(@$_REQUEST['prixmin']=='40000') $var.=' selected'; $var.='>40 000</option>
                <option value="50000"'; if(@$_REQUEST['prixmin']=='50000') $var.=' selected'; $var.='>50 000</option>
                <option value="75000"'; if(@$_REQUEST['prixmin']=='75000') $var.=' selected'; $var.='>75 000</option>
                <option value="100000"'; if(@$_REQUEST['prixmin']=='100000') $var.=' selected'; $var.='>100 000</option>            
            </select>
            
            <select name="prixmax" class="textbox" style="width:auto;">
                <option value="" >max</option>
                <option value="20"'; if(@$_REQUEST['prixmax']=='20') $var.=' selected'; $var.='>20</option>
                <option value="50"'; if(@$_REQUEST['prixmax']=='50') $var.=' selected'; $var.='>50</option>
                <option value="100"'; if(@$_REQUEST['prixmax']=='100') $var.=' selected'; $var.='>100</option>
                <option value="500"'; if(@$_REQUEST['prixmax']=='500') $var.=' selected'; $var.='>500</option>
                <option value="1000"'; if(@$_REQUEST['prixmax']=='1000') $var.=' selected'; $var.='>1 000</option>
                <option value="1500"'; if(@$_REQUEST['prixmax']=='1500') $var.=' selected'; $var.='>1 500</option>
                <option value="2000"'; if(@$_REQUEST['prixmax']=='2000') $var.=' selected'; $var.='>2 000</option>
                <option value="2500"'; if(@$_REQUEST['prixmax']=='2500') $var.=' selected'; $var.='>2 500</option>
                <option value="3000"'; if(@$_REQUEST['prixmax']=='3000') $var.=' selected'; $var.='>3 000</option>
                <option value="4000"'; if(@$_REQUEST['prixmax']=='4000') $var.=' selected'; $var.='>4 000</option>
                <option value="5000"'; if(@$_REQUEST['prixmax']=='5000') $var.=' selected'; $var.='>5 000</option>
                <option value="7500"'; if(@$_REQUEST['prixmax']=='7500') $var.=' selected'; $var.='>7 500</option>
                <option value="10000"'; if(@$_REQUEST['prixmax']=='10000') $var.=' selected'; $var.='>10 000</option>
                <option value="15000"'; if(@$_REQUEST['prixmax']=='15000') $var.=' selected'; $var.='>15 000</option>
                <option value="20000"'; if(@$_REQUEST['prixmax']=='20000') $var.=' selected'; $var.='>20 000</option>
                <option value="30000"'; if(@$_REQUEST['prixmax']=='30000') $var.=' selected'; $var.='>30 000</option>
                <option value="40000"'; if(@$_REQUEST['prixmax']=='40000') $var.=' selected'; $var.='>40 000</option>
                <option value="50000"'; if(@$_REQUEST['prixmax']=='50000') $var.=' selected'; $var.='>50 000</option>
                <option value="75000"'; if(@$_REQUEST['prixmax']=='75000') $var.=' selected'; $var.='>75 000</option>
                <option value="100000"'; if(@$_REQUEST['prixmax']=='100000') $var.=' selected'; $var.='>100 000</option>
                <option value="9999999"'; if(@$_REQUEST['prixmax']=='9999999') $var.=' selected'; $var.='>illimité</option>
            </select>';
        
		}
		
    	switch($cat){
		
        case 900:
        	
            $var.='
			Km:
            <select  name="kmmin" class="textbox" style="width:auto;">
                <option value="">min</option>
                <option value="10000"'; if(@$_REQUEST['kmmin']=='10000') $var.=' selected'; $var.='>10 000</option>
                <option value="20000"'; if(@$_REQUEST['kmmin']=='20000') $var.=' selected'; $var.='>20 000</option>
                <option value="30000"'; if(@$_REQUEST['kmmin']=='30000') $var.=' selected'; $var.='>30 000</option>
                <option value="40000"'; if(@$_REQUEST['kmmin']=='40000') $var.=' selected'; $var.='>40 000</option>
                <option value="50000"'; if(@$_REQUEST['kmmin']=='50000') $var.=' selected'; $var.='>50 000</option>
                <option value="60000"'; if(@$_REQUEST['kmmin']=='60000') $var.=' selected'; $var.='>60 000</option>
                <option value="70000"'; if(@$_REQUEST['kmmin']=='70000') $var.=' selected'; $var.='>70 000</option>
                <option value="80000"'; if(@$_REQUEST['kmmin']=='80000') $var.=' selected'; $var.='>80 000</option>
                <option value="90000"'; if(@$_REQUEST['kmmin']=='90000') $var.=' selected'; $var.='>90 000</option>
                <option value="100000"'; if(@$_REQUEST['kmmin']=='100000') $var.=' selected'; $var.='>100 000</option>
                <option value="125000"'; if(@$_REQUEST['kmmin']=='125000') $var.=' selected'; $var.='>125 000</option>
                <option value="150000"'; if(@$_REQUEST['kmmin']=='150000') $var.=' selected'; $var.='>150 000</option>
                <option value="175000"'; if(@$_REQUEST['kmmin']=='175000') $var.=' selected'; $var.='>175 000</option>
                <option value="200000"'; if(@$_REQUEST['kmmin']=='200000') $var.=' selected'; $var.='>200 000</option>
                <option value="250000"'; if(@$_REQUEST['kmmin']=='250000') $var.=' selected'; $var.='>250 000</option>
            </select>
            
            <select name="kmmax" class="textbox" style="width:auto;">
                <option value="">max</option>
                <option value="10000"'; if(@$_REQUEST['kmmax']=='10000') $var.=' selected'; $var.='>10 000</option>
                <option value="20000"'; if(@$_REQUEST['kmmax']=='20000') $var.=' selected'; $var.='>20 000</option>
                <option value="30000"'; if(@$_REQUEST['kmmax']=='30000') $var.=' selected'; $var.='>30 000</option>
                <option value="40000"'; if(@$_REQUEST['kmmax']=='40000') $var.=' selected'; $var.='>40 000</option>
                <option value="50000"'; if(@$_REQUEST['kmmax']=='50000') $var.=' selected'; $var.='>50 000</option>
                <option value="60000"'; if(@$_REQUEST['kmmax']=='60000') $var.=' selected'; $var.='>60 000</option>
                <option value="70000"'; if(@$_REQUEST['kmmax']=='70000') $var.=' selected'; $var.='>70 000</option>
                <option value="80000"'; if(@$_REQUEST['kmmax']=='80000') $var.=' selected'; $var.='>80 000</option>
                <option value="90000"'; if(@$_REQUEST['kmmax']=='90000') $var.=' selected'; $var.='>90 000</option>
                <option value="100000"'; if(@$_REQUEST['kmmax']=='100000') $var.=' selected'; $var.='>100 000</option>
                <option value="125000"'; if(@$_REQUEST['kmmax']=='125000') $var.=' selected'; $var.='>125 000</option>
                <option value="150000"'; if(@$_REQUEST['kmmax']=='150000') $var.=' selected'; $var.='>150 000</option>
                <option value="175000"'; if(@$_REQUEST['kmmax']=='175000') $var.=' selected'; $var.='>175 000</option>
                <option value="200000"'; if(@$_REQUEST['kmmax']=='200000') $var.=' selected'; $var.='>200 000</option>
                <option value="250000"'; if(@$_REQUEST['kmmax']=='250000') $var.=' selected'; $var.='>250 000</option>
                <option value="9999999"'; if(@$_REQUEST['kmmax']=='9999999') $var.=' selected'; $var.='>illimité</option>
            </select>
            
            Année:
            <select name="anneemin" class="textbox" style="width:auto;">
                <option value="">min</option>';
                
                    for ($i = date("Y"); $i >= 1900; $i--) {
                        if(@$_REQUEST['anneemin']==$i)
                            $var.= "<option value='".$i."' selected>".$i."</option>";
                        else
                            $var.= "<option value='".$i."'>".$i."</option>";
                    }
                
            $var.=
			'</select>
        
            <select name="anneemax" class="textbox" style="width:auto;">
                <option value="">max</option>';
                
                    for ($i = date("Y"); $i >= 1900; $i--) {
                        if(@$_REQUEST['anneemax']==$i)
                            $var.='<option value="'.$i.'" selected>'.$i.'</option>';
                        else
                            $var.='<option value="'.$i.'">'.$i.'</option>';
                    }
                
            $var.='
			</select>
			
			Energie:
			<select name="energy" class="textbox" style="width:auto;">
				<option value="">Indifférent</option>
				<option value="1"'; if(@$_REQUEST['energy']==1) $var.='selected'; $var.='>Essence</option>
				<option value="2"'; if(@$_REQUEST['energy']==2) $var.='selected'; $var.='>Diesel</option>
				<option value="3"'; if(@$_REQUEST['energy']==3) $var.='selected'; $var.='>GPL</option>
				<option value="4"'; if(@$_REQUEST['energy']==4) $var.='selected'; $var.='>Electrique</option>
				<option value="5"'; if(@$_REQUEST['energy']==5) $var.='selected'; $var.='>Hybride</option>
			</select>';  //if($energy=='')echo "selected='selected'";
            break;
        
        case 901:
			
			$var.='
			Km:
			<select  name="kmmin" class="textbox" style="width:auto;">
				<option value="">min</option>
				<option value="10000"'; if(@$_REQUEST['kmmin']=='10000') $var.=' selected'; $var.='>10 000</option>
				<option value="20000"'; if(@$_REQUEST['kmmin']=='20000') $var.=' selected'; $var.='>20 000</option>
				<option value="30000"'; if(@$_REQUEST['kmmin']=='30000') $var.=' selected'; $var.='>30 000</option>
				<option value="40000"'; if(@$_REQUEST['kmmin']=='40000') $var.=' selected'; $var.='>40 000</option>
				<option value="50000"'; if(@$_REQUEST['kmmin']=='50000') $var.=' selected'; $var.='>50 000</option>
				<option value="60000"'; if(@$_REQUEST['kmmin']=='60000') $var.=' selected'; $var.='>60 000</option>
				<option value="70000"'; if(@$_REQUEST['kmmin']=='70000') $var.=' selected'; $var.='>70 000</option>
				<option value="80000"'; if(@$_REQUEST['kmmin']=='80000') $var.=' selected'; $var.='>80 000</option>
				<option value="90000"'; if(@$_REQUEST['kmmin']=='90000') $var.=' selected'; $var.='>90 000</option>
				<option value="100000"'; if(@$_REQUEST['kmmin']=='100000') $var.=' selected'; $var.='>100 000</option>
				<option value="125000"'; if(@$_REQUEST['kmmin']=='125000') $var.=' selected'; $var.='>125 000</option>
				<option value="150000"'; if(@$_REQUEST['kmmin']=='150000') $var.=' selected'; $var.='>150 000</option>
				<option value="175000"'; if(@$_REQUEST['kmmin']=='175000') $var.=' selected'; $var.='>175 000</option>
				<option value="200000"'; if(@$_REQUEST['kmmin']=='200000') $var.=' selected'; $var.='>200 000</option>
				<option value="250000"'; if(@$_REQUEST['kmmin']=='250000') $var.=' selected'; $var.='>250 000</option>
			</select>
			
			<select name="kmmax"  class="textbox" style="width:auto;">
				<option value=""'; if(@$_REQUEST['kmmax']=='') $var.=' selected'; $var.='>max</option>
				<option value="10000"'; if(@$_REQUEST['kmmax']=='10000') $var.=' selected'; $var.='>10 000</option>
				<option value="20000"'; if(@$_REQUEST['kmmax']=='20000') $var.=' selected'; $var.='>20 000</option>
				<option value="30000"'; if(@$_REQUEST['kmmax']=='30000') $var.=' selected'; $var.='>30 000</option>
				<option value="40000"'; if(@$_REQUEST['kmmax']=='40000') $var.=' selected'; $var.='>40 000</option>
				<option value="50000"'; if(@$_REQUEST['kmmax']=='50000') $var.=' selected'; $var.='>50 000</option>
				<option value="60000"'; if(@$_REQUEST['kmmax']=='60000') $var.=' selected'; $var.='>60 000</option>
				<option value="70000"'; if(@$_REQUEST['kmmax']=='70000') $var.=' selected'; $var.='>70 000</option>
				<option value="80000"'; if(@$_REQUEST['kmmax']=='80000') $var.=' selected'; $var.='>80 000</option>
				<option value="90000"'; if(@$_REQUEST['kmmax']=='90000') $var.=' selected'; $var.='>90 000</option>
				<option value="100000"'; if(@$_REQUEST['kmmax']=='100000') $var.=' selected'; $var.='>100 000</option>
				<option value="125000"'; if(@$_REQUEST['kmmax']=='125000') $var.=' selected'; $var.='>125 000</option>
				<option value="150000"'; if(@$_REQUEST['kmmax']=='150000') $var.=' selected'; $var.='>150 000</option>
				<option value="175000"'; if(@$_REQUEST['kmmax']=='175000') $var.=' selected'; $var.='>175 000</option>
				<option value="200000"'; if(@$_REQUEST['kmmax']=='200000') $var.=' selected'; $var.='>200 000</option>
				<option value="250000"'; if(@$_REQUEST['kmmax']=='250000') $var.=' selected'; $var.='>250 000</option>
				<option value="9999999"'; if(@$_REQUEST['kmmax']=='9999999') $var.=' selected'; $var.='>illimité</option>
			</select>
			
			Cylindrée:
			<select name="cylindreemin" class="textbox" style="width:auto;">
				<option value=""'; if(@$_REQUEST['cylindreemin']=='') $var.=' selected'; $var.='>min</option>
				<option value="50"'; if(@$_REQUEST['cylindreemin']=='50') $var.=' selected'; $var.='>50</option>
				<option value="80"'; if(@$_REQUEST['cylindreemin']=='80') $var.=' selected'; $var.='>80</option>
				<option value="125"'; if(@$_REQUEST['cylindreemin']=='125') $var.=' selected'; $var.='>125</option>
				<option value="250"'; if(@$_REQUEST['cylindreemin']=='250') $var.=' selected'; $var.='>250</option>
				<option value="400"'; if(@$_REQUEST['cylindreemin']=='400') $var.=' selected'; $var.='>400</option>
				<option value="500"'; if(@$_REQUEST['cylindreemin']=='500') $var.=' selected'; $var.='>500</option>
				<option value="600"'; if(@$_REQUEST['cylindreemin']=='600') $var.=' selected'; $var.='>600</option>
				<option value="750"'; if(@$_REQUEST['cylindreemin']=='750') $var.=' selected'; $var.='>750</option>
				<option value="900"'; if(@$_REQUEST['cylindreemin']=='900') $var.=' selected'; $var.='>900</option>
				<option value="1000"'; if(@$_REQUEST['cylindreemin']=='1000') $var.=' selected'; $var.='>1 000</option>
				<option value="1100"'; if(@$_REQUEST['cylindreemin']=='1100') $var.=' selected'; $var.='>1 100</option>
				<option value="1200"'; if(@$_REQUEST['cylindreemin']=='1200') $var.=' selected'; $var.='>1 200</option>
			</select>
			
			<select name="cylindreemax" class="textbox" style="width:auto;">
				<option value=""'; if(@$_REQUEST['cylindreemax']=='') $var.=' selected'; $var.='>max</option>
				<option value="50"'; if(@$_REQUEST['cylindreemax']=='50') $var.=' selected'; $var.='>50</option>
				<option value="80"'; if(@$_REQUEST['cylindreemax']=='80') $var.=' selected'; $var.='>80</option>
				<option value="125"'; if(@$_REQUEST['cylindreemax']=='125') $var.=' selected'; $var.='>125</option>
				<option value="250"'; if(@$_REQUEST['cylindreemax']=='250') $var.=' selected'; $var.='>250</option>
				<option value="400"'; if(@$_REQUEST['cylindreemax']=='400') $var.=' selected'; $var.='>400</option>
				<option value="500"'; if(@$_REQUEST['cylindreemax']=='500') $var.=' selected'; $var.='>500</option>
				<option value="600"'; if(@$_REQUEST['cylindreemax']=='600') $var.=' selected'; $var.='>600</option>
				<option value="750"'; if(@$_REQUEST['cylindreemax']=='750') $var.=' selected'; $var.='>750</option>
				<option value="900"'; if(@$_REQUEST['cylindreemax']=='900') $var.=' selected'; $var.='>900</option>
				<option value="1000"'; if(@$_REQUEST['cylindreemax']=='1000') $var.=' selected'; $var.='>1 000</option>
				<option value="1100"'; if(@$_REQUEST['cylindreemax']=='1100') $var.=' selected'; $var.='>1 100</option>
				<option value="1200"'; if(@$_REQUEST['cylindreemax']=='1200') $var.=' selected'; $var.='>1 200</option>
				<option value="9999999"'; if(@$_REQUEST['cylindreemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
			</select>
			
			Année:
			<select name="anneemin" class="textbox" style="width:auto;">
				<option value="" >min</option>';
	
					for ($i = date("Y"); $i >= 1900; $i--) {
						if(@$_REQUEST['anneemin']==$i)
							$var.='<option value="'.$i.'" selected>"'.$i.'"</option>';
						else
							$var.='<option value="'.$i.'">"'.$i.'"</option>';
					}
	
			$var.='
			</select>
			
			<select name="anneemax" class="textbox" style="width:auto;">
				<option value="" >max</option>';
					for ($i = date("Y"); $i >= 1900; $i--) {
						if(@$_REQUEST['anneemax']==$i)
							$var.= "<option value='".$i."' selected>".$i."</option>";
						else
							$var.= "<option value='".$i."'>".$i."</option>";
					}
			$var.='
			</select>';
        break;
    
        
        case 902:
			$var.='Km:
			<select  name="kmmin" class="textbox" style="width:auto;">
				<option value="" >min</option>
				<option value="10000"'; if(@$_REQUEST['kmmin']=='10000') $var.=' selected'; $var.='>10 000</option>
				<option value="20000"'; if(@$_REQUEST['kmmin']=='20000') $var.=' selected'; $var.='>20 000</option>
				<option value="30000"'; if(@$_REQUEST['kmmin']=='30000') $var.=' selected'; $var.='>30 000</option>
				<option value="40000"'; if(@$_REQUEST['kmmin']=='40000') $var.=' selected'; $var.='>40 000</option>
				<option value="50000"'; if(@$_REQUEST['kmmin']=='50000') $var.=' selected'; $var.='>50 000</option>
				<option value="60000"'; if(@$_REQUEST['kmmin']=='60000') $var.=' selected'; $var.='>60 000</option>
				<option value="70000"'; if(@$_REQUEST['kmmin']=='70000') $var.=' selected'; $var.='>70 000</option>
				<option value="80000"'; if(@$_REQUEST['kmmin']=='80000') $var.=' selected'; $var.='>80 000</option>
				<option value="90000"'; if(@$_REQUEST['kmmin']=='90000') $var.=' selected'; $var.='>90 000</option>
				<option value="100000"'; if(@$_REQUEST['kmmin']=='100000') $var.=' selected'; $var.='>100 000</option>
				<option value="125000"'; if(@$_REQUEST['kmmin']=='125000') $var.=' selected'; $var.='>125 000</option>
				<option value="150000"'; if(@$_REQUEST['kmmin']=='150000') $var.=' selected'; $var.='>150 000</option>
				<option value="175000"'; if(@$_REQUEST['kmmin']=='175000') $var.=' selected'; $var.='>175 000</option>
				<option value="200000"'; if(@$_REQUEST['kmmin']=='200000') $var.=' selected'; $var.='>200 000</option>
				<option value="250000"'; if(@$_REQUEST['kmmin']=='250000') $var.=' selected'; $var.='>250 000</option>
			</select>
			
			<select name="kmmax" class="textbox" style="width:auto;">
				<option value=""'; if(@$_REQUEST['kmmax']=='') $var.=' selected'; $var.='>max</option>
				<option value="10000"'; if(@$_REQUEST['kmmax']=='10000') $var.=' selected'; $var.='>10 000</option>
				<option value="20000"'; if(@$_REQUEST['kmmax']=='20000') $var.=' selected'; $var.='>20 000</option>
				<option value="30000"'; if(@$_REQUEST['kmmax']=='30000') $var.=' selected'; $var.='>30 000</option>
				<option value="40000"'; if(@$_REQUEST['kmmax']=='40000') $var.=' selected'; $var.='>40 000</option>
				<option value="50000"'; if(@$_REQUEST['kmmax']=='50000') $var.=' selected'; $var.='>50 000</option>
				<option value="60000"'; if(@$_REQUEST['kmmax']=='60000') $var.=' selected'; $var.='>60 000</option>
				<option value="70000"'; if(@$_REQUEST['kmmax']=='70000') $var.=' selected'; $var.='>70 000</option>
				<option value="80000"'; if(@$_REQUEST['kmmax']=='80000') $var.=' selected'; $var.='>80 000</option>
				<option value="90000"'; if(@$_REQUEST['kmmax']=='90000') $var.=' selected'; $var.='>90 000</option>
				<option value="100000"'; if(@$_REQUEST['kmmax']=='100000') $var.=' selected'; $var.='>100 000</option>
				<option value="125000"'; if(@$_REQUEST['kmmax']=='125000') $var.=' selected'; $var.='>125 000</option>
				<option value="150000"'; if(@$_REQUEST['kmmax']=='150000') $var.=' selected'; $var.='>150 000</option>
				<option value="175000"'; if(@$_REQUEST['kmmax']=='175000') $var.=' selected'; $var.='>175 000</option>
				<option value="200000"'; if(@$_REQUEST['kmmax']=='200000') $var.=' selected'; $var.='>200 000</option>
				<option value="250000"'; if(@$_REQUEST['kmmax']=='250000') $var.=' selected'; $var.='>250 000</option>
				<option value="9999999"'; if(@$_REQUEST['kmmax']=='9999999') $var.=' selected'; $var.='>illimité</option>
			</select>
			
			
			Année:
			<select name="anneemin" class="textbox" style="width:auto;">
				<option value=""'; if(@$_REQUEST['anneemin']=='') $var.=' selected'; $var.='>min</option>';
				
					for ($i = date("Y"); $i >= 1900; $i--) {
						if(@$_REQUEST['anneemin']==$i)
							$var.= "<option value='".$i."' selected>".$i."</option>";
						else
							$var.= "<option value='".$i."'>".$i."</option>";
					}
	
			$var.='
			</select>
			
			<select name="anneemax" class="textbox" style="width:auto;">
				<option value="" >max</option>';
				
					for ($i = date("Y"); $i >= 1900; $i--) {
						if(@$_REQUEST['anneemax']==$i)
							$var.= "<option value='".$i."' selected>".$i."</option>";
						else
							$var.= "<option value='".$i."'>".$i."</option>";
					}
				
			$var.='
			</select>';
			
			
			$Type_vehicule6=(@$_REQUEST['Type_vehicule']==6) ? 
						'<option value="6" selected="selected">Caravane</option>':
						'<option value="6">Caravane</option>';
			$Type_vehicule7=(@$_REQUEST['Type_vehicule']==7) ? 
						'<option value="7" selected="selected">Camping car</option>':
						'<option value="7">Camping car</option>';
			$Type_vehicule8=(@$_REQUEST['Type_vehicule']==8) ? 
						'<option value="8" selected="selected">Mobile home</option>':
						'<option value="8">Mobile home</option>';
			$Type_vehicule9=(@$_REQUEST['Type_vehicule']==9) ? 
						'<option value="9" selected="selected">Accessoire</option>':
						'<option value="9">Accessoire</option>'; 
			
			$var.='Type de véhicule:
				<select name="Type_vehicule" class="textbox" style="width:auto;" >
					<option value="">Choisir une option</option>'.
					$Type_vehicule6.
					$Type_vehicule7.
					$Type_vehicule8.
					$Type_vehicule9.
					'
				</select>
				';
        break;
		
        case 903:

        $var.='Km:
        <select  name="kmmin" class="textbox" style="width:auto;">
            <option value="">min</option>
            <option value="10000"'; if(@$_REQUEST['kmmin']=='10000') $var.=' selected'; $var.='>10 000</option>
            <option value="20000"'; if(@$_REQUEST['kmmin']=='20000') $var.=' selected'; $var.='>20 000</option>
            <option value="30000"'; if(@$_REQUEST['kmmin']=='30000') $var.=' selected'; $var.='>30 000</option>
            <option value="40000"'; if(@$_REQUEST['kmmin']=='40000') $var.=' selected'; $var.='>40 000</option>
            <option value="50000"'; if(@$_REQUEST['kmmin']=='50000') $var.=' selected'; $var.='>50 000</option>
            <option value="60000"'; if(@$_REQUEST['kmmin']=='60000') $var.=' selected'; $var.='>60 000</option>
            <option value="70000"'; if(@$_REQUEST['kmmin']=='70000') $var.=' selected'; $var.='>70 000</option>
            <option value="80000"'; if(@$_REQUEST['kmmin']=='80000') $var.=' selected'; $var.='>80 000</option>
            <option value="90000"'; if(@$_REQUEST['kmmin']=='90000') $var.=' selected'; $var.='>90 000</option>
            <option value="100000"'; if(@$_REQUEST['kmmin']=='100000') $var.=' selected'; $var.='>100 000</option>
            <option value="125000"'; if(@$_REQUEST['kmmin']=='125000') $var.=' selected'; $var.='>125 000</option>
            <option value="150000"'; if(@$_REQUEST['kmmin']=='150000') $var.=' selected'; $var.='>150 000</option>
            <option value="175000"'; if(@$_REQUEST['kmmin']=='175000') $var.=' selected'; $var.='>175 000</option>
            <option value="200000"'; if(@$_REQUEST['kmmin']=='200000') $var.=' selected'; $var.='>200 000</option>
            <option value="250000"'; if(@$_REQUEST['kmmin']=='250000') $var.=' selected'; $var.='>250 000</option>
        </select>
        <select name="kmmax" class="textbox" style="width:auto;">
        	<option value="">max</option>
            <option value="10000"'; if(@$_REQUEST['kmmax']=='10000') $var.=' selected'; $var.='>10 000</option>
            <option value="20000"'; if(@$_REQUEST['kmmax']=='20000') $var.=' selected'; $var.='>20 000</option>
            <option value="30000"'; if(@$_REQUEST['kmmax']=='30000') $var.=' selected'; $var.='>30 000</option>
            <option value="40000"'; if(@$_REQUEST['kmmax']=='40000') $var.=' selected'; $var.='>40 000</option>
            <option value="50000"'; if(@$_REQUEST['kmmax']=='50000') $var.=' selected'; $var.='>50 000</option>
            <option value="60000"'; if(@$_REQUEST['kmmax']=='60000') $var.=' selected'; $var.='>60 000</option>
            <option value="70000"'; if(@$_REQUEST['kmmax']=='70000') $var.=' selected'; $var.='>70 000</option>
            <option value="80000"'; if(@$_REQUEST['kmmax']=='80000') $var.=' selected'; $var.='>80 000</option>
            <option value="90000"'; if(@$_REQUEST['kmmax']=='90000') $var.=' selected'; $var.='>90 000</option>
            <option value="100000"'; if(@$_REQUEST['kmmax']=='100000') $var.=' selected'; $var.='>100 000</option>
            <option value="125000"'; if(@$_REQUEST['kmmax']=='125000') $var.=' selected'; $var.='>125 000</option>
            <option value="150000"'; if(@$_REQUEST['kmmax']=='150000') $var.=' selected'; $var.='>150 000</option>
            <option value="175000"'; if(@$_REQUEST['kmmax']=='175000') $var.=' selected'; $var.='>175 000</option>
            <option value="200000"'; if(@$_REQUEST['kmmax']=='200000') $var.=' selected'; $var.='>200 000</option>
            <option value="250000"'; if(@$_REQUEST['kmmax']=='250000') $var.=' selected'; $var.='>250 000</option>
            <option value="9999999"'; if(@$_REQUEST['kmmax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>';
        
		$var.='Année:
        <select name="anneemin" class="textbox" style="width:auto;">
        	<option value="">min</option>';
            
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemin']==$i)
						$var.= "<option value='".$i."' selected>".$i."</option>";
					else
						$var.= "<option value='".$i."'>".$i."</option>";
				}
$var.='</select>
        
        <select name="anneemax" class="textbox" style="width:auto;">
        	<option value="">max</option>';
            
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemax']==$i)
						$var.= "<option value='".$i."' selected>".$i."</option>";
					else
						$var.= "<option value='".$i."'>".$i."</option>";
				}
$var.='
        </select>';
		
			$type_camion10=(@$_REQUEST['type_camion']==10) ? 
		 			'<option value="10" selected="selected">Utilitaire</option>':
					'<option value="10">Utilitaire</option>';
					
		 $type_camion11=(@$_REQUEST['type_camion']=='11') ? 
		 			'<option value="11" selected="selected">Fourgon</option>':
					'<option value="11">Fourgon</option>';
					
		 $type_camion12=(@$_REQUEST['type_camion']=='12') ? 
		 			'<option value="12" selected="selected">Frigorifique</option>':
					'<option value="12">Frigorifique</option>';
					
		 $type_camion13=(@$_REQUEST['type_camion']=='13') ? 
		 			'<option value="13" selected="selected">Benne, Plateau</option>':
					'<option value="13">Benne, Plateau</option>';
					
		 $type_camion14=(@$_REQUEST['type_camion']=='14') ? 
		 			'<option value="14" selected="selected">Poids lourd</option>':
					'<option value="14">Poids lourd</option>';
					
		 $type_camion15=(@$_REQUEST['type_camion']=='15') ? 
		 			'<option value="15" selected="selected">Autre</option>':
					'<option value="15">Autre</option>';

$var.='Type de camion:
			<select name="type_camion" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$type_camion10.
				$type_camion11.
				$type_camion12.
				$type_camion13.
				$type_camion14.
				$type_camion15.
				'</select>';
        break;
		
        case 904:
			$var.='Longueur(m):
        <select name="longueurmin" class="textbox" style="width:auto;">
        	<option value="" >min</option>
            <option value="4"'; if(@$_REQUEST['longueurmin']=='4') $var.=' selected'; $var.='>4</option>
            <option value="6"'; if(@$_REQUEST['longueurmin']=='6') $var.=' selected'; $var.='>6</option>
            <option value="8"'; if(@$_REQUEST['longueurmin']=='8') $var.=' selected'; $var.='>8</option>
            <option value="10"'; if(@$_REQUEST['longueurmin']=='10') $var.=' selected'; $var.='>10</option>
            <option value="12"'; if(@$_REQUEST['longueurmin']=='12') $var.=' selected'; $var.='>12</option>
            <option value="14"'; if(@$_REQUEST['longueurmin']=='14') $var.=' selected'; $var.='>14</option>
            <option value="16"'; if(@$_REQUEST['longueurmin']=='16') $var.=' selected'; $var.='>16</option>
            <option value="18"'; if(@$_REQUEST['longueurmin']=='18') $var.=' selected'; $var.='>18</option>
            <option value="20"'; if(@$_REQUEST['longueurmin']=='20') $var.=' selected'; $var.='>20</option>
            <option value="22"'; if(@$_REQUEST['longueurmin']=='22') $var.=' selected'; $var.='>22</option>
		</select>
        
        <select name="longueurmax" class="textbox" style="width:auto;">
        	<option value=""'; if(@$_REQUEST['longueurmax']=='') $var.=' selected'; $var.='>max</option>
            <option value="4"'; if(@$_REQUEST['longueurmax']=='4') $var.=' selected'; $var.='>4</option>
            <option value="6"'; if(@$_REQUEST['longueurmax']=='6') $var.=' selected'; $var.='>6</option>
            <option value="8"'; if(@$_REQUEST['longueurmax']=='8') $var.=' selected'; $var.='>8</option>
            <option value="10"'; if(@$_REQUEST['longueurmax']=='10') $var.=' selected'; $var.='>10</option>
            <option value="12"'; if(@$_REQUEST['longueurmax']=='12') $var.=' selected'; $var.='>12</option>
            <option value="14"'; if(@$_REQUEST['longueurmax']=='14') $var.=' selected'; $var.='>14</option>
            <option value="16"'; if(@$_REQUEST['longueurmax']=='16') $var.=' selected'; $var.='>16</option>
            <option value="18"'; if(@$_REQUEST['longueurmax']=='18') $var.=' selected'; $var.='>18</option>
            <option value="20"'; if(@$_REQUEST['longueurmax']=='20') $var.=' selected'; $var.='>20</option>
            <option value="22"'; if(@$_REQUEST['longueurmax']=='22') $var.=' selected'; $var.='>22</option>
            <option value="9999999">illimité</option>
        </select>
        
		Année:
        <select name="anneemin" class="textbox" style="width:auto;">
        	<option value=""'; if(@$_REQUEST['anneemin']=='') $var.=' selected'; $var.='>min</option>';
			
				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemin']==$i)
						$var.= "<option value='".$i."' selected>".$i."</option>";
					else
						$var.= "<option value='".$i."'>".$i."</option>";
				}
		$var.='</select>
        
        <select name="anneemax" class="textbox" style="width:auto;">
        	<option value="">max</option>';

				for ($i = date("Y"); $i >= 1900; $i--) {
					if(@$_REQUEST['anneemax']==$i)
						$var.= "<option value='".$i."' selected>".$i."</option>";
					else
						$var.= "<option value='".$i."'>".$i."</option>";
				}
		$var.='</select>';
        
		$type_bateau16=(@$_REQUEST['type_bateau']==16) ? 
		 			'<option value="16" selected="selected">Voilier</option>':
					'<option value="16">Voilier</option>';
		$type_bateau17=(@$_REQUEST['type_bateau']==17) ? 
		 			'<option value="17" selected="selected">Bateau moteur</option>':
					'<option value="17">Bateau moteur</option>'; 
		$var.=' 
			Type de bateau:
				<select name="type_bateau" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$type_bateau16.
				$type_bateau17.'
				</select>';
        break;
        
        case 911:
		case 912:
		case 913:
		case 914:
		case 916:
		case 917:
		case 918:
		case 919:
		
			$var.='
			Pièce:
			<select name="piecemin" class="textbox" style="width:auto;">
				<option value="">min</option>
				<option value="1"'; if(@$_REQUEST['piecemin']=='1') $var.=' selected'; $var.='>Studio</option>
				<option value="2"'; if(@$_REQUEST['piecemin']=='2') $var.=' selected'; $var.='>2</option>
				<option value="3"'; if(@$_REQUEST['piecemin']=='3') $var.=' selected'; $var.='>3</option>
				<option value="4"'; if(@$_REQUEST['piecemin']=='4') $var.=' selected'; $var.='>4</option>
				<option value="5"'; if(@$_REQUEST['piecemin']=='5') $var.=' selected'; $var.='>5</option>
			</select>
			
			<select name="piecemax" class="textbox" style="width:auto;">
				<option value="">max</option>
				<option value="1"'; if(@$_REQUEST['piecemax']=='1') $var.=' selected'; $var.='>Studio</option>
				<option value="2"'; if(@$_REQUEST['piecemax']=='2') $var.=' selected'; $var.='>2</option>
				<option value="3"'; if(@$_REQUEST['piecemax']=='3') $var.=' selected'; $var.='>3</option>
				<option value="4"'; if(@$_REQUEST['piecemax']=='4') $var.=' selected'; $var.='>4</option>
				<option value="5"'; if(@$_REQUEST['piecemax']=='5') $var.=' selected'; $var.='>5</option>
				<option value="9999999"'; if(@$_REQUEST['piecemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
			</select>
			
			Surface:
			<select name="surfacemin" class="textbox" style="width:auto;">
				<option value=""'; if(@$_REQUEST['surfacemin']=='') $var.=' selected'; $var.='>min</option>
				<option value="20"'; if(@$_REQUEST['surfacemin']=='20') $var.=' selected'; $var.='>20</option>
				<option value="30"'; if(@$_REQUEST['surfacemin']=='30') $var.=' selected'; $var.='>30</option>
				<option value="40"'; if(@$_REQUEST['surfacemin']=='40') $var.=' selected'; $var.='>40</option>
				<option value="50"'; if(@$_REQUEST['surfacemin']=='50') $var.=' selected'; $var.='>50</option>
				<option value="60"'; if(@$_REQUEST['surfacemin']=='60') $var.=' selected'; $var.='>60</option>
				<option value="70"'; if(@$_REQUEST['surfacemin']=='70') $var.=' selected'; $var.='>70</option>
				<option value="80"'; if(@$_REQUEST['surfacemin']=='80') $var.=' selected'; $var.='>80</option>
				<option value="90"'; if(@$_REQUEST['surfacemin']=='90') $var.=' selected'; $var.='>90</option>
				<option value="100"'; if(@$_REQUEST['surfacemin']=='100') $var.=' selected'; $var.='>100</option>
				<option value="120"'; if(@$_REQUEST['surfacemin']=='120') $var.=' selected'; $var.='>120</option>
				<option value="140"'; if(@$_REQUEST['surfacemin']=='140') $var.=' selected'; $var.='>140</option>
				<option value="160"'; if(@$_REQUEST['surfacemin']=='160') $var.=' selected'; $var.='>160</option>
				<option value="180"'; if(@$_REQUEST['surfacemin']=='180') $var.=' selected'; $var.='>180</option>
				<option value="200"'; if(@$_REQUEST['surfacemin']=='200') $var.=' selected'; $var.='>200</option>
				<option value="220"'; if(@$_REQUEST['surfacemin']=='220') $var.=' selected'; $var.='>220</option>
				<option value="240"'; if(@$_REQUEST['surfacemin']=='240') $var.=' selected'; $var.='>240</option>
				<option value="260"'; if(@$_REQUEST['surfacemin']=='260') $var.=' selected'; $var.='>260</option>
				<option value="280"'; if(@$_REQUEST['surfacemin']=='280') $var.=' selected'; $var.='>280</option>
				<option value="300"'; if(@$_REQUEST['surfacemin']=='300') $var.=' selected'; $var.='>300</option>
			</select>
			
			<select name="surfacemax" class="textbox" style="width:auto;">
				<option value="" selected="">max</option>
				<option value="20"'; if(@$_REQUEST['surfacemax']=='20') $var.=' selected'; $var.='>20</option>
				<option value="30"'; if(@$_REQUEST['surfacemax']=='30') $var.=' selected'; $var.='>30</option>
				<option value="40"'; if(@$_REQUEST['surfacemax']=='40') $var.=' selected'; $var.='>40</option>
				<option value="50"'; if(@$_REQUEST['surfacemax']=='50') $var.=' selected'; $var.='>50</option>
				<option value="60"'; if(@$_REQUEST['surfacemax']=='60') $var.=' selected'; $var.='>60</option>
				<option value="70"'; if(@$_REQUEST['surfacemax']=='70') $var.=' selected'; $var.='>70</option>
				<option value="80"'; if(@$_REQUEST['surfacemax']=='80') $var.=' selected'; $var.='>80</option>
				<option value="90"'; if(@$_REQUEST['surfacemax']=='90') $var.=' selected'; $var.='>90</option>
				<option value="100"'; if(@$_REQUEST['surfacemax']=='100') $var.=' selected'; $var.='>100</option>
				<option value="120"'; if(@$_REQUEST['surfacemax']=='120') $var.=' selected'; $var.='>120</option>
				<option value="140"'; if(@$_REQUEST['surfacemax']=='140') $var.=' selected'; $var.='>140</option>
				<option value="160"'; if(@$_REQUEST['surfacemax']=='160') $var.=' selected'; $var.='>160</option>
				<option value="180"'; if(@$_REQUEST['surfacemax']=='180') $var.=' selected'; $var.='>180</option>
				<option value="200"'; if(@$_REQUEST['surfacemax']=='200') $var.=' selected'; $var.='>200</option>
				<option value="220"'; if(@$_REQUEST['surfacemax']=='220') $var.=' selected'; $var.='>220</option>
				<option value="240"'; if(@$_REQUEST['surfacemax']=='240') $var.=' selected'; $var.='>240</option>
				<option value="260"'; if(@$_REQUEST['surfacemax']=='260') $var.=' selected'; $var.='>260</option>
				<option value="280"'; if(@$_REQUEST['surfacemax']=='280') $var.=' selected'; $var.='>280</option>
				<option value="300"'; if(@$_REQUEST['surfacemax']=='300') $var.=' selected'; $var.='>300</option>
				<option value="9999999"'; if(@$_REQUEST['surfacemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
			</select>';
		
		break;
		
		case 923:
			$var.='Surface:
		<select name="surfacemin" class="textbox" style="width:auto;">
            <option value=""'; if(@$_REQUEST['surfacemin']=='') $var.=' selected'; $var.='>min</option>
            <option value="20"'; if(@$_REQUEST['surfacemin']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemin']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemin']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemin']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemin']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemin']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemin']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemin']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemin']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemin']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemin']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemin']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemin']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemin']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemin']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemin']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemin']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemin']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemin']=='300') $var.=' selected'; $var.='>300</option>
        </select>
        
		<select name="surfacemax" class="textbox" style="width:auto;">
            <option value="" selected="">max</option>
            <option value="20"'; if(@$_REQUEST['surfacemax']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemax']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemax']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemax']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemax']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemax']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemax']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemax']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemax']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemax']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemax']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemax']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemax']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemax']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemax']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemax']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemax']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemax']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemax']=='300') $var.=' selected'; $var.='>300</option>
            <option value="9999999"'; if(@$_REQUEST['surfacemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>';
		
		$typebien118=(@$_REQUEST['typebien']==118) ? 
		 			'<option value="118" selected="selected">Maison</option>':
					'<option value="118">Maison</option>';
		$typebien119=(@$_REQUEST['typebien']==119) ? 
		 			'<option value="119" selected="selected">Appartement</option>':
					'<option value="119">Appartement</option>';
		$typebien120=(@$_REQUEST['typebien']==120) ? 
		 			'<option value="120" selected="selected">Parking</option>':
					'<option value="120">Parking</option>';
		$typebien121=(@$_REQUEST['typebien']==121) ? 
		 			'<option value="121" selected="selected">Immeuble</option>':
					'<option value="121">Immeuble</option>';
		$typebien122=(@$_REQUEST['typebien']==122) ? 
		 			'<option value="122" selected="selected">Terrain</option>':
					'<option value="122">Terrain</option>'; 
		$var.='			
		Type de bien:
			<select name="typebien" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$typebien118.
				$typebien119.
				$typebien120.
				$typebien121.
				$typebien122.'
			</select>';	
        break;
			
		case 915:
			$var.='
			Surface:
			<select name="surfacemin" class="textbox" style="width:auto;">
				<option value=""'; if(@$_REQUEST['surfacemin']=='') $var.=' selected'; $var.='>min</option>
				<option value="20"'; if(@$_REQUEST['surfacemin']=='20') $var.=' selected'; $var.='>20</option>
				<option value="30"'; if(@$_REQUEST['surfacemin']=='30') $var.=' selected'; $var.='>30</option>
				<option value="40"'; if(@$_REQUEST['surfacemin']=='40') $var.=' selected'; $var.='>40</option>
				<option value="50"'; if(@$_REQUEST['surfacemin']=='50') $var.=' selected'; $var.='>50</option>
				<option value="60"'; if(@$_REQUEST['surfacemin']=='60') $var.=' selected'; $var.='>60</option>
				<option value="70"'; if(@$_REQUEST['surfacemin']=='70') $var.=' selected'; $var.='>70</option>
				<option value="80"'; if(@$_REQUEST['surfacemin']=='80') $var.=' selected'; $var.='>80</option>
				<option value="90"'; if(@$_REQUEST['surfacemin']=='90') $var.=' selected'; $var.='>90</option>
				<option value="100"'; if(@$_REQUEST['surfacemin']=='100') $var.=' selected'; $var.='>100</option>
				<option value="120"'; if(@$_REQUEST['surfacemin']=='120') $var.=' selected'; $var.='>120</option>
				<option value="140"'; if(@$_REQUEST['surfacemin']=='140') $var.=' selected'; $var.='>140</option>
				<option value="160"'; if(@$_REQUEST['surfacemin']=='160') $var.=' selected'; $var.='>160</option>
				<option value="180"'; if(@$_REQUEST['surfacemin']=='180') $var.=' selected'; $var.='>180</option>
				<option value="200"'; if(@$_REQUEST['surfacemin']=='200') $var.=' selected'; $var.='>200</option>
				<option value="220"'; if(@$_REQUEST['surfacemin']=='220') $var.=' selected'; $var.='>220</option>
				<option value="240"'; if(@$_REQUEST['surfacemin']=='240') $var.=' selected'; $var.='>240</option>
				<option value="260"'; if(@$_REQUEST['surfacemin']=='260') $var.=' selected'; $var.='>260</option>
				<option value="280"'; if(@$_REQUEST['surfacemin']=='280') $var.=' selected'; $var.='>280</option>
				<option value="300"'; if(@$_REQUEST['surfacemin']=='300') $var.=' selected'; $var.='>300</option>
			</select>
			
			<select name="surfacemax"  class="textbox" style="width:auto;">
				<option value="" selected="">max</option>
				<option value="20"'; if(@$_REQUEST['surfacemax']=='20') $var.=' selected'; $var.='>20</option>
				<option value="30"'; if(@$_REQUEST['surfacemax']=='30') $var.=' selected'; $var.='>30</option>
				<option value="40"'; if(@$_REQUEST['surfacemax']=='40') $var.=' selected'; $var.='>40</option>
				<option value="50"'; if(@$_REQUEST['surfacemax']=='50') $var.=' selected'; $var.='>50</option>
				<option value="60"'; if(@$_REQUEST['surfacemax']=='60') $var.=' selected'; $var.='>60</option>
				<option value="70"'; if(@$_REQUEST['surfacemax']=='70') $var.=' selected'; $var.='>70</option>
				<option value="80"'; if(@$_REQUEST['surfacemax']=='80') $var.=' selected'; $var.='>80</option>
				<option value="90"'; if(@$_REQUEST['surfacemax']=='90') $var.=' selected'; $var.='>90</option>
				<option value="100"'; if(@$_REQUEST['surfacemax']=='100') $var.=' selected'; $var.='>100</option>
				<option value="120"'; if(@$_REQUEST['surfacemax']=='120') $var.=' selected'; $var.='>120</option>
				<option value="140"'; if(@$_REQUEST['surfacemax']=='140') $var.=' selected'; $var.='>140</option>
				<option value="160"'; if(@$_REQUEST['surfacemax']=='160') $var.=' selected'; $var.='>160</option>
				<option value="180"'; if(@$_REQUEST['surfacemax']=='180') $var.=' selected'; $var.='>180</option>
				<option value="200"'; if(@$_REQUEST['surfacemax']=='200') $var.=' selected'; $var.='>200</option>
				<option value="220"'; if(@$_REQUEST['surfacemax']=='220') $var.=' selected'; $var.='>220</option>
				<option value="240"'; if(@$_REQUEST['surfacemax']=='240') $var.=' selected'; $var.='>240</option>
				<option value="260"'; if(@$_REQUEST['surfacemax']=='260') $var.=' selected'; $var.='>260</option>
				<option value="280"'; if(@$_REQUEST['surfacemax']=='280') $var.=' selected'; $var.='>280</option>
				<option value="300"'; if(@$_REQUEST['surfacemax']=='300') $var.=' selected'; $var.='>300</option>
				<option value="9999999"'; if(@$_REQUEST['surfacemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
			</select>';
			
			$constructible143=(@$_REQUEST['constructible']==143) ? 
						'<option value="143" selected="selected">Constructible</option>':
						'<option value="143">Constructible</option>';
			$constructible144=(@$_REQUEST['constructible']==144) ? 
						'<option value="144" selected="selected">Non Constructible</option>':
						'<option value="144">Non Constructible</option>'; 
			$var.=' 
			Constructible:
				<select name="constructible" class="textbox" style="width:auto;">
					<option value="">Choisir une option</option>'.
					$constructible143.
					$constructible144.'
				</select>
				';
		break;
			
			
		case 920:
		
			$var.=' Nbre Pièce:
        <select name="piecemin" class="textbox" style="width:auto;">
            <option value=""'; if(@$_REQUEST['piecemin']=='') $var.=' selected'; $var.='>min</option>
            <option value="1"'; if(@$_REQUEST['piecemin']=='1') $var.=' selected'; $var.='>Studio</option>
            <option value="2"'; if(@$_REQUEST['piecemin']=='2') $var.=' selected'; $var.='>2</option>
            <option value="3"'; if(@$_REQUEST['piecemin']=='3') $var.=' selected'; $var.='>3</option>
            <option value="4"'; if(@$_REQUEST['piecemin']=='4') $var.=' selected'; $var.='>4</option>
            <option value="5"'; if(@$_REQUEST['piecemin']=='5') $var.=' selected'; $var.='>5</option>
        </select>
        
        <select name="piecemax" class="textbox" style="width:auto;">
        	<option value="">max</option>
            <option value="1"'; if(@$_REQUEST['piecemax']=='1') $var.=' selected'; $var.='>Studio</option>
            <option value="2"'; if(@$_REQUEST['piecemax']=='2') $var.=' selected'; $var.='>2</option>
            <option value="3"'; if(@$_REQUEST['piecemax']=='3') $var.=' selected'; $var.='>3</option>
            <option value="4"'; if(@$_REQUEST['piecemax']=='4') $var.=' selected'; $var.='>4</option>
            <option value="5"'; if(@$_REQUEST['piecemax']=='5') $var.=' selected'; $var.='>5</option>
            <option value="9999999"'; if(@$_REQUEST['piecemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>
        
        Surface:
		<select name="surfacemin" class="textbox" style="width:auto;">
            <option value=""'; if(@$_REQUEST['surfacemin']=='') $var.=' selected'; $var.='>min</option>
            <option value="20"'; if(@$_REQUEST['surfacemin']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemin']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemin']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemin']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemin']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemin']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemin']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemin']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemin']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemin']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemin']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemin']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemin']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemin']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemin']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemin']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemin']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemin']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemin']=='300') $var.=' selected'; $var.='>300</option>
        </select>
        
		<select name="surfacemax" class="textbox" style="width:auto;">
            <option value="" selected="">max</option>
            <option value="20"'; if(@$_REQUEST['surfacemax']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemax']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemax']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemax']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemax']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemax']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemax']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemax']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemax']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemax']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemax']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemax']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemax']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemax']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemax']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemax']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemax']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemax']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemax']=='300') $var.=' selected'; $var.='>300</option>
            <option value="9999999"'; if(@$_REQUEST['surfacemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>';
        
		$typebien245=(@$_REQUEST['typebien']==245) ? 
		 			'<option value="245" selected="selected">Maison</option>':
					'<option value="245">Maison</option>';
		$typebien246=(@$_REQUEST['typebien']==246) ? 
		 			'<option value="246" selected="selected">Appartement</option>':
					'<option value="246">Appartement</option>';
		$typebien247=(@$_REQUEST['typebien']==247) ? 
		 			'<option value="247" selected="selected">Parking</option>':
					'<option value="247">Parking</option>';
		$typebien248=(@$_REQUEST['typebien']==248) ? 
		 			'<option value="248" selected="selected">Immeuble</option>':
					'<option value="248">Immeuble</option>'; 
		$var.=' 
		Type de bien:
			<select name="typebien" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$typebien245.
				$typebien246.
				$typebien247.
				$typebien248.'
			</select>
			';
		break;
			
		case 921:
			$var.=' 
        Nbre de chambre:
        <select name="piecemin"  class="textbox" style="width:auto;">
            <option value=""'; if(@$_REQUEST['piecemin']=='') $var.=' selected'; $var.='>min</option>
            <option value="1"'; if(@$_REQUEST['piecemin']=='1') $var.=' selected'; $var.='>Studio</option>
            <option value="2"'; if(@$_REQUEST['piecemin']=='2') $var.=' selected'; $var.='>2</option>
            <option value="3"'; if(@$_REQUEST['piecemin']=='3') $var.=' selected'; $var.='>3</option>
            <option value="4"'; if(@$_REQUEST['piecemin']=='4') $var.=' selected'; $var.='>4</option>
            <option value="5"'; if(@$_REQUEST['piecemin']=='5') $var.=' selected'; $var.='>5</option>
        </select>
        
        <select name="piecemax" class="textbox" style="width:auto;">
        	<option value="">max</option>
            <option value="1"'; if(@$_REQUEST['piecemax']=='1') $var.=' selected'; $var.='>Studio</option>
            <option value="2"'; if(@$_REQUEST['piecemax']=='2') $var.=' selected'; $var.='>2</option>
            <option value="3"'; if(@$_REQUEST['piecemax']=='3') $var.=' selected'; $var.='>3</option>
            <option value="4"'; if(@$_REQUEST['piecemax']=='4') $var.=' selected'; $var.='>4</option>
            <option value="5"'; if(@$_REQUEST['piecemax']=='5') $var.=' selected'; $var.='>5</option>
            <option value="9999999"'; if(@$_REQUEST['piecemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>';
		break;
			
		case 777:
			$var.=' 
        Nbre Pièce:
        <select name="piecemin" class="textbox" style="width:auto;">
            <option value=""'; if(@$_REQUEST['piecemin']=='') $var.=' selected'; $var.='>min</option>
            <option value="1"'; if(@$_REQUEST['piecemin']=='1') $var.=' selected'; $var.='>Studio</option>
            <option value="2"'; if(@$_REQUEST['piecemin']=='2') $var.=' selected'; $var.='>2</option>
            <option value="3"'; if(@$_REQUEST['piecemin']=='3') $var.=' selected'; $var.='>3</option>
            <option value="4"'; if(@$_REQUEST['piecemin']=='4') $var.=' selected'; $var.='>4</option>
            <option value="5"'; if(@$_REQUEST['piecemin']=='5') $var.=' selected'; $var.='>5</option>
        </select>
        
        <select name="piecemax" class="textbox" style="width:auto;">
        	<option value="">max</option>
            <option value="1"'; if(@$_REQUEST['piecemax']=='1') $var.=' selected'; $var.='>Studio</option>
            <option value="2"'; if(@$_REQUEST['piecemax']=='2') $var.=' selected'; $var.='>2</option>
            <option value="3"'; if(@$_REQUEST['piecemax']=='3') $var.=' selected'; $var.='>3</option>
            <option value="4"'; if(@$_REQUEST['piecemax']=='4') $var.=' selected'; $var.='>4</option>
            <option value="5"'; if(@$_REQUEST['piecemax']=='5') $var.=' selected'; $var.='>5</option>
            <option value="9999999"'; if(@$_REQUEST['piecemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>
        
        Surface:
		<select name="surfacemin" class="textbox" style="width:auto;">
            <option value=""'; if(@$_REQUEST['surfacemin']=='') $var.=' selected'; $var.='>min</option>
            <option value="20"'; if(@$_REQUEST['surfacemin']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemin']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemin']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemin']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemin']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemin']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemin']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemin']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemin']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemin']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemin']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemin']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemin']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemin']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemin']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemin']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemin']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemin']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemin']=='300') $var.=' selected'; $var.='>300</option>
        </select>
        
		<select name="surfacemax" class="textbox" style="width:auto;">
            <option value="" selected="">max</option>
            <option value="20"'; if(@$_REQUEST['surfacemax']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemax']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemax']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemax']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemax']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemax']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemax']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemax']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemax']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemax']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemax']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemax']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemax']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemax']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemax']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemax']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemax']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemax']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemax']=='300') $var.=' selected'; $var.='>300</option>
            <option value="9999999"'; if(@$_REQUEST['surfacemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>
        <br />';
		
		$Situation629=(@$_REQUEST['Situation']==629) ? 
		 			'<option value="629" selected="selected">Ville</option>':
					'<option value="629">Ville</option>';
		$Situation630=(@$_REQUEST['Situation']==630) ? 
		 			'<option value="630" selected="selected">Campagne</option>':
					'<option value="630">Campagne</option>';
		$tSituation631=(@$_REQUEST['Situation']==631) ? 
		 			'<option value="631" selected="selected">Montagne</option>':
					'<option value="631">Montagne</option>';
		$Situation632=(@$_REQUEST['Situation']==632) ? 
		 			'<option value="632" selected="selected">Bord de mer</option>':
					'<option value="632">Bord de mer</option>';
					
		$Type633=(@$_REQUEST['Type']==633) ? 
		 			'<option value="633" selected="selected">Maison</option>':
					'<option value="633">Maison</option>';
		$Type634=(@$_REQUEST['Type']==634) ? 
		 			'<option value="634" selected="selected">Appartement</option>':
					'<option value="634">Appartement</option>';
		$Type635=(@$_REQUEST['Type']==635) ? 
		 			'<option value="635" selected="selected">Hôtel</option>':
					'<option value="635">Hôtel</option>';
		$Type636=(@$_REQUEST['Type']==636) ? 
		 			'<option value="636" selected="selected">Gite</option>':
					'<option value="636">Gite</option>';
		$Type637=(@$_REQUEST['Type']==637) ? 
		 			'<option value="637" selected="selected">Chambre d\'hôte</option>':
					'<option value="637">Chambre d\'hôte</option>';
		$Type638=(@$_REQUEST['Type']==638) ? 
		 			'<option value="638" selected="selected">Chalet</option>':
					'<option value="638">Chalet</option>';
		$Type639=(@$_REQUEST['Type']==639) ? 
		 			'<option value="639" selected="selected">Camping/Mobile home</option>':
					'<option value="639">Camping/Mobile home</option>';
		$Type640=(@$_REQUEST['Type']==640) ? 
		 			'<option value="640" selected="selected">Insolite</option>':
					'<option value="640">Insolite</option>'; 
		$var.=' 
		Situation:
			<select name="Situation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$Situation629.
				$Situation630.
				$Situation631.
				$Situation632.'
			</select>
		Type:
			<select name="Type" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$Type633.
				$Type634.
				$Type635.
				$Type636.
				$Type637.
				$Type638.
				$Type639.
				$Type640.'
			</select>
			';
		break;
			
		case 784:
			$var.=' Surface:
		<select name="surfacemin" class="textbox" style="width:auto;">
            <option value="">min</option>
            <option value="20"'; if(@$_REQUEST['surfacemin']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemin']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemin']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemin']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemin']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemin']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemin']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemin']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemin']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemin']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemin']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemin']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemin']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemin']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemin']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemin']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemin']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemin']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemin']=='300') $var.=' selected'; $var.='>300</option>
        </select>
        
		<select name="surfacemax" class="textbox" style="width:auto;">
            <option value="" selected="">max</option>
            <option value="20"'; if(@$_REQUEST['surfacemax']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemax']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemax']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemax']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemax']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemax']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemax']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemax']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemax']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemax']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemax']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemax']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemax']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemax']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemax']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemax']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemax']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemax']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemax']=='300') $var.=' selected'; $var.='>300</option>
            <option value="9999999"'; if(@$_REQUEST['surfacemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>';
		
		$ventelocation405=(@$_REQUEST['ventelocation']==405) ? 
		 			'<option value="405" selected="selected">A vendre</option>':
					'<option value="405">A vendre</option>';
		$ventelocation406=(@$_REQUEST['ventelocation']==406) ? 
		 			'<option value="406" selected="selected">A louer</option>':
					'<option value="406">A louer</option>'; $var.=' 
		Vente/Location:
			<select name="ventelocation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$ventelocation405.
				$ventelocation406.'
			</select>
			';
        break;
			
		case 785:
			$var.='
		Surface:
		<select name="surfacemin" class="textbox" style="width:auto;">
            <option value="">min</option>
            <option value="20"'; if(@$_REQUEST['surfacemin']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemin']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemin']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemin']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemin']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemin']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemin']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemin']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemin']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemin']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemin']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemin']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemin']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemin']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemin']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemin']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemin']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemin']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemin']=='300') $var.=' selected'; $var.='>300</option>
        </select>
        
		<select name="surfacemax" class="textbox" style="width:auto;">
            <option value="" selected="">max</option>
            <option value="20"'; if(@$_REQUEST['surfacemax']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemax']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemax']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemax']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemax']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemax']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemax']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemax']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemax']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemax']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemax']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemax']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemax']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemax']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemax']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemax']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemax']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemax']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemax']=='300') $var.=' selected'; $var.='>300</option>
            <option value="9999999"'; if(@$_REQUEST['surfacemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>';
        break;
			
		case 787:
			$var.=' 
		Nbre Pièce:
        <select name="piecemin" class="textbox" style="width:auto;">
            <option value="">min</option>
            <option value="1"'; if(@$_REQUEST['piecemin']=='1') $var.=' selected'; $var.='>Studio</option>
            <option value="2"'; if(@$_REQUEST['piecemin']=='2') $var.=' selected'; $var.='>2</option>
            <option value="3"'; if(@$_REQUEST['piecemin']=='3') $var.=' selected'; $var.='>3</option>
            <option value="4"'; if(@$_REQUEST['piecemin']=='4') $var.=' selected'; $var.='>4</option>
            <option value="5"'; if(@$_REQUEST['piecemin']=='5') $var.=' selected'; $var.='>5</option>
        </select>
        
        <select name="piecemax" class="textbox" style="width:auto;">
        	<option value="">max</option>
            <option value="1"'; if(@$_REQUEST['piecemax']=='1') $var.=' selected'; $var.='>Studio</option>
            <option value="2"'; if(@$_REQUEST['piecemax']=='2') $var.=' selected'; $var.='>2</option>
            <option value="3"'; if(@$_REQUEST['piecemax']=='3') $var.=' selected'; $var.='>3</option>
            <option value="4"'; if(@$_REQUEST['piecemax']=='4') $var.=' selected'; $var.='>4</option>
            <option value="5"'; if(@$_REQUEST['piecemax']=='5') $var.=' selected'; $var.='>5</option>
            <option value="9999999"'; if(@$_REQUEST['piecemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>
        
        Surface:
		<select name="surfacemin" class="textbox" style="width:auto;">
            <option value=""'; if(@$_REQUEST['surfacemin']=='') $var.=' selected'; $var.='>min</option>
            <option value="20"'; if(@$_REQUEST['surfacemin']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemin']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemin']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemin']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemin']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemin']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemin']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemin']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemin']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemin']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemin']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemin']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemin']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemin']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemin']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemin']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemin']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemin']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemin']=='300') $var.=' selected'; $var.='>300</option>
        </select>
        
		<select name="surfacemax" class="textbox" style="width:auto;">
            <option value="" selected="">max</option>
            <option value="20"'; if(@$_REQUEST['surfacemax']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemax']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemax']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemax']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemax']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemax']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemax']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemax']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemax']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemax']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemax']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemax']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemax']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemax']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemax']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemax']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemax']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemax']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemax']=='300') $var.=' selected'; $var.='>300</option>
            <option value="9999999"'; if(@$_REQUEST['surfacemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>
        <br />';
		
		$typebien245=(@$_REQUEST['typebien']==245) ? 
		 			'<option value="245" selected="selected">Maison</option>':
					'<option value="245">Maison</option>';
		$typebien246=(@$_REQUEST['typebien']==246) ? 
		 			'<option value="246" selected="selected">Appartement</option>':
					'<option value="246">Appartement</option>';
		$typebien247=(@$_REQUEST['typebien']==247) ? 
		 			'<option value="247" selected="selected">Parking</option>':
					'<option value="247">Parking</option>';
		$typebien248=(@$_REQUEST['typebien']==248) ? 
		 			'<option value="248" selected="selected">Immeuble</option>':
					'<option value="248">Immeuble</option>'; $var.=' 
        Pays:
            <input type="text" name="Pays" value="'.@$_REQUEST['Pays'].'" style="width:75px;" />
        Ville:
            <input type="text" name="Ville" value="'.@$_REQUEST['Ville'].'" style="width:75px;" />
		Type de bien:
			<select name="typebien" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$typebien245.
				$typebien246.
				$typebien247.
				$typebien248.'
			</select>';
        break;
			
		case 788:
			$var.=' Nbre Pièce:
        <select name="piecemin" class="textbox" style="width:auto;">
            <option value="">min</option>
            <option value="1"'; if(@$_REQUEST['piecemin']=='1') $var.=' selected'; $var.='>Studio</option>
            <option value="2"'; if(@$_REQUEST['piecemin']=='2') $var.=' selected'; $var.='>2</option>
            <option value="3"'; if(@$_REQUEST['piecemin']=='3') $var.=' selected'; $var.='>3</option>
            <option value="4"'; if(@$_REQUEST['piecemin']=='4') $var.=' selected'; $var.='>4</option>
            <option value="5"'; if(@$_REQUEST['piecemin']=='5') $var.=' selected'; $var.='>5</option>
        </select>
        
        <select name="piecemax" class="textbox" style="width:auto;">
        	<option value="">max</option>
            <option value="1"'; if(@$_REQUEST['piecemax']=='1') $var.=' selected'; $var.='>Studio</option>
            <option value="2"'; if(@$_REQUEST['piecemax']=='2') $var.=' selected'; $var.='>2</option>
            <option value="3"'; if(@$_REQUEST['piecemax']=='3') $var.=' selected'; $var.='>3</option>
            <option value="4"'; if(@$_REQUEST['piecemax']=='4') $var.=' selected'; $var.='>4</option>
            <option value="5"'; if(@$_REQUEST['piecemax']=='5') $var.=' selected'; $var.='>5</option>
            <option value="9999999"'; if(@$_REQUEST['piecemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>
        
        Surface:
		<select name="surfacemin" class="textbox" style="width:auto;">
            <option value="">min</option>
            <option value="20"'; if(@$_REQUEST['surfacemin']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemin']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemin']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemin']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemin']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemin']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemin']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemin']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemin']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemin']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemin']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemin']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemin']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemin']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemin']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemin']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemin']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemin']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemin']=='300') $var.=' selected'; $var.='>300</option>
        </select>
        
		<select name="surfacemax" class="textbox" style="width:auto;">
            <option value="" selected="">max</option>
            <option value="20"'; if(@$_REQUEST['surfacemax']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemax']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemax']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemax']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemax']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemax']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemax']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemax']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemax']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemax']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemax']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemax']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemax']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemax']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemax']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemax']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemax']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemax']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemax']=='300') $var.=' selected'; $var.='>300</option>
            <option value="9999999"'; if(@$_REQUEST['surfacemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>
        <br />';
		
		$Situation371=(@$_REQUEST['Situation']==371) ? 
		 			'<option value="371" selected="selected">Ville</option>':
					'<option value="371">Ville</option>';
		$Situation372=(@$_REQUEST['Situation']==372) ? 
		 			'<option value="372" selected="selected">Campagne</option>':
					'<option value="372">Campagne</option>';
		$tSituation373=(@$_REQUEST['Situation']==373) ? 
		 			'<option value="373" selected="selected">Montagne</option>':
					'<option value="373">Montagne</option>';
		$Situation374=(@$_REQUEST['Situation']==374) ? 
		 			'<option value="374" selected="selected">Bord de mer</option>':
					'<option value="374">Bord de mer</option>';
					
		$Type377=(@$_REQUEST['Type']==377) ? 
		 			'<option value="377" selected="selected">Maison</option>':
					'<option value="377">Maison</option>';
		$Type378=(@$_REQUEST['Type']==378) ? 
		 			'<option value="378" selected="selected">Appartement</option>':
					'<option value="378">Appartement</option>';
		$Type376=(@$_REQUEST['Type']==376) ? 
		 			'<option value="376" selected="selected">Hôtel</option>':
					'<option value="376">Hôtel</option>';
		$Type382=(@$_REQUEST['Type']==382) ? 
		 			'<option value="382" selected="selected">Gite</option>':
					'<option value="382">Gite</option>';
		$Type375=(@$_REQUEST['Type']==375) ? 
		 			'<option value="375" selected="selected">Chambre d\'hôte</option>':
					'<option value="375">Chambre d\'hôte</option>';
		$Type381=(@$_REQUEST['Type']==381) ? 
		 			'<option value="638" selected="selected">Chalet</option>':
					'<option value="381">Chalet</option>';
		$Type380=(@$_REQUEST['Type']==380) ? 
		 			'<option value="380" selected="selected">Camping/Mobile home</option>':
					'<option value="380">Camping/Mobile home</option>';
		$Type379=(@$_REQUEST['Type']==379) ? 
		 			'<option value="379" selected="selected">Insolite</option>':
					'<option value="379">Insolite</option>'; 
		$var.=' 
        Pays:
            <input type="text" name="Pays" value="'.@$_REQUEST['Pays'].'" style="width:75px;" />
        Ville:
            <input type="text" name="Ville" value="'.@$_REQUEST['Ville'].'" style="width:75px;" />
		Situation:
			<select name="Situation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$Situation371.
				$Situation372.
				$tSituation373.
				$Situation374.'
			</select>
		Type:
			<select name="Type" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$Type377.
				$Type378.
				$Type378.
				$Type376.
				$Type375.
				$Type381.
				$Type380.
				$Type379.'
			</select>
			';
        break;
			
		case 789:
			$var.=' 
		Surface:
		<select name="surfacemin" class="textbox" style="width:auto;">
            <option value=""'; if(@$_REQUEST['surfacemin']=='') $var.=' selected'; $var.='>min</option>
            <option value="20"'; if(@$_REQUEST['surfacemin']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemin']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemin']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemin']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemin']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemin']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemin']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemin']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemin']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemin']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemin']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemin']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemin']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemin']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemin']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemin']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemin']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemin']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemin']=='300') $var.=' selected'; $var.='>300</option>
        </select>
        
		<select name="surfacemax" class="textbox" style="width:auto;">
            <option value="" selected="">max</option>
            <option value="20"'; if(@$_REQUEST['surfacemax']=='20') $var.=' selected'; $var.='>20</option>
            <option value="30"'; if(@$_REQUEST['surfacemax']=='30') $var.=' selected'; $var.='>30</option>
            <option value="40"'; if(@$_REQUEST['surfacemax']=='40') $var.=' selected'; $var.='>40</option>
            <option value="50"'; if(@$_REQUEST['surfacemax']=='50') $var.=' selected'; $var.='>50</option>
            <option value="60"'; if(@$_REQUEST['surfacemax']=='60') $var.=' selected'; $var.='>60</option>
            <option value="70"'; if(@$_REQUEST['surfacemax']=='70') $var.=' selected'; $var.='>70</option>
            <option value="80"'; if(@$_REQUEST['surfacemax']=='80') $var.=' selected'; $var.='>80</option>
            <option value="90"'; if(@$_REQUEST['surfacemax']=='90') $var.=' selected'; $var.='>90</option>
            <option value="100"'; if(@$_REQUEST['surfacemax']=='100') $var.=' selected'; $var.='>100</option>
            <option value="120"'; if(@$_REQUEST['surfacemax']=='120') $var.=' selected'; $var.='>120</option>
            <option value="140"'; if(@$_REQUEST['surfacemax']=='140') $var.=' selected'; $var.='>140</option>
            <option value="160"'; if(@$_REQUEST['surfacemax']=='160') $var.=' selected'; $var.='>160</option>
            <option value="180"'; if(@$_REQUEST['surfacemax']=='180') $var.=' selected'; $var.='>180</option>
            <option value="200"'; if(@$_REQUEST['surfacemax']=='200') $var.=' selected'; $var.='>200</option>
            <option value="220"'; if(@$_REQUEST['surfacemax']=='220') $var.=' selected'; $var.='>220</option>
            <option value="240"'; if(@$_REQUEST['surfacemax']=='240') $var.=' selected'; $var.='>240</option>
            <option value="260"'; if(@$_REQUEST['surfacemax']=='260') $var.=' selected'; $var.='>260</option>
            <option value="280"'; if(@$_REQUEST['surfacemax']=='280') $var.=' selected'; $var.='>280</option>
            <option value="300"'; if(@$_REQUEST['surfacemax']=='300') $var.=' selected'; $var.='>300</option>
            <option value="9999999"'; if(@$_REQUEST['surfacemax']=='9999999') $var.=' selected'; $var.='>illimité</option>
        </select>';
		
		$constructible403=(@$_REQUEST['constructible']==403) ? 
		 			'<option value="403" selected="selected">Constructible</option>':
					'<option value="403">Constructible</option>';
		$constructible404=(@$_REQUEST['constructible']==404) ? 
		 			'<option value="404" selected="selected">Non Constructible</option>':
					'<option value="404">Non Constructible</option>'; 
		$var.=' 
		Constructible:
			<select name="constructible" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$constructible403.
				$constructible404.'
			</select>
		<br />
        Pays:
            <input type="text" name="Pays" value="'.@$_REQUEST['Pays'].'" style="width:75px;" />
        Ville:
            <input type="text" name="Ville" value="'.@$_REQUEST['Ville'].'" style="width:75px;" />
		';
		break;
		
		case 926:		
			$ventelocation549=(@$_REQUEST['ventelocation']==549) ? 
		 			'<option value="549" selected="selected">A vendre</option>':
					'<option value="549">A vendre</option>';
		$ventelocation550=(@$_REQUEST['ventelocation']==550) ? 
		 			'<option value="550" selected="selected">A louer</option>':
					'<option value="550">A louer</option>'; 
		$var.=' 
		Vente/Location:
			<select name="ventelocation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$ventelocation549.
				$ventelocation550.'
			</select>
			</select>
		';
		break;
			
		case 927:
			$ventelocation577=(@$_REQUEST['ventelocation']==577) ? 
		 			'<option value="577" selected="selected">A vendre</option>':
					'<option value="577">A vendre</option>';
		$ventelocation578=(@$_REQUEST['ventelocation']==578) ? 
		 			'<option value="578" selected="selected">A louer</option>':
					'<option value="578">A louer</option>'; 
		
		$var.=' 
        Taille:
            <input type="text" name="taillemin" value="'.@$_REQUEST['taillemin'].'" style="width:75px;" />
            <input type="text" name="taillemax" value="'.@$_REQUEST['taillemax'].'" style="width:75px;" />
		Vente/Location:
			<select name="ventelocation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$ventelocation577.
				$ventelocation578.'
			</select>
		';
		break;
		
        case 793:
			$contrat551=(@$_REQUEST['contrat']==551) ? 
		 			'<option value="551" selected="selected">CDI</option>':
					'<option value="551">CDI</option>';
		$contrat552=(@$_REQUEST['contrat']==552) ? 
		 			'<option value="552" selected="selected">CDD</option>':
					'<option value="552">CDD</option>';
		$contrat553=(@$_REQUEST['contrat']==553) ? 
		 			'<option value="553" selected="selected">Intérim</option>':
					'<option value="553">Intérim</option>';
		$contrat554=(@$_REQUEST['contrat']==554) ? 
		 			'<option value="554" selected="selected">Stage</option>':
					'<option value="554">Stage</option>';
		$contrat555=(@$_REQUEST['contrat']==555) ? 
		 			'<option value="555" selected="selected">Alternance</option>':
					'<option value="555">Alternance</option>';
		$contrat556=(@$_REQUEST['contrat']==556) ? 
		 			'<option value="556" selected="selected">Job étudiant</option>':
					'<option value="556">Job étudiant</option>';
		$contrat557=(@$_REQUEST['contrat']==557) ? 
		 			'<option value="557" selected="selected">Saisonnier</option>':
					'<option value="557">Saisonnier</option>';
		$contrat558=(@$_REQUEST['contrat']==558) ? 
		 			'<option value="558" selected="selected">Saisonnier</option>':
					'<option value="558">Saisonnier</option>';
					
		$formation559=(@$_REQUEST['formation']==559) ? 
		 			'<option value="559" selected="selected">BEP/CAP</option>':
					'<option value="559">BEP/CAP</option>';
		$formation560=(@$_REQUEST['formation']==560) ? 
		 			'<option value="560" selected="selected">Bac</option>':
					'<option value="560">Bac</option>';
		$formation561=(@$_REQUEST['formation']==561) ? 
		 			'<option value="561" selected="selected">Bac+2</option>':
					'<option value="561">Bac+2</option>';
		$formation562=(@$_REQUEST['formation']==562) ? 
		 			'<option value="562" selected="selected">Bac+3</option>':
					'<option value="562">Bac+3</option>';
		$formation563=(@$_REQUEST['formation']==563) ? 
		 			'<option value="563" selected="selected">Bac+4</option>':
					'<option value="563">Bac+4</option>';
		$formation564=(@$_REQUEST['formation']==564) ? 
		 			'<option value="564" selected="selected">Bac+5</option>':
					'<option value="564">Bac+5</option>';
		$formation565=(@$_REQUEST['formation']==565) ? 
		 			'<option value="565" selected="selected">Bac+6 et plus</option>':
					'<option value="565">Bac+6 et plus</option>';
					
		$experience566=(@$_REQUEST['experience']==566) ? 
		 			'<option value="566" selected="selected">Jeune diplômé</option>':
					'<option value="566">Jeune diplômé</option>';
		$experience567=(@$_REQUEST['experience']==567) ? 
		 			'<option value="567" selected="selected">1 à 2 ans</option>':
					'<option value="567">1 à 2 ans</option>';
		$experience568=(@$_REQUEST['experience']==568) ? 
		 			'<option value="568" selected="selected">3 à 5 ans</option>':
					'<option value="568">3 à 5 ans</option>';
		$experience569=(@$_REQUEST['experience']==569) ? 
		 			'<option value="569" selected="selected">6 à 10 ans</option>':
					'<option value="569">6 à 10 ans</option>';
		$experience570=(@$_REQUEST['experience']==570) ? 
		 			'<option value="570" selected="selected">Plus de 10 ans</option>':
					'<option value="570">Plus de 10 ans</option>';
					
		$Mobilite571=(@$_REQUEST['Mobilite']==571) ? 
		 			'<option value="571" selected="selected">Internationale</option>':
					'<option value="571">Internationale</option>';
		$Mobilite572=(@$_REQUEST['Mobilite']==572) ? 
		 			'<option value="572" selected="selected">Nationale</option>':
					'<option value="572">Nationale</option>';
		$Mobilite573=(@$_REQUEST['Mobilite']==573) ? 
		 			'<option value="573" selected="selected">Régionale</option>':
					'<option value="573">Régionale</option>';
		$Mobilite574=(@$_REQUEST['Mobilite']==574) ? 
		 			'<option value="574" selected="selected">Locale</option>':
					'<option value="574">Locale</option>';
					
		$emploi571=(@$_REQUEST['emploi']==575) ? 
		 			'<option value="575" selected="selected">Temps plein</option>':
					'<option value="575">Temps plein</option>';
		$emploi572=(@$_REQUEST['emploi']==576) ? 
		 			'<option value="576" selected="selected">Temps partiel</option>':
					'<option value="576">Temps partiel</option>'; 
		
		$var.=' 
			<br>
		Type de contrat:
			<select name="contrat" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$contrat551.
				$contrat552.
				$contrat553.
				$contrat554.
				$contrat555.
				$contrat556.
				$contrat557.
				$contrat558.'
			</select>
		Niveau de formation:
			<select name="formation" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$formation559.
				$formation560.
				$formation561.
				$formation562.
				$formation563.
				$formation564.
				$formation565.'
			</select>
		Niveau d\'expérience:
			<select name="experience" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$experience566.
				$experience567.
				$experience568.
				$experience569.
				$experience570.'
			</select>
			<br>
		Mobilité:
			<select name="Mobilite" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$Mobilite571.
				$Mobilite572.
				$Mobilite573.
				$Mobilite574.'
			</select>
		Type d\'emploi	:
			<select name="emploi" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$emploi571.
				$emploi572.'
			</select>
			';
        break;
            
        case 821:
        
		$typeemploi512=(@$_REQUEST['typeemploi']==512) ? 
		 			'<option value="512" selected="selected">Auxiliaire de vie</option>':
					'<option value="512">Auxiliaire de vie</option>';
		$typeemploi513=(@$_REQUEST['typeemploi']==513) ? 
		 			'<option value="513" selected="selected">Assistante de vie</option>':
					'<option value="513">Assistante de vie</option>';
		$typeemploi514=(@$_REQUEST['typeemploi']==514) ? 
		 			'<option value="514" selected="selected">Aide a domicile</option>':
					'<option value="514">Aide a domicile</option>';
		$typeemploi515=(@$_REQUEST['typeemploi']==515) ? 
		 			'<option value="515" selected="selected">Aide ménagère</option>':
					'<option value="515">Aide ménagère</option>';
		$typeemploi516=(@$_REQUEST['typeemploi']==516) ? 
		 			'<option value="516" selected="selected">Aide soignante</option>':
					'<option value="516">Aide soignante</option>';
		$typeemploi517=(@$_REQUEST['typeemploi']==517) ? 
		 			'<option value="517" selected="selected">Garde a domicile</option>':
					'<option value="517">Garde a domicile</option>';
		$typeemploi518=(@$_REQUEST['typeemploi']==518) ? 
		 			'<option value="518" selected="selected">Garde de nuit</option>':
					'<option value="518">Garde de nuit</option>';
		$typeemploi519=(@$_REQUEST['typeemploi']==519) ? 
		 			'<option value="519" selected="selected">Autre</option>':
					'<option value="519">Autre</option>';
					
		$autretache520=(@$_REQUEST['autretache']==520) ? 
		 			'<option value="520" selected="selected">Menage</option>':
					'<option value="520">Menage</option>';
		$autretache521=(@$_REQUEST['autretache']==521) ? 
		 			'<option value="521" selected="selected">Repassage</option>':
					'<option value="521">Repassage</option>';
		$autretache522=(@$_REQUEST['autretache']==522) ? 
		 			'<option value="522" selected="selected">Cuisine</option>':
					'<option value="522">Cuisine</option>';
		$autretache523=(@$_REQUEST['autretache']==523) ? 
		 			'<option value="523" selected="selected">Courses</option>':
					'<option value="523">Courses</option>';
		$autretache524=(@$_REQUEST['autretache']==524) ? 
		 			'<option value="524" selected="selected">Infirmier(e) diplome(e)</option>':
					'<option value="524">Infirmier(e) diplome(e)</option>';
		$autretache525=(@$_REQUEST['autretache']==525) ? 
		 			'<option value="525" selected="selected">Permis de conduire</option>':
					'<option value="525">Permis de conduire</option>'; $var.=' 
		Type d\'emploi:
			<select name="typeemploi" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$typeemploi512.
				$typeemploi513.
				$typeemploi514.
				$typeemploi515.
				$typeemploi516.
				$typeemploi517.
				$typeemploi518.
				$typeemploi519.'
			</select>
		Autres tâches:
			<select name="autretache" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$autretache520.
				$autretache521.
				$autretache522.
				$autretache523.
				$autretache524.
				$autretache525.'
			</select>
			';
            break;
			            
        case 875: 
		$var.=' 
			<br>
				<div>
						Langue (du):
							<input type="checkbox" name="492">  Allemand
							<input type="checkbox" name="493">  Anglais
							<input type="checkbox" name="494">  Arabe<br>
							<input type="checkbox" name="495">  Espagnol
							<input type="checkbox" name="496">  Français
							<input type="checkbox" name="497">  Italien<br>
							<input type="checkbox" name="498">  Japonais
							<input type="checkbox" name="499">  Mandarin
							<input type="checkbox" name="500">  Portugais<br>
							<input type="checkbox" name="501">  Autre<br><br>
				</div>
				<div>			
						Traduction (en):<input type="checkbox" name="502">  Allemand
							<input type="checkbox" name="503">  Anglais
							<input type="checkbox" name="504">  Arabe<br>
							<input type="checkbox" name="505">  Espagnol
							<input type="checkbox" name="506">  Français
							<input type="checkbox" name="507">  Italien<br>
							<input type="checkbox" name="508">  Japonais
							<input type="checkbox" name="509">  Mandarin
							<input type="checkbox" name="510">  Portugais<br>
							<input type="checkbox" name="511">  Autre<br><br>
				</div>			
			';
            break;
			
        case 882:
					
		$placesdispo526=(@$_REQUEST['placesdispo']==526) ? 
		 			'<option value="526" selected="selected">1</option>':
					'<option value="526">1</option>';
		$placesdispo527=(@$_REQUEST['placesdispo']==527) ? 
		 			'<option value="527" selected="selected">2</option>':
					'<option value="527">2</option>';
		$placesdispo528=(@$_REQUEST['placesdispo']==528) ? 
		 			'<option value="528" selected="selected">3</option>':
					'<option value="528">3</option>';
		$placesdispo529=(@$_REQUEST['placesdispo']==529) ? 
		 			'<option value="529" selected="selected">4</option>':
					'<option value="529">4</option>';
		$placesdispo530=(@$_REQUEST['placesdispo']==530) ? 
		 			'<option value="530" selected="selected">5+</option>':
					'<option value="530">5+</option>'; 
					
		$var.=' 
		Places disponibles:
			<select name="placesdispo" class="textbox" style="width:auto;">
				<option value="">Choisir une option</option>'.
				$placesdispo526.
				$placesdispo527.
				$placesdispo528.
				$placesdispo529.
				$placesdispo530.'
			</select>
		<br>
		Ville de destination:
			<input type="text" name="villedestination" value="'.@$_REQUEST['villedestination'].'" class="textbox" style="width:100px;">
		Du:
			<input type="text" name="du" value="'.@$_REQUEST['du'].'" class="textbox" style="width:100px;">
			';
            break;
            /*
        case 930:
        case 931: $var.=' 
        Espèce:
            <select name="sp_common_main_type" onchange="">
                <option value="" selected="">Indifférent</option>
                <option value="Chat">Chat</option>
                <option value="Chien">Chien</option>
                <option value="Cheval">Cheval</option>
                <option value="Oiseau">Oiseau</option>
                <option value="Rongeur">Rongeur</option>
                <option value="Reptile">Reptile</option>
                <option value="Poisson">Poisson</option>
                <option value="Autre animal">Autre animal</option>
            </select>'	;
        break;
			*/
			
        case 888:
        case 892:
        case 893:
		
		$var.='
		<select name="agemin">
        	<option value=""'; if(@$_REQUEST['agemin']=='') $var.=' selected'; $var.='>min</option>';
			
				for ($i = 18; $i <= 99; $i--) {
					if(@$_REQUEST['agemin']==$i)
						$var.= "<option value='".$i."' selected>".$i."</option>";
					else
						$var.= "<option value='".$i."'>".$i."</option>";
				}
		$var.='
		</select>
        
		<select name="agemax">
        	<option value=""'; if(@$_REQUEST['agemax']=='') $var.=' selected'; $var.='>max</option>';

				for ($i = 18; $i <= 99; $i--) {
					if(@$_REQUEST['agemax']==$i)
						$var.= "<option value='".$i."' selected>".$i."</option>";
					else
						$var.= "<option value='".$i."'>".$i."</option>";
				}
$var.='
		</select>';
		
		break;
		}
echo $var;
}

/* Make Option Sub Sub category drop down second level */
if(isset($_REQUEST['osubcatId']) && $_REQUEST['osubcatId']!=""){
	$subCatID = intval($_REQUEST['subcatId']);
      $sql_cat=db_query("select * from tbl_option_cat where cat_id ='$osubcatId' order by cat_id");
	   $num=mysql_num_rows($sql_cat);
	   $var=''; 
	  if($num > 0 ){
		  $var.='<table width="100%" border="0">';			
			$sbCatID = intval($_REQUEST['sbcatId']);
			while($rw=mysql_fetch_array($sql_cat)){ 
				$var.='<tr><td  align="right" valign="top" width="20%">'.$rw['option_nom'].':</td>';
				//------------------------------
					  $sql=db_query("select * from tbl_value_option where option_id ='$rw[option_id]' ORDER BY val_id");
					   $num2=mysql_num_rows($sql);
							$var.='<td>';
					  if($num2 > 0 ){
						  	if(($rw[option_id]==159)||($rw[option_id]==160)){
								$l=0;
								while($rw2=mysql_fetch_array($sql)){ 
                            		$var.="<input type='checkbox' name='".$rw2[val_id]."'>  ".$rw2[val_nom];
									$l++;
									$var.=($l%3==0)?"<br>":"";
								}
								$var.="<br><br>";
							}
							else{
								$var.="<select name='".$rw[option_id]."' class='textbox' style='width:314px;' />"; 
								$var.='<option value="">Choisir une option</option>';	
								while($rw2=mysql_fetch_array($sql)){ 
						   
									$var.='<option value="'.$rw2[val_id].'">'.$rw2['val_nom'].'</option>';		
									
									//$var.="<input type='radio' name='$rw[option_id]' value='$rw2[val_id]'>".$rw2['val_nom'];
								}
								$var.="</select>";
							}
						}
						else if($rw['option_nom']==htmlentities("Présentation de l'entreprise", ENT_QUOTES, "UTF-8")){
							$var.="<textarea rows='3' cols='30' name='".$rw[option_id]."' maxlength='60'></textarea>";
						}
						else if($rw['option_nom']==htmlentities("Année", ENT_QUOTES, "UTF-8")){
							//-----------
							
								$var.="<select name='".$rw['option_id']."' class='textbox' style='width:314px;' />"; 
								$var.='<option value="">Choisir une option</option>';	
								$ann=date("Y");
								while($ann>=1900){ 
						   
									$var.='<option value="'.$ann.'">'.$ann.'</option>';
									$ann--;
								}
								$var.="</select>";
							//-------------
						}
						else if($rw['option_nom']==htmlentities("Modèle/Marque", ENT_QUOTES, "UTF-8")){
							//-----------
							
								$var.="<select name='".$rw['option_id']."' class='textbox' style='width:314px;' />"; 
								$var.='<option value="">Choisir une option</option>';	
								 
								$var.='<option value="Acura">Acura</option>';
								$var.='<option value="Acura">aixam</option>';
								$var.='<option value="Alfa Romeo">Alfa Romeo</option>';
								$var.='<option value="Audi">Audi</option>';	
								$var.='<option value="BMW">BMW</option>';	
								$var.='<option value="BRERA">BRERA </option>';
								$var.='<option value="Buick">Buick</option>';	
								$var.='<option value="Cadillac">Cadillac</option>';	
								$var.='<option value="Chevrolet">Chevrolet</option>';
								$var.='<option value="Citroen">Citroen</option>';	
								$var.='<option value="Chrysler">Chrysler</option>';	
								$var.='<option value="Dacia">Dacia</option>';
								$var.='<option value="Dodge">Dodge</option>';
								$var.='<option value="Fiat">Fiat</option>';
								$var.='<option value="Ford">Ford</option>';
								$var.='<option value="GMC">GMC</option>';	
								$var.='<option value="Honda">Honda</option>';	
								$var.='<option value="Hummer">Hummer</option>';	
								$var.='<option value="Hyundai">Hyundai</option>';	
								$var.='<option value="Infiniti">Infiniti</option>';	
								$var.='<option value="Jaguar">Jaguar</option>';	
								$var.='<option value="Jeep">Jeep</option>';	
								$var.='<option value="Kia">Kia</option>';	
								$var.='<option value="Land Rover">Land Rover</option>';	
								$var.='<option value="Lexus">Lexus</option>';	
								$var.='<option value="Lincoln">Lincoln</option>';	
								$var.='<option value="Limousin">Limousin</option>';	
								$var.='<option value="Mazda">Mazda</option>';	
								$var.='<option value="MC LOUIS TANDY 640">MC LOUIS TANDY 640</option>';	
								$var.='<option value="Mercedes Benz">Mercedes Benz</option>';	
								$var.='<option value="Mercury">Mercury</option>';	
								$var.='<option value="Mini">Mini</option>';	
								$var.='<option value="Mitsubishi">Mitsubishi</option>';	
								$var.='<option value="Nissan">Nissan</option>';	
								$var.='<option value="Peugeot">Peugeot</option>';
								$var.='<option value="Pininfarina">Pininfarina</option>';
								$var.='<option value="Pontiac">Pontiac</option>';	
								$var.='<option value="Porsche">Porsche</option>';	
								$var.='<option value="Renualt">Renault</option>';
								$var.='<option value="Ram">Ram</option>';	
								$var.='<option value="Saab">Saab</option>';	
								$var.='<option value="Saturn">Saturn</option>';	
								$var.='<option value="Scion">Scion</option>';	
								$var.='<option value="Smart">Smart</option>';	
								$var.='<option value="Subaru">Subaru</option>';	
								$var.='<option value="Suzuki">Suzuki</option>';	
								$var.='<option value="Toyota">Toyota</option>';	
								$var.='<option value="Volkswagen">Volkswagen</option>';	
								$var.='<option value="Volvo">Volvo</option>';	
								$var.='<option value="other cars">other cars</option>';	
								$var.="</select>";
							//-------------
						}
						else if($rw['option_id']==htmlentities("149", ENT_QUOTES, "UTF-8") || $rw['option_id']==htmlentities("153", ENT_QUOTES, "UTF-8") ){
							/**************affiche les options de fonction du  publier une offre et publier votre CV*************/
							
						$sql_fonction=db_query("select * from tbl_category where cat_parent ='793' and cat_status='Y' order by cat_order");
									   
						   	$var.="<select name='".$rw[option_id]."' class='textbox' style='width:314px;' />"; 
									   $var.= '<option value="">Choisir une option</option>';
									  			
										while($rwf=mysql_fetch_array($sql_fonction)){  
										  $var.='<option value="'.$rwf['cat_id'].'" '.$sel.' >'.$rwf['cat_name'].'</option>';	 
									   }	
										   
										 $var.='</select>';		
						}
						else{
							$var.="<input type='text' name='$rw[option_id]' value='' class='textbox' maxlength='10' required='required' >";
						}
							
							if($rw['option_nom']=="Surface"){
								$var.="m²";
							}else if($rw['option_nom']==htmlentities("Kilométrage", ENT_QUOTES, "UTF-8")){
								$var.="Km";
							}else if($rw['option_nom']==htmlentities("Cylindrée", ENT_QUOTES, "UTF-8")){
								$var.="CC";
							}else if($rw['option_nom']==htmlentities("Longueur", ENT_QUOTES, "UTF-8")){
								$var.="M";
							}else if($rw['option_nom']==htmlentities("Nbre de pièces", ENT_QUOTES, "UTF-8")){
								$var.="pièce(s)";
							}else if($rw['option_nom']==htmlentities("Loyer", ENT_QUOTES, "UTF-8")){
								$var.="/mois";
							}else if($rw['option_nom']==htmlentities("Nbre de chambres", ENT_QUOTES, "UTF-8")){
								$var.="chambre(s)";
							}else if($rw['option_nom']==htmlentities("Couchages", ENT_QUOTES, "UTF-8")){
								$var.="Couchages";
							}else if($rw['option_nom']==htmlentities("Loyer / semaine", ENT_QUOTES, "UTF-8")){
								$var.="/semaine";
							}else if($rw['option_nom']==htmlentities("Prix/Loyer", ENT_QUOTES, "UTF-8")){
								$var.="€";
							}else if($rw['option_nom']==htmlentities("Taille", ENT_QUOTES, "UTF-8")){
								$var.="Ha";
							}
							
							$var.='</td>';
				//------------------------------
				$var.='</tr>';
			}	 
		  $var.='</table>';	
	   }
echo $var;
}
/* Make city drop down second level */
if(isset($_REQUEST['statId']) && $_REQUEST['statId']!=""){		
	$statID = intval($_REQUEST['statId']);
	$sbCatID = intval($_REQUEST['sbcatId']);
      $sql_cat=db_query("select * from tbl_city where city_state_id ='$statID' and city_status='Active' order by city_name");
	  $num=mysql_num_rows($sql_cat);
	  $var='<select name="classi_city" id="classi_city" class="textbox" style="width:310px;" />';
	  
	  $var.= '<option value="">Choisir Ville</option>';
	  if($num > 0 ){
	      while($rw=mysql_fetch_array($sql_cat)){ 
		  if($rw[city_id]==$sbCatID){
		     $sel="selected";
		   }else{
		     $sel="";
		   	}  
		  $var.='<option value="'.$rw['city_id'].'" '.$sel.' >'.$rw['city_name'].'</option>';		
	       }
		  $var.='</select>';
	   }
echo $var;
}

/* Make city drop down second level */
if(isset($_REQUEST['statIdsearch']) && $_REQUEST['statIdsearch']!=""){
	$statID = intval($_REQUEST['statIdsearch']);
	$sbCatID = intval($_REQUEST['sbcatId']);
      $sql_cat=db_query("select * from tbl_city where city_state_id ='$statID' and city_status='Active' order by city_name");
	  $num=mysql_num_rows($sql_cat);
	  $var='<select name="cityId" id="classi_city" class="textbox" style="width:auto;" />';
	  
	  $var.= '<option value="">Choisir Ville</option>';
	  if($num > 0 ){
	      while($rw=mysql_fetch_array($sql_cat)){ 
			  if($rw[city_id]==$sbCatID){
				 $sel="selected";
			  }else{
				 $sel="";
			  }  
			  $var.='<option value="'.$rw['city_id'].'" '.$sel.' >'.$rw['city_name'].'</option>';		
	      }
		  $var.='</select>';			 
	   }
echo $var;
}

?>