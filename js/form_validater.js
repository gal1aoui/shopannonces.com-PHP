$(document).ready(function() {
	
				
			$("#regions a").add("area").mouseover(function() {
				var id=this.id.substring(this.id.indexOf("_") + 1);				
				var regionmap = $("#hoverregion_" + id);
				if (regionmap && regionmap.length > 0) {
					$("#area_highlight").removeClass().addClass("sprite_index_tn_tn_hover_region" + id );
					$("#region_"+id).removeClass().addClass("region map_state");
				}
			});
			$("#regions a").add("area").mouseout(function() {
				var id=this.id.substring(this.id.indexOf("_") + 1);
				var regionmap = $("#hoverregion_" + id);
				if (regionmap && regionmap.length > 0) {
					$("#area_highlight").removeClass();
					$("#region_"+id).removeClass().addClass("region link");
				}
			});
            $("#principale_select").focus(function(){
                //remove all the class add the messagebox classes and start fading
                //$("#msgboxcategory").removeClass().addClass('messagebox').fadeIn("slow");
                $("#msgtextcategory").removeClass().addClass('messagebox').fadeIn("slow");
                
                    $("#msgtextcategory").fadeTo(200,0.1,function()  //start fading the messagebox
                    { 
                      //add message and change the class of the box and start fading
                      $(this).html('').append('<urgent> Sélectionner la bonne catégorie est essentiel !<br /> 1/ La rubrique principale dans le menu déroulant<br /> 2/ Les sous-rubriques s’afficheront dessous.<br /> Regarder bien toutes les options avant de faire votre choix. </urgent>').fadeTo(900,1);
                    });
            });
			
			
					
					//Onclik Controle boutton publier-annonce
					$("#publier-annonce").click(function()
					{
						var err=true;
						
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
					
						$("#msgboxogiga").removeClass().addClass('messagebox').fadeIn("slow");
						$("#msgtextogiga").removeClass().addClass('messagebox').fadeIn("slow");
						
						//alert(document.getElementById("ogiga").innerHTML.length);
						if(document.getElementById("ogiga").innerHTML.length!=180
							 && document.getElementById("ogiga").innerHTML.length!=314
							  && document.getElementById("ogiga").innerHTML.length!=274
							  && document.getElementById("ogiga").innerHTML.length!=1306
							  && document.getElementById("ogiga").innerHTML.length!=1380
							  && document.getElementById("ogiga").innerHTML.length!=1346
							  && document.getElementById("ogiga").innerHTML.length!=277
							  && document.getElementById("ogiga").innerHTML.length!=255
							  && document.getElementById("ogiga").innerHTML.length!=317
							  && document.getElementById("ogiga").innerHTML.length!=351 && document.getElementById("ogiga").innerHTML.length!=0){
							//div ogiga not empty
								//remove all the class add the messagebox classes and start fading
							//alert($('input[type=radio][name=cat_level_two]:checked').length);
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
			/*
						//remove all the class add the messagebox classes and start fading
						$("#msgboxprice").removeClass().addClass('messagebox').fadeIn("slow");
						$("#msgtextprice").removeClass().addClass('messagebox').fadeIn("slow");
						
						if(document.frm.classi_price.value=="" && document.frm.my_offer.value=="")
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
						*/
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
                        else {
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
							$("#msgboxuser_name").removeClass().addClass('messagebox').fadeIn("slow");
							$("#msgtextuser_name").removeClass().addClass('messagebox').fadeIn("slow");
							
							if(document.frm.mem_lname.value=="")
							{
								$("#msgboxuser_name").fadeTo(200,0.1,function()  //start fading the messagebox
								{ 
								  //add message and change the class of the box and start fading
								  $(this).html('').addClass('messageboxerror').fadeTo(900,1);	
									
								});
								$("#msgtextuser_name").fadeTo(200,0.1,function()  //start fading the messagebox
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
										$("#msgtextuser_name").empty();
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
			
			
                    //Onclik Controle boutton
                    $("#editer-annonce").click(function()
                    {
                        var err=true;
						
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
                                    $("#msgboxogiga").empty();
                                    $("#msgtextogiga").empty();
                                    */
                        }
                        
                        $("#msgboxogiga").removeClass().addClass('messagebox').fadeIn("slow");
                        $("#msgtextogiga").removeClass().addClass('messagebox').fadeIn("slow");
						
                        if(document.getElementById("ogiga").innerHTML.length!=180
				 && document.getElementById("ogiga").innerHTML.length!=314
				  && document.getElementById("ogiga").innerHTML.length!=274 
				  && document.getElementById("ogiga").innerHTML.length!=265
				  && document.getElementById("ogiga").innerHTML.length!=225
				  && document.getElementById("ogiga").innerHTML.length!=299   && (document.getElementById("ogiga").innerHTML.length!=0)){
                            //div ogiga not empty
                                //remove all the class add the messagebox classes and start fading
                            $("#msgboxogiga").removeClass().addClass('messagebox').fadeIn("slow");
                            
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
                            
                            }
                             else {
                                    $("#msgtextogiga").empty();
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
            
                        } else {
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
            
                        } else {
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
                                $(this).html('').append('<urgent>Veuillez de ne pas dépasser 1000 caractères au maximum. </urgent>').fadeTo(900,1);
                                
                            });
            
                            err=false;
                        } else {
                                    $("#msgtextdesc").empty();
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
                        } else {
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
                        } else {
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
                        else {
                            $("#msgtextzipcode").fadeTo(200,0.1,function()  //start fading the messagebox

                            {
                                //$(this).html('').append('').fadeTo(900,1);
                                
                            });
                                    $("#msgtextzipcode").empty();
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
			
			
function readURL(input,pos)
{
	if(((( input.files[0].size) / 1024 ) / 1024)>3){
		alert("Les photos de taille dépasse 3 Mo ne seront pas publiées.");
		input.files[0].value='';
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


function cat_drop_prin_select(catID,scatId)
{
	document.getElementById("ogiga").innerHTML="";	
	document.getElementById("omega").innerHTML="";	
		
		var url	=	"function_respons.php?pcatId="+catID;
		
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
						if(xmlHttp2.responseText.length!=0)
						{
							//alert("ogiga");
							document.getElementById("ogiga").innerHTML=txt;
							if(catID==793 || catID==794){
								//alert("omega");
								//----------------------------
								var url	=	"function_respons.php?osubcatId="+catID+"&osbcatId="+scatId+"&ran="+Math.random();
								
								xmlHttp2.open("GET",url,true)
								xmlHttp2.send(null)
								xmlHttp2.onreadystatechange = function()
								{		
									if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
									{		
										var txt2 = xmlHttp2.responseText;
										
										document.getElementById("omega").innerHTML=txt2;
									}							
								}
							}
						}
						else
						{
							//alert("omega");
							//----------------------------
							var url	=	"function_respons.php?osubcatId="+catID+"&osbcatId="+scatId+"&ran="+Math.random();
							
							xmlHttp2.open("GET",url,true)
							xmlHttp2.send(null)
							xmlHttp2.onreadystatechange = function()
							{		
								if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
								{		
									var txt2 = xmlHttp2.responseText;
									
									document.getElementById("omega").innerHTML=txt2;
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
	var url	=	"function_respons.php?catId="+catID+"&sbcatId="+scatId+"&ran="+Math.random();
	
	xmlHttp2	=	GetXmlHttpObject();	
	xmlHttp2.open("GET",url,true)
	xmlHttp2.send(null)	
	xmlHttp2.onreadystatechange = function()
	{		
			if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
			{		
			  var txt	 = xmlHttp2.responseText;
					 if(txt!="")
					 {
						document.getElementById("cat_tree1").innerHTML=txt;							
					 }	
			  }
	}
}
function cat_drop_down_advertise(catID,scatId)
{
	var url	=	"function_respons.php?catId_advertise="+catID+"&sbcatId_advertise="+scatId+"&ran="+Math.random();
	
	xmlHttp2	=	GetXmlHttpObject();	
	xmlHttp2.open("GET",url,true)
	xmlHttp2.send(null)	
	xmlHttp2.onreadystatechange = function()
	{		
			if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
			{		
			  var txt	 = xmlHttp2.responseText;
			  
					 if(txt!="")
					 {
						document.getElementById("cat_tree1").innerHTML=txt;							
					 }	
			  }
	
	}
}

function cat_drop_down2_advertise(subcatID,scatId)
{
	var url	=	"function_respons.php?catId_advertise2="+subcatID+"&sbcatId_advertise2="+scatId+"&ran="+Math.random();

	xmlHttp2	=	GetXmlHttpObject();	
	xmlHttp2.open("GET",url,true)
	xmlHttp2.send(null)	
	xmlHttp2.onreadystatechange = function()
	{		
			if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
			{		
			  var txt	 = xmlHttp2.responseText;
					 if(txt!="")
					 {
						document.getElementById("cat_tree2").innerHTML=txt;							
					 }	
			  }
	
	}
}
function cat_drop_down2(subcatID,scatId)
{
	var url	=	"function_respons.php?subcatId="+subcatID+"&sbcatId="+scatId+"&ran="+Math.random();
	
	xmlHttp22	=	GetXmlHttpObject();
	xmlHttp22.open("GET",url,true)
	xmlHttp22.send(null)
	xmlHttp22.onreadystatechange = function()
	{		
			if (xmlHttp22.readyState==4 || xmlHttp22.readyState=="complete")
			{		
			  var txt2	 = xmlHttp22.responseText;
					 if(txt2!="")
					 {
						document.getElementById("cat_level_two").innerHTML=txt2;							
					 }	
			  }
	
	}
}

function cat_drop_down3(subcatID,scatId)
{
	document.getElementById("omega").innerHTML="";	
	var url	=	"function_respons.php?osubcatId="+subcatID+"&osbcatId="+scatId+"&ran="+Math.random();
	xmlHttp22	=	GetXmlHttpObject();
	xmlHttp22.open("GET",url,true)
	xmlHttp22.send(null)
	xmlHttp22.onreadystatechange = function()
	{		
			if (xmlHttp22.readyState==4 || xmlHttp22.readyState=="complete")
			{		
			  var txt2	 = xmlHttp22.responseText;
					 if(txt2!="")
					 {
					 	document.getElementById("omega").innerHTML=txt2;		
					 }	
			  }
	
	}
}
function cat_drop_down_search(subcatID,scatId)
{
	document.getElementById("filtre").innerHTML="";	
	var url	=	"function_respons.php?searchsubcatId="+subcatID+"&searchsbcatId="+scatId+"&ran="+Math.random();
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
					 	document.getElementById("filtre").innerHTML=txt2;
					 }	
			  }
	
	}
}

function Acat_drop_down(catID,scatId)
{
	var url	=	"../function_respons.php?catId="+catID+"&sbcatId="+scatId+"&ran="+Math.random();
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
	var url	=	"../function_respons.php?subcatId="+subcatID+"&sbcatId="+scatId+"&ran="+Math.random();	
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

function cat_search_drop_down(catID,scatId)
{
	var url	=	"../function_respons.php?catIdsearch="+catID+"&sbcatIdsearch="+scatId+"&ran="+Math.random();
	
				document.getElementById("ofiltre1").innerHTML="";	
				document.getElementById("ofiltre2").innerHTML="";	
				document.getElementById("ofiltre3").innerHTML="";	
	xmlHttp2	=	GetXmlHttpObject();	
	xmlHttp2.open("GET",url,true)
	xmlHttp2.send(null)	
	xmlHttp2.onreadystatechange = function()
	{		
		if (xmlHttp2.readyState==4 || xmlHttp2.readyState=="complete")
		{		
			var txt	 = xmlHttp2.responseText;
			if(txt!="")
			{
				document.getElementById("cat_tree1").innerHTML=txt;	
				document.getElementById("cat_tree2").innerHTML="<select name='subcatId' class='textbox1'><option value=''>Sous-catégorie</option></select>";
				
switch(catID){
	case '1':
	
		document.getElementById("ofiltre1").innerHTML=
		"Prix:"+
		"<input type='text' name='prixmin' value='' style='width:75px;' />"+
		"<input type='text' name='prixmax' value='' style='width:75px;' />";
	break;
	
	case '208':
	
		document.getElementById("ofiltre1").innerHTML=
		"Prix:"+
		"<input type='text' name='prixmin' value='' style='width:75px;' />"+
		"<input type='text' name='prixmax' value='' style='width:75px;' />"+
		"Année:<input type='text' name='anneemin' value='' style='width:75px;' />"+
		"<input type='text' name='anneemax' value='' style='width:75px;' />";
	break;
	
	case '213':
		document.getElementById("ofiltre1").innerHTML=" Prix:"+
    	"<input type='text' name='prixmin' value='' style='width:75px;' />"+
        "<input type='text' name='prixmax' value='' style='width:75px;' />"	;
	break;
	
	case '833':
		
		document.getElementById("ofiltre1").innerHTML="Prix:"+
    	"<input type='text' name='prixmin' value='' style='width:75px;' />"+
        "<input type='text' name='prixmax' value='' style='width:75px;' />"	;
	break;
	
	case '835':
		
		document.getElementById("ofiltre1").innerHTML="Age:"+
    	"<input type='text' name='prixmin' value='' style='width:75px;' />"+
        "<input type='text' name='prixmax' value='' style='width:75px;' />"	;
	break;
	
}
			}	
		}
	}
}

function cat_search_drop_down2(subcatID,scatId)
{
	var url	=	"function_respons.php?subcatId="+subcatID+"&sbcatId="+scatId+"&ran="+Math.random();
	
				document.getElementById("ofiltre2").innerHTML="";	
				document.getElementById("ofiltre3").innerHTML="";	
				
	xmlHttp22	=	GetXmlHttpObject();
	xmlHttp22.open("GET",url,true)
	xmlHttp22.send(null)
	xmlHttp22.onreadystatechange = function()
	{		
		if (xmlHttp22.readyState==4 || xmlHttp22.readyState=="complete")
		{		
			var txt2	 = xmlHttp22.responseText;
			if(txt2!="")
			{
			document.getElementById("cat_tree2").innerHTML=txt2;							
			}	
		}	
	}
switch(subcatID){
	case '899':
	
		document.getElementById("ofiltre2").innerHTML+="Km:"+
    	"<input type='text' name='kmmin' value='' style='width:75px;' />"+
        "<input type='text' name='kmmax' value='' style='width:75px;' />";
		break;
		
	case '773':
	
		document.getElementById("ofiltre2").innerHTML+="Pièce:"+
    	"<input type='text' name='piecemin' value='' style='width:75px;' />"+
        "<input type='text' name='piecemax' value='' style='width:75px;' />"+
	"Surface:"+
    	"<input type='text' name='surfacemin' value='' style='width:75px;' />"+
        "<input type='text' name='surfacemax' value='' style='width:75px;' />";
		break;
		
	case '775':

		document.getElementById("ofiltre2").innerHTML+="Pièce:"+
		"<input type='text' name='piecemin' value='' style='width:75px;' />"
		"<input type='text' name='piecemax' value='' style='width:75px;' />";
		break;
		
	case '783':

		document.getElementById("ofiltre2").innerHTML+="Surface:"+
    	"<input type='text' name='surfacemin' value='' style='width:75px;' />"+
        "<input type='text' name='surfacemax' value='' style='width:75px;' />";
		break;
		
	case '929':
		document.getElementById("ofiltre2").innerHTML+="Espèce:"+
    	"<select name='sp_common_main_type' onchange=''>"+
         "   <option value='' selected=''>Indifférent</option>"+
          "  <option value='Chat'>Chat</option>"+
           " <option value='Chien'>Chien</option>"+
            "<option value='Cheval'>Cheval</option>"+
            "<option value='Oiseau'>Oiseau</option>"+
            "<option value='Rongeur'>Rongeur</option>"+
           " <option value='Reptile'>Reptile</option>"+
          "  <option value='Poisson'>Poisson</option>"+
         "   <option value='Autre animal'>Autre animal</option>"+
        "</select>"	;
	break;
}

}
function search_drop_down3(subcatID,scatId)
{
				document.getElementById("ofiltre3").innerHTML="";	
switch(subcatID){
	case '900':
	
		document.getElementById("ofiltre3").innerHTML+="Energie:"+
		"<select name='sp_vehicules_energy' onchange=''>"+
		"	<option value='' selected=''>Indifférent</option>"+
		"	<option value='Essence'>Essence</option>"+
		"	<option value='Diesel'>Diesel</option>"+
		"	<option value='GPL'>GPL</option>"+
		"	<option value='Electrique'>Electrique</option>"+
		"	<option value='Hybride'>Hybride</option>"+
		"</select>";
		break;
		
	case '901':

		document.getElementById("ofiltre3").innerHTML+="Cylindrée:"+
			"<input type='text' name='cylindreemin' value='' style='width:75px;' />"+
			"<input type='text' name='cylindreemax' value='' style='width:75px;' />";
		break;

	case '904':

		document.getElementById("ofiltre3").innerHTML+="Longueur(m):"+
			"<input type='text' name='longueurmin' value='' style='width:75px;' />"+
			"<input type='text' name='longueurmax' value='' style='width:75px;' />";
		break;
		
	case '784':

		document.getElementById("ofiltre3").innerHTML+="A vendre/A louer:"+
    	"<select name='sp_common_designation'>"+
        	"<option value='' selected=''>Indifférent</option>"+
            "<option value='A vendre'>A vendre</option>"+
            "<option value='A louer'>A louer</option>"+
		"</select>";
		break;
		
	case '927':

		document.getElementById("ofiltre3").innerHTML+="Taille:"+
 "   	<input type='text' name='taillemin' value='' style='width:75px;' />"+
"        <input type='text' name='taillemax' value='' style='width:75px;' />";
		break;
		
}

}

function get_city_by_state(stateID,scatId)
{
	var url	=	"function_respons.php?statId="+stateID+"&sbcatId="+scatId+"&ran="+Math.random();
	
	xmlHttp3	=	GetXmlHttpObject();
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

function serach_city_by_state(stateID,scatId)
{
	var url	= "function_respons.php?statIdsearch="+stateID+"&sbcatId="+scatId+"&ran="+Math.random();
	
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

function get_topbanner(stateID,scatId)
{
	
	var url	=	"function_respons.php?statId="+stateID+"&sbcatId="+scatId+"&ran="+Math.random();;
	
	xmlHttp3	=	GetXmlHttpObject();
	xmlHttp3.open("GET",url,true)
	xmlHttp3.send(null)
	xmlHttp3.onreadystatechange = function()
	{		
			if (xmlHttp3.readyState==4 || xmlHttp3.readyState=="complete")
			{		
			  var txt	 = xmlHttp3.responseText;
			  
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
	
	xmlHttp4	=	GetXmlHttpObject();
	xmlHttp4.open("GET",url,true)
	xmlHttp4.send(null)
	xmlHttp4.onreadystatechange = function()
	{		
			if (xmlHttp4.readyState==4 || xmlHttp4.readyState=="complete")
			{		
			  var txt	 = xmlHttp4.responseText;
			  
					 if(txt!="")
					 {
						 window.location=ref;
						 
					   //document.getElementById("city_link").innerHTML=xmlHttp3.responseText							
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
	a = object.value;
	valide1 = false;
	
	for(var j=1;j<(a.length);j++){
		if(a.charAt(j)=='@'){
			if(j<(a.length-4)){
				for(var k=j;k<(a.length-2);k++){
					if(a.charAt(k)=='.') valide1=true;
				}
			}
		}
	}
	//if(valide1==false) alert("Veuillez saisir une adresse email valide.");
	return valide1;
}

//----------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------------------

/********** Common Function ******************/

function isValidusername(email){
	var regExp=/^([a-zA-Z0-9_\-])+$/;  
	return regExp.test(email);
}
function RemoveLTSpace(elemval){
     var val=elemval.replace(/\s*/,"")
     var val=val.replace(/\s*$/,"")
     return val;
}
function isEmailAddr(email){
 var regExp	=	/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;  
  return regExp.test(email);
}
function isAlphabet(name){
  var regExp	=	/^[A-Za-z\s]+$/;  
  return regExp.test(name);
}

function isURL(s) {
 	var regexp = /(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;
	 return regexp.test(s); 	
}

function validateFileExtension(fld) {
	var regExp	=	/^[0-9A-Za-z\s_ -]+(.[jJ][pP][gG]|.[gG][iI][fF]|.[jJ][pP][eE][gG]|.[pP][nN][gG])$/;  
	fPath= new String(fld);
	fileName= fPath.substring(fPath.lastIndexOf('\\')+1);     
	return regExp.test(fileName);
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
	if(validcheck(name)==true) {
		if(confirm("Etes-vous sûr de vouloir effacer l'enregistrement?")) {
			return true;  
		} else  {
			return false;  
		}
	}
	else if(validcheck(name)==false) {
		alert("Sélectionnez au moins une case à cocher.");		
		return false;
	}
}


function sendemailConfirmFromUser(name)
{		
	////////alert("aaaaaa");
	if(validcheck(name)==true)
	{
		if(confirm("Etes-vous sûr que vous voulez envoyer cette rediffusion personne"))
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
		alert("Sélectionnez au moins une case à cocher.");		
		return false;
	}
}


function Check_reg(chk)
{
	if(chk.check_add.checked==1){		
		chk.mem_address.value=chk.comp_address.value;		
		chk.mem_city.value= chk.comp_city.value;
		chk.mem_state.value= chk.comp_state.value;
		chk.mem_postal.value= chk.comp_postal.value;		
		chk.mem_country.value= chk.comp_country.options[chk.comp_country.selectedIndex].value;
		
	} 
	if(chk.check_add.checked==0){
		chk.mem_address.value='';
		chk.mem_city.value='';
		chk.mem_state.value='';
		chk.mem_postal.value='';
		chk.mem_country.value=chk.comp_country.options[0].value;
		
	}
	
}


/******* Start of contact us  from  validation ************/


function validate_savesearch(obj){
	if(RemoveLTSpace(obj.save_title.value)=="Search Title"){
		alert("S'il vous plaît entrer titre à sauvé.");
		obj.save_title.focus();
        return false;
	}
	if(RemoveLTSpace(obj.save_title.value)==""){
		alert("S'il vous plaît entrer titre à sauvé.");
		obj.save_title.focus();
        return false;
	}
	
}

function validate_headersearch(obj){
	if(RemoveLTSpace(obj.keyword.value)=="Enter Your Keywords.." && (obj.classi_city.value)=="" ){
		alert("S'il vous plaît entrer mot-clé ou sélectionnez la ville.");
		obj.keyword.focus();
        return false;
	}
}
function validate_advertise(obj){
	
	if(RemoveLTSpace(obj.name.value)==""){
		alert("S'il vous plaît entrer votre nom.");
		obj.name.focus();
        return false;
	}
	if(RemoveLTSpace(obj.email.value)==""){
		alert("S'il vous plaît entrer votre e-mail.");
		obj.email.focus();
        return false;
	}
	if(!isEmailAddr(obj.email.value)){
		alert("S'il vous plaît entrer votre e-mail valide.");
		obj.email.focus();
        return false;
	}
	if(RemoveLTSpace(obj.org.value)==""){
		alert("S'il vous plaît entrer votre Nom de compagnie .");
		obj.org.focus();
        return false;
	}
	if(RemoveLTSpace(obj.contact_no.value)==""){
		alert("S'il vous plaît entrer votre No Tél.");
		obj.contact_no.focus();
        return false;
	}
	
	
	if(!Number(obj.contact_no.value)){
		alert("S'il vous plaît entrer votre No Tél.");
		obj.contact_no.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.cat_level_root.value)==""){
		alert("S'il vous plaît entrer la Categorie.");
		obj.cat_level_root.focus();
        return false;
	}
	if(RemoveLTSpace(obj.ban_position.value)==""){
		alert("S'il vous plaît entrer Position de la Bannière.");
		obj.ban_position.focus();
        return false;
	}
	if(RemoveLTSpace(obj.file.value)==""){
		alert("S'il vous plaît choisir Image de la Bannière.");
		obj.file.focus();
        return false;
	}
	if(RemoveLTSpace(obj.urls.value)==""){
		alert("S'il vous plaît entrer URL de la Bannière.");
		obj.urls.focus();
        return false;
	}
	if(RemoveLTSpace(obj.comments.value)==""){
		alert("S'il vous plaît entrer votre Commentaires .");
		obj.comments.focus();
        return false;
	}
}

function validate_contactus(obj){
	if(RemoveLTSpace(obj.name.value)==""){
		alert("S'il vous plaît entrer votre nom.");
		obj.name.focus();
        return false;
	}
	if(!isAlphabet(obj.name.value)){
		alert("S'il vous plaît entrer vos alphabets seulement.");
		obj.name.focus();
        return false;
	}
		
	
	if(RemoveLTSpace(obj.email.value)==""){
		alert("S'il vous plaît entrer votre e-mail.");
		obj.email.focus();
        return false;
	}
	if(!isEmailAddr(obj.email.value)){
		alert("S'il vous plaît entrer votre e-mail valide.");
		obj.email.focus();
        return false;
	}
 if(!isAlphabet(obj.city.value)){
		alert("S'il vous plaît entrer le sujet.");
        obj.city.value="";
		obj.city.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.comment.value)==""){
		alert("S'il vous plaît entrer vos commentaires.");
		obj.comment.focus();
        return false;
	}
	
}
/******* End  of info request   from  validation ************/

function validate_feedback(obj){
	if(RemoveLTSpace(obj.name.value)==""){
		alert("S'il vous plaît entrer votre nom.");
		obj.name.focus();
        return false;
	}
	if(!isAlphabet(obj.name.value)){
		alert("S'il vous plaît entrer vos alphabets seulement.");
		obj.name.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.email.value)==""){
		alert("S'il vous plaît entrer votre e-mail.");
		obj.email.focus();
        return false;
	}
	if(!isEmailAddr(obj.email.value)){
		alert("S'il vous plaît entrer votre e-mail valide.");
		obj.email.focus();
        return false;
	}
	if(RemoveLTSpace(obj.phone_no.value)==""){
		alert("S'il vous plaît entrer votre numéro de téléphone.");
		obj.phone_no.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.address.value)==""){
		alert("S'il vous plaît, entrez votre adresse.");
		obj.address.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.country.value)==""){
		alert("S'il vous plaît entrer dans votre pays.");
		obj.country.focus();
        return false;
	}
  if(RemoveLTSpace(obj.sate.value)==""){
		alert("S'il vous plaît entrer votre état.");        
		obj.sate.focus();
        return false;
	}
 if(!isAlphabet(obj.sate.value)){
		alert("S'il vous plaît entrer alphabets seulement.");
        obj.sate.value="";
		obj.sate.focus();
        return false;
	}
  if(RemoveLTSpace(obj.city.value)==""){
		alert("S'il vous plaît entrer votre ville.");
		obj.city.focus();
        return false;
	}

 if(!isAlphabet(obj.city.value)){
		alert("S'il vous plaît entrer alphabets seulement.");
        obj.city.value="";
		obj.city.focus();
        return false;
	}

	if(RemoveLTSpace(obj.comment.value)==""){
		alert("S'il vous plaît entrer vos commentaires.");
		obj.comment.focus();
        return false;
	}
	
}

/******* Start of register product form   validation ************/
/*function validate_advertise(obj){
	if(RemoveLTSpace(obj.name.value)==""){
		alert("S'il vous plaît entrer votre nom.");
		obj.name.focus();
        return false;
	}
	if(!isAlphabet(obj.name.value)){
		alert("S'il vous plaît entrer vos alphabets seulement.");
		obj.name.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.email.value)==""){
		alert("S'il vous plaît entrer votre e-mail.");
		obj.email.focus();
        return false;
	}
	if(!isEmailAddr(obj.email.value)){
		alert("S'il vous plaît entrer votre e-mail valide.");
		obj.email.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.org.value)==""){
		alert("S'il vous plaît entrer le nom de votre entreprise.");
		obj.org.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.contact_no.value)==""){
		alert("S'il vous plaît entrer contactez pas.");
		obj.contact_no.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.cat_level_root.value)==""){
		alert("S'il vous plaît sélectionner catégorie.");
		obj.cat_level_root.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.ban_position.value)==""){
		alert("S'il vous plaît choisir la position de la bannière.");
		obj.ban_position.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.file.value)==""){
		alert("S'il vous plaît télécharger le fichier.");
		obj.file.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.urls.value)==""){
		alert("S'il vous plaît entrer votre URL de site Web.");
		obj.urls.focus();
        return false;
	}
	if(!isURL(obj.urls.value)){
		alert("S'il vous plaît entrer une adresse valide Site Web.");
		obj.urls.focus();
        return false;
	}	
		if(RemoveLTSpace(obj.comments.value)==""){
		alert("S'il vous plaît entrer vos commentaires.");
		obj.comments.focus();
        return false;
	}
	
	
}
*/
/******* End  of register product form validation ************/


/******* start  of apply job  form validation ************/
function validate_classified_inquire(obj){
	if(RemoveLTSpace(obj.sender_email.value)==""){
		alert("S'il vous plaît entrer votre e-mail.");
		obj.sender_email.focus();
        return false;
	}
	if(!isEmailAddr(obj.sender_email.value)){
		alert("S'il vous plaît entrer votre e-mail valide.");
		obj.sender_email.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.sender_name.value)==""){
		alert("S'il vous plaît entrer votre nom.");
		obj.sender_name.focus();
        return false;
	}
	
	if(!isAlphabet(obj.sender_name.value)){
		alert("S'il vous plaît entrer vos alphabets seulement.");
		obj.sender_name.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.sender_msg.value)==""){
		alert("S'il vous plaît entrez votre message.");
		obj.sender_msg.focus();
        return false;
	}
	if(RemoveLTSpace(obj.code.value)==""){
		alert("S'il vous plaît entrer le code de vérification.");
		obj.code.focus();
        return false;
	}
	/*
	if(obj.trems.checked == false){
		alert("S'il vous plaît entrer vérifier les termes et conditions.");
		obj.trems.focus();
        return false;
	}
	*/
}
/******* end  of apply job  form validation ************/



/******* start  of login  form validation ************/
function validate_loginform(obj){	
	if(RemoveLTSpace(obj.userid.value)==""){
		alert("S'il vous plaît entrer nom d'utilisateur.");
		obj.userid.focus();
        return false;
	}
	if(!isEmailAddr(obj.userid.value)){
		alert("S'il vous plaît entrer un nom d'utilisateur valide.");
		obj.userid.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.userpass.value)==""){
		alert("S'il vous plaît entrer votre mot de passe.");
		obj.userpass.focus();
        return false;
	}	
	
	
}
/******* end   of login  form validation ************/

/******* Start Forum reply form validation ************/
function validate_forumreply(obj){
	if(RemoveLTSpace(obj.name.value)==""){
		alert("S'il vous plaît entrer votre nom.");
		obj.name.focus();
        return false;
	}
	if(!isAlphabet(obj.name.value)){
		alert("S'il vous plaît entrer vos alphabets seulement.");
		obj.name.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.email.value)==""){
		alert("S'il vous plaît entrer votre e-mail.");
		obj.email.focus();
        return false;
	}
	if(!isEmailAddr(obj.email.value)){
		alert("S'il vous plaît entrer votre e-mail valide.");
		obj.email.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.heading.value)==""){
		alert("S'il vous plaît entrer votre titre.");
		obj.heading.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.comment.value)==""){
		alert("S'il vous plaît entrer votre commentaire.");
		obj.comment.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.verif_box.value)==""){
		alert("S'il vous plaît entrez le code de vérification.");
		obj.verif_box.focus();
        return false;
	}


}
/******* End Forum reply form validation ************/


function validate_username(obj){
	if(RemoveLTSpace(obj.username.value)==""){
		alert("S'il vous plaît entrer le nom de votre site.");
		obj.username.focus();
        return false;
	}
	if(!isValidusername(obj.username.value)){
	   alert("S'il vous plaît entrer un nom de site valide. Aucun caractère spécial autorisé.");
	   obj.username.focus();
       return false;
	}
}

function validate_sendreplay(obj){
	if(RemoveLTSpace(obj.subject.value)==""){
		alert("S'il vous plaît entrez votre sujet.");
		obj.subject.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.msg.value)==""){
		alert("S'il vous plaît entrez votre message.");
		obj.msg.focus();
        return false;
	}
}

function validate_registration(obj){
	
	if(!isEmailAddr(obj.user_id.value)){
		alert("S'il vous plaît entrer votre email valide.");
		obj.user_id.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.mem_lname.value)==""){
		alert("S'il vous plaît entrer votre nom.");
		obj.mem_lname.focus();
        return false;
	}
	
	if(obj.user_password.value==""){
		alert("S'il vous plaît entrer votre mot de passe.");
		obj.user_password.focus();
        return false;
	}
	
	if(obj.user_password.value.length<6){
		alert("Mot de passe 6 caractères minimum ..");
		obj.user_password.focus();
        return false;
	}
	
	
	if(obj.confirm_password.value==""){
		alert("S'il vous plaît entrer de nouveau votre mot de passe.");
		obj.confirm_password.focus();
        return false;
	}
	if(obj.confirm_password.value.length<6){
		alert("Confirmer mot de passe au moins 6 caractères ..");
		obj.confirm_password.focus();
        return false;
	}
	
	if(obj.user_password.value!=obj.confirm_password.value){
		alert("Mot de passe et Confirmer le mot de passe ne sont pas identiques.");
		obj.user_password.focus();
        return false;
	}
	
	
	
	
	
	
	if(RemoveLTSpace(obj.mem_fname.value)==""){
		alert("S'il vous plaît entrer votre prénom.");
		obj.mem_fname.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_lname.value)==""){
		alert("S'il vous plaît entrer votre nom de famille.");
		obj.mem_lname.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.mem_email.value)==""){
		alert("S'il vous plaît entrer votre e-mail.");
		obj.mem_email.focus();
        return false;
	}
	if(!isEmailAddr(obj.mem_email.value)){
		alert("S'il vous plaît entrer votre nom e-mail valide.");
		obj.mem_email.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_address.value)==""){
		alert("S'il vous plaît, entrez votre adresse.");
		obj.mem_address.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.mem_postal.value)==""){
		alert("S'il vous plaît entrer votre code postal.");
		obj.mem_postal.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_city.value)==""){
		alert("S'il vous plaît entrer votre ville.");
		obj.mem_city.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_state.value)==""){
		alert("S'il vous plaît entrer votre état.");
		obj.mem_state.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_country.value)==""){
		alert("S'il vous plaît entrer dans votre pays.");
		obj.mem_country.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_telno.value)==""){
		alert("S'il vous plaît entrer votre numéro de téléphone.");
		obj.mem_telno.focus();
        return false;
	}
	if(RemoveLTSpace(obj.daily_alrt.value)==""){
		alert("S'il vous plaît choisir Alertes quotidiennes.");
		obj.daily_alrt.focus();
        return false;
	}
	
}

