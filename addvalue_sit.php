<?
include("connect.php");
include("authsys.php");	
if($loginform==1){
	echo "Juurdep��s keelatud!";}
else {
	$kool_id=$_GET["fid"];	
	$dom=$_GET["domain"];
	$sid=$_GET["sid"];
if($sid)
{
$query_site="SELECT * FROM ".$dom." WHERE id=".$sid."";
//						echo $query3;
$result_site=mysql_query($query_site);
$tulem_site=mysql_fetch_array($result_site);

$query_kool="SELECT * FROM kool WHERE id=".$tulem_site["kool_id"]."";
//						echo $query3;
$result_kool=mysql_query($query_kool);
$tulem_kool=mysql_fetch_array($result_kool);
}


	$tehtud=0;	
	if($_GET["act"]=="upi"){	
		echo "uploading ... ";
		if (is_uploaded_file($_FILES['userfile']['tmp_name'])) {
			$filename = $_FILES['userfile']['tmp_name'];
    		$realname = $_FILES['userfile']['name'];
			$query="SELECT id FROM ".$dom." ORDER BY id DESC LIMIT 1";
			$result=mysql_query($query);
			$line=mysql_fetch_array($result);
			$newid=$line["id"]+1;
			$url="media/".$dom."/".$newid."_".$realname;
			copy($_FILES["userfile"]["tmp_name"],$url);
			$query="INSERT INTO ".$dom." (nimi,url,oid,allkiri_est,allkiri_eng,allkiri_rus) VALUES (\"".$_POST["nimi"]."\",\"".urlencode($url)."\",\"".$oid."\",\"".$_POST["allkiri_est"]."\", \"".$_POST["allkiri_eng"]."\", \"".$_POST["allkiri_rus"]."\")";
		echo $query;
			$result=mysql_query($query);
   			$tehtud=1;
		} else {
		echo "Mingi jama juhtus :("; 
     	} 
	}
?>
<link href="scat.css" rel="stylesheet" type="text/css">
<style type="text/css">
<!--
.back {
	background-color: #FFFFFF;
	border: 2px none #CCCCCC;
}
-->
</style>
<script>

function aken(){
window.open('about:blank','uploader','width=420,height=20,top=100,toolbar=no');
return true;
}

function ending(){
	window.opener.location.reload();
	window.close();
}

function ehee(){
		self.opener.ending();
		window.close();
}

</script>
<body class="back" <? if($tehtud==1) echo "onLoad=\"ehee();\""; ?>>
<form name="form1" enctype="multipart/form-data" method="post" action="<? echo $PHP_SELF; ?>?act=upi&oid=<? echo $oid; ?>&domain=<? echo $dom; ?>" target="uploader" onSubmit="return aken();"><? if($tehtud!=1) {?>


<h1>GLOBE m��tmiskoha iseloomustus</h1>
<p><strong>A. �ldandmed</strong></p>
<p>Kooli nimi: <strong><? echo $tulem_kool["nimi"];?></strong></p>
<p>Protokolli t�itjad: </p>
<p>
  M��tekoha nimi:
  <input name="nimi" type="text" id="df" size="50" maxlength="100" value="<? echo $tulem_site["nimi"]; ?>">
</p>
<p>M��tekoha geograafilised koordinaadid:
  <input type="text" name="WG_LA" id="WG_LA" size="10" value="<? echo $tulem_site["WG_LA"]; ?>">N;
<input type="text" name="WG_LO" id="WG_LO" size="10" value="<? echo $tulem_site["WG_LO"]; ?>">
E; 
<input type="text" name="altitude" id="altitude" size="10"  value="<? echo $tulem_site["altitude"]; ?>">
m.</p>
<p>M��tekoha �mbruse kirjeldus:<br />
  Asula suurus (<em>m�rgi sobiv variant</em>):</p>
<table width="200">
  <tr>
    <td><label>
      <input type="radio" name="asula_kirjeldus" value="0" id="asula_kirjeldus_0">
      �le 100 000 elaniku</label></td>
  </tr>
  <tr>
    <td><label>
      <input type="radio" name="asula_kirjeldus" value="1" id="asula_kirjeldus_1">
      10 000 - 30 000 elanikku</label></td>
  </tr>
  <tr>
    <td><label>
      <input type="radio" name="asula_kirjeldus" value="2" id="asula_kirjeldus_2">
      5000- 10 000 elanikku</label></td>
  </tr>
  <tr>
    <td><label>
      <input type="radio" name="asula_kirjeldus" value="3" id="asula_kirjeldus_3">
      1000 - 5000 elanikku</label></td>
  </tr>
  <tr>
    <td><label>
      <input type="radio" name="asula_kirjeldus" value="4" id="asula_kirjeldus_4">
      100 - 1000 elanikku</label></td>
  </tr>
  <tr>
    <td><label>
      <input type="radio" name="asula_kirjeldus" value="5" id="asula_kirjeldus_5">
      alla 100 elaniku</label></td>
  </tr>
  <tr>
    <td><label>
      <input type="radio" name="asula_kirjeldus" value="6" id="asula_kirjeldus_6">
      maaline asula</label></td>
  </tr>
</table>

<p>L�hedal asuvad saasteallikad (<em>m�rgi k�ik sobivad variandid</em>):</p>
<p>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_0">
    saasteallikad puuduvad</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_1">
    reovee puhastamisega tegelev ettev�te</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_2">
    aktiivne laevandus (mere��rsed koolid)</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_3">
    katlamaja, kus kasutatakse rasket k�tte�li (masuut) v�i p�levkivi</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_4">
    katlamaja, kus kasutatakse kivis�tt</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_5">
    linn v�i kool asub linnas</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_6">
    tiheda liiklusega maantee, magistraalt�nav v�i linnakeskus</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_7">
    eramajad, mida k�etakse puudega</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_7">
    eramajad, mida k�etakse kivis&ouml;ega</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_8">
    aktiivne p�llumajandus</label>
  <br>
</p>
<ul>
  <li></li>
  <li>t��stushoone:  ________________________________________________ (<em>milline?</em>);</li>
  <li>muu:  _______________________________________________________ (<em>milline?</em>).</li>
</ul>
<br clear="all" />
<p align="left">Saasteallikate kaugused linnulennult ja p�hiline saaste liik  (suits, tolm, gaas�):</p>
<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45"><br />
      <strong>nr</strong></td>
    <td width="227"><p align="center"><strong>saasteallikas</strong></p></td>
    <td width="132"><p align="center"><strong>kaugus (m), suund (N-S-N)</strong></p></td>
    <td width="232"><p align="center"><strong>p�hiline saaste liik</strong></p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">1.</p></td>
    <td width="227"><p align="center">&nbsp;</p></td>
    <td width="132"><p align="center">&nbsp;</p></td>
    <td width="232"><p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">2.</p></td>
    <td width="227"><p align="center">&nbsp;</p></td>
    <td width="132"><p align="center">&nbsp;</p></td>
    <td width="232"><p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">3.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">4.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">5.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">6.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">7.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">8.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
</table>
<p align="left">�mbruskonna k�ttekollete kirjeldus:</p>
<ul>
  <ul>
    <li>k�ttekollete liik asulas tervikuna ja  m��tmispaiga l�hedal:</li>
  </ul>
</ul>
<p>&nbsp;</p>
<ul>
  <ul>
    <li>k�ttekollete ligikaudne arv: </li>
  </ul>
</ul>
<p>&nbsp;</p>
<ul>
  <ul>
    <li>kollete tihedus (arv pinna�hiku kohta):</li>
  </ul>
</ul>
<p>&nbsp;</p>
<ul>
  <ul>
    <li>p�letusainete liigid:</li>
  </ul>
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Kuna suur osa  �husaastast p�rineb sissep�lemismootoritest ning tahma tekitavad  diiselmootoriga autod, tolmu igasuguste s�idukite rattad, pakub meile huvi ka  info �mbruskonna transpordi kohta.<br />
  Suuremad teed �mbruskonnas (maantee, raudtee, lennuv�li...),  nende kaugus ja suund, koormus (s�idukite arv aja�hikus, v�imalusel eraldi  tipptundidel ja tavaolukorras).</p>
<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45"><br />
      <strong>nr</strong></td>
    <td width="227"><p align="center"><strong>tee liik ja nimi</strong></p></td>
    <td width="132"><p align="center"><strong>kaugus (m), suund (N-S-N)</strong></p></td>
    <td width="232"><p align="center"><strong>koormus (s�idukite arv aja�hikus)</strong></p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">1.</p></td>
    <td width="227"><p align="center">&nbsp;</p></td>
    <td width="132"><p align="center">&nbsp;</p></td>
    <td width="232"><p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">2.</p></td>
    <td width="227"><p align="center">&nbsp;</p></td>
    <td width="132"><p align="center">&nbsp;</p></td>
    <td width="232"><p align="center">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">3.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">4.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">5.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">6.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">7.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
  <tr>
    <td width="45"><p align="center">8.</p></td>
    <td width="227"><p align="left">&nbsp;</p></td>
    <td width="132"><p align="left">&nbsp;</p></td>
    <td width="232"><p align="left">&nbsp;</p></td>
  </tr>
</table>
<p>&nbsp;</p>
<p>Koosta arvutirakenduste abil m��tmispiirkonna l�hema �mbruse  kaart ning lisa see protokollile. Kaardile tuleb m�rkida m��tmiskoht ja  suuremad saasteallikad.</p>
<p>&nbsp;</p>
<p>Joonista prooviv�tukoha plaan v�i tee foto, millelt saaks  v�lja lugeda filtrihoidja asendi maapinna, seinte ja valdavate tuulte suhtes. M�rgi  joonisele kindlasti p�hjasuund. Lisa see protokollile.</p>
<div>
    <p>Hommikune ja �htune  tipptund t��le-t��lt �ra liiklustihedustega v�ib suurusj�rkudes erineda  �ldisest keskmisest. Kuna tahmaproov v�etakse 24h keskmisena, siis v�ib suur  osa filtrile kogunevast liiklussaastest p�rineda vaid l�hikestelt  ajavahemikelt.</p>
</div>



</form>
<? } 
}
?>