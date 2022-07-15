/**
* ASWin
* @author Alexandre Saban
	asno@asno.fr
*/

var ASWin = Class.create();

ASWin.version = "0.1";
ASWin.lastUpdate = '2010-03-21';

// IE :s ou pas :D
var is_ie = (navigator.appVersion.match(/\bMSIE\b/)) ? true : false ;


//==================================
//=== constructeur
//==================================
ASWin.prototype ={


	initialize : function(options){

		options = (typeof(options) == 'object') ? options : {};

		title = (options.title) ? options.title : '';
		content = (options.content) ? options.content : '<img src=images/ajax/processing.gif />';
		this.top = (options.top) ? options.top : 0;
		this.left = (options.left) ? options.left : 0;
		this.imgBase = (options.imgBase) ? options.imgBase : 'images/aswin/';
		this.modal = (typeof(options.modal) == 'boolean') ? options.modal : true ;
		this.onclickBgClose = (typeof(options.onclickBgClose) == 'boolean') ? options.onclickBgClose : false ;
		this.backgroundColor = (options.backgroundColor) ? options.backgroundColor : 'white';
		this.onclose = (options.onclose) ? options.onclose : '';
		this.afterclose = (options.afterclose) ? options.afterclose : '';
		this.noEffects = (typeof(options.noEffects) == 'boolean') ? options.noEffects : false;
		this.draggable = (typeof(options.draggable) == 'boolean') ? options.draggable : true;
		this.icone = (options.icone) ? options.icone : 'images/icon_search.gif';

		// la fenetre
		this.fenetre = document.createElement('div');

		this.fenetre.style.top = this.top + 'px';
		this.fenetre.style.left = this.left + 'px';


		this.tblFenetre = document.createElement('table');
		this.tblFenetre.border = 0;
		this.tblFenetre.cellPadding = 0;
		this.tblFenetre.cellSpacing = 0;

		this.tblFenetre.className = 'asw_tblFenetre';


		// barre de titre
		var row0 = this.tblFenetre.insertRow(0);

		// bordure gauche/haut
		var cell0 = row0.insertCell(0);
		if(is_ie) cell0.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' +this.imgBase + 'border_left_top.png\', sizingMethod=\'scale\')';
		else cell0.style.backgroundImage = 'url(' + this.imgBase + 'border_left_top.png)';
		cell0.className = 'asw_border_left_top';

		// espace de titre
		var cellTitleBar = row0.insertCell(1);
		if(is_ie) cellTitleBar.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' +this.imgBase + 'border_top.png\', sizingMethod=\'scale\')';
		else cellTitleBar.style.backgroundImage = 'url(' + this.imgBase + 'border_top.png)';

		cellTitleBar.className = 'asw_border_top_center';


		// bordure droite/haut
		var cell2 = row0.insertCell(2);
		if(is_ie) cell2.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' +this.imgBase + 'border_right_top.png\', sizingMethod=\'scale\')';
		else cell2.style.backgroundImage = 'url(' + this.imgBase + 'border_right_top.png)';
		cell2.className = 'asw_border_right_top';


		// insertion du tableau pour l'icone, le titre et les boutons
		this.tblTitleBar = document.createElement('table');
		this.tblTitleBar.border = 0;
		this.tblTitleBar.cellPadding = 0;
		this.tblTitleBar.cellSpacing = 0;
		this.tblTitleBar.className = 'tblTitleBar';


		var row0 = this.tblTitleBar.insertRow(0);
		
		// L'icone de la fenetre
		this.iconeCell = row0.insertCell(0);
		this.iconeCell.className = 'asw_iconCell';
        this.setIcon(this.icone)
        
		// Titre de la fenetre
		this.titleCell = row0.insertCell(1);
		this.titleCell.className = 'asw_titleCell';
		this.setTitle(title);

		// boutons
		this.buttonsCell = row0.insertCell(2);
		this.buttonsCell.className = 'asw_buttonsCell';

		// bouton close
		this.btnClose = document.createElement('img');

		if(is_ie) this.btnClose.src = this.imgBase + 'btn_close.gif';
		else this.btnClose.src = this.imgBase + 'btn_close.gif';


		this.btnClose.title = 'Fermer';
		this.btnClose.alt = 'Fermer';
		this.btnClose.className = 'asw_btnClose';

		if(is_ie) transportClass =  this;
		else this.btnClose.transportClass = this;

		Event.observe(	this.btnClose, 'click', function(){
			if(is_ie) transportClass.close();
			else this.transportClass.close();

		}
		);

		this.buttonsCell.appendChild(this.btnClose);

		// bordure gauche, contenu de la fenetre et bordure droite
		var row1 = this.tblFenetre.insertRow(1);

		// la bordure gauche
		var cell0 = row1.insertCell(0);
		if(is_ie) cell0.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' +this.imgBase + 'border_left.png\', sizingMethod=\'scale\')';
		else cell0.style.backgroundImage = 'url(' + this.imgBase + 'border_left.png)';
		cell0.className = 'asw_border_left';

		// le contenu de la fenetre
		this.cellContent = row1.insertCell(1);
		this.cellContent.className = 'asw_cellContent';
		if(this.backgroundColor != 'none') this.cellContent.style.backgroundColor = this.backgroundColor;

		this.setContent(content);

		// la bordure droite
		var cell2 = row1.insertCell(2);
		if(is_ie) cell2.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' +this.imgBase + 'border_right.png\', sizingMethod=\'scale\')';
		else cell2.style.backgroundImage = 'url(' + this.imgBase + 'border_right.png)';
		cell2.className = 'asw_border_right';

		// bordure gauche/bas , bordure bas et bordure droite/bas
		var row2 = this.tblFenetre.insertRow(2);

		// la bordure gauche/bas
		var cell0 = row2.insertCell(0);
		if(is_ie) cell0.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' +this.imgBase + 'border_left_bottom.png\', sizingMethod=\'scale\')';
		else cell0.style.backgroundImage = 'url(' + this.imgBase + 'border_left_bottom.png)';
		cell0.className = 'asw_border_left_bottom';

		// la bordure bas
		var cell1 = row2.insertCell(1);
		if(is_ie) cell1.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' +this.imgBase + 'border_bottom.png\', sizingMethod=\'scale\')';
		else cell1.style.backgroundImage = 'url(' + this.imgBase + 'border_bottom.png)';
		cell1.className = 'asw_border_bottom';

		// la bordure bas droite
		var cell2 = row2.insertCell(2);
		if(is_ie) cell2.style.filter = 'progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\'' +this.imgBase + 'border_right_bottom.png\', sizingMethod=\'scale\')';
		else cell2.style.backgroundImage = 'url(' + this.imgBase + 'border_right_bottom.png)';
		cell2.className = 'asw_border_right_bottom';

		// TODO Ajouter une metode plus propre de gerer les filtres avec IE

		// Ajout de le titlebar a la fenetre
		cellTitleBar.appendChild(this.tblTitleBar);

	},

	showFondEcran : function(){

		this.fondEcran = document.createElement('div');
		this.fondEcran.style.zIndex = this.getLastZIndex();
		this.fondEcran.className = 'fondEcran';
		if (is_ie){

			var divbas = document.createElement('div');

			divbas.style.bottom ='0px';
			divbas.style.position = 'absolute';
			divbas.style.height = '20px';
			

			//			divbas.style.display = 'none';
			//			divbas.style.border = 'solid red 1px';


			document.body.appendChild(divbas);

			var posDivBas = Element.cumulativeOffset(divbas);

			this.fondEcran.style.height = parseInt(posDivBas[1] + 20) + 'px';
			this.fondEcran.style.top  = 0;
			this.fondEcran.style.left = 0;
			document.body.appendChild(this.fondEcran);

		} else {

			var pageSize = this.getPageSize();
			this.fondEcran.style.height = pageSize[1] + 'px';
			
			//this.fondEcran.style.height = '100%';//Element.getDimensions(document.body).height;
			this.fondEcran.style.top = '0';
			this.fondEcran.style.left = '0';
			document.body.insertBefore(this.fondEcran, document.body.childNodes[0]);
		}

		// Ferme la fenetre aussi en faissent click sur le background
		if(is_ie) transportClass =  this;
		else this.fondEcran.transportClass = this;
		if(this.onclickBgClose) Event.observe(
		this.fondEcran,
		'click',
		function(){
			if(is_ie) transportClass.close();
			else this.transportClass.close();
		}
		);

		Element.setOpacity(this.fondEcran, 0.5);
	},

	hiddenFondEcran : function(){

		//if(is_ie) this.pe.stop();
		document.body.removeChild(this.fondEcran);

	},

	show : function(){

		// montrer le fond d'ecran
		if(this.modal == true){
			this.showFondEcran();
		}

		this.fenetre.style.zIndex = parseInt(this.getLastZIndex()) + 1;
		this.fenetre.appendChild(this.tblFenetre);

		if(is_ie){

			this.fenetre.style.top = 0;
		}

		this.fenetre.style.position = 'absolute';
		
		
		if(!this.noEffects) this.fenetre.style.display = 'none';
		else {
			this.fenetre.style.display = 'block';
		}
		
		//this.center();
		this.setposition();

		document.body.appendChild(this.fenetre);

		// Effect pour faire apparaitre la fenetre
		if(!this.noEffects) new Effect.Appear(this.fenetre, 0.0, 1.0);

		// pour pouvoir deplacer la fenetre
		// if(this.draggable) new Draggable(this.fenetre);

		this.fenetre.obj = this;

		function movebody(event) {if(this.obj)this.obj.Drag(event || window.event);}

		if (this.draggable) {
			
			Event.observe(this.fenetre, 'mousedown', function(event){
				Event.observe(document.body, 'mousemove', movebody);
				this.obj.registerClick(event || window.event);
			});
			
			
			Event.observe(this.fenetre, 'mouseup', function(event){
				this.obj.unregisterClick(event || window.event);
				Event.stopObserving(document.body, 'mousemove', movebody);
			});
			
		}

	},

	setContent : function(content){

		this.cellContent.innerHTML = content;
	},

	setIcon : function (_icone){

		this.iconeCell.innerHTML = '<img src=' + _icone + ' />';

	},
	setTitle : function (title){


		this.titleCell.innerHTML = title.stripTags();

	},
	
	setModal : function(bool_modal){
		
		this.modal = bool_modal;
		
	},

	close : function(){

		// ferme la fenetre
		if(this.onclose){

			if(typeof(this.onclose) == 'function'){
				this.onclose();
			} else {
				exec(this.onclose);
			}
		}

		if(!this.noEffects) new Effect.DropOut(this.fenetre);
		else this.fenetre.style.display = 'none';

		if(this.modal == true) this.hiddenFondEcran();

		// After Close
		if(this.afterclose){

			if(typeof(this.afterclose) == 'function'){
				this.afterclose();
			} else {
				exec(this.afterclose);
			}
		}

	},
	/**
	* efface tout le contenu de  la fen�tre
	*/
	clear : function(){

		this.cellContent.innerHTML = '&nbsp;';

	},

	/**
	* Charge une url en ajax
	*/
	loadUrl : function(url, options){

		options = (typeof(options) == 'object') ? options : {};

		var objClasse = this;
		

		new Ajax.Request(url, {

			onComplete: function(transport) {

				
				objClasse.cellContent.innerHTML = transport.responseText;
				
				if(objClasse.onload) {
					objClasse.onload();
				}
				
				//objClasse.center();
                objClasse.setposition();
			},
			onFailure : function (transport){

				objClasse.cellContent.innerHTML = 'Erreur de chargement...';

			},
			onException : function  (transport, exeption){

				objClasse.clear();
				//objClasse.cellContent.innerHTML = 'Exception:' + "\n" + transport.responseText + " " + exeption;

			},
			onFailure : function (){

				objClasse.cellContent.innerHTML = 'Failure.';

			},
			onSuccess : function (transport){

				objClasse.clear();
				//objClasse.cellContent.innerHTML = 'Success.';

			},
			contentType : 'application/x-www-form-urlencoded'


		});

	},
	
	center : function(){
		
		if(!this.fenetre.getDimensions) return;
		
		// calculate top and left offset for the lightbox 
        var arrayPageScroll = document.viewport.getScrollOffsets();
		var fenetreDimensions = this.fenetre.getDimensions();
		var pageSize = this.getPageSize();
		
        var theTop = arrayPageScroll[1] + (document.viewport.getHeight() / 10);
		var theLeft = (pageSize[0] / 2) - (fenetreDimensions.width / 2);
		this.fenetre.style.top = theTop + 'px';
		this.fenetre.style.left = theLeft + 'px';
	},
	
	setposition : function(){
		
		if(!this.fenetre.getDimensions) return;
		
		// calculate top and left offset for the lightbox 
        var arrayPageScroll = document.viewport.getScrollOffsets();
		var fenetreDimensions = this.fenetre.getDimensions();
		var pageSize = this.getPageSize();

        var theTop = arrayPageScroll[1] ;
        offset=20;
        if ( (pageSize[0] - fenetreDimensions.width) > 100 ) offset=100;
		var theLeft = (pageSize[0] ) - (fenetreDimensions.width )-offset;
		this.fenetre.style.top = theTop + 'px';
		this.fenetre.style.left = theLeft + 'px';
	},

	getLastZIndex : function(){

		var divs = document.getElementsByTagName('div');
		var zIndexPlusHaut = 0;

		for(i=0; i < divs.length; i++){
			if(divs[i].style.zIndex != null && divs[i].style.zIndex > zIndexPlusHaut)
			zIndexPlusHaut = divs[i].style.zIndex;
		}

		zIndexPlusHaut = (zIndexPlusHaut == 0) ? divs.length : zIndexPlusHaut;
		return zIndexPlusHaut;
	},


	/**
	 * enregistre le click sur la fenetre pour effectuer un drag
	 */
	registerClick: function (e) {

		this.ClickRegistered = true;

		if(e.clientX) {
			this.tx = parseInt(this.fenetre.style.left+0) - e.clientX;
			this.ty = parseInt(this.fenetre.style.top+0) - e.clientY;
		} else {
			this.tx = parseInt(this.fenetre.style.left+0) - event.clientX;
			this.ty = parseInt(this.fenetre.style.left+0) - event.clientY;
		}

		// on enregistre l'objet dragu� courant
		document.body.obj = this;

	},

	/**
	 * stop l'action drag : d�clench� lorsque l'utilisateur arrete de cliquer
	 */
	unregisterClick: function (e) {

		this.ClickRegistered = false;

	},



	Drag: function (e) {

		if(this.ClickRegistered) {

			if(e.clientX) {
				var left = this.tx + e.clientX;
				var top  = this.ty + e.clientY;
			} else {
				var left = this.tx + event.clientX;
				var top  = this.ty + event.clientY;
			}

			// on travaille en mode strict et non en quirks,
			// il faut donc rajouter 'px' a la fin, sinon ca ne fonctionne pas
			this.fenetre.style.left = left + 'px';
			this.fenetre.style.top = top + 'px';

		}
	},
	getPageSize: function() {
	        
	     var xScroll, yScroll;
		
		if (window.innerHeight && window.scrollMaxY) {	
			xScroll = window.innerWidth + window.scrollMaxX;
			yScroll = window.innerHeight + window.scrollMaxY;
		} else if (document.body.scrollHeight > document.body.offsetHeight){ // all but Explorer Mac
			xScroll = document.body.scrollWidth;
			yScroll = document.body.scrollHeight;
		} else { // Explorer Mac...would also work in Explorer 6 Strict, Mozilla and Safari
			xScroll = document.body.offsetWidth;
			yScroll = document.body.offsetHeight;
		}
		
		var windowWidth, windowHeight;
		
		if (self.innerHeight) {	// all except Explorer
			if(document.documentElement.clientWidth){
				windowWidth = document.documentElement.clientWidth; 
			} else {
				windowWidth = self.innerWidth;
			}
			windowHeight = self.innerHeight;
		} else if (document.documentElement && document.documentElement.clientHeight) { // Explorer 6 Strict Mode
			windowWidth = document.documentElement.clientWidth;
			windowHeight = document.documentElement.clientHeight;
		} else if (document.body) { // other Explorers
			windowWidth = document.body.clientWidth;
			windowHeight = document.body.clientHeight;
		}	
		
		// for small pages with total height less then height of the viewport
		if(yScroll < windowHeight){
			pageHeight = windowHeight;
		} else { 
			pageHeight = yScroll;
		}
	
		// for small pages with total width less then width of the viewport
		if(xScroll < windowWidth){	
			pageWidth = xScroll;		
		} else {
			pageWidth = windowWidth;
		}

		return [pageWidth,pageHeight];
	}

}