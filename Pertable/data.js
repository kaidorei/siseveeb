var Props = new Array();
Props.selected = null;
Props.sorted = false;
Props.checkSort = function(){
	if (!this.sorted) {
		this.sort(function(a,b){
			if (a.order > b.order) return 1;
			if (a.order < b.order) return -1;
			return 0;
		});
		this.sorted = true;
	}
}

var Colormaps = new Array();

function Prop(key, data, options)
{
	this.key = key;
	this.data = data;
	
	if (options == undefined)
		options = {};
	
	if (options.numeric == undefined)
		this.numeric = true;
	else
		this.numeric = options.numeric;
		
	if (this.numeric && options.numberFormat != undefined)
		this.numberFormat = options.numberFormat;
		
	if ("unit" in options)
		this.unit = options.unit;
	
	if ("source" in options) {
		if (options.source instanceof Array)
			this.source = options.source;
		else {
			this.source = [options.source];
		}
	}
	
	if ("info" in options)
		this.info = options.info;
	
	if ("category" in options)
		this.category = options.category;
	else
		this.category = "otherprop";
	
	this.order = ["generalprop", "atomicprop", "physicalprop", "abundprop", "otherprop"].indexOf(this.category);
	
	if ("format" in options)
		this.format = options.format;
	else if (this.numeric)
		this.format = this.formatNumeric;
	else
		this.format = this.formatNonNumeric;
	
	if (this.numeric) {
		this.minval = Number.MAX_VALUE;
		for (var i = 0; i < this.data.length; i++) {
			if (this.data[i] != null && this.data[i] < this.minval) {
				this.minval = this.data[i];
				this.lowIndex = i;
			}
		}
		
		this.maxval = Number.MIN_VALUE;
		for (var i = 0; i < this.data.length; i++) {
			if (this.data[i] != null && this.data[i] > this.maxval) {
				this.maxval = this.data[i];
				this.highIndex = i;
			}
		}
	}
}

Prop.prototype.missingValue = "&#8212;";
Prop.prototype.precision = 6;

Prop.prototype.numberFormat = function(value) {
	return value.format();
	//return value.toHTML(this.precision);
}

Prop.prototype.formatNumeric = function(index, withunit) {
	if (this.data[index] == null)
		return this.missingValue;
	else if (withunit && this.unit != undefined)
		return this.numberFormat(this.data[index]) + " " + this.unit;
	else
		return this.numberFormat(this.data[index]);
}

Prop.prototype.formatNonNumeric = function(index) {
	if (this.data[index] == null)
		return this.missingValue;
	else
		return this.data[index];
}

Prop.prototype.formatMin = function() {
	return this.format(this.lowIndex) + " (" + Symbols[this.lowIndex] + ")";
}

Prop.prototype.formatMax = function() {
	return this.format(this.highIndex) + " (" + Symbols[this.highIndex] + ")";
}

Prop.prototype.getName = function(withunit, newline) {
	if (withunit == undefined)
		withunit = false;
	
	if (!withunit || this.unit == undefined)
		return T[this.key];

	if (newline == undefined)
		newline = false;
	
	if (newline)
		return T[this.key] + "<BR>[" + this.unit + "]";
	else
		return T[this.key] + " [" + this.unit + "]";
}

function RegisterData(key, data, options) {
	Props.push(new Prop(key, data, options));
}

Props.push( new Prop("name", Symbols,
	{
		numeric: false,
		category: "generalprop",
		format: function(i) { return T[this.data[i]]; }
	})
);

function Colormap(label, func) {
	this.label = label;
	this.apply = func;
}

function RegisterColormap(label, func) {
	Colormaps.push(new Colormap(label, func));
	if (Colormaps.selected == undefined)
		Colormaps.selected = Colormaps[0];
}

