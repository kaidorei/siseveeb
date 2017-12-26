var Layouts = new Array();
var Symbols = [
"H", "He", "Li", "Be", "B", "C", "N", "O", "F", "Ne", "Na", "Mg", "Al", "Si", "P", "S", "Cl", "Ar",
"K", "Ca", "Sc", "Ti", "V", "Cr", "Mn", "Fe", "Co", "Ni", "Cu", "Zn", "Ga", "Ge", "As", "Se", "Br",
"Kr", "Rb", "Sr", "Y", "Zr", "Nb", "Mo", "Tc", "Ru", "Rh", "Pd", "Ag", "Cd", "In", "Sn", "Sb", "Te",
"I", "Xe", "Cs", "Ba", "La", "Ce", "Pr", "Nd", "Pm", "Sm", "Eu", "Gd", "Tb", "Dy", "Ho", "Er", "Tm",
"Yb", "Lu", "Hf", "Ta", "W", "Re", "Os", "Ir", "Pt", "Au", "Hg", "Tl", "Pb", "Bi", "Po", "At", "Rn",
"Fr", "Ra", "Ac", "Th", "Pa", "U", "Np", "Pu", "Am", "Cm", "Bk", "Cf", "Es", "Fm", "Md", "No", "Lr",
"Rf", "Db", "Sg", "Bh", "Hs", "Mt", "Ds", "Rg"];

var Cells = new Array(Symbols.length);

Cells.unselect = function() {
	if (this.selected != undefined)
		this.selected.unselect();
}

Cells.reselect = function() {
	if (this.selected != undefined) {
		var tmp = this.selected;
		this.selected = null;
		tmp.select();
	}
}

var Table = {
	fillContent: function() {
		for (var i = 0; i < Cells.length; i++)
			Cells[i].fillContent();
		
		var headers;
		headers = document.getElementsByName("period-header");
		for (var i = 0; i < headers.length; i++)
			headers[i].className = "period";
			
		headers = document.getElementsByName("group-header");
		for (var i = 0; i < headers.length; i++)
			headers[i].className = "group";
		
		document.getElementById("PropertyInfoArea").innerHTML =
		'<strong><span id="PropertyName"></span></strong><br>' +
		'<table cellpadding="0" cellspacing="0" border="0"><tr><td id="MinPropValue" style="padding: 3px"></td>' +
		'<td id="ScaleBar"></td>' +
		'<td id="MaxPropValue" style="padding: 3px"></td></tr></table>';
	},

	setHints: function() {
		for (var i = 0; i < Cells.length; i++)
			Cells[i].setDefaultHint();
			
		var A;
		A = document.getElementsByName("period-header");
		for (var i = 0; i < A.length; i++)
			A[i].setAttribute("title", T.periodnum);
			
		A = document.getElementsByName("group-header");
		for (var i = 0; i < A.length; i++)
			A[i].setAttribute("title", T.groupnum);
	},
	
	updateColors: function() {
		var createScaleBar = function() {
			var str = '<table cellpadding="0" cellspacing="0" border="0"><tr>';
			for (var x = 0.0; x <= 1.0; x+= 0.02)
				str += '<td bgcolor="' + Colormaps.selected.apply(x) + '">&nbsp;</td>'

			str += '</tr></table>';
			document.getElementById("ScaleBar").innerHTML = str;
		};

		if (Groups.selected.length > 0) {
			for (var i = 0; i < Cells.length; i++)
				if ( Groups.selected.match(i) )
					Cells[i].highlight();
				else
					Cells[i].resetColor();
					
			document.getElementById("ScaleBar").innerHTML = "";
			this.setPropertyRange();
		} else if (Colormaps.selected == null || Props.selected == null || !Props.selected.numeric) {
			for (var i = 0; i < Cells.length; i++)
				Cells[i].resetColor();
			
			document.getElementById("ScaleBar").innerHTML = "";
			this.setPropertyRange();
		} else {
			if (Colormaps.scale == LogScale && Props.selected.minval <= 0.0) {
				alert(T.logerror)
				Colormaps.scale = LinearScale;
			}

			for (var i = 0; i < Cells.length; i++)
			{
				if (Props.selected.data[i] == null)
					Cells[i].resetColor();
				else
					Cells[i].setColor( Colormaps.selected.apply( Colormaps.scale( Props.selected.data[i], Props.selected.minval, Props.selected.maxval ) ) );
			}
			createScaleBar();
			this.setPropertyRange(true);
		};
	},
	
	updateProperty: function(range) {
		if (Props.selected == null) {
			for (var i = 0; i < Cells.length; i++)
				Cells[i].setInfo();
				
			document.getElementById("PropertyName").innerHTML = "";
		} else {
			for (var i = 0; i < Cells.length; i++)
				Cells[i].setInfo( Props.selected.format(i) );
				
			document.getElementById("PropertyName").innerHTML = Props.selected.getName(true, false);
			if (range)
				this.setPropertyRange( Colormaps.selected != null && Groups.selected.length == 0 );
		}
	},
	
	setPropertyRange: function(fill) {
		document.getElementById("MinPropValue").innerHTML = fill ? Props.selected.formatMin() : "";
		document.getElementById("MaxPropValue").innerHTML = fill ? Props.selected.formatMax() : "";
	}
};

