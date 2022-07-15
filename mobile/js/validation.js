function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}
 // validation for e-mail
function check_validchar(pattern,str)
{
  var re = new RegExp(pattern,"g");
  var arr = re.exec(str);
  return arr;
}

function isEmailAddr(email)
{
  var regExp	=	/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;  
  return regExp.test(email);
}
function isValidusername(email)
{
  var regExp	=	/^([a-zA-Z0-9])+$/;  
  return regExp.test(email);
}



// this function used to check valid chars
function check_validchar(pattern,str)
{
  var re = new RegExp(pattern,"g");
  var arr = re.test(str);
  return arr;
}  

function check_confirm(type){
	if(!confirm("Are you sure you want to delete this "+type+".")){
			   return false;
	 }else{
				return true;
	 }
}


function Trim(s) 
{
  // Remove leading spaces and carriage returns
  
  while ((s.substring(0,1) == ' ') || (s.substring(0,1) == '\n') || (s.substring(0,1) == '\r'))
  {
    s = s.substring(1,s.length);
  }

  // Remove trailing spaces and carriage returns

  while ((s.substring(s.length-1,s.length) == ' ') || (s.substring(s.length-1,s.length) == '\n') || (s.substring(s.length-1,s.length) == '\r'))
  {
    s = s.substring(0,s.length-1);
  }
  return s;
}


// get element value after removing leading and trailing spaces
function RemoveLTSpace(elemval)
{
     var val=elemval.replace(/\s*/,"")
     var val=val.replace(/\s*$/,"")
     return val;
}
function JSvalid_form(formnm)
{
formnm=eval(formnm);
for(var i=0;i<formnm.elements.length;i++)
     {
if(formnm.elements[i].alt){
// START CHECK FOR BLANK
var altval=formnm.elements[i].alt;
var altval1=altval.split("~DM~");
if(altval1[0]=="BC" && RemoveLTSpace(formnm.elements[i].value)=="")
          {
          formnm.elements[i].value=RemoveLTSpace(formnm.elements[i].value);
          alert("Please enter "+altval1[1]);
          formnm.elements[i].focus();
          return false;
          }
// END CHECK FOR BLANK
// VALID CHAR CHECK
if(altval1[2]!="" && formnm.elements[i].value!="")
     {
var re1 = new RegExp ('&q', 'g') ;
var pattern_val = altval1[2].replace(re1,'"') ;
var pattern="["+pattern_val+"]";
var re = new RegExp(pattern,"g");
if(re.test(formnm.elements[i].value)==true)
          {
          alert("Please avoid to enter \""+pattern_val+"\" in "+altval1[1]);
          formnm.elements[i].focus();
          formnm.elements[i].select();
          return false;
          }
     }
//START EMAIL CHECK
if(altval1[0]=="EMC")
{
if(altval1[3]!="NBC")
{
  if (formnm.elements[i].value == "")
  {
    alert("Please enter a valid email id for \"email\" field.");
    formnm.elements[i].focus();
    return (false);
  }
}
if (formnm.elements[i].value != "")
{
  if (!isEmailAddr(formnm.elements[i].value))
  {
    alert("Please enter a complete email address in the form: yourname@yourdomain.com");
    formnm.elements[i].focus();
     formnm.elements[i].select();
    return (false);
  }
  if (formnm.elements[i].value.length < 3)
  {
    alert("Please enter at least 3 characters in the \"email\" field.");
    formnm.elements[i].focus();
     formnm.elements[i].select();
    return (false);
  }
}
}
// END EMAIL CHECK
     }
}
return true;
}

// function for password match
function password_match(pass1,pass2)
{
pass1=eval(pass1);
pass2=eval(pass2);
     if(pass1.value!=pass2.value)
     {
          return false;
     }
return true;
}

// function for email match
function email_match(pass1,pass2)
{
pass1=eval(pass1);
pass2=eval(pass2);
     if(pass1.value!=pass2.value)
     {
          return false;
     }
return true;
}

// function used pop up a window

function window_popup(filename,attr1,winname)
{
     if(winname=="")
     winname="openwin";
     var popupwin=window.open(filename,winname,attr1);
}

// compare date
function date_compare(start_date,end_date)
{
//	alert(start_date);
     var stdate=start_date.split("-");
     var enddate=end_date.split("-");
     if(parseInt(stdate[0],10)>parseInt(enddate[0],10)) return false;
     if(parseInt(stdate[0],10)==parseInt(enddate[0],10) && parseInt(stdate[1],10)>parseInt(enddate[1],10)) return false;
     if(parseInt(stdate[0],10)==parseInt(enddate[0],10) && parseInt(stdate[1],10)==parseInt(enddate[1],10) && parseInt(stdate[2],10)>parseInt(enddate[2],10)) return false;

     return true;
          }
function changeBg(name){
     document.getElementById(name).style.background = '#A5A7FC';
}