RegisterColormap("Rainbow",
				function(x) {
					var m;
					if (x < 0.5)
					{
						x = 2.0 * x;
						y = 1.0 - x;
						x = Math.sqrt(x);
						y = Math.sqrt(y);
						m = Math.max(x, y);
						return RGB2HTML( 0.0, x / m, y / m);
					}
					else
					{
						x = 2.0 * x - 1.0;
						y = 1.0 - x;
						x = Math.sqrt(x);
						y = Math.sqrt(y);
						m = Math.max(x, y);
						return RGB2HTML( x / m, y / m, 0.0);
					}
				});

RegisterColormap("Yellow",
				function(x) {
					y = Math.sqrt(1.0 - x + 0.1);
					x = Math.sqrt(x + 0.2);
					m = Math.max(x, y);
					return RGB2HTML( x / m, y / m, 0.0);
				});

RegisterColormap("Red",
				function(x) {
					return RGB2HTML( 1, 1 - x, 1 - x);
				});

/*RegisterColormap("Grey",
				function(x) {
					return RGB2HTML( x, x, x);
				});*/


function LinearScale(x, min, max) {
	return (x - min) / (max - min);
}

function LogScale(x, min, max) {
	return (Math.log(x) - Math.log(min)) / (Math.log(max) - Math.log(min));
}

Colormaps.scale = LinearScale;

var getDataDlg = (function() {
	var dlg = null;
	
	var btnClearClick = function()
	{
		if (Props.selected == null)
			return;
		
		dlg.list.clearSelection();
		Props.selected = null;
		Table.updateProperty();
		Table.updateColors();
	}
	
	var optionDataClick = function() {
		if (browser.isIE)
			dlg.list.setSelected( this );
		Props.selected = this.object;
		Table.updateProperty();
		Table.updateColors();
	}
	
	return function() {
		if (dlg == null) {
			dlg = new Dialog();
			dlg.setWidth("20em");
			dlg.setInit(function() {
				Props.checkSort();
				this.setTitle(T.data);
				this.footer.appendButton(T.clear, btnClearClick);
				this.footer.appendHideBtn(T.close);
				this.icons.appendHideIcon({ hint: T.close });
				this.list = this.content.appendList(false, { height: "10em", scroll: true, hint: T.datahint });
				var cat = "";
				for (var i = 0; i < Props.length; i++) {
					if (Props[i].category != cat) {
						cat = Props[i].category;
						this.list.appendRegion(T[cat]);
					};
					this.list.appendItem(Props[i].getName(), { onclick: optionDataClick, object: Props[i] });
					if ( Props[i].info != undefined || Props[i].source != undefined )
						this.list.region.appendIcon("icons/info-small.png",
							{ hint: T.info, onclick: iconInfoClick, object: Props[i], leftgap: "10px" });
				}
			
				this.list.setSelectedByObject( Props.selected );
			});
		}

		return dlg;
	}
})();

function iconInfoClick() {
	var dlg = new Dialog();
	var prop = this.object;
	dlg.setWidth("35em");
	dlg.setInit( function() {
		this.setTitle( T[prop.key] );
		
		if (prop.info != undefined)
			this.content.appendPara( T[prop.info] );
		
		if (prop.source != undefined) {
			var text = T.source + ":";
			for (i = 0; i < prop.source.length; i++)
				text += "<br>" + (i+1).toString() + ". " + prop.source[i];			
			this.content.appendPara( text );
		}
		
		dlg.footer.appendCloseBtn(T.ok);
		dlg.icons.appendIcon("icons/close.png", { hint: T.close, onclick: "this.dialog.remove();" });
	});
	
	dlg.show().move();
}

