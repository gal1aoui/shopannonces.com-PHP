<?php /*************************************************************************************************
* Devloper Name : stk																							
* Organization  : cl
* File 			: For Common Functions *************************************************************************************************/
function validate_user()
{
	$cur_page1 = basename($_SERVER['PHP_SELF']);
	if($_SESSION['sess_u_id']!='' && $_SESSION['sess_u_id']!=0){
	   if($cur_page1=="wholesale-login.php" or $cur_page1=="wholesale-register.php" or $cur_page1=="wforgot-password.php" or $cur_page1=="wholesale-folder.php" or $cur_page1=="wholesale-product.php" or $cur_page1=="wholesale-cart.php" or $cur_page1=="wholesale-checkout.php" or $cur_page1=="wholesale-process.php" or $cur_page1=="wprocess2.php" or $cur_page1=="wpayment.php" or  $cur_page1=="wpaypalpro.php" or $cur_page1=="wholesale-change-password.php" or $cur_page1=="wholesale-profile.php" or $cur_page1=="whistory.php"){
   	     set_session_msg("Your are login as a retailer. If you want to login as a wholesaler then first <a href='logout.php'>click here</a> to logout and click on wholesale login.");
	     header("Location:message.php");
		 exit;
	     //////////
	   }else{
	   
	     //////////
	   }	  
	}elseif($_SESSION['sess_w_id']!='' && $_SESSION['sess_w_id']!=0){
	   //////////////////
	}else{
	    $_SESSION['pageName']=$_SERVER['REQUEST_URI'];		
		if($cur_page1=="index.php"){
		  header("Location:login.php");
		  exit;
		}else{
		    if($cur_page1!="wholesale-login.php" && $cur_page1!="wholesale-register.php" && $cur_page1!="wforgot-password.php" && ($cur_page1=="wholesale-folder.php"  or $cur_page1=="wholesale-product.php" or $cur_page1=="wholesale-cart.php" or $cur_page1=="wholesale-checkout.php" or $cur_page1=="wholesale-process.php" or $cur_page1=="wprocess2.php" or $cur_page1=="wpayment.php" or  $cur_page1=="wpaypalpro.php" or $cur_page1=="wholesale-change-password.php" or $cur_page1=="wholesale-profile.php" or $cur_page1=="whistory.php")){
				$_SESSION['sess_msg'] = "You are not logged in. Please login first.";
				header("Location:wholesale-login.php?back=".urlencode($_SERVER['REQUEST_URI']));
				exit;
			}elseif($cur_page1!="wholesale-login.php" && $cur_page1!="wholesale-register.php" && $cur_page1!="wforgot-password.php"){
				$_SESSION['sess_msg'] = "You are not logged in. Please login first.";
				header("Location:login.php?back=".urlencode($_SERVER['REQUEST_URI']));
				exit;
			}
		}
	}
}


function protect_user($role_type){
$cur_page = basename($_SERVER['PHP_SELF']);
  if($role_type=='Sales'){
     if($cur_page!="sale_transaction.php" && $cur_page!="transaction.php" && $cur_page!="refund_transaction.php" && $cur_page!="receipt.php" && $cur_page!="gift_cert_sale.php" && $cur_page!="gift_cert_print.php" && $cur_page!="gift_certificate.php" && $cur_page!="index.php"){
	  // $_SESSION['sess_msg'] = "You are a sales person. You can only manage the transactions.";
	   header("Location: index.php");
	   exit;
	 }
  }else if($role_type=='Manager'){
     if($cur_page=="store.php"){
	   //$_SESSION['sess_msg'] = "You are a Manager. You can not manage the store.";
	   header("Location: index.php");
	   exit;
	 }
  }
}

if(!function_exists("send_mail"))
{
	function send_mail($email_to,$subject,$message,$from_email,$from_name='',$html=false)
	{
		 if($from_name == '') 
		 	$from_name=$from_email;
		 if($html==true) 
		 	$headers = "Content-type: text/html; charset=utf-8\r\n";
		 else 
		 	$headers = "Content-type: text/plain; charset=utf-8\r\n";
			
		 $headers .= "From: $from_email \r\n";
		 @mail($email_to, '=?utf-8?B?'.base64_encode($subject).'?=',$message,$headers);
	}

} 


function price_convert($CrId,$amount_tol)
{
$sql_cur=db_query("select * from  exchange_currency where curr_id=$CrId");
if(mysql_num_rows($sql_cur) > 0 )
{
$cr_val=mysql_fetch_array($sql_cur);
$cur_sym = $cr_val['curr_symbol']; 
$cur_value = $cr_val['curr_value']; 
$final_rice=number_format(($amount_tol/$cur_value),2);
$display_price= "$cur_sym"." : "."$final_rice";
}else{
$sql_cur=db_query("select * from  exchange_currency where curr_id=6");
$cr_val=mysql_fetch_array($sql_cur);
$cur_sym = $cr_val['curr_symbol']; 
$cur_value = $cr_val['curr_value']; 
$final_rice=number_format(($amount_tol/$cur_value),2);
$display_price= "$cur_sym"." : "."$final_rice";
}
return $display_price;
}



function readmyfile($path)
{
	$text='';
	$fp = @fopen($path,"r");
	while (!@feof($fp))
	{
		$buffer = @fgets($fp, 4096);
		$text.= $buffer;
	}
	@fclose($fp);
	return $text;
}

function validate_form()
{
	return ' onsubmit="return validateForm(this,0,0,0,1,8);" ';
}

function protect_admin_page() {
	$cur_page = basename($_SERVER['PHP_SELF']);
	//echo "<br>cur_page: $cur_page";
	if($cur_page != 'index.php') {
		if ($_SESSION['sess_admin_login_id']=='') {
			header('Location: index.php');
			exit;
		}
	}
}

function status_dropdown()
{
	$arr = array( "Active" => 'Active', 'Inactive' => 'Inactive');
	return array_dropdown($arr, $sel_value, $name);
}

function yes_no_dropdown()
{
	$arr = array( "Yes" => 'Yes', 'No' => 'No');
	return array_dropdown($arr, $sel_value, $name);
}

function  getCountryDropDown($name,$sel_value,$extra)
{
$arr=array();
$sql="SELECT contId,contName FROM country_master ";
$rs=db_query($sql);

   if($rs)
   {
      while($line=mysql_fetch_array($rs))
	  {
	    @extract($line);
		$arr[$contId]=$contName;
			
	  }
	  $sel_value	=	($sel_value=="" or $sel_value=="0")?"219":$sel_value;
	  
	  $dropdown	=	array_dropdown($arr, $sel_value, $name, $extra);
   }
  
return $dropdown;
}

function  getCountryDropDown_x($name,$sel_value,$extra)
{
$arr=array();
$sql="SELECT country_type,contName FROM country_master ";
$rs=db_query($sql);

   if($rs)
   {
      while($line=mysql_fetch_array($rs))
	  {
	    @extract($line);
		$arr[$country_type]=$contName;
			
	  }
	  $sel_value	=	($sel_value=="")?"UK":$sel_value;
	  
	  $dropdown	=	array_dropdown($arr, $sel_value, $name, $extra);
   }
  
return $dropdown;
}


function  getCountryName($country_id)
{
  $country_name='';
  $row=getDBRow('country_master',"contId='".$country_id."'",'contName');
  if(is_array($row))
     {
       $country_name=$row['contName'];
     }
  
  
 return $country_name; 
}

function  getCountryCode($country_id)
{
  $country_name='';
  $row=getDBRow('country_master',"contId='".$country_id."'",'contCode');
  if(is_array($row))
     {
       $country_name=$row['contCode'];
     }
  
  
 return $country_name; 
}


function  getUsStateDropDown($name,$sel_value,$extra)
{
$arr=array();
$sql="SELECT state_id,state FROM us_state ";
$rs=db_query($sql);
   if($rs)
   {
      while($line=mysql_fetch_array($rs))
	  {
	    @extract($line);
		$arr[$state]=$state;
			
	  }
	  $dropdown	=	array_dropdown($arr, $sel_value, $name, $extra,"Select");
   }
return $dropdown;
}

function  getCountryDropDownCode($name,$sel_value,$extra)
{
$arr=array();
$sql="SELECT contCode,contName FROM country_master ";
$rs=db_query($sql);

   if($rs)
   {
      while($line=mysql_fetch_array($rs))
	  {
	    @extract($line);
		$arr[$contCode]=$contName;
			
	  }
	  $sel_value	=	($sel_value=="")?"UK":$sel_value;
	  
	  $dropdown	=	array_dropdown($arr, $sel_value, $name, $extra);
   }
  
return $dropdown;
}


function getDBRow($table,$condition='',$field_list)
{

  if($table!='' && $field_list!='')
   {
      $sql="SELECT $field_list  FROM  $table  ";  
	  if($condition!='')
	   $sql.=" WHERE  $condition ";
	   $rs=db_query($sql);
	   if($rs)
	      {
		    $row=mysql_fetch_array($rs);
			
		  }
   }
return $row;

}

function checkAvailableRecord($table,$field1,$condition){
 if($table!="" && $field1!="" && $condition!=""){
  $sql		=	"select $field1 from $table where $condition";
  $result	=	db_scalar($sql);
 }else{
   $result	=	0;
 }
 return $result;
}

function searchSingleRecord($table,$field1,$field2,$value){

  if($table!="" && $field1!="" && $field2!="" && $value!=""){
    $sql	=	"select $field1 from $table where $field2='".$value."'";
	$result	=	db_scalar($sql);
	return $result;	
  }
}