function changeBg(name){
     document.getElementById(name).style.background = '#A5A7FC';
}


function NormalBg(name){
     document.getElementById(name).style.background = '#ffffff';
}
function overEffect(obj){
     obj.bgcolor = '#ffffff';
}
function validFloatDigit(key, fieldValue){
     if(key<48 || key>57){
          if(key==46)
               return fieldValue.indexOf('.')== -1 ? key : 0 ;
          else
               return 0;
     }
     else
          return key;
}

function validIntDigit(key, fieldValue){
     return  key<48 || key>57 ? 0 : key;
}

function valid_date(dd,mm,yyyy)
{
     
        if(mm==1 || mm==3 || mm==5 || mm==7 ||  mm==8 || mm==10 || mm==12)
        {
                return true;
        }
        else if((mm==4 || mm==6 || mm==9 || mm==11) && dd>30)
        {
                return false
        }
        else if(mm==2)
        {
        if(yyyy%4==0 && dd>29){return false}
        else if(yyyy%4 !=0 && dd>28){return false}
        }
        return true
}
          //function to check valid date
function check_date(from,to)
{
     var err1;
     var err2;

frmarry =     from.split('-');
toarry =     to.split('-');


HoldDate=new Date();
currdate =  (HoldDate.getMonth()+1)+ "-" + HoldDate.getDate() + "-" + HoldDate.getYear();

if (Date.parse(from) > Date.parse(currdate)) {
alert("From date must be current date or previous date !");
return false;
}

if (Date.parse(to) > Date.parse(currdate)) {
alert("To date must be current date or previous date !");
return false;
}


if(frmarry[0] == "" || frmarry[1] == "" || frmarry[2] == "")
{
     if(frmarry[0] == "") err1 = 1;
     if(frmarry[1] == "") err1 = 1;
     if(frmarry[2] == "") err1 = 1;
     if(frmarry[0] == "" && frmarry[1] == "" && frmarry[2] == "") err1 = 2;
}
else
err1 =0;

if(toarry[0] == "" || toarry[1] == "" || toarry[2] == "")
{
     if(toarry[0] == "") err2 = 3;
     if(toarry[1] == "") err2 = 3;
     if(toarry[2] == "") err2 = 3;
     if(toarry[0] == "" && toarry[1] == "" && toarry[2] == "") err2 = 4;
}
else
err2 =0;

if((err1 == 1 && err2 == 4) || (err1 == 2 && err2 == 3)||(err1 == 0 && err2 == 4) ||(err1 == 1 && err2 == 0))
{
     alert("Both dates must be entered.")
     return false;
}
else if(err1 == 1 || err2 == 3)
{
     alert ("Please select date properly");
     return false;
}

     if( err1 == '2') 
     {
          alert("Please Select From Date");
          return false;
     }

var monthval1 = month_validate(frmarry[0],frmarry[1],frmarry[2]);
if(monthval1 == '0')
return false;

var monthval2 = month_validate(toarry[0],toarry[1],toarry[2]);
if(monthval2 == '0')
return false;

if (Date.parse(from) > Date.parse(to))
{
     alert("To date must occur after the from date.");
     return false;
}
else
{
     return true;
}
}
//please do not write code in this block
// java-script Validation function ver 1.0 
     
