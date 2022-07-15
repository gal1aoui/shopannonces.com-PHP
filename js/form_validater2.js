//XRegExp 1.5.1 <xregexp.com> MIT License
var XRegExp;if(XRegExp){throw Error("can't load XRegExp twice in the same frame")}(function(d){XRegExp=function(w,r){var q=[],u=XRegExp.OUTSIDE_CLASS,x=0,p,s,v,t,y;if(XRegExp.isRegExp(w)){if(r!==d){throw TypeError("can't supply flags when constructing one RegExp from another")}return j(w)}if(g){throw Error("can't call the XRegExp constructor within token definition functions")}r=r||"";p={hasNamedCapture:false,captureNames:[],hasFlag:function(z){return r.indexOf(z)>-1},setFlag:function(z){r+=z}};while(x<w.length){s=o(w,x,u,p);if(s){q.push(s.output);x+=(s.match[0].length||1)}else{if(v=l.exec.call(i[u],w.slice(x))){q.push(v[0]);x+=v[0].length}else{t=w.charAt(x);if(t==="["){u=XRegExp.INSIDE_CLASS}else{if(t==="]"){u=XRegExp.OUTSIDE_CLASS}}q.push(t);x++}}}y=RegExp(q.join(""),l.replace.call(r,h,""));y._xregexp={source:w,captureNames:p.hasNamedCapture?p.captureNames:null};return y};XRegExp.version="1.5.1";XRegExp.INSIDE_CLASS=1;XRegExp.OUTSIDE_CLASS=2;var c=/\$(?:(\d\d?|[$&`'])|{([$\w]+)})/g,h=/[^gimy]+|([\s\S])(?=[\s\S]*\1)/g,n=/^(?:[?*+]|{\d+(?:,\d*)?})\??/,g=false,k=[],l={exec:RegExp.prototype.exec,test:RegExp.prototype.test,match:String.prototype.match,replace:String.prototype.replace,split:String.prototype.split},a=l.exec.call(/()??/,"")[1]===d,f=function(){var p=/^/g;l.test.call(p,"");return !p.lastIndex}(),b=RegExp.prototype.sticky!==d,i={};i[XRegExp.INSIDE_CLASS]=/^(?:\\(?:[0-3][0-7]{0,2}|[4-7][0-7]?|x[\dA-Fa-f]{2}|u[\dA-Fa-f]{4}|c[A-Za-z]|[\s\S]))/;i[XRegExp.OUTSIDE_CLASS]=/^(?:\\(?:0(?:[0-3][0-7]{0,2}|[4-7][0-7]?)?|[1-9]\d*|x[\dA-Fa-f]{2}|u[\dA-Fa-f]{4}|c[A-Za-z]|[\s\S])|\(\?[:=!]|[?*+]\?|{\d+(?:,\d*)?}\??)/;XRegExp.addToken=function(s,r,q,p){k.push({pattern:j(s,"g"+(b?"y":"")),handler:r,scope:q||XRegExp.OUTSIDE_CLASS,trigger:p||null})};XRegExp.cache=function(r,p){var q=r+"/"+(p||"");return XRegExp.cache[q]||(XRegExp.cache[q]=XRegExp(r,p))};XRegExp.copyAsGlobal=function(p){return j(p,"g")};XRegExp.escape=function(p){return p.replace(/[-[\]{}()*+?.,\\^$|#\s]/g,"\\$&")};XRegExp.execAt=function(t,s,u,r){var p=j(s,"g"+((r&&b)?"y":"")),q;p.lastIndex=u=u||0;q=p.exec(t);if(r&&q&&q.index!==u){q=null}if(s.global){s.lastIndex=q?p.lastIndex:0}return q};XRegExp.freezeTokens=function(){XRegExp.addToken=function(){throw Error("can't run addToken after freezeTokens")}};XRegExp.isRegExp=function(p){return Object.prototype.toString.call(p)==="[object RegExp]"};XRegExp.iterate=function(u,t,v,s){var p=j(t,"g"),r=-1,q;while(q=p.exec(u)){if(t.global){t.lastIndex=p.lastIndex}v.call(s,q,++r,u,t);if(p.lastIndex===q.index){p.lastIndex++}}if(t.global){t.lastIndex=0}};XRegExp.matchChain=function(q,p){return function r(s,x){var v=p[x].regex?p[x]:{regex:p[x]},u=j(v.regex,"g"),w=[],t;for(t=0;t<s.length;t++){XRegExp.iterate(s[t],u,function(y){w.push(v.backref?(y[v.backref]||""):y[0])})}return((x===p.length-1)||!w.length)?w:r(w,x+1)}([q],0)};RegExp.prototype.apply=function(q,p){return this.exec(p[0])};RegExp.prototype.call=function(p,q){return this.exec(q)};RegExp.prototype.exec=function(u){var s,r,q,p;if(!this.global){p=this.lastIndex}s=l.exec.apply(this,arguments);if(s){if(!a&&s.length>1&&m(s,"")>-1){q=RegExp(this.source,l.replace.call(e(this),"g",""));l.replace.call((u+"").slice(s.index),q,function(){for(var v=1;v<arguments.length-2;v++){if(arguments[v]===d){s[v]=d}}})}if(this._xregexp&&this._xregexp.captureNames){for(var t=1;t<s.length;t++){r=this._xregexp.captureNames[t-1];if(r){s[r]=s[t]}}}if(!f&&this.global&&!s[0].length&&(this.lastIndex>s.index)){this.lastIndex--}}if(!this.global){this.lastIndex=p}return s};RegExp.prototype.test=function(r){var q,p;if(!this.global){p=this.lastIndex}q=l.exec.call(this,r);if(q&&!f&&this.global&&!q[0].length&&(this.lastIndex>q.index)){this.lastIndex--}if(!this.global){this.lastIndex=p}return !!q};String.prototype.match=function(q){if(!XRegExp.isRegExp(q)){q=RegExp(q)}if(q.global){var p=l.match.apply(this,arguments);q.lastIndex=0;return p}return q.exec(this)};String.prototype.replace=function(s,t){var u=XRegExp.isRegExp(s),r,q,v,p;if(u){if(s._xregexp){r=s._xregexp.captureNames}if(!s.global){p=s.lastIndex}}else{s=s+""}if(Object.prototype.toString.call(t)==="[object Function]"){q=l.replace.call(this+"",s,function(){if(r){arguments[0]=new String(arguments[0]);for(var w=0;w<r.length;w++){if(r[w]){arguments[0][r[w]]=arguments[w+1]}}}if(u&&s.global){s.lastIndex=arguments[arguments.length-2]+arguments[0].length}return t.apply(null,arguments)})}else{v=this+"";q=l.replace.call(v,s,function(){var w=arguments;return l.replace.call(t+"",c,function(y,x,B){if(x){switch(x){case"$":return"$";case"&":return w[0];case"`":return w[w.length-1].slice(0,w[w.length-2]);case"'":return w[w.length-1].slice(w[w.length-2]+w[0].length);default:var z="";x=+x;if(!x){return y}while(x>w.length-3){z=String.prototype.slice.call(x,-1)+z;x=Math.floor(x/10)}return(x?w[x]||"":"$")+z}}else{var A=+B;if(A<=w.length-3){return w[A]}A=r?m(r,B):-1;return A>-1?w[A+1]:y}})})}if(u){if(s.global){s.lastIndex=0}else{s.lastIndex=p}}return q};String.prototype.split=function(u,p){if(!XRegExp.isRegExp(u)){return l.split.apply(this,arguments)}var w=this+"",r=[],v=0,t,q;if(p===d||+p<0){p=Infinity}else{p=Math.floor(+p);if(!p){return[]}}u=XRegExp.copyAsGlobal(u);while(t=u.exec(w)){if(u.lastIndex>v){r.push(w.slice(v,t.index));if(t.length>1&&t.index<w.length){Array.prototype.push.apply(r,t.slice(1))}q=t[0].length;v=u.lastIndex;if(r.length>=p){break}}if(u.lastIndex===t.index){u.lastIndex++}}if(v===w.length){if(!l.test.call(u,"")||q){r.push("")}}else{r.push(w.slice(v))}return r.length>p?r.slice(0,p):r};function j(r,q){if(!XRegExp.isRegExp(r)){throw TypeError("type RegExp expected")}var p=r._xregexp;r=XRegExp(r.source,e(r)+(q||""));if(p){r._xregexp={source:p.source,captureNames:p.captureNames?p.captureNames.slice(0):null}}return r}function e(p){return(p.global?"g":"")+(p.ignoreCase?"i":"")+(p.multiline?"m":"")+(p.extended?"x":"")+(p.sticky?"y":"")}function o(v,u,w,p){var r=k.length,y,s,x;g=true;try{while(r--){x=k[r];if((w&x.scope)&&(!x.trigger||x.trigger.call(p))){x.pattern.lastIndex=u;s=x.pattern.exec(v);if(s&&s.index===u){y={output:x.handler.call(p,s,w),match:s};break}}}}catch(q){throw q}finally{g=false}return y}function m(s,q,r){if(Array.prototype.indexOf){return s.indexOf(q,r)}for(var p=r||0;p<s.length;p++){if(s[p]===q){return p}}return -1}XRegExp.addToken(/\(\?#[^)]*\)/,function(p){return l.test.call(n,p.input.slice(p.index+p[0].length))?"":"(?:)"});XRegExp.addToken(/\((?!\?)/,function(){this.captureNames.push(null);return"("});XRegExp.addToken(/\(\?<([$\w]+)>/,function(p){this.captureNames.push(p[1]);this.hasNamedCapture=true;return"("});XRegExp.addToken(/\\k<([\w$]+)>/,function(q){var p=m(this.captureNames,q[1]);return p>-1?"\\"+(p+1)+(isNaN(q.input.charAt(q.index+q[0].length))?"":"(?:)"):q[0]});XRegExp.addToken(/\[\^?]/,function(p){return p[0]==="[]"?"\\b\\B":"[\\s\\S]"});XRegExp.addToken(/^\(\?([imsx]+)\)/,function(p){this.setFlag(p[1]);return""});XRegExp.addToken(/(?:\s+|#.*)+/,function(p){return l.test.call(n,p.input.slice(p.index+p[0].length))?"":"(?:)"},XRegExp.OUTSIDE_CLASS,function(){return this.hasFlag("x")});XRegExp.addToken(/\./,function(){return"[\\s\\S]"},XRegExp.OUTSIDE_CLASS,function(){return this.hasFlag("s")})})();
/*
XRegExp Unicode plugin base 0.6
(c) 2008-2012 Steven Levithan
MIT License
<http://xregexp.com>

Uses the Unicode 6.1 character database:
<http://unicode.org/Public/6.1.0/ucd/>

The Unicode plugin base adds support for the \p{L} token only (Unicode category
Letter). Plugin packages are available that add support for the remaining
Unicode categories, as well as Unicode scripts and blocks.

All Unicode tokens can be inverted by using an uppercase P; e.g., \P{L} matches
any character not in Unicode's Letter category. Negated Unicode tokens are not
supported within character classes.

Letter case, spaces, hyphens, and underscores are ignored when comparing
Unicode token names.
*/
if(!XRegExp){throw ReferenceError("XRegExp must be loaded before the Unicode plugin");}
(function () {
    var unicode = {}; // protected storage for package tokens
    XRegExp.addUnicodePackage = function (pack) {
        var codePoint = /\w{4}/g,
            clip = /[- _]+/g,
            name, p;
        for (p in pack) {
            if (pack.hasOwnProperty(p)) {
                name = p.replace(clip, "").toLowerCase();
                // disallow overriding properties that have already been added
                if (!unicode.hasOwnProperty(name)) {
                    unicode[name] = pack[p].replace(codePoint, "\\u$&");
                }
            }
        }
    };
    XRegExp.addToken(
        /\\([pP]){(\^?)([^}]*)}/,
        function (match, scope) {
            var negated = (match[1] === "P" || match[2]),
                item = match[3].replace(/[- _]+/g, "").toLowerCase();
            // \p{}, \P{}, and \p{^} are valid, but the double negative \P{^} isn't
            if (match[1] === "P" && match[2])
                throw SyntaxError("erroneous characters: " + match[0]);
            if (negated && scope === XRegExp.INSIDE_CLASS)
                throw SyntaxError("not supported in character classes: \\" + match[1] + "{" + match[2] + "...}");
            if (!unicode.hasOwnProperty(item))
                throw SyntaxError("invalid or unsupported Unicode item: " + match[0]);

            return scope === XRegExp.OUTSIDE_CLASS ?
                "[" + (negated ? "^" : "") + unicode[item] + "]" :
                unicode[item];
        },
        XRegExp.INSIDE_CLASS | XRegExp.OUTSIDE_CLASS
    );
    XRegExp.addUnicodePackage({
        L: "0041-005A0061-007A00AA00B500BA00C0-00D600D8-00F600F8-02C102C6-02D102E0-02E402EC02EE0370-037403760377037A-037D03860388-038A038C038E-03A103A3-03F503F7-0481048A-05270531-055605590561-058705D0-05EA05F0-05F20620-064A066E066F0671-06D306D506E506E606EE06EF06FA-06FC06FF07100712-072F074D-07A507B107CA-07EA07F407F507FA0800-0815081A082408280840-085808A008A2-08AC0904-0939093D09500958-09610971-09770979-097F0985-098C098F09900993-09A809AA-09B009B209B6-09B909BD09CE09DC09DD09DF-09E109F009F10A05-0A0A0A0F0A100A13-0A280A2A-0A300A320A330A350A360A380A390A59-0A5C0A5E0A72-0A740A85-0A8D0A8F-0A910A93-0AA80AAA-0AB00AB20AB30AB5-0AB90ABD0AD00AE00AE10B05-0B0C0B0F0B100B13-0B280B2A-0B300B320B330B35-0B390B3D0B5C0B5D0B5F-0B610B710B830B85-0B8A0B8E-0B900B92-0B950B990B9A0B9C0B9E0B9F0BA30BA40BA8-0BAA0BAE-0BB90BD00C05-0C0C0C0E-0C100C12-0C280C2A-0C330C35-0C390C3D0C580C590C600C610C85-0C8C0C8E-0C900C92-0CA80CAA-0CB30CB5-0CB90CBD0CDE0CE00CE10CF10CF20D05-0D0C0D0E-0D100D12-0D3A0D3D0D4E0D600D610D7A-0D7F0D85-0D960D9A-0DB10DB3-0DBB0DBD0DC0-0DC60E01-0E300E320E330E40-0E460E810E820E840E870E880E8A0E8D0E94-0E970E99-0E9F0EA1-0EA30EA50EA70EAA0EAB0EAD-0EB00EB20EB30EBD0EC0-0EC40EC60EDC-0EDF0F000F40-0F470F49-0F6C0F88-0F8C1000-102A103F1050-1055105A-105D106110651066106E-10701075-1081108E10A0-10C510C710CD10D0-10FA10FC-1248124A-124D1250-12561258125A-125D1260-1288128A-128D1290-12B012B2-12B512B8-12BE12C012C2-12C512C8-12D612D8-13101312-13151318-135A1380-138F13A0-13F41401-166C166F-167F1681-169A16A0-16EA1700-170C170E-17111720-17311740-17511760-176C176E-17701780-17B317D717DC1820-18771880-18A818AA18B0-18F51900-191C1950-196D1970-19741980-19AB19C1-19C71A00-1A161A20-1A541AA71B05-1B331B45-1B4B1B83-1BA01BAE1BAF1BBA-1BE51C00-1C231C4D-1C4F1C5A-1C7D1CE9-1CEC1CEE-1CF11CF51CF61D00-1DBF1E00-1F151F18-1F1D1F20-1F451F48-1F4D1F50-1F571F591F5B1F5D1F5F-1F7D1F80-1FB41FB6-1FBC1FBE1FC2-1FC41FC6-1FCC1FD0-1FD31FD6-1FDB1FE0-1FEC1FF2-1FF41FF6-1FFC2071207F2090-209C21022107210A-211321152119-211D212421262128212A-212D212F-2139213C-213F2145-2149214E218321842C00-2C2E2C30-2C5E2C60-2CE42CEB-2CEE2CF22CF32D00-2D252D272D2D2D30-2D672D6F2D80-2D962DA0-2DA62DA8-2DAE2DB0-2DB62DB8-2DBE2DC0-2DC62DC8-2DCE2DD0-2DD62DD8-2DDE2E2F300530063031-3035303B303C3041-3096309D-309F30A1-30FA30FC-30FF3105-312D3131-318E31A0-31BA31F0-31FF3400-4DB54E00-9FCCA000-A48CA4D0-A4FDA500-A60CA610-A61FA62AA62BA640-A66EA67F-A697A6A0-A6E5A717-A71FA722-A788A78B-A78EA790-A793A7A0-A7AAA7F8-A801A803-A805A807-A80AA80C-A822A840-A873A882-A8B3A8F2-A8F7A8FBA90A-A925A930-A946A960-A97CA984-A9B2A9CFAA00-AA28AA40-AA42AA44-AA4BAA60-AA76AA7AAA80-AAAFAAB1AAB5AAB6AAB9-AABDAAC0AAC2AADB-AADDAAE0-AAEAAAF2-AAF4AB01-AB06AB09-AB0EAB11-AB16AB20-AB26AB28-AB2EABC0-ABE2AC00-D7A3D7B0-D7C6D7CB-D7FBF900-FA6DFA70-FAD9FB00-FB06FB13-FB17FB1DFB1F-FB28FB2A-FB36FB38-FB3CFB3EFB40FB41FB43FB44FB46-FBB1FBD3-FD3DFD50-FD8FFD92-FDC7FDF0-FDFBFE70-FE74FE76-FEFCFF21-FF3AFF41-FF5AFF66-FFBEFFC2-FFC7FFCA-FFCFFFD2-FFD7FFDA-FFDC"
    });
})();

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
  var regExp	=	XRegExp('^\\p{L}+$');  
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


function sendemailConfirmFromUser(name)
{		
	////////alert("aaaaaa");
	if(validcheck(name)==true)
	{
		if(confirm("Are you sure you want to send replay this person"))
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
		alert('Please enter save title.');
		obj.save_title.focus();
        return false;
	}
	if(RemoveLTSpace(obj.save_title.value)==""){
		alert('Please enter save title.');
		obj.save_title.focus();
        return false;
	}
	
}

function validate_headersearch(obj){
	if(RemoveLTSpace(obj.keyword.value)=="Enter Your Keywords.." && (obj.classi_city.value)=="" ){
		alert('Please enter keyword or select city.');
		obj.keyword.focus();
        return false;
	}
}

function validate_contactus(obj){	
	
	if(RemoveLTSpace(obj.name.value)==""){
		alert('Please enter your name.');
		obj.name.focus();
        return false;
	}
	if(!isAlphabet(obj.name.value)){
		alert('Please enter your alphabets only.');
		obj.name.focus();
        return false;
	}
	if(RemoveLTSpace(obj.org.value)==""){
		alert('Please enter your company name.');
		obj.org.focus();
        return false;
	}
	if(RemoveLTSpace(obj.email.value)==""){
		alert('Please enter your email.');
		obj.email.focus();
        return false;
	}
	if(!isEmailAddr(obj.email.value)){
		alert('Please enter your valid email.');
		obj.email.focus();
        return false;
	}
	if(RemoveLTSpace(obj.phone_no.value)==""){
		alert('Please enter your phone number.');
		obj.phone_no.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.address.value)==""){
		alert('Please enter your address.');
		obj.address.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.country.value)==""){
		alert('Please enter your country.');
		obj.country.focus();
        return false;
	}
  if(RemoveLTSpace(obj.sate.value)==""){
		alert('Please enter your state.');
		obj.sate.focus();
        return false;
	}
 if(!isAlphabet(obj.sate.value)){
		alert('Please enter  alphabets only.');
        obj.sate.value="";
		obj.sate.focus();
        return false;
	}

 if(RemoveLTSpace(obj.city.value)==""){
		alert('Please enter your city.');        
		obj.city.focus();
        return false;
	}	
 if(!isAlphabet(obj.city.value)){
		alert('Please enter alphabets only.');
        obj.city.value="";
		obj.city.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.comment.value)==""){
		alert('Please enter your comments.');
		obj.comment.focus();
        return false;
	}
	
}
/******* End  of info request   from  validation ************/

function validate_feedback(obj){
	if(RemoveLTSpace(obj.name.value)==""){
		alert('Please enter your name.');
		obj.name.focus();
        return false;
	}
	if(!isAlphabet(obj.name.value)){
		alert('Please enter your alphabets only.');
		obj.name.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.email.value)==""){
		alert('Please enter your email.');
		obj.email.focus();
        return false;
	}
	if(!isEmailAddr(obj.email.value)){
		alert('Please enter your valid email.');
		obj.email.focus();
        return false;
	}
	if(RemoveLTSpace(obj.phone_no.value)==""){
		alert('Please enter your phone number.');
		obj.phone_no.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.address.value)==""){
		alert('Please enter your address.');
		obj.address.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.country.value)==""){
		alert('Please enter your country.');
		obj.country.focus();
        return false;
	}
  if(RemoveLTSpace(obj.sate.value)==""){
		alert('Please enter your state.');        
		obj.sate.focus();
        return false;
	}
 if(!isAlphabet(obj.sate.value)){
		alert('Please enter alphabets only.');
        obj.sate.value="";
		obj.sate.focus();
        return false;
	}
  if(RemoveLTSpace(obj.city.value)==""){
		alert('Please enter your city.');
		obj.city.focus();
        return false;
	}

 if(!isAlphabet(obj.city.value)){
		alert('Please enter alphabets only.');
        obj.city.value="";
		obj.city.focus();
        return false;
	}

	if(RemoveLTSpace(obj.comment.value)==""){
		alert('Please enter your comments.');
		obj.comment.focus();
        return false;
	}
	
}