var loadingComplete = false;

function RegisterLayout(key) {
	Layouts.push( key );
}

var getLayoutDlg = (function() {
	var dlg = null;
	
	return function() {
		if (dlg == null) {
			dlg = new Dialog();
			dlg.setWidth("10em");
			dlg.setInit( function() {
				this.setTitle(T.layout);
				this.footer.appendHideBtn(T.close);
				this.icons.appendHideIcon({ hint: T.close });
				this.content.style.textAlign = "center";
			
				var A = Layouts.slice(0);
				for (var i = 0; i < A.length; i++)
					A[i] = T[A[i]] + '<br><img src="layouts/' + A[i] + '.png" style="cursor: pointer; margin: 5px;" onclick="getLayoutDlg().hide(); SwitchLayout('+ i + ');">';
		
				this.content.innerHTML = A.join("<hr>");
			});
		}

		return dlg;
	}
})();

var getSearchDlg = (function() {
	var dlg = null;
	
	var editSymbolChange = function() {
		var symbol = dlg.editSymbol.value.trim().toLowerCase().capitalize();
		if (symbol == "") {
			Cells.unselect();
			return;
		}
		
		for (var i = 0; i < Symbols.length; i++)
			if (Symbols[i] == symbol) {
				Cells[i].select();
				return;
			};
			
		Cells.unselect();
	}

	var editNameChange = function() {
		var name = dlg.editName.value.trim().toLowerCase();
		if (name == "") {
			Cells.unselect();
			return;
		}
		
		for (var i = 0; i < Symbols.length; i++)
			if (T[Symbols[i]].indexOf(name) == 0) {
				Cells[i].select();
				return;
			};
		
		Cells.unselect();
	}
	
	return function() {
		if (dlg == null) {
			dlg = new Dialog();
			dlg.setWidth("20em");
			dlg.setInit( function() {
				this.setTitle(T.search);
				this.footer.appendHideBtn(T.close);
				this.icons.appendHideIcon({ hint: T.close });
				
				var table = this.content.appendTable(2, 0, 0);
				table.appendCell(false, { align: "right", width: "0px" }).innerHTML = T.name + ":&nbsp;";
				this.editName = table.appendCell().appendEdit();
				setEvtHandler(this.editName, "change", editNameChange);
			
				table.appendCell(false, { align: "right", width: "0px" }).innerHTML = T.symbol + ":&nbsp;";
				this.editSymbol = table.appendCell().appendEdit();
				setEvtHandler(this.editSymbol, "change", editSymbolChange);
			});
		}

		return dlg;
	}
})();

var getSettingsDlg = (function() {
	var dlg = null;
	
	var btnFullPrecClick = function()
	{
		DefaultNumberFormat.setFullPrec();
		
		if (Props.selected != null)	
			Table.updateProperty(true);
			
		Dialog.reinit("elem");
	}

	var btnLimPrecClick = function()
	{
		DefaultNumberFormat.setPrecision(4);
		
		if (Props.selected != null)	
			Table.updateProperty(true);
			
		Dialog.reinit("elem");
	}

	var btnCompFmtClick = function()
	{
		DefaultNumberFormat.setCompFmt();
		
		if (Props.selected != null)	
			Table.updateProperty(true);
			
		Dialog.reinit("elem");
	}

	var btnSciFmtClick = function()
	{
		DefaultNumberFormat.setSciFmt();
		
		if (Props.selected != null)	
			Table.updateProperty(true);
			
		Dialog.reinit("elem");
	}
	
	return function(){
		if (dlg == null) {
			dlg = new Dialog();
			dlg.setWidth("11em");
			dlg.setInit(function() {
				this.setTitle(T.settings);
				this.footer.appendHideBtn(T.close);
				this.icons.appendIcon("icons/close.png", { hint: T.close, onclick: "this.dialog.hide();" });
				this.content.appendSubtitle(T.numericaccuracy + ":");
				this.content.appendButton("1.23", btnLimPrecClick, { width: "5em", hint: T.limprechint });
				this.content.appendButton("1.2345...", btnFullPrecClick, { width: "5em", hint: T.fullprechint });
				this.content.newline();
				this.content.appendSubtitle(T.numericformat + ":");
				this.content.appendButton("1.2e3", btnCompFmtClick, { width: "5em", hint: T.compfmthint });
				this.content.appendButton("1.2×10³", btnSciFmtClick, { width: "5em", hint: T.scifmthint });
			});
		};
		
		return dlg;
	};
})();

