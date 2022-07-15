function GetXmlHttpObject()
{
	var xmlHttp;
	try{
		/************** Firefox, Opera 8.0+, Safari ************* */
		xmlHttp=new XMLHttpRequest();
	}catch(e){
		/* ************* Internet Explorer************* */
		try{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
			xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
		}
	}
	return xmlHttp;
}
xmlHttp		=	 GetXmlHttpObject();

function check_user(obj)
{
	var username = obj.user_id.value;
	var url	=	"ajax_respons.php?c="+username;	
	xmlHttp	=	GetXmlHttpObject();
	xmlHttp.open("GET",url,true)
	xmlHttp.send(null)	
	xmlHttp.onreadystatechange = function(){	
		if (xmlHttp.readyState==4 || xmlHttp.readyState=="complete"){		
			var txt	 = xmlHttp.responseText;
			//alert(txt);
			if(txt!=""){
				document.getElementById("txtHint1").innerHTML=xmlHttp.responseText;
			}
		}
	}
	
}

function cat_drop_prin_select(catID,scatId)
{
	document.getElementById("ogiga").innerHTML="";
	document.getElementById("msgboxcategory").className="";
	document.getElementById("msgtextogiga").innerHTML="";

	document.getElementById("omega").innerHTML="";	

		var url	=	"ajax_respons.php?pcatId="+catID;
		xmlHttp2	=	GetXmlHttpObject();	
		xmlHttp2.open("GET",url,true)
		xmlHttp2.send(null)	
		xmlHttp2.onreadystatechange = function()
		{		
				if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
				{		
				  var txt	 = xmlHttp2.responseText;
				   //alert("111"+txt);
				   //alert(xmlHttp2.responseText.length);
						 if(xmlHttp2.responseText.length!=1059 && xmlHttp2.responseText.length!=0)
						 {					
						  //alert("cat_tree1");
						document.getElementById("ogiga").innerHTML=txt;
						 }
						 else
						 {
							//----------------------------
							var url	=	"ajax_respons.php?osubcatId="+catID+"&osbcatId="+scatId+"&ran="+Math.random();	
							//alert(url);
							xmlHttp2.open("GET",url,true)
							xmlHttp2.send(null)
							xmlHttp2.onreadystatechange = function()
							{		
									if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
									{		
									  var txt2	 = xmlHttp2.responseText;											 
												// alert("cat_tree2");
											 document.getElementById("omega").innerHTML=txt2;	
											// document.getElementById("omega").style.display="";
									  }							
							}
							//---------------------------- 
						 }
				  }		
		}
}

function cat_drop_down(catID,scatId)
{
	document.getElementById("omega").innerHTML="";	
	document.getElementById("cat_level_two").innerHTML="";	
	var url	=	"ajax_respons.php?catId="+catID+"&sbcatId="+scatId+"&ran="+Math.random();
	//alert(url);
	xmlHttp2	=	GetXmlHttpObject();	
	xmlHttp2.open("GET",url,true)
	xmlHttp2.send(null)	
	xmlHttp2.onreadystatechange = function()
	{		
			if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
			{		
			  var txt	 = xmlHttp2.responseText;
			   //alert("111"+txt);
					 if(txt!="")
					 {					
					  //alert("cat_tree1");
					document.getElementById("cat_tree1").innerHTML=txt;							
					 }	
			  }
	
	}
}
function cat_drop_down_advertise(catID,scatId)
{
//	document.getElementById("cat_level_two").innerHTML="";	
	var url	=	"ajax_respons.php?catId_advertise="+catID+"&sbcatId_advertise="+scatId+"&ran="+Math.random();
	//alert(url);
	xmlHttp2	=	GetXmlHttpObject();	
	xmlHttp2.open("GET",url,true)
	xmlHttp2.send(null)	
	xmlHttp2.onreadystatechange = function()
	{		
			if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
			{		
			  var txt	 = xmlHttp2.responseText;
			   //alert("111"+txt);
					 if(txt!="")
					 {					
					  //alert("cat_tree1");
					document.getElementById("cat_tree1").innerHTML=txt;							
					 }	
			  }
	
	}
}

