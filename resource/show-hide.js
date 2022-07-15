function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}
function MM_openBrWindow(theURL,winName,features) { //v2.0
  window.open(theURL,winName,features);
}

function mandatory(){
  var re=0; 
 if(document.form_p.brust && document.form_p.brust.value!=''  && document.form_p.brust.value!=0){
  re=re+1;
 }

 if(document.form_p.hips && document.form_p.hips.value!=''  && document.form_p.hips.value!=0){
  re=re+1;
 }

 if(document.form_p.waist && document.form_p.waist.value!=''  && document.form_p.waist.value!=0 ){
  re=re+1;
 }
 
 if(document.form_p.length && document.form_p.length.value!=''  && document.form_p.length.value!=0){
  re=re+1;
 }

 if(document.form_p.m_color_id && document.form_p.m_color_id.value!=''  && document.form_p.m_color_id.value!=0){
  re=re+1;
 }
 
 if(re>0){
   document.form_p.submit();
 }else{
   alert("Please select atleast one measurement.");
   return false;
 }
}

function MM_reloadPage(init) {  //reloads the window if Nav4 resized
  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
    document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
}
MM_reloadPage(true);

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_showHideLayers() { //v6.0
  var i,p,v,obj,args=MM_showHideLayers.arguments;
  for (i=0; i<(args.length-2); i+=3) if ((obj=MM_findObj(args[i]))!=null) { v=args[i+2];
    if (obj.style) { obj=obj.style; v=(v=='show')?'visible':(v=='hide')?'hidden':v; }
    obj.visibility=v; }
}

function show_menu(menuID){
 //alert(menuID);
if(document.getElementById(menuID).style.display=='none'){
	  document.getElementById(menuID).style.display='block';
	 }

}
function hide_all_menu(count){
document.getElementById('menu'+count).style.display='none';	
}

function show_gall(trace_obj,end_limit) {
	for(var w=0;w<=end_limit;w++){
		if(trace_obj==w){
			if(document.getElementById('gallery_1_'+w).style.display=='none'){
				document.getElementById('gallery_1_'+w).style.display='block';
				document.getElementById('gallzoom_1_'+w).style.display='block';
			}
		}else{
			document.getElementById('gallery_1_'+w).style.display='none';
			document.getElementById('gallzoom_1_'+w).style.display='none';
		}
	}
}