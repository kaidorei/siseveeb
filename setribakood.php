<?
		include("connect.php");
//		include("authsys.php");	
//		if($loginform==1) { echo "Sorry. Permission denied!";}
//		else {
			$ribakood=$_POST["ribakood"];	//kui ei mahu ära, siis kustpoolt trimmitakse
			$seo_kood=$_POST["seo_kood"];	
?><html>
<head>


	<meta charset="utf-8">
	<link rel="stylesheet" href="jquery-ui/development-bundle/themes/base/jquery.ui.all.css">
	<script src="jquery-ui/js/jquery-1.10.2.js"></script>
	<script src="jquery-ui/development-bundle/ui/jquery.ui.core.js"></script>
	<script src="jquery-ui/development-bundle/ui/jquery.ui.widget.js"></script>
	<script src="jquery-ui/development-bundle/ui/jquery.ui.position.js"></script>
	<script src="jquery-ui/development-bundle/ui/jquery.ui.menu.js"></script>
	<script src="jquery-ui/development-bundle/ui/jquery.ui.autocomplete.js"></script>
	<link rel="stylesheet" href="jquery-ui/development-bundle/demos/demos.css">
	<style>
	.ui-autocomplete-loading {
		background: white url('image/ui-anim_basic_16x16.gif') right center no-repeat;
	}
	</style>


<script>
		$(function() {
			function log( message ) {
				$( "<div>" ).text( message ).prependTo( "#log" );
				$( "#log" ).scrollTop( 0 );
			}
	
			$( "#birds" ).autocomplete({
				source: "vahendid_search.php",
				minLength: 2,
				select: function( event, ui ) {
					log( ui.item ?
						"Selected: " + ui.item.value + " aka " + ui.item.id :
						"Nothing selected, input was " + this.value );
				}
			});
		});
</script>




<script type="text/javascript">
function FocusOnInput()
{
     document.getElementById("InputID").focus();
}
</script>
<script>

function get_vahend(ribakood)
{
//alert("You pressed a key inside the input field");
//document.getElementById("vahend_div").innerHTML="sdf";	

var xmlhttp;
	
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
	
	
//	xmlhttp.open("POST","demo_post.asp",true);
//	xmlhttp.send();

	xmlhttp.onreadystatechange=function()
	  {
	  if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
		document.getElementById("vahend_div").innerHTML=xmlhttp.responseText;
		}
		
	  }
	
	xmlhttp.open("GET","vahendid_asp.php?ribakood="+ribakood,true);
	xmlhttp.send();	//mylist.options[mylist.selectedIndex].text;


}
</script>
<link href="scat.css" rel="stylesheet" type="text/css">
</head>

<body onload="FocusOnInput()">
       
     <input class="fields_big" name="ribakood" type="text" id="InputID"  onKeyDown="if (event.keyCode == 13) {get_vahend(this.value);}">
  <hr>
  <div id="vahend_div"><h2>Skaneeri ribakoodi ...</h2></div>
  <hr>
<div class="ui-widget">
	<label for="birds">Otsi: </label>
	<input id="birds">
</div>

<div class="ui-widget" style="margin-top:2em; font-family:Arial">
	Result:
	<div id="log" style="height: 200px; width: 300px; overflow: auto;" class="ui-widget-content"></div>
</div>
</body>

</html>