function validateForm(formnm){     
     formnm=eval(formnm);
     for(var i=0;i<formnm.elements.length;i++){
          if(formnm.elements[i].id){
               // START CHECK FOR BLANK
               var idval=formnm.elements[i].id;
               var idArray=idval.split("~DM~");
               for(j=0;j<idArray.length;j++){
                    idInnerArray=idArray[j].split("~");
					switch(idInnerArray[0]){                         
                         case "NOBLANK" :
                              if(RemoveLTSpace(formnm.elements[i].value)==""){
                                   alert(idInnerArray[1]);
								   formnm.elements[i].focus();
                                   return false;
                              }
                              break;
						 case "NOBLANKQ" :
                              if(RemoveLTSpace(formnm.elements[i].value)=="" || RemoveLTSpace(formnm.elements[i].value)=="Your Answer"){
                                   alert(idInnerArray[1]);
								   formnm.elements[i].focus();
                                   return false;
                              }
                              break;
                         case "FLOAT" :
                              if(formnm.elements[i].value!=""){
								  if(!floatvalue(formnm.elements[i].value)){
									     alert(idInnerArray[1]);
										 formnm.elements[i].focus();
										 return false;
								  }
							  }
                         break;   
                         case "EMAIL" :
	                        if(formnm.elements[i].value!=""){					 
                              if(!isEmailAddr(formnm.elements[i].value))     {
                                   alert(idInnerArray[1]);
                                   formnm.elements[i].focus();
                                   return false;
                              }
							}
                            break;
						case "PASS" :
	                        if(formnm.elements[i].value!=""){					 
                              if(formnm.elements[i].value.length<6)     {
                                   alert(idInnerArray[1]);
                                   formnm.elements[i].focus();
                                   return false;
                              }
						}
                        break;
						case "CONFIRMPASSWORD":
							  if(!password_match(formnm.elements[i],formnm.elements[i-1])){
								alert(idInnerArray[1]);
									 formnm.elements[i].focus();
									 formnm.elements[i].select();
									 return false;
							  }
						  break;
						case "ALPHA" :
						 if(formnm.elements[i].value!=""){	
                              if(formnm.elements[i].value.search(/\b[A-Za-z\s]+\b$/)){
                                   alert(idInnerArray[1]);
                                   formnm.elements[i].focus();
                                   formnm.elements[i].select();
                                   return false;
                              }
						 }
                         break;
                              
                         case "LOGINID" :

                              if(!isValidusername(formnm.elements[i].value)){
                                   alert(idInnerArray[1]);
                                   formnm.elements[i].focus();
                                   formnm.elements[i].select();
                                   return false;
                              }
                              break; 
						  case "URL":
						   if(formnm.elements[i].value!=""){
							   if(!checkValidURL1(formnm.elements[i].value)){
								alert(idInnerArray[1]);
								 formnm.elements[i].focus();
								 formnm.elements[i].select();
								 return false;
							   }							  
						   }
						  break;
						  case "MYIMAGE":
							 
							 if(!document.getElementById("upload_photo").checked){
								 if(getFileName(formnm.elements[i].value).search(/^[0-9A-Za-z\s_ -]+(.[jJ][pP][gG]|.[gG][iI][fF]|.[jJ][pP][eE][gG])$/)==-1){
										alert(idInnerArray[1]);
										 formnm.elements[i].focus();
										 formnm.elements[i].select();
										 return false;
								  }
							  }
							  break;
						  case "IMAGE":
							 if(getFileName(formnm.elements[i].value).search(/^[0-9A-Za-z\s_ -]+(.[jJ][pP][gG]|.[gG][iI][fF]|.[jJ][pP][eE][gG])$/)==-1){
										alert(idInnerArray[1]);
										 formnm.elements[i].focus();
										 formnm.elements[i].select();
										 return false;
							  }
							  break;	
						  case "IMAGEEDIT":
							  if(formnm.elements[i].value!=""){
								  if(getFileName(formnm.elements[i].value).search(/^[0-9A-Za-z\s_ -]+(.[jJ][pP][gG]|.[gG][iI][fF]|.[jJ][pP][eE][gG])$/)==-1){
										 alert(idInnerArray[1]);
										 formnm.elements[i].focus();
										 formnm.elements[i].select();
										 return false;
								  }
							  }
                          break;
						  case "PHOTO":
							  
							  if(formnm.elements[i].value!=""){
								  if(getFileName(formnm.elements[i].value).search(/^[0-9A-Za-z\s_ -]+(.[jJ][pP][gG]|.[gG][iI][fF]|.[jJ][pP][eE][gG])$/)==-1){
										 alert(idInnerArray[1]);
										 formnm.elements[i].focus();
										 formnm.elements[i].select();
										 return false;
								  }
								if(formnm.elements[i-1].value==""){
										 alert("Please Enter Photo title");
										 formnm.elements[i-1].focus();										 
										 return false;
								}
							  }
							  
                          break;
						  case "Video":
							  if(formnm.elements[i].value=="" && formnm.elements[i-1].value==""){
										 alert("Please upload your video or add video code");
										 formnm.elements[i].focus();										 
										 return false;
							  }
							  if(formnm.elements[i].value!="" && formnm.elements[i-1].value!=""){
										 alert("Either upload video or video code");
										 formnm.elements[i].focus();										 
										 return false;
							  }		  
							  if(formnm.elements[i].value!=""){
								  if(getFileName(formnm.elements[i].value).search(/^[0-9A-Za-z\s_ -]+(.[aA][vV][iI]|.[fF][lL][vV]|.[wW][mM][vV])$/)==-1){
										 alert(idInnerArray[1]);
										 formnm.elements[i].focus();
										 formnm.elements[i].select();
										 return false;
								  }
							  }
							  
                          break;
						  case "PHONE" : 
							 
						   if(formnm.elements[i].value!=""){
								var re2 = /^[\+0-9][ 0-9_-]+\d$/;
								if (!re2.test(formnm.elements[i].value)) {
								   alert(idInnerArray[1]);
								   formnm.elements[i].focus();                                  
                                   return false;
								}
						   }
						   break;
						  case "ACCEPT":
							   if(!formnm.elements[i].checked){
                                    alert(idInnerArray[1]);
									return false;
						       }
						   break;
						   case "USSTATE":
							   var cou=trim(formnm.elements[i-2].options[formnm.elements[i-2].selectedIndex].value,"");
							   if(cou!="" && cou=="United States"){
								   if(formnm.elements[i-4].value==""){
										alert(idInnerArray[1]);
										formnm.elements[i-4].focus(); 
										return false;
									}
						       }
						   break;
						   case "USZIP":
							   var cou=trim(formnm.elements[i-2].options[formnm.elements[i-2].selectedIndex].value,"");
							   if(cou!="" && cou=="United States"){
                                    if(formnm.elements[i-3].value==""){
										alert(idInnerArray[1]);
										formnm.elements[i-3].focus(); 
										return false;
									}
						       }
						   break;
						   case "EDITVIDEO":
						   if(formnm.elements[i].value!=""){
								  if(getFileName(formnm.elements[i].value).search(/^[0-9A-Za-z\s_ -]+(.[aA][vV][iI]|.[fF][lL][vV]|.[wW][mM][vV])$/)==-1){
										 alert(idInnerArray[1]);
										 formnm.elements[i].focus();
										 formnm.elements[i].select();
										 return false;
								  }
							  }
							  
                          break;
						case "ANSWER":
							
							var nam=document.getElementsByName('answer');							
							var c=0;
							for (var jj=0; jj < nam.length; jj++){
								if (nam[jj].checked){
									c=1;
									exit;
								}
							}
							if (c==0){
								alert('Please select your answer.');	
								return false;
							}
							break;
						case "ATLEAST":
                            var chkArray=idInnerArray[1].split(",");
							var nam=document.getElementsByName(chkArray[1]);	
							
							for (var jj=0; jj < nam.length; jj++){
                               if (nam[jj].checked){
								   if(nam[jj].value=="Private"){										
										var myid=document.getElementById(chkArray[0]);
										if(myid.style.display=="block"){
											var len=myid.getElementsByTagName('input');
											
											var chkall=0;
											for(var mm=0;mm < len.length;mm++){
												if(len[mm].checked){
													chkall=1;
													break;
												}
											}

											if(chkall==0){
												alert(chkArray[2]);	
												return false;
											}
										}
								   }
							   }
							}
                            break;
							case "SETPASS":							
							var nam=document.getElementsByName('privacy');							
							
							for (var jj=0; jj < nam.length; jj++){
								if (nam[jj].checked){
									if(nam[jj].value=="Private" && document.getElementById('option1').style.display=="block"){
										if(formnm.elements[i].value=="" && !formnm.elements[i+1].checked){
											alert(idInnerArray[1]);
											formnm.elements[i].focus();                                  
											return false;
										}
									}
								}
							}
							
							break;
                    }
               }
          }
     }
     return true;
}