function get_username($mem_id)
{
   $name='';
   $sql		=	"select u_fname,u_lname  from user where u_id='$mem_id'";
   $result	=	db_query($sql);
    if($result)
    {
	    $row=mysql_fetch_array($result);
	    $name=$row['u_fname'];
	    $name.=" ".$row['u_lname'];
     }
 return ucwords($name);
}

function get_wholesaler($mem_id)
{
   $name='';
   $sql		=	"select w_fname,w_lname  from tbl_wholesaler where w_id='$mem_id'";
   $result	=	db_query($sql);
    if($result)
    {
	   $row=mysql_fetch_array($result);
	   $name=$row['w_fname'];
	    $name.=" ".$row['w_lname'];
     }
 return ucwords($name);
}

function count_character($str,$td_len)
{
	$length=strlen($str);
	if($length > $td_len)
	{
	  $i=$td_len;
	  do { 
			$i--;
		}while(substr($str,$i,1)!=" ");
	  return substr($str,0,$i)."...";
	}
	else
	  {
		return $str;
	  }
}



function set_session_msg($msg)
{
 $_SESSION['sess_msg']=$msg;
}

function display_sess_msg()
{
 if(@$_SESSION['sess_msg']!='')  {
  echo '<div align="center" class="red">';
  echo "<br>".@$_SESSION['sess_msg'];
  unset($_SESSION['sess_msg']) ; 
  echo "</div>";
   }

}


function sendMail($email_to,$emailto_name,$email_subject,$email_body,$email_from,$reply_to,$html=true)
{
	include_once 'class.phpmailer.php';
	$mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	//$mail->IsSMTP(); // send via SMTP]
	$mail->IsMail(); // send via PHP mail function]
	$mail->Mailer   = 'mail'; 
	//$mail->Host   = ""; // SMTP servers
	$mail->From     = $email_from;
	$mail->FromName = SITE_NAME;
	$mail->AddAddress($email_to,$emailto_name); 
	
	$mail->AddReplyTo($reply_to,SITE_NAME);
	//$mail->WordWrap = 50;                              // set word wrap
	$mail->IsHTML($html);                               // send as HTML
	$mail->Subject  =  $email_subject;
	$mail->Body     =  $email_body;
	if(!$mail->Send())
	{
		return false;
	}
	else
	{
		return true; 
	}
}

function generateInsertQuery($table){
	if($table!=""){
		$query="select * from $table";
		$result=db_query($query);
		$insert	=	"Insert into $table values(";	
		$i = 0;
		while ($i < mysql_num_fields ($result)) {
		$row = mysql_fetch_field ($result);
		$name	= $row->name;
		$insert	.= " '$$name',";	
		  $i++;
		}	
		$insert	=	substr($insert,0,-1).")";
		return $insert;	
	}
}

function generateUpdateQuery($table){
	if($table!=""){
		$query="select * from $table";
		$result=db_query($query);
		$insert	=	"Update $table set ";	
		$i = 0;
		while ($i < mysql_num_fields ($result)) {
		
		$row = mysql_fetch_field ($result);
		$name	= $row->name;
		$insert	.= " $name='$$name',";	
		  $i++;
		}	
		$insert	=	substr($insert,0,-1);
		return $insert;	
	}
}

function gen_random_string($length=6, $str='')
{
		for($i=1; $i<=$length; $i++)
		{
			$ord = rand(48, 90);

			if( ( ($ord>=48) && ($ord<=57) ) || ( ($ord>=65) && ($ord<=90) ) )
			{
				$str .= chr($ord);
			}
			else
			{
				$str .= gen_random_string(1);
			}
		}
		return $str;
}

function CreateCouponCode(){
		$random	=	getRandomString();
		$check	=	checkAvailableRecord("user","count(*)"," activation_key='$random' ");
		if($check=="" || $check=="0"){
		  return $random;	
		}else{
		  return CreateCouponCode(); 
		}
}

function ADD_CART($product_id,$Price,$Qty,$color_id,$size_id,$type,$size_t)
{
     $basket=array();
     if(count($_SESSION[Cart1])>0)
     {
          foreach($_SESSION[Cart1] as $key=>$value)
          {
               $basket[]=$value["product_id"]."~".$value["color_id"]."~".$value["size_id"]."~".$value["type"];
          // $basket[]=;
          }
		  $x	=	$product_id."~".$color_id."~".$size_id."~".$type;
          if(in_array($x,$basket))
          {
          //print_r($basket);
          //echo $Connection_id;
          ///exit();     
          }
          else
          {
		 		  
               $_SESSION[Cart1][]=array('product_id'=>$product_id,'color_id'=>$color_id,'size_id'=>$size_id,'Price'=>$Price,"Quantity"=>$Qty,"type"=>$type,"size_t"=>$size_t);
          }
     }
     else
     {
     $_SESSION[Cart1][]=array('product_id'=>$product_id,'color_id'=>$color_id,'size_id'=>$size_id,'Price'=>$Price,"Quantity"=>$Qty,"type"=>$type,"size_t"=>$size_t);
     }
}

function View1_Cart()
{
     echo "<pre>";
     print_r($_SESSION[Cart1]);
}
function Count_Array()
{
     return count($_SESSION[Cart]);
}
function RemoveAndRepairCart($x)
{
     $Cart_new = $_SESSION['Cart1'];
     unset($Cart_new[$x]);
     $new_Cart = array();
     foreach ($Cart_new as $key1=>$val1)
     {
          $new_Cart[]=$val1; 
     }     
     $_SESSION['Cart1']=$new_Cart;
}
function getCartTotalAmount()
{
     $total_amount=0.0;
    
	foreach($_SESSION[Cart1] as $item)
		{
			if(is_array($item))
			{
			 $coaches_order_details_price=$item["Price"];
			 $Quantity=$item["Quantity"];
			 $amount=$Price*$Quantity;
			 $total_amount+=$amount;
			}	 
		
		}     
	return 	$total_amount;
}
function Empty_cart()
{
     $Cart_new = $_SESSION['Cart1'];
     unset($Cart_new);
     $new_Cart = array();
     /*foreach($Cart_new as $key1=>$val1)
     {
          $new_Cart[]=$val1; 
     } */    
     $_SESSION['Cart1']=$new_Cart;
}


function getdatedifference($date1,$date2){

if(($date2!="0000-00-00" && $date2!="0000-00-00 00:00:00")){
  if($date2 >= $date1){
	 $s = strtotime($date2)-strtotime($date1);
	 $mon	=	intval(($s*12)/(86400*365));
	 $s	-=	intval(($mon*86400*365)/12);	 
	 $d = intval($s/86400); 
	 $s -= $d*86400;
	 $h = intval($s/3600);
	 $s -= $h*3600;
	 $m = intval($s/60); 
	 $s -= $m*60;
	 $time	=	"";
	 if($mon!=0){
	  $time	=	$mon." months ";
	 }
	 $time	.=	($d!=0)?"$d days ":"";
	 $time	.=	($h!=0)?"$h hrs ":"";
	 $time	.=	($m!=0)?"$m min ":"";
	 return $time;
  }
 }else{
   return '';
 }
}

function getchild($catid){
$low_level	=	"";
	if($catid!='' && $catid!=0){
	    $sql	=	"select cat_id from product_category where cat_parent='$catid' ";
		$res	=	db_query($sql);
		$num	=	mysql_num_rows($res);
		if($num>0){
		  $i=0;
		  while($row=mysql_fetch_row($res)){		    
		   $low_level	.=	$row[0].",".getchild($row[0]);				
		   $i++;}
		}     	
	}	
	return $low_level;
}

function getParent($catid){
	$res=mysql_fetch_array(mysql_query("select * from product_category where cat_id='$catid'"));
	$flag=0;
	$catparent=$catid;
	while($flag!=1){
		$res1=mysql_query("select * from product_category where cat_id='$catparent'");
		$record=mysql_fetch_array($res1);
		if($record[cat_parent]!=0){
			$catparent=$record[cat_parent];
			$array.="$record[cat_id]~";
		}else{
			if($record[cat_id]!=""){
				$array.="$record[cat_id]~";
			}
			$flag=1;
		}
	}
	$arr=explode("~",$array);
	$result = array_reverse($arr);
	return $result[1];
}


function calculate_avg_rating($rating_type="",$rating_prod_id){

  if($rating_prod_id!="" && $rating_prod_id!="0"){
     $check	=	checkAvailableRecord("rating","count(*)"," rating_prod_id='$rating_prod_id' ");
	 if($check!="" && $check!="0"){
	   switch($rating_type){

	   case 'comfort':
		   $sql	=	" select ROUND(AVG(rating_comfort),1) from rating where rating_prod_id='$rating_prod_id'";
	   break;
	   
      case 'style':
		   $sql	=	" select ROUND(AVG(rating_style),1) from rating where rating_prod_id='$rating_prod_id'";
	  break;
	   
     case 'quality':
		   $sql	=	" select ROUND(AVG(rating_quality),1) from rating where rating_prod_id='$rating_prod_id'";
     break; 
	   
	 default:
	   $sql	=	" select ROUND(AVG((rating_comfort+rating_style+rating_quality)/3),1) from rating where rating_prod_id='$rating_prod_id'";
	 }
	   
	   $res	=	db_scalar($sql);
	   return $res;
	 }  
   }
}