/******* Start of register product form   validation ************/
function validate_advertise(obj){
	if(RemoveLTSpace(obj.name.value)==""){
		alert('Please enter your name.');
		obj.name.focus();
        return false;
	}
	if(!isAlphabet(obj.name.value)){
		alert('Please enter your alphabets only.');
		obj.name.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.email.value)==""){
		alert('Please enter your email.');
		obj.email.focus();
        return false;
	}
	if(!isEmailAddr(obj.email.value)){
		alert('Please enter your valid email.');
		obj.email.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.org.value)==""){
		alert('Please enter your company name.');
		obj.org.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.contact_no.value)==""){
		alert('Please enter contact no.');
		obj.contact_no.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.cat_level_root.value)==""){
		alert('Please select category.');
		obj.cat_level_root.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.ban_position.value)==""){
		alert('Please select banner position.');
		obj.ban_position.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.file.value)==""){
		alert('Please upload file.');
		obj.file.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.urls.value)==""){
		alert('Please enter your website url.');
		obj.urls.focus();
        return false;
	}
	if(!isURL(obj.urls.value)){
		alert('Please enter valid website url.');
		obj.urls.focus();
        return false;
	}	
		if(RemoveLTSpace(obj.comments.value)==""){
		alert('Please enter your comments.');
		obj.comments.focus();
        return false;
	}
	
	
}