function trim(str, chars) {
    return ltrim(rtrim(str, chars), chars);
}

function ltrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("^[" + chars + "]+", "g"), "");
}

function rtrim(str, chars) {
    chars = chars || "\\s";
    return str.replace(new RegExp("[" + chars + "]+$", "g"), "");
}

function junkValue(fieldValue){
     //return true if any junk character found in given value otherwise false
     if(fieldValue!=""){
     junkChar="\\\"<>~`!#%^*/][{}()";
     for(i=0;i<junkChar.length;i++)
          if(fieldValue.indexOf(junkChar.charAt(i))!=-1)
               return true;
     }
     return false;
}
function junkValueForDesc(fieldValue){
     //return true if any junk character found in given value otherwise false
     if(fieldValue!=""){
     junkChar="\\~`^][{}<>";
     for(i=0;i<junkChar.length;i++)
          if(fieldValue.indexOf(junkChar.charAt(i))!=-1)
               return true;
     }
     return false;
}
function junkValueForURL(fieldValue){
     //return true if any junk character found in given value otherwise false
     if(fieldValue!=""){
     junkChar="~`^][{}<>";
     for(i=0;i<junkChar.length;i++)
          if(fieldValue.indexOf(junkChar.charAt(i))!=-1)
               return true;
     }
     return false;
}

function alphaNumeric(str){
     // return false if given string does not follow variable naming scheme
     for (i=0;i<str.length;i++){
          ascCode=str.charCodeAt(i);
         if(     (ascCode>=65 && ascCode<=90) || 
               (ascCode>=97 && ascCode<=122) || 
               (ascCode>=48 && ascCode<=57) || 
               (ascCode==95) || (ascCode==32)
            );
          else{
               //alert(ascCode);
               //alert("alphe numeric returning false");
               return false;
          }
     }
     //alert("alphe numeric returning true");
     return true;
}
function loginid(str){
     // return false if given string does not follow variable naming scheme
     for (i=0;i<str.length;i++){
          ascCode=str.charCodeAt(i);
         if(     (ascCode>=65 && ascCode<=90) || 
               (ascCode>=97 && ascCode<=122) || 
               (ascCode>=48 && ascCode<=57) || 
               (ascCode==95) 
            );
          else{
               //alert("alphe numeric returning false");
               return false;
          }
     }
     //alert("alphe numeric returning true");
     return true;
}
               

