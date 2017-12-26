var Langs = [];
var Dicts = []
var T; //translator of the active language

function RegisterLanguage(name, dict)
{
	Langs.push(name);
	Dicts.push(dict);
}

function CreateLanguageBar()
{
	var arr = new Array(Langs.length);
	for (var i = 0; i < Langs.length; i++)
		arr[i] = '<IMG CLASS="flag" SRC="lang/' + Langs[i] + '.png" TITLE="' + Langs[i] + '" ONCLICK="btnLanguageClick(' + i + ')">';

	document.getElementById("LanguageArea").innerHTML = arr.join("&nbsp;");
}

function btnLanguageClick(n) {
	ActivateLanguage(n);
	SetMainTitle();
	if (Props.selected != null)
		Table.updateProperty();
	Table.setHints();
	Dialog.reinit(); //calls reinit of all existing dialog boxes
}

function ActivateLanguage(n) {
	T = Dicts[n];
	Props.sorted = false;
	CreateToolBar();
}

function DetectLanguage() {
	var n = 0;
	var lang = getUrlParamValue("lang");
	if (lang != "")
	{
		n = Langs.indexOf(lang);
		if (n == -1)
		{
			alert("Unsupported language requested: " + lang + "!");
			n = 0;
		}
	}
	
	ActivateLanguage(n);
}