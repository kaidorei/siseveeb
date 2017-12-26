loadCss("dialogs.css");

function Dialog(tag) {
	this.frame = document.createElement("div");
	this.frame.className = "dialog";
	this.frame.onmousedown = dom.frameMouseDown;
	this.header = document.createElement("div");
	this.header.className = "dialog-header";
	this.header.style.position = "relative";
	this.header.onmousedown = dom.headerMouseDown;
	this.title = document.createElement("div");
	this.header.appendChild(this.title);
	this.icons = document.createElement("div");
	this.icons.dialog = this;
	this.icons.style.position = "absolute";
	this.icons.style.right = "5";
	this.icons.style.top = "5";
	dom.attachContainerMethods(this.icons);
	this.header.appendChild(this.icons);
	this.frame.appendChild(this.header);
	this.content = document.createElement("div");
	this.content.className = "dialog-content";
	this.content.dialog = this;
	dom.attachContainerMethods(this.content);
	this.frame.appendChild(this.content);
	this.footer = document.createElement("div");
	this.footer.className = "dialog-footer";
	this.footer.dialog = this;
	dom.attachContainerMethods(this.footer);
	this.frame.appendChild(this.footer);
	document.body.appendChild(this.frame);
	
	if (tag != undefined)
		this.tag = tag;
	
	if (Dialog.dlgs == undefined)
		Dialog.dlgs = new Array(); //list of existing dialogs
		
	Dialog.dlgs.push(this);
}

Dialog.reinit = function(tag) {
	if (Dialog.dlgs == undefined)
		return;
		
	for (var i = 0; i < Dialog.dlgs.length; i++){
		var dlg = Dialog.dlgs[i];
		if (tag == undefined)
			dlg.reinit();
		else if (dlg.tag == tag)
			dlg.reinit();
	}
}

Dialog.prototype.setInit = function(init) {
	this.init = init;
	this.init();
}

Dialog.prototype.reinit = function() {
	if (this.init != undefined) {
		this.clear();
		this.init();
	}
}

Dialog.prototype.clear = function() {
	this.title.innerHTML = "";
	this.icons.innerHTML = "";
	this.content.innerHTML = "";
	this.footer.innerHTML = "";
}

Dialog.prototype.remove = function() {
	Dialog.dlgs.remove(this); 
	document.body.removeChild(this.frame);
}

Dialog.prototype.setWidth = function(width) {
	this.frame.style.width = width;
	return this;
}

Dialog.prototype.setHeight = function(height) {
	this.frame.style.height = height;
	return this;
}

Dialog.prototype.setVScroll = function(height) {
	this.content.style.height = height;
	this.content.style.overflow = "auto";
}

Dialog.prototype.setTitle = function(title) {
	this.title.innerHTML = title;
	return this;
}

Dialog.prototype.show = function() {
	this.frame.style.display = "block";
	this.frame.style.zIndex = getMaxZindex() + 1;
	return this;
}

Dialog.prototype.hide = function() {
	this.frame.style.display = "none";
	return this;
}

Dialog.prototype.visible = function() {
	return this.frame.style.display != "none";
}

Dialog.prototype.move = function(x,y)
{
	if (x == undefined) //screen center if unspecified
	{
		x = Math.floor(0.5 * (document.body.clientWidth - this.frame.offsetWidth)) + document.body.scrollLeft;
		if (x < 0)
			x = 0;
	}
	
	if (y == undefined) //screen center if unspecified
	{
		y = Math.floor(0.5 * (document.body.clientHeight - this.frame.offsetHeight)) + document.body.scrollTop;
		if (y < 0)
			y = 0;
	}
	
	this.frame.style.left = x + 'px';
	this.frame.style.top = y + 'px';
	return this;
}