function digit(fieldValue){
     //return true if any digit found in given value otherwise false
     if(fieldValue!=""){
     junkChar="1234567890";
     for(i=0;i<junkChar.length;i++)
          if(fieldValue.indexOf(junkChar.charAt(i))!=-1)
               return true;
     }
     return false;
}

function fileNameLength(filePath){
     //return the length of file name from given path
     fPath= new String(filePath);
     fileName= fPath.substring(fPath.lastIndexOf('\\')+1);
     fileName=new String(fileName);
     return fileName.length;
}

function getFileName(filePath){
     //return the length of file name from given path
     fPath= new String(filePath);
     fileName= fPath.substring(fPath.lastIndexOf('\\')+1);
     return fileName;
}

function fileJunkValue(fieldValue){
     //return true if any junk character found in given file
     //get file name from path
     fileName=getFileName(fieldValue);
     if(fileName!=""){
     junkChar="\\\"<>'~`!@#$%^&*/";
     for(i=0;i<junkChar.length;i++)
          if(fileName.indexOf(junkChar.charAt(i))!=-1)
               return true;
     }
     return false;
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

function multisub()
{
     if(document.frmCat.chkconfrm.value=="")
     {
          if(validateForm(frmCat))
               return true;
          else
               return false;     
     }
     else
     {
          if(confirm("Are you sure to delete this category"))
               return true;
          else
               return false;     
     }
}
function chkdel()
{
     document.frmCat.chkconfrm.value="xyz";
}
function chkmod()
{
     document.frmCat.chkconfrm.value="";
}

function ResetForm(objForm)
{
     for(var intCounter=0;intCounter<objForm.elements.length;intCounter++)
     {
          if(objForm.elements[intCounter].type!=null)
          {
               if(objForm.elements[intCounter].type=="text")
               {
                   if(!objForm.elements[intCounter].readOnly){
						objForm.elements[intCounter].value="";
					}
               }
               else if(objForm.elements[intCounter].type=="select-one")
               {
                    objForm.elements[intCounter].selectedIndex=0;     
               }
               else if(objForm.elements[intCounter].type=="file")
               {
                    var oObject=objForm.elements[intCounter];
                    var strValue=oObject.outerHTML;     
                    var strFieldValue=oObject.value;
                    strValue=strValue.replace(strFieldValue,"");
                    oObject.outerHTML=strValue;
               }
               else if(objForm.elements[intCounter].type=="textarea")
               {
                    objForm.elements[intCounter].value="";
               }
               else if(objForm.elements[intCounter].type=="password")
               {
                    objForm.elements[intCounter].value="";
               }
            else if(objForm.elements[intCounter].type=="checkbox")
               {
                    objForm.elements[intCounter].checked=false;
               }
            else if(objForm.elements[intCounter].type=="radio")
               {
                    objForm.elements[intCounter].checked=false;
               }  
          }
     }
}

function format(txt)
{
     if(txt.search(/\d{3}\-\d{2}\-\d{4}/)==-1)
      {
        return false;
      }
      else{
          return true;
      }
}


function format1(phone1)
{
            if(phone1.search(/\d{3}\-\d{3}\-\d{4}/)==-1)
            {
              return false;
            }
            else
            {
                  return true;
            }
     
}

function length1(phone)
{
     if(phone.search(/\d{3}/)==-1)
                              {
                                return false;
                              }
                                   else{
                                   return true;
                                   }
}

function floatvalue(txt){
 //if(txt.search(/((\d+(\.\d*)?)|((\d*\.)?\d+))$/)==-1){
  if(txt.search(/\b[0-9]*\.?([0-9]+)\b$/)==-1){	 	 
	  return false;
  }else{
	  return true;
  }
}

function validamount(txt){
 //if(txt.search(/((\d+(\.\d*)?)|((\d*\.)?\d+))$/)==-1){
	 
  if(txt.search(/\d+\.\d{2}$/)==-1){	 	 
	  return false;
  }else{
	  return true;
  }
}

function intvalue(txt,field){
 //if(txt.search(/((\d+(\.\d*)?)|((\d*\.)?\d+))$/)==-1){
  if(txt.search(/\b\d+\b$/)==-1){	 	 
	  alert("Please enter a number");
      document.getElementById(field).focus();
	  return false;
  }else{
	  return true;
  }
}


function validcheck(name,action,text)
{
	var chObj	=	document.getElementsByName(name);
	var result	=	false;	
	for(var i=0;i<chObj.length;i++){
	
		if(chObj[i].checked){
		  result=true;
		  break;
		}
	}

	if(!result){
		 alert("Please select atleast one "+text+" to "+action+".");
		 return false;
	}else if(action=='delete'){
			 if(!confirm("Are you sure you want to delete this.")){
			   return false;
			 }else{
				document.form1.submit();
			 }
	}else{
		 document.form1.submit();
	}
}


function radioButtonValue(name){

	var chObj	=	document.getElementsByName(name);
	var result	=	false;	
	for(var i=0;i<chObj.length;i++){
		if(chObj[i].checked){
		  txt2	=	chObj[i].value;
		  break;
		}
	}
	return txt2;
}

function checkall(objForm){
	len = objForm.elements.length;
	var i=0;
	for( i=0 ; i<len ; i++) {
		if (objForm.elements[i].type=='checkbox') {
			objForm.elements[i].checked=objForm.check_all.checked;
		}
	}
}

function cardval(s) {
// remove non-numerics
var v = "0123456789";
var w = "";
for (i=0; i < s.length; i++) {
	x = s.charAt(i);
	if (v.indexOf(x,0) != -1)
	w += x;
}
// validate number
j = w.length / 2;
if (j < 6.5 || j > 8 || j == 7) return false;
k = Math.floor(j);
m = Math.ceil(j) - k;
c = 0;
for (i=0; i<k; i++) {
a = w.charAt(i*2+m) * 2;
c += a > 9 ? Math.floor(a/10 + a%10) : a;
}
for (i=0; i<k+m; i++) c += w.charAt(i*2+1-m) * 1;
return (c%10 == 0);
}

function checkcard(card,field,payment){
	var result	=	true;
if(payment=="Visa")	{
	 if(card.length==16 && card.charAt(0)==4){
		 if(!cardval(card))
			{
			 result=false;
		  }
	 }else{
		 result=false;
	 }	 
}else if(payment=="Amex"){
	 if(card.length==15 && card.charAt(0)==3){
		 if(!cardval(card))
		  {
			 result=false;
		  }
	 }else{
		 result=false;
	 }
}else if(payment=="Discover"){
	 if(card.length==16 && card.charAt(0)==6){
		 if(!cardval(card))
		  {
			 result=false;
		  }
	 }else{
		 result= false;
	 }
}else if(payment=="MasterCard"){
	  if(card.length==16 && card.charAt(0)==5){
		 if(!cardval(card))
			{
			 result= false;
		  }
	 }else{
		 result= false;
	 }
}

	if(!result){
		 alert("Please enter the valid card number");
		 document.getElementById(field).focus();
		 return false;
	}

}

function formatNumber(num,dec,thou,pnt,curr1,curr2,n1,n2) 
{
var x = Math.round(num * Math.pow(10,dec));if (x >= 0) n1=n2='';var y = (''+Math.abs(x)).split('');var z = y.length - dec; if (z<0) z--; for(var i = z; i < 0; i++) y.unshift('0');y.splice(z, 0, pnt); while (z > 3) {z-=3; y.splice(z,0,thou);}var r = curr1+n1+y.join('')+n2+curr2;
return r;
}

function validate(frm){
	if(!validateForm(frm)){
      return false;
	}else{
         return true;	 
  	}
}

function checkValidURL1(url){
	//alert('hjdfdd');
 var expression1 = new RegExp("^(((ht|f)tp(s?))\://)?(www.|[a-zA-Z].)[a-zA-Z0-9\-\.]+\.(com|edu|gov|mil|net|in|org|biz|info|name|museum|us|ca|uk)(\:[0-9]+)*(/($|[a-zA-Z0-9\.\,\;\?\'\\\+&%\$#\=~_\-]+))*$", "i");
 if (!expression1.test(url)) 
  return false;
 else 
  return true;
  
}
function checkModeOfPayment(frm1){
	if(frm1.mode[0].checked==false && frm1.mode[1].checked==false && frm1.mode[2].checked==false) {
		alert("Please select Mode of Payment..");	
		frm1.mode[0].focus();
		return false;
	}

}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
  return false;
}