function sendInvoiceEmail($order_id,$u_id){

if($order_id!=""){
$sql	=	"select t1.*,t2.* from `order` t1, user t2 where t2.u_id=t1.user_id And t1.order_id='$order_id' ";
$result	=	db_query($sql);
	if(mysql_num_rows($result)>0){
	  $row=mysql_fetch_assoc($result);
	  @extract($row);
	
$invoice	=	"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
\"http://www.w3.org/TR/html4/loose.dtd\"><html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<title>Sexyher Online Shop</title>
<style type=\"text/css\">
body {
	font-family: Verdana, Arial, Helvetica, sans-serif;
	font-size: 10px;
}
.pagetitle {
	font-size: 11px;
	font-weight: bold;
	text-transform: uppercase;
	background-color: #FFFFFF;
}
.tile-brdr {
	border-right-width: 1px;
	border-bottom-width: 1px;
	border-left-width: 1px;
	border-top-style: none;
	border-right-style: solid;
	border-bottom-style: solid;
	border-left-style: solid;
	border-right-color: #FF0000;
	border-bottom-color: #FF0000;
	border-left-color: #FF0000;
	padding: 5px;
}
.wt {
	font-weight: bold;
	color: #FFFFFF;
	text-decoration: none;
}
.litebg {
	background-color: #FDFAF4;
	border-top-width: 1px;
	border-bottom-width: 1px;
	border-top-style: dashed;
	border-bottom-style: dashed;
	border-top-color: #F0DFC1;
	border-bottom-color: #F0DFC1;
}
.red {
	color: #BD2124;
	text-decoration: none;
}
.btmborder {
	border-bottom-width: 1px;
	border-bottom-style: dotted;
	border-bottom-color: #CCCCCC;
}
.grey1 {
	background-color: #F0F0F0;
}
.grey2 {
	background-color: #E5E5E5;
}
.grey3 {
	background-color: #DBDBDB;
}
</style>

</head>
<body style=\"font-family: Verdana, Arial, Helvetica, sans-serif;font-size: 10px;\">
<table width=\"90%\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr background=\"images/titlebg.gif\">
    <td align=\"left\" nowrap background=\"images/titlebg.gif\"><table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
          <td nowrap><img src=\"images/title-lt.gif\" width=\"17\" height=\"18\" align=\"absmiddle\"><span class=\"pagetitle\">invoice </span></td>
          <td background=\"images/titlebg.gif\"><img src=\"images/title-lt2.gif\" width=\"8\" height=\"18\"></td>
        </tr>
    </table></td>
    <td align=\"right\" background=\"images/titlebg.gif\"><img src=\"images/title-rt.gif\" width=\"8\" height=\"18\"></td>
  </tr>
  <tr>
    <td colspan=\"2\" class=\"tile-brdr\"><form name=\"form4\" method=\"post\" action=\"\">
        <br>
        <table  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\" id=\"wt\">
          <tr>
            <td><table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\"  >
                <tr>
                  <td width=\"100\" height=\"25\" align=\"center\" bgcolor=\"#FF0000\"><a href=\"Javascript:window.print();\" class=\"wt\"> Print Invoice </a></td>
                </tr>
            </table></td>
            <td><table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\"  >
                <tr>
                  <td width=\"100\" height=\"25\" align=\"center\" bgcolor=\"#FF0000\"><a href=\"Javascript:window.close()\" class=\"wt\">Close Window </a></td>
                </tr>
            </table></td>
          </tr>
        </table>
        <br>
        <table width=\"100%\"  border=\"0\" cellpadding=\"2\" cellspacing=\"2\" summary=\" \">
          <tr valign=\"top\" >
            <td width=\"97%\" height=\"20\" colspan=\"2\" align=\"left\" valign=\"middle\" class=\"litebg\" ><strong>Your Details</strong></td>
          </tr>
          <tr>
            <td valign=\"top\"><strong>Billing Address</strong><br />
      ".get_username($u_id)."<br />";
  $invoice	.=($u_bil_address!="")?$u_bil_address."<br>":"";
  $invoice	.=($u_bil_address2!="")?$u_bil_address2."<br>":"";
  $invoice	.=$u_bil_city;
  $invoice	.="&nbsp;&nbsp;".$u_bil_state;
  $invoice	.=	"<br>".$u_bil_zipcode;
  $invoice	.=	"<br>".getCountryName($u_bil_country)."</td><td valign=\"top\"><strong>Shipping Address</strong><br />";
  $invoice	.= get_username($u_id);
  $invoice	.="<br />";
  $invoice  .=($u_ship_address!="")?$u_ship_address."<br>":"";
  $invoice  .=($u_ship_address2!="")?$u_ship_address2."<br>":"";
  $invoice   .=$u_ship_city;
  $invoice  .="&nbsp;&nbsp;".$u_ship_state;
  $invoice	.="<br>".$u_ship_zipcode;
  $invoice	.=	"<br>".getCountryName($u_ship_country)."</td></tr>
  <TR><TD>Invoice Date : ".date_format1($order_date)."</TD>
                        <TD><B>Order Number</B> : ".$order_id."</TD>
                      </TR>
  <tr>
            <td valign=\"top\">&nbsp;</td>
            <td valign=\"top\">&nbsp;</td>
          </tr>
          <tr valign=\"top\" >
            <td height=\"20\" colspan=\"2\" align=\"left\" valign=\"middle\" class=\"litebg\" ><strong>Product  Details</strong></td>
          </tr>
          <tr>
            <td colspan=\"2\" valign=\"top\"><table width=\"100%\"  border=\"0\" cellpadding=\"2\" cellspacing=\"2\">";
$sql_detail	=	"select t1.*,t2.* from order_detail t1, product t2 where t2.product_id=t1.od_prod_id And t1.od_order_id='$order_id'";
$res		=	db_query($sql_detail);
if(mysql_num_rows($res)>0)		{   $total	=	0;
$invoice	.="<tr align=\"left\" class=\"litebg red\">
                <td height=\"25\"><strong>Product </strong></td>
                <td><strong>Color/Size  or  Measurment(Bust,Waist,Hips,Length,Color) </strong></td>
                <td><strong>Code </strong></td>
                <td><strong>Price</strong></td>
                <td><strong>Qty</strong></td>
                <td><strong>Total</strong></td>
                </tr>";
  while($row_s=mysql_fetch_array($res)){
	 @extract($row_s);
   $invoice	.="<tr align=\"left\">
                <td height=\"18\" class=\"btmborder\">$product_name</td>
                <td class=\"btmborder\">";
  
  // $invoice	.=searchSingleRecord("tbl_color","color_name","color_id",$od_color_id);$invoice	.= "/";
   //$invoice	.=	searchSingleRecord("tbl_size","s_size","s_id",$od_size_id);
   if($od_type=="Measure"){
	 $invoice	.= str_replace('_',',',$od_color_id);
	 $invoice	.= ",";
	 //$invoice	.= str_replace('_',',',$od_size_id); }
	$col	=	explode('~DM~',$od_size_id);
	$col1	=	str_replace('_',',',$col[0]);
	if($col[1]!=""){
	$col	=searchSingleRecord("tbl_color","color_name","color_id",$col[1]); 									 		$invoice	.= $col1.",".$col;
	}else{	 
		$invoice	.= $col1.",".$col;
	}
  }	 
	 
   if($od_type=="Normal"){
	 $invoice	.=searchSingleRecord("tbl_color","color_name","color_id",$od_color_id);
	if($od_size_id!="" && $od_size_id!=0){
	 	$invoice	.=" / ";
	}
	 $invoice	.=searchSingleRecord("tbl_size","s_size","s_id",$od_size_id);
  }
  
  
   $invoice	.=	"&nbsp;</td>
                <td class=\"btmborder\">";
   $invoice	.=	$product_code;
   $invoice	.="</td><td class=\"btmborder\">";
   $discount	=	($discount=="" or $discount==0)?0.00:round(floatval(($product_price*$discount)/100),2);
   //$price	=	floatval($product_price-$discount); 
   $price	=	$od_unit_price;
   
   $invoice	.=	price_format($price);
   $invoice	.="</td><td class=\"btmborder\">$od_qty </td>
                <td class=\"btmborder\">";
   $sub	=	$price*$od_qty;
   $invoice	.= price_format($sub);
   $invoice	.="</td></tr>";
   $total	+=	$sub;
				
				}
  }
              
 $invoice	.="</table><br><table width=\"80%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\"><tr>
                <td height=\"26\" align=\"right\" class=\"grey1\"><strong>Sub Total</strong></td>
                <td width=\"30\" align=\"center\" class=\"grey1\">:</td>
                <td align=\"left\" class=\"grey1\"><strong>";
 $invoice	.=price_format($total);
				
 $invoice	.=" </strong></td></tr>
              <tr><td height=\"26\" align=\"right\" class=\"grey2\"><strong>Shipping Charges:</strong></td><td align=\"center\" class=\"grey2\">:</td>
                <td align=\"left\" class=\"grey2\"><strong>";
// $ship		=	searchSingleRecord("config","conf_value","conf_name","shipping_charges");  
 $ship		=	$shipping_charge;
 $invoice	.= price_format($ship);
 $invoice	.=	"</strong></td></tr>
              <tr>
                <td height=\"26\" align=\"right\" class=\"grey3\"><strong>Grand Total</strong></td>
                <td width=\"30\" align=\"center\" class=\"grey3\">:</td>
                <td align=\"left\" class=\"grey3\"><strong>";
				
$invoice	.=price_format(floatval($total+$ship));
$invoice	.="</strong></td></tr>
            </table><br></td>
          </tr><tr align=\"center\">
            <td colspan=\"2\" valign=\"top\"><table  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\" id=\"wt\">
              <tr>
                <td><table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\"  >
                    <tr>
                      <td width=\"100\" height=\"25\" align=\"center\" bgcolor=\"#FF0000\"><a href=\"Javascript:window.print();\" class=\"wt\"> Print Invoice </a></td>
                    </tr>
                </table></td>
                <td><table width=\"100%\"  border=\"0\" cellpadding=\"0\" cellspacing=\"0\"  >
                    <tr>
                      <td width=\"100\" height=\"25\" align=\"center\" bgcolor=\"#FF0000\"><a href=\"Javascript:window.close()\" class=\"wt\">Close Window </a></td>
                    </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table>
        <br>
    </form></td>
  </tr>
</table>
</body>
</html>
";

$sq		=	"select * from user where u_id='$u_id' ";
$res	=	db_query($sq);
$r		=	mysql_fetch_assoc($res);		
@extract($r);
	 $email_subject =   "Order confirmation Sexyher Online Shop";
	 $body			=	readmyfile("shopping.txt");
	 $body			=	str_replace("{name}",$u_fname." ".$u_lname,$body);
	 $body			=	str_replace('{SITE}',"<b>".SITE_NAME."</b>",$body);
	 $body			=	str_replace('{SITE_PATH}',SITE_WS_PATH,$body);
	 $body			=	str_replace('{ADMIN_EMAIL}',ADMIN_EMAIL,$body);
	 $body			=	nl2br($body);			
   	 $body			=	str_replace('{invoice}',$invoice,$body);
	 sendMail($u_email,$u_fname." ".$u_lname,$email_subject,$body,ADMIN_EMAIL,ADMIN_EMAIL,$html=true);	
	  
}else{
	 return set_session_msg("Order does not exist.");
	}
}

}