function validate_editAccount(obj){	
	
	
	if(RemoveLTSpace(obj.mem_fname.value)==""){
		alert("S'il vous plaît entrer votre prénom.");
		obj.mem_fname.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_lname.value)==""){
		alert("S'il vous plaît entrer votre nom de famille.");
		obj.mem_lname.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.mem_email.value)==""){
		alert("S'il vous plaît entrer votre e-mail.");
		obj.mem_email.focus();
        return false;
	}
	if(!isEmailAddr(obj.mem_email.value)){
		alert("S'il vous plaît entrer votre nom e-mail valide.");
		obj.mem_email.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_address.value)==""){
		alert("S'il vous plaît, entrez votre adresse.");
		obj.mem_address.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.mem_postal.value)==""){
		alert("S'il vous plaît entrer votre code postal.");
		obj.mem_postal.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_city.value)==""){
		alert("S'il vous plaît entrer votre ville.");
		obj.mem_city.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_state.value)==""){
		alert("S'il vous plaît entrer votre état.");
		obj.mem_state.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_country.value)==""){
		alert("S'il vous plaît entrer dans votre pays.");
		obj.mem_country.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_telno.value)==""){
		alert("S'il vous plaît entrer votre numéro de téléphone.");
		obj.mem_telno.focus();
        return false;
	}	
	
}

