<?
	include("globals.php");
	include("tabel_class_iid.php");
	include("tabel_class_iid_opetaja.php");
	$eh=$_GET["action"];
	$fid=$_GET["fid"];
	if($eh=="new"){
		// kui me saabume kutsete leheküljelt, siis selle id kaudu saab andmebaasist vastavad värgid
		$kutse_id=$_GET["kutse_id"];
		$etendus_id=$_GET["etendus_id"];
		$query_kutse="SELECT * FROM kutse WHERE id='".$kutse_id."'";
		// et ei satuks olematule tabelireale ...
		if (!$etendus_id) $etendus_id=0;
//		echo $query;
		$result_kutse=mysql_query($query_kutse);
		$line_kutse=mysql_fetch_array($result_kutse); 
		
		if ($line_kutse["aadress"]) $koolinimi=$line_kutse["nimi"]; else $koolinimi="Nimetu";
		
		$query_new="INSERT INTO kool (nimi, aadress, email1, kontakt1, tel1, markused, kutse_".$etendus_id.", date) VALUES ('".$koolinimi."', '".$line_kutse["aadress"]."', '".$line_kutse["email1"]."', '".$line_kutse["kontakt1"]."', '".$line_kutse["tel1"]."', '".$line_kutse["markused"]."','1', '".date("Y-m-d")."')";
//		echo $query_new;
		$tmp=mysql_query($query_new);
		$tmp=mysql_fetch_array(mysql_query("SELECT last_insert_id()"));
		$fid=$tmp["last_insert_id()"];
		
		// NB kohe peaks tegema ka vastava kutse_kool tabeli kirje ...
		if($etendus_id)
		{
			$query_seos="INSERT INTO kutse_kool (oid1, oid2) VALUES ('".$kutse_id."', '".$fid."')";
			$result_seos=mysql_query($query_seos);
		}
	
		
?>
<link href="scat.css" rel="stylesheet" type="text/css" />
<style type="text/css">
<!--
.style1 {color: #FF0000}
-->
</style>
<!--<table width="100%" border="0">
  <tr>
    <td class="fields"><? //echo "Salvesta! fid = ", $fid; ?></td>
  </tr>
</table>--><?
		// ------------------------------------------------
		} elseif($eh=="save"){
		  $valjad=array("nimi","kontakt1","kontakt2","tel1","tel2","email1","email2","aadress","maakond","markused","amet1", "amet2", "tyyp","PK", "LK", "kutse_1", "kutse_2", "kutse_3", "kutse_4", "kutse_5", "kutse_7","on_globe","kontakt3", "tel3", "email3", "amet3", "veeb", "yldine_email", "on_tugikool");
			foreach($valjad as $var){
			$rida[$var]=$var."='".$_POST[$var]."'";
			}
			$query="UPDATE kool SET ".implode(",",$rida)." WHERE id=".$fid." LIMIT 1";
			sql_rida($login_id, $query, 1, 0);


	// kui chekbox on kontrollitud, muudetakse pildikataloogi nimi vastavaks reisi toimumise ajale ja nimele
	if ($_POST["setasi"]==1)
	{	
		$yldkool=$_POST["yldkool"];
		// võtan andmed "yldkoolid" andmebaasist
		$query="SELECT nimi,  PK, LK, kooli_tyyp FROM yldkoolid WHERE nimi='".$yldkool."'";
//		echo $query;
		$result=mysql_query($query);
		$linek=mysql_fetch_array($result); 
		sql_rida($login_id, "UPDATE kool SET nimi='".$linek["nimi"]."', PK='".$linek["PK"]."', LK='".$linek["LK"]."', kooli_tyyp='".$linek["kooli_tyyp"]."' WHERE id=".$fid, 1, 0);
	}
	}	

	 $line=sql_val($login_id, "SELECT * FROM kool WHERE id=".$fid, 0, 0);
 ?> 
<br>

<form name="kool" method="post" action="<? echo $PHP_SELF."?page=kool_disp&action=save&fid=".$fid;?> ">
<h1>Tahma (</em></a>Black Carbon) analüüsimise  projekti mõõtmiskoha iseloomustus</h1>
<p><strong>A. Üldandmed</strong></p>
<p>Kooli nimi:</p>
<p>Protokolli täitjad:</p>
<p>Mõõtekoha nimi:</p>
<p>Mõõtekoha geograafilised koordinaadid: __________ N;  __________ E; __________ m.</p>
<p>Mõõtekoha ümbruse kirjeldus:<br />
  Asula suurus (<em>märgi sobiv variant</em>):</p>
<br clear="all" />
<div>
  <ul>
    <li>üle 100&nbsp;000 elaniku;</li>
    <li>30&nbsp;000 – 100&nbsp;000 elanikku;</li>
    <li>10&nbsp;000 – 30&nbsp;000 elanikku;</li>
    <li>5000 – 10&nbsp;000 elanikku;</li>
    <li>1000 – 5000 elanikku;</li>
    <li>100 – 1000 elanikku;</li>
    <li>alla 100 elaniku;</li>
    <li>maaline asula.</li>
  </ul>
</div>
<br clear="all" />
<p>Lähedal asuvad saasteallikad (<em>märgi kõik sobivad variandid</em>):</p>
<ul>
  <li>saasteallikad puuduvad;</li>
  <li>linn või kool asub linnas;</li>
  <li>tiheda liiklusega maantee, magistraaltänav või  linnakeskus;</li>
  <li>eramajad, mida köetakse puudega;</li>
  <li>eramajad, mida köetakse kivisöega;</li>
  <li>aktiivne põllumajandus;</li>
  <li>reovee puhastamisega tegelev ettevõte;</li>
  <li>aktiivne laevandus (mereäärsed koolid);</li>
  <li>katlamaja, kus kasutatakse rasket kütteõli  (masuut) või põlevkivi;</li>
  <li>katlamaja, kus kasutatakse kivisütt;</li>
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