function getDressCat($cat_parent=0,$txt='dress',$str){
$sql	="select cat_id from product_category where cat_parent='$cat_parent' And cat_name like '%$txt%' ";

$res	=	db_query($sql);
	if(mysql_num_rows($res)>0){
	  while($row=mysql_fetch_row($res)){
		$str	.=	$row[0].",".getChild($row[0]);		
	  }
	}
	return substr($str,0,-1);
}

function change_order($cat_id,$new_order,$id,$type)
{		
if($type=='faculty')
{
	$table_name = "coaches_faculty";
	$col1       = "faculty_order";
	$col2       = "faculty_id";
	$id_head    = "";
	$id_head_value = "";
}
elseif($type=='product')
{
	$table_name = "product";
	$col1       = "product_order";
	$col2       = "product_id";
	$id_head    = "";
	$id_head_value = "";
}

	$sql = " select $col1 from $table_name where $col2='$id'";
	$order_old=db_scalar($sql);

	if(intval($order_old) > intval($new_order))
	{
		$sql= "select $col1,$col2 from $table_name where $col1 >='$new_order' and $col1<'$order_old'";
		if($id_head_value!='' && $id_head!='') { 
			$sql .= " and $id_head ='$id_head_value' ";
		}
		$sql .= " order by $col1 asc ";
		$result=db_query($sql);
		while($line = mysql_fetch_array($result))
		{
			$orderx = $line[$col1];
			$idx	 = $line[$col2];
			$orderx++;
			$sql_update="update $table_name set $col1='$orderx' where $col2='$idx'";
			db_query($sql_update);
		}
	}
	else
	{
		$sql= "select $col1,$col2 from $table_name where $col1>$order_old  and $col1<=$new_order";
		if($id_head_value!='' && $id_head!='') { 
			$sql .= " and $id_head ='$id_head_value' ";
		}
		$sql .= " order by $col1 asc ";
		$result=db_query($sql);
		while($line = mysql_fetch_array($result))
		{
			$orderx  = $line[$col1];
			$idx	 = $line[$col2];
			$orderx--;
			$sql_update="update $table_name set $col1='$orderx' where $col2='$idx'";
			db_query($sql_update);
		}
	}
	$sql= "update $table_name set $col1='$new_order' where $col2='$id'";
	db_query($sql);
}

function getCatList($word){
  if($word!=""){
	$str	=	"";
	$sql	=	"select cat_id from product_category where cat_name like '%$word%' ";
	$res	=	db_query($sql);
	if(mysql_num_rows($res)>0){
	  while($row=mysql_fetch_row($res)){
	    $str	.=	$row[0].",";
	  }
	  $str	=	substr($str,0,-1);
	}
	 return $str;
  }
}

function UpdateCategory(){
	$str	=   "select cat_id,cat_name,cat_parent  from product_category where status!='D' And status!='N' order by cat_parent";
	$qry1	=	db_query($str);
	$totalRecord=mysql_num_rows($qry1);
	if($totalRecord > 0){
	 $dataVal="d = new dTree('d');
				   d.config.folderLinks=false;
 				   d.config.useIcons=false;
				   d.config.useLines=false;
				   d.config.useSelection=false;
				   d.config.closeSameLevel=true;
				   d.config.useCookies=false;
				   d.add(0,-1,'','');";
     while($r1=mysql_fetch_array($qry1)){
	 @extract($r1);
	   // function(id, pid, name, url, classname, title, target, icon, iconOpen, open)
		 $sql=db_query("select * from product where (product_catid='".$cat_id."' or find_in_set('$cat_id',other_cat)) and status='Y'");	 
		 if(mysql_num_rows($sql)==0){
			$dataVal.="d.add('".$cat_id."', '".$cat_parent."','".count_character($cat_name,18)."','javascript:void(0);','".$cat_name."');";
			$dataVal.="\n";
		 }else{
			$dataVal.="d.add('".$cat_id."', '".$cat_parent."','".count_character($cat_name,18)."','products.php?product_catid=".$cat_id."','".$cat_name."');";
			$dataVal.="\n";
		 }
	  } 		
	  $dataVal.=" document.write(d);";
	$fp = fopen(SITE_FS_PATH."/make.js", "w+");
	fwrite($fp,$dataVal);	
	}
}

function getParent1($catid,$p=''){
$top_level	=	"";
	if($catid!='' or $catid==0){
	    $cat_parent	=	db_scalar("select cat_parent from product_category where cat_id='$catid' And cat_parent!='0'");
        if($cat_parent!="" && $cat_parent!=0){
		 if($p==''){
		  $str	=	getParent1($cat_parent,'')." >> ".searchSingleRecord("product_category","cat_name","cat_id",$catid)."";
		  }else{
		  $str	=	getParent1($cat_parent,'')." >> <a href='products.php?product_catid=".$catid."' class='white'>".searchSingleRecord("product_category","cat_name","cat_id",$catid)."</a>";
		  }
		}else{
		  $str	=	"<a href='products.php?product_catid=".$catid."' class='white' style=' font-size:14px'>".searchSingleRecord("product_category","cat_name","cat_id",$catid)."</a>";
		}  

	}	
$top_level	=	$str;
return $top_level;
}


function getcatFromCatId($id,$p){
	if($id!='' && $id!=0){
	  $x=getParent($id);
	  if($x!=0){ 
	   $parent_name	=	searchSingleRecord("product_category","cat_name","cat_id",$x);
	   return getParent1($id,$p);    }
	   else{
	   return '';
	   }
	 }
}


function findnearest($val,$val_arr){
	if($val!='' && !empty($val_arr)){
	  $diff_arr=array();
	  for($i=0;$i<count($val_arr);$i++){
	      if($val>$val_arr[$i]){
		  	$diff_arr[$i]=abs($val-$val_arr[$i]);
		  }
	  }	
	  if(!empty($diff_arr)){
	    $min	=	min($diff_arr);
		$key	=	array_search($min,$diff_arr);
	    return $val_arr[$key];
	  }
	}
}

function updateStock($order_id){
	if($order_id!='' && $order_id!='0'){
       	$sql_detail	=	"select * from order_detail where od_order_id='$order_id'";
		$res		=	db_query($sql_detail);	
		if(mysql_num_rows($res)>0){
		   $total	=	0;
		   while($row_s=mysql_fetch_array($res)){
				@extract($row_s);
				if($od_type=="Normal"){
				  $update="Update stocks set stock_entry=stock_entry-$od_qty where stock_prod_id='$od_prod_id' And stock_color_id='$od_color_id' And stock_size_id='$od_size_id'";
				  db_query($update);
				}
		   }	
		}   
	}
}

function getStock($prod_id,$color_id){
$stock=0;
 if($prod_id!='' && $prod_id!=0){
  $stock	=	db_scalar("select Sum(stock_entry) from stocks where stock_prod_id='$prod_id' And stock_color_id='$color_id'");
 }
 return $stock;
}

function updateWStock($order_id){
	if($order_id!='' && $order_id!='0'){
       	$sql_detail	=	"select * from tbl_wholesale_order_detail where od_order_id='$order_id'";
		$res		=	db_query($sql_detail);	
		if(mysql_num_rows($res)>0){
		   $total	=	0;
		   while($row_s=mysql_fetch_array($res)){
				@extract($row_s);
				$color_id=db_scalar("select color_id from tbl_color where color_name='$od_color_id'");
                $size=explode('.',$od_size_id);
				$qty=explode('.',$od_qty);	
				if(!empty($size)){
				 for($j=0;$j<count($size);$j++){
				 $size_id=db_scalar("select s_id from tbl_size where s_size='$size[$j]'");
				 if($qty[$j]!=''){
				 $update="Update stocks set stock_entry=stock_entry-$qty[$j] where stock_prod_id='$od_prod_id' And stock_color_id='$color_id' And stock_size_id='$size_id'";
				  db_query($update);
				 }
				 } 
				}  
		   }	
		}   
	}
}