function validate_post_classified(obj){	
	if(RemoveLTSpace(obj.cat_level_root.value)==""){
		alert("S'il vous plaît sélectionner le nom de la catégorie.");
		obj.cat_level_root.focus();
        return false;
	}
	if(RemoveLTSpace(obj.cat_level_one.value)==""){
		alert("S'il vous plaît choisir sous le nom de la catégorie.");
		obj.cat_level_one.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.cat_level_two.value)==""){
		alert("S'il vous plaît sélectionner un sous sous le nom de la catégorie.");
		obj.cat_level_two.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.classi_title.value)==""){
		alert("S'il vous plaît entrer titre de l'annonce.");
		obj.classi_title.focus();
        return false;
	}
	if(RemoveLTSpace(obj.classi_ad_type.value)==""){
		alert("S'il vous plaît sélectionner le type d'annonce.");
		obj.classi_ad_type.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.classi_desc.value)==""){
		alert("S'il vous plaît entrer Description classifiées.");
		obj.classi_desc.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.classi_price.value)=="" && (obj.my_offer.value)=="" ){
		alert("S'il vous plaît entrer prix classifiées ou sélectionner une option.");
		obj.classi_price.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.classi_address.value)==""){
		alert("S'il vous plaît entrez l'adresse classifiées.");
		obj.classi_address.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.classi_city.value)==""){
		alert("S'il vous plaît entrer classée ville.");
		obj.classi_city.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.classi_state.value)==""){
		alert("S'il vous plaît entrer dans l'état classifiées.");
		obj.classi_state.focus();
        return false;
	}
	if(RemoveLTSpace(obj.classi_zipcode.value)==""){
		alert("S'il vous plaît entrer le code postal classifiées.");
		obj.classi_zipcode.focus();
        return false;
	}
	if(RemoveLTSpace(obj.classi_email.value)==""){
		alert("S'il vous plaît entrer votre nom e-mail.");
		obj.classi_email.focus();
        return false;
	}
	if(!isEmailAddr(obj.classi_email.value)){
		alert("S'il vous plaît entrer votre nom e-mail valide.");
		obj.classi_email.focus();
        return false;
	}	
	
}

