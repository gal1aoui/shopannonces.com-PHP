	var newwindow;
	function poptastic(url){
		newwindow=window.open(url,'name','height=700,width=1000,scroling=yes,scrollbars=yes');
		if (window.focus) {newwindow.focus()}
	}


function validateorder(obj){
var len=obj.elements.length;
	for(var tx=1;tx<len;tx++)
	{
	if(obj.elements[tx].type=='text'){
	if(obj.elements[tx].id.indexOf('cat')!=-1){
		var res= obj.elements[tx].value;	
		 if(parseInt(res)<=0){
				alert("Order must be greater than zero!!");
				obj.elements[tx].value='';
				obj.elements[tx].focus();
				return false;
			}
		}
	}
		
  }
}