/******* End  of register product form validation ************/


/******* start  of apply job  form validation ************/
function validate_classified_inquire(obj){
	if(RemoveLTSpace(obj.sender_name.value)==""){
		alert('Please enter your name.');
		obj.sender_name.focus();
        return false;
	}
	
	if(!isAlphabet(obj.sender_name.value)){
		alert('Please enter your alphabets only.');
		obj.sender_name.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.sender_email.value)==""){
		alert('Please enter your email.');
		obj.sender_email.focus();
        return false;
	}
	if(!isEmailAddr(obj.sender_email.value)){
		alert('Please enter your valid email.');
		obj.sender_email.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.sender_msg.value)==""){
		alert('Please enter your message.');
		obj.sender_msg.focus();
        return false;
	}
	if(RemoveLTSpace(obj.verifaction.value)==""){
		alert('Please enter verification code.');
		obj.verifaction.focus();
        return false;
	}
	if(obj.trems.checked == false){
		alert('Please enter check the terms and conditions.');
		obj.trems.focus();
        return false;
	}
	
}
/******* end  of apply job  form validation ************/



/******* start  of login  form validation ************/
function validate_loginform(obj){	
	if(RemoveLTSpace(obj.userid.value)==""){
		alert('Please enter user name.');
		obj.userid.focus();
        return false;
	}
	if(!isEmailAddr(obj.userid.value)){
		alert('Please enter valid user name.');
		obj.userid.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.userpass.value)==""){
		alert('Please enter your password.');
		obj.userpass.focus();
        return false;
	}	
	
	
}
/******* end   of login  form validation ************/