function UpdateCategoryOneLevel(){
	$str	=   "select cat_id,cat_name,cat_parent  from product_category where status!='D' And cat_parent=0 order by cat_parent";
	$qry1	=	db_query($str);
	$totalRecord=mysql_num_rows($qry1);
	if($totalRecord > 0){
	 $dataVal="";
     while($r1=mysql_fetch_array($qry1)){
	 @extract($r1);
	 $sql=db_query("select * from product where (product_catid='".$cat_id."' or find_in_set('$cat_id',other_cat)) and status='Y'");	 
		 if(mysql_num_rows($sql)==0){
			$dataVal.="<strong class='sitemap' title='$cat_name'>".$cat_name."</strong>";
			$dataVal.="<ol>";
		 }else{
			$dataVal.="<a href='products.php?product_catid=".$cat_id."' class='sitemap' title='$cat_name'>$cat_name</a>";
			$dataVal.="<ol>";
		 }	 
	 
	 $sql	=	"select cat_id,cat_name,cat_parent  from product_category where status!='D' And cat_parent='$cat_id' order by cat_order ";
	 $x		=	db_query($sql);
	 if(mysql_num_rows($x)>0){
	    while($row=mysql_fetch_array($x)){
		@extract($row);
		 $sql=db_query("select * from product where (product_catid='".$cat_id."' or find_in_set('$cat_id',other_cat)) and status='Y'");	 
		 if(mysql_num_rows($sql)==0){
			$dataVal.="<li><b title='$cat_name'>".$cat_name."</b></li>";
		////	$dataVal.="<br>";
		 }else{
			$dataVal.="<li><b><a href='products.php?product_catid=".$cat_id."' class=node title='$cat_name'>$cat_name</a></b></li>";
			//$dataVal.="<br>";
		 }
		}
		//$dataVal .="<br>";
	   }
	   	 $dataVal .="</ol>";
	  } 		
	}
	return $dataVal;
}

function extracode(){
?>
<!-- Google Code for purchase Conversion Page -->
<script language="JavaScript" type="text/javascript">
<!--
var google_conversion_id = 1050868089;
var google_conversion_language = "en_GB";
var google_conversion_format = "1";
var google_conversion_color = "FFFFFF";
if (1) {
  var google_conversion_value = 1;
}
var google_conversion_label = "purchase";
//-->
</script>
<script language="JavaScript" src="http://www.googleadservices.com/pagead/conversion.js">
</script>
<noscript>
<img height=1 width=1 border=0 src="http://www.googleadservices.com/pagead/conversion/1050868089/imp.gif?value=1&label=purchase&script=0">
</noscript>

<SCRIPT language="JavaScript" type="text/javascript">
<!-- Yahoo!
window.ysm_customData = new Object();
window.ysm_customData.conversion = "transId=,currency=,amount=";
var ysm_accountid  = "1L8B8RP3JHQOGQ8QFFS8Q8RR2P4";
document.write("<SCR" + "IPT language='JavaScript' type='text/javascript' " 
+ "SRC=//" + "srv3.wa.marketingsolutions.yahoo.com" + "/script/ScriptServlet" + "?aid=" + ysm_accountid 
+ "></SCR" + "IPT>");
// -->
</SCRIPT>
<!-- Pay Pal Tracking code -->
<script Language="JavaScript">

//
// QueryString
//

function QueryString(key)
{
var value = null;
for (var i=0;i<QueryString.keys.length;i++)
{
if (QueryString.keys[i]==key)
{
value = QueryString.values[i];
break;
}
}
return value;
}

QueryString.keys = new Array();
QueryString.values = new Array();

function QueryString_Parse()
{
var query = window.location.search.substring(1);
var pairs = query.split("&");

for (var i=0;i<pairs.length;i++)
{
var pos = pairs[i].indexOf('=');
if (pos >= 0)
{
var argname = pairs[i].substring(0,pos);
var value = pairs[i].substring(pos+1);
QueryString.keys[QueryString.keys.length] = argname;
QueryString.values[QueryString.values.length] = value;
}
}

}

QueryString_Parse();

</script>

<script language="javascript" src="https://scripts.affiliatefuture.com/AFFunctions.js">
var merchantID = 2804;
var orderValue = QueryString("amount");
var orderRef = QueryString("order_id");
var payoutCodes = '';
var offlineCode = '';

AFProcessSaleV2(merchantID, orderValue,
orderRef,payoutCodes,offlineCode);
</script>
<?php
}


///////////function for wholesale cart
function ADD_WCART($product_id,$color_id,$size_id,$Qty)
{
     $basket=array();
     if(count($_SESSION[WCart1])>0)
     {
          foreach($_SESSION[WCart1] as $key=>$value)
          {
               $basket[]=$value["product_id"]."~".$value["color_id"];
          // $basket[]=;
          }
		  $x	=	$product_id."~".$color_id;
          if(in_array($x,$basket))
          {
          //print_r($basket);
          //echo $Connection_id;
          ///exit();     
          }
          else
          {
		 		  
               $_SESSION[WCart1][]=array('product_id'=>$product_id,'color_id'=>$color_id,'size_id'=>$size_id,"Quantity"=>$Qty);
          }
     }
     else
     {
     $_SESSION[WCart1][]=array('product_id'=>$product_id,'color_id'=>$color_id,'size_id'=>$size_id,"Quantity"=>$Qty);
     }
}

function View_WCart()
{
     echo "<pre>";
     print_r($_SESSION[WCart1]);
}
function WCount_Array()
{
     return count($_SESSION[WCart]);
}
function RemoveAndRepairWCart($x)
{
     $Cart_new = $_SESSION['WCart1'];
     unset($Cart_new[$x]);
     $new_Cart = array();
     foreach ($Cart_new as $key1=>$val1)
     {
          $new_Cart[]=$val1; 
     }     
     $_SESSION['WCart1']=$new_Cart;
}
function getWCartTotalAmount()
{
     $total_amount=0.0;
    
	foreach($_SESSION[WCart1] as $item)
		{
			if(is_array($item))
			{
			 $coaches_order_details_price=$item["Price"];
			 $Quantity=$item["Quantity"];
			 $amount=$Price*$Quantity;
			 $total_amount+=$amount;
			}	 
		}     
	return 	$total_amount;
}
function Empty_wcart()
{
     $Cart_new = $_SESSION['WCart1'];
     unset($Cart_new);
     $new_Cart = array();
     /*foreach($Cart_new as $key1=>$val1)
     {
          $new_Cart[]=$val1; 
     } */    
     $_SESSION['WCart1']=$new_Cart;
}

function fetchRecArr($table,$field1,$condition){
$row_arr	=	array();
  if($table!="" && $field1!=""){
	$query_res =	db_query("select $field1 from $table where $condition");
	 if(mysql_num_rows($query_res)==1){
		$row_arr=mysql_fetch_assoc($query_res);
	  }
  }
 return $row_arr; 
}

function selectprice($prod_id,$qty){
  if($qty>5)	{
    $price	=	searchSingleRecord("product","product_price2","product_id",$prod_id);
  }else{
    $price	=	searchSingleRecord("product","product_price","product_id",$prod_id);
  }
  return $price;
}


function getAutoincrement($tablename){
$inc=1;
$query	=	db_query("SHOW TABLE STATUS LIKE '$tablename'");
	if(mysql_num_rows($query)==1){
	  $row=mysql_fetch_assoc($query);
	  $inc=$row['Auto_increment'];
	}
  return $inc;	
}