function validate_login(obj){
	if(RemoveLTSpace(obj.username.value)==""){
		alert("S'il vous plaît entrer votre e-mail.");
		obj.username.focus();
        return false;
	}
	if(!isEmailAddr(obj.username.value)){
		alert("S'il vous plaît entrez l'adresse e-mail valide.");
		obj.username.focus();
        return false;
	}
	if(obj.pwd.value==""){
		alert("S'il vous plaît entrer votre mot de passe.");
		obj.pwd.focus();
        return false;
	}
}

function validate_ref(obj){
	
	if(RemoveLTSpace(obj.your_name.value)==""){
		alert("S'il vous plaît entrer votre nom.")
		obj.your_name.focus();   
		return false;
	}
	if(!isNaN(obj.your_name.value)){
		alert("S'il vous plaît entrer valeur alphabétique à votre nom.")
		obj.your_name.focus(); 
		return false;
	}   
	if(RemoveLTSpace(obj.your_email.value)== ""){
		alert("S'il vous plaît, entrez votre adresse e-mail.")
		obj.your_email.focus(); 
		return false;
	}
	if(!isEmailAddr(obj.your_email.value)){
		alert("S'il vous plaît vérifier votre e-mail.");
		obj.your_email.focus();
		return false;
	}
	if(RemoveLTSpace(obj.email1.value)== ""){
		alert("S'il vous plaît, entrez email1.")
		obj.email1.focus(); 
		return false;
	}
	
	if(!isEmailAddr(obj.email1.value)){
		alert("S'il vous plaît vérifier votre email1.");
		obj.email1.focus();
		return false;
	}
	
	if(RemoveLTSpace(obj.email2.value)!= ""){
		if(!isEmailAddr(obj.email2.value)){
			alert("S'il vous plaît vérifier votre email2.");
			obj.email2.focus(); 
			return false;
		}
	}
	if(RemoveLTSpace(obj.email3.value)!= ""){
		if(!isEmailAddr(obj.email3.value)){
			alert("S'il vous plaît vérifier votre email3.");
			obj.email3.focus(); 
			return false;
		}
	}
	
}
function validate_refriend(obj){
	
	if(RemoveLTSpace(obj.your_name.value)==""){
		alert("S'il vous plaît entrer votre nom.")
		obj.your_name.focus();   
		return false;
	}
	if(!isNaN(obj.your_name.value)){
		alert("S'il vous plaît entrer valeur alphabétique à votre nom.")
		obj.your_name.focus(); 
		return false;
	}   
	if(RemoveLTSpace(obj.your_email.value)== ""){
		alert("S'il vous plaît, entrez votre adresse e-mail.")
		obj.your_email.focus(); 
		return false;
	}
	if(!isEmailAddr(obj.your_email.value)){
		alert("S'il vous plaît vérifier votre e-mail.");
		obj.your_email.focus();
		return false;
	}
	if(RemoveLTSpace(obj.friend_name.value) == "") {
		alert("S'il vous plaît entrer le nom de votre ami.")
		obj.friend_name.focus(); 
		return false;
	}
	if(!isNaN(obj.friend_name.value)){
		alert("S'il vous plaît entrer valeur alphabétique au nom de votre ami.")
		obj.friend_name.focus();
		return false;
	}	  
	if(RemoveLTSpace(obj.friend_email.value)== ""){
		alert("S'il vous plaît entrez l'adresse email de votre ami.")
		obj.friend_email.focus(); 
		return false;
	}
	if(!isEmailAddr(obj.friend_email.value)){
		alert("S'il vous plaît vérifier l'adresse e-mail  de votre ami.");
		obj.friend_email.focus();
		return false;
	}
	
	
}

