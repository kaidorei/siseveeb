var browser = (function(){
	var obj = {};
	
	var versionDetect = function(str) {
		var i = navigator.userAgent.indexOf(str);
		if (i == -1)
			return -1;
		else {
			i += str.length;
			return parseInt(navigator.userAgent.substr(i + 1));
		}
	};
	
	obj.isIE = navigator.appName.indexOf("Microsoft") != -1;
	obj.isSafari = navigator.userAgent.indexOf("Safari") != -1;
	obj.isFF = navigator.userAgent.indexOf("Firefox") != -1;
	obj.isOpera = "opera" in window;
	obj.isOther = false;
	
	if (obj.isIE)
		obj.version = versionDetect("MSIE");
	else if (obj.isFF)
		obj.version = versionDetect("Firefox");
	else {
		obj.isOther = true;
		obj.version = -1;
	}
	
	return obj;
})();

function isString(o) {
	return typeof o == "string" || (typeof o == "object" && o.constructor === String);
}

function isNumber(o) {
	return typeof o == "number" || (typeof o == "object" && o.constructor === Number);
}

Object.prototype.clone = function() {
	var out = (this instanceof Array) ? [] : {};
	for (i in this) {
		if (i == "clone") continue;
		if (this[i] && typeof this[i] == "object")
			out[i] = this[i].clone();
		else
			out[i] = this[i];
	}
	return out;
};

String.prototype.trim = function()
{
	return this.replace(/^\s+/, '').replace(/\s+$/, '')
}

String.prototype.leftStr = function(n)
{
	return this.substr(1, n);
}

String.prototype.trimZeroes = function()
{
	return this.replace(/[0]+$/, '').replace(/[\.]$/, '')
}


String.prototype.lpad = function(padStr, length)
{
	var str = this;
    while (str.length < length)
        str = padStr + str;
    return str;
}

String.prototype.capitalize = function()
{
	return (this.length == 0) ? this : this.charAt(0).toUpperCase() + this.slice(1);
}

String.prototype.format = function() {
    var str = this;
    for (var i = 0; i < arguments.length; i++) {
        var regexp = new RegExp('\\{'+i+'\\}', 'gi');
        str = str.replace(regexp, arguments[i]);
    }
    return str;
};

String.prototype.link = function(options) {
	if (options == undefined)
		options = {};

	if (options.url == undefined)
		options.url = this.split(" ").join("");
		
	var out = '<a href="' + options.url + '"';
	
	if ("title" in options)
		out += ' title="' + options.title + '"';
	
	if ("cls" in options)
		out += ' class="' + options.cls + '"';
	
	if (options.blank)
		out += ' target="_blank"';
	
	return out + '>' + this + '</a>';
}

String.prototype.blank = function() {
	return '<a href="' + this.split(" ").join("") + '" target="_blank">' + this + '</a>';
}

String.prototype.toWikiUrl = function(lang) {
	if (lang == undefined)
		lang = "en";
		
	return "http://" + lang + ".wikipedia.org/wiki/" + this.split(" ").join("_");		
}

String.prototype.wiki = function(options) {
	if (options == undefined)
		options = {};

	if (options.title == undefined)
		options.title = "Wikipedia article";

	options.url = this.toWikiUrl(options.lang);

	return this.link(options);
}

Math.log10 = function(x) { return this.log(x) / this.LN10; };

function NumberFormat() {
	this.precision = 4;
	this.low = 0.01;
	this.high = 1e6;
	
	this.setFullPrec = function() { this.precision = 15 };
	
	this.setPrecision = function(n) {
		if (n < 3)
			this.precision = 3;
		else if (n > 15)
			this.precision = 15;
		else
			this.precision = n;
	};
	
	this.setFastFmt = function() { this.format = this.formatFast };
	
	this.setCompFmt = function() { this.format = this.formatComp };
	
	this.setSciFmt = function() { this.format = this.formatSci };
	
	this.formatFast = function(x) {
		if (this.precision >= 15)
			return x.toString();
		else
			return this.toPrecTrim(this.precision);
	};
	
	this.formatComp = function(x) {
		if (x == 0)
			return 0;
		
		var neg = x < 0;
		x = Math.abs(x);
		
		var m = Math.floor( Math.log10(x) );
		if (x < this.low || x >= this.high)
			res = (x / Math.pow(10, m)).toPrecTrim(this.precision) + "e" + m.toString();
		else if (m + 1 >= this.precision)
			res = x.toFixed();
		else
			res = x.toFixed(this.precision - m - 1).trimZeroes();
		
		if (neg) res = "-" + res;
		return res;
	};
	
	this.formatSci = function(x) {
		if (x == 0)
			return 0;
		
		var neg = x < 0;
		x = Math.abs(x);
		
		var m = Math.floor( Math.log10(x) );
		if (x < this.low || x >= this.high)
			res = (x / Math.pow(10, m)).toPrecTrim(this.precision) + "&times;10<SUP>" + m.toString().replace("-", "&#8211;") + "</SUP>";
		else if (m + 1 >= this.precision)
			res = x.toFixed();
		else
			res = x.toFixed(this.precision - m - 1).trimZeroes();
		
		if (neg) res = "&#8211;" + res;
		return res;
	};
	
	this.format = this.formatComp;
};

var DefaultNumberFormat = new NumberFormat();

Number.prototype.toHTML = function(n) {
	var m = Math.floor( Math.log10(this) );
	if (this < 0.01 || this >= 1e6)
		return (this / Math.pow(10, m)).toPrecision(n).trimZeroes() + 
			"&middot;10<SUP>" + m.toString().replace("-", "&#8211;") + "</SUP>";
	else if (m >= n)
		return this.toFixed();
	else
		return this.toPrecision(n).trimZeroes();
}