function cat_drop_down2_advertise(subcatID,scatId)
{
					// document.getElementById("omega").innerHTML="";	
	var url	=	"ajax_respons.php?catId_advertise2="+subcatID+"&sbcatId_advertise2="+scatId+"&ran="+Math.random();

	xmlHttp2	=	GetXmlHttpObject();	
	xmlHttp2.open("GET",url,true)
	xmlHttp2.send(null)	
	xmlHttp2.onreadystatechange = function()
	{		
			if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
			{		
			  var txt	 = xmlHttp2.responseText;
			   //alert("111"+txt);
					 if(txt!="")
					 {					
					  //alert("cat_tree1");
					document.getElementById("cat_tree2").innerHTML=txt;							
					 }	
			  }
	
	}
}
function cat_drop_down2(subcatID,scatId)
{
					// document.getElementById("omega").innerHTML="";	
	var url	=	"ajax_respons.php?subcatId="+subcatID+"&sbcatId="+scatId+"&ran="+Math.random();	
	//alert(url);
	xmlHttp22	=	GetXmlHttpObject();
	xmlHttp22.open("GET",url,true)
	xmlHttp22.send(null)
	xmlHttp22.onreadystatechange = function()
	{		
			if (xmlHttp22.readyState==4 || xmlHttp22.readyState=="complete")
			{		
			  var txt2	 = xmlHttp22.responseText;
			      //alert(txt2);
					 if(txt2!="")
					 {
						// alert("cat_tree2");
					 //document.getElementById("cat_tree2").innerHTML=txt2;	
					 document.getElementById("cat_level_two").innerHTML=txt2;							
					 }	
			  }
	
	}
}

function cat_drop_down3(subcatID,scatId)
{
	document.getElementById("omega").innerHTML="";	
	var url	=	"ajax_respons.php?osubcatId="+subcatID+"&osbcatId="+scatId+"&ran="+Math.random();	
	//alert(url);	
	xmlHttp22	=	GetXmlHttpObject();
	xmlHttp22.open("GET",url,true)
	xmlHttp22.send(null)
	xmlHttp22.onreadystatechange = function()
	{		
			if (xmlHttp22.readyState==4 || xmlHttp22.readyState=="complete")
			{		
			  var txt2	 = xmlHttp22.responseText;
			      //alert(txt2);
					 if(txt2!="")
					 {
						// alert("cat_tree2");
					 document.getElementById("omega").innerHTML=txt2;	
					// document.getElementById("omega").style.display="";			
					 }	
			  }
	
	}
}

function cat_drop_down_list(subcatID,scatId)
{
	document.getElementById("filtre").innerHTML="";	
	var url	=	"ajax_respons.php?list_osubcatId="+subcatID+"&list_osbcatId="+scatId+"&ran="+Math.random();	
	//alert(url);	
	xmlHttp22	=	GetXmlHttpObject();
	xmlHttp22.open("GET",url,true)
	xmlHttp22.send(null)
	xmlHttp22.onreadystatechange = function()
	{		
		if (xmlHttp22.readyState==4 || xmlHttp22.readyState=="complete")
		{		
			var txt2	 = xmlHttp22.responseText;
			//alert(txt2);
			if(txt2!="")
			{
				document.getElementById("filtre").innerHTML=txt2;	
				// document.getElementById("omega").style.display="";			
			}	
		  }
	
	}
}

function Acat_drop_down(catID,scatId)
{
	var url	=	"ajax_respons.php?catId="+catID+"&sbcatId="+scatId+"&ran="+Math.random();
	//alert(url);
	xmlHttp2	=	GetXmlHttpObject();	
	xmlHttp2.open("GET",url,true)
	xmlHttp2.send(null)	
	xmlHttp2.onreadystatechange = function()
	{		
			if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
			{		
			  var txt	 = xmlHttp2.responseText;
			   //alert("111"+txt);
					 if(txt!="")
					 {					
					  //alert("cat_tree1");
					document.getElementById("cat_tree1").innerHTML=txt;							
					 }	
			  }
	
	}
}

function Acat_drop_down2(subcatID,scatId)
{
//					 document.getElementById("omega").innerHTML="";	
	var url	=	"ajax_respons.php?subcatId="+subcatID+"&sbcatId="+scatId+"&ran="+Math.random();	
	//alert(url);
	xmlHttp22	=	GetXmlHttpObject();
	xmlHttp22.open("GET",url,true)
	xmlHttp22.send(null)
	xmlHttp22.onreadystatechange = function()
	{		
			if (xmlHttp22.readyState==4 || xmlHttp22.readyState=="complete")
			{		
			  var txt2	 = xmlHttp22.responseText;
			      //alert(txt2);
					 if(txt2!="")
					 {
						// alert("cat_tree2");
					 //document.getElementById("cat_tree2").innerHTML=txt2;	
					 document.getElementById("cat_level_two").innerHTML=txt2;							
					 }	
			  }
	
	}
}