/******* Start Forum reply form validation ************/
function validate_forumreply(obj){
	if(RemoveLTSpace(obj.name.value)==""){
		alert('Please enter your name.');
		obj.name.focus();
        return false;
	}
	if(!isAlphabet(obj.name.value)){
		alert('Please enter your alphabets only.');
		obj.name.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.email.value)==""){
		alert('Please enter your email.');
		obj.email.focus();
        return false;
	}
	if(!isEmailAddr(obj.email.value)){
		alert('Please enter your valid email.');
		obj.email.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.heading.value)==""){
		alert('Please enter your title.');
		obj.heading.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.comment.value)==""){
		alert('Please enter your comment.');
		obj.comment.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.verif_box.value)==""){
		alert('Please enter Verifaction code .');
		obj.verif_box.focus();
        return false;
	}


}
/******* End Forum reply form validation ************/


function validate_username(obj){
	if(RemoveLTSpace(obj.username.value)==""){
		alert('Please enter your site name.');
		obj.username.focus();
        return false;
	}
	if(!isValidusername(obj.username.value)){
	   alert("Please enter valid site name. No Special character allowed.");
	   obj.username.focus();
       return false;
	}
}

function validate_sendreplay(obj){
	if(RemoveLTSpace(obj.subject.value)==""){
		alert('Please enter your subject.');
		obj.subject.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.msg.value)==""){
		alert('Please enter your message.');
		obj.msg.focus();
        return false;
	}
}