function sendWInvoiceEmail($order_id,$u_id,$config_size,$config_sizearr){

if($order_id!=""){
$sql	=	"select t1.*,t2.* from `tbl_wholesale_order` t1, tbl_wholesaler t2 where t2.w_id=t1.order_seller_id And t1.order_id='$order_id' ";
$result	=	db_query($sql);
	if(mysql_num_rows($result)>0){
	  $row=mysql_fetch_assoc($result);
	  @extract($row);
	
$invoice	=	"<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\"
\"http://www.w3.org/TR/html4/loose.dtd\">
<html>
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=iso-8859-1\">
<title>Guangzhou Smart Apparel Co.</title>
<link href=\"".SITE_WS_PATH."/style.css\" rel=\"stylesheet\" type=\"text/css\">
</head>

<body>
<table width=\"883\"  border=\"0\" align=\"center\" cellpadding=\"0\" cellspacing=\"0\">
  <tr background=\"".SITE_WS_PATH."/images/titlebg.gif\">
    <td align=\"left\" nowrap background=\"".SITE_WS_PATH."/images/titlebg.gif\"><table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
        <tr>
          <td nowrap><table  border=\"0\" cellpadding=\"0\" cellspacing=\"0\" bordercolor=\"#ECE9D8\">
            <tr>
              <td nowrap background=\"".SITE_WS_PATH."/images/textbg.gif\"><img src=\"".SITE_WS_PATH."/images/title-lt.gif\" width=\"17\" height=\"18\" align=\"absmiddle\"><span class=\"pagetitle\">Invoice</span></td>
              <td background=\"".SITE_WS_PATH."/images/titlebg.gif\"><img src=\"".SITE_WS_PATH."/images/title-lt2.gif\" width=\"8\" height=\"18\"></td>
            </tr>
          </table></td>
          <td background=\"".SITE_WS_PATH."\images/titlebg.gif\">&nbsp;</td>
        </tr>
    </table></td>
    <td align=\"right\" background=\"".SITE_WS_PATH."/images/titlebg.gif\"><img src=\"".SITE_WS_PATH."/images/title-rt.gif\" width=\"8\" height=\"18\"></td>
  </tr>
  <tr>
    <td colspan=\"2\" background=\"".SITE_WS_PATH."/images/table2.jpg\" class=\"tile-brdr\" style=\"background-repeat:repeat-x \">
        <br>
        <TABLE width=\"100%\" border=0 align=center cellPadding=0 cellSpacing=0>
          <TBODY>
            <TR>
              <TD><TABLE cellSpacing=0 cellPadding=0 width=\"100%\" align=center border=0>
                  <TBODY>
                    <TR>
                      <TD width=\"55%\"><span class=\"greenb\"><strong>Guangzhou Smart Apparel Co., Ltd</strong> </STRONG></span><BR>
                                          <span class=\"white\">#8 Fuyi Road<BR>
                Chadong Shiji Panyu<BR>
                Guangzhou 511450<BR>
                Guangdong China</span></STRONG></TD>
                      <TD width=\"45%\"><img src=\"".SITE_WS_PATH."/images/logo.jpg\" width=\"449\" height=61></TD>
                    </TR>
                    <TR>
                      <TD colspan=\"2\" vAlign=top><table width=\"100%\"  border=\"0\" cellpadding=\"2\" cellspacing=\"2\" summary=\"\">
                          <tr valign=\"top\" >
                            <td width=\"97%\" height=\"20\" colspan=\"2\" align=\"left\" valign=\"middle\" class=\"litebg\" ><strong class=\"greenb\">Your Details</strong></td>
</tr><tr><td valign=\"top\" class=\"white\"><strong class=\"white\"> Address</strong><br />";
  $invoice	.=get_wholesaler($w_id);
  $invoice	.="<br />";
  $invoice	.=($w_address1!="")?$w_address1."<br>":"";
  $invoice	.=($w_address2!="")?$w_address2."<br>":"";
  $invoice	.=$w_city;
  $invoice	.="&nbsp;&nbsp;".$w_state;
  $invoice	.=	"<br>".$w_zipcode;
  $invoice	.=	"<br>".getCountryName($w_country)."</td><td valign=\"top\" class=\"white\"><strong class=\"white\">Delivery Address</strong><br />".get_wholesaler($w_id)."<br />";
  $invoice	.=($w_bil_address1!="")?$w_bil_address1."<br>":"";
  $invoice	.=($w_bil_address2!="")?$w_bil_address2."<br>":"";
  $invoice	.=$w_bil_city;
  $invoice	.="&nbsp;&nbsp;".$w_bil_state;
  $invoice	.=	"<br>".$w_bil_zipcode;
  $invoice	.=	"<br>".getCountryName($w_bil_country)."</td>
                          </tr>
                      </table></TD>
                    </TR>
                    <TR>
                      <TD colSpan=2><HR SIZE=1>
                      </TD>
                    </TR>
                    <TR>
                      <TD><span class=\"details\">Invoice Date :</span> <span class=\"white\"> : ".date_format1($order_date)."</span></TD>
                      <TD><span class=\"details\"><B>Invoice Number</B> :</span> <span class=\"white\"> : ".$order_invoice_number."</span></TD>
                    </TR>
                    <TR>
                      <TD colSpan=2><HR SIZE=1>
                      </TD>
                    </TR>
                    <TR>
                      <TD colSpan=2>&nbsp;</TD>
                    </TR>
                  </TBODY>
                </TABLE>
                  <TABLE cellSpacing=0 cellPadding=0 width=\"100%\" border=0>
                    <TBODY>
                      <TR>
                        <TD><table width=\"100%\"  border=\"0\" cellpadding=\"2\" cellspacing=\"2\" summary=\"\">
                            <tr valign=\"top\" >
                              <td height=\"20\" align=\"left\" valign=\"middle\" class=\"litebg\" ><strong class=\"greenb\">Product Details</strong></td></tr><tr><td valign=\"top\"><table width=\"100%\"  border=\"0\" cellpadding=\"2\" cellspacing=\"2\">";
$sql_detail	=	"select t1.*,t2.* from `tbl_wholesale_order_detail` t1, product t2 where t2.product_id=t1.od_prod_id And t1.od_order_id='$order_id'";
$res		=	db_query($sql_detail);
if(mysql_num_rows($res)>0)		{   $total	=	0;
$invoice	.="<tr align=\"left\" class=\"litebg red\">
                                                  <td width=\"9%\" height=\"25\" valign=\"top\" class=\"details\">Item Code</td>
                                                  <td width=\"9%\" valign=\"top\" class=\"details\">Item Name & Color</td>                                                
                                                  <td width=\"38%\" align=\"center\" valign=\"top\" class=\"details\">size/QTY</td>
                                                  <td width=\"12%\" align=\"center\" valign=\"top\" class=\"details\">Total  Qty.</td>
												  <td width=\"12%\" valign=\"top\" class=\"details\"><strong>Price
												  (USA
												  ".$config_size."
												  )</strong>												  </td>
                                                  <td width=\"9%\" align=\"center\" valign=\"top\" class=\"details\">Price</td>
                                                  <td width=\"11%\" align=\"center\" valign=\"top\" class=\"details\">Amount</td>
                                                
                                                </tr>
                  ";
				   while($row_s=mysql_fetch_array($res)){
					     @extract($row_s);
						 
						 $x	=	explode('.',$od_qty);
						 $tot=0; 
					     $tot1=0;
						 $tot2=0;
						 if(!empty($x)){
						   $qty	=	array_sum($x);
						   $price	=	selectprice($od_prod_id,$qty);
						 }	
$invoice	.="<tr align=\"left\"><td height=\"20\" valign=\"top\" class=\"btmborderw\">".$product_code."</td><td valign=\"top\" class=\"btmborderw\">".$product_name."<br>
                                                  (".$od_color_id.")</td>
                                                  <td class=\"btmborderw\"><table width=\"100%\" border=\"0\" cellpadding=\"1\" cellspacing=\"1\">";
                     $size=explode('.',$od_size_id);
					   if(!empty($size)){
$invoice	.="<tr align=\"center\"><td align=\"left\" class=\"txtfield grey1\"><strong>Size</strong></td>";
 for($j=0;$j<count($size);$j++){
 $invoice	.="<td class=\"txtfield grey1\">".$size[$j]."</td>";
	if(in_array($size[$j],$config_sizearr)){
		$f_arr[]=$j;						
	 }
							 }
$invoice	.="</tr>";
						 }							  
     if(!empty($x)){
$invoice	."<tr align=\"center\"><td align=\"left\" class=\"txtfield grey1\"><strong>qty</strong></td>";
 	$z	=	count($x);
	for($j=0;$j<$z;$j++){
$invoice	.="<td class=\"txtfield grey1\">".$x[$j]."</td>";
 if(!empty($f_arr)){
   if(!in_array($j,$f_arr)){
	 $tot1 +=$x[$j];
   }else{
	 $tot2 +=$x[$j];
   } 
}else{
  $tot1 += $x[$j];
}
}                    
$invoice	.="</tr>";
}
$sub	=	floatval($tot2*$od_usaprice+$tot1*$od_unit_price);
$invoice	.="</table></td>
<td align=\"center\" valign=\"bottom\" class=\"btmborderw\">".$qty."</td>
<td valign=\"bottom\" class=\"btmborderw\">".price_format($od_usaprice)."</td>
<td valign=\"bottom\" class=\"btmborderw\">".price_format($od_unit_price)."</td>
<td valign=\"bottom\" class=\"btmborderw\">".price_format($sub)."</td></tr>";
$total	+=	$sub;
}
}
$invoice	.="</table><br><table width=\"80%\"  border=\"0\" align=\"center\" cellpadding=\"2\" cellspacing=\"2\"><tr><td height=\"26\" align=\"right\" class=\"grey1\"><strong>Sub Total</strong></td><td width=\"30\" align=\"center\" class=\"grey1\">:</td><td align=\"left\" class=\"grey1\"><strong>".price_format($total)."</strong></td></tr><tr><td height=\"26\" align=\"right\" class=\"grey2\"><strong>Shipping Charges:</strong></td>
<td align=\"center\" class=\"grey2\">:</td>
<td align=\"left\" class=\"grey2\"><strong>";
$ship	=	$order_shipping_charge;
$invoice	.=price_format($ship)."</strong></td></tr><tr><td height=\"26\" align=\"right\" class=\"grey3\"><strong>Grand Total</strong></td><td width=\"30\" align=\"center\" class=\"grey3\">:</td><td align=\"left\" class=\"grey3\"><strong>".price_format(floatval($total+$ship))."</strong></td></tr></table><br></td></tr></table></TD></TR>
</TBODY></TABLE><B></B></TD></TR></TBODY></TABLE><br>
<table  border=\"0\" align=\"center\" cellpadding=\"3\" cellspacing=\"3\" id=\"wt\">
<tr align=\"center\"><td width=\"150\" align=\"left\" class=\"button\"><a href=\"Javascript:window.print();\" class=\"btntxt\">Print Invoice</a></td>
<td width=\"20\">&nbsp;</td><td width=\"150\" align=\"left\" class=\"button\"><a href=\"Javascript:window.close()\" class=\"btntxt\">Close Window</a></td></tr></table></form></td>
</tr></table></body></html>";

$sq		=	"select * from tbl_wholesaler where w_id='$w_id' ";
$res	=	db_query($sq);
$r		=	mysql_fetch_assoc($res);		
@extract($r);

	 $body			=	readmyfile("shopping.txt");
	 $body			=	str_replace("{name}",ucwords($w_fname." ".$w_lname),$body);
	 $body			=	str_replace('{SITE}',"<b>".SITE_NAME."</b>",$body);
	 $body			=	str_replace('{SITE_PATH}',SITE_WS_PATH,$body);
	 $body			=	nl2br($body);			
     $body		    =	str_replace('{invoice}',$invoice,$body);
	 sendMail($w_email,ucwords($w_fname." ".$w_lname),"Guangzhou Order Placement Mail",$body,ADMIN_EMAIL,ADMIN_EMAIL,$html=true);

	 
	 $body			=	readmyfile(SITE_WS_PATH."/includes/email/admin_mail1.txt");
	 $body			=	str_replace('{SITE}',"<b>".SITE_NAME."</b>",$body);
	 $body			=	str_replace('{member}',ucwords($w_fname." ".$w_lname),$body);
	 $body			=	str_replace('{order_number}',$order_invoice_number,$body);
	 $body			=	str_replace('{order_date}',$order_date,$body);
	 $body			=	str_replace('{SITE_PATH}',SITE_WS_PATH,$body);
	 $body			=	str_replace('{ADMIN_EMAIL}',ADMIN_EMAIL,$body);
	 $body			= 	nl2br($body);	
	 $email_subject =	"Guangzhou New Order Placement Mail "; 		
   	 sendMail(ADMIN_EMAIL,"Administrator",$email_subject,$body,ADMIN_EMAIL,ADMIN_EMAIL,$html=true);		 
	 
}else{
	 return set_session_msg("Order does not exist.");
	}
}

}