<!--  jquery  for classified reply ------->
$(document).ready(function(){
	$("a[id^='rep']").each(function(){
		$(this).click(function(event) {
			event.preventDefault();
				var objId=$(this).attr('id').substring(3);
				 $(this + " img[src*='close.gif']").click(function(){
					$("a[id='rep"+objId+"']").show();
					 $("#inq"+objId).hide();
					 });					 
					$("a[id^='rep']").each(function(){
							 var objId1=$(this).attr('id').substring(3);
							if(objId1==objId){
								$(this).hide();
								$("#inq"+objId1).show();
								 }else{
								$(this).show();
								$("#inq"+objId1).hide();
								 }
						 });
					});
					
			 }); 
							 
});


function upload_photo(object,dest)
{
	alert(object.files[0]);
	var url	=	"function_respons.php?uploadphoto="+object.files[0]+"&ran="+Math.random();;
	
	xmlHttp3	=	GetXmlHttpObject();
	xmlHttp3.open("GET",url,true)
	xmlHttp3.send(null)
	xmlHttp3.onreadystatechange = function()
	{		
			if (xmlHttp3.readyState==4 || xmlHttp3.readyState=="complete")
			{		
			  var txt	 = xmlHttp3.responseText;
			  
					if(txt!="")
					{
						document.getElementById("city_link").innerHTML=xmlHttp3.responseText							
					 }	
			  }
	
	}
}
<!-- End  jquery  for classified reply ------->