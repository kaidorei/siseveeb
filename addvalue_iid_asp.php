<?
	include("connect.php");
	include("authsys.php");
	include("globals.php");

	  $oid=$_GET["oid"];
	  $dom=$_GET["domain"];
	  $otsing=$_GET["otsing"];
	  $vali=$_GET["vali"];
	  $sel=$_GET["sel"];
		$aine=$_GET["aine"];
	?>

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
			xmlhttp.open("GET","otsing_asp_addvalue_iid.php?domain=<? echo $dom;?>&sel=<? echo $sel;?>&oid1=<? echo $oid;?>&aine=<? echo $aine;?>&value="+document.getElementById("birds").value+"&gpid_demo="+gpid_demo,true);
			xmlhttp.send();
		}

		function ending(){
			window.opener.location.reload();
			window.close();
		}





		$(function() {
			function log( message, oid ) {
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

	//---------------------------------------------------
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
				xmlhttp_tabel.open("GET","tabel_class_iid_asp.php?domain=<? echo $dom;?>&list=<? echo $otsing;?>&oid=<? echo $oid;?>",true);

				xmlhttp_tabel.send();
//---------------------------------------------------------------
			}
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
				xmlhttp.open("GET","otsing_asp_addvalue_iid.php?domain=<? echo $dom;?>&sel=<? echo $sel;?>&oid1=<? echo $oid;?>&aine=<? echo $aine;?>&oid2="+oid,true);
				xmlhttp.send();
			}
			$("#birds").autocomplete({
				source: "otsing_asp.php?domain=<? echo $otsing;?>&vali=<? echo $vali;?>",
				minLength: 3,
				select: function( event, ui ) {
					log( ui.item ?
						"Lisatud: " + ui.item.value + " id=" + ui.item.id :
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
<?
		if($loginform==1) { echo "Juurdepääs keelatud!";}
		else {
		$dom1=substr($dom,0,strpos($dom,"_"));
		$dom2=substr($dom,strpos($dom,"_")+1,strlen($dom));
//	echo "dom1=",$dom1." dom2=".$dom2." ";
//	  $tehtud=0;
//		if($_GET["act"]=="upi"){

		switch($sel)
		{
			case '1':
			//$query="INSERT INTO ".$dom." (oid1,oid2) VALUES (\"".$oid."\",\"".$_POST["entity"]."\")";
				$list_dom=$dom2;
			break;
			case '2':
			//$query="INSERT INTO ".$dom." (oid1,oid2) VALUES (\"".$_POST["entity"]."\",\"".$oid."\")";
				$list_dom=$dom1;
			break;
		}
			//echo $query."<br>";
			//$result=mysql_query($query);
			//$tehtud=1;

//		}

		?>
<link href="scat.css" rel="stylesheet" type="text/css">
<body  onLoad="FocusOnInput()">
<span class="pealkiri">Otsi ja/v&otilde;i lisa
<?
	switch($dom2)
	{
		case "nupula": echo "&nbsp;kontrollküsimusi";
		break;
		case "valem": echo "&nbsp;valemeid";
		break;
		case "aine": echo "&nbsp;mooduleid";
		break;
		case "exp": echo "exp objekte";
		break;
		default: echo $dom;
		break;
	}
	?></span>
<table width="100%" border="0" cellspacing="1" cellpadding="0">
  <tr>
    <td width="3%" background="image/sinine.gif" class="menu" >
<label for="birds">Otsi:</label></td>
    <td width="10%" background="image/sinine.gif" class="menu" ><!--<input width="200" id="birds">--><textarea name="textarea" id="birds" cols="40" rows="2"></textarea></td>
    <td align="center" background="image/sinine.gif" class="menu" >
    <?
switch($list_dom) // uute elementide ikoonid, mis eksperimentide juurde k�ivad
{
	case "exp":
	{	 ?>Uus:<?
		$query_liigid = "SELECT * FROM exp_grupid_demo where autoadd=1 ORDER BY id";
		$result_liigid = $db->query($query_liigid);
		while($row = $result_liigid->fetch_assoc()) {
/*			switch($row['ico_url_lisa'])
			{
				case 9:
					$vajutades='';
				break;
				default:
					$vajutades='';
				break;
			}
*/			echo '<img onClick="lisa_uus(\''.$row["id"].'\')" width="30" src="' . $row['ico_url_lisa'] . '" alt="&nbsp;' . $row['nimi'] . '" title="' . $row['nimi'] . '" border="0">';
		}
		break;
	}
	case "vahendid":
	case "oskus":
	case "pohivara":
	{
		echo '<input type="button"  class="button" value="Lisa uus vahend" onClick="lisa_uus()">';
		break;
	}
	default:
	break;
}
	?></td>
    <td width="27%" align="center" background="image/sinine.gif" class="menu" ><input type="button"  class="button" value="Valmis, sulge aken" onClick="ending()"></td>
  </tr>
   <tr>

    <td colspan="4" class="options" >
<div class="ui-widget" style="margin-top:1em; font-family:Arial">
	Tulemused, mis lisati:
  <div id="log" style="height: 200px; width: 100%; overflow: auto;" class="ui-widget-content"></div>
</div></td>
    </tr>
<tr background="image/sinine.gif">
  <td colspan="4" background="image/sinine.gif"><img src="image/sinine.gif" width="1" height="1"></td>
</tr>

</table>
<textarea name="textarea" id="favorite" cols="75" rows="5"></textarea>
<?
}
?></body>