function fetch_data($unique_id, $submiturl, $data) 
{
	// get data ready for API
	//$tempstr = $_POST['AMT'].date('YmdGis'); 
	$request_id = md5($unique_id); //echo "Request ID:".$request_id.'<br>';
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	// Here's your custom headers; adjust appropriately for your setup:
	$headers[] = "Content-Type: text/namevalue"; //or maybe text/xml
	$headers[] = "X-VPS-Timeout: 15";
	$headers[] = "X-VPS-VIT-OS-Name: Linux";  // Name of your OS
	$headers[] = "X-VPS-VIT-OS-Version: RHEL 4";  // OS Version
	$headers[] = "X-VPS-VIT-Client-Type: PHP/cURL";  // What you are using
	$headers[] = "X-VPS-VIT-Client-Version: 0.01";  // For your info
	$headers[] = "X-VPS-VIT-Client-Architecture: x86";  // For your info
	$headers[] = "X-VPS-VIT-Client-Certification-Id: 13abb2433ff2923d7b191d2d011b7fde";
	$headers[] = "X-VPS-VIT-Integration-Product: PHPv4::cURL";  // For your info, would populate with application name
	$headers[] = "X-VPS-VIT-Integration-Version: 0.01"; // Application version
	$headers[] = "X-VPS-Request-ID: " . $request_id;

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $submiturl);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_HEADER, 1); // tells curl to include headers in response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
	curl_setopt($ch, CURLOPT_TIMEOUT, 90); // times out after 90 secs
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // this line makes it work under https
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //adding POST data
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2); //verifies ssl certificate
	curl_setopt($ch, CURLOPT_FORBID_REUSE, TRUE); //forces closure of connection when done 
	curl_setopt($ch, CURLOPT_POST, 1); //data sent as POST 
							
	$result = curl_exec($ch);
	$headers = curl_getinfo($ch);
	curl_close($ch);
	$result = strstr($result, "RESULT");
	// prepare responses into array
 	$proArray = array();
	while(strlen($result)){
		// name
		$keypos= strpos($result,'=');
		$keyval = substr($result,0,$keypos);
		// value
		$valuepos = strpos($result,'&') ? strpos($result,'&'): strlen($result);
		$valval = substr($result,$keypos+1,$valuepos-$keypos-1);
		// decoding the respose
		$proArray[$keyval] = $valval;
		$result = substr($result,$valuepos+1,strlen($result));
	}
   
   //$t_i	=	db_scalar("select max(temp_id)+1 from `order`");
   //$proArray['INVNUM']	=	$t_i;
    $proArray['INVNUM']	=	$unique_id; 
	return $proArray;
}	 

function error_handle($nvp) 
{
	$error= '<h2>Error!</h2><p>We were unable to process your order.</p>';
//	echo '<p>Error '.$nvp['RESULT'].': '.$nvp['RESPMSG'].'.</p>';
	$error	.='<p>Error : '.$nvp['RESPMSG'].'.</p>';

	while (list($key, $val) = each($nvp)) {
//		echo "\n" . $key . ": " . $val . "\n<br>";
		//echo "\n" . $key . ": " . $val . "\n<br>";
	}		  
	return $error;
}

function fetch_wdata($unique_id, $submiturl, $data) 
{
	// get data ready for API
	//$tempstr = $_POST['AMT'].date('YmdGis'); 
	$request_id = md5($unique_id); //echo "Request ID:".$request_id.'<br>';
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	// Here's your custom headers; adjust appropriately for your setup:
	$headers[] = "Content-Type: text/namevalue"; //or maybe text/xml
	$headers[] = "X-VPS-Timeout: 15";
	$headers[] = "X-VPS-VIT-OS-Name: Linux";  // Name of your OS
	$headers[] = "X-VPS-VIT-OS-Version: RHEL 4";  // OS Version
	$headers[] = "X-VPS-VIT-Client-Type: PHP/cURL";  // What you are using
	$headers[] = "X-VPS-VIT-Client-Version: 0.01";  // For your info
	$headers[] = "X-VPS-VIT-Client-Architecture: x86";  // For your info
	$headers[] = "X-VPS-VIT-Client-Certification-Id: 13abb2433ff2923d7b191d2d011b7fde";
	$headers[] = "X-VPS-VIT-Integration-Product: PHPv4::cURL";  // For your info, would populate with application name
	$headers[] = "X-VPS-VIT-Integration-Version: 0.01"; // Application version
	$headers[] = "X-VPS-Request-ID: " . $request_id;

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $submiturl);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_HEADER, 1); // tells curl to include headers in response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
	curl_setopt($ch, CURLOPT_TIMEOUT, 90); // times out after 90 secs
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // this line makes it work under https
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //adding POST data
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2); //verifies ssl certificate
	curl_setopt($ch, CURLOPT_FORBID_REUSE, TRUE); //forces closure of connection when done 
	curl_setopt($ch, CURLOPT_POST, 1); //data sent as POST 
							
	$result = curl_exec($ch);
	$headers = curl_getinfo($ch);
	curl_close($ch);
	$result = strstr($result, "RESULT");
	// prepare responses into array
 	$proArray = array();
	while(strlen($result)){
		// name
		$keypos= strpos($result,'=');
		$keyval = substr($result,0,$keypos);
		// value
		$valuepos = strpos($result,'&') ? strpos($result,'&'): strlen($result);
		$valval = substr($result,$keypos+1,$valuepos-$keypos-1);
		// decoding the respose
		$proArray[$keyval] = $valval;
		$result = substr($result,$valuepos+1,strlen($result));
	}
   
   $t_i	=	db_scalar("select order_invoice_number from `tbl_wholesale_order` where order_id='$unique_id' ");
   $proArray['INVNUM']	=	$t_i;
   // $proArray['INVNUM']	=	$unique_id; 
	return $proArray;
}	 

function fetch_mdata($unique_id, $submiturl, $data) 
{
	// get data ready for API
	//$tempstr = $_POST['AMT'].date('YmdGis'); 
	$request_id = md5($unique_id); //echo "Request ID:".$request_id.'<br>';
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	// Here's your custom headers; adjust appropriately for your setup:
	$headers[] = "Content-Type: text/namevalue"; //or maybe text/xml
	$headers[] = "X-VPS-Timeout: 15";
	$headers[] = "X-VPS-VIT-OS-Name: Linux";  // Name of your OS
	$headers[] = "X-VPS-VIT-OS-Version: RHEL 4";  // OS Version
	$headers[] = "X-VPS-VIT-Client-Type: PHP/cURL";  // What you are using
	$headers[] = "X-VPS-VIT-Client-Version: 0.01";  // For your info
	$headers[] = "X-VPS-VIT-Client-Architecture: x86";  // For your info
	$headers[] = "X-VPS-VIT-Client-Certification-Id: 13abb2433ff2923d7b191d2d011b7fde";
	$headers[] = "X-VPS-VIT-Integration-Product: PHPv4::cURL";  // For your info, would populate with application name
	$headers[] = "X-VPS-VIT-Integration-Version: 0.01"; // Application version
	$headers[] = "X-VPS-Request-ID: " . $request_id;

	$ch = curl_init(); 
	curl_setopt($ch, CURLOPT_URL, $submiturl);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
	curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
	curl_setopt($ch, CURLOPT_HEADER, 1); // tells curl to include headers in response
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // return into a variable
	curl_setopt($ch, CURLOPT_TIMEOUT, 90); // times out after 90 secs
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // this line makes it work under https
	curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //adding POST data
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2); //verifies ssl certificate
	curl_setopt($ch, CURLOPT_FORBID_REUSE, TRUE); //forces closure of connection when done 
	curl_setopt($ch, CURLOPT_POST, 1); //data sent as POST 
							
	$result = curl_exec($ch);
	$headers = curl_getinfo($ch);
	curl_close($ch);
	$result = strstr($result, "RESULT");
	// prepare responses into array
 	$proArray = array();
	while(strlen($result)){
		// name
		$keypos= strpos($result,'=');
		$keyval = substr($result,0,$keypos);
		// value
		$valuepos = strpos($result,'&') ? strpos($result,'&'): strlen($result);
		$valval = substr($result,$keypos+1,$valuepos-$keypos-1);
		// decoding the respose
		$proArray[$keyval] = $valval;
		$result = substr($result,$valuepos+1,strlen($result));
	}
   
   $t_i	=	db_scalar("select m_order_num from `manual_order` where m_order_id='$unique_id' ");
   $proArray['INVNUM']	=	$t_i;
   // $proArray['INVNUM']	=	$unique_id; 
	return $proArray;
}

function topMostCat($cat_id){
$x		=	'';
$parent	=	db_scalar("select cat_parent from product_category where cat_id='$cat_id'");
if($parent!='0'){
  $x	=	topMostCat($parent);
}else{
  $x	=	$cat_id;
}
return $x;
}