function SwitchLayout(i) {
	if (Layouts.selectedIndex != undefined && Layouts.selectedIndex == i)
		return;
	
	Layouts.selectedIndex = i;
	document.getElementById("TableLoader").src = "layouts/" + Layouts[i] + ".htm";
}

function TableLoadComplete() {
	var loader = document.getElementById("TableLoader");
	if (loader.src == "")
		return;
	
	loader = loader.contentWindow || loader.contentDocument;
	if (loader.document)
		loader = loader.document;
		
	document.getElementById("TableContainer").innerHTML = loader.body.innerHTML;
	loader.body.innerHTML = "";
	
	SetMainTitle();
	Table.fillContent();
	Table.setHints();
	Cells.reselect();

	if (Props.selected != null)
		Table.updateProperty();
	
	Table.updateColors();
}

function Cell(n) {
	this.index = n; //atomic number n >= 1
	this.symbol = Symbols[n-1];
}

Cell.prototype.fillContent = function() {
	var i = this.index.toString();
	this.cell = document.getElementById( "cell" + i );
	this.cell.className = "cell";
	this.link = document.createElement("a");
	this.link.className = "symbol";
	this.link.href = "javascript:SymbolClick(" + i + ");";
	this.link.setAttribute("id", "symbol" + i);
	this.link.innerHTML = this.symbol;
	this.cell.appendChild( this.link );
	this.cell.appendChild( document.createElement("br") );
	this.info = document.createElement("div");
	this.info.className = "info";
	this.info.setAttribute("id", "info" + i);
	this.cell.appendChild( this.info );
}

Cell.prototype.select = function() {
	Cells.unselect();
	this.cell.className = "selected-cell";
	Cells.selected = this;
}

Cell.prototype.unselect = function() {
	this.cell.className = "cell";
	Cells.selected = null;
}

Cell.prototype.setDefaultHint = function() {
	this.link.setAttribute("title", T[this.symbol]);
}

Cell.prototype.setColor = function(color) {
	this.cell.style.backgroundColor = color;
}

Cell.prototype.resetColor = function() {
	this.cell.style.backgroundColor = "";
}

Cell.prototype.highlight = function() {
	this.setColor("yellow");
}

Cell.prototype.setInfo = function(text) {
	if (text == "" || text == undefined || text == null)
	{
		this.info.innerHTML = "";
		this.info.style.display = 'none';
	}
	else
	{
		this.info.innerHTML = text;
		this.info.style.display = 'block';
	}
}

function SymbolClick(n)
{
	if (!loadingComplete)
		return;
	
	var dlg = new Dialog("elem");
	dlg.index = n - 1;
	dlg.setWidth("40em").setVScroll("20em");
	dlg.setInit( function() {
		var k = this.index;
		this.setTitle(T[Symbols[k]].capitalize() + " (" + Symbols[k] + ")");
		this.footer.appendCloseBtn(T.close);
		this.icons.appendCloseIcon({ hint: T.close });
		var table = this.content.appendTable(3, 1, 3);
		
		var cell;
		for (var i = 0; i < Props.length; i++) {
			cell = table.appendCell(true, { align: "right" });
			cell.style.whiteSpace="nowrap";
			cell.innerHTML = T[Props[i].key] + ":";
			cell = table.appendCell(false, { align: "left" });
			cell.style.whiteSpace="nowrap";
			cell.innerHTML = Props[i].format(k, true);
			cell = table.appendCell();
			if ( Props[i].info != undefined || Props[i].source != undefined )
				cell.appendIcon("icons/info-small.png", { hint: T.info, onclick: iconInfoClick, object: Props[i] });
		}

		var arr = new Array();
		for (var i = 0; i < Groups.length; i++)
			if ( Groups[i].contains(k) )
				arr.push(T[Groups[i].key]);
		
		cell = table.appendCell(true, { align: "right", valign: "top" });
		cell.style.whiteSpace="nowrap";
		cell.innerHTML = T.groups + ":";
		cell = table.appendCell(false, { align: "left", valign: "top" });
		cell.style.whiteSpace="nowrap";
		if (arr.length != 0)
			cell.innerHTML = arr.join("<br>");
		else
			cell.innerHTML = Prop.prototype.missingValue;

		this.content.appendPara( T.wikiart + ': ' + T[Symbols[k]].capitalize().toWikiUrl(T.langid).blank() );
	});
	
	dlg.show().move();
}

