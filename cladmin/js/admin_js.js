function checkall(objForm){
	len = objForm.elements.length;
	var i=0;
	for( i=0 ; i<len ; i++) {
		if (objForm.elements[i].type=='checkbox') {
			objForm.elements[i].checked=objForm.check_all.checked;
		}
	}
}

function confirm_submit(objForm) {
	return true;
}

function validcheck(name){
var chObj = document.getElementsByName(name);
var result	=	false;
for(var i=0;i<chObj.length;i++){

	if(chObj[i].checked){
	  result=true;
	  break;
	}
}
  if(!result){
    return false;
  }else{
	 return true;
  }
}
function deleteConfirmFromUser(name) {		
	////////alert("aaaaaa");
	if(validcheck(name)==true) {
		if(confirm("Are you sure you want to delete the record?")) {
			return true;  
		} else  {
			return false;  
		}
	}
	else if(validcheck(name)==false) {
		alert("Select at least one check box.");		
		return false;
	}
}

function ChangeConfirmFromUser(name)
{		
	////////alert("aaaaaa");
	//alert(name.value);
	if(confirm("Are you sure you want to Send Change the record?"))
	{
		return true;  
	}
	else 
	{
		return false;  
	}
}


function activateConfirmFromUser(name)
{		
	////////alert("aaaaaa");
	if(validcheck(name)==true)
	{
		if(confirm("Are you sure you want to activate the record?"))
		{
			return true;  
		}
		else 
		{
			return false;  
		}
	}
	else if(validcheck(name)==false)
	{
		alert("Select at least one check box.");		
		return false;
	}
}

function sendemailConfirmFromUser(name)
{		
	////////alert("aaaaaa");
	if(validcheck(name)==true)
	{
		if(confirm("Are you sure you want to send email to subscriber?"))
		{
			return true;  
		}
		else 
		{
			return false;  
		}
	}
	else if(validcheck(name)==false)
	{
		alert("Select at least one check box.");		
		return false;
	}
}

function deactivateConfirmFromUser(name)
{		
	////////alert("aaaaaa");
	if(validcheck(name)==true)
	{
		if(confirm("Are you sure you want to deactivate the record?"))
		{
			return true;  
		}
		else 
		{
			return false;  
		}
	}
	else if(validcheck(name)==false)
	{
		alert("Select at least one check box.");		
		return false;
	}
}


function rappelConfirmFromUser(name)
{		
	////////alert("aaaaaa");
	if(validcheck(name)==true)
	{
		if(confirm("Are you sure you want to send Recall the record?"))
		{
			return true;  
		}
		else 
		{
			return false;  
		}
	}
	else if(validcheck(name)==false)
	{
		alert("Select at least one check box.");		
		return false;
	}
}

function featuredConfirmFromUser(name)
{		
	////////alert("aaaaaa");
	if(validcheck(name)==true)
	{
		if(confirm("Are you sure you want to Featured the record?"))
		{
			return true;  
		}
		else 
		{
			return false;  
		}
	}
	else if(validcheck(name)==false)
	{
		alert("Select at least one check box.");		
		return false;
	}
}
function UnfeaturedConfirmFromUser(name)
{		
	////////alert("aaaaaa");
	if(validcheck(name)==true)
	{
		if(confirm("Are you sure you want to Unfeatured the record?"))
		{
			return true;  
		}
		else 
		{
			return false;  
		}
	}
	else if(validcheck(name)==false)
	{
		alert("Select at least one check box.");		
		return false;
	}
}

function emailConfirmFromUser(name){		
 	if(validcheck(name)==true){
		if(confirm("Are you sure you want to send email ?")){
			return true;  
		} else {
			return false;  
		}
	} else if(validcheck(name)==false){
		alert("Select at least one check box.");		
		return false;
	}
}


function urlConfirmFromUser(name){		
 	if(validcheck(name)==true){
		return true; 
 	} else if(validcheck(name)==false){
		alert("Select at least one check box.");		
		return false;
	}
}