function validate_registration(obj){	
	if(RemoveLTSpace(obj.user_id.value)==""){
		alert('Please enter User id.');
		obj.user_id.focus();
        return false;
	}
	if(!isEmailAddr(obj.user_id.value)){
		alert('Please enter valid User id.');
		obj.user_id.focus();
        return false;
	}
	if(obj.user_password.value==""){
		alert('Please enter your password.');
		obj.user_password.focus();
        return false;
	}
	if(obj.confirm_password.value==""){
		alert('Please re-enter your password.');
		obj.confirm_password.focus();
        return false;
	}
	if(obj.user_password.value!=obj.confirm_password.value){
		alert('Password and Retype password are not same.');
		obj.user_password.focus();
        return false;
	}
	
	
	
	
	
	
	if(RemoveLTSpace(obj.mem_fname.value)==""){
		alert('Please enter your first name.');
		obj.mem_fname.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_lname.value)==""){
		alert('Please enter your last name.');
		obj.mem_lname.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.mem_email.value)==""){
		alert('Please enter your email.');
		obj.mem_email.focus();
        return false;
	}
	if(!isEmailAddr(obj.mem_email.value)){
		alert('Please enter valid email id.');
		obj.mem_email.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_address.value)==""){
		alert('Please enter your address.');
		obj.mem_address.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.mem_postal.value)==""){
		alert('Please enter your Postal code.');
		obj.mem_postal.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_city.value)==""){
		alert('Please enter your city.');
		obj.mem_city.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_state.value)==""){
		alert('Please enter your state.');
		obj.mem_state.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_country.value)==""){
		alert('Please enter your country.');
		obj.mem_country.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_telno.value)==""){
		alert('Please enter your phone number.');
		obj.mem_telno.focus();
        return false;
	}
	if(RemoveLTSpace(obj.daily_alrt.value)==""){
		alert('Please select Daily Alerts.');
		obj.daily_alrt.focus();
        return false;
	}
	
}