function SetMainTitle() {
	document.title = T.maintitle;
	document.getElementById("maintitle").innerHTML = T.maintitle + ' <SPAN STYLE="font-size: 60%">[' + T[Layouts[Layouts.selectedIndex]] + ']</SPAN>';;
}

function CreateToolBar() {
	var container = document.getElementById("ToolbarArea");
	container.appendBitBtn = dom.appendBitBtn;
	container.innerHTML = "";
	
	var btnGroupsClick = function()	{ getGroupDlg().show().move( getAbsLeft(this), getAbsTop(this) ); };
	
	var btnDataClick = function() {
		getDataDlg().show().move( getAbsLeft(this), getAbsTop(this) );
		getDataDlg().list.setSelectedByObject( Props.selected );
	}
	
	var btnColorClick = function() {
		getColorDlg().show().move( getAbsLeft(this), getAbsTop(this) );
		getColorDlg().scaling.setSelectedByObject( Colormaps.scale );
		getColorDlg().map.setSelectedByObject( Colormaps.selected );
	}
	
	var btnPlotClick = function() {	getPlotDlg().show().move( getAbsLeft(this), getAbsTop(this) ); };
	
	var btnHistClick = function() {	getHistDlg().show().move( getAbsLeft(this), getAbsTop(this) ); };
	
	var btnListClick = function() {	getListDlg().show().move( getAbsLeft(this), getAbsTop(this) ); };
	
	var btnLayoutClick = function() { getLayoutDlg().show().move( getAbsLeft(this), getAbsTop(this) ); };

	var btnSearchClick = function() { getSearchDlg().show().move( getAbsLeft(this), getAbsTop(this) ); };
	
	var btnSettingsClick = function() {	getSettingsDlg().show().move( getAbsLeft(this), getAbsTop(this) ); };
	
	container.appendBitBtn("groups", T["groups"], btnGroupsClick, {hint: T["grouphint"]});
	container.appendBitBtn("data", T["data"], btnDataClick, {hint: T["datahint"]});
	container.appendBitBtn("colormap", T["colormap"], btnColorClick, {hint: T["colormaphint"]});
	container.appendBitBtn("plot", T["plot"], btnPlotClick, {hint: T["plothint"]});
	container.appendBitBtn("histogram", T["histogram"], btnHistClick, {hint: T["histogramhint"]});
	container.appendBitBtn("table", T["table"], btnListClick, {hint: T["tablehint"]});
	container.appendBitBtn("layout", T["layout"], btnLayoutClick, {hint: T["layouthint"]});
	container.appendBitBtn("search", T["search"], btnSearchClick, {hint: T["searchhint"]});
	container.appendBitBtn("settings", T["settings"], btnSettingsClick, {hint: T["settingshint"]});	
}

function InitApp() {
	for (i = 0; i < Cells.length; i++)
		Cells[i] = new Cell(i+1);
		
	CreateLanguageBar();
	DetectLanguage();
	SwitchLayout(0);
	loadScripts( delayedScripts, function() { loadingComplete = true; toggleVisibility("Toolbar"); } );
	
	
	var body = document.getElementsByTagName("body")[0];	
	if ("unselectable" in body) // Internet Explorer, Opera
		disableSelect = function(disable) {
			if (disable == undefined)
				disable = true;
			body.unselectable = disable;
		};
	else if (window.getComputedStyle) {
		var style = window.getComputedStyle(body, null);
		if ("MozUserSelect" in style) // Firefox
			disableSelect = function(disable) { body.style.MozUserSelect = (disable == undefined || disable) ? "none" : "text"; };
		else if ("webkitUserSelect" in style) // Google Chrome and Safari
			disableSelect = function(disable) { body.style.webkitUserSelect = (disable == undefined || disable) ? "none" : "text"; };
	};	
}