function make_request(bsurl,val){
   try{
			ob1=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			try{
				ob1=new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e2){
				ob1=false;
			}
	}
	if(!ob1 && typeof XMLHttpRequest!='undefined'){
			ob1=new XMLHttpRequest();
	}
	
   	var url=bsurl+"/cpanel/ajax.php?num="+val;
   
   
	ob1.open("GET",url,false);
	ob1.onreadystatechange=take_Response;
	ob1.send(null);
	
}

//Ajax Response
function take_Response(){
	if(ob1.readyState==4){
	 	var resp=ob1.responseText;
	 	if(resp=='Invalid'){
		 	alert("Please Select Number!!");
	 	}else{
   	 	document.getElementById("insbox").innerHTML=resp;
	 	}
	}
}

function showhide(){
	if(document.getElementById("upload_photo").checked) {
		document.getElementById("option1").style.display='none';
	} else{
		document.getElementById("option1").style.display='block';
	}
}
function showtext(val){
	if(val.value=="Others:"){
		val.value="";
	}

}
function hidetext(val){
	if(val.value==""){
		val.value="Others:";
	}

}


function showcommentbox(boxname){
	document.getElementById(boxname).style.display='block';
}
function cancelReply(boxname){
	document.getElementById(boxname).style.display='none';
}
function createalbum(val){
	if(val=="N"){
		document.getElementById('create').style.display='block';
	}else{
		document.getElementById('create').style.display='none';
	}

}
/*function showhide(show,hide){
	if(show!=''){
		document.getElementById(show).style.display='block';
	}
	if(hide!=''){
		document.getElementById(hide).style.display='none';
	}
}*/