function getProductListbox($name,$sel,$extra,$choose){
$arr	=	array();
$str	=	'';
$sql	=	db_query("select product_id,product_name,product_catid from product where status='Y'");
if(mysql_num_rows($sql)>0){
  while($row=mysql_fetch_array($sql)){
    @extract($row);
	$top	=	topMostCat($product_catid);
    $arr[$product_id]=$product_name." (".db_scalar("select cat_name from product_category where cat_id='$top'").")";
  }
  $str=array_dropdown($arr,$sel, $name, $extra, $choose,array());
} 
return $str;
}


function getColorName($code){
	if($code!=''){
	   $color_name=db_scalar("select color_name from tbl_color where color_code='$code'");
	   return $color_name;
	}

}

function getCartProdPrice($qty,$price,$size,$type){
$p1=$price;
$config_size=searchSingleRecord("config","config_value","config_id",5);
$arr=explode(',',$config_size);
 if($type=='' && in_array($size,$arr)){ 
  $sql=db_query("SELECT * FROM `tbl_pricing` WHERE sp_min_piece<=$qty And sp_max_piece>='$qty'");
	if(mysql_num_rows($sql)>0){
	  $ro=mysql_fetch_assoc($sql);
	  @extract($ro);
	    $x=round(($p1*$sp_percent)/100,2);
	    if(strtolower($sp_action)=='add'){
		  $price	=	round($p1+$x,2);
		}elseif(strtolower($sp_action)=='subtract'){
  		  $price	=	round($p1-$x,2);
		}elseif(strtolower($sp_action)=='multiply'){
  		  $price	=	round($p1*$x,2);
		}elseif(strtolower($sp_action)=='divide'){
 		  $price	=	round($p1/$x,2);
		}
	}

     $s=db_query("select config_value,config_unit from config where config_id='6'");
	 if(mysql_num_rows($s)>0){
	   $r=mysql_fetch_assoc($s); 
	   @extract($r);
	    if(strtolower($config_unit)=='add'){
		  $price	=	round($price + round(($price*$config_value)/100,2),2);
		}elseif(strtolower($config_unit)=='subtract'){
  		  $price	=	round($price-round(($price*$config_value)/100,2),2);
		}elseif(strtolower($config_unit)=='multiply'){
  		  $price	=	round($price * round(($price*$config_value)/100,2),2);
		}elseif(strtolower($config_unit)=='divide'){
 		  $price	=	round($price/round(($price*$config_value)/100,2),2);
		}
	 }
	//$price=round($price+$price1,2);	 		
  }else{
    $sql=db_query("SELECT * FROM `tbl_pricing` WHERE sp_min_piece<='$qty' And sp_max_piece>='$qty'");
	if(mysql_num_rows($sql)>0){
	  $ro=mysql_fetch_assoc($sql);
	  @extract($ro);
	    if(strtolower($sp_action)=='add'){
		  $price	=	round($price+round(($price*$sp_percent)/100,2),2);
		}elseif(strtolower($sp_action)=='subtract'){
  		  $price	=	round($price-round(($price*$sp_percent)/100,2),2);
		}elseif(strtolower($sp_action)=='multiply'){
  		  $price	=	round($price*round(($price*$sp_percent)/100,2),2);
		}elseif(strtolower($sp_action)=='divide'){
 		  $price	=	round($price/round(($price*$sp_percent)/100,2),2);
		}
	}
  }
 return round($price,2);
}

function getProductSize($size,$type){
 if($size!=""){
 $str	=	"";
 $arr	=	array();
 	 $sql = "select s_size from tbl_size  where 1 And s_id In ($size) order by s_size asc";
	 $res =  db_query($sql);	
	 if(mysql_num_rows($res)>0){
	   while($r=mysql_fetch_row($res)){	      
		  if($type!=''){
			   $s=db_query("select config_value,config_unit from config where config_id='$type'");
			   if(mysql_num_rows($s)>0){
			     $ro=mysql_fetch_assoc($s);
				 @extract($ro);
				  if(strtolower($config_unit)=='add'){
				    $arr[]	=	$r[0]+$config_value;;
				  }elseif(strtolower($config_unit)=='subtract'){
				    $arr[]	=	$r[0]-$config_value;;
				  }elseif(strtolower($config_unit)=='multiply'){
				    $arr[]	=	$r[0]*$config_value;;
				  }elseif(strtolower($config_unit)=='divide'){
				    $arr[]	=	$r[0]/$config_value;;
				  }
			   }else{
	     		  $arr[]	=	$r[0];
			   }
		  }else{
		  $arr[]	=	$r[0];
		  }
	      //$str	.=	$r[0].",";
		}
		asort($arr);
		reset($arr);
		$str	=	implode(',',$arr);
	   //$str	=	substr($str,0,-1);	
	 }
 	 return $str;	 
  }
}

function getSingleProductSize($size,$type){
 if($size!=""){       
		  if($type!=''){
			   $s=db_query("select config_value,config_unit from config where config_id='$type'");
			   if(mysql_num_rows($s)>0){
			     $ro=mysql_fetch_assoc($s);
				 @extract($ro);
				  if(strtolower($config_unit)=='add'){
				    $size	=	$size+$config_value;;
				  }elseif(strtolower($config_unit)=='subtract'){
				    $size	=	$size-$config_value;;
				  }elseif(strtolower($config_unit)=='multiply'){
				    $size	=	$size*$config_value;;
				  }elseif(strtolower($config_unit)=='divide'){
				    $size	=	$size/$config_value;;
				  }
			   }
		  }
	 return $size;	 
  }
}

function getProductSizeArr($size,$type){
 if($size!=""){
 $arr	=	array();
 	 $sql = "select s_size,s_id from tbl_size  where 1 And s_id In ($size) order by s_size asc";
	 $res =  db_query($sql);	
	 if(mysql_num_rows($res)>0){
	   while($r=mysql_fetch_row($res)){	      
		  if($type!=''){
			   $s=db_query("select config_value,config_unit from config where config_id='$type'");
			   if(mysql_num_rows($s)>0){
			     $ro=mysql_fetch_assoc($s);
				 @extract($ro);
				  if(strtolower($config_unit)=='add'){
				    $arr[$r[1]]	=	$r[0]+$config_value;;
				  }elseif(strtolower($config_unit)=='subtract'){
				    $arr[$r[1]]	=	$r[0]-$config_value;;
				  }elseif(strtolower($config_unit)=='multiply'){
				    $arr[$r[1]]	=	$r[0]*$config_value;;
				  }elseif(strtolower($config_unit)=='divide'){
				    $arr[$r[1]]	=	$r[0]/$config_value;;
				  }
			   }else{
	     		  $arr[$r[1]]	=	$r[0];
			   }
		  }else{
		  $arr[$r[1]]	=	$r[0];
		  }
	      //$str	.=	$r[0].",";
		}
		asort($arr);
		reset($arr);
	   //$str	=	substr($str,0,-1);	
	 }
 	 return $arr;	 
  }
}

function TotalPriceByWeight($weight,$sc_type,$sc_country_type){
$arr=array('1'=>'USA & Canada','2'=>'Western EU','3'=>'Middle East, Africa & Non Western EU','4'=>'Oceania','5'=>'Singapore','6'=>'Other');
$sc_country_type=$arr[$sc_country_type];

$base_weight=db_scalar("select sc_weight from tbl_shipping_charge where sc_type='$sc_type' And sc_country_type='$sc_country_type'");
  if($weight!='' && $sc_type!=''){
    $weight= floatval($weight/1000);
	if($base_weight>=$weight){
	$def=searchSingleRecord("config","config_value","config_id",4);
	  if($def!='' && $def!=0){
	      $price=db_scalar("select sc_price1 from tbl_shipping_charge where sc_type='$sc_type' And sc_country_type='$sc_country_type'");
		  if($def<$weight){
		    $weight=$weight-$def;
			$mult= ceil($weight/$def);
			$p=db_scalar("select sc_price2 from tbl_shipping_charge where sc_type='$sc_type' And sc_country_type='$sc_country_type'");
			$price2=floatval($p*$mult);
			$price = round($price+$price2,2);
		  }
	  }	  
	}else{
	  	$p=db_scalar("select sc_price3 from tbl_shipping_charge where sc_type='$sc_type' And sc_country_type='$sc_country_type'");
		$price=round(floatval($p*$weight),2);
	} 
  }else{
    $price=0.00;
  }
  return $price;
}

function getTitle($page_id){
  if($page_id!='' && $page_id!=0){
   $text	=	db_scalar("select static_title from static_content where static_id='$page_id'");
  }else{
   $text="&nbsp;";
  }
  return $text;
}
///////////end of function for wholesale cart

function secureValue($v) {
	if(filter_var($v, FILTER_VALIDATE_EMAIL)){
	     header("error/404.html"); 
		 exit();
	}
	
	
	$v = preg_replace('~<\s*\bscript\b[^>]*>(.*?)<\s*\/\s*script\s*>~is', '', $v);
	$v = htmlspecialchars(stripslashes(strip_tags($v)),ENT_QUOTES);
	$v = str_ireplace('<script', '<blocked', $v);
//	return mysql_escape_string($v);
	return $v;
}

function secureUrl($url) {
	$l = strlen($url);
	if(0<$l) {
		for($i = 0; $i < $l; $i++) {
			if(strpos("/:@&%=?.#", $url[$i]) === false)
				$url[$i] = urlencode($url[$i]);
		}
		$url = str_replace(array('%3C','%3E'), array('<','>'), $url);
		$url = strip_tags($url);
	}
	return $url;
}
?>