function get_city_by_state(stateID,scatId)
{
	var url	=	"ajax_respons.php?statId="+stateID+"&sbcatId="+scatId+"&ran="+Math.random();
	
	xmlHttp3	=	GetXmlHttpObject();
	xmlHttp3.open("GET",url,true)
	xmlHttp3.send(null)
	xmlHttp3.onreadystatechange = function()
	{		
			if (xmlHttp3.readyState==4 || xmlHttp3.readyState=="complete")
			{		
			  var txt	 = xmlHttp3.responseText;
			  //alert(txt);
					 if(txt!="")
					 {
						document.getElementById("bloc_city").innerHTML=xmlHttp3.responseText;
					 }	
			  }
	
	}
}

function get_topbanner(stateID,scatId)
{
	
	var url	=	"ajax_respons.php?statId="+stateID+"&sbcatId="+scatId+"&ran="+Math.random();;
	//alert(url);
	xmlHttp3	=	GetXmlHttpObject();
	xmlHttp3.open("GET",url,true)
	xmlHttp3.send(null)
	xmlHttp3.onreadystatechange = function()
	{		
			if (xmlHttp3.readyState==4 || xmlHttp3.readyState=="complete")
			{		
			  var txt	 = xmlHttp3.responseText;
			  //alert(txt);
					 if(txt!="")
					 {
					document.getElementById("city_link").innerHTML=xmlHttp3.responseText							
					 }	
			  }
	
	}
}

function changed_currency(curid,ref)
{
	
	var url	=	"multiple-currency.php?currId="+curid;
	//alert(url);
	xmlHttp4	=	GetXmlHttpObject();
	xmlHttp4.open("GET",url,true)
	xmlHttp4.send(null)
	xmlHttp4.onreadystatechange = function()
	{		
			if (xmlHttp4.readyState==4 || xmlHttp4.readyState=="complete")
			{		
			  var txt	 = xmlHttp4.responseText;
			  //alert(txt);
					 if(txt!="")
					 {
						 window.location=ref;
						 
					   //document.getElementById("city_link").innerHTML=xmlHttp3.responseText							
					 }	
			  }
	
	}
}

function serach_city_by_state(stateID,scatId)
{
	var url	= "ajax_respons.php?statIdsearch="+stateID+"&sbcatId="+scatId+"&ran="+Math.random();
	
	xmlHttp3 = GetXmlHttpObject();
	xmlHttp3.open("GET",url,true)
	xmlHttp3.send(null)
	xmlHttp3.onreadystatechange = function()
	{		
		if (xmlHttp3.readyState==4 || xmlHttp3.readyState=="complete")
		{		
			var txt	 = xmlHttp3.responseText;
			if(txt!="")
			{
				document.getElementById("bloc_city").innerHTML=xmlHttp3.responseText;
			}	
		}
	}
}

function verif_nbre_caract (objet)
{
	if ( objet.value.length<15) 
	
	 document.getElementById('message_desc').style.visibility='visible';
	
	else
	 document.getElementById('message_desc').style.visibility='hidden';
}


function check(valeur) 
{ 
	reg = new RegExp('[^0-9]+', 'g'); 
	if(reg.test(valeur)) 
	{ 
		valeur.value=valeur.value.replace(/[^0-9]+/, ''); 
	} 
	else 
	{
		return true; 
	} 
}

function VerifEmail(object)
{
	var regEmail = new RegExp('^[0-9a-z._-]+@{1}[0-9a-z.-]{2,}[.]{1}[a-z]{2,5}$','i');
	
	return regEmail.test(object.value);
}

function readURL(input,pos)
{
	if(((( input.files[0].size) / 1024 ) / 1024)>3){
		alert("Les photos de taille dépasse 3 Mo ne seront pas publiées.");
	}
	else{
    	if (input.files && input.files[0])
		{
			var reader = new FileReader();
		 	reader.onload = function (e)
								  {
										$("#"+pos.id)
										.attr('src',e.target.result)
										.width(90)
										.height(60);
								  };
		 	reader.readAsDataURL(input.files[0]);
		}
	}
}

