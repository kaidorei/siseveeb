<?
include("connect.php");
include("authsys.php");	
if($loginform==1){
	echo "Juurdepääs keelatud!";}
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


<h1>GLOBE mõõtmiskoha iseloomustus</h1>
<p><strong>A. Üldandmed</strong></p>
<p>Kooli nimi: <strong><? echo $tulem_kool["nimi"];?></strong></p>
<p>Protokolli täitjad: </p>
<p>
  Mõõtekoha nimi:
  <input name="nimi" type="text" id="df" size="50" maxlength="100" value="<? echo $tulem_site["nimi"]; ?>">
</p>
<p>Mõõtekoha geograafilised koordinaadid:
  <input type="text" name="WG_LA" id="WG_LA" size="10" value="<? echo $tulem_site["WG_LA"]; ?>">N;
<input type="text" name="WG_LO" id="WG_LO" size="10" value="<? echo $tulem_site["WG_LO"]; ?>">
E; 
<input type="text" name="altitude" id="altitude" size="10"  value="<? echo $tulem_site["altitude"]; ?>">
m.</p>
<p>Mõõtekoha ümbruse kirjeldus:<br />
  Asula suurus (<em>märgi sobiv variant</em>):</p>
<table width="200">
  <tr>
    <td><label>
      <input type="radio" name="asula_kirjeldus" value="0" id="asula_kirjeldus_0">
      üle 100 000 elaniku</label></td>
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

<p>Lähedal asuvad saasteallikad (<em>märgi kõik sobivad variandid</em>):</p>
<p>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_0">
    saasteallikad puuduvad</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_1">
    reovee puhastamisega tegelev ettevõte</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_2">
    aktiivne laevandus (mereäärsed koolid)</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_3">
    katlamaja, kus kasutatakse rasket kütteõli (masuut) või põlevkivi</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_4">
    katlamaja, kus kasutatakse kivisütt</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_5">
    linn või kool asub linnas</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_6">
    tiheda liiklusega maantee, magistraaltänav või linnakeskus</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_7">
    eramajad, mida köetakse puudega</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_7">
    eramajad, mida köetakse kivis&ouml;ega</label>
  <br>
  <label>
    <input type="checkbox" name="saasteallikad" value="checkbox" id="saasteallikad_8">
    aktiivne põllumajandus</label>
  <br>
</p>
<ul>
  <li></li>
  <li>tööstushoone:  ________________________________________________ (<em>milline?</em>);</li>
  <li>muu:  _______________________________________________________ (<em>milline?</em>).</li>
</ul>
<br clear="all" />
<p align="left">Saasteallikate kaugused linnulennult ja põhiline saaste liik  (suits, tolm, gaas…):</p>
<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45"><br />
      <strong>nr</strong></td>
    <td width="227"><p align="center"><strong>saasteallikas</strong></p></td>
    <td width="132"><p align="center"><strong>kaugus (m), suund (N-S-N)</strong></p></td>
    <td width="232"><p align="center"><strong>põhiline saaste liik</strong></p></td>
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
<p align="left">Ümbruskonna küttekollete kirjeldus:</p>
<ul>
  <ul>
    <li>küttekollete liik asulas tervikuna ja  mõõtmispaiga lähedal:</li>
  </ul>
</ul>
<p>&nbsp;</p>
<ul>
  <ul>
    <li>küttekollete ligikaudne arv: </li>
  </ul>
</ul>
<p>&nbsp;</p>
<ul>
  <ul>
    <li>kollete tihedus (arv pinnaühiku kohta):</li>
  </ul>
</ul>
<p>&nbsp;</p>
<ul>
  <ul>
    <li>põletusainete liigid:</li>
  </ul>
</ul>
<p>&nbsp;</p>
<p>&nbsp;</p>
<p>Kuna suur osa  õhusaastast pärineb sissepõlemismootoritest ning tahma tekitavad  diiselmootoriga autod, tolmu igasuguste sõidukite rattad, pakub meile huvi ka  info ümbruskonna transpordi kohta.<br />
  Suuremad teed ümbruskonnas (maantee, raudtee, lennuväli...),  nende kaugus ja suund, koormus (sõidukite arv ajaühikus, võimalusel eraldi  tipptundidel ja tavaolukorras).</p>
<table border="1" cellspacing="0" cellpadding="0">
  <tr>
    <td width="45"><br />
      <strong>nr</strong></td>
    <td width="227"><p align="center"><strong>tee liik ja nimi</strong></p></td>
    <td width="132"><p align="center"><strong>kaugus (m), suund (N-S-N)</strong></p></td>
    <td width="232"><p align="center"><strong>koormus (sõidukite arv ajaühikus)</strong></p></td>
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
<p>Koosta arvutirakenduste abil mõõtmispiirkonna lähema ümbruse  kaart ning lisa see protokollile. Kaardile tuleb märkida mõõtmiskoht ja  suuremad saasteallikad.</p>
<p>&nbsp;</p>
<p>Joonista proovivõtukoha plaan või tee foto, millelt saaks  välja lugeda filtrihoidja asendi maapinna, seinte ja valdavate tuulte suhtes. Märgi  joonisele kindlasti põhjasuund. Lisa see protokollile.</p>
<div>
    <p>Hommikune ja õhtune  tipptund tööle-töölt ära liiklustihedustega võib suurusjärkudes erineda  üldisest keskmisest. Kuna tahmaproov võetakse 24h keskmisena, siis võib suur  osa filtrile kogunevast liiklussaastest pärineda vaid lühikestelt  ajavahemikelt.</p>
</div>



</form>
<? } 
}
?>