function validate_editAccount(obj){	
	
	
	if(RemoveLTSpace(obj.mem_fname.value)==""){
		alert('Please enter your first name.');
		obj.mem_fname.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_lname.value)==""){
		alert('Please enter your last name.');
		obj.mem_lname.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.mem_email.value)==""){
		alert('Please enter your email.');
		obj.mem_email.focus();
        return false;
	}
	if(!isEmailAddr(obj.mem_email.value)){
		alert('Please enter valid email id.');
		obj.mem_email.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_address.value)==""){
		alert('Please enter your address.');
		obj.mem_address.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.mem_postal.value)==""){
		alert('Please enter your Postal code.');
		obj.mem_postal.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_city.value)==""){
		alert('Please enter your city.');
		obj.mem_city.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_state.value)==""){
		alert('Please enter your state.');
		obj.mem_state.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_country.value)==""){
		alert('Please enter your country.');
		obj.mem_country.focus();
        return false;
	}
	if(RemoveLTSpace(obj.mem_telno.value)==""){
		alert('Please enter your phone number.');
		obj.mem_telno.focus();
        return false;
	}	
	
}

function validate_post_classified(obj){	
	if(RemoveLTSpace(obj.cat_level_root.value)==""){
		alert('Please select category name.');
		obj.cat_level_root.focus();
        return false;
	}
	if(RemoveLTSpace(obj.cat_level_one.value)==""){
		alert('Please select sub category name.');
		obj.cat_level_one.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.cat_level_two.value)==""){
		alert('Please select sub sub category name.');
		obj.cat_level_two.focus();
        return false;
	}	
	if(RemoveLTSpace(obj.classi_title.value)==""){
		alert('Please enter classified title.');
		obj.classi_title.focus();
        return false;
	}
	if(RemoveLTSpace(obj.classi_ad_type.value)==""){
		alert('Please select ad type .');
		obj.classi_ad_type.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.classi_desc.value)==""){
		alert('Please enter classified description.');
		obj.classi_desc.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.classi_price.value)=="" && (obj.my_offer.value)=="" ){
		alert('Please enter classified price or select one option .');
		obj.classi_price.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.classi_address.value)==""){
		alert('Please enter classified address.');
		obj.classi_address.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.classi_city.value)==""){
		alert('Please enter classified city.');
		obj.classi_city.focus();
        return false;
	}
	
	if(RemoveLTSpace(obj.classi_state.value)==""){
		alert('Please enter classified state.');
		obj.classi_state.focus();
        return false;
	}
	if(RemoveLTSpace(obj.classi_zipcode.value)==""){
		alert('Please enter classified postal code.');
		obj.classi_zipcode.focus();
        return false;
	}
	if(RemoveLTSpace(obj.classi_email.value)==""){
		alert('Please enter  email id .');
		obj.classi_email.focus();
        return false;
	}
	if(!isEmailAddr(obj.classi_email.value)){
		alert('Please enter valid email id.');
		obj.classi_email.focus();
        return false;
	}	
	
}