var dom = {
	frameMouseDown: function() { this.style.zIndex = getMaxZindex() + 1; },

	bodyMouseMove: function(event) {
		var e = event || window.event;
		if (Dialog.dragobj != null)
		{
			Dialog.dragobj.style.left = (e.clientX + Dialog.DX) + "px";
			Dialog.dragobj.style.top = (e.clientY + Dialog.DY) + "px";
		}
	},
	
	bodyMouseUp: function() {
		if (Dialog.dragobj != null) {
			Dialog.dragobj.style.cursor = "default";
			Dialog.dragobj = null;
		}
		document.body.onmousemove = null;
		document.body.onmouseup = null;
		disableSelect(false);
	},
	
	headerMouseDown: function(event) {
		var e = event || window.event;
		var obj = this.parentNode;
		Dialog.dragobj = obj;
		obj.style.cursor = "move";
		Dialog.DX = parseInt(obj.style.left, 10) - e.clientX;
		Dialog.DY = parseInt(obj.style.top, 10) - e.clientY;
		document.body.onmousemove = dom.bodyMouseMove;
		document.body.onmouseup = dom.bodyMouseUp;
		disableSelect();
	},

	attachContainerMethods: function(element) {
		element.appendContainer = dom.appendContainer;
		element.appendButton = dom.appendButton;
		element.appendCloseBtn = dom.appendCloseBtn;
		element.appendHideBtn = dom.appendHideBtn;
		element.appendBitBtn = dom.appendBitBtn;
		element.appendList = dom.appendList;
		element.appendPara = dom.appendPara;
		element.appendSubtitle = dom.appendSubtitle;
		element.appendCheck = dom.appendCheck;
		element.appendTable = dom.appendTable;
		element.appendSpan = dom.appendSpan;
		element.appendSelect = dom.appendSelect;
		element.appendImg = dom.appendImg;
		element.appendIcon = dom.appendIcon;
		element.appendHideIcon = dom.appendHideIcon;
		element.appendCloseIcon = dom.appendCloseIcon;
		element.newline = dom.appendNewline;
	},
	
	getFirstSelected: function() {
		for (var i = 0; i < this.items.length; i++)
			if (this.items[i].checked)
				return this.items[i];

		return null;
	},
	
	setSelected: function(item) {
		for (var i = 0; i < this.items.length; i++)
			this.items[i].checked = (this.items[i] == item);
	},
	
	setSelectedByObject: function(obj) {
		for (var i = 0; i < this.items.length; i++)
			this.items[i].checked = (this.items[i].object == obj);
	},
	
	setSelectedIndex: function(index) {
		for (var i = 0; i < this.items.length; i++)
			this.items[i].checked = (i == index);
	},
	
	clearSelection: function() {
		for (var i = 0; i < this.items.length; i++)
			this.items[i].checked = false;
	},
	
	execOptions: function(element, options) {
		if (options == undefined)
			return;
		
		if ("hint" in options)
			element.setAttribute("title", options.hint);
		
		if ("cls" in options)
			element.className = options.cls;
	
		if ("onclick" in options)
			setEvtHandler(element, "click", options.onclick);
				
		if ("ondblclick" in options)
			setEvtHandler(element, "dblclick", options.ondblclick);
		
		if ("onchange" in options)
			setEvtHandler(element, "change", options.onchange);
		
		if ("onload" in options)
			setEvtHandler(element, "load", options.onload);
		
		if ("object" in options)
			element.object = options.object;
		
		if ("css" in options)
			element.style.cssText = options.css;
		
		if ("width" in options)
			element.style.width = options.width;
		
		if ("height" in options)
			element.style.height = options.height;
			
		if (options.scroll) {
			element.style.overflow = "auto";
			element.style.borderWidth = "1px";
			element.style.borderStyle = "solid";
			element.style.borderColor = "black";
		}
		
		if ("cursor" in options)
			element.style.cursor = options.cursor;
		
		if ("align" in options)
			element.style.textAlign = options.align;
			
		if ("valign" in options)
			element.style.verticalAlign = options.valign;
		
		if ("leftgap" in options)
			element.style.marginLeft = options.leftgap;
			
		if ("topgap" in options)
			element.style.marginTop = options.topgap;
	},
	
	appendButton: function(caption, onclick, options) {
		var button = document.createElement("input");
		button.setAttribute("type", "button");
		button.className = "dialog-button";
		button.value = caption;
		button.dialog = this.dialog;
		setEvtHandler(button, "click", onclick);
		dom.execOptions(button, options);
		this.appendChild(button);
		return button;
	},
	
	appendCloseBtn: function(caption, options) {
		return this.appendButton( caption, "this.dialog.remove()", options );
	},

	appendHideBtn: function(caption, options) {
		return this.appendButton( caption, "this.dialog.hide()", options );
	},

	appendBitBtn: function(src, label, onclick, options) {
		var button = document.createElement("button");
		button.setAttribute("type", "button");
		button.className = "dialog-bitbtn";
		button.dialog = this.dialog;
		setEvtHandler(button, "click", onclick);
		dom.execOptions(button, options);
		button.innerHTML = '<img src="icons/' + src + '.png"><br><strong>' + label + '</strong>';
		this.appendChild(button);
		return button;
	},
	
	appendContainer: function(options) {
		var div = document.createElement("div");
		dom.attachContainerMethods(div);
		dom.execOptions(div, options);
		this.appendChild(div);
		return div;
	},

	appendList: function(multi, options) {
		var list = this.appendContainer(options);
		list.multi = multi;
		list.items = new Array();
		list.group = uid();
		list.region = list;
		list.firstitem = true;
		list.className = "dialog-list";
		list.appendItem = dom.appendListItem;
		list.appendRegion = dom.appendListRegion;
		list.getFirstSelected = dom.getFirstSelected;	
		list.setSelectedByObject = dom.setSelectedByObject;
		list.setSelected = dom.setSelected;
		list.setSelectedIndex = dom.setSelectedIndex;
		list.clearSelection = dom.clearSelection;
		this.appendChild(list);
		return list;
	},
	
	appendListRegion: function(caption, options) {
		var obj = this.appendPara(caption, { cls: "dialog-list-region-title" });
		var region = this.appendContainer();
		this.region = region;
		obj.onclick = function() { toggleVisibility(region); };
		
		this.firstitem = true;
		return this.region;
	},
	
	appendListItem: function(caption, options) {
		if (!this.firstitem)
			this.region.newline();
		else
			this.firstitem = false;
	
		var input = document.createElement("input");
		input.type = this.multi ? "checkbox" : "radio";
		input.className = this.multi ? "dialog-check" : "dialog-radio";		
		input.setAttribute("name", this.group);
		input.list = this; //reference to parent list
		
		var id = uid();
		input.setAttribute("id", id);
		dom.execOptions(input, options);
		this.region.appendChild(input);
		this.items.push(input);
		
		var label = document.createElement("label");
		label.className = "dialog-list-item-label";
		
		if (browser.isIE)
			label.setAttribute("htmlFor", id);
		else
			label.setAttribute("for", id);
		
		label.appendChild(document.createTextNode(caption));
		this.region.appendChild(label);

		return input;
	},

	appendImg: function(src, options) {
		var img = document.createElement("img");
		img.src = src;
		img.dialog = this.dialog;
		dom.execOptions(img, options);
		this.appendChild(img);
		return img;
	},
	
	appendIcon: function(src, options) {
		var icon = this.appendImg(src, options);
		icon.className = "dialog-icon";
		return icon;
	},
	
	appendHideIcon: function(options) {
		if (options == undefined)
			options = {};
		
		options.onclick = "this.dialog.hide()";
		return this.appendIcon("icons/close.png", options);
	},
	
	appendCloseIcon: function(options) {
		if (options == undefined)
			options = {};
		
		options.onclick = "this.dialog.remove()";
		return this.appendIcon("icons/close.png", options);
	},
	
	appendPara: function(text, options) {
		var para = document.createElement("p");
		if (text != undefined)
			para.innerHTML = text;
		dom.execOptions(para, options);
		this.appendChild(para);
		return para;
	},
	
	appendSubtitle: function(text) {
		return this.appendPara(text, { cls: "dialog-subtitle" });
	},
	
	appendCheck: function(caption, options) {
		var input = document.createElement("input");
		input.type = "checkbox";
		input.className = "dialog-check";
	
		var id = uid();
		input.setAttribute("id", id);
		dom.execOptions(input, options);
		this.appendChild(input);
		
		var label = document.createElement("label");
		
		if (browser.isIE)
			label.setAttribute("htmlFor", id);
		else
			label.setAttribute("for", id);
		
		label.appendChild(document.createTextNode(caption));
		this.appendChild(label);
		
		return input;
	},
	
	appendTable: function(cols, spacing, padding, options) {
		var table = document.createElement("table");
		if (spacing != undefined && spacing != "")
			table.setAttribute("cellspacing", spacing);
		if (padding != undefined && padding != "")
			table.setAttribute("cellpadding", padding);
		table.setAttribute("border", 0);
		table.style.width = "100%";
		table.cols = cols;
		table.cindex = 1;
		table.appendCell = dom.appendCell;
		dom.execOptions(table, options);
		this.appendChild(table);
		return table;
	},
	
	appendCell: function(header, options) {
		if (this.cindex == 1)
			this.row = this.insertRow(-1);
	
		if (header)
			var cell = document.createElement("th");
		else
			var cell = document.createElement("td");

		cell.appendEdit = dom.appendEdit;
		cell.appendIcon = dom.appendIcon;
		cell.appendImg = dom.appendImg;
		dom.execOptions(cell, options);
		this.row.appendChild(cell);
		this.cindex++;
	
		if (this.cindex > this.cols)
			this.cindex = 1;
		
		return cell;
	},
	
	appendEdit: function(options) {
		var edit = document.createElement("input");
		edit.setAttribute("type", "edit");
		edit.className = "dialog-edit";
		edit.style.width = "100%";
		dom.execOptions(edit, options);
		this.appendChild(edit);
		return edit;
	},
	
	appendSpan: function(text, options) {
		var span = document.createElement("span");
		if (text != undefined)
			span.innerHTML = text;
		dom.execOptions(span, options);
		this.appendChild(span);
		return span;
	},
	
	appendNewline: function() {
		this.appendChild(document.createElement("br"));
	},
	
	appendSelect: function(size, options) {
		if (size == undefined)
			size = 1;
		
		list = document.createElement("select");
		list.setAttribute("size", size);
		list.style.width = "100%";
		list.className = "dialog-select";
		list.appendOption = dom.appendOption;
		dom.execOptions(list, options);
		this.appendChild(list);
		return list;
	},
	
	appendOption: function(caption) {
		option = document.createElement("option");
		option.text = caption;
		if (browser.isIE)
			this.add(option);
		else
			this.add(option, null);
		return option;
	},
	
	appendSeparator: function() {
		var hr = document.createElement("hr");
		hr.className = "dialog-rule";
		this.appendChild(hr);
	}
}

function tmsg(titlekey, contentkey) { //translatable message box
	var dlg = new Dialog();
	dlg.setWidth("30em");
	dlg.setInit( function() {
		this.setTitle( T[titlekey] );
		this.icons.appendCloseIcon({ hint: T.close });
		this.content.appendPara( T[contentkey] );
		this.footer.appendCloseBtn(T.ok);
	});
	
	dlg.show().move();
}

function timg(titlekey, src) { //image with translatable title
	var dlg = new Dialog();
	//dlg.setWidth("30em");
	dlg.setInit( function() {
		this.setTitle( T[titlekey] );
		this.icons.appendCloseIcon({ hint: T.close });
		this.content.appendImg( src, {onload: "if (this.dialog.visible()) this.dialog.move();"} );
		this.footer.appendCloseBtn(T.ok);
	});
	
	dlg.show().move();
}