Number.prototype.toPrecTrim = function(n) {
	if (n == undefined)
		return this.toString();
	else
		return parseFloat(this.toPrecision(n)).toString();
}

Number.prototype.format = function(f) {
	if (f == undefined)
		f = DefaultNumberFormat;

	return f.format(this);
}

Array.prototype.clear = function() {
	this.length = 0;
	return this;
}

Array.prototype.remove = function(obj) {
	if (this.length > 0) {	
		var remaining = new Array();
		for (var i = 0; i < this.length; i++)
			if (this[i] != obj)
				remaining.push(this[i]);

		this.length = 0;
		this.push.apply(this, remaining);
	}
	return this;
}

if (!Array.prototype.indexOf) {
	Array.prototype.indexOf = function (obj, fromIndex) {
		if (fromIndex == null)
			fromIndex = 0;
		else if (fromIndex < 0)
			fromIndex = Math.max(0, this.length + fromIndex);

		for (var i = fromIndex; i < this.length; i++) {
			if (this[i] === obj)
				return i;
		}
		return -1;
	};
}

Array.prototype.apply = function(f) {
	for (var i = 0; i < this.length; i++)
		this[i] = f(this[i]);
	return this;
}

Array.prototype.last = function() {
	return (this.length == 0) ? null : this[this.length - 1];
}

function getUrlParamValue( name )
{
	name = name.replace(/[\[]/,"\\\[").replace(/[\]]/,"\\\]");
	var regexS = "[\\?&]"+name+"=([^&#]*)";
	var regex = new RegExp( regexS );
	var results = regex.exec( window.location.href );
	return (results == null) ? "" : results[1];
}

function getMaxZindex(id) {
	var parent;
	if (id == null || id == undefined || id == "")
		parent = document;
	else
		parent = getElementById(id);
	
	var elements = parent.getElementsByTagName("*");
	var z = 0;

	for (var i = 0; i < elements.length; i++)
		if (elements[i].style.zIndex != "")
			z = Math.max( z, parseInt(elements[i].style.zIndex) );
		
	return z;
}

function TLink(text, title, url) {
	if (url == "" || url == null || url == undefined)
		return '<SPAN TITLE="' + title + '">' + text + '</SPAN>';
	else
		return '<A HREF="' + url + '" TITLE="' + title + '" TARGET="_blank">' + text + '</A>';
}

function uid() {
	var N = 6;
	var alphabet = "0123456789abcdefghijklmnopqurstuvwxyzABCDEFGHIJKLMNOPQURSTUVWXYZ";
	var str = "";
	for (var i = 0; i < N; i++)
		str += alphabet.charAt( Math.floor(Math.random() * 62) );
	
	return str;
}

function removeElement(obj) {
	if (isString(obj))
		obj = document.getElementById(obj);

	obj.parentNode.removeChild(obj);
}

function hideElement(obj) {
	if (isString(obj))
		obj = document.getElementById(obj);

	obj.style.display = 'none';
}

function toggleVisibility(obj) {
	if (isString(obj))
		obj = document.getElementById(obj);
	
	obj.style.display = (obj.style.display != "none") ? "none" : "";
}

function RGB2HTML(red, green, blue)
{
	red = Math.round(255.0 * red);
	green = Math.round(255.0 * green);
	blue = Math.round(255.0 * blue);
	var rgb = blue | (green << 8) | (red << 16);
 	return "#" + rgb.toString(16).lpad("0", 6);
}

function getAbsLeft( obj ) {
	var x = 0;
    while( obj && !isNaN( obj.offsetLeft ) ) {
        x += obj.offsetLeft;
        obj = obj.offsetParent;
    }
    return x;
}

function getAbsTop( obj ) {
	var y = 0;
    while( obj && !isNaN( obj.offsetTop ) ) {
        y += obj.offsetTop;
        obj = obj.offsetParent;
    }
    return y;
}

function loadScript(url, callback) {
	var script = document.createElement("script");
	script.type = "text/javascript";

	if (callback)
		if (script.readyState) //IE
			script.onreadystatechange = function() {
				if (script.readyState == "loaded" || script.readyState == "complete")
					script.onreadystatechange = null;
				callback();
			}
		else
			script.onload = function() { callback(); };
		
	script.src = url;
	document.getElementsByTagName("head")[0].appendChild(script);
}

function loadScripts(urls, callback) {
	var last = urls.length - 1;
	
	for (var i = 0; i < last; i++)
		loadScript(urls[i]);

	loadScript(urls[last], callback);
}

function loadCss(url) {
	var link = document.createElement("link");
	link.type = "text/css";
	link.rel = "stylesheet";
	link.href = url;
	document.getElementsByTagName("head")[0].appendChild(link);
}

function setEvtHandler(element, evt, behavior) {
	if (evt == "change") {
		if (typeof behavior == "function") {
			if (browser.isIE) {
				element.onkeyup = behavior;
				element.onpaste = behavior;
			} else
				element.oninput = behavior;
		} else if (typeof behavior == "string") {
			if (browser.isIE) {
				element.onkeyup = new Function(behavior);
				element.onpaste = new Function(behavior);
			} else
				element.oninput = new Function(behavior);
		}
	} else {
		evt = "on" + evt;
		
		if (typeof behavior == "function")
			element[evt] = behavior;
		else if (typeof behavior == "string")
			element[evt] = new Function(behavior);
	}
}