function chk_unchk(val, form_name) {
   	dml=eval('document.'+form_name);
   	len=dml.elements.length;
   	var i=0;
   	for (i=0; i<len; i++) {
     	if (dml.elements[i].type == "checkbox") {
        	if (val == 1) { 
           		dml.elements[i].checked=true;
        	} 
			else {
           		dml.elements[i].checked=false;
        	}
     	}   
   	}
}
var mailArray="";
function addemail(val){
	var c=new Array();
	var value1=0;
	c=mailArray.split(",");
	for(var i=0;i<c.length;i++){
		if(c[i]==val && val!=''){
			value1=1;
			break;
		}
	}
	if(value1==0 && val!=""){
		mailArray+=val+",";
	}
	var chObj	=	document.getElementsByName('sendmailTo');
	chObj[0].value=mailArray;
}
function showfriend(d1,d2,d3){
	mailArray="";
	var chObj	=	document.getElementsByName('sendmailTo');
	chObj[0].value=mailArray;
	document.getElementById('se1').value='';
	document.getElementById('se2').value='';
	document.getElementById('se3').value='';
	if(d1!=''){
		document.getElementById('friends').style.display='block';
		document.getElementById('group1').style.display='none';
		document.getElementById('group2').style.display='none';
	}
	if(d2!=''){
		document.getElementById('friends').style.display='none';
		document.getElementById('group1').style.display='block';
		document.getElementById('group2').style.display='none';
	}
	if(d3!=''){
		document.getElementById('friends').style.display='none';
		document.getElementById('group1').style.display='none';
		document.getElementById('group2').style.display='block';
	}

}
function focuscommentbox(){
 document.getElementById('message').focus();
}
function focuson(frm){
	frm.comments.focus();
	frm.comments.className='txtfield1';
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


function getRequest(action,value,siteUrl){
	try{
			ob1=new ActiveXObject("Msxml2.XMLHTTP");
	}catch(e){
		try{
				ob1=new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e2){
				ob1=false;
		}
	}
	if(!ob1 && typeof XMLHttpRequest!='undefined'){
			ob1=new XMLHttpRequest();
	}
	var url=siteUrl+"/ajax.php?val="+value+"&action="+action;	
	ob1.open("GET",url,true);
	ob1.onreadystatechange=show_form;
	ob1.send(null);
}
function show_form(){
	if(ob1.readyState==4){
	 	var resp=ob1.responseText;
		var arr=Array();
		arr=resp.split("-");
		if(arr[1]=="p"){
			document.getElementById('msgp').innerHTML=arr[0];
		}else if(arr[1]=="w"){
			document.getElementById('msgw').innerHTML=arr[0];
		}
	}
}
function chk_radio(form_name,message) {
   	dml=eval('document.'+form_name);
   	len=dml.elements.length;
   	var i=0;
	var count=0;
   	for (i=0; i<len; i++) {
     	if (dml.elements[i].type == "radio") {
        	if (dml.elements[i].checked) { 
           		count=1;
        	}     	
		}   
   	}
	if(count==0){
		alert(message);
		return false;
	}
}

function showhide(show,hide){
	if(show!=''){
		document.getElementById('option1').style.display='block';
	}
	if(hide!=''){
		document.getElementById('option1').style.display='none';
	}
}
function hide(){
	if(document.getElementById('skip').checked){
		document.getElementById('pass').style.display='none';
	}else{
		document.getElementById('pass').style.display='block';
	}
}
function taLimit(event) {
	if (navigator.appVersion.indexOf("MSIE")!=-1){
		var taObj=event.srcElement;
	}else{
		var taObj=event.target;
	}
	if (taObj.value.length==taObj.maxLength*1) return false;
}

function taCountRegister(event,maxLength,frmname) { 
	obj=eval('document.'+frmname);
	if (navigator.appVersion.indexOf("MSIE")!=-1){
		var taObj=event.srcElement;
	}else{
		var taObj=event.target;
	}
	if (taObj.value.length>maxLength*1) taObj.value=taObj.value.substring(0,maxLength*1);
	if (event) obj.myCounter.value=maxLength-taObj.value.length;
}
function openwin(file,Iwidth,Iheight) {
	var newWin1=window.open(file,'nWin2','x=0,y=0,toolbar=no,location=no,directories=no,status=no,scrollbars=yes,copyhistory=no,width='+Iwidth+',height='+Iheight+',screenX=0,screenY=0,left=20,top=20');
}

function hideshow(show,hide){

       document.getElementById(hide).style.display='none';
		document.getElementById(show).style.display='block';
}
function taCounter(event,frmname,countername) {
	
	obj=eval('document.'+frmname);
	obj1=eval('document.'+frmname+'.'+countername);
	if (navigator.appVersion.indexOf("MSIE")!=-1){
		var taObj=event.srcElement;
	}else{
		var taObj=event.target;
	}
	if (event) obj1.value=taObj.value.length;
}

function chkaction(frm){
	count = frm.elements.length;
	var c=0;
	var d=0;
	for (i=0; i < count; i++){
		if(frm.elements[i].checked == 1 && frm.elements[i].type=="checkbox"){
			c = 1;
		}
		if(frm.elements[i].checked == 1 && frm.elements[i].type=="radio"){
			d = 1;
		}

	}
	if(c == 0){
		alert('Please select any record.');
		return false;
	}
	
	if(d == 0){
		alert('Please select any action.');
		return false;
	}
}

function select_one(frm){
	count = frm.elements.length;
	var c=0;
	var d=0;
	for (i=0; i < count; i++){
		if(frm.elements[i].checked == 1 && frm.elements[i].type=="checkbox"){
			c = 1;
		}
	}
	if(c == 0){
		alert('Please select any record.');
		return false;
	}
}


function show_div(show){
	document.getElementById(show).style.display='block';
}
function hide_div(show){
	document.getElementById(show).style.display='none';
}
function preview(frm){
	
   	len=frm.elements.length;
   	var i=0;
	var count=0;
   	for (i=0; i<len; i++) {
     	if (frm.elements[i].type == "radio") {
        	if (frm.elements[i].checked) { 
           		count=frm.elements[i].value;
        	}     	
		}   
   	}
	if(count==0){
		alert("Please select one flash template");
		return false;
	}else{
		MM_openBrWindow('preview_flash.php?flashID='+count+'','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=700,height=600');
	}
}

function preview_music(frm){
	
   	len=frm.elements.length;
   	var i=0;
	var count=0;
   	for (i=0; i<len; i++) {
     	if (frm.elements[i].type == "radio") {
        	if (frm.elements[i].checked) { 
           		count=frm.elements[i].value;
        	}     	
		}   
   	}
	if(count==0){
		alert("Please select one music template");
		return false;
	}else{
		MM_openBrWindow('preview_music.php?musicID='+count+'','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=400,height=260');
	}
}
function preview_music_selected(val){
		MM_openBrWindow('preview_music.php?musicID='+val+'','','toolbar=yes,location=yes,status=yes,menubar=yes,scrollbars=yes,resizable=yes,width=400,height=260');
}

function enable_disable(var1,var2){
	obj=eval('document.register.'+var1);
	obj2=eval('document.register.'+var2);
	var j='';
	j=obj.checked;
	if(j){
		obj2.value="";
		obj2.disabled=true;
	}else{
		obj2.disabled=false;
	}
}


function show_story() {
	if(document.getElementById('boy_area').style.display=='none'){
			document.getElementById('edit_area').style.display='block';
			document.getElementById('boy_area').style.display='block';
	}
}

function show_boy_story() {
	if(document.getElementById('boy_area').style.display=='none'){
			document.getElementById('edit_area').style.display='block';
			document.getElementById('boy_area').style.display='block';
			document.getElementById('girl_area').style.display='none';
	}
}
function show_girl_story() {
	if(document.getElementById('girl_area').style.display=='none'){
			document.getElementById('edit_area').style.display='block';
			document.getElementById('girl_area').style.display='block';
			document.getElementById('boy_area').style.display='none';
	}
}

function show_bride_family() {
	if(document.getElementById('bride_area').style.display=='none'){			
			document.getElementById('bride_area').style.display='block';
			document.getElementById('groom_area').style.display='none';
	}
}
function show_groom_family() {
	if(document.getElementById('groom_area').style.display=='none'){
			document.getElementById('groom_area').style.display='block';
			document.getElementById('bride_area').style.display='none';			
	}
}

function show_welcome(){
	if(document.getElementById('edit_area').style.display=='none'){
		document.getElementById('edit_area').style.display='block';
	}
}

function show_tempalte(tempID){
	document.getElementById('template_div').innerHTML='<img src="large/wedding-temp'+tempID+'.jpg" alt="" width="540" height="525" />';

}
function show_tempalte_personal(tempID){
	document.getElementById('template_div').innerHTML='<img src="large/personal-temp'+tempID+'.jpg" alt="" />';

}


