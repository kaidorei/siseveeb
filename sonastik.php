<?
 /* Connecting, selecting database */
    $link = mysql_connect("localhost", "fyysika_ee", "4dNobeliNitro")
     	or die("Could not connect");
    mysql_select_db("fyysika_ee") or die("Could not select database"); 
?><? 
	require_once 'header.php';
///////////////////////////////////////
	$otsing="dict_term";
	$vali="kirje";
	$keel="et";
///////////////////////////////////////7
?><head>
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
///////////////////////////////////////////////////
		function lisa_uus(gpid_demo){
    		document.getElementById("log").innerHTML = "Proovime lisada uue elemendi -" + document.getElementById("birds").value + "-";
			var xmlhttp;

			if (window.XMLHttpRequest)
			  {// code for IE7+, Firefox, Chrome, Opera, Safari
			  xmlhttp=new XMLHttpRequest();
			  }
			else

			  {// code for IE6, IE5
			  	xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
			  }

			xmlhttp.onreadystatechange=function()

			  {
			  if (xmlhttp.readyState==4 && xmlhttp.status==200)
				{
				document.getElementById("favorite").value=xmlhttp.responseText;
				}
			  }
			xmlhttp.open("GET","sonastik_add.php?domain=<? echo $dom;?>&sel=<? echo $sel;?>&oid1=<? echo $oid;?>&value="+document.getElementById("birds").value+"&gpid_demo="+gpid_demo,true);

			xmlhttp.send();	
		}


///////////////////////////////////////////////////
		function ending(){
			window.opener.location.reload();
			window.close();
		}

///////////////////////////////////////////////////		

	$(function() {

//---------------------------------------------------				
			function log( message, oid ) 
			{
				var xmlhttp_tabel;
				var jsonData_tabel;

				$( "<div>" ).text( message ).prependTo( "#log" );
				$( "#log" ).scrollTop( 0 );

				if (window.XMLHttpRequest)
				  {// code for IE7+, Firefox, Chrome, Opera, Safari
				  	xmlhttp_tabel=new XMLHttpRequest();
				  }
				else
				  {// code for IE6, IE5
				  	xmlhttp_tabel=new ActiveXObject("Microsoft.XMLHTTP");
				  }


				xmlhttp_tabel.onreadystatechange=function()
				  {
				  if (xmlhttp_tabel.readyState==4 && xmlhttp_tabel.status==200)

					{

					jsonData_tabel=JSON.parse(xmlhttp_tabel.responseText);

					$( "<div>" ).text( jsonData_tabel ).prependTo( "#log" );
					$( "<div>" ).text( "Tabelis on " + jsonData_tabel.length + " liiget" ).prependTo( "#log" );
					for (var i = 0; i < jsonData.length; i++) {
						var counter = jsonData.nimi[i];
						$( "<div>" ).text( counter ).prependTo( "#log" );
						$( "#log" ).scrollTop( 0 );
					}
					}
				  }
				xmlhttp_tabel.open("GET","sonastik_echo_tabel.php?domain=<? echo $dom;?>&list=<? echo $otsing;?>&oid=<? echo $oid;?>",true);
				xmlhttp_tabel.send();	
			}
//---------------------------------------------------------------			

			function lisa_seos(oid)

			{
				document.getElementById("favorite").value="On: " + oid;
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
					document.getElementById("favorite").value=xmlhttp.responseText;
					}
				  }
				xmlhttp.open("GET","sonastik_add.php?domain=<? echo $dom;?>&sel=<? echo $sel;?>&oid1=<? echo $oid;?>&oid2="+oid,true);
				xmlhttp.send();	
			}
			
			
			$("#birds").autocomplete({
				source: "sonastik_otsing.php?domain=<? echo $otsing;?>&keel=<? echo $keel;?>&vali=<? echo $vali;?>",
				minLength: 3,
				select: function( event, ui ) {
					log( ui.item ?
						"" + ui.item.value + " - " + ui.item.tolk :
						"Nothing selected, input was " + this.value, ui.item.id);
					lisa_seos(ui.item.id);
				}
			});
		});
</script>

<script type="text/javascript">
function FocusOnInput()
{
     document.getElementById("birds").focus();
}
</script>


<link href="scat.css" rel="stylesheet" type="text/css">
</head>
<link href="scat.css" rel="stylesheet" type="text/css">
<body onLoad="FocusOnInput()">
<table align="center" width="600" border="0" cellspacing="1" cellpadding="0">
  <tr> 
    <td width="3%" background="image/sinine.gif" class="menu" >
				<label for="birds">Otsi:</label>
    </td>
    <td width="10%" background="image/sinine.gif" class="menu" ><textarea name="textarea" id="birds" cols="40" rows="2"></textarea></td>

    <td align="center" background="image/sinine.gif" class="menu" ><p>
      <label>
        <input type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_0">
        Eesti </label>
      <br>
      <label>
        <input type="radio" name="RadioGroup1" value="radio" id="RadioGroup1_1">
        Inglise</label>
      <br>
    </p></td>

    <td width="27%" align="center" background="image/sinine.gif" class="menu" ><? 
?>
    <?
			echo '<img onClick="lisa_uus(\''.$row["id"].'\')" width="30" src="images/askis.ico" alt="&nbsp;' . $row['nimi'] . '" title="' . $row['nimi'] . '" border="0">';

	?></td>

  </tr>
   <tr> 

    <td colspan="4" class="options" >
<div class="ui-widget" style="margin-top:1em; font-family:Arial">

	Kirje:

	  <div id="log" style="height: 200px; width: 100%; overflow: auto;" class="ui-widget-content"></div>

</div></td>

    </tr>

<tr background="image/sinine.gif"> 

  <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>

</tr>

 

</table>
<p align="center">
<textarea name="textarea" id="favorite" cols="75" rows="5"></textarea>
</p>
 
</body>