$(document).ready(function() {
		
		$("#principale_select").focus(function(){
			//remove all the class add the messagebox classes and start fading
			//$("#msgboxcategory").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextcategory").removeClass().addClass('messagebox').fadeIn("slow");
			
				$("#msgtextcategory").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<urgent> Sélectionner la bonne catégorie est essentiel !<br /> 1/ La rubrique principale dans le menu déroulant<br /> 2/ Les sous-rubriques s’afficheront dessous. <br /> Regarder bien toutes les options avant de faire <br /> votre choix. </urgent>').fadeTo(900,1);
				});
		});
		/*
		$("#principale_select").blur(function(){
			
			$("#msgboxcategory").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextcategory").removeClass().addClass('messagebox').fadeIn("slow");
			if(document.frm.principale_select.value=="")
			{
				$("#msgboxcategory").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
				});
				$("#msgtextcategory").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
				});

			} 
			
			$("#msgtextcategory").empty();
		});*/
		
		//Onclik Controle boutton
		$("#button5").click(function()
		{
			var err=true;
			alert("h");
			//remove all the class add the messagebox classes and start fading
			$("#msgboxcategory").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextcategory").removeClass().addClass('messagebox').fadeIn("slow");
			
			if(document.frm.principale_select.value=="")
			{
				$("#msgboxcategory").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
				});
				
				$("#msgtextcategory").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
				});
				err=false;

			}
			 else {/*
				$("#msgboxcategory").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxyes').fadeTo(900,1);
				});*/
						$("#msgtextcategory").empty();
			}
			
			//alert(document.getElementById("ogiga").innerHTML.length);
			if(document.getElementById("ogiga").innerHTML.length!=0){
				//div ogiga not empty
					//remove all the class add the messagebox classes and start fading
				$("#msgboxogiga").removeClass().addClass('messagebox').fadeIn("slow");
				$("#msgtextogiga").removeClass().addClass('messagebox').fadeIn("slow");
				
				if($('input[type=radio][name=cat_level_two]:checked').length==0)
				{
					$("#msgboxogiga").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);	
						
					});
					$("#msgtextogiga").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
					});
					err=false;
	
				}
				 else {/*
					$("#msgboxogiga").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxyes').fadeTo(900,1);
	
					});*/
						$("#msgtextogiga").empty();
				}
			}
						
			//remove all the class add the messagebox classes and start fading
			$("#msgboxtitle").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtexttitle").removeClass().addClass('messagebox').fadeIn("slow");
			
			if(document.frm.classi_title.value=="")
			{
				$("#msgboxtitle").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);	
					
				});
				$("#msgtexttitle").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
				});
				err=false;

			} else {/*
				$("#msgboxtitle").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxyes').fadeTo(900,1);

				});*/
						$("#msgtexttitle").empty();
			}

			//remove all the class add the messagebox classes and start fading
			$("#msgboxadtype").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextadtype").removeClass().addClass('messagebox').fadeIn("slow");
			
			if(document.frm.classi_ad_type.value=="")
			{
				$("#msgboxadtype").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);	
					
				});
				$("#msgtextadtype").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
				});
				err=false;

			} else {/*
				$("#msgboxadtype").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxyes').fadeTo(900,1);

				});*/
						$("#msgtextadtype").empty();
			}

			//remove all the class add the messagebox classes and start fading
			$("#msgboxdesc").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextdesc").removeClass().addClass('messagebox').fadeIn("slow");
			
			if(document.frm.classi_desc.value=="")
			{
				$("#msgboxdesc").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);	
				});
				
				$("#msgtextdesc").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
				});
				err=false;
			}
			else if(document.frm.classi_desc.value.length<15){
				$("#msgboxdesc").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);	
				});
				
				$("#msgtextdesc").fadeTo(200,0.1,function()  //start fading the messagebox
				{
					$(this).html('').append('<urgent> Soyez le plus précis et détaillé possible.<br /> Les annonces contenant la meilleure information reçoivent le plus de contacts.<br> 15 caractères minimum. </urgent>').fadeTo(900,1);
					
				});
				
				err=false;

			}else if(document.frm.classi_desc.value.length>=10000)
			{
				$("#msgboxdesc").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
				
				});
				$("#msgtextdesc").fadeTo(200,0.1,function()  //start fading the messagebox
				{
					$(this).html('').append('<urgent>Veuillez de ne pas dépasser 10 000 caractères au maximum. </urgent>').fadeTo(900,1);
					
				});

				err=false;
			} else {/*
				$("#msgboxdesc").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxyes').fadeTo(900,1);

				});
				$("#msgtextdesc").fadeTo(200,0.1,function()  //start fading the messagebox
				{
					//$(this).html('').append('');
				});*/
						$("#msgtextdesc").empty();
			}

			//remove all the class add the messagebox classes and start fading
			$("#msgboxprice").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextprice").removeClass().addClass('messagebox').fadeIn("slow");
			
			if((document.frm.classi_price.value=="" || document.frm.classi_price.value==0) && document.frm.my_offer.value=="")
			{
				$("#msgboxprice").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
				});

				$("#msgtextprice").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
				});
				err=false;
			} else {
				//$("#msgboxprice").fadeTo(200,0.1,function()  //start fading the messagebox
				//{ 
				  //add message and change the class of the box and start fading
				  //$(this).html('').addClass('messageboxyes').fadeTo(900,1);

				//});
						$("#msgtextprice").empty();
			}
			
			//remove all the class add the messagebox classes and start fading
			$("#msgboxaddress").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextaddress").removeClass().addClass('messagebox').fadeIn("slow");
			
			if(document.frm.classi_address.value.length>=100)
			{
				//---------------------
				$("#msgboxaddress").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
				
				});
				$("#msgtextaddress").fadeTo(200,0.1,function()  //start fading the messagebox
				{
					$(this).html('').append('<urgent>Veuillez de ne pas dépasser 100 caractères au maximum. </urgent>').fadeTo(900,1);
					
				});
				err=false;
				//---------------------
			} else {
				/*
				$("#msgboxaddress").fadeTo(200,0.1,function()  //start fading the messagebox
				{$(this).html('').append('');
				});*/
				$("#msgtextaddress").fadeTo(200,0.1,function(){  //start fading the messagebox
					//$(this).html('').append('');
				});
			}
			
			//remove all the class add the messagebox classes and start fading
			$("#msgboxstate").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextstate").removeClass().addClass('messagebox').fadeIn("slow");
			
			if(document.frm.classi_state.value=="")
			{
				$("#msgboxstate").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
				});

				$("#msgtextstate").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
				});
				err=false;
			} else {/*
				$("#msgboxstate").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxyes').fadeTo(900,1);

				});*/
						$("#msgtextstate").empty();
			}
			
			//remove all the class add the messagebox classes and start fading
			$("#msgboxcity").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextcity").removeClass().addClass('messagebox').fadeIn("slow");
			
			if(document.frm.classi_city.value=="" )
			{
				$("#msgboxcity").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
				});

				$("#msgtextcity").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
				});
				err=false;
			} else {/*
				$("#msgboxcity").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxyes').fadeTo(900,1);

				});*/
						$("#msgtextcity").empty();
			}
			
			//remove all the class add the messagebox classes and start fading
			$("#msgboxzipcode").removeClass().addClass('messagebox').fadeIn("slow");
			$("#msgtextzipcode").removeClass().addClass('messagebox').fadeIn("slow");

			if(document.frm.classi_zipcode.value=="")
			{
				$("#msgboxzipcode").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
				});
				$("#msgtextzipcode").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
				});
				err=false;
			}
			else if(document.frm.classi_zipcode.value.length<4)
			{
				$("#msgboxzipcode").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
				});
				
				$("#msgtextzipcode").fadeTo(200,0.1,function()  //start fading the messagebox
				{
					$(this).html('').append('<urgent>Minimum 4 characters. </urgent>').fadeTo(900,1);
					
				});

				err=false;
			} 
			else {/*
				$("#msgboxzipcode").fadeTo(200,0.1,function()  //start fading the messagebox
				{ 
				  //add message and change the class of the box and start fading
				  $(this).html('').addClass('messageboxyes').fadeTo(900,1);

				});
				*/
				$("#msgtextzipcode").fadeTo(200,0.1,function()  //start fading the messagebox
				{
					//$(this).html('').append('').fadeTo(900,1);
					
				});
						$("#msgtextzipcode").empty();
			}
			
			
			if(document.getElementById("connect_member").innerHTML.length!=0){
				//div ogiga not empty
					
				//remove all the class add the messagebox classes and start fading
				$("#msgboxuser_id").removeClass().addClass('messagebox').fadeIn("slow");
				$("#msgtextuser_id").removeClass().addClass('messagebox').fadeIn("slow");
				
				if(document.frm.user_id.value=="" || !VerifEmail(document.frm.user_id))
				{
					$("#msgboxuser_id").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
	
					$("#msgtextuser_id").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
					});
					err=false;
				} else {/*
					$("#msgboxuser_id").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxyes').fadeTo(900,1);
	
					});*/
						$("#msgtextuser_id").empty();
				}
				
				//remove all the class add the messagebox classes and start fading
				$("#msgboxuser_password").removeClass().addClass('messagebox').fadeIn("slow");
				$("#msgtextuser_password").removeClass().addClass('messagebox').fadeIn("slow");
				
				if(document.frm.user_password.value=="" )
				{
					$("#msgboxuser_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
	
					$("#msgtextuser_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
					});
					err=false;
				}else if(document.frm.user_password.value.length<6){
					
					$("#msgboxuser_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
					
					$("#msgtextuser_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{
						$(this).html('').append('<urgent>Minimum 6 characters. </urgent>').fadeTo(900,1);
						
					});
					err=false;
				}
				else {/*
					$("#msgboxuser_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxyes').fadeTo(900,1);
	
					});
					
					$("#msgtextuser_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{
						$(this).html('').append('').fadeTo(900,1);
						
					});*/
					
						$("#msgtextuser_password").empty();
				}
				
				//remove all the class add the messagebox classes and start fading
				$("#msgboxconfirm_password").removeClass().addClass('messagebox').fadeIn("slow");
				$("#msgtextconfirm_password").removeClass().addClass('messagebox').fadeIn("slow");
				
				if((document.frm.confirm_password.value==""))
				{
					$("#msgboxconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
					
					$("#msgtextconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').append('<oblig>Ce champ est obligatoire.</oblig>').fadeTo(900,1);
					});
					err=false;
				}
				else if(document.frm.confirm_password.value!=document.frm.user_password.value){
					
					$("#msgboxconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
					
					$("#msgtextconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').append('<oblig>Vos Mot de passe ne correspondent pas. Veuillez réessayer.</oblig>').fadeTo(900,1);
					});
					err=false;
				}else if(document.frm.user_password.value.length<6){
					
					$("#msgboxconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxerror').fadeTo(900,1);
					});
					
					$("#msgtextconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{
						$(this).html('').append('<urgent>Minimum 6 characters. </urgent>').fadeTo(900,1);
						
					});
					err=false;
				}else {
					/*
					$("#msgboxconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').addClass('messageboxyes').fadeTo(900,1);
	
					});
					*/
					$("#msgtextconfirm_password").fadeTo(200,0.1,function()  //start fading the messagebox
					{
						//$(this).html('').append('').fadeTo(900,1);
						$("#msgtextconfirm_password").empty();
						
					});
				}
			}
			
			setTimeout(function() {
			  // wait 1 second before announcing the result
				$("#msgtextverifier").removeClass().addClass('messagebox').fadeIn("slow");	
				$("#msgtextverifier").empty();
			  	if(err==true){
					document.frm.submit();
				}
				else
				{				
					$("#msgtextverifier").fadeTo(200,0.1,function()  //start fading the messagebox
					{ 
					  //add message and change the class of the box and start fading
					  $(this).html('').append('<oblig>Veuillez remplir tous les champs obligatoires.</oblig>').fadeTo(900,1);
					});
				}
			 // "returns" the value
			}, 1000);
			
		});
		
		
});



/*******fenetre lightbox******************/
			$(document).ready(function ($) {

				// delegate calls to data-toggle="lightbox"
				$(document).delegate('*[data-toggle="lightbox"]:not([data-gallery="navigateTo"])', 'click', function(event) {
					event.preventDefault();
					return $(this).ekkoLightbox({
						onShown: function() {
							if (window.console) {
								return console.log('Checking our the events huh?');
							}
						},
						onNavigate: function(direction, itemIndex) {
							if (window.console) {
								return console.log('Navigating '+direction+'. Current item: '+itemIndex);
							}
						}
					});
				});

				//Programatically call
				$('#open-image').click(function (e) {
					e.preventDefault();
					$(this).ekkoLightbox();
				});
				$('#open-youtube').click(function (e) {
					e.preventDefault();
					$(this).ekkoLightbox();
				});

				$(document).delegate('*[data-gallery="navigateTo"]', 'click', function(event) {
					event.preventDefault();
					return $(this).ekkoLightbox({
						onShown: function() {
							var a = this.modal_content.find('.modal-footer a');
							if(a.length > 0) {
								a.click(function(e) {
									e.preventDefault();
									this.navigateTo(2);
								}.bind(this));
							}
						}
					});
				});

			});