var getColorDlg = (function() {
	var dlg = null;
	
	var optionClick = function() {
		if (browser.isIE)
			this.list.setSelected(this);
		Colormaps.scale = dlg.scaling.getFirstSelected().object;
		Colormaps.selected = dlg.map.getFirstSelected().object;
		
		if (Props.selected != null && Props.selected.numeric) {
			if (Colormaps.selected != null && Groups.selected.length > 0)
				getGroupDlg().clearSelection();
			else if (Groups.selected.length == 0)
				Table.updateColors();
		} else if (Colormaps.selected != null)
			alert(T.selectdataforcolormap);
	};
	
	return function(){
		if (dlg == null) {
			dlg = new Dialog();
			dlg.setWidth("11em");
			dlg.setInit(function() {
				this.setTitle(T.colormap);
				this.footer.appendHideBtn(T.close);
				this.icons.appendHideIcon({ hint: T.close });
				
				this.content.appendSubtitle(T.scaling + ":");
				this.scaling = this.content.appendList(false, { hint: T.scalinghint });
				this.scaling.appendItem(T.linear, { onclick: optionClick, object: LinearScale });
				this.scaling.appendItem(T.log, { onclick: optionClick, object: LogScale });
			
				this.content.appendSubtitle(T.colormap + ":");
				this.map = this.content.appendList(false, { hint: T.colormaphint });
				this.map.appendItem(T.none, { onclick: optionClick, object: null });
				for (var i = 0; i < Colormaps.length; i++)
					this.map.appendItem(Colormaps[i].label, { onclick: optionClick, object: Colormaps[i] });
				
				this.scaling.setSelectedByObject( Colormaps.scale );
				this.map.setSelectedByObject( Colormaps.selected );
			});
		}
	
		return dlg;
	}
})();

var getPlotDlg = (function() {
	var dlg = null;
	
	var btnClearClick = function() {
		dlg.list.clearSelection();
	}

	var btnOkClick = function() {
		var selected = new Array();
		dlg.selected = selected;
		var list = dlg.list;
			
		for (var i = 0; i < list.items.length; i++)
			if (list.items[i].checked)
				selected.push(list.items[i].object);
		
		if (selected.length == 0) {
			alert(T.selectdataforplot);
			return;
		}
		
		dlg.hide();
		window.open("plot.htm", "plotWnd", "height=500, width=1000, resizable=1, location=0, toolbar=0, menubar=0, scrollbars=0", false);
	}
	
	return function(){
		if (dlg == null) {
			dlg = new Dialog();
			dlg.setWidth("20em");
			dlg.setInit(function() {
				Props.checkSort();
				this.setTitle(T.plot);
				this.footer.appendButton(T.clear, btnClearClick);
				this.footer.appendButton(T.ok, btnOkClick);
				this.footer.appendHideBtn(T.cancel);
				this.icons.appendHideIcon({ hint: T.close });
				this.list = this.content.appendList(true, { height: "15em", scroll: true, hint: T.datahint });
				var cat = "";
				for (var i = 0; i < Props.length; i++)
					if (Props[i].numeric) {
						if (Props[i].category != cat) {
							cat = Props[i].category;
							this.list.appendRegion(T[cat]);
						};
						this.list.appendItem(Props[i].getName(false)).object = Props[i];
					}
			
				this.rescale = this.content.appendCheck(T.rescale);
				this.log = this.content.appendCheck(T.logscale); this.log.style.marginLeft = "15px";
			});
		}

		return dlg;
	}
})();

var getListDlg = (function() {
	var dlg = null;
	
	var btnOkClick = function() {
		var selected = new Array();
		dlg.selected = selected;
		var menu = getListDlg().menu;
		
		for (var i = 0; i < menu.length; i++) {
			var combo = menu[i];
			if (combo.selectedIndex > 0)
				selected.push(combo.options[combo.selectedIndex].object);
		}
		
		if (selected.length == 0) {
			alert(T.selectdataforplot);
			return;
		}
		
		dlg.hide();
		window.open("list.htm", "listWnd", "height=600, width=600, resizable=1, location=0, toolbar=0, menubar=0, scrollbars=1", false);
	}
	
	return function(){
		if (dlg == null) {
			dlg = new Dialog();
			dlg.setWidth("26em");
			dlg.setInit( function() {
				Props.checkSort();
				this.setTitle(T.table);
				this.content.style.textAlign = "right";
				this.footer.appendButton(T.ok, btnOkClick);
				this.footer.appendHideBtn(T.cancel);
				this.icons.appendHideIcon({ hint: T.close });
			
				var count = 9;
				this.menu = new Array(count);
				for (var i = 0; i < count; i++) {	
					this.content.appendSpan(T.column + " " + (i+1).toString() + ": ");
					this.menu[i] = this.content.appendSelect(1, {width: "20em", hint: T.datahint});
					this.menu[i].appendOption(T.none).object = null;
					this.menu[i].appendOption(T.symbol).object = { format: function(index) { return Symbols[index]; },
																getName: function() { return T.symbol; } };
					for (k = 0; k < Props.length; k++)
						this.menu[i].appendOption(Props[k].getName(false)).object = Props[k];
					this.content.newline();
				}
			});
		}
	
		return dlg;
	}
})();

