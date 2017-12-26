var Groups = new Array();
Groups.selected = new Array();
Groups.selected.containedInAny = function(inany) {
	var matchAny = function(i) {
		for (var k = 0; k < this.length; k++)
			if ( this[k].contains(i) )
				return true;
		
		return false;
	}

	var matchAll = function(i) {
		for (var k = 0; k < this.length; k++)
			if ( !(this[k].contains(i)) )
				return false;
		
		return true;
	}
	
	if (inany)
		this.match = matchAny;
	else
		this.match = matchAll;
}

function Group(key, data, options)
{
	this.key = key;
	if (typeof data == "function") {
		this.contains = data;
		if (options != undefined && options.param != undefined)
			this.param = options.param;
	} else {	
		this.data = data;
		if (data.length != Symbols.length)	
			this.contains = this.contains2;
	}
	
	if (options != undefined && options.info != undefined)
		this.info = options.info;
}

Group.prototype.contains = function(i) {
	return this.data[i] != 0;
}

Group.prototype.contains2 = function(i) { //if data is list of atomic numbers
	return this.data.indexOf(i + 1) != -1;
}


function RegisterGroup(name, data, options)
{
	var g = new Group(name, data, options);
	Groups.push(g);
	return g;
}


var getGroupDlg = (function() {
	var dlg = null;
	
	var update = function() {
		//document.getElementById("ColorScaleArea").innerHTML = "&nbsp;";
		Groups.selected.clear();
		var items = dlg.list.items;
		for (var k = 0; k < items.length; k++)
			if (items[k].checked)
				Groups.selected.push( items[k].object );
		
		Groups.selected.containedInAny( dlg.inany.checked );
		Table.updateColors();
	}
	
	var optionInfoClick = function() {
		var group = this.object;
		tmsg(group.key, group.info);
	}
	
	var btnClearClick = function() {
		dlg.list.clearSelection();	
		update();
	}
	
	var optionGroupClick = function() {
		if (this.checked && this.object.param != undefined) {
			var value = prompt(T[this.object.param.name], this.object.param.value);
			if (value == null) {
				this.checked = false;
				return;
			}
			
			value = parseFloat(value);
			if ( isNaN(value) ) {
				this.checked = false;
				return;
			}
			
			this.object.param.value = value;
		}
		
		update();
	}
	
	return function() {
		if (dlg == null){
			dlg = new Dialog();
			dlg.setWidth("25em");
			dlg.setInit(function() {
				this.setTitle(T.groups);
				this.footer.appendButton(T.clear, btnClearClick);
				this.footer.appendHideBtn(T.close);
				this.clearSelection = btnClearClick;
				this.icons.appendHideIcon({ hint: T.close });
				this.list = this.content.appendList(true, { height: "10em", scroll: true, hint: T.grouphint });
				for (var i = 0; i < Groups.length; i++) {
					this.list.appendItem(T[Groups[i].key],
						{ onclick: optionGroupClick, object: Groups[i] }).checked = (Groups.selected.indexOf(Groups[i]) != -1);
				
					if ( Groups[i].info != undefined )
						this.list.appendIcon("icons/info-small.png",
							{ hint: T.info, onclick: optionInfoClick, object: Groups[i] }).style.marginLeft = "10px";
				}
			
				var tmp = this.content.appendList(false);
				tmp.style.marginTop = "5px";
				this.inany = tmp.appendItem(T.inanygroup, { onclick: update });
				this.inany.checked = true;
				tmp.appendItem(T.ineachgroup, { onclick: update });
			});
		}
	
		return dlg;
	};
})();