function validate_login(obj){
	if(RemoveLTSpace(obj.username.value)==""){
		alert('Please enter your email.');
		obj.username.focus();
        return false;
	}
	if(!isEmailAddr(obj.username.value)){
		alert('Please enter valid email address.');
		obj.username.focus();
        return false;
	}
	if(obj.pwd.value==""){
		alert('Please enter your password.');
		obj.pwd.focus();
        return false;
	}
}

function validate_refriend(obj){
	
	if(RemoveLTSpace(obj.your_name.value)==""){
		alert("Please enter your name.")
		obj.your_name.focus();   
		return false;
	}
	if(!isNaN(obj.your_name.value)){
		alert("Please enter alphabetic value in your name.")
		obj.your_name.focus(); 
		return false;
	}   
	if(RemoveLTSpace(obj.your_email.value)== ""){
		alert("Please enter your email address .")
		obj.your_name.focus(); 
		return false;
	}
	if(!isEmailAddr(obj.your_email.value)){
		alert('Please enter valid email id.');
		obj.your_email.focus();
		return false;
	}
	if(RemoveLTSpace(obj.friend_name.value) == "") {
		alert("Please enter your friend's name.")
		obj.friend_name.focus(); 
		return false;
	}
	if(!isNaN(obj.friend_name.value)){
		alert("Please enter alphabetic value in your friend's name.")
		obj.friend_name.focus();
		return false;
	}	  
	if(RemoveLTSpace(obj.friend_email.value)== ""){
		alert("Please enter your friend's email address .")
		obj.your_name.focus(); 
		return false;
	}
	if(!isEmailAddr(obj.friend_email.value)){
		alert('Please enter valid email id.');
		obj.your_email.focus();
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

<!-- End  jquery  for classified reply ------->