var getHistDlg = (function() {
	var dlg = null;

	var btnOkClick = function() {
		dlg.selected = dlg.list.getFirstSelected();

		if (dlg.selected == null) {
			alert(T.selectdataforhist);
			return;
		}
		
		dlg.selected = dlg.selected.object;
		dlg.start = parseFloat(dlg.editStart.value);
		dlg.stop = parseFloat(dlg.editStop.value);
		dlg.step = parseFloat(dlg.editStep.value);

		if (isNaN(dlg.start)) {
			dlg.editStart.focus();
			dlg.editStart.select();
			alert(T.floaterror + ": " + dlg.editStart.value);
			return;
		}
		
		if (isNaN(dlg.stop)) {
			dlg.editStop.focus();
			dlg.editStop.select();
			alert(T.floaterror + ": " + dlg.editStop.value);
			return;
		}
		
		if (isNaN(dlg.step)) {
			dlg.editStep.focus();
			dlg.editStep.select();
			alert(T.floaterror + ": " + dlg.editStep.value);
			return;
		}

		if (dlg.start > dlg.stop) {
			var tmp = dlg.stop;
			dlg.stop = dlg.start;
			dlg.start = tmp;
		}
		
		dlg.step = Math.abs(dlg.step);
		dlg.count = Math.ceil((dlg.stop - dlg.start) / dlg.step);

		dlg.hide();
		window.open("histogram.htm", "plotWnd", "height=500, width=1000, resizable=1, location=0, toolbar=0, menubar=0, scrollbars=0", false);
	}
	
	var optionPropClick = function() {
		var prop = this.object;
		if (browser.isIE)
			dlg.list.setSelected( this );
		dlg.editStart.value = prop.minval;
		dlg.editStop.value = prop.maxval;
		dlg.editStep.value = (prop.maxval - prop.minval) / 10.0;
	}
	
	return function(){
		if (dlg == null) {
			dlg = new Dialog();
			dlg.setWidth("20em");
			dlg.setInit(function() {
				Props.checkSort();
				this.setTitle(T.histogram);
				this.footer.appendButton(T.ok, btnOkClick);
				this.footer.appendHideBtn(T.cancel);
				this.icons.appendHideIcon({ hint: T.close });
				
				this.list = this.content.appendList(false, { height: "15em", scroll: true, hint: T.datahint });
				var cat = "";
				for (var i = 0; i < Props.length; i++)
					if (Props[i].numeric) {
						if (Props[i].category != cat) {
							cat = Props[i].category;
							this.list.appendRegion(T[cat]);
						};
						this.list.appendItem(Props[i].getName(false), { onclick: optionPropClick, object: Props[i] });
					}
			
				var table = this.content.appendTable(2, 0, 0);
				table.appendCell(false, { align: "right", width: "0px" }).innerHTML = T.start + ":&nbsp;";
				this.editStart = table.appendCell().appendEdit();
			
				table.appendCell(false, { align: "right", width: "0px" }).innerHTML = T.stop + ":&nbsp;";
				this.editStop = table.appendCell().appendEdit();
			
				table.appendCell(false, { align: "right", width: "0px" }).innerHTML = T.step + ":&nbsp;";
				this.editStep = table.appendCell().appendEdit();
			});
		}

		return dlg